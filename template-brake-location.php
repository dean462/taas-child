<?php
/**
 * Template Name: Brake Location
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
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

$suburb_name   = get_post_meta($post_id, 'suburb_name', true) ?: 'South Auckland';
$suburb_slug   = get_post_meta($post_id, 'suburb_slug', true) ?: '';
$distance_note = get_post_meta($post_id, 'distance_note', true) ?: '';

$page_slug = get_post_field('post_name', $post_id);

// ── Suburbs array ────────────────────────────────────────────────────────────
$suburbs = [
    ['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],
];

// ── EV services list ─────────────────────────────────────────────────────────
$brk_services = [
    ['label' => 'Pad & Rotor Replacement','url' => '/brake-pad-rotor-replacement-manukau/'],
    ['label' => 'Brake Fluid Service',    'url' => '/brake-fluid-service-manukau/'],
    ['label' => 'Calliper Repair',        'url' => '/brake-calliper-repair-manukau/'],
    ['label' => 'Drum Brakes & Shoes',    'url' => '/drum-brake-repair-manukau/'],
    ['label' => 'Handbrake Repair',       'url' => '/handbrake-repair-manukau/'],
    ['label' => 'Disc Skimming',          'url' => '/disc-skimming/'],
    ['label' => 'WOF Inspections',        'url' => '/wof/'],
    ['label' => 'Clutch Replacement',     'url' => '/clutch-replacement-manukau/'],
];

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'Do you do brake repairs for ' . $suburb_name . '?',
     'a' => 'Yes. Tony Allen Auto Service at 139 Cavendish Drive, Manukau is ' . ($distance_note ? $distance_note . ' from ' . $suburb_name : 'easily accessible from ' . $suburb_name) . '. We do all brake work — pad and rotor replacement, callipers, drums, brake fluid, handbrake, and disc skimming. All makes and models.'],
    ['q' => 'What brake services do you offer?',
     'a' => 'Pad and rotor replacement (always together — never pads only), brake fluid service, calliper repair, drum brakes and shoes, handbrake repair, and on-site disc skimming. WOF brake failures fixed and re-inspected on-site. NZTA Authorised.'],
    ['q' => 'How much do brake repairs cost?',
     'a' => 'Brake pad and rotor replacement starts from $380. Price varies by vehicle. We always provide an estimate before starting. Call ' . $phone_free . ' to discuss your vehicle.'],
    ['q' => 'Why don\'t you just replace brake pads?',
     'a' => 'New pads on a worn or grooved rotor will not bed in correctly. They wear unevenly, squeal, and the old groove pattern transfers into the new pads. We always pair new pads with rotor machining or replacement — it costs a little more but lasts significantly longer.'],
    ['q' => 'Can you fix WOF brake failures?',
     'a' => 'Yes — brakes are one of the most common WOF failure items. We repair the fault and re-inspect on-site. NZTA Authorised — you do not need to go elsewhere. Same-day where possible. Call ' . $phone_free . '.'],
    ['q' => 'Do you offer finance for brake repairs?',
     'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted.'],
    ['q' => 'Do you work on European vehicle brakes?',
     'a' => 'Yes. Our TAAS European division covers all European makes — electronic handbrakes, pad wear sensors, and specific rotor specifications. Call ' . $phone_free . ' for an estimate.'],
    ['q' => 'Where is Manukau Brake & Clutch?',
     'a' => '139 Cavendish Drive, Manukau, Auckland 2104. ' . ($distance_note ? ucfirst($distance_note) . ' from ' . $suburb_name . '. ' : '') . 'Open ' . $hours . '. Call ' . $phone_free . ' to book.'],
    ['q' => 'How long do brake repairs take?',
     'a' => 'A pad and rotor replacement is typically completed same-day. More complex work — calliper rebuilds, drum brake overhauls — may take longer. Walk-ins welcome mornings, booking recommended for brake work.'],
    ['q' => 'Do you offer disc skimming for ' . $suburb_name . ' customers?',
     'a' => 'Yes — we machine brake rotors on-site. Disc skimming removes grooves and scoring and restores a flat surface for new pads. Call ' . $phone_free . ' to book.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Brake Repairs','item'=>$site_url.'//brake-repairs-manukau/'],['@type'=>'ListItem','position'=>3,'name'=>'Brake Repairs Service ' . $suburb_name,'item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Brake repairs and servicing for ' . $suburb_name . ', South Auckland. Pad and rotor replacement, callipers, drums, brake fluid, handbrake — all makes. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'areaServed'=>$suburb_name,'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.brl-hero__sub','.brl-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-brake-location .site-content,.page-template-template-brake-location .entry-content,.page-template-template-brake-location .entry-header,.page-template-template-brake-location article,.page-template-template-brake-location #primary,.page-template-template-brake-location #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-brake-location{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}
:root{}

.brl-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.brl-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;text-align:center;}
.brl-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 60% at 50% 40%,rgba(255,200,0,.07) 0%,transparent 60%);pointer-events:none;}
.brl-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.brl-eye--green{background:rgba(255,200,0,.06);color:var(--taas-yellow,#FFC800);border:1px solid rgba(255,200,0,.25);}
.brl-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.brl-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 auto 16px;max-width:700px;}
.brl-hero h1 span{color:var(--taas-yellow,#FFC800);}
.brl-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 24px;line-height:1.75;}
.brl-hero__ctas{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.brl-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.brl-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.brl-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.brl-trust__item::before{content:'✓';font-weight:900;}
.brl-section{padding:var(--taas-sec-pad,72px) 0;}
.brl-section--white{background:var(--taas-white,#fff);}
.brl-section--grey{background:var(--taas-panel,#F7F7F5);}
.brl-section--dark{background:var(--taas-dark,#1A1A1A);}
.brl-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.brl-h2--white{color:var(--taas-white,#fff);}
.brl-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.75;}
.brl-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.75;}
.brl-content p{margin-bottom:16px;}
.brl-svc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.brl-svc-link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.brl-svc-link:hover{border-color:var(--taas-yellow,#FFC800);}
.brl-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.brl-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.brl-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}
.brl-enquiry__form .wpcf7-form label,.brl-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.brl-enquiry__form .wpcf7-form input[type="text"],.brl-enquiry__form .wpcf7-form input[type="email"],.brl-enquiry__form .wpcf7-form input[type="tel"],.brl-enquiry__form .wpcf7-form textarea,.brl-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.brl-enquiry__form .wpcf7-form input:focus,.brl-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.brl-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.brl-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.brl-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.brl-suburb-pill{display:inline-block;padding:6px 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:13px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}
.brl-suburb-pill:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.brl-suburb-pill--active{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:700;pointer-events:none;}
.brl-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.brl-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.brl-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.brl-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.brl-faq__item--open .brl-faq__q::after{content:'−';}
.brl-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.75;}
.brl-faq__item--open .brl-faq__a{display:block;}
.brl-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.brl-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.brl-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.brl-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.brl-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.brl-enquiry{grid-template-columns:1fr;}}
@media(max-width:640px){.brl-enquiry{display:flex;flex-direction:column-reverse;}.brl-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.brl-hero h1{font-size:clamp(26px,7vw,38px);}.brl-section{padding:var(--taas-sec-pad-m,48px) 0;}.brl-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.brl-trust__item{font-size:12px;}.brl-faq__q{font-size:14px;padding:16px 32px 16px 0;}.brl-faq__a{font-size:13px;}.brl-hero__ctas{flex-direction:column;align-items:stretch;}.brl-hero__ctas .brl-btn{justify-content:center;text-align:center;}}
</style>

<section class="brl-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="brl-w">
  <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'//brake-repairs-manukau/'); ?>" style="color:#555;text-decoration:none;">Brake Repairs</a><span style="margin:0 6px;">›</span><span style="color:#888;"><?php echo esc_html($suburb_name); ?></span></nav>
  <span class="brl-eye brl-eye--green">Brake Repairs — <?php echo esc_html($suburb_name); ?></span>
  <h1>Brake Repairs<br><span><?php echo esc_html($suburb_name); ?></span></h1>
  <p class="brl-hero__sub">Brake repairs and servicing for <?php echo esc_html($suburb_name); ?> drivers. All makes and models — Pad and rotor replacement, callipers, drums, brake fluid, handbrake. On-site disc skimming. <?php echo ($distance_note ? esc_html(ucfirst($distance_note)) . ' from ' . esc_html($suburb_name) . '. ' : ''); ?><?php echo esc_html($customers); ?> customers serviced.</p>
  <div class="brl-hero__ctas">
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="brl-btn brl-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
    <a href="#brl-enquire" class="brl-btn brl-btn--outline">Book Online</a>
  </div>
</div></section>

<div class="brl-trust" role="list"><div class="brl-trust__inner"><div class="brl-trust__item" role="listitem">MTA Assured</div><div class="brl-trust__item" role="listitem">NZTA Authorised</div><div class="brl-trust__item" role="listitem">On-Site Disc Skimming</div><div class="brl-trust__item" role="listitem">WOF Re-Inspection On-Site</div><div class="brl-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<section class="brl-section brl-section--white"><div class="brl-w">
  <span class="brl-eye brl-eye--dark">Brake Repairs — <?php echo esc_html($suburb_name); ?></span>
  <h2 class="brl-h2">Brake Repairs for <?php echo esc_html($suburb_name); ?> Drivers</h2>
  <div class="brl-content">
    <p>Tony Allen Auto Service at 139 Cavendish Drive, Manukau provides brake repairs and servicing for <?php echo esc_html($suburb_name); ?> and surrounding areas. <?php echo ($distance_note ? 'We are ' . esc_html($distance_note) . ' from ' . esc_html($suburb_name) . '. ' : ''); ?>We never fit pads only — new pads are always paired with rotor machining or replacement. On-site disc skimming available. Failed your WOF on brakes? We fix and re-inspect on-site — NZTA Authorised.</p>
    <p>Brake repairs start from $380 — pads plus rotor machining or replacement. Callipers, drums, brake fluid, and handbrake repairs also available. Finance accepted — Afterpay, Q Card, GEM Finance, Aotea Finance.</p>
    <p>For detailed information on our brake services, pricing, and the pads-only explanation, visit our <a href="<?php echo esc_url($site_url.'//brake-repairs-manukau/'); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;">brake repairs hub page</a>.</p>
  </div>
</div></section>

<section class="brl-section brl-section--grey"><div class="brl-w">
  <span class="brl-eye brl-eye--dark">Our Services</span>
  <h2 class="brl-h2">Brake Repairs Services Available</h2>
  <div class="brl-svc-grid"><?php foreach ($brk_services as $s): ?><a href="<?php echo esc_url($site_url.$s['url']); ?>" class="brl-svc-link"><?php echo esc_html($s['label']); ?><span style="color:var(--taas-yellow,#FFC800);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section id="brl-enquire" class="brl-section brl-section--dark"><div class="brl-w"><div class="brl-enquiry">
  <div>
    <span class="brl-eye brl-eye--green">Book Today</span>
    <h2 class="brl-h2 brl-h2--white">Brake Repairs Service — <span style="color:var(--taas-yellow,#FFC800);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.75;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="brl-enquiry__form">
    <div class="brl-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow,#FFC800);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow,#FFC800);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="brl-section brl-section--grey"><div class="brl-w">
  <span class="brl-eye brl-eye--dark">Other Areas</span>
  <h2 class="brl-h2">Brake Repairs Across South Auckland</h2>
  <div class="brl-suburb-pills"><?php foreach ($suburbs as $s): ?><a href="<?php echo esc_url($site_url.'/brake-repairs-'.$s['slug'].'/'); ?>" class="brl-suburb-pill<?php echo ($s['slug'] === $suburb_slug ? ' brl-suburb-pill--active' : ''); ?>"<?php echo ($s['slug'] === $suburb_slug ? ' aria-current="page"' : ''); ?>><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
</div></section>

<section class="brl-section brl-section--white"><div class="brl-w">
  <span class="brl-eye brl-eye--dark">Customer Reviews</span>
  <h2 class="brl-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="brl-section brl-section--grey"><div class="brl-w">
  <span class="brl-eye brl-eye--dark">Common Questions</span>
  <h2 class="brl-h2">Brake Repairs <?php echo esc_html($suburb_name); ?> — FAQ</h2>
  <div class="brl-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="brl-faq__item<?php echo $i===0?' brl-faq__item--open':''; ?>"><button class="brl-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="brl-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="brl-a-<?php echo $i; ?>" class="brl-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'//brake-repairs-manukau/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Brake Repairs</a></div>

<script>
(function(){document.querySelectorAll('.brl-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.brl-faq__item');var wasOpen=item.classList.contains('brl-faq__item--open');document.querySelectorAll('.brl-faq__item--open').forEach(function(el){el.classList.remove('brl-faq__item--open');el.querySelector('.brl-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('brl-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
