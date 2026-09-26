<?php
/**
 * Template Name: S&S Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Shock absorber replacement suburb spoke pages (15 suburbs, excl. Manukau).
 * Content lighter than sub-service — location-focused with link back to main page.
 * CSS namespace: .ssl
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url       = get_site_url();
$page_url       = get_permalink();
$post_id        = get_the_ID();
$phone_local    = defined('TAAS_PHONE_LOCAL')     ? TAAS_PHONE_LOCAL     : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')      ? TAAS_PHONE_FREE      : '0800 100 876';
$email          = defined('TAAS_EMAIL')           ? TAAS_EMAIL           : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')         ? TAAS_ADDRESS         : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')           ? TAAS_HOURS           : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$rating         = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$reviews        = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$ms_number      = defined('TAAS_MS_NUMBER')       ? TAAS_MS_NUMBER       : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')       ? TAAS_CUSTOMERS       : '10,000+';
$susp_price     = defined('TAAS_SUSPENSION_PRICE')? TAAS_SUSPENSION_PRICE: 'from $300';
$align_price    = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Suburb data from post_meta ───────────────────────────────────────────────
$has_acf       = function_exists('get_field');
$suburb_name   = ($has_acf ? get_field('suburb_name') : null) ?: get_post_meta($post_id, 'suburb_name', true) ?: 'South Auckland';
$suburb_slug   = ($has_acf ? get_field('suburb_slug') : null) ?: get_post_meta($post_id, 'suburb_slug', true) ?: '';
$distance_note = ($has_acf ? get_field('distance_note') : null) ?: get_post_meta($post_id, 'distance_note', true) ?: '';
$area_served   = ($has_acf ? get_field('area_served') : null) ?: get_post_meta($post_id, 'area_served', true) ?: '';

// ── Custom FAQs from post_meta ───────────────────────────────────────────────
$custom_faqs = [];
for ($i = 1; $i <= 5; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => $q, 'a' => $a];
}

// ── All suburbs for pills ────────────────────────────────────────────────────
$suburbs = [
    ['name' => 'Manukau',        'slug' => 'manukau'],
    ['name' => 'Papatoetoe',     'slug' => 'papatoetoe'],
    ['name' => 'Māngere',        'slug' => 'mangere'],
    ['name' => 'Māngere Bridge', 'slug' => 'mangere-bridge'],
    ['name' => 'Ōtāhuhu',       'slug' => 'otahuhu'],
    ['name' => 'Wiri',           'slug' => 'wiri'],
    ['name' => 'Ōtara',         'slug' => 'otara'],
    ['name' => 'Hunters Corner', 'slug' => 'hunters-corner'],
    ['name' => 'Clover Park',    'slug' => 'clover-park'],
    ['name' => 'Flat Bush',      'slug' => 'flat-bush'],
    ['name' => 'Manurewa',       'slug' => 'manurewa'],
    ['name' => 'Clendon',        'slug' => 'clendon'],
    ['name' => 'Weymouth',       'slug' => 'weymouth'],
    ['name' => 'Takanini',       'slug' => 'takanini'],
    ['name' => 'Papakura',       'slug' => 'papakura'],
    ['name' => 'Howick',         'slug' => 'howick'],
];

// ── Build FAQs (10) ──────────────────────────────────────────────────────────
$faqs = [
    ['q' => "How much does shock absorber replacement cost near {$suburb_name}?",
     'a' => "Suspension repairs start {$susp_price} depending on your vehicle. Wheel alignment is {$align_price} and included after replacement. We always provide an estimate before starting any work. Call us on {$phone_free} with your vehicle details."],
    ['q' => "How far is Tony Allen Auto Service from {$suburb_name}?",
     'a' => $distance_note ?: "Our workshop is at 139 Cavendish Drive, Manukau — a short drive from {$suburb_name}. Call us on {$phone_free} for directions."],
    ['q' => "My car failed its WOF for shock absorbers near {$suburb_name} — what should I do?",
     'a' => "Call us on {$phone_free}. We carry out the repair and recheck the failed items on the same visit where possible — you do not need to rebook for the WOF check. We always provide an estimate before starting any work."],
    ['q' => 'Do you replace shock absorbers in pairs?',
     'a' => 'Yes — we always recommend replacing shock absorbers in axle pairs (both fronts or both rears). Replacing a single shock creates an imbalance in damping that affects handling and braking. If only one shock has failed, both on that axle should still be replaced.'],
    ['q' => 'Is a wheel alignment included after shock absorber replacement?',
     'a' => "Yes. We carry out a wheel alignment after every shock absorber replacement. Alignment is {$align_price}. Skipping alignment after suspension work causes pulling and uneven tyre wear."],
    ['q' => 'How do I know if my shock absorbers need replacing?',
     'a' => 'The clearest signs are excessive bouncing on uneven roads, the vehicle squatting heavily under braking, body roll through corners, uneven tyre wear, or the vehicle sitting noticeably lower on one corner. Worn shocks also cause WOF failure.'],
    ['q' => "Do you offer finance for shock absorber replacement near {$suburb_name}?",
     'a' => "Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. Interest-free options available. Visit our finance page or ask when you call on {$phone_free}."],
    ['q' => 'Can I drive with worn shock absorbers?',
     'a' => 'A worn shock absorber significantly increases braking distance and reduces stability — particularly in wet conditions or emergency manoeuvres. Worn shocks are a WOF fail item. If the vehicle is bouncing excessively or failed its WOF, get it checked promptly.'],
];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q' => 'What else might need replacing at the same time?',
           'a' => 'Shock absorber replacement is often combined with suspension bush replacement, wheel alignment, and a WOF check. Our technicians will flag anything that needs attention during the inspection — no surprises.'];
$faqs[] = ['q' => "Where is your workshop?",
           'a' => "139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}. Call {$phone_free} to book. We service all South Auckland suburbs including {$suburb_name}."];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq['a'])]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Steering & Suspension', 'item' => $site_url . '/steering-and-suspension/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Shock Absorbers', 'item' => $site_url . '/shock-absorber-replacement-manukau/'],
            ['@type' => 'ListItem', 'position' => 4, 'name' => "Shock Absorber Replacement {$suburb_name}", 'item' => $page_url],
        ]],
        ['@type' => ['AutoRepair', 'LocalBusiness'],
         '@id' => $site_url . '/#organization',
         'name' => 'Tony Allen Auto Service',
         'url' => $site_url,
         'description' => "Shock absorber replacement near {$suburb_name}, South Auckland. Replaced in axle pairs. Wheel alignment included. MTA Assured. NZTA Authorised. Established {$established}.",
         'telephone' => [$phone_free, $phone_local],
         'email' => $email,
         'foundingDate' => '1985-10',
         'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
         'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
         'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
         'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'],
         'priceRange' => '$$',
         'areaServed' => $suburb_name . ', South Auckland',
         'sameAs' => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
         'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
         'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
        ],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.ssl-hero__sub', '.ssl-faq__a:first-of-type']],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-ss-location .site-content,
.page-template-template-ss-location .entry-content,
.page-template-template-ss-location .entry-header,
.page-template-template-ss-location article,
.page-template-template-ss-location #primary,
.page-template-template-ss-location #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-ss-location { overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button { font-family: var(--taas-font, 'Inter', Arial, sans-serif) !important; }

.ssl-w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.ssl-hero { background: var(--taas-black, #111); padding: 72px 0 60px; }
.ssl-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.ssl-hero h1 { font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #fff); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.ssl-hero h1 span { color: var(--taas-yellow, #FFC800); }
.ssl-hero__sub { font-size: 16px; color: #aaa; max-width: 580px; margin: 0 0 24px; line-height: 1.65; }
.ssl-hero__ctas { display: flex; flex-wrap: wrap; gap: 12px; }
.ssl-trust { background: var(--taas-yellow, #FFC800); padding: var(--taas-trust-pad, 18px) 0; }
.ssl-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.ssl-trust__item { font-size: var(--taas-trust-size, 14px); font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.ssl-trust__item::before { content: '✓'; font-weight: 900; }
.ssl-section { padding: var(--taas-sec-pad, 72px) 0; }
.ssl-section--white { background: var(--taas-white, #fff); }
.ssl-section--grey  { background: var(--taas-panel, #F7F7F5); }
.ssl-section--dark  { background: var(--taas-dark, #1A1A1A); }
.ssl-eyebrow { display: inline-block; font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.ssl-eyebrow--dark { background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); }
.ssl-eyebrow--yellow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ssl-h2 { font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111); letter-spacing: -0.01em; margin: 0 0 12px; line-height: 1.15; }
.ssl-h2--white { color: var(--taas-white, #fff); }
.ssl-lead { font-size: 16px; color: var(--taas-mid, #666); max-width: 640px; margin: 0 0 32px; line-height: 1.65; }
.ssl-section--dark .ssl-lead { color: #aaa; }
.ssl-content { max-width: 780px; font-size: 16px; color: var(--taas-mid, #666); line-height: 1.7; }
.ssl-check-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.ssl-check-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 15px; color: var(--taas-body, #333); line-height: 1.5; }
.ssl-check-list li::before { content: '✓'; color: var(--taas-dark, #1A1A1A); background: var(--taas-yellow, #FFC800); font-size: 11px; font-weight: 700; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
.ssl-signs { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; }
.ssl-signs li { display: flex; align-items: flex-start; gap: 14px; padding: 12px 0; border-bottom: 1px solid var(--taas-border, #E8E8E4); font-size: 15px; color: var(--taas-body, #333); line-height: 1.5; }
.ssl-signs li:last-child { border-bottom: none; }
.ssl-signs li::before { content: '!'; color: #fff; background: var(--taas-alert, #C0392B); font-size: 10px; font-weight: 900; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
.ssl-steps { display: flex; flex-direction: column; gap: 0; max-width: 780px; }
.ssl-step { display: flex; align-items: flex-start; gap: 16px; padding: 16px 0; border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.ssl-step:last-child { border-bottom: none; }
.ssl-step__num { width: 32px; height: 32px; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-size: 14px; font-weight: 800; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.ssl-step__text { font-size: 15px; color: var(--taas-body, #333); line-height: 1.5; }
.ssl-suburb-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; }
.ssl-suburb-pill { display: inline-block; padding: 7px 18px; background: var(--taas-white, #fff); border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; font-size: 14px; font-weight: 500; color: var(--taas-body, #333); text-decoration: none; transition: all .15s; }
.ssl-suburb-pill:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ssl-suburb-pill--active { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 700; }
.ssl-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; max-width: 780px; }
.ssl-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.ssl-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-faq-q, 15px); font-weight: 700; color: var(--taas-black, #111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.ssl-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666); }
.ssl-faq__item--open .ssl-faq__q::after { content: '−'; }
.ssl-faq__a { display: none; padding: 0 0 18px; font-size: var(--taas-faq-a, 15px); color: var(--taas-mid, #666); line-height: 1.7; }
.ssl-faq__item--open .ssl-faq__a { display: block; }
.ssl-btn { display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px; font-size: var(--taas-btn-size, 14px); font-weight: 700; border-radius: var(--taas-radius, 6px); text-decoration: none; transition: all .18s ease; border: 2px solid transparent; white-space: nowrap; }
.ssl-btn--primary { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); border-color: var(--taas-yellow, #FFC800); }
.ssl-btn--primary:hover { background: var(--taas-yellow2, #e6b400); border-color: var(--taas-yellow2, #e6b400); }
.ssl-btn--outline { background: transparent; color: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); }
.ssl-btn--outline:hover { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ssl-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.ssl-enquiry__phone { display: block; font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.ssl-enquiry__phone:hover { color: #fff; }
.ssl-enquiry__detail { font-size: 15px; color: #aaa; line-height: 1.7; }
.ssl-enquiry__detail strong { color: var(--taas-white, #fff); }

@media (max-width: 960px) { .ssl-enquiry { grid-template-columns: 1fr; gap: 32px; } }
@media (max-width: 640px) {
  .ssl-hero { padding: var(--taas-sec-pad-m, 48px) 0 40px; }
  .ssl-hero h1 { font-size: clamp(26px, 7vw, 38px); }
  .ssl-hero__sub { font-size: 14px; }
  .ssl-hero__ctas { flex-direction: column; align-items: stretch; }
  .ssl-hero__ctas .ssl-btn { justify-content: center; text-align: center; }
  .ssl-section { padding: var(--taas-sec-pad-m, 48px) 0; }
  .ssl-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .ssl-trust__item { font-size: 12px; }
  .ssl-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .ssl-faq__a { font-size: 13px; }
  .ssl-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
}

/* ── CF7 form overrides on light panel ────────────────────────────────────── */
.ssl-enquiry__form { background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 32px; }
.ssl-enquiry__form .wpcf7-form label,
.ssl-enquiry__form .wpcf7-form p { color: var(--taas-body, #333) !important; font-size: 13px; font-weight: 600; }
.ssl-enquiry__form .wpcf7-form input[type="text"],
.ssl-enquiry__form .wpcf7-form input[type="email"],
.ssl-enquiry__form .wpcf7-form input[type="tel"],
.ssl-enquiry__form .wpcf7-form textarea,
.ssl-enquiry__form .wpcf7-form select { background: var(--taas-white, #fff); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 12px 14px; font-size: 15px; color: var(--taas-black, #111); width: 100%; box-sizing: border-box; }
.ssl-enquiry__form .wpcf7-form input:focus,
.ssl-enquiry__form .wpcf7-form textarea:focus { border-color: var(--taas-yellow, #FFC800); outline: none; }
.ssl-enquiry__form .wpcf7-form input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); border: none; border-radius: var(--taas-radius, 6px); padding: 14px 28px; font-size: var(--taas-btn-size, 14px); font-weight: 700; cursor: pointer; width: 100%; text-transform: uppercase; letter-spacing: 0.06em; transition: background .15s; }
.ssl-enquiry__form .wpcf7-form input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }
.ssl-enquiry__form-title { font-size: 16px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 20px; letter-spacing: -0.01em; }

/* ── Breadcrumb ─────────────────────────────────────────────────────────── */
.ssl-bc { background:#1A1A1A; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.ssl-bc__inner { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:400; color:#666; flex-wrap:wrap; }
.ssl-bc__inner a { color:#888; transition:color .15s; text-decoration:none; }
.ssl-bc__inner a:hover { color:var(--taas-yellow, #FFC800); }
.ssl-bc__sep { color:#444; }

/* ── Phone strip ───────────────────────────────────────────────────────── */
.ssl-pstrip { background:var(--taas-yellow, #FFC800); padding:14px 0; }
.ssl-pstrip__inner { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.ssl-pstrip__number { font-size:28px; font-weight:900; color:var(--taas-dark, #1A1A1A); }
.ssl-pstrip__number a { color:inherit; text-decoration:none; }
.ssl-pstrip__number a:hover { opacity:.65; }
.ssl-pstrip__right { display:flex; align-items:center; gap:20px; }
.ssl-pstrip__hours { font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); }
.ssl-pstrip__email { display:inline-block; background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); font-size:12px; font-weight:700; padding:6px 14px; border-radius:3px; text-decoration:none; }
.ssl-pstrip__email:hover { opacity:.85; }

@media (max-width:640px) {
  .ssl-pstrip__inner { flex-direction:column; text-align:center; }
  .ssl-pstrip__right { flex-direction:column; gap:8px; }
}
</style>


<!-- ── BREADCRUMB ───────────────────────────────────────────────────────────── -->
<nav class="ssl-bc" aria-label="Breadcrumb">
  <div class="ssl-w">
    <div class="ssl-bc__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="ssl-bc__sep">›</span>
      <a href="<?php echo esc_url($site_url . '/steering-and-suspension/'); ?>">Steering &amp; Suspension</a>
      <span class="ssl-bc__sep">›</span>
      <span><?php echo esc_html($suburb_name); ?></span>
    </div>
  </div>
</nav>

<!-- ── HERO ────────────────────────────────────────────────────────────────── -->
<section class="ssl-hero">
  <div class="ssl-w">
    <span class="ssl-hero__eyebrow">Shock Absorber Replacement — <?php echo esc_html($suburb_name); ?></span>
    <h1>Shock Absorber Replacement<br><span>Near <?php echo esc_html($suburb_name); ?></span></h1>
    <p class="ssl-hero__sub">Worn shocks replaced in axle pairs. Wheel alignment included. WOF recheck same day where possible. <?php if ($distance_note) echo esc_html($distance_note); ?> Suspension repairs <?php echo esc_html($susp_price); ?>.</p>
    <div class="ssl-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssl-btn ssl-btn--primary">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
        Call <?php echo esc_html($phone_free); ?>
      </a>
      <a href="#ssl-enquire" class="ssl-btn ssl-btn--outline">Book Online</a>
    </div>
  </div>
</section>

<!-- ── PHONE STRIP ──────────────────────────────────────────────────────────── -->
<div class="ssl-pstrip" role="region" aria-label="Contact">
  <div class="ssl-w">
    <div class="ssl-pstrip__inner">
      <div class="ssl-pstrip__number"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></div>
      <div class="ssl-pstrip__right">
        <span class="ssl-pstrip__hours"><?php echo esc_html($hours); ?></span>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="ssl-pstrip__email"><?php echo esc_html($email); ?></a>
      </div>
    </div>
  </div>
</div>

<!-- ── TRUST STRIP ─────────────────────────────────────────────────────────── -->
<div class="ssl-trust" role="list" style="background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);">
  <div class="ssl-trust__inner">
    <div class="ssl-trust__item" role="listitem">MTA Assured</div>
    <div class="ssl-trust__item" role="listitem">NZTA Authorised</div>
    <div class="ssl-trust__item" role="listitem">Replaced in Axle Pairs</div>
    <div class="ssl-trust__item" role="listitem">Alignment Included</div>
    <div class="ssl-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  </div>
</div>


<!-- ── WHAT TO EXPECT ── White ─────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--white">
  <div class="ssl-w">
    <span class="ssl-eyebrow ssl-eyebrow--dark">What to Expect</span>
    <h2 class="ssl-h2">Shock Absorber Replacement for <?php echo esc_html($suburb_name); ?> Drivers</h2>
    <div class="ssl-content" style="margin-bottom:32px;">
      <p>Our workshop is at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a><?php if ($distance_note) echo ' — ' . esc_html($distance_note); ?>. We replace shock absorbers for customers from <?php echo esc_html($suburb_name); ?> and across South Auckland.</p>
      <p>Shocks are always replaced in axle pairs — both fronts or both rears — because mismatched damping affects handling and braking. Wheel alignment is carried out after every replacement. If your vehicle failed its WOF for shock absorbers, we carry out the repair and recheck on the same visit where possible.</p>
    </div>
    <ul class="ssl-check-list">
      <li>Estimate before any work begins — no surprises</li>
      <li>Shock absorbers replaced in axle pairs</li>
      <li>Wheel alignment <?php echo esc_html($align_price); ?> — included after replacement</li>
      <li>WOF recheck same day where possible</li>
      <li>All makes and models — Japanese, Korean, European, SUVs, utes, 4WDs</li>
      <li>Finance available — Afterpay, Q Card, GEM, Aotea</li>
    </ul>
    <p style="margin-top:24px;font-size:14px;color:var(--taas-mid);line-height:1.6;">For detailed technical information about shock absorber replacement, see our <a href="<?php echo esc_url($site_url . '/shock-absorber-replacement-manukau/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">main shock absorber page</a>.</p>
  </div>
</section>


<!-- ── WARNING SIGNS ── Grey ───────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--grey">
  <div class="ssl-w">
    <span class="ssl-eyebrow ssl-eyebrow--dark">Warning Signs</span>
    <h2 class="ssl-h2">Signs Your Shock Absorbers Need Replacing</h2>
    <ul class="ssl-signs">
      <li>Vehicle bouncing and not settling after bumps</li>
      <li>Excessive body roll through corners</li>
      <li>Nose diving under braking</li>
      <li>Uneven or cupped tyre wear</li>
      <li>WOF failure for shock absorbers</li>
      <li>Vehicle sitting low on one corner</li>
    </ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssl-btn ssl-btn--primary" style="margin-top:24px;">Call <?php echo esc_html($phone_free); ?> — Describe Your Symptoms</a>
  </div>
</section>


<!-- ── PROCESS ── White ────────────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--white">
  <div class="ssl-w">
    <span class="ssl-eyebrow ssl-eyebrow--dark">Our Process</span>
    <h2 class="ssl-h2">How We Replace Shock Absorbers</h2>
    <div class="ssl-steps">
      <?php foreach ([
        'Inspection of all four shock absorbers — visual and bounce test',
        'Estimate provided before work begins',
        'Shocks replaced in axle pairs — front or rear as required',
        'Wheel alignment carried out after replacement',
        'WOF recheck on the same visit where applicable',
        'Road test to confirm ride and handling',
      ] as $i => $step): ?>
      <div class="ssl-step">
        <div class="ssl-step__num"><?php echo $i + 1; ?></div>
        <div class="ssl-step__text"><?php echo esc_html($step); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ── PRICING ── Dark ─────────────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--dark">
  <div class="ssl-w">
    <span class="ssl-eyebrow ssl-eyebrow--yellow">Pricing</span>
    <h2 class="ssl-h2 ssl-h2--white">Shock Absorber Replacement — Price Guide</h2>
    <p class="ssl-lead">Suspension repairs <?php echo esc_html($susp_price); ?>. Wheel alignment <?php echo esc_html($align_price); ?> — included after replacement. Price varies by vehicle. Call for a specific estimate.</p>
    <div style="background:#161616;border:1px solid #2a2a2a;border-radius:var(--taas-radius);padding:24px;max-width:480px;margin-bottom:24px;">
      <p style="font-size:14px;color:#ccc;line-height:1.6;margin-bottom:12px;"><strong style="color:var(--taas-yellow);">Finance available:</strong> Afterpay, Q Card, GEM Finance, and Aotea Finance. Interest-free options.</p>
      <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-yellow2);text-decoration:none;">View finance options →</a>
    </div>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssl-btn ssl-btn--primary">Get an Estimate — Call <?php echo esc_html($phone_free); ?></a>
  </div>
</section>


<!-- ── ENQUIRY ── White ────────────────────────────────────────────────────── -->
<section id="ssl-enquire" class="ssl-section ssl-section--white">
  <div class="ssl-w">
    <div class="ssl-enquiry">
      <div>
        <span class="ssl-eyebrow ssl-eyebrow--dark">Book Today</span>
        <h2 class="ssl-h2">Shock Absorber Replacement Near <span style="color:var(--taas-yellow2, #e6b400);"><?php echo esc_html($suburb_name); ?></span></h2>
        <p style="font-size:16px;color:var(--taas-mid);line-height:1.6;margin-bottom:16px;">Call us or fill in the form and we'll get back to you. Estimate provided before any work begins.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin-bottom:6px;"><?php echo esc_html($phone_free); ?></a>
        <p style="font-size:15px;color:var(--taas-mid);line-height:1.7;">
          <strong style="color:var(--taas-black);"><?php echo esc_html($phone_local); ?></strong><br>
          <?php echo esc_html($hours); ?><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>
        </p>
      </div>
      <div class="ssl-enquiry__form">
        <div class="ssl-enquiry__form-title">Send Us Your Details</div>
        <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
        <p style="font-size:14px;color:var(--taas-mid);">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-black);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="font-weight:700;color:var(--taas-black);">use our contact form</a>.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ── SUBURBS ── Grey ─────────────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--grey">
  <div class="ssl-w">
    <h2 class="ssl-h2">Shock Absorber Replacement — South Auckland Areas</h2>
    <p style="font-size:14px;color:var(--taas-mid);margin-bottom:16px;">Serving all South Auckland suburbs from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
    <div class="ssl-suburb-pills">
      <?php foreach ($suburbs as $s):
        $is_current = ($s['slug'] === $suburb_slug); ?>
      <a href="<?php echo esc_url($site_url . '/shock-absorber-replacement-' . $s['slug'] . '/'); ?>" class="ssl-suburb-pill<?php echo $is_current ? ' ssl-suburb-pill--active' : ''; ?>"><?php echo esc_html($s['name']); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="ssl-section ssl-section--white">
  <div class="ssl-w">
    <span class="ssl-eyebrow ssl-eyebrow--dark">Common Questions</span>
    <h2 class="ssl-h2">Shock Absorber Replacement Near <?php echo esc_html($suburb_name); ?> — FAQ</h2>
    <div class="ssl-faq__list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="ssl-faq__item<?php echo $i === 0 ? ' ssl-faq__item--open' : ''; ?>">
        <button class="ssl-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="ssl-a-<?php echo $i; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div id="ssl-a-<?php echo $i; ?>" class="ssl-faq__a"><?php echo wp_kses_post($faq['a']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<div style="background:var(--taas-panel);padding:24px 0;text-align:center;">
  <a href="<?php echo esc_url($site_url . '/steering-and-suspension/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Steering &amp; Suspension</a>
</div>

<script>
(function(){
  document.querySelectorAll('.ssl-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = this.closest('.ssl-faq__item');
      var wasOpen = item.classList.contains('ssl-faq__item--open');
      document.querySelectorAll('.ssl-faq__item--open').forEach(function(el){
        el.classList.remove('ssl-faq__item--open');
        el.querySelector('.ssl-faq__q').setAttribute('aria-expanded','false');
      });
      if (!wasOpen) {
        item.classList.add('ssl-faq__item--open');
        this.setAttribute('aria-expanded','true');
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
