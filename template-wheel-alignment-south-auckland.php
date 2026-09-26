<?php
/**
 * Template Name: Wheel Alignment South Auckland
 * Template Post Type: page
 *
 * URL: /wheel-alignment-south-auckland/
 * Target keyword: wheel alignment south auckland — 805 SC impressions
 *
 * Broader geo hub — catches South Auckland searches that aren't
 * suburb-specific. Links to suburb spokes. Stronger conversion
 * angle than the Manukau page — positions TAAS as THE South Auckland
 * wheel alignment specialist.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-wasa', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

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

$suburbs = [
    ['name' => 'Manukau',       'url' => '/wheel-alignment-manukau/'],
    ['name' => 'Papatoetoe',    'url' => '/wheel-alignment-papatoetoe/'],
    ['name' => 'Mangere',       'url' => '/wheel-alignment-mangere/'],
    ['name' => 'Otara',         'url' => '/wheel-alignment-otara/'],
    ['name' => 'Manurewa',      'url' => '/wheel-alignment-manurewa/'],
    ['name' => 'Takanini',      'url' => '/wheel-alignment-takanini/'],
    ['name' => 'Papakura',      'url' => '/wheel-alignment-papakura/'],
    ['name' => 'Wiri',          'url' => '/wheel-alignment-wiri/'],
    ['name' => 'Otahuhu',       'url' => '/wheel-alignment-otahuhu/'],
    ['name' => 'Flat Bush',     'url' => '/wheel-alignment-flat-bush/'],
    ['name' => 'Botany',        'url' => '/wheel-alignment-botany/'],
    ['name' => 'Pakuranga',     'url' => '/wheel-alignment-pakuranga/'],
    ['name' => 'Howick',        'url' => '/wheel-alignment-howick/'],
    ['name' => 'Māngere East',  'url' => '/wheel-alignment-mangere-east/'],
    ['name' => 'Clover Park',   'url' => '/wheel-alignment-clover-park/'],
    ['name' => 'Pukekohe',      'url' => '/wheel-alignment-pukekohe/'],
];

$why_points = [
    '3D laser four-wheel alignment — camber, caster, and toe measured on every corner',
    'Before-and-after print-out included — you can see exactly what was corrected',
    'All vehicle types — cars, SUVs, 4WDs, vans, utes, light trucks',
    $alignment_price . ' — transparent pricing, no hidden fees',
    'Available on the same visit as tyre fitting — save a return trip',
    'MTA Assured workshop, trading since ' . $established . ' — ' . $years_trading . ' years in South Auckland',
];

$faqs = [
    [
        'q' => 'Where can I get a wheel alignment in South Auckland?',
        'a' => 'Tony Allen Auto Service at 139 Cavendish Drive, Manukau is South Auckland\'s dedicated wheel alignment workshop. We serve the full South Auckland corridor — Papatoetoe, Mangere, Otara, Manurewa, Takanini, Papakura, Wiri, Botany, Howick, and surrounding suburbs. Call us on ' . $phone_local . ' to book.',
    ],
    [
        'q' => 'How much does wheel alignment cost in South Auckland?',
        'a' => 'At Tony Allen Auto Service, wheel alignment is ' . $alignment_price . '. This includes a four-wheel 3D laser alignment with a before-and-after print-out. All vehicle types — cars, SUVs, 4WDs, vans, and utes. No hidden fees.',
    ],
    [
        'q' => 'How often should I get a wheel alignment in South Auckland?',
        'a' => 'We recommend checking your alignment every 12 months or after any of the following: hitting a kerb or pothole at speed, fitting new tyres, any suspension work, or if you notice uneven tyre wear or the car pulling to one side. South Auckland roads — particularly in older industrial areas — can knock alignment out more quickly than motorway driving.',
    ],
    [
        'q' => 'Can I get alignment and new tyres on the same visit?',
        'a' => 'Yes — we recommend it. New tyres will wear unevenly if alignment is out, sometimes visibly within the first few thousand kilometres. Combining both on one visit is the most efficient way to do it. Let us know when booking and we\'ll schedule time for both.',
    ],
    [
        'q' => 'Do you do wheel alignment for 4WDs and utes in South Auckland?',
        'a' => 'Yes — our 3D laser alignment system handles all vehicle types including 4WDs, dual-cab utes, SUVs, vans, and light trucks. Call us on ' . $phone_local . ' to confirm your vehicle type and book.',
    ],
    [
        'q' => 'How long does a wheel alignment take?',
        'a' => 'A four-wheel alignment typically takes 45–60 minutes. If significant adjustments are needed or suspension components are worn, it may take longer. We\'ll let you know before starting.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-wasa*,.taas-wasa*::before,.taas-wasa*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-wasa{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.wasa-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.wasa-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.wasa-ey--yellow{background:#FFC800;color:#111;}
.wasa-ey--dark{background:#1A1A1A;color:#FFC800;}
.wasa-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.wasa-h1 em{color:#FFC800;font-style:normal;}
.wasa-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.wasa-h2--white{color:#fff;}
.wasa-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.wasa-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.wasa-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.wasa-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.wasa-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.wasa-btn--outline:hover{background:#FFC800;color:#111;}

/* Hero */
.wasa-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.wasa-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.wasa-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.wasa-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.wasa-hero__bc a{color:#555;text-decoration:none;}
.wasa-hero__bc a:hover{color:#FFC800;}
.wasa-hero__bc span{margin:0 6px;}
.wasa-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.wasa-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.wasa-hero__tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px;}
.wasa-hero__tag{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:4px;padding:5px 12px;font-size:12px;font-weight:600;color:#888;}
.wasa-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.wasa-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.wasa-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.wasa-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.wasa-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.wasa-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.wasa-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

/* Trust */
.wasa-trust{background:#FFC800;}
.wasa-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.wasa-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.wasa-trust__icon{font-size:20px;flex-shrink:0;}
.wasa-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

/* Why — White */
.wasa-why{background:#fff;padding:72px 0;}
.wasa-why__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.wasa-why__points{list-style:none;display:flex;flex-direction:column;gap:14px;}
.wasa-why__point{display:flex;gap:12px;align-items:flex-start;font-size:15px;color:#333;line-height:1.5;}
.wasa-why__point::before{content:'✓';color:#111;background:#FFC800;font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.wasa-price-card{background:#111;border-radius:8px;padding:32px;}
.wasa-price-card h3{font-family:'Oswald',Arial,sans-serif;font-size:26px;font-weight:900;color:#FFC800;margin-bottom:8px;}
.wasa-price-card__price{font-family:'Oswald',Arial,sans-serif;font-size:48px;font-weight:900;color:#fff;line-height:1;margin-bottom:4px;}
.wasa-price-card__sub{font-size:13px;color:#666;margin-bottom:20px;}
.wasa-price-card__includes{list-style:none;display:flex;flex-direction:column;gap:10px;margin-bottom:24px;}
.wasa-price-card__includes li{font-size:14px;color:#ccc;display:flex;gap:8px;align-items:flex-start;}
.wasa-price-card__includes li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;}

/* Suburbs — Grey */
.wasa-suburbs{background:#F7F7F5;padding:72px 0;}
.wasa-suburbs__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:32px;}
.wasa-suburb-card{background:#fff;border:1px solid #E8E8E4;border-radius:6px;padding:16px 20px;text-decoration:none;display:flex;align-items:center;justify-content:space-between;font-size:14px;font-weight:700;color:#111;transition:all .15s ease;}
.wasa-suburb-card:hover{border-color:#FFC800;color:#111;}
.wasa-suburb-card span{color:#FFC800;font-size:16px;}

/* Reviews */
.wasa-reviews{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}

/* Booking */
.wasa-booking{background:#F7F7F5;padding:72px 0;}
.wasa-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.wasa-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.wasa-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.wasa-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.wasa-booking__form{background:#fff;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

/* CTA */
.wasa-cta{background:#111;padding:72px 0;text-align:center;}
.wasa-cta h2{color:#fff!important;margin-bottom:12px;}
.wasa-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.wasa-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.wasa-cta__info{margin-top:24px;font-size:13px;color:#555;}

/* FAQ */
.wasa-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.wasa-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.wasa-faq__item{border-bottom:1px solid #E8E8E4;}
.wasa-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.wasa-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.wasa-faq__q[aria-expanded="true"]::after{content:'−';}
.wasa-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

/* Related */
.wasa-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.wasa-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:24px;}
.wasa-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.wasa-related__link:hover{border-color:#FFC800;}
.wasa-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .wasa-hero__inner,.wasa-why__inner,.wasa-booking__inner{grid-template-columns:1fr;}
    .wasa-hero__card{display:none;}
    .wasa-trust__inner{grid-template-columns:1fr 1fr;}
    .wasa-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .wasa-hero,.wasa-why,.wasa-suburbs,.wasa-reviews,.wasa-booking,.wasa-cta,.wasa-faq{padding:48px 0;}
    .wasa-trust__inner{grid-template-columns:1fr 1fr;}
}
</style>

<div class="taas-wasa">

<!-- HERO -->
<section class="wasa-hero">
    <div class="wasa-w">
        <div class="wasa-hero__inner">
            <nav class="wasa-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <span>Wheel Alignment South Auckland</span>
            </nav>
            <div>
                <span class="wasa-ey wasa-ey--yellow">Wheel Alignment — South Auckland</span>
                <h1 class="wasa-h1">Wheel Alignment<br><em>South Auckland</em></h1>
                <p class="wasa-hero__sub">
                    3D laser four-wheel alignment at 139 Cavendish Drive, Manukau.
                    Serving the full South Auckland corridor. <?php echo esc_html($alignment_price); ?> — before-and-after print-out included.
                </p>
                <div class="wasa-hero__btns">
                    <a href="#wasa-booking" class="wasa-btn wasa-btn--primary">Book Wheel Alignment</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="wasa-btn wasa-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
                <div class="wasa-hero__tags">
                    <span class="wasa-hero__tag">✓ 3D laser alignment</span>
                    <span class="wasa-hero__tag">✓ All 4 wheels measured</span>
                    <span class="wasa-hero__tag">✓ Print-out included</span>
                    <span class="wasa-hero__tag">✓ All vehicle types</span>
                </div>
            </div>
            <div class="wasa-hero__card">
                <h3>Wheel Alignment Includes</h3>
                <ul>
                    <li>3D laser 4-wheel measurement</li>
                    <li>Camber, caster &amp; toe checked</li>
                    <li>Before &amp; after print-out</li>
                    <li>All vehicle types</li>
                    <li>Same visit as tyre fitting</li>
                    <li><?php echo esc_html($alignment_price); ?></li>
                </ul>
                <div class="wasa-hero__phone">
                    <span style="font-size:12px;color:#888;display:block;margin-bottom:4px;">Call to book</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>"><?php echo esc_html($phone_free); ?></a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" style="font-size:15px;color:#888;margin-top:4px;font-weight:600;display:block;"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<div class="wasa-trust" role="list">
    <div class="wasa-w">
        <div class="wasa-trust__inner">
            <?php foreach ([
                ['<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><circle cx="12" cy="12" r="4"/></svg>','3D Laser 4-Wheel Alignment'],
                ['🖨️','Before & After Print-Out'],
                ['<img src="' . get_site_url() . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png" alt="MTA Assured" style="height:28px;width:auto;display:block;">','MTA Assured — Since '.$established],
                ['<img src="https://www.gstatic.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="height:22px;width:22px;display:block;">',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="wasa-trust__item" role="listitem">
                <span class="wasa-trust__icon"><?php echo $t[0]; ?></span>
                <span class="wasa-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- WHY — White -->
<section class="wasa-why" aria-labelledby="wasa-why-h2">
    <div class="wasa-w">
        <div class="wasa-why__inner">
            <div>
                <span class="wasa-ey wasa-ey--dark">Why Choose TAAS</span>
                <h2 class="wasa-h2" id="wasa-why-h2">South Auckland's Wheel Alignment Specialist Since <?php echo esc_html($established); ?></h2>
                <p style="font-size:16px;color:#555;line-height:1.7;margin-bottom:24px;">
                    We've been doing wheel alignments in South Auckland for <?php echo esc_html($years_trading); ?> years.
                    One workshop, one address, every suburb in the corridor served.
                    3D laser equipment, transparent pricing, and a print-out that shows exactly what was corrected.
                </p>
                <ul class="wasa-why__points">
                    <?php foreach ($why_points as $p): ?>
                    <li class="wasa-why__point"><?php echo esc_html($p); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="wasa-price-card">
                <h3>Alignment Pricing</h3>
                <div class="wasa-price-card__price">$100<span style="font-size:20px;color:#888;"> incl. GST</span></div>
                <div class="wasa-price-card__sub">Four-wheel laser alignment — all vehicle types</div>
                <ul class="wasa-price-card__includes">
                    <li>3D laser measurement — all 4 wheels</li>
                    <li>Camber, caster and toe corrected</li>
                    <li>Before-and-after print-out</li>
                    <li>All vehicle types — cars to utes</li>
                    <li>Available same visit as tyre fitting</li>
                </ul>
                <a href="#wasa-booking" class="wasa-btn wasa-btn--primary" style="width:100%;justify-content:center;">Book Now</a>
                <div style="margin-top:12px;text-align:center;">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" style="font-size:14px;color:#FFC800;font-weight:700;text-decoration:none;"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SUBURBS — Grey -->
<section class="wasa-suburbs" aria-labelledby="wasa-suburbs-h2">
    <div class="wasa-w">
        <span class="wasa-ey wasa-ey--dark">All South Auckland Suburbs</span>
        <h2 class="wasa-h2" id="wasa-suburbs-h2">Wheel Alignment Near You</h2>
        <p class="wasa-lead">Based at 139 Cavendish Drive, Manukau — serving every suburb in the South Auckland corridor.</p>
        <div class="wasa-suburbs__grid">
            <?php foreach ($suburbs as $s): ?>
            <a href="<?php echo esc_url($site_url.$s['url']); ?>" class="wasa-suburb-card">
                <?php echo esc_html($s['name']); ?> <span>→</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- REVIEWS — White -->
<section class="wasa-reviews" aria-labelledby="wasa-reviews-h2">
    <div class="wasa-w">
        <span class="wasa-ey wasa-ey--dark">Customer Reviews</span>
        <h2 class="wasa-h2" id="wasa-reviews-h2"><?php echo esc_html($google_reviews); ?> Reviews · <?php echo esc_html($google_rating); ?>★ on Google</h2>
        <p class="wasa-lead" style="margin-bottom:32px;">South Auckland's trusted independent workshop since <?php echo esc_html($established); ?>.</p>
        <?php if ($reviews_widget): echo do_shortcode($reviews_widget);
        else: ?>
        <p style="font-size:15px;color:#666;"><a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service" target="_blank" rel="noopener" style="color:#111;font-weight:700;">See our Google reviews →</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- BOOKING — Grey -->
<section class="wasa-booking" id="wasa-booking" aria-labelledby="wasa-booking-h2">
    <div class="wasa-w">
        <div class="wasa-booking__inner">
            <div>
                <span class="wasa-ey wasa-ey--dark">Book Online</span>
                <h2 class="wasa-h2" id="wasa-booking-h2">Book a Wheel Alignment — South Auckland</h2>
                <p class="wasa-lead">Send us your details and we'll confirm your booking. Or call <?php echo esc_html($phone_local); ?> directly.</p>
                <ul class="wasa-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li><?php echo esc_html($alignment_price); ?></li>
                    <li>Before-and-after print-out included</li>
                    <li>Tyre fitting available same visit</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="wasa-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA — Dark -->
<section class="wasa-cta" aria-labelledby="wasa-cta-h2">
    <div class="wasa-w">
        <span class="wasa-ey wasa-ey--yellow">Ready?</span>
        <h2 class="wasa-h2 wasa-h2--white" id="wasa-cta-h2">Get Your Alignment Done Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="wasa-cta__btns">
            <a href="#wasa-booking" class="wasa-btn wasa-btn--primary">Book Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="wasa-btn wasa-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="wasa-btn wasa-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="wasa-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<!-- FAQ -->
<section class="wasa-faq" aria-labelledby="wasa-faq-h2">
    <div class="wasa-w">
        <span class="wasa-ey wasa-ey--dark">FAQ</span>
        <h2 class="wasa-h2" id="wasa-faq-h2">Common Questions</h2>
        <div class="wasa-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='wasa-faq-q-'.$i; $aid='wasa-faq-a-'.$i; ?>
            <div class="wasa-faq__item">
                <button id="<?php echo $qid; ?>" class="wasa-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="wasa-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RELATED -->
<section class="wasa-related" aria-label="Related services">
    <div class="wasa-w">
        <span class="wasa-ey wasa-ey--dark">Related Services</span>
        <h2 class="wasa-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="wasa-related__grid">
            <?php foreach ([
                ['Wheel Alignment Manukau',  '/wheel-alignment-manukau/'],
                ['Wheel Balancing',          '/wheel-balancing-manukau/'],
                ['Tyre Fitting',             '/tyre-fitting-manukau/'],
                ['Tyre Centre',              '/tyre-centre/'],
                ['Steering & Suspension',    '/steering-and-suspension/'],
                ['WOF Inspections',          '/wof/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="wasa-related__link"
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
      {"@type":"ListItem","position":2,"name":"Wheel Alignment South Auckland","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"Service","name":"Wheel Alignment South Auckland",
     "description":"3D laser four-wheel alignment at Tony Allen Auto Service, 139 Cavendish Drive, Manukau. Serving all South Auckland suburbs. From $100 incl. GST. Before-and-after print-out included.",
     "serviceType":"Wheel Alignment",
     "areaServed":{"@type":"State","name":"South Auckland"},
     "provider":{"@type":"AutoRepair","@id":"<?php echo esc_js($site_url); ?>/#organization",
       "name":"Tony Allen Auto Service","telephone":"<?php echo esc_js($phone_local); ?>",
       "address":{"@type":"PostalAddress","streetAddress":"139 Cavendish Drive","addressLocality":"Manukau","addressRegion":"Auckland","addressCountry":"NZ","postalCode":"2104"},
       "openingHours":"Mo-Fr 07:30-17:00",
       "aggregateRating":{"@type":"AggregateRating","ratingValue":"<?php echo esc_js($google_rating); ?>","reviewCount":"<?php echo esc_js(preg_replace('/[^0-9]/','', $google_reviews)); ?>","bestRating":"5","worstRating":"1"},
       "foundingDate":"<?php echo esc_js($established); ?>",
       "memberOf":{"@type":"Organization","name":"MTA New Zealand"}
     },
     "offers":{"@type":"Offer","price":"100","priceCurrency":"NZD","description":"Four-wheel 3D laser alignment including before-and-after print-out"}
    },
    {"@type":"FAQPage","mainEntity":[
      <?php echo implode(',', array_map(fn($f) => sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}', json_encode($f['q']), json_encode(strip_tags($f['a']))), $faqs)); ?>
    ]}
  ]
}
</script>

<script>
(function(){
    document.querySelectorAll('.wasa-faq__q').forEach(function(btn){
        btn.addEventListener('click',function(){
            var exp=this.getAttribute('aria-expanded')==='true';
            document.querySelectorAll('.wasa-faq__q').forEach(function(b){
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
