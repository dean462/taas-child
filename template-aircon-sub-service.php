<?php
/**
 * Template Name: Air Conditioning Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Serves 5 AC sub-service pages: regas, diagnosis, repair, cabin filter, climate control.
 * Content from post_meta (set via runner). Cross-links auto-generated.
 * CSS namespace: .acs-
 *
 * Built June 2026 — full design system compliance
 * Section order: Hero → Trust → What is it → Causes → Process → Pricing → Enquiry → Related → Reviews → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$post_id       = get_the_ID();
$page_slug     = get_post_field('post_name', $post_id);
$phone_free    = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$email         = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established   = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating        = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews       = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$customers     = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$aircon_price  = defined('TAAS_AIRCON_PRICE')  ? TAAS_AIRCON_PRICE  : 'from $280';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$years         = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Master services array ────────────────────────────────────────────────────
$ac_master = [
    'air-conditioning-regas-manukau' => ['name'=>'Air Conditioning Regas','badge'=>'DR','short'=>'Full refrigerant evacuation and recharge with UV dye test. R134a and R1234yf — all makes and models.','hero_price'=>'Standard regas & dye test '.$aircon_price,'price'=>'Standard regas & dye test '.$aircon_price,'urgency'=>'low'],
    'air-conditioning-diagnosis-manukau' => ['name'=>'AC System Diagnosis','badge'=>'SD','short'=>'Electronic and mechanical diagnosis of all AC faults — compressor, condenser, evaporator, expansion valve.','hero_price'=>'Contact for estimate — depends on fault complexity','price'=>'Contact for estimate — depends on fault complexity','urgency'=>'medium'],
    'car-air-conditioning-repair-manukau' => ['name'=>'Air Conditioning Repair','badge'=>'CH','short'=>'Cooling and heating circuit repair — blend doors, heater cores, actuators, compressors, and condensers.','hero_price'=>'Contact for estimate — depends on fault and parts required','price'=>'Contact for estimate — depends on fault and parts required','urgency'=>'medium'],
    'cabin-filter-replacement-manukau' => ['name'=>'Cabin Filter Replacement','badge'=>'CF','short'=>'Supply and fit the correct cabin filter for your vehicle. Improves air quality and reduces strain on the AC system.','hero_price'=>'Contact for estimate — price varies by make and model','price'=>'Contact for estimate — price varies by make and model','urgency'=>'low'],
    'climate-control-repair-manukau' => ['name'=>'Climate Control Repair','badge'=>'CC','short'=>'Diagnosis and repair of electronic climate control — single-zone, dual-zone, and automatic systems on all makes.','hero_price'=>'Contact for estimate — depends on system and fault','price'=>'Contact for estimate — depends on system and fault','urgency'=>'low'],
];

// ── Current page data ────────────────────────────────────────────────────────
$current = isset($ac_master[$page_slug]) ? $ac_master[$page_slug] : null;
if (!$current) { $current = ['name'=>get_the_title(),'badge'=>'AC','short'=>'','urgency'=>'low']; }

$service_name  = $current['name'];
$badge         = $current['badge'];
$default_price = isset($current['price']) ? $current['price'] : '';
$hero_price    = isset($current['hero_price']) ? $current['hero_price'] : $default_price;
$urgency_level = isset($current['urgency']) ? $current['urgency'] : 'low';

// Post meta fields
$what_it_is    = get_post_meta($post_id, 'what_it_is', true) ?: '';
$causes_raw    = get_post_meta($post_id, 'causes', true) ?: '';
$symptoms_raw  = get_post_meta($post_id, 'symptoms', true) ?: '';
$process_raw   = get_post_meta($post_id, 'our_process', true) ?: '';
$price_signal  = get_post_meta($post_id, 'price_signal', true) ?: $default_price;
$vehicles_note = get_post_meta($post_id, 'vehicles_note', true) ?: '';

$causes   = $causes_raw   ? array_filter(array_map('trim', explode('|', $causes_raw)))   : [];
$symptoms = $symptoms_raw  ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw   ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

// Custom FAQs
$custom_faqs = [];
for ($i = 1; $i <= 3; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => $q, 'a' => $a];
}

// ── Badge helper ─────────────────────────────────────────────────────────────
function acs_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Build FAQs ───────────────────────────────────────────────────────────────
$faqs = [];
$faqs[] = ['q'=>"What is {$service_name}?",'a'=>$what_it_is ?: "Contact Tony Allen Auto Service on {$phone_free} for information about {$service_name}."];
if ($causes_raw) { $faqs[] = ['q'=>"What causes problems with {$service_name}?",'a'=>implode('. ', $causes).'.'];}
if ($symptoms_raw) { $faqs[] = ['q'=>"How do I know if I need {$service_name}?",'a'=>'Common signs include: '.strtolower(implode('; ', $symptoms)).'.'];}
$faqs[] = ['q'=>"How much does {$service_name} cost in Manukau?",'a'=>$price_signal.'. All fees explained upfront — we provide an estimate before proceeding with any work. Call '.$phone_free.' for a current estimate on your vehicle.'];
$faqs[] = ['q'=>"Do you diagnose before recommending repairs?",'a'=>"Yes — always. We test the system and confirm the fault before recommending any work. A regas without diagnosis risks wasting money on a system that has a leak or component failure."];
$faqs[] = ['q'=>"Can you do this on European vehicles?",'a'=>"Yes. We service air conditioning on all makes including {$euro_brands}. European vehicles often have specific refrigerant requirements and dual-zone climate systems — we have the equipment and knowledge to handle these."];
$faqs[] = ['q'=>"How long does {$service_name} take?",'a'=>"A standard regas takes 45 to 60 minutes. Diagnosis and repairs take longer depending on the fault — we give you a timeframe when we provide your estimate."];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q'=>"Do you offer finance for AC work?",'a'=>"Yes — we accept Afterpay, Q Card, GEM Finance, and Aotea Finance. Spread the cost of your repair over time."];
$faqs[] = ['q'=>"Where is your air conditioning workshop?",'a'=>"Tony Allen Auto Service, 139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}. Call {$phone_free} to book."];
if (count($faqs) < 10) {
    $faqs[] = ['q'=>"What refrigerant does my car use?",'a'=>"Most pre-2017 vehicles use R134a. Many newer models use R1234yf. We carry both and check which your vehicle requires before starting any work."];
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = [
    '@context'=>'https://schema.org',
    '@graph'=>[
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'Air Conditioning','item'=>$site_url.'/air-conditioning/'],
            ['@type'=>'ListItem','position'=>3,'name'=>$service_name,'item'=>$page_url]]],
        ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,
         'telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10',
         'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
         'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
         'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
         'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
         'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
         'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
         'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Zip','Q Card','Gem Finance']],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.acs-hero__sub','.acs-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-aircon-sub-service .site-content,.page-template-template-aircon-sub-service .entry-content,.page-template-template-aircon-sub-service .entry-header,.page-template-template-aircon-sub-service article,.page-template-template-aircon-sub-service #primary,.page-template-template-aircon-sub-service #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-aircon-sub-service{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.acs-hero h1,.acs-sec__h2,.acs-cause__title,.acs-step__title,.acs-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.acs-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;text-align:center;}
.acs-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.acs-hero__badge{margin:0 auto 20px;}
.acs-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.acs-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.acs-hero h1 span{color:var(--taas-yellow,#FFC800);}
.acs-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 12px;line-height:1.75;}
.acs-hero__price{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.acs-hero__ctas{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
.acs-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.acs-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.acs-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.acs-trust__item::before{content:'✓';font-weight:900;}
.acs-sec{padding:var(--taas-sec-pad,72px) 0;}
.acs-sec--white{background:var(--taas-white,#FFFFFF);}
.acs-sec--grey{background:var(--taas-panel,#F7F7F5);}
.acs-sec--dark{background:var(--taas-dark,#1A1A1A);}
.acs-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.acs-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.acs-sec--dark .acs-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.acs-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.acs-sec--dark .acs-sec__h2{color:var(--taas-white,#FFFFFF);}
.acs-sec__body{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;max-width:780px;margin:0 0 24px;}
.acs-causes{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:24px;}
.acs-cause{background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:20px;border-left:4px solid var(--taas-yellow,#FFC800);}
.acs-cause__title{font-size:15px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:4px;}
.acs-steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:24px;counter-reset:step;}
.acs-step{background:var(--taas-panel,#F7F7F5);border-radius:var(--taas-radius,6px);padding:24px 20px;counter-increment:step;}
.acs-step::before{content:counter(step);display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:28px;font-weight:800;color:var(--taas-yellow,#FFC800);margin-bottom:8px;}
.acs-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111111);margin-bottom:4px;}
.acs-step__desc{font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;}
.acs-price-box{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:24px;}
.acs-price-box__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:8px;}
.acs-price-box__body{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;}
.acs-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.acs-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.acs-enquiry__phone:hover{opacity:.65;}
.acs-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.acs-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.acs-sec--dark .wpcf7 label,.acs-sec--dark .wpcf7 span:not(.wpcf7-spinner),.acs-sec--dark .wpcf7 div:not(.wpcf7-response-output),.acs-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.acs-sec--dark .wpcf7 input[type="text"],.acs-sec--dark .wpcf7 input[type="email"],.acs-sec--dark .wpcf7 input[type="tel"],.acs-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.acs-sec--dark .wpcf7 input::placeholder,.acs-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.acs-sec--dark .wpcf7 input:focus,.acs-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.acs-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.acs-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.acs-xlinks{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:24px;}
.acs-xlink{display:flex;align-items:center;gap:10px;padding:14px 16px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s,box-shadow 0.15s;}
.acs-xlink:hover{border-color:var(--taas-yellow,#FFC800);box-shadow:0 2px 8px rgba(0,0,0,0.06);}
.acs-xlink__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;font-weight:600;color:var(--taas-black,#111111);}
.acs-faq{max-width:780px;margin:28px auto 0;}
.acs-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.acs-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.acs-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.acs-faq__item--open .acs-faq__q::after{content:'−';}
.acs-faq__a{display:none;padding:0 0 18px;}
.acs-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.acs-faq__item--open .acs-faq__a{display:block;}
@media(max-width:960px){.acs-causes{grid-template-columns:1fr;}.acs-enquiry{grid-template-columns:1fr;gap:32px;}.acs-xlinks{grid-template-columns:repeat(2,1fr);}}
@media(max-width:640px){.acs-enquiry{display:flex;flex-direction:column-reverse;}.acs-hero{padding:48px 0 40px;}.acs-hero h1{font-size:clamp(26px,6vw,38px);}.acs-hero__sub{font-size:14px;}.acs-hero__ctas{flex-direction:column;align-items:stretch;}.acs-hero__ctas .taas-btn{text-align:center;}.acs-sec{padding:48px 0;}.acs-sec__h2{font-size:clamp(22px,5vw,30px);}.acs-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.acs-trust__item{font-size:12px;}.acs-xlinks{grid-template-columns:1fr;}.acs-faq__q{font-size:14px;padding:16px 32px 16px 0;}.acs-faq__a p{font-size:13px;}.acs-enquiry__phone{font-size:clamp(24px,6vw,32px);}.acs-steps{grid-template-columns:1fr;}}
</style>

<!-- 1. HERO -->
<section class="acs-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="acs-hero__inner">
    <div class="acs-hero__badge"><?php echo acs_badge($badge, 56); ?></div>
    <span class="acs-hero__eyebrow">Air Conditioning — Manukau</span>
    <h1><?php echo esc_html($service_name); ?><br><span>Manukau — South Auckland</span></h1>
    <p class="acs-hero__sub"><?php echo esc_html($current['short']); ?> Estimate before we start. All makes and models. Family-owned since <?php echo esc_html($established); ?>.</p>
    <?php if ($hero_price) : ?>
      <div class="acs-hero__price"><?php echo esc_html($hero_price); ?></div>
    <?php endif; ?>
    <div class="acs-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Enquire About <?php echo esc_html($service_name); ?></a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>

<!-- 2. TRUST STRIP -->
<div class="acs-trust"><div class="acs-trust__inner">
  <div class="acs-trust__item">MTA Assured</div>
  <div class="acs-trust__item">Estimate Before We Start</div>
  <div class="acs-trust__item">Diagnosis Often Available Same Day</div>
  <div class="acs-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="acs-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<!-- 3. WHAT IS IT -->
<?php if ($what_it_is) : ?>
<section class="acs-sec acs-sec--white">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">What Is It</span>
    <h2 class="acs-sec__h2"><?php echo esc_html($service_name); ?> — Explained</h2>
    <div class="acs-sec__body"><?php echo wp_kses_post($what_it_is); ?></div>
    <?php if ($vehicles_note) : ?>
      <p style="font-size:14px;color:var(--taas-mid,#666666);line-height:1.75;font-style:italic;"><?php echo wp_kses_post($vehicles_note); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- 4. CAUSES -->
<?php if ($causes) : ?>
<section class="acs-sec acs-sec--grey">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">Causes</span>
    <h2 class="acs-sec__h2">What Causes <?php echo esc_html($service_name); ?> Problems</h2>
    <div class="acs-causes">
      <?php foreach ($causes as $c) : ?>
      <div class="acs-cause"><div class="acs-cause__title"><?php echo wp_kses_post($c); ?></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 5. PROCESS -->
<?php if ($process) : ?>
<section class="acs-sec acs-sec--white">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">Our Process</span>
    <h2 class="acs-sec__h2">How We Handle <?php echo esc_html($service_name); ?></h2>
    <div class="acs-steps">
      <?php foreach ($process as $step) :
        $parts = explode(':', $step, 2);
        $title = trim($parts[0]);
        $desc  = isset($parts[1]) ? trim($parts[1]) : '';
      ?>
      <div class="acs-step">
        <div class="acs-step__title"><?php echo esc_html($title); ?></div>
        <?php if ($desc) : ?><div class="acs-step__desc"><?php echo esc_html($desc); ?></div><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 6. PRICING -->
<section class="acs-sec acs-sec--grey">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">Pricing</span>
    <h2 class="acs-sec__h2"><?php echo esc_html($service_name); ?> — Pricing Guide</h2>
    <div class="acs-price-box">
      <div class="acs-price-box__title"><?php echo esc_html($service_name); ?></div>
      <p class="acs-price-box__body"><?php echo wp_kses_post($price_signal); ?>. All fees explained upfront before any work begins. We provide an estimate once we have tested the system. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> for an estimate specific to your vehicle.</p>
    </div>
  </div>
</section>

<!-- 7. ENQUIRY -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Zip</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="acs-sec acs-sec--dark" id="enquire">
  <div class="acs-sec__inner">
    <div class="acs-enquiry">
      <div>
        <span class="acs-sec__eyebrow">Enquire Now</span>
        <h2 class="acs-sec__h2">Enquire About <?php echo esc_html($service_name); ?></h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and what the AC is doing. We'll come back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="acs-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="acs-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- 8. RELATED -->
<section class="acs-sec acs-sec--grey">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">Other AC Services</span>
    <h2 class="acs-sec__h2">Related Services</h2>
    <div class="acs-xlinks">
      <?php
      foreach ($ac_master as $slug => $svc) {
          if ($slug === $page_slug) continue;
          echo '<a href="'.esc_url($site_url.'/'.$slug.'/').'" class="acs-xlink">';
          echo '<div>'.acs_badge($svc['badge'], 32).'</div>';
          echo '<div class="acs-xlink__name">'.esc_html($svc['name']).'</div>';
          echo '</a>';
      }
      // Hub link
      echo '<a href="'.esc_url($site_url.'/air-conditioning/').'" class="acs-xlink">';
      echo '<div>'.acs_badge('AC', 32).'</div>';
      echo '<div class="acs-xlink__name">All AC Services</div>';
      echo '</a>';
      ?>
    </div>
  </div>
</section>

<!-- 9. REVIEWS -->
<section class="acs-sec acs-sec--white">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="acs-sec__h2">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- 10. FAQ -->
<section class="acs-sec acs-sec--grey">
  <div class="acs-sec__inner">
    <span class="acs-sec__eyebrow">FAQ</span>
    <h2 class="acs-sec__h2"><?php echo esc_html($service_name); ?> — Common Questions</h2>
    <div class="acs-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="acs-faq__item<?php echo $i===0?' acs-faq__item--open':''; ?>">
        <button class="acs-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="acs-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.acs-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.acs-faq__item'),o=i.classList.contains('acs-faq__item--open');document.querySelectorAll('.acs-faq__item--open').forEach(function(x){x.classList.remove('acs-faq__item--open');});if(!o)i.classList.add('acs-faq__item--open');});});
</script>

<?php get_footer(); ?>
