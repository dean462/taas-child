<?php
/**
 * Runner: Create Terms & Conditions + Cookie Policy pages
 * Upload to: public_html/taas-runner-legal-pages.php
 * Access: https://wordpress-1623285-6409270.cloudwaysapps.com/taas-runner-legal-pages.php
 * Self-deletes after execution.
 */

require_once __DIR__ . '/wp-load.php';

if (!current_user_can('manage_options')) {
    wp_die('Unauthorised.');
}

header('Content-Type: text/plain; charset=utf-8');
ob_implicit_flush(true);

echo "=== TAAS Legal Pages Runner ===\n\n";

global $wpdb;
$aioseo_table = $wpdb->prefix . 'aioseo_posts';

$pages = array(
    array(
        'title'    => 'Terms & Conditions',
        'slug'     => 'terms-and-conditions',
        'template' => 'template-terms-conditions.php',
        'seo_title'=> 'Terms & Conditions | Tony Allen Auto Service',
        'seo_desc' => 'Terms and conditions for services at Tony Allen Auto Service, Manukau. Covers estimates, payment, warranty, vehicle collection, and dispute resolution.',
    ),
    array(
        'title'    => 'Cookie & Analytics Policy',
        'slug'     => 'cookie-policy',
        'template' => 'template-cookie-policy.php',
        'seo_title'=> 'Cookie & Analytics Policy | Tony Allen Auto Service',
        'seo_desc' => 'What cookies and analytics tools the Tony Allen Auto Service website uses, why we use them, and how to manage them.',
    ),
);

$created = 0;

foreach ($pages as $p) {
    echo "── {$p['title']} ──\n";

    $page = get_page_by_path($p['slug']);

    if (!$page) {
        $page_id = wp_insert_post(array(
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ));
        echo "  Created /{$p['slug']}/ — post ID {$page_id}\n";
    } else {
        $page_id = $page->ID;
        wp_update_post(array(
            'ID'           => $page_id,
            'post_content' => '',
            'post_status'  => 'publish',
        ));
        echo "  Found /{$p['slug']}/ — post ID {$page_id}\n";
    }

    // Assign template
    update_post_meta($page_id, '_wp_page_template', $p['template']);
    echo "  Template: {$p['template']}\n";

    // AIOSEO
    $aioseo_data = array(
        'post_id'              => $page_id,
        'title'                => $p['seo_title'],
        'description'          => $p['seo_desc'],
        'og_title'             => $p['seo_title'],
        'og_description'       => $p['seo_desc'],
        'twitter_title'        => $p['seo_title'],
        'twitter_description'  => $p['seo_desc'],
        'robots_noindex'       => 0,
        'robots_nofollow'      => 0,
    );

    $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$aioseo_table} WHERE post_id = %d", $page_id));

    if ($exists) {
        $wpdb->update($aioseo_table, $aioseo_data, array('post_id' => $page_id));
        echo "  AIOSEO updated.\n";
    } else {
        $wpdb->insert($aioseo_table, $aioseo_data);
        echo "  AIOSEO inserted.\n";
    }

    echo "  SEO Title: {$p['seo_title']}\n";
    echo "  SEO Desc:  {$p['seo_desc']}\n\n";

    $created++;
}

// Flush rewrite rules
flush_rewrite_rules();
echo "Rewrite rules flushed.\n";

echo "\n── Summary ──\n";
echo "{$created} pages processed.\n";
echo "  /terms-and-conditions/\n";
echo "  /cookie-policy/\n";
echo "  /privacy-policy/ (already live)\n";
echo "\nAll three legal pages should now be linked from the footer.\n";

// Self-delete
$me = __FILE__;
if (is_file($me)) {
    unlink($me);
    echo "Runner self-deleted.\n";
}

echo "\n=== Done. ===\n";
