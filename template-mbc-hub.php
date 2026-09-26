<?php
/**
 * Template Name: MBC Hub
 * Template Post Type: page
 * URL: /manukau-brake-clutch/
 *
 * Tony Allen Auto Service — taas.co.nz
 * Manukau Brake & Clutch — division hub page.
 * CSS namespace: .mbc
 * Rebuilt to Go-Live Standard — June 2026
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
$clutch_price   = defined('TAAS_CLUTCH_PRICE')   ? TAAS_CLUTCH_PRICE   : 'from $800';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

$hero_img = defined('TAAS_HERO_MBC') ? TAAS_HERO_MBC : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

$finance = [['name'=>'Afterpay','logo'=>''],['name'=>'Q Card','logo'=>''],['name'=>'GEM Finance','logo'=>''],['name'=>'Aotea Finance','logo'=>'']];

function mbc_badge($initials,$size=56){$fs=strlen($initials)>2?14:18;return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#111111"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="700" letter-spacing="0.5">'.$initials.'</text></svg>';}

$hubs = [
    ['badge'=>'BR','title'=>'Brake Repairs & Servicing','desc'=>'Pad and rotor replacement, brake fluid, callipers, drums, handbrake repairs, and brake noise diagnosis. WOF brake failures fixed and re-inspected on-site.','price'=>$brake_price,'url'=>'/brake-repairs-manukau/','cta'=>'Brake Repairs →'],
    ['badge'=>'CL','title'=>'Clutch Replacement & Repair','desc'=>'Clutch kit replacement, flywheel inspection and replacement, hydraulic clutch systems, and clutch diagnosis.','price'=>$clutch_price,'url'=>'/clutch-replacement-manukau/','cta'=>'Clutch Repairs →'],
    ['badge'=>'DS','title'=>'Disc Skimming','desc'=>'On-site brake disc machining. Rotors resurfaced to specification — removes grooves, scoring, and minor warping. Paired with new pads for correct bedding.','price'=>'Contact for pricing','url'=>'/disc-skimming/','cta'=>'Disc Skimming →'],
];

$related = [['label'=>'WOF Inspections','url'=>'/wof/'],['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Steering & Suspension','url'=>'/steering-and-suspension/'],['label'=>'Wheel Alignment','url'=>'/wheel-alignment-manukau/'],['label'=>'Transmission Service','url'=>'/transmission-service-and-repair/'],['label'=>'Diagnostic Scanning','url'=>'/diagnostic-scanning/'],['label'=>'TAAS European','url'=>'/european/'],['label'=>'EV & Hybrid Servicing','url'=>'/electric-hybrid-vehicle-servicing/'],['label'=>'Finance Options','url'=>'/finance-options/'],['label'=>'MBI Approved Repairer','url'=>'/mechanical-breakdown-insurance/']];

$suburbs = [['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],['name'=>'Botany','slug'=>'botany']];

$faqs = [
    $taas_faqs["mbc_brake_cost"],
    $taas_faqs["mbc_clutch_cost"],
    $taas_faqs["mbc_pads_only"],
    $taas_faqs["mbc_disc_skimming"],
    $taas_faqs["mbc_wof_brakes"],
    $taas_faqs["mbc_brake_signs"],
    $taas_faqs["mbc_clutch_signs"],
    $taas_faqs["mbc_european"],
    $taas_faqs["mbc_finance"],
    $taas_faqs["mbc_mbi"],
    $taas_faqs["mbc_duration"],
    $taas_faqs["mbc_location"],
];

$schema_faqs=[];foreach($faqs as $faq){$schema_faqs[]=['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]];}
$schema=['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>$site_url.'/services/'],['@type'=>'ListItem','position'=>3,'name'=>'Manukau Brake & Clutch','item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Manukau Brake & Clutch — specialist brake and clutch division of Tony Allen Auto Service. Brake repairs '.$brake_price.'. Clutch replacement '.$clutch_price.'. On-site disc skimming. NZTA Authorised WOF re-inspection. MTA Assured. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.mbc-hero__sub','.mbc-faq__item:first-of-type .mbc-faq__a']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-mbc-hub .site-content,.page-template-template-mbc-hub .entry-content,.page-template-template-mbc-hub .entry-header,.page-template-template-mbc-hub article,.page-template-template-mbc-hub #primary,.page-template-template-mbc-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-mbc-hub{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;}
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.mbc-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.mbc-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}.mbc-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}.mbc-crumb__inner a{color:#999;text-decoration:none;}.mbc-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}.mbc-crumb__sep{margin:0 8px;color:#444;}.mbc-crumb__cur{color:#bbb;}
.mbc-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}.mbc-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}.mbc-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.mbc-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}.mbc-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}.mbc-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.mbc-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}.mbc-hero h1 span{color:var(--taas-yellow,#FFC800);}
.mbc-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.mbc-hero__prices{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:24px;}.mbc-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);}
.mbc-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.mbc-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}.mbc-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}.mbc-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}.mbc-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}.mbc-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}.mbc-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}.mbc-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}.mbc-sidebar__phone:hover{opacity:.65;}.mbc-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.75;}
.mbc-phonestrip{background:var(--taas-yellow,#FFC800);}.mbc-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.mbc-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.mbc-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.mbc-phonestrip__num:hover{opacity:.65;}
.mbc-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}.mbc-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}.mbc-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}.mbc-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}
.mbc-section{padding:var(--taas-sec-pad,72px) 0;}.mbc-section--white{background:var(--taas-white,#fff);}.mbc-section--grey{background:var(--taas-panel,#F7F7F5);}.mbc-section--dark{background:var(--taas-dark,#1A1A1A);}
.mbc-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}.mbc-h2--white{color:var(--taas-white,#fff);}
.mbc-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}.mbc-section--dark .mbc-lead{color:#aaa;}
.mbc-content{max-width:780px;}.mbc-content p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 16px;}
.mbc-safety{border-left:4px solid var(--taas-alert,#C0392B);background:rgba(192,57,43,.05);padding:20px 24px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:32px;max-width:780px;}.mbc-safety__title{font-size:14px;font-weight:700;color:#c0392b;margin-bottom:6px;}.mbc-safety__body{font-size:14px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}
.mbc-hubs{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:28px;}.mbc-hub-card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px;text-decoration:none;display:flex;flex-direction:column;transition:border-color .15s;}.mbc-hub-card:hover{border-color:var(--taas-yellow,#FFC800);}.mbc-hub-card__badge{margin-bottom:16px;}.mbc-hub-card__title{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:10px;}.mbc-hub-card__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:12px;flex:1;}.mbc-hub-card__price{font-size:14px;font-weight:700;color:var(--taas-black,#111);margin-bottom:12px;}.mbc-hub-card__cta{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);}
.mbc-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}.mbc-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}.mbc-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}.mbc-finance__text strong{font-weight:700;color:var(--taas-black,#111);}.mbc-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}.mbc-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.mbc-fin img{max-height:20px;width:auto;display:block;}.mbc-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}.mbc-finance__link:hover{text-decoration:underline;}
.mbc-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}.mbc-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}.mbc-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.mbc-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}.mbc-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}.mbc-enquiry__phone:hover{opacity:.65;}.mbc-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;}.mbc-enquiry__detail strong{color:#fff;font-weight:700;}.mbc-enquiry__detail a{color:#aaa;text-decoration:underline;}.mbc-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}.mbc-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.mbc-enquiry__badge img{max-height:18px;width:auto;display:block;}.mbc-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.mbc-enquiry__note strong{color:#fff;font-weight:700;}.mbc-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.mbc-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}.mbc-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.mbc-section--dark .wpcf7 label,.mbc-section--dark .wpcf7 p,.mbc-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}.mbc-section--dark .wpcf7 input[type="text"],.mbc-section--dark .wpcf7 input[type="email"],.mbc-section--dark .wpcf7 input[type="tel"],.mbc-section--dark .wpcf7 textarea,.mbc-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}.mbc-section--dark .wpcf7 input::placeholder,.mbc-section--dark .wpcf7 textarea::placeholder{color:#666;}.mbc-section--dark .wpcf7 input:focus,.mbc-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}.mbc-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}.mbc-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.mbc-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}.mbc-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}.mbc-related__link:hover{border-color:var(--taas-yellow,#FFC800);}.mbc-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.mbc-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}.mbc-suburb-pill{display:inline-block;padding:7px 18px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:14px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}.mbc-suburb-pill:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.mbc-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}.mbc-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}.mbc-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}.mbc-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}.mbc-faq__item--open .mbc-faq__q::after{content:'−';}.mbc-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}.mbc-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}.mbc-faq__a a:hover{text-decoration:underline;}.mbc-faq__item--open .mbc-faq__a{display:block;}
.mbc-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}.mbc-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}.mbc-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}.mbc-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.mbc-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}.mbc-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}.mbc-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}.mbc-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}.mbc-btn--dark:hover{background:#000;}.mbc-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}.mbc-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
@media(max-width:960px){.mbc-hero__inner,.mbc-enquiry{grid-template-columns:1fr;gap:32px;}.mbc-sidebar{display:none;}.mbc-hubs{grid-template-columns:1fr;}}
@media(max-width:640px){.mbc-hero{padding:48px 0 40px;}.mbc-hero h1{font-size:clamp(26px,7vw,38px);}.mbc-hero__sub{font-size:14px;}.mbc-section{padding:48px 0;}.mbc-h2{font-size:clamp(22px,5vw,28px);}.mbc-lead{font-size:14px;}.mbc-content p,.mbc-safety__body,.mbc-enquiry__list li,.mbc-finance__text,.mbc-hub-card__desc{font-size:14px;}.mbc-trust__inner{gap:8px 20px;}.mbc-trust__item{font-size:12px;}.mbc-phonestrip__num{font-size:17px;}.mbc-faq__q{font-size:14px;padding:16px 32px 16px 0;}.mbc-faq__a{font-size:13px;}.mbc-hero__ctas{flex-direction:column;align-items:stretch;}.mbc-hero__ctas .mbc-btn{justify-content:center;text-align:center;}.mbc-hero__prices{flex-direction:column;align-items:flex-start;}.mbc-enquiry{display:flex;flex-direction:column-reverse;}.mbc-close{flex-direction:column;align-items:flex-start;}}
</style>

<nav class="mbc-crumb" aria-label="Breadcrumb"><div class="mbc-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="mbc-crumb__sep">›</span><a href="<?php echo esc_url($site_url.'/services/'); ?>">Services</a><span class="mbc-crumb__sep">›</span><span class="mbc-crumb__cur">Manukau Brake &amp; Clutch</span></div></nav>

<section class="mbc-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="mbc-w"><div class="mbc-hero__inner">
  <div>
    <span class="mbc-eye mbc-eye--yellow">Manukau Brake &amp; Clutch</span>
    <h1>Brake &amp; Clutch<br><span>Specialists Manukau</span></h1>
    <p class="mbc-hero__sub">Manukau Brake &amp; Clutch — specialist brake and clutch division of Tony Allen Auto Service. Brake repairs, clutch replacement, and on-site disc skimming. Safety-critical work done properly the first time. <?php echo esc_html($years); ?> years of workshop experience.</p>
    <div class="mbc-hero__prices"><div class="mbc-hero__price">Brakes <?php echo esc_html($brake_price); ?></div><div class="mbc-hero__price">Clutch <?php echo esc_html($clutch_price); ?></div></div>
    <div class="mbc-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbc-btn mbc-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#mbc-enquire" class="mbc-btn mbc-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="mbc-sidebar">
    <div class="mbc-sidebar__title">At a Glance</div>
    <ul class="mbc-sidebar__list"><li>Brakes <?php echo esc_html($brake_price); ?></li><li>Clutch <?php echo esc_html($clutch_price); ?></li><li>On-site disc skimming</li><li>WOF re-inspection on-site</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbc-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="mbc-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="mbc-phonestrip"><div class="mbc-phonestrip__inner"><span class="mbc-phonestrip__label">Brakes or clutch playing up?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbc-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<div class="mbc-trust"><div class="mbc-trust__inner"><div class="mbc-trust__item">MTA Assured</div><div class="mbc-trust__item">NZTA Authorised</div><div class="mbc-trust__item">On-Site Disc Skimming</div><div class="mbc-trust__item">WOF Re-Inspection On-Site</div><div class="mbc-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="mbc-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<section class="mbc-section mbc-section--white"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Why It Matters</span>
  <h2 class="mbc-h2">Brakes and Clutch Are Safety-Critical</h2>
  <div class="mbc-content">
    <p>Your brakes are the most important safety system on your vehicle. A steering failure is dangerous. An engine failure is inconvenient. A brake failure is life-threatening. Brakes are also one of the most common WOF failure items in New Zealand — and the difference between a workshop that does brake work properly and one that takes shortcuts is the difference between a repair that lasts and one that puts you back in the same position six months later.</p>
    <p>We never fit pads only. New brake pads on a worn, grooved, or scored rotor will not bed in correctly. They wear unevenly, they squeal, and the grooves from the old pads transfer straight into the new ones. Every brake job at Manukau Brake &amp; Clutch includes rotor machining or replacement alongside new pads — because that is the only way to do it properly.</p>
    <p>Clutch work is the same principle. We replace the clutch as a kit — disc, pressure plate, and release bearing together — and inspect the flywheel before reassembly. A new clutch disc on a worn flywheel will judder, slip early, and cost you twice.</p>
  </div>
  <div class="mbc-safety">
    <div class="mbc-safety__title">Failed Your WOF on Brakes?</div>
    <div class="mbc-safety__body">We repair the fault and re-inspect on-site. NZTA Authorised — you do not need to go elsewhere for re-inspection. Same-day where possible, subject to parts availability. Call <?php echo esc_html($phone_free); ?>.</div>
  </div>
</div></section>

<section class="mbc-section mbc-section--grey"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Our Services</span>
  <h2 class="mbc-h2">Manukau Brake &amp; Clutch Services</h2>
  <div class="mbc-hubs"><?php foreach ($hubs as $h): ?>
    <a href="<?php echo esc_url($site_url.$h['url']); ?>" class="mbc-hub-card"><div class="mbc-hub-card__badge"><?php echo mbc_badge($h['badge']); ?></div><div class="mbc-hub-card__title"><?php echo esc_html($h['title']); ?></div><div class="mbc-hub-card__desc"><?php echo esc_html($h['desc']); ?></div><div class="mbc-hub-card__price"><?php echo esc_html($h['price']); ?></div><div class="mbc-hub-card__cta"><?php echo esc_html($h['cta']); ?></div></a>
  <?php endforeach; ?></div>
</div></section>

<div class="mbc-finance"><div class="mbc-finance__inner">
  <div class="mbc-finance__text"><strong>Finance available</strong> — brake and clutch repairs are safety-critical. Don't delay.</div>
  <div class="mbc-finance__logos"><?php foreach ($finance as $f): ?><span class="mbc-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" class="mbc-finance__link">View finance options →</a>
</div></div>

<section id="mbc-enquire" class="mbc-section mbc-section--dark"><div class="mbc-w"><div class="mbc-enquiry">
  <div>
    <span class="mbc-eye mbc-eye--yellow">Book or Enquire</span>
    <h2 class="mbc-h2 mbc-h2--white">Brake &amp; Clutch — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your vehicle make and model and whether it is brakes, clutch, or both. We will advise on next steps and provide an estimate.</p>
    <ul class="mbc-enquiry__list"><?php foreach (['Pads and rotors always — never pads only','Complete clutch kit — disc, pressure plate, release bearing','Written estimate before any work begins','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbc-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="mbc-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="mbc-enquiry__badges"><?php foreach ($finance as $f): ?><span class="mbc-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="mbc-enquiry__note"><strong>Estimate before we start.</strong> We confirm the price before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="mbc-enquiry__form">
    <div class="mbc-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="mbc-section mbc-section--white"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Customer Reviews</span>
  <h2 class="mbc-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="mbc-section mbc-section--grey"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Related Services</span>
  <h2 class="mbc-h2">Connected Services</h2>
  <div class="mbc-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="mbc-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<section class="mbc-section mbc-section--white"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Common Questions</span>
  <h2 class="mbc-h2">Manukau Brake &amp; Clutch — FAQ</h2>
  <div class="mbc-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="mbc-faq__item<?php echo $i===0?' mbc-faq__item--open':''; ?>"><button class="mbc-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="mbc-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="mbc-a-<?php echo $i; ?>" class="mbc-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<section class="mbc-section mbc-section--grey"><div class="mbc-w">
  <span class="mbc-eye mbc-eye--dark">Service Areas</span>
  <h2 class="mbc-h2">Brake &amp; Clutch Across South Auckland</h2>
  <div class="mbc-suburb-pills"><?php foreach ($suburbs as $s): ?><a href="<?php echo esc_url($site_url.'/brake-repairs-'.$s['slug'].'/'); ?>" class="mbc-suburb-pill"><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
  <div class="mbc-close">
    <div class="mbc-close__text">Brakes and clutch are safety-critical — don't wait.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="mbc-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbc-btn mbc-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#mbc-enquire" class="mbc-btn mbc-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.mbc-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.mbc-faq__item');var wasOpen=item.classList.contains('mbc-faq__item--open');document.querySelectorAll('.mbc-faq__item--open').forEach(function(el){el.classList.remove('mbc-faq__item--open');el.querySelector('.mbc-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('mbc-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
