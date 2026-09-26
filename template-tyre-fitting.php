<?php
/**
 * Template Name: Tyre Fitting Manukau
 * Template Post Type: page
 *
 * URL: /tyre-fitting-manukau/
 * Parent: /tyre-centre/
 * Target keyword: tyre fitting manukau — 487 SC impressions
 *
 * Tone: Practical and direct. This is the core service page —
 *       what happens when you come in for new tyres.
 *       Process-heavy, trust signals throughout.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-tf', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

$phone_local     = '09 278 9556';
$phone_free      = '0800 100 876';
$hours           = defined('TAAS_HOURS')           ? TAAS_HOURS           : 'Monday–Friday 7:30am–5:00pm';
$established     = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$google_rating   = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$google_reviews  = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$reviews_widget  = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general     = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$balance_price   = defined('TAAS_BALANCE_PRICE')   ? TAAS_BALANCE_PRICE   : 'from $25 per wheel incl. GST';

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

$process = [
    ['step'=>'1','title'=>'Check Your Tyre Size','desc'=>'Your tyre size is on the sidewall of your current tyres — e.g. 205/55R16. Call us with this before coming in and we\'ll confirm stock. Most common sizes are available same-day.'],
    ['step'=>'2','title'=>'Remove & Inspect','desc'=>'Wheel removed from the vehicle. We inspect the rim for damage and the old tyre for any signs of sidewall damage, run-flat use, or puncture history before fitting the new tyre.'],
    ['step'=>'3','title'=>'Fit New Tyre','desc'=>'Tyre mounted on the rim using our tyre changer. Tyre levers are not used — machine fitting only, which protects alloy rims from damage.'],
    ['step'=>'4','title'=>'Balance','desc'=>'Every tyre we fit is balanced on our ER85 touchscreen balancer. Static, dynamic, and run-out measured in a single spin. Weights placed precisely. This step is included in the price — always.'],
    ['step'=>'5','title'=>'Refit & Torque','desc'=>'Wheel refitted to manufacturer torque specification using a torque wrench — not air gun guesswork. Correct torque protects wheel studs and ensures the wheel stays on.'],
    ['step'=>'6','title'=>'Tyre Pressure & Check','desc'=>'Tyre inflated to manufacturer specification. Final visual check before the vehicle is returned. If we notice anything else that needs attention, we\'ll tell you — no obligation.'],
];

$vehicle_types = [
    ['icon'=>'🚗','label'=>'Cars & Hatchbacks'],
    ['icon'=>'🚙','label'=>'SUVs & Crossovers'],
    ['icon'=>'🚐','label'=>'Vans & MPVs'],
    ['icon'=>'🛻','label'=>'Utes & Pickups'],
    ['icon'=>'🚚','label'=>'Light Trucks'],
    ['icon'=>'🏕️','label'=>'Campervans'],
    ['icon'=>'🚌','label'=>'Mini Buses'],
    ['icon'=>'🔧','label'=>'Fleet Vehicles'],
];

$faqs = [
    [
        'q' => 'How long does tyre fitting take in Manukau?',
        'a' => 'A single tyre is typically 20–30 minutes. A full set of four takes around 60–90 minutes including balancing all four wheels. Drop-in appointments are available in most cases — call ahead on ' . $phone_local . ' and we\'ll confirm wait times for the day.',
    ],
    [
        'q' => 'Is wheel balancing included when you fit tyres?',
        'a' => 'Yes — balancing is included with every tyre we fit. We do not fit tyres without balancing them. An unbalanced tyre causes steering wheel vibration and shortens tyre life. No extra charge.',
    ],
    [
        'q' => 'Do I need to book for tyre fitting in Manukau?',
        'a' => 'Booking is recommended but not always required. Call us on ' . $phone_local . ' and we\'ll confirm availability. Walk-ins are accommodated where we have space. If you need a specific time or are coming from a distance, a booking is worth making.',
    ],
    [
        'q' => 'Can I supply my own tyres and have you fit them?',
        'a' => 'Yes — we fit customer-supplied tyres. Call ahead to confirm the tyre is appropriate for your vehicle and rim size. Balancing is still required and charged separately when fitting customer-supplied tyres.',
    ],
    [
        'q' => 'Do you fit tyres on alloy wheels?',
        'a' => 'Yes — we use machine tyre fitting equipment, not tyre levers. Machine fitting is safer for alloy rims and reduces the risk of bead or wheel damage. Stick-on weights are used on alloy wheels where appropriate to avoid marking the rim.',
    ],
    [
        'q' => 'What happens if I need a wheel alignment after fitting tyres?',
        'a' => 'We can do alignment on the same visit. We recommend it — new tyres wear unevenly if your alignment is out. Alignment is ' . $alignment_price . '. Let us know when you book and we\'ll schedule time for both.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-tf*,.taas-tf*::before,.taas-tf*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-tf{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.tf-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.tf-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.tf-ey--yellow{background:#FFC800;color:#111;}
.tf-ey--dark{background:#1A1A1A;color:#FFC800;}
.tf-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.tf-h1 em{color:#FFC800;font-style:normal;}
.tf-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.tf-h2--white{color:#fff;}
.tf-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.tf-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.tf-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.tf-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.tf-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.tf-btn--outline:hover{background:#FFC800;color:#111;}

/* Hero */
.tf-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.tf-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.tf-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.tf-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.tf-hero__bc a{color:#555;text-decoration:none;}
.tf-hero__bc a:hover{color:#FFC800;}
.tf-hero__bc span{margin:0 6px;}
.tf-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.tf-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.tf-hero__tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px;}
.tf-hero__tag{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:4px;padding:5px 12px;font-size:12px;font-weight:600;color:#888;}
.tf-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.tf-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.tf-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.tf-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.tf-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.tf-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.tf-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

/* Trust */
.tf-trust{background:#FFC800;}
.tf-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.tf-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.tf-trust__icon{font-size:20px;flex-shrink:0;}
.tf-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

/* Process */
.tf-process{background:#F7F7F5;padding:72px 0;}
.tf-process__block{background:#fff;border-radius:8px;border:1px solid #E8E8E4;margin-top:40px;overflow:hidden;}
.tf-process__header{padding:24px 28px;border-bottom:1px solid #E8E8E4;}
.tf-process__header h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:4px;}
.tf-process__header p{font-size:14px;color:#666;}
.tf-steps{display:grid;grid-template-columns:1fr 1fr;gap:24px 40px;padding:28px;}
.tf-step{display:flex;gap:16px;align-items:flex-start;}
.tf-step__num{width:32px;height:32px;background:#FFC800;color:#111;font-size:13px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.tf-step__content h4{font-size:14px;font-weight:700;color:#111;margin-bottom:4px;}
.tf-step__content p{font-size:14px;color:#555;line-height:1.55;}

/* Vehicle types */
.tf-vehicles{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tf-vehicles__grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:32px;}
.tf-vehicle-item{background:#F7F7F5;border:1px solid #E8E8E4;border-radius:6px;padding:16px;display:flex;align-items:center;gap:12px;font-size:14px;font-weight:600;color:#333;}
.tf-vehicle-item__icon{font-size:22px;flex-shrink:0;}

/* Includes panel */
.tf-includes{background:#1A1A1A;padding:72px 0;}
.tf-includes__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tf-includes__list{list-style:none;display:flex;flex-direction:column;gap:14px;}
.tf-includes__item{display:flex;gap:12px;align-items:flex-start;font-size:15px;color:#ccc;line-height:1.5;}
.tf-includes__item::before{content:'✓';color:#111;background:#FFC800;font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.tf-includes__card{background:#111;border-radius:8px;padding:28px;border:1px solid #2a2a2a;}
.tf-includes__card h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#FFC800;margin-bottom:12px;}
.tf-includes__card p{font-size:14px;color:#888;line-height:1.6;margin-bottom:16px;}

/* Reviews */
.tf-reviews{background:#F7F7F5;padding:72px 0;}

/* Booking */
.tf-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tf-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tf-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.tf-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.tf-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.tf-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

/* CTA */
.tf-cta{background:#111;padding:72px 0;text-align:center;}
.tf-cta h2{color:#fff!important;margin-bottom:12px;}
.tf-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.tf-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.tf-cta__info{margin-top:24px;font-size:13px;color:#555;}

/* FAQ */
.tf-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tf-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.tf-faq__item{border-bottom:1px solid #E8E8E4;}
.tf-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.tf-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.tf-faq__q[aria-expanded="true"]::after{content:'−';}
.tf-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

/* Related */
.tf-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.tf-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.tf-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.tf-related__link:hover{border-color:#FFC800;}
.tf-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .tf-hero__inner,.tf-includes__inner,.tf-booking__inner{grid-template-columns:1fr;}
    .tf-hero__card{display:none;}
    .tf-trust__inner{grid-template-columns:1fr 1fr;}
    .tf-steps{grid-template-columns:1fr;}
    .tf-vehicles__grid{grid-template-columns:1fr 1fr;}
    .tf-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .tf-hero,.tf-process,.tf-vehicles,.tf-includes,.tf-reviews,.tf-booking,.tf-cta,.tf-faq{padding:48px 0;}
    .tf-trust__inner{grid-template-columns:1fr 1fr;}
    .tf-vehicles__grid{grid-template-columns:1fr 1fr;}
}
</style>

<div class="taas-tf">

<!-- HERO -->
<section class="tf-hero">
    <div class="tf-w">
        <div class="tf-hero__inner">
            <nav class="tf-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url.'/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>Tyre Fitting Manukau</span>
            </nav>
            <div>
                <span class="tf-ey tf-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="tf-h1">Tyre Fitting<br><em>Manukau</em></h1>
                <p class="tf-hero__sub">
                    Supply and fit at 139 Cavendish Drive. All vehicle types. Budget through premium brands.
                    Balancing included with every tyre — no exceptions.
                </p>
                <div class="tf-hero__btns">
                    <a href="#tf-booking" class="tf-btn tf-btn--primary">Book Tyre Fitting</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tf-btn tf-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
                <div class="tf-hero__tags">
                    <span class="tf-hero__tag">✓ Balancing included</span>
                    <span class="tf-hero__tag">✓ Machine fitting — no tyre levers</span>
                    <span class="tf-hero__tag">✓ Torqued to spec</span>
                    <span class="tf-hero__tag">✓ Alignment same visit</span>
                </div>
            </div>
            <div class="tf-hero__card">
                <h3>Every Tyre Fit Includes</h3>
                <ul>
                    <li>Machine fitting — no lever damage</li>
                    <li>ER85 wheel balance — included</li>
                    <li>Torqued to manufacturer spec</li>
                    <li>Tyre pressure set correctly</li>
                    <li>Visual inspection on removal</li>
                    <li>Alignment available same visit</li>
                </ul>
                <div class="tf-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call direct</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" style="font-size:15px;color:#888;margin-top:4px;font-weight:600;display:block;"><?php echo esc_html($phone_free); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<div class="tf-trust" role="list">
    <div class="tf-w">
        <div class="tf-trust__inner">
            <?php foreach ([
                ['🔧','Machine Fitting — No Tyre Levers'],
                ['🔄','ER85 Balance Included'],
                ['🏆','MTA Assured Workshop'],
                ['⭐',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="tf-trust__item" role="listitem">
                <span class="tf-trust__icon" aria-hidden="true"><?php echo $t[0]; ?></span>
                <span class="tf-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- PROCESS — Grey -->
<section class="tf-process" aria-labelledby="tf-process-h2">
    <div class="tf-w">
        <span class="tf-ey tf-ey--dark">Our Process</span>
        <h2 class="tf-h2" id="tf-process-h2">How We Fit Your Tyres</h2>
        <p class="tf-lead">Six steps. Every vehicle. Done right before it leaves the workshop.</p>
        <div class="tf-process__block">
            <div class="tf-process__header">
                <h3>Tyre Fitting — Full Process</h3>
                <p>From removal to refit — what we do on every tyre fit at 139 Cavendish Drive.</p>
            </div>
            <div class="tf-steps">
                <?php foreach ($process as $s): ?>
                <div class="tf-step">
                    <div class="tf-step__num"><?php echo esc_html($s['step']); ?></div>
                    <div class="tf-step__content">
                        <h4><?php echo esc_html($s['title']); ?></h4>
                        <p><?php echo esc_html($s['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- VEHICLE TYPES — White -->
<section class="tf-vehicles" aria-labelledby="tf-vehicles-h2">
    <div class="tf-w">
        <span class="tf-ey tf-ey--dark">All Vehicle Types</span>
        <h2 class="tf-h2" id="tf-vehicles-h2">We Fit Tyres on Every Vehicle Type</h2>
        <p class="tf-lead">Cars, SUVs, vans, utes, light trucks — if it has tyres, we fit them.</p>
        <div class="tf-vehicles__grid">
            <?php foreach ($vehicle_types as $v): ?>
            <div class="tf-vehicle-item">
                <span class="tf-vehicle-item__icon" aria-hidden="true"><?php echo $v['icon']; ?></span>
                <span><?php echo esc_html($v['label']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- WHAT'S INCLUDED — Dark -->
<section class="tf-includes" aria-labelledby="tf-includes-h2">
    <div class="tf-w">
        <div class="tf-includes__inner">
            <div>
                <span class="tf-ey tf-ey--yellow">What's Included</span>
                <h2 class="tf-h2 tf-h2--white" id="tf-includes-h2">Balancing is Always Included</h2>
                <p style="font-size:16px;color:#888;line-height:1.6;margin-bottom:28px;">
                    Every tyre we fit is balanced on our ER85 touchscreen balancer as standard.
                    No exceptions, no extra charge. This is how tyre fitting should work.
                </p>
                <ul class="tf-includes__list">
                    <?php foreach ([
                        'Machine tyre fitting — no lever marks on alloy rims',
                        'ER85 wheel balance — static, dynamic, and run-out in one spin',
                        'Tyre pressure set to manufacturer specification',
                        'Wheel torqued to spec with a torque wrench',
                        'Visual inspection of rim and old tyre on removal',
                        'Honest report if we notice anything else that needs attention',
                    ] as $item): ?>
                    <li class="tf-includes__item"><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="tf-includes__card">
                <h3>Also Available Same Visit</h3>
                <p>Save a return trip. All of these can be done on the same visit as tyre fitting.</p>
                <?php foreach ([
                    ['Wheel Alignment', $alignment_price, '/wheel-alignment-manukau/'],
                    ['Tyre Rotation','Rotate to even out wear pattern','/tyre-fitting-manukau/'],
                    ['Puncture Repair','Assessed — repaired if safe','/tyre-centre/puncture-repair-manukau/'],
                    ['WOF Inspection','NZTA-authorised from $80','/wof/'],
                ] as $s): ?>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #2a2a2a;">
                    <div>
                        <div style="font-size:14px;font-weight:700;color:#fff;"><?php echo esc_html($s[0]); ?></div>
                        <div style="font-size:12px;color:#666;"><?php echo esc_html($s[1]); ?></div>
                    </div>
                    <a href="<?php echo esc_url($site_url.$s[2]); ?>" style="font-size:13px;color:#FFC800;text-decoration:none;font-weight:700;">Info →</a>
                </div>
                <?php endforeach; ?>
                <a href="#tf-booking" class="tf-btn tf-btn--primary" style="margin-top:20px;width:100%;justify-content:center;">Book Tyre Fitting</a>
            </div>
        </div>
    </div>
</section>

<!-- REVIEWS — Grey -->
<section class="tf-reviews" aria-labelledby="tf-reviews-h2">
    <div class="tf-w">
        <span class="tf-ey tf-ey--dark">Customer Reviews</span>
        <h2 class="tf-h2" id="tf-reviews-h2"><?php echo esc_html($google_reviews); ?> Reviews · <?php echo esc_html($google_rating); ?>★ on Google</h2>
        <p class="tf-lead" style="margin-bottom:32px;">South Auckland's trusted independent workshop since <?php echo esc_html($established); ?>.</p>
        <?php if ($reviews_widget): echo do_shortcode($reviews_widget);
        else: ?>
        <p style="font-size:15px;color:#666;"><a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service" target="_blank" rel="noopener" style="color:#111;font-weight:700;">See our Google reviews →</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- BOOKING — White -->
<section class="tf-booking" id="tf-booking" aria-labelledby="tf-booking-h2">
    <div class="tf-w">
        <div class="tf-booking__inner">
            <div>
                <span class="tf-ey tf-ey--dark">Book Online</span>
                <h2 class="tf-h2" id="tf-booking-h2">Book Tyre Fitting in Manukau</h2>
                <p class="tf-lead">Tell us your tyre size and vehicle — we'll confirm stock and book you in. Or call <?php echo esc_html($phone_local); ?> directly.</p>
                <ul class="tf-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>Balancing included with every fit</li>
                    <li>Alignment available same visit</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
                <div style="margin-top:24px;padding:18px;background:#F7F7F5;border-radius:6px;border:1px solid #E8E8E4;">
                    <p style="font-size:13px;font-weight:700;color:#111;margin-bottom:6px;">Finding your tyre size</p>
                    <p style="font-size:13px;color:#666;line-height:1.6;">Check the sidewall of your current tyre — it's printed there e.g. <strong>205/55R16</strong>. Width / profile / rim diameter. Bring it in if you're not sure.</p>
                </div>
            </div>
            <div class="tf-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA — Dark -->
<section class="tf-cta" aria-labelledby="tf-cta-h2">
    <div class="tf-w">
        <span class="tf-ey tf-ey--yellow">Ready?</span>
        <h2 class="tf-h2 tf-h2--white" id="tf-cta-h2">Get Your Tyres Fitted Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="tf-cta__btns">
            <a href="#tf-booking" class="tf-btn tf-btn--primary">Book Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="tf-btn tf-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tf-btn tf-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="tf-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<!-- FAQ -->
<section class="tf-faq" aria-labelledby="tf-faq-h2">
    <div class="tf-w">
        <span class="tf-ey tf-ey--dark">FAQ</span>
        <h2 class="tf-h2" id="tf-faq-h2">Common Questions</h2>
        <div class="tf-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='tf-faq-q-'.$i; $aid='tf-faq-a-'.$i; ?>
            <div class="tf-faq__item">
                <button id="<?php echo $qid; ?>" class="tf-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="tf-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RELATED -->
<section class="tf-related" aria-label="Related services">
    <div class="tf-w">
        <span class="tf-ey tf-ey--dark">Related Services</span>
        <h2 class="tf-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="tf-related__grid">
            <?php foreach ([
                ['Tyre Centre',       '/tyre-centre/'],
                ['Wheel Alignment',   '/wheel-alignment-manukau/'],
                ['Wheel Balancing',   '/wheel-balancing-manukau/'],
                ['Budget Tyres',      '/tyre-centre/budget-tyres-manukau/'],
                ['4WD Tyres',         '/4wd-tyres-manukau/'],
                ['Puncture Repair',   '/tyre-centre/puncture-repair-manukau/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="tf-related__link"
               onmouseover="this.style.borderColor='#FFC800'" onmouseout="this.style.borderColor='#E8E8E4'">
                <?php echo esc_html($r[0]); ?> <span>→</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</div>

<!-- SCHEMA -->
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@graph":[
    {"@type":"BreadcrumbList","itemListElement":[
      {"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},
      {"@type":"ListItem","position":2,"name":"Tyre Centre","item":"<?php echo esc_js($site_url.'/tyre-centre/'); ?>"},
      {"@type":"ListItem","position":3,"name":"Tyre Fitting Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"Service","name":"Tyre Fitting Manukau",
     "description":"Tyre supply and fitting at Tony Allen Auto Service, 139 Cavendish Drive, Manukau. Machine fitting, balancing included, all vehicle types. Budget to premium brands.",
     "serviceType":"Tyre Fitting",
     "provider":{"@type":"AutoRepair","@id":"<?php echo esc_js($site_url); ?>/#organization",
       "name":"Tony Allen Auto Service","telephone":"<?php echo esc_js($phone_local); ?>",
       "address":{"@type":"PostalAddress","streetAddress":"139 Cavendish Drive","addressLocality":"Manukau","addressRegion":"Auckland","addressCountry":"NZ","postalCode":"2104"},
       "openingHours":"Mo-Fr 07:30-17:00",
       "aggregateRating":{"@type":"AggregateRating","ratingValue":"<?php echo esc_js($google_rating); ?>","reviewCount":"<?php echo esc_js(preg_replace('/[^0-9]/','', $google_reviews)); ?>","bestRating":"5","worstRating":"1"},
       "foundingDate":"<?php echo esc_js($established); ?>",
       "memberOf":{"@type":"Organization","name":"MTA New Zealand"}
     }},
    {"@type":"FAQPage","mainEntity":[
      <?php echo implode(',', array_map(fn($f) => sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}', json_encode($f['q']), json_encode(strip_tags($f['a']))), $faqs)); ?>
    ]}
  ]
}
</script>

<script>
(function(){
    document.querySelectorAll('.tf-faq__q').forEach(function(btn){
        btn.addEventListener('click',function(){
            var exp=this.getAttribute('aria-expanded')==='true';
            document.querySelectorAll('.tf-faq__q').forEach(function(b){
                b.setAttribute('aria-expanded','false');
                var a=document.getElementById(b.getAttribute('aria-controls'));
                if(a)a.style.display='none';
            });
            if(!exp){this.setAttribute('aria-expanded','true');var ans=document.getElementById(this.getAttribute('aria-controls'));if(ans)ans.style.display='block';}
        });
    });
}());
</script>

<?php get_footer(); ?>
