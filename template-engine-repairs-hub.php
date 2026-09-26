<?php
/**
 * Template Name: Engine Repairs Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /engine-repairs/
 * CSS namespace: .erh-
 *
 * Section order (Go-Live Standard):
 * Hero → Phone Strip → Trust → Services → Approach → Common Problems →
 * Finance Strip → Enquiry → MBI → Reviews → Related → FAQ
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
$euro_brands   = defined('TAAS_EURO_BRANDS')  ? TAAS_EURO_BRANDS  : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$scan_price    = defined('TAAS_SCAN_PRICE')   ? TAAS_SCAN_PRICE   : 'from $75';
$mech_diag     = defined('TAAS_MECH_DIAG')    ? TAAS_MECH_DIAG    : 'from $175';
$phone_free    = defined('TAAS_PHONE_FREE')   ? TAAS_PHONE_FREE   : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL')  ? TAAS_PHONE_LOCAL  : '09 278 9556';
$phone_free_tel= str_replace(' ', '', $phone_free);
$phone_local_tel= str_replace(' ', '', $phone_local);
$address       = defined('TAAS_ADDRESS') ? TAAS_ADDRESS : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')   ? TAAS_HOURS   : 'Monday–Friday 7:30am–5:00pm';
$email         = defined('TAAS_EMAIL')   ? TAAS_EMAIL   : 'enquiries@taas.co.nz';
$rating        = defined('TAAS_RATING')  ? TAAS_RATING  : '4.2';
$reviews       = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$cf7_general   = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$customers     = defined('TAAS_CUSTOMERS') ? TAAS_CUSTOMERS : '10,000+';
$mbi_list      = defined('TAAS_MBI_LIST') ? TAAS_MBI_LIST : 'Autosure, Assurant, Provident, Janssen, Autolife';
$finance_list  = defined('TAAS_FINANCE_LIST') ? TAAS_FINANCE_LIST : 'Afterpay, Q Card, GEM, Aotea Finance';

// Hero image — page-specific override → default workshop shot → none
$hero_image = defined('TAAS_HERO_ENGINE') ? TAAS_HERO_ENGINE
            : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');

// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['engine_what_repairs'],
    $taas_faqs['engine_cost'],
    $taas_faqs['engine_symptoms'],
    $taas_faqs['engine_diagnose_first'],
    $taas_faqs['engine_oil_leak'],
    $taas_faqs['engine_misfire'],
    $taas_faqs['engine_check_light'],
    $taas_faqs['engine_european'],
    $taas_faqs['engine_head_gasket'],
    $taas_faqs['engine_finance'],
    $taas_faqs['engine_mbi'],
    $taas_faqs['engine_location'],
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
            'description' => 'Engine diagnosis and repair in Manukau, South Auckland. Oil leaks, misfires, engine noise, head gaskets, oil consumption and more. MTA Assured, ' . $years_trading . ' years trading.',
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
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.erh-hero__sub', '.erh-faq__a:first-of-type p']],
        [
            '@type'       => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Engine Repairs', 'item' => $page_url],
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

// ── Badge helper ─────────────────────────────────────────────────────────────
function erh_badge($code) {
    return '<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="8" fill="#1A1A1A"/><text x="22" y="27" text-anchor="middle" font-family="Inter,Arial,sans-serif" font-size="14" font-weight="700" fill="#FFC800">' . esc_html($code) . '</text></svg>';
}

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ══ RESET ════════════════════════════════════════════════════════════════ */
.page-template-template-engine-repairs-hub .site-content,
.page-template-template-engine-repairs-hub .entry-content,
.page-template-template-engine-repairs-hub .entry-header,
.page-template-template-engine-repairs-hub article,
.page-template-template-engine-repairs-hub #primary,
.page-template-template-engine-repairs-hub #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-engine-repairs-hub { overflow-x:hidden; }
.taas-erh *, .taas-erh *::before, .taas-erh *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-erh { font-family:var(--taas-font,'Inter',Arial,sans-serif); -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }

/* ══ LAYOUT ══════════════════════════════════════════════════════════════ */
.erh-w { max-width:var(--taas-container,1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ══════════════════════════════════════════════════════════ */
.erh-bc { background:var(--taas-black,#111111); padding:14px 0 0; }
.erh-bc__list { list-style:none; display:flex; gap:6px; align-items:center; font-size:12px; color:#666; }
.erh-bc__list a { color:#888; text-decoration:none; }
.erh-bc__list a:hover { color:var(--taas-yellow,#FFC800); }
.erh-bc__sep { color:#444; }
.erh-bc__current { color:#aaa; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.erh-hero { background:var(--taas-black,#111111); padding:0 0 60px; position:relative; }
.erh-hero--has-image { background-size:cover; background-position:center 40%; }
.erh-hero--has-image::before { content:''; position:absolute; inset:0; background:rgba(13,13,13,0.82); }
.erh-hero__inner { position:relative; z-index:1; display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:start; padding-top:32px; }
.erh-hero__eyebrow { display:inline-block; background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:5px 14px; border-radius:3px; margin-bottom:20px; }
.erh-hero h1 { font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px)); font-weight:800; color:#fff; letter-spacing:-0.02em; line-height:1.1; margin-bottom:16px; }
.erh-hero h1 span { color:var(--taas-yellow,#FFC800); }
.erh-hero__sub { font-size:16px; font-weight:300; color:#aaa; max-width:540px; margin-bottom:28px; line-height:1.75; letter-spacing:-0.1px; }
.erh-hero__ctas { display:flex; gap:12px; flex-wrap:wrap; }
.erh-sidebar { background:#1e1e1e; border:1px solid #333; border-radius:var(--taas-radius,6px); padding:24px; }
.erh-sidebar__title { font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:14px; }
.erh-sidebar__list { list-style:none; display:flex; flex-direction:column; gap:8px; margin-bottom:20px; }
.erh-sidebar__list li { font-size:13px; color:#ccc; padding-left:18px; position:relative; line-height:1.4; }
.erh-sidebar__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.erh-sidebar hr { border:none; border-top:1px solid #333; margin-bottom:16px; }
.erh-sidebar__phone { display:block; font-size:22px; font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-bottom:4px; line-height:1.1; }
.erh-sidebar__phone:hover { opacity:.65; }
.erh-sidebar__detail { font-size:12px; color:#666; line-height:1.6; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════ */
.erh-pstrip { background:var(--taas-yellow,#FFC800); padding:18px 0; }
.erh-pstrip__inner { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.erh-pstrip__left { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.erh-pstrip__lbl { font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; color:var(--taas-dark,#1A1A1A); }
.erh-pstrip__num { font-size:28px; font-weight:900; color:var(--taas-dark,#1A1A1A); text-decoration:none; }
.erh-pstrip__num:hover { opacity:.65; }
.erh-pstrip__hours { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); opacity:.75; }
.erh-pstrip__email { display:inline-flex; align-items:center; gap:6px; background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); font-size:13px; font-weight:600; padding:8px 16px; border-radius:var(--taas-radius,6px); text-decoration:none; transition:background .15s; }
.erh-pstrip__email:hover { background:#333; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════ */
.erh-trust { background:var(--taas-panel,#F7F7F5); padding:16px 0; border-bottom:1px solid var(--taas-border,#E8E8E4); }
.erh-trust__inner { display:flex; gap:32px; align-items:center; justify-content:center; flex-wrap:wrap; }
.erh-trust__item { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); display:flex; align-items:center; gap:7px; white-space:nowrap; }
.erh-trust__item::before { content:'✓'; font-weight:900; color:var(--taas-yellow,#FFC800); }

/* ══ SECTIONS ════════════════════════════════════════════════════════════ */
.erh-section { padding:72px 0; }
.erh-section--white { background:var(--taas-white,#FFFFFF); }
.erh-section--grey  { background:var(--taas-panel,#F7F7F5); }
.erh-section--dark  { background:var(--taas-dark,#1A1A1A); }
.erh-section__eyebrow { display:inline-block; background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.erh-section--dark .erh-section__eyebrow { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.erh-section__heading { font-size:var(--taas-h2,clamp(26px,3.5vw,36px)); font-weight:700; color:var(--taas-black,#111111); letter-spacing:-0.01em; margin-bottom:12px; }
.erh-section--dark .erh-section__heading { color:var(--taas-white,#FFFFFF); }
.erh-section__sub { font-size:16px; font-weight:300; color:var(--taas-mid,#666666); max-width:640px; margin-bottom:36px; line-height:1.75; letter-spacing:-0.1px; }
.erh-section--dark .erh-section__sub { color:#aaa; }

/* ══ SERVICE CARDS ═══════════════════════════════════════════════════════ */
.erh-services { display:grid; grid-template-columns:repeat(2,1fr); gap:20px; }
.erh-service { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:28px 24px; display:flex; flex-direction:column; gap:10px; text-decoration:none; transition:box-shadow .2s,transform .2s,border-color .2s; border-top:3px solid transparent; }
.erh-service:hover { box-shadow:0 4px 16px rgba(0,0,0,.08); transform:translateY(-2px); border-top-color:var(--taas-yellow,#FFC800); }
.erh-service__icon { width:44px; height:44px; flex-shrink:0; }
.erh-service__title { font-size:16px; font-weight:700; color:var(--taas-black,#111111); }
.erh-service__desc { font-size:14px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; flex:1; }
.erh-service__link { font-size:12px; font-weight:700; color:var(--taas-yellow,#FFC800); margin-top:auto; }
.erh-service:hover .erh-service__link { text-decoration:underline; }

/* ══ APPROACH ════════════════════════════════════════════════════════════ */
.erh-approach { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.erh-approach__text { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; letter-spacing:-0.1px; }
.erh-approach__text p { margin-bottom:16px; }
.erh-callout { border-left:4px solid var(--taas-yellow,#FFC800); background:#fffbea; padding:24px 28px; border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; margin:24px 0; }
.erh-callout__title { font-size:15px; font-weight:700; color:var(--taas-dark,#1A1A1A); margin-bottom:8px; }
.erh-callout__body { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; }
.erh-panel { background:var(--taas-dark,#1A1A1A); border-radius:var(--taas-radius,6px); padding:32px 28px; }
.erh-panel__title { font-size:12px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }
.erh-panel__list { list-style:none; display:flex; flex-direction:column; gap:10px; }
.erh-panel__list li { font-size:14px; color:#ccc; padding-left:20px; position:relative; line-height:1.5; }
.erh-panel__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }

/* ══ COMMON PROBLEMS ════════════════════════════════════════════════════ */
.erh-problems { display:grid; grid-template-columns:1fr 1fr; gap:32px 48px; margin-top:24px; }
.erh-problems h3 { font-size:16px; font-weight:700; color:var(--taas-black,#111111); margin-bottom:8px; }
.erh-problems p { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; }

/* ══ FINANCE STRIP ═══════════════════════════════════════════════════════ */
.erh-finance { background:var(--taas-panel,#F7F7F5); padding:40px 0; border-top:1px solid var(--taas-border,#E8E8E4); }
.erh-finance__inner { text-align:center; }
.erh-finance__heading { font-size:18px; font-weight:700; color:var(--taas-dark,#1A1A1A); margin-bottom:6px; }
.erh-finance__sub { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); margin-bottom:24px; line-height:1.75; }
.erh-finance__logos { display:flex; align-items:center; justify-content:center; gap:28px; flex-wrap:wrap; }
.erh-finance__logo-img { height:36px; width:auto; object-fit:contain; transition:transform .15s; }
.erh-finance__logo-img:hover { transform:scale(1.05); }
.erh-finance__link { display:inline-block; margin-top:16px; font-size:14px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; }
.erh-finance__link:hover { text-decoration:underline; }

/* ══ ENQUIRY ═════════════════════════════════════════════════════════════ */
.erh-enquiry { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.erh-enquiry__phone { display:block; font-size:clamp(28px,4vw,40px); font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin:16px 0 6px; }
.erh-enquiry__phone:hover { opacity:.65; }
.erh-enquiry__detail { font-size:15px; font-weight:300; color:#aaa; line-height:1.75; }
.erh-enquiry__detail strong { color:var(--taas-white,#FFFFFF); }
.erh-enquiry__estimate { margin-top:20px; padding:14px 18px; background:rgba(255,200,0,.08); border-left:3px solid var(--taas-yellow,#FFC800); border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; font-size:14px; font-weight:600; color:var(--taas-yellow,#FFC800); line-height:1.5; }
.erh-enquiry__finance-logos { display:flex; gap:10px; flex-wrap:wrap; margin-top:20px; align-items:center; }
.erh-enquiry__fin-img { height:32px; width:auto; object-fit:contain; background:#fff; border-radius:6px; padding:8px 14px; transition:transform .15s; }
.erh-enquiry__fin-img:hover { transform:scale(1.05); }
.erh-enquiry__fin-link { font-size:12px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-top:8px; display:inline-block; }
.erh-enquiry__fin-link:hover { text-decoration:underline; }
.erh-enquiry__form-title { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }

/* Dark form overrides */
.erh-section--dark .wpcf7 label, .erh-section--dark .wpcf7 span:not(.wpcf7-spinner), .erh-section--dark .wpcf7 div:not(.wpcf7-response-output), .erh-section--dark .wpcf7 p { color:#888!important; font-size:11px!important; font-weight:700!important; letter-spacing:.08em!important; text-transform:uppercase!important; }
.erh-section--dark .wpcf7 input[type="text"], .erh-section--dark .wpcf7 input[type="email"], .erh-section--dark .wpcf7 input[type="tel"], .erh-section--dark .wpcf7 textarea { background:#1c1c1c!important; border:1px solid #333!important; color:#fff!important; border-radius:var(--taas-radius,6px)!important; padding:12px 14px!important; width:100%!important; font-size:15px!important; font-family:var(--taas-font,'Inter',Arial,sans-serif)!important; font-weight:300!important; box-sizing:border-box!important; margin-top:4px!important; transition:border-color .15s!important; }
.erh-section--dark .wpcf7 input::placeholder, .erh-section--dark .wpcf7 textarea::placeholder { color:#666; }
.erh-section--dark .wpcf7 input:focus, .erh-section--dark .wpcf7 textarea:focus { outline:none!important; border-color:var(--taas-yellow,#FFC800)!important; }
.erh-section--dark .wpcf7 textarea { min-height:100px!important; resize:vertical!important; }
.erh-section--dark .wpcf7 input[type="submit"] { background:var(--taas-yellow,#FFC800)!important; color:var(--taas-dark,#1A1A1A)!important; font-weight:700!important; font-size:14px!important; letter-spacing:.04em!important; text-transform:uppercase!important; border:none!important; padding:14px 28px!important; border-radius:var(--taas-radius,6px)!important; cursor:pointer!important; width:100%!important; margin-top:4px!important; }
.erh-section--dark .wpcf7 input[type="submit"]:hover { background:var(--taas-yellow2,#e6b400)!important; }

/* ══ MBI ═════════════════════════════════════════════════════════════════ */
.erh-mbi { max-width:800px; margin:0 auto; text-align:center; }
.erh-mbi__text { font-size:15px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; margin-bottom:24px; }
.erh-mbi__badges { display:flex; flex-wrap:wrap; gap:12px; justify-content:center; margin-bottom:28px; }
.erh-mbi__badge { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); padding:8px 18px; font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); border-radius:var(--taas-radius,6px); }

/* ══ RELATED ═════════════════════════════════════════════════════════════ */
.erh-related { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.erh-related .erh-service__desc { font-size:14px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════ */
.erh-faq__list { display:flex; flex-direction:column; max-width:780px; margin:28px auto 0; }
.erh-faq__item { border-bottom:1px solid var(--taas-border,#E8E8E4); }
.erh-faq__q { width:100%; text-align:left; background:none; border:none; padding:18px 40px 18px 0; font-size:15px; font-weight:700; color:var(--taas-black,#111111); cursor:pointer; position:relative; line-height:1.4; display:block; font-family:inherit; }
.erh-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:400; color:var(--taas-mid,#666666); transition:transform .2s; }
.erh-faq__item--open .erh-faq__q::after { content:'−'; }
.erh-faq__a { display:none; padding:0 0 18px; font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; }
.erh-faq__a a { color:var(--taas-yellow,#FFC800); font-weight:600; text-decoration:none; }
.erh-faq__a a:hover { text-decoration:underline; }
.erh-faq__item--open .erh-faq__a { display:block; }

/* ══ BUTTONS ═════════════════════════════════════════════════════════════ */
.erh-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; border-radius:var(--taas-radius,6px); font-size:var(--taas-btn-size,14px); font-weight:700; text-decoration:none; text-transform:uppercase; letter-spacing:.05em; transition:background .15s,color .15s,border-color .15s,transform .15s; border:2px solid transparent; }
.erh-btn--primary { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); border-color:var(--taas-yellow,#FFC800); }
.erh-btn--primary:hover { background:var(--taas-yellow2,#e6b400); border-color:var(--taas-yellow2,#e6b400); transform:translateY(-1px); }
.erh-btn--outline { background:transparent; color:var(--taas-yellow,#FFC800); border:2px solid var(--taas-yellow,#FFC800); }
.erh-btn--outline:hover { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media (max-width:960px) {
  .erh-hero__inner { grid-template-columns:1fr; }
  .erh-services { grid-template-columns:1fr; }
  .erh-approach { grid-template-columns:1fr; }
  .erh-enquiry { grid-template-columns:1fr; gap:32px; }
  .erh-related { grid-template-columns:1fr; }
  .erh-problems { grid-template-columns:1fr; }
}
@media (max-width:640px) {
  .erh-hero { padding-bottom:40px; }
  .erh-hero h1 { font-size:clamp(28px,7vw,42px); }
  .erh-hero__sub { font-size:14px; }
  .erh-hero__ctas { flex-direction:column; align-items:stretch; }
  .erh-hero__ctas .erh-btn { justify-content:center; text-align:center; }
  .erh-section { padding:48px 0; }
  .erh-section__heading { font-size:clamp(22px,5vw,28px); }
  .erh-section__sub { font-size:14px; }
  .erh-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .erh-trust__item { font-size:12px; }
  .erh-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .erh-faq__a { font-size:14px; }
  /* Body text — all 14px on mobile */
  .erh-approach__text { font-size:14px; }
  .erh-callout__body { font-size:14px; }
  .erh-problems p { font-size:14px; }
  .erh-enquiry__detail { font-size:14px; }
  .erh-mbi__text { font-size:14px; }
  .erh-service__desc { font-size:13px; }
  .erh-finance__heading { font-size:16px; }
  .erh-finance__sub { font-size:14px; }
  .erh-enquiry__phone { font-size:clamp(24px,6vw,32px); }
  .erh-sidebar__phone { font-size:20px; }
  /* Mobile: form first, contact below */
  .erh-enquiry { display:flex; flex-direction:column-reverse; gap:32px; }
  /* Phone strip */
  .erh-pstrip__inner { flex-direction:column; text-align:center; gap:6px; }
  .erh-pstrip__left { flex-direction:column; gap:4px; }
  .erh-pstrip__lbl { display:none; }
  .erh-pstrip__num { font-size:22px; }
  .erh-pstrip__hours { font-size:12px; }
  /* Finance strip */
  .erh-finance__logos { gap:16px; }
  .erh-finance__logo-img { height:28px; }
  .erh-enquiry__fin-img { height:28px; padding:6px 10px; }
}
</style>

<div class="taas-erh">

<!-- ══ BREADCRUMB ════════════════════════════════════════════════════════ -->
<nav class="erh-bc" aria-label="Breadcrumb"><div class="erh-w">
  <ol class="erh-bc__list">
    <li><a href="<?php echo esc_url($site_url); ?>">Home</a></li>
    <li class="erh-bc__sep">›</li>
    <li><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a></li>
    <li class="erh-bc__sep">›</li>
    <li class="erh-bc__current">Engine Repairs</li>
  </ol>
</div></nav>

<!-- ══ HERO ══════════════════════════════════════════════════════════════ -->
<section class="erh-hero<?php echo $hero_image ? ' erh-hero--has-image' : ''; ?>"<?php echo $hero_image ? ' style="background-image:url(' . esc_url($site_url . $hero_image) . ');"' : ''; ?>>
  <div class="erh-w">
    <div class="erh-hero__inner">
      <div>
        <span class="erh-hero__eyebrow">Engine Repairs — Manukau</span>
        <h1>Engine Repairs<br><span>Manukau — South Auckland</span></h1>
        <p class="erh-hero__sub">Oil leaks, engine noise, misfires, oil consumption, head gaskets and more — diagnosed properly, repaired in-house. We keep you informed at every stage. <?php echo esc_html($years_trading); ?> years of workshop experience.</p>
        <div class="erh-hero__ctas">
          <a href="#erh-enquire" class="erh-btn erh-btn--primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
            Book a Diagnostic
          </a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="erh-btn erh-btn--outline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <?php echo esc_html($phone_free); ?>
          </a>
        </div>
      </div>
      <div class="erh-sidebar">
        <div class="erh-sidebar__title">What We Repair</div>
        <ul class="erh-sidebar__list">
          <li>Oil leak diagnosis and repair</li>
          <li>Engine noise investigation</li>
          <li>Misfire diagnosis and repair</li>
          <li>Oil consumption testing</li>
          <li>Head gasket replacement</li>
          <li>Engine mount replacement</li>
          <li>Valve cover and sump gaskets</li>
          <li>Timing chain and cambelt</li>
          <li>Compression and leak-down testing</li>
          <li>European engine specialists</li>
        </ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="erh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="erh-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ══════════════════════════════════════════════════════ -->
<div class="erh-pstrip"><div class="erh-w">
  <div class="erh-pstrip__inner">
    <div class="erh-pstrip__left">
      <span class="erh-pstrip__lbl">Book Now</span>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="erh-pstrip__num"><?php echo esc_html($phone_free); ?></a>
      <span class="erh-pstrip__hours"><?php echo esc_html($hours); ?></span>
    </div>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="erh-pstrip__email">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      <?php echo esc_html($email); ?>
    </a>
  </div>
</div></div>

<!-- ══ TRUST ═════════════════════════════════════════════════════════════ -->
<div class="erh-trust"><div class="erh-w">
  <div class="erh-trust__inner">
    <div class="erh-trust__item">MTA Assured</div>
    <div class="erh-trust__item">NZTA Authorised</div>
    <div class="erh-trust__item">Estimate Before We Start</div>
    <div class="erh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="erh-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div></div>

<!-- ══ WHAT WE DIAGNOSE & REPAIR ════════════════════════════════════════ -->
<section class="erh-section erh-section--white">
  <div class="erh-w">
    <span class="erh-section__eyebrow">Engine Division</span>
    <h2 class="erh-section__heading">What we diagnose and repair</h2>
    <p class="erh-section__sub">Engine problems rarely fix themselves. The sooner you get it looked at, the less it costs to put right. We diagnose first, explain clearly, then repair — with your approval at every step.</p>
    <div class="erh-services">
      <a href="<?php echo esc_url($site_url . '/engine-oil-leak-repair/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('OL'); ?></div>
        <div class="erh-service__title">Oil Leak Diagnosis &amp; Repair</div>
        <p class="erh-service__desc">Rocker cover gaskets, sump gaskets, cam seals, crank seals, oil cooler seals. We find the source first — sometimes what looks like one leak is actually two.</p>
        <span class="erh-service__link">Oil Leak Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/engine-misfire-diagnosis/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('MF'); ?></div>
        <div class="erh-service__title">Misfire Diagnosis &amp; Repair</div>
        <p class="erh-service__desc">Spark plugs, ignition coils, fuel injectors, vacuum leaks, low compression. We use scan data and live testing to identify which cylinder and why.</p>
        <span class="erh-service__link">Misfire Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/engine-noise-diagnosis/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('EN'); ?></div>
        <div class="erh-service__title">Engine Noise Investigation</div>
        <p class="erh-service__desc">Knocking, ticking, rattling, whining — every noise has a cause. We use stethoscope diagnosis and systematic testing to isolate the source.</p>
        <span class="erh-service__link">Noise Diagnosis →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/head-gasket-repair-manukau/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('HG'); ?></div>
        <div class="erh-service__title">Head Gasket Replacement</div>
        <p class="erh-service__desc">Pressure testing, combustion gas checks, head machining if required. We confirm the diagnosis before committing to this significant repair.</p>
        <span class="erh-service__link">Head Gasket Info →</span>
      </a>
    </div>
  </div>
</section>

<!-- ══ OUR APPROACH ═════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--grey">
  <div class="erh-w">
    <span class="erh-section__eyebrow">How We Work</span>
    <h2 class="erh-section__heading">Our approach to engine repairs</h2>
    <div class="erh-approach">
      <div>
        <p class="erh-approach__text">Engine repairs can be stressful. The symptoms are alarming, the terminology is unfamiliar, and the costs can be significant. We understand that — which is why we break everything down in plain English and never start work without your approval.</p>
        <p class="erh-approach__text">Every engine repair starts with a diagnostic. We use a combination of scan tools, mechanical testing, and visual inspection to identify the actual fault. We then explain what we have found, what it means, and what the repair involves — including the cost. You decide whether to proceed.</p>
        <div class="erh-callout">
          <div class="erh-callout__title">We diagnose first — always</div>
          <p class="erh-callout__body">No guesswork. No replacing parts on a hunch. We confirm the fault before recommending the repair. Diagnostic assessment from <?php echo esc_html($scan_price); ?> (scan) or <?php echo esc_html($mech_diag); ?> (full mechanical).</p>
        </div>
      </div>
      <div class="erh-panel">
        <div class="erh-panel__title">What You Can Expect</div>
        <ul class="erh-panel__list">
          <li>Diagnostic scan and mechanical assessment</li>
          <li>Clear explanation of the fault in plain English</li>
          <li>Written estimate before any repair begins</li>
          <li>Your approval at every stage</li>
          <li>Updates while the work is in progress</li>
          <li>Parts shown to you on request</li>
          <li>Road test and quality check before handover</li>
          <li>All work guaranteed</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══ COMMON ENGINE PROBLEMS ═══════════════════════════════════════════ -->
<section class="erh-section erh-section--white">
  <div class="erh-w">
    <span class="erh-section__eyebrow">Common Faults</span>
    <h2 class="erh-section__heading">Common engine problems we see daily</h2>
    <p class="erh-section__sub">These are the engine issues that come through our workshop most often. If you are experiencing any of these, book a diagnostic before it gets worse.</p>
    <div class="erh-problems">
      <div>
        <h3>Oil on the ground where you park</h3>
        <p>Usually a gasket or seal failure — rocker cover, sump, cam seal, crank seal. Left unchecked, oil level drops and engine damage follows. We find the source and repair it.</p>
      </div>
      <div>
        <h3>Check engine light on the dash</h3>
        <p>A solid light means a stored fault — get it scanned. A flashing light means an active misfire — stop driving and call us. Ignoring it risks catalytic converter damage.</p>
      </div>
      <div>
        <h3>Engine knocking, ticking or rattling</h3>
        <p>Could be anything from a worn timing chain to low oil pressure to a failing hydraulic lifter. The noise itself tells us a lot — we use stethoscope diagnosis to isolate it.</p>
      </div>
      <div>
        <h3>Rough idle or loss of power</h3>
        <p>Often a misfire caused by spark plugs, coils, injectors or vacuum leaks. Could also be a clogged EGR, failing sensor, or compression issue. Scan data narrows it down fast.</p>
      </div>
      <div>
        <h3>Using too much oil between services</h3>
        <p>If you are topping up oil regularly, there is a leak or internal consumption issue. We test for both — external leak inspection plus compression and leak-down testing for internal wear.</p>
      </div>
      <div>
        <h3>Overheating</h3>
        <p>Coolant leaks, thermostat failure, water pump failure, head gasket failure, blocked radiator. Do not drive an overheating vehicle — the repair cost escalates dramatically. Call us for a tow-in.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════ -->
<div class="erh-finance"><div class="erh-w">
  <div class="erh-finance__inner">
    <div class="erh-finance__heading">Unexpected Repair? Spread the Cost.</div>
    <p class="erh-finance__sub">Engine repairs are rarely planned. Interest-free finance available on most options.</p>
    <div class="erh-finance__logos">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="erh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="erh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="erh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="erh-finance__logo-img" height="36" loading="lazy">
    </div>
    <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="erh-finance__link">View all finance options →</a>
  </div>
</div></div>

<!-- ══ ENQUIRY ═══════════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--dark" id="erh-enquire" style="border-top:3px solid var(--taas-yellow,#FFC800);">
  <div class="erh-w">
    <div class="erh-enquiry">
      <div>
        <span class="erh-section__eyebrow">Book or Enquire</span>
        <h2 class="erh-section__heading">Book an Engine Diagnostic</h2>
        <p style="font-size:15px;font-weight:300;color:#aaa;line-height:1.75;letter-spacing:-0.1px;margin-bottom:8px;">Tell us your vehicle make, model and what symptoms you have noticed — noises, warning lights, oil loss, rough running.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="erh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="erh-enquiry__detail">
          <strong>Tony Allen Auto Service</strong><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>
          <?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?>
        </div>
        <div class="erh-enquiry__estimate">Estimate before we start — nothing happens without your approval.</div>
        <div class="erh-enquiry__finance-logos">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="erh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="erh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="erh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="erh-enquiry__fin-img" height="32" loading="lazy">
        </div>
        <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="erh-enquiry__fin-link">Finance options →</a>
      </div>
      <div>
        <div class="erh-enquiry__form-title">Send Us Your Details</div>
        <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
        <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow,#FFC800);"><?php echo esc_html($phone_free); ?></a> or email <a href="mailto:<?php echo esc_attr($email); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;"><?php echo esc_html($email); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══ MBI ═══════════════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--grey">
  <div class="erh-w">
    <div class="erh-mbi">
      <span class="erh-section__eyebrow">MBI Approved Repairer</span>
      <h2 class="erh-section__heading">Got an MBI policy? We handle the claim.</h2>
      <p class="erh-mbi__text">Engine repairs are one of the most common MBI claims. Tony Allen Auto Service is an approved repairer for all four major MBI providers in New Zealand. Call your provider first, then bring your vehicle to us. We liaise with the insurer, get the work authorised, and carry out the repair. You pay the excess — your insurer pays the balance.</p>
      <div class="erh-mbi__badges">
        <span class="erh-mbi__badge">Autosure</span>
        <span class="erh-mbi__badge">Assurant</span>
        <span class="erh-mbi__badge">Provident</span>
        <span class="erh-mbi__badge">Janssen</span>
        <span class="erh-mbi__badge">Autolife</span>
      </div>
      <a href="<?php echo esc_url($site_url . '/mechanical-breakdown-insurance/'); ?>" class="erh-btn erh-btn--primary">MBI Information →</a>
    </div>
  </div>
</section>

<!-- ══ REVIEWS ═══════════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--white">
  <div class="erh-w">
    <span class="erh-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="erh-section__heading">What Customers Say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══ RELATED ═══════════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--grey">
  <div class="erh-w">
    <span class="erh-section__eyebrow">Also at TAAS</span>
    <h2 class="erh-section__heading">Related Services</h2>
    <p class="erh-section__sub">Engine work often connects to other systems. These divisions work alongside the engine team at the same address.</p>
    <div class="erh-related">
      <a href="<?php echo esc_url($site_url . '/cambelts-and-water-pumps/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('CB'); ?></div>
        <div class="erh-service__title">Cambelts &amp; Water Pumps</div>
        <p class="erh-service__desc">Replace on schedule — a snapped cambelt destroys the engine. We do the full kit: belt, tensioner, water pump.</p>
        <span class="erh-service__link">Cambelt Info →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/cooling-system/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('CS'); ?></div>
        <div class="erh-service__title">Cooling System</div>
        <p class="erh-service__desc">Overheating causes head gasket failure and warped heads. Radiators, thermostats, water pumps, coolant leaks — all done in-house.</p>
        <span class="erh-service__link">Cooling System →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/transmission-service-and-repair/'); ?>" class="erh-service">
        <div class="erh-service__icon"><?php echo erh_badge('TS'); ?></div>
        <div class="erh-service__title">Transmission Service</div>
        <p class="erh-service__desc">Auto and manual gearbox service and repair. CVT fluid changes, DSG service, transmission fluid flush.</p>
        <span class="erh-service__link">Transmission Info →</span>
      </a>
    </div>
  </div>
</section>

<!-- ══ FAQ ═══════════════════════════════════════════════════════════════ -->
<section class="erh-section erh-section--white">
  <div class="erh-w">
    <span class="erh-section__eyebrow">FAQ</span>
    <h2 class="erh-section__heading">Engine Repair Questions Answered</h2>
    <div class="erh-faq__list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'erh-faq-q-' . $fi;
        $aid = 'erh-faq-a-' . $fi;
      ?>
      <div class="erh-faq__item<?php echo $fi === 0 ? ' erh-faq__item--open' : ''; ?>">
        <button class="erh-faq__q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="erh-faq__a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- .taas-erh -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('.erh-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = this.closest('.erh-faq__item');
      var wasOpen = item.classList.contains('erh-faq__item--open');
      document.querySelectorAll('.erh-faq__item--open').forEach(function(i){
        i.classList.remove('erh-faq__item--open');
        i.querySelector('.erh-faq__q').setAttribute('aria-expanded','false');
      });
      if (!wasOpen) {
        item.classList.add('erh-faq__item--open');
        this.setAttribute('aria-expanded','true');
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
