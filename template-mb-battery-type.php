<?php
/**
 * Template Name: MB Battery Type
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Serves 5 battery type pages at /{type}-battery-manukau/:
 * car, 4WD, AGM, marine, motorcycle.
 * Acts as both type hub AND Manukau location for that type.
 * CSS namespace: .mbt-
 *
 * Built June 2026 — full design system compliance
 * Section order: Hero → Trust → What is it → Brands → Pricing → Enquiry → Suburbs → Reviews → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url      = get_site_url();
$page_url      = get_permalink();
$post_id       = get_the_ID();
$page_slug     = get_post_field('post_name', $post_id);
$phone_free    = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established   = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating        = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews       = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$customers     = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$battery_price = defined('TAAS_BATTERY_PRICE') ? TAAS_BATTERY_PRICE : 'from $180 fitted';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$years         = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Type master array ────────────────────────────────────────────────────────
$type_master = [
    'car-battery-manukau' => [
        'name'=>'Car Battery','badge'=>'CAR','type_key'=>'car',
        'tagline'=>'Standard, EFB, AGM and stop-start batteries for all cars and passenger vehicles. Neuton Power, Bosch and more — matched to your vehicle specification.',
        'chips'=>['Standard','EFB','AGM','Stop-Start','All Makes'],
        'price_text'=>'Car batteries '.$battery_price,
        'has_locations'=>true,
        'about'=>'A car battery does more than start the engine. It stabilises voltage, powers accessories when the engine is off, and in stop-start vehicles cycles hundreds of times a day. The correct battery — right chemistry, right CCA, right group size — is essential for reliable starting and electrical system health.',
    ],
    '4wd-battery-manukau' => [
        'name'=>'4WD &amp; SUV Battery','badge'=>'4WD','type_key'=>'4wd',
        'tagline'=>'High-CCA batteries for 4WDs, utes and SUVs. Hilux, Ranger, Navara, D-MAX, Triton, Pajero — stock held for most popular models.',
        'chips'=>['4WD','SUV','Ute','High CCA','Diesel','All Makes'],
        'price_text'=>'4WD and SUV batteries — contact for pricing on your vehicle',
        'has_locations'=>true,
        'about'=>'4WD and SUV batteries need higher cold cranking amps than standard car batteries — especially diesel vehicles with glow plug systems. The wrong battery leads to slow cranking in cold mornings and shortened battery life. We match the correct CCA rating and group size for your specific vehicle.',
    ],
    'agm-battery-manukau' => [
        'name'=>'AGM / Stop-Start Battery','badge'=>'AGM','type_key'=>'agm',
        'tagline'=>'Stop-start vehicle specialists. Correct AGM spec matched and fitted every time. BMS registration included for European vehicles.',
        'chips'=>['AGM','EFB','Stop-Start','European BMS','All Makes'],
        'price_text'=>'AGM batteries — contact for pricing. BMS registration included for European vehicles',
        'has_locations'=>true,
        'about'=>'AGM (Absorbent Glass Mat) batteries are designed for vehicles with stop-start systems. They handle deep cycling — repeated discharging and recharging — far better than standard lead-acid batteries. Fitting a standard battery in a stop-start vehicle will shorten its life dramatically. European vehicles also require BMS registration after replacement — included at Manukau Batteries.',
    ],
    'marine-battery-manukau' => [
        'name'=>'Marine Battery','badge'=>'MAR','type_key'=>'marine',
        'tagline'=>'Starting batteries, deep cycle and dual-purpose marine batteries for boats and jet skis. Built for on-water vibration and high electrical demand.',
        'chips'=>['Starting','Deep Cycle','Dual Purpose','Marine AGM','Jet Ski'],
        'price_text'=>'Marine batteries — contact for pricing on your application',
        'has_locations'=>true,
        'about'=>'Marine batteries face different demands than automotive batteries — constant vibration, high accessory loads (fish finders, lights, pumps), and often extended periods without charging. We stock starting batteries for engine cranking, deep cycle batteries for accessory power, and dual-purpose batteries that handle both. Matched to your boat or jet ski application.',
    ],
    'motorcycle-battery-manukau' => [
        'name'=>'Motorcycle Battery','badge'=>'MCY','type_key'=>'motorcycle',
        'tagline'=>'Conventional, AGM and gel motorcycle batteries. Most common models in stock. Bring the bike in or call with your make and model details.',
        'chips'=>['Conventional','AGM','Gel','Scooter','All Makes'],
        'price_text'=>'Motorcycle batteries — contact for pricing on your model',
        'has_locations'=>false, // No suburb location pages for motorcycle
        'about'=>'Motorcycle batteries are smaller and more vehicle-specific than car batteries. The wrong physical size will not fit, and the wrong chemistry can damage the charging system. We stock conventional, AGM, and gel motorcycle batteries for most common models. Bring the bike in or call with your make and model.',
    ],
];

$current = isset($type_master[$page_slug]) ? $type_master[$page_slug] : null;
if (!$current) { $current = ['name'=>'Battery','badge'=>'BAT','type_key'=>'car','tagline'=>'','chips'=>[],'price_text'=>$battery_price,'has_locations'=>true,'about'=>'']; }

$type_name     = $current['name'];
$badge         = $current['badge'];
$type_key      = $current['type_key'];
$has_locations = $current['has_locations'];

// Post meta overrides
$custom_about = get_post_meta($post_id, 'what_it_is', true) ?: '';
$about_text   = $custom_about ?: $current['about'];
$price_text   = get_post_meta($post_id, 'price_signal', true) ?: $current['price_text'];

// Custom FAQs
$custom_faqs = [];
for ($i = 1; $i <= 3; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q'=>$q,'a'=>$a];
}

function mbt_badge($initials, $size = 48) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.2) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// Suburb pills — only for types with locations
$suburbs = [
    ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Māngere','slug'=>'mangere'],
    ['label'=>'Ōtāhuhu','slug'=>'otahuhu'],['label'=>'Wiri','slug'=>'wiri'],
    ['label'=>'Manurewa','slug'=>'manurewa'],['label'=>'Flat Bush','slug'=>'flat-bush'],
    ['label'=>'Takanini','slug'=>'takanini'],['label'=>'Papakura','slug'=>'papakura'],
    ['label'=>'Ōtara','slug'=>'otara'],['label'=>'Botany','slug'=>'botany'],
    ['label'=>'Howick','slug'=>'howick'],['label'=>'Clover Park','slug'=>'clover-park'],
    ['label'=>'Weymouth','slug'=>'weymouth'],['label'=>'Clendon','slug'=>'clendon'],
    ['label'=>'Hunters Corner','slug'=>'hunters-corner'],
];

// FAQs
$faqs = [];
$faqs[] = ['q'=>'How much does a '.$type_name.' cost fitted in Manukau?','a'=>$price_text.'. The exact price depends on your vehicle specification. Call '.$phone_free.' with your registration number and we will confirm before you come in.'];
$faqs[] = ['q'=>'Can I get a '.$type_name.' fitted same day?','a'=>'In most cases yes. We carry a full range at 139 Cavendish Drive, Manukau. Call ahead on '.$phone_local.' to confirm stock for your vehicle.'];
$faqs[] = ['q'=>'Do you offer free battery testing?','a'=>'Yes — free load test, voltage check, and cranking amp assessment on any vehicle. No appointment needed. We also test alternator and starter motor at no charge.'];
if ($type_key === 'car' || $type_key === 'agm') {
    $faqs[] = ['q'=>'Do European cars need battery registration?','a'=>'Yes. BMW, Mercedes-Benz, Audi, Volkswagen, Volvo, and most European vehicles have a BMS that must be updated when a new battery is fitted. BMS registration is included at Manukau Batteries.'];
}
$faqs[] = ['q'=>'What if my battery keeps going flat?','a'=>'A battery that keeps going flat is often an alternator fault, not a battery problem. We test both before recommending any replacement.'];
$faqs[] = ['q'=>'What brands do you stock?','a'=>'Neuton Power is our preferred brand — proven reliable over '.$years.' years. We are also an authorised Bosch dealer through YHI Automotive NZ.'];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q'=>'Can I pay with Afterpay?','a'=>'Yes — we accept Afterpay, Q Card, GEM Finance, and Aotea Finance.'];
$faqs[] = ['q'=>'Where is Manukau Batteries?','a'=>'139 Cavendish Drive, Manukau, Auckland 2104. Open '.$hours.'. Walk-ins welcome mornings. Call '.$phone_free.'.'];
if (count($faqs) < 10) {
    $faqs[] = ['q'=>'Do you recycle old batteries?','a'=>'Yes — old batteries collected and recycled responsibly at no charge with every supply and fit.'];
}

// Schema
$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Manukau Batteries','item'=>$site_url.'/manukau-batteries/'],
        ['@type'=>'ListItem','position'=>3,'name'=>$type_name.' Manukau','item'=>$page_url]]],
    ['@type'=>['AutoPartsStore','LocalBusiness'],'@id'=>$site_url.'/#manukau-batteries','name'=>'Manukau Batteries — Tony Allen Auto Service','url'=>$site_url.'/manukau-batteries/',
     'telephone'=>[$phone_free,$phone_local],'email'=>defined('TAAS_EMAIL')?TAAS_EMAIL:'enquiries@taas.co.nz','foundingDate'=>'1985-10',
     'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
     'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
     'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
     'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Q Card','Gem Finance']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.mbt-hero__sub','.mbt-faq__a:first-of-type p']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-mb-battery-type .site-content,.page-template-template-mb-battery-type .entry-content,.page-template-template-mb-battery-type .entry-header,.page-template-template-mb-battery-type article,.page-template-template-mb-battery-type #primary,.page-template-template-mb-battery-type #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-mb-battery-type{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.mbt-hero h1,.mbt-sec__h2,.mbt-faq__q{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.mbt-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;text-align:center;}
.mbt-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.mbt-hero__badge{margin:0 auto 20px;}
.mbt-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.mbt-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.mbt-hero h1 span{color:var(--taas-yellow,#FFC800);}
.mbt-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 12px;line-height:1.75;}
.mbt-hero__chips{display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin-bottom:20px;}
.mbt-hero__chip{background:rgba(255,200,0,0.1);border:1px solid rgba(255,200,0,0.25);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:600;padding:4px 12px;border-radius:100px;}
.mbt-hero__price{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.mbt-hero__ctas{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
.mbt-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.mbt-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.mbt-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.mbt-trust__item::before{content:'✓';font-weight:900;}
.mbt-sec{padding:var(--taas-sec-pad,72px) 0;}
.mbt-sec--white{background:var(--taas-white,#FFFFFF);}
.mbt-sec--grey{background:var(--taas-panel,#F7F7F5);}
.mbt-sec--dark{background:var(--taas-dark,#1A1A1A);}
.mbt-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.mbt-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.mbt-sec--dark .mbt-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.mbt-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.mbt-sec--dark .mbt-sec__h2{color:var(--taas-white,#FFFFFF);}
.mbt-sec__body{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;max-width:780px;margin:0 0 24px;}
.mbt-price-box{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:24px;}
.mbt-price-box__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:8px;}
.mbt-price-box__body{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;}
.mbt-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.mbt-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.mbt-enquiry__phone:hover{opacity:.65;}
.mbt-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.mbt-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.mbt-sec--dark .wpcf7 label,.mbt-sec--dark .wpcf7 span:not(.wpcf7-spinner),.mbt-sec--dark .wpcf7 div:not(.wpcf7-response-output),.mbt-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.mbt-sec--dark .wpcf7 input[type="text"],.mbt-sec--dark .wpcf7 input[type="email"],.mbt-sec--dark .wpcf7 input[type="tel"],.mbt-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.mbt-sec--dark .wpcf7 input::placeholder,.mbt-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.mbt-sec--dark .wpcf7 input:focus,.mbt-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.mbt-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.mbt-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.mbt-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:24px;list-style:none;padding:0;}
.mbt-pills li a{display:inline-block;padding:7px 18px;border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;background:var(--taas-white,#FFFFFF);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333333);text-decoration:none;transition:all 0.15s;}
.mbt-pills li a:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:600;}
.mbt-xlinks{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:24px;}
.mbt-xlink{display:flex;align-items:center;gap:10px;padding:14px 16px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s;}
.mbt-xlink:hover{border-color:var(--taas-yellow,#FFC800);}
.mbt-xlink__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;font-weight:600;color:var(--taas-black,#111111);}
.mbt-faq{max-width:780px;margin:28px auto 0;}
.mbt-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.mbt-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.mbt-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.mbt-faq__item--open .mbt-faq__q::after{content:'−';}
.mbt-faq__a{display:none;padding:0 0 18px;}
.mbt-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.mbt-faq__item--open .mbt-faq__a{display:block;}
@media(max-width:960px){.mbt-enquiry{grid-template-columns:1fr;gap:32px;}.mbt-xlinks{grid-template-columns:repeat(2,1fr);}}
@media(max-width:640px){.mbt-enquiry{display:flex;flex-direction:column-reverse;}.mbt-hero{padding:48px 0 40px;}.mbt-hero h1{font-size:clamp(26px,6vw,38px);}.mbt-hero__sub{font-size:14px;}.mbt-hero__ctas{flex-direction:column;align-items:stretch;}.mbt-hero__ctas .taas-btn{text-align:center;}.mbt-sec{padding:48px 0;}.mbt-sec__h2{font-size:clamp(22px,5vw,30px);}.mbt-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.mbt-trust__item{font-size:12px;}.mbt-xlinks{grid-template-columns:1fr;}.mbt-faq__q{font-size:14px;padding:16px 32px 16px 0;}.mbt-faq__a p{font-size:13px;}.mbt-enquiry__phone{font-size:clamp(24px,6vw,32px);}}
</style>

<section class="mbt-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="mbt-hero__inner">
  <div class="mbt-hero__badge"><?php echo mbt_badge($badge, 56); ?></div>
  <span class="mbt-hero__eyebrow">Manukau Batteries</span>
  <h1><?php echo $type_name; ?><br><span>Manukau — Supply &amp; Fit</span></h1>
  <p class="mbt-hero__sub"><?php echo esc_html($current['tagline']); ?> Authorised Neuton Power and Bosch dealer. Free battery testing.</p>
  <div class="mbt-hero__chips"><?php foreach ($current['chips'] as $c) { echo '<span class="mbt-hero__chip">'.esc_html($c).'</span>'; } ?></div>
  <div class="mbt-hero__price"><?php echo esc_html($price_text); ?></div>
  <div class="mbt-hero__ctas">
    <a href="#enquire" class="taas-btn taas-btn--primary">Get an Estimate</a>
    <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
  </div>
</div></section>

<div class="mbt-trust"><div class="mbt-trust__inner">
  <div class="mbt-trust__item">Neuton Power Authorised</div>
  <div class="mbt-trust__item">Bosch Authorised</div>
  <div class="mbt-trust__item">Free Battery Testing</div>
  <div class="mbt-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="mbt-trust__item">Since <?php echo esc_html($established); ?></div>
</div></div>

<?php if ($about_text) : ?>
<section class="mbt-sec mbt-sec--white"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow">About</span>
  <h2 class="mbt-sec__h2"><?php echo $type_name; ?> — What You Need to Know</h2>
  <div class="mbt-sec__body"><?php echo wp_kses_post($about_text); ?></div>
</div></section>
<?php endif; ?>

<section class="mbt-sec mbt-sec--grey"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow">Pricing</span>
  <h2 class="mbt-sec__h2"><?php echo $type_name; ?> — Pricing</h2>
  <div class="mbt-price-box">
    <div class="mbt-price-box__title"><?php echo $type_name; ?> Supply &amp; Fit</div>
    <p class="mbt-price-box__body"><?php echo wp_kses_post($price_text); ?>. Includes supply, fitting, and old battery disposal. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> with your registration number for an exact price.</p>
  </div>
</div></section>

<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="mbt-sec mbt-sec--dark" id="enquire"><div class="mbt-sec__inner">
  <div class="mbt-enquiry">
    <div>
      <span class="mbt-sec__eyebrow">Get an Estimate</span>
      <h2 class="mbt-sec__h2"><?php echo $type_name; ?> — Enquire</h2>
      <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and year. We will confirm stock and pricing.</p>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="mbt-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="mbt-enquiry__detail"><strong>Manukau Batteries</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?></div>
    </div>
    <div><?php echo do_shortcode($cf7_general); ?></div>
  </div>
</div></section>

<?php if ($has_locations) : ?>
<section class="mbt-sec mbt-sec--grey"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow">Near You</span>
  <h2 class="mbt-sec__h2"><?php echo $type_name; ?> — South Auckland</h2>
  <ul class="mbt-pills">
    <?php foreach ($suburbs as $s) : ?>
    <li><a href="<?php echo esc_url($site_url.'/'.$type_key.'-battery-'.$s['slug'].'/'); ?>"><?php echo $type_name; ?> <?php echo esc_html($s['label']); ?></a></li>
    <?php endforeach; ?>
  </ul>
</div></section>
<?php endif; ?>

<section class="mbt-sec mbt-sec--white"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow">Other Battery Types</span>
  <h2 class="mbt-sec__h2">Also at Manukau Batteries</h2>
  <div class="mbt-xlinks">
    <?php foreach ($type_master as $slug => $tm) {
        if ($slug === $page_slug) continue;
        echo '<a href="'.esc_url($site_url.'/'.$slug.'/').'" class="mbt-xlink">';
        echo '<div>'.mbt_badge($tm['badge'],32).'</div>';
        echo '<div class="mbt-xlink__name">'.strip_tags($tm['name']).'</div>';
        echo '</a>';
    } ?>
    <a href="<?php echo esc_url($site_url.'/manukau-batteries/'); ?>" class="mbt-xlink">
      <div><?php echo mbt_badge('MB',32); ?></div>
      <div class="mbt-xlink__name">All Batteries</div>
    </a>
  </div>
</div></section>

<section class="mbt-sec mbt-sec--grey"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
  <h2 class="mbt-sec__h2">What Customers Say</h2>
  <?php echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="mbt-sec mbt-sec--white"><div class="mbt-sec__inner">
  <span class="mbt-sec__eyebrow">FAQ</span>
  <h2 class="mbt-sec__h2"><?php echo $type_name; ?> — Common Questions</h2>
  <div class="mbt-faq">
    <?php foreach ($faqs as $i => $faq) : ?>
    <div class="mbt-faq__item<?php echo $i===0?' mbt-faq__item--open':''; ?>">
      <button class="mbt-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
      <div class="mbt-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<script>
document.querySelectorAll('.mbt-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.mbt-faq__item'),o=i.classList.contains('mbt-faq__item--open');document.querySelectorAll('.mbt-faq__item--open').forEach(function(x){x.classList.remove('mbt-faq__item--open');});if(!o)i.classList.add('mbt-faq__item--open');});});
</script>

<?php get_footer(); ?>
