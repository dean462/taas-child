<?php
/**
 * Template Name: TAAS Fleet
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /fleet-servicing/
 * CSS namespace: .fl-
 * B2B sales page — fleet managers, direct answers, Dean as contact
 *
 * Rebuilt June 2026 — full design system compliance
 * Single page — no sub-service or location templates needed
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
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_FLEET') ? TAAS_HERO_FLEET : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

function fl_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

$faqs = [
    $taas_faqs['fleet_setup'],
    $taas_faqs['fleet_billing'],
    $taas_faqs['fleet_vehicle_types'],
    $taas_faqs['fleet_turnaround'],
    $taas_faqs['fleet_afterhours'],
    $taas_faqs['fleet_wof'],
    $taas_faqs['fleet_european'],
    $taas_faqs['fleet_ev'],
    $taas_faqs['fleet_location'],
    $taas_faqs['fleet_contact'],
];

$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','alternateName'=>'TAAS Fleet',
     'url'=>$site_url,
     'description'=>'Fleet vehicle servicing and repairs in Manukau, South Auckland. Approved supplier to SG Fleet NZ, ORIX, Custom Fleet, Fleet Partners. Direct invoicing. All makes to 6.5 tonne. Seven specialist divisions under one roof. Family-owned since '.$established.'.',
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
        ['@type'=>'ListItem','position'=>2,'name'=>'Fleet Servicing','item'=>$page_url]]],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.fl-hero__sub','.fl-faq__a:first-of-type p']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-fleet .site-content,.page-template-template-fleet .entry-content,.page-template-template-fleet .entry-header,.page-template-template-fleet article,.page-template-template-fleet #primary,.page-template-template-fleet #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-fleet{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.fl-hero h1,.fl-sec__h2,.fl-step__title,.fl-qa__a,.fl-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.fl-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;}
.fl-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.fl-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.fl-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.fl-hero h1 span{color:var(--taas-yellow,#FFC800);}
.fl-hero__sub{font-size:16px;color:#aaa;max-width:540px;margin:0 0 16px;line-height:1.75;}
.fl-hero__tags{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px;}
.fl-hero__tag{display:inline-block;background:rgba(255,200,0,0.1);border:1px solid rgba(255,200,0,0.2);border-radius:4px;padding:5px 12px;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow,#FFC800);letter-spacing:0.04em;}
.fl-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.fl-sidebar{background:#1c1c1c;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.fl-sidebar__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.fl-sidebar__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:18px;font-weight:800;color:var(--taas-white,#FFFFFF);margin-bottom:2px;}
.fl-sidebar__role{font-size:12px;color:#888;margin-bottom:16px;}
.fl-sidebar__row{padding:8px 0;border-bottom:1px solid #2a2a2a;display:flex;flex-direction:column;gap:2px;}
.fl-sidebar__row:last-child{border-bottom:none;}
.fl-sidebar__label{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#555;}
.fl-sidebar__val{font-size:13px;font-weight:600;color:#ccc;}
.fl-sidebar__val a{color:var(--taas-yellow,#FFC800);text-decoration:none;font-weight:700;}
.fl-sidebar__val a:hover{opacity:.65;}
.fl-phonestrip{background:var(--taas-yellow,#FFC800);}.fl-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.fl-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.fl-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.fl-phonestrip__num:hover{opacity:.65;}
.fl-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.fl-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.fl-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.fl-trust__item::before{content:'✓';font-weight:900;}
.fl-sec{padding:var(--taas-sec-pad,72px) 0;}
.fl-sec--white{background:var(--taas-white,#FFFFFF);}
.fl-sec--grey{background:var(--taas-panel,#F7F7F5);}
.fl-sec--dark{background:var(--taas-dark,#1A1A1A);}
.fl-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.fl-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.fl-sec--dark .fl-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.fl-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.fl-sec--dark .fl-sec__h2{color:var(--taas-white,#FFFFFF);}
.fl-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.fl-sec--dark .fl-sec__sub{color:#aaa;}
.fl-suppliers{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:24px;}
.fl-supplier{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:18px 20px;}
.fl-supplier__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:4px;}
.fl-supplier__note{font-size:12px;color:var(--taas-mid,#666666);line-height:1.4;}
.fl-billing{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:32px 28px;}
.fl-billing__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:18px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:16px;}
.fl-billing__list{list-style:none;padding:0;margin:0 0 24px;display:flex;flex-direction:column;gap:12px;}
.fl-billing__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:28px;position:relative;line-height:1.5;}
.fl-billing__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;background:rgba(255,200,0,0.15);width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;}
.fl-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:32px;counter-reset:flstep;}
.fl-step{background:var(--taas-panel,#F7F7F5);border-radius:var(--taas-radius,6px);padding:28px 24px;border-top:4px solid var(--taas-yellow,#FFC800);counter-increment:flstep;}
.fl-step::before{content:counter(flstep,decimal-leading-zero);display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:36px;font-weight:800;color:var(--taas-yellow,#FFC800);margin-bottom:8px;line-height:1;}
.fl-step__title{font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:6px;}
.fl-step__body{font-size:13px;color:var(--taas-mid,#666666);line-height:1.75;}
.fl-qa{display:grid;grid-template-columns:1fr 1fr;gap:2px;margin-top:32px;background:var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);overflow:hidden;}
.fl-qa__item{background:var(--taas-white,#FFFFFF);padding:24px 28px;}
.fl-qa__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#999;margin-bottom:8px;}
.fl-qa__a{font-size:16px;font-weight:700;color:var(--taas-black,#111111);line-height:1.4;}
.fl-why{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.fl-why__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;}
.fl-why__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:#ccc;padding-left:28px;position:relative;line-height:1.5;}
.fl-why__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;background:rgba(255,200,0,0.15);width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;}
.fl-why__card{background:#111;border:1px solid #2a2a2a;border-radius:var(--taas-radius,6px);padding:32px 28px;}
.fl-why__card-title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:18px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:12px;}
.fl-prospect{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:#aaa;display:flex;align-items:center;gap:8px;padding:4px 0;}
.fl-prospect::before{content:'·';color:var(--taas-yellow,#FFC800);font-size:18px;flex-shrink:0;}
.fl-svc-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;margin-top:32px;}
.fl-svc-col h3{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:16px;padding-bottom:8px;border-bottom:2px solid var(--taas-yellow,#FFC800);}
.fl-svc-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.fl-svc-list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333333);padding-left:20px;position:relative;line-height:1.5;}
.fl-svc-list li::before{content:'→';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.fl-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.fl-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.fl-enquiry__phone:hover{opacity:.65;}
.fl-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.fl-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.fl-enquiry__checks{list-style:none;padding:0;margin:16px 0 0;display:flex;flex-direction:column;gap:10px;}
.fl-enquiry__checks li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:24px;position:relative;line-height:1.4;}
.fl-enquiry__checks li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.fl-sec--dark .wpcf7 label,.fl-sec--dark .wpcf7 span:not(.wpcf7-spinner),.fl-sec--dark .wpcf7 div:not(.wpcf7-response-output),.fl-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.fl-sec--dark .wpcf7 input[type="text"],.fl-sec--dark .wpcf7 input[type="email"],.fl-sec--dark .wpcf7 input[type="tel"],.fl-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.fl-sec--dark .wpcf7 input::placeholder,.fl-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.fl-sec--dark .wpcf7 input:focus,.fl-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.fl-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.fl-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.fl-faq{max-width:780px;margin:28px auto 0;}
.fl-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.fl-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.fl-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.fl-faq__item--open .fl-faq__q::after{content:'−';}
.fl-faq__a{display:none;padding:0 0 18px;}
.fl-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.fl-faq__item--open .fl-faq__a{display:block;}
@media(max-width:960px){.fl-hero__inner{grid-template-columns:1fr;}.fl-suppliers{grid-template-columns:1fr;}.fl-svc-grid{grid-template-columns:1fr;}.fl-why{grid-template-columns:1fr;}.fl-enquiry{grid-template-columns:1fr;gap:32px;}.fl-steps{grid-template-columns:1fr 1fr;}.fl-qa{grid-template-columns:1fr;}}
@media(max-width:640px){.fl-phonestrip__num{font-size:17px;}.fl-enquiry{display:flex;flex-direction:column-reverse;}.fl-hero{padding:48px 0 40px;}.fl-hero h1{font-size:clamp(28px,7vw,42px);}.fl-hero__sub{font-size:14px;}.fl-hero__ctas{flex-direction:column;align-items:stretch;}.fl-hero__ctas .taas-btn{text-align:center;}.fl-sec{padding:48px 0;}.fl-sec__h2{font-size:clamp(22px,5vw,30px);}.fl-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.fl-trust__item{font-size:12px;}.fl-steps{grid-template-columns:1fr;}.fl-faq__q{font-size:14px;padding:16px 32px 16px 0;}.fl-faq__a p{font-size:13px;}.fl-enquiry__phone{font-size:clamp(24px,6vw,32px);}}
</style>

<!-- 1. HERO -->
<section class="fl-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="fl-hero__inner">
  <div>
    <span class="fl-hero__eyebrow">Fleet Servicing — South Auckland</span>
    <h1>Fleet Vehicle<br><span>Servicing &amp; Repairs</span></h1>
    <p class="fl-hero__sub">Approved supplier to New Zealand's leading fleet management companies. Direct billing available. South Auckland's most capable independent workshop. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
    <div class="fl-hero__tags">
      <?php foreach (['SG Fleet NZ','ORIX NZ','Custom Fleet','Fleet Partners'] as $co) : ?>
      <span class="fl-hero__tag">✓ <?php echo esc_html($co); ?></span>
      <?php endforeach; ?>
    </div>
    <div class="fl-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--primary">Call <?php echo esc_html($phone_free); ?> — Ask for Dean</a>
      <a href="mailto:dean@taas.co.nz?subject=Fleet Account Enquiry" class="taas-btn taas-btn--outline">Email Dean</a>
    </div>
  </div>
  <div class="fl-sidebar">
    <div class="fl-sidebar__title">Fleet Contact</div>
    <div class="fl-sidebar__name">Dean Allen</div>
    <div class="fl-sidebar__role">Owner / General Manager</div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">Free Phone</div><div class="fl-sidebar__val"><a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_free); ?></a><div style="font-size:11px;color:#555;margin-top:2px;">Ask for Dean</div></div></div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">Local</div><div class="fl-sidebar__val"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a></div></div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">Email</div><div class="fl-sidebar__val"><a href="mailto:dean@taas.co.nz?subject=Fleet Account Enquiry">dean@taas.co.nz</a></div></div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">Hours</div><div class="fl-sidebar__val"><?php echo esc_html($hours); ?></div></div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">After Hours</div><div class="fl-sidebar__val">Key drop box available</div></div>
    <div class="fl-sidebar__row"><div class="fl-sidebar__label">Address</div><div class="fl-sidebar__val">139 Cavendish Drive<br>Manukau, Auckland 2104</div></div>
  </div>
</div></section>

<!-- 2. TRUST STRIP -->
<div class="fl-phonestrip"><div class="fl-phonestrip__inner"><span class="fl-phonestrip__label">Fleet enquiries — ask for Dean</span><a href="tel:<?php echo esc_attr($phone_tel); ?>" class="fl-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>
<div class="fl-trust"><div class="fl-trust__inner">
  <div class="fl-trust__item">MTA Assured</div>
  <div class="fl-trust__item">NZTA Authorised</div>
  <div class="fl-trust__item">SG Fleet Approved</div>
  <div class="fl-trust__item">Direct Invoicing</div>
  <div class="fl-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. APPROVED SUPPLIERS -->
<section class="fl-sec fl-sec--white"><div class="fl-sec__inner">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;">
    <div>
      <span class="fl-sec__eyebrow">Approved Supplier</span>
      <h2 class="fl-sec__h2">We Work With NZ's Leading Fleet Companies</h2>
      <p style="font-size:16px;color:var(--taas-mid,#666666);line-height:1.75;margin-bottom:28px;">Tony Allen Auto Service invoices companies direct — no driver reimbursements, no upfront payment. We work directly with businesses, as well as with the major fleet management companies listed below.</p>
      <div class="fl-suppliers">
        <?php foreach ([
          ['name'=>'SG Fleet NZ','note'=>'Approved supplier — invoiced direct'],
          ['name'=>'ORIX NZ','note'=>'Approved supplier — invoiced direct'],
          ['name'=>'Custom Fleet','note'=>'Approved supplier — invoiced direct'],
          ['name'=>'Fleet Partners','note'=>'Approved supplier — invoiced direct'],
        ] as $s) : ?>
        <div class="fl-supplier"><div class="fl-supplier__name"><?php echo esc_html($s['name']); ?></div><div class="fl-supplier__note"><?php echo esc_html($s['note']); ?></div></div>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:16px;font-size:14px;color:var(--taas-mid,#666666);">Fleet management company not listed? We work with others too. We also invoice businesses direct — no intermediary required. Call Dean to discuss.</p>
    </div>
    <div class="fl-billing">
      <div class="fl-billing__title">Direct Billing — How It Works</div>
      <ul class="fl-billing__list">
        <li>Drivers do not pay upfront — invoiced direct to your company or fleet management company</li>
        <li>Invoices reference your job number or purchase order</li>
        <li>Scope changes communicated before any additional work</li>
        <li>No surprise invoices — you always know what is being done</li>
        <li>Service history reporting available per vehicle on request</li>
      </ul>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--primary" style="width:100%;justify-content:center;">Call Dean to Set Up an Account</a>
    </div>
  </div>
</div></section>

<!-- 4. QUICK ANSWERS -->
<section class="fl-sec fl-sec--grey"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow">Direct Answers</span>
  <h2 class="fl-sec__h2">What Fleet Managers Ask First</h2>
  <div class="fl-qa">
    <?php foreach ([
      ['q'=>'Direct billing?','a'=>'Yes — to your company or fleet management company.'],
      ['q'=>'Vehicle types?','a'=>'Cars, vans, SUVs, utes, light trucks to 6.5 tonne.'],
      ['q'=>'Turnaround?','a'=>'Servicing and general repairs — same day.'],
      ['q'=>'After-hours drop-off?','a'=>'Yes. Key drop box available outside hours.'],
      ['q'=>'Pickup and delivery?','a'=>'Available — call Dean to discuss.'],
      ['q'=>'WOF on-site?','a'=>'Yes. NZTA Authorised.'],
      ['q'=>'European fleet vehicles?','a'=>'Yes. Factory-spec diagnostics — all European makes.'],
      ['q'=>'How do we start?','a'=>'Call Dean on '.$phone_free.'. One conversation.'],
    ] as $qa) : ?>
    <div class="fl-qa__item"><div class="fl-qa__q"><?php echo esc_html($qa['q']); ?></div><div class="fl-qa__a"><?php echo wp_kses_post($qa['a']); ?></div></div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- 5. HOW IT WORKS -->
<section class="fl-sec fl-sec--white"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow">Getting Started</span>
  <h2 class="fl-sec__h2">How Fleet Accounts Work</h2>
  <p class="fl-sec__sub">One call to Dean. Straightforward from there.</p>
  <div class="fl-steps">
    <?php foreach ([
      ['title'=>'Call Dean','body'=>'Call '.$phone_free.' and speak to Dean directly. Fleet size, vehicle types, billing arrangements. No forms, no delays.'],
      ['title'=>'Account Set Up','body'=>'Billing arrangements confirmed — invoicing your company direct or through your fleet management company. Dean works through the details.'],
      ['title'=>'Book Vehicles','body'=>'Book by phone or have drivers call us directly. Key drop box for after-hours drop-off. Servicing and general repairs completed same day where possible.'],
      ['title'=>'Direct Invoice','body'=>'Invoice sent directly to your fleet account. We call you if anything changes in scope before proceeding. No surprises.'],
    ] as $step) : ?>
    <div class="fl-step"><div class="fl-step__title"><?php echo esc_html($step['title']); ?></div><div class="fl-step__body"><?php echo esc_html($step['body']); ?></div></div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- 6. CAPABILITY -->
<section class="fl-sec fl-sec--grey"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow">Capability</span>
  <h2 class="fl-sec__h2">What We Service — Seven Specialist Divisions</h2>
  <p class="fl-sec__sub">All services carried out in-house at 139 Cavendish Drive, Manukau. One workshop — one invoice — one point of contact.</p>
  <div class="fl-svc-grid">
    <div><h3>Vehicle Types</h3><ul class="fl-svc-list">
      <?php foreach (['Passenger vehicles — cars, hatchbacks, sedans','SUVs and 4WDs','Vans and people movers','Utes — single and double cab','Light trucks — up to 6.5 tonne','European fleet vehicles','Hybrid and EV fleet vehicles'] as $v) : ?>
      <li><?php echo esc_html($v); ?></li>
      <?php endforeach; ?></ul></div>
    <div><h3>Services</h3><ul class="fl-svc-list">
      <?php foreach (['Warrant of Fitness — NZTA Authorised on-site','Scheduled servicing — all manufacturers','WOF failure repairs and recheck','Tyres, wheel alignment, and balancing','Brakes and clutch','Steering and suspension','Auto electrical and diagnostics','Cambelt and water pump','Cooling system repairs','Engine repairs','Air conditioning — regas, repair, diagnosis','Battery supply and fit'] as $s) : ?>
      <li><?php echo esc_html($s); ?></li>
      <?php endforeach; ?></ul></div>
  </div>
</div></section>

<!-- 7. WHY SOUTH AUCKLAND -->
<section class="fl-sec fl-sec--dark"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow">Why TAAS</span>
  <h2 class="fl-sec__h2">South Auckland's Fleet Workshop — <?php echo esc_html($established); ?> to Today</h2>
  <p class="fl-sec__sub">Independent, established, and in the right location. 139 Cavendish Drive puts us at the centre of South Auckland's industrial and logistics hub.</p>
  <div class="fl-why">
    <div><ul class="fl-why__list">
      <?php foreach ([
        'Wiri, Māngere, Ōtāhuhu, Manukau — South Auckland\'s fleet heartland, minutes from our workshop',
        'Seven specialist divisions in one building — one supplier for everything',
        'Family-owned since '.$established.' — same ownership, same address',
        'MTA Assured and NZTA Authorised — independently verified standards',
        'Dean Allen handles fleet accounts directly — no account managers, no layers',
        'Active SG Fleet NZ supplier — already in their system',
      ] as $pt) : ?>
      <li><?php echo esc_html($pt); ?></li>
      <?php endforeach; ?></ul></div>
    <div class="fl-why__card">
      <div class="fl-why__card-title">Key Prospects in Our Area</div>
      <p style="font-size:14px;color:#888;line-height:1.75;margin-bottom:20px;">These businesses operate significant fleets in our direct service area.</p>
      <?php foreach ([
        'Wiri — Foodstuffs NI distribution','Wiri — Lineage Logistics',
        'Māngere — Bluebird / PepsiCo','Māngere — Frucor Suntory',
        'Manukau — Counties Manukau Health','South Auckland — SG Fleet active accounts',
      ] as $p) : ?>
      <div class="fl-prospect"><?php echo esc_html($p); ?></div>
      <?php endforeach; ?>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--primary" style="width:100%;justify-content:center;margin-top:24px;">Call <?php echo esc_html($phone_free); ?> — Ask for Dean</a>
    </div>
  </div>
</div></section>

<!-- 8. ENQUIRY -->
<section class="fl-sec fl-sec--dark" style="background:var(--taas-panel,#F7F7F5);" id="enquire"><div class="fl-sec__inner">
  <div class="fl-enquiry">
    <div>
      <span class="fl-sec__eyebrow" style="background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);">Start a Fleet Account</span>
      <h2 class="fl-sec__h2" style="color:var(--taas-black,#111111);">Enquire About Fleet Servicing</h2>
      <p style="font-size:16px;color:var(--taas-mid,#666666);line-height:1.75;margin-bottom:8px;">The fastest way to get started is to call Dean directly on <strong><?php echo esc_html($phone_free); ?></strong>. For out-of-hours enquiries, use the form and Dean will respond the next business morning.</p>
      <p style="font-size:14px;color:#999;margin-bottom:16px;">Include your company name, fleet size, and fleet management company in the message.</p>
      <ul class="fl-enquiry__checks" style="color:var(--taas-body,#333333);">
        <li style="color:var(--taas-body,#333333);">Direct billing to SG Fleet, ORIX, Custom Fleet, Fleet Partners</li>
        <li style="color:var(--taas-body,#333333);">Servicing and general repairs completed same day</li>
        <li style="color:var(--taas-body,#333333);">Key drop box for after-hours vehicle drop-off</li>
        <li style="color:var(--taas-body,#333333);">All makes — light vehicles to 6.5 tonne</li>
        <li style="color:var(--taas-body,#333333);">WOF on-site — NZTA Authorised</li>
      </ul>
    </div>
    <div style="background:var(--taas-white,#FFFFFF);border-radius:var(--taas-radius,6px);padding:32px;border:1px solid var(--taas-border,#E8E8E4);">
      <?php echo do_shortcode($cf7_general); ?>
    </div>
  </div>
</div></section>

<!-- 9. REVIEWS -->
<section class="fl-sec fl-sec--white"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
  <h2 class="fl-sec__h2">What Customers Say</h2>
  <?php echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- 10. FAQ -->
<section class="fl-sec fl-sec--grey"><div class="fl-sec__inner">
  <span class="fl-sec__eyebrow">FAQ</span>
  <h2 class="fl-sec__h2">Fleet Servicing — Common Questions</h2>
  <div class="fl-faq">
    <?php foreach ($faqs as $i => $faq) : ?>
    <div class="fl-faq__item<?php echo $i===0?' fl-faq__item--open':''; ?>">
      <button class="fl-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
      <div class="fl-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<script>
document.querySelectorAll('.fl-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.fl-faq__item'),o=i.classList.contains('fl-faq__item--open');document.querySelectorAll('.fl-faq__item--open').forEach(function(x){x.classList.remove('fl-faq__item--open');});if(!o)i.classList.add('fl-faq__item--open');});});
</script>

<?php get_footer(); ?>
