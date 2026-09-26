<?php
/**
 * Template Name: TPMS Reset Manukau
 * Template Post Type: page
 *
 * URL: /tpms-reset-manukau/
 * Parent: /tyre-centre/
 *
 * Tone: Clear and educational. Most customers don't understand TPMS.
 *       Explain what it is, why the light is on, what we do.
 *       Good supporting content — captures tyre pressure warning light searches.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-tpms', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

$phone_local    = '09 278 9556';
$phone_free     = '0800 100 876';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$google_rating  = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$google_reviews = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

$why_light_on = [
    ['icon'=>'💨','title'=>'Tyre Pressure Low','desc'=>'The most common reason. One or more tyres has dropped below the minimum pressure threshold — typically 25% below recommended. Check and inflate before driving further.'],
    ['icon'=>'🌡️','title'=>'Temperature Change','desc'=>'Cold weather reduces tyre pressure. A significant overnight temperature drop can trigger TPMS even on tyres that were correctly inflated. Inflate to spec and the light should clear.'],
    ['icon'=>'🔄','title'=>'After Tyre Fitting or Rotation','desc'=>'TPMS sensors need to be reset after tyres are rotated or replaced. The system may not recognise the new sensor positions until a reset is performed.'],
    ['icon'=>'🔋','title'=>'Sensor Battery Low','desc'=>'TPMS sensors run on batteries with a typical life of 5–10 years. When the battery dies, the sensor stops transmitting and the light activates.'],
    ['icon'=>'📡','title'=>'Sensor Fault or Damage','desc'=>'A sensor can be damaged during tyre fitting or by road debris. A faulty sensor will trigger the TPMS warning light.'],
    ['icon'=>'🖥️','title'=>'System Needs Calibration','desc'=>'On some vehicles with indirect TPMS (no physical sensors — uses wheel speed instead), the system needs recalibration after tyre changes.'],
];

$faqs = [
    [
        'q' => 'What does the TPMS warning light mean?',
        'a' => 'TPMS stands for Tyre Pressure Monitoring System. The warning light — typically a cross-section of a tyre with an exclamation mark — means one or more tyres has dropped below the minimum safe pressure threshold. Check your tyre pressures first. If all pressures are correct and the light remains on, the system may need a reset or a sensor may have a fault.',
    ],
    [
        'q' => 'Can I drive with the TPMS light on?',
        'a' => 'You should check your tyre pressures before continuing to drive. If the light is on due to genuinely low pressure, continuing to drive risks tyre damage or failure. If you\'ve checked the pressures, they\'re all correct, and the light is still on, it\'s likely a sensor or system issue rather than an immediate safety concern — but get it checked.',
    ],
    [
        'q' => 'Why is my TPMS light on after fitting new tyres?',
        'a' => 'TPMS sensors need to be reset after new tyres are fitted or rotated. The system needs to re-learn the position of each sensor (or the wheel speed pattern in indirect systems). If we fitted your tyres, bring the vehicle back and we\'ll reset the TPMS. No charge if we did the tyre fitting.',
    ],
    [
        'q' => 'How do you reset a TPMS?',
        'a' => 'It depends on the system type. Direct TPMS (physical sensors in each wheel) often requires a scan tool to reset and re-learn sensor positions. Indirect TPMS (using ABS wheel speed sensors) can often be reset via a button or menu in the vehicle. On some vehicles a simple drive at speed after inflating to correct pressure will clear the light. We use diagnostic equipment to reset and verify TPMS on all systems.',
    ],
    [
        'q' => 'Do TPMS sensors need to be replaced when I fit new tyres?',
        'a' => 'Not necessarily — if your existing sensors are working and within their service life, they can be transferred to new tyres. However, the valve stem and seal should be inspected and replaced if needed. If a sensor battery is near end of life (typically after 5–7 years), replacement at the time of tyre fitting avoids a second service visit later.',
    ],
    [
        'q' => 'How much does TPMS service cost in Manukau?',
        'a' => 'Cost varies depending on what\'s needed — a simple reset is typically a short job, while sensor replacement involves parts and more labour. Call us on ' . $phone_local . ' with your vehicle make, model, and year and we\'ll give you a price.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-tpms*,.taas-tpms*::before,.taas-tpms*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-tpms{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.tpms-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.tpms-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.tpms-ey--yellow{background:#FFC800;color:#111;}
.tpms-ey--dark{background:#1A1A1A;color:#FFC800;}
.tpms-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.tpms-h1 em{color:#FFC800;font-style:normal;}
.tpms-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.tpms-h2--white{color:#fff;}
.tpms-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.tpms-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.tpms-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.tpms-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.tpms-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.tpms-btn--outline:hover{background:#FFC800;color:#111;}

.tpms-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.tpms-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.tpms-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.tpms-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.tpms-hero__bc a{color:#555;text-decoration:none;}
.tpms-hero__bc a:hover{color:#FFC800;}
.tpms-hero__bc span{margin:0 6px;}
.tpms-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.tpms-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.tpms-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.tpms-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.tpms-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.tpms-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.tpms-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.tpms-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.tpms-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

.tpms-trust{background:#FFC800;}
.tpms-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.tpms-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.tpms-trust__icon{font-size:20px;flex-shrink:0;}
.tpms-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

.tpms-why{background:#fff;padding:72px 0;}
.tpms-why__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:40px;}
.tpms-why-card{background:#F7F7F5;border:1px solid #E8E8E4;border-radius:8px;padding:22px;}
.tpms-why-card__icon{font-size:28px;margin-bottom:12px;}
.tpms-why-card__title{font-family:'Oswald',Arial,sans-serif;font-size:18px;font-weight:900;color:#111;margin-bottom:8px;}
.tpms-why-card__desc{font-size:14px;color:#555;line-height:1.6;}

.tpms-service{background:#F7F7F5;padding:72px 0;}
.tpms-service__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tpms-service__body p{font-size:16px;color:#333;line-height:1.7;}
.tpms-service__body p+p{margin-top:16px;}
.tpms-service__list{list-style:none;margin-top:20px;display:flex;flex-direction:column;gap:10px;}
.tpms-service__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:#333;line-height:1.5;}
.tpms-service__list li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;}
.tpms-action{background:#111;border-radius:8px;padding:28px;}
.tpms-action h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#FFC800;margin-bottom:12px;}
.tpms-action p{font-size:14px;color:#888;line-height:1.6;margin-bottom:16px;}
.tpms-action__steps{list-style:none;display:flex;flex-direction:column;gap:12px;margin-bottom:20px;}
.tpms-action__steps li{display:flex;gap:12px;align-items:flex-start;font-size:14px;color:#ccc;line-height:1.4;}
.tpms-action__num{background:#FFC800;color:#111;font-size:12px;font-weight:800;width:22px;height:22px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;}

.tpms-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tpms-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tpms-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.tpms-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.tpms-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.tpms-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

.tpms-cta{background:#111;padding:72px 0;text-align:center;}
.tpms-cta h2{color:#fff!important;margin-bottom:12px;}
.tpms-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.tpms-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.tpms-cta__info{margin-top:24px;font-size:13px;color:#555;}

.tpms-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tpms-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.tpms-faq__item{border-bottom:1px solid #E8E8E4;}
.tpms-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.tpms-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.tpms-faq__q[aria-expanded="true"]::after{content:'−';}
.tpms-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

.tpms-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.tpms-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:24px;}
.tpms-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.tpms-related__link:hover{border-color:#FFC800;}
.tpms-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .tpms-hero__inner,.tpms-service__inner,.tpms-booking__inner{grid-template-columns:1fr;}
    .tpms-hero__card{display:none;}
    .tpms-trust__inner,.tpms-why__grid{grid-template-columns:1fr 1fr;}
    .tpms-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .tpms-hero,.tpms-why,.tpms-service,.tpms-booking,.tpms-cta,.tpms-faq{padding:48px 0;}
    .tpms-trust__inner{grid-template-columns:1fr 1fr;}
    .tpms-why__grid{grid-template-columns:1fr;}
}
</style>

<div class="taas-tpms">

<section class="tpms-hero">
    <div class="tpms-w">
        <div class="tpms-hero__inner">
            <nav class="tpms-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url.'/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>TPMS Reset Manukau</span>
            </nav>
            <div>
                <span class="tpms-ey tpms-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="tpms-h1">TPMS Reset &amp;<br><em>Sensor Service</em></h1>
                <p class="tpms-hero__sub">Tyre pressure warning light on? We diagnose, reset, and service TPMS systems at 139 Cavendish Drive. All vehicle makes and models.</p>
                <div class="tpms-hero__btns">
                    <a href="#tpms-booking" class="tpms-btn tpms-btn--primary">Enquire About TPMS</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tpms-btn tpms-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
            <div class="tpms-hero__card">
                <h3>TPMS Service</h3>
                <ul>
                    <li>TPMS diagnosis &amp; reset</li>
                    <li>Sensor replacement</li>
                    <li>Valve stem service</li>
                    <li>Direct &amp; indirect systems</li>
                    <li>After tyre fitting reset</li>
                    <li>All makes &amp; models</li>
                </ul>
                <div class="tpms-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call to enquire</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tpms-trust" role="list">
    <div class="tpms-w">
        <div class="tpms-trust__inner">
            <?php foreach ([
                ['📡','TPMS Diagnosis & Reset'],
                ['🔧','Sensor Replacement'],
                ['🏆','MTA Assured Workshop'],
                ['⭐',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="tpms-trust__item" role="listitem">
                <span class="tpms-trust__icon"><?php echo $t[0]; ?></span>
                <span class="tpms-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="tpms-why" aria-labelledby="tpms-why-h2">
    <div class="tpms-w">
        <span class="tpms-ey tpms-ey--dark">Why Is the Light On?</span>
        <h2 class="tpms-h2" id="tpms-why-h2">Common Reasons Your TPMS Light Is On</h2>
        <p class="tpms-lead">The tyre pressure warning light can come on for several reasons — not all of them mean your tyre is flat right now.</p>
        <div class="tpms-why__grid">
            <?php foreach ($why_light_on as $w): ?>
            <div class="tpms-why-card">
                <div class="tpms-why-card__icon"><?php echo $w['icon']; ?></div>
                <div class="tpms-why-card__title"><?php echo esc_html($w['title']); ?></div>
                <div class="tpms-why-card__desc"><?php echo esc_html($w['desc']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="tpms-service" aria-labelledby="tpms-service-h2">
    <div class="tpms-w">
        <div class="tpms-service__inner">
            <div>
                <span class="tpms-ey tpms-ey--dark">What We Do</span>
                <h2 class="tpms-h2" id="tpms-service-h2">TPMS Diagnosis, Reset &amp; Sensor Service</h2>
                <div class="tpms-service__body">
                    <p>We use diagnostic equipment to read TPMS fault codes, identify which sensor (if any) is causing the issue, and reset the system after repairs or tyre service. We service both direct TPMS (physical sensors in the wheel) and indirect TPMS (using ABS wheel speed sensors).</p>
                    <p>If a sensor needs replacement, we use quality replacement sensors and programme them to the vehicle. We also replace valve stems and seals as part of any TPMS sensor service.</p>
                </div>
                <ul class="tpms-service__list">
                    <?php foreach ([
                        'TPMS diagnostic scan — identify which sensor or system is at fault',
                        'Reset after tyre fitting or rotation',
                        'Sensor replacement — programmed to vehicle',
                        'Valve stem and seal replacement',
                        'Indirect TPMS calibration and reset',
                        'All makes and models including European vehicles',
                    ] as $item): ?>
                    <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="tpms-action">
                <h3>First Check Your Pressures</h3>
                <p>Before bringing the vehicle in, check all four tyre pressures and inflate to the manufacturer's recommendation (found on the door jamb sticker or owner's manual). Then:</p>
                <ul class="tpms-action__steps">
                    <li><span class="tpms-action__num">1</span>Inflate all four tyres to correct pressure</li>
                    <li><span class="tpms-action__num">2</span>Drive at speed for 10+ minutes — some systems reset automatically</li>
                    <li><span class="tpms-action__num">3</span>If the light is still on, bring it in — we'll diagnose and reset</li>
                </ul>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tpms-btn tpms-btn--primary" style="width:100%;justify-content:center;">
                    Call <?php echo esc_html($phone_local); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="tpms-booking" id="tpms-booking" aria-labelledby="tpms-booking-h2">
    <div class="tpms-w">
        <div class="tpms-booking__inner">
            <div>
                <span class="tpms-ey tpms-ey--dark">Enquire</span>
                <h2 class="tpms-h2" id="tpms-booking-h2">TPMS Service — Enquire Online</h2>
                <p class="tpms-lead">Tell us your vehicle make, model, and what the warning light is doing — we'll advise on what's needed and book you in.</p>
                <ul class="tpms-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>All makes and models</li>
                    <li>Direct &amp; indirect TPMS</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="tpms-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="tpms-cta" aria-labelledby="tpms-cta-h2">
    <div class="tpms-w">
        <span class="tpms-ey tpms-ey--yellow">Ready?</span>
        <h2 class="tpms-h2 tpms-h2--white" id="tpms-cta-h2">Get Your TPMS Light Sorted</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="tpms-cta__btns">
            <a href="#tpms-booking" class="tpms-btn tpms-btn--primary">Enquire Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="tpms-btn tpms-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tpms-btn tpms-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="tpms-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<section class="tpms-faq" aria-labelledby="tpms-faq-h2">
    <div class="tpms-w">
        <span class="tpms-ey tpms-ey--dark">FAQ</span>
        <h2 class="tpms-h2" id="tpms-faq-h2">Common Questions</h2>
        <div class="tpms-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='tpms-faq-q-'.$i; $aid='tpms-faq-a-'.$i; ?>
            <div class="tpms-faq__item">
                <button id="<?php echo $qid; ?>" class="tpms-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="tpms-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="tpms-related" aria-label="Related services">
    <div class="tpms-w">
        <span class="tpms-ey tpms-ey--dark">Related Services</span>
        <h2 class="tpms-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="tpms-related__grid">
            <?php foreach ([
                ['Tyre Fitting',      '/tyre-fitting-manukau/'],
                ['Tyre Centre',       '/tyre-centre/'],
                ['Run-Flat Tyres',    '/run-flat-tyres-manukau/'],
                ['Diagnostic Scanning','/diagnostic-scanning/'],
                ['Wheel Alignment',   '/wheel-alignment-manukau/'],
                ['WOF Inspections',   '/wof/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="tpms-related__link"
               onmouseover="this.style.borderColor='#FFC800'" onmouseout="this.style.borderColor='#E8E8E4'">
                <?php echo esc_html($r[0]); ?> <span>→</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</div>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@graph":[
    {"@type":"BreadcrumbList","itemListElement":[
      {"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},
      {"@type":"ListItem","position":2,"name":"Tyre Centre","item":"<?php echo esc_js($site_url.'/tyre-centre/'); ?>"},
      {"@type":"ListItem","position":3,"name":"TPMS Reset Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"FAQPage","mainEntity":[
      <?php echo implode(',', array_map(fn($f) => sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}', json_encode($f['q']), json_encode(strip_tags($f['a']))), $faqs)); ?>
    ]}
  ]
}
</script>
<script>
(function(){document.querySelectorAll('.tpms-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var exp=this.getAttribute('aria-expanded')==='true';document.querySelectorAll('.tpms-faq__q').forEach(function(b){b.setAttribute('aria-expanded','false');var a=document.getElementById(b.getAttribute('aria-controls'));if(a)a.style.display='none';});if(!exp){this.setAttribute('aria-expanded','true');var ans=document.getElementById(this.getAttribute('aria-controls'));if(ans)ans.style.display='block';}});});}());
</script>
<?php get_footer(); ?>
