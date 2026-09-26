<?php
/**
 * Template Name: Towing
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /towing/
 * CSS namespace: .tw-
 *
 * Standalone page — towing is a sublet service (no TAAS truck).
 * Towing TO the workshop only — not a general towing company.
 * Distress purchase tone — calm, practical, reassuring.
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
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

function tw_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

$faqs = [
    $taas_faqs['tow_own_truck'],
    $taas_faqs['tow_cost'],
    $taas_faqs['tow_where'],
    $taas_faqs['tow_breakdown'],
    $taas_faqs['tow_arrival'],
    $taas_faqs['tow_afterhours'],
    $taas_faqs['tow_4wd'],
    $taas_faqs['tow_unattended'],
    $taas_faqs['tow_finance'],
    $taas_faqs['tow_location'],
];

$schema_faqs = [];
foreach ($faqs as $i => $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service',
     'url'=>$site_url,'telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10',
     'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
     'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
     'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
     'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
     'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Q Card','Gem Finance'],
     'areaServed'=>['@type'=>'Place','name'=>'South Auckland']],
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Towing','item'=>$page_url]]],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.tw-hero__sub','.tw-faq__a:first-of-type p']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-towing .site-content,.page-template-template-towing .entry-content,.page-template-template-towing .entry-header,.page-template-template-towing article,.page-template-template-towing #primary,.page-template-template-towing #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-towing{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.tw-hero h1,.tw-sec__h2,.tw-step__title,.tw-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.tw-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;text-align:center;}
.tw-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tw-hero__eyebrow{display:inline-block;background:var(--taas-alert,#C0392B);color:#fff;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.tw-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.tw-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tw-hero__sub{font-size:16px;color:#aaa;max-width:580px;margin:0 auto 12px;line-height:1.75;}
.tw-hero__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(32px,5vw,48px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:24px auto 8px;letter-spacing:-0.01em;}
.tw-hero__phone:hover{opacity:.65;}
.tw-hero__detail{font-size:14px;color:#888;margin-bottom:24px;}
.tw-hero__ctas{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
.tw-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.tw-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.tw-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.tw-trust__item::before{content:'✓';font-weight:900;}
.tw-sec{padding:var(--taas-sec-pad,72px) 0;}
.tw-sec--white{background:var(--taas-white,#FFFFFF);}
.tw-sec--grey{background:var(--taas-panel,#F7F7F5);}
.tw-sec--dark{background:var(--taas-dark,#1A1A1A);}
.tw-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tw-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.tw-sec--dark .tw-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.tw-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.tw-sec--dark .tw-sec__h2{color:var(--taas-white,#FFFFFF);}
.tw-sec__sub{font-size:16px;color:var(--taas-mid,#666666);max-width:640px;margin:0 0 36px;line-height:1.75;}
.tw-sec--dark .tw-sec__sub{color:#aaa;}
.tw-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:32px;counter-reset:twstep;}
.tw-step{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;border-top:4px solid var(--taas-yellow,#FFC800);counter-increment:twstep;}
.tw-step::before{content:counter(twstep);display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:36px;font-weight:800;color:var(--taas-yellow,#FFC800);margin-bottom:8px;line-height:1;}
.tw-step__title{font-size:16px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:6px;}
.tw-step__body{font-size:13px;color:var(--taas-mid,#666666);line-height:1.75;}
.tw-breakdown{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;margin-top:32px;}
.tw-breakdown__text p{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;margin:0 0 20px;}
.tw-breakdown__callout{background:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);padding:32px 28px;}
.tw-breakdown__callout-title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:16px;}
.tw-breakdown__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}
.tw-breakdown__list li{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:#ccc;padding-left:20px;position:relative;line-height:1.5;}
.tw-breakdown__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.tw-notice{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:32px;}
.tw-notice__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:8px;}
.tw-notice__body{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;}
.tw-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tw-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.tw-enquiry__phone:hover{opacity:.65;}
.tw-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.tw-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.tw-sec--dark .wpcf7 label,.tw-sec--dark .wpcf7 span:not(.wpcf7-spinner),.tw-sec--dark .wpcf7 div:not(.wpcf7-response-output),.tw-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.tw-sec--dark .wpcf7 input[type="text"],.tw-sec--dark .wpcf7 input[type="email"],.tw-sec--dark .wpcf7 input[type="tel"],.tw-sec--dark .wpcf7 textarea{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.tw-sec--dark .wpcf7 input::placeholder,.tw-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.tw-sec--dark .wpcf7 input:focus,.tw-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.tw-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.tw-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.tw-related{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.tw-related-card{display:flex;align-items:center;gap:12px;padding:16px 18px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s;}
.tw-related-card:hover{border-color:var(--taas-yellow,#FFC800);}
.tw-related-card__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-black,#111111);}
.tw-faq{max-width:780px;margin:28px auto 0;}
.tw-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tw-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.tw-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.tw-faq__item--open .tw-faq__q::after{content:'−';}
.tw-faq__a{display:none;padding:0 0 18px;}
.tw-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.tw-faq__item--open .tw-faq__a{display:block;}
@media(max-width:960px){.tw-steps{grid-template-columns:1fr 1fr;}.tw-breakdown{grid-template-columns:1fr;}.tw-enquiry{grid-template-columns:1fr;gap:32px;}.tw-related{grid-template-columns:1fr;}}
@media(max-width:640px){.tw-enquiry{display:flex;flex-direction:column-reverse;}.tw-hero{padding:48px 0 40px;}.tw-hero h1{font-size:clamp(28px,7vw,42px);}.tw-hero__sub{font-size:14px;}.tw-hero__ctas{flex-direction:column;align-items:stretch;}.tw-hero__ctas .taas-btn{text-align:center;}.tw-sec{padding:48px 0;}.tw-sec__h2{font-size:clamp(22px,5vw,30px);}.tw-steps{grid-template-columns:1fr;}.tw-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.tw-trust__item{font-size:12px;}.tw-faq__q{font-size:14px;padding:16px 32px 16px 0;}.tw-faq__a p{font-size:13px;}.tw-enquiry__phone{font-size:clamp(24px,6vw,32px);}.tw-hero__phone{font-size:clamp(28px,7vw,40px);}}
</style>

<!-- 1. HERO — urgency tone, phone number prominent -->
<section class="tw-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="tw-hero__inner">
  <span class="tw-hero__eyebrow">Breakdown &amp; Towing</span>
  <h1>Car Broken Down?<br><span>We'll Arrange the Tow</span></h1>
  <p class="tw-hero__sub">Call us. We arrange a tow truck to bring your vehicle directly to our workshop at 139 Cavendish Drive, Manukau. We diagnose the fault, give you an estimate, and get it fixed.</p>
  <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="tw-hero__phone"><?php echo esc_html($phone_free); ?></a>
  <div class="tw-hero__detail"><?php echo esc_html($phone_local); ?> · <?php echo esc_html($hours); ?></div>
  <div class="tw-hero__ctas">
    <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--primary">Call Now</a>
    <a href="#enquire" class="taas-btn taas-btn--outline">Send Details</a>
  </div>
</div></section>

<!-- 2. TRUST STRIP -->
<div class="tw-trust"><div class="tw-trust__inner">
  <div class="tw-trust__item">MTA Assured</div>
  <div class="tw-trust__item">NZTA Authorised</div>
  <div class="tw-trust__item">We Arrange Everything</div>
  <div class="tw-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="tw-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. HOW IT WORKS -->
<section class="tw-sec tw-sec--grey"><div class="tw-sec__inner">
  <span class="tw-sec__eyebrow">How It Works</span>
  <h2 class="tw-sec__h2">From Breakdown to Back on the Road</h2>
  <p class="tw-sec__sub">One call. We handle the rest.</p>
  <div class="tw-steps">
    <div class="tw-step"><div class="tw-step__title">Call Us</div><div class="tw-step__body">Call <?php echo esc_html($phone_free); ?>. Tell us where the vehicle is, what happened, and the make and model. We take it from there.</div></div>
    <div class="tw-step"><div class="tw-step__title">We Arrange the Tow</div><div class="tw-step__body">We organise a tow truck to collect your vehicle and bring it directly to our workshop at 139 Cavendish Drive, Manukau. You deal with us, not a random tow company.</div></div>
    <div class="tw-step"><div class="tw-step__title">We Diagnose the Fault</div><div class="tw-step__body">Once the vehicle is at our workshop, we diagnose the problem. We contact you with what we find and provide an estimate before starting any repair.</div></div>
    <div class="tw-step"><div class="tw-step__title">We Fix It</div><div class="tw-step__body">No work without your approval. We repair the fault, test the vehicle, and get you back on the road. Finance available if the repair is unexpected.</div></div>
  </div>
</div></section>

<!-- 4. WHAT TO DO WHEN YOUR CAR BREAKS DOWN -->
<section class="tw-sec tw-sec--white"><div class="tw-sec__inner">
  <span class="tw-sec__eyebrow">Practical Guide</span>
  <h2 class="tw-sec__h2">What to Do When Your Car Breaks Down</h2>
  <div class="tw-breakdown">
    <div class="tw-breakdown__text">
      <p>If your car breaks down on the road, the first priority is safety. Pull over as far left as possible — off the road if you can. Turn on your hazard lights immediately. If you are on a motorway, stay in the vehicle with your seatbelt on — it is safer inside the car than standing on the roadside.</p>
      <p>Once you are safe, call us on <?php echo esc_html($phone_free); ?>. Tell us where you are, what happened, and what the vehicle is doing (or not doing). We will arrange a tow to our workshop and advise on the next steps.</p>
      <p>If the vehicle has overheated, do not open the radiator cap — the coolant is under pressure and can cause serious burns. If there is smoke or a burning smell, move away from the vehicle and call emergency services first, then call us.</p>
    </div>
    <div class="tw-breakdown__callout">
      <div class="tw-breakdown__callout-title">Common Reasons We Arrange Tows</div>
      <ul class="tw-breakdown__list">
        <li>Engine will not start — no crank, no fire</li>
        <li>Overheating — temperature gauge in the red</li>
        <li>Cambelt or timing chain failure</li>
        <li>Transmission failure — will not drive</li>
        <li>Major electrical fault — complete loss of power</li>
        <li>Accident damage assessment</li>
        <li>Clutch failure — cannot select gears</li>
        <li>Severe steering or suspension damage</li>
        <li>Vehicle is unsafe to drive to the workshop</li>
      </ul>
    </div>
  </div>
  <div class="tw-notice">
    <div class="tw-notice__title">Important — Towing to Our Workshop Only</div>
    <div class="tw-notice__body">We arrange towing specifically for vehicles being brought to Tony Allen Auto Service for diagnosis and repair. This is not a general towing service. The tow truck is organised through a trusted operator we work with regularly — you deal with us throughout the process.</div>
  </div>
</div></section>

<!-- 5. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="tw-sec tw-sec--dark" id="enquire"><div class="tw-sec__inner">
  <div class="tw-enquiry">
    <div>
      <span class="tw-sec__eyebrow">Arrange a Tow</span>
      <h2 class="tw-sec__h2">Call Us or Send Your Details</h2>
      <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us where the vehicle is, what happened, and the make and model. We will arrange a tow and get back to you with next steps.</p>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="tw-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="tw-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    </div>
    <div><?php echo do_shortcode($cf7_general); ?></div>
  </div>
</div></section>

<!-- 6. RELATED -->
<section class="tw-sec tw-sec--grey"><div class="tw-sec__inner">
  <span class="tw-sec__eyebrow">Once It's Here</span>
  <h2 class="tw-sec__h2">What We Can Fix</h2>
  <p class="tw-sec__sub">Seven specialist divisions under one roof. Whatever the fault, we can diagnose and repair it in-house.</p>
  <div class="tw-related">
    <a href="<?php echo esc_url($site_url.'/auto-electrical/'); ?>" class="tw-related-card"><div><?php echo tw_badge('AE',36); ?></div><div class="tw-related-card__name">Auto Electrical</div></a>
    <a href="<?php echo esc_url($site_url.'/engine-repairs/'); ?>" class="tw-related-card"><div><?php echo tw_badge('ENG',36); ?></div><div class="tw-related-card__name">Engine Repairs</div></a>
    <a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>" class="tw-related-card"><div><?php echo tw_badge('CS',36); ?></div><div class="tw-related-card__name">Cooling System</div></a>
    <a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/'); ?>" class="tw-related-card"><div><?php echo tw_badge('MBC',36); ?></div><div class="tw-related-card__name">Brakes &amp; Clutch</div></a>
    <a href="<?php echo esc_url($site_url.'/steering-and-suspension/'); ?>" class="tw-related-card"><div><?php echo tw_badge('SS',36); ?></div><div class="tw-related-card__name">Steering &amp; Suspension</div></a>
    <a href="<?php echo esc_url($site_url.'/manukau-batteries/'); ?>" class="tw-related-card"><div><?php echo tw_badge('BAT',36); ?></div><div class="tw-related-card__name">Battery Supply &amp; Fit</div></a>
  </div>
</div></section>

<!-- 7. REVIEWS -->
<section class="tw-sec tw-sec--white"><div class="tw-sec__inner">
  <span class="tw-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
  <h2 class="tw-sec__h2">What Customers Say</h2>
  <?php echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- 8. FAQ -->
<section class="tw-sec tw-sec--grey"><div class="tw-sec__inner">
  <span class="tw-sec__eyebrow">FAQ</span>
  <h2 class="tw-sec__h2">Towing — Common Questions</h2>
  <div class="tw-faq">
    <?php foreach ($faqs as $faq) : ?>
    <div class="tw-faq__item<?php echo $i===0?' tw-faq__item--open':''; ?>">
      <button class="tw-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
      <div class="tw-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<script>
document.querySelectorAll('.tw-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.tw-faq__item'),o=i.classList.contains('tw-faq__item--open');document.querySelectorAll('.tw-faq__item--open').forEach(function(x){x.classList.remove('tw-faq__item--open');});if(!o)i.classList.add('tw-faq__item--open');});});
</script>

<?php get_footer(); ?>
