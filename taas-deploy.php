<?php
/**
 * TAAS — Auto-deploy from GitHub
 *
 * GitHub sends a webhook to /wp-json/taas/v1/deploy on every push to main.
 * We verify GitHub's signature, then ask Cloudways to pull the latest theme
 * (same as clicking "Pull" in Deployment via Git).
 *
 * Secrets live in wp-config.php, never in this repo:
 *   define('TAAS_DEPLOY_SECRET', '...');   // same value as the GitHub webhook secret
 *   define('TAAS_CW_TOKEN',      '...');   // Cloudways API access token
 *   define('TAAS_CW_SERVER_ID',  '...');   // from the Cloudways server URL
 *   define('TAAS_CW_APP_ID',     '...');   // from the Cloudways application URL
 *
 * If any are missing, the endpoint does nothing.
 */

if (!defined('ABSPATH')) exit;

define('TAAS_DEPLOY_GIT_URL', 'git@github.com:dean462/taas-child.git');
define('TAAS_DEPLOY_BRANCH',  'main');
define('TAAS_DEPLOY_PATH',    'wp-content/themes/taas-child/');

add_action('rest_api_init', function () {
    register_rest_route('taas/v1', '/deploy', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true', // authenticated by GitHub signature below
        'callback'            => 'taas_deploy_webhook',
    ]);
});

function taas_deploy_webhook(WP_REST_Request $request) {
    foreach (['TAAS_DEPLOY_SECRET', 'TAAS_CW_TOKEN', 'TAAS_CW_SERVER_ID', 'TAAS_CW_APP_ID'] as $c) {
        if (!defined($c) || !constant($c)) {
            return new WP_REST_Response(['ok' => false, 'error' => 'Deploy not configured'], 503);
        }
    }

    // 1. Verify it really came from GitHub (HMAC SHA-256 of the raw body).
    $body = $request->get_body();
    $sig  = (string) $request->get_header('x-hub-signature-256');
    $calc = 'sha256=' . hash_hmac('sha256', $body, TAAS_DEPLOY_SECRET);
    if (!$sig || !hash_equals($calc, $sig)) {
        return new WP_REST_Response(['ok' => false, 'error' => 'Bad signature'], 401);
    }

    // 2. GitHub's test ping when the webhook is created.
    $event = (string) $request->get_header('x-github-event');
    if ($event === 'ping') {
        return new WP_REST_Response(['ok' => true, 'pong' => true], 200);
    }
    if ($event !== 'push') {
        return new WP_REST_Response(['ok' => true, 'skipped' => 'not a push'], 200);
    }

    // 3. Only deploy pushes to main.
    $payload = json_decode($body, true);
    if (!is_array($payload) && isset($_POST['payload'])) {
        $payload = json_decode(wp_unslash($_POST['payload']), true);
    }
    $ref = is_array($payload) ? ($payload['ref'] ?? '') : '';
    if ($ref !== 'refs/heads/' . TAAS_DEPLOY_BRANCH) {
        return new WP_REST_Response(['ok' => true, 'skipped' => 'branch ' . $ref], 200);
    }

    // 4. Ask Cloudways to pull.
    $res = wp_remote_post('https://api.cloudways.com/api/v1/git/pull', [
        'timeout' => 20,
        'headers' => [
            'Authorization' => 'Bearer ' . TAAS_CW_TOKEN,
            'Accept'        => 'application/json',
        ],
        'body' => [
            'server_id'   => TAAS_CW_SERVER_ID,
            'app_id'      => TAAS_CW_APP_ID,
            'git_url'     => TAAS_DEPLOY_GIT_URL,
            'branch_name' => TAAS_DEPLOY_BRANCH,
            'deploy_path' => TAAS_DEPLOY_PATH,
        ],
    ]);

    if (is_wp_error($res)) {
        return new WP_REST_Response(['ok' => false, 'error' => $res->get_error_message()], 502);
    }

    $code = wp_remote_retrieve_response_code($res);
    $out  = json_decode(wp_remote_retrieve_body($res), true);

    // Keep a short record of the last deploy (visible to Claude via the connector).
    update_option('taas_last_deploy', [
        'time'   => current_time('mysql'),
        'commit' => is_array($payload) ? substr((string) ($payload['after'] ?? ''), 0, 12) : '',
        'status' => $code,
    ], false);

    return new WP_REST_Response([
        'ok'         => $code >= 200 && $code < 300,
        'cloudways'  => $code,
        'operation'  => is_array($out) ? ($out['operation_id'] ?? null) : null,
    ], ($code >= 200 && $code < 300) ? 200 : 502);
}
