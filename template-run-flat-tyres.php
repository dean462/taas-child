<?php
/**
 * Template Name: Run Flat Tyres Manukau
 * Template Post Type: page
 *
 * URL: /run-flat-tyres-manukau/
 * Parent: /tyre-centre/
 * Target keyword: run flat tyres manukau — 190 SC impressions
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-rft', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

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

$faqs = [
    [
        'q' => 'What is a run-flat tyre?',
        'a' => 'A run-flat tyre has reinforced sidewalls that allow it to continue supporting the vehicle\'s weight after a puncture — typically for up to 80km at reduced speed (usually 80km/h max). This means you can drive to a workshop without stopping to change a tyre by the roadside. Run-flat tyres are standard fitment on many BMW, MINI, and some Mercedes-Benz models.',
    ],
    [
        'q' => 'Can you repair a run-flat tyre after a puncture?',
        'a' => 'In most cases, no. Run-flat tyres that have been driven on while flat — even for a short distance — typically cannot be safely repaired. The sidewall reinforcement can be permanently damaged without any visible external sign. Most manufacturers recommend replacing a run-flat tyre that has been driven on while flat. Bring it in and we\'ll assess it honestly.',
    ],
    [
        'q' => 'Can I replace my run-flat tyres with regular tyres?',
        'a' => 'Technically yes, but there are important considerations. Many vehicles fitted with run-flat tyres as standard don\'t carry a spare wheel — switching to regular tyres means you need to add a spare or run-flat kit. Some vehicles also have TPMS systems calibrated for run-flat behaviour. Call us on ' . $phone_local . ' with your vehicle details and we\'ll advise on your options.',
    ],
    [
        'q' => 'Do you stock run-flat tyres in Manukau?',
        'a' => 'Yes — we stock run-flat tyres in the most common sizes. Call us on ' . $phone_local . ' with your tyre size and vehicle and we\'ll confirm availability and pricing. Run-flat sizing can be less common in some sizes — it\'s worth calling ahead.',
    ],
    [
        'q' => 'How do I know if I have run-flat tyres?',
        'a' => 'Check the tyre sidewall for markings such as "RFT", "ROF", "SSR", "ZP", or "EMT" depending on the brand. Your vehicle handbook will also confirm if run-flat tyres are standard fitment. If you\'re unsure, bring the vehicle in and we\'ll check.',
    ],
    [
        'q' => 'Are run-flat tyres more expensive than regular tyres?',
        'a' => 'Yes — run-flat tyres typically cost 20–40% more than an equivalent regular tyre due to the reinforced sidewall construction. The trade-off is the convenience of continuing to drive after a puncture without stopping. Call us on ' . $phone_local . ' for pricing on your specific size.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-rft*,.taas-rft*::before,.taas-rft*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-rft{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.rft-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.rft-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.rft-ey--yellow{background:#FFC800;color:#111;}
.rft-ey--dark{background:#1A1A1A;color:#FFC800;}
.rft-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.rft-h1 em{color:#FFC800;font-style:normal;}
.rft-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.rft-h2--white{color:#fff;}
.rft-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.rft-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.rft-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.rft-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.rft-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.rft-btn--outline:hover{background:#FFC800;color:#111;}

.rft-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.rft-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.rft-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.rft-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.rft-hero__bc a{color:#555;text-decoration:none;}
.rft-hero__bc a:hover{color:#FFC800;}
.rft-hero__bc span{margin:0 6px;}
.rft-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.rft-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.rft-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.rft-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.rft-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.rft-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.rft-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.rft-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.rft-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

.rft-trust{background:#FFC800;}
.rft-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.rft-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.rft-trust__icon{font-size:20px;flex-shrink:0;}
.rft-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

.rft-what{background:#fff;padding:72px 0;}
.rft-what__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.rft-what__body p{font-size:16px;color:#333;line-height:1.7;}
.rft-what__body p+p{margin-top:16px;}
.rft-alert{background:#F7F7F5;border-left:4px solid #FFC800;border-radius:0 6px 6px 0;padding:18px 20px;margin-top:20px;}
.rft-alert h4{font-size:14px;font-weight:700;color:#111;margin-bottom:6px;}
.rft-alert p{font-size:14px;color:#555;line-height:1.6;margin:0;}
.rft-info-card{background:#111;border-radius:8px;padding:28px;}
.rft-info-card h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#FFC800;margin-bottom:14px;}
.rft-info-list{list-style:none;display:flex;flex-direction:column;gap:10px;}
.rft-info-list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:#ccc;line-height:1.5;}
.rft-info-list li::before{content:'→';color:#FFC800;font-weight:700;flex-shrink:0;}

.rft-vehicles{background:#F7F7F5;padding:72px 0;}
.rft-vehicles__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;}
.rft-vehicle-card{background:#fff;border:1px solid #E8E8E4;border-radius:8px;padding:22px;}
.rft-vehicle-card h4{font-family:'Oswald',Arial,sans-serif;font-size:18px;font-weight:900;color:#111;margin-bottom:8px;}
.rft-vehicle-card p{font-size:13px;color:#555;line-height:1.55;}
.rft-vehicle-card__brands{font-size:12px;color:#888;margin-top:8px;font-style:italic;}

.rft-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.rft-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.rft-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.rft-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.rft-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.rft-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

.rft-cta{background:#111;padding:72px 0;text-align:center;}
.rft-cta h2{color:#fff!important;margin-bottom:12px;}
.rft-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.rft-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.rft-cta__info{margin-top:24px;font-size:13px;color:#555;}

.rft-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.rft-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.rft-faq__item{border-bottom:1px solid #E8E8E4;}
.rft-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.rft-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.rft-faq__q[aria-expanded="true"]::after{content:'−';}
.rft-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

.rft-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.rft-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:24px;}
.rft-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.rft-related__link:hover{border-color:#FFC800;}
.rft-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .rft-hero__inner,.rft-what__inner,.rft-booking__inner{grid-template-columns:1fr;}
    .rft-hero__card{display:none;}
    .rft-trust__inner{grid-template-columns:1fr 1fr;}
    .rft-vehicles__grid{grid-template-columns:1fr 1fr;}
    .rft-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .rft-hero,.rft-what,.rft-vehicles,.rft-booking,.rft-cta,.rft-faq{padding:48px 0;}
    .rft-trust__inner,.rft-vehicles__grid{grid-template-columns:1fr 1fr;}
}
</style>

<div class="taas-rft">

<section class="rft-hero">
    <div class="rft-w">
        <div class="rft-hero__inner">
            <nav class="rft-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url.'/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>Run-Flat Tyres Manukau</span>
            </nav>
            <div>
                <span class="rft-ey rft-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="rft-h1">Run-Flat Tyres<br><em>Manukau</em></h1>
                <p class="rft-hero__sub">Supply and fit run-flat tyres at 139 Cavendish Drive. BMW, MINI, Mercedes-Benz, and all RFT-compatible vehicles. Call ahead with your size — availability varies.</p>
                <div class="rft-hero__btns">
                    <a href="#rft-booking" class="rft-btn rft-btn--primary">Enquire About Run-Flats</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="rft-btn rft-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
            <div class="rft-hero__card">
                <h3>Run-Flat Tyre Service</h3>
                <ul>
                    <li>Supply &amp; fit run-flat tyres</li>
                    <li>All RFT-compatible vehicles</li>
                    <li>BMW, MINI, Mercedes-Benz</li>
                    <li>Balancing included</li>
                    <li>Honest assessment of used RFTs</li>
                    <li>Call ahead for availability</li>
                </ul>
                <div class="rft-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call for availability</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="rft-trust" role="list">
    <div class="rft-w">
        <div class="rft-trust__inner">
            <?php foreach ([
                ['🛡️','Run-Flat Supply & Fit'],
                ['🔄','Balancing Included'],
                ['🏆','MTA Assured Workshop'],
                ['⭐',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="rft-trust__item" role="listitem">
                <span class="rft-trust__icon"><?php echo $t[0]; ?></span>
                <span class="rft-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="rft-what" aria-labelledby="rft-what-h2">
    <div class="rft-w">
        <div class="rft-what__inner">
            <div>
                <span class="rft-ey rft-ey--dark">What Are Run-Flat Tyres?</span>
                <h2 class="rft-h2" id="rft-what-h2">Drive Up to 80km After a Puncture</h2>
                <div class="rft-what__body">
                    <p>Run-flat tyres have reinforced sidewalls that support the vehicle's weight even after a complete loss of tyre pressure. Instead of immediately going flat, they allow you to continue driving — typically up to 80km at a maximum of 80km/h — giving you time to reach a workshop safely.</p>
                    <p>They are standard fitment on many BMW and MINI models, some Mercedes-Benz vehicles, and other European makes. Vehicles fitted with run-flat tyres as standard often don't carry a spare wheel.</p>
                    <p>The main trade-off is cost — run-flat tyres are typically 20–40% more expensive than equivalent regular tyres. They also generally cannot be repaired after being driven on while flat.</p>
                </div>
                <div class="rft-alert">
                    <h4>⚠️ Run-flat tyres driven on while flat usually need replacing</h4>
                    <p>Even a short distance driven on a flat run-flat can permanently damage the internal sidewall reinforcement — without any visible external sign. We assess every run-flat honestly before recommending replacement.</p>
                </div>
            </div>
            <div class="rft-info-card">
                <h3>How to Identify Run-Flat Tyres</h3>
                <p style="font-size:14px;color:#888;line-height:1.6;margin-bottom:16px;">Look for these markings on the sidewall — different brands use different codes:</p>
                <ul class="rft-info-list">
                    <li><strong style="color:#fff;">RFT</strong> — Bridgestone / Generic</li>
                    <li><strong style="color:#fff;">ROF</strong> — Michelin Run On Flat</li>
                    <li><strong style="color:#fff;">SSR</strong> — Continental Self Supporting Runflat</li>
                    <li><strong style="color:#fff;">ZP / ZPS</strong> — Michelin Zero Pressure</li>
                    <li><strong style="color:#fff;">EMT</strong> — Goodyear Extended Mobility</li>
                    <li><strong style="color:#fff;">RSC</strong> — Bridgestone Run-Flat System Component</li>
                </ul>
                <div style="margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;">
                    <p style="font-size:13px;color:#666;margin-bottom:12px;">Not sure? Bring the vehicle in and we'll check.</p>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="rft-btn rft-btn--primary" style="width:100%;justify-content:center;"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="rft-vehicles" aria-labelledby="rft-vehicles-h2">
    <div class="rft-w">
        <span class="rft-ey rft-ey--dark">Common RFT Vehicles</span>
        <h2 class="rft-h2" id="rft-vehicles-h2">Vehicles That Commonly Use Run-Flat Tyres</h2>
        <div class="rft-vehicles__grid">
            <?php foreach ([
                ['BMW','Most BMW models since 2003 are standard fitment with run-flat tyres, particularly 3 Series, 5 Series, and X models.','Common sizes: 225/45R17, 245/45R18, 255/40R19'],
                ['MINI','Most MINI models use run-flat tyres as standard. No spare wheel included.','Common sizes: 195/55R16, 205/45R17, 225/40R18'],
                ['Mercedes-Benz','Selected Mercedes-Benz models use run-flat tyres, particularly C-Class and E-Class.','Common sizes: 225/45R17, 245/40R18, 255/35R19'],
                ['Audi','Some Audi models — particularly later A4 and A6 variants — use extended mobility tyres.','Common sizes: 225/50R17, 245/40R18'],
                ['Other European','Various Porsche, Volvo, and other European models have run-flat fitment on selected variants.','Check your vehicle handbook'],
                ['Your Vehicle','Not sure if your vehicle has run-flat tyres? Call us with your registration and we can advise.','Call 09 278 9556'],
            ] as $v): ?>
            <div class="rft-vehicle-card">
                <h4><?php echo esc_html($v[0]); ?></h4>
                <p><?php echo esc_html($v[1]); ?></p>
                <p class="rft-vehicle-card__brands"><?php echo esc_html($v[2]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="rft-booking" id="rft-booking" aria-labelledby="rft-booking-h2">
    <div class="rft-w">
        <div class="rft-booking__inner">
            <div>
                <span class="rft-ey rft-ey--dark">Enquire</span>
                <h2 class="rft-h2" id="rft-booking-h2">Enquire About Run-Flat Tyres</h2>
                <p class="rft-lead">Call ahead with your tyre size and vehicle — run-flat availability varies by size. We'll confirm stock and pricing before you come in.</p>
                <ul class="rft-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>Balancing included with every fit</li>
                    <li>Honest assessment of existing RFTs</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="rft-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="rft-cta" aria-labelledby="rft-cta-h2">
    <div class="rft-w">
        <span class="rft-ey rft-ey--yellow">Ready?</span>
        <h2 class="rft-h2 rft-h2--white" id="rft-cta-h2">Get Run-Flat Tyres Fitted Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="rft-cta__btns">
            <a href="#rft-booking" class="rft-btn rft-btn--primary">Enquire Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="rft-btn rft-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="rft-btn rft-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="rft-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<section class="rft-faq" aria-labelledby="rft-faq-h2">
    <div class="rft-w">
        <span class="rft-ey rft-ey--dark">FAQ</span>
        <h2 class="rft-h2" id="rft-faq-h2">Common Questions</h2>
        <div class="rft-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='rft-faq-q-'.$i; $aid='rft-faq-a-'.$i; ?>
            <div class="rft-faq__item">
                <button id="<?php echo $qid; ?>" class="rft-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="rft-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="rft-related" aria-label="Related services">
    <div class="rft-w">
        <span class="rft-ey rft-ey--dark">Related Services</span>
        <h2 class="rft-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="rft-related__grid">
            <?php foreach ([
                ['Tyre Centre',       '/tyre-centre/'],
                ['Tyre Fitting',      '/tyre-fitting-manukau/'],
                ['4WD Tyres',         '/4wd-tyres-manukau/'],
                ['Wheel Alignment',   '/wheel-alignment-manukau/'],
                ['TPMS Service',      '/tpms-reset-manukau/'],
                ['Puncture Repair',   '/tyre-centre/puncture-repair-manukau/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="rft-related__link"
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
      {"@type":"ListItem","position":3,"name":"Run-Flat Tyres Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"Service","name":"Run-Flat Tyres Manukau","serviceType":"Tyre Fitting",
     "description":"Run-flat tyre supply and fitting at Tony Allen Auto Service, Manukau. BMW, MINI, Mercedes-Benz and all RFT vehicles. Balancing included.",
     "provider":{"@type":"AutoRepair","@id":"<?php echo esc_js($site_url); ?>/#organization",
       "name":"Tony Allen Auto Service","telephone":"<?php echo esc_js($phone_local); ?>",
       "address":{"@type":"PostalAddress","streetAddress":"139 Cavendish Drive","addressLocality":"Manukau","addressRegion":"Auckland","addressCountry":"NZ","postalCode":"2104"},
       "openingHours":"Mo-Fr 07:30-17:00",
       "aggregateRating":{"@type":"AggregateRating","ratingValue":"<?php echo esc_js($google_rating); ?>","reviewCount":"<?php echo esc_js(preg_replace('/[^0-9]/','', $google_reviews)); ?>","bestRating":"5","worstRating":"1"},
       "foundingDate":"<?php echo esc_js($established); ?>"
     }},
    {"@type":"FAQPage","mainEntity":[
      <?php echo implode(',', array_map(fn($f) => sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}', json_encode($f['q']), json_encode(strip_tags($f['a']))), $faqs)); ?>
    ]}
  ]
}
</script>
<script>
(function(){document.querySelectorAll('.rft-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var exp=this.getAttribute('aria-expanded')==='true';document.querySelectorAll('.rft-faq__q').forEach(function(b){b.setAttribute('aria-expanded','false');var a=document.getElementById(b.getAttribute('aria-controls'));if(a)a.style.display='none';});if(!exp){this.setAttribute('aria-expanded','true');var ans=document.getElementById(this.getAttribute('aria-controls'));if(ans)ans.style.display='block';}});});}());
</script>
<?php get_footer(); ?>
