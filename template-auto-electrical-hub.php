<?php
/**
 * Template Name: Auto Electrical Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /auto-electrical/
 * CSS namespace: .aeh-
 * Raj's division — Lead Diagnostics & Auto Electrical
 *
 * Rebuilt June 2026 — full design system compliance
 * Inter only, CSS variables with fallbacks, @graph schema,
 * educational section, pricing cards, form after pricing
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$established   = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$years         = date('Y') - intval($established);
$rating        = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews       = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$customers     = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$phone_free    = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$email         = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$ms_number     = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$autoelec_diag = defined('TAAS_AUTOELEC_DIAG') ? TAAS_AUTOELEC_DIAG : 'from $175';
$battery_price = defined('TAAS_BATTERY_PRICE') ? TAAS_BATTERY_PRICE : 'from $180 fitted';
$alt_test      = defined('TAAS_ALT_TEST')      ? TAAS_ALT_TEST      : 'from $85';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_AUTOELEC') ? TAAS_HERO_AUTOELEC : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Badge helper ─────────────────────────────────────────────────────────────
function aeh_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    $taas_faqs['ae_services'],
    $taas_faqs['ae_diagnostic_cost'],
    $taas_faqs['ae_diagnose_first'],
    $taas_faqs['ae_european'],
    $taas_faqs['ae_check_engine'],
    $taas_faqs['ae_scan_vs_diag'],
    $taas_faqs['ae_scan_duration'],
    $taas_faqs['ae_airbag'],
    $taas_faqs['ae_aftermarket'],
    $taas_faqs['ae_fleet'],
    $taas_faqs['ae_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $f) {
    $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => ['AutoRepair','LocalBusiness'],
            '@id'         => $site_url . '/#organization',
            'name'        => 'Tony Allen Auto Service',
            'alternateName'=> 'TAAS Auto Electrical',
            'url'         => $site_url,
            'description' => 'Auto electrical diagnosis and repair in Manukau, South Auckland. ECU diagnostics, battery, alternator, starter motor, ABS, SRS, wiring, central locking and more. Led by Raj — Lead Diagnostics & Auto Electrical Technician. Fault confirmed before parts replaced.',
            'telephone'   => [$phone_free, $phone_local],
            'email'       => $email,
            'foundingDate'=> '1985-10',
            'address'     => ['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
            'geo'         => ['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
            'openingHoursSpecification' => [['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
            'aggregateRating' => ['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
            'memberOf'    => ['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
            'sameAs'      => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
            'paymentAccepted'=> ['Cash','EFTPOS','Visa','Mastercard','Afterpay','Q Card','Gem Finance'],
            'priceRange'  => '$$',
            'areaServed'  => ['@type'=>'Place','name'=>'South Auckland'],
        ],
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'Auto Electrical','item'=>$page_url],
        ]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.aeh-hero__sub','.aeh-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-auto-electrical-hub .site-content,
.page-template-template-auto-electrical-hub .entry-content,
.page-template-template-auto-electrical-hub .entry-header,
.page-template-template-auto-electrical-hub article,
.page-template-template-auto-electrical-hub #primary,
.page-template-template-auto-electrical-hub #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-auto-electrical-hub { overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%; }

/* ── Typography — all headings explicit ────────────────────────────────────── */
.aeh-hero h1,
.aeh-sec__h2,
.aeh-edu h3,
.aeh-problems h3,
.aeh-pricing__title,
.aeh-faq__q { font-family: var(--taas-font, 'Inter', Arial, sans-serif); }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.aeh-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.aeh-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 300px; gap: 48px; align-items: start; }
.aeh-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.aeh-hero h1 { font-size: var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.aeh-hero h1 span { color: var(--taas-yellow, #FFC800); }
.aeh-hero__sub { font-size: 16px; color: #aaa; max-width: 540px; margin: 0 0 28px; line-height: 1.75; }
.aeh-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }

/* ── Sidebar ───────────────────────────────────────────────────────────────── */
.aeh-sidebar { background: #1c1c1c; border: 1px solid #333; border-radius: var(--taas-radius, 6px); padding: 24px; }
.aeh-sidebar__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 14px; }
.aeh-sidebar__list { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 8px; }
.aeh-sidebar__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: #ccc; padding-left: 18px; position: relative; line-height: 1.4; }
.aeh-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }
.aeh-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 16px; }
.aeh-sidebar__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 22px; font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin-bottom: 4px; line-height: 1.1; }
.aeh-sidebar__phone:hover{opacity:.65;}
.aeh-sidebar__detail { font-size: 12px; color: #888; line-height: 1.75; }

/* ── Trust strip ───────────────────────────────────────────────────────────── */
.aeh-phonestrip{background:var(--taas-yellow,#FFC800);}.aeh-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.aeh-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.aeh-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.aeh-phonestrip__num:hover{opacity:.65;}
.aeh-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4); padding: 18px 0; }
.aeh-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.aeh-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.aeh-trust__item::before { content: '✓'; font-weight: 900; }

/* ── Sections ──────────────────────────────────────────────────────────────── */
.aeh-sec { padding: var(--taas-sec-pad, 72px) 0; }
.aeh-sec--white { background: var(--taas-white, #FFFFFF); }
.aeh-sec--grey  { background: var(--taas-panel, #F7F7F5); }
.aeh-sec--dark  { background: var(--taas-dark, #1A1A1A); }
.aeh-sec__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.aeh-sec__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.aeh-sec--dark .aeh-sec__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.aeh-sec__h2 { font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.aeh-sec--dark .aeh-sec__h2 { color: var(--taas-white, #FFFFFF); }
.aeh-sec__sub { font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 36px; line-height: 1.75; }
.aeh-sec--dark .aeh-sec__sub { color: #aaa; }

/* ── Educational section ───────────────────────────────────────────────────── */
.aeh-edu { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; margin-top: 32px; }
.aeh-edu__text p { font-size: 16px; color: var(--taas-body, #333333); line-height: 1.75; margin: 0 0 20px; }
.aeh-edu h3 { font-size: 18px; font-weight: 700; color: var(--taas-black, #111111); margin: 0 0 12px; }
.aeh-edu__callout { background: var(--taas-panel, #F7F7F5); border-left: 4px solid var(--taas-yellow, #FFC800); border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; padding: 24px 28px; }
.aeh-edu__callout p { font-size: 15px; color: var(--taas-body, #333333); line-height: 1.75; margin: 0 0 8px; }
.aeh-edu__callout p:last-child { margin-bottom: 0; }
.aeh-edu__panel { background: var(--taas-dark, #1A1A1A); border-radius: var(--taas-radius, 6px); padding: 32px 28px; }
.aeh-edu__panel-title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 16px; }
.aeh-edu__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.aeh-edu__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: #ccc; padding-left: 20px; position: relative; line-height: 1.5; }
.aeh-edu__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }

/* ── Service cards ─────────────────────────────────────────────────────────── */
.aeh-services { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
.aeh-service { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px 18px; display: flex; flex-direction: column; gap: 8px; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s; border-top: 3px solid transparent; }
.aeh-service:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); transform: translateY(-2px); border-top-color: var(--taas-yellow, #FFC800); }
.aeh-service__icon { width: 40px; height: 40px; flex-shrink: 0; }
.aeh-service__icon svg { display: block; }
.aeh-service__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); }
.aeh-service__desc { font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; flex: 1; }
.aeh-service__link { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; color: var(--taas-yellow2, #e6b400); margin-top: auto; }
.aeh-service:hover .aeh-service__link { color: var(--taas-yellow, #FFC800); }
.aeh-sec--grey .aeh-service { background: var(--taas-white, #FFFFFF); }

/* ── Raj / specialist ──────────────────────────────────────────────────────── */
.aeh-raj { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.aeh-raj__text p { font-size: 16px; color: var(--taas-body, #333333); line-height: 1.75; margin: 0 0 16px; }

/* ── Common problems ───────────────────────────────────────────────────────── */
.aeh-problems { display: grid; grid-template-columns: 1fr 1fr; gap: 32px 48px; margin-top: 24px; }
.aeh-problems h3 { font-size: 16px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 8px; }
.aeh-problems p { font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.75; }

/* ── Pricing ───────────────────────────────────────────────────────────────── */
.aeh-pricing { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 32px; }
.aeh-pricing__card { background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 28px 24px; text-align: center; }
.aeh-pricing__card--highlight { border-color: var(--taas-yellow, #FFC800); border-width: 2px; }
.aeh-pricing__badge { margin: 0 auto 16px; }
.aeh-pricing__title { font-size: 16px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 8px; }
.aeh-pricing__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 24px; font-weight: 800; color: var(--taas-dark, #1A1A1A); margin-bottom: 12px; }
.aeh-pricing__desc { font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.75; }
.aeh-pricing__note { margin-top: 28px; font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.75; max-width: 700px; }

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.aeh-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.aeh-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.aeh-enquiry__phone:hover{opacity:.65;}
.aeh-enquiry__detail { font-size: 15px; color: #aaa; line-height: 1.75; }
.aeh-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

/* ── CF7 dark ──────────────────────────────────────────────────────────────── */
.aeh-sec--dark .wpcf7 label,
.aeh-sec--dark .wpcf7 span:not(.wpcf7-spinner),
.aeh-sec--dark .wpcf7 div:not(.wpcf7-response-output),
.aeh-sec--dark .wpcf7 p { color: #ccc !important; font-size: 14px; }
.aeh-sec--dark .wpcf7 input[type="text"],
.aeh-sec--dark .wpcf7 input[type="email"],
.aeh-sec--dark .wpcf7 input[type="tel"],
.aeh-sec--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.aeh-sec--dark .wpcf7 input::placeholder,
.aeh-sec--dark .wpcf7 textarea::placeholder { color: #666; }
.aeh-sec--dark .wpcf7 input:focus,
.aeh-sec--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.aeh-sec--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: var(--taas-btn-size, 14px); letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.aeh-sec--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

/* ── Suburb pills ──────────────────────────────────────────────────────────── */
.aeh-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; list-style: none; padding: 0; }
.aeh-pills li a { display: inline-block; padding: 7px 18px; border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; background: var(--taas-white, #FFFFFF); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); text-decoration: none; transition: all 0.15s; }
.aeh-pills li a:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 600; }

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.aeh-faq { max-width: 780px; margin: 28px auto 0; }
.aeh-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.aeh-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.aeh-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); transition: transform 0.2s; }
.aeh-faq__item--open .aeh-faq__q::after { content: '−'; }
.aeh-faq__a { display: none; padding: 0 0 18px; }
.aeh-faq__a p { font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.75; margin: 0; }
.aeh-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.aeh-faq__a a:hover { text-decoration: underline; }
.aeh-faq__item--open .aeh-faq__a { display: block; }

/* ── Related ───────────────────────────────────────────────────────────────── */
.aeh-related { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media (max-width: 960px) {
  .aeh-hero__inner { grid-template-columns: 1fr; }
  .aeh-services { grid-template-columns: repeat(2, 1fr); }
  .aeh-edu { grid-template-columns: 1fr; }
  .aeh-raj { grid-template-columns: 1fr; }
  .aeh-pricing { grid-template-columns: 1fr; }
  .aeh-enquiry { grid-template-columns: 1fr; gap: 32px; }
  .aeh-related { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {.aeh-phonestrip__num{font-size:17px;}.aeh-enquiry{display:flex;flex-direction:column-reverse;}
  .aeh-hero { padding: 48px 0 40px; }
  .aeh-hero h1 { font-size: clamp(28px, 7vw, 42px); }
  .aeh-hero__sub { font-size: 14px; }
  .aeh-hero__ctas { flex-direction: column; align-items: stretch; }
  .aeh-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .aeh-sec { padding: 48px 0; }
  .aeh-sec__h2 { font-size: clamp(22px, 5vw, 30px); }
  .aeh-sec__sub { font-size: 14px; }
  .aeh-services { grid-template-columns: 1fr; }
  .aeh-problems { grid-template-columns: 1fr; gap: 24px; }
  .aeh-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .aeh-trust__item { font-size: 12px; }
  .aeh-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .aeh-faq__a p { font-size: 13px; }
  .aeh-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .aeh-sidebar__phone { font-size: 20px; }
  .aeh-pricing { grid-template-columns: 1fr; }
}
</style>

<!-- ═══════════════════════════════════════════════════════════════════════════
     1. HERO
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="aeh-hero__inner">
    <div>
      <span class="aeh-hero__eyebrow">Auto Electrical — Manukau</span>
      <h1>Auto Electrician<br><span>Manukau — South Auckland</span></h1>
      <p class="aeh-hero__sub">ECU diagnostics, battery, alternator, ABS, SRS, wiring and more — led by Raj, our Lead Diagnostics & Auto Electrical Technician. Fault confirmed before any parts are replaced. Serving <?php echo esc_html($customers); ?> customers across South Auckland since <?php echo esc_html($established); ?>.</p>
      <div class="aeh-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book a Diagnostic</a>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
      </div>
    </div>
    <div class="aeh-sidebar">
      <div class="aeh-sidebar__title">What We Diagnose & Repair</div>
      <ul class="aeh-sidebar__list">
        <li>ECU & fault code diagnostics</li>
        <li>Dashboard warning lights</li>
        <li>Battery supply & fit</li>
        <li>Alternator repair</li>
        <li>Starter motor replacement</li>
        <li>ABS fault diagnosis</li>
        <li>SRS & airbag repair</li>
        <li>EGR & emission faults</li>
        <li>Wiring fault repair</li>
        <li>Central locking & windows</li>
        <li>Immobiliser & key programming</li>
        <li>Lighting & headlights</li>
        <li>Traction & stability control</li>
      </ul>
      <hr>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="aeh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="aeh-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     2. TRUST STRIP
     ═══════════════════════════════════════════════════════════════════════════ -->
<div class="aeh-phonestrip"><div class="aeh-phonestrip__inner"><span class="aeh-phonestrip__label">Electrical issue? Talk to Raj</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="aeh-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="aeh-trust">
  <div class="aeh-trust__inner">
    <div class="aeh-trust__item">MTA Assured</div>
    <div class="aeh-trust__item">NZTA Authorised</div>
    <div class="aeh-trust__item">Fault Confirmed Before Parts Replaced</div>
    <div class="aeh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="aeh-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════════
     3. UNDERSTANDING AUTO ELECTRICAL
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--white">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">Understanding the Discipline</span>
    <h2 class="aeh-sec__h2">Why Auto Electrical Is Different from Mechanical Repair</h2>
    <div class="aeh-edu">
      <div class="aeh-edu__text">
        <p>Modern vehicles are built around electronics. What used to be a simple alternator-battery-starter circuit is now a network of 30 to 80 interconnected control units — engine management, transmission, ABS, SRS, body control, instrument cluster, comfort modules and more — all communicating across shared data networks.</p>
        <p>When something goes wrong in this network, symptoms can appear far from the actual fault. A wiring issue in the boot can disable the dashboard. A faulty earth connection on one module can cause intermittent faults across three others. A failing battery management sensor can trigger warning lights that look like engine problems.</p>
        <p>This is why auto electrical diagnosis is fundamentally different from mechanical repair. With a mechanical fault — a worn brake pad, a leaking radiator — the symptom usually points directly to the problem. With an electrical fault, the symptom often has nothing to do with the root cause. Replacing parts based on a diagnostic code alone is like treating the thermometer instead of the fever.</p>
        <div class="aeh-edu__callout">
          <h3>The Scan vs the Diagnosis</h3>
          <p>A scan reads the fault codes stored in the vehicle's control units — it tells you what the car is reporting. A diagnosis is the investigation that follows: testing the actual components, reading live sensor data, checking wiring, measuring voltage drops, and confirming which part has actually failed.</p>
          <p>The scan gives us the starting point. The diagnosis gives us the answer. That distinction is why we price them separately — and why we get cars fixed first time.</p>
        </div>
      </div>
      <div class="aeh-edu__panel">
        <div class="aeh-edu__panel-title">Raj — Lead Diagnostics & Auto Electrical</div>
        <ul class="aeh-edu__list">
          <li>Lead diagnostics technician — all makes and models</li>
          <li>Factory-spec scan tools including European</li>
          <li>Fault verified before parts recommended</li>
          <li>Live data and component-level testing</li>
          <li>Wiring fault tracing and repair</li>
          <li>CAN bus and network fault diagnosis</li>
          <li>Fleet electrical work — account facilities</li>
          <li>European vehicles — <?php echo esc_html($euro_brands); ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     4. SERVICES GRID
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--grey">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">Services</span>
    <h2 class="aeh-sec__h2">Auto Electrical Services — Manukau</h2>
    <p class="aeh-sec__sub">All work carried out in-house at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a>. No farming out, no guessing.</p>
    <div class="aeh-services">
      <a href="<?php echo esc_url($site_url . '/diagnostic-scanning/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('DS'); ?></div><div class="aeh-service__title">Diagnostic Scanning</div>
        <p class="aeh-service__desc">ECU fault codes, live data, all modules. Factory-spec equipment — not a generic code reader.</p>
        <span class="aeh-service__link">Diagnostic Scanning →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/dashboard-warning-lights-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('DW'); ?></div><div class="aeh-service__title">Dashboard Warning Lights</div>
        <p class="aeh-service__desc">Engine light, ABS, SRS, TPMS, oil — every warning light explained and diagnosed correctly.</p>
        <span class="aeh-service__link">Warning Lights →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/car-wont-start-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('CS'); ?></div><div class="aeh-service__title">Car Won't Start</div>
        <p class="aeh-service__desc">Dead flat, clicks but won't crank, cranks but won't fire — we diagnose the cause, not the symptom.</p>
        <span class="aeh-service__link">Car Won't Start →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-battery/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('CB'); ?></div><div class="aeh-service__title">Car Battery</div>
        <p class="aeh-service__desc">Load testing, supply and fit. BMS registration for European vehicles. Alternator checked before replacement.</p>
        <span class="aeh-service__link">Battery Info →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-alternator/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('AR'); ?></div><div class="aeh-service__title">Alternator Repair</div>
        <p class="aeh-service__desc">Battery light on, flat battery, dimming lights. Output tested before replacement recommended.</p>
        <span class="aeh-service__link">Alternator Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-starter-motor/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('SM'); ?></div><div class="aeh-service__title">Starter Motor</div>
        <p class="aeh-service__desc">Click but no crank. Solenoid vs motor fault identified before parts are ordered.</p>
        <span class="aeh-service__link">Starter Motor →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/abs-fault-diagnosis-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('ABS'); ?></div><div class="aeh-service__title">ABS Fault Diagnosis</div>
        <p class="aeh-service__desc">ABS warning light, wheel speed sensors, ABS module. Diagnosis here — mechanical repair at MBC.</p>
        <span class="aeh-service__link">ABS Diagnosis →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/srs-airbag-repair-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('SRS'); ?></div><div class="aeh-service__title">SRS & Airbag</div>
        <p class="aeh-service__desc">SRS warning light, clock spring, pretensioner, sensor faults. Do not ignore this light.</p>
        <span class="aeh-service__link">SRS Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/traction-stability-control-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('TCS'); ?></div><div class="aeh-service__title">Traction & Stability</div>
        <p class="aeh-service__desc">ESC, TCS, VSC warning lights. Often shares sensors with ABS — diagnosed together.</p>
        <span class="aeh-service__link">Traction Control →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/egr-repair-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('EGR'); ?></div><div class="aeh-service__title">EGR & Emission Faults</div>
        <p class="aeh-service__desc">Engine light, rough idle, excess smoke. EGR cleaning or replacement. DPF-related faults on diesels.</p>
        <span class="aeh-service__link">EGR Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-central-locking/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('CL'); ?></div><div class="aeh-service__title">Central Locking</div>
        <p class="aeh-service__desc">Actuator failure, wiring fault, key fob programming. One door or all — diagnosed correctly.</p>
        <span class="aeh-service__link">Central Locking →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/electric-window-repair-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('EW'); ?></div><div class="aeh-service__title">Electric Windows</div>
        <p class="aeh-service__desc">Motor, regulator, or switch fault. One window or all — fault identified before parts ordered.</p>
        <span class="aeh-service__link">Window Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-immobiliser/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('IK'); ?></div><div class="aeh-service__title">Immobiliser & Keys</div>
        <p class="aeh-service__desc">Car won't start — immobiliser triggered. Key programming, transponder faults, bypass.</p>
        <span class="aeh-service__link">Immobiliser →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical-lighting/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('LH'); ?></div><div class="aeh-service__title">Lighting & Headlights</div>
        <p class="aeh-service__desc">Headlight adjustment, HID/xenon faults, LED issues, wiring causing flickering. WOF lighting checks.</p>
        <span class="aeh-service__link">Lighting →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wiring-fault-repair-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('WF'); ?></div><div class="aeh-service__title">Wiring Fault Repair</div>
        <p class="aeh-service__desc">Intermittent faults, chafed wiring, rodent damage, aftermarket wiring issues. Traced and repaired properly.</p>
        <span class="aeh-service__link">Wiring Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tpms-reset-manukau/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('TPMS'); ?></div><div class="aeh-service__title">TPMS Reset</div>
        <p class="aeh-service__desc">Tyre pressure monitoring light on after a tyre change or rotation. Reset and sensor replacement.</p>
        <span class="aeh-service__link">TPMS →</span>
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     5. COMMON PROBLEMS
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--white">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">What We See</span>
    <h2 class="aeh-sec__h2">Common Auto Electrical Problems in South Auckland</h2>
    <p class="aeh-sec__sub">These are the most common auto electrical faults we diagnose and repair at TAAS. Most are straightforward once the fault is confirmed — the key is getting the diagnosis right first.</p>
    <div class="aeh-problems">
      <div>
        <h3>Dashboard warning lights that won't clear</h3>
        <p>The most common reason we see vehicles is a warning light that stays on — engine, ABS, SRS, TPMS, or oil. Some are stored codes from an old fault, some are active and need immediate attention. We scan all modules, not just the engine, and read the live data to tell the difference. A generic OBD reader gives you a code. We give you a diagnosis.</p>
      </div>
      <div>
        <h3>Car won't start — but the battery is fine</h3>
        <p>A flat battery is the obvious cause, but when the battery tests good and the car still won't start, you're into immobiliser faults, starter motor relay issues, fuel pump relay failures, or ECU communication problems. We test each system in order rather than replacing parts on a hunch. That approach saves you money and gets the car fixed first time.</p>
      </div>
      <div>
        <h3>Alternator not charging properly</h3>
        <p>A failing alternator often shows up as a flat battery, dimming headlights, or a battery warning light. We load test the alternator before recommending replacement — sometimes it's a wiring issue or a failing voltage regulator, not the alternator itself. European vehicles need BMS registration after a new battery or alternator is fitted.</p>
      </div>
      <div>
        <h3>Intermittent electrical faults</h3>
        <p>Faults that come and go are the hardest to diagnose — but they're what Raj specialises in. Chafed wiring, corroded connectors, aftermarket accessories wired incorrectly, and rodent damage are all common causes. We trace the circuit, test under load, and find the root cause rather than applying a temporary fix that comes back in a month.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     6. PRICING
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--grey">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">Pricing Guide</span>
    <h2 class="aeh-sec__h2">Auto Electrical Pricing — Manukau</h2>
    <p class="aeh-sec__sub">All fees explained upfront before any work begins. If you proceed with the repair, the diagnostic fee is applied to the final invoice.</p>
    <div class="aeh-pricing">
      <div class="aeh-pricing__card">
        <div class="aeh-pricing__badge"><?php echo aeh_badge('DS', 48); ?></div>
        <div class="aeh-pricing__title">Diagnostic Scan</div>
        <div class="aeh-pricing__price"><?php echo esc_html($scan_price); ?></div>
        <p class="aeh-pricing__desc">Read all fault codes across every module. Factory-spec equipment — not a generic code reader. Starting point for every auto electrical job.</p>
      </div>
      <div class="aeh-pricing__card aeh-pricing__card--highlight">
        <div class="aeh-pricing__badge"><?php echo aeh_badge('FD', 48); ?></div>
        <div class="aeh-pricing__title">Full Diagnostic</div>
        <div class="aeh-pricing__price"><?php echo esc_html($autoelec_diag); ?></div>
        <p class="aeh-pricing__desc">Live data analysis, component-level testing, wiring checks. The work that actually confirms the fault — not just reads the code.</p>
      </div>
      <div class="aeh-pricing__card">
        <div class="aeh-pricing__badge"><?php echo aeh_badge('CB', 48); ?></div>
        <div class="aeh-pricing__title">Battery Supply & Fit</div>
        <div class="aeh-pricing__price"><?php echo esc_html($battery_price); ?></div>
        <p class="aeh-pricing__desc">Load tested, fitted, terminals cleaned. BMS registration for European vehicles included. Charging system checked before replacement.</p>
      </div>
    </div>
    <p class="aeh-pricing__note">Individual system tests (alternator, starter motor, ABS, SRS, lighting, wiring) start <?php echo esc_html($alt_test); ?>. Repair costs depend on the fault and parts required — we provide an estimate before proceeding. All pricing includes GST.</p>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     7. ENQUIRY — immediately after pricing
     ═══════════════════════════════════════════════════════════════════════════ -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="aeh-sec aeh-sec--dark" id="enquire">
  <div class="aeh-sec__inner">
    <div class="aeh-enquiry">
      <div>
        <span class="aeh-sec__eyebrow">Book or Enquire</span>
        <h2 class="aeh-sec__h2">Book a Diagnostic</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and what warning lights or symptoms you have. We'll come back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="aeh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="aeh-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     8. RELATED SERVICES
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--grey">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">Also at TAAS</span>
    <h2 class="aeh-sec__h2">Related Services</h2>
    <p class="aeh-sec__sub">Auto electrical faults often overlap with mechanical systems. These divisions work alongside Raj's team at the same address.</p>
    <div class="aeh-related">
      <a href="<?php echo esc_url($site_url . '/air-conditioning/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('AC'); ?></div>
        <div class="aeh-service__title">Air Conditioning</div>
        <p class="aeh-service__desc">Regas, compressor repair, leak detection. AC system faults often trigger electrical codes.</p>
        <span class="aeh-service__link">Air Conditioning →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/european/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('EURO'); ?></div>
        <div class="aeh-service__title">TAAS European</div>
        <p class="aeh-service__desc">Factory-spec diagnostic equipment for <?php echo esc_html($euro_brands); ?>.</p>
        <span class="aeh-service__link">European Vehicles →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/manukau-brake-clutch/'); ?>" class="aeh-service">
        <div class="aeh-service__icon"><?php echo aeh_badge('MBC'); ?></div>
        <div class="aeh-service__title">Manukau Brake & Clutch</div>
        <p class="aeh-service__desc">ABS sensor replacement and mechanical brake repairs carried out by the MBC team alongside diagnostic work.</p>
        <span class="aeh-service__link">Brakes & Clutch →</span>
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     9. REVIEWS
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--white">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="aeh-sec__h2">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     10. SUBURB PILLS
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--grey">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">South Auckland</span>
    <h2 class="aeh-sec__h2">Auto Electrician Near You</h2>
    <p class="aeh-sec__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="aeh-pills">
      <?php
      $suburbs = [
        ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Manukau','slug'=>'manukau'],
        ['label'=>'Māngere','slug'=>'mangere'],['label'=>'Ōtāhuhu','slug'=>'otahuhu'],
        ['label'=>'Wiri','slug'=>'wiri'],['label'=>'Manurewa','slug'=>'manurewa'],
        ['label'=>'Flat Bush','slug'=>'flat-bush'],['label'=>'Takanini','slug'=>'takanini'],
        ['label'=>'Papakura','slug'=>'papakura'],['label'=>'Ōtara','slug'=>'otara'],
        ['label'=>'Botany','slug'=>'botany'],['label'=>'Howick','slug'=>'howick'],
        ['label'=>'Clover Park','slug'=>'clover-park'],['label'=>'Weymouth','slug'=>'weymouth'],
        ['label'=>'Clendon','slug'=>'clendon'],['label'=>'Hunters Corner','slug'=>'hunters-corner'],
      ];
      foreach ($suburbs as $s) {
        echo '<li><a href="' . esc_url($site_url . '/auto-electrical-' . $s['slug'] . '/') . '">Auto Electrician ' . esc_html($s['label']) . '</a></li>';
      }
      ?>
    </ul>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════════
     11. FAQ
     ═══════════════════════════════════════════════════════════════════════════ -->
<section class="aeh-sec aeh-sec--white">
  <div class="aeh-sec__inner">
    <span class="aeh-sec__eyebrow">FAQ</span>
    <h2 class="aeh-sec__h2">Common Questions — Auto Electrical</h2>
    <div class="aeh-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="aeh-faq__item">
        <button class="aeh-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="aeh-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="aeh-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.aeh-faq__q').forEach(function(btn){
  btn.addEventListener('click',function(){
    var item = this.closest('.aeh-faq__item');
    var wasOpen = item.classList.contains('aeh-faq__item--open');
    document.querySelectorAll('.aeh-faq__item--open').forEach(function(i){ i.classList.remove('aeh-faq__item--open'); });
    if(!wasOpen) item.classList.add('aeh-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
