<?php
/**
 * Template Name: EV Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Shared template for 5 EV/Hybrid sub-service pages:
 *   hybrid-vehicle-servicing-manukau, electric-vehicle-servicing-manukau,
 *   hybrid-battery-check-manukau, phev-servicing-manukau, ev-brake-service-manukau
 *
 * CSS namespace: .evs (EV sub-service)
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$post_id        = get_the_ID();
$page_slug      = get_post_field('post_name', $post_id);
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
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Master array ─────────────────────────────────────────────────────────────
$evs_master = [
    'hybrid-vehicle-servicing-manukau' => [
        'name'    => 'Hybrid Vehicle Servicing',
        'badge'   => 'HV',
        'short'   => 'Scheduled servicing for all hybrid types — HEV, PHEV, MHEV. Oil, filters, brakes, coolant, and hybrid-specific system checks. Dealer alternative.',
        'price'   => 'Hybrid service — contact for pricing based on your make and model',
        'urgency' => 'low',
    ],
    'electric-vehicle-servicing-manukau' => [
        'name'    => 'Electric Vehicle Servicing',
        'badge'   => 'EV',
        'short'   => 'BEV service — brake fluid, coolant, cabin filter, tyres, suspension, 12V battery, and full diagnostic health check. No engine oil required.',
        'price'   => 'EV service — contact for pricing based on your make and model',
        'urgency' => 'low',
    ],
    'hybrid-battery-check-manukau' => [
        'name'    => 'Hybrid Battery Health Check',
        'badge'   => 'BC',
        'short'   => 'HV battery health assessment — individual cell voltages, state of charge balance, capacity vs original specification. Know the true condition of your battery.',
        'price'   => 'Battery health check — contact for pricing',
        'urgency' => 'medium',
    ],
    'phev-servicing-manukau' => [
        'name'    => 'PHEV Servicing',
        'badge'   => 'PH',
        'short'   => 'Plug-in hybrid service covers both the petrol engine schedule and EV-specific components. Two systems in one vehicle — both need maintaining.',
        'price'   => 'PHEV service — contact for pricing based on your make and model',
        'urgency' => 'low',
    ],
    'ev-brake-service-manukau' => [
        'name'    => 'EV Brake Service',
        'badge'   => 'EB',
        'short'   => 'Regenerative braking means the physical brakes are used less — but brake fluid still degrades, callipers seize, and pads need checking. EV brakes need a different service approach.',
        'price'   => 'EV brake service — contact for pricing',
        'urgency' => 'medium',
    ],
];

$current = isset($evs_master[$page_slug]) ? $evs_master[$page_slug] : null;
if (!$current) { $current = ['name' => get_the_title(), 'badge' => 'EV', 'short' => '', 'price' => '', 'urgency' => 'low']; }

$service_name  = $current['name'];
$badge         = $current['badge'];
$default_price = $current['price'];
$urgency_level = $current['urgency'];

// ── Post meta ────────────────────────────────────────────────────────────────
$what_it_is    = get_post_meta($post_id, 'what_it_is', true) ?: '';
$includes_raw  = get_post_meta($post_id, 'service_includes', true) ?: '';
$symptoms_raw  = get_post_meta($post_id, 'symptoms', true) ?: '';
$process_raw   = get_post_meta($post_id, 'our_process', true) ?: '';
$price_signal  = get_post_meta($post_id, 'price_signal', true) ?: $default_price;
$vehicles_note = get_post_meta($post_id, 'vehicles_note', true) ?: '';

$includes = $includes_raw ? array_filter(array_map('trim', explode('|', $includes_raw))) : [];
$symptoms = $symptoms_raw ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw  ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

$custom_faqs = [];
for ($i = 1; $i <= 5; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => $q, 'a' => $a];
}

// ── Cross-links ──────────────────────────────────────────────────────────────
$cross_links = [];
foreach ($evs_master as $slug => $svc) {
    if ($slug !== $page_slug) { $cross_links[] = ['label' => $svc['name'], 'url' => '/' . $slug . '/']; }
}
$cross_links[] = ['label' => 'EV & Hybrid Hub', 'url' => '/electric-hybrid-vehicle-servicing/'];
$cross_links[] = ['label' => 'Vehicle Servicing', 'url' => '/vehicle-servicing/'];
$cross_links[] = ['label' => 'WOF Inspections', 'url' => '/wof/'];
$cross_links[] = ['label' => 'Tyres & Alignment', 'url' => '/tyre-centre/'];
$cross_links[] = ['label' => 'Diagnostic Scanning', 'url' => '/diagnostic-scanning/'];
$cross_links[] = ['label' => 'Finance Options', 'url' => '/finance-options/'];

// ── Build FAQs (minimum 10) ─────────────────────────────────────────────────
$faqs = [];
if ($what_it_is) { $faqs[] = ['q' => "What is {$service_name}?", 'a' => $what_it_is]; }
if ($includes_raw) { $faqs[] = ['q' => "What is included in {$service_name}?", 'a' => 'The service includes: ' . strtolower(implode('; ', $includes)) . '. Call ' . $phone_free . ' for pricing on your specific vehicle.']; }
if ($symptoms_raw) { $faqs[] = ['q' => "How do I know if I need {$service_name}?", 'a' => 'Signs to look for: ' . strtolower(implode('; ', $symptoms)) . '. If your vehicle is showing any of these, call us on ' . $phone_free . '.']; }
$faqs[] = ['q' => "How much does {$service_name} cost in Manukau?", 'a' => $price_signal . '. We always provide an estimate before starting any work. Call us on ' . $phone_free . ' with your make, model, and year.'];
$faqs[] = ['q' => 'Do I have to go to the dealer for EV or hybrid servicing?', 'a' => 'No. Once the factory warranty has expired, any qualified workshop with the right equipment and training can service your vehicle. We carry the diagnostic tools for all EV and hybrid systems. Our technicians are completing EV-specific qualification training. Call ' . $phone_free . ' to discuss your vehicle.'];
$faqs[] = ['q' => 'Can you work on the high-voltage battery system?', 'a' => 'Yes. Two of our technicians are trained in HV systems. We carry out battery health assessments, read individual cell data, diagnose HV system faults, and carry out in-car repairs on HV components.'];
$faqs[] = ['q' => 'Do you offer finance for EV and hybrid servicing?', 'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted.'];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q' => 'Where is your workshop?', 'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' to book.'];
if (count($faqs) < 10) { $faqs[] = ['q' => "How long does {$service_name} take?", 'a' => "Timing depends on the vehicle and service scope. Most routine EV and hybrid services are completed same-day. We advise on expected timeframe when you book. Call " . $phone_free . "."]; }
if (count($faqs) < 10) { $faqs[] = ['q' => 'What EV and hybrid models do you work on?', 'a' => 'All makes — Japanese, Korean, European, and Chinese. Toyota, Nissan, Honda, Mitsubishi, Hyundai, Kia, BYD, MG, GWM, Volvo, BMW, Volkswagen, and more. Call ' . $phone_free . ' with your vehicle details.']; }
if (count($faqs) < 10) { $faqs[] = ['q' => 'Why does my EV still need brake fluid changes?', 'a' => 'Brake fluid absorbs moisture from the air regardless of how often the brakes are physically used. Degraded brake fluid has a lower boiling point, causing brake fade under heavy braking. We change brake fluid to manufacturer intervals on all hybrid and EV models.']; }

// ── Badge helper ─────────────────────────────────────────────────────────────
function evs_badge($initials, $size = 40) {
    $fs = strlen($initials) > 2 ? 11 : 14;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#4ade80" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'EV & Hybrid Servicing','item'=>$site_url.'/electric-hybrid-vehicle-servicing/'],['@type'=>'ListItem','position'=>3,'name'=>$service_name,'item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>$service_name.' in Manukau, South Auckland. '.$current['short'].' MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.evs-hero__sub','.evs-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-ev-sub-service .site-content,.page-template-template-ev-sub-service .entry-content,.page-template-template-ev-sub-service .entry-header,.page-template-template-ev-sub-service article,.page-template-template-ev-sub-service #primary,.page-template-template-ev-sub-service #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-ev-sub-service{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}
:root{--ev-green:#4ade80;--ev-green-dim:rgba(74,222,128,.08);}

.evs-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.evs-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;}
.evs-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(74,222,128,.06) 0%,transparent 65%);pointer-events:none;}
.evs-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.evs-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.evs-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.evs-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.evs-eye--green{background:var(--ev-green-dim);color:var(--ev-green);border:1px solid rgba(74,222,128,.2);}
.evs-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.evs-hero h1 span{color:var(--ev-green);}
.evs-hero__sub{font-size:16px;color:#aaa;max-width:560px;margin:0 0 20px;line-height:1.65;}
.evs-hero__price{display:inline-block;background:var(--ev-green-dim);border:1px solid rgba(74,222,128,.2);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:600;color:var(--ev-green);margin-bottom:24px;}
.evs-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.evs-sidebar{background:#1e1e1e;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.evs-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ev-green);margin-bottom:14px;}
.evs-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.evs-sidebar__list li{font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.evs-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--ev-green);font-weight:700;}
.evs-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.evs-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;}
.evs-sidebar__phone:hover{color:#fff;}
.evs-sidebar__detail{font-size:12px;color:#666;line-height:1.6;}
.evs-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.evs-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.evs-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.evs-trust__item::before{content:'✓';font-weight:900;}
.evs-section{padding:var(--taas-sec-pad,72px) 0;}
.evs-section--white{background:var(--taas-white,#fff);}
.evs-section--grey{background:var(--taas-panel,#F7F7F5);}
.evs-section--dark{background:var(--taas-dark,#1A1A1A);}
.evs-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.evs-h2--white{color:var(--taas-white,#fff);}
.evs-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.evs-section--dark .evs-lead{color:#aaa;}
.evs-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.7;}
.evs-content p{margin-bottom:16px;}
.evs-includes{display:grid;grid-template-columns:1fr 1fr;gap:8px 32px;max-width:700px;list-style:none;padding:0;margin:28px 0 0;}
.evs-includes li{display:flex;gap:10px;font-size:14px;color:var(--taas-body,#333);line-height:1.5;padding:8px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.evs-includes li::before{content:'⚡';color:var(--ev-green);flex-shrink:0;}
.evs-symptoms li{display:flex;align-items:flex-start;gap:12px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;list-style:none;}
.evs-symptoms li:last-child{border-bottom:none;}
.evs-symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.evs-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.evs-step{display:flex;align-items:flex-start;gap:16px;padding:16px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.evs-step:last-child{border-bottom:none;}
.evs-step__num{width:32px;height:32px;background:var(--ev-green);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.evs-step__text{font-size:15px;color:var(--taas-body,#333);line-height:1.5;}
.evs-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:580px;}
.evs-pricing__signal{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:12px;}
.evs-pricing__body{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin-bottom:16px;}
.evs-pricing__finance{font-size:14px;color:var(--taas-body,#333);padding-top:16px;border-top:1px solid var(--taas-border,#E8E8E4);line-height:1.6;}
.evs-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.evs-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.evs-enquiry__form-title{font-size:16px;font-weight:700;color:var(--ev-green);margin-bottom:20px;}
.evs-enquiry__form .wpcf7-form label,.evs-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.evs-enquiry__form .wpcf7-form input[type="text"],.evs-enquiry__form .wpcf7-form input[type="email"],.evs-enquiry__form .wpcf7-form input[type="tel"],.evs-enquiry__form .wpcf7-form textarea,.evs-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.evs-enquiry__form .wpcf7-form input:focus,.evs-enquiry__form .wpcf7-form textarea:focus{border-color:var(--ev-green);outline:none;}
.evs-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.evs-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.evs-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.evs-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.evs-related__link:hover{border-color:var(--ev-green);}
.evs-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.evs-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.evs-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.evs-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.evs-faq__item--open .evs-faq__q::after{content:'−';}
.evs-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.evs-faq__item--open .evs-faq__a{display:block;}
.evs-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.evs-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.evs-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.evs-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.evs-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.evs-hero__inner,.evs-enquiry{grid-template-columns:1fr;}.evs-sidebar{display:none;}.evs-includes{grid-template-columns:1fr;}}
@media(max-width:640px){.evs-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.evs-hero h1{font-size:clamp(26px,7vw,38px);}.evs-section{padding:var(--taas-sec-pad-m,48px) 0;}.evs-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.evs-trust__item{font-size:12px;}.evs-faq__q{font-size:14px;padding:16px 32px 16px 0;}.evs-faq__a{font-size:13px;}.evs-hero__ctas{flex-direction:column;align-items:stretch;}.evs-hero__ctas .evs-btn{justify-content:center;text-align:center;}}
</style>

<section class="evs-hero"><div class="evs-w"><div class="evs-hero__inner">
  <div>
    <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/electric-hybrid-vehicle-servicing/'); ?>" style="color:#555;text-decoration:none;">EV &amp; Hybrid</a><span style="margin:0 6px;">›</span><span style="color:#888;"><?php echo esc_html($service_name); ?></span></nav>
    <span class="evs-eye evs-eye--green">EV &amp; Hybrid — Manukau</span>
    <h1><?php echo esc_html($service_name); ?><br><span>Manukau — South Auckland</span></h1>
    <p class="evs-hero__sub"><?php echo esc_html($current['short']); ?> <?php echo esc_html($years); ?> years of workshop experience. <?php echo esc_html($customers); ?> customers serviced.</p>
    <?php if ($price_signal): ?><div class="evs-hero__price"><?php echo esc_html($price_signal); ?></div><?php endif; ?>
    <div class="evs-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evs-btn evs-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#evs-enquire" class="evs-btn evs-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="evs-sidebar">
    <div class="evs-sidebar__title">At a Glance</div>
    <ul class="evs-sidebar__list"><li><?php echo esc_html($service_name); ?></li><li>HV-trained technicians</li><li>Diagnose before we recommend</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evs-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="evs-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="evs-trust" role="list"><div class="evs-trust__inner"><div class="evs-trust__item" role="listitem">MTA Assured</div><div class="evs-trust__item" role="listitem">NZTA Authorised</div><div class="evs-trust__item" role="listitem">HV-Trained Technicians</div><div class="evs-trust__item" role="listitem">Estimate Before We Start</div><div class="evs-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<?php if ($what_it_is): ?>
<section class="evs-section evs-section--white"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">EV &amp; Hybrid</span>
  <h2 class="evs-h2">What Is <?php echo esc_html($service_name); ?>?</h2>
  <div class="evs-content"><?php foreach (array_filter(explode("\n", $what_it_is)) as $para): ?><p><?php echo wp_kses_post($para); ?></p><?php endforeach; ?></div>
  <?php if ($vehicles_note): ?><div style="border-left:4px solid var(--ev-green);background:var(--ev-green-dim);padding:20px 24px;border-radius:0 var(--taas-radius) var(--taas-radius) 0;margin-top:24px;max-width:780px;"><div style="font-size:14px;font-weight:700;color:var(--taas-dark);margin-bottom:6px;">Vehicle-Specific Note</div><div style="font-size:14px;color:var(--taas-body);line-height:1.65;"><?php echo wp_kses_post($vehicles_note); ?></div></div><?php endif; ?>
</div></section>
<?php endif; ?>

<?php if ($includes): ?>
<section class="evs-section evs-section--grey"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">What's Included</span>
  <h2 class="evs-h2"><?php echo esc_html($service_name); ?> Includes</h2>
  <ul class="evs-includes"><?php foreach ($includes as $item): ?><li><?php echo esc_html($item); ?></li><?php endforeach; ?></ul>
</div></section>
<?php endif; ?>

<?php if ($symptoms): ?>
<section class="evs-section evs-section--dark"><div class="evs-w">
  <span class="evs-eye evs-eye--yellow">Warning Signs</span>
  <h2 class="evs-h2 evs-h2--white">Does This Sound Like Your Vehicle?</h2>
  <ul class="evs-symptoms" style="max-width:700px;"><?php foreach ($symptoms as $s): ?><li><?php echo esc_html($s); ?></li><?php endforeach; ?></ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evs-btn evs-btn--primary" style="margin-top:24px;">Call <?php echo esc_html($phone_free); ?></a>
</div></section>
<?php endif; ?>

<?php if ($process): ?>
<section class="evs-section evs-section--grey"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">Our Process</span>
  <h2 class="evs-h2">How We Handle <?php echo esc_html($service_name); ?></h2>
  <div class="evs-steps"><?php foreach ($process as $i => $step): ?><div class="evs-step"><div class="evs-step__num"><?php echo $i+1; ?></div><div class="evs-step__text"><?php echo esc_html($step); ?></div></div><?php endforeach; ?></div>
</div></section>
<?php endif; ?>

<section class="evs-section evs-section--white"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">Pricing</span>
  <h2 class="evs-h2">How Much Does <?php echo esc_html($service_name); ?> Cost?</h2>
  <div class="evs-pricing">
    <div class="evs-pricing__signal"><?php echo esc_html($price_signal); ?></div>
    <div class="evs-pricing__body">Price varies by vehicle make, model, and year. Call <?php echo esc_html($phone_free); ?> with your vehicle details for an estimate.</div>
    <div class="evs-pricing__finance"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--ev-green);font-weight:600;">View finance options →</a></div>
  </div>
</div></section>

<section id="evs-enquire" class="evs-section evs-section--dark"><div class="evs-w"><div class="evs-enquiry">
  <div>
    <span class="evs-eye evs-eye--yellow">Book Today</span>
    <h2 class="evs-h2 evs-h2--white"><?php echo esc_html($service_name); ?> — <span style="color:var(--ev-green);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="evs-enquiry__form">
    <div class="evs-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--ev-green);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--ev-green);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="evs-section evs-section--grey"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">Related Services</span>
  <h2 class="evs-h2">Other EV &amp; Hybrid Services</h2>
  <div class="evs-related__grid"><?php foreach ($cross_links as $cl): ?><a href="<?php echo esc_url($site_url.$cl['url']); ?>" class="evs-related__link"><?php echo esc_html($cl['label']); ?><span style="color:var(--ev-green);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<section class="evs-section evs-section--white"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">Customer Reviews</span>
  <h2 class="evs-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="evs-section evs-section--grey"><div class="evs-w">
  <span class="evs-eye evs-eye--dark">Common Questions</span>
  <h2 class="evs-h2"><?php echo esc_html($service_name); ?> — FAQ</h2>
  <div class="evs-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="evs-faq__item<?php echo $i===0?' evs-faq__item--open':''; ?>"><button class="evs-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="evs-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="evs-a-<?php echo $i; ?>" class="evs-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'/electric-hybrid-vehicle-servicing/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to EV &amp; Hybrid Servicing</a></div>

<script>
(function(){document.querySelectorAll('.evs-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.evs-faq__item');var wasOpen=item.classList.contains('evs-faq__item--open');document.querySelectorAll('.evs-faq__item--open').forEach(function(el){el.classList.remove('evs-faq__item--open');el.querySelector('.evs-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('evs-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
