<?php
/**
 * Template Name: Transmission Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Shared template for 4 transmission sub-service pages:
 *   automatic-transmission-service-manukau, manual-gearbox-repair-manukau,
 *   cvt-transmission-service-manukau, transmission-fluid-change-manukau
 *
 * Content from master array + post_meta overrides.
 * CSS namespace: .tss (transmission sub-service)
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
$mech_diag      = defined('TAAS_MECH_DIAG')      ? TAAS_MECH_DIAG      : 'from $175';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Master services array ────────────────────────────────────────────────────
$tss_master = [
    'automatic-transmission-service-manukau' => [
        'name'    => 'Automatic Transmission Service',
        'badge'   => 'AT',
        'short'   => 'Fluid and filter service, solenoid replacement, torque converter diagnosis, and in-car repairs on conventional automatic transmissions. Full rebuilds arranged through specialist.',
        'price'   => 'Fluid service — contact for pricing · In-car repairs — estimate after diagnosis',
        'urgency' => 'medium',
    ],
    'manual-gearbox-repair-manukau' => [
        'name'    => 'Manual Gearbox Repair',
        'badge'   => 'MG',
        'short'   => 'Clutch replacement, synchro diagnosis, gear selection faults, gearbox oil service, and bearing replacement on manual transmissions.',
        'price'   => 'Gearbox repair — estimate after inspection. Clutch replacement — estimate by vehicle',
        'urgency' => 'medium',
    ],
    'cvt-transmission-service-manukau' => [
        'name'    => 'CVT Transmission Service',
        'badge'   => 'CV',
        'short'   => 'CVT fluid must be changed every 40,000 km — this is non-negotiable. Belt and pulley inspection, judder diagnosis, and valve body repair on all CVT-equipped vehicles.',
        'price'   => 'CVT fluid service — contact for pricing · Repair — estimate after diagnosis',
        'urgency' => 'high',
    ],
    'transmission-fluid-change-manukau' => [
        'name'    => 'Transmission Fluid Change',
        'badge'   => 'TF',
        'short'   => 'Drain-and-fill or machine exchange with the correct fluid specification for your transmission type — automatic, CVT, DSG, or manual gearbox oil.',
        'price'   => 'Transmission fluid change — contact for pricing. Fluid type depends on your vehicle',
        'urgency' => 'low',
    ],
];

$current = isset($tss_master[$page_slug]) ? $tss_master[$page_slug] : null;
if (!$current) { $current = ['name' => get_the_title(), 'badge' => 'TS', 'short' => '', 'price' => '', 'urgency' => 'medium']; }

$service_name  = $current['name'];
$badge         = $current['badge'];
$default_price = $current['price'];
$urgency_level = $current['urgency'];

// ── Post meta ────────────────────────────────────────────────────────────────
$what_it_is    = get_post_meta($post_id, 'what_it_is', true) ?: '';
$causes_raw    = get_post_meta($post_id, 'causes', true) ?: '';
$symptoms_raw  = get_post_meta($post_id, 'symptoms', true) ?: '';
$process_raw   = get_post_meta($post_id, 'our_process', true) ?: '';
$urgency_msg   = get_post_meta($post_id, 'urgency_message', true) ?: '';
$price_signal  = get_post_meta($post_id, 'price_signal', true) ?: $default_price;
$vehicles_note = get_post_meta($post_id, 'vehicles_note', true) ?: '';

$causes   = $causes_raw   ? array_filter(array_map('trim', explode('|', $causes_raw)))   : [];
$symptoms = $symptoms_raw  ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw   ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

// Custom FAQs
$custom_faqs = [];
for ($i = 1; $i <= 5; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => $q, 'a' => $a];
}

// ── Urgency colours ──────────────────────────────────────────────────────────
$uc_map = [
    'high'   => ['bg' => 'rgba(192,57,43,.12)', 'border' => 'var(--taas-alert, #C0392B)', 'text' => '#f5a0a0', 'label' => 'Urgent — Do Not Ignore'],
    'medium' => ['bg' => 'rgba(255,200,0,.08)', 'border' => 'var(--taas-yellow, #FFC800)', 'text' => 'var(--taas-yellow, #FFC800)', 'label' => 'Book Soon'],
    'low'    => ['bg' => 'rgba(255,255,255,.06)', 'border' => '#555', 'text' => '#aaa', 'label' => 'Preventative Maintenance'],
];
$uc = $uc_map[$urgency_level] ?? $uc_map['medium'];

// ── Cross-links ──────────────────────────────────────────────────────────────
$cross_links = [];
foreach ($tss_master as $slug => $svc) {
    if ($slug !== $page_slug) {
        $cross_links[] = ['label' => $svc['name'], 'url' => '/' . $slug . '/'];
    }
}
$cross_links[] = ['label' => 'Transmission Hub', 'url' => '/transmission-service-and-repair/'];
$cross_links[] = ['label' => 'Diagnostic Scanning', 'url' => '/diagnostic-scanning/'];
$cross_links[] = ['label' => 'Engine Repairs', 'url' => '/engine-repairs/'];
$cross_links[] = ['label' => 'Vehicle Servicing', 'url' => '/vehicle-servicing/'];
$cross_links[] = ['label' => 'TAAS European', 'url' => '/european/'];
$cross_links[] = ['label' => 'Finance Options', 'url' => '/finance-options/'];

// ── Build FAQs (minimum 10) ─────────────────────────────────────────────────
$faqs = [];
if ($what_it_is) { $faqs[] = ['q' => "What is {$service_name}?", 'a' => $what_it_is]; }
if ($causes_raw) { $faqs[] = ['q' => "What causes {$service_name} problems?", 'a' => implode('. ', $causes) . '.']; }
if ($symptoms_raw) { $faqs[] = ['q' => "How do I know if I need {$service_name}?", 'a' => 'Common signs include: ' . strtolower(implode('; ', $symptoms)) . '. If your vehicle is showing any of these, call us on ' . $phone_free . '.']; }
$faqs[] = ['q' => "How much does {$service_name} cost in Manukau?", 'a' => $price_signal . '. We always provide an estimate before starting any work. Call us on ' . $phone_free . ' with your vehicle details.'];
$faqs[] = ['q' => 'My transmission is slipping — is it safe to drive?', 'a' => 'No. A slipping transmission is actively destroying itself. The clutch packs overheat, the fluid breaks down, and debris circulates through the valve body and solenoids. What might be a minor repair today becomes a full rebuild next week. Stop driving and call us on ' . $phone_free . '.'];
$faqs[] = ['q' => 'Do you carry out full transmission rebuilds?', 'a' => 'Full rebuilds are carried out by a trusted transmission specialist. We diagnose the fault, remove the transmission, and manage the rebuild process on your behalf. This is the honest approach — a rebuild requires specialist tooling that a general workshop should not pretend to have.'];
$faqs[] = ['q' => 'Do you work on European vehicle transmissions?', 'a' => 'Yes. Our TAAS European division covers all European makes. ZF automatics, Aisin units, and VW/Audi DSG gearboxes have specific fluid requirements and service procedures that we follow to manufacturer specification.'];
$faqs[] = ['q' => 'Do you offer finance for transmission repairs?', 'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. Transmission repairs should not be delayed — the longer you wait, the more internal damage occurs.'];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q' => 'Where is your workshop?', 'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' to book.'];
if (count($faqs) < 10) { $faqs[] = ['q' => "How long does {$service_name} take?", 'a' => "Timing depends on the specific repair and vehicle. A fluid service is typically same-day. In-car repairs may take 1–2 days. Full rebuilds take longer — we advise on expected timeframe after diagnosis. Call " . $phone_free . "."]; }
if (count($faqs) < 10) { $faqs[] = ['q' => 'Is transmission failure covered by mechanical breakdown insurance?', 'a' => 'In most cases, yes. Transmission component failure is commonly covered under MBI. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. We handle MBI claims directly.']; }

// ── Badge helper ─────────────────────────────────────────────────────────────
function tss_badge($initials, $size = 40) {
    $fs = strlen($initials) > 2 ? 11 : 14;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Transmission Service & Repair','item'=>$site_url.'/transmission-service-and-repair/'],['@type'=>'ListItem','position'=>3,'name'=>$service_name,'item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>$service_name.' in Manukau, South Auckland. '.$current['short'].' MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.tss-hero__sub','.tss-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-transmission-sub .site-content,.page-template-template-transmission-sub .entry-content,.page-template-template-transmission-sub .entry-header,.page-template-template-transmission-sub article,.page-template-template-transmission-sub #primary,.page-template-template-transmission-sub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-transmission-sub{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.tss-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tss-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;}
.tss-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.07) 0%,transparent 65%);pointer-events:none;}
.tss-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.tss-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.tss-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.tss-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.tss-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.tss-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tss-hero__sub{font-size:16px;color:#aaa;max-width:560px;margin:0 0 20px;line-height:1.65;}
.tss-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.tss-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.tss-hero__urgency{margin-top:24px;border-radius:var(--taas-radius,6px);padding:14px 18px;font-size:14px;line-height:1.6;max-width:580px;}
.tss-sidebar{background:#1e1e1e;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.tss-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.tss-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.tss-sidebar__list li{font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.tss-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.tss-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.tss-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;}
.tss-sidebar__phone:hover{color:#fff;}
.tss-sidebar__detail{font-size:12px;color:#666;line-height:1.6;}
.tss-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.tss-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.tss-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.tss-trust__item::before{content:'✓';font-weight:900;}
.tss-section{padding:var(--taas-sec-pad,72px) 0;}
.tss-section--white{background:var(--taas-white,#fff);}
.tss-section--grey{background:var(--taas-panel,#F7F7F5);}
.tss-section--dark{background:var(--taas-dark,#1A1A1A);}
.tss-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.tss-h2--white{color:var(--taas-white,#fff);}
.tss-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.tss-section--dark .tss-lead{color:#aaa;}
.tss-content{max-width:780px;font-size:16px;color:var(--taas-mid,#666);line-height:1.7;}
.tss-content p{margin-bottom:16px;}
.tss-dual{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tss-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;}
.tss-list--causes li{display:flex;align-items:flex-start;gap:14px;padding:12px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;}
.tss-list--causes li:last-child{border-bottom:none;}
.tss-list--causes li::before{content:'—';color:var(--taas-yellow,#FFC800);font-weight:700;flex-shrink:0;}
.tss-list--symptoms li{display:flex;align-items:flex-start;gap:12px;padding:12px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;}
.tss-list--symptoms li:last-child{border-bottom:none;}
.tss-list--symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.tss-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.tss-step{display:flex;align-items:flex-start;gap:16px;padding:16px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tss-step:last-child{border-bottom:none;}
.tss-step__num{width:32px;height:32px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.tss-step__text{font-size:15px;color:var(--taas-body,#333);line-height:1.5;}
.tss-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:580px;}
.tss-pricing__signal{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:12px;}
.tss-pricing__body{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin-bottom:16px;}
.tss-pricing__finance{font-size:14px;color:var(--taas-body,#333);padding-top:16px;border-top:1px solid var(--taas-border,#E8E8E4);line-height:1.6;}
.tss-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tss-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.tss-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}
.tss-enquiry__form .wpcf7-form label,.tss-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.tss-enquiry__form .wpcf7-form input[type="text"],.tss-enquiry__form .wpcf7-form input[type="email"],.tss-enquiry__form .wpcf7-form input[type="tel"],.tss-enquiry__form .wpcf7-form textarea,.tss-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.tss-enquiry__form .wpcf7-form input:focus,.tss-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.tss-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.tss-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.tss-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.tss-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.tss-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.tss-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.tss-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tss-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.tss-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.tss-faq__item--open .tss-faq__q::after{content:'−';}
.tss-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.tss-faq__item--open .tss-faq__a{display:block;}
.tss-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.tss-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.tss-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.tss-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.tss-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.tss-hero__inner,.tss-dual,.tss-enquiry{grid-template-columns:1fr;}.tss-sidebar{display:none;}}
@media(max-width:640px){.tss-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.tss-hero h1{font-size:clamp(26px,7vw,38px);}.tss-section{padding:var(--taas-sec-pad-m,48px) 0;}.tss-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.tss-trust__item{font-size:12px;}.tss-faq__q{font-size:14px;padding:16px 32px 16px 0;}.tss-faq__a{font-size:13px;}.tss-hero__ctas{flex-direction:column;align-items:stretch;}.tss-hero__ctas .tss-btn{justify-content:center;text-align:center;}}
</style>

<section class="tss-hero"><div class="tss-w"><div class="tss-hero__inner">
  <div>
    <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/transmission-service-and-repair/'); ?>" style="color:#555;text-decoration:none;">Transmission</a><span style="margin:0 6px;">›</span><span style="color:#888;"><?php echo esc_html($service_name); ?></span></nav>
    <span class="tss-eye tss-eye--yellow">Transmission — Manukau</span>
    <h1><?php echo esc_html($service_name); ?><br><span>Manukau — South Auckland</span></h1>
    <p class="tss-hero__sub"><?php echo esc_html($current['short']); ?> <?php echo esc_html($years); ?> years of workshop experience. <?php echo esc_html($customers); ?> customers serviced.</p>
    <?php if ($price_signal): ?><div class="tss-hero__price"><?php echo esc_html($price_signal); ?></div><?php endif; ?>
    <div class="tss-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tss-btn tss-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#tss-enquire" class="tss-btn tss-btn--outline">Book Online</a>
    </div>
    <?php if ($urgency_msg): ?><div class="tss-hero__urgency" style="background:<?php echo $uc['bg']; ?>;border:1px solid <?php echo $uc['border']; ?>;border-left:4px solid <?php echo $uc['border']; ?>;color:<?php echo $uc['text']; ?>;"><strong style="color:<?php echo $uc['text']; ?>;">⚠ <?php echo esc_html($uc['label']); ?>:</strong> <?php echo esc_html($urgency_msg); ?></div><?php endif; ?>
  </div>
  <div class="tss-sidebar">
    <div class="tss-sidebar__title">At a Glance</div>
    <ul class="tss-sidebar__list"><li><?php echo esc_html($service_name); ?></li><li>Diagnose before we recommend</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tss-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="tss-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="tss-trust" role="list"><div class="tss-trust__inner"><div class="tss-trust__item" role="listitem">MTA Assured</div><div class="tss-trust__item" role="listitem">NZTA Authorised</div><div class="tss-trust__item" role="listitem">Diagnose First</div><div class="tss-trust__item" role="listitem">Estimate Before We Start</div><div class="tss-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<?php if ($what_it_is): ?>
<section class="tss-section tss-section--white"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Transmission</span>
  <h2 class="tss-h2">What Is <?php echo esc_html($service_name); ?>?</h2>
  <div class="tss-content"><?php foreach (array_filter(explode("\n", $what_it_is)) as $para): ?><p><?php echo wp_kses_post($para); ?></p><?php endforeach; ?></div>
  <?php if ($vehicles_note): ?><div style="border-left:4px solid var(--taas-yellow);background:#fffbea;padding:20px 24px;border-radius:0 var(--taas-radius) var(--taas-radius) 0;margin-top:24px;max-width:780px;"><div style="font-size:14px;font-weight:700;color:var(--taas-dark);margin-bottom:6px;">Vehicle-Specific Note</div><div style="font-size:14px;color:var(--taas-body);line-height:1.65;"><?php echo wp_kses_post($vehicles_note); ?></div></div><?php endif; ?>
</div></section>
<?php endif; ?>

<?php if ($causes || $symptoms): ?>
<section class="tss-section tss-section--dark"><div class="tss-w"><div class="tss-dual">
  <?php if ($causes): ?><div><span class="tss-eye tss-eye--yellow">Causes</span><h2 class="tss-h2 tss-h2--white">What Causes <?php echo esc_html($service_name); ?> Problems?</h2><ul class="tss-list tss-list--causes"><?php foreach ($causes as $c): ?><li><?php echo esc_html($c); ?></li><?php endforeach; ?></ul></div><?php endif; ?>
  <?php if ($symptoms): ?><div><span class="tss-eye tss-eye--yellow">Warning Signs</span><h2 class="tss-h2 tss-h2--white">Does This Sound Like Your Vehicle?</h2><ul class="tss-list tss-list--symptoms"><?php foreach ($symptoms as $s): ?><li><?php echo esc_html($s); ?></li><?php endforeach; ?></ul><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tss-btn tss-btn--primary" style="margin-top:24px;">Call <?php echo esc_html($phone_free); ?></a></div><?php endif; ?>
</div></div></section>
<?php endif; ?>

<?php if ($process): ?>
<section class="tss-section tss-section--grey"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Our Process</span>
  <h2 class="tss-h2">How We Handle <?php echo esc_html($service_name); ?></h2>
  <p class="tss-lead">We diagnose first — every time. No guesswork, no replacing parts on a hunch.</p>
  <div class="tss-steps"><?php foreach ($process as $i => $step): ?><div class="tss-step"><div class="tss-step__num"><?php echo $i+1; ?></div><div class="tss-step__text"><?php echo esc_html($step); ?></div></div><?php endforeach; ?></div>
</div></section>
<?php endif; ?>

<section class="tss-section tss-section--white"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Pricing</span>
  <h2 class="tss-h2">How Much Does <?php echo esc_html($service_name); ?> Cost?</h2>
  <p class="tss-lead">We always provide an estimate before starting any work — no surprises.</p>
  <div class="tss-pricing">
    <div class="tss-pricing__signal"><?php echo esc_html($price_signal); ?></div>
    <div class="tss-pricing__body">Price varies by vehicle make, model, and transmission type. Call <?php echo esc_html($phone_free); ?> with your vehicle details for an estimate.</div>
    <div class="tss-pricing__finance"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">View finance options →</a></div>
  </div>
</div></section>

<section id="tss-enquire" class="tss-section tss-section--dark"><div class="tss-w"><div class="tss-enquiry">
  <div>
    <span class="tss-eye tss-eye--yellow">Book Today</span>
    <h2 class="tss-h2 tss-h2--white"><?php echo esc_html($service_name); ?> — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="tss-enquiry__form">
    <div class="tss-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="tss-section tss-section--grey"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Related Services</span>
  <h2 class="tss-h2">Other Transmission &amp; Related Services</h2>
  <div class="tss-related__grid"><?php foreach ($cross_links as $cl): ?><a href="<?php echo esc_url($site_url.$cl['url']); ?>" class="tss-related__link"><?php echo esc_html($cl['label']); ?><span style="color:var(--taas-yellow);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<section class="tss-section tss-section--white"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Customer Reviews</span>
  <h2 class="tss-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="tss-section tss-section--grey"><div class="tss-w">
  <span class="tss-eye tss-eye--dark">Common Questions</span>
  <h2 class="tss-h2"><?php echo esc_html($service_name); ?> — FAQ</h2>
  <div class="tss-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="tss-faq__item<?php echo $i===0?' tss-faq__item--open':''; ?>"><button class="tss-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="tss-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="tss-a-<?php echo $i; ?>" class="tss-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'/transmission-service-and-repair/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Transmission Service &amp; Repair</a></div>

<script>
(function(){document.querySelectorAll('.tss-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.tss-faq__item');var wasOpen=item.classList.contains('tss-faq__item--open');document.querySelectorAll('.tss-faq__item--open').forEach(function(el){el.classList.remove('tss-faq__item--open');el.querySelector('.tss-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('tss-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
