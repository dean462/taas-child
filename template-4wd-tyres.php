<?php
/**
 * Template Name: 4WD Tyres Manukau
 * Template Post Type: page
 *
 * URL: /4wd-tyres-manukau/
 * Parent: /tyre-centre/
 * Target keyword: 4wd tyres manukau — 340 SC impressions
 *
 * Tone: Practical and specific. 4WD buyers are knowledgeable —
 *       speak their language. AT vs MT vs HT distinction matters.
 *       Fitment and load rating knowledge builds trust.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-4wd', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

$phone_local     = '09 278 9556';
$phone_free      = '0800 100 876';
$hours           = defined('TAAS_HOURS')           ? TAAS_HOURS           : 'Monday–Friday 7:30am–5:00pm';
$established     = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$google_rating   = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$google_reviews  = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$reviews_widget  = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general     = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

$tyre_types = [
    [
        'type'   => 'All-Terrain (AT)',
        'icon'   => '🗺️',
        'desc'   => 'The most popular 4WD tyre. Handles well on-road while still capable off-road. Good for drivers who mix highway and gravel.',
        'best'   => 'Weekend off-roading, rural driveways, lifestyle blocks, towing on mixed surfaces',
        'brands' => 'Maxxis Bravo AT, Toyo Open Country AT, Nitto Terra Grappler',
    ],
    [
        'type'   => 'Mud Terrain (MT)',
        'icon'   => '🌿',
        'desc'   => 'Aggressive tread pattern for serious off-road use. Louder on-road and higher rolling resistance. Built for mud, rock, and heavy going.',
        'best'   => 'Serious off-road use, farm tracks, 4WD competitions, regular mud driving',
        'brands' => 'Maxxis Trepador, Toyo Open Country MT, Nitto Trail Grappler',
    ],
    [
        'type'   => 'Highway Terrain (HT)',
        'icon'   => '🏙️',
        'desc'   => 'On-road comfort and efficiency in a 4WD size. Quiet, good fuel economy, long tread life. For SUVs and 4WDs that rarely go off-road.',
        'best'   => 'Urban SUVs, school runs, highway commuting, towing on sealed roads',
        'brands' => 'Toyo H08, Maxxis HP M8, Hankook Dynapro HT',
    ],
    [
        'type'   => 'SUV / Crossover',
        'icon'   => '🚙',
        'desc'   => 'Designed for car-based SUVs and crossovers. Similar to passenger tyres but in larger sizes. Comfort-focused.',
        'best'   => 'Crossovers, soft-roaders, medium SUVs on sealed roads',
        'brands' => 'Maxxis HP M8, Hankook Dynapro HP2, Nankang SP-9',
    ],
];

$sizes = [
    '265/70R16', '265/75R16', '285/75R16',
    '265/65R17', '265/70R17', '285/70R17', '285/65R17',
    '265/60R18', '265/65R18', '285/60R18', '285/65R18',
    '265/50R20', '285/50R20', '295/55R20',
];

$faqs = [
    [
        'q' => 'What is the difference between AT and MT tyres?',
        'a' => 'All-terrain (AT) tyres have a moderate tread pattern that works well on-road and off-road. They handle gravel, mud, and light off-road well while still being quiet and comfortable on sealed roads. Mud terrain (MT) tyres have a much more aggressive tread designed specifically for serious off-road conditions — deep mud, rocks, and rough terrain. MT tyres are louder on sealed roads and wear faster in regular driving. Most 4WD owners who occasionally go off-road choose AT tyres. Those who go off-road regularly or do serious work choose MT.',
    ],
    [
        'q' => 'Do you stock 4WD tyres in Manukau?',
        'a' => 'Yes — we stock a range of 4WD tyre sizes and types at 139 Cavendish Drive, Manukau. Call us on ' . $phone_local . ' with your tyre size and we\'ll confirm what\'s in stock and give you options across different types and price points.',
    ],
    [
        'q' => 'Is wheel balancing included when you fit 4WD tyres?',
        'a' => 'Yes — balancing is included with every tyre we fit, including 4WD and SUV sizes. We use our ER85 touchscreen balancer which handles large rim and tyre combinations. No extra charge.',
    ],
    [
        'q' => 'Should I get a wheel alignment after fitting new 4WD tyres?',
        'a' => 'Yes, especially if you\'re changing tyre size or moving between tyre types. A size change can affect your alignment settings. We recommend alignment after any tyre change on a 4WD. Alignment is ' . $alignment_price . ' and available on the same visit.',
    ],
    [
        'q' => 'Can you fit plus-sized tyres on my 4WD?',
        'a' => 'In many cases yes — but there are things to consider. Larger tyres can affect speedometer accuracy, fuel economy, clearance, and load ratings. Call us on ' . $phone_local . ' with your vehicle details and the size you\'re considering and we\'ll advise whether it\'s appropriate for your setup.',
    ],
    [
        'q' => 'Do you fit tyres on dual-cab utes?',
        'a' => 'Yes — we fit tyres on dual-cab utes, single-cabs, SUVs, and 4WD wagons. For utes used for towing or work, we\'ll make sure the tyre has an appropriate load rating for your application.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-4wd*,.taas-4wd*::before,.taas-4wd*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-4wd{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.fw-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.fw-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.fw-ey--yellow{background:#FFC800;color:#111;}
.fw-ey--dark{background:#1A1A1A;color:#FFC800;}
.fw-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.fw-h1 em{color:#FFC800;font-style:normal;}
.fw-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.fw-h2--white{color:#fff;}
.fw-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.fw-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.fw-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.fw-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.fw-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.fw-btn--outline:hover{background:#FFC800;color:#111;}

/* Hero */
.fw-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.fw-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.fw-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.fw-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.fw-hero__bc a{color:#555;text-decoration:none;}
.fw-hero__bc a:hover{color:#FFC800;}
.fw-hero__bc span{margin:0 6px;}
.fw-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.fw-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.fw-hero__tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px;}
.fw-hero__tag{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:4px;padding:5px 12px;font-size:12px;font-weight:600;color:#888;}
.fw-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.fw-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.fw-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.fw-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.fw-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.fw-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.fw-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

/* Trust */
.fw-trust{background:#FFC800;}
.fw-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.fw-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.fw-trust__icon{font-size:20px;flex-shrink:0;}
.fw-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

/* Tyre types */
.fw-types{background:#fff;padding:72px 0;}
.fw-types__grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:40px;}
.fw-type-card{background:#F7F7F5;border:1px solid #E8E8E4;border-radius:8px;overflow:hidden;}
.fw-type-card__header{background:#111;padding:18px 22px;display:flex;align-items:center;gap:12px;}
.fw-type-card__icon{font-size:24px;}
.fw-type-card__title{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#FFC800;}
.fw-type-card__body{padding:20px 22px;display:flex;flex-direction:column;gap:12px;}
.fw-type-card__desc{font-size:14px;color:#333;line-height:1.6;}
.fw-type-card__best{font-size:13px;color:#555;}
.fw-type-card__best strong{color:#111;}
.fw-type-card__brands{font-size:12px;color:#888;font-style:italic;}

/* Sizes */
.fw-sizes{background:#F7F7F5;padding:72px 0;}
.fw-sizes__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.fw-sizes__grid{display:flex;flex-wrap:wrap;gap:8px;margin-top:24px;}
.fw-size-pill{padding:8px 16px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;font-size:13px;font-weight:700;color:#333;font-family:'Courier New',monospace;}
.fw-sizes__note{background:#111;border-radius:8px;padding:28px;}
.fw-sizes__note h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#FFC800;margin-bottom:12px;}
.fw-sizes__note p{font-size:14px;color:#888;line-height:1.6;margin-bottom:16px;}

/* Alignment upsell */
.fw-upsell{background:#1A1A1A;padding:56px 0;}
.fw-upsell__inner{display:grid;grid-template-columns:1fr auto;gap:32px;align-items:center;}
.fw-upsell h3{font-family:'Oswald',Arial,sans-serif;font-size:28px;font-weight:900;color:#FFC800;margin-bottom:10px;}
.fw-upsell p{font-size:15px;color:#888;line-height:1.6;}

/* Reviews */
.fw-reviews{background:#F7F7F5;padding:72px 0;}

/* Booking */
.fw-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.fw-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.fw-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.fw-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.fw-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.fw-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

/* CTA */
.fw-cta{background:#111;padding:72px 0;text-align:center;}
.fw-cta h2{color:#fff!important;margin-bottom:12px;}
.fw-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.fw-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.fw-cta__info{margin-top:24px;font-size:13px;color:#555;}

/* FAQ */
.fw-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.fw-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.fw-faq__item{border-bottom:1px solid #E8E8E4;}
.fw-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.fw-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.fw-faq__q[aria-expanded="true"]::after{content:'−';}
.fw-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

/* Related */
.fw-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.fw-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.fw-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.fw-related__link:hover{border-color:#FFC800;}
.fw-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .fw-hero__inner,.fw-sizes__inner,.fw-upsell__inner,.fw-booking__inner{grid-template-columns:1fr;}
    .fw-hero__card{display:none;}
    .fw-trust__inner{grid-template-columns:1fr 1fr;}
    .fw-types__grid{grid-template-columns:1fr;}
    .fw-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .fw-hero,.fw-types,.fw-sizes,.fw-reviews,.fw-booking,.fw-cta,.fw-faq{padding:48px 0;}
    .fw-trust__inner{grid-template-columns:1fr 1fr;}
}
</style>

<div class="taas-4wd">

<!-- HERO -->
<section class="fw-hero">
    <div class="fw-w">
        <div class="fw-hero__inner">
            <nav class="fw-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url.'/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>4WD Tyres Manukau</span>
            </nav>
            <div>
                <span class="fw-ey fw-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="fw-h1">4WD &amp; SUV Tyres<br><em>Manukau</em></h1>
                <p class="fw-hero__sub">
                    All-terrain, mud terrain, and highway tyres for 4WDs, SUVs, and utes.
                    Fitted and balanced at 139 Cavendish Drive. Call us with your size — we'll confirm stock and pricing.
                </p>
                <div class="fw-hero__btns">
                    <a href="#fw-booking" class="fw-btn fw-btn--primary">Enquire About 4WD Tyres</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="fw-btn fw-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
                <div class="fw-hero__tags">
                    <span class="fw-hero__tag">✓ AT · MT · HT options</span>
                    <span class="fw-hero__tag">✓ Balancing included</span>
                    <span class="fw-hero__tag">✓ All 4WD & SUV sizes</span>
                    <span class="fw-hero__tag">✓ Alignment same visit</span>
                </div>
            </div>
            <div class="fw-hero__card">
                <h3>4WD Tyre Range</h3>
                <ul>
                    <li>All-terrain (AT) — mixed use</li>
                    <li>Mud terrain (MT) — serious off-road</li>
                    <li>Highway terrain (HT) — on-road comfort</li>
                    <li>SUV & crossover range</li>
                    <li>Dual-cab ute sizes</li>
                    <li>Balancing always included</li>
                    <li>Alignment available same visit</li>
                </ul>
                <div class="fw-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call for pricing & availability</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<div class="fw-trust" role="list">
    <div class="fw-w">
        <div class="fw-trust__inner">
            <?php foreach ([
                ['🚙','AT · MT · HT — All Types'],
                ['🔄','Balancing Included'],
                ['🏆','MTA Assured Workshop'],
                ['⭐',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="fw-trust__item" role="listitem">
                <span class="fw-trust__icon"><?php echo $t[0]; ?></span>
                <span class="fw-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- TYRE TYPES — White -->
<section class="fw-types" aria-labelledby="fw-types-h2">
    <div class="fw-w">
        <span class="fw-ey fw-ey--dark">Which Type?</span>
        <h2 class="fw-h2" id="fw-types-h2">AT vs MT vs HT — Which Tyre Do You Need?</h2>
        <p class="fw-lead">The right tyre depends on how and where you drive. Here's the breakdown.</p>
        <div class="fw-types__grid">
            <?php foreach ($tyre_types as $t): ?>
            <div class="fw-type-card">
                <div class="fw-type-card__header">
                    <span class="fw-type-card__icon"><?php echo $t['icon']; ?></span>
                    <span class="fw-type-card__title"><?php echo esc_html($t['type']); ?></span>
                </div>
                <div class="fw-type-card__body">
                    <p class="fw-type-card__desc"><?php echo esc_html($t['desc']); ?></p>
                    <p class="fw-type-card__best"><strong>Best for:</strong> <?php echo esc_html($t['best']); ?></p>
                    <p class="fw-type-card__brands">Brands we stock: <?php echo esc_html($t['brands']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:20px;font-size:14px;color:#666;">Not sure which type suits your vehicle and use? Call us on <?php echo esc_html($phone_local); ?> — we'll give you a straight recommendation.</p>
    </div>
</section>

<!-- SIZES — Grey -->
<section class="fw-sizes" aria-labelledby="fw-sizes-h2">
    <div class="fw-w">
        <div class="fw-sizes__inner">
            <div>
                <span class="fw-ey fw-ey--dark">Common Sizes</span>
                <h2 class="fw-h2" id="fw-sizes-h2">4WD & SUV Tyre Sizes We Stock</h2>
                <p class="fw-lead" style="margin-bottom:0;">Common sizes available — call to confirm your specific size and type.</p>
                <div class="fw-sizes__grid">
                    <?php foreach ($sizes as $sz): ?>
                    <span class="fw-size-pill"><?php echo esc_html($sz); ?></span>
                    <?php endforeach; ?>
                    <span class="fw-size-pill" style="background:#111;color:#FFC800;border-color:#111;">+ More</span>
                </div>
                <p style="margin-top:16px;font-size:13px;color:#888;">Your tyre size is printed on the sidewall of your current tyres — e.g. <strong>265/70R16</strong>. Bring your vehicle in if you're not sure.</p>
            </div>
            <div class="fw-sizes__note">
                <h3>Changing Tyre Size?</h3>
                <p>Going bigger — or switching from HT to AT/MT — can affect speedometer accuracy, fuel economy, and load ratings. Before committing to a size change, call us and we'll advise on what works for your vehicle and setup.</p>
                <p>For utes used for towing or carrying loads, we'll make sure the load rating suits your application — this matters more than most owners realise.</p>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="fw-btn fw-btn--primary" style="width:100%;justify-content:center;margin-top:8px;">
                    Call <?php echo esc_html($phone_local); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ALIGNMENT UPSELL — Dark -->
<section class="fw-upsell" aria-label="Alignment upsell">
    <div class="fw-w">
        <div class="fw-upsell__inner">
            <div>
                <h3>Get Alignment Checked at the Same Time</h3>
                <p>A tyre type or size change can shift your alignment settings. We recommend checking alignment whenever new 4WD tyres are fitted. <?php echo esc_html($alignment_price); ?>. Same visit, no extra trip.</p>
            </div>
            <div style="display:flex;flex-direction:column;gap:10px;min-width:220px;">
                <a href="<?php echo esc_url($site_url.'/wheel-alignment-manukau/'); ?>" class="fw-btn fw-btn--primary">Wheel Alignment →</a>
                <a href="<?php echo esc_url($site_url.'/wheel-balancing-manukau/'); ?>" class="fw-btn fw-btn--outline">Wheel Balancing →</a>
            </div>
        </div>
    </div>
</section>

<!-- REVIEWS — Grey -->
<section class="fw-reviews" aria-labelledby="fw-reviews-h2">
    <div class="fw-w">
        <span class="fw-ey fw-ey--dark">Customer Reviews</span>
        <h2 class="fw-h2" id="fw-reviews-h2"><?php echo esc_html($google_reviews); ?> Reviews · <?php echo esc_html($google_rating); ?>★ on Google</h2>
        <p class="fw-lead" style="margin-bottom:32px;">South Auckland's trusted independent workshop since <?php echo esc_html($established); ?>.</p>
        <?php if ($reviews_widget): echo do_shortcode($reviews_widget);
        else: ?>
        <p style="font-size:15px;color:#666;"><a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service" target="_blank" rel="noopener" style="color:#111;font-weight:700;">See our Google reviews →</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- BOOKING — White -->
<section class="fw-booking" id="fw-booking" aria-labelledby="fw-booking-h2">
    <div class="fw-w">
        <div class="fw-booking__inner">
            <div>
                <span class="fw-ey fw-ey--dark">Enquire</span>
                <h2 class="fw-h2" id="fw-booking-h2">Enquire About 4WD &amp; SUV Tyres</h2>
                <p class="fw-lead">Tell us your tyre size, vehicle, and what you use it for — we'll recommend the right tyre type and confirm stock and pricing.</p>
                <ul class="fw-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>Balancing included with every fit</li>
                    <li>Alignment available same visit</li>
                    <li>Honest advice on type and size</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="fw-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA — Dark -->
<section class="fw-cta" aria-labelledby="fw-cta-h2">
    <div class="fw-w">
        <span class="fw-ey fw-ey--yellow">Ready?</span>
        <h2 class="fw-h2 fw-h2--white" id="fw-cta-h2">Get Your 4WD Tyres Sorted</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="fw-cta__btns">
            <a href="#fw-booking" class="fw-btn fw-btn--primary">Enquire Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="fw-btn fw-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="fw-btn fw-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="fw-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<!-- FAQ -->
<section class="fw-faq" aria-labelledby="fw-faq-h2">
    <div class="fw-w">
        <span class="fw-ey fw-ey--dark">FAQ</span>
        <h2 class="fw-h2" id="fw-faq-h2">Common Questions</h2>
        <div class="fw-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='fw-faq-q-'.$i; $aid='fw-faq-a-'.$i; ?>
            <div class="fw-faq__item">
                <button id="<?php echo $qid; ?>" class="fw-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="fw-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RELATED -->
<section class="fw-related" aria-label="Related services">
    <div class="fw-w">
        <span class="fw-ey fw-ey--dark">Related Services</span>
        <h2 class="fw-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="fw-related__grid">
            <?php foreach ([
                ['Tyre Centre',       '/tyre-centre/'],
                ['Tyre Fitting',      '/tyre-fitting-manukau/'],
                ['Wheel Alignment',   '/wheel-alignment-manukau/'],
                ['Wheel Balancing',   '/wheel-balancing-manukau/'],
                ['Budget Tyres',      '/tyre-centre/budget-tyres-manukau/'],
                ['Steering & Suspension','/steering-and-suspension/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="fw-related__link"
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
      {"@type":"ListItem","position":3,"name":"4WD Tyres Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"Service","name":"4WD & SUV Tyres Manukau",
     "description":"4WD, SUV, and ute tyre supply and fitting at Tony Allen Auto Service, 139 Cavendish Drive, Manukau. All-terrain, mud terrain, and highway tyres. Balancing included.",
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
    document.querySelectorAll('.fw-faq__q').forEach(function(btn){
        btn.addEventListener('click',function(){
            var exp=this.getAttribute('aria-expanded')==='true';
            document.querySelectorAll('.fw-faq__q').forEach(function(b){
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
