<?php
/**
 * single.php — TAAS Child Theme
 * Renders individual blog posts with TAAS header/footer.
 * Tony Allen Auto Service — taas.co.nz
 * Built: May 2026
 */

wp_enqueue_style( 'taas-global', get_stylesheet_directory_uri() . '/taas-global.css' );
wp_enqueue_style( 'taas-font',   'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap' );

$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$email       = defined('TAAS_EMAIL')        ? TAAS_EMAIL        : 'enquiries@taas.co.nz';
$hours       = defined('TAAS_HOURS')        ? TAAS_HOURS        : 'Monday–Friday 7:30am–5:00pm';
$rating      = defined('TAAS_RATING')       ? TAAS_RATING       : '4.2';
$reviews     = defined('TAAS_REVIEWS')      ? TAAS_REVIEWS      : '200+';
$site_url    = get_site_url();
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url    = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Content cleanup filter — fixes old-site HTML at render time ───────────
function taas_clean_blog_content($content) {
    // Remove dark CTA blocks baked into old posts
    $content = preg_replace('/<div[^>]*style="[^"]*background(?:-color)?:\s*#1[Aa][Aa]1[Aa][Aa][^"]*"[^>]*>[\s\S]*?<\/div>/i', '', $content);
    $content = preg_replace('/<div[^>]*style="[^"]*background(?:-color)?:\s*(?:#FFC800|#111|linear-gradient)[^"]*"[^>]*>[\s\S]*?<\/div>/i', '', $content);

    // Remove SVGs (old TOC icons)
    $content = preg_replace('/<svg[^>]*>[\s\S]*?<\/svg>/i', '', $content);

    // Strip aria-* attributes
    $content = preg_replace('/\s+aria-[a-z-]+="[^"]*"/i', '', $content);

    // Strip inline styles from text elements
    foreach (['p','h1','h2','h3','h4','h5','h6','span','div','ul','ol','li','strong','b','em','i','blockquote'] as $tag) {
        $content = preg_replace('/(<' . $tag . ')\s+style="[^"]*"/i', '$1', $content);
    }

    // Fix heading hierarchy: h4→h2, h5→h3
    $content = preg_replace('/<h4[^>]*>\s*<(?:b|strong)>(.*?)<\/(?:b|strong)>\s*<\/h4>/is', '<h2>$1</h2>', $content);
    $content = preg_replace('/<h4[^>]*>/i', '<h2>', $content);
    $content = str_ireplace('</h4>', '</h2>', $content);
    $content = preg_replace('/<h5[^>]*>/i', '<h3>', $content);
    $content = str_ireplace('</h5>', '</h3>', $content);

    // Remove bold/strong wrapping inside headings
    $content = preg_replace_callback('/<(h[2-3])>(.*?)<\/\1>/is', function($m) {
        $inner = preg_replace('/<\/?(?:strong|b)>/i', '', $m[2]);
        return '<' . $m[1] . '>' . trim($inner) . '</' . $m[1] . '>';
    }, $content);

    // Convert <b>→<strong>, <i>→<em>
    $content = str_ireplace(['<b>', '</b>'], ['<strong>', '</strong>'], $content);
    $content = str_ireplace(['<i>', '</i>'], ['<em>', '</em>'], $content);

    // Clean tag attributes
    $content = preg_replace('/<li[^>]*>/i', '<li>', $content);
    $content = preg_replace('/<(h[23])\s+[^>]*>/i', '<$1>', $content);

    // Normalize <br>
    $content = preg_replace('/<br\s*\/?\s*>/i', '<br>', $content);

    // Remove empty elements — including paragraphs with multiple &nbsp; entities
    $content = preg_replace('/<p[^>]*>(?:\s|&nbsp;|&#160;|\xC2\xA0)*<\/p>/i', '', $content);
    $content = preg_replace('/<h[2-4][^>]*>\s*<\/h[2-4]>/i', '', $content);
    $content = preg_replace('/<strong>\s*<\/strong>/i', '', $content);
    $content = preg_replace('/<em>\s*<\/em>/i', '', $content);
    $content = preg_replace('/<div[^>]*>\s*<\/div>/i', '', $content);
    $content = preg_replace('/<p[^>]*>\s*(<br>\s*)+<\/p>/i', '', $content);
    $content = preg_replace('/(<br>\s*){3,}/i', '<br><br>', $content);

    // ── Convert dash-prefix paragraphs to proper lists ───────────────────────
    $content = preg_replace('/<p>\s*[–—\-]\s*/i', '<p class="__dashitem__">', $content);

    // ── Group consecutive short paragraphs into lists ─────────────────────────
    // Split content into lines for processing
    $lines = explode("\n", $content);
    $output = [];
    $in_list = false;
    $list_type = 'ul'; // ul for dash items, could be ol for numbered

    foreach ($lines as $line) {
        $trimmed = trim($line);
        if (empty($trimmed)) continue;

        $is_dash_item = (strpos($trimmed, '<p class="__dashitem__">') !== false);

        // Also detect short paragraphs that look like list items
        // (single sentence, no heading, under 120 chars text, following another similar item)
        $is_short_item = false;
        if (!$is_dash_item && preg_match('/^<p>(.*?)<\/p>$/is', $trimmed, $sm)) {
            $text_len = strlen(strip_tags($sm[1]));
            if ($text_len > 5 && $text_len < 120 && $in_list) {
                // Continue the list if we're already in one and this looks like an item
                $is_short_item = true;
            }
        }

        if ($is_dash_item || $is_short_item) {
            if (!$in_list) {
                $output[] = '<ul>';
                $in_list = true;
            }
            // Extract the paragraph content
            if (preg_match('/<p[^>]*>(.*?)<\/p>/is', $trimmed, $pm)) {
                $output[] = '<li>' . trim($pm[1]) . '</li>';
            } else {
                $output[] = $trimmed;
            }
        } else {
            if ($in_list) {
                $output[] = '</ul>';
                $in_list = false;
            }
            $output[] = $trimmed;
        }
    }
    if ($in_list) $output[] = '</ul>';

    $content = implode("\n", $output);

    // Clean up marker class
    $content = str_replace(' class="__dashitem__"', '', $content);

    // Final whitespace cleanup
    $content = preg_replace('/\n{3,}/', "\n\n", $content);
    $content = trim($content);

    return $content;
}

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
    $post_id      = get_the_ID();
    $title        = get_the_title();
    $date         = get_the_date( 'j F Y' );
    $author       = get_the_author();
    $cats         = get_the_category();
    $cat_name     = $cats ? esc_html( $cats[0]->name ) : 'Automotive';
    $cat_url      = $cats ? esc_url( get_category_link( $cats[0]->term_id ) ) : '#';
    $raw_content  = apply_filters( 'the_content', get_the_content() );
    $content      = taas_clean_blog_content( $raw_content );
    $excerpt      = get_the_excerpt();
    $wc           = str_word_count( strip_tags( get_post_field( 'post_content', $post_id ) ) );
    $read_time    = max( 1, round( $wc / 200 ) );
    $thumb        = get_the_post_thumbnail_url( null, 'large' );
    $page_url     = get_permalink();

    // Schema
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'           => 'BreadcrumbList',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $site_url . '/blog/' ],
                    [ '@type' => 'ListItem', 'position' => 3, 'name' => $title, 'item' => $page_url ],
                ],
            ],
            [
                '@type'         => 'Article',
                'headline'      => $title,
                'datePublished' => get_the_date( 'c' ),
                'dateModified'  => get_the_modified_date( 'c' ),
                'author'        => [ '@type' => 'Organization', 'name' => 'Tony Allen Auto Service' ],
                'publisher'     => [
                    '@type' => 'Organization',
                    'name'  => 'Tony Allen Auto Service',
                    'url'   => $site_url,
                ],
                'url'         => $page_url,
                'description' => wp_strip_all_tags( $excerpt ),
                'image'       => $thumb ?: $site_url . '/wp-content/uploads/2026/05/taas-og-image.png',
            ],
            [
                '@type'           => [ 'AutoRepair', 'LocalBusiness' ],
                '@id'             => $site_url . '/#organization',
                'name'            => 'Tony Allen Auto Service',
                'url'             => $site_url,
                'telephone'       => [ $phone_local, $phone_free ],
                'address'         => [ '@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'postalCode' => '2104', 'addressCountry' => 'NZ' ],
                'foundingDate'    => '1985-10',
                'aggregateRating' => [ '@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/','',$reviews), 'bestRating' => '5' ],
                'sameAs'          => [ 'https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060' ],
            ],
        ],
    ];
?>
<script type="application/ld+json"><?php echo json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>

<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.single .site-content,
.single .entry-content,
.single .entry-header,
.single article.type-post,
.single #primary,
.single #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.single{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}

/* ── TAAS Single Post ───────────────────────────────────────────────────────── */
.sp-wrap { max-width: 780px; margin: 0 auto; padding: 0 24px 80px; }
.sp-full { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }

/* Breadcrumb */
.sp-breadcrumb { background: #F7F7F5; border-bottom: 1px solid var(--taas-border, #E8E8E4); padding: 12px 0; }
.sp-breadcrumb__inner { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #999; flex-wrap: wrap; }
.sp-breadcrumb__inner a { color: #666; text-decoration: none; }
.sp-breadcrumb__inner a:hover { color: var(--taas-yellow, #FFC800); }
.sp-breadcrumb__sep { color: #ccc; }

/* Hero */
.sp-hero { background: var(--taas-black, #111); padding: 56px 0 48px; }
.sp-hero__inner { max-width: 780px; margin: 0 auto; padding: 0 24px; }
.sp-hero__cat { display: inline-block; background: var(--taas-yellow, #FFC800); color: #1A1A1A; font-size: 10px; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; padding: 4px 12px; margin-bottom: 16px; text-decoration: none; }
.sp-hero__h1 { font-family: 'Inter', Arial, sans-serif; font-size: clamp(28px, 4.5vw, 48px); font-weight: 900; color: #fff; line-height: 1.1; letter-spacing: -.01em; margin-bottom: 20px; }
.sp-hero__meta { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
.sp-hero__meta-item { display: flex; align-items: center; gap: 6px; font-size: 13px; color: #888; font-family: 'Inter', Arial, sans-serif; }
.sp-hero__meta-item svg { flex-shrink: 0; }

/* Featured image */
.sp-image { background: #1A1A1A; }
.sp-image img { width: 100%; max-height: 480px; object-fit: cover; display: block; }

/* Content */
.sp-content { padding-top: 48px; }
.sp-content h2 { font-family: 'Inter', Arial, sans-serif; font-size: clamp(22px, 2.8vw, 32px); font-weight: 800; color: #111; letter-spacing: -.01em; margin: 48px 0 16px; line-height: 1.15; padding-bottom: 10px; border-bottom: 3px solid var(--taas-yellow, #FFC800); }
.sp-content h2:first-child { margin-top: 0; }
.sp-content h3 { font-family: 'Inter', Arial, sans-serif; font-size: 19px; font-weight: 700; color: #111; margin: 32px 0 12px; padding-left: 14px; border-left: 3px solid var(--taas-yellow, #FFC800); }
.sp-content h4 { font-family: 'Inter', Arial, sans-serif; font-size: 16px; font-weight: 700; color: #333; margin: 20px 0 8px; }
.sp-content p { font-family: 'Inter', Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.8; margin-bottom: 16px; }
.sp-content p:empty { display: none; margin: 0; padding: 0; line-height: 0; }
.sp-content ul, .sp-content ol { font-family: 'Inter', Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.75; margin: 0 0 20px 0; padding-left: 0; list-style: none; }
.sp-content ul li { margin-bottom: 8px; padding-left: 22px; position: relative; }
.sp-content ul li::before { content: ''; position: absolute; left: 0; top: 10px; width: 8px; height: 8px; background: var(--taas-yellow, #FFC800); border-radius: 50%; }
.sp-content ol { list-style: decimal; padding-left: 24px; }
.sp-content ol li { margin-bottom: 8px; padding-left: 4px; }
.sp-content li { margin-bottom: 8px; }
.sp-content strong { font-weight: 700; color: #111; }
.sp-content em { font-style: italic; }
.sp-content a { color: #1A1A1A; text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--taas-yellow, #FFC800); text-decoration-thickness: 2px; }
.sp-content a:hover { color: var(--taas-yellow, #FFC800); }
.sp-content blockquote { border-left: 4px solid var(--taas-yellow, #FFC800); padding: 20px 24px; background: #F7F7F5; margin: 28px 0; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; }
.sp-content blockquote p { color: #555; font-style: italic; margin-bottom: 0; font-size: 15px; }
.sp-content table { width: 100%; border-collapse: collapse; margin: 24px 0; font-size: 14px; font-family: 'Inter', Arial, sans-serif; border-radius: var(--taas-radius, 6px); overflow: hidden; }
.sp-content th { background: #1A1A1A; color: #fff; padding: 12px 16px; text-align: left; font-weight: 700; font-size: 13px; letter-spacing: 0.03em; }
.sp-content td { padding: 12px 16px; border-bottom: 1px solid #E8E8E4; color: #444; }
.sp-content tr:nth-child(even) td { background: #FAFAF8; }
.sp-content tr:last-child td { border-bottom: none; }
.sp-content img { max-width: 100%; height: auto; border-radius: var(--taas-radius, 6px); margin: 16px 0; }
.sp-content figure { margin: 28px 0; }
.sp-content figcaption { font-size: 13px; color: #888; text-align: center; margin-top: 8px; }

/* Dark info boxes from CTA in content */
.sp-content div[style*="background:#1A1A1A"], 
.sp-content div[style*="background: #1A1A1A"] {
    border-radius: 6px;
    margin: 40px 0;
}

/* Mid-article CTA strip */
.sp-mid-cta { background: var(--taas-yellow, #FFC800); padding: 24px; margin: 48px 0; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
.sp-mid-cta__text { font-family: 'Inter', Arial, sans-serif; font-size: 16px; font-weight: 700; color: #1A1A1A; }
.sp-mid-cta__btn { display: inline-block; background: #1A1A1A; color: #fff !important; font-family: 'Inter', Arial, sans-serif; font-weight: 700; font-size: 14px; letter-spacing: .04em; text-transform: uppercase; padding: 12px 24px; text-decoration: none; white-space: nowrap; }
.sp-mid-cta__btn:hover { background: #000; }

/* Post footer */
.sp-post-footer { border-top: 2px solid #E8E8E4; margin-top: 48px; padding-top: 32px; }
.sp-post-footer__tags { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px; }
.sp-tag { font-family: 'Inter', Arial, sans-serif; font-size: 12px; font-weight: 600; color: #666; background: #F7F7F5; padding: 4px 12px; border: 1px solid #E8E8E4; text-decoration: none; }
.sp-tag:hover { background: #FFC800; color: #1A1A1A; border-color: #FFC800; }

/* Post nav */
.sp-post-nav { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: #E8E8E4; margin-top: 48px; }
.sp-post-nav__item { background: #fff; padding: 20px 24px; text-decoration: none; transition: background .15s; }
.sp-post-nav__item:hover { background: #F7F7F5; }
.sp-post-nav__item--next { text-align: right; }
.sp-post-nav__dir { font-family: 'Inter', Arial, sans-serif; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: #999; display: block; margin-bottom: 4px; }
.sp-post-nav__title { font-family: 'Inter', Arial, sans-serif; font-size: 14px; font-weight: 600; color: #333; line-height: 1.4; }

/* CTA section */
.sp-cta { background: #1A1A1A; padding: 64px 0; }
.sp-cta__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; text-align: center; }
.sp-cta__h2 { font-family: 'Inter', Arial, sans-serif; font-size: clamp(26px, 3.5vw, 40px); font-weight: 900; color: #fff; margin-bottom: 10px; }
.sp-cta__h2 span { color: var(--taas-yellow, #FFC800); }
.sp-cta__sub { font-family: 'Inter', Arial, sans-serif; font-size: 16px; color: #888; margin-bottom: 32px; }
.sp-cta__phone { display: block; font-family: 'Inter', Arial, sans-serif; font-size: clamp(28px, 4vw, 46px); font-weight: 900; color: var(--taas-yellow, #FFC800); text-decoration: none; margin-bottom: 24px; }
.sp-cta__btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
.sp-btn { display: inline-flex; align-items: center; font-family: 'Inter', Arial, sans-serif; font-weight: 700; font-size: 14px; letter-spacing: .04em; text-transform: uppercase; padding: 14px 28px; text-decoration: none; transition: all .15s; }
.sp-btn--yellow { background: var(--taas-yellow, #FFC800); color: #1A1A1A !important; }
.sp-btn--yellow:hover { background: #e6b400; }
.sp-btn--outline { background: transparent; color: var(--taas-yellow, #FFC800) !important; border: 2px solid var(--taas-yellow, #FFC800); }
.sp-btn--outline:hover { background: var(--taas-yellow, #FFC800); color: #1A1A1A !important; }

/* Responsive */
@media (max-width: 640px) {
    .sp-post-nav { grid-template-columns: 1fr; }
    .sp-mid-cta { flex-direction: column; text-align: center; }
    .sp-hero__meta { gap: 10px; }
    .sp-hero { padding: 40px 0 36px; }
    .sp-hero__h1 { font-size: clamp(24px, 6vw, 36px); }
    .sp-hero__cat { font-size: 9px; }
    .sp-hero__meta-item { font-size: 12px; }
    .sp-content h2 { font-size: clamp(20px, 5vw, 26px); margin: 32px 0 12px; }
    .sp-content h3 { font-size: 16px; }
    .sp-content p { font-size: 15px; }
    .sp-content ul, .sp-content ol { font-size: 15px; }
    .sp-wrap { padding: 0 20px 48px; }
    .sp-content { padding-top: 36px; }
    .sp-cta { padding: 48px 0; }
    .sp-cta__h2 { font-size: clamp(22px, 6vw, 32px); }
    .sp-cta__phone { font-size: clamp(24px, 6vw, 36px); }
    .sp-cta__btns { flex-direction: column; align-items: stretch; }
    .sp-cta__btns .sp-btn { justify-content: center; text-align: center; }
    .sp-breadcrumb__inner { font-size: 12px; }
}
</style>

<!-- ── BREADCRUMB ─────────────────────────────────────────────────────────── -->
<nav class="sp-breadcrumb" aria-label="Breadcrumb">
    <div class="sp-full">
        <div class="sp-breadcrumb__inner">
            <a href="<?php echo esc_url( $site_url ); ?>">Home</a>
            <span class="sp-breadcrumb__sep">›</span>
            <a href="<?php echo esc_url( $site_url . '/blog/' ); ?>">Blog</a>
            <span class="sp-breadcrumb__sep">›</span>
            <span><?php echo esc_html( $title ); ?></span>
        </div>
    </div>
</nav>

<!-- ── HERO ──────────────────────────────────────────────────────────────── -->
<section class="sp-hero" aria-label="Article header">
    <div class="sp-hero__inner">
        <a href="<?php echo $cat_url; ?>" class="sp-hero__cat"><?php echo $cat_name; ?></a>
        <h1 class="sp-hero__h1"><?php echo esc_html( $title ); ?></h1>
        <div class="sp-hero__meta" aria-label="Article details">
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <?php echo esc_html( $date ); ?>
            </span>
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?php echo esc_html( $read_time ); ?> min read
            </span>
            <span class="sp-hero__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Tony Allen Auto Service
            </span>
        </div>
    </div>
</section>

<?php if ( $thumb ) : ?>
<!-- ── FEATURED IMAGE ─────────────────────────────────────────────────────── -->
<div class="sp-image">
    <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="eager">
</div>
<?php endif; ?>

<!-- ── ARTICLE CONTENT ───────────────────────────────────────────────────── -->
<main id="main-content" class="sp-wrap">
    <article class="sp-content" aria-label="Article content">
        <?php echo $content; ?>
    </article>

    <!-- Post tags -->
    <?php
    $tags = get_the_tags();
    if ( $tags ) : ?>
    <div class="sp-post-footer">
        <div class="sp-post-footer__tags" aria-label="Article tags">
            <?php foreach ( $tags as $tag ) : ?>
            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="sp-tag"><?php echo esc_html( $tag->name ); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Post navigation -->
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    if ( $prev_post || $next_post ) : ?>
    <nav class="sp-post-nav" aria-label="Post navigation">
        <?php if ( $prev_post ) : ?>
        <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="sp-post-nav__item">
            <span class="sp-post-nav__dir">← Previous</span>
            <span class="sp-post-nav__title"><?php echo esc_html( get_the_title( $prev_post ) ); ?></span>
        </a>
        <?php else : ?>
        <div></div>
        <?php endif; ?>

        <?php if ( $next_post ) : ?>
        <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="sp-post-nav__item sp-post-nav__item--next">
            <span class="sp-post-nav__dir">Next →</span>
            <span class="sp-post-nav__title"><?php echo esc_html( get_the_title( $next_post ) ); ?></span>
        </a>
        <?php endif; ?>
    </nav>
    <?php endif; ?>
</main>

<!-- ── BOTTOM CTA ────────────────────────────────────────────────────────── -->
<section class="sp-cta" aria-label="Book a service">
    <div class="sp-cta__inner">
        <h2 class="sp-cta__h2">Need Your Vehicle <span>Sorted?</span></h2>
        <p class="sp-cta__sub"><?php echo esc_html($hours); ?> · <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#999;text-decoration:underline;">139 Cavendish Drive, Manukau</a></p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="sp-cta__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="sp-cta__btns">
            <a href="<?php echo esc_url( $site_url . '/contact-us/' ); ?>" class="sp-btn sp-btn--yellow">Send Enquiry</a>
            <a href="<?php echo esc_url( $site_url . '/blog/' ); ?>" class="sp-btn sp-btn--outline">More Articles</a>
        </div>
    </div>
</section>

<?php endwhile; endif; ?>

<script>
(function(){
  var content = document.querySelector('.sp-content');
  if (!content) return;

  // 1. Hide ALL visually empty paragraphs (including those with &nbsp;)
  content.querySelectorAll('p').forEach(function(p) {
    if (p.textContent.trim() === '') {
      p.style.display = 'none';
      p.style.margin = '0';
      p.style.padding = '0';
      p.style.lineHeight = '0';
    }
  });

  // 2. Convert consecutive short paragraphs into proper lists
  // Detect: a paragraph ending with ":" followed by 2+ short paragraphs (< 100 chars)
  var children = Array.from(content.children);
  var i = 0;
  while (i < children.length) {
    var el = children[i];
    
    // Skip hidden/empty elements
    if (el.style.display === 'none' || el.tagName !== 'P') { i++; continue; }
    
    var text = el.textContent.trim();
    
    // Look for a paragraph ending with ":" followed by short items
    if (text.endsWith(':')) {
      var listItems = [];
      var j = i + 1;
      
      while (j < children.length) {
        var next = children[j];
        if (next.style.display === 'none') { j++; continue; }
        if (next.tagName !== 'P') break;
        
        var nextText = next.textContent.trim();
        if (nextText === '') { j++; continue; }
        if (nextText.length > 120) break;
        
        // Check if this looks like a list item (short, no period at end unless it's a sentence)
        // Stop if it looks like a normal paragraph (long, starts with capital + has period)
        if (nextText.length > 80 && nextText.indexOf('.') > 20) break;
        
        listItems.push({ el: next, text: nextText, html: next.innerHTML });
        j++;
      }
      
      if (listItems.length >= 2) {
        // Create a proper list
        var ul = document.createElement('ul');
        listItems.forEach(function(item) {
          var li = document.createElement('li');
          li.innerHTML = item.html;
          ul.appendChild(li);
          item.el.style.display = 'none';
          item.el.style.margin = '0';
        });
        // Insert after the colon paragraph
        el.parentNode.insertBefore(ul, el.nextSibling);
        i = j;
        continue;
      }
    }
    i++;
  }
})();
</script>

<?php get_footer(); ?>
