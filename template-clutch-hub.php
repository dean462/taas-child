<?php
/**
 * Template Name: Clutch Hub
 * Template Post Type: page
 * URL: /clutch-replacement-manukau/
 *
 * Tony Allen Auto Service — taas.co.nz
 * CSS namespace: .clu
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
$clutch_price   = defined('TAAS_CLUTCH_PRICE')   ? TAAS_CLUTCH_PRICE   : 'from $800';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

$hero_img = defined('TAAS_HERO_CLUTCH') ? TAAS_HERO_CLUTCH : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

$finance = [['name'=>'Afterpay','logo'=>''],['name'=>'Q Card','logo'=>''],['name'=>'GEM Finance','logo'=>''],['name'=>'Aotea Finance','logo'=>'']];

$services = [
    ['badge'=>'CK','title'=>'Clutch Kit Replacement','desc'=>'Complete clutch kit — disc, pressure plate, and release bearing replaced together. Flywheel inspected and replaced if worn.','url'=>'/clutch-kit-replacement-manukau/','cta'=>'Clutch Kit →'],
    ['badge'=>'FW','title'=>'Flywheel Replacement','desc'=>'Worn, cracked, or heat-damaged flywheels replaced. Dual-mass flywheels on European vehicles cannot be repaired — replacement only.','url'=>'/flywheel-replacement-manukau/','cta'=>'Flywheel →'],
    ['badge'=>'CH','title'=>'Clutch Hydraulics','desc'=>'Clutch master cylinder, slave cylinder, and hydraulic line repair. Leaking or spongy clutch pedal diagnosed and fixed.','url'=>'/clutch-hydraulics-manukau/','cta'=>'Hydraulics →'],
];

$related = [['label'=>'Manukau Brake & Clutch','url'=>'/manukau-brake-clutch/'],['label'=>'Brake Repairs','url'=>'/brake-repairs-manukau/'],['label'=>'Manual Gearbox Repair','url'=>'/manual-gearbox-repair-manukau/'],['label'=>'Transmission Service','url'=>'/transmission-service-and-repair/'],['label'=>'Disc Skimming','url'=>'/disc-skimming/'],['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Diagnostic Scanning','url'=>'/diagnostic-scanning/'],['label'=>'TAAS European','url'=>'/european/'],['label'=>'Finance Options','url'=>'/finance-options/'],['label'=>'MBI Approved Repairer','url'=>'/mechanical-breakdown-insurance/']];

$faqs = [
    $taas_faqs['clutch_cost'],
    $taas_faqs['clutch_signs'],
    $taas_faqs['clutch_disc_only'],
    $taas_faqs['clutch_dmf'],
    $taas_faqs['clutch_duration'],
    $taas_faqs['clutch_mbi'],
    $taas_faqs['clutch_wear'],
    $taas_faqs['clutch_spongy'],
    $taas_faqs['clutch_european'],
    $taas_faqs['clutch_finance'],
    $taas_faqs['clutch_vs_gearbox'],
    $taas_faqs['clutch_location'],
];

function clu_badge($i,$s=56){$f=strlen($i)>2?14:18;return '<svg width="'.$s.'" height="'.$s.'" viewBox="0 0 '.$s.' '.$s.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($s/2).'" cy="'.($s/2).'" r="'.($s/2).'" fill="#111"/><text x="'.($s/2).'" y="'.($s/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$f.'" font-weight="700" letter-spacing="0.5">'.$i.'</text></svg>';}

$schema_faqs=[];foreach($faqs as $faq){$schema_faqs[]=['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]];}
$schema=['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Manukau Brake & Clutch','item'=>$site_url.'/manukau-brake-clutch/'],['@type'=>'ListItem','position'=>3,'name'=>'Clutch Replacement','item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Clutch replacement and repair in Manukau, South Auckland. Complete clutch kit '.$clutch_price.'. Flywheel inspection and replacement. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.clu-hero__sub','.clu-faq__item:first-of-type .clu-faq__a']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-clutch-hub .site-content,.page-template-template-clutch-hub .entry-content,.page-template-template-clutch-hub .entry-header,.page-template-template-clutch-hub article,.page-template-template-clutch-hub #primary,.page-template-template-clutch-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-clutch-hub{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;}
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.clu-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.clu-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}.clu-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}.clu-crumb__inner a{color:#999;text-decoration:none;}.clu-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}.clu-crumb__sep{margin:0 8px;color:#444;}.clu-crumb__cur{color:#bbb;}
.clu-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}.clu-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}.clu-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.clu-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}.clu-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}.clu-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.clu-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}.clu-hero h1 span{color:var(--taas-yellow,#FFC800);}
.clu-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.clu-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:11px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);margin-bottom:24px;line-height:1.5;}
.clu-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.clu-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}.clu-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}.clu-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}.clu-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}.clu-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}.clu-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}.clu-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}.clu-sidebar__phone:hover{opacity:.65;}.clu-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.75;}
.clu-phonestrip{background:var(--taas-yellow,#FFC800);}.clu-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.clu-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.clu-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.clu-phonestrip__num:hover{opacity:.65;}
.clu-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}.clu-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}.clu-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}.clu-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}
.clu-section{padding:var(--taas-sec-pad,72px) 0;}.clu-section--white{background:var(--taas-white,#fff);}.clu-section--grey{background:var(--taas-panel,#F7F7F5);}.clu-section--dark{background:var(--taas-dark,#1A1A1A);}
.clu-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}.clu-h2--white{color:var(--taas-white,#fff);}
.clu-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}.clu-section--dark .clu-lead{color:#aaa;}
.clu-content{max-width:780px;}.clu-content p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 16px;}
.clu-services{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:28px;}.clu-svc{display:flex;gap:16px;padding:24px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color .15s;align-items:flex-start;}.clu-svc:hover{border-color:var(--taas-yellow,#FFC800);}.clu-svc__body{flex:1;}.clu-svc__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:6px;}.clu-svc__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:8px;}.clu-svc__cta{font-size:13px;font-weight:700;color:var(--taas-yellow2,#e6b400);}
.clu-symptoms{list-style:none;padding:0;margin:0;max-width:700px;}.clu-symptoms li{display:flex;align-items:flex-start;gap:12px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;font-weight:300;color:#ccc;line-height:1.75;}.clu-symptoms li:last-child{border-bottom:none;}.clu-symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.clu-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:580px;}.clu-pricing__title{font-size:20px;font-weight:800;color:var(--taas-black,#111);margin-bottom:12px;}.clu-pricing__body{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.clu-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}.clu-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}.clu-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}.clu-finance__text strong{font-weight:700;color:var(--taas-black,#111);}.clu-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}.clu-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.clu-fin img{max-height:20px;width:auto;display:block;}.clu-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}.clu-finance__link:hover{text-decoration:underline;}
.clu-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}.clu-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}.clu-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.clu-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}.clu-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}.clu-enquiry__phone:hover{opacity:.65;}.clu-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;}.clu-enquiry__detail strong{color:#fff;font-weight:700;}.clu-enquiry__detail a{color:#aaa;text-decoration:underline;}.clu-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}.clu-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.clu-enquiry__badge img{max-height:18px;width:auto;display:block;}.clu-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.75;}.clu-enquiry__note strong{color:#fff;font-weight:700;}.clu-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.clu-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}.clu-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.clu-section--dark .wpcf7 label,.clu-section--dark .wpcf7 p,.clu-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}.clu-section--dark .wpcf7 input[type="text"],.clu-section--dark .wpcf7 input[type="email"],.clu-section--dark .wpcf7 input[type="tel"],.clu-section--dark .wpcf7 textarea,.clu-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}.clu-section--dark .wpcf7 input::placeholder,.clu-section--dark .wpcf7 textarea::placeholder{color:#666;}.clu-section--dark .wpcf7 input:focus,.clu-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}.clu-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}.clu-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.clu-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}.clu-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}.clu-related__link:hover{border-color:var(--taas-yellow,#FFC800);}.clu-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.clu-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}.clu-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}.clu-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}.clu-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}.clu-faq__item--open .clu-faq__q::after{content:'−';}.clu-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}.clu-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}.clu-faq__a a:hover{text-decoration:underline;}.clu-faq__item--open .clu-faq__a{display:block;}
.clu-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}.clu-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}.clu-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}.clu-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.clu-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}.clu-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}.clu-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}.clu-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}.clu-btn--dark:hover{background:#000;}.clu-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}.clu-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
@media(max-width:960px){.clu-hero__inner,.clu-enquiry{grid-template-columns:1fr;gap:32px;}.clu-sidebar{display:none;}.clu-services{grid-template-columns:1fr;}}
@media(max-width:640px){.clu-hero{padding:48px 0 40px;}.clu-hero h1{font-size:clamp(26px,7vw,38px);}.clu-hero__sub{font-size:14px;}.clu-section{padding:48px 0;}.clu-h2{font-size:clamp(22px,5vw,28px);}.clu-lead{font-size:14px;}.clu-content p,.clu-enquiry__list li,.clu-finance__text,.clu-pricing__body{font-size:14px;}.clu-svc__desc,.clu-symptoms li{font-size:13px;}.clu-trust__inner{gap:8px 20px;}.clu-trust__item{font-size:12px;}.clu-phonestrip__num{font-size:17px;}.clu-faq__q{font-size:14px;padding:16px 32px 16px 0;}.clu-faq__a{font-size:13px;}.clu-hero__ctas{flex-direction:column;align-items:stretch;}.clu-hero__ctas .clu-btn{justify-content:center;text-align:center;}.clu-enquiry{display:flex;flex-direction:column-reverse;}.clu-close{flex-direction:column;align-items:flex-start;}}
</style>

<nav class="clu-crumb" aria-label="Breadcrumb"><div class="clu-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="clu-crumb__sep">›</span><a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/'); ?>">Manukau Brake &amp; Clutch</a><span class="clu-crumb__sep">›</span><span class="clu-crumb__cur">Clutch Replacement</span></div></nav>

<section class="clu-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="clu-w"><div class="clu-hero__inner">
  <div>
    <span class="clu-eye clu-eye--yellow">Clutch — Manukau</span>
    <h1>Clutch Replacement<br>&amp; Repair <span>Manukau</span></h1>
    <p class="clu-hero__sub">Complete clutch kit replacement — disc, pressure plate, and release bearing together. Flywheel inspected and replaced if worn. We do not cut corners on clutch work. <?php echo esc_html($years); ?> years of workshop experience.</p>
    <div class="clu-hero__price">Clutch replacement <?php echo esc_html($clutch_price); ?></div>
    <div class="clu-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-btn clu-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#clu-enquire" class="clu-btn clu-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="clu-sidebar">
    <div class="clu-sidebar__title">At a Glance</div>
    <ul class="clu-sidebar__list"><li>Complete clutch kit</li><li>Flywheel inspected</li><li>DMF replacement available</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="clu-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="clu-phonestrip"><div class="clu-phonestrip__inner"><span class="clu-phonestrip__label">Clutch slipping, juddering, or burning?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<div class="clu-trust"><div class="clu-trust__inner"><div class="clu-trust__item">MTA Assured</div><div class="clu-trust__item">NZTA Authorised</div><div class="clu-trust__item">Complete Kit Always</div><div class="clu-trust__item">Estimate Before We Start</div><div class="clu-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="clu-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<section class="clu-section clu-section--white"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Understanding Clutch Replacement</span>
  <h2 class="clu-h2">Why We Replace the Clutch as a Complete Kit</h2>
  <div class="clu-content">
    <p>The clutch connects your engine to the gearbox. When you press the clutch pedal, the clutch disc separates from the flywheel, disconnecting engine power so you can change gears. When you release the pedal, the pressure plate clamps the disc back against the flywheel and power transfers to the wheels.</p>
    <p>The disc, pressure plate, and release bearing all wear together over the life of the clutch. The gearbox has to be removed to access any of them — and the labour is the same whether you replace one component or all three. Replacing the disc alone against a worn pressure plate means the new disc wears faster, and you pay the full labour cost again when the pressure plate fails six months later.</p>
    <p>We always replace the clutch as a complete kit. We also inspect the flywheel surface before reassembly — if it is worn, heat-damaged, or cracked, we replace it. A new clutch on a damaged flywheel will judder, slip early, and not last. On vehicles with dual-mass flywheels — common on European and many modern Japanese and Korean models — the flywheel cannot be repaired and must be replaced when it fails.</p>
  </div>
</div></section>

<section class="clu-section clu-section--grey"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Our Services</span>
  <h2 class="clu-h2">Clutch Services</h2>
  <div class="clu-services"><?php foreach ($services as $s): ?><a href="<?php echo esc_url($site_url.$s['url']); ?>" class="clu-svc"><div><?php echo clu_badge($s['badge']); ?></div><div class="clu-svc__body"><div class="clu-svc__title"><?php echo esc_html($s['title']); ?></div><div class="clu-svc__desc"><?php echo esc_html($s['desc']); ?></div><div class="clu-svc__cta"><?php echo esc_html($s['cta']); ?></div></div></a><?php endforeach; ?></div>
</div></section>

<section class="clu-section clu-section--dark"><div class="clu-w">
  <span class="clu-eye clu-eye--yellow">Warning Signs</span>
  <h2 class="clu-h2 clu-h2--white">Does This Sound Like Your Vehicle?</h2>
  <p class="clu-lead">A slipping clutch gets worse rapidly. The longer you drive on it, the more damage occurs to the flywheel and pressure plate — turning a clutch job into a significantly more expensive repair.</p>
  <ul class="clu-symptoms">
    <li>Slipping — engine revs rise but vehicle does not accelerate, especially under load or uphill</li>
    <li>Difficulty selecting gears — particularly first and reverse when cold</li>
    <li>High or changing bite point — pedal engages closer to the top of travel</li>
    <li>Juddering or vibration on take-off from a standstill</li>
    <li>Burning smell — especially in stop-start traffic or on hills</li>
    <li>Clutch pedal feels soft, spongy, or sticks to the floor</li>
    <li>Rattling or chattering noise with the clutch pedal released — dual-mass flywheel</li>
  </ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-btn clu-btn--primary" style="margin-top:28px;">Call <?php echo esc_html($phone_free); ?></a>
</div></section>

<section class="clu-section clu-section--white"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Pricing</span>
  <h2 class="clu-h2">How Much Does Clutch Replacement Cost?</h2>
  <p class="clu-lead">We always provide an estimate before starting any work — no surprises.</p>
  <div class="clu-pricing">
    <div class="clu-pricing__title">Clutch replacement <?php echo esc_html($clutch_price); ?></div>
    <div class="clu-pricing__body">Includes clutch disc, pressure plate, and release bearing as a complete kit. Flywheel replacement additional if required — we inspect and advise. Dual-mass flywheel replacement adds to the cost on European and some Asian vehicles. Call <?php echo esc_html($phone_free); ?> with your make and model.</div>
  </div>
</div></section>

<div class="clu-finance"><div class="clu-finance__inner">
  <div class="clu-finance__text"><strong>Finance available</strong> — a clutch replacement is a significant job. Don't delay.</div>
  <div class="clu-finance__logos"><?php foreach ($finance as $f): ?><span class="clu-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" class="clu-finance__link">View finance options →</a>
</div></div>

<section id="clu-enquire" class="clu-section clu-section--dark"><div class="clu-w"><div class="clu-enquiry">
  <div>
    <span class="clu-eye clu-eye--yellow">Book or Enquire</span>
    <h2 class="clu-h2 clu-h2--white">Clutch Replacement — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your vehicle make, model, and what symptoms you are noticing — slipping, juddering, burning smell, difficulty selecting gears. We will advise on next steps.</p>
    <ul class="clu-enquiry__list"><?php foreach (['Complete clutch kit — disc, pressure plate, release bearing','Written estimate before any work begins','Flywheel inspected and replaced if worn','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="clu-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="clu-enquiry__badges"><?php foreach ($finance as $f): ?><span class="clu-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="clu-enquiry__note"><strong>Estimate before we start.</strong> We confirm the price before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="clu-enquiry__form">
    <div class="clu-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="clu-section clu-section--white"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Customer Reviews</span>
  <h2 class="clu-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="clu-section clu-section--grey"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Related Services</span>
  <h2 class="clu-h2">Connected Services</h2>
  <div class="clu-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="clu-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<section class="clu-section clu-section--white"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">Common Questions</span>
  <h2 class="clu-h2">Clutch Replacement — FAQ</h2>
  <div class="clu-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="clu-faq__item<?php echo $i===0?' clu-faq__item--open':''; ?>"><button class="clu-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="clu-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="clu-a-<?php echo $i; ?>" class="clu-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<section class="clu-section clu-section--grey"><div class="clu-w">
  <span class="clu-eye clu-eye--dark">South Auckland</span>
  <h2 class="clu-h2">Clutch Replacement — Manukau</h2>
  <p class="clu-lead" style="margin-bottom:0;">Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="clu-close">
    <div class="clu-close__text">A slipping clutch gets worse every day you wait.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="clu-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="clu-btn clu-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#clu-enquire" class="clu-btn clu-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.clu-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.clu-faq__item');var wasOpen=item.classList.contains('clu-faq__item--open');document.querySelectorAll('.clu-faq__item--open').forEach(function(el){el.classList.remove('clu-faq__item--open');el.querySelector('.clu-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('clu-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
