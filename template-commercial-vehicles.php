<?php
/**
 * Template Name: Commercial Vehicles
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /commercial-vehicles/
 * CSS namespace: .cv-
 *
 * Hub page for commercial vehicle servicing — tradies, couriers, small business.
 * Consumer tone, not B2B fleet. Model pages to be built in a future session.
 * Model cards link to /commercial-vehicles/ until model pages are live.
 *
 * Built June 2026 — design system compliant from start
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
$email         = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$wof_price     = defined('TAAS_WOF_PRICE')     ? TAAS_WOF_PRICE     : '$80';
$service_price = defined('TAAS_SERVICE_PRICE') ? TAAS_SERVICE_PRICE : 'from $230';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$brake_price   = defined('TAAS_BRAKE_PRICE')   ? TAAS_BRAKE_PRICE   : 'from $380';
$cambelt_price = defined('TAAS_CAMBELT_PRICE') ? TAAS_CAMBELT_PRICE : 'from $800';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_COMMERCIAL') ? TAAS_HERO_COMMERCIAL : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

function cv_badge($initials, $size = 48) {
    $len = strlen($initials);
    $fs = $len > 4 ? intval($size * 0.18) : ($len > 3 ? intval($size * 0.22) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35)));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// Models — URLs point to /commercial-vehicles/ until model pages are built
$models = [
    ['badge'=>'RGR','name'=>'Ford Ranger','desc'=>'NZ\'s best-selling vehicle. Servicing, brakes, cambelt, suspension, diesel diagnostics. We see Rangers every day.','slug'=>'commercial-vehicles'],
    ['badge'=>'HLX','name'=>'Toyota Hilux','desc'=>'Bulletproof reputation — but still needs servicing. Timing chain, brakes, suspension, DPF. All Hilux models.','slug'=>'commercial-vehicles'],
    ['badge'=>'NAV','name'=>'Nissan Navara','desc'=>'Timing chain, turbo, DPF, suspension. Known issues on D40 and NP300 models — we know what to look for.','slug'=>'commercial-vehicles'],
    ['badge'=>'TRT','name'=>'Mitsubishi Triton','desc'=>'Servicing, brakes, suspension, DPF. Solid workhorse that responds well to regular maintenance.','slug'=>'commercial-vehicles'],
    ['badge'=>'DMX','name'=>'Isuzu D-MAX','desc'=>'Diesel servicing, brakes, suspension. D-MAX and MU-X — same platform, same service requirements.','slug'=>'commercial-vehicles'],
    ['badge'=>'HAC','name'=>'Toyota HiAce','desc'=>'NZ\'s most popular van. Servicing, brakes, timing chain, sliding door repairs, dual battery systems.','slug'=>'commercial-vehicles'],
    ['badge'=>'TRN','name'=>'Ford Transit','desc'=>'Transit, Transit Custom, Transit Connect. Servicing, brakes, turbo, DPF, dual mass flywheel.','slug'=>'commercial-vehicles'],
    ['badge'=>'SPR','name'=>'Mercedes Sprinter','desc'=>'European specialist servicing. Factory-spec diagnostics. DPF, turbo, brakes, AdBlue system.','slug'=>'commercial-vehicles'],
    ['badge'=>'VWT','name'=>'VW Transporter','desc'=>'T5, T6, Caddy. VAG diagnostics. DSG service, cambelt, brakes. European specialist rates.','slug'=>'commercial-vehicles'],
    ['badge'=>'iLD','name'=>'Hyundai iLoad','desc'=>'Servicing, brakes, timing chain, turbo. Reliable workhorse — regular servicing keeps it that way.','slug'=>'commercial-vehicles'],
];

$faqs = [
    $taas_faqs['comm_vehicle_types'],
    $taas_faqs['comm_service_cost'],
    $taas_faqs['comm_diesel'],
    $taas_faqs['comm_wof'],
    $taas_faqs['comm_wait'],
    $taas_faqs['comm_same_day'],
    $taas_faqs['comm_cambelt'],
    $taas_faqs['comm_finance'],
    $taas_faqs['comm_fleet_accounts'],
    $taas_faqs['comm_location'],
];

$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service',
     'url'=>$site_url,
     'description'=>'Commercial vehicle servicing and repairs in Manukau, South Auckland. Utes, vans, light trucks. Ford Ranger, Toyota Hilux, HiAce, Nissan Navara, Ford Transit, Mercedes Sprinter, VW Transporter. Diesel specialists. Family-owned since '.$established.'.',
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
        ['@type'=>'ListItem','position'=>2,'name'=>'Commercial Vehicles','item'=>$page_url]]],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.cv-hero__sub','.cv-faq__a:first-of-type p']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-commercial-vehicles .site-content,.page-template-template-commercial-vehicles .entry-content,.page-template-template-commercial-vehicles .entry-header,.page-template-template-commercial-vehicles article,.page-template-template-commercial-vehicles #primary,.page-template-template-commercial-vehicles #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-commercial-vehicles{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.cv-hero h1,.cv-sec__h2,.cv-edu h3,.cv-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.cv-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;}
.cv-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 300px;gap:48px;align-items:start;}
.cv-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.cv-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.cv-hero h1 span{color:var(--taas-yellow,#FFC800);}
.cv-hero__sub{font-size:16px;color:#aaa;max-width:540px;margin:0 0 28px;line-height:1.75;}
.cv-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.cv-sidebar{background:#1c1c1c;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.cv-sidebar__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.cv-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.cv-sidebar__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.cv-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.cv-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.cv-sidebar__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.cv-sidebar__phone:hover{opacity:.65;}
.cv-sidebar__detail{font-size:12px;color:#888;line-height:1.75;}
.cv-phonestrip{background:var(--taas-yellow,#FFC800);}.cv-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.cv-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.cv-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.cv-phonestrip__num:hover{opacity:.65;}
.cv-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.cv-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.cv-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.cv-trust__item::before{content:'✓';font-weight:900;}
.cv-sec{padding:var(--taas-sec-pad,72px) 0;}
.cv-sec--white{background:var(--taas-white,#FFFFFF);}
.cv-sec--grey{background:var(--taas-panel,#F7F7F5);}
.cv-sec--dark{background:var(--taas-dark,#1A1A1A);}
.cv-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.cv-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.cv-sec--dark .cv-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.cv-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.cv-sec--dark .cv-sec__h2{color:var(--taas-white,#FFFFFF);}
.cv-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.cv-sec--dark .cv-sec__sub{color:#aaa;}
.cv-edu{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.cv-edu__text p{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 20px;}
.cv-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111111);margin:0 0 12px;}
.cv-edu__callout{background:var(--taas-panel,#F7F7F5);border-left:4px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:24px 28px;}
.cv-edu__callout p{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 8px;}
.cv-edu__callout p:last-child{margin-bottom:0;}
.cv-edu__panel{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:32px 28px;}
.cv-edu__panel-title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:16px;}
.cv-edu__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.cv-edu__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:20px;position:relative;line-height:1.5;}
.cv-edu__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.cv-models{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
.cv-model{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:22px 18px;display:flex;flex-direction:column;gap:8px;text-decoration:none;transition:box-shadow 0.2s,transform 0.2s,border-color 0.2s;border-top:3px solid transparent;}
.cv-model:hover{box-shadow:0 4px 16px rgba(0,0,0,0.1);transform:translateY(-2px);border-top-color:var(--taas-yellow,#FFC800);}
.cv-model__icon{width:48px;height:48px;flex-shrink:0;}
.cv-model__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111111);}
.cv-model__desc{font-size:13px;color:var(--taas-mid,#666666);line-height:1.5;flex:1;}
.cv-model__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);margin-top:auto;}
.cv-services{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.cv-svc{display:flex;align-items:center;gap:12px;padding:16px 18px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s;}
.cv-svc:hover{border-color:var(--taas-yellow,#FFC800);}
.cv-svc__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-black,#111111);}
.cv-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.cv-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.cv-enquiry__phone:hover{opacity:.65;}
.cv-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.cv-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.cv-sec--dark .wpcf7 label,.cv-sec--dark .wpcf7 span:not(.wpcf7-spinner),.cv-sec--dark .wpcf7 div:not(.wpcf7-response-output),.cv-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.cv-sec--dark .wpcf7 input[type="text"],.cv-sec--dark .wpcf7 input[type="email"],.cv-sec--dark .wpcf7 input[type="tel"],.cv-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.cv-sec--dark .wpcf7 input::placeholder,.cv-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.cv-sec--dark .wpcf7 input:focus,.cv-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.cv-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.cv-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.cv-related{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.cv-related-card{display:flex;align-items:center;gap:12px;padding:16px 18px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s;}
.cv-related-card:hover{border-color:var(--taas-yellow,#FFC800);}
.cv-related-card__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-black,#111111);}
.cv-faq{max-width:780px;margin:28px auto 0;}
.cv-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.cv-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.cv-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.cv-faq__item--open .cv-faq__q::after{content:'−';}
.cv-faq__a{display:none;padding:0 0 18px;}
.cv-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.cv-faq__item--open .cv-faq__a{display:block;}
@media(max-width:960px){.cv-hero__inner{grid-template-columns:1fr;}.cv-models{grid-template-columns:repeat(2,1fr);}.cv-services{grid-template-columns:repeat(2,1fr);}.cv-edu{grid-template-columns:1fr;}.cv-enquiry{grid-template-columns:1fr;gap:32px;}.cv-related{grid-template-columns:1fr;}}
@media(max-width:640px){.cv-phonestrip__num{font-size:17px;}.cv-enquiry{display:flex;flex-direction:column-reverse;}.cv-hero{padding:48px 0 40px;}.cv-hero h1{font-size:clamp(28px,7vw,42px);}.cv-hero__sub{font-size:14px;}.cv-hero__ctas{flex-direction:column;align-items:stretch;}.cv-hero__ctas .taas-btn{text-align:center;}.cv-sec{padding:48px 0;}.cv-sec__h2{font-size:clamp(22px,5vw,30px);}.cv-models{grid-template-columns:1fr;}.cv-services{grid-template-columns:1fr;}.cv-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.cv-trust__item{font-size:12px;}.cv-faq__q{font-size:14px;padding:16px 32px 16px 0;}.cv-faq__a p{font-size:13px;}.cv-enquiry__phone{font-size:clamp(24px,6vw,32px);}}
</style>

<!-- 1. HERO -->
<section class="cv-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="cv-hero__inner">
  <div>
    <span class="cv-hero__eyebrow">Commercial Vehicles — Manukau</span>
    <h1>Commercial Vehicle<br><span>Servicing &amp; Repairs</span></h1>
    <p class="cv-hero__sub">Utes, vans, and light trucks — serviced by a workshop that understands commercial vehicle demands. Ranger, Hilux, HiAce, Transit, Navara and more. Your vehicle is your income — we get that. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
    <div class="cv-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Book a Service</a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
  <div class="cv-sidebar">
    <div class="cv-sidebar__title">What We Service</div>
    <ul class="cv-sidebar__list">
      <li>Utes — Ranger, Hilux, Navara, Triton, D-MAX</li>
      <li>Vans — HiAce, Transit, Sprinter, Transporter</li>
      <li>Light trucks — up to 6.5 tonne</li>
      <li>Diesel diagnostics &amp; DPF</li>
      <li>WOF on-site — NZTA Authorised</li>
      <li>Brakes, cambelt, suspension</li>
      <li>Same-day servicing where possible</li>
      <li>Finance — Afterpay, Q Card</li>
    </ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="cv-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="cv-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
  </div>
</div></section>

<!-- 2. TRUST STRIP -->
<div class="cv-phonestrip"><div class="cv-phonestrip__inner"><span class="cv-phonestrip__label">Work vehicle needs attention?</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="cv-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="cv-trust"><div class="cv-trust__inner">
  <div class="cv-trust__item">MTA Assured</div>
  <div class="cv-trust__item">NZTA Authorised</div>
  <div class="cv-trust__item">Diesel Specialists</div>
  <div class="cv-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="cv-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. UNDERSTANDING COMMERCIAL VEHICLES -->
<section class="cv-sec cv-sec--white"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow">Understanding the Difference</span>
  <h2 class="cv-sec__h2">Why Commercial Vehicles Need a Workshop That Gets It</h2>
  <div class="cv-edu">
    <div class="cv-edu__text">
      <p>A commercial vehicle works harder than a family car. It carries more weight, covers more kilometres, runs hotter, and wears brakes faster. A Ranger towing a trailer every day has completely different service requirements to the same Ranger doing school runs. The oil, the intervals, the brake wear, the suspension load — everything changes when the vehicle is working for a living.</p>
      <p>Modern diesel utes and vans add another layer. DPF (diesel particulate filter) regeneration, EGR valve issues, turbo wear, AdBlue systems on newer models — these are all diesel-specific systems that need a workshop with the right diagnostic equipment and the knowledge to interpret what it finds. A generic service misses these entirely.</p>
      <p>We also understand that your vehicle is your income. A car owner can catch a bus for a day. A tradie, courier, or delivery driver cannot. Same-day turnaround on routine servicing is the standard here, not the exception.</p>
      <div class="cv-edu__callout">
        <h3>Downtime Costs You Money</h3>
        <p>We aim for same-day turnaround on scheduled servicing and general repairs. For complex work, we advise on timeframes before starting so you can plan around it. No surprises, no vehicles sitting on the hoist waiting for parts we should have ordered in advance.</p>
      </div>
    </div>
    <div class="cv-edu__panel">
      <div class="cv-edu__panel-title">Commercial Vehicle Capability</div>
      <ul class="cv-edu__list">
        <li>Utes, vans, light trucks to 6.5 tonne</li>
        <li>Diesel diagnostics — DPF, EGR, turbo, injectors</li>
        <li>Logbook servicing — all manufacturers</li>
        <li>WOF on-site — NZTA Authorised</li>
        <li>Brakes, cambelt, suspension, cooling system</li>
        <li>Auto electrical and wiring</li>
        <li>European commercials — Sprinter, Transporter, Transit</li>
        <li>Same-day turnaround on routine servicing</li>
        <li>Finance — Afterpay, Q Card, GEM, Aotea</li>
        <li>Fleet accounts available for 3+ vehicles</li>
      </ul>
    </div>
  </div>
</div></section>

<!-- 4. MODELS GRID -->
<section class="cv-sec cv-sec--grey"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow">Vehicles We Service</span>
  <h2 class="cv-sec__h2">Commercial Vehicles We Specialise In</h2>
  <p class="cv-sec__sub">We service these models every week. We know the common faults, the correct service intervals, and the parts that work.</p>
  <div class="cv-models">
    <?php foreach ($models as $m) : ?>
    <a href="<?php echo esc_url($site_url.'/'.$m['slug'].'/'); ?>" class="cv-model">
      <div class="cv-model__icon"><?php echo cv_badge($m['badge']); ?></div>
      <div class="cv-model__name"><?php echo esc_html($m['name']); ?></div>
      <p class="cv-model__desc"><?php echo esc_html($m['desc']); ?></p>
      <span class="cv-model__link"><?php echo esc_html($m['name']); ?> →</span>
    </a>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- 5. SERVICES -->
<section class="cv-sec cv-sec--white"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow">Services</span>
  <h2 class="cv-sec__h2">Services for Commercial Vehicles</h2>
  <p class="cv-sec__sub">All work in-house at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a>. Seven specialist divisions under one roof.</p>
  <div class="cv-services">
    <?php
    $svcs = [
      ['badge'=>'SVC','name'=>'Logbook Servicing','url'=>'/vehicle-servicing/'],
      ['badge'=>'WOF','name'=>'WOF — '.$wof_price,'url'=>'/wof/'],
      ['badge'=>'DS','name'=>'Diesel Diagnostics','url'=>'/diagnostic-scanning/'],
      ['badge'=>'MBC','name'=>'Brakes &amp; Clutch','url'=>'/manukau-brake-clutch/'],
      ['badge'=>'CB','name'=>'Cambelt &amp; Water Pump','url'=>'/cambelts-and-water-pumps/'],
      ['badge'=>'SS','name'=>'Steering &amp; Suspension','url'=>'/steering-and-suspension/'],
      ['badge'=>'CS','name'=>'Cooling System','url'=>'/cooling-system/'],
      ['badge'=>'AE','name'=>'Auto Electrical','url'=>'/auto-electrical/'],
      ['badge'=>'AC','name'=>'Air Conditioning','url'=>'/air-conditioning/'],
      ['badge'=>'TYR','name'=>'Tyres &amp; Alignment','url'=>'/tyre-centre/'],
      ['badge'=>'BAT','name'=>'Battery Supply &amp; Fit','url'=>'/manukau-batteries/'],
      ['badge'=>'EUR','name'=>'European Commercials','url'=>'/european/'],
    ];
    foreach ($svcs as $svc) :
    ?>
    <a href="<?php echo esc_url($site_url.$svc['url']); ?>" class="cv-svc">
      <div><?php echo cv_badge($svc['badge'], 36); ?></div>
      <div class="cv-svc__name"><?php echo $svc['name']; ?></div>
    </a>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- 6. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="cv-sec cv-sec--dark" id="enquire"><div class="cv-sec__inner">
  <div class="cv-enquiry">
    <div>
      <span class="cv-sec__eyebrow">Book or Enquire</span>
      <h2 class="cv-sec__h2">Book Your Commercial Vehicle In</h2>
      <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model, and what it needs. We will come back to you with an estimate and a timeframe.</p>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="cv-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="cv-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    </div>
    <div><?php echo do_shortcode($cf7_general); ?></div>
  </div>
</div></section>

<!-- 7. RELATED -->
<section class="cv-sec cv-sec--grey"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow">Also at TAAS</span>
  <h2 class="cv-sec__h2">Related Services</h2>
  <div class="cv-related">
    <a href="<?php echo esc_url($site_url.'/fleet-servicing/'); ?>" class="cv-related-card"><div><?php echo cv_badge('FLT',36); ?></div><div class="cv-related-card__name">Fleet Servicing (3+ vehicles)</div></a>
    <a href="<?php echo esc_url($site_url.'/european/'); ?>" class="cv-related-card"><div><?php echo cv_badge('EUR',36); ?></div><div class="cv-related-card__name">European Vehicles</div></a>
    <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" class="cv-related-card"><div><?php echo cv_badge('FIN',36); ?></div><div class="cv-related-card__name">Finance Options</div></a>
  </div>
</div></section>

<!-- 8. REVIEWS -->
<section class="cv-sec cv-sec--white"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
  <h2 class="cv-sec__h2">What Customers Say</h2>
  <?php echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- 9. FAQ -->
<section class="cv-sec cv-sec--grey"><div class="cv-sec__inner">
  <span class="cv-sec__eyebrow">FAQ</span>
  <h2 class="cv-sec__h2">Commercial Vehicle Servicing — Common Questions</h2>
  <div class="cv-faq">
    <?php foreach ($faqs as $i => $faq) : ?>
    <div class="cv-faq__item<?php echo $i===0?' cv-faq__item--open':''; ?>">
      <button class="cv-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
      <div class="cv-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<script>
document.querySelectorAll('.cv-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.cv-faq__item'),o=i.classList.contains('cv-faq__item--open');document.querySelectorAll('.cv-faq__item--open').forEach(function(x){x.classList.remove('cv-faq__item--open');});if(!o)i.classList.add('cv-faq__item--open');});});
</script>

<?php get_footer(); ?>
