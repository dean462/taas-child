<?php
/**
 * Template Name: EV Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Location spoke for 16 hybrid/EV suburb pages.
 * Suburb name and distance from post_meta.
 * CSS namespace: .evl (EV location)
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$post_id        = get_the_ID();
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

$suburb_name   = get_post_meta($post_id, 'suburb_name', true) ?: 'South Auckland';
$suburb_slug   = get_post_meta($post_id, 'suburb_slug', true) ?: '';
$distance_note = get_post_meta($post_id, 'distance_note', true) ?: '';

$page_slug = get_post_field('post_name', $post_id);

// ── Suburbs array ────────────────────────────────────────────────────────────
$suburbs = [
    ['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],
];

// ── EV services list ─────────────────────────────────────────────────────────
$ev_services = [
    ['label' => 'Hybrid Servicing',      'url' => '/hybrid-vehicle-servicing-manukau/'],
    ['label' => 'Electric Vehicle Service','url' => '/electric-vehicle-servicing-manukau/'],
    ['label' => 'Battery Health Check',   'url' => '/hybrid-battery-check-manukau/'],
    ['label' => 'PHEV Servicing',         'url' => '/phev-servicing-manukau/'],
    ['label' => 'EV Brake Service',       'url' => '/ev-brake-service-manukau/'],
    ['label' => 'WOF Inspections',        'url' => '/wof/'],
    ['label' => 'Tyres & Alignment',      'url' => '/tyre-centre/'],
    ['label' => 'Diagnostic Scanning',    'url' => '/diagnostic-scanning/'],
];

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'Do you service electric and hybrid vehicles from ' . $suburb_name . '?',
     'a' => 'Yes. Tony Allen Auto Service at 139 Cavendish Drive, Manukau is ' . ($distance_note ? $distance_note . ' from ' . $suburb_name : 'easily accessible from ' . $suburb_name) . '. We service all EV and hybrid types — BEV, HEV, PHEV, and MHEV — all makes and models.'],
    ['q' => 'What EV and hybrid services do you offer?',
     'a' => 'Hybrid and EV scheduled servicing, HV battery health checks, regenerative brake service, EV tyre supply and fitting, diagnostic scanning, WOF inspections, and all standard maintenance. Two of our technicians are completing EV-specific qualification training with HV system access.'],
    ['q' => 'Do I have to take my EV or hybrid to the dealer?',
     'a' => 'No. Once the factory warranty has expired, an independent workshop with the right equipment and training is entirely appropriate — and significantly more affordable. We carry the diagnostic tools for all EV and hybrid systems. Call ' . $phone_free . ' to discuss your vehicle.'],
    ['q' => 'Can you check my hybrid battery health?',
     'a' => 'Yes. We read HV battery cell data — individual cell voltages, state of charge balance, and capacity versus original specification — on Toyota, Nissan, Honda, and more. We advise what the data means for your vehicle and whether any action is needed.'],
    ['q' => 'How much does EV or hybrid servicing cost?',
     'a' => 'EV and hybrid servicing is comparable in cost to standard vehicle servicing. No engine oil on a BEV means fewer consumables. Contact us with your make, model, and year for a specific estimate. We always provide an estimate before starting any work. Call ' . $phone_free . '.'],
    ['q' => 'Do you offer finance for EV and hybrid repairs?',
     'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted.'],
    ['q' => 'What makes and models do you service?',
     'a' => 'All makes — Toyota, Nissan, Honda, Mitsubishi, Hyundai, Kia, BYD, MG, GWM/Haval, Volvo, BMW, Volkswagen, and more. The NZ EV market is changing fast — call ' . $phone_free . ' with your vehicle details.'],
    ['q' => 'Where is your workshop?',
     'a' => '139 Cavendish Drive, Manukau, Auckland 2104. ' . ($distance_note ? ucfirst($distance_note) . ' from ' . $suburb_name . '. ' : '') . 'Open ' . $hours . '. Call ' . $phone_free . ' to book.'],
    ['q' => 'Why does my EV still need brake fluid changes?',
     'a' => 'Brake fluid absorbs moisture from the air regardless of how often the brakes are physically used. Degraded fluid has a lower boiling point, causing brake fade under heavy braking. We change brake fluid at manufacturer intervals on all EV and hybrid models.'],
    ['q' => 'Can you source EV tyres for ' . $suburb_name . ' customers?',
     'a' => 'Yes. We source low rolling resistance tyres designed for EV weight and torque. Call ' . $phone_free . ' with your tyre size for availability and pricing.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'EV & Hybrid Servicing','item'=>$site_url.'/electric-hybrid-vehicle-servicing/'],['@type'=>'ListItem','position'=>3,'name'=>'EV & Hybrid Service ' . $suburb_name,'item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Electric and hybrid vehicle servicing for ' . $suburb_name . ', South Auckland. BEV, HEV, PHEV, MHEV — all makes. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'areaServed'=>$suburb_name,'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.evl-hero__sub','.evl-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-ev-location .site-content,.page-template-template-ev-location .entry-content,.page-template-template-ev-location .entry-header,.page-template-template-ev-location article,.page-template-template-ev-location #primary,.page-template-template-ev-location #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-ev-location{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}
:root{--ev-green:#4ade80;--ev-green-dim:rgba(74,222,128,.08);}

.evl-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.evl-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;text-align:center;}
.evl-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 60% at 50% 40%,rgba(74,222,128,.06) 0%,transparent 60%);pointer-events:none;}
.evl-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.evl-eye--green{background:var(--ev-green-dim);color:var(--ev-green);border:1px solid rgba(74,222,128,.2);}
.evl-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.evl-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 auto 16px;max-width:700px;}
.evl-hero h1 span{color:var(--ev-green);}
.evl-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 24px;line-height:1.65;}
.evl-hero__ctas{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.evl-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.evl-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.evl-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.evl-trust__item::before{content:'✓';font-weight:900;}
.evl-section{padding:var(--taas-sec-pad,72px) 0;}
.evl-section--white{background:var(--taas-white,#fff);}
.evl-section--grey{background:var(--taas-panel,#F7F7F5);}
.evl-section--dark{background:var(--taas-dark,#1A1A1A);}
.evl-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.evl-h2--white{color:var(--taas-white,#fff);}
.evl-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.evl-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.7;}
.evl-content p{margin-bottom:16px;}
.evl-svc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.evl-svc-link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.evl-svc-link:hover{border-color:var(--ev-green);}
.evl-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.evl-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.evl-enquiry__form-title{font-size:16px;font-weight:700;color:var(--ev-green);margin-bottom:20px;}
.evl-enquiry__form .wpcf7-form label,.evl-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.evl-enquiry__form .wpcf7-form input[type="text"],.evl-enquiry__form .wpcf7-form input[type="email"],.evl-enquiry__form .wpcf7-form input[type="tel"],.evl-enquiry__form .wpcf7-form textarea,.evl-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.evl-enquiry__form .wpcf7-form input:focus,.evl-enquiry__form .wpcf7-form textarea:focus{border-color:var(--ev-green);outline:none;}
.evl-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.evl-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.evl-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.evl-suburb-pill{display:inline-block;padding:6px 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:13px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}
.evl-suburb-pill:hover{background:var(--ev-green);border-color:var(--ev-green);color:var(--taas-dark,#1A1A1A);}
.evl-suburb-pill--active{background:var(--ev-green);border-color:var(--ev-green);color:var(--taas-dark,#1A1A1A);font-weight:700;pointer-events:none;}
.evl-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.evl-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.evl-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.evl-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.evl-faq__item--open .evl-faq__q::after{content:'−';}
.evl-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.evl-faq__item--open .evl-faq__a{display:block;}
.evl-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.evl-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.evl-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.evl-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.evl-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.evl-enquiry{grid-template-columns:1fr;}}
@media(max-width:640px){.evl-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.evl-hero h1{font-size:clamp(26px,7vw,38px);}.evl-section{padding:var(--taas-sec-pad-m,48px) 0;}.evl-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.evl-trust__item{font-size:12px;}.evl-faq__q{font-size:14px;padding:16px 32px 16px 0;}.evl-faq__a{font-size:13px;}.evl-hero__ctas{flex-direction:column;align-items:stretch;}.evl-hero__ctas .evl-btn{justify-content:center;text-align:center;}}
</style>

<section class="evl-hero"><div class="evl-w">
  <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/electric-hybrid-vehicle-servicing/'); ?>" style="color:#555;text-decoration:none;">EV &amp; Hybrid</a><span style="margin:0 6px;">›</span><span style="color:#888;"><?php echo esc_html($suburb_name); ?></span></nav>
  <span class="evl-eye evl-eye--green">EV &amp; Hybrid — <?php echo esc_html($suburb_name); ?></span>
  <h1>EV &amp; Hybrid Servicing<br><span><?php echo esc_html($suburb_name); ?></span></h1>
  <p class="evl-hero__sub">Electric and hybrid vehicle servicing for <?php echo esc_html($suburb_name); ?> drivers. All makes and models — BEV, HEV, PHEV, MHEV. HV-trained technicians. <?php echo ($distance_note ? esc_html(ucfirst($distance_note)) . ' from ' . esc_html($suburb_name) . '. ' : ''); ?><?php echo esc_html($customers); ?> customers serviced.</p>
  <div class="evl-hero__ctas">
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evl-btn evl-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
    <a href="#evl-enquire" class="evl-btn evl-btn--outline">Book Online</a>
  </div>
</div></section>

<div class="evl-trust" role="list"><div class="evl-trust__inner"><div class="evl-trust__item" role="listitem">MTA Assured</div><div class="evl-trust__item" role="listitem">NZTA Authorised</div><div class="evl-trust__item" role="listitem">HV-Trained Technicians</div><div class="evl-trust__item" role="listitem">All EV Types</div><div class="evl-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<section class="evl-section evl-section--white"><div class="evl-w">
  <span class="evl-eye evl-eye--dark">EV &amp; Hybrid — <?php echo esc_html($suburb_name); ?></span>
  <h2 class="evl-h2">EV &amp; Hybrid Servicing for <?php echo esc_html($suburb_name); ?> Drivers</h2>
  <div class="evl-content">
    <p>Tony Allen Auto Service at 139 Cavendish Drive, Manukau provides electric and hybrid vehicle servicing for <?php echo esc_html($suburb_name); ?> and surrounding areas. <?php echo ($distance_note ? 'We are ' . esc_html($distance_note) . ' from ' . esc_html($suburb_name) . '. ' : ''); ?>Two of our technicians are completing EV-specific qualification training with high-voltage system access — covering HV battery health assessments, inverter and drive motor diagnosis, and regenerative brake service.</p>
    <p>We service all EV and hybrid types: BEV (battery electric), HEV (full hybrid), PHEV (plug-in hybrid), and MHEV (mild hybrid). All makes — Japanese, Korean, European, and Chinese. You do not need to use the dealer once your factory warranty has expired. We carry the same diagnostic tools and follow the same service procedures — at a significantly lower cost.</p>
    <p>For detailed information on our EV and hybrid capability, vehicle coverage, and the dealer vs independent comparison, visit our <a href="<?php echo esc_url($site_url.'/electric-hybrid-vehicle-servicing/'); ?>" style="color:var(--ev-green);font-weight:600;">EV &amp; hybrid servicing hub page</a>.</p>
  </div>
</div></section>

<section class="evl-section evl-section--grey"><div class="evl-w">
  <span class="evl-eye evl-eye--dark">Our Services</span>
  <h2 class="evl-h2">EV &amp; Hybrid Services Available</h2>
  <div class="evl-svc-grid"><?php foreach ($ev_services as $s): ?><a href="<?php echo esc_url($site_url.$s['url']); ?>" class="evl-svc-link"><?php echo esc_html($s['label']); ?><span style="color:var(--ev-green);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<section id="evl-enquire" class="evl-section evl-section--dark"><div class="evl-w"><div class="evl-enquiry">
  <div>
    <span class="evl-eye evl-eye--green">Book Today</span>
    <h2 class="evl-h2 evl-h2--white">EV &amp; Hybrid Service — <span style="color:var(--ev-green);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="evl-enquiry__form">
    <div class="evl-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--ev-green);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--ev-green);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="evl-section evl-section--grey"><div class="evl-w">
  <span class="evl-eye evl-eye--dark">Other Areas</span>
  <h2 class="evl-h2">EV &amp; Hybrid Servicing Across South Auckland</h2>
  <div class="evl-suburb-pills"><?php foreach ($suburbs as $s): ?><a href="<?php echo esc_url($site_url.'/hybrid-vehicle-service-'.$s['slug'].'/'); ?>" class="evl-suburb-pill<?php echo ($s['slug'] === $suburb_slug ? ' evl-suburb-pill--active' : ''); ?>"<?php echo ($s['slug'] === $suburb_slug ? ' aria-current="page"' : ''); ?>><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
</div></section>

<section class="evl-section evl-section--white"><div class="evl-w">
  <span class="evl-eye evl-eye--dark">Customer Reviews</span>
  <h2 class="evl-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="evl-section evl-section--grey"><div class="evl-w">
  <span class="evl-eye evl-eye--dark">Common Questions</span>
  <h2 class="evl-h2">EV &amp; Hybrid Servicing <?php echo esc_html($suburb_name); ?> — FAQ</h2>
  <div class="evl-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="evl-faq__item<?php echo $i===0?' evl-faq__item--open':''; ?>"><button class="evl-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="evl-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="evl-a-<?php echo $i; ?>" class="evl-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'/electric-hybrid-vehicle-servicing/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to EV &amp; Hybrid Servicing</a></div>

<script>
(function(){document.querySelectorAll('.evl-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.evl-faq__item');var wasOpen=item.classList.contains('evl-faq__item--open');document.querySelectorAll('.evl-faq__item--open').forEach(function(el){el.classList.remove('evl-faq__item--open');el.querySelector('.evl-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('evl-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
