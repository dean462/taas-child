<?php
/**
 * Template Name: Overheating Engine
 * Template Post Type: page
 * URL: /overheating-engine-manukau/
 *
 * Tony Allen Auto Service — taas.co.nz
 * EMERGENCY / DISTRESS page — phone-first design.
 * Different shape from every other template on the site.
 * Towing link prominent. Form secondary to phone.
 * CSS namespace: .ohe (overheating engine)
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

// ── Emergency steps ──────────────────────────────────────────────────────────
$emergency_steps = [
    ['icon' => '⚠', 'title' => 'Pull Over Safely',           'text' => 'Get off the road as soon as it is safe. Turn on your hazard lights.'],
    ['icon' => '⏹', 'title' => 'Turn the Engine Off',        'text' => 'Do not idle the engine. Idling an overheating engine causes more damage, not less.'],
    ['icon' => '🚫', 'title' => 'Do Not Open the Radiator Cap', 'text' => 'The cooling system is pressurised. Opening the cap releases superheated steam that causes serious burns.'],
    ['icon' => '⏱', 'title' => 'Wait at Least 20 Minutes',   'text' => 'Let the engine cool completely before checking anything. Do not add cold water to a hot engine — thermal shock can crack the block.'],
    ['icon' => '📞', 'title' => 'Call Us or Arrange a Tow',   'text' => 'Call ' . $phone_free . '. If the vehicle cannot be driven safely, we can arrange a tow to our workshop.'],
];

// ── Causes ───────────────────────────────────────────────────────────────────
$causes = [
    ['title' => 'Coolant Leak',          'text' => 'Hose, radiator, water pump, or head gasket leak causing coolant loss. The most common reason engines overheat.',                'url' => '/coolant-leak-repair-manukau/'],
    ['title' => 'Failed Thermostat',     'text' => 'A thermostat stuck closed blocks coolant flow to the radiator. A cheap part that causes expensive damage if ignored.',           'url' => '/thermostat-replacement-manukau/'],
    ['title' => 'Blocked Radiator',      'text' => 'Internal corrosion or debris restricts coolant flow through the radiator. External blockage from dirt, leaves, or bugs.',        'url' => '/radiator-repair-manukau/'],
    ['title' => 'Failed Water Pump',     'text' => 'Coolant stops circulating. The engine overheats within minutes. Usually caused by bearing or seal failure.',                      'url' => '/water-pump-replacement-manukau/'],
    ['title' => 'Blown Head Gasket',     'text' => 'Combustion gases enter the cooling system, displacing coolant and pressurising the system. The most expensive possibility.',     'url' => '/head-gasket-repair-manukau/'],
    ['title' => 'Cooling Fan Failure',   'text' => 'Electric fan not running at low speed or idle. Common in stop-start traffic where airflow through the radiator is minimal.',     'url' => ''],
    ['title' => 'Low Coolant',           'text' => 'Simple neglect — coolant level dropped below minimum over time. Often a slow leak that has not been noticed or addressed.',      'url' => ''],
    ['title' => 'Broken Drive Belt',     'text' => 'If the serpentine belt drives the water pump and the belt snaps, coolant circulation stops immediately.',                         'url' => ''],
];

// ── The escalation cascade ───────────────────────────────────────────────────
$cascade = [
    ['stage' => 'Thermostat fails',                         'cost' => 'Typically from $200',       'colour' => '#FFC800'],
    ['stage' => 'Engine overheats — coolant boils',         'cost' => '',                           'colour' => '#e67e22'],
    ['stage' => 'Head gasket fails',                        'cost' => 'Typically from $1,500',     'colour' => '#e74c3c'],
    ['stage' => 'Cylinder head warps — needs machining',    'cost' => 'Can cost $2,000–$3,500+',  'colour' => '#c0392b'],
    ['stage' => 'Engine block damage — replacement needed', 'cost' => 'Can cost $5,000+',          'colour' => '#922b21'],
];

// ── Process ──────────────────────────────────────────────────────────────────
$process = [
    ['title' => 'Vehicle Arrives',         'text' => 'Driven in or towed — we assess the situation immediately. If the engine is still hot, we allow it to cool before any work begins.'],
    ['title' => 'Visual Inspection',       'text' => 'Check coolant level, condition, and any visible leaks. Check drive belt condition. Inspect radiator, hoses, and fan operation.'],
    ['title' => 'Pressure Test',           'text' => 'Cooling system pressurised and monitored. Identifies the source of any leak — internal or external.'],
    ['title' => 'Thermostat & Pump Check', 'text' => 'Thermostat operation tested. Water pump inspected for bearing play, weep hole leak, and impeller condition.'],
    ['title' => 'Head Gasket Assessment',  'text' => 'If head gasket failure is suspected: compression test and chemical block test. We confirm the diagnosis before recommending a path forward.'],
    ['title' => 'Estimate & Decision',     'text' => 'You receive a clear estimate before we start any repair. If the damage exceeds the vehicle value, we tell you straight.'],
];

// ── Related services ─────────────────────────────────────────────────────────
$related = [
    ['label' => 'Towing',                    'url' => '/towing/'],
    ['label' => 'Cooling System Hub',         'url' => '/cooling-system/'],
    ['label' => 'Head Gasket Repair',         'url' => '/head-gasket-repair-manukau/'],
    ['label' => 'Water Pump Replacement',     'url' => '/water-pump-replacement-manukau/'],
    ['label' => 'Radiator Repair',            'url' => '/radiator-repair-manukau/'],
    ['label' => 'Thermostat Replacement',     'url' => '/thermostat-replacement-manukau/'],
    ['label' => 'Coolant Leak Repair',        'url' => '/coolant-leak-repair-manukau/'],
    ['label' => 'Engine Repairs Hub',         'url' => '/engine-repairs/'],
    ['label' => 'MBI Approved Repairer',      'url' => '/mechanical-breakdown-insurance/'],
    ['label' => 'Finance Options',            'url' => '/finance-options/'],
];

// ── FAQs (11) ────────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'My engine is overheating right now — what should I do?',
     'a' => 'Pull over safely and turn the engine off immediately. Turn on your hazard lights. Do not open the radiator cap — the system is pressurised and the steam will burn you. Wait at least 20 minutes for the engine to cool. Then call us on ' . $phone_free . '. If the vehicle cannot be driven safely, we can <a href="' . $site_url . '/towing/">arrange a tow</a> to our workshop.'],
    ['q' => 'Can I add water to my radiator if it is overheating?',
     'a' => 'Wait until the engine has cooled completely — at least 20 minutes with the engine off. Never add cold water to a hot engine. Thermal shock from cold water hitting a hot engine block or cylinder head can crack cast iron or aluminium components. Once cool, you can carefully top up with water as an emergency measure to get to a workshop, but the cooling system needs proper diagnosis — topping up does not fix the underlying cause.'],
    ['q' => 'How far can I drive with the temperature warning light on?',
     'a' => 'As little as possible — ideally not at all. Every metre driven with an overheating engine causes additional damage. The longer you drive, the more the repair will cost. If the gauge is in the red or the warning light is on, pull over immediately and call us on ' . $phone_free . '. If you cannot stop immediately, turn off the air conditioning, turn the heater to full heat (this draws heat from the engine), and pull over at the first safe opportunity.'],
    ['q' => 'Is it safe to drive after my engine cools down?',
     'a' => 'Not necessarily. The engine cooling down does not mean the problem is fixed. If the cause is a failed thermostat, low coolant, or a minor leak, you may be able to drive a short distance to a workshop — slowly, watching the gauge, with the heater running. If the cause is a blown head gasket or a burst hose, the engine will overheat again within minutes. When in doubt, arrange a tow. Call ' . $phone_free . ' and we can advise.'],
    ['q' => 'What is the most common cause of engine overheating?',
     'a' => 'Coolant leaks are the most common cause — a split hose, leaking radiator, failed water pump seal, or slow gasket leak that has gone unnoticed. The second most common is a failed thermostat stuck in the closed position. Both are relatively inexpensive to repair when caught early. The expensive scenarios — head gasket failure, cylinder head damage — are almost always the result of a cheaper problem being ignored or the vehicle being driven after overheating.'],
    ['q' => 'How much does it cost to fix an overheating engine?',
     'a' => 'It depends entirely on the cause. A thermostat replacement can cost from around $200. A radiator hose is similar. A water pump replacement varies by vehicle. A head gasket repair typically starts from $1,500 and can reach $3,000 to $5,000 or more on complex engines. We diagnose the cause first — mechanical diagnosis ' . $mech_diag . ' — and provide an estimate before starting any repair work. Call ' . $phone_free . '.'],
    ['q' => 'Can you arrange a tow if my car has overheated?',
     'a' => 'Yes. We arrange towing to our workshop via our towing partner. Call us on ' . $phone_free . ' and we will organise it. Do not attempt to drive an overheating vehicle — the cost of a tow is a fraction of the additional engine damage caused by driving. See our <a href="' . $site_url . '/towing/">towing page</a> for details.'],
    ['q' => 'Will my mechanical breakdown insurance cover overheating damage?',
     'a' => 'The component that failed (thermostat, water pump, head gasket) is usually covered under MBI. However, consequential damage from continued driving after symptoms appeared may not be covered by all policies — which is another reason to stop driving immediately when the warning light comes on. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. We handle MBI claims directly.'],
    ['q' => 'What happens if I keep driving with an overheating engine?',
     'a' => 'The damage escalates rapidly. A stuck thermostat (from around $200 to repair) causes the engine to overheat. Sustained overheating causes the head gasket to fail (from around $1,500). Continued driving with a blown head gasket warps the cylinder head (can cost $2,000 to $3,500 or more including machining). If the head or block cracks, engine replacement is the only option (can cost $5,000 or more). What started as a minor repair becomes a write-off.'],
    ['q' => 'Do you offer finance for overheating engine repairs?',
     'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. An overheating repair should never be delayed because of cost — the damage from continued overheating is exponentially more expensive than the original repair.'],
    ['q' => 'Where is your workshop?',
     'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' — we can advise over the phone and arrange a tow if needed.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Cooling System','item'=>$site_url.'/cooling-system/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Overheating Engine','item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Engine overheating emergency service in Manukau, South Auckland. Diagnosis, repair, and towing arranged. Do not drive an overheating engine — call us. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.ohe-hero__sub','.ohe-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-overheating .site-content,.page-template-template-overheating .entry-content,.page-template-template-overheating .entry-header,.page-template-template-overheating article,.page-template-template-overheating #primary,.page-template-template-overheating #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-overheating{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.ohe-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}

/* ── HERO — Emergency Design ─────────────────────────────────────────────── */
.ohe-hero{background:var(--taas-black,#111);padding:60px 0 0;position:relative;overflow:hidden;}
.ohe-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 90% at 50% 20%,rgba(192,57,43,.1) 0%,transparent 60%);pointer-events:none;}
.ohe-hero__top{text-align:center;max-width:700px;margin:0 auto;padding-bottom:48px;}
.ohe-hero__top nav{font-size:13px;color:#555;margin-bottom:20px;}
.ohe-hero__top nav a{color:#555;text-decoration:none;}
.ohe-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:6px 16px;border-radius:3px;margin-bottom:20px;}
.ohe-eye--emergency{background:var(--taas-alert,#C0392B);color:#fff;animation:ohe-pulse 2s ease-in-out infinite;}
@keyframes ohe-pulse{0%,100%{opacity:1;}50%{opacity:.7;}}
.ohe-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.ohe-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.ohe-hero h1{font-size:clamp(32px,6vw,56px);font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.08;margin:0 0 16px;}
.ohe-hero h1 span{color:var(--taas-alert,#C0392B);}
.ohe-hero__sub{font-size:17px;color:#bbb;margin:0 auto 28px;line-height:1.6;max-width:600px;}
.ohe-hero__phone{display:block;font-size:clamp(36px,7vw,60px);font-weight:900;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:8px;letter-spacing:-0.01em;transition:color .15s;}
.ohe-hero__phone:hover{color:#fff;}
.ohe-hero__phone-label{font-size:14px;font-weight:600;color:#888;margin-bottom:28px;}
.ohe-hero__ctas{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;margin-bottom:0;}

/* Emergency steps — inside hero, dark card */
.ohe-emergency{background:#1a1a1a;border-top:4px solid var(--taas-alert,#C0392B);padding:40px 0 48px;}
.ohe-emergency__title{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-white,#fff);text-align:center;margin-bottom:8px;}
.ohe-emergency__subtitle{font-size:15px;color:#999;text-align:center;margin-bottom:32px;}
.ohe-emergency__grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;max-width:1000px;margin:0 auto;}
.ohe-emergency__step{background:#222;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:20px 16px;text-align:center;}
.ohe-emergency__step-icon{font-size:28px;margin-bottom:10px;display:block;}
.ohe-emergency__step-num{font-size:11px;font-weight:700;color:var(--taas-alert,#C0392B);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:6px;}
.ohe-emergency__step-title{font-size:14px;font-weight:700;color:var(--taas-white,#fff);margin-bottom:6px;line-height:1.3;}
.ohe-emergency__step-text{font-size:12px;color:#999;line-height:1.5;}

/* Towing banner */
.ohe-towing{background:var(--taas-dark,#1A1A1A);border-top:1px solid #333;border-bottom:1px solid #333;padding:20px 0;}
.ohe-towing__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;}
.ohe-towing__text{font-size:15px;font-weight:600;color:#ccc;}
.ohe-towing__text strong{color:var(--taas-white,#fff);}
.ohe-towing__link{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:background .15s;}
.ohe-towing__link:hover{background:var(--taas-yellow2,#e6b400);}

.ohe-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.ohe-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.ohe-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.ohe-trust__item::before{content:'✓';font-weight:900;}

.ohe-section{padding:var(--taas-sec-pad,72px) 0;}
.ohe-section--white{background:var(--taas-white,#fff);}
.ohe-section--grey{background:var(--taas-panel,#F7F7F5);}
.ohe-section--dark{background:var(--taas-dark,#1A1A1A);}
.ohe-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.ohe-h2--white{color:var(--taas-white,#fff);}
.ohe-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.ohe-section--dark .ohe-lead{color:#aaa;}
.ohe-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.7;}
.ohe-content p{margin-bottom:16px;}

/* Causes grid */
.ohe-causes{display:grid;grid-template-columns:1fr 1fr;gap:16px;max-width:880px;margin-top:28px;}
.ohe-cause{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:20px;display:flex;flex-direction:column;}
.ohe-cause h3{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin:0 0 6px;}
.ohe-cause p{font-size:13px;color:var(--taas-mid,#666);line-height:1.55;margin:0 0 8px;flex:1;}
.ohe-cause a{font-size:13px;font-weight:600;color:var(--taas-yellow2,#e6b400);text-decoration:none;}
.ohe-cause a:hover{text-decoration:underline;}

/* Escalation cascade */
.ohe-cascade{max-width:640px;margin-top:28px;}
.ohe-cascade__step{display:flex;align-items:center;gap:16px;padding:16px 0;border-bottom:1px solid #2a2a2a;}
.ohe-cascade__step:last-child{border-bottom:none;}
.ohe-cascade__arrow{font-size:18px;color:#555;flex-shrink:0;width:24px;text-align:center;}
.ohe-cascade__stage{flex:1;font-size:15px;font-weight:600;line-height:1.4;}
.ohe-cascade__cost{font-size:13px;font-weight:700;white-space:nowrap;flex-shrink:0;}
.ohe-cascade__warning{margin-top:24px;border-left:4px solid var(--taas-alert,#C0392B);background:rgba(192,57,43,.08);padding:16px 20px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;color:#ccc;line-height:1.6;}
.ohe-cascade__warning strong{color:var(--taas-white,#fff);}

/* Process steps */
.ohe-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.ohe-step{display:flex;align-items:flex-start;gap:16px;padding:18px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.ohe-step:last-child{border-bottom:none;}
.ohe-step__num{width:34px;height:34px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ohe-step__body{flex:1;}
.ohe-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}
.ohe-step__text{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;}

/* Pricing */
.ohe-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:640px;}
.ohe-pricing__row{display:flex;justify-content:space-between;align-items:baseline;padding:10px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);font-size:14px;}
.ohe-pricing__row:last-child{border-bottom:none;}
.ohe-pricing__label{color:var(--taas-body,#333);font-weight:600;}
.ohe-pricing__value{color:var(--taas-black,#111);font-weight:700;}
.ohe-pricing__note{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;margin-top:20px;max-width:640px;}
.ohe-pricing__finance{font-size:14px;color:var(--taas-body,#333);padding-top:20px;border-top:1px solid var(--taas-border,#E8E8E4);line-height:1.6;margin-top:20px;max-width:640px;}

/* Enquiry */
.ohe-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.ohe-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}
.ohe-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}
.ohe-enquiry__form .wpcf7-form label,.ohe-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}
.ohe-enquiry__form .wpcf7-form input[type="text"],.ohe-enquiry__form .wpcf7-form input[type="email"],.ohe-enquiry__form .wpcf7-form input[type="tel"],.ohe-enquiry__form .wpcf7-form textarea,.ohe-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.ohe-enquiry__form .wpcf7-form input:focus,.ohe-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.ohe-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.ohe-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* Related */
.ohe-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.ohe-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.ohe-related__link:hover{border-color:var(--taas-yellow,#FFC800);}

/* FAQ */
.ohe-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.ohe-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.ohe-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.ohe-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.ohe-faq__item--open .ohe-faq__q::after{content:'−';}
.ohe-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.ohe-faq__item--open .ohe-faq__a{display:block;}

.ohe-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.ohe-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.ohe-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.ohe-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.ohe-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.ohe-btn--alert{background:var(--taas-alert,#C0392B);color:#fff;border-color:var(--taas-alert,#C0392B);}
.ohe-btn--alert:hover{background:#a93226;border-color:#a93226;}

@media(max-width:960px){.ohe-enquiry{grid-template-columns:1fr;}.ohe-emergency__grid{grid-template-columns:repeat(3,1fr);}.ohe-causes{grid-template-columns:1fr;}}
@media(max-width:640px){.ohe-hero{padding:40px 0 0;}.ohe-hero h1{font-size:clamp(28px,7vw,42px);}.ohe-hero__phone{font-size:clamp(30px,8vw,44px);}.ohe-section{padding:var(--taas-sec-pad-m,48px) 0;}.ohe-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.ohe-trust__item{font-size:12px;}.ohe-faq__q{font-size:14px;padding:16px 32px 16px 0;}.ohe-faq__a{font-size:13px;}.ohe-emergency__grid{grid-template-columns:1fr;max-width:400px;margin:0 auto;}.ohe-hero__ctas{flex-direction:column;align-items:stretch;}.ohe-hero__ctas .ohe-btn{justify-content:center;text-align:center;}.ohe-towing__inner{flex-direction:column;text-align:center;}}
</style>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO — Phone-First Emergency Design -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="ohe-hero">
  <div class="ohe-w">
    <div class="ohe-hero__top">
      <nav aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>">Cooling System</a><span style="margin:0 6px;">›</span><span style="color:#888;">Overheating Engine</span></nav>
      <span class="ohe-eye ohe-eye--emergency">Emergency — Pull Over Now</span>
      <h1>Is Your Engine<br><span>Overheating?</span></h1>
      <p class="ohe-hero__sub">Stop driving. Turn the engine off. Do not open the radiator cap. Call us — we diagnose the cause and arrange a tow if needed.</p>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ohe-hero__phone"><?php echo esc_html($phone_free); ?></a>
      <div class="ohe-hero__phone-label">Tap to call — <?php echo esc_html($hours); ?></div>
      <div class="ohe-hero__ctas">
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ohe-btn ohe-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call Now</a>
        <a href="<?php echo esc_url($site_url.'/towing/'); ?>" class="ohe-btn ohe-btn--alert"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>Arrange a Tow</a>
        <a href="#ohe-enquire" class="ohe-btn ohe-btn--outline">Send Details Online</a>
      </div>
    </div>
  </div>

  <!-- Emergency Steps — Inside Hero -->
  <div class="ohe-emergency"><div class="ohe-w">
    <div class="ohe-emergency__title">What to Do Right Now</div>
    <div class="ohe-emergency__subtitle">Follow these steps in order — do not skip any.</div>
    <div class="ohe-emergency__grid">
      <?php foreach ($emergency_steps as $i => $s): ?>
      <div class="ohe-emergency__step">
        <span class="ohe-emergency__step-icon"><?php echo $s['icon']; ?></span>
        <div class="ohe-emergency__step-num">Step <?php echo $i+1; ?></div>
        <div class="ohe-emergency__step-title"><?php echo esc_html($s['title']); ?></div>
        <div class="ohe-emergency__step-text"><?php echo esc_html($s['text']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div></div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- TOWING BANNER -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div class="ohe-towing"><div class="ohe-towing__inner">
  <div class="ohe-towing__text"><strong>Cannot drive?</strong> We arrange towing to our workshop via our towing partner.</div>
  <a href="<?php echo esc_url($site_url.'/towing/'); ?>" class="ohe-towing__link"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>Towing Information</a>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ohe-towing__link" style="background:transparent;border:2px solid var(--taas-yellow);color:var(--taas-yellow);">Call <?php echo esc_html($phone_free); ?></a>
</div></div>

<!-- TRUST STRIP -->
<div class="ohe-trust" role="list"><div class="ohe-trust__inner"><div class="ohe-trust__item" role="listitem">MTA Assured</div><div class="ohe-trust__item" role="listitem">NZTA Authorised</div><div class="ohe-trust__item" role="listitem">Diagnose First</div><div class="ohe-trust__item" role="listitem">Towing Arranged</div><div class="ohe-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div></div></div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- WHAT CAUSES OVERHEATING -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="ohe-section ohe-section--white"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">Causes</span>
  <h2 class="ohe-h2">What Causes an Engine to Overheat?</h2>
  <div class="ohe-content"><p>An engine overheats when the cooling system cannot remove heat fast enough. The cause is almost always one of these eight — and the first five are the most common. Every one of them is repairable when caught early. The expensive outcomes happen when people keep driving.</p></div>
  <div class="ohe-causes">
    <?php foreach ($causes as $c): ?>
    <div class="ohe-cause"><h3><?php echo esc_html($c['title']); ?></h3><p><?php echo esc_html($c['text']); ?></p><?php if ($c['url']): ?><a href="<?php echo esc_url($site_url.$c['url']); ?>">Learn more →</a><?php endif; ?></div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- THE ESCALATION — What Happens If You Keep Driving -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="ohe-section ohe-section--dark"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--yellow">The Cascade</span>
  <h2 class="ohe-h2 ohe-h2--white">What Happens If You Keep Driving</h2>
  <p class="ohe-lead">Every minute of driving an overheating engine increases the repair cost. Here is how a minor fault becomes a written-off engine.</p>
  <div class="ohe-cascade">
    <?php foreach ($cascade as $i => $c): ?>
    <div class="ohe-cascade__step">
      <div class="ohe-cascade__arrow"><?php echo $i === 0 ? '' : '↓'; ?></div>
      <div class="ohe-cascade__stage" style="color:<?php echo $c['colour']; ?>;"><?php echo esc_html($c['stage']); ?></div>
      <?php if ($c['cost']): ?><div class="ohe-cascade__cost" style="color:<?php echo $c['colour']; ?>;"><?php echo esc_html($c['cost']); ?></div><?php endif; ?>
    </div>
    <?php endforeach; ?>
    <div class="ohe-cascade__warning"><strong>The message is simple:</strong> a $200 thermostat becomes a $5,000+ engine replacement if you keep driving. Pull over, turn it off, and call <?php echo esc_html($phone_free); ?>.</div>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PROCESS — What We Do When the Car Arrives -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="ohe-section ohe-section--grey"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">At the Workshop</span>
  <h2 class="ohe-h2">What Happens When Your Vehicle Arrives</h2>
  <p class="ohe-lead">Driven in or towed — we follow the same diagnostic process. Fault confirmed before parts are replaced.</p>
  <div class="ohe-steps">
    <?php foreach ($process as $i => $step): ?>
    <div class="ohe-step">
      <div class="ohe-step__num"><?php echo $i+1; ?></div>
      <div class="ohe-step__body">
        <div class="ohe-step__title"><?php echo esc_html($step['title']); ?></div>
        <div class="ohe-step__text"><?php echo esc_html($step['text']); ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="ohe-section ohe-section--white"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">Pricing</span>
  <h2 class="ohe-h2">How Much Does It Cost to Fix an Overheating Engine?</h2>
  <p class="ohe-lead">It depends on the cause. We diagnose first and provide an estimate before starting any repair.</p>

  <div class="ohe-pricing">
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Mechanical diagnosis</span><span class="ohe-pricing__value"><?php echo esc_html($mech_diag); ?></span></div>
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Thermostat replacement</span><span class="ohe-pricing__value">Typically from $200</span></div>
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Radiator hose</span><span class="ohe-pricing__value">Typically from $200</span></div>
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Water pump</span><span class="ohe-pricing__value">Varies by vehicle</span></div>
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Radiator replacement</span><span class="ohe-pricing__value">Estimate after inspection</span></div>
    <div class="ohe-pricing__row"><span class="ohe-pricing__label">Head gasket repair</span><span class="ohe-pricing__value">Typically from $1,500</span></div>
  </div>
  <div class="ohe-pricing__note">Every repair starts with diagnosis. We confirm the cause before recommending a path forward — and we tell you straight if the repair cost exceeds the vehicle value. Call <?php echo esc_html($phone_free); ?> with your vehicle details.</div>
  <div class="ohe-pricing__finance"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. Do not delay an overheating repair because of cost — the damage escalates every day. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">View finance options →</a></div>
</div></section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY — After Pricing -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section id="ohe-enquire" class="ohe-section ohe-section--dark"><div class="ohe-w"><div class="ohe-enquiry">
  <div>
    <span class="ohe-eye ohe-eye--yellow">Get Help</span>
    <h2 class="ohe-h2 ohe-h2--white">Engine Overheating? — <span style="color:var(--taas-yellow);">Call Us Now</span></h2>
    <p style="font-size:15px;color:#aaa;margin:0 0 16px;line-height:1.6;">Calling is faster than the form for an overheating emergency. We can advise over the phone and arrange a tow immediately.</p>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free); ?></a>
    <div style="font-size:15px;color:#aaa;line-height:1.7;margin-bottom:16px;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div>
    <a href="<?php echo esc_url($site_url.'/towing/'); ?>" style="display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:700;color:var(--taas-alert);text-decoration:none;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>Need a tow? See towing options →</a>
  </div>
  <div class="ohe-enquiry__form">
    <div class="ohe-enquiry__form-title">Or Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- RELATED SERVICES -->
<section class="ohe-section ohe-section--grey"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">Related Services</span>
  <h2 class="ohe-h2">Connected Services</h2>
  <div class="ohe-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="ohe-related__link"><?php echo esc_html($r['label']); ?><span style="color:var(--taas-yellow);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<!-- REVIEWS -->
<section class="ohe-section ohe-section--white"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">Customer Reviews</span>
  <h2 class="ohe-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- FAQ -->
<section class="ohe-section ohe-section--grey"><div class="ohe-w">
  <span class="ohe-eye ohe-eye--dark">Common Questions</span>
  <h2 class="ohe-h2">Overheating Engine — FAQ</h2>
  <div class="ohe-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="ohe-faq__item<?php echo $i===0?' ohe-faq__item--open':''; ?>"><button class="ohe-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="ohe-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="ohe-a-<?php echo $i; ?>" class="ohe-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- BACK LINK -->
<div style="background:var(--taas-panel);padding:24px 0;text-align:center;">
  <a href="<?php echo esc_url($site_url.'/cooling-system/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Cooling System</a>
</div>

<script>
(function(){document.querySelectorAll('.ohe-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.ohe-faq__item');var wasOpen=item.classList.contains('ohe-faq__item--open');document.querySelectorAll('.ohe-faq__item--open').forEach(function(el){el.classList.remove('ohe-faq__item--open');el.querySelector('.ohe-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('ohe-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
