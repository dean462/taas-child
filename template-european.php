<?php
/**
 * Template Name: TAAS European
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /european/
 * CSS namespace: .eu-
 *
 * Rebuilt June 2026 — full design system compliance
 * Inter only, CSS variables with fallbacks, @graph schema,
 * educational section, dealer vs independent, cambelt warning
 *
 * Make pages and make × location pages to be built in a future session.
 * Make cards currently link to /european/ — update URLs when make pages go live.
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
$wof_price     = defined('TAAS_WOF_PRICE')     ? TAAS_WOF_PRICE     : '$80';
$service_price = defined('TAAS_SERVICE_PRICE') ? TAAS_SERVICE_PRICE : 'from $230';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$cambelt_price = defined('TAAS_CAMBELT_PRICE') ? TAAS_CAMBELT_PRICE : 'from $800';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_EUROPEAN') ? TAAS_HERO_EUROPEAN : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Badge helper ─────────────────────────────────────────────────────────────
function eu_badge($initials, $size = 48) {
    $len = strlen($initials);
    $fs = $len > 4 ? intval($size * 0.2) : ($len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35)));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Makes — confirmed order ──────────────────────────────────────────────────
// URLs point to /european/ until make pages are built. Update slugs when live.
$makes = [
    ['badge'=>'AUDI','name'=>'Audi','desc'=>'A3, A4, A6, Q5, Q7. VAG group diagnostics. DSG transmission service, cambelt, engine repairs.','slug'=>'european'],
    ['badge'=>'VW','name'=>'Volkswagen','desc'=>'Golf, Tiguan, Passat, Transporter. Full VAG diagnostic capability. Logbook servicing and DSG service.','slug'=>'european'],
    ['badge'=>'BMW','name'=>'BMW','desc'=>'3 Series, 5 Series, X3, X5 and more. Logbook servicing, brake service, diagnostic scanning, suspension.','slug'=>'european'],
    ['badge'=>'MERC','name'=>'Mercedes-Benz','desc'=>'C-Class, E-Class, GLC, Sprinter vans. Servicing, repairs and diagnostics at independent rates.','slug'=>'european'],
    ['badge'=>'LR','name'=>'Land Rover','desc'=>'Discovery, Freelander, Defender, Range Rover Evoque, Sport, Velar. Air suspension, servicing and brakes.','slug'=>'european'],
    ['badge'=>'POR','name'=>'Porsche','desc'=>'Cayenne, Macan, Boxster, Cayman. Servicing, brakes, diagnostics. Independent alternative to dealer.','slug'=>'european'],
    ['badge'=>'MINI','name'=>'MINI','desc'=>'Cooper, Countryman, Clubman. BMW platform — same diagnostic and parts supply capability.','slug'=>'european'],
    ['badge'=>'SKDA','name'=>'Škoda','desc'=>'Octavia, Superb, Kodiaq. VAG platform — same diagnostic and parts capability as Audi and VW.','slug'=>'european'],
    ['badge'=>'VOLV','name'=>'Volvo','desc'=>'XC60, XC90, V60, S60. Logbook servicing, brakes, cambelt, suspension. PHEV variants also serviced.','slug'=>'european'],
    ['badge'=>'PEU','name'=>'Peugeot','desc'=>'208, 308, 3008, 508. Logbook servicing, diagnostics, suspension and brake repairs.','slug'=>'european'],
    ['badge'=>'REN','name'=>'Renault','desc'=>'Megane, Koleos, Kadjar. Full servicing and diagnostic capability. Parts sourced fast.','slug'=>'european'],
];

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    $taas_faqs['euro_makes'],
    $taas_faqs['euro_warranty'],
    $taas_faqs['euro_diagnostics'],
    $taas_faqs['euro_pricing'],
    $taas_faqs['euro_cambelt'],
    $taas_faqs['euro_vag'],
    $taas_faqs['euro_porsche_mini'],
    $taas_faqs['euro_service_cost'],
    $taas_faqs['euro_finance'],
    $taas_faqs['euro_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = [
    '@context'=>'https://schema.org',
    '@graph'=>[
        ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','alternateName'=>'TAAS European',
         'url'=>$site_url,
         'description'=>'Specialist European vehicle servicing and repairs in Manukau, South Auckland. Audi, Volkswagen, BMW, Mercedes-Benz, Land Rover, Porsche, MINI, Škoda, Volvo, Peugeot, Renault. Factory-spec diagnostics. Independent pricing. Family-owned since '.$established.'.',
         'telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10',
         'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
         'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
         'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
         'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
         'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
         'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
         'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Q Card','Gem Finance'],
         'priceRange'=>'$$','areaServed'=>['@type'=>'Place','name'=>'South Auckland']],
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'TAAS European','item'=>$page_url]]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.eu-hero__sub','.eu-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-european .site-content,.page-template-template-european .entry-content,.page-template-template-european .entry-header,.page-template-template-european article,.page-template-template-european #primary,.page-template-template-european #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-european{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}

/* ── Typography ────────────────────────────────────────────────────────────── */
.eu-hero h1,.eu-sec__h2,.eu-edu h3,.eu-compare__col-title,.eu-cambelt__title,.eu-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.eu-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;}
.eu-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.eu-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.eu-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.eu-hero h1 span{color:var(--taas-yellow,#FFC800);}
.eu-hero__sub{font-size:16px;color:#aaa;max-width:540px;margin:0 0 28px;line-height:1.75;}
.eu-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.eu-sidebar{background:#1c1c1c;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.eu-sidebar__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.eu-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.eu-sidebar__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.eu-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.eu-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.eu-sidebar__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.eu-sidebar__phone:hover{opacity:.65;}
.eu-sidebar__detail{font-size:12px;color:#888;line-height:1.75;}

/* ── Trust strip ───────────────────────────────────────────────────────────── */
.eu-phonestrip{background:var(--taas-yellow,#FFC800);}.eu-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.eu-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.eu-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.eu-phonestrip__num:hover{opacity:.65;}
.eu-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.eu-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.eu-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.eu-trust__item::before{content:'✓';font-weight:900;}

/* ── Sections ──────────────────────────────────────────────────────────────── */
.eu-sec{padding:var(--taas-sec-pad,72px) 0;}
.eu-sec--white{background:var(--taas-white,#FFFFFF);}
.eu-sec--grey{background:var(--taas-panel,#F7F7F5);}
.eu-sec--dark{background:var(--taas-dark,#1A1A1A);}
.eu-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.eu-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.eu-sec--dark .eu-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.eu-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.eu-sec--dark .eu-sec__h2{color:var(--taas-white,#FFFFFF);}
.eu-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.eu-sec--dark .eu-sec__sub{color:#aaa;}

/* ── Educational section ───────────────────────────────────────────────────── */
.eu-edu{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.eu-edu__text p{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 20px;}
.eu-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111111);margin:0 0 12px;}
.eu-edu__callout{background:var(--taas-panel,#F7F7F5);border-left:4px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:24px 28px;}
.eu-edu__callout p{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 8px;}
.eu-edu__callout p:last-child{margin-bottom:0;}
.eu-edu__panel{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:32px 28px;}
.eu-edu__panel-title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:16px;}
.eu-edu__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.eu-edu__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:20px;position:relative;line-height:1.5;}
.eu-edu__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}

/* ── Make cards ─────────────────────────────────────────────────────────────── */
.eu-makes{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
.eu-make{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:22px 18px;display:flex;flex-direction:column;gap:10px;text-decoration:none;transition:box-shadow 0.2s,transform 0.2s,border-color 0.2s;border-top:3px solid transparent;}
.eu-make:hover{box-shadow:0 4px 16px rgba(0,0,0,0.1);transform:translateY(-2px);border-top-color:var(--taas-yellow,#FFC800);}
.eu-make__icon{width:48px;height:48px;flex-shrink:0;}
.eu-make__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111111);}
.eu-make__desc{font-size:13px;color:var(--taas-mid,#666666);line-height:1.5;flex:1;}
.eu-make__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);margin-top:auto;}
.eu-make:hover .eu-make__link{color:var(--taas-yellow,#FFC800);}

/* ── Service cards ─────────────────────────────────────────────────────────── */
.eu-services{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.eu-svc{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:20px 18px;display:flex;flex-direction:column;gap:8px;text-decoration:none;transition:border-color 0.15s,box-shadow 0.15s;}
.eu-svc:hover{border-color:var(--taas-yellow,#FFC800);box-shadow:0 2px 8px rgba(0,0,0,0.06);}
.eu-svc__icon{width:40px;height:40px;flex-shrink:0;}
.eu-svc__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-black,#111111);}
.eu-svc__desc{font-size:13px;color:var(--taas-mid,#666666);line-height:1.5;flex:1;}
.eu-svc__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);margin-top:auto;}

/* ── Dealer vs Independent ─────────────────────────────────────────────────── */
.eu-compare{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:32px;}
.eu-compare__col{border-radius:var(--taas-radius,6px);padding:28px 24px;}
.eu-compare__col--dealer{background:#f5f5f5;border:1px solid #ddd;}
.eu-compare__col--taas{background:var(--taas-dark,#1A1A1A);}
.eu-compare__col-title{font-size:13px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:16px;color:var(--taas-mid,#666666);}
.eu-compare__col--taas .eu-compare__col-title{color:var(--taas-yellow,#FFC800);}
.eu-compare__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.eu-compare__list li{font-size:15px;padding-left:22px;position:relative;line-height:1.4;color:var(--taas-body,#333333);}
.eu-compare__col--taas .eu-compare__list li{color:#ddd;}
.eu-compare__list li::before{content:'✗';position:absolute;left:0;color:var(--taas-alert,#C0392B);font-weight:700;}
.eu-compare__col--taas .eu-compare__list li::before{content:'✓';color:var(--taas-yellow,#FFC800);}

/* ── Cambelt warning ───────────────────────────────────────────────────────── */
.eu-cambelt{border-left:4px solid var(--taas-alert,#C0392B);background:#fff5f5;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:8px;}
.eu-cambelt__title{font-size:17px;font-weight:700;color:var(--taas-alert,#C0392B);margin-bottom:10px;}
.eu-cambelt__body{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;margin-bottom:14px;}
.eu-cambelt__link{font-size:14px;font-weight:600;color:var(--taas-alert,#C0392B);text-decoration:underline;}

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.eu-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.eu-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.eu-enquiry__phone:hover{opacity:.65;}
.eu-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.eu-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}

/* ── CF7 dark ──────────────────────────────────────────────────────────────── */
.eu-sec--dark .wpcf7 label,.eu-sec--dark .wpcf7 span:not(.wpcf7-spinner),.eu-sec--dark .wpcf7 div:not(.wpcf7-response-output),.eu-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.eu-sec--dark .wpcf7 input[type="text"],.eu-sec--dark .wpcf7 input[type="email"],.eu-sec--dark .wpcf7 input[type="tel"],.eu-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.eu-sec--dark .wpcf7 input::placeholder,.eu-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.eu-sec--dark .wpcf7 input:focus,.eu-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.eu-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.eu-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* ── Suburb pills ──────────────────────────────────────────────────────────── */
.eu-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:24px;list-style:none;padding:0;}
.eu-pills li{display:inline-block;padding:7px 18px;border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;background:var(--taas-white,#FFFFFF);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333333);}

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.eu-faq{max-width:780px;margin:28px auto 0;}
.eu-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.eu-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.eu-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);transition:transform 0.2s;}
.eu-faq__item--open .eu-faq__q::after{content:'−';}
.eu-faq__a{display:none;padding:0 0 18px;}
.eu-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.eu-faq__item--open .eu-faq__a{display:block;}

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media(max-width:960px){.eu-hero__inner{grid-template-columns:1fr;}.eu-makes{grid-template-columns:repeat(3,1fr);}.eu-services{grid-template-columns:repeat(2,1fr);}.eu-compare{grid-template-columns:1fr;}.eu-enquiry{grid-template-columns:1fr;gap:32px;}.eu-edu{grid-template-columns:1fr;}}
@media(max-width:640px){.eu-phonestrip__num{font-size:17px;}.eu-enquiry{display:flex;flex-direction:column-reverse;}.eu-hero{padding:48px 0 40px;}.eu-hero h1{font-size:clamp(28px,7vw,42px);}.eu-hero__sub{font-size:14px;}.eu-hero__ctas{flex-direction:column;align-items:stretch;}.eu-hero__ctas .taas-btn{justify-content:center;text-align:center;}.eu-sec{padding:48px 0;}.eu-sec__h2{font-size:clamp(22px,5vw,30px);}.eu-sec__sub{font-size:14px;}.eu-makes{grid-template-columns:repeat(2,1fr);}.eu-services{grid-template-columns:1fr;}.eu-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.eu-trust__item{font-size:12px;}.eu-faq__q{font-size:14px;padding:16px 32px 16px 0;}.eu-faq__a p{font-size:13px;}.eu-enquiry__phone{font-size:clamp(24px,6vw,32px);}.eu-sidebar__phone{font-size:20px;}}
</style>

<!-- 1. HERO -->
<section class="eu-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="eu-hero__inner">
    <div>
      <span class="eu-hero__eyebrow">TAAS European</span>
      <h1>European Car Servicing<br>&amp; Repairs — <span>Manukau</span></h1>
      <p class="eu-hero__sub">Audi, Volkswagen, BMW, Mercedes-Benz, Land Rover, Porsche, MINI, Škoda and more — serviced with factory-spec diagnostics at independent rates. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
      <div class="eu-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book a Service</a>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
      </div>
    </div>
    <div class="eu-sidebar">
      <div class="eu-sidebar__title">What We Do</div>
      <ul class="eu-sidebar__list">
        <li>Logbook &amp; WOF servicing</li>
        <li>Factory-spec diagnostics</li>
        <li>Cambelt &amp; water pump</li>
        <li>Brakes, clutch &amp; discs</li>
        <li>Steering &amp; suspension</li>
        <li>DSG &amp; transmission service</li>
        <li>Cooling system &amp; radiator</li>
        <li>Auto electrical &amp; wiring</li>
        <li>Air conditioning regas</li>
        <li>EV &amp; hybrid servicing</li>
        <li>Pre-purchase inspection</li>
      </ul>
      <hr>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="eu-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="eu-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
    </div>
  </div>
</section>

<!-- 2. TRUST STRIP -->
<div class="eu-phonestrip"><div class="eu-phonestrip__inner"><span class="eu-phonestrip__label">European specialist — call now</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="eu-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="eu-trust"><div class="eu-trust__inner">
  <div class="eu-trust__item">MTA Assured</div>
  <div class="eu-trust__item">Factory-Spec Diagnostics</div>
  <div class="eu-trust__item">Independent Pricing</div>
  <div class="eu-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="eu-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. UNDERSTANDING EUROPEAN SERVICING -->
<section class="eu-sec eu-sec--white">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">Understanding the Difference</span>
    <h2 class="eu-sec__h2">Why European Vehicles Need Specialist Knowledge</h2>
    <div class="eu-edu">
      <div class="eu-edu__text">
        <p>European vehicles are engineered differently from Japanese and Korean cars. Tighter tolerances, specific oil grades, unique fastener types, electronic systems that require brand-specific diagnostic tools, and service intervals that vary significantly by make, model, and engine variant. A Golf and a Corolla might look similar from the outside — under the bonnet, the engineering philosophy is fundamentally different.</p>
        <p>The biggest practical difference is diagnostic access. VAG group vehicles (Volkswagen, Audi, Škoda) use proprietary communication protocols that generic OBD readers cannot fully access. BMW, Mercedes-Benz, and Land Rover have their own system architectures. A workshop without the correct tools can read basic engine codes but misses the majority of module data — body control, comfort systems, transmission adaptation, parking sensors, and more.</p>
        <p>The second difference is parts specification. European engines often require specific oil viscosities (VW 504/507, BMW LL-04, Mercedes 229.51) that differ from universal grades. Using the wrong oil does not cause immediate damage, but over time it affects timing chain wear, DPF regeneration cycles, and long-term engine health. We use the correct specification for your vehicle — every time.</p>
        <div class="eu-edu__callout">
          <h3>Your Warranty Is Protected</h3>
          <p>Under the Consumer Guarantees Act, you are entitled to have your vehicle serviced at any qualified workshop without voiding your manufacturer warranty — provided the service is carried out to manufacturer specification.</p>
          <p>We use the correct grade oils, OEM-equivalent parts, and document everything. Your service history is maintained to the same standard as a franchise dealer — at independent rates.</p>
        </div>
      </div>
      <div>
        <div class="eu-edu__panel">
          <div class="eu-edu__panel-title">What Sets TAAS European Apart</div>
          <ul class="eu-edu__list">
            <li>Factory-spec diagnostic tools — not generic OBD readers</li>
            <li>VAG, BMW, Mercedes, Land Rover protocols</li>
            <li>Correct oil specifications per make and model</li>
            <li>OEM-equivalent parts — correctly specified</li>
            <li>Independent labour rates — 30–50% below dealer</li>
            <li>No service department sales targets</li>
            <li>Talk directly to the technician doing the work</li>
            <li>Finance available — Afterpay, Q Card</li>
            <li>MTA Assured — industry accredited since <?php echo esc_html($established); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. MAKES GRID -->
<section class="eu-sec eu-sec--grey">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">European Makes</span>
    <h2 class="eu-sec__h2">European Makes We Specialise In</h2>
    <p class="eu-sec__sub">Factory-spec diagnostic tooling for every make listed. Each has its own service requirements, known failure patterns, and parts specifications — we know them.</p>
    <div class="eu-makes">
      <?php foreach ($makes as $mk) : ?>
      <a href="<?php echo esc_url($site_url . '/' . $mk['slug'] . '/'); ?>" class="eu-make">
        <div class="eu-make__icon"><?php echo eu_badge($mk['badge']); ?></div>
        <div class="eu-make__name"><?php echo esc_html($mk['name']); ?></div>
        <p class="eu-make__desc"><?php echo esc_html($mk['desc']); ?></p>
        <span class="eu-make__link"><?php echo esc_html($mk['name']); ?> Services →</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 5. SERVICES -->
<section class="eu-sec eu-sec--white">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">Services</span>
    <h2 class="eu-sec__h2">Services for European Vehicles</h2>
    <p class="eu-sec__sub">All work carried out in-house at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a>. No subcontracting, no farming out.</p>
    <div class="eu-services">
      <?php
      $svcs = [
        ['badge'=>'SVC','title'=>'Logbook Servicing','desc'=>'Manufacturer-spec oil, filter and fluid service. Documented and stamped. Does not void your factory warranty.','url'=>'/vehicle-servicing/','cta'=>'Servicing →'],
        ['badge'=>'DS','title'=>'Diagnostic Scanning','desc'=>'Factory-spec European diagnostics. Full fault code access across all ECUs — not a generic OBD reader.','url'=>'/diagnostic-scanning/','cta'=>'Diagnostics →'],
        ['badge'=>'WOF','title'=>'WOF Inspections','desc'=>'NZTA Authorised. Fixed '.esc_html($wof_price).'. Free 28-day recheck if repaired by TAAS.','url'=>'/wof/','cta'=>'WOF Info →'],
        ['badge'=>'MBC','title'=>'Brakes &amp; Clutch','desc'=>'Brake pads, discs, callipers, fluid. In-house disc machining. Clutch replacement for manual European vehicles.','url'=>'/manukau-brake-clutch/','cta'=>'Brakes →'],
        ['badge'=>'CB','title'=>'Cambelt &amp; Water Pump','desc'=>'Critical on most European engines. Interference engines mean belt failure equals engine damage. Full kit replacement.','url'=>'/cambelts-and-water-pumps/','cta'=>'Cambelt →'],
        ['badge'=>'CS','title'=>'Cooling System','desc'=>'Radiator, thermostat, coolant flush, hoses, head gasket. European engines run precise coolant specifications.','url'=>'/cooling-system/','cta'=>'Cooling →'],
        ['badge'=>'SS','title'=>'Steering &amp; Suspension','desc'=>'Shock absorbers, ball joints, control arms, steering rack. Wheel alignment after every geometry repair.','url'=>'/steering-and-suspension/','cta'=>'Suspension →'],
        ['badge'=>'TX','title'=>'Transmission Service','desc'=>'DSG, mechatronic, CVT, automatic. Fluid changes and diagnostics. Full rebuilds sublet to a specialist.','url'=>'/transmission-service-and-repair/','cta'=>'Transmission →'],
        ['badge'=>'AE','title'=>'Auto Electrical','desc'=>'European electrical systems are complex. Factory-spec diagnostics, wiring fault tracing, alternator, starter, lighting.','url'=>'/auto-electrical/','cta'=>'Auto Electrical →'],
        ['badge'=>'AC','title'=>'Air Conditioning','desc'=>'Regas, diagnosis, cabin filter, compressor repair. European AC systems fully supported. R134a and R1234yf.','url'=>'/air-conditioning/','cta'=>'Air Con →'],
        ['badge'=>'EV','title'=>'EV &amp; Hybrid','desc'=>'Volvo PHEV, BMW i-series, VW ID range. High-voltage qualified technicians. Hybrid battery checks.','url'=>'/electric-hybrid-vehicle-servicing/','cta'=>'EV &amp; Hybrid →'],
        ['badge'=>'PPI','title'=>'Pre-Purchase Inspection','desc'=>'Buying a used European vehicle? A PPI exposes hidden faults before you commit. Book before you buy.','url'=>'/pre-purchase-inspection-manukau/','cta'=>'PPI →'],
      ];
      foreach ($svcs as $svc) :
      ?>
      <a href="<?php echo esc_url($site_url . $svc['url']); ?>" class="eu-svc">
        <div class="eu-svc__icon"><?php echo eu_badge($svc['badge'], 40); ?></div>
        <div class="eu-svc__title"><?php echo $svc['title']; ?></div>
        <p class="eu-svc__desc"><?php echo $svc['desc']; ?></p>
        <span class="eu-svc__link"><?php echo $svc['cta']; ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 6. DEALER VS INDEPENDENT -->
<section class="eu-sec eu-sec--grey">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">The Case for Independent</span>
    <h2 class="eu-sec__h2">Dealer vs Independent Workshop</h2>
    <p class="eu-sec__sub">European dealers do good work. So do we — at significantly lower rates, without the overheads that inflate every invoice.</p>
    <div class="eu-compare">
      <div class="eu-compare__col eu-compare__col--dealer">
        <div class="eu-compare__col-title">Franchise Dealer</div>
        <ul class="eu-compare__list">
          <li>High hourly labour rates — showroom overhead recovered per job</li>
          <li>Service advisors with monthly revenue targets</li>
          <li>Manufacturer-mandated parts pricing — no flexibility</li>
          <li>Booking delays — often 1–2 weeks out</li>
          <li>You deal with a service adviser, not a technician</li>
        </ul>
      </div>
      <div class="eu-compare__col eu-compare__col--taas">
        <div class="eu-compare__col-title">TAAS European</div>
        <ul class="eu-compare__list">
          <li>Independent labour rates — typically 30–50% lower</li>
          <li>No sales targets — we advise what is actually needed</li>
          <li>OEM-equivalent parts, correctly specified for your vehicle</li>
          <li>Faster turnaround — South Auckland, Monday to Friday</li>
          <li>Talk directly to the people doing the work</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- 7. CAMBELT WARNING -->
<section class="eu-sec eu-sec--white">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">Important</span>
    <h2 class="eu-sec__h2">Cambelt Warning — European Engines</h2>
    <p class="eu-sec__sub">This is the one service European owners most commonly delay — and it carries the highest consequence if missed.</p>
    <div class="eu-cambelt">
      <div class="eu-cambelt__title">Most European engines are interference engines</div>
      <p class="eu-cambelt__body">On an interference engine, if the cambelt fails, the pistons and valves occupy the same space. The result is immediate internal engine damage — bent valves, damaged pistons, or a destroyed engine block. Repair costs can exceed $10,000. Replacement intervals vary widely — from 60,000 km to 200,000 km depending on make and model. VAG group, BMW, Peugeot and Renault engines are predominantly interference designs. If you do not know when your belt was last replaced, treat it as due. Cambelt replacement starts <?php echo esc_html($cambelt_price); ?>.</p>
      <a href="<?php echo esc_url($site_url . '/cambelts-and-water-pumps/'); ?>" class="eu-cambelt__link">Cambelt replacement information →</a>
    </div>
  </div>
</section>

<!-- 8. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="eu-sec eu-sec--dark" id="enquire">
  <div class="eu-sec__inner">
    <div class="eu-enquiry">
      <div>
        <span class="eu-sec__eyebrow">Book or Enquire</span>
        <h2 class="eu-sec__h2">Talk to Our European Team</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your make, model and what you need. We'll confirm availability and get back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="eu-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="eu-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- 9. REVIEWS -->
<section class="eu-sec eu-sec--white">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="eu-sec__h2">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- 10. SUBURBS -->
<section class="eu-sec eu-sec--grey">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">South Auckland</span>
    <h2 class="eu-sec__h2">European Car Specialist — South Auckland</h2>
    <p class="eu-sec__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="eu-pills">
      <?php
      // Non-linked pills — will become links when make × location pages are built
      $suburbs = ['Papatoetoe','Manukau','Māngere','Ōtāhuhu','Wiri','Manurewa','Flat Bush','Takanini','Papakura','Ōtara','Botany','Howick','Clover Park','Weymouth','Clendon','Hunters Corner','Māngere Bridge'];
      foreach ($suburbs as $s) {
        echo '<li>' . esc_html($s) . '</li>';
      }
      ?>
    </ul>
  </div>
</section>

<!-- 11. FAQ -->
<section class="eu-sec eu-sec--white">
  <div class="eu-sec__inner">
    <span class="eu-sec__eyebrow">FAQ</span>
    <h2 class="eu-sec__h2">Common Questions — TAAS European</h2>
    <div class="eu-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="eu-faq__item<?php echo $i===0?' eu-faq__item--open':''; ?>">
        <button class="eu-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="eu-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.eu-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var i=this.closest('.eu-faq__item'),o=i.classList.contains('eu-faq__item--open');document.querySelectorAll('.eu-faq__item--open').forEach(function(x){x.classList.remove('eu-faq__item--open');});if(!o)i.classList.add('eu-faq__item--open');});});
</script>

<?php get_footer(); ?>
