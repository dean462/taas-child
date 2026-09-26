<?php
/**
 * Template Name: Cambelt Location Spoke
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL pattern: /cambelt-replacement-[suburb]/
 * ACF fields: suburb_name, suburb_slug, distance_note, custom_faq_q1–q5
 * CSS namespace: .cbl
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
require_once get_stylesheet_directory() . '/taas-suburbs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$post_id        = get_the_ID();
$phone_local    = defined('TAAS_PHONE_LOCAL')     ? TAAS_PHONE_LOCAL     : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')      ? TAAS_PHONE_FREE      : '0800 100 876';
$email          = defined('TAAS_EMAIL')           ? TAAS_EMAIL           : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')           ? TAAS_HOURS           : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$rating         = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$reviews        = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$ms_number      = defined('TAAS_MS_NUMBER')       ? TAAS_MS_NUMBER       : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')       ? TAAS_CUSTOMERS       : '10,000+';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Suburb data ──────────────────────────────────────────────────────────────
$has_acf       = function_exists('get_field');
$suburb_name   = ($has_acf ? get_field('suburb_name') : null) ?: get_post_meta($post_id, 'suburb_name', true) ?: 'South Auckland';
$suburb_slug   = ($has_acf ? get_field('suburb_slug') : null) ?: get_post_meta($post_id, 'suburb_slug', true) ?: '';
$distance_note = ($has_acf ? get_field('distance_note') : null) ?: get_post_meta($post_id, 'distance_note', true) ?: '';
$sub           = function_exists('taas_suburb_data') ? taas_suburb_data($suburb_slug, $suburb_name) : null;

// ── Custom FAQs ──────────────────────────────────────────────────────────────
$custom_faqs = [];
for ($i = 1; $i <= 5; $i++) {
    $q = ($has_acf ? get_field("custom_faq_q{$i}") : null) ?: get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = ($has_acf ? get_field("custom_faq_a{$i}") : null) ?: get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => $q, 'a' => $a];
}

// ── Suburbs ──────────────────────────────────────────────────────────────────
$suburbs = [
    ['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],
    ['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],
    ['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],
    ['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],
    ['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],
    ['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],
    ['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],
    ['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],
];

// ── FAQs (10) ────────────────────────────────────────────────────────────────
$faqs = [];
if (function_exists('taas_suburb_coverage_faq')) {
    $faqs[] = taas_suburb_coverage_faq($suburb_slug, $suburb_name, 'a cambelt replacement', $phone_local);
}
$faqs[] = ['q' => "How much does a cambelt replacement cost near {$suburb_name}?", 'a' => "Cambelt costs vary significantly by make and model depending on access time and kit parts. We always confirm the cost before starting work. Call us on {$phone_free} with your make, model, and year for a same-day estimate."];
$faqs[] = ['q' => "How far is Tony Allen Auto Service from {$suburb_name}?", 'a' => $distance_note ? "We are at 139 Cavendish Drive, Manukau — {$distance_note}. Open {$hours}." : "Our workshop is at 139 Cavendish Drive, Manukau — a short drive from {$suburb_name}. Call us on {$phone_free} for directions."];
$faqs[] = ['q' => "Should I replace the water pump at the same time as the cambelt?", 'a' => "Yes — in almost all cases. The water pump is driven by the cambelt and is fully accessible during replacement, so the additional cost is small. If the water pump fails later, you pay full labour again. We include the water pump as standard in every cambelt kit."];
$faqs[] = ['q' => "My car has unknown service history — should I replace the cambelt?", 'a' => "Yes. If you do not know when the cambelt was last replaced, treat it as due regardless of the km on the odometer. A cambelt failure on an interference engine causes catastrophic damage — the cost of a new belt is always less than an engine rebuild."];
$faqs[] = ['q' => "What happens if a cambelt snaps while driving?", 'a' => "On an interference engine — which covers the majority of modern vehicles — a snapped cambelt causes the pistons and valves to collide. This typically results in bent valves, damaged pistons, and in severe cases a destroyed engine. This is why cambelt replacement is treated as urgent preventative maintenance."];
$faqs[] = ['q' => "Do you offer finance for cambelt replacement near {$suburb_name}?", 'a' => "Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. A cambelt replacement is not something to delay because of cost — finance means you can get it done now and pay over time. Call {$phone_free} to discuss."];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q' => "Do you work on European vehicle cambelts?", 'a' => "Yes. Our TAAS European division covers all European makes including Audi, BMW, Volkswagen, Peugeot, and Renault. European cambelt replacements are often more labour-intensive — we follow manufacturer procedures and use OE-quality parts."];
$faqs[] = ['q' => "How long does a cambelt replacement take?", 'a' => "Most cambelt replacements take between 4 and 8 hours depending on the vehicle. Some European engines require more access work. We advise on timing when you book and recommend planning for a full day. Walk-ins are welcome mornings — booking is recommended for cambelt work."];
$faqs[] = ['q' => "Where is your workshop?", 'a' => "139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}. Call {$phone_free} to book. We service all South Auckland suburbs including {$suburb_name}."];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq['a'])]]; }
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Cambelts & Water Pumps','item'=>$site_url.'/cambelts-and-water-pumps/'],
        ['@type'=>'ListItem','position'=>3,'name'=>"Cambelt Replacement {$suburb_name}",'item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>"Cambelt replacement near {$suburb_name}, South Auckland. Full kit — belt, water pump, idlers, tensioner. MTA Assured. NZTA Authorised. Established {$established}.",'telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>$suburb_name.', South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand']],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-cambelt-location .site-content,.page-template-template-cambelt-location .entry-content,.page-template-template-cambelt-location .entry-header,.page-template-template-cambelt-location article,.page-template-template-cambelt-location #primary,.page-template-template-cambelt-location #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-cambelt-location{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.cbl-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.cbl-hero{background:var(--taas-black,#111);padding:72px 0 60px;}
.cbl-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.cbl-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.cbl-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.cbl-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.cbl-hero h1 span{color:var(--taas-yellow,#FFC800);}
.cbl-hero__sub{font-size:16px;color:#aaa;max-width:580px;margin:0 0 20px;line-height:1.65;}
.cbl-hero__urgency{margin-top:20px;background:rgba(192,57,43,.12);border:1px solid rgba(192,57,43,.35);border-left:4px solid var(--taas-alert,#C0392B);border-radius:var(--taas-radius,6px);padding:12px 16px;font-size:13px;color:#f5a0a0;line-height:1.6;max-width:560px;}
.cbl-hero__urgency strong{color:#ff6b6b;}
.cbl-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.cbl-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.cbl-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.cbl-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.cbl-trust__item::before{content:'✓';font-weight:900;}
.cbl-section{padding:var(--taas-sec-pad,72px) 0;}
.cbl-section--white{background:var(--taas-white,#fff);}
.cbl-section--grey{background:var(--taas-panel,#F7F7F5);}
.cbl-section--dark{background:var(--taas-dark,#1A1A1A);}
.cbl-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.cbl-h2--white{color:var(--taas-white,#fff);}
.cbl-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.cbl-section--dark .cbl-lead{color:#aaa;}
.cbl-check-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;}
.cbl-check-list li{display:flex;align-items:flex-start;gap:12px;font-size:15px;color:var(--taas-body,#333);line-height:1.5;}
.cbl-check-list li::before{content:'✓';color:var(--taas-dark,#1A1A1A);background:var(--taas-yellow,#FFC800);font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.cbl-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.cbl-step{display:flex;align-items:flex-start;gap:16px;padding:16px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.cbl-step:last-child{border-bottom:none;}
.cbl-step__num{width:32px;height:32px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.cbl-step__text{font-size:15px;color:var(--taas-body,#333);line-height:1.5;}
.cbl-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.cbl-enquiry__form{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;}
.cbl-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:20px;}
.cbl-enquiry__form .wpcf7-form label,.cbl-enquiry__form .wpcf7-form p{color:var(--taas-body,#333)!important;font-size:13px;font-weight:600;}
.cbl-enquiry__form .wpcf7-form input[type="text"],.cbl-enquiry__form .wpcf7-form input[type="email"],.cbl-enquiry__form .wpcf7-form input[type="tel"],.cbl-enquiry__form .wpcf7-form textarea,.cbl-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.cbl-enquiry__form .wpcf7-form input:focus,.cbl-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.cbl-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.cbl-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.cbl-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.cbl-suburb-pill{display:inline-block;padding:7px 18px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:14px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}
.cbl-suburb-pill:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.cbl-suburb-pill--active{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:700;}
.cbl-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.cbl-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.cbl-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.cbl-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.cbl-faq__item--open .cbl-faq__q::after{content:'−';}
.cbl-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.cbl-faq__item--open .cbl-faq__a{display:block;}
.cbl-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.cbl-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.cbl-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.cbl-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.cbl-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.cbl-enquiry{grid-template-columns:1fr;gap:32px;}}
@media(max-width:640px){.cbl-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.cbl-hero h1{font-size:clamp(26px,7vw,38px);}.cbl-section{padding:var(--taas-sec-pad-m,48px) 0;}.cbl-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.cbl-trust__item{font-size:12px;}.cbl-faq__q{font-size:14px;padding:16px 32px 16px 0;}.cbl-faq__a{font-size:13px;}.cbl-hero__ctas{flex-direction:column;align-items:stretch;}.cbl-hero__ctas .cbl-btn{justify-content:center;text-align:center;}}
</style>

<!-- ── HERO ────────────────────────────────────────────────────────────────── -->
<section class="cbl-hero"><div class="cbl-w">
  <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/cambelts-and-water-pumps/'); ?>" style="color:#555;text-decoration:none;">Cambelts &amp; Water Pumps</a><span style="margin:0 6px;">›</span><span style="color:#888;"><?php echo esc_html($suburb_name); ?></span></nav>
  <span class="cbl-eye cbl-eye--yellow">Cambelt Replacement — <?php echo esc_html($suburb_name); ?></span>
  <h1>Cambelt Replacement<br><span>Near <?php echo esc_html($suburb_name); ?></span></h1>
  <p class="cbl-hero__sub">Full cambelt kit — belt, water pump, idlers, and tensioner. <?php if ($distance_note) echo esc_html($distance_note) . '. '; ?>All makes and models. Estimate before we start.</p>
  <div class="cbl-hero__ctas">
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbl-btn cbl-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
    <a href="#cbl-enquire" class="cbl-btn cbl-btn--outline">Book Online</a>
  </div>
  <div class="cbl-hero__urgency"><strong>⚠ Do not delay a cambelt replacement.</strong> A snapped cambelt on an interference engine causes immediate engine damage. The replacement cost is a fraction of an engine rebuild.</div>
</div></section>

<div class="cbl-trust" role="list"><div class="cbl-trust__inner"><div class="cbl-trust__item" role="listitem">MTA Assured</div><div class="cbl-trust__item" role="listitem">NZTA Authorised</div><div class="cbl-trust__item" role="listitem">Full Kit Approach</div><div class="cbl-trust__item" role="listitem">Estimate Before We Start</div><div class="cbl-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<!-- ── WHAT TO EXPECT ── White ─────────────────────────────────────────────── -->
<section class="cbl-section cbl-section--white"><div class="cbl-w">
  <span class="cbl-eye cbl-eye--dark">What to Expect</span>
  <h2 class="cbl-h2">Cambelt Replacement for <?php echo esc_html($suburb_name); ?> Drivers</h2>
  <div style="max-width:780px;font-size:16px;color:var(--taas-mid);line-height:1.7;margin-bottom:32px;">
    <p style="margin-bottom:16px;">Our workshop is at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a><?php if ($distance_note) echo ' — ' . esc_html($distance_note); ?>. We replace cambelts for customers from <?php echo esc_html($suburb_name); ?> and across South Auckland.</p>
    <p>Every cambelt replacement includes the full kit — belt, water pump, idler pulleys, and tensioner. Replacing only the belt and leaving original pulleys and water pump is a false economy — those components fail at the same interval and the labour to access them is already done.</p>
  </div>
  <ul class="cbl-check-list">
    <li>Full kit — belt, water pump, idlers, and tensioner replaced together</li>
    <li>Estimate before any work begins — no surprises</li>
    <li>Manufacturer intervals followed, or sooner if history is unknown</li>
    <li>All makes and models — Japanese, Korean, European</li>
    <li>Finance available — Afterpay, Q Card, GEM, Aotea</li>
  </ul>
  <p style="margin-top:24px;font-size:14px;color:var(--taas-mid);line-height:1.6;">For detailed interval information and technical guidance, see our <a href="<?php echo esc_url($site_url.'/cambelts-and-water-pumps/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">main cambelt page</a>.</p>
</div></section>

<!-- ── PROCESS ── Grey ─────────────────────────────────────────────────────── -->
<section class="cbl-section cbl-section--grey"><div class="cbl-w">
  <span class="cbl-eye cbl-eye--dark">Our Process</span>
  <h2 class="cbl-h2">How We Replace Cambelts</h2>
  <div class="cbl-steps"><?php foreach (['Check vehicle service history and confirm cambelt interval for your specific engine','Provide estimate — confirm cost before any work begins','Remove covers and access timing belt assembly','Replace cambelt, water pump, idler pulleys, and tensioner as a complete kit','Set timing marks and confirm correct operation','Road test and final inspection'] as $i => $step): ?>
    <div class="cbl-step"><div class="cbl-step__num"><?php echo $i+1; ?></div><div class="cbl-step__text"><?php echo esc_html($step); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── ENQUIRY ── White ────────────────────────────────────────────────────── -->
<section id="cbl-enquire" class="cbl-section cbl-section--white"><div class="cbl-w"><div class="cbl-enquiry">
  <div>
    <span class="cbl-eye cbl-eye--dark">Book Today</span>
    <h2 class="cbl-h2">Cambelt Replacement Near <span style="color:var(--taas-yellow2);"><?php echo esc_html($suburb_name); ?></span></h2>
    <p style="font-size:16px;color:var(--taas-mid);line-height:1.6;margin-bottom:16px;">Call us or fill in the form and we'll get back to you. Estimate provided before any work begins.</p>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin-bottom:6px;"><?php echo esc_html($phone_free); ?></a>
    <p style="font-size:15px;color:var(--taas-mid);line-height:1.7;"><strong style="color:var(--taas-black);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a></p>
  </div>
  <div class="cbl-enquiry__form">
    <div class="cbl-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;color:var(--taas-mid);">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-black);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-black);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ── SUBURBS ── Grey ─────────────────────────────────────────────────────── -->
<section class="cbl-section cbl-section--grey"><div class="cbl-w">
  <h2 class="cbl-h2">Cambelt Replacement — South Auckland Areas</h2>
  <p style="font-size:14px;color:var(--taas-mid);margin-bottom:16px;">Serving all South Auckland suburbs from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="cbl-suburb-pills"><?php foreach ($suburbs as $s): $is_current=($s['slug']===$suburb_slug); ?><a href="<?php echo esc_url($site_url.'/cambelt-replacement-'.$s['slug'].'/'); ?>" class="cbl-suburb-pill<?php echo $is_current?' cbl-suburb-pill--active':''; ?>"><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
</div></section>

<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="cbl-section cbl-section--white"><div class="cbl-w">
  <span class="cbl-eye cbl-eye--dark">Common Questions</span>
  <h2 class="cbl-h2">Cambelt FAQ — <?php echo esc_html($suburb_name); ?></h2>
  <div class="cbl-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="cbl-faq__item<?php echo $i===0?' cbl-faq__item--open':''; ?>"><button class="cbl-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="cbl-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="cbl-a-<?php echo $i; ?>" class="cbl-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── BACK LINK ──────────────────────────────────────────────────────────── -->
<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'/cambelts-and-water-pumps/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Cambelts &amp; Water Pumps</a></div>

<script>
(function(){document.querySelectorAll('.cbl-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.cbl-faq__item');var wasOpen=item.classList.contains('cbl-faq__item--open');document.querySelectorAll('.cbl-faq__item--open').forEach(function(el){el.classList.remove('cbl-faq__item--open');el.querySelector('.cbl-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('cbl-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
