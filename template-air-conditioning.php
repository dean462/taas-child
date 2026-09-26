<?php
/**
 * Template Name: Air Conditioning Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /air-conditioning/
 * CSS namespace: .ach-
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
$aircon_price  = defined('TAAS_AIRCON_PRICE')  ? TAAS_AIRCON_PRICE  : 'from $280';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_AIRCON') ? TAAS_HERO_AIRCON : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Badge helper ─────────────────────────────────────────────────────────────
function ach_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Services ─────────────────────────────────────────────────────────────────
$services = [
    ['badge'=>'DR','title'=>'Degassing &amp; Regassing','desc'=>'Full refrigerant evacuation and recharge to manufacturer specification. R134a and R1234yf — covering older and newer vehicles.','url'=>'/air-conditioning-regas-manukau/','cta'=>'AC Regas →'],
    ['badge'=>'SD','title'=>'System Diagnosis &amp; Repair','desc'=>'Electronic and mechanical diagnosis of all AC faults — compressor, condenser, evaporator, expansion valve. Fault confirmed before repair recommended.','url'=>'/air-conditioning-diagnosis-manukau/','cta'=>'AC Diagnosis →'],
    ['badge'=>'CH','title'=>'Cooling &amp; Heating Repairs','desc'=>'Fault diagnosis and repair of both the cooling and heating circuits — including blend doors, heater cores, and actuators.','url'=>'/car-air-conditioning-repair-manukau/','cta'=>'AC Repair →'],
    ['badge'=>'LD','title'=>'Leak &amp; Blockage Detection','desc'=>'UV dye and electronic leak detection to locate refrigerant loss. Blockage identification and clearance to restore full system performance.','url'=>'/air-conditioning/','cta'=>'Enquire →'],
    ['badge'=>'PT','title'=>'Dry Pressure Testing','desc'=>'Pressure testing without refrigerant to confirm system integrity before regassing. Ensures repairs hold before refrigerant is introduced.','url'=>'/air-conditioning/','cta'=>'Enquire →'],
    ['badge'=>'PH','title'=>'Custom Pipe &amp; Hose Manufacture','desc'=>'On-site manufacture of replacement AC hoses and pipes — for vehicles where standard parts are unavailable or discontinued.','url'=>'/air-conditioning/','cta'=>'Enquire →'],
    ['badge'=>'OT','title'=>'Odour Treatment &amp; Deodorisation','desc'=>'Antibacterial treatment of the evaporator and cabin to eliminate musty or mouldy smells. Effective on all vehicle types.','url'=>'/air-conditioning/','cta'=>'Enquire →'],
    ['badge'=>'CF','title'=>'Cabin / Pollen Filter Replacement','desc'=>'Supply and fit of the correct cabin filter — improves in-cabin air quality and reduces strain on the AC system.','url'=>'/cabin-filter-replacement-manukau/','cta'=>'Cabin Filter →'],
    ['badge'=>'WD','title'=>'Windscreen Demisting','desc'=>'Diagnosis of slow or ineffective demisting — often linked to AC performance, low refrigerant, or blend door faults. A safety issue in winter.','url'=>'/air-conditioning/','cta'=>'Enquire →'],
    ['badge'=>'CC','title'=>'Climate Control Repairs','desc'=>'Fault diagnosis and repair of electronic climate control systems — single-zone, dual-zone, and automatic temperature control on all makes.','url'=>'/climate-control-repair-manukau/','cta'=>'Climate Control →'],
];

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    $taas_faqs['ac_regas_cost'],
    $taas_faqs['ac_signs'],
    $taas_faqs['ac_common_faults'],
    $taas_faqs['ac_duration'],
    $taas_faqs['ac_all_makes'],
    $taas_faqs['ac_safe_to_drive'],
    $taas_faqs['ac_refrigerant'],
    $taas_faqs['ac_musty_smell'],
    $taas_faqs['ac_custom_hoses'],
    $taas_faqs['ac_finance'],
    $taas_faqs['ac_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $f) {
    $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
}
$schema = [
    '@context'=>'https://schema.org',
    '@graph'=>[
        ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','alternateName'=>'TAAS Air Conditioning','url'=>$site_url,
         'description'=>'Car air conditioning regas, diagnosis, leak detection and repairs in Manukau, South Auckland. All makes and models. R134a and R1234yf. Custom hose manufacture on-site. Family-owned since '.$established.'.',
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
            ['@type'=>'ListItem','position'=>2,'name'=>'Air Conditioning','item'=>$page_url]]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.ach-hero__sub','.ach-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-air-conditioning .site-content,.page-template-template-air-conditioning .entry-content,.page-template-template-air-conditioning .entry-header,.page-template-template-air-conditioning article,.page-template-template-air-conditioning #primary,.page-template-template-air-conditioning #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-air-conditioning{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}

/* ── Typography ────────────────────────────────────────────────────────────── */
.ach-hero h1,.ach-sec__h2,.ach-edu h3,.ach-problems h3,.ach-pricing__title,.ach-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.ach-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;}
.ach-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.ach-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.ach-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.ach-hero h1 span{color:var(--taas-yellow,#FFC800);}
.ach-hero__sub{font-size:16px;color:#aaa;max-width:540px;margin:0 0 28px;line-height:1.75;}
.ach-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}

/* ── Sidebar ───────────────────────────────────────────────────────────────── */
.ach-sidebar{background:#1c1c1c;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.ach-sidebar__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.ach-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.ach-sidebar__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.ach-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.ach-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.ach-sidebar__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.ach-sidebar__phone:hover{opacity:.65;}
.ach-sidebar__detail{font-size:12px;color:#888;line-height:1.75;}

/* ── Trust strip ───────────────────────────────────────────────────────────── */
.ach-phonestrip{background:var(--taas-yellow,#FFC800);}.ach-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.ach-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.ach-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.ach-phonestrip__num:hover{opacity:.65;}
.ach-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.ach-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.ach-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.ach-trust__item::before{content:'✓';font-weight:900;}

/* ── Sections ──────────────────────────────────────────────────────────────── */
.ach-sec{padding:var(--taas-sec-pad,72px) 0;}
.ach-sec--white{background:var(--taas-white,#FFFFFF);}
.ach-sec--grey{background:var(--taas-panel,#F7F7F5);}
.ach-sec--dark{background:var(--taas-dark,#1A1A1A);}
.ach-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.ach-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.ach-sec--dark .ach-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.ach-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.ach-sec--dark .ach-sec__h2{color:var(--taas-white,#FFFFFF);}
.ach-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.ach-sec--dark .ach-sec__sub{color:#aaa;}

/* ── Educational section ───────────────────────────────────────────────────── */
.ach-edu{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.ach-edu__text p{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 20px;}
.ach-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111111);margin:0 0 12px;}
.ach-edu__callout{background:var(--taas-panel,#F7F7F5);border-left:4px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:24px 28px;}
.ach-edu__callout p{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 8px;}
.ach-edu__callout p:last-child{margin-bottom:0;}
.ach-edu__panel{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:32px 28px;}
.ach-edu__panel-title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:16px;}
.ach-edu__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.ach-edu__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:20px;position:relative;line-height:1.5;}
.ach-edu__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}

/* ── Service cards ─────────────────────────────────────────────────────────── */
.ach-services{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.ach-service{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:20px 18px;display:flex;flex-direction:column;gap:8px;text-decoration:none;transition:box-shadow 0.2s,transform 0.2s,border-color 0.2s;border-top:3px solid transparent;}
.ach-service:hover{box-shadow:0 4px 16px rgba(0,0,0,0.1);transform:translateY(-2px);border-top-color:var(--taas-yellow,#FFC800);}
.ach-service__icon{width:40px;height:40px;flex-shrink:0;}
.ach-service__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-black,#111111);}
.ach-service__desc{font-size:13px;color:var(--taas-mid,#666666);line-height:1.5;flex:1;}
.ach-service__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);margin-top:auto;}
.ach-service:hover .ach-service__link{color:var(--taas-yellow,#FFC800);}

/* ── Common problems ───────────────────────────────────────────────────────── */
.ach-problems{display:grid;grid-template-columns:1fr 1fr;gap:32px 48px;margin-top:24px;}
.ach-problems h3{font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:8px;}
.ach-problems p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;}

/* ── Pricing ───────────────────────────────────────────────────────────────── */
.ach-pricing{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px;}
.ach-pricing__card{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;text-align:center;}
.ach-pricing__card--highlight{border-color:var(--taas-yellow,#FFC800);border-width:2px;}
.ach-pricing__badge{margin:0 auto 16px;}
.ach-pricing__title{font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:8px;}
.ach-pricing__price{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:24px;font-weight:800;color:var(--taas-dark,#1A1A1A);margin-bottom:12px;}
.ach-pricing__desc{font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;}
.ach-pricing__note{margin-top:28px;font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;max-width:700px;}

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.ach-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.ach-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.ach-enquiry__phone:hover{opacity:.65;}
.ach-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.ach-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}

/* ── CF7 dark ──────────────────────────────────────────────────────────────── */
.ach-sec--dark .wpcf7 label,.ach-sec--dark .wpcf7 span:not(.wpcf7-spinner),.ach-sec--dark .wpcf7 div:not(.wpcf7-response-output),.ach-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.ach-sec--dark .wpcf7 input[type="text"],.ach-sec--dark .wpcf7 input[type="email"],.ach-sec--dark .wpcf7 input[type="tel"],.ach-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.ach-sec--dark .wpcf7 input::placeholder,.ach-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.ach-sec--dark .wpcf7 input:focus,.ach-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.ach-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.ach-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* ── Suburb pills ──────────────────────────────────────────────────────────── */
.ach-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:24px;list-style:none;padding:0;}
.ach-pills li a{display:inline-block;padding:7px 18px;border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;background:var(--taas-white,#FFFFFF);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333333);text-decoration:none;transition:all 0.15s;}
.ach-pills li a:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:600;}

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.ach-faq{max-width:780px;margin:28px auto 0;}
.ach-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.ach-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.ach-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);transition:transform 0.2s;}
.ach-faq__item--open .ach-faq__q::after{content:'−';}
.ach-faq__a{display:none;padding:0 0 18px;}
.ach-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.ach-faq__a a{color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;}
.ach-faq__a a:hover{text-decoration:underline;}
.ach-faq__item--open .ach-faq__a{display:block;}

/* ── Related ───────────────────────────────────────────────────────────────── */
.ach-related{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media(max-width:960px){.ach-hero__inner{grid-template-columns:1fr;}.ach-services{grid-template-columns:repeat(2,1fr);}.ach-edu{grid-template-columns:1fr;}.ach-pricing{grid-template-columns:1fr;}.ach-enquiry{grid-template-columns:1fr;gap:32px;}.ach-related{grid-template-columns:1fr;}.ach-problems{grid-template-columns:1fr;gap:24px;}}
@media(max-width:640px){.ach-phonestrip__num{font-size:17px;}.ach-enquiry{display:flex;flex-direction:column-reverse;}.ach-hero{padding:48px 0 40px;}.ach-hero h1{font-size:clamp(28px,7vw,42px);}.ach-hero__sub{font-size:14px;}.ach-hero__ctas{flex-direction:column;align-items:stretch;}.ach-hero__ctas .taas-btn{justify-content:center;text-align:center;}.ach-sec{padding:48px 0;}.ach-sec__h2{font-size:clamp(22px,5vw,30px);}.ach-sec__sub{font-size:14px;}.ach-services{grid-template-columns:1fr;}.ach-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.ach-trust__item{font-size:12px;}.ach-faq__q{font-size:14px;padding:16px 32px 16px 0;}.ach-faq__a p{font-size:13px;}.ach-enquiry__phone{font-size:clamp(24px,6vw,32px);}.ach-sidebar__phone{font-size:20px;}}
</style>

<!-- 1. HERO -->
<section class="ach-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="ach-hero__inner">
    <div>
      <span class="ach-hero__eyebrow">Air Conditioning — Manukau</span>
      <h1>Air Conditioning<br><span>Service &amp; Repairs</span></h1>
      <p class="ach-hero__sub">Regassing, diagnosis, leak detection and repairs for all makes and models. We diagnose before we recommend — find the fault first, fix it right. Serving <?php echo esc_html($customers); ?> customers across South Auckland since <?php echo esc_html($established); ?>.</p>
      <div class="ach-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Enquire About AC Service</a>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
      </div>
    </div>
    <div class="ach-sidebar">
      <div class="ach-sidebar__title">What We Do</div>
      <ul class="ach-sidebar__list">
        <li>Degassing &amp; regassing</li>
        <li>System diagnosis &amp; repair</li>
        <li>Leak &amp; blockage detection</li>
        <li>Compressor repair &amp; replacement</li>
        <li>Climate control repair</li>
        <li>Cabin &amp; pollen filter supply &amp; fit</li>
        <li>Custom hose manufacture on-site</li>
        <li>Odour treatment &amp; deodorisation</li>
        <li>Windscreen demisting diagnosis</li>
        <li>R134a and R1234yf refrigerant</li>
      </ul>
      <hr>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="ach-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="ach-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
    </div>
  </div>
</section>

<!-- 2. TRUST STRIP -->
<div class="ach-phonestrip"><div class="ach-phonestrip__inner"><span class="ach-phonestrip__label">AC not cooling? We can help</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="ach-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="ach-trust"><div class="ach-trust__inner">
  <div class="ach-trust__item">MTA Assured</div>
  <div class="ach-trust__item">Estimate Before We Start</div>
  <div class="ach-trust__item">Diagnosis Often Available Same Day</div>
  <div class="ach-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="ach-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. UNDERSTANDING AC -->
<section class="ach-sec ach-sec--white">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">Understanding the System</span>
    <h2 class="ach-sec__h2">How Your Car's Air Conditioning Works</h2>
    <div class="ach-edu">
      <div class="ach-edu__text">
        <p>Your car's AC system does more than cool the cabin. It dehumidifies the air, clears windscreen fog in winter, and filters airborne particles through the cabin filter. When any part of this system fails, the effects go beyond comfort — a car that cannot demist properly is a safety issue.</p>
        <p>The system works by compressing refrigerant gas into a high-pressure liquid, passing it through a condenser to shed heat, then expanding it through a valve into the evaporator inside the dashboard. As it expands, it absorbs heat from the cabin air, cooling it. A blower motor pushes that cooled air through the vents.</p>
        <p>Over time, refrigerant escapes through micro-leaks in hoses, O-rings, and seals. This is normal — most systems lose a small amount each year. But a system that needs regassing every season has a leak that needs finding and fixing, not just topping up.</p>
        <div class="ach-edu__callout">
          <h3>Why "Just Regas It" Often Doesn't Work</h3>
          <p>A regas puts refrigerant back into the system — but if the system has a leak, that new gas will escape in weeks or months. If the compressor is failing, no amount of gas will fix the noise or the lack of cooling. If a blend door actuator has seized, the system may cool but not direct air correctly.</p>
          <p>That is why we diagnose first. We test the system, find the fault, and give you an estimate before doing any work. If it genuinely just needs a regas, that is what we do. If there is a fault, you know about it before spending money on gas that will leak out again.</p>
        </div>
      </div>
      <div>
        <div class="ach-edu__panel">
          <div class="ach-edu__panel-title">AC Services at TAAS</div>
          <ul class="ach-edu__list">
            <li>System tested before regassing</li>
            <li>R134a and R1234yf refrigerant</li>
            <li>UV dye and electronic leak detection</li>
            <li>Compressor, condenser, evaporator repair</li>
            <li>Custom pipe and hose manufacture on-site</li>
            <li>Blend door and actuator repair</li>
            <li>Cabin filter supply and fit</li>
            <li>Antibacterial odour treatment</li>
            <li>All makes — Japanese, Korean, European, American</li>
            <li>Finance available — Afterpay, Q Card</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. SERVICES GRID -->
<section class="ach-sec ach-sec--grey">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">Services</span>
    <h2 class="ach-sec__h2">Air Conditioning Services — Manukau</h2>
    <p class="ach-sec__sub">All work carried out in-house at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a>. No outsourcing, no waiting.</p>
    <div class="ach-services">
      <?php foreach ($services as $svc) : ?>
      <a href="<?php echo esc_url($site_url . $svc['url']); ?>" class="ach-service">
        <div class="ach-service__icon"><?php echo ach_badge($svc['badge']); ?></div>
        <div class="ach-service__title"><?php echo $svc['title']; ?></div>
        <p class="ach-service__desc"><?php echo esc_html($svc['desc']); ?></p>
        <span class="ach-service__link"><?php echo $svc['cta']; ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 5. COMMON PROBLEMS -->
<section class="ach-sec ach-sec--white">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">What We See</span>
    <h2 class="ach-sec__h2">Common AC Problems in South Auckland</h2>
    <p class="ach-sec__sub">These are the most common air conditioning faults we diagnose and repair. Most are straightforward once the cause is confirmed.</p>
    <div class="ach-problems">
      <div>
        <h3>AC blows warm or less-cold air</h3>
        <p>The most common complaint. Often low refrigerant — but not always. Could be a compressor starting to fail, a blocked expansion valve, or a faulty pressure switch. We test the system pressures and component function before recommending a regas or a repair.</p>
      </div>
      <div>
        <h3>Musty smell when AC is turned on</h3>
        <p>Bacterial and fungal growth on the evaporator — the component that sits inside the dashboard in a dark, damp environment. We carry out an antibacterial treatment and cabin filter replacement. Common after winter when the AC has not been used for months.</p>
      </div>
      <div>
        <h3>AC makes a noise when it kicks in</h3>
        <p>A clunk, rattle, or grinding noise when the compressor engages usually means the compressor clutch or bearings are worn. This is the most expensive AC component — but catching it early can sometimes avoid a full replacement. Do not ignore AC noises.</p>
      </div>
      <div>
        <h3>Windscreen will not demist properly</h3>
        <p>The AC system is critical for demisting — it dehumidifies the air before the heater warms it. If your demisting is slow or ineffective, the AC system is likely low on refrigerant or has a fault. This is a safety issue in winter driving conditions.</p>
      </div>
    </div>
  </div>
</section>

<!-- 6. PRICING -->
<section class="ach-sec ach-sec--grey">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">Pricing Guide</span>
    <h2 class="ach-sec__h2">Air Conditioning Pricing — Manukau</h2>
    <p class="ach-sec__sub">All fees explained upfront before any work begins. Estimate provided before proceeding with any repair.</p>
    <div class="ach-pricing">
      <div class="ach-pricing__card ach-pricing__card--highlight">
        <div class="ach-pricing__badge"><?php echo ach_badge('DR', 48); ?></div>
        <div class="ach-pricing__title">Standard Regas &amp; Dye Test</div>
        <div class="ach-pricing__price"><?php echo esc_html($aircon_price); ?></div>
        <p class="ach-pricing__desc">Full evacuation and recharge with UV dye for leak monitoring. R134a or R1234yf as required by your vehicle.</p>
      </div>
      <div class="ach-pricing__card">
        <div class="ach-pricing__badge"><?php echo ach_badge('SD', 48); ?></div>
        <div class="ach-pricing__title">System Diagnosis &amp; Repair</div>
        <div class="ach-pricing__price">Contact for estimate</div>
        <p class="ach-pricing__desc">Full system diagnosis including pressure testing, leak detection, and component checks. Repair cost depends on the fault — estimate provided before any work.</p>
      </div>
      <div class="ach-pricing__card">
        <div class="ach-pricing__badge"><?php echo ach_badge('CF', 48); ?></div>
        <div class="ach-pricing__title">Cabin Filter Replacement</div>
        <div class="ach-pricing__price">Contact for estimate</div>
        <p class="ach-pricing__desc">Supply and fit the correct cabin filter for your vehicle. Price varies by make and model. Often done alongside a regas or service.</p>
      </div>
    </div>
    <p class="ach-pricing__note">Compressor, condenser, and evaporator repairs are priced on inspection — cost depends on the vehicle and the fault. Custom hose manufacture and odour treatment also available. All pricing includes GST. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> for an estimate.</p>
  </div>
</section>

<!-- 7. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="ach-sec ach-sec--dark" id="enquire">
  <div class="ach-sec__inner">
    <div class="ach-enquiry">
      <div>
        <span class="ach-sec__eyebrow">Book or Enquire</span>
        <h2 class="ach-sec__h2">Enquire About Air Conditioning</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and what the AC is doing. We'll come back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="ach-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ach-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- 8. RELATED SERVICES -->
<section class="ach-sec ach-sec--grey">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">Also at TAAS</span>
    <h2 class="ach-sec__h2">Related Services</h2>
    <p class="ach-sec__sub">AC work often overlaps with other services. Combine them in one visit — fewer trips, less downtime.</p>
    <div class="ach-related">
      <a href="<?php echo esc_url($site_url . '/auto-electrical/'); ?>" class="ach-service">
        <div class="ach-service__icon"><?php echo ach_badge('AE'); ?></div>
        <div class="ach-service__title">Auto Electrical</div>
        <p class="ach-service__desc">AC faults often trigger electrical codes. Raj and the team diagnose both systems together.</p>
        <span class="ach-service__link">Auto Electrical →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wof/'); ?>" class="ach-service">
        <div class="ach-service__icon"><?php echo ach_badge('WOF'); ?></div>
        <div class="ach-service__title">Warrant of Fitness</div>
        <p class="ach-service__desc">Combine an AC service with a WOF check. One visit, one drop-off.</p>
        <span class="ach-service__link">WOF →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="ach-service">
        <div class="ach-service__icon"><?php echo ach_badge('SVC'); ?></div>
        <div class="ach-service__title">Vehicle Servicing</div>
        <p class="ach-service__desc">Full vehicle service while your AC is being worked on. Cabin filter included in most service packages.</p>
        <span class="ach-service__link">Servicing →</span>
      </a>
    </div>
  </div>
</section>

<!-- 9. REVIEWS -->
<section class="ach-sec ach-sec--white">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="ach-sec__h2">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- 10. SUBURB PILLS -->
<section class="ach-sec ach-sec--grey">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">South Auckland</span>
    <h2 class="ach-sec__h2">Air Conditioning Near You</h2>
    <p class="ach-sec__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="ach-pills">
      <?php
      $suburbs = [
        ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Manukau','slug'=>'manukau'],
        ['label'=>'Māngere','slug'=>'mangere'],['label'=>'Māngere Bridge','slug'=>'mangere-bridge'],
        ['label'=>'Ōtāhuhu','slug'=>'otahuhu'],['label'=>'Wiri','slug'=>'wiri'],
        ['label'=>'Manurewa','slug'=>'manurewa'],['label'=>'Flat Bush','slug'=>'flat-bush'],
        ['label'=>'Takanini','slug'=>'takanini'],['label'=>'Papakura','slug'=>'papakura'],
        ['label'=>'Ōtara','slug'=>'otara'],['label'=>'Botany','slug'=>'botany'],
        ['label'=>'Howick','slug'=>'howick'],['label'=>'Clover Park','slug'=>'clover-park'],
        ['label'=>'Weymouth','slug'=>'weymouth'],['label'=>'Clendon','slug'=>'clendon'],
        ['label'=>'Hunters Corner','slug'=>'hunters-corner'],
      ];
      foreach ($suburbs as $s) {
        echo '<li><a href="'.esc_url($site_url.'/air-conditioning-'.$s['slug'].'/').'">Air Conditioning '.esc_html($s['label']).'</a></li>';
      }
      ?>
    </ul>
  </div>
</section>

<!-- 11. FAQ -->
<section class="ach-sec ach-sec--white">
  <div class="ach-sec__inner">
    <span class="ach-sec__eyebrow">FAQ</span>
    <h2 class="ach-sec__h2">Common Questions — Air Conditioning</h2>
    <div class="ach-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="ach-faq__item<?php echo $i===0?' ach-faq__item--open':''; ?>">
        <button class="ach-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="ach-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.ach-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var i=this.closest('.ach-faq__item'),o=i.classList.contains('ach-faq__item--open');document.querySelectorAll('.ach-faq__item--open').forEach(function(x){x.classList.remove('ach-faq__item--open');});if(!o)i.classList.add('ach-faq__item--open');});});
</script>

<?php get_footer(); ?>
