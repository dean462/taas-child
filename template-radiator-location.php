<?php
/**
 * Template Name: Radiator Location Spoke
 * Template Post Type: page
 * URL pattern: /radiator-repair-[suburb]/
 * Also used for: /overheating-engine-[suburb]/
 *
 * ACF fields: suburb_name, suburb_slug, distance_note, page_type (radiator|overheating), custom_faq_q1/a1
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
require_once get_stylesheet_directory() . '/taas-suburbs.php';
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

$has_acf       = function_exists('get_field');
$suburb_name   = ($has_acf ? get_field('suburb_name')   : null) ?: get_the_title();
$suburb_slug   = ($has_acf ? get_field('suburb_slug')   : null) ?: sanitize_title($suburb_name);
$sub           = taas_suburb_data($suburb_slug, $suburb_name);
$distance_note = ($has_acf ? get_field('distance_note') : null) ?: 'Serving South Auckland from our Manukau workshop';
$page_type     = ($has_acf ? get_field('page_type')     : null) ?: 'radiator';
$faq_q1        = ($has_acf ? get_field('custom_faq_q1') : null) ?: '';
$faq_a1        = ($has_acf ? get_field('custom_faq_a1') : null) ?: '';

$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$google_rating  = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$google_reviews = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$site_url       = get_site_url();
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$page_url       = get_permalink();

// Content varies by page type
if ($page_type === 'overheating') {
    $h1_line1   = 'Car Overheating';
    $h1_em      = $suburb_name;
    $eyebrow    = 'Overheating Engine — ' . $suburb_name;
    $hero_sub   = 'Engine overheating near ' . $suburb_name . '? Pull over immediately. We diagnose the cause and repair it properly. ' . $distance_note . '.';
    $hub_url    = '/cooling-system/';
    $hub_label  = 'Cooling System';
    $spoke_base = '/overheating-engine-';
    $urgency    = '<strong>⚠ Pull over immediately.</strong> Driving an overheating engine causes head gasket failure and serious engine damage within minutes. Turn off the engine, wait 20 minutes, and call us on ' . $phone_free . '.';
    $services_h2 = 'Overheating Diagnosis &amp; Repair — ' . $suburb_name;
    $services_lead = 'We find the cause of the overheating and fix it. Not just add coolant.';
    $cta_h2     = 'Engine Overheating Near ' . $suburb_name . '?';
    $faq_h2     = 'Overheating Engine FAQ — ' . $suburb_name;
    $services = [
        'Overheating diagnosis', 'Coolant leak repair', 'Radiator repair &amp; replacement',
        'Thermostat replacement', 'Water pump replacement', 'Radiator hose replacement',
        'Head gasket assessment', 'Coolant flush &amp; refill',
    ];
    $faqs_extra = [
        ['q' => 'My car is overheating near ' . $suburb_name . ' — what should I do?', 'a' => 'Pull over immediately and turn the engine off. Do not try to drive to a workshop if the temperature gauge is in the red — this causes head gasket failure. Wait at least 20 minutes for the engine to cool. Do not open the radiator cap while the engine is hot. Call us on ' . $phone_free . ' and we can advise on whether you need a tow or whether it is safe to drive once cooled.'],
        ['q' => 'What causes a car engine to overheat?', 'a' => 'The most common causes are: a coolant leak from a hose, the radiator, or the water pump; a failed thermostat stuck in the closed position; a blocked or damaged radiator reducing coolant flow; a failed radiator fan; or a blown head gasket. We carry out a full cooling system diagnosis to find the actual cause — not just top up the coolant and send you on your way.'],
        ['q' => 'Will my engine be damaged if it overheated?', 'a' => 'It depends on how long it ran hot and how hot it got. A brief overheat caught quickly often causes no lasting damage. Sustained overheating — especially if the engine kept running after the warning light came on — can cause a blown head gasket, warped cylinder head, or in severe cases cracked engine block. We can assess the damage when you bring the vehicle in.'],
        ['q' => 'How much does it cost to repair an overheating engine near ' . $suburb_name . '?', 'a' => 'It depends entirely on the cause. A thermostat replacement is inexpensive. A head gasket repair is a significant job. We always diagnose first and provide an estimate before starting any work. Call us on ' . $phone_free . ' to discuss your situation.'],
        ['q' => 'Is it safe to add water to the radiator if my car is overheating?', 'a' => 'Only if the engine has fully cooled — never open the radiator cap on a hot engine. You can add water as a temporary measure to get to a workshop, but water alone does not provide corrosion protection or the correct boiling/freezing point of proper coolant. We will flush and refill with the correct coolant when you arrive.'],
    ];
} else {
    $h1_line1   = 'Radiator Repair';
    $h1_em      = $suburb_name;
    $eyebrow    = 'Radiator Repair — ' . $suburb_name;
    $hero_sub   = 'Radiator repair and replacement for ' . $suburb_name . ' customers at Tony Allen Auto Service. ' . $distance_note . '. Estimate before we start.';
    $hub_url    = '/cooling-system/';
    $hub_label  = 'Cooling System';
    $spoke_base = '/radiator-repair-';
    $urgency    = '<strong>⚠ Overheating or coolant leaking?</strong> Do not keep driving. A leaking radiator leads to overheating and potential head gasket failure. Call us on ' . $phone_free . ' before driving further.';
    $services_h2 = 'Radiator Services for ' . $suburb_name . ' Customers';
    $services_lead = 'Radiator repair, replacement, and full cooling system service at our Manukau workshop.';
    $cta_h2     = 'Radiator Problem Near ' . $suburb_name . '?';
    $faq_h2     = 'Radiator FAQ — ' . $suburb_name;
    $services = [
        'Radiator repair', 'Radiator replacement', 'Coolant flush &amp; refill',
        'Coolant leak diagnosis', 'Water pump replacement', 'Thermostat replacement',
        'Radiator hose replacement', 'Overheating diagnosis',
    ];
    $faqs_extra = [
        ['q' => 'How much does radiator repair or replacement cost near ' . $suburb_name . '?', 'a' => 'Costs vary depending on whether the radiator can be repaired or needs replacing, and the make and model of your vehicle. We always assess the radiator and provide an estimate before starting any work. Call us on ' . $phone_free . ' with your vehicle details for a guide price.'],
        ['q' => 'Can a leaking radiator be repaired or does it need replacing?', 'a' => 'It depends on the type and extent of the damage. Small leaks from fittings or minor corrosion can often be repaired. Radiators with significant stone damage, severe internal corrosion, or multiple leak points usually require replacement. We assess the condition before making a recommendation — we do not replace parts that can be fixed.'],
        ['q' => 'How long does a radiator replacement take?', 'a' => 'Most radiator replacements can be completed in 2 to 4 hours, depending on the vehicle and access. We recommend booking in advance — call us on ' . $phone_free . '. We are open Monday to Friday, 7:30am to 5:00pm at 139 Cavendish Drive, Manukau.'],
        ['q' => 'Should I replace the coolant at the same time as the radiator?', 'a' => 'Yes — the cooling system is fully drained during a radiator replacement. We always refill with fresh coolant at the correct concentration. If the old coolant was contaminated or degraded, it may have contributed to the radiator failure, so starting fresh makes sense.'],
        ['q' => 'What is included in a radiator service at Tony Allen Auto Service?', 'a' => 'We carry out a pressure test of the cooling system, inspect all hoses and connections, repair or replace the radiator as required, flush the cooling system, and refill with fresh coolant at the correct concentration. We also check the thermostat and coolant temperature sensor condition as part of the inspection.'],
    ];
}

$faqs = [];
if ($faq_q1 && $faq_a1) $faqs[] = ['q' => $faq_q1, 'a' => $faq_a1];
foreach ($faqs_extra as $f) $faqs[] = $f;

$all_suburbs = [
    ['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],
    ['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],
    ['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],
    ['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],
    ['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],
    ['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],
    ['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],
    ['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],
];
$other_suburbs = array_filter($all_suburbs, function($s) use ($suburb_slug){ return $s['slug'] !== $suburb_slug; });

function rl_mono($initials) {
    return '<svg width="40" height="40" viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#111"/><text x="20" y="25" text-anchor="middle" font-family="Inter,Arial,sans-serif" font-size="13" font-weight="700" fill="#FFC800" letter-spacing="0.5">' . $initials . '</text></svg>';
}

array_unshift($faqs, taas_suburb_coverage_faq($suburb_slug, $suburb_name, 'cooling system or radiator work', $phone_local));

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@700;900&family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-rl*,.taas-rl*::before,.taas-rl*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-rl{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.taas-rl__w{max-width:1140px;margin:0 auto;padding:0 24px;}
.rl-eyebrow{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.rl-eyebrow--yellow{background:#FFC800;color:#111;}.rl-eyebrow--dark{background:#1A1A1A;color:#FFC800;}
.rl-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(40px,6.5vw,68px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.rl-h1 em{color:#FFC800;font-style:normal;}
.rl-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(26px,3.5vw,40px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.rl-h2--white{color:#fff;}
.rl-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.rl-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}.rl-btn--primary:hover{background:#e6b400;}
.rl-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}.rl-btn--outline:hover{background:#FFC800;color:#111;}
.rl-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;}
.rl-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.rl-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.rl-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}.rl-hero__bc a{color:#555;text-decoration:none;}.rl-hero__bc a:hover{color:#FFC800;}.rl-hero__bc span{margin:0 6px;}
.rl-hero-sub{font-size:16px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.rl-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.rl-hero__urgency{margin-top:24px;background:rgba(192,57,43,.15);border:1px solid rgba(192,57,43,.4);border-left:4px solid #C0392B;border-radius:6px;padding:12px 16px;font-size:13px;color:#f5a0a0;line-height:1.6;max-width:560px;}
.rl-hero__urgency strong{color:#ff6b6b;}
.rl-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.rl-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.rl-loc-row{padding:10px 0;border-bottom:1px solid #2a2a2a;display:flex;flex-direction:column;gap:3px;}
.rl-loc-row:last-child{border-bottom:none;}
.rl-loc-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#555;}
.rl-loc-val{font-size:13px;font-weight:600;color:#ccc;}.rl-loc-val a{color:#fff;text-decoration:none;}.rl-loc-val a:hover{color:#FFC800;}
.rl-trust{background:#FFC800;}
.rl-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.rl-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.rl-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}
.rl-services{background:#fff;padding:72px 0;}
.rl-services__grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:32px;}
.rl-service-item{display:flex;align-items:center;gap:12px;background:#F7F7F5;border:1px solid #E8E8E4;border-radius:6px;padding:14px 16px;font-size:14px;font-weight:600;color:#333;transition:border-color .15s;}
.rl-service-item:hover{border-color:#FFC800;}
.rl-why{background:#1A1A1A;padding:72px 0;}
.rl-why__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;}
.rl-why__points{list-style:none;display:flex;flex-direction:column;gap:14px;}
.rl-why__point{display:flex;gap:12px;align-items:flex-start;font-size:15px;color:#ccc;line-height:1.5;}
.rl-why__point::before{content:'✓';color:#111;background:#FFC800;font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.rl-cta{background:#111;padding:72px 0;text-align:center;}
.rl-cta h2{color:#fff!important;margin-bottom:12px;}
.rl-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.rl-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.rl-cta__info{margin-top:24px;font-size:13px;color:#555;}
.rl-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.rl-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.rl-faq__item{border-bottom:1px solid #E8E8E4;}
.rl-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;}
.rl-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.rl-faq__q[aria-expanded="true"]::after{content:'−';}
.rl-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}
.rl-suburbs{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.rl-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.rl-suburb-pill{display:inline-block;padding:6px 14px;background:#fff;border:1px solid #E8E8E4;border-radius:100px;font-size:13px;font-weight:500;color:#333;text-decoration:none;transition:all .15s ease;}
.rl-suburb-pill:hover{background:#FFC800;border-color:#FFC800;color:#111;}
@media(max-width:960px){.rl-hero__inner{grid-template-columns:1fr;}.rl-hero__card{display:none;}.rl-trust__inner{grid-template-columns:1fr 1fr;}.rl-why__inner{grid-template-columns:1fr;}.rl-faq__grid{grid-template-columns:1fr;}}
@media(max-width:600px){.rl-hero,.rl-services,.rl-why,.rl-cta,.rl-faq{padding:48px 0;}.rl-services__grid{grid-template-columns:1fr;}}
</style>

<div class="taas-rl">
<section class="rl-hero">
    <div class="taas-rl__w">
        <div class="rl-hero__inner">
            <nav class="rl-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a><span>›</span>
                <a href="<?php echo esc_url($site_url . $hub_url); ?>"><?php echo esc_html($hub_label); ?></a><span>›</span>
                <span><?php echo esc_html($suburb_name); ?></span>
            </nav>
            <div>
                <span class="rl-eyebrow rl-eyebrow--yellow"><?php echo esc_html($eyebrow); ?></span>
                <h1 class="rl-h1"><?php echo esc_html($h1_line1); ?><br><em><?php echo esc_html($h1_em); ?></em></h1>
                <p class="rl-hero-sub"><?php echo esc_html($hero_sub); ?></p>
                <div class="rl-hero__btns">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="rl-btn rl-btn--primary">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        Call <?php echo esc_html($phone_free); ?>
                    </a>
                    <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="rl-btn rl-btn--outline">Book Online</a>
                </div>
                <div class="rl-hero__urgency"><p><?php echo $urgency; ?></p></div>
            </div>
            <div class="rl-hero__card">
                <h3>Workshop</h3>
                <div class="rl-loc-row"><div class="rl-loc-label">Address</div><div class="rl-loc-val">139 Cavendish Drive<br>Manukau, Auckland 2104</div></div>
                <div class="rl-loc-row"><div class="rl-loc-label">From <?php echo esc_html($suburb_name); ?></div><div class="rl-loc-val"><?php echo esc_html($distance_note); ?></div></div>
                <div class="rl-loc-row"><div class="rl-loc-label">Hours</div><div class="rl-loc-val">Mon–Fri 7:30am–5:00pm<br><span style="color:#555;font-size:12px;">Sat &amp; Sun: Closed</span></div></div>
                <div class="rl-loc-row"><div class="rl-loc-label">Free Phone</div><div class="rl-loc-val"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"><?php echo esc_html($phone_free); ?></a></div></div>
                <div class="rl-loc-row"><div class="rl-loc-label">Local</div><div class="rl-loc-val"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>"><?php echo esc_html($phone_local); ?></a></div></div>
            </div>
        </div>
    </div>
</section>

<div class="rl-trust" role="list">
    <div class="taas-rl__w">
        <div class="rl-trust__inner">
            <?php $ts = [['<img src="' . get_site_url() . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png" alt="MTA Assured" style="height:28px;width:auto;display:block;">','MTA Assured Workshop'],['<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>','Estimate Before We Start'],['<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>','Same-Day Where Possible'],['<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>','All Makes &amp; Models']]; foreach($ts as $t): ?>
            <div class="rl-trust__item" role="listitem"><span aria-hidden="true"><?php echo $t[0]; ?></span><span class="rl-trust__label"><?php echo $t[1]; ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="rl-services" aria-labelledby="rl-services-h2">
    <div class="taas-rl__w">
        <span class="rl-eyebrow rl-eyebrow--dark">What We Do</span>
        <h2 class="rl-h2" id="rl-services-h2"><?php echo $services_h2; ?></h2>
        <p style="font-size:16px;color:#666;line-height:1.6;margin-bottom:32px;"><?php echo esc_html($services_lead); ?></p>

        <?php if ($page_type === 'overheating'): ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;margin-bottom:40px;align-items:start;">
            <div>
                <h3 style="font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:12px;">What Causes Engine Overheating?</h3>
                <p style="font-size:15px;color:#555;line-height:1.7;margin-bottom:16px;">An overheating engine is always a symptom — something in the cooling system has failed. The most common causes are a coolant leak from a hose, radiator, or water pump; a thermostat stuck in the closed position preventing coolant from reaching the radiator; a failed radiator fan; or a head gasket leak.</p>
                <p style="font-size:15px;color:#555;line-height:1.7;">The most important thing is to stop immediately when the temperature warning light comes on. Continued driving causes head gasket failure within minutes. We diagnose the actual cause — not just top up the coolant.</p>
            </div>
            <div>
                <h3 style="font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:12px;">What To Do Right Now</h3>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <?php foreach (['Pull over and turn the engine off immediately','Do not open the radiator cap — wait 20 minutes for the engine to cool','Turn the heater on full if you need to reach a safe spot — it helps dissipate heat','Do not attempt to drive to a workshop if the gauge is in the red','Call us on ' . $phone_free . ' — we can advise on whether to tow or drive'] as $step): ?>
                    <div style="display:flex;gap:12px;align-items:flex-start;font-size:14px;color:#333;line-height:1.5;">
                        <span style="background:#C0392B;color:#fff;font-size:11px;font-weight:700;padding:2px 7px;border-radius:3px;flex-shrink:0;margin-top:2px;">!</span>
                        <?php echo esc_html($step); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:32px;margin-bottom:40px;align-items:start;">
            <div>
                <h3 style="font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:12px;">Radiator Repair or Replacement?</h3>
                <p style="font-size:15px;color:#555;line-height:1.7;margin-bottom:16px;">Not every radiator needs replacing. Small leaks from fittings or minor corrosion can often be repaired. Radiators with significant stone damage to the core, cracked plastic end tanks, or severe internal corrosion typically need replacing.</p>
                <p style="font-size:15px;color:#555;line-height:1.7;">At Tony Allen Auto Service we assess the condition of your radiator first and recommend the most appropriate repair. We pressure test before and after all radiator work to confirm the repair is complete.</p>
            </div>
            <div>
                <h3 style="font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:12px;">What We Check</h3>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <?php foreach (['Radiator core and end tanks — damage, cracks, corrosion','All hoses — upper, lower, bypass, and heater hoses','Thermostat — confirm it opens and closes at the correct temperature','Water pump — check for weep hole leaks and bearing noise','Cooling fan — confirm correct operation at the correct temperature','Coolant condition — colour, concentration, and contamination'] as $item): ?>
                    <div style="display:flex;gap:12px;align-items:flex-start;font-size:14px;color:#333;line-height:1.5;">
                        <span style="color:#FFC800;font-weight:700;flex-shrink:0;margin-top:2px;">✓</span>
                        <?php echo esc_html($item); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="rl-services__grid">
            <?php $initials = ['RR','CF','WP','TS','WL','WH','HC','OE'];
            foreach ($services as $i => $svc): ?>
            <div class="rl-service-item">
                <?php echo rl_mono($initials[$i] ?? 'CS'); ?>
                <span><?php echo $svc; ?></span>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:24px;font-size:14px;color:#666;">→ <a href="<?php echo esc_url($site_url . '/cooling-system/'); ?>" style="font-weight:700;color:#111;">View all cooling system services</a></p>
    </div>
</section>

<section class="rl-why">
    <div class="taas-rl__w">
        <div class="rl-why__inner">
            <div>
                <span class="rl-eyebrow rl-eyebrow--yellow">Why Choose TAAS</span>
                <h2 class="rl-h2 rl-h2--white">Serving <?php echo esc_html($suburb_name); ?> Since <?php echo esc_html($established); ?></h2>
                <p style="font-size:16px;color:#888;line-height:1.6;margin-bottom:28px;">Family-owned, independent, honest. We diagnose first — we find the actual fault before recommending any work.</p>
                <ul class="rl-why__points">
                    <?php foreach (['Diagnose first — find the actual fault before any recommendation','Estimate before we start — no surprise invoices','All makes and models — Japanese, Korean, European','Finance available — Afterpay, Q Card and more','MTA Assured workshop since ' . $established,'Open Monday–Friday, 7:30am–5:00pm'] as $pt): ?>
                    <li class="rl-why__point"><?php echo esc_html($pt); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div style="background:#111;border:1px solid #2a2a2a;border-radius:8px;padding:32px;">
                <h3 style="font-family:'Oswald',Arial,sans-serif;font-size:26px;font-weight:900;color:#FFC800;margin-bottom:12px;">While You're In</h3>
                <p style="font-size:14px;color:#888;line-height:1.6;margin-bottom:20px;">Combine your cooling system repair with a vehicle service, WOF, or cambelt — one visit, less total labour cost.</p>
                <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:24px;">
                    <?php foreach ([['Cambelt & Water Pump','/cambelts-and-water-pumps/'],['Vehicle Servicing','/vehicle-servicing/'],['Warrant of Fitness','/wof/'],['Finance Options','/finance-options/']] as $ex): ?>
                    <a href="<?php echo esc_url($site_url . $ex[1]); ?>" style="display:flex;align-items:center;gap:8px;font-size:14px;color:#FFC800;text-decoration:none;font-weight:600;"><span>→</span><?php echo esc_html($ex[0]); ?></a>
                    <?php endforeach; ?>
                </div>
                <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="rl-btn rl-btn--primary">Book Online</a>
            </div>
        </div>
    </div>
</section>

<!-- ── BOOKING FORM — White ───────────────────────────────────────────────── -->
<section id="rl-booking" style="background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;" aria-labelledby="rl-booking-h2">
    <div class="taas-rl__w">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;max-width:1140px;margin:0 auto;">
            <div>
                <span class="rl-eyebrow rl-eyebrow--dark">Book a Service</span>
                <h2 class="rl-h2" id="rl-booking-h2">Enquire About Cooling System Repair</h2>
                <p style="font-size:16px;color:#666;line-height:1.6;margin-bottom:24px;">Call us or fill in the form and we'll get back to you.</p>
                <ul style="list-style:none;display:flex;flex-direction:column;gap:12px;">
                                        <li style="display:flex;align-items:center;gap:10px;font-size:14px;color:#333;">
                        <span style="color:#FFC800;font-weight:700;font-size:16px;">✓</span>
                        Diagnose first — find the actual fault
                    </li>
                    <li style="display:flex;align-items:center;gap:10px;font-size:14px;color:#333;">
                        <span style="color:#FFC800;font-weight:700;font-size:16px;">✓</span>
                        Estimate before any work begins
                    </li>
                    <li style="display:flex;align-items:center;gap:10px;font-size:14px;color:#333;">
                        <span style="color:#FFC800;font-weight:700;font-size:16px;">✓</span>
                        All makes and models
                    </li>
                    <li style="display:flex;align-items:center;gap:10px;font-size:14px;color:#333;">
                        <span style="color:#FFC800;font-weight:700;font-size:16px;">✓</span>
                        Finance available — Afterpay, Q Card
                    </li>

                </ul>
                <div style="margin-top:28px;padding:20px 24px;background:#F7F7F5;border-left:4px solid #FFC800;border-radius:4px;">
                    <p style="font-size:14px;color:#333;margin:0;line-height:1.7;">
                        <strong>Need finance?</strong> We accept Afterpay, Q Card, GEM Finance and Aotea Finance.
                        <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" style="color:#111;font-weight:700;">View finance options →</a>
                    </p>
                </div>
            </div>
            <div style="background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;">
                <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
                <p style="font-size:14px;color:#666;">Call <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" style="font-weight:700;color:#111;"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="font-weight:700;color:#111;">use our contact form</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="rl-cta">
    <div class="taas-rl__w">
        <span class="rl-eyebrow rl-eyebrow--yellow">Book Today</span>
        <h2 class="rl-h2"><?php echo esc_html($cta_h2); ?></h2>
        <p>Call us or book online. Open Monday to Friday, 7:30am to 5:00pm at 139 Cavendish Drive, Manukau.</p>
        <div class="rl-cta__btns">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="rl-btn rl-btn--primary"><?php echo esc_html($phone_free); ?></a>
            <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="rl-btn rl-btn--outline">Book Online</a>
        </div>
        <p class="rl-cta__info"><?php echo esc_html($hours); ?> &middot; 139 Cavendish Drive, Manukau &middot; Sat &amp; Sun: Closed</p>
    </div>
</section>

<section class="rl-faq" aria-labelledby="rl-faq-h2">
    <div class="taas-rl__w">
        <span class="rl-eyebrow rl-eyebrow--dark">Common Questions</span>
        <h2 class="rl-h2" id="rl-faq-h2"><?php echo esc_html($faq_h2); ?></h2>
        <div class="rl-faq__grid">
            <?php foreach ($faqs as $i => $faq): $qid='rl-q-'.$i; $aid='rl-a-'.$i; ?>
            <div class="rl-faq__item">
                <button id="<?php echo $qid; ?>" class="rl-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>"><?php echo esc_html($faq['q']); ?></button>
                <div id="<?php echo $aid; ?>" class="rl-faq__a" style="<?php echo $i===0?'display:block;':''; ?>"><?php echo wp_kses_post($faq['a']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:32px;font-size:14px;color:#666;text-align:center;"><a href="<?php echo esc_url($site_url . '/cooling-system/'); ?>" style="font-weight:700;color:#111;">← Back to Cooling System Services</a></p>
    </div>
</section>

<section class="rl-suburbs">
    <div class="taas-rl__w">
        <h2 style="font-family:'Oswald',Arial,sans-serif;font-size:24px;font-weight:900;color:#111;margin-bottom:8px;">Other South Auckland Areas</h2>
        <div class="rl-suburb-pills">
            <?php foreach ($other_suburbs as $s): ?>
            <a href="<?php echo esc_url($site_url . $spoke_base . $s['slug'] . '/'); ?>" class="rl-suburb-pill"><?php echo esc_html($s['name']); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</div>

<script type="application/ld+json">
{"@context":"https://schema.org","@graph":[{"@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},{"@type":"ListItem","position":2,"name":"<?php echo esc_js($hub_label); ?>","item":"<?php echo esc_js($site_url . $hub_url); ?>"},{"@type":"ListItem","position":3,"name":"<?php echo esc_js($h1_line1 . ' ' . $suburb_name); ?>","item":"<?php echo esc_js($page_url); ?>"}]},{"@type":["AutoRepair","LocalBusiness"],"@id":"<?php echo esc_js($site_url); ?>/#organization","name":"Tony Allen Auto Service","telephone":["<?php echo esc_js($phone_local); ?>","<?php echo esc_js($phone_free); ?>"],"address":{"@type":"PostalAddress","streetAddress":"139 Cavendish Drive","addressLocality":"Manukau","addressRegion":"Auckland","postalCode":"2104","addressCountry":"NZ"}},{"@type":"FAQPage","mainEntity":[<?php $sf=[];foreach($faqs as $f){$sf[]=sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}',json_encode($f['q']),json_encode(strip_tags($f['a'])));}echo implode(",\n",$sf);?>]}]}
</script>
<script>
(function(){document.querySelectorAll('.rl-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var exp=this.getAttribute('aria-expanded')==='true';document.querySelectorAll('.rl-faq__q').forEach(function(b){b.setAttribute('aria-expanded','false');var a=document.getElementById(b.getAttribute('aria-controls'));if(a)a.style.display='none';});if(!exp){this.setAttribute('aria-expanded','true');var ans=document.getElementById(this.getAttribute('aria-controls'));if(ans)ans.style.display='block';}});});}());
</script>
<?php get_footer(); ?>
