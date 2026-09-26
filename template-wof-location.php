<?php
/**
 * Template Name: WOF Location Page
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * WOF suburb spoke pages — one template, 17+ pages via ACF
 * Built: May 2026 · Go-Live Standard: June 2026
 *
 * ACF fields required:
 *   suburb_name    (text)   — e.g. "Papatoetoe"
 *   suburb_slug    (text)   — e.g. "papatoetoe"
 *   distance_note  (text)   — e.g. "~5 min via Great South Rd"
 *   area_served    (textarea, one suburb per line) — nearby suburbs list
 *
 * DEPLOY:
 *   1. Drop into wp-content/themes/taas-child/
 *   2. WP Admin → Pages → Add New → Title: "WOF [Suburb]" → Slug: wof-inspection-[suburb]
 *   3. Template → "WOF Location Page" → Publish
 *   4. ACF → populate all fields
 *   5. AIOSEO → Title / Description / Focus keyword: wof [suburb]
 *   6. Purge Cloudflare cache
 */

// ── Shared libraries ─────────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

// ── ACF fields ────────────────────────────────────────────────────────────────
$has_acf      = function_exists('get_field');
$suburb_name  = ($has_acf ? get_field('suburb_name')   : null) ?: get_the_title();
$suburb_name  = preg_replace('/^WOF\s+/i', '', $suburb_name);
$suburb_slug  = ($has_acf ? get_field('suburb_slug')   : null) ?: sanitize_title($suburb_name);

// ── Suburb data — shared library ─────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-suburbs.php';
$sub           = taas_suburb_data($suburb_slug, $suburb_name);
$area_served   = taas_suburb_area($suburb_slug, $suburb_name);
$acf_distance  = ($has_acf ? get_field('distance_note') : null) ?: '';
$distance_text = taas_suburb_distance($suburb_slug, $suburb_name, $acf_distance);

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email          = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$price          = defined('TAAS_WOF_PRICE')     ? TAAS_WOF_PRICE     : '$80';
$established    = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating         = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews        = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$ms_number      = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$cf7_wof        = defined('TAAS_CF7_WOF')       ? TAAS_CF7_WOF       : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET: '';
$division_count = defined('TAAS_DIVISION_COUNT')? TAAS_DIVISION_COUNT: '7';
$finance_list   = defined('TAAS_FINANCE_LIST')  ? TAAS_FINANCE_LIST  : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')      ? TAAS_MBI_LIST      : 'Autosure, Assurant, Provident, Janssen, Autolife';
$mta_badge      = get_site_url() . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png';

// ── Derived ───────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$years         = date('Y') - intval($established);
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel= preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── FAQs — shared library + suburb-specific ──────────────────────────────────
$faqs = [
  // Suburb-specific (need $suburb_name interpolation — can't live in shared library)
  ['q' => "Where is the nearest WOF station to {$suburb_name}?",
   'a' => "Tony Allen Auto Service is at 139 Cavendish Drive, Manukau — {$distance_text}. " . rtrim($sub['getting_here'], '.') . ". We are NZTA Authorised and have been providing WOF inspections to {$suburb_name} and surrounding South Auckland suburbs since {$established}. Walk-ins welcome mornings, or call {$phone_free} to book."],
  ['q' => "How much does a WOF cost near {$suburb_name}?",
   'a' => "A Warrant of Fitness at Tony Allen Auto Service is {$price} incl. GST — all makes, all models, no hidden charges. We're at 139 Cavendish Drive, Manukau ({$distance_text}). If we find anything that needs attention, we give you a clear written estimate before touching it. Free re-inspection within 28 days."],
  ['q' => "Do I need to book or can I walk in from {$suburb_name}?",
   'a' => "Walk-ins are welcome mornings, Monday to Friday. Afternoons fill quickly, so booking ahead is recommended for {$suburb_name} drivers. Most inspections take 30–45 minutes. Call {$phone_free} to book a time, or send an enquiry through our website."],
  ['q' => "What happens if my car fails its WOF?",
   'a' => "We give you a clear written estimate before any work begins — no obligation to proceed. The re-inspection is free within 28 days. You can have the repairs done here, somewhere else, or do them yourself — the recheck is free either way. Because we run {$division_count} specialist divisions under one roof at 139 Cavendish Drive, we can often carry out repairs on the same visit — saving {$suburb_name} drivers a second trip."],
  // Shared library FAQs
  $taas_faqs['wof_frequency_2026'],
  $taas_faqs['wof_checklist'],
  ['q' => "Can you carry out repairs if my car fails?",
   'a' => "Yes. Tony Allen Auto Service is a full-service MTA Assured workshop with {$division_count} specialist divisions under one roof — brakes, steering, auto electrical, air conditioning, tyres, and more. In most cases we can carry out WOF repairs on the same visit — saving {$suburb_name} drivers the hassle of booking elsewhere. We give you a clear estimate and timeframe before any work begins."],
  $taas_faqs['wof_fine_2026'],
  $taas_faqs['wof_older_vehicles'],
  ["q" => "What areas do you cover from Manukau?",
   "a" => "We serve all of South Auckland from 139 Cavendish Drive, Manukau — including {$area_served}. {$years} years at the same address. " . rtrim($sub['intro'], '.') . "."],
  $taas_faqs['wof_reminders'],
  $taas_faqs['finance'],
];

// ── Suburb pills — from shared library ────────────────────────────────────────
$all_suburbs = [];
foreach (taas_suburbs_library() as $slug => $data) {
    $all_suburbs[] = [$data['name'], '/wof-inspection-' . $slug . '/'];
}

// ── Schema ────────────────────────────────────────────────────────────────────
$schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type'           => 'BreadcrumbList',
      'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Warrant of Fitness','item'=>$site_url.'/wof/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'WOF '.$suburb_name,'item'=>$page_url],
      ],
    ],
    [
      '@type'       => ['AutoRepair','LocalBusiness'],
      '@id'         => $site_url . '/#organization',
      'name'        => 'Tony Allen Auto Service',
      'description' => 'NZTA Authorised WOF inspections — ' . $price . ' flat rate. MTA Assured. ' . $ms_number . '.',
      'url'         => $site_url,
      'telephone'   => [$phone_local, $phone_free],
      'email'       => $email,
      'foundingDate'=> '1985-10',
      'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => '139 Cavendish Drive',
        'addressLocality' => 'Manukau',
        'addressRegion'   => 'Auckland',
        'postalCode'      => '2104',
        'addressCountry'  => 'NZ',
      ],
      'geo' => [
        '@type'     => 'GeoCoordinates',
        'latitude'  => -36.9935,
        'longitude' => 174.8661,
      ],
      'openingHoursSpecification' => [[
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
        'opens'     => '07:30',
        'closes'    => '17:00',
      ]],
      'aggregateRating' => [
        '@type'       => 'AggregateRating',
        'ratingValue' => $rating,
        'reviewCount' => preg_replace('/[^0-9]/', '', $reviews),
        'bestRating'  => '5',
      ],
      'areaServed'  => $suburb_name . ', South Auckland, New Zealand',
      'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
      'priceRange'  => '$$',
      'sameAs'      => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
      'memberOf'    => ['@type'=>'Organization','name'=>'MTA New Zealand'],
    ],
    [
      '@type'       => 'Service',
      'name'        => 'WOF ' . $suburb_name . ' — Warrant of Fitness Inspection',
      'description' => 'NZTA-authorised Warrant of Fitness inspections for ' . $suburb_name . ' drivers at ' . $price . ' incl. GST. Walk-ins welcome mornings — booking recommended. Free re-inspection within 28 days.',
      'provider'    => ['@id' => $site_url . '/#organization'],
      'areaServed'  => $suburb_name . ', South Auckland, New Zealand',
      'offers'      => [
        '@type'         => 'Offer',
        'price'         => '80',
        'priceCurrency' => 'NZD',
        'description'   => 'WOF inspection — all makes and models, incl. GST',
      ],
    ],
    [
      '@type'      => 'FAQPage',
      'mainEntity' => array_map(function($f) {
        return ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
      }, $faqs),
    ],
  ],
];

get_header();
$schema['@graph'][1]['speakable'] = [
  '@type'  => 'SpeakableSpecification',
  'cssSelector' => ['.wl-hero__h1', '.wl-hero__sub'],
];
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-wof-loc">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════ */
.page-template-template-wof-location .site-content,
.page-template-template-wof-location .entry-content,
.page-template-template-wof-location .entry-header,
.page-template-template-wof-location article,
.page-template-template-wof-location #primary,
.page-template-template-wof-location #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-wof-loc *, .taas-wof-loc *::before, .taas-wof-loc *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-wof-loc { font-family:var(--taas-font); -webkit-font-smoothing:antialiased; color:#333; overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }

/* ══ LAYOUT ══════════════════════════════════════════════════════════════ */
.wl-w { max-width:1140px; margin:0 auto; padding:0 24px; }
.wl-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.wl-grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }

/* ══ BREADCRUMB ═════════════════════════════════════════════════════════ */
.wl-bread { background:#0D0D0D; border-bottom:1px solid rgba(255,255,255,.06); padding:12px 0; }
.wl-bread a, .wl-bread span { font-size:12px; color:#888; text-decoration:none; }
.wl-bread a:hover { color:#FFC800; }
.wl-bread span[aria-current] { color:#ccc; }
.wl-bread span:not([aria-current]) { margin:0 6px; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.wl-hero { background:#0D0D0D; padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px); }
.wl-hero__inner { display:grid; grid-template-columns:1fr 320px; gap:48px; align-items:center; }
.wl-hero__eye {
  display:inline-flex; align-items:center; gap:10px; margin-bottom:20px;
}
.wl-hero__line { width:40px; height:2px; background:#FFC800; }
.wl-hero__eye-txt { font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#FFC800; }
.wl-hero__h1 {
  font-family:var(--taas-font);
  font-size:var(--taas-h1-spoke, clamp(30px,5vw,50px));
  font-weight:800; color:#fff;
  letter-spacing:-.02em;
  line-height:1.1; margin-bottom:20px;
}
.wl-hero__h1 span { color:#FFC800; }
.wl-hero__pill { display:inline-block; background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); font-size:10px; font-weight:700; letter-spacing:0.08em; padding:8px 16px; border-radius:3px; margin-bottom:16px; line-height:1.3; }
.wl-hero__sub { font-size:17px; color:#999; line-height:1.75; font-weight:300; letter-spacing:-0.1px; max-width:520px; margin-bottom:32px; }
.wl-hero__ctas { display:flex; gap:14px; flex-wrap:wrap; }
.wl-btn {
  display:inline-flex; align-items:center; gap:9px;
  font-family:var(--taas-font); font-weight:var(--taas-btn-wt, 600); font-size:var(--taas-btn-size, 15px);
  letter-spacing:.03em; text-transform:uppercase;
  padding:15px 26px; border-radius:6px;
  transition:all .18s; cursor:pointer; border:none; text-decoration:none;
  -webkit-font-smoothing:antialiased;
}
.wl-btn--yellow { background:#FFC800; color:#1A1A1A!important; }
.wl-btn--yellow:hover { background:#e6b400; color:#1A1A1A!important; transform:translateY(-1px); }
.wl-btn--outline { background:transparent; color:#FFC800!important; border:2px solid #FFC800; }
.wl-btn--outline:hover { background:#FFC800; color:#1A1A1A!important; }
.wl-btn--dark { background:#1A1A1A; color:#fff!important; }
.wl-btn--dark:hover { background:#000; transform:translateY(-1px); }

/* Hero trust card */
.wl-hero__card {
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1);
  border-top:3px solid #FFC800; padding:28px 24px;
}
.wl-hero__card-title { font-size:10px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:#FFC800; margin-bottom:20px; }
.wl-card-item { display:flex; gap:14px; align-items:flex-start; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.wl-card-item:last-child { border-bottom:none; padding-bottom:0; }
.wl-card-icon { width:36px; height:36px; background:rgba(255,200,0,.1); border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.wl-card-icon svg { width:18px; height:18px; fill:#FFC800; }
.wl-card-label { font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; margin-bottom:3px; }
.wl-card-val { font-size:15px; font-weight:700; color:#fff; }

/* ══ PHONE STRIP ══════════════════════════════════════════════════════════ */
.wl-pstrip { background:var(--taas-yellow, #FFC800); padding:var(--taas-trust-pad, 18px) 0; }
.wl-pstrip__inner { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.wl-pstrip__left { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.wl-pstrip__lbl { font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; color:#1A1A1A; }
.wl-pstrip__num { font-family:var(--taas-font); font-size:28px; font-weight:900; color:#1A1A1A; text-decoration:none; }
.wl-pstrip__hours { font-size:13px; font-weight:600; color:#1A1A1A; opacity:.75; }
.wl-pstrip__walkin { font-size:13px; font-weight:700; color:#1A1A1A; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════ */
.wl-trust { background:#F7F7F5; padding:18px 0; border-bottom:1px solid #E8E8E4; }
.wl-trust__inner { display:flex; justify-content:center; gap:32px; flex-wrap:wrap; }
.wl-trust__item { display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#333; }
.wl-trust__item svg { width:16px; height:16px; fill:#FFC800; flex-shrink:0; }

/* ══ FINANCE STRIP ═══════════════════════════════════════════════════════ */
.wl-finance { background:#FFFDF5; padding:16px 0; border-bottom:1px solid #E8E8E4; }
.wl-finance__inner { display:flex; justify-content:center; align-items:center; gap:24px; flex-wrap:wrap; }
.wl-finance__lbl { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#999; }
.wl-finance__badge { font-size:13px; font-weight:600; color:#555; }

/* ══ ABOUT SECTION (white) ════════════════════════════════════════════════ */
.wl-about { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.wl-about__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A);
  margin-bottom:16px;
}
.wl-about__h2 span { color:#FFC800; }
.wl-about__body { font-size:17px; color:var(--taas-mid, #666); line-height:1.75; font-weight:300; letter-spacing:-0.1px; margin-bottom:16px; }
.wl-about__body:last-child { margin-bottom:0; }

/* Why choose list */
.wl-choose { list-style:none; display:flex; flex-direction:column; gap:12px; margin-top:8px; }
.wl-choose li {
  display:flex; align-items:flex-start; gap:12px;
  font-size:15px; color:#333; line-height:1.5;
}
.wl-choose li::before {
  content:''; width:20px; height:20px; flex-shrink:0; margin-top:1px;
  background:#FFC800; border-radius:50%;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 10l4 4 6-6' stroke='%231A1A1A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-size:contain;
}

/* CTA panel */
.wl-cta-panel {
  background:#FFC800; padding:24px 28px; text-align:center;
}
.wl-cta-panel__head { font-size:17px; font-weight:700; color:#111; margin-bottom:4px; }
.wl-cta-panel__sub { font-size:14px; color:#333; margin-bottom:16px; }

/* ══ WHAT WE CHECK (grey) ═════════════════════════════════════════════════ */
.wl-checks { background:#F7F7F5; padding:var(--taas-sec-pad, 72px) 0; }
.wl-checks__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px;
}
.wl-checks__h2 span { color:#FFC800; }
.wl-checks__sub { font-size:17px; color:var(--taas-mid, #666); margin-bottom:36px; max-width:600px; line-height:1.75; font-weight:300; letter-spacing:-0.1px; }
.wl-checks__grid {
  display:grid; grid-template-columns:repeat(4,1fr); gap:12px;
}
.wl-check-item {
  background:#fff; border:1px solid #E8E8E4;
  border-top:3px solid #FFC800;
  padding:18px 16px;
  font-size:14px; font-weight:600; color:#1A1A1A;
  line-height:1.4;
}
.wl-checks__note {
  margin-top:28px; padding:16px 20px;
  background:#fff; border-left:3px solid #FFC800;
  font-size:15px; color:#555; line-height:1.6;
}
.wl-checks__note strong { color:#1A1A1A; }

/* ══ 2026 RULES (white) ════════════════════════════════════════════════════ */
.wl-rules { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.wl-rules__eye { display:inline-block; background:#FFC800; color:#1A1A1A; font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; padding:6px 14px; margin-bottom:16px; }
.wl-rules__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:12px;
}
.wl-rules__sub { font-size:16px; color:#666; margin-bottom:36px; max-width:600px; line-height:1.6; }
.wl-table-wrap { overflow-x:auto; }
.wl-table {
  width:100%; border-collapse:collapse;
  font-size:14px; background:#fff;
  border:1px solid #E8E8E4;
}
.wl-table thead th {
  background:#1A1A1A; color:#fff;
  font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
  padding:14px 16px; text-align:left;
  border-right:1px solid rgba(255,255,255,.08);
}
.wl-table thead th:first-child { color:#FFC800; }
.wl-table thead th:last-child { border-right:none; }
.wl-table tbody td {
  padding:13px 16px; border-bottom:1px solid #E8E8E4;
  border-right:1px solid #E8E8E4; color:#333; vertical-align:middle;
}
.wl-table tbody td:last-child { border-right:none; }
.wl-table tbody tr:last-child td { border-bottom:none; }
.wl-table tbody tr:nth-child(even) td { background:#F9F9F7; }
.wl-table tbody td:first-child { font-weight:600; color:#1A1A1A; }
.wl-table .tag-new { background:#FFC800; color:#1A1A1A; font-size:10px; font-weight:800; letter-spacing:.08em; padding:2px 8px; text-transform:uppercase; border-radius:2px; white-space:nowrap; }
.wl-table .tag-nc { background:#E8E8E4; color:#666; font-size:10px; font-weight:700; letter-spacing:.06em; padding:2px 8px; text-transform:uppercase; border-radius:2px; white-space:nowrap; }
.wl-rules__note { margin-top:20px; padding:16px 20px; background:#F7F7F5; border-left:3px solid #FFC800; font-size:14px; color:#555; line-height:1.6; }
.wl-rules__note strong { color:#1A1A1A; }

/* ══ BOOKING / ENQUIRY (dark) ═══════════════════════════════════════════ */
.wl-book { background:#111; padding:var(--taas-sec-pad, 72px) 0; }
.wl-book__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:#fff; margin-bottom:8px;
}
.wl-book__h2 span { color:#FFC800; }
.wl-book__sub { font-size:16px; color:#999; margin-bottom:40px; line-height:1.6; }
.wl-book__grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }

/* CF7 wrapper — dark variant */
.wl-form-wrap {
  background:#1c1c1c; border:1px solid rgba(255,255,255,.08);
  border-top:3px solid #FFC800;
  padding:32px;
}
.wl-form-wrap h3 { font-size:18px; font-weight:700; color:#fff; margin-bottom:8px; }
.wl-form-wrap p { font-size:15px; color:#999; line-height:1.6; margin-bottom:24px; }

/* CF7 field overrides — dark inputs */
.wl-form-wrap .wpcf7-form input[type="text"],
.wl-form-wrap .wpcf7-form input[type="email"],
.wl-form-wrap .wpcf7-form input[type="tel"],
.wl-form-wrap .wpcf7-form select,
.wl-form-wrap .wpcf7-form textarea {
  background:#1c1c1c!important; border:1px solid rgba(255,255,255,.12)!important;
  color:#fff!important; border-radius:6px!important;
  padding:13px 16px!important; font-size:15px!important;
  font-family:var(--taas-font)!important;
  width:100%!important; box-sizing:border-box!important;
  transition:border-color .15s!important; height:auto!important;
  line-height:1.5!important; margin-top:6px!important;
}
.wl-form-wrap .wpcf7-form textarea { min-height:110px!important; resize:vertical!important; }
.wl-form-wrap .wpcf7-form input:focus,
.wl-form-wrap .wpcf7-form textarea:focus {
  border-color:#FFC800!important; outline:none!important;
  box-shadow:0 0 0 3px rgba(255,200,0,.12)!important;
}
.wl-form-wrap .wpcf7-form input::placeholder,
.wl-form-wrap .wpcf7-form textarea::placeholder { color:#666!important; }
.wl-form-wrap .wpcf7-form label {
  color:#999!important; font-size:12px!important; font-weight:700!important;
  display:block!important; text-transform:uppercase!important; letter-spacing:.08em!important;
}
.wl-form-wrap .wpcf7-form input[type="submit"],
.wl-form-wrap .wpcf7-form .wpcf7-submit {
  background:#FFC800!important; color:#1A1A1A!important;
  border:none!important; padding:15px 32px!important;
  font-size:15px!important; font-weight:700!important;
  font-family:var(--taas-font)!important;
  border-radius:6px!important; cursor:pointer!important;
  width:100%!important; margin-top:4px!important;
  letter-spacing:.03em!important; text-transform:uppercase!important;
  transition:opacity .15s!important;
}
.wl-form-wrap .wpcf7-form input[type="submit"]:hover { opacity:.88!important; }
.wl-form-wrap .wpcf7-form .wpcf7-not-valid-tip { color:#C0392B!important; font-size:12px!important; margin-top:4px!important; }
.wl-form-wrap .wpcf7-form .wpcf7-response-output { border:1px solid #E8E8E4!important; color:#555!important; font-size:14px!important; padding:14px!important; border-radius:6px!important; margin-top:16px!important; }

/* Contact card — dark variant */
.wl-contact-card {
  background:#1c1c1c; border:1px solid rgba(255,255,255,.08); padding:32px;
}
.wl-contact-card h3 { font-size:16px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#666; margin-bottom:20px; }
.wl-contact-row { display:flex; flex-direction:column; gap:4px; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.08); }
.wl-contact-row:last-child { border-bottom:none; }
.wl-contact-label { font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#666; }
.wl-contact-val { font-size:15px; font-weight:600; color:#fff; }
.wl-contact-val a { color:#fff; text-decoration:none; }
.wl-contact-val a:hover { color:#FFC800; }
.wl-contact-val--price { color:#FFC800; font-weight:700; }

/* ══ REVIEWS (white) ═════════════════════════════════════════════════════ */
.wl-reviews { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.wl-reviews__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px;
}
.wl-reviews__h2 span { color:#FFC800; }
.wl-reviews__meta { display:flex; align-items:center; gap:20px; margin-bottom:36px; flex-wrap:wrap; }
.wl-reviews__score { font-family:var(--taas-font); font-size:56px; font-weight:900; color:#FFC800; line-height:1; }
.wl-reviews__detail { font-size:14px; color:#666; line-height:1.6; }
.wl-reviews__stars { color:#FFC800; font-size:18px; display:block; margin-bottom:2px; }

/* ══ SUBURBS (grey) ══════════════════════════════════════════════════════ */
.wl-suburbs { background:#F7F7F5; padding:56px 0; }
.wl-suburbs__h2 {
  font-family:var(--taas-font);
  font-size:clamp(24px,2.5vw,34px);
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px;
}
.wl-suburbs__sub { font-size:15px; color:#666; margin-bottom:28px; }
.wl-suburbs__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:10px; }
.wl-suburb-pill {
  display:block; background:#fff; border:1px solid #E8E8E4;
  padding:12px 16px; text-decoration:none;
  font-size:14px; font-weight:600; color:#1A1A1A;
  transition:border-color .15s, background .15s;
}
.wl-suburb-pill:hover,
.wl-suburb-pill[aria-current="page"] { border-color:#FFC800; background:#FFFBEB; color:#1A1A1A; }

/* ══ CTA BAND (dark) ═════════════════════════════════════════════════════ */
.wl-cta { background:#0D0D0D; padding:72px 0; text-align:center; }
.wl-cta__h2 {
  font-family:var(--taas-font);
  font-size:clamp(32px,4.5vw,56px);
  font-weight:700; color:#fff; margin-bottom:8px;
}
.wl-cta__h2 span { color:#FFC800; }
.wl-cta__sub { font-size:16px; color:#999; margin-bottom:12px; }
.wl-cta__price { font-size:20px; font-weight:700; color:#FFC800; margin-bottom:32px; }
.wl-cta__phone { font-family:var(--taas-font); font-size:var(--taas-cta-phone, 40px); font-weight:var(--taas-cta-phone-wt, 800); color:#FFC800; text-decoration:none; display:block; margin-bottom:24px; }
.wl-cta__btns { display:flex; gap:16px; justify-content:center; flex-wrap:wrap; }

/* ══ FAQ (white) ══════════════════════════════════════════════════════════ */
.wl-faq { background:#fff; padding:72px 0; }
.wl-faq__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A);
  text-align:center; margin-bottom:8px;
}
.wl-faq__h2 span { color:#FFC800; }
.wl-faq__sub { text-align:center; color:#666; font-size:16px; margin-bottom:48px; }
.wl-faq__list { max-width:800px; margin:0 auto; }
.wl-faq__item { border-bottom:1px solid #E8E8E4; }
.wl-faq__item:first-child { border-top:1px solid #E8E8E4; }
.wl-faq__q {
  width:100%; text-align:left; background:none; border:none;
  padding:20px 40px 20px 0;
  font-family:var(--taas-font);
  font-size:16px; font-weight:700; color:#1A1A1A;
  cursor:pointer; position:relative; line-height:1.4;
}
.wl-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:24px; font-weight:300; color:#FFC800; }
.wl-faq__item.is-open .wl-faq__q::after { content:'−'; }
.wl-faq__a { display:none; padding:0 40px 20px 0; }
.wl-faq__item.is-open .wl-faq__a { display:block; }
.wl-faq__a p { font-size:15px; color:#666; line-height:1.75; margin:0; }
.wl-faq__a a { color:#FFC800; font-weight:600; text-decoration:none; }
.wl-faq__a a:hover { text-decoration:underline; }
.wl-faq__a strong { color:#1A1A1A; }

/* ══ AWARDS ═══════════════════════════════════════════════════════════════ */
.wl-awards { background:#F7F7F5; padding:48px 0; border-top:1px solid #E8E8E4; }
.wl-awards__inner { display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap; }
.wl-awards__label { font-size:11px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#999; margin-bottom:12px; }
.wl-awards__list { display:flex; flex-wrap:wrap; gap:8px; }
.wl-award-pill { background:#fff; border:1px solid #E8E8E4; font-size:13px; font-weight:600; color:#333; padding:8px 14px; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .wl-hero__inner { grid-template-columns:1fr; }
  .wl-hero__card { display:none; }
  .wl-grid-2 { grid-template-columns:1fr; }
  .wl-book__grid { grid-template-columns:1fr; }
  .wl-checks__grid { grid-template-columns:repeat(3,1fr); }
  .wl-suburbs__grid { grid-template-columns:repeat(3,1fr); }
  .wl-grid-3 { grid-template-columns:1fr 1fr; }
}
@media (max-width:640px) {
  /* Layout */
  .wl-checks__grid { grid-template-columns:repeat(2,1fr); }
  .wl-suburbs__grid { grid-template-columns:repeat(2,1fr); }
  .wl-grid-3 { grid-template-columns:1fr; }
  .wl-awards__inner { flex-direction:column; align-items:flex-start; }
  .wl-book__grid { flex-direction:column-reverse; display:flex; gap:32px; }
  .wl-trust__inner { gap:16px; }
  .wl-finance__inner { gap:12px; }

  /* Section spacing */
  .wl-hero { padding:48px 0 40px; }
  .wl-about { padding:48px 0; }
  .wl-checks { padding:48px 0; }
  .wl-rules { padding:48px 0; }
  .wl-book { padding:48px 0; }
  .wl-reviews { padding:48px 0; }
  .wl-suburbs { padding:48px 0; }
  .wl-cta { padding:48px 0; }
  .wl-faq { padding:48px 0; }

  /* Type scale */
  .wl-hero__h1 { font-size:clamp(26px, 7vw, 42px); }
  .wl-hero__sub { font-size:14px; margin-bottom:24px; }
  .wl-hero__price { font-size:11px; padding:6px 14px; }
  .wl-hero__ctas { flex-direction:column; align-items:stretch; }
  .wl-hero__ctas .wl-btn { justify-content:center; text-align:center; }
  .wl-btn { font-size:13px; padding:12px 20px; }
  .wl-about__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-about__body { font-size:14px; }
  .wl-checklist li { font-size:13px; gap:10px; }
  .wl-checklist li::before { width:18px; height:18px; }
  .wl-step__head { font-size:14px; }
  .wl-step__body { font-size:13px; }
  .wl-step__num { width:34px; height:34px; font-size:18px; }
  .wl-checks__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-checks__sub { font-size:14px; }
  .wl-check-card { padding:18px 16px; }
  .wl-check-card__num { font-size:24px; }
  .wl-check-card__name { font-size:13px; }
  .wl-check-card__desc { font-size:12px; }
  .wl-rules__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-rules__sub { font-size:14px; }
  .wl-book__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-book__sub { font-size:14px; }
  .wl-suburbs__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-suburbs__sub { font-size:13px; }
  .wl-suburb-pill { padding:12px 14px; }
  .wl-suburb-pill__name { font-size:13px; }
  .wl-suburb-pill__dist { font-size:11px; }
  .wl-cta__h2 { font-size:clamp(24px, 6vw, 36px); }
  .wl-cta__sub { font-size:14px; }
  .wl-cta__price { font-size:16px; }
  .wl-cta__phone { font-size:28px; }
  .wl-cta__btns { flex-direction:column; align-items:stretch; }
  .wl-cta__btns .wl-btn { justify-content:center; text-align:center; }
  .wl-faq__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wl-faq__sub { font-size:14px; margin-bottom:32px; }
  .wl-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .wl-faq__a p { font-size:13px; }

  /* Phone strip */
  .wl-pstrip__inner { flex-direction:column; text-align:center; gap:6px; }
  .wl-pstrip__left { flex-direction:column; gap:4px; }
  .wl-pstrip__lbl { display:none; }
  .wl-pstrip__num { font-size:22px; }
  .wl-pstrip__hours { font-size:12px; }
  .wl-pstrip__walkin { font-size:12px; }

  /* Table → stacked cards */
  .wl-table thead { display:none; }
  .wl-table, .wl-table tbody, .wl-table tr, .wl-table td { display:block; width:100%; }
  .wl-table { border:none; }
  .wl-table tr { padding:16px; border-bottom:1px solid #E8E8E4; }
  .wl-table tr:last-child { border-bottom:none; }
  .wl-table tbody td { padding:3px 0; border:none; border-right:none; }
  .wl-table tbody td:first-child { font-size:14px; font-weight:700; color:#1A1A1A; margin-bottom:6px; }
  .wl-table tbody td:nth-child(2) { font-size:12px; color:#999; }
  .wl-table tbody td:nth-child(2)::before { content:'Current: '; font-weight:600; color:#666; }
  .wl-table tbody td:nth-child(3)::before { content:'From Nov 2026: '; font-weight:600; color:#666; font-size:12px; }
  .wl-table tbody td:nth-child(3) { font-size:13px; margin-top:4px; }
  .wl-table tbody tr:nth-child(even) td { background:transparent; }
}
</style>


<!-- ══ BREADCRUMB ════════════════════════════════════════════════════════ -->
<nav class="wl-bread" aria-label="Breadcrumb">
  <div class="wl-w">
    <a href="<?php echo esc_url($site_url); ?>">Home</a>
    <span>›</span>
    <a href="<?php echo esc_url($site_url . '/wof/'); ?>">Warrant of Fitness</a>
    <span>›</span>
    <span aria-current="page">WOF <?php echo esc_html($suburb_name); ?></span>
  </div>
</nav>

<!-- ══ HERO ══════════════════════════════════════════════════════════════ -->
<section class="wl-hero" aria-label="WOF <?php echo esc_attr($suburb_name); ?> hero">
  <div class="wl-w">
    <div class="wl-hero__inner">
      <div>
        <div class="wl-hero__eye">
          <div class="wl-hero__line"></div>
          <span class="wl-hero__eye-txt">NZTA Authorised — WOF <?php echo esc_html($suburb_name); ?></span>
        </div>
        <h1 class="wl-hero__h1">
          WOF Inspection<br>
          <span><?php echo esc_html($suburb_name); ?> — <?php echo esc_html($price); ?> Flat Rate</span>
        </h1>
        <div class="wl-hero__pill"><?php echo esc_html(strtoupper('Booking recommended · ' . $hours . ($sub['distance'] ? ' · ' . $sub['distance'] : ''))); ?></div>
        <p class="wl-hero__sub">
          NZTA-authorised Warrant of Fitness inspections for <?php echo esc_html($suburb_name); ?> drivers at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:underline;">139 Cavendish Drive, Manukau</a><?php if ($distance_text): ?> — <?php echo esc_html($distance_text); ?><?php endif; ?>. One fixed price for every vehicle. Free re-inspection within 28 days.
        </p>
        <div class="wl-hero__ctas">
          <a href="#wl-book" class="wl-btn wl-btn--yellow">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            Book My WOF — <?php echo esc_html($price); ?>
          </a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wl-btn wl-btn--outline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <?php echo esc_html($phone_free); ?>
          </a>
        </div>
      </div>

      <div class="wl-hero__card" aria-hidden="true">
        <div class="wl-hero__card-title">What to expect</div>
        <div class="wl-card-item">
          <div class="wl-card-icon"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg></div>
          <div>
            <div class="wl-card-label">Inspection time</div>
            <div class="wl-card-val">30–45 minutes</div>
          </div>
        </div>
        <div class="wl-card-item">
          <div class="wl-card-icon"><svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg></div>
          <div>
            <div class="wl-card-label">Fixed price</div>
            <div class="wl-card-val"><?php echo esc_html($price); ?> all makes &amp; models</div>
          </div>
        </div>
        <div class="wl-card-item">
          <div class="wl-card-icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
          <div>
            <div class="wl-card-label">Location</div>
            <div class="wl-card-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#fff;text-decoration:underline;">139 Cavendish Drive, Manukau</a><?php if ($distance_text): ?><br><span style="font-size:13px;color:#999;font-weight:400;"><?php echo esc_html($distance_text); ?></span><?php endif; ?></div>
          </div>
        </div>
        <div class="wl-card-item">
          <div class="wl-card-icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
          <div>
            <div class="wl-card-label">Accreditation</div>
            <div class="wl-card-val">NZTA Authorised · MTA Assured</div>
          </div>
        </div>
        <div class="wl-card-item">
          <div class="wl-card-icon"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm4.24 16L12 15.45 7.77 18l1.12-4.81-3.73-3.23 4.92-.42L12 5l1.92 4.53 4.92.42-3.73 3.23L16.23 18z"/></svg></div>
          <div>
            <div class="wl-card-label">Google rating</div>
            <div class="wl-card-val"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> reviews</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ════════════════════════════════════════════════════════ -->
<div class="wl-pstrip" role="region" aria-label="Contact">
  <div class="wl-w">
    <div class="wl-pstrip__inner">
      <div class="wl-pstrip__left">
        <span class="wl-pstrip__lbl">Book your WOF</span>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wl-pstrip__num"><?php echo esc_html($phone_free); ?></a>
        <span class="wl-pstrip__hours"><?php echo esc_html($hours); ?></span>
      </div>
      <span class="wl-pstrip__walkin">Walk-ins welcome mornings · Bookings recommended</span>
    </div>
  </div>
</div>


<!-- ══ TRUST STRIP ═══════════════════════════════════════════════════════ -->
<div class="wl-trust" role="region" aria-label="Trust signals">
  <div class="wl-w">
    <div class="wl-trust__inner">
      <span class="wl-trust__item"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> MTA Assured</span>
      <span class="wl-trust__item"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> NZTA Authorised</span>
      <span class="wl-trust__item"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> Estimate Before We Start</span>
      <span class="wl-trust__item"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg> <?php echo esc_html($division_count); ?> Divisions, One Workshop</span>
    </div>
  </div>
</div>

<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════ -->
<div class="wl-finance" role="region" aria-label="Finance options">
  <div class="wl-w">
    <div class="wl-finance__inner">
      <span class="wl-finance__lbl">Finance available</span>
      <span class="wl-finance__badge">Afterpay</span>
      <span class="wl-finance__badge">Zip</span>
      <span class="wl-finance__badge">Q Card</span>
      <span class="wl-finance__badge">Gem Finance</span>
      <span class="wl-finance__badge">Aotea Finance</span>
    </div>
  </div>
</div>


<!-- ══ ABOUT / WHY TAAS (white) ══════════════════════════════════════════ -->
<section class="wl-about" aria-labelledby="wl-about-head">
  <div class="wl-w">
    <div class="wl-grid-2">
      <div>
        <h2 class="wl-about__h2" id="wl-about-head">
          WOF <?php echo esc_html($suburb_name); ?> — <span>South Auckland's Trusted Workshop</span>
        </h2>
        <p class="wl-about__body">
          Tony Allen Auto Service has been providing Warrant of Fitness inspections to <?php echo esc_html($suburb_name); ?> and surrounding South Auckland suburbs since <?php echo esc_html($established); ?>. We are NZTA Authorised and MTA Assured — every <?php echo esc_html($suburb_name); ?> WOF is carried out to the same standard, every time.
        </p>
        <p class="wl-about__body">
          Our workshop is at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a><?php echo $distance_text ? ' — ' . esc_html($distance_text) : ''; ?>. We are one of the largest independent automotive workshops in South Auckland, operating <?php echo esc_html($division_count); ?> specialist divisions under one roof. Whatever your vehicle — daily driver, ute, van, or light commercial — our technicians have the experience to get your WOF done efficiently.
        </p>
        <p class="wl-about__body">
          <?php echo esc_html($suburb_name); ?> drivers choose us because we are straight with you. If your vehicle passes, you are out the door. If it needs work, we give you a clear written estimate before touching anything. You decide whether to proceed. No pressure, no surprises.
        </p>
      </div>

      <div>
        <div style="background:#F7F7F5;border:1px solid #E8E8E4;border-top:3px solid #FFC800;padding:28px;margin-bottom:20px;">
          <h3 style="font-size:15px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#999;margin-bottom:20px;">Why <?php echo esc_html($suburb_name); ?> Drivers Choose TAAS</h3>
          <ul class="wl-choose">
            <li>NZTA authorised — every inspector trained and certified</li>
            <li><?php echo esc_html($price); ?> flat rate — all makes, all models, no hidden charges</li>
            <li>Free re-inspection within 28 days of the initial inspection date</li>
            <li>Repairs carried out in Manukau — no need to book elsewhere</li>
            <li>Afterpay, Q Card, Gem Finance, Aotea Finance accepted</li>
            <li>Trading since <?php echo esc_html($established); ?> — <?php echo esc_html($years); ?> years serving South Auckland</li>
          </ul>
        </div>
        <div class="wl-cta-panel">
          <p class="wl-cta-panel__head">Book a time or walk in</p>
          <p class="wl-cta-panel__sub"><?php echo esc_html($hours); ?> · <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:none;">139 Cavendish Drive, Manukau</a></p>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wl-btn wl-btn--dark">Call <?php echo esc_html($phone_free); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ WHAT WE CHECK (grey) ══════════════════════════════════════════════ -->
<section class="wl-checks" aria-labelledby="wl-checks-head">
  <div class="wl-w">
    <h2 class="wl-checks__h2" id="wl-checks-head">
      What We Check in Your <span>WOF Inspection</span>
    </h2>
    <p class="wl-checks__sub">
      Our NZTA-authorised inspectors work through all mandatory checkpoints — every time, no shortcuts.
    </p>
    <div class="wl-checks__grid">
      <div class="wl-check-item">Tyres &amp; tread depth</div>
      <div class="wl-check-item">Brakes &amp; brake lines</div>
      <div class="wl-check-item">Lights &amp; indicators</div>
      <div class="wl-check-item">Steering &amp; suspension</div>
      <div class="wl-check-item">Windscreen &amp; wipers</div>
      <div class="wl-check-item">Seatbelts &amp; airbags</div>
      <div class="wl-check-item">Body &amp; structure</div>
      <div class="wl-check-item">Exhaust system</div>
      <div class="wl-check-item">Fuel system</div>
      <div class="wl-check-item">Doors &amp; glazing</div>
      <div class="wl-check-item">Speedometer</div>
      <div class="wl-check-item">ADAS warning lights <span style="font-size:11px;color:#FFC800;font-weight:800;margin-left:4px;">NEW 2026</span></div>
    </div>
    <div class="wl-checks__note">
      <strong>Failed your WOF?</strong> In most cases we can carry out the repairs in Manukau on the same visit — saving you the hassle of booking elsewhere. Subject to work required and parts availability.
    </div>
  </div>
</section>


<!-- ══ 2026 RULES (white) ════════════════════════════════════════════════ -->
<section class="wl-rules" aria-labelledby="wl-rules-head">
  <div class="wl-w">
    <div class="wl-rules__eye">Important — Updated Rules</div>
    <h2 class="wl-rules__h2" id="wl-rules-head">New WOF Rules from November 2026 — What Changes for You</h2>
    <p class="wl-rules__sub">The New Zealand Government has confirmed changes to WOF inspection frequency, effective <strong>1 November 2026</strong>. Here is a plain-English summary for <?php echo esc_html($suburb_name); ?> drivers.</p>

    <div class="wl-table-wrap">
      <table class="wl-table" aria-label="2026 NZ WOF frequency changes">
        <thead>
          <tr>
            <th>Your Vehicle</th>
            <th>Current Rule</th>
            <th>From 1 Nov 2026</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>New vehicle (first WOF)</td><td>WOF at 3 years</td><td><span class="tag-new">WOF at 4 years</span></td></tr>
          <tr><td>4–14 years old (registered from Nov 2019)</td><td>Annual WOF</td><td><span class="tag-new">Every 2 years</span></td></tr>
          <tr><td>4–14 years old (registered from Nov 2013)</td><td>Annual WOF</td><td><span class="tag-new">Every 2 years from Nov 2027</span></td></tr>
          <tr><td>Over 14 years old</td><td>Annual WOF</td><td><span class="tag-nc">Annual WOF — no change</span></td></tr>
          <tr><td>Pre-2000 vehicles</td><td>6-monthly WOF</td><td><span class="tag-new">Annual WOF</span></td></tr>
          <tr><td>Light rental vehicles</td><td>6-monthly</td><td><span class="tag-new">Annual from Nov 2026</span></td></tr>
        </tbody>
      </table>
    </div>

    <div class="wl-rules__note">
      <strong>Important for <?php echo esc_html($suburb_name); ?> drivers:</strong> Most vehicles over 14 years old — which make up a large proportion of the South Auckland fleet — continue on annual WOFs with no change. WOF fines are also increasing: from 1 November 2026, driving with a WOF expired by more than two months attracts a <strong>$350 fine</strong> (up from $200). Non-compliant tyres up to $1,000. Not sure when your WOF is due? Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a> and we'll check for you.
    </div>
    <p style="margin-top:14px;font-size:13px;color:#999;">Source: NZTA. Always verify current standards at <a href="https://www.nzta.govt.nz" target="_blank" rel="noopener noreferrer" style="color:#FFC800;">nzta.govt.nz</a>.</p>
  </div>
</section>


<!-- ══ BOOKING / ENQUIRY (dark) ══════════════════════════════════════════ -->
<section class="wl-book" id="wl-book" aria-labelledby="wl-book-head">
  <div class="wl-w">
    <h2 class="wl-book__h2" id="wl-book-head">
      Book Your WOF <span><?php echo esc_html($suburb_name); ?></span>
    </h2>
    <p class="wl-book__sub">Book a time and we'll have a bay ready. Walk-ins welcome mornings — booking recommended for afternoons.</p>

    <div class="wl-book__grid">
      <div class="wl-form-wrap">
        <?php if ($cf7_wof): ?>
          <h3>Book a WOF</h3>
          <p>Leave your details and we'll confirm your booking promptly.</p>
          <?php echo do_shortcode($cf7_wof); ?>
        <?php else: ?>
          <h3>Book Your WOF Today</h3>
          <p>Call or email — or walk in mornings, Monday to Friday at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
          <div style="display:flex;flex-direction:column;gap:12px;">
            <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wl-btn wl-btn--yellow" style="justify-content:center;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
              Call <?php echo esc_html($phone_free); ?>
            </a>
            <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="wl-btn wl-btn--outline" style="justify-content:center;">
              Local <?php echo esc_html($phone_local); ?>
            </a>
            <a href="mailto:<?php echo esc_attr($email); ?>" class="wl-btn wl-btn--outline" style="justify-content:center;">
              <?php echo esc_html($email); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <div class="wl-contact-card">
        <h3>Visit Us</h3>
        <div class="wl-contact-row">
          <span class="wl-contact-label">Address</span>
          <span class="wl-contact-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener"><?php echo esc_html($address); ?></a></span>
        </div>
        <div class="wl-contact-row">
          <span class="wl-contact-label">Toll-free</span>
          <span class="wl-contact-val"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></span>
        </div>
        <div class="wl-contact-row">
          <span class="wl-contact-label">Local</span>
          <span class="wl-contact-val"><a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a></span>
        </div>
        <div class="wl-contact-row">
          <span class="wl-contact-label">Email</span>
          <span class="wl-contact-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
        </div>
        <div class="wl-contact-row">
          <span class="wl-contact-label">Hours</span>
          <span class="wl-contact-val"><?php echo esc_html($hours); ?></span>
        </div>
        <div class="wl-contact-row">
          <span class="wl-contact-label">WOF Price</span>
          <span class="wl-contact-val wl-contact-val--price"><?php echo esc_html($price); ?> · Free re-inspection within 28 days</span>
        </div>
        <?php if ($distance_text): ?>
        <div class="wl-contact-row">
          <span class="wl-contact-label">From <?php echo esc_html($suburb_name); ?></span>
          <span class="wl-contact-val"><?php echo esc_html($distance_text); ?></span>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ══ REVIEWS (white) ════════════════════════════════════════════════════ -->
<section class="wl-reviews" aria-labelledby="wl-reviews-head">
  <div class="wl-w">
    <h2 class="wl-reviews__h2" id="wl-reviews-head">
      What <?php echo esc_html($suburb_name); ?> Drivers Say <span>About Us</span>
    </h2>
    <div class="wl-reviews__meta">
      <div class="wl-reviews__score"><?php echo esc_html($rating); ?></div>
      <div class="wl-reviews__detail">
        <span class="wl-reviews__stars">★★★★☆</span>
        <strong>Google Rating</strong><br>
        Based on <?php echo esc_html($reviews); ?> verified reviews · Trading since <?php echo esc_html($established); ?>
      </div>
    </div>
    <?php if ($reviews_widget): ?>
      <?php echo do_shortcode($reviews_widget); ?>
    <?php else: ?>
      <div style="background:#F7F7F5;border:1px solid #E8E8E4;border-left:3px solid #FFC800;padding:20px 24px;font-size:15px;color:#555;line-height:1.7;">
        Tony Allen Auto Service has been trading in South Auckland since <?php echo esc_html($established); ?>. Our <?php echo esc_html($reviews); ?> Google reviews reflect <?php echo esc_html($years); ?> years of honest, reliable service to the local community.
        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" style="display:inline-block;margin-top:16px;color:#FFC800;font-weight:700;text-decoration:none;">Book your WOF →</a>
      </div>
    <?php endif; ?>
  </div>
</section>


<!-- ══ SUBURBS (grey) ════════════════════════════════════════════════════ -->
<section class="wl-suburbs" aria-labelledby="wl-suburbs-head">
  <div class="wl-w">
    <?php $nearby = taas_suburb_nearby($suburb_slug, $suburb_name); if (!empty($nearby)): ?>
    <div style="margin-bottom:40px;">
      <h2 class="wl-suburbs__h2" id="wl-suburbs-head">WOF for <?php echo esc_html($suburb_name); ?> &amp; Nearby</h2>
      <p class="wl-suburbs__sub">Our workshop at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a> serves drivers from <?php echo esc_html($suburb_name); ?> and surrounding areas<?php echo $distance_text ? ' — ' . esc_html($distance_text) : ''; ?>.</p>
      <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <?php foreach ($nearby as $area): ?>
        <span style="background:#fff;border:1px solid #E8E8E4;padding:6px 14px;font-size:13px;font-weight:600;color:#333;"><?php echo esc_html($area); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    <?php else: ?>
    <h2 class="wl-suburbs__h2" id="wl-suburbs-head">WOF Inspections Across South Auckland</h2>
    <p class="wl-suburbs__sub">We serve drivers from across South Auckland. Select your area for local information.</p>
    <?php endif; ?>

    <h3 style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#999;margin-bottom:16px;">All WOF Locations</h3>
    <div class="wl-suburbs__grid">
      <?php foreach ($all_suburbs as $s):
        $is_current = (strtolower($s[0]) === strtolower($suburb_name));
      ?>
      <a href="<?php echo esc_url($site_url . $s[1]); ?>"
         class="wl-suburb-pill"
         <?php if ($is_current) echo 'aria-current="page"'; ?>>
        <?php echo esc_html($s[0]); ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ CTA BAND (dark) ════════════════════════════════════════════════════ -->
<section class="wl-cta" aria-label="Book your WOF">
  <div class="wl-w">
    <h2 class="wl-cta__h2">Ready for your <span>WOF</span><br>near <?php echo esc_html($suburb_name); ?>?</h2>
    <p class="wl-cta__sub">Walk-ins welcome mornings, Monday to Friday. Book ahead for afternoons.</p>
    <div class="wl-cta__price"><?php echo esc_html($price); ?> flat rate · All makes &amp; models · NZTA Authorised</div>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wl-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="wl-cta__btns">
      <a href="#wl-book" class="wl-btn wl-btn--yellow">Book My WOF — <?php echo esc_html($price); ?></a>
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="wl-btn wl-btn--outline">Send Enquiry</a>
    </div>
  </div>
</section>


<!-- ══ FAQ (white) ════════════════════════════════════════════════════════ -->
<section class="wl-faq" aria-labelledby="wl-faq-head">
  <div class="wl-w">
    <h2 class="wl-faq__h2" id="wl-faq-head">WOF <?php echo esc_html($suburb_name); ?> — <span>Questions Answered</span></h2>
    <p class="wl-faq__sub">Updated for the 2026 rule changes. Answers reflect current NZTA requirements.</p>
    <div class="wl-faq__list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="wl-faq__item<?php echo $i === 0 ? ' is-open' : ''; ?>">
        <button class="wl-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div class="wl-faq__a">
          <p><?php echo wp_kses_post($faq['a']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ AWARDS ═════════════════════════════════════════════════════════════ -->
<section class="wl-awards" aria-label="Industry recognition">
  <div class="wl-w">
    <div class="wl-awards__inner">
      <div>
        <div class="wl-awards__label">Industry recognition</div>
        <div class="wl-awards__list">
          <span class="wl-award-pill">🏆 MTA Best General Repairer — South Auckland 2010</span>
          <span class="wl-award-pill">MTA Awards Finalist 2012</span>
          <span class="wl-award-pill">MTA Awards Finalist 2014</span>
          <span class="wl-award-pill">2 Degrees Business Awards Nominee 2026</span>
        </div>
      </div>
      <div>
        <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured — Motor Trade Association member" style="height:70px;width:auto;" loading="lazy">
      </div>
    </div>
  </div>
</section>

</div><!-- /.taas-wof-loc -->

<script>
(function(){
  document.querySelectorAll('.wl-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.wl-faq__item');
      var isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.wl-faq__item').forEach(function(i){
        i.classList.remove('is-open');
        i.querySelector('.wl-faq__q').setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded','true');
      }
    });
  });
})();
</script>

<?php get_footer(); ?>
