<?php
/**
 * Template Name: WOF Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz/wof/
 * Built: May 2026
 *
 * DEPLOY:
 *   1. Drop into wp-content/themes/taas-child/
 *   2. WP Admin → Pages → Add New → Title: "Warrant of Fitness Manukau" → Slug: wof
 *   3. Template → "WOF Hub" → Publish
 *   4. AIOSEO → Title: "WOF Manukau $80 | Warrant of Fitness | Tony Allen Auto Service"
 *   5. AIOSEO → Focus keyword: wof manukau
 *   6. Purge cache
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$wof_price      = defined('TAAS_WOF_PRICE')      ? TAAS_WOF_PRICE      : '$80';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$cf7_wof        = defined('TAAS_CF7_WOF')        ? TAAS_CF7_WOF        : '[contact-form-7 id="bdcfc93" title="WOF Booking"]';
$years          = date('Y') - intval($established);
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$mta_badge      = get_site_url() . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png';
$hero_img       = get_site_url() . '/wp-content/uploads/2026/06/hero-wof.webp';
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

get_header();
?>

<div class="taas-wof">

<?php
/* ══ FAQ ARRAY — cherry-picked from shared library ══════════════════════════
   $taas_faqs loaded from taas-faqs.php. Schema and accordion both read
   from this array — zero duplication, one-file updates propagate everywhere.
═══════════════════════════════════════════════════════════════════════════ */
$wof_faqs = [
    $taas_faqs['wof_cost'],
    $taas_faqs['wof_appointment'],
    $taas_faqs['wof_frequency_2026'],
    $taas_faqs['wof_fail_detail'],
    $taas_faqs['wof_checklist'],
    $taas_faqs['wof_fine_2026'],
    $taas_faqs['wof_older_vehicles'],
    $taas_faqs['wof_reminders'],
    $taas_faqs['finance'],
    $taas_faqs['wof_accreditation'],
];

/* ══ SCHEMA ══════════════════════════════════════════════════════════════════
   @graph: BreadcrumbList + AutoRepair/LocalBusiness + Service + FAQPage
   FAQPage generated from $wof_faqs array — zero duplication
═══════════════════════════════════════════════════════════════════════════ */
$schema_faq_items = [];
foreach ($wof_faqs as $faq) {
    $schema_faq_items[] = [
        '@type' => 'Question',
        'name'  => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => strip_tags($faq['a']),
        ],
    ];
}

$schema = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type'        => 'BreadcrumbList',
      'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>get_site_url()],
        ['@type'=>'ListItem','position'=>2,'name'=>'Warrant of Fitness','item'=>get_site_url().'/wof/'],
      ],
    ],
    [
      '@type'            => ['AutoRepair','LocalBusiness'],
      '@id'              => get_site_url() . '/#organization',
      'name'             => 'Tony Allen Auto Service',
      'url'              => get_site_url(),
      'telephone'        => [$phone_local, $phone_free],
      'email'            => $email,
      'foundingDate'     => '1985-10',
      'address'          => [
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
      'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
      'priceRange' => '$$',
      'sameAs' => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
      'memberOf' => ['@type'=>'Organization','name'=>'MTA New Zealand'],
    ],
    [
      '@type'       => 'Service',
      'name'        => 'Warrant of Fitness Inspection',
      'description' => 'NZTA-authorised Warrant of Fitness inspections at '.$wof_price.' incl. GST. Walk-ins welcome mornings — booking recommended for afternoons. Free re-inspection within 28 days.',
      'provider'    => ['@id' => get_site_url() . '/#organization'],
      'areaServed'  => 'Manukau, South Auckland, New Zealand',
      'offers'      => [
        '@type'         => 'Offer',
        'price'         => '80',
        'priceCurrency' => 'NZD',
        'description'   => 'WOF inspection — all makes and models, incl. GST',
      ],
    ],
    [
      '@type'      => 'FAQPage',
      'mainEntity' => $schema_faq_items,
    ],
  ],
];

$schema['@graph'][1]['speakable'] = [
  '@type'  => 'SpeakableSpecification',
  'cssSelector' => ['.wof-hero__h1', '.wof-hero__sub', '.wof-facts__body'],
];

echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════ */
.page-template-template-wof .site-content,
.page-template-template-wof .entry-content,
.page-template-template-wof .entry-header,
.page-template-template-wof article,
.page-template-template-wof #primary,
.page-template-template-wof #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-wof *, .taas-wof *::before, .taas-wof *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-wof { font-family:var(--taas-font); -webkit-font-smoothing:antialiased; overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }

/* ══ LAYOUT ══════════════════════════════════════════════════════════════ */
.wof-w { max-width:1140px; margin:0 auto; padding:0 24px; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.wof-hero {
  background:#0D0D0D url('<?php echo esc_url($hero_img); ?>') center 40% / cover no-repeat;
  padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px);
  position:relative;
}
.wof-hero::before {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,.82);
  pointer-events:none;
}
.wof-hero__inner { display:grid; grid-template-columns:1fr 320px; gap:48px; align-items:center; position:relative; z-index:1; }
.wof-hero__eye {
  display:inline-flex; align-items:center; gap:10px;
  margin-bottom:20px;
}
.wof-hero__line { width:40px; height:2px; background:#FFC800; }
.wof-hero__eye-txt { font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#FFC800; }
.wof-hero__h1 {
  font-family:var(--taas-font);
  font-size:var(--taas-h1-hub, clamp(34px,5.5vw,54px));
  font-weight:800; color:#fff;
  letter-spacing:-.02em;
  line-height:1.1; margin-bottom:20px;
}
.wof-hero__h1 span { color:#FFC800; }
.wof-hero__price {
  display:inline-block; background:#FFC800; color:#1A1A1A;
  font-family:var(--taas-font); font-size:13px; font-weight:800;
  letter-spacing:.08em; text-transform:uppercase;
  padding:8px 18px; margin-bottom:20px;
}
.wof-hero__sub { font-size:17px; color:#999; line-height:1.75; font-weight:300; letter-spacing:-0.1px; max-width:520px; margin-bottom:32px; }
.wof-hero__ctas { display:flex; gap:14px; flex-wrap:wrap; }
.wof-btn {
  display:inline-flex; align-items:center; gap:9px;
  font-family:var(--taas-font); font-weight:var(--taas-btn-wt, 600); font-size:var(--taas-btn-size, 15px);
  letter-spacing:.04em; text-transform:uppercase;
  padding:var(--taas-btn-pad, 14px 28px); border-radius:var(--taas-radius, 6px);
  transition:all .18s; cursor:pointer; border:none; text-decoration:none;
  -webkit-font-smoothing:antialiased;
}
.wof-btn--yellow { background:#FFC800; color:#1A1A1A!important; }
.wof-btn--yellow:hover { background:#e6b400; color:#1A1A1A!important; transform:translateY(-1px); }
.wof-btn--outline { background:transparent; color:#FFC800!important; border:2px solid #FFC800; }
.wof-btn--outline:hover { background:#FFC800; color:#1A1A1A!important; }

/* Hero trust card */
.wof-hero__card {
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1);
  border-top:3px solid #FFC800; padding:28px 24px;
}
.wof-hero__card-title { font-size:10px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:#FFC800; margin-bottom:20px; }
.wof-card-item { display:flex; gap:14px; align-items:flex-start; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.wof-card-item:last-child { border-bottom:none; padding-bottom:0; }
.wof-card-icon { width:36px; height:36px; background:rgba(255,200,0,.1); border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.wof-card-icon svg { width:18px; height:18px; fill:#FFC800; }
.wof-card-label { font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; margin-bottom:3px; }
.wof-card-val { font-size:15px; font-weight:700; color:#fff; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════ */
.wof-pstrip { background:var(--taas-yellow, #FFC800); padding:var(--taas-trust-pad, 18px) 0; }
.wof-pstrip__inner { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.wof-pstrip__left { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.wof-pstrip__lbl { font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; color:#1A1A1A; }
.wof-pstrip__num { font-family:var(--taas-font); font-size:28px; font-weight:900; color:#1A1A1A; text-decoration:none; transition:opacity .15s; }
.wof-pstrip__num:hover { opacity:.65; }
.wof-pstrip__hours { font-size:13px; font-weight:600; color:#1A1A1A; opacity:.75; }
.wof-pstrip__walkin { font-size:13px; font-weight:700; color:#1A1A1A; }

/* ══ KEY FACTS ════════════════════════════════════════════════════════════ */
.wof-facts { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.wof-facts__grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.wof-facts__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:#0D0D0D;
  margin-bottom:16px;
}
.wof-facts__h2 span { color:#FFC800; }
.wof-facts__body { font-size:17px; color:#555; line-height:1.75; font-weight:300; letter-spacing:-0.1px; margin-bottom:24px; }
.wof-checklist { list-style:none; display:flex; flex-direction:column; gap:12px; }
.wof-checklist li {
  display:flex; align-items:flex-start; gap:12px;
  font-size:15px; color:#333; line-height:1.5;
}
.wof-checklist li::before {
  content:''; width:20px; height:20px; flex-shrink:0; margin-top:1px;
  background:#FFC800; border-radius:50%;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 10l4 4 6-6' stroke='%231A1A1A' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
  background-size:contain;
}

/* Facts right — process steps */
.wof-steps { display:flex; flex-direction:column; gap:0; }
.wof-step { display:flex; gap:20px; padding:20px 0; border-bottom:1px solid #E8E8E4; }
.wof-step:first-child { padding-top:0; }
.wof-step:last-child { border-bottom:none; }
.wof-step__num {
  width:40px; height:40px; flex-shrink:0;
  background:#1A1A1A; color:#FFC800;
  font-family:var(--taas-font);
  font-size:22px; font-weight:900;
  display:flex; align-items:center; justify-content:center;
  border-radius:6px;
}
.wof-step__head { font-size:15px; font-weight:700; color:#1A1A1A; margin-bottom:4px; }
.wof-step__body { font-size:14px; color:#666; line-height:1.6; }

/* ══ STATS BAND ══════════════════════════════════════════════════════════ */
.wof-stats { background:#0D0D0D; padding:48px 0; }
.wof-stats__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:24px; text-align:center; }
.wof-stat__num {
  font-family:var(--taas-font);
  font-size:clamp(40px,5vw,58px); font-weight:900;
  color:#FFC800; line-height:1; margin-bottom:6px;
}
.wof-stat__lbl { font-size:11px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#888; }

/* ══ 2026 RULES ══════════════════════════════════════════════════════════ */
.wof-rules { background:#F7F7F5; padding:var(--taas-sec-pad, 72px) 0; }
.wof-rules__eye { display:inline-block; background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); font-size:var(--taas-eye-size, 10px); font-weight:800; letter-spacing:.16em; text-transform:uppercase; padding:6px 14px; margin-bottom:16px; }
.wof-rules__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:12px;
}
.wof-rules__sub { font-size:17px; color:#666; margin-bottom:40px; max-width:600px; line-height:1.75; font-weight:300; letter-spacing:-0.1px; }
.wof-table-wrap { overflow-x:auto; }
.wof-table {
  width:100%; border-collapse:collapse;
  font-size:14px; background:#fff;
  border:1px solid #E8E8E4;
}
.wof-table thead th {
  background:#1A1A1A; color:#fff;
  font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
  padding:14px 16px; text-align:left;
  border-right:1px solid rgba(255,255,255,.08);
}
.wof-table thead th:first-child { color:#FFC800; }
.wof-table thead th:last-child { border-right:none; }
.wof-table tbody td {
  padding:13px 16px; border-bottom:1px solid #E8E8E4;
  border-right:1px solid #E8E8E4; color:#333; vertical-align:middle;
}
.wof-table tbody td:last-child { border-right:none; }
.wof-table tbody tr:last-child td { border-bottom:none; }
.wof-table tbody tr:nth-child(even) td { background:#F9F9F7; }
.wof-table tbody td:first-child { font-weight:600; color:#1A1A1A; }
.wof-table .tag-new { background:#FFC800; color:#1A1A1A; font-size:10px; font-weight:800; letter-spacing:.08em; padding:2px 8px; text-transform:uppercase; border-radius:2px; white-space:nowrap; }
.wof-table .tag-nc { background:#E8E8E4; color:#666; font-size:10px; font-weight:700; letter-spacing:.06em; padding:2px 8px; text-transform:uppercase; border-radius:2px; white-space:nowrap; }
.wof-rules__note { margin-top:20px; padding:16px 20px; background:#fff; border-left:3px solid #FFC800; font-size:14px; color:#555; line-height:1.6; }
.wof-rules__note strong { color:#1A1A1A; }

/* ══ BOOKING FORM ════════════════════════════════════════════════════════ */
.wof-book { background:#fff; padding:64px 0; }
.wof-book__grid { display:grid; grid-template-columns:1fr 380px; gap:56px; align-items:start; }
.wof-book__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:12px;
}
.wof-book__sub { font-size:17px; color:#666; line-height:1.75; font-weight:300; letter-spacing:-0.1px; margin-bottom:28px; }
.wof-book__info { display:flex; flex-direction:column; gap:16px; }
.wof-book__info-item { display:flex; gap:14px; align-items:flex-start; }
.wof-book__info-icon { width:40px; height:40px; background:#F7F7F5; border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.wof-book__info-icon svg { width:18px; height:18px; }
.wof-book__info-lbl { font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; margin-bottom:3px; }
.wof-book__info-val { font-size:15px; font-weight:600; color:#1A1A1A; }
.wof-book__info-val a { color:#FFC800; text-decoration:none; }
.wof-book__info-val a:hover { text-decoration:underline; }
.wof-map-link { color:#1A1A1A!important; text-decoration:none; }
.wof-map-link:hover { color:#FFC800!important; }

/* ══ WOF CHECKS ══════════════════════════════════════════════════════════ */
.wof-checks { background:#F7F7F5; padding:var(--taas-sec-pad, 72px) 0; }
.wof-checks__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A);
  text-align:center; margin-bottom:8px;
}
.wof-checks__sub { text-align:center; color:#666; font-size:16px; margin-bottom:40px; }
.wof-checks__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
.wof-check-card {
  background:#fff; border:1px solid #E8E8E4;
  padding:24px 20px; border-top:3px solid #E8E8E4;
  transition:border-color .18s;
}
.wof-check-card:hover { border-top-color:#FFC800; }
.wof-check-card__num { font-family:var(--taas-font); font-size:32px; font-weight:900; color:#E8E8E4; line-height:1; margin-bottom:8px; }
.wof-check-card__name { font-size:var(--taas-card-title, 16px); font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:6px; }
.wof-check-card__desc { font-size:var(--taas-card-desc, 14px); color:var(--taas-mid, #666); line-height:1.55; font-weight:400; }

/* ══ WHY TAAS / FINANCE ══════════════════════════════════════════════════ */
.wof-why { background:#1A1A1A; padding:var(--taas-sec-pad, 72px) 0; }
.wof-why__eye { display:inline-block; background:#FFC800; color:#1A1A1A; font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; padding:6px 14px; margin-bottom:16px; }
.wof-why__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:#fff; margin-bottom:36px;
}
.wof-why__grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.wof-why__card { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); padding:28px 24px; }
.wof-why__card-head { font-size:15px; font-weight:700; color:#FFC800; margin-bottom:10px; }
.wof-why__card-body { font-size:14px; color:#888; line-height:1.65; }

.wof-finance { background:#fff; padding:56px 0; border-top:1px solid #E8E8E4; }
.wof-finance__label { font-size:12px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#999; margin-bottom:16px; text-align:center; }
.wof-finance__logos { display:flex; align-items:center; justify-content:center; gap:32px; flex-wrap:wrap; }
.wof-finance__logo { font-size:13px; font-weight:700; color:#555; padding:8px 16px; border:1px solid #E8E8E4; border-radius:6px; text-decoration:none; transition:border-color .15s, color .15s; }
a.wof-finance__logo:hover { border-color:#FFC800; color:#1A1A1A; }

/* ══ SUBURBS ═════════════════════════════════════════════════════════════ */
.wof-suburbs { background:#F7F7F5; padding:64px 0; }
.wof-suburbs__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px;
}
.wof-suburbs__sub { font-size:15px; color:#666; margin-bottom:36px; }
.wof-suburbs__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
.wof-suburb-pill {
  display:flex; flex-direction:column;
  background:#fff; border:1px solid #E8E8E4;
  padding:16px 18px; text-decoration:none;
  transition:border-color .15s, background .15s;
}
.wof-suburb-pill:hover { border-color:#FFC800; background:#FFFBEB; }
.wof-suburb-pill__name { font-size:14px; font-weight:700; color:#1A1A1A; margin-bottom:3px; }
.wof-suburb-pill__dist { font-size:12px; color:#999; }

/* ══ CTA BAND ════════════════════════════════════════════════════════════ */
.wof-cta { background:#0D0D0D; padding:72px 0; text-align:center; }
.wof-cta__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:#fff; margin-bottom:8px;
}
.wof-cta__h2 span { color:#FFC800; }
.wof-cta__sub { font-size:16px; color:#999; margin-bottom:12px; }
.wof-cta__price { font-size:20px; font-weight:700; color:#FFC800; margin-bottom:32px; }
.wof-cta__btns { display:flex; gap:16px; justify-content:center; flex-wrap:wrap; }
.wof-cta__phone { font-family:var(--taas-font); font-size:var(--taas-cta-phone, 40px); font-weight:var(--taas-cta-phone-wt, 800); color:#FFC800; text-decoration:none; display:block; margin-bottom:24px; transition:opacity .15s; }
.wof-cta__phone:hover { opacity:.7; }

/* ══ FAQ ══════════════════════════════════════════════════════════════════ */
.wof-faq { background:#fff; padding:72px 0; }
.wof-faq__h2 {
  font-family:var(--taas-font);
  font-size:var(--taas-h2, clamp(26px,3.5vw,36px));
  font-weight:700; color:var(--taas-dark, #1A1A1A);
  text-align:center; margin-bottom:8px;
}
.wof-faq__h2 span { color:#FFC800; }
.wof-faq__sub { text-align:center; color:#666; font-size:16px; margin-bottom:48px; }
.wof-faq__list { max-width:800px; margin:0 auto; }
.wof-faq__item { border-bottom:1px solid #E8E8E4; }
.wof-faq__item:first-child { border-top:1px solid #E8E8E4; }
.wof-faq__q {
  width:100%; text-align:left; background:none; border:none;
  padding:20px 40px 20px 0; font-family:var(--taas-font);
  font-size:var(--taas-faq-q, 15px); font-weight:700; color:var(--taas-dark, #1A1A1A);
  cursor:pointer; position:relative; line-height:1.4;
}
.wof-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:24px; font-weight:300; color:#FFC800; }
.wof-faq__item.is-open .wof-faq__q::after { content:'−'; }
.wof-faq__a { display:none; padding:0 40px 20px 0; }
.wof-faq__item.is-open .wof-faq__a { display:block; }
.wof-faq__a p { font-size:15px; color:#666; line-height:1.75; margin:0; }
.wof-faq__a a { color:#FFC800; font-weight:600; text-decoration:none; }
.wof-faq__a a:hover { text-decoration:underline; }
.wof-faq__a strong { color:#1A1A1A; }

/* ══ AWARDS ══════════════════════════════════════════════════════════════ */
.wof-awards { background:#F7F7F5; padding:48px 0; border-top:1px solid #E8E8E4; }
.wof-awards__inner { display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap; }
.wof-awards__label { font-size:11px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#999; margin-bottom:12px; }
.wof-awards__list { display:flex; flex-wrap:wrap; gap:8px; }
.wof-award-pill { background:#fff; border:1px solid #E8E8E4; font-size:13px; font-weight:600; color:#333; padding:8px 14px; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .wof-hero__inner { grid-template-columns:1fr; }
  .wof-hero__card { display:none; }
  .wof-facts__grid { grid-template-columns:1fr; }
  .wof-book__grid { grid-template-columns:1fr; }
  .wof-checks__grid { grid-template-columns:repeat(2,1fr); }
  .wof-suburbs__grid { grid-template-columns:repeat(3,1fr); }
  .wof-why__grid { grid-template-columns:1fr 1fr; }
}
@media (max-width:640px) {
  /* Layout */
  .wof-stats__grid { grid-template-columns:repeat(2,1fr); }
  .wof-checks__grid { grid-template-columns:repeat(2,1fr); }
  .wof-suburbs__grid { grid-template-columns:repeat(2,1fr); }
  .wof-why__grid { grid-template-columns:1fr; }
  .wof-awards__inner { flex-direction:column; align-items:flex-start; }

  /* Section spacing */
  .wof-hero { padding:48px 0 40px; }
  .wof-facts { padding:48px 0; }
  .wof-stats { padding:36px 0; }
  .wof-rules { padding:48px 0; }
  .wof-book { padding:48px 0; }
  .wof-checks { padding:48px 0; }
  .wof-why { padding:48px 0; }
  .wof-suburbs { padding:48px 0; }
  .wof-cta { padding:48px 0; }
  .wof-faq { padding:48px 0; }
  .wof-finance { padding:40px 0; }

  /* Type scale */
  .wof-hero__h1 { font-size:clamp(30px, 8vw, 48px); }
  .wof-hero__sub { font-size:14px; margin-bottom:24px; }
  .wof-hero__price { font-size:11px; padding:6px 14px; }
  .wof-hero__ctas { flex-direction:column; align-items:stretch; }
  .wof-hero__ctas .wof-btn { justify-content:center; text-align:center; }
  .wof-btn { font-size:13px; padding:12px 20px; }
  .wof-facts__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-facts__body { font-size:14px; }
  .wof-checklist li { font-size:13px; gap:10px; }
  .wof-checklist li::before { width:18px; height:18px; }
  .wof-step__head { font-size:14px; }
  .wof-step__body { font-size:13px; }
  .wof-step__num { width:34px; height:34px; font-size:18px; }
  .wof-stat__num { font-size:clamp(30px, 8vw, 42px); }
  .wof-stat__lbl { font-size:10px; }
  .wof-rules__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-rules__sub { font-size:14px; }
  .wof-book__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-book__sub { font-size:14px; }
  .wof-checks__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-checks__sub { font-size:14px; }
  .wof-check-card__num { font-size:24px; }
  .wof-check-card__name { font-size:13px; }
  .wof-check-card__desc { font-size:12px; }
  .wof-check-card { padding:18px 16px; }
  .wof-why__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-why__card-head { font-size:14px; }
  .wof-why__card-body { font-size:13px; }
  .wof-suburbs__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-suburbs__sub { font-size:13px; }
  .wof-suburb-pill { padding:12px 14px; }
  .wof-suburb-pill__name { font-size:13px; }
  .wof-suburb-pill__dist { font-size:11px; }
  .wof-cta__h2 { font-size:clamp(24px, 6vw, 36px); }
  .wof-cta__sub { font-size:14px; }
  .wof-cta__price { font-size:16px; }
  .wof-cta__phone { font-size:28px; }
  .wof-cta__btns { flex-direction:column; align-items:stretch; }
  .wof-cta__btns .wof-btn { justify-content:center; text-align:center; }
  .wof-faq__h2 { font-size:clamp(22px, 6vw, 32px); }
  .wof-faq__sub { font-size:14px; margin-bottom:32px; }
  .wof-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .wof-faq__a p { font-size:13px; }

  /* Phone strip */
  .wof-pstrip__inner { flex-direction:column; text-align:center; gap:6px; }
  .wof-pstrip__left { flex-direction:column; gap:4px; }
  .wof-pstrip__lbl { display:none; }
  .wof-pstrip__num { font-size:22px; }
  .wof-pstrip__hours { font-size:12px; }
  .wof-pstrip__walkin { font-size:12px; }

  /* Table scroll hint */
  .wof-table { font-size:13px; }

  /* Table → stacked cards on mobile */
  .wof-table thead { display:none; }
  .wof-table, .wof-table tbody, .wof-table tr, .wof-table td { display:block; width:100%; }
  .wof-table { border:none; }
  .wof-table tr { padding:16px; border-bottom:1px solid #E8E8E4; }
  .wof-table tr:last-child { border-bottom:none; }
  .wof-table tbody td { padding:3px 0; border:none; border-right:none; }
  .wof-table tbody td:first-child { font-size:14px; font-weight:700; color:#1A1A1A; margin-bottom:6px; }
  .wof-table tbody td:nth-child(2) { font-size:12px; color:#999; }
  .wof-table tbody td:nth-child(2)::before { content:'Current: '; font-weight:600; color:#666; }
  .wof-table tbody td:nth-child(3)::before { content:'From Nov 2026: '; font-weight:600; color:#666; font-size:12px; }
  .wof-table tbody td:nth-child(3) { font-size:13px; margin-top:4px; }
  .wof-table tbody tr:nth-child(even) td { background:transparent; }
}
</style>


<!-- ══ HERO ══════════════════════════════════════════════════════════════ -->
<section class="wof-hero" aria-label="WOF Manukau hero">
  <div class="wof-w">
    <div class="wof-hero__inner">
      <div>
        <div class="wof-hero__eye">
          <div class="wof-hero__line"></div>
          <span class="wof-hero__eye-txt">NZTA Authorised — Manukau</span>
        </div>
        <h1 class="wof-hero__h1">
          WOF Inspection Manukau<br>
          <span><?php echo esc_html($wof_price); ?> Flat Rate — All Makes &amp; Models</span>
        </h1>
        <div class="wof-hero__price">Walk-ins welcome mornings · Mon–Fri 7:30am–5:00pm</div>
        <p class="wof-hero__sub">Warrant of Fitness (WOF) inspections in Manukau, NZTA-authorised, at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:underline;">139 Cavendish Drive</a>. One fixed price for every vehicle, and if it doesn't pass first time, the re-inspection within 28 days is free.</p>
        <div class="wof-hero__ctas">
          <a href="#wof-book" class="wof-btn wof-btn--yellow">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            Book My WOF — <?php echo esc_html($wof_price); ?>
          </a>
          <a href="tel:<?php echo preg_replace('/\s+/','',$phone_free); ?>" class="wof-btn wof-btn--outline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <?php echo esc_html($phone_free); ?>
          </a>
        </div>
      </div>

      <div class="wof-hero__card" aria-hidden="true">
        <div class="wof-hero__card-title">What to expect</div>
        <div class="wof-card-item">
          <div class="wof-card-icon"><svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg></div>
          <div>
            <div class="wof-card-label">Inspection time</div>
            <div class="wof-card-val">30–45 minutes</div>
          </div>
        </div>
        <div class="wof-card-item">
          <div class="wof-card-icon"><svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg></div>
          <div>
            <div class="wof-card-label">Fixed price</div>
            <div class="wof-card-val"><?php echo esc_html($wof_price); ?> incl. GST · All vehicles</div>
          </div>
        </div>
        <div class="wof-card-item">
          <div class="wof-card-icon"><svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg></div>
          <div>
            <div class="wof-card-label">If you fail</div>
            <div class="wof-card-val">Free re-inspection within 28 days</div>
          </div>
        </div>
        <div class="wof-card-item">
          <div class="wof-card-icon"><svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>
          <div>
            <div class="wof-card-label">Location</div>
            <div class="wof-card-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#fff;text-decoration:underline;">139 Cavendish Drive, Manukau</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ════════════════════════════════════════════════════════ -->
<div class="wof-pstrip" role="complementary" aria-label="Contact details">
  <div class="wof-w">
    <div class="wof-pstrip__inner">
      <div class="wof-pstrip__left">
        <span class="wof-pstrip__lbl">Call us</span>
        <a href="tel:<?php echo preg_replace('/\s+/','',$phone_free); ?>" class="wof-pstrip__num"><?php echo esc_html($phone_free); ?></a>
        <span class="wof-pstrip__hours">Mon–Fri 7:30am–5:00pm</span>
      </div>
      <span class="wof-pstrip__walkin">Walk-ins welcome mornings · Bookings recommended</span>
    </div>
  </div>
</div>


<!-- ══ KEY FACTS ═════════════════════════════════════════════════════════ -->
<section class="wof-facts" aria-labelledby="wof-facts-head">
  <div class="wof-w">
    <div class="wof-facts__grid">
      <div>
        <h2 class="wof-facts__h2" id="wof-facts-head">South Auckland's <span>WOF Specialists</span><br>Since <?php echo esc_html($established); ?></h2>
        <p class="wof-facts__body">Tony Allen Auto Service has been carrying out NZTA-authorised Warrant of Fitness inspections in Manukau since 1985. We are a family-owned independent workshop with a dedicated WOF inspection bay and a team of qualified technicians.</p>
        <p class="wof-facts__body">We operate seven specialist divisions under one roof. If your vehicle fails its WOF — whether it needs brakes, tyres, suspension, or electrical work — we can often carry out repairs on the same visit, depending on the work required and parts availability. No referrals. No second booking needed in many cases.</p>
        <ul class="wof-checklist">
          <li>NZTA Authorised — <?php echo esc_html($ms_number); ?></li>
          <li>MTA Assured — independently assessed quality standard</li>
          <li>Dedicated WOF inspection bay</li>
          <li><?php echo esc_html($wof_price); ?> flat rate — all makes, all models, incl. GST</li>
          <li>Written repair estimate before any work begins</li>
          <li>Free re-inspection within 28 days</li>
          <li>Repairs often carried out on the same visit — subject to work required and parts</li>
          <li>Free Wi-Fi and coffee in customer lounge while you wait</li>
        </ul>
      </div>

      <div>
        <div class="wof-steps">
          <div class="wof-step">
            <div class="wof-step__num">1</div>
            <div>
              <div class="wof-step__head">Drive in or book ahead</div>
              <div class="wof-step__body">Walk-ins welcome mornings, Monday to Friday. Afternoons fill quickly, so booking ahead is recommended. Call <?php echo esc_html($phone_free); ?> to secure a time.</div>
            </div>
          </div>
          <div class="wof-step">
            <div class="wof-step__num">2</div>
            <div>
              <div class="wof-step__head">Inspection in 30–45 minutes</div>
              <div class="wof-step__body">Relax in our customer lounge with free Wi-Fi and a coffee. You can watch through the window as your vehicle goes through the inspection bay.</div>
            </div>
          </div>
          <div class="wof-step">
            <div class="wof-step__num">3</div>
            <div>
              <div class="wof-step__head">Pass or full written report</div>
              <div class="wof-step__body">If your vehicle passes, we issue the WOF. If it fails, you get a written repair estimate before we touch anything. Your choice whether to proceed.</div>
            </div>
          </div>
          <div class="wof-step">
            <div class="wof-step__num">4</div>
            <div>
              <div class="wof-step__head">Free re-inspection within 28 days</div>
              <div class="wof-step__body">The re-inspection is free within 28 days. You can have the repairs done here, somewhere else, or do them yourself &mdash; the recheck is free either way. Where possible, repairs are completed on the same visit &mdash; subject to the work required and parts availability.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ STATS BAND ═════════════════════════════════════════════════════════ -->
<section class="wof-stats" aria-label="Trust statistics">
  <div class="wof-w">
    <div class="wof-stats__grid">
      <div>
        <div class="wof-stat__num"><?php echo esc_html($years); ?></div>
        <div class="wof-stat__lbl">Years doing WOFs in Manukau</div>
      </div>
      <div>
        <div class="wof-stat__num"><?php echo esc_html($wof_price); ?></div>
        <div class="wof-stat__lbl">Flat rate · All vehicles</div>
      </div>
      <div>
        <div class="wof-stat__num"><?php echo esc_html($reviews); ?></div>
        <div class="wof-stat__lbl">Google reviews · <?php echo esc_html($rating); ?>★ average</div>
      </div>
      <div>
        <div class="wof-stat__num">28</div>
        <div class="wof-stat__lbl">Days free re-inspection window</div>
      </div>
    </div>
  </div>
</section>


<!-- ══ 2026 RULE CHANGES ══════════════════════════════════════════════════ -->
<section class="wof-rules" aria-labelledby="wof-rules-head">
  <div class="wof-w">
    <div class="wof-rules__eye">Updated — 2026 Rule Changes</div>
    <h2 class="wof-rules__h2" id="wof-rules-head">New WOF Frequency Rules<br>from 1 November 2026</h2>
    <p class="wof-rules__sub">The New Zealand Government has confirmed changes to WOF inspection frequency. Here's a plain-English summary for South Auckland drivers.</p>
    <div class="wof-table-wrap">
      <table class="wof-table">
        <thead>
          <tr>
            <th>Your vehicle</th>
            <th>Current rule</th>
            <th>From 1 Nov 2026</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>New vehicle — first WOF</td>
            <td>WOF at 3 years</td>
            <td><span class="tag-new">WOF at 4 years</span></td>
          </tr>
          <tr>
            <td>4–14 years (registered from Nov 2019)</td>
            <td>Annual WOF</td>
            <td><span class="tag-new">Every 2 years</span></td>
          </tr>
          <tr>
            <td>4–14 years (registered from Nov 2013)</td>
            <td>Annual WOF</td>
            <td><span class="tag-new">Every 2 years from Nov 2027</span></td>
          </tr>
          <tr>
            <td>Over 14 years old</td>
            <td>Annual WOF</td>
            <td><span class="tag-nc">Annual — no change</span></td>
          </tr>
          <tr>
            <td>Pre-2000 vehicles</td>
            <td>6-monthly WOF</td>
            <td><span class="tag-new">Annual WOF</span></td>
          </tr>
          <tr>
            <td>Light rental vehicles</td>
            <td>6-monthly</td>
            <td><span class="tag-new">Annual from Nov 2026</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="wof-rules__note">
      <strong>Important for South Auckland:</strong> A large proportion of the South Auckland vehicle fleet is over 14 years old — these vehicles remain on annual WOFs with no change. Not sure which category your vehicle falls into? Call us on <a href="tel:<?php echo preg_replace('/\s+/','',$phone_free); ?>" style="color:#1A1A1A;font-weight:700;"><?php echo esc_html($phone_free); ?></a> and we'll check for you. WOF fines also increase from 1 November 2026 — driving with a WOF expired by more than two months will be <strong>$350</strong> (up from $200).
    </div>
  </div>
</section>


<!-- ══ BOOKING FORM ═══════════════════════════════════════════════════════ -->
<section class="wof-book" id="wof-book" aria-labelledby="wof-book-head">
  <div class="wof-w">
    <div class="wof-book__grid">
      <div>
        <h2 class="wof-book__h2" id="wof-book-head">Book Your <span style="color:#FFC800">WOF</span></h2>
        <p class="wof-book__sub">Fill in your details and we'll confirm a time. Walk-ins welcome mornings, Monday to Friday — booking recommended for afternoons.</p>
        <?php echo do_shortcode($cf7_wof); ?>
      </div>
      <div class="wof-book__info">
        <div class="wof-book__info-item">
          <div class="wof-book__info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
          </div>
          <div>
            <div class="wof-book__info-lbl">Address</div>
            <div class="wof-book__info-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" class="wof-map-link">139 Cavendish Drive<br>Manukau, Auckland 2104</a></div>
          </div>
        </div>
        <div class="wof-book__info-item">
          <div class="wof-book__info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.09 6.09l1.77-1.77a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div>
            <div class="wof-book__info-lbl">Freephone</div>
            <div class="wof-book__info-val"><a href="tel:<?php echo preg_replace('/\s+/','',$phone_free); ?>"><?php echo esc_html($phone_free); ?></a></div>
          </div>
        </div>
        <div class="wof-book__info-item">
          <div class="wof-book__info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div>
            <div class="wof-book__info-lbl">Hours</div>
            <div class="wof-book__info-val">Mon–Fri 7:30am–5:00pm<br><span style="color:#999;font-size:13px;">Saturday &amp; Sunday: Closed</span></div>
          </div>
        </div>
        <div class="wof-book__info-item">
          <div class="wof-book__info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          </div>
          <div>
            <div class="wof-book__info-lbl">Walk-ins</div>
            <div class="wof-book__info-val">Welcome mornings<br><span style="color:#999;font-size:13px;">Booking recommended for afternoons</span></div>
          </div>
        </div>
        <div class="wof-book__info-item">
          <div class="wof-book__info-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <div>
            <div class="wof-book__info-lbl">Free reminder service</div>
            <div class="wof-book__info-val">We'll email or text when your WOF is due — ask us to add you</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ WOF CHECKS ═════════════════════════════════════════════════════════ -->
<section class="wof-checks" aria-labelledby="wof-checks-head">
  <div class="wof-w">
    <h2 class="wof-checks__h2" id="wof-checks-head">What We Check in a <span style="color:#FFC800">NZ WOF</span></h2>
    <p class="wof-checks__sub">12 mandatory safety areas as required by NZTA. Updated for 2026.</p>
    <div class="wof-checks__grid">
      <?php
      $checks = [
        ['01','Tyres','Tread depth minimum 1.5mm, sidewall condition, correct size and rating'],
        ['02','Brakes','Brake lines, pads, discs, handbrake function and balance'],
        ['03','Steering & Suspension','Steering play, ball joints, shock absorbers, CV joints'],
        ['04','Lights & Indicators','All exterior lights, brake lights, hazards, number plate light'],
        ['05','Windscreen & Wipers','Cracks in driver sightline, wiper blade condition and wash function'],
        ['06','Seatbelts','All belts present, anchored, locking and retracting correctly'],
        ['07','Body & Structure','Rust, panel damage, sharp edges, towbar condition'],
        ['08','Exhaust','Leaks, security, excessive smoke or noise'],
        ['09','Fuel System','No fuel leaks, cap sealing correctly'],
        ['10','Doors & Glazing','All doors open, close and latch. Glazing condition.'],
        ['11','Speedometer','Functioning and accurately calibrated'],
        ['12','ADAS (from 2026)','Safety system warning lights — new requirement from November 2026'],
      ];
      foreach($checks as $c): ?>
      <div class="wof-check-card">
        <div class="wof-check-card__num"><?php echo esc_html($c[0]); ?></div>
        <div class="wof-check-card__name"><?php echo esc_html($c[1]); ?></div>
        <div class="wof-check-card__desc"><?php echo esc_html($c[2]); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ WHY TAAS ═══════════════════════════════════════════════════════════ -->
<section class="wof-why" aria-labelledby="wof-why-head">
  <div class="wof-w">
    <div class="wof-why__eye">Family-owned since <?php echo esc_html($established); ?></div>
    <h2 class="wof-why__h2" id="wof-why-head"><?php echo esc_html($years); ?> Years at the Same Address.</h2>
    <div class="wof-why__grid">
      <div class="wof-why__card">
        <div class="wof-why__card-head">Written estimate — always</div>
        <div class="wof-why__card-body">If your vehicle fails, you get a written repair estimate before we touch anything. No obligation to proceed. No surprises.</div>
      </div>
      <div class="wof-why__card">
        <div class="wof-why__card-head">Repairs where possible on the day</div>
        <div class="wof-why__card-body">Seven specialist divisions under one roof — brakes, tyres, suspension, electrics. Where the work and parts allow, we aim to have repairs done on the same visit. We'll always tell you upfront what's possible.</div>
      </div>
      <div class="wof-why__card">
        <div class="wof-why__card-head">Free re-inspection</div>
        <div class="wof-why__card-body">Re-inspection is free within 28 days &mdash; even if you get the repairs done somewhere else. No questions asked.</div>
      </div>
      <div class="wof-why__card">
        <div class="wof-why__card-head">Calibrated equipment</div>
        <div class="wof-why__card-body">We use regularly calibrated, fully certified testing equipment — the same standard required by NZTA. The inspection is the inspection.</div>
      </div>
      <div class="wof-why__card">
        <div class="wof-why__card-head">Free reminder service</div>
        <div class="wof-why__card-body">We'll email or text when your WOF is due. Ask us to add you at your next visit. You'll never miss an expiry again.</div>
      </div>
      <div class="wof-why__card">
        <div class="wof-why__card-head"><?php echo esc_html($reviews); ?> reviews · <?php echo esc_html($rating); ?>★</div>
        <div class="wof-why__card-body">Real customers, real reviews on Google. MTA Assured — independently assessed. MTA Best General Repairer South Auckland 2010.</div>
      </div>
    </div>
  </div>
</section>


<!-- ══ CTA BAND ═══════════════════════════════════════════════════════════ -->
<section class="wof-cta" aria-label="Book your WOF">
  <div class="wof-w">
    <h2 class="wof-cta__h2">Ready for your <span>WOF</span><br>in Manukau?</h2>
    <p class="wof-cta__sub">Walk-ins welcome mornings, Monday to Friday. Book ahead for afternoons.</p>
    <div class="wof-cta__price"><?php echo esc_html($wof_price); ?> flat rate · All makes &amp; models · NZTA Authorised</div>
    <a href="tel:<?php echo preg_replace('/\s+/','',$phone_free); ?>" class="wof-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="wof-cta__btns">
      <a href="#wof-book" class="wof-btn wof-btn--yellow">Book My WOF — <?php echo esc_html($wof_price); ?></a>
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="wof-btn wof-btn--outline">Send Enquiry</a>
    </div>
  </div>
</section>


<!-- ══ FINANCE ════════════════════════════════════════════════════════════ -->
<section class="wof-finance" aria-label="Finance options">
  <div class="wof-w">
    <div class="wof-finance__label">Spread the cost — finance available for repairs after your WOF</div>
    <div class="wof-finance__logos">
      <a href="<?php echo esc_url(home_url('/afterpay-car-repairs/')); ?>" class="wof-finance__logo">Afterpay</a>
      <a href="<?php echo esc_url(home_url('/qcard-car-repairs/')); ?>" class="wof-finance__logo">Q Card</a>
      <a href="<?php echo esc_url(home_url('/gem-finance-car-repairs/')); ?>" class="wof-finance__logo">Gem Finance</a>
      <a href="<?php echo esc_url(home_url('/aotea-finance-car-repairs/')); ?>" class="wof-finance__logo">Aotea Finance</a>
    </div>
  </div>
</section>


<!-- ══ SUBURB SPOKES ══════════════════════════════════════════════════════ -->
<section class="wof-suburbs" aria-labelledby="wof-suburbs-head">
  <div class="wof-w">
    <h2 class="wof-suburbs__h2" id="wof-suburbs-head">WOF Near Me — South Auckland</h2>
    <p class="wof-suburbs__sub">We serve drivers from across South Auckland from our workshop at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>. Select your suburb for local WOF information and directions.</p>
    <div class="wof-suburbs__grid">
      <?php
      $suburbs = [
        ['Manukau','On site — we are here','/wof-inspection-manukau/'],
        ['Papatoetoe','~5 min via Great South Rd','/wof-inspection-papatoetoe/'],
        ['Māngere','~10 min from town centre','/wof-inspection-mangere/'],
        ['Māngere Bridge','~10–12 min via Massey Rd','/wof-inspection-mangere-bridge/'],
        ['Ōtāhuhu','~10 min via Great South Rd','/wof-inspection-otahuhu/'],
        ['Wiri','On the doorstep of Wiri industrial','/wof-inspection-wiri/'],
        ['Ōtara','~10 min via Great South Rd','/wof-inspection-otara/'],
        ['Hunters Corner','~5 min from shops','/wof-inspection-hunters-corner/'],
        ['Clover Park','~10 min via Chapel Rd','/wof-inspection-clover-park/'],
        ['Flat Bush','~10–15 min via Ormiston Rd','/wof-inspection-flat-bush/'],
        ['Botany','~15–20 min via Ti Rakau Dr','/wof-inspection-botany/'],
        ['Manurewa','~10–15 min via Great South Rd','/wof-inspection-manurewa/'],
        ['Clendon','~15 min via Great South Rd','/wof-inspection-clendon/'],
        ['Weymouth','~15 min via Weymouth Rd','/wof-inspection-weymouth/'],
        ['Takanini','~15–20 min via Great South Rd','/wof-inspection-takanini/'],
        ['Papakura','~20 min via Great South Rd','/wof-inspection-papakura/'],
        ['Howick','~20–25 min via South-Eastern Hwy','/wof-inspection-howick/'],
      ];
      foreach($suburbs as $s): ?>
      <a href="<?php echo esc_url(home_url($s[2])); ?>" class="wof-suburb-pill">
        <span class="wof-suburb-pill__name"><?php echo esc_html($s[0]); ?></span>
        <span class="wof-suburb-pill__dist"><?php echo esc_html($s[1]); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ FAQ ════════════════════════════════════════════════════════════════ -->
<section class="wof-faq" aria-labelledby="wof-faq-head">
  <div class="wof-w">
    <h2 class="wof-faq__h2" id="wof-faq-head">WOF Questions <span>Answered</span></h2>
    <p class="wof-faq__sub">Updated for the 2026 rule changes. Answers reflect current NZTA requirements.</p>
    <div class="wof-faq__list">
      <?php foreach ($wof_faqs as $fi => $faq): ?>
      <div class="wof-faq__item<?php echo $fi === 0 ? ' is-open' : ''; ?>">
        <button class="wof-faq__q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="wof-faq__a">
          <p><?php echo wp_kses_post($faq['a']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ AWARDS ═════════════════════════════════════════════════════════════ -->
<section class="wof-awards" aria-label="Industry recognition">
  <div class="wof-w">
    <div class="wof-awards__inner">
      <div>
        <div class="wof-awards__label">Industry recognition</div>
        <div class="wof-awards__list">
          <span class="wof-award-pill">🏆 MTA Best General Repairer — South Auckland 2010</span>
          <span class="wof-award-pill">MTA Awards Finalist 2012</span>
          <span class="wof-award-pill">MTA Awards Finalist 2014</span>
          <span class="wof-award-pill">2 Degrees Business Awards Nominee 2026</span>
        </div>
      </div>
      <div>
        <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured — Motor Trade Association member" style="height:70px;width:auto;" loading="lazy">
      </div>
    </div>
  </div>
</section>

</div><!-- /.taas-wof -->

<script>
(function(){
  document.querySelectorAll('.wof-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.wof-faq__item');
      var isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.wof-faq__item').forEach(function(i){
        i.classList.remove('is-open');
        i.querySelector('.wof-faq__q').setAttribute('aria-expanded','false');
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
