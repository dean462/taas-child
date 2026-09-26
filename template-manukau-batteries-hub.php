<?php
/**
 * Template Name: Manukau Batteries Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /manukau-batteries/
 * CSS namespace: .mbh-
 *
 * Rebuilt June 2026 — full design system compliance
 * Inter only, CSS variables with fallbacks, @graph schema,
 * educational section, Neuton Power endorsement, pricing section
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$battery_price = defined('TAAS_BATTERY_PRICE') ? TAAS_BATTERY_PRICE : 'from $180 fitted';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_BATTERIES') ? TAAS_HERO_BATTERIES : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

function mbh_badge($initials, $size = 48) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.2) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

$battery_types = [
    ['badge'=>'CAR','name'=>'Car Batteries','desc'=>'Standard, EFB, AGM and stop-start batteries for all cars and passenger vehicles. Matched to your vehicle specification.','url'=>'/car-battery-manukau/','cta'=>'Car Batteries →','chips'=>['Standard','EFB','AGM','Stop-Start']],
    ['badge'=>'4WD','name'=>'4WD &amp; SUV Batteries','desc'=>'High-CCA batteries for 4WDs, utes and SUVs. Hilux, Ranger, Navara, D-MAX, Triton, Pajero — stock held.','url'=>'/4wd-battery-manukau/','cta'=>'4WD Batteries →','chips'=>['4WD','SUV','Ute','Diesel']],
    ['badge'=>'AGM','name'=>'AGM / Stop-Start','desc'=>'Stop-start vehicle specialists. Correct AGM spec matched every time. BMS registration included for European vehicles.','url'=>'/agm-battery-manukau/','cta'=>'AGM Batteries →','chips'=>['AGM','EFB','BMS Reg','European']],
    ['badge'=>'MAR','name'=>'Marine Batteries','desc'=>'Starting, deep cycle and dual-purpose marine batteries for boats and jet skis. Built for on-water vibration.','url'=>'/marine-battery-manukau/','cta'=>'Marine Batteries →','chips'=>['Starting','Deep Cycle','Dual Purpose']],
    ['badge'=>'MCY','name'=>'Motorcycle Batteries','desc'=>'Conventional, AGM and gel motorcycle batteries. Most common models in stock. Bring the bike in or call with details.','url'=>'/motorcycle-battery-manukau/','cta'=>'Motorcycle Batteries →','chips'=>['Conventional','AGM','Gel','Scooter']],
];

$faqs = [
    $taas_faqs['mb_location'],
    $taas_faqs['mb_cost'],
    $taas_faqs['mb_types'],
    $taas_faqs['mb_free_test'],
    $taas_faqs['mb_same_day'],
    $taas_faqs['mb_european_bms'],
    $taas_faqs['mb_keeps_going_flat'],
    $taas_faqs['mb_brands'],
    $taas_faqs['mb_recycle'],
    $taas_faqs['mb_marine'],
    $taas_faqs['mb_finance'],
];

$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = [
    '@context'=>'https://schema.org',
    '@graph'=>[
        ['@type'=>['AutoPartsStore','LocalBusiness'],'@id'=>$site_url.'/#manukau-batteries','name'=>'Manukau Batteries — Tony Allen Auto Service',
         'url'=>$page_url,
         'description'=>'Car, 4WD, AGM, marine and motorcycle batteries in Manukau, South Auckland. Supply and fit. Authorised Neuton Power and Bosch dealer. Free battery testing. Family-owned since '.$established.'.',
         'telephone'=>[$phone_free,$phone_local],'email'=>defined('TAAS_EMAIL')?TAAS_EMAIL:'enquiries@taas.co.nz','foundingDate'=>'1985-10',
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
            ['@type'=>'ListItem','position'=>2,'name'=>'Manukau Batteries','item'=>$page_url]]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.mbh-hero__sub','.mbh-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-manukau-batteries-hub .site-content,.page-template-template-manukau-batteries-hub .entry-content,.page-template-template-manukau-batteries-hub .entry-header,.page-template-template-manukau-batteries-hub article,.page-template-template-manukau-batteries-hub #primary,.page-template-template-manukau-batteries-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-manukau-batteries-hub{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.mbh-hero h1,.mbh-sec__h2,.mbh-edu h3,.mbh-faq__q,.mbh-neuton h3{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.mbh-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;}
.mbh-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.mbh-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.mbh-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.mbh-hero h1 span{color:var(--taas-yellow,#FFC800);}
.mbh-hero__sub{font-size:16px;color:#aaa;max-width:540px;margin:0 0 28px;line-height:1.75;}
.mbh-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.mbh-sidebar{background:#1c1c1c;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.mbh-sidebar__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.mbh-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.mbh-sidebar__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.mbh-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.mbh-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.mbh-sidebar__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.mbh-sidebar__phone:hover{opacity:.65;}
.mbh-sidebar__detail{font-size:12px;color:#888;line-height:1.75;}
.mbh-phonestrip{background:var(--taas-yellow,#FFC800);}.mbh-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.mbh-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.mbh-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.mbh-phonestrip__num:hover{opacity:.65;}
.mbh-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.mbh-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.mbh-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.mbh-trust__item::before{content:'✓';font-weight:900;}
.mbh-sec{padding:var(--taas-sec-pad,72px) 0;}
.mbh-sec--white{background:var(--taas-white,#FFFFFF);}
.mbh-sec--grey{background:var(--taas-panel,#F7F7F5);}
.mbh-sec--dark{background:var(--taas-dark,#1A1A1A);}
.mbh-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.mbh-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.mbh-sec--dark .mbh-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.mbh-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.mbh-sec--dark .mbh-sec__h2{color:var(--taas-white,#FFFFFF);}
.mbh-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.mbh-sec--dark .mbh-sec__sub{color:#aaa;}
.mbh-edu{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.mbh-edu__text p{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 20px;}
.mbh-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111111);margin:0 0 12px;}
.mbh-edu__callout{background:var(--taas-panel,#F7F7F5);border-left:4px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:24px 28px;}
.mbh-edu__callout p{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 8px;}
.mbh-edu__callout p:last-child{margin-bottom:0;}
.mbh-types{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.mbh-type{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:22px 18px;display:flex;flex-direction:column;gap:8px;text-decoration:none;transition:box-shadow 0.2s,transform 0.2s,border-color 0.2s;border-top:3px solid transparent;}
.mbh-type:hover{box-shadow:0 4px 16px rgba(0,0,0,0.1);transform:translateY(-2px);border-top-color:var(--taas-yellow,#FFC800);}
.mbh-type__icon{width:48px;height:48px;flex-shrink:0;}
.mbh-type__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111111);}
.mbh-type__desc{font-size:13px;color:var(--taas-mid,#666666);line-height:1.5;flex:1;}
.mbh-type__chips{display:flex;flex-wrap:wrap;gap:5px;margin:4px 0;}
.mbh-type__chip{background:var(--taas-panel,#F7F7F5);color:var(--taas-body,#333333);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:600;padding:3px 8px;border-radius:3px;}
.mbh-type__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);margin-top:auto;}
.mbh-neuton{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;margin-top:32px;}
.mbh-neuton__visual{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:40px 32px;display:flex;flex-direction:column;align-items:center;gap:24px;text-align:center;}
.mbh-neuton__badge-label{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:5px 14px;border-radius:3px;}
.mbh-warranty{border-left:4px solid var(--taas-yellow,#FFC800);background:var(--taas-panel,#F7F7F5);padding:20px 24px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin:20px 0;}
.mbh-warranty__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--taas-black,#111111);margin-bottom:8px;}
.mbh-warranty__text{font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;}
.mbh-pricing{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:32px;}
.mbh-pricing__card{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;text-align:center;}
.mbh-pricing__card--highlight{border-color:var(--taas-yellow,#FFC800);border-width:2px;}
.mbh-pricing__badge{margin:0 auto 16px;}
.mbh-pricing__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:8px;}
.mbh-pricing__price{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:24px;font-weight:800;color:var(--taas-dark,#1A1A1A);margin-bottom:12px;}
.mbh-pricing__desc{font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;}
.mbh-pricing__note{margin-top:28px;font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;max-width:700px;}
.mbh-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.mbh-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.mbh-enquiry__phone:hover{opacity:.65;}
.mbh-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.mbh-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.mbh-sec--dark .wpcf7 label,.mbh-sec--dark .wpcf7 span:not(.wpcf7-spinner),.mbh-sec--dark .wpcf7 div:not(.wpcf7-response-output),.mbh-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.mbh-sec--dark .wpcf7 input[type="text"],.mbh-sec--dark .wpcf7 input[type="email"],.mbh-sec--dark .wpcf7 input[type="tel"],.mbh-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.mbh-sec--dark .wpcf7 input::placeholder,.mbh-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.mbh-sec--dark .wpcf7 input:focus,.mbh-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.mbh-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.mbh-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.mbh-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;list-style:none;padding:0;}
.mbh-pills li a{display:inline-block;padding:7px 18px;border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;background:var(--taas-white,#FFFFFF);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:var(--taas-body,#333333);text-decoration:none;transition:all 0.15s;}
.mbh-pills li a:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:600;}
.mbh-pill-group{margin-bottom:24px;}
.mbh-pill-group__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666666);margin-bottom:10px;}
.mbh-faq{max-width:780px;margin:28px auto 0;}
.mbh-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.mbh-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.mbh-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.mbh-faq__item--open .mbh-faq__q::after{content:'−';}
.mbh-faq__a{display:none;padding:0 0 18px;}
.mbh-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.mbh-faq__item--open .mbh-faq__a{display:block;}
.mbh-related{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.mbh-related-card{display:flex;align-items:center;gap:12px;padding:16px 18px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s;}
.mbh-related-card:hover{border-color:var(--taas-yellow,#FFC800);}
.mbh-related-card__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-black,#111111);}
@media(max-width:960px){.mbh-hero__inner{grid-template-columns:1fr;}.mbh-types{grid-template-columns:repeat(2,1fr);}.mbh-neuton{grid-template-columns:1fr;}.mbh-enquiry{grid-template-columns:1fr;gap:32px;}.mbh-pricing{grid-template-columns:1fr;}.mbh-edu{grid-template-columns:1fr;}.mbh-related{grid-template-columns:1fr;}}
@media(max-width:640px){.mbh-phonestrip__num{font-size:17px;}.mbh-enquiry{display:flex;flex-direction:column-reverse;}.mbh-hero{padding:48px 0 40px;}.mbh-hero h1{font-size:clamp(28px,7vw,42px);}.mbh-hero__sub{font-size:14px;}.mbh-hero__ctas{flex-direction:column;align-items:stretch;}.mbh-hero__ctas .taas-btn{text-align:center;}.mbh-sec{padding:48px 0;}.mbh-sec__h2{font-size:clamp(22px,5vw,30px);}.mbh-types{grid-template-columns:1fr;}.mbh-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.mbh-trust__item{font-size:12px;}.mbh-faq__q{font-size:14px;padding:16px 32px 16px 0;}.mbh-faq__a p{font-size:13px;}.mbh-enquiry__phone{font-size:clamp(24px,6vw,32px);}}
</style>

<!-- 1. HERO -->
<section class="mbh-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="mbh-hero__inner">
  <div>
    <span class="mbh-hero__eyebrow">Manukau Batteries</span>
    <h1>Car Batteries <span>Manukau</span><br>Supply &amp; Fit</h1>
    <p class="mbh-hero__sub">Authorised Neuton Power and Bosch dealer. Car, 4WD, AGM, marine and motorcycle batteries — supply and fit at 139 Cavendish Drive. Free battery testing. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
    <div class="mbh-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Get an Estimate</a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
  <div class="mbh-sidebar">
    <div class="mbh-sidebar__title">What We Offer</div>
    <ul class="mbh-sidebar__list">
      <li>Car, 4WD, AGM &amp; marine batteries</li>
      <li>Same-day supply &amp; fit</li>
      <li>Free battery load test</li>
      <li>Free alternator &amp; starter test</li>
      <li>BMS registration — European cars</li>
      <li>Old battery recycled free</li>
      <li>Walk-ins welcome mornings</li>
    </ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="mbh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="mbh-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
  </div>
</div></section>

<!-- 2. TRUST STRIP -->
<div class="mbh-phonestrip"><div class="mbh-phonestrip__inner"><span class="mbh-phonestrip__label">Need a battery? Call now</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="mbh-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="mbh-trust"><div class="mbh-trust__inner">
  <div class="mbh-trust__item">Neuton Power Authorised</div>
  <div class="mbh-trust__item">Bosch Authorised</div>
  <div class="mbh-trust__item">Free Battery Testing</div>
  <div class="mbh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="mbh-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. UNDERSTANDING BATTERIES -->
<section class="mbh-sec mbh-sec--white"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">Understanding Batteries</span>
  <h2 class="mbh-sec__h2">Why the Right Battery Matters</h2>
  <div class="mbh-edu">
    <div class="mbh-edu__text">
      <p>A car battery does more than start the engine. It stabilises voltage across the electrical system, powers accessories when the engine is off, and in modern vehicles with stop-start systems, it cycles hundreds of times a day. The wrong battery — wrong chemistry, wrong CCA, wrong group size — shortens battery life and can cause electrical faults.</p>
      <p>Standard lead-acid batteries work fine in conventional vehicles. But stop-start vehicles need AGM or EFB batteries that handle deep cycling. European vehicles need BMS registration after replacement so the charging system knows a new battery is fitted. Marine applications need batteries built for vibration and deep discharge. Fitting the wrong type is not just a waste of money — it can damage the charging system.</p>
      <p>We test before we recommend. A free load test tells us whether the battery is genuinely failing or whether the problem is actually the alternator, a parasitic drain, or a wiring fault. Fitting a new battery does not fix a charging problem.</p>
      <div class="mbh-edu__callout">
        <h3>Test Before You Replace</h3>
        <p>A battery that keeps going flat is not always a battery problem. We test the battery, alternator, and starter motor before recommending anything. No charge for testing — walk in any weekday.</p>
      </div>
    </div>
    <div>
      <div class="mbh-neuton__visual">
        <span class="mbh-neuton__badge-label">Authorised YHI Dealer</span>
        <div style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,208,0,0.5);margin-bottom:8px;">Our recommended brand</div>
        <img src="<?php echo esc_url($site_url); ?>/wp-content/uploads/2026/05/NEW_NeutonPower_RD-Copy.png" alt="Neuton Power batteries Manukau" style="width:180px;max-width:90%;height:auto;display:block;margin:0 auto;">
        <div style="width:100%;padding-top:16px;border-top:1px solid rgba(255,255,255,0.08);text-align:center;">
          <div style="font-size:10px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:10px;">Also authorised Bosch dealer</div>
          <img src="<?php echo esc_url($site_url); ?>/wp-content/uploads/2026/05/Bosch_symbol_logo_black_red.png" alt="Bosch batteries" style="width:100px;height:auto;display:block;margin:0 auto;filter:brightness(0) invert(1);">
        </div>
      </div>
    </div>
  </div>
</div></section>

<!-- 4. BATTERY TYPES -->
<section class="mbh-sec mbh-sec--grey"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">Battery Range</span>
  <h2 class="mbh-sec__h2">Batteries for Every Vehicle Type</h2>
  <p class="mbh-sec__sub">Full range stocked at 139 Cavendish Drive. Call with your registration number and we will confirm the right battery and price before you come in.</p>
  <div class="mbh-types">
    <?php foreach ($battery_types as $bt) : ?>
    <a href="<?php echo esc_url($site_url . $bt['url']); ?>" class="mbh-type">
      <div class="mbh-type__icon"><?php echo mbh_badge($bt['badge']); ?></div>
      <div class="mbh-type__name"><?php echo $bt['name']; ?></div>
      <p class="mbh-type__desc"><?php echo esc_html($bt['desc']); ?></p>
      <div class="mbh-type__chips"><?php foreach ($bt['chips'] as $c) { echo '<span class="mbh-type__chip">'.esc_html($c).'</span>'; } ?></div>
      <span class="mbh-type__link"><?php echo $bt['cta']; ?></span>
    </a>
    <?php endforeach; ?>
    <a href="<?php echo esc_url($site_url . '/auto-electrical-battery/'); ?>" class="mbh-type">
      <div class="mbh-type__icon"><?php echo mbh_badge('AE'); ?></div>
      <div class="mbh-type__name">Alternator &amp; Starter</div>
      <p class="mbh-type__desc">Battery keeps going flat? It could be the alternator or starter motor. We test both before recommending anything. Free testing.</p>
      <div class="mbh-type__chips"><span class="mbh-type__chip">Free Test</span><span class="mbh-type__chip">Alternator</span><span class="mbh-type__chip">Starter</span></div>
      <span class="mbh-type__link">Battery &amp; Electrical →</span>
    </a>
  </div>
</div></section>

<!-- 5. PRICING -->
<section class="mbh-sec mbh-sec--white"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">Pricing Guide</span>
  <h2 class="mbh-sec__h2">Battery Pricing — Manukau</h2>
  <p class="mbh-sec__sub">All prices include supply, fitting, and old battery disposal. Call with your registration number for an exact price.</p>
  <div class="mbh-pricing">
    <div class="mbh-pricing__card mbh-pricing__card--highlight">
      <div class="mbh-pricing__badge"><?php echo mbh_badge('CAR', 48); ?></div>
      <div class="mbh-pricing__title">Car Battery Supply &amp; Fit</div>
      <div class="mbh-pricing__price"><?php echo esc_html($battery_price); ?></div>
      <p class="mbh-pricing__desc">Matched to your vehicle spec. Includes fitting and old battery disposal. BMS registration for European vehicles included.</p>
    </div>
    <div class="mbh-pricing__card">
      <div class="mbh-pricing__badge"><?php echo mbh_badge('TST', 48); ?></div>
      <div class="mbh-pricing__title">Battery &amp; Alternator Test</div>
      <div class="mbh-pricing__price">Free</div>
      <p class="mbh-pricing__desc">Load test, voltage check, cranking amp assessment. Alternator and starter motor tested at no charge. No appointment needed.</p>
    </div>
    <div class="mbh-pricing__card">
      <div class="mbh-pricing__badge"><?php echo mbh_badge('BMS', 48); ?></div>
      <div class="mbh-pricing__title">BMS Registration</div>
      <div class="mbh-pricing__price">Included</div>
      <p class="mbh-pricing__desc">European vehicles require battery management system registration. Included at no extra charge with every European battery fitment.</p>
    </div>
  </div>
  <p class="mbh-pricing__note">4WD, AGM, marine, and motorcycle battery pricing depends on specification. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> with your vehicle details for an estimate. All pricing includes GST.</p>
</div></section>

<!-- 6. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="mbh-sec mbh-sec--dark" id="enquire"><div class="mbh-sec__inner">
  <div class="mbh-enquiry">
    <div>
      <span class="mbh-sec__eyebrow">Get an Estimate</span>
      <h2 class="mbh-sec__h2">Talk to Manukau Batteries</h2>
      <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and year. We will confirm stock and pricing before you come in.</p>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="mbh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="mbh-enquiry__detail"><strong>Manukau Batteries — Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    </div>
    <div><?php echo do_shortcode($cf7_general); ?></div>
  </div>
</div></section>

<!-- 7. RELATED -->
<section class="mbh-sec mbh-sec--grey"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">Also at TAAS</span>
  <h2 class="mbh-sec__h2">Related Services</h2>
  <div class="mbh-related">
    <a href="<?php echo esc_url($site_url.'/auto-electrical/'); ?>" class="mbh-related-card"><div><?php echo mbh_badge('AE',36); ?></div><div class="mbh-related-card__name">Auto Electrical</div></a>
    <a href="<?php echo esc_url($site_url.'/wof/'); ?>" class="mbh-related-card"><div><?php echo mbh_badge('WOF',36); ?></div><div class="mbh-related-card__name">Warrant of Fitness</div></a>
    <a href="<?php echo esc_url($site_url.'/vehicle-servicing/'); ?>" class="mbh-related-card"><div><?php echo mbh_badge('SVC',36); ?></div><div class="mbh-related-card__name">Vehicle Servicing</div></a>
  </div>
</div></section>

<!-- 8. REVIEWS -->
<section class="mbh-sec mbh-sec--white"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
  <h2 class="mbh-sec__h2">What Customers Say</h2>
  <?php echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- 9. SUBURB PILLS — grouped by type -->
<section class="mbh-sec mbh-sec--grey"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">Battery by Suburb</span>
  <h2 class="mbh-sec__h2">Battery Replacement — South Auckland</h2>
  <p class="mbh-sec__sub">Serving all of South Auckland from 139 Cavendish Drive, Manukau.</p>
  <?php
  $suburbs = [
    ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Māngere','slug'=>'mangere'],
    ['label'=>'Ōtāhuhu','slug'=>'otahuhu'],['label'=>'Wiri','slug'=>'wiri'],
    ['label'=>'Manurewa','slug'=>'manurewa'],['label'=>'Flat Bush','slug'=>'flat-bush'],
    ['label'=>'Takanini','slug'=>'takanini'],['label'=>'Papakura','slug'=>'papakura'],
    ['label'=>'Ōtara','slug'=>'otara'],['label'=>'Botany','slug'=>'botany'],
    ['label'=>'Howick','slug'=>'howick'],['label'=>'Clover Park','slug'=>'clover-park'],
    ['label'=>'Weymouth','slug'=>'weymouth'],['label'=>'Clendon','slug'=>'clendon'],
    ['label'=>'Hunters Corner','slug'=>'hunters-corner'],
  ];
  $pill_types = [
    ['label'=>'Car Battery','prefix'=>'car'],
    ['label'=>'4WD Battery','prefix'=>'4wd'],
    ['label'=>'AGM Battery','prefix'=>'agm'],
    ['label'=>'Marine Battery','prefix'=>'marine'],
  ];
  foreach ($pill_types as $pt) : ?>
  <div class="mbh-pill-group">
    <div class="mbh-pill-group__title"><?php echo esc_html($pt['label']); ?></div>
    <ul class="mbh-pills">
      <?php foreach ($suburbs as $s) : ?>
      <li><a href="<?php echo esc_url($site_url.'/'.$pt['prefix'].'-battery-'.$s['slug'].'/'); ?>"><?php echo esc_html($s['label']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>
</div></section>

<!-- 10. FAQ -->
<section class="mbh-sec mbh-sec--white"><div class="mbh-sec__inner">
  <span class="mbh-sec__eyebrow">FAQ</span>
  <h2 class="mbh-sec__h2">Common Questions — Manukau Batteries</h2>
  <div class="mbh-faq">
    <?php foreach ($faqs as $i => $faq) : ?>
    <div class="mbh-faq__item<?php echo $i===0?' mbh-faq__item--open':''; ?>">
      <button class="mbh-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
      <div class="mbh-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<script>
document.querySelectorAll('.mbh-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.mbh-faq__item'),o=i.classList.contains('mbh-faq__item--open');document.querySelectorAll('.mbh-faq__item--open').forEach(function(x){x.classList.remove('mbh-faq__item--open');});if(!o)i.classList.add('mbh-faq__item--open');});});
</script>

<?php get_footer(); ?>
