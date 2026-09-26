<?php
/**
 * Template Name: Pre-Purchase Inspection
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /pre-purchase-inspection-manukau/
 * CSS namespace: .ppi-
 * Standalone page — three-tier pricing, centred hero
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
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$euro_brands   = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_free);

$ppi_basic    = defined('TAAS_PPI_BASIC')    ? TAAS_PPI_BASIC    : '$149';
$ppi_standard = defined('TAAS_PPI_STANDARD') ? TAAS_PPI_STANDARD : '$229';
$ppi_premium  = defined('TAAS_PPI_PREMIUM')  ? TAAS_PPI_PREMIUM  : '$329';

// ── FAQ ──────────────────────────────────────────────────────────────────────
$faqs = [
    $taas_faqs['ppi_duration'],
    $taas_faqs['ppi_mobile'],
    $taas_faqs['ppi_seller_refuses'],
    $taas_faqs['ppi_present'],
    $taas_faqs['ppi_any_make'],
    $taas_faqs['ppi_problems'],
    $taas_faqs['ppi_report'],
    $taas_faqs['ppi_carjam'],
    $taas_faqs['ppi_body_paint'],
    $taas_faqs['ppi_vs_aa'],
    $taas_faqs['ppi_compression'],
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
            'description' => 'Pre-purchase vehicle inspections in Manukau, South Auckland. Three inspection tiers from ' . strip_tags($ppi_basic) . '. Independent assessment with written report and repair cost estimates.',
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
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => TAAS_RATING,
                                  'reviewCount' => preg_replace('/\D+/', '', TAAS_REVIEWS), 'bestRating' => '5'],
            'sameAs'         => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'paymentAccepted'=> 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'priceRange'     => '$$',
            'areaServed'     => 'South Auckland',
            'memberOf'       => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        [
            '@type'      => 'Service',
            'name'       => 'Pre-Purchase Vehicle Inspection',
            'provider'   => ['@id' => $site_url . '/#organization'],
            'areaServed' => 'South Auckland',
            'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'PPI Tiers', 'itemListElement' => [
                ['@type' => 'Offer', 'name' => 'Basic Pre-Purchase Inspection', 'price' => preg_replace('/[^0-9.]/', '', $ppi_basic), 'priceCurrency' => 'NZD', 'description' => 'Visual and electronic check — underbody, engine bay, OBD scan, battery test, written checklist report. 45–60 minutes.'],
                ['@type' => 'Offer', 'name' => 'Standard Pre-Purchase Inspection', 'price' => preg_replace('/[^0-9.]/', '', $ppi_standard), 'priceCurrency' => 'NZD', 'description' => 'Full road test, detailed suspension assessment, brake disc measurement, cambelt history, AC test, detailed written report with purchase recommendation. 60–75 minutes.'],
                ['@type' => 'Offer', 'name' => 'Premium Pre-Purchase Inspection', 'price' => preg_replace('/[^0-9.]/', '', $ppi_premium), 'priceCurrency' => 'NZD', 'description' => 'Relative compression test, Carjam vehicle history, European-specific checks, hybrid/EV battery health, full written report with photos. 75–90 minutes.'],
            ]],
        ],
        [
            '@type'          => 'SpeakableSpecification',
            'cssSelector'    => ['.ppi-hero__sub', '.ppi-faq__a:first-of-type p'],
        ],
        [
            '@type'       => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Pre-Purchase Inspection', 'item' => $page_url],
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
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-pre-purchase-inspection .site-content,
.page-template-template-pre-purchase-inspection .entry-content,
.page-template-template-pre-purchase-inspection .entry-header,
.page-template-template-pre-purchase-inspection article,
.page-template-template-pre-purchase-inspection #primary,
.page-template-template-pre-purchase-inspection #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-pre-purchase-inspection { overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300; }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.ppi-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; text-align: center; }
.ppi-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.ppi-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 5px 14px; border-radius: 3px; margin-bottom: 20px; }
.ppi-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.ppi-hero h1 span { color: var(--taas-yellow, #FFC800); }
.ppi-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 640px; margin: 0 auto 28px; line-height: 1.75; }
.ppi-hero__ctas { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* ── Trust ─────────────────────────────────────────────────────────────────── */
.ppi-phonestrip{background:var(--taas-yellow,#FFC800);padding:13px 0;}.ppi-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.ppi-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.ppi-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;}.ppi-phonestrip__num:hover{opacity:.65;}
.ppi-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.ppi-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.ppi-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.ppi-trust__item::before { content: '✓'; font-weight: 900; }

/* ── Sections ─────────────────────────────────────────────────────────────── */
.ppi-section { padding: var(--taas-sec-pad, 72px) 0; }
.ppi-section--white { background: var(--taas-white, #FFFFFF); }
.ppi-section--grey  { background: var(--taas-panel, #F7F7F5); }
.ppi-section--dark  { background: var(--taas-dark, #1A1A1A); }
.ppi-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.ppi-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.ppi-section--dark .ppi-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ppi-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.ppi-section--dark .ppi-section__heading { color: var(--taas-white, #FFFFFF); }
.ppi-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 36px; line-height: 1.75; }
.ppi-section--dark .ppi-section__sub { color: #aaa; }

/* ── Tier cards ────────────────────────────────────────────────────────────── */
.ppi-tiers { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.ppi-tier { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 32px 28px; display: flex; flex-direction: column; position: relative; transition: box-shadow 0.2s, transform 0.2s; }
.ppi-tier:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); transform: translateY(-3px); }
.ppi-tier--featured { border-color: var(--taas-yellow, #FFC800); border-width: 2px; }
.ppi-tier--featured::before { content: 'Most Popular'; position: absolute; top: -13px; left: 50%; transform: translateX(-50%); background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; padding: 4px 14px; border-radius: 20px; white-space: nowrap; }
.ppi-tier__name { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-mid, #666666); margin-bottom: 8px; }
.ppi-tier__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(32px, 4vw, 42px); font-weight: 800; color: var(--taas-black, #111111); margin-bottom: 4px; }
.ppi-tier__time { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); margin-bottom: 20px; }
.ppi-tier__desc { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); line-height: 1.6; margin-bottom: 20px; }
.ppi-tier__list { list-style: none; padding: 0; margin: 0 0 24px; display: flex; flex-direction: column; gap: 8px; flex: 1; }
.ppi-tier__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-body, #333333); padding-left: 20px; position: relative; line-height: 1.5; }
.ppi-tier__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }
.ppi-tier__cta { display: block; text-align: center; padding: 12px 20px; border-radius: var(--taas-radius, 6px); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-btn-size, 14px); font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; transition: background 0.15s, color 0.15s; margin-top: auto; }
.ppi-tier__cta--primary { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ppi-tier__cta--primary:hover { background: var(--taas-yellow2, #e6b400); }
.ppi-tier__cta--outline { background: transparent; color: var(--taas-dark, #1A1A1A); border: 2px solid var(--taas-dark, #1A1A1A); }
.ppi-tier__cta--outline:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); }
.ppi-tier__expand{width:100%;background:none;border:1px solid var(--taas-border,#E8E8E4);padding:10px;font-family:var(--taas-font,"Inter",Arial,sans-serif);font-size:13px;font-weight:600;color:var(--taas-mid,#666);cursor:pointer;margin:12px 0 8px;transition:all .15s;border-radius:var(--taas-radius,6px);}
.ppi-tier__expand:hover{border-color:var(--taas-yellow,#FFC800);color:var(--taas-yellow,#FFC800);}
.ppi-tier__expand[aria-expanded="true"]{border-color:var(--taas-yellow,#FFC800);color:var(--taas-yellow,#FFC800);}
.ppi-tier__detail{padding:16px 0 8px;font-size:13px;color:var(--taas-body,#333);line-height:1.75;}
.ppi-tier__detail p{margin-bottom:8px;}
.ppi-tier__detail strong{font-weight:700;color:var(--taas-black,#111);}
.ppi-tier__badge{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:10px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:4px 12px;margin-bottom:8px;border-radius:3px;}
.ppi-tier__tag{font-size:14px;color:var(--taas-mid,#666);margin-bottom:8px;line-height:1.75;font-style:italic;}
.ppi-tier__best{font-size:13px;color:var(--taas-body,#333);line-height:1.75;margin-bottom:14px;}

/* ── Why section ──────────────────────────────────────────────────────────── */
.ppi-why { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.ppi-why__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.ppi-why__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); padding-left: 24px; position: relative; line-height: 1.6; }
.ppi-why__list li::before { content: '✗'; position: absolute; left: 0; color: var(--taas-alert, #C0392B); font-weight: 700; }
.ppi-why__panel { background: var(--taas-dark, #1A1A1A); border-radius: var(--taas-radius, 6px); padding: 32px 28px; }
.ppi-why__panel-title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 16px; }
.ppi-why__panel-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.ppi-why__panel-list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: #ccc; padding-left: 20px; position: relative; line-height: 1.5; }
.ppi-why__panel-list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }

/* ── Process ──────────────────────────────────────────────────────────────── */
.ppi-process { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; counter-reset: ppi-step; }
.ppi-step { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 28px 24px; position: relative; counter-increment: ppi-step; }
.ppi-step::before { content: counter(ppi-step); display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; font-weight: 800; border-radius: 50%; margin-bottom: 14px; }
.ppi-step__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 8px; }
.ppi-step__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.6; }

/* ── Compression callout ──────────────────────────────────────────────────── */
.ppi-callout { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; margin-top: 32px; }
.ppi-callout__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.ppi-callout__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); line-height: 1.75; }

/* ── Enquiry ──────────────────────────────────────────────────────────────── */
.ppi-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.ppi-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.ppi-enquiry__phone:hover { color: #fff; }
.ppi-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.ppi-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }
.ppi-section--dark .wpcf7 label, .ppi-section--dark .wpcf7 span:not(.wpcf7-spinner), .ppi-section--dark .wpcf7 div:not(.wpcf7-response-output), .ppi-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; }
.ppi-section--dark .wpcf7 input[type="text"], .ppi-section--dark .wpcf7 input[type="email"], .ppi-section--dark .wpcf7 input[type="tel"], .ppi-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.ppi-section--dark .wpcf7 input::placeholder, .ppi-section--dark .wpcf7 textarea::placeholder { color: #666; }
.ppi-section--dark .wpcf7 input:focus, .ppi-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.ppi-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.ppi-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

/* ── Related ──────────────────────────────────────────────────────────────── */
.ppi-related { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }
.ppi-related a { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); text-decoration: none; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); transition: border-color 0.15s; }
.ppi-related a:hover { border-color: var(--taas-yellow, #FFC800); }
.ppi-related a span { color: var(--taas-yellow, #FFC800); font-size: 18px; }

/* ── FAQ ──────────────────────────────────────────────────────────────────── */
.ppi-faq__list { display: flex; flex-direction: column; gap: 0; max-width: 780px; margin: 28px auto 0; }
.ppi-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.ppi-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.ppi-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); transition: transform 0.2s; }
.ppi-faq__item--open .ppi-faq__q::after { content: '−'; }
.ppi-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.ppi-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.ppi-faq__a a:hover { text-decoration: underline; }
.ppi-faq__item--open .ppi-faq__a { display: block; }

/* ── Buttons ──────────────────────────────────────────────────────────────── */
.ppi-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: var(--taas-radius, 6px); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-btn-size, 14px); font-weight: 700; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; transition: background 0.15s, color 0.15s, border-color 0.15s; }
.ppi-btn--primary { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.ppi-btn--primary:hover { background: var(--taas-yellow2, #e6b400); }
.ppi-btn--outline { background: transparent; color: var(--taas-yellow, #FFC800); border: 2px solid var(--taas-yellow, #FFC800); }
.ppi-btn--outline:hover { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }

/* ── Responsive ───────────────────────────────────────────────────────────── */
@media (max-width: 960px) {
  .ppi-tiers { grid-template-columns: 1fr; max-width: 480px; margin: 0 auto; }
  .ppi-why { grid-template-columns: 1fr; }
  .ppi-enquiry { grid-template-columns: 1fr; gap: 32px; }
  .ppi-related { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .ppi-hero { padding: 48px 0 40px; }
  .ppi-hero h1 { font-size: clamp(28px, 7vw, 42px); }
  .ppi-hero__sub { font-size: 14px; }
  .ppi-hero__ctas { flex-direction: column; align-items: stretch; }
  .ppi-hero__ctas .ppi-btn { justify-content: center; text-align: center; }
  .ppi-section { padding: 48px 0; }
  .ppi-section__heading { font-size: clamp(22px, 5vw, 28px); }
  .ppi-section__sub { font-size: 14px; }
  .ppi-tiers { max-width: 100%; }
  .ppi-tier__price { font-size: clamp(28px, 6vw, 36px); }
  .ppi-process { grid-template-columns: 1fr; }
  .ppi-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .ppi-trust__item { font-size: 12px; }
  .ppi-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .ppi-faq__a { font-size: 13px; }
  .ppi-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
}
</style>

<!-- ══ HERO ══════════════════════════════════════════════════════════════════ -->
<section class="ppi-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="ppi-hero__inner">
    <span class="ppi-hero__eyebrow">Pre-Purchase Inspection — Manukau</span>
    <h1>Pre-Purchase Vehicle<br><span>Inspection</span></h1>
    <p style="font-size:18px;font-weight:600;color:var(--taas-yellow,#FFC800);margin:0 0 16px;font-family:var(--taas-font,'Inter',Arial,sans-serif);">Don't buy a used car without one.</p>
    <p class="ppi-hero__sub">Buying a used car is one of the biggest purchases you'll make. A pre-purchase inspection gives you the full picture before you commit — what's good, what needs attention, and what could cost you down the road. Independent inspections by MTA Assured technicians. Serving South Auckland since <?php echo esc_html($established); ?>.</p>
    <div class="ppi-hero__ctas">
      <a href="#enquire" class="ppi-btn ppi-btn--primary">Book an Inspection</a>
      <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" class="ppi-btn ppi-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ═══════════════════════════════════════════════════════════ -->
<div class="ppi-phonestrip"><div class="ppi-phonestrip__inner"><span class="ppi-phonestrip__label">Book your inspection</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="ppi-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<!-- ══ TRUST ═════════════════════════════════════════════════════════════════ -->
<div class="ppi-trust">
  <div class="ppi-trust__inner">
    <div class="ppi-trust__item">MTA Assured</div>
    <div class="ppi-trust__item">NZTA Authorised</div>
    <div class="ppi-trust__item"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</div>
    <div class="ppi-trust__item">Independent — No Relationship With Seller</div>
    <div class="ppi-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div>

<!-- ══ WHY — WOF vs PPI ═════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--white">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">Why It Matters</span>
    <h2 class="ppi-section__heading">What a WOF Doesn't Check</h2>
    <p class="ppi-section__sub">A current WOF means the vehicle is safe to drive today. It tells you nothing about how long it will stay that way — or how much it will cost you over the next 12 months.</p>
    <div class="ppi-why">
      <div>
        <ul class="ppi-why__list">
          <li>Engine compression and internal condition</li>
          <li>Oil and fluid health</li>
          <li>Cambelt history and service records</li>
          <li>Transmission behaviour under load</li>
          <li>Air conditioning performance</li>
          <li>Brake disc thickness against minimum spec</li>
          <li>Accident history and structural repair</li>
          <li>Finance registered against the vehicle</li>
        </ul>
      </div>
      <div class="ppi-why__panel">
        <div class="ppi-why__panel-title">A TAAS Pre-Purchase Inspection Checks</div>
        <ul class="ppi-why__panel-list">
          <li>All of the above — depending on the tier you choose</li>
          <li>Written report with condition ratings</li>
          <li>Repair cost estimates for everything identified</li>
          <li>Clear recommendation — buy, buy with conditions, or don't buy</li>
          <li>Verbal debrief with the inspecting technician</li>
          <li>Independent assessment — we work for you, not the seller</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══ TIER CARDS ════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--grey">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">Choose Your Level</span>
    <h2 class="ppi-section__heading">Three Inspection Tiers</h2>
    <p class="ppi-section__sub">The right tier depends on the vehicle and what you need to know. Not sure? Call us on <?php echo esc_html(TAAS_PHONE_FREE); ?> and we'll recommend the best option.</p>

    <div class="ppi-tiers">
      <!-- BASIC -->
      <div class="ppi-tier">
        <div class="ppi-tier__name">Basic</div>
        <div class="ppi-tier__price"><?php echo esc_html($ppi_basic); ?> <span style="font-size:12px;font-weight:400;color:#888;">incl. GST</span></div>
        <p class="ppi-tier__tag">Essential safety and condition check</p>
        <p class="ppi-tier__best"><strong>Best for:</strong> Vehicles under $10,000 — covers the fundamentals so you know what you're buying.</p>
        <ul class="ppi-tier__list">
          <li>Visual inspection across all major systems</li>
          <li>OBD fault code scan</li>
          <li>12V battery health test</li>
          <li>Short road test</li>
          <li>Written checklist report</li>
        </ul>
        <button class="ppi-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="ppi-tier__detail" style="display:none;">
          <p><strong>Exterior:</strong> Body condition, glass and windscreen, all lights, wiper blades</p>
          <p><strong>Engine Bay:</strong> All fluid levels and condition, drive belt condition, leak check, air filter visual, 12V battery health test</p>
          <p><strong>Tyres:</strong> Tread depth all four, condition and wear pattern, spare tyre, matching brands and sizes</p>
          <p><strong>Brakes:</strong> Front and rear pad condition — visual (wheels on). Disc condition — good/scored/worn</p>
          <p><strong>Interior:</strong> Seats, dashboard warning lights, radio/Bluetooth/USB, instrument cluster, carpet and headliner</p>
          <p><strong>Underbody:</strong> Rust and corrosion check, leak check from underneath, exhaust condition</p>
          <p><strong>Road Test:</strong> Short drive up to 50 km/h — engine start/idle, noise and vibration check</p>
          <p><strong>Diagnostics:</strong> OBD fault code scan — stored codes, pending codes, readiness monitors</p>
          <p><strong>Report:</strong> Written checklist — Good / Fair / Poor per item. Verbal debrief with your technician</p>
          <p style="font-size:12px;color:#999;margin-top:12px;"><em>Does not include: suspension and steering assessment, cooling system pressure test, brake roller test, disc measurement, air conditioning check, Carjam history, repair cost estimates, or purchase recommendation.</em></p>
        </div>
        <a href="#enquire" class="ppi-tier__cta ppi-tier__cta--outline">Book Basic</a>
      </div>

      <!-- STANDARD -->
      <div class="ppi-tier ppi-tier--featured">
        <span class="ppi-tier__badge">Most Popular</span>
        <div class="ppi-tier__name">Standard</div>
        <div class="ppi-tier__price"><?php echo esc_html($ppi_standard); ?> <span style="font-size:12px;font-weight:400;color:#888;">incl. GST</span></div>
        <p class="ppi-tier__tag">Comprehensive mechanical assessment</p>
        <p class="ppi-tier__best"><strong>Best for:</strong> Any used vehicle purchase. Covers everything a buyer needs to make a confident decision.</p>
        <ul class="ppi-tier__list">
          <li>Everything in Basic plus:</li>
          <li>Brake roller test</li>
          <li>Cooling system pressure test</li>
          <li>Full steering and suspension check</li>
          <li>Full hoist underbody</li>
          <li>Thorough road test</li>
          <li>AC check</li>
          <li>Repair cost estimates</li>
          <li>Buy / Buy with conditions / Do not buy recommendation</li>
        </ul>
        <button class="ppi-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="ppi-tier__detail" style="display:none;">
          <p style="font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:8px;">Everything in Basic, plus…</p>
          <p><strong>Engine Bay — Extended:</strong> Cambelt history and visual check, radiator and hose condition, transmission fluid check</p>
          <p><strong>Brakes — Full Assessment:</strong> Brake roller test (braking efficiency per wheel), brake fluid condition test, caliper function check, handbrake/park brake operation</p>
          <p><strong>Steering & Suspension:</strong> Shock absorbers, bushes, ball joints, CV boots and driveshafts, steering rack and boots, wheel bearings, tie rod ends</p>
          <p><strong>Cooling System:</strong> Pressure test, radiator cap test, hose condition, water pump assessment</p>
          <p><strong>Interior — Extended:</strong> Air conditioning function and temperature, all power windows, central locking, heated seats and electric mirrors (where fitted)</p>
          <p><strong>Underbody — Full Hoist:</strong> Chassis rail integrity, subframe condition, sill panels and floor, fuel and brake line condition</p>
          <p><strong>Road Test — Thorough:</strong> Engine under load, transmission shift quality/clutch, brakes under load, steering response, suspension feel</p>
          <p><strong>Report — Detailed:</strong> Condition rating per system, repair cost estimates, clear purchase recommendation: Buy / Buy with conditions / Do not buy. Verbal debrief</p>
        </div>
        <a href="#enquire" class="ppi-tier__cta ppi-tier__cta--primary">Book Standard</a>
      </div>

      <!-- PREMIUM -->
      <div class="ppi-tier">
        <div class="ppi-tier__name">Premium</div>
        <div class="ppi-tier__price"><?php echo esc_html($ppi_premium); ?> <span style="font-size:12px;font-weight:400;color:#888;">incl. GST</span></div>
        <p class="ppi-tier__tag">The complete picture — engine health, wheels off, and specialist checks</p>
        <p class="ppi-tier__best"><strong>Best for:</strong> Higher-value vehicles, European cars, performance vehicles, or any purchase where you want nothing left to chance.</p>
        <ul class="ppi-tier__list">
          <li>Everything in Standard plus:</li>
          <li>Wheels removed for direct brake inspection</li>
          <li>Relative compression test</li>
          <li>European specialist checks</li>
          <li>Photos of all concerns</li>
          <li>Senior technician debrief</li>
        </ul>
        <button class="ppi-tier__expand" aria-expanded="false" onclick="this.setAttribute('aria-expanded',this.getAttribute('aria-expanded')==='true'?'false':'true');this.nextElementSibling.style.display=this.getAttribute('aria-expanded')==='true'?'block':'none';">What's Included ▾</button>
        <div class="ppi-tier__detail" style="display:none;">
          <p style="font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:8px;">Everything in Standard, plus…</p>
          <p><strong>Brakes — Wheels Removed:</strong> Direct pad inspection and disc measurement against manufacturer minimum specification. Full visual caliper inspection</p>
          <p><strong>Engine Health:</strong> Relative compression test — confirms engine health across all cylinders. Non-invasive assessment that flags internal engine wear</p>
          <p><strong>European Specialist Checks (where applicable):</strong> DSG/DCT fluid condition, air suspension assessment, brand-specific known fault check</p>
          <p><strong>Documentation:</strong> Photos of all concerns identified. Full written report with cost estimates for every item. Clear Buy / Buy with conditions / Do not buy recommendation. Verbal debrief with a senior technician</p>
        </div>
        <a href="#enquire" class="ppi-tier__cta ppi-tier__cta--outline">Book Premium</a>
      </div>
    </div>

    <!-- Carjam add-on -->
    <div class="ppi-callout" style="margin-top:32px;">
      <div class="ppi-callout__title">Add a Carjam Vehicle History Report — $25</div>
      <p class="ppi-callout__body">Know the full history before you buy. A Carjam report checks ownership count, odometer reading history for discrepancies, finance and security interests, stolen vehicle flags, accident and write-off history, and import details. Available as an add-on with any inspection level. Just let us know when you book.</p>
    </div>

    <!-- EV/Hybrid add-on -->
    <div class="ppi-callout" style="margin-top:16px;">
      <div class="ppi-callout__title">Buying a Hybrid or EV?</div>
      <p class="ppi-callout__body">Add our EV/Hybrid Battery Health Assessment to your inspection for $100, or book it as a standalone service. We read the traction battery cell data and produce a full report covering cell balance, voltage consistency, remaining capacity, and degradation assessment. Essential for any hybrid or EV purchase where battery condition is a major factor in vehicle value.</p>
      <p style="margin-top:10px;"><a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:700;font-size:14px;text-decoration:none;">Ask about battery health testing — <?php echo esc_html($phone_free); ?></a></p>
    </div>
  </div>
</section>

<!-- ══ PROCESS ═══════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--white">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">How It Works</span>
    <h2 class="ppi-section__heading">Three Simple Steps</h2>
    <p class="ppi-section__sub">Book ahead so we can allocate the right amount of time for your vehicle and chosen tier.</p>
    <div class="ppi-process">
      <div class="ppi-step">
        <div class="ppi-step__title">Book Your Inspection</div>
        <p class="ppi-step__body">Call <?php echo esc_html(TAAS_PHONE_FREE); ?> or use the form below. Tell us the vehicle make, model, and year — plus which tier you want. We'll book a time that works for you.</p>
      </div>
      <div class="ppi-step">
        <div class="ppi-step__title">Bring the Vehicle In</div>
        <p class="ppi-step__body">You or the seller brings the vehicle to <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>. We inspect it on the hoist, scan tools, and road test — independently and thoroughly.</p>
      </div>
      <div class="ppi-step">
        <div class="ppi-step__title">Get Your Report</div>
        <p class="ppi-step__body">You receive a written report with condition ratings, repair cost estimates for everything identified, and a clear purchase recommendation. Use it to negotiate, request repairs, or walk away.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ ENQUIRY ═══════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--dark" id="enquire">
  <div class="ppi-section__inner">
    <div class="ppi-enquiry">
      <div>
        <span class="ppi-section__eyebrow">Book or Enquire</span>
        <h2 class="ppi-section__heading">Book Your Pre-Purchase Inspection</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us the vehicle make, model, year, and which tier you'd like. We'll confirm availability and book you in.</p>
        <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" class="ppi-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="ppi-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode(TAAS_CF7_GENERAL); ?></div>
    </div>
  </div>
</section>

<!-- ══ REVIEWS ═══════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--white">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</span>
    <h2 class="ppi-section__heading">What Customers Say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══ RELATED ═══════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--grey">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">Also at TAAS</span>
    <h2 class="ppi-section__heading">Related Services</h2>
    <p class="ppi-section__sub">If we find work that needs doing, we can carry it out — or you can use the report to negotiate with the seller.</p>
    <div class="ppi-related">
      <?php
      $related = [
          ['label' => 'Vehicle Servicing',       'url' => '/vehicle-servicing/'],
          ['label' => 'Engine Repairs',           'url' => '/engine-repairs/'],
          ['label' => 'Cambelt & Water Pump',     'url' => '/cambelts-and-water-pumps/'],
          ['label' => 'TAAS European',            'url' => '/european/'],
          ['label' => 'EV & Hybrid Servicing',    'url' => '/electric-hybrid-vehicle-servicing/'],
          ['label' => 'WOF Inspection',           'url' => '/wof/'],
          ['label' => 'Finance Options',          'url' => '/finance-options/'],
      ];
      foreach ($related as $r):
      ?>
      <a href="<?php echo esc_url($site_url . $r['url']); ?>"><?php echo esc_html($r['label']); ?><span>→</span></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ WHY CHOOSE US ═════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--grey">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">Why Us</span>
    <h2 class="ppi-section__heading">Why Choose Us for Your Pre-Purchase Inspection</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:24px;margin-top:28px;">
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">🛡️</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);">Independent</strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">We're not connected to any dealer or seller. Our report is for you — honest, unbiased, and in your interest.</p></div>
      </div>
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">🔧</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);">Established <?php echo esc_html($established); ?></strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">South Auckland's largest independent workshop. <?php echo esc_html($years_trading); ?> years of experience across every make and model.</p></div>
      </div>
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">✓</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);">MTA Assured</strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">Member of the Motor Trade Association. Our work meets MTA quality standards.</p></div>
      </div>
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">📋</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);">NZTA Authorised</strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">We hold the same standards for your PPI as we do for every vehicle that comes through our workshop.</p></div>
      </div>
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">🏠</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);"><?php echo esc_html($division_count); ?> Specialist Divisions</strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">General servicing, brakes and clutch, batteries, auto electrical, air conditioning, European vehicles, and fleet. Whatever the inspection finds, we can fix it under one roof.</p></div>
      </div>
      <div style="display:flex;gap:14px;align-items:flex-start;">
        <span style="font-size:24px;flex-shrink:0;">📄</span>
        <div><strong style="font-size:15px;color:var(--taas-black,#111);">Written Report You Can Use</strong><p style="font-size:14px;color:var(--taas-mid,#666);line-height:1.75;margin-top:4px;">Our Standard and Premium reports include repair cost estimates and a clear purchase recommendation. Use it to negotiate the price or walk away with confidence.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════════ -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>

<!-- ══ FAQ ═══════════════════════════════════════════════════════════════════ -->
<section class="ppi-section ppi-section--white">
  <div class="ppi-section__inner">
    <span class="ppi-section__eyebrow">FAQ</span>
    <h2 class="ppi-section__heading">Common Questions About Pre-Purchase Inspections</h2>
    <div class="ppi-faq__list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="ppi-faq__item<?php echo $i === 0 ? ' ppi-faq__item--open' : ''; ?>">
        <button class="ppi-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="ppi-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ DISCLAIMER ═══════════════════════════════════════════════════════════ -->
<div style="background:var(--taas-panel,#F7F7F5);padding:28px 0;border-top:1px solid var(--taas-border,#E8E8E4);">
  <div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;">
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;color:#999;line-height:1.75;">This inspection records the condition of the vehicle at the time of inspection based on a visual and mechanical assessment appropriate to the level selected. It does not constitute a warranty or guarantee of the vehicle's condition, future reliability, or fitness for any particular purpose. Concealed faults, intermittent faults, or conditions not detectable within the scope of the inspection level selected are expressly excluded. Body panel, paint, and cosmetic observations are visual only and do not represent a professional panel and paint assessment — a specialist report is recommended where cosmetic condition is a material consideration. Tony Allen Auto Service Ltd accepts no liability for any loss, damage, or expense arising from reliance on this report.</p>
  </div>
</div>

<script>
document.querySelectorAll('.ppi-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.ppi-faq__item');
    var wasOpen = item.classList.contains('ppi-faq__item--open');
    document.querySelectorAll('.ppi-faq__item--open').forEach(function(i){ i.classList.remove('ppi-faq__item--open'); });
    if (!wasOpen) item.classList.add('ppi-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
