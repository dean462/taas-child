<?php
/**
 * Template Name: Vehicle Servicing Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /vehicle-servicing/
 * CSS namespace: .vs-
 * Rebuilt: July 2026 — Essential/Standard/Premium tiers, 5 vehicle categories, 14-step workflow
 *
 * Section order (Go-Live Standard):
 * Hero → Phone Strip → Trust → Symptoms → Tiers → Pricing Table → Finance → 14-Step Workflow →
 * Why Matters → Specialist → Dealer → Enquiry → Reviews → Related → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url      = get_site_url();
$page_url      = get_permalink();
$established   = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years_trading = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$euro_brands   = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$customers     = defined('TAAS_CUSTOMERS')   ? TAAS_CUSTOMERS   : '10,000+';
$phone_free    = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free_tel= str_replace(' ', '', $phone_free);
$phone_local_tel= str_replace(' ', '', $phone_local);
$address       = defined('TAAS_ADDRESS') ? TAAS_ADDRESS : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS') ? TAAS_HOURS : 'Monday–Friday 7:30am–5:00pm';
$email         = defined('TAAS_EMAIL') ? TAAS_EMAIL : 'enquiries@taas.co.nz';
$rating        = defined('TAAS_RATING') ? TAAS_RATING : '4.2';
$reviews       = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$cf7_general   = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';

// ── Tier pricing — Car category shown on cards, "from" framing ──
$ess_car  = defined('TAAS_SVC_ESS_CAR')  ? TAAS_SVC_ESS_CAR  : '$229';
$std_car  = defined('TAAS_SVC_STD_CAR')  ? TAAS_SVC_STD_CAR  : '$329';
$prem_car = defined('TAAS_SVC_PREM_CAR') ? TAAS_SVC_PREM_CAR : '$429';

// ── Vehicle category pricing grid ──
$pricing_grid = [
    ['cat' => 'Car',                'sub' => 'Up to 5L — Corolla, Mazda 3, Swift, i30',
     'ess' => defined('TAAS_SVC_ESS_CAR')    ? TAAS_SVC_ESS_CAR    : '$229',
     'std' => defined('TAAS_SVC_STD_CAR')    ? TAAS_SVC_STD_CAR    : '$329',
     'prem'=> defined('TAAS_SVC_PREM_CAR')   ? TAAS_SVC_PREM_CAR   : '$429'],
    ['cat' => 'SUV / V6',           'sub' => '5–7L — RAV4, CX-5, Highlander, Outlander',
     'ess' => defined('TAAS_SVC_ESS_SUV')    ? TAAS_SVC_ESS_SUV    : '$269',
     'std' => defined('TAAS_SVC_STD_SUV')    ? TAAS_SVC_STD_SUV    : '$369',
     'prem'=> defined('TAAS_SVC_PREM_SUV')   ? TAAS_SVC_PREM_SUV   : '$469'],
    ['cat' => 'Ute / V8',           'sub' => '7L+ — Hilux, Ranger, Navara, Mustang',
     'ess' => defined('TAAS_SVC_ESS_UTE')    ? TAAS_SVC_ESS_UTE    : '$319',
     'std' => defined('TAAS_SVC_STD_UTE')    ? TAAS_SVC_STD_UTE    : '$419',
     'prem'=> defined('TAAS_SVC_PREM_UTE')   ? TAAS_SVC_PREM_UTE   : '$519'],
    ['cat' => 'European Standard',   'sub' => 'Spec oil 4-cyl — Golf, A3, Octavia, 320i',
     'ess' => defined('TAAS_SVC_ESS_EUROS')  ? TAAS_SVC_ESS_EUROS  : '$259',
     'std' => defined('TAAS_SVC_STD_EUROS')  ? TAAS_SVC_STD_EUROS  : '$359',
     'prem'=> defined('TAAS_SVC_PREM_EUROS') ? TAAS_SVC_PREM_EUROS : '$459'],
    ['cat' => 'European Performance','sub' => '6L+ spec — AMG, M-Power, RS, Porsche',
     'ess' => defined('TAAS_SVC_ESS_EUROP')  ? TAAS_SVC_ESS_EUROP  : '$349',
     'std' => defined('TAAS_SVC_STD_EUROP')  ? TAAS_SVC_STD_EUROP  : '$449',
     'prem'=> defined('TAAS_SVC_PREM_EUROP') ? TAAS_SVC_PREM_EUROP : '$549'],
];

// ── Hero image ──
$hero_image = defined('TAAS_HERO_SERVICING') ? TAAS_HERO_SERVICING
            : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');

// ── FAQ — from shared library ────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-faqs.php';
$faqs = [
    $taas_faqs['service_cost'],
    $taas_faqs['svc_which_tier'],
    $taas_faqs['service_included'],
    $taas_faqs['service_frequency'],
    $taas_faqs['svc_dealer'],
    $taas_faqs['logbook'],
    $taas_faqs['svc_hybrid'],
    $taas_faqs['svc_european'],
    $taas_faqs['svc_diesel'],
    $taas_faqs['svc_price_vary'],
    $taas_faqs['svc_additional_work'],
    $taas_faqs['svc_booking'],
    $taas_faqs['svc_finance'],
    $taas_faqs['location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => ['AutoRepair', 'LocalBusiness'],
            '@id'         => $site_url . '/#organization',
            'name'        => 'Tony Allen Auto Service',
            'url'         => $site_url,
            'description' => 'Car servicing in Manukau, South Auckland. Essential, Standard and Premium services for all makes and models — Japanese, European, diesel, hybrid and EV. MTA Assured, ' . $years_trading . ' years trading.',
            'telephone'   => [TAAS_PHONE_LOCAL, TAAS_PHONE_FREE],
            'email'       => TAAS_EMAIL,
            'address'     => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive',
                              'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland',
                              'postalCode' => '2104', 'addressCountry' => 'NZ'],
            'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
            'foundingDate'=> '1985-10',
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
                'opens' => '07:30', 'closes' => '17:00']],
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating,
                                  'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'],
            'sameAs'         => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'paymentAccepted'=> 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'priceRange'     => '$$',
            'areaServed'     => 'South Auckland',
            'memberOf'       => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.vs-hero__sub', '.vs-faq__a:first-of-type p']],
        [
            '@type'       => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Vehicle Servicing', 'item' => $page_url],
            ],
        ],
        [
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(function($f) {
                return ['@type' => 'Question', 'name' => $f['q'],
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($f['a'])]];
            }, $faqs),
        ],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ══ RESET ════════════════════════════════════════════════════════════════ */
.page-template-template-vehicle-servicing .site-content,
.page-template-template-vehicle-servicing .entry-content,
.page-template-template-vehicle-servicing .entry-header,
.page-template-template-vehicle-servicing article,
.page-template-template-vehicle-servicing #primary,
.page-template-template-vehicle-servicing #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-vehicle-servicing { overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
.taas-vs *, .taas-vs *::before, .taas-vs *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-vs { font-family:var(--taas-font,'Inter',Arial,sans-serif); -webkit-font-smoothing:antialiased; }

/* ══ LAYOUT ══════════════════════════════════════════════════════════════ */
.vs-w { max-width:var(--taas-container,1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ══════════════════════════════════════════════════════════ */
.vs-bc { background:var(--taas-black,#111111); padding:14px 0 0; }
.vs-bc__list { list-style:none; display:flex; gap:6px; align-items:center; font-size:12px; color:#666; }
.vs-bc__list a { color:#888; text-decoration:none; }
.vs-bc__list a:hover { color:var(--taas-yellow,#FFC800); }
.vs-bc__sep { color:#444; }
.vs-bc__current { color:#aaa; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.vs-hero { background:var(--taas-black,#111111); padding:0 0 60px; position:relative; }
.vs-hero--has-image { background-size:cover; background-position:center 40%; }
.vs-hero--has-image::before { content:''; position:absolute; inset:0; background:rgba(13,13,13,0.82); }
.vs-hero__inner { position:relative; z-index:1; display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:start; padding-top:32px; }
.vs-hero__eyebrow { display:inline-block; background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:5px 14px; border-radius:3px; margin-bottom:20px; }
.vs-hero h1 { font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px)); font-weight:800; color:#fff; letter-spacing:-0.02em; line-height:1.1; margin-bottom:16px; }
.vs-hero h1 span { color:var(--taas-yellow,#FFC800); }
.vs-hero__sub { font-size:16px; font-weight:300; color:#aaa; max-width:540px; margin-bottom:28px; line-height:1.75; }
.vs-hero__ctas { display:flex; gap:12px; flex-wrap:wrap; }

/* ── Sidebar card ── */
.vs-sidebar { background:#1e1e1e; border:1px solid #333; border-radius:var(--taas-radius,6px); padding:24px; }
.vs-sidebar__title { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:14px; }
.vs-sidebar__list { list-style:none; display:flex; flex-direction:column; gap:8px; margin-bottom:20px; }
.vs-sidebar__list li { font-size:13px; color:#ccc; padding-left:18px; position:relative; line-height:1.4; font-weight:300; }
.vs-sidebar__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.vs-sidebar hr { border:none; border-top:1px solid #333; margin-bottom:16px; }
.vs-sidebar__phone { display:block; font-size:22px; font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-bottom:4px; line-height:1.1; }
.vs-sidebar__phone:hover { opacity:.65; }
.vs-sidebar__detail { font-size:12px; color:#666; line-height:1.6; font-weight:300; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════ */
.vs-pstrip { background:var(--taas-yellow,#FFC800); padding:18px 0; }
.vs-pstrip__inner { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.vs-pstrip__left { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.vs-pstrip__lbl { font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; color:var(--taas-dark,#1A1A1A); }
.vs-pstrip__num { font-size:28px; font-weight:900; color:var(--taas-dark,#1A1A1A); text-decoration:none; }
.vs-pstrip__num:hover { opacity:.65; }
.vs-pstrip__hours { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); opacity:.75; }
.vs-pstrip__email { display:inline-flex; align-items:center; gap:6px; background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); font-size:13px; font-weight:600; padding:8px 16px; border-radius:var(--taas-radius,6px); text-decoration:none; transition:background .15s; }
.vs-pstrip__email:hover { background:#333; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════ */
.vs-trust { background:var(--taas-panel,#F7F7F5); padding:16px 0; border-bottom:1px solid var(--taas-border,#E8E8E4); }
.vs-trust__inner { display:flex; gap:32px; align-items:center; justify-content:center; flex-wrap:wrap; }
.vs-trust__item { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); display:flex; align-items:center; gap:7px; white-space:nowrap; }
.vs-trust__item::before { content:'✓'; font-weight:900; color:var(--taas-yellow,#FFC800); }

/* ══ SYMPTOM CARDS ═══════════════════════════════════════════════════════ */
.vs-symptoms { background:var(--taas-white,#FFFFFF); padding:48px 0; }
.vs-symptoms__heading { font-size:var(--taas-h2,clamp(26px,3.5vw,36px)); font-weight:700; color:var(--taas-black,#111111); letter-spacing:-0.01em; margin-bottom:8px; }
.vs-symptoms__sub { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); margin-bottom:28px; line-height:1.75; }
.vs-symptoms__grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; }
.vs-symptom { display:flex; align-items:center; gap:12px; padding:16px 18px; background:var(--taas-panel,#F7F7F5); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); text-decoration:none; transition:border-color .15s,transform .15s; }
.vs-symptom:hover { border-color:var(--taas-yellow,#FFC800); transform:translateY(-2px); }
.vs-symptom__icon { width:36px; height:36px; background:var(--taas-dark,#1A1A1A); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.vs-symptom__icon svg { width:18px; height:18px; fill:var(--taas-yellow,#FFC800); }
.vs-symptom__icon--red { background:#C0392B; }
.vs-symptom__icon--red svg { fill:#fff; }
.vs-symptom__text { font-size:14px; font-weight:600; color:var(--taas-black,#111111); line-height:1.3; }
.vs-symptom__arrow { margin-left:auto; color:var(--taas-yellow,#FFC800); font-size:16px; flex-shrink:0; }

/* ══ SECTIONS ════════════════════════════════════════════════════════════ */
.vs-section { padding:var(--taas-sec-pad,72px) 0; }
.vs-section--white { background:var(--taas-white,#FFFFFF); }
.vs-section--grey  { background:var(--taas-panel,#F7F7F5); }
.vs-section--dark  { background:var(--taas-dark,#1A1A1A); }
.vs-section__eyebrow { display:inline-block; background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.vs-section--dark .vs-section__eyebrow { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.vs-section__heading { font-size:var(--taas-h2,clamp(26px,3.5vw,36px)); font-weight:700; color:var(--taas-black,#111111); letter-spacing:-0.01em; margin-bottom:12px; }
.vs-section--dark .vs-section__heading { color:var(--taas-white,#FFFFFF); }
.vs-section__sub { font-size:16px; font-weight:300; color:var(--taas-mid,#666666); max-width:640px; margin-bottom:36px; line-height:1.75; }
.vs-section--dark .vs-section__sub { color:#aaa; }

/* ══ TIER CARDS ══════════════════════════════════════════════════════════ */
.vs-tiers { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.vs-tier { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:32px 28px; display:flex; flex-direction:column; position:relative; transition:box-shadow .2s,transform .2s; }
.vs-tier:hover { box-shadow:0 8px 24px rgba(0,0,0,.08); transform:translateY(-3px); }
.vs-tier--featured { border-color:var(--taas-yellow,#FFC800); border-width:2px; }
.vs-tier--featured::before { content:'Most Popular'; position:absolute; top:-13px; left:50%; transform:translateX(-50%); background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:11px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; padding:4px 14px; border-radius:20px; white-space:nowrap; }
.vs-tier__name { font-size:13px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--taas-mid,#666666); margin-bottom:8px; }
.vs-tier__price { font-size:clamp(32px,4vw,42px); font-weight:800; color:var(--taas-black,#111111); margin-bottom:4px; }
.vs-tier__price span { font-size:14px; font-weight:400; color:var(--taas-mid,#666666); }
.vs-tier__tag { font-size:14px; font-weight:600; color:var(--taas-body,#333333); margin-bottom:20px; line-height:1.5; }
.vs-tier__list { list-style:none; display:flex; flex-direction:column; gap:8px; flex:1; margin-bottom:16px; }
.vs-tier__list li { font-size:13px; color:var(--taas-body,#333333); padding-left:20px; position:relative; line-height:1.5; font-weight:300; }
.vs-tier__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.vs-tier__expand { width:100%; text-align:center; background:none; border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:10px; font-size:13px; font-weight:600; color:var(--taas-mid,#666666); cursor:pointer; margin-bottom:16px; font-family:inherit; transition:border-color .15s; }
.vs-tier__expand:hover { border-color:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.vs-tier__detail { display:none; padding:16px 0; font-size:13px; color:var(--taas-body,#333333); line-height:1.6; font-weight:300; }
.vs-tier__detail p { margin-bottom:10px; }
.vs-tier__detail strong { font-weight:700; color:var(--taas-dark,#1A1A1A); }
.vs-tier__cta { display:block; text-align:center; padding:12px 20px; border-radius:var(--taas-radius,6px); font-size:var(--taas-btn-size,14px); font-weight:700; text-decoration:none; text-transform:uppercase; letter-spacing:.05em; transition:background .15s,color .15s; margin-top:auto; }
.vs-tier__cta--primary { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.vs-tier__cta--primary:hover { background:var(--taas-yellow2,#e6b400); }
.vs-tier__cta--outline { background:transparent; color:var(--taas-dark,#1A1A1A); border:2px solid var(--taas-dark,#1A1A1A); }
.vs-tier__cta--outline:hover { background:var(--taas-yellow,#FFC800); border-color:var(--taas-yellow,#FFC800); }

/* ── Callout ── */
.vs-callout { border-left:4px solid var(--taas-yellow,#FFC800); background:#fffbea; padding:24px 28px; border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; margin-top:32px; }
.vs-callout__title { font-size:15px; font-weight:700; color:var(--taas-dark,#1A1A1A); margin-bottom:8px; }
.vs-callout__body { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; }

/* ══ PRICING TABLE ══════════════════════════════════════════════════════ */
.vs-ptable { width:100%; border-collapse:collapse; margin-top:24px; }
.vs-ptable th { background:var(--taas-dark,#1A1A1A); color:#fff; font-size:12px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; padding:14px 16px; text-align:left; }
.vs-ptable th:not(:first-child) { text-align:center; }
.vs-ptable th.vs-ptable__featured { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.vs-ptable td { padding:14px 16px; border-bottom:1px solid var(--taas-border,#E8E8E4); font-size:14px; color:var(--taas-body,#333333); font-weight:300; }
.vs-ptable td:not(:first-child) { text-align:center; font-weight:700; font-size:16px; color:var(--taas-dark,#1A1A1A); }
.vs-ptable tr:nth-child(even) td { background:var(--taas-panel,#F7F7F5); }
.vs-ptable__cat { font-weight:700!important; color:var(--taas-dark,#1A1A1A)!important; font-size:15px!important; }
.vs-ptable__sub { display:block; font-size:12px!important; font-weight:300!important; color:var(--taas-mid,#666666)!important; margin-top:2px; }

/* ══ 14-STEP WORKFLOW ═══════════════════════════════════════════════════ */
.vs-steps { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px; counter-reset:vs-step; }
.vs-step { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:20px 18px; counter-increment:vs-step; display:flex; align-items:flex-start; gap:14px; }
.vs-step::before { content:counter(vs-step); flex-shrink:0; width:32px; height:32px; background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:14px; font-weight:800; border-radius:50%; display:flex; align-items:center; justify-content:center; }
.vs-step__text { font-size:14px; font-weight:600; color:var(--taas-dark,#1A1A1A); line-height:1.4; }
.vs-step__note { display:block; font-size:12px; font-weight:300; color:var(--taas-mid,#666666); margin-top:3px; }
.vs-steps-callout { margin-top:24px; background:var(--taas-dark,#1A1A1A); border-radius:var(--taas-radius,6px); padding:20px 24px; font-size:15px; font-weight:300; color:#ccc; line-height:1.75; }
.vs-steps-callout strong { color:var(--taas-yellow,#FFC800); font-weight:700; }

/* ══ FINANCE STRIP ═══════════════════════════════════════════════════════ */
.vs-finance { background:var(--taas-panel,#F7F7F5); padding:40px 0; border-top:1px solid var(--taas-border,#E8E8E4); }
.vs-finance__inner { text-align:center; }
.vs-finance__heading { font-size:18px; font-weight:700; color:var(--taas-dark,#1A1A1A); margin-bottom:6px; }
.vs-finance__sub { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); margin-bottom:24px; line-height:1.75; }
.vs-finance__logos { display:flex; align-items:center; justify-content:center; gap:28px; flex-wrap:wrap; }
.vs-finance__logo-img { height:36px; width:auto; object-fit:contain; transition:transform .15s; }
.vs-finance__logo-img:hover { transform:scale(1.05); }
.vs-finance__link { display:inline-block; margin-top:16px; font-size:14px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; }
.vs-finance__link:hover { text-decoration:underline; }

/* ══ WHY / DEALER / SPECIALIST / ENQUIRY / RELATED — unchanged from base ══ */
.vs-why { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.vs-why__text { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; }
.vs-why__text p { margin-bottom:16px; }
.vs-why__panel { background:var(--taas-dark,#1A1A1A); border-radius:var(--taas-radius,6px); padding:32px 28px; }
.vs-why__panel-title { font-size:12px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }
.vs-why__panel-list { list-style:none; display:flex; flex-direction:column; gap:10px; }
.vs-why__panel-list li { font-size:14px; font-weight:300; color:#ccc; padding-left:20px; position:relative; line-height:1.5; }
.vs-why__panel-list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.vs-specs { display:grid; grid-template-columns:repeat(2,1fr); gap:20px; }
.vs-spec { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:28px 24px; transition:border-color .15s; }
.vs-spec:hover { border-color:var(--taas-yellow,#FFC800); }
.vs-spec__title { font-size:16px; font-weight:700; color:var(--taas-black,#111111); margin-bottom:10px; }
.vs-spec__body { font-size:14px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; margin-bottom:14px; }
.vs-spec__link { font-size:13px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; }
.vs-spec__link:hover { text-decoration:underline; }
.vs-dealer { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center; }
.vs-dealer__text { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; }
.vs-dealer__text p { margin-bottom:16px; }
.vs-dealer__text strong { color:var(--taas-black,#111111); font-weight:700; }
.vs-dealer__card { background:#252525; border:1px solid #333; border-radius:var(--taas-radius,6px); padding:32px 28px; }
.vs-dealer__card-title { font-size:14px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }
.vs-dealer__card-list { list-style:none; display:flex; flex-direction:column; gap:12px; }
.vs-dealer__card-list li { font-size:14px; font-weight:300; color:#ccc; padding-left:20px; position:relative; line-height:1.5; }
.vs-dealer__card-list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.vs-enquiry { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.vs-enquiry__phone { display:block; font-size:clamp(28px,4vw,40px); font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin:16px 0 6px; }
.vs-enquiry__phone:hover { opacity:.65; }
.vs-enquiry__detail { font-size:15px; font-weight:300; color:#aaa; line-height:1.75; }
.vs-enquiry__detail strong { color:var(--taas-white,#FFFFFF); }
.vs-enquiry__estimate { margin-top:20px; padding:14px 18px; background:rgba(255,200,0,.08); border-left:3px solid var(--taas-yellow,#FFC800); border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; font-size:14px; font-weight:600; color:var(--taas-yellow,#FFC800); line-height:1.5; }
.vs-enquiry__finance-logos { display:flex; gap:10px; flex-wrap:wrap; margin-top:20px; align-items:center; }
.vs-enquiry__fin-img { height:32px; width:auto; object-fit:contain; background:#fff; border-radius:6px; padding:8px 14px; transition:transform .15s; }
.vs-enquiry__fin-img:hover { transform:scale(1.05); }
.vs-enquiry__fin-link { font-size:12px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-top:8px; display:inline-block; }
.vs-enquiry__fin-link:hover { text-decoration:underline; }
.vs-enquiry__form-title { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }
.vs-section--dark .wpcf7 label, .vs-section--dark .wpcf7 span:not(.wpcf7-spinner), .vs-section--dark .wpcf7 div:not(.wpcf7-response-output), .vs-section--dark .wpcf7 p { color:#ccc!important; font-size:14px; }
.vs-section--dark .wpcf7 input[type="text"], .vs-section--dark .wpcf7 input[type="email"], .vs-section--dark .wpcf7 input[type="tel"], .vs-section--dark .wpcf7 textarea { background:#1c1c1c; border:1px solid #444; color:#fff; border-radius:var(--taas-radius,6px); padding:10px 14px; width:100%; font-size:15px; }
.vs-section--dark .wpcf7 input::placeholder, .vs-section--dark .wpcf7 textarea::placeholder { color:#666; }
.vs-section--dark .wpcf7 input:focus, .vs-section--dark .wpcf7 textarea:focus { outline:none; border-color:var(--taas-yellow,#FFC800); }
.vs-section--dark .wpcf7 input[type="submit"] { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); border:none; padding:14px 32px; font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; border-radius:var(--taas-radius,6px); cursor:pointer; width:100%; transition:background .15s; }
.vs-section--dark .wpcf7 input[type="submit"]:hover { background:var(--taas-yellow2,#e6b400); }
.vs-related { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:12px; }
.vs-related a { display:flex; justify-content:space-between; align-items:center; padding:16px 20px; background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); font-size:14px; font-weight:600; color:var(--taas-black,#111111); text-decoration:none; transition:border-color .15s; }
.vs-related a:hover { border-color:var(--taas-yellow,#FFC800); }
.vs-related a span { color:var(--taas-yellow,#FFC800); font-size:18px; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════ */
.vs-faq__list { display:flex; flex-direction:column; max-width:780px; margin:28px auto 0; }
.vs-faq__item { border-bottom:1px solid var(--taas-border,#E8E8E4); }
.vs-faq__q { width:100%; text-align:left; background:none; border:none; padding:18px 40px 18px 0; font-size:15px; font-weight:700; color:var(--taas-black,#111111); cursor:pointer; position:relative; line-height:1.4; display:block; font-family:inherit; }
.vs-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:400; color:var(--taas-mid,#666666); transition:transform .2s; }
.vs-faq__item--open .vs-faq__q::after { content:'−'; }
.vs-faq__a { display:none; padding:0 0 18px; font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; }
.vs-faq__a a { color:var(--taas-yellow,#FFC800); font-weight:600; text-decoration:none; }
.vs-faq__a a:hover { text-decoration:underline; }
.vs-faq__item--open .vs-faq__a { display:block; }

/* ══ BUTTONS ═════════════════════════════════════════════════════════════ */
.vs-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:var(--taas-radius,6px); font-size:var(--taas-btn-size,14px); font-weight:var(--taas-btn-wt,600); text-decoration:none; text-transform:uppercase; letter-spacing:.05em; transition:background .15s,color .15s,border-color .15s; }
.vs-btn--primary { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.vs-btn--primary:hover { background:var(--taas-yellow2,#e6b400); }
.vs-btn--outline { background:transparent; color:var(--taas-yellow,#FFC800); border:2px solid var(--taas-yellow,#FFC800); }
.vs-btn--outline:hover { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media (max-width:960px) {
  .vs-hero__inner { grid-template-columns:1fr; }
  .vs-tiers { grid-template-columns:1fr; max-width:480px; margin:0 auto; }
  .vs-symptoms__grid { grid-template-columns:repeat(2,1fr); }
  .vs-why { grid-template-columns:1fr; }
  .vs-specs { grid-template-columns:1fr; }
  .vs-dealer { grid-template-columns:1fr; }
  .vs-enquiry { grid-template-columns:1fr; gap:32px; }
  .vs-ptable { font-size:13px; }
  .vs-ptable th, .vs-ptable td { padding:10px 12px; }
}
@media (max-width:640px) {
  .vs-hero { padding-bottom:40px; }
  .vs-hero h1 { font-size:clamp(28px,7vw,42px); }
  .vs-hero__sub { font-size:14px; }
  .vs-hero__ctas { flex-direction:column; align-items:stretch; }
  .vs-hero__ctas .vs-btn { justify-content:center; text-align:center; }
  .vs-section { padding:48px 0; }
  .vs-section__heading { font-size:clamp(22px,5vw,28px); }
  .vs-section__sub { font-size:14px; }
  .vs-tiers { max-width:100%; }
  .vs-tier__price { font-size:clamp(28px,6vw,36px); }
  .vs-symptoms { padding:36px 0; }
  .vs-symptoms__grid { grid-template-columns:1fr 1fr; }
  .vs-symptom { padding:14px; }
  .vs-symptom__text { font-size:13px; }
  .vs-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .vs-trust__item { font-size:12px; }
  .vs-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .vs-faq__a { font-size:14px; }
  .vs-why__text, .vs-dealer__text, .vs-callout__body, .vs-enquiry__detail { font-size:14px; }
  .vs-spec__body { font-size:13px; }
  .vs-finance__heading { font-size:16px; }
  .vs-finance__sub { font-size:14px; }
  .vs-enquiry__phone { font-size:clamp(24px,6vw,32px); }
  .vs-sidebar__phone { font-size:20px; }
  .vs-enquiry { display:flex; flex-direction:column-reverse; gap:32px; }
  .vs-pstrip__inner { flex-direction:column; text-align:center; gap:6px; }
  .vs-pstrip__left { flex-direction:column; gap:4px; }
  .vs-pstrip__lbl { display:none; }
  .vs-pstrip__num { font-size:22px; }
  .vs-pstrip__hours { font-size:12px; }
  .vs-finance__logos { gap:16px; }
  .vs-finance__logo-img { height:28px; }
  .vs-enquiry__fin-img { height:28px; padding:6px 10px; }
  .vs-ptable td:not(:first-child) { font-size:14px; }
  .vs-steps { grid-template-columns:1fr; }
  .vs-steps-callout { font-size:14px; }
}
</style>

<div class="taas-vs">

<!-- ══ BREADCRUMB ════════════════════════════════════════════════════════ -->
<nav class="vs-bc" aria-label="Breadcrumb"><div class="vs-w">
  <ol class="vs-bc__list">
    <li><a href="<?php echo esc_url($site_url); ?>">Home</a></li>
    <li class="vs-bc__sep">›</li>
    <li><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a></li>
    <li class="vs-bc__sep">›</li>
    <li class="vs-bc__current">Vehicle Servicing</li>
  </ol>
</div></nav>

<!-- ══ HERO ══════════════════════════════════════════════════════════════ -->
<section class="vs-hero<?php echo $hero_image ? ' vs-hero--has-image' : ''; ?>"<?php echo $hero_image ? ' style="background-image:url(' . esc_url($site_url . $hero_image) . ');"' : ''; ?> aria-label="Vehicle Servicing hero">
  <div class="vs-w">
    <div class="vs-hero__inner">
      <div>
        <span class="vs-hero__eyebrow">Vehicle Servicing — Manukau</span>
        <h1>Car Service<br><span>Manukau — South Auckland</span></h1>
        <p class="vs-hero__sub">Three service levels for all makes and models — Japanese, Korean, European, diesel, hybrid and electric. From <?php echo esc_html($ess_car); ?>. Our Premium service delivers 12 months of safe motoring. Estimate before we start, nothing happens without your approval.</p>
        <div class="vs-hero__ctas">
          <a href="#vs-enquire" class="vs-btn vs-btn--primary">Book a Service</a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="vs-btn vs-btn--outline"><?php echo esc_html($phone_free); ?></a>
        </div>
      </div>
      <div class="vs-sidebar">
        <div class="vs-sidebar__title">Every Service Includes</div>
        <ul class="vs-sidebar__list">
          <li>Engine oil and filter replaced</li>
          <li>All fluid levels checked &amp; topped up</li>
          <li>Tyre pressures checked incl. spare</li>
          <li>Lube sticker renewed</li>
          <li>Service interval reset</li>
          <li>Written report on condition</li>
          <li>Estimate before additional work</li>
        </ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="vs-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="vs-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ══════════════════════════════════════════════════════ -->
<div class="vs-pstrip"><div class="vs-w">
  <div class="vs-pstrip__inner">
    <div class="vs-pstrip__left">
      <span class="vs-pstrip__lbl">Book Now</span>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="vs-pstrip__num"><?php echo esc_html($phone_free); ?></a>
      <span class="vs-pstrip__hours"><?php echo esc_html($hours); ?></span>
    </div>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="vs-pstrip__email"><?php echo esc_html($email); ?></a>
  </div>
</div></div>

<!-- ══ TRUST ═════════════════════════════════════════════════════════════ -->
<div class="vs-trust"><div class="vs-w">
  <div class="vs-trust__inner">
    <div class="vs-trust__item">MTA Assured</div>
    <div class="vs-trust__item">NZTA Authorised</div>
    <div class="vs-trust__item">Estimate Before We Start</div>
    <div class="vs-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="vs-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div></div>

<!-- ══ NOT SURE WHAT YOU NEED? ═══════════════════════════════════════════ -->
<div class="vs-symptoms"><div class="vs-w">
  <h2 class="vs-symptoms__heading">Not Sure What You Need?</h2>
  <p class="vs-symptoms__sub">Pick the one that sounds like you — we'll point you in the right direction.</p>
  <div class="vs-symptoms__grid">
    <a href="#vs-enquire" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div><span class="vs-symptom__text">Due for a service</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/diagnostic-scanning/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg></div><span class="vs-symptom__text">Dashboard warning light</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/brake-repairs-manukau/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm-1-5h2v2h-2zm0-8h2v6h-2z"/></svg></div><span class="vs-symptom__text">Strange noise or vibration</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/wof/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg></div><span class="vs-symptom__text">WOF due or failed</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/air-conditioning/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M22 11h-4.17l2.58-2.58L19 7l-5 5 5 5 1.41-1.41L17.83 13H22v-2zM12 2L7 7l1.41 1.41L11 5.83V10h2V5.83l2.58 2.58L17 7l-5-5z"/></svg></div><span class="vs-symptom__text">AC not blowing cold</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/overheating-engine-manukau/'); ?>" class="vs-symptom"><div class="vs-symptom__icon vs-symptom__icon--red"><svg viewBox="0 0 24 24"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg></div><span class="vs-symptom__text">Car overheating</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5" style="fill:var(--taas-yellow,#FFC800);opacity:.2"/><circle cx="12" cy="12" r="3"/></svg></div><span class="vs-symptom__text">Need new tyres</span><span class="vs-symptom__arrow">→</span></a>
    <a href="<?php echo esc_url($site_url . '/wheel-alignment-manukau/'); ?>" class="vs-symptom"><div class="vs-symptom__icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm-1-11h2v2h-2zm0 4h2v4h-2z"/></svg></div><span class="vs-symptom__text">Car pulling to one side</span><span class="vs-symptom__arrow">→</span></a>
  </div>
</div></div>

<!-- ══ THREE TIERS ══════════════════════════════════════════════════════ -->
<section class="vs-section vs-section--white">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Choose Your Service</span>
    <h2 class="vs-section__heading">Three Service Levels</h2>
    <p class="vs-section__sub">The right service depends on your vehicle, its mileage, and when it was last serviced. Not sure? Call <?php echo esc_html($phone_free); ?> — we'll check your service history and recommend what's actually due.</p>
    <div class="vs-tiers">

      <!-- ESSENTIAL -->
      <div class="vs-tier">
        <div class="vs-tier__name">Essential Service</div>
        <div class="vs-tier__price">from <?php echo esc_html($ess_car); ?> <span>incl. GST</span></div>
        <p class="vs-tier__tag">Oil, filter and basic safety checks.</p>
        <ul class="vs-tier__list">
          <li>Engine oil and filter replaced</li>
          <li>All under-bonnet fluids checked and topped up</li>
          <li>Brake pad visual check</li>
          <li>Tyre pressures, tread depth and condition</li>
          <li>All exterior lights tested</li>
          <li>Battery terminal check and clean</li>
          <li>Lube sticker and service interval reset</li>
        </ul>
        <button class="vs-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="vs-tier__detail">
          <p><strong>Engine:</strong> Oil and filter change, sump plug washer replaced, coolant level check</p>
          <p><strong>Brakes:</strong> Brake pad visual check (on-car), brake fluid level check</p>
          <p><strong>Tyres:</strong> Tyre pressures set including spare, tread depth measured, condition and damage check</p>
          <p><strong>Electrical:</strong> All exterior lights, horn, wiper operation and blade condition, battery terminal check and clean</p>
          <p><strong>Road Test:</strong> Short drive assessment</p>
          <p><strong>Report:</strong> Written checklist report, verbal debrief</p>
        </div>
        <a href="#vs-enquire" class="vs-tier__cta vs-tier__cta--outline">Book Essential</a>
      </div>

      <!-- STANDARD -->
      <div class="vs-tier">
        <div class="vs-tier__name">Standard Service</div>
        <div class="vs-tier__price">from <?php echo esc_html($std_car); ?> <span>incl. GST</span></div>
        <p class="vs-tier__tag">Full safety assessment with brake and suspension checks.</p>
        <ul class="vs-tier__list">
          <li>Everything in Essential</li>
          <li>Brake roller machine test</li>
          <li>Full suspension and steering assessment</li>
          <li>Cooling system pressure test</li>
          <li>Battery health test (12V starting)</li>
          <li>AC function check</li>
          <li>All power features tested</li>
        </ul>
        <button class="vs-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="vs-tier__detail">
          <p><strong>Engine:</strong> Everything in Essential plus cambelt visual check, drive belt condition, radiator hose condition</p>
          <p><strong>Brakes:</strong> Brake roller machine test, brake line and hose inspection, handbrake test and adjustment check</p>
          <p><strong>Steering &amp; Suspension:</strong> Steering free-play, ball joints, tie rod ends, CV boots, shock absorbers</p>
          <p><strong>Cooling:</strong> Pressure test, radiator cap test, hose condition, water pump visual</p>
          <p><strong>Tyres:</strong> Everything in Essential plus silicone tyre check, wheel nut torque</p>
          <p><strong>Electrical:</strong> Interior lights, dashboard warnings, battery health test (12V)</p>
          <p><strong>Interior:</strong> AC function and temperature, all power windows, central locking, heated seats and electric mirrors where fitted</p>
          <p><strong>Fluids:</strong> Clutch fluid check (manual), power steering fluid check</p>
          <p><strong>Road Test:</strong> Full road test — engine under load, transmission, brakes, steering</p>
          <p><strong>Report:</strong> Detailed written report with condition ratings, verbal debrief</p>
        </div>
        <a href="#vs-enquire" class="vs-tier__cta vs-tier__cta--outline">Book Standard</a>
      </div>

      <!-- PREMIUM — Most Popular -->
      <div class="vs-tier vs-tier--featured">
        <div class="vs-tier__name">Premium Service</div>
        <div class="vs-tier__price">from <?php echo esc_html($prem_car); ?> <span>incl. GST</span></div>
        <p class="vs-tier__tag">12 months of safe motoring — the full inspection.</p>
        <ul class="vs-tier__list">
          <li>Everything in Standard</li>
          <li>Wheels removed — disc and pad measurement</li>
          <li>OBD diagnostic scan with fault code report</li>
          <li>Air, cabin and fuel filters inspected</li>
          <li>Brake fluid condition tested</li>
          <li>Full steering rack and bush inspection</li>
          <li>Tyre rotation if required</li>
          <li>Thorough road test</li>
        </ul>
        <button class="vs-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="vs-tier__detail">
          <p><strong>Engine:</strong> Everything in Standard plus transmission/gearbox fluid level and condition</p>
          <p><strong>Brakes:</strong> Wheels removed, disc and pad thickness measured and recorded, brake fluid condition test</p>
          <p><strong>Steering &amp; Suspension:</strong> Everything in Standard plus steering rack boot inspection, bush condition, wheel bearings</p>
          <p><strong>Filters:</strong> Air filter, cabin/pollen filter, fuel filter (where accessible) — inspected and reported</p>
          <p><strong>Electrical:</strong> OBD diagnostic scan — read and clear fault codes, full report</p>
          <p><strong>Tyres:</strong> Everything in Standard plus tyre rotation if required</p>
          <p><strong>Underbody:</strong> Full hoist inspection — chassis rails, subframe, sill panels, fuel and brake lines, exhaust</p>
          <p><strong>Road Test:</strong> Thorough road test covering engine, transmission, brakes, steering, suspension</p>
          <p><strong>Report:</strong> Comprehensive written report with condition ratings per system, deferred work recommendations</p>
        </div>
        <a href="#vs-enquire" class="vs-tier__cta vs-tier__cta--primary">Book Premium</a>
      </div>

    </div>
    <div class="vs-callout">
      <div class="vs-callout__title">Why Does the Price Vary by Vehicle?</div>
      <p class="vs-callout__body">The main variables are engine oil specification and capacity. A Toyota Corolla takes around 4 litres of standard synthetic. A Hilux diesel takes 7–8 litres. A BMW or Mercedes requires manufacturer-specification oil at a higher cost per litre. We have five vehicle categories with clear pricing for each — see the table below.</p>
    </div>
  </div>
</section>

<!-- ══ PRICING BY VEHICLE TYPE ══════════════════════════════════════════ -->
<section class="vs-section vs-section--grey">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Transparent Pricing</span>
    <h2 class="vs-section__heading">Pricing by Vehicle Type</h2>
    <p class="vs-section__sub">All prices include GST. Not sure which category your vehicle falls into? Call <?php echo esc_html($phone_free); ?> and we will confirm the price for your specific vehicle.</p>
    <table class="vs-ptable">
      <thead>
        <tr>
          <th>Vehicle Category</th>
          <th>Essential</th>
          <th>Standard</th>
          <th class="vs-ptable__featured">Premium</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pricing_grid as $row): ?>
        <tr>
          <td><span class="vs-ptable__cat"><?php echo esc_html($row['cat']); ?></span><span class="vs-ptable__sub"><?php echo esc_html($row['sub']); ?></span></td>
          <td><?php echo esc_html($row['ess']); ?></td>
          <td><?php echo esc_html($row['std']); ?></td>
          <td><?php echo esc_html($row['prem']); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════ -->
<div class="vs-finance"><div class="vs-w">
  <div class="vs-finance__inner">
    <div class="vs-finance__heading">Split the Cost — Interest-Free Options Available</div>
    <p class="vs-finance__sub">Need it done now but the timing's tight? Spread the cost with no interest on most options.</p>
    <div class="vs-finance__logos">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="vs-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="vs-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="vs-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="vs-finance__logo-img" height="36" loading="lazy">
    </div>
    <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="vs-finance__link">View all finance options →</a>
  </div>
</div></div>

<!-- ══ ANATOMY OF A TAAS SERVICE — 14 STEPS ════════════════════════════ -->
<section class="vs-section vs-section--white">
  <div class="vs-w">
    <span class="vs-section__eyebrow">What Actually Happens</span>
    <h2 class="vs-section__heading">Anatomy of a TAAS Service</h2>
    <p class="vs-section__sub">Every Premium service follows this 14-step workflow. Standard covers most of these. Essential covers the fundamentals. This is not a checklist we aspirate to — it is what our technicians do, every vehicle, every time.</p>
    <div class="vs-steps">
      <div class="vs-step"><div class="vs-step__text">Road Test<span class="vs-step__note">Before we touch anything</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Lights<span class="vs-step__note">All exterior and interior</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Dash Lights<span class="vs-step__note">Warning indicators checked</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Diagnostic Scan<span class="vs-step__note">OBD fault codes read</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Under Bonnet<span class="vs-step__note">Fluids, belts, hoses, leaks</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Suspension<span class="vs-step__note">Bushes, ball joints, shocks</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Brakes<span class="vs-step__note">Pads, discs, fluid, lines</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Underbody<span class="vs-step__note">Rust, leaks, structural</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Oil &amp; Filter<span class="vs-step__note">Drained, replaced, reset</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Wheels<span class="vs-step__note">Pressures, tread, condition</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Fluids<span class="vs-step__note">Topped up across all systems</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Stickers<span class="vs-step__note">Lube sticker renewed</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Service Light Reset<span class="vs-step__note">Interval counter cleared</span></div></div>
      <div class="vs-step"><div class="vs-step__text">Second Road Test<span class="vs-step__note">Confirm everything is right</span></div></div>
    </div>
    <div class="vs-steps-callout">
      <strong>A budget service covers 4 of those 14 steps</strong> — oil, fluids, sticker, and maybe tyres. The other ten are where problems get caught before they become breakdowns. That is the difference between an oil change and a service.
    </div>
  </div>
</section>

<!-- ══ WHY SERVICING MATTERS ════════════════════════════════════════════ -->
<section class="vs-section vs-section--grey">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Why It Matters</span>
    <h2 class="vs-section__heading">Why Regular Servicing Matters</h2>
    <div class="vs-why">
      <div class="vs-why__text">
        <p>Regular servicing is not about replacing things that are not broken. It is about catching problems when they are small and cheap to fix — before they become large and expensive. A failing water pump spotted at a service costs a fraction of what it costs after it has overheated and damaged the head gasket.</p>
        <p>Servicing also protects your resale value. A vehicle with a complete, stamped service history is worth measurably more than one without — and it sells faster. Buyers trust a vehicle that has been looked after.</p>
        <p>If your vehicle is under warranty, regular servicing at the correct intervals — with the correct fluids and parts — is essential. You do not need to use the dealer. Under New Zealand consumer law, any qualified workshop can service your vehicle without affecting your warranty.</p>
      </div>
      <div class="vs-why__panel">
        <div class="vs-why__panel-title">What Regular Servicing Prevents</div>
        <ul class="vs-why__panel-list">
          <li>Engine damage from contaminated or low oil</li>
          <li>Overheating from coolant that has lost its protection</li>
          <li>Brake failure from worn pads and degraded fluid</li>
          <li>Cambelt failure from missed replacement intervals</li>
          <li>WOF failures from deferred maintenance</li>
          <li>Warranty disputes from incomplete service records</li>
          <li>Higher fuel consumption from dirty filters and aged plugs</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══ SPECIALIST VEHICLE TYPES ═════════════════════════════════════════ -->
<section class="vs-section vs-section--white">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Specialist Servicing</span>
    <h2 class="vs-section__heading">Diesel, Hybrid, EV &amp; European</h2>
    <p class="vs-section__sub">We service all vehicle types — not just standard petrol cars. Each type has its own additional checks built into the service.</p>
    <div class="vs-specs">
      <div class="vs-spec">
        <div class="vs-spec__title">Diesel Vehicles</div>
        <p class="vs-spec__body">Same three-tier structure with additional diesel-specific checks — fuel filter, DPF status via diagnostic scan including soot load and regeneration cycle data, turbocharger inspection, and AdBlue levels where applicable.</p>
        <a href="<?php echo esc_url($site_url . '/diesel-vehicle-servicing/'); ?>" class="vs-spec__link">Diesel Servicing →</a>
      </div>
      <div class="vs-spec">
        <div class="vs-spec__title">Hybrid Vehicles</div>
        <p class="vs-spec__body">Standard petrol service schedule plus hybrid-specific checks — 12V auxiliary battery test, HV battery health and cooling system condition, hybrid-specific filters, and fault code verification.</p>
        <a href="<?php echo esc_url($site_url . '/electric-hybrid-vehicle-servicing/'); ?>" class="vs-spec__link">EV &amp; Hybrid Servicing →</a>
      </div>
      <div class="vs-spec">
        <div class="vs-spec__title">Electric Vehicles</div>
        <p class="vs-spec__body">No oil change needed, but EVs are not maintenance-free. We service the 12V battery, HV coolant, brake fluid, cabin and pollen filters, HV battery cooling intake, plus a full HV system health scan.</p>
        <a href="<?php echo esc_url($site_url . '/electric-hybrid-vehicle-servicing/'); ?>" class="vs-spec__link">EV &amp; Hybrid Servicing →</a>
      </div>
      <div class="vs-spec">
        <div class="vs-spec__title">European Vehicles</div>
        <p class="vs-spec__body"><?php echo esc_html($euro_brands); ?> — serviced with correct oil grades, filters, reset procedures and brand-specific diagnostic tools through our TAAS European division.</p>
        <a href="<?php echo esc_url($site_url . '/european/'); ?>" class="vs-spec__link">TAAS European →</a>
      </div>
    </div>
  </div>
</section>

<!-- ══ DEALER OBJECTION KILLER ══════════════════════════════════════════ -->
<section class="vs-section vs-section--grey">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Your Warranty Is Safe</span>
    <h2 class="vs-section__heading">Do I Need to Go Back to the Dealer?</h2>
    <div class="vs-dealer">
      <div class="vs-dealer__text">
        <p><strong>No.</strong> Under New Zealand consumer law, you can have your vehicle serviced at any qualified workshop without affecting your manufacturer warranty — provided the correct parts, fluids and service intervals are followed.</p>
        <p>Tony Allen Auto Service is MTA Assured and services all vehicles to manufacturer specification. We use the correct oil grades, genuine-equivalent filters, and follow manufacturer service schedules. We stamp your service book.</p>
        <p>Many of our <?php echo esc_html($customers); ?> customers switched from dealer servicing and saved hundreds of dollars annually — with no impact on their warranty. The difference is overhead, not quality.</p>
      </div>
      <div class="vs-dealer__card">
        <div class="vs-dealer__card-title">Why Customers Switch From the Dealer</div>
        <ul class="vs-dealer__card-list">
          <li>Same quality service — lower overhead, lower price</li>
          <li>MTA Assured workshop — nationally recognised standard</li>
          <li>Correct oil grades and manufacturer-equivalent parts</li>
          <li>Service book stamped at every visit</li>
          <li>No upselling — estimate before any additional work</li>
          <li>Family-owned since <?php echo esc_html($established); ?> — not a corporate chain</li>
          <li><?php echo esc_html($rating); ?>★ across <?php echo esc_html($reviews); ?> Google reviews</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══ ENQUIRY ═══════════════════════════════════════════════════════════ -->
<section class="vs-section vs-section--dark" id="vs-enquire" style="border-top:3px solid var(--taas-yellow,#FFC800);">
  <div class="vs-w">
    <div class="vs-enquiry">
      <div>
        <span class="vs-section__eyebrow">Book or Enquire</span>
        <h2 class="vs-section__heading">Book Your Service</h2>
        <p style="font-size:15px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and year. We'll confirm what's due and provide a price before you commit.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="vs-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="vs-enquiry__detail">
          <strong>Tony Allen Auto Service</strong><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>
          <?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?>
        </div>
        <div class="vs-enquiry__estimate">Estimate before we start — nothing happens without your approval.</div>
        <div class="vs-enquiry__finance-logos">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="vs-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="vs-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="vs-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="vs-enquiry__fin-img" height="32" loading="lazy">
        </div>
        <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="vs-enquiry__fin-link">Finance options →</a>
      </div>
      <div>
        <div class="vs-enquiry__form-title">Send Us Your Details</div>
        <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
        <p style="font-size:15px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow,#FFC800);"><?php echo esc_html($phone_free); ?></a> or email <a href="mailto:<?php echo esc_attr($email); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;"><?php echo esc_html($email); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══ REVIEWS ═══════════════════════════════════════════════════════════ -->
<section class="vs-section vs-section--white">
  <div class="vs-w">
    <span class="vs-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="vs-section__heading">What Customers Say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══ RELATED ═══════════════════════════════════════════════════════════ -->
<section class="vs-section vs-section--grey">
  <div class="vs-w">
    <span class="vs-section__eyebrow">Also at TAAS</span>
    <h2 class="vs-section__heading">Related Services</h2>
    <p class="vs-section__sub">Services often done alongside or identified during a vehicle service.</p>
    <div class="vs-related">
      <?php
      $related = [
          ['label' => 'WOF Inspection',           'url' => '/wof/'],
          ['label' => 'Cambelt & Water Pump',      'url' => '/cambelts-and-water-pumps/'],
          ['label' => 'Brake Repairs',             'url' => '/brake-repairs-manukau/'],
          ['label' => 'Wheel Alignment',           'url' => '/wheel-alignment-manukau/'],
          ['label' => 'Tyre Centre',               'url' => '/tyre-centre/'],
          ['label' => 'Air Conditioning',          'url' => '/air-conditioning/'],
          ['label' => 'Pre-Purchase Inspection',   'url' => '/pre-purchase-inspection-manukau/'],
          ['label' => 'Finance Options',           'url' => '/finance-options/'],
      ];
      foreach ($related as $r):
      ?>
      <a href="<?php echo esc_url($site_url . $r['url']); ?>"><?php echo esc_html($r['label']); ?><span>→</span></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ FAQ ═══════════════════════════════════════════════════════════════ -->
<section class="vs-section vs-section--white">
  <div class="vs-w">
    <span class="vs-section__eyebrow">FAQ</span>
    <h2 class="vs-section__heading">Common Questions — Vehicle Servicing</h2>
    <div class="vs-faq__list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="vs-faq__item<?php echo $i === 0 ? ' vs-faq__item--open' : ''; ?>">
        <button class="vs-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="vs-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- .taas-vs -->

<script>
document.querySelectorAll('.vs-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.vs-faq__item');
    var wasOpen = item.classList.contains('vs-faq__item--open');
    document.querySelectorAll('.vs-faq__item--open').forEach(function(i){
      i.classList.remove('vs-faq__item--open');
      i.querySelector('.vs-faq__q').setAttribute('aria-expanded','false');
    });
    if (!wasOpen) {
      item.classList.add('vs-faq__item--open');
      this.setAttribute('aria-expanded','true');
    }
  });
});
</script>

<?php get_footer(); ?>
