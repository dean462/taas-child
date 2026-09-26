<?php
/**
 * Template Name: Logo Test
 */
// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', 1);

get_header();
?>
<div style="background:#111;color:#fff;padding:40px;font-family:monospace;font-size:13px;line-height:1.8">
<h2 style="color:#FFC800;">Logo Test — Page ID: <?php echo get_the_ID(); ?></h2>
<?php
$post_id = get_the_ID();

echo "<p>post_id: $post_id</p>";

// Test 1: raw postmeta
$raw = get_post_meta($post_id, 'provider_logo', true);
echo "<p>Raw postmeta 'provider_logo': " . var_export($raw, true) . "</p>";

// Test 2: ACF
$acf = function_exists('get_field') ? get_field('provider_logo', $post_id) : 'ACF not loaded';
echo "<p>ACF get_field: " . var_export($acf, true) . "</p>";

// Test 3: wp_get_attachment_image_src with a known media ID
if ($raw && is_numeric($raw)) {
    $src = wp_get_attachment_image_src((int)$raw, 'full');
    echo "<p>wp_get_attachment_image_src($raw): " . var_export($src, true) . "</p>";
    if ($src) {
        echo "<p>Image URL: {$src[0]}</p>";
        echo "<img src='{$src[0]}' style='max-height:60px;background:#fff;padding:8px'>";
    }
} else {
    // Try hardcoded autosure ID 291
    $src = wp_get_attachment_image_src(291, 'full');
    echo "<p>Hardcoded test ID 291: " . var_export($src, true) . "</p>";
    if ($src) echo "<img src='{$src[0]}' style='max-height:60px;background:#fff;padding:8px'>";
}

// Test 4: check all provider_logo meta across all 5 pages
global $wpdb;
$rows = $wpdb->get_results("SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = 'provider_logo'");
echo "<p>All provider_logo postmeta rows: " . count($rows) . "</p>";
foreach ($rows as $row) {
    echo "<p>  Page {$row->post_id} → {$row->meta_value}</p>";
}
?>
</div>
<?php get_footer(); ?>
