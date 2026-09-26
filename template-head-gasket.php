<?php
/**
 * Template Name: Head Gasket
 * Template Post Type: page
 * URL: /head-gasket-repair-manukau/
 *
 * Tony Allen Auto Service — taas.co.nz
 * Standalone template — triple parent: Cooling System + Engine Repairs + MBI
 * Highest-cost cooling system repair. "Is it worth repairing?" section.
 * CSS namespace: .hgs (head gasket service)
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
$mech_diag      = defined('TAAS_MECH_DIAG')      ? TAAS_MECH_DIAG      : 'from $175';
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

// ── Symptoms ─────────────────────────────────────────────────────────────────
$symptoms = [
    'White smoke or steam from the exhaust — coolant burning in the combustion chamber',
    'Milky or creamy residue under the oil filler cap — coolant mixing with engine oil',
    'Unexplained coolant loss with no visible external leak',
    'Overheating — especially after short journeys or in stop-start traffic',
    'Bubbling in the coolant overflow bottle while the engine is running — combustion gases in the cooling system',
    'Rough idle, misfire, or loss of power — coolant entering a cylinder',
    'Sweet smell from the exhaust — burning coolant',
    'Oil in the coolant — chocolate milk appearance in the overflow bottle',
];

// ── Causes ───────────────────────────────────────────────────────────────────
$causes = [
    ['title' => 'Overheating', 'text' => 'The number one cause. The head gasket is designed for specific temperature ranges. Sustained overheating distorts the mating surfaces between the head and the block — once those surfaces are no longer flat, the gasket cannot seal.'],
    ['title' => 'Cooling System Neglect', 'text' => 'Old coolant turns acidic and corrodes aluminium cylinder heads from the inside. Uneven surface wear creates weak spots where the gasket fails first. A $200 coolant flush every two years prevents this.'],
    ['title' => 'Pre-Existing Cooling Faults', 'text' => 'A failed thermostat, blocked radiator, or leaking water pump causes localised hot spots in the engine. The head gasket fails at the hottest point — usually between two adjacent cylinders or at a coolant passage.'],
    ['title' => 'Age and Mileage', 'text' => 'Gasket material degrades through thousands of heat cycles over the life of the engine. High-mileage engines with original gaskets are more susceptible, particularly if the coolant has not been maintained.'],
];

// ── Diagnostic methods ───────────────────────────────────────────────────────
$diagnostics = [
    ['title' => 'Compression Test', 'text' => 'Measures the pressure each cylinder can hold. Low or uneven compression between adjacent cylinders indicates a gasket breach. This test also reveals whether valve or piston ring damage has occurred.'],
    ['title' => 'Chemical Block Test', 'text' => 'Also called a combustion leak test or sniff test. A test fluid is drawn through the coolant — if combustion gases are present in the cooling system, the fluid changes colour. This confirms the gasket has failed between a combustion chamber and a coolant passage.'],
    ['title' => 'Cooling System Pressure Test', 'text' => 'The cooling system is pressurised and monitored. A pressure drop with no visible external leak points to an internal gasket failure. Combined with the other two tests, this gives a complete picture of where and how badly the gasket has failed.'],
];

// ── Process steps ────────────────────────────────────────────────────────────
$process = [
    ['title' => 'Diagnose',              'text' => 'Compression test, chemical block test, and pressure test to confirm head gasket failure and assess whether secondary damage has occurred. We do not estimate head gasket replacement based on symptoms alone.'],
    ['title' => 'Honest Assessment',     'text' => 'You get a straight answer: gasket only, gasket plus head machining, or whether the repair cost exceeds the vehicle value. We tell you the truth before you commit to anything.'],
    ['title' => 'Detailed Estimate',     'text' => 'Parts and labour — gasket kit, head bolts, coolant, oil, and any machining or additional components. Estimate provided before we start.'],
    ['title' => 'Head Removal',          'text' => 'Cylinder head removed and inspected. Head and block mating surfaces checked for warping with a straight edge. Damage assessed — determines whether the head can be machined or needs replacement.'],
    ['title' => 'Machine if Required',   'text' => 'If the cylinder head is warped (common after overheating), it is sent to a machinist for resurfacing. A flat surface is essential — fitting a new gasket to a warped head will fail again.'],
    ['title' => 'Reassemble',            'text' => 'New head gasket kit fitted — gasket, head bolts (stretch bolts are always replaced, never reused), and valve stem seals where applicable. Torqued to manufacturer specification in the correct sequence.'],
    ['title' => 'Fluids & Bleed',        'text' => 'Fresh coolant at the correct concentration, new engine oil and filter (contaminated oil must be replaced). Cooling system bled of air to prevent hot spots.'],
    ['title' => 'Test & Confirm',        'text' => 'Compression retest, pressure test, road test to operating temperature. Temperature stable. No leaks. No smoke. Confirmed correct operation before handover.'],
];

// ── Related services ─────────────────────────────────────────────────────────
$related = [
    ['label' => 'Cooling System Hub',         'url' => '/cooling-system/'],
    ['label' => 'Engine Repairs Hub',         'url' => '/engine-repairs/'],
    ['label' => 'MBI Approved Repairer',      'url' => '/mechanical-breakdown-insurance/'],
    ['label' => 'Overheating Engine',         'url' => '/overheating-engine-manukau/'],
    ['label' => 'Water Pump Replacement',     'url' => '/water-pump-replacement-manukau/'],
    ['label' => 'Coolant Leak Repair',        'url' => '/coolant-leak-repair-manukau/'],
    ['label' => 'Radiator Repair',            'url' => '/radiator-repair-manukau/'],
    ['label' => 'Thermostat Replacement',     'url' => '/thermostat-replacement-manukau/'],
    ['label' => 'Cambelt & Water Pump',       'url' => '/cambelts-and-water-pumps/'],
    ['label' => 'Vehicle Servicing',          'url' => '/vehicle-servicing/'],
];

// ── FAQs (11) ────────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'What is a head gasket and what does it do?',
     'a' => 'The head gasket sits between the engine block and the cylinder head. It seals three separate systems: combustion pressure, coolant passages, and oil passages. When it fails, these systems cross-contaminate — coolant enters combustion chambers, oil mixes with coolant, or combustion gases pressurise the cooling system. Any of these will damage the engine if not addressed.'],
    ['q' => 'What causes a head gasket to fail?',
     'a' => 'Overheating is the primary cause. Sustained high temperatures distort the mating surfaces between the head and block, and the gasket can no longer seal. Other causes include old acidic coolant corroding aluminium heads, pre-existing cooling system faults like a blocked radiator or failed thermostat, and simple age — gasket material degrades over thousands of heat cycles.'],
    ['q' => 'How much does head gasket repair cost in Manukau?',
     'a' => 'A straightforward head gasket replacement on a four-cylinder engine typically starts from around $1,500. If the cylinder head needs machining, costs can reach $2,000 to $3,500 or more. Complex engines — V6, European, turbocharged — can cost $3,000 to $5,000 or more depending on the extent of damage. We always diagnose first and provide a detailed estimate before starting any work. Call ' . $phone_free . ' with your vehicle details.'],
    ['q' => 'How do I know if my head gasket has failed?',
     'a' => 'The most common signs are white smoke from the exhaust, milky residue under the oil filler cap, unexplained coolant loss with no visible leak, and overheating. Bubbling in the coolant overflow bottle while the engine is running is another strong indicator — it means combustion gases are entering the cooling system. If you notice any of these, do not continue driving. Call us on ' . $phone_free . '.'],
    ['q' => 'Is it worth repairing a blown head gasket?',
     'a' => 'It depends on four factors: the value of the vehicle, the condition of the engine, how far the damage has progressed, and whether you drove the vehicle after symptoms appeared. If the gasket failure is caught early and the head is not warped, the repair is worthwhile on most vehicles. If the engine has sustained secondary damage from continued driving — warped head, damaged bores, cracked block — the cost escalates and may exceed the vehicle value. We diagnose first and give you a straight answer.'],
    ['q' => 'Can I drive with a blown head gasket?',
     'a' => 'No. Every kilometre driven with a blown head gasket causes additional damage. Coolant in the combustion chamber washes oil from the cylinder walls, accelerating bore wear. Combustion gases in the cooling system cause further overheating. Oil contaminated with coolant loses its lubricating properties. What starts as a gasket-only repair becomes a head machining job, then an engine replacement. Stop driving and call us.'],
    ['q' => 'Is head gasket failure covered by mechanical breakdown insurance?',
     'a' => 'In most cases, yes — head gasket failure is a mechanical component failure and is commonly covered under MBI policies. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. We handle the claim directly. Note: some policies may not cover damage resulting from continued driving after symptoms appeared, which is another reason early diagnosis matters.'],
    ['q' => 'How long does head gasket replacement take?',
     'a' => 'A straightforward replacement typically takes 1–2 days. If the cylinder head needs machining, add 1–2 days for the machinist. Complex engines or those with secondary damage may take longer. We advise on expected timeframe after diagnosis. We do not rush head gasket work — it needs to be done correctly the first time.'],
    ['q' => 'Can a head gasket be repaired with a sealant?',
     'a' => 'We do not recommend chemical sealants for head gasket repair. They may temporarily reduce symptoms on a minor failure, but they cannot fix a mechanical breach between a combustion chamber and a coolant passage. Sealant can also block heater cores, radiator passages, and thermostat ports — creating new problems. If your gasket has failed, it needs replacing properly.'],
    ['q' => 'Do you work on European vehicle head gaskets?',
     'a' => 'Yes. Our TAAS European division covers all European makes including BMW, Audi, Volkswagen, Mercedes-Benz, and others. European engines often use multi-layer steel gaskets and require specific torque procedures and head bolt specifications — we follow manufacturer repair data for every engine.'],
    ['q' => 'Where is your workshop?',
     'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' to book a diagnostic appointment.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Engine Repairs','item'=>$site_url.'/engine-repairs/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Head Gasket Repair','item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Head gasket diagnosis and repair in Manukau, South Auckland. Compression testing, block testing, and cylinder head machining on all makes. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$–$$$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.hgs-hero__sub','.hgs-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-head-gasket .site-content,.page-template-template-head-gasket .entry-content,.page-template-template-head-gasket .entry-header,.page-template-template-head-gasket article,.page-template-template-head-gasket #primary,.page-template-template-head-gasket #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-head-gasket{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.hgs-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.hgs-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;}
.hgs-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(192,57,43,.06) 0%,transparent 65%);pointer-events:none;}
.hgs-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.hgs-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.hgs-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.hgs-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.hgs-eye--alert{background:rgba(192,57,43,.15);color:#e74c3c;border:1px solid rgba(192,57,43,.3);}
.hgs-hero h1{font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.hgs-hero h1 span{color:var(--taas-yellow,#FFC800);}
.hgs-hero__sub{font-size:16px;color:#aaa;max-width:560px;margin:0 0 20px;line-height:1.65;}
.hgs-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.hgs-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.hgs-hero__urgency{margin-top:24px;border-radius:var(--taas-radius,6px);padding:14px 18px;font-size:14px;line-height:1.6;max-width:580px;background:rgba(192,57,43,.12);border:1px solid var(--taas-alert,#C0392B);border-left:4px solid var(--taas-alert,#C0392B);color:#f5a0a0;}
.hgs-sidebar{background:#1e1e1e;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.hgs-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.hgs-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.hgs-sidebar__list li{font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.hgs-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.hgs-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.hgs-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;}
.hgs-sidebar__phone:hover{color:#fff;}
.hgs-sidebar__detail{font-size:12px;color:#666;line-height:1.6;}

.hgs-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.hgs-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.hgs-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.hgs-trust__item::before{content:'✓';font-weight:900;}

.hgs-section{padding:var(--taas-sec-pad,72px) 0;}
.hgs-section--white{background:var(--taas-white,#fff);}
.hgs-section--grey{background:var(--taas-panel,#F7F7F5);}
.hgs-section--dark{background:var(--taas-dark,#1A1A1A);}
.hgs-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.hgs-h2--white{color:var(--taas-white,#fff);}
.hgs-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.hgs-section--dark .hgs-lead{color:#aaa;}
.hgs-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.7;}
.hgs-content p{margin-bottom:16px;}

/* Causes cards */
.hgs-causes{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:28px;max-width:880px;}
.hgs-cause{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;}
.hgs-cause h3{font-size:16px;font-weight:700;color:var(--taas-black,#111);margin:0 0 10px;}
.hgs-cause p{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin:0;}

/* Symptoms — dark section */
.hgs-symptoms{display:flex;flex-direction:column;max-width:700px;}
.hgs-symptoms li{display:flex;align-items:flex-start;gap:12px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;list-style:none;}
.hgs-symptoms li:last-child{border-bottom:none;}
.hgs-symptoms li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}

/* Diagnostics cards */
.hgs-diag{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:28px;max-width:880px;}
.hgs-diag__card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;}
.hgs-diag__card h3{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin:0 0 10px;}
.hgs-diag__card p{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;margin:0;}

/* Worth repairing */
.hgs-worth{max-width:780px;}
.hgs-worth__factors{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin:28px 0;}
.hgs-worth__factor{padding:20px;border-radius:var(--taas-radius,6px);}
.hgs-worth__factor--yes{background:rgba(255,200,0,.08);border:1px solid rgba(255,200,0,.2);}
.hgs-worth__factor--no{background:rgba(192,57,43,.06);border:1px solid rgba(192,57,43,.15);}
.hgs-worth__factor h3{font-size:14px;font-weight:700;margin:0 0 8px;}
.hgs-worth__factor--yes h3{color:var(--taas-dark,#1A1A1A);}
.hgs-worth__factor--no h3{color:#c0392b;}
.hgs-worth__factor p{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;margin:0;}
.hgs-worth__bottom{font-size:15px;font-weight:600;color:var(--taas-body,#333);line-height:1.6;border-left:4px solid var(--taas-yellow,#FFC800);padding-left:20px;}

/* Process steps */
.hgs-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.hgs-step{display:flex;align-items:flex-start;gap:16px;padding:18px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.hgs-step:last-child{border-bottom:none;}
.hgs-step__num{width:34px;height:34px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.hgs-step__body{flex:1;}
.hgs-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}
.hgs-step__text{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;}

/* Pricing */
.hgs-pricing{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:880px;}
.hgs-pricing__card{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;}
.hgs-pricing__card-label{font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:8px;}
.hgs-pricing__card-price{font-size:18px;font-weight:800;color:var(--taas-black,#111);margin-bottom:8px;}
.hgs-pricing__card-body{font-size:13px;color:var(--taas-mid,#666);line-height:1.6;}
.hgs-pricing__note{font-size:14px;color:var(--taas-body,#333);line-height:1.6;margin-top:24px;max-width:880px;}
.hgs-pricing__finance{font-size:14px;color:var(--taas-body,#333);padding-top:20px;border-top:1px solid var(--taas-border,#E8E8E4);line-height:1.6;margin-top:20px;max-width:880px;}

/* MBI */
.hgs-mbi{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 32px;max-width:780px;margin-top:32px;}
.hgs-mbi__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:10px;}
.hgs-mbi__body{font-size:14px;color:var(--taas-mid,#666);line-height:1.65;margin-bottom:16px;}
.hgs-mbi__providers{display:flex;flex-wrap:wrap;gap:8px;}
.hgs-mbi__pill{display:inline-block;padding:6px 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);font-size:13px;font-weight:600;color:var(--taas-black,#111);text-decoration:none;transition:border-color .15s;}
.hgs-mbi__pill:hover{border-color:var(--taas-yellow,#FFC800);}

/* Enquiry */
.hgs-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.hgs-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.hgs-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}
.hgs-enquiry__form .wpcf7-form label,.hgs-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.hgs-enquiry__form .wpcf7-form input[type="text"],.hgs-enquiry__form .wpcf7-form input[type="email"],.hgs-enquiry__form .wpcf7-form input[type="tel"],.hgs-enquiry__form .wpcf7-form textarea,.hgs-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.hgs-enquiry__form .wpcf7-form input:focus,.hgs-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.hgs-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.hgs-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* Related */
.hgs-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.hgs-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.hgs-related__link:hover{border-color:var(--taas-yellow,#FFC800);}

/* FAQ */
.hgs-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.hgs-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.hgs-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.hgs-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.hgs-faq__item--open .hgs-faq__q::after{content:'−';}
.hgs-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.hgs-faq__item--open .hgs-faq__a{display:block;}

/* Buttons */
.hgs-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.hgs-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.hgs-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.hgs-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.hgs-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.hgs-hero__inner,.hgs-enquiry{grid-template-columns:1fr;}.hgs-sidebar{display:none;}.hgs-causes,.hgs-worth__factors,.hgs-pricing{grid-template-columns:1fr;}.hgs-diag{grid-template-columns:1fr;}}
@media(max-width:640px){.hgs-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.hgs-hero h1{font-size:clamp(26px,7vw,38px);}.hgs-section{padding:var(--taas-sec-pad-m,48px) 0;}.hgs-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.hgs-trust__item{font-size:12px;}.hgs-faq__q{font-size:14px;padding:16px 32px 16px 0;}.hgs-faq__a{font-size:13px;}.hgs-hero__ctas{flex-direction:column;align-items:stretch;}.hgs-hero__ctas .hgs-btn{justify-content:center;text-align:center;}}
</style>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-hero"><div class="hgs-w"><div class="hgs-hero__inner">
  <div>
    <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/engine-repairs/'); ?>" style="color:#555;text-decoration:none;">Engine Repairs</a><span style="margin:0 6px;">›</span><span style="color:#888;">Head Gasket Repair</span></nav>
    <span class="hgs-eye hgs-eye--alert">High-Cost Repair — Diagnosis First</span>
    <h1>Head Gasket Repair<br><span>Manukau — South Auckland</span></h1>
    <p class="hgs-hero__sub">A blown head gasket is the most expensive cooling system repair — and every kilometre driven after it fails makes it worse. Tony Allen Auto Service diagnoses the extent of damage before you commit to anything. <?php echo esc_html($years); ?> years of workshop experience. <?php echo esc_html($customers); ?> customers serviced.</p>
    <div class="hgs-hero__price">Diagnosis <?php echo esc_html($mech_diag); ?> · Repair — estimate after diagnosis</div>
    <div class="hgs-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hgs-btn hgs-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#hgs-enquire" class="hgs-btn hgs-btn--outline">Book Diagnosis</a>
    </div>
    <div class="hgs-hero__urgency"><strong style="color:#f5a0a0;">⚠ Do Not Drive:</strong> If your engine is overheating or you see white smoke from the exhaust, stop driving immediately. Continued driving causes damage that turns a gasket repair into an engine replacement.</div>
  </div>
  <div class="hgs-sidebar">
    <div class="hgs-sidebar__title">At a Glance</div>
    <ul class="hgs-sidebar__list"><li>Head gasket diagnosis &amp; repair</li><li>Compression &amp; block testing</li><li>Cylinder head machining</li><li>Diagnose before we recommend</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>MBI claims accepted</li><li>Finance available</li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hgs-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="hgs-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<!-- TRUST STRIP -->
<div class="hgs-trust" role="list"><div class="hgs-trust__inner"><div class="hgs-trust__item" role="listitem">MTA Assured</div><div class="hgs-trust__item" role="listitem">NZTA Authorised</div><div class="hgs-trust__item" role="listitem">Diagnose First</div><div class="hgs-trust__item" role="listitem">Estimate Before We Start</div><div class="hgs-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- UNDERSTANDING — What a Head Gasket Is -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--white"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Understanding Head Gaskets</span>
  <h2 class="hgs-h2">What Is a Head Gasket and Why Does It Fail?</h2>
  <div class="hgs-content">
    <p>The head gasket sits between the engine block and the cylinder head. Its job is to seal three completely separate systems: the high-pressure combustion gases inside each cylinder, the coolant passages that carry heat away from the engine, and the oil passages that lubricate the valve train and camshaft. When a head gasket fails, these systems cross-contaminate — and the consequences escalate fast.</p>
    <p>Coolant enters the combustion chamber and burns as white smoke. Oil mixes with coolant and turns into a milky sludge that cannot lubricate. Combustion gases pressurise the cooling system and cause further overheating. What started as a gasket failure becomes cylinder head damage, bore wear, and potentially a written-off engine — all because the three systems that should never meet are now mixing freely.</p>
  </div>
  <div class="hgs-causes">
    <?php foreach ($causes as $c): ?>
    <div class="hgs-cause"><h3><?php echo esc_html($c['title']); ?></h3><p><?php echo esc_html($c['text']); ?></p></div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- WARNING SIGNS — Dark Section -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--dark"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--yellow">Warning Signs</span>
  <h2 class="hgs-h2 hgs-h2--white">How Do You Know Your Head Gasket Has Failed?</h2>
  <p class="hgs-lead">A blown head gasket does not always present the same way. Some vehicles show one symptom, others show several. Any of the following warrants immediate diagnosis — do not wait for multiple signs to appear.</p>
  <ul class="hgs-symptoms">
    <?php foreach ($symptoms as $s): ?><li><?php echo esc_html($s); ?></li><?php endforeach; ?>
  </ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hgs-btn hgs-btn--primary" style="margin-top:28px;">Call <?php echo esc_html($phone_free); ?></a>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- DIAGNOSIS — How We Confirm It -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--grey"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Diagnosis</span>
  <h2 class="hgs-h2">How We Confirm Head Gasket Failure</h2>
  <p class="hgs-lead">We do not estimate head gasket replacement based on symptoms alone. Three tests confirm where the gasket has failed and whether secondary damage has occurred.</p>
  <div class="hgs-diag">
    <?php foreach ($diagnostics as $d): ?>
    <div class="hgs-diag__card"><h3><?php echo esc_html($d['title']); ?></h3><p><?php echo esc_html($d['text']); ?></p></div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- IS IT WORTH REPAIRING? -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--white"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">The Real Question</span>
  <h2 class="hgs-h2">Is It Worth Repairing a Blown Head Gasket?</h2>
  <div class="hgs-worth">
    <p class="hgs-lead" style="margin-bottom:8px;">This is the question everyone asks — and we give you a straight answer after diagnosis, not a sales pitch.</p>
    <div class="hgs-worth__factors">
      <div class="hgs-worth__factor hgs-worth__factor--yes">
        <h3>Repair Is Usually Worthwhile When</h3>
        <p>The gasket failure was caught early. The cylinder head is not warped. The engine has not been driven with symptoms for an extended period. The vehicle value exceeds the repair cost. The rest of the engine and vehicle are in reasonable condition.</p>
      </div>
      <div class="hgs-worth__factor hgs-worth__factor--no">
        <h3>Repair May Not Be Worthwhile When</h3>
        <p>The vehicle was driven overheating for a sustained period. The cylinder head is warped or cracked. The engine has secondary damage — scored bores, damaged bearings, cracked block. The repair cost approaches or exceeds the vehicle value.</p>
      </div>
    </div>
    <div class="hgs-worth__bottom">We tell you the truth before you spend your money. If the repair does not make financial sense, we will say so — and help you understand what the alternatives are. That is what <?php echo esc_html($years); ?> years in business looks like.</div>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PROCESS -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--grey"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Our Process</span>
  <h2 class="hgs-h2">How We Handle Head Gasket Repair</h2>
  <p class="hgs-lead">Fault confirmed before parts are replaced. Estimate before we start. No guesswork.</p>
  <div class="hgs-steps">
    <?php foreach ($process as $i => $step): ?>
    <div class="hgs-step">
      <div class="hgs-step__num"><?php echo $i+1; ?></div>
      <div class="hgs-step__body">
        <div class="hgs-step__title"><?php echo esc_html($step['title']); ?></div>
        <div class="hgs-step__text"><?php echo esc_html($step['text']); ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="hgs-section hgs-section--white"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Pricing</span>
  <h2 class="hgs-h2">How Much Does Head Gasket Repair Cost?</h2>
  <p class="hgs-lead">We always provide an estimate after diagnosis and before starting any work — no surprises.</p>

  <div class="hgs-pricing">
    <div class="hgs-pricing__card">
      <div class="hgs-pricing__card-label">Four-Cylinder</div>
      <div class="hgs-pricing__card-price">Typically from $1,500</div>
      <div class="hgs-pricing__card-body">Straightforward gasket replacement without head machining. Most common four-cylinder engines.</div>
    </div>
    <div class="hgs-pricing__card">
      <div class="hgs-pricing__card-label">With Head Machining</div>
      <div class="hgs-pricing__card-price">Can cost $2,000–$3,500+</div>
      <div class="hgs-pricing__card-body">Warped cylinder head requires machinist resurfacing. Common after sustained overheating.</div>
    </div>
    <div class="hgs-pricing__card">
      <div class="hgs-pricing__card-label">Complex Engines</div>
      <div class="hgs-pricing__card-price">Can cost $3,000–$5,000+</div>
      <div class="hgs-pricing__card-body">V6, European, turbocharged engines. Higher parts costs and significantly more labour.</div>
    </div>
  </div>

  <div class="hgs-pricing__note"><strong>Diagnosis first:</strong> Mechanical diagnosis <?php echo esc_html($mech_diag); ?>. This confirms the head gasket fault and the extent of any secondary damage before you commit to the repair. We do not provide a repair estimate based on symptoms alone.</div>

  <div class="hgs-pricing__finance"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. A head gasket repair is a significant cost — finance options help you get the repair done without delay. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">View finance options →</a></div>

  <div class="hgs-mbi">
    <div class="hgs-mbi__title">Covered by Mechanical Breakdown Insurance?</div>
    <div class="hgs-mbi__body">Head gasket failure is commonly covered under MBI policies — often as a high-value claim. Tony Allen Auto Service is an approved repairer and we handle the claim process directly. Note: some policies may not cover damage resulting from continued driving after symptoms appeared, which is another reason early diagnosis matters.</div>
    <div class="hgs-mbi__providers">
      <?php foreach ($mbi_providers as $p): ?><a href="<?php echo esc_url($site_url.$p['url']); ?>" class="hgs-mbi__pill"><?php echo esc_html($p['name']); ?></a><?php endforeach; ?>
      <a href="<?php echo esc_url($site_url.'/mechanical-breakdown-insurance/'); ?>" class="hgs-mbi__pill" style="background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);border-color:var(--taas-dark,#1A1A1A);">All MBI Providers →</a>
    </div>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY — Immediately After Pricing -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section id="hgs-enquire" class="hgs-section hgs-section--dark"><div class="hgs-w"><div class="hgs-enquiry">
  <div>
    <span class="hgs-eye hgs-eye--yellow">Book Today</span>
    <h2 class="hgs-h2 hgs-h2--white">Head Gasket Diagnosis — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
  </div>
  <div class="hgs-enquiry__form">
    <div class="hgs-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- RELATED SERVICES -->
<section class="hgs-section hgs-section--grey"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Related Services</span>
  <h2 class="hgs-h2">Connected Services</h2>
  <div class="hgs-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="hgs-related__link"><?php echo esc_html($r['label']); ?><span style="color:var(--taas-yellow);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<!-- REVIEWS -->
<section class="hgs-section hgs-section--white"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Customer Reviews</span>
  <h2 class="hgs-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- FAQ -->
<section class="hgs-section hgs-section--grey"><div class="hgs-w">
  <span class="hgs-eye hgs-eye--dark">Common Questions</span>
  <h2 class="hgs-h2">Head Gasket Repair — FAQ</h2>
  <div class="hgs-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="hgs-faq__item<?php echo $i===0?' hgs-faq__item--open':''; ?>"><button class="hgs-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="hgs-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="hgs-a-<?php echo $i; ?>" class="hgs-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- BACK LINKS — Triple Parent -->
<div style="background:var(--taas-panel);padding:24px 0;text-align:center;display:flex;justify-content:center;gap:32px;flex-wrap:wrap;">
  <a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Cooling System</a>
  <a href="<?php echo esc_url($site_url.'/engine-repairs/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Engine Repairs</a>
  <a href="<?php echo esc_url($site_url.'/mechanical-breakdown-insurance/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← MBI Approved Repairer</a>
</div>

<script>
(function(){document.querySelectorAll('.hgs-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.hgs-faq__item');var wasOpen=item.classList.contains('hgs-faq__item--open');document.querySelectorAll('.hgs-faq__item--open').forEach(function(el){el.classList.remove('hgs-faq__item--open');el.querySelector('.hgs-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('hgs-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
