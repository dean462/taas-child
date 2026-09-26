<?php
/**
 * Template Name: Brake Hub
 * Template Post Type: page
 * URL: /brake-repairs-manukau/
 *
 * Tony Allen Auto Service — taas.co.nz
 * CSS namespace: .brk
 * Rebuilt to Go-Live Standard — June 2026
 * High-GP page — CTA-heavy. WOF brake failure capture.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$brake_price    = defined('TAAS_BRAKE_PRICE')    ? TAAS_BRAKE_PRICE    : 'from $380';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

$hero_img = defined('TAAS_HERO_BRAKE') ? TAAS_HERO_BRAKE : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

$finance = [['name'=>'Afterpay','logo'=>''],['name'=>'Q Card','logo'=>''],['name'=>'GEM Finance','logo'=>''],['name'=>'Aotea Finance','logo'=>'']];

$services = [
    ['badge'=>'PR','title'=>'Pad & Rotor Replacement','desc'=>'New pads plus rotor machining or replacement — always together, never pads only. The correct way to do brake work.','url'=>'/brake-pad-rotor-replacement-manukau/','cta'=>'Pads & Rotors →'],
    ['badge'=>'BF','title'=>'Brake Fluid Service','desc'=>'Brake fluid absorbs moisture and degrades over time. A fluid change restores the boiling point and prevents brake fade under heavy use.','url'=>'/brake-fluid-service-manukau/','cta'=>'Brake Fluid →'],
    ['badge'=>'CA','title'=>'Calliper Service & Repair','desc'=>'Seized, sticking, or leaking callipers cause uneven braking, pad wear, and vehicle pull. Rebuild or replacement.','url'=>'/brake-calliper-repair-manukau/','cta'=>'Callipers →'],
    ['badge'=>'DR','title'=>'Drum Brakes & Shoes','desc'=>'Rear drum brake inspection, shoe replacement, and wheel cylinder repair. Common on older vehicles and some modern rear axles.','url'=>'/drum-brake-repair-manukau/','cta'=>'Drum Brakes →'],
    ['badge'=>'HB','title'=>'Handbrake Repair','desc'=>'Cable adjustment, shoe replacement, and electronic handbrake diagnosis. Your handbrake is a WOF requirement.','url'=>'/handbrake-repair-manukau/','cta'=>'Handbrake →'],
    ['badge'=>'BN','title'=>'Brake Noise Diagnosis','desc'=>'Squealing, grinding, or scraping? We identify the cause — pad wear indicators, glazed pads, rotor damage, seized calliper, or stone caught in the shield.','url'=>'/brake-noise-diagnosis-manukau/','cta'=>'Brake Noise →'],
    ['badge'=>'WF','title'=>'WOF Brake Failure','desc'=>'Failed your WOF on brakes? We fix it and re-inspect on-site — NZTA Authorised. Same-day where possible.','url'=>'/wof-brake-failure-manukau/','cta'=>'WOF Brakes →'],
];

$related = [['label'=>'Manukau Brake & Clutch','url'=>'/manukau-brake-clutch/'],['label'=>'Clutch Replacement','url'=>'/clutch-replacement-manukau/'],['label'=>'Disc Skimming','url'=>'/disc-skimming/'],['label'=>'WOF Inspections','url'=>'/wof/'],['label'=>'Wheel Alignment','url'=>'/wheel-alignment-manukau/'],['label'=>'Steering & Suspension','url'=>'/steering-and-suspension/'],['label'=>'EV Brake Service','url'=>'/ev-brake-service-manukau/'],['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Diagnostic Scanning','url'=>'/diagnostic-scanning/'],['label'=>'Finance Options','url'=>'/finance-options/']];

$faqs = [
    $taas_faqs['brake_cost'],
    $taas_faqs['brake_pads_only'],
    $taas_faqs['brake_signs'],
    $taas_faqs['brake_wof_fail'],
    $taas_faqs['brake_disc_skimming'],
    $taas_faqs['brake_fluid'],
    $taas_faqs['brake_grinding'],
    $taas_faqs['brake_european'],
    $taas_faqs['brake_finance'],
    $taas_faqs['brake_duration'],
    $taas_faqs['brake_disc_vs_drum'],
    $taas_faqs['brake_location'],
];

function brk_badge($i,$s=56){$f=strlen($i)>2?14:18;return '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 '.$s.' '.$s.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($s/2).'" cy="'.($s/2).'" r="'.($s/2).'" fill="#111"/><text x="'.($s/2).'" y="'.($s/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$f.'" font-weight="700" letter-spacing="0.5">'.$i.'</text></svg>';}

$schema_faqs=[];foreach($faqs as $faq){$schema_faqs[]=['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]];}
$schema=['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Manukau Brake & Clutch','item'=>$site_url.'/manukau-brake-clutch/'],['@type'=>'ListItem','position'=>3,'name'=>'Brake Repairs','item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Brake repairs in Manukau, South Auckland. Pad and rotor replacement '.$brake_price.'. On-site disc skimming. WOF brake failures fixed and re-inspected. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.brk-hero__sub','.brk-faq__item:first-of-type .brk-faq__a']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-brake-hub .site-content,.page-template-template-brake-hub .entry-content,.page-template-template-brake-hub .entry-header,.page-template-template-brake-hub article,.page-template-template-brake-hub #primary,.page-template-template-brake-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-brake-hub{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;}
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.brk-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.brk-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}.brk-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}.brk-crumb__inner a{color:#999;text-decoration:none;}.brk-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}.brk-crumb__sep{margin:0 8px;color:#444;}.brk-crumb__cur{color:#bbb;}
.brk-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}.brk-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}.brk-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.brk-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}.brk-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}.brk-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.brk-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}.brk-hero h1 span{color:var(--taas-yellow,#FFC800);}
.brk-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.brk-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:11px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);margin-bottom:24px;line-height:1.5;}
.brk-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.brk-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}.brk-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}.brk-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}.brk-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}.brk-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}.brk-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}.brk-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}.brk-sidebar__phone:hover{opacity:.65;}.brk-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.75;}
.brk-phonestrip{background:var(--taas-yellow,#FFC800);}.brk-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.brk-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.brk-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.brk-phonestrip__num:hover{opacity:.65;}
.brk-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}.brk-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}.brk-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}.brk-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}
.brk-section{padding:var(--taas-sec-pad,72px) 0;}.brk-section--white{background:var(--taas-white,#fff);}.brk-section--grey{background:var(--taas-panel,#F7F7F5);}.brk-section--dark{background:var(--taas-dark,#1A1A1A);}
.brk-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}.brk-h2--white{color:var(--taas-white,#fff);}
.brk-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}.brk-section--dark .brk-lead{color:#aaa;}
.brk-content{max-width:780px;}.brk-content p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 16px;}
.brk-compare{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:28px;max-width:780px;}.brk-compare__card{border-radius:var(--taas-radius,6px);padding:24px;}.brk-compare__card--wrong{background:rgba(192,57,43,.05);border:1px solid rgba(192,57,43,.15);}.brk-compare__card--right{background:rgba(255,200,0,.06);border:1px solid rgba(255,200,0,.2);}.brk-compare__card h3{font-size:15px;font-weight:700;margin:0 0 10px;}.brk-compare__card--wrong h3{color:#c0392b;}.brk-compare__card--right h3{color:var(--taas-dark,#1A1A1A);}.brk-compare__card p{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin:0;}
.brk-wof-cta{border-left:4px solid var(--taas-alert,#C0392B);background:rgba(192,57,43,.05);padding:20px 24px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:32px;max-width:780px;}.brk-wof-cta__title{font-size:14px;font-weight:700;color:#c0392b;margin-bottom:6px;}.brk-wof-cta__body{font-size:14px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}
.brk-services{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-top:28px;}.brk-svc{display:flex;gap:16px;padding:24px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color .15s;align-items:flex-start;}.brk-svc:hover{border-color:var(--taas-yellow,#FFC800);}.brk-svc__body{flex:1;}.brk-svc__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:6px;}.brk-svc__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:8px;}.brk-svc__cta{font-size:13px;font-weight:700;color:var(--taas-yellow2,#e6b400);}
.brk-symptoms{list-style:none;padding:0;margin:0;max-width:700px;}.brk-symptoms li{display:flex;align-items:flex-start;gap:12px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;font-weight:300;color:#ccc;line-height:1.75;}.brk-symptoms li:last-child{border-bottom:none;}.brk-symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.brk-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:580px;}.brk-pricing__title{font-size:20px;font-weight:800;color:var(--taas-black,#111);margin-bottom:12px;}.brk-pricing__body{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.brk-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}.brk-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}.brk-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}.brk-finance__text strong{font-weight:700;color:var(--taas-black,#111);}.brk-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}.brk-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.brk-fin img{max-height:20px;width:auto;display:block;}.brk-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}.brk-finance__link:hover{text-decoration:underline;}
.brk-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}.brk-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}.brk-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.brk-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}.brk-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}.brk-enquiry__phone:hover{opacity:.65;}.brk-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;}.brk-enquiry__detail strong{color:#fff;font-weight:700;}.brk-enquiry__detail a{color:#aaa;text-decoration:underline;}.brk-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}.brk-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.brk-enquiry__badge img{max-height:18px;width:auto;display:block;}.brk-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.brk-enquiry__note strong{color:#fff;font-weight:700;}.brk-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.brk-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}.brk-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.brk-section--dark .wpcf7 label,.brk-section--dark .wpcf7 p,.brk-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}.brk-section--dark .wpcf7 input[type="text"],.brk-section--dark .wpcf7 input[type="email"],.brk-section--dark .wpcf7 input[type="tel"],.brk-section--dark .wpcf7 textarea,.brk-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}.brk-section--dark .wpcf7 input::placeholder,.brk-section--dark .wpcf7 textarea::placeholder{color:#666;}.brk-section--dark .wpcf7 input:focus,.brk-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}.brk-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}.brk-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.brk-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}.brk-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}.brk-related__link:hover{border-color:var(--taas-yellow,#FFC800);}.brk-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.brk-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}.brk-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}.brk-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}.brk-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}.brk-faq__item--open .brk-faq__q::after{content:'−';}.brk-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}.brk-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}.brk-faq__a a:hover{text-decoration:underline;}.brk-faq__item--open .brk-faq__a{display:block;}
.brk-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}.brk-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}.brk-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}.brk-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.brk-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}.brk-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}.brk-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}.brk-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}.brk-btn--dark:hover{background:#000;}.brk-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}.brk-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
@media(max-width:960px){.brk-hero__inner,.brk-enquiry{grid-template-columns:1fr;gap:32px;}.brk-sidebar{display:none;}.brk-compare{grid-template-columns:1fr;}}
@media(max-width:640px){.brk-hero{padding:48px 0 40px;}.brk-hero h1{font-size:clamp(26px,7vw,38px);}.brk-hero__sub{font-size:14px;}.brk-section{padding:48px 0;}.brk-h2{font-size:clamp(22px,5vw,28px);}.brk-lead{font-size:14px;}.brk-content p,.brk-wof-cta__body,.brk-compare__card p,.brk-enquiry__list li,.brk-finance__text,.brk-pricing__body{font-size:14px;}.brk-svc__desc,.brk-symptoms li{font-size:13px;}.brk-trust__inner{gap:8px 20px;}.brk-trust__item{font-size:12px;}.brk-phonestrip__num{font-size:17px;}.brk-faq__q{font-size:14px;padding:16px 32px 16px 0;}.brk-faq__a{font-size:13px;}.brk-hero__ctas{flex-direction:column;align-items:stretch;}.brk-hero__ctas .brk-btn{justify-content:center;text-align:center;}.brk-enquiry{display:flex;flex-direction:column-reverse;}.brk-close{flex-direction:column;align-items:flex-start;}}
</style>

<nav class="brk-crumb" aria-label="Breadcrumb"><div class="brk-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="brk-crumb__sep">›</span><a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/'); ?>">Manukau Brake &amp; Clutch</a><span class="brk-crumb__sep">›</span><span class="brk-crumb__cur">Brake Repairs</span></div></nav>

<section class="brk-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="brk-w"><div class="brk-hero__inner">
  <div>
    <span class="brk-eye brk-eye--yellow">Brakes — Manukau</span>
    <h1>Brake Repairs<br><span>Manukau — South Auckland</span></h1>
    <p class="brk-hero__sub">New pads plus rotor machining or replacement — always together, never pads only. On-site disc skimming. WOF brake failures fixed and re-inspected on-site. NZTA Authorised. <?php echo esc_html($years); ?> years of workshop experience.</p>
    <div class="brk-hero__price">Brake pad &amp; rotor replacement <?php echo esc_html($brake_price); ?></div>
    <div class="brk-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-btn brk-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#brk-enquire" class="brk-btn brk-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="brk-sidebar">
    <div class="brk-sidebar__title">At a Glance</div>
    <ul class="brk-sidebar__list"><li>Pads + rotors always</li><li>On-site disc skimming</li><li>WOF re-inspection on-site</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="brk-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="brk-phonestrip"><div class="brk-phonestrip__inner"><span class="brk-phonestrip__label">Brakes squealing, grinding, or pulling?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<div class="brk-trust"><div class="brk-trust__inner"><div class="brk-trust__item">MTA Assured</div><div class="brk-trust__item">NZTA Authorised</div><div class="brk-trust__item">On-Site Disc Skimming</div><div class="brk-trust__item">WOF Re-Inspection On-Site</div><div class="brk-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="brk-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<section class="brk-section brk-section--white"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Understanding Brake Repairs</span>
  <h2 class="brk-h2">Why We Never Fit Brake Pads Only</h2>
  <div class="brk-content">
    <p>The rotor surface is what the pad grips to slow your vehicle. Over thousands of kilometres, that surface develops grooves, heat spots, and uneven wear from the old pads. When you fit new pads to a grooved rotor, the new pads cannot make full contact with the surface. They ride on the high spots, wear unevenly, overheat at the contact points, and squeal because the pad is vibrating against an uneven surface.</p>
    <p>Worse — the groove pattern from the old pads physically transfers into the new pads within the first few hundred kilometres. The new pads effectively become pre-worn to match the old rotor's imperfections. You have paid for new pads that are already compromised.</p>
    <p>Machining the rotor (disc skimming) removes the old groove pattern and restores a flat, smooth surface. New pads on a machined rotor bed in evenly, wear correctly, and deliver consistent stopping power. If the rotor is below minimum thickness or too damaged to machine, we replace it. Either way — the surface is correct before the new pads go on.</p>
  </div>
  <div class="brk-compare">
    <div class="brk-compare__card brk-compare__card--wrong"><h3>Pads Only — The Cheap Approach</h3><p>New pads on old grooved rotors. Uneven contact. Squealing. Accelerated wear. The pad grooves into the same pattern within months. Customer returns with the same complaint. False economy — you pay twice.</p></div>
    <div class="brk-compare__card brk-compare__card--right"><h3>Pads + Rotors — Done Properly</h3><p>New pads on a machined or replaced rotor. Full surface contact from day one. Even wear. No squealing. Correct bedding. Consistent braking performance. Lasts significantly longer. One visit.</p></div>
  </div>
  <div class="brk-wof-cta">
    <div class="brk-wof-cta__title">Failed Your WOF on Brakes?</div>
    <div class="brk-wof-cta__body">Brakes are one of the most common WOF failure items. We repair the fault and re-inspect on-site — NZTA Authorised. You do not need to go elsewhere. Same-day where possible, subject to parts availability. <a href="<?php echo esc_url($site_url.'/wof/'); ?>" style="color:#c0392b;font-weight:600;">More about WOF at TAAS →</a></div>
  </div>
</div></section>

<section class="brk-section brk-section--grey"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Our Services</span>
  <h2 class="brk-h2">Brake Services at Manukau Brake &amp; Clutch</h2>
  <div class="brk-services"><?php foreach ($services as $s): ?><a href="<?php echo esc_url($site_url.$s['url']); ?>" class="brk-svc"><div><?php echo brk_badge($s['badge']); ?></div><div class="brk-svc__body"><div class="brk-svc__title"><?php echo esc_html($s['title']); ?></div><div class="brk-svc__desc"><?php echo esc_html($s['desc']); ?></div><div class="brk-svc__cta"><?php echo esc_html($s['cta']); ?></div></div></a><?php endforeach; ?></div>
</div></section>

<section class="brk-section brk-section--dark"><div class="brk-w">
  <span class="brk-eye brk-eye--yellow">Warning Signs</span>
  <h2 class="brk-h2 brk-h2--white">Does This Sound Like Your Vehicle?</h2>
  <p class="brk-lead">If your vehicle is showing any of these, your brakes need inspecting. Do not wait until they fail.</p>
  <ul class="brk-symptoms">
    <li>Squealing or high-pitched noise when braking — pad wear indicator contact</li>
    <li>Grinding or scraping metal sound — pads completely worn, metal on metal</li>
    <li>Vibration or pulsing through the brake pedal — warped or uneven rotors</li>
    <li>Vehicle pulls to one side under braking — seized calliper or uneven pad wear</li>
    <li>Longer stopping distance — pads worn thin or brake fluid degraded</li>
    <li>Brake warning light on dashboard — low fluid, worn pads, or system fault</li>
    <li>Soft or spongy brake pedal — air in the system or fluid degradation</li>
    <li>Burning smell when braking — overheated pad or seized calliper</li>
  </ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-btn brk-btn--primary" style="margin-top:28px;">Call <?php echo esc_html($phone_free); ?></a>
</div></section>

<section class="brk-section brk-section--white"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Pricing</span>
  <h2 class="brk-h2">How Much Do Brake Repairs Cost?</h2>
  <p class="brk-lead">We always provide an estimate before starting any work — no surprises.</p>
  <div class="brk-pricing">
    <div class="brk-pricing__title">Pad &amp; rotor replacement <?php echo esc_html($brake_price); ?></div>
    <div class="brk-pricing__body">Includes new pads and rotor machining or replacement. Price varies by vehicle make and model. Rear brakes, calliper work, and drum brakes priced separately after inspection. Call <?php echo esc_html($phone_free); ?> with your vehicle details for an estimate.</div>
  </div>
</div></section>

<div class="brk-finance"><div class="brk-finance__inner">
  <div class="brk-finance__text"><strong>Finance available</strong> — brake repairs are safety-critical. Don't delay because of cost.</div>
  <div class="brk-finance__logos"><?php foreach ($finance as $f): ?><span class="brk-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" class="brk-finance__link">View finance options →</a>
</div></div>

<section id="brk-enquire" class="brk-section brk-section--dark"><div class="brk-w"><div class="brk-enquiry">
  <div>
    <span class="brk-eye brk-eye--yellow">Book or Enquire</span>
    <h2 class="brk-h2 brk-h2--white">Brake Repairs — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your vehicle make and model and what symptoms you are noticing — noise, vibration, warning light, WOF failure. We will advise on next steps.</p>
    <ul class="brk-enquiry__list"><?php foreach (['Pads and rotors always — never pads only','Written estimate before any work begins','On-site disc skimming and WOF re-inspection','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="brk-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="brk-enquiry__badges"><?php foreach ($finance as $f): ?><span class="brk-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="brk-enquiry__note"><strong>Estimate before we start.</strong> We confirm the price before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="brk-enquiry__form">
    <div class="brk-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="brk-section brk-section--white"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Customer Reviews</span>
  <h2 class="brk-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="brk-section brk-section--grey"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Related Services</span>
  <h2 class="brk-h2">Connected Services</h2>
  <div class="brk-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="brk-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<section class="brk-section brk-section--white"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">Common Questions</span>
  <h2 class="brk-h2">Brake Repairs — FAQ</h2>
  <div class="brk-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="brk-faq__item<?php echo $i===0?' brk-faq__item--open':''; ?>"><button class="brk-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="brk-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="brk-a-<?php echo $i; ?>" class="brk-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<section class="brk-section brk-section--grey"><div class="brk-w">
  <span class="brk-eye brk-eye--dark">South Auckland</span>
  <h2 class="brk-h2">Brake Repairs — Manukau</h2>
  <p class="brk-lead" style="margin-bottom:0;">Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="brk-close">
    <div class="brk-close__text">Brakes are safety-critical — don't wait.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="brk-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brk-btn brk-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#brk-enquire" class="brk-btn brk-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.brk-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.brk-faq__item');var wasOpen=item.classList.contains('brk-faq__item--open');document.querySelectorAll('.brk-faq__item--open').forEach(function(el){el.classList.remove('brk-faq__item--open');el.querySelector('.brk-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('brk-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
