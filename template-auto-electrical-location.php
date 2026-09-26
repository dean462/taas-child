<?php
/**
 * Template Name: Auto Electrical Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL pattern: /auto-electrical-[suburb]/
 * Serves 16 suburb spoke pages with unique distance data and content.
 * CSS namespace: .ael-
 *
 * Rebuilt June 2026 — full design system compliance
 * Section order: Hero → Trust → What to expect → Signs → Process → Pricing → Enquiry → Suburbs → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$post_id       = get_the_ID();
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
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$autoelec_diag = defined('TAAS_AUTOELEC_DIAG') ? TAAS_AUTOELEC_DIAG : 'from $175';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$years         = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Master suburbs array ─────────────────────────────────────────────────────
$suburbs_master = [
    'papatoetoe'     => ['label'=>'Papatoetoe',    'distance'=>'~5 min via Great South Rd','area'=>'Papatoetoe, Hunters Corner, Manukau, Ōtāhuhu, Māngere, and Wiri'],
    'manukau'        => ['label'=>'Manukau',        'distance'=>'at our address on Cavendish Drive','area'=>'Manukau CBD, Wiri, Papatoetoe, Hunters Corner, Ōtara, and Māngere'],
    'mangere'        => ['label'=>'Māngere',        'distance'=>'~10 min from Māngere town centre','area'=>'Māngere, Māngere Bridge, Māngere East, Favona, Papatoetoe, and Ōtāhuhu'],
    'otahuhu'        => ['label'=>'Ōtāhuhu',        'distance'=>'~10 min via Great South Rd','area'=>'Ōtāhuhu, Māngere, Papatoetoe, Mt Wellington, Sylvia Park, and Manukau'],
    'wiri'           => ['label'=>'Wiri',            'distance'=>'~5 min via Cavendish Drive','area'=>'Wiri, Manukau, Manurewa, Papatoetoe, Ōtara, and Takanini'],
    'manurewa'       => ['label'=>'Manurewa',        'distance'=>'~10 min via Great South Rd','area'=>'Manurewa, Clendon, Wiri, Manukau, Weymouth, and Takanini'],
    'flat-bush'      => ['label'=>'Flat Bush',       'distance'=>'~15 min via Ormiston Rd','area'=>'Flat Bush, Ormiston, Clover Park, Ōtara, Manukau, Howick, and Dannemora'],
    'takanini'       => ['label'=>'Takanini',        'distance'=>'~12 min via Great South Rd','area'=>'Takanini, Conifer Grove, Manurewa, Papakura, Wiri, Manukau, and Clendon'],
    'papakura'       => ['label'=>'Papakura',        'distance'=>'~15 min via Great South Rd','area'=>'Papakura, Takanini, Manurewa, Clendon, Drury, and Manukau'],
    'otara'          => ['label'=>'Ōtara',           'distance'=>'~8 min via East Tāmaki Rd','area'=>'Ōtara, East Tāmaki, Clover Park, Flat Bush, Hunters Corner, and Wiri'],
    'botany'         => ['label'=>'Botany',          'distance'=>'~20 min via Ti Rakau Drive','area'=>'Botany Downs, Botany Town Centre, Chapel Downs, Dannemora, Flat Bush, and Howick'],
    'howick'         => ['label'=>'Howick',          'distance'=>'~20 min via Ti Rakau Drive','area'=>'Howick, Pakuranga, Half Moon Bay, Bucklands Beach, Flat Bush, Clover Park, and Botany'],
    'clover-park'    => ['label'=>'Clover Park',     'distance'=>'~10 min via Ti Rakau Drive','area'=>'Clover Park, Ōtara, Flat Bush, Manukau, Howick, and Hunters Corner'],
    'weymouth'       => ['label'=>'Weymouth',        'distance'=>'~18 min via Weymouth Rd','area'=>'Weymouth, Wattle Downs, Manurewa, Clendon, Manukau, Wiri, and Takanini'],
    'clendon'        => ['label'=>'Clendon',         'distance'=>'~15 min via Roscommon Rd','area'=>'Clendon Park, Manurewa, Weymouth, Manukau, Wiri, and Takanini'],
    'hunters-corner' => ['label'=>'Hunters Corner',  'distance'=>'~5 min via Lambie Drive','area'=>'Hunters Corner, Papatoetoe, Manukau, Ōtara, Wiri, and Middlemore'],
];

// ── Current suburb data ──────────────────────────────────────────────────────
$has_acf     = function_exists('get_field');
$suburb_name = ($has_acf ? get_field('suburb_name') : null) ?: get_post_meta($post_id, 'suburb_name', true) ?: 'South Auckland';
$suburb_slug = ($has_acf ? get_field('suburb_slug') : null) ?: get_post_meta($post_id, 'suburb_slug', true) ?: sanitize_title($suburb_name);

$sub = isset($suburbs_master[$suburb_slug]) ? $suburbs_master[$suburb_slug] : null;
$distance    = $sub ? $sub['distance'] : 'a short drive';
$area_served = $sub ? $sub['area'] : $suburb_name;

// Build distance text naturally
if ($suburb_slug === 'manukau') {
    $distance_text = 'at 139 Cavendish Drive, Manukau';
} elseif (strpos($distance, 'from') !== false) {
    $distance_text = $distance;
} else {
    $distance_text = $distance . ' from ' . $suburb_name;
}

// Custom FAQs from post_meta
$custom_faq_q1 = get_post_meta($post_id, 'custom_faq_q1', true) ?: '';
$custom_faq_a1 = get_post_meta($post_id, 'custom_faq_a1', true) ?: '';
$custom_faq_q2 = get_post_meta($post_id, 'custom_faq_q2', true) ?: '';
$custom_faq_a2 = get_post_meta($post_id, 'custom_faq_a2', true) ?: '';

// ── Badge helper ─────────────────────────────────────────────────────────────
function ael_badge($initials, $size = 36) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── FAQs ─────────────────────────────────────────────────────────────────────
$faqs = [
    ['q'=>'How much does an auto electrical diagnostic cost near '.$suburb_name.'?',
     'a'=>'A diagnostic scan starts '.$scan_price.' at Tony Allen Auto Service — '.$distance_text.'. A full diagnostic starts '.$autoelec_diag.' and includes live data analysis, component testing, and wiring checks. All fees explained upfront. If you proceed with the repair, the diagnostic fee applies to the final invoice.'],
    ['q'=>'Do you diagnose faults before replacing parts?',
     'a'=>'Yes — always. Raj, our Lead Diagnostics & Auto Electrical Technician, verifies the fault before recommending any parts. A scan tool code tells you where to look, not what to replace. We test, confirm, then recommend. This approach avoids unnecessary replacements and gets the car fixed properly on the first visit.'],
    ['q'=>'How far is Tony Allen Auto Service from '.$suburb_name.'?',
     'a'=>'Tony Allen Auto Service is '.$distance_text.'. Our address is 139 Cavendish Drive, Manukau, Auckland 2104. We serve '.$area_served.'. Open '.$hours.'.'],
    ['q'=>'What auto electrical services do you offer near '.$suburb_name.'?',
     'a'=>'We offer ECU diagnostics, dashboard warning light diagnosis, battery supply and fit, alternator and starter motor repair, ABS and SRS fault diagnosis, central locking, electric window repair, immobiliser and key programming, wiring fault tracing, EGR and emission faults, TPMS reset, and lighting. All work led by Raj — Lead Diagnostics & Auto Electrical Technician.'],
    ['q'=>'Can you work on European vehicles from '.$suburb_name.'?',
     'a'=>'Yes. We carry factory-specification diagnostic equipment for '.$euro_brands.' through our TAAS European division. European ECUs require brand-specific scan tools — generic OBD readers miss a significant portion of fault data.'],
    ['q'=>'My check engine light is on — should I drive to your workshop from '.$suburb_name.'?',
     'a'=>'A solid check engine light usually means a stored fault code — it is generally safe to drive '.$distance_text.' to our workshop. Get it scanned promptly. A flashing check engine light means a serious active fault — stop driving and call us on '.$phone_free.'.'],
    ['q'=>'Do I need to book for an auto electrical diagnostic?',
     'a'=>'Walk-ins are welcome mornings, but booking is recommended to guarantee a time slot. Call '.$phone_free.' or use the enquiry form on this page to book a diagnostic.'],
    ['q'=>'Do you offer fleet auto electrical services for businesses near '.$suburb_name.'?',
     'a'=>'Yes. We carry out auto electrical repairs for fleet operators and light commercial operators across South Auckland. Direct invoicing to fleet management companies available. Call '.$phone_free.' to discuss your fleet requirements.'],
    ['q'=>'How long does a diagnostic scan take?',
     'a'=>'A standard scan takes 30 to 60 minutes. Full diagnostics involving wiring tracing or intermittent faults may take longer — we give you a timeframe and estimate before proceeding.'],
    ['q'=>'Where exactly is your auto electrical workshop?',
     'a'=>'Tony Allen Auto Service is at 139 Cavendish Drive, Manukau, Auckland 2104 — '.$distance_text.'. Open '.$hours.'. Call '.$phone_free.' to book.'],
];
if ($custom_faq_q1 && $custom_faq_a1) { $faqs[] = ['q'=>$custom_faq_q1,'a'=>$custom_faq_a1]; }
if ($custom_faq_q2 && $custom_faq_a2) { $faqs[] = ['q'=>$custom_faq_q2,'a'=>$custom_faq_a2]; }

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $f) { $schema_faqs[] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }
$schema = [
    '@context'=>'https://schema.org',
    '@graph'=>[
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'Auto Electrical','item'=>$site_url.'/auto-electrical/'],
            ['@type'=>'ListItem','position'=>3,'name'=>'Auto Electrician '.$suburb_name,'item'=>$page_url],
        ]],
        ['@type'=>['AutoRepair','LocalBusiness'],
         '@id'=>$site_url.'/#organization',
         'name'=>'Tony Allen Auto Service',
         'url'=>$site_url,
         'telephone'=>[$phone_free,$phone_local],
         'email'=>$email,
         'foundingDate'=>'1985-10',
         'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
         'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
         'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
         'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
         'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
         'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
         'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Q Card','Gem Finance'],
         'areaServed'=>['@type'=>'Place','name'=>$suburb_name.', South Auckland'],
        ],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.ael-hero__sub','.ael-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-auto-electrical-location .site-content,.page-template-template-auto-electrical-location .entry-content,.page-template-template-auto-electrical-location .entry-header,.page-template-template-auto-electrical-location article,.page-template-template-auto-electrical-location #primary,.page-template-template-auto-electrical-location #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-auto-electrical-location{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
.ael-hero h1,.ael-sec__h2,.ael-faq__q,.ael-svc__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.ael-hero{background:var(--taas-black,#111111);padding:var(--taas-sec-pad,72px) 0 60px;text-align:center;}
.ael-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.ael-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.ael-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#FFFFFF);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.ael-hero h1 span{color:var(--taas-yellow,#FFC800);}
.ael-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 12px;line-height:1.75;}
.ael-hero__price{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.ael-hero__ctas{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}
.ael-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.ael-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.ael-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.ael-trust__item::before{content:'✓';font-weight:900;}
.ael-sec{padding:var(--taas-sec-pad,72px) 0;}
.ael-sec--white{background:var(--taas-white,#FFFFFF);}
.ael-sec--grey{background:var(--taas-panel,#F7F7F5);}
.ael-sec--dark{background:var(--taas-dark,#1A1A1A);}
.ael-sec__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.ael-sec__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.ael-sec--dark .ael-sec__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.ael-sec__h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111111);letter-spacing:-0.01em;margin:0 0 12px;}
.ael-sec--dark .ael-sec__h2{color:var(--taas-white,#FFFFFF);}
.ael-sec__body{font-size:16px;color:var(--taas-body,#333333);line-height:1.75;max-width:780px;margin:0 0 20px;}
.ael-svcs{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:24px;}
.ael-svc{display:flex;align-items:center;gap:12px;padding:16px 18px;background:var(--taas-white,#FFFFFF);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color 0.15s,box-shadow 0.15s;}
.ael-svc:hover{border-color:var(--taas-yellow,#FFC800);box-shadow:0 2px 8px rgba(0,0,0,0.06);}
.ael-svc__title{font-size:14px;font-weight:600;color:var(--taas-black,#111111);}
.ael-price-box{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:24px;}
.ael-price-box__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:8px;}
.ael-price-box__body{font-size:15px;color:var(--taas-body,#333333);line-height:1.75;}
.ael-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.ael-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.ael-enquiry__phone:hover{opacity:.65;}
.ael-enquiry__detail{font-size:15px;color:#aaa;line-height:1.75;}
.ael-enquiry__detail strong{color:var(--taas-white,#FFFFFF);}
.ael-sec--dark .wpcf7 label,.ael-sec--dark .wpcf7 span:not(.wpcf7-spinner),.ael-sec--dark .wpcf7 div:not(.wpcf7-response-output),.ael-sec--dark .wpcf7 p{color:#ccc!important;font-size:14px;}
.ael-sec--dark .wpcf7 input[type="text"],.ael-sec--dark .wpcf7 input[type="email"],.ael-sec--dark .wpcf7 input[type="tel"],.ael-sec--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.ael-sec--dark .wpcf7 input::placeholder,.ael-sec--dark .wpcf7 textarea::placeholder{color:#666;}
.ael-sec--dark .wpcf7 input:focus,.ael-sec--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.ael-sec--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:var(--taas-btn-size,14px);letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}
.ael-sec--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.ael-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:24px;list-style:none;padding:0;}
.ael-pills li a{display:inline-block;padding:7px 18px;border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;background:var(--taas-white,#FFFFFF);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333333);text-decoration:none;transition:all 0.15s;}
.ael-pills li a:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:600;}
.ael-pills li a[aria-current="page"]{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-weight:700;}
.ael-faq{max-width:780px;margin:28px auto 0;}
.ael-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.ael-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-size:15px;font-weight:700;color:var(--taas-black,#111111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.ael-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666666);}
.ael-faq__item--open .ael-faq__q::after{content:'−';}
.ael-faq__a{display:none;padding:0 0 18px;}
.ael-faq__a p{font-size:15px;color:var(--taas-mid,#666666);line-height:1.75;margin:0;}
.ael-faq__item--open .ael-faq__a{display:block;}
@media(max-width:960px){.ael-svcs{grid-template-columns:repeat(2,1fr);}.ael-enquiry{grid-template-columns:1fr;gap:32px;}}
@media(max-width:640px){.ael-enquiry{display:flex;flex-direction:column-reverse;}.ael-hero{padding:48px 0 40px;}.ael-hero h1{font-size:clamp(26px,6vw,38px);}.ael-hero__sub{font-size:14px;}.ael-hero__ctas{flex-direction:column;align-items:stretch;}.ael-hero__ctas .taas-btn{text-align:center;}.ael-sec{padding:48px 0;}.ael-sec__h2{font-size:clamp(22px,5vw,30px);}.ael-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.ael-trust__item{font-size:12px;}.ael-svcs{grid-template-columns:1fr;}.ael-faq__q{font-size:14px;padding:16px 32px 16px 0;}.ael-faq__a p{font-size:13px;}.ael-enquiry__phone{font-size:clamp(24px,6vw,32px);}}
</style>

<!-- 1. HERO -->
<section class="ael-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="ael-hero__inner">
    <span class="ael-hero__eyebrow">Auto Electrician — <?php echo esc_html($suburb_name); ?></span>
    <h1>Auto Electrician<br><span><?php echo esc_html($suburb_name); ?></span></h1>
    <p class="ael-hero__sub">Auto electrical diagnosis and repair for <?php echo esc_html($suburb_name); ?> — <?php echo esc_html($distance_text); ?>. Led by Raj, our Lead Diagnostics & Auto Electrical Technician. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
    <div class="ael-hero__price">Diagnostic scan <?php echo esc_html($scan_price); ?> · Full diagnostic <?php echo esc_html($autoelec_diag); ?></div>
    <div class="ael-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Book a Diagnostic</a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>

<!-- 2. TRUST STRIP -->
<div class="ael-trust"><div class="ael-trust__inner">
  <div class="ael-trust__item">MTA Assured</div>
  <div class="ael-trust__item">NZTA Authorised</div>
  <div class="ael-trust__item">Fault Confirmed First</div>
  <div class="ael-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  <div class="ael-trust__item"><?php echo esc_html($distance); ?></div>
</div></div>

<!-- 3. WHAT TO EXPECT -->
<section class="ael-sec ael-sec--white">
  <div class="ael-sec__inner">
    <span class="ael-sec__eyebrow">Auto Electrician for <?php echo esc_html($suburb_name); ?></span>
    <h2 class="ael-sec__h2">Auto Electrical Services Near <?php echo esc_html($suburb_name); ?></h2>
    <p class="ael-sec__body">Tony Allen Auto Service provides full auto electrical diagnosis and repair from our workshop at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a> — <?php echo esc_html($distance_text); ?>. All auto electrical work is led by Raj, our Lead Diagnostics & Auto Electrical Technician, who verifies the fault before recommending any parts.</p>
    <p class="ael-sec__body">We serve <?php echo esc_html($area_served); ?> with full ECU diagnostics, battery supply and fit, alternator and starter motor repair, ABS and SRS fault diagnosis, wiring fault tracing, and more. Family-owned since <?php echo esc_html($established); ?>, MTA Assured, and NZTA Authorised.</p>
    <p class="ael-sec__body">Whether it's a dashboard warning light, a car that won't start, or an intermittent electrical fault — we diagnose the cause, not the symptom. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> to book a diagnostic.</p>
  </div>
</section>

<!-- 4. SERVICES -->
<section class="ael-sec ael-sec--grey">
  <div class="ael-sec__inner">
    <span class="ael-sec__eyebrow">Services</span>
    <h2 class="ael-sec__h2">Auto Electrical Services Available</h2>
    <div class="ael-svcs">
      <?php
      $service_links = [
        ['badge'=>'DS','name'=>'Diagnostic Scanning','slug'=>'diagnostic-scanning'],
        ['badge'=>'DW','name'=>'Dashboard Warning Lights','slug'=>'dashboard-warning-lights-manukau'],
        ['badge'=>'CS','name'=>"Car Won't Start",'slug'=>'car-wont-start-manukau'],
        ['badge'=>'CB','name'=>'Car Battery','slug'=>'auto-electrical-battery'],
        ['badge'=>'AR','name'=>'Alternator Repair','slug'=>'auto-electrical-alternator'],
        ['badge'=>'SM','name'=>'Starter Motor','slug'=>'auto-electrical-starter-motor'],
        ['badge'=>'ABS','name'=>'ABS Fault Diagnosis','slug'=>'abs-fault-diagnosis-manukau'],
        ['badge'=>'SRS','name'=>'SRS & Airbag','slug'=>'srs-airbag-repair-manukau'],
        ['badge'=>'EGR','name'=>'EGR & Emissions','slug'=>'egr-repair-manukau'],
        ['badge'=>'CL','name'=>'Central Locking','slug'=>'auto-electrical-central-locking'],
        ['badge'=>'WF','name'=>'Wiring Faults','slug'=>'wiring-fault-repair-manukau'],
        ['badge'=>'LH','name'=>'Lighting','slug'=>'auto-electrical-lighting'],
      ];
      foreach ($service_links as $svc) {
        echo '<a href="'.esc_url($site_url.'/'.$svc['slug'].'/').'" class="ael-svc">';
        echo '<div>'.ael_badge($svc['badge']).'</div>';
        echo '<div class="ael-svc__title">'.esc_html($svc['name']).'</div>';
        echo '</a>';
      }
      ?>
    </div>
  </div>
</section>

<!-- 5. PRICING -->
<section class="ael-sec ael-sec--white">
  <div class="ael-sec__inner">
    <span class="ael-sec__eyebrow">Pricing</span>
    <h2 class="ael-sec__h2">Auto Electrical Pricing for <?php echo esc_html($suburb_name); ?> Customers</h2>
    <div class="ael-price-box">
      <div class="ael-price-box__title">Diagnostic scan <?php echo esc_html($scan_price); ?> · Full diagnostic <?php echo esc_html($autoelec_diag); ?></div>
      <p class="ael-price-box__body">All fees explained upfront before any work begins. If you proceed with the repair, the diagnostic fee is applied to the final invoice. Repair costs depend on the fault and parts required — we provide an estimate before proceeding. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> for an estimate specific to your vehicle.</p>
    </div>
  </div>
</section>

<!-- 6. ENQUIRY — immediately after pricing -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="ael-sec ael-sec--dark" id="enquire">
  <div class="ael-sec__inner">
    <div class="ael-enquiry">
      <div>
        <span class="ael-sec__eyebrow">Enquire Now</span>
        <h2 class="ael-sec__h2">Book a Diagnostic</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and what symptoms you have. We'll come back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="ael-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ael-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- 7. SUBURB PILLS -->
<section class="ael-sec ael-sec--grey">
  <div class="ael-sec__inner">
    <span class="ael-sec__eyebrow">South Auckland</span>
    <h2 class="ael-sec__h2">Auto Electrician Near You</h2>
    <ul class="ael-pills">
      <?php foreach ($suburbs_master as $slug => $data) :
        $is_current = ($slug === $suburb_slug);
        $aria = $is_current ? ' aria-current="page"' : '';
      ?>
      <li><a href="<?php echo esc_url($site_url.'/auto-electrical-'.$slug.'/'); ?>"<?php echo $aria; ?>>Auto Electrician <?php echo esc_html($data['label']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- 8. FAQ -->
<section class="ael-sec ael-sec--white">
  <div class="ael-sec__inner">
    <span class="ael-sec__eyebrow">FAQ</span>
    <h2 class="ael-sec__h2">Auto Electrical — <?php echo esc_html($suburb_name); ?> Questions</h2>
    <div class="ael-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="ael-faq__item<?php echo $i===0?' ael-faq__item--open':''; ?>">
        <button class="ael-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="ael-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.ael-faq__q').forEach(function(b){b.addEventListener('click',function(){var i=this.closest('.ael-faq__item'),o=i.classList.contains('ael-faq__item--open');document.querySelectorAll('.ael-faq__item--open').forEach(function(x){x.classList.remove('ael-faq__item--open');});if(!o)i.classList.add('ael-faq__item--open');});});
</script>

<?php get_footer(); ?>
