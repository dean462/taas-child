<?php
/**
 * Template Name: Water Pump
 * Template Post Type: page
 * URL: /water-pump-replacement-manukau/
 *
 * Tony Allen Auto Service — taas.co.nz
 * Standalone template — dual parent: Cambelt & Water Pump + Cooling System
 * MBI angle: water pump failure commonly claimed.
 * CSS namespace: .wps (water pump service)
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
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$cambelt_price  = defined('TAAS_CAMBELT_PRICE')  ? TAAS_CAMBELT_PRICE  : 'from $800';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── MBI providers ────────────────────────────────────────────────────────────
$mbi_providers = [
    ['name' => 'Autosure',  'url' => '/autosure-warranty-repairs-manukau/'],
    ['name' => 'Assurant',  'url' => '/assurant-warranty-repairs-manukau/'],
    ['name' => 'Provident', 'url' => '/provident-warranty-repairs-manukau/'],
    ['name' => 'Janssen',   'url' => '/janssen-warranty-repairs-manukau/'],
    ['name' => 'Autolife',  'url' => '/autolife-warranty-repairs-manukau/'],
];

// ── Warning signs ────────────────────────────────────────────────────────────
$symptoms = [
    'Coolant leak from the front of the engine — often from the weep hole at the base of the pump',
    'Whining or grinding noise from the front of the engine that changes with RPM',
    'Temperature gauge climbing toward the red zone',
    'Steam or sweet-smelling vapour from under the bonnet',
    'Coolant residue or staining around the pump housing',
    'Low coolant level with no obvious external leak',
    'Overheating — especially at idle or in traffic',
];

// ── Process steps ────────────────────────────────────────────────────────────
$process = [
    ['title' => 'Inspect & Diagnose',   'text' => 'Visual inspection and pressure test to confirm the water pump as the source of the leak or noise. We verify the fault before recommending replacement.'],
    ['title' => 'Estimate',             'text' => 'You receive an estimate before we start — parts and labour. If the cambelt is due at the same time, we provide a combined estimate so you can make an informed decision.'],
    ['title' => 'Remove & Replace',     'text' => 'If the pump is cambelt-driven, the belt and tensioners come off first. Old pump removed, new pump fitted with fresh gaskets and seals. Cambelt kit replaced at the same time where applicable.'],
    ['title' => 'Coolant & Bleed',      'text' => 'Cooling system refilled with fresh coolant at the correct concentration. Air bled from the system — trapped air pockets cause hot spots and gauge fluctuation.'],
    ['title' => 'Pressure Test',        'text' => 'Full pressure test to confirm no leaks. Thermostat operation verified. System holds pressure to specification.'],
    ['title' => 'Road Test & Confirm',  'text' => 'Vehicle road tested to operating temperature. Temperature gauge stable. Heater working. No leaks. Confirmed correct operation before handover.'],
];

// ── Related services ─────────────────────────────────────────────────────────
$related = [
    ['label' => 'Cambelt & Water Pump Hub',  'url' => '/cambelts-and-water-pumps/'],
    ['label' => 'Cooling System Hub',         'url' => '/cooling-system/'],
    ['label' => 'Timing Chain Service',       'url' => '/timing-chain-service-manukau/'],
    ['label' => 'Head Gasket Repair',         'url' => '/head-gasket-repair-manukau/'],
    ['label' => 'Overheating Engine',         'url' => '/overheating-engine-manukau/'],
    ['label' => 'Radiator Repair',            'url' => '/radiator-repair-manukau/'],
    ['label' => 'Coolant Leak Repair',        'url' => '/coolant-leak-repair-manukau/'],
    ['label' => 'Thermostat Replacement',     'url' => '/thermostat-replacement-manukau/'],
    ['label' => 'Vehicle Servicing',          'url' => '/vehicle-servicing/'],
    ['label' => 'MBI Approved Repairer',      'url' => '/mechanical-breakdown-insurance/'],
];

// ── FAQs (10+) ───────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'What does a water pump do and why does it fail?',
     'a' => 'The water pump circulates coolant through your engine, radiator, and heater core. It runs constantly while the engine is on. The internal seal and bearing wear over time — typically between 80,000 and 150,000 km depending on the vehicle. When the seal fails, coolant leaks from the weep hole at the base of the pump. When the bearing fails, you hear a whining or grinding noise.'],
    ['q' => 'Should I replace the water pump with the cambelt?',
     'a' => 'Yes — on any engine where the cambelt drives the water pump (which is most of them). The cambelt has to come off to reach the pump, so the labour is already done. If you replace the cambelt and leave the old pump, and the pump fails six months later, you pay the full labour cost again to access the same area. We always recommend a complete cambelt kit: belt, tensioner, idler pulleys, water pump, and thermostat.'],
    ['q' => 'How much does water pump replacement cost in Manukau?',
     'a' => 'As part of a cambelt service, the water pump is included in the kit — cambelt replacement starts ' . $cambelt_price . '. Standalone water pump replacement on a timing chain engine varies by vehicle — call us on ' . $phone_free . ' with your make and model for an estimate. We always provide an estimate before starting any work.'],
    ['q' => 'How do I know if my water pump is failing?',
     'a' => 'The most common sign is a coolant leak from the front of the engine, often from a small hole at the base of the pump called the weep hole. Other signs include a whining or grinding noise that changes with engine speed, the temperature gauge climbing, or unexplained coolant loss. If your temperature warning light comes on, pull over immediately and call us on ' . $phone_free . '.'],
    ['q' => 'Can I drive with a failing water pump?',
     'a' => 'Not safely. A failing water pump means coolant is not circulating properly. The engine will overheat — and overheating causes head gasket failure, warped cylinder heads, and potentially a written-off engine. If you notice any symptoms, get it inspected as soon as possible. If the temperature warning light comes on, pull over and do not drive further.'],
    ['q' => 'Is water pump failure covered by mechanical breakdown insurance?',
     'a' => 'In most cases, yes. Water pump failure is a mechanical component failure and is commonly covered under MBI policies. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. We handle the claim process directly — you do not need to arrange anything yourself.'],
    ['q' => 'What is the difference between a cambelt-driven and serpentine belt-driven water pump?',
     'a' => 'On most four-cylinder engines, the water pump is driven by the cambelt (timing belt) and sits inside the timing cover. On timing chain engines and some V6/V8 configurations, the water pump is external and driven by the serpentine belt. The external type is usually a simpler and less expensive replacement because the timing components do not need to be disturbed.'],
    ['q' => 'Do you work on European vehicle water pumps?',
     'a' => 'Yes. Our TAAS European division covers all European makes including Audi, BMW, Volkswagen, Mercedes-Benz, and others. European cooling systems often use plastic impeller water pumps that are more prone to failure than metal ones — we always fit quality replacement parts.'],
    ['q' => 'Do you offer finance for water pump replacement?',
     'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. A water pump repair should not be delayed because of cost — the damage from overheating is exponentially more expensive than the pump replacement itself.'],
    ['q' => 'Where is your workshop?',
     'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' to book or get an estimate.'],
    ['q' => 'How long does water pump replacement take?',
     'a' => 'A standalone water pump replacement typically takes 2–4 hours depending on the vehicle. A combined cambelt and water pump service takes 4–8 hours. We advise on expected timeframe when you book. Walk-ins are welcome mornings — booking is recommended for this type of work.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Cooling System','item'=>$site_url.'/cooling-system/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Water Pump Replacement','item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Water pump replacement in Manukau, South Auckland. Cambelt-driven and standalone water pump repair on all makes. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.wps-hero__sub','.wps-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-water-pump .site-content,.page-template-template-water-pump .entry-content,.page-template-template-water-pump .entry-header,.page-template-template-water-pump article,.page-template-template-water-pump #primary,.page-template-template-water-pump #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-water-pump{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.wps-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.wps-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;}
.wps-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.07) 0%,transparent 65%);pointer-events:none;}
.wps-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.wps-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.wps-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.wps-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.wps-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.wps-hero h1 span{color:var(--taas-yellow,#FFC800);}
.wps-hero__sub{font-size:16px;color:#aaa;max-width:560px;margin:0 0 20px;line-height:1.65;}
.wps-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.wps-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.wps-sidebar{background:#1e1e1e;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.wps-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.wps-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.wps-sidebar__list li{font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.wps-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.wps-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.wps-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;}
.wps-sidebar__phone:hover{color:#fff;}
.wps-sidebar__detail{font-size:12px;color:#666;line-height:1.6;}

.wps-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.wps-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.wps-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.wps-trust__item::before{content:'✓';font-weight:900;}

.wps-section{padding:var(--taas-sec-pad,72px) 0;}
.wps-section--white{background:var(--taas-white,#fff);}
.wps-section--grey{background:var(--taas-panel,#F7F7F5);}
.wps-section--dark{background:var(--taas-dark,#1A1A1A);}
.wps-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.wps-h2--white{color:var(--taas-white,#fff);}
.wps-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.wps-section--dark .wps-lead{color:#aaa;}
.wps-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.7;}
.wps-content p{margin-bottom:16px;}

/* Understanding section — two cards */
.wps-understand{display:grid;grid-template-columns:1fr 1fr;gap:32px;margin-top:32px;max-width:880px;}
.wps-understand__card{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px;}
.wps-understand__card h3{font-size:17px;font-weight:700;color:var(--taas-black,#111);margin:0 0 12px;line-height:1.3;}
.wps-understand__card p{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin:0;}
.wps-callout{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:20px 24px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:32px;max-width:780px;}
.wps-callout__title{font-size:14px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:6px;}
.wps-callout__body{font-size:14px;color:var(--taas-body,#333);line-height:1.65;}

/* Warning signs — dark section */
.wps-symptoms{display:flex;flex-direction:column;max-width:700px;}
.wps-symptoms li{display:flex;align-items:flex-start;gap:12px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;list-style:none;}
.wps-symptoms li:last-child{border-bottom:none;}
.wps-symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}

/* Process steps */
.wps-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.wps-step{display:flex;align-items:flex-start;gap:16px;padding:18px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.wps-step:last-child{border-bottom:none;}
.wps-step__num{width:34px;height:34px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.wps-step__body{flex:1;}
.wps-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}
.wps-step__text{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;}

/* Pricing */
.wps-pricing{display:grid;grid-template-columns:1fr 1fr;gap:24px;max-width:780px;}
.wps-pricing__card{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px;}
.wps-pricing__card-title{font-size:13px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:10px;}
.wps-pricing__card-price{font-size:20px;font-weight:800;color:var(--taas-black,#111);margin-bottom:10px;}
.wps-pricing__card-body{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;}
.wps-pricing__finance{font-size:14px;color:var(--taas-body,#333);padding-top:20px;border-top:1px solid var(--taas-border,#E8E8E4);line-height:1.6;margin-top:24px;max-width:780px;}

/* MBI */
.wps-mbi{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 32px;max-width:780px;margin-top:32px;}
.wps-mbi__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:10px;}
.wps-mbi__body{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin-bottom:16px;}
.wps-mbi__providers{display:flex;flex-wrap:wrap;gap:8px;}
.wps-mbi__pill{display:inline-block;padding:6px 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);font-size:13px;font-weight:600;color:var(--taas-black,#111);text-decoration:none;transition:border-color .15s;}
.wps-mbi__pill:hover{border-color:var(--taas-yellow,#FFC800);}

/* Enquiry */
.wps-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.wps-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.wps-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}
.wps-enquiry__form .wpcf7-form label,.wps-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.wps-enquiry__form .wpcf7-form input[type="text"],.wps-enquiry__form .wpcf7-form input[type="email"],.wps-enquiry__form .wpcf7-form input[type="tel"],.wps-enquiry__form .wpcf7-form textarea,.wps-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.wps-enquiry__form .wpcf7-form input:focus,.wps-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.wps-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.wps-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* Related */
.wps-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.wps-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.wps-related__link:hover{border-color:var(--taas-yellow,#FFC800);}

/* FAQ */
.wps-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.wps-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.wps-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.wps-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.wps-faq__item--open .wps-faq__q::after{content:'−';}
.wps-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.wps-faq__item--open .wps-faq__a{display:block;}

/* Buttons */
.wps-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.wps-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.wps-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.wps-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.wps-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.wps-hero__inner,.wps-enquiry{grid-template-columns:1fr;}.wps-sidebar{display:none;}.wps-understand{grid-template-columns:1fr;}.wps-pricing{grid-template-columns:1fr;}}
@media(max-width:640px){.wps-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.wps-hero h1{font-size:clamp(26px,7vw,38px);}.wps-section{padding:var(--taas-sec-pad-m,48px) 0;}.wps-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.wps-trust__item{font-size:12px;}.wps-faq__q{font-size:14px;padding:16px 32px 16px 0;}.wps-faq__a{font-size:13px;}.wps-hero__ctas{flex-direction:column;align-items:stretch;}.wps-hero__ctas .wps-btn{justify-content:center;text-align:center;}}
</style>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-hero"><div class="wps-w"><div class="wps-hero__inner">
  <div>
    <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>" style="color:#555;text-decoration:none;">Cooling System</a><span style="margin:0 6px;">›</span><span style="color:#888;">Water Pump Replacement</span></nav>
    <span class="wps-eye wps-eye--yellow">Cooling System — Manukau</span>
    <h1>Water Pump Replacement<br><span>Manukau — South Auckland</span></h1>
    <p class="wps-hero__sub">A failed water pump stops coolant circulating through your engine. Overheating follows within minutes. Tony Allen Auto Service replaces water pumps on all makes — standalone or as part of a cambelt service. <?php echo esc_html($years); ?> years of workshop experience. <?php echo esc_html($customers); ?> customers serviced.</p>
    <div class="wps-hero__price">Cambelt + water pump kit <?php echo esc_html($cambelt_price); ?> · Standalone — estimate after inspection</div>
    <div class="wps-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wps-btn wps-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#wps-enquire" class="wps-btn wps-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="wps-sidebar">
    <div class="wps-sidebar__title">At a Glance</div>
    <ul class="wps-sidebar__list"><li>Water pump replacement</li><li>Cambelt kit recommended</li><li>Diagnose before we recommend</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li><li>MBI claims accepted</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wps-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="wps-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- TRUST STRIP -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div class="wps-trust" role="list"><div class="wps-trust__inner"><div class="wps-trust__item" role="listitem">MTA Assured</div><div class="wps-trust__item" role="listitem">NZTA Authorised</div><div class="wps-trust__item" role="listitem">Diagnose First</div><div class="wps-trust__item" role="listitem">Estimate Before We Start</div><div class="wps-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- UNDERSTANDING — What a Water Pump Does + The Cambelt Connection -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--white"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Understanding Water Pumps</span>
  <h2 class="wps-h2">What Does a Water Pump Do?</h2>
  <div class="wps-content">
    <p>The water pump is the heart of your cooling system. It circulates coolant continuously through the engine block, cylinder head, radiator, and heater core while the engine is running. Without it, coolant sits still — and an engine with no coolant circulation overheats within minutes.</p>
    <p>Inside the pump is a spinning impeller driven by either the cambelt (timing belt) or the serpentine belt, depending on your engine. A mechanical seal keeps coolant inside the housing while the shaft spins at engine speed. Both the seal and the bearing wear over time — typically somewhere between 80,000 and 150,000 km — and when either fails, the pump needs replacing.</p>
  </div>

  <div class="wps-understand">
    <div class="wps-understand__card">
      <h3>Cambelt-Driven Water Pump</h3>
      <p>On most four-cylinder engines, the water pump sits inside the timing cover and is driven by the cambelt. This means the cambelt has to come off to reach the pump. The labour is the same whether you replace just the belt or the belt and pump together — which is why every reputable workshop recommends doing both at the same time. Replacing the cambelt and leaving the old pump is a false economy. If the pump fails six months later, you pay the full labour cost again to access the same area.</p>
    </div>
    <div class="wps-understand__card">
      <h3>Serpentine Belt-Driven Water Pump</h3>
      <p>On timing chain engines and some V6/V8 configurations, the water pump is external and driven by the serpentine belt. These are usually a simpler replacement because the timing components do not need to be disturbed. The pump bolts directly to the engine block or a separate housing. It can be replaced independently without touching the timing chain or any internal components.</p>
    </div>
  </div>

  <div class="wps-callout">
    <div class="wps-callout__title">The Full Cambelt Kit</div>
    <div class="wps-callout__body">We always recommend a complete cambelt kit when the water pump is cambelt-driven: cambelt, tensioner, idler pulleys, water pump, and thermostat. Every component in the kit is the same age and exposed to the same heat cycling. Replacing them together means one job, one labour cost, and a full reset of the timing system. See our <a href="<?php echo esc_url($site_url.'/cambelts-and-water-pumps/'); ?>" style="color:var(--taas-dark);font-weight:700;text-decoration:underline;">cambelt &amp; water pump</a> page for interval guides and pricing.</div>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- WARNING SIGNS — Dark Section -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--dark"><div class="wps-w">
  <span class="wps-eye wps-eye--yellow">Warning Signs</span>
  <h2 class="wps-h2 wps-h2--white">How Do You Know Your Water Pump Is Failing?</h2>
  <p class="wps-lead">A water pump rarely fails without warning. These are the signs our technicians see most often — if your vehicle is showing any of them, get it checked before the engine overheats.</p>
  <ul class="wps-symptoms">
    <?php foreach ($symptoms as $s): ?><li><?php echo esc_html($s); ?></li><?php endforeach; ?>
  </ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wps-btn wps-btn--primary" style="margin-top:28px;">Call <?php echo esc_html($phone_free); ?></a>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PROCESS -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--grey"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Our Process</span>
  <h2 class="wps-h2">How We Handle Water Pump Replacement</h2>
  <p class="wps-lead">Fault confirmed before parts are replaced. Estimate before we start. No guesswork.</p>
  <div class="wps-steps">
    <?php foreach ($process as $i => $step): ?>
    <div class="wps-step">
      <div class="wps-step__num"><?php echo $i+1; ?></div>
      <div class="wps-step__body">
        <div class="wps-step__title"><?php echo esc_html($step['title']); ?></div>
        <div class="wps-step__text"><?php echo esc_html($step['text']); ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--white"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Pricing</span>
  <h2 class="wps-h2">How Much Does Water Pump Replacement Cost?</h2>
  <p class="wps-lead">We always provide an estimate before starting any work — no surprises.</p>

  <div class="wps-pricing">
    <div class="wps-pricing__card">
      <div class="wps-pricing__card-title">With Cambelt Service</div>
      <div class="wps-pricing__card-price"><?php echo esc_html($cambelt_price); ?></div>
      <div class="wps-pricing__card-body">Water pump included in the full cambelt kit — belt, tensioner, idler pulleys, water pump, and thermostat. One job, one labour cost. Price varies by vehicle make and model.</div>
    </div>
    <div class="wps-pricing__card">
      <div class="wps-pricing__card-title">Standalone Replacement</div>
      <div class="wps-pricing__card-price">Estimate after inspection</div>
      <div class="wps-pricing__card-body">For timing chain engines where the water pump is externally driven. Cost depends on access, vehicle type, and parts. Call with your vehicle details for a same-day estimate.</div>
    </div>
  </div>

  <div class="wps-pricing__finance"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. A water pump repair should not wait — overheating causes damage that costs far more than the pump itself. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">View finance options →</a></div>

  <div class="wps-mbi">
    <div class="wps-mbi__title">Covered by Mechanical Breakdown Insurance?</div>
    <div class="wps-mbi__body">Water pump failure is a mechanical component failure and is commonly covered under MBI policies. Tony Allen Auto Service is an approved repairer — we handle the claim process directly. You do not need to arrange anything yourself.</div>
    <div class="wps-mbi__providers">
      <?php foreach ($mbi_providers as $p): ?><a href="<?php echo esc_url($site_url.$p['url']); ?>" class="wps-mbi__pill"><?php echo esc_html($p['name']); ?></a><?php endforeach; ?>
      <a href="<?php echo esc_url($site_url.'/mechanical-breakdown-insurance/'); ?>" class="wps-mbi__pill" style="background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);border-color:var(--taas-dark,#1A1A1A);">All MBI Providers →</a>
    </div>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY — Immediately After Pricing -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section id="wps-enquire" class="wps-section wps-section--dark"><div class="wps-w"><div class="wps-enquiry">
  <div>
    <span class="wps-eye wps-eye--yellow">Book Today</span>
    <h2 class="wps-h2 wps-h2--white">Water Pump Replacement — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="wps-enquiry__form">
    <div class="wps-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- RELATED SERVICES -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--grey"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Related Services</span>
  <h2 class="wps-h2">Connected Services</h2>
  <div class="wps-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="wps-related__link"><?php echo esc_html($r['label']); ?><span style="color:var(--taas-yellow);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- REVIEWS -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--white"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Customer Reviews</span>
  <h2 class="wps-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- FAQ -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="wps-section wps-section--grey"><div class="wps-w">
  <span class="wps-eye wps-eye--dark">Common Questions</span>
  <h2 class="wps-h2">Water Pump Replacement — FAQ</h2>
  <div class="wps-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="wps-faq__item<?php echo $i===0?' wps-faq__item--open':''; ?>"><button class="wps-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="wps-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="wps-a-<?php echo $i; ?>" class="wps-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- BACK LINKS — Dual Parent -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div style="background:var(--taas-panel);padding:24px 0;text-align:center;display:flex;justify-content:center;gap:32px;flex-wrap:wrap;">
  <a href="<?php echo esc_url($site_url.'/cambelts-and-water-pumps/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Cambelt &amp; Water Pump</a>
  <a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Cooling System</a>
</div>

<script>
(function(){document.querySelectorAll('.wps-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.wps-faq__item');var wasOpen=item.classList.contains('wps-faq__item--open');document.querySelectorAll('.wps-faq__item--open').forEach(function(el){el.classList.remove('wps-faq__item--open');el.querySelector('.wps-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('wps-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
