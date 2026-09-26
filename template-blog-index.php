<?php
/**
 * Template Name: Blog Index
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /blog/
 * Built: May 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. WP Admin → Pages → Blog → Template → "Blog Index" → Update
 * 3. Run taas-fix-template.php pattern if template doesn't appear
 * 4. Set AIOSEO — focus keyword: mechanic manukau blog
 * 5. Purge Cloudflare cache
 *
 * How it works:
 * - Queries all published posts (standard WP post type)
 * - Paginates at 9 posts per page
 * - Featured post (most recent) gets full-width hero card treatment
 * - Remaining posts in 3-column grid
 * - Category filter pills (JS-powered, no page reload)
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$phone_local    = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$email          = defined('TAAS_EMAIL')        ? TAAS_EMAIL        : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')      ? TAAS_ADDRESS      : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')        ? TAAS_HOURS        : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')  ? TAAS_ESTABLISHED  : '1985';
$rating         = defined('TAAS_RATING')       ? TAAS_RATING       : '4.2';
$reviews        = defined('TAAS_REVIEWS')      ? TAAS_REVIEWS      : '200+';
$ms_number      = defined('TAAS_MS_NUMBER')    ? TAAS_MS_NUMBER    : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$site_url       = get_site_url();
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$years          = date('Y') - intval($established);
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$divisions      = defined('TAAS_DIVISIONS') ? TAAS_DIVISIONS : 'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries';
$wof_price      = defined('TAAS_WOF_PRICE') ? TAAS_WOF_PRICE : '$80';

// ── Query posts ───────────────────────────────────────────────────────────────
$paged       = get_query_var('paged') ? get_query_var('paged') : 1;
$posts_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

// ── Schema ────────────────────────────────────────────────────────────────────
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
                ['@type'=>'ListItem','position'=>2,'name'=>'Blog','item'=>$site_url.'/blog/'],
            ],
        ],
        [
            '@type'       => 'Blog',
            'name'        => 'Tony Allen Auto Service — Automotive Guides & News',
            'url'         => $site_url . '/blog/',
            'description' => 'Automotive guides, WOF information, servicing tips and industry news from South Auckland\'s largest independent workshop.',
            'publisher'   => ['@type'=>'Organization','name'=>'Tony Allen Auto Service','url'=>$site_url],
        ],
        [
            '@type'           => ['AutoRepair','LocalBusiness'],
            '@id'             => $site_url . '/#organization',
            'name'            => 'Tony Allen Auto Service',
            'url'             => $site_url,
            'telephone'       => [$phone_local, $phone_free],
            'foundingDate'    => '1985-10',
            'address'         => ['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
            'geo'             => ['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
            'openingHoursSpecification' => [['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
            'aggregateRating' => ['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'memberOf'        => ['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
            'speakable'       => ['@type'=>'SpeakableSpecification','cssSelector'=>['.bi-hero__h1','.bi-hero__sub']],
            'sameAs'          => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
        ],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
$blog_faq_schema = ['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>[
  ['@type'=>'Question','name'=>'What services does Tony Allen Auto Service offer?','acceptedAnswer'=>['@type'=>'Answer','text'=>'WOF inspections ('.$wof_price.' flat rate), vehicle servicing, brakes and clutch, auto electrical, European vehicles, tyres, fleet servicing and MBI repairs. '.$divisions.'. MTA Assured, NZTA Authorised '.$ms_number.'.']],
  ['@type'=>'Question','name'=>'Where is Tony Allen Auto Service located?','acceptedAnswer'=>['@type'=>'Answer','text'=>'139 Cavendish Drive, Manukau, Auckland 2104. Open '.$hours.'. Walk-ins welcome mornings for WOF inspections — booking recommended for afternoons.']],
  ['@type'=>'Question','name'=>'How do I book a service?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Call '.$phone_free.' or '.$phone_local.', email '.$email.', or use the booking form at taas.co.nz/contact-us. Walk-ins welcome mornings for WOF inspections.']],
]];
echo '<script type="application/ld+json">' . wp_json_encode($blog_faq_schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-blog-index">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════════ */
.page-template-template-blog-index .site-content,
.page-template-template-blog-index .entry-content,
.page-template-template-blog-index .entry-header,
.page-template-template-blog-index article,
.page-template-template-blog-index #primary,
.page-template-template-blog-index #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-blog-index *, .taas-blog-index *::before, .taas-blog-index *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-blog-index { font-family:var(--taas-font, 'Inter', Arial, sans-serif); color:var(--taas-body, #333); -webkit-font-smoothing:antialiased; .taas-blog-index{-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.taas-blog-index a { text-decoration:none; }
.bi-w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ══ HERO ═════════════════════════════════════════════════════════════════════ */
.bi-hero { background:var(--taas-black, #111111); padding:56px 0 48px; text-align:center; }
.bi-hero__eye {
  display:inline-block; margin-bottom:16px;
  background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A);
  font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; padding:4px 12px; border-radius:3px;
}
.bi-hero__h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight:800;
  color:#fff; letter-spacing:-0.02em; margin-bottom:12px;
}
.bi-hero__sub { font-size:16px; color:#999; max-width:560px; margin:0 auto; line-height:1.75; }

/* ══ FILTER PILLS ═════════════════════════════════════════════════════════════ */
.bi-filters { background:#F7F7F5; border-bottom:1px solid #E8E8E4; padding:16px 0; }
.bi-filters__inner { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
.bi-filters__label { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#999; margin-right:4px; }
.bi-filter-btn {
  background:#fff; border:1px solid #E8E8E4; color:#666;
  font-family:'Inter',Arial,sans-serif; font-size:12px; font-weight:600;
  padding:6px 16px; cursor:pointer; transition:all .15s; letter-spacing:.04em;
}
.bi-filter-btn:hover, .bi-filter-btn.is-active { background:#FFC800; border-color:#FFC800; color:#1A1A1A; }

/* ══ MAIN CONTENT ═════════════════════════════════════════════════════════════ */
.bi-main { padding:56px 0 72px; background:#fff; }

/* Featured post — full width */
.bi-featured {
  display:grid; grid-template-columns:1fr 1fr;
  gap:0; margin-bottom:48px;
  border:1px solid #E8E8E4; border-top:3px solid #FFC800;
  overflow:hidden;
}
.bi-featured__img {
  background:#1A1A1A; aspect-ratio:16/9; overflow:hidden;
  display:flex; align-items:center; justify-content:center;
}
.bi-featured__img img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .4s; }
.bi-featured:hover .bi-featured__img img { transform:scale(1.03); }
.bi-featured__img-ph { font-size:12px; color:#555; font-weight:600; letter-spacing:.1em; text-transform:uppercase; }
.bi-featured__body { padding:36px 36px; display:flex; flex-direction:column; justify-content:center; background:#fff; }
.bi-featured__badge {
  display:inline-block; background:#FFC800; color:#1A1A1A;
  font-size:10px; font-weight:800; letter-spacing:.12em; text-transform:uppercase;
  padding:3px 10px; margin-bottom:14px;
}
.bi-featured__title {
  font-family:'Inter',Arial,sans-serif;
  font-size:clamp(22px,2.5vw,32px); font-weight:900;
  color:#0D0D0D; text-transform:uppercase; line-height:1.1;
  margin-bottom:12px;
}
.bi-featured__excerpt { font-size:15px; color:#666; line-height:1.75; margin-bottom:20px; }
.bi-featured__meta { display:flex; gap:16px; align-items:center; margin-bottom:20px; flex-wrap:wrap; }
.bi-featured__date { font-size:12px; color:#999; font-weight:600; }
.bi-featured__cat { font-size:11px; font-weight:700; color:#FFC800; letter-spacing:.08em; text-transform:uppercase; }
.bi-featured__reading { font-size:12px; color:#bbb; }
.bi-featured__link {
  display:inline-flex; align-items:center; gap:8px;
  background:#1A1A1A; color:#fff!important;
  font-family:'Inter',Arial,sans-serif; font-weight:700; font-size:13px;
  letter-spacing:.06em; text-transform:uppercase; padding:12px 22px;
  align-self:flex-start; transition:background .15s;
}
.bi-featured__link:hover { background:#FFC800; color:#1A1A1A!important; }
.bi-featured__link::after { content:'→'; }

/* ══ GRID DIVIDER ══════════════════════════════════════════════════════════════ */
.bi-grid-head {
  display:flex; align-items:center; justify-content:space-between;
  border-bottom:2px solid #E8E8E4; padding-bottom:12px; margin-bottom:32px;
}
.bi-grid-head__title {
  font-family:'Inter',Arial,sans-serif;
  font-size:20px; font-weight:900; color:#0D0D0D; text-transform:uppercase;
}
.bi-grid-head__count { font-size:12px; color:#999; letter-spacing:.08em; text-transform:uppercase; }

/* ══ POST GRID ════════════════════════════════════════════════════════════════ */
.bi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.bi-card {
  background:#fff; border:1px solid #E8E8E4; border-top:3px solid transparent;
  display:flex; flex-direction:column;
  transition:border-color .18s, transform .18s, box-shadow .18s;
}
.bi-card:hover { border-top-color:#FFC800; transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,.07); }
.bi-card__img { background:#F7F7F5; aspect-ratio:16/9; overflow:hidden; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
.bi-card__img img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .35s; }
.bi-card:hover .bi-card__img img { transform:scale(1.04); }
.bi-card__img-ph { font-size:11px; color:#bbb; font-weight:600; letter-spacing:.08em; text-transform:uppercase; }
.bi-card__body { padding:20px 22px 24px; display:flex; flex-direction:column; flex:1; }
.bi-card__meta { display:flex; gap:12px; align-items:center; margin-bottom:10px; flex-wrap:wrap; }
.bi-card__cat { font-size:10px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:#FFC800; }
.bi-card__date { font-size:11px; color:#bbb; font-weight:600; }
.bi-card__reading { font-size:11px; color:#ccc; }
.bi-card__title {
  font-family:'Inter',Arial,sans-serif;
  font-size:19px; font-weight:900; color:#0D0D0D;
  text-transform:uppercase; line-height:1.15; margin-bottom:10px;
}
.bi-card__title a { color:#0D0D0D; transition:color .15s; }
.bi-card__title a:hover { color:#FFC800; }
.bi-card__excerpt { font-size:13px; color:#777; line-height:1.75; flex:1; margin-bottom:16px; }
.bi-card__link {
  display:inline-flex; align-items:center; gap:6px;
  font-size:12px; font-weight:700; color:#FFC800;
  letter-spacing:.08em; text-transform:uppercase;
  align-self:flex-start; margin-top:auto;
  transition:gap .15s;
}
.bi-card__link::after { content:'→'; transition:transform .15s; }
.bi-card:hover .bi-card__link::after { transform:translateX(3px); }

/* ══ PAGINATION ═══════════════════════════════════════════════════════════════ */
.bi-pagination { display:flex; gap:8px; justify-content:center; margin-top:56px; flex-wrap:wrap; }
.bi-pagination a, .bi-pagination span {
  display:flex; align-items:center; justify-content:center;
  width:40px; height:40px;
  font-family:'Inter',Arial,sans-serif; font-size:14px; font-weight:600; color:#333;
  border:1px solid #E8E8E4; transition:all .15s;
}
.bi-pagination a:hover { border-color:#FFC800; color:#FFC800; }
.bi-pagination .current { background:#FFC800; border-color:#FFC800; color:#1A1A1A; font-weight:700; }

/* ══ EMPTY STATE ══════════════════════════════════════════════════════════════ */
.bi-empty { text-align:center; padding:64px 24px; }
.bi-empty__icon { font-size:48px; margin-bottom:16px; }
.bi-empty__title { font-family:'Inter',Arial,sans-serif; font-size:28px; font-weight:900; text-transform:uppercase; color:#0D0D0D; margin-bottom:8px; }
.bi-empty__text { font-size:16px; color:#999; }

/* ══ SIDEBAR CTA ══════════════════════════════════════════════════════════════ */
.bi-cta-strip { background:var(--taas-dark, #1A1A1A); padding:var(--taas-sec-pad-m, 48px) 0; }
.bi-cta-strip__inner { display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap; }
.bi-cta-strip__h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:#fff; }
.bi-cta-strip__h2 span { color:#FFC800; }
.bi-cta-strip__sub { font-size:15px; color:#777; margin-top:4px; }
.bi-cta-strip__btns { display:flex; gap:12px; flex-wrap:wrap; flex-shrink:0; }
.bi-btn {
  display:inline-flex; align-items:center; gap:8px;
  font-family:'Inter',Arial,sans-serif; font-weight:700; font-size:13px;
  letter-spacing:.05em; text-transform:uppercase; padding:13px 22px;
  transition:all .15s;
}
.bi-btn--yellow { background:#FFC800; color:#1A1A1A!important; }
.bi-btn--yellow:hover { background:#e6b400; }
.bi-btn--outline { background:transparent; color:#FFC800!important; border:2px solid #FFC800; }
.bi-btn--outline:hover { background:#FFC800; color:#1A1A1A!important; }

/* ══ RESPONSIVE ═══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .bi-featured { grid-template-columns:1fr; }
  .bi-featured__img { aspect-ratio:16/7; }
  .bi-grid { grid-template-columns:repeat(2,1fr); }
}
@media (max-width:640px) {
  .bi-grid { grid-template-columns:1fr; }
  .bi-hero { padding:48px 0 36px; }
  .bi-hero__h1 { font-size:clamp(26px, 7vw, 38px); }
  .bi-hero__sub { font-size:14px; }
  .bi-main { padding:40px 0 48px; }
  .bi-featured__body { padding:24px 20px; }
  .bi-featured__title { font-size:clamp(20px, 5vw, 28px); }
  .bi-featured__excerpt { font-size:14px; margin-bottom:16px; }
  .bi-featured__link { font-size:12px; padding:10px 18px; }
  .bi-card__body { padding:16px 18px 20px; }
  .bi-card__title { font-size:16px; }
  .bi-card__excerpt { font-size:12px; }
  .bi-grid-head__title { font-size:17px; }
  .bi-pagination { margin-top:40px; }
  .bi-cta-strip { padding:40px 0; }
  .bi-cta-strip__inner { flex-direction:column; text-align:center; }
  .bi-cta-strip__btns { justify-content:center; flex-direction:column; align-items:stretch; }
  .bi-cta-strip__btns .bi-btn { justify-content:center; text-align:center; }
  .bi-cta-strip__h2 { font-size:clamp(22px, 6vw, 32px); }
  .bi-filters__inner { gap:6px; }
  .bi-filter-btn { font-size:11px; padding:5px 12px; }
  .bi-empty__title { font-size:22px; }
}
</style>


<!-- ══ HERO ═══════════════════════════════════════════════════════════════════ -->
<section class="bi-hero" aria-label="Blog"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="bi-w">
    <div class="bi-hero__eye">Automotive Guides & News</div>
    <h1 class="bi-hero__h1">The TAAS Blog</h1>
    <p class="bi-hero__sub">Practical guides, WOF updates, servicing tips, and automotive news from South Auckland's largest independent workshop. Written by the people who work on your car.</p>
  </div>
</section>


<!-- ══ TRUST STRIP ════════════════════════════════════════════════════════════ -->
<div style="background:#FFC800;padding:13px 0;"><div class="bi-w"><div style="display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;"><span style="font-size:14px;font-weight:600;color:#1A1A1A;">Need a service? Call now</span><a href="tel:<?php echo esc_attr($phone_free_tel);?>" style="display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:#1A1A1A;text-decoration:none;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free);?></a></div></div></div>
<div style="background:#F7F7F5;border-bottom:1px solid #E8E8E4;padding:18px 0;">
  <div class="bi-w">
    <div style="display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;">
      <span style="font-size:14px;font-weight:600;color:#333;">✓ MTA Assured</span>
      <span style="font-size:14px;font-weight:600;color:#333;">✓ NZTA Authorised</span>
      <span style="font-size:14px;font-weight:600;color:#333;">✓ Family-owned since <?php echo esc_html($established); ?></span>
      <span style="font-size:14px;font-weight:600;color:#333;">✓ <?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> reviews</span>
    </div>
  </div>
</div>


<!-- ══ FILTER PILLS ════════════════════════════════════════════════════════════ -->
<?php
$categories = get_categories(['hide_empty' => true]);
if ($categories && count($categories) > 1):
?>
<div class="bi-filters" role="navigation" aria-label="Filter by category">
  <div class="bi-w">
    <div class="bi-filters__inner">
      <span class="bi-filters__label">Filter:</span>
      <button class="bi-filter-btn is-active" data-filter="all">All Posts</button>
      <?php foreach ($categories as $cat): ?>
      <button class="bi-filter-btn" data-filter="<?php echo esc_attr($cat->slug); ?>">
        <?php echo esc_html($cat->name); ?>
        <span style="opacity:.6;margin-left:4px;">(<?php echo $cat->count; ?>)</span>
      </button>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>


<!-- ══ MAIN ════════════════════════════════════════════════════════════════════ -->
<main class="bi-main" id="bi-posts">
  <div class="bi-w">

    <?php if ($posts_query->have_posts()): ?>

      <?php
      // ── Featured post (first/most recent) ───────────────────────────────────
      $posts_query->the_post();
      $feat_cats    = get_the_category();
      $feat_cat_name = $feat_cats ? $feat_cats[0]->name : 'General';
      $feat_cat_slug = $feat_cats ? $feat_cats[0]->slug : 'general';
      $feat_thumb   = get_the_post_thumbnail_url(null, 'large');
      $feat_excerpt = get_the_excerpt();
      $feat_id      = get_the_ID();
      // Reading time estimate
      $content_str  = get_post_field('post_content', $feat_id);
      $word_count   = str_word_count(strip_tags($content_str));
      $read_time    = max(1, round($word_count / 200));
      ?>

      <a href="<?php the_permalink(); ?>" class="bi-featured" data-cat="<?php echo esc_attr($feat_cat_slug); ?>" aria-label="<?php the_title_attribute(); ?>">
        <div class="bi-featured__img">
          <?php if ($feat_thumb): ?>
            <img src="<?php echo esc_url($feat_thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="eager">
          <?php else: ?>
            <span class="bi-featured__img-ph">Tony Allen Auto Service</span>
          <?php endif; ?>
        </div>
        <div class="bi-featured__body">
          <span class="bi-featured__badge">Latest Article</span>
          <div class="bi-featured__meta">
            <span class="bi-featured__cat"><?php echo esc_html($feat_cat_name); ?></span>
            <span class="bi-featured__date"><?php echo get_the_date('j F Y'); ?></span>
            <span class="bi-featured__reading"><?php echo $read_time; ?> min read</span>
          </div>
          <h2 class="bi-featured__title"><?php the_title(); ?></h2>
          <p class="bi-featured__excerpt"><?php echo wp_trim_words($feat_excerpt ?: get_the_excerpt(), 30, '…'); ?></p>
          <span class="bi-featured__link">Read Article</span>
        </div>
      </a>

      <?php
      // ── Remaining posts grid ─────────────────────────────────────────────────
      if ($posts_query->have_posts()):
      ?>
      <div class="bi-grid-head">
        <h2 class="bi-grid-head__title">More Articles</h2>
        <span class="bi-grid-head__count"><?php echo ($posts_query->found_posts - 1); ?> articles</span>
      </div>
      <div class="bi-grid" id="bi-grid">
        <?php while ($posts_query->have_posts()): $posts_query->the_post();
          $cats      = get_the_category();
          $cat_name  = $cats ? $cats[0]->name : 'General';
          $cat_slug  = $cats ? $cats[0]->slug : 'general';
          $thumb     = get_the_post_thumbnail_url(null, 'medium_large');
          $excerpt   = get_the_excerpt();
          $id        = get_the_ID();
          $wc        = str_word_count(strip_tags(get_post_field('post_content', $id)));
          $rt        = max(1, round($wc / 200));
        ?>
        <article class="bi-card" data-cat="<?php echo esc_attr($cat_slug); ?>">
          <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <div class="bi-card__img">
              <?php if ($thumb): ?>
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              <?php else: ?>
                <span class="bi-card__img-ph">TAAS</span>
              <?php endif; ?>
            </div>
          </a>
          <div class="bi-card__body">
            <div class="bi-card__meta">
              <span class="bi-card__cat"><?php echo esc_html($cat_name); ?></span>
              <span class="bi-card__date"><?php echo get_the_date('j M Y'); ?></span>
              <span class="bi-card__reading"><?php echo $rt; ?> min</span>
            </div>
            <h3 class="bi-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="bi-card__excerpt"><?php echo wp_trim_words($excerpt ?: get_the_excerpt(), 20, '…'); ?></p>
            <a href="<?php the_permalink(); ?>" class="bi-card__link">Read More</a>
          </div>
        </article>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>

      <?php
      // ── Pagination ───────────────────────────────────────────────────────────
      $big = 999999999;
      $pagination = paginate_links([
          'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format'    => '?paged=%#%',
          'current'   => $paged,
          'total'     => $posts_query->max_num_pages,
          'prev_text' => '←',
          'next_text' => '→',
          'type'      => 'array',
      ]);
      if ($pagination && $posts_query->max_num_pages > 1):
      ?>
      <nav class="bi-pagination" aria-label="Blog pages">
        <?php echo implode('', $pagination); ?>
      </nav>
      <?php endif; ?>

    <?php else: ?>
      <div class="bi-empty">
        <div class="bi-empty__icon">📝</div>
        <div class="bi-empty__title">Articles Coming Soon</div>
        <p class="bi-empty__text">We're working on it. Check back shortly — or call us on <?php echo esc_html($phone_free); ?> with any questions.</p>
      </div>
    <?php endif;
    wp_reset_postdata();
    ?>

  </div>
</main>


<!-- ══ CTA STRIP ══════════════════════════════════════════════════════════════ -->
<div class="bi-cta-strip" role="region" aria-label="Book a service">
  <div class="bi-w">
    <div class="bi-cta-strip__inner">
      <div>
        <h2 class="bi-cta-strip__h2">Ready to <span>Book?</span></h2>
        <p class="bi-cta-strip__sub"><?php echo esc_html($hours); ?> · <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#999;text-decoration:underline;">139 Cavendish Drive, Manukau</a></p>
      </div>
      <div class="bi-cta-strip__btns">
        <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="bi-btn bi-btn--yellow">Book a Service</a>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="bi-btn bi-btn--outline">Call <?php echo esc_html($phone_free); ?></a>
      </div>
    </div>
  </div>
</div>

</div><!-- /.taas-blog-index -->

<script>
(function(){
  // Category filter — client-side show/hide
  var btns = document.querySelectorAll('.bi-filter-btn');
  if (!btns.length) return;

  btns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var filter = this.dataset.filter;
      // Update active button
      btns.forEach(function(b){ b.classList.remove('is-active'); });
      this.classList.add('is-active');
      // Filter cards
      var cards = document.querySelectorAll('.bi-card, .bi-featured');
      cards.forEach(function(card) {
        if (filter === 'all' || card.dataset.cat === filter) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
      // Update grid head count
      var visible = document.querySelectorAll('.bi-card:not([style*="none"])').length;
      var countEl = document.querySelector('.bi-grid-head__count');
      if (countEl) countEl.textContent = visible + ' article' + (visible !== 1 ? 's' : '');
    });
  });
})();
</script>

<?php get_footer(); ?>
