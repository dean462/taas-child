<?php
/**
 * Template Name: Budget Tyres Manukau
 * Template Post Type: page
 *
 * URL: /budget-tyres-manukau/
 * Parent: /tyre-centre/
 * Target keyword: budget tyres manukau — 890 SC impressions
 *
 * Tone: Direct and reassuring. Budget is a distress purchase angle —
 *       people want safe, affordable tyres without being upsold.
 *       Honest about what budget means. No embarrassment about price.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-bt', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

$phone_local    = '09 278 9556';
$phone_free     = '0800 100 876';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$google_rating  = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$google_reviews = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

$budget_brands = [
    ['name' => 'Farroad',  'note' => 'Chinese-made, solid value for everyday driving'],
    ['name' => 'Radar',    'note' => 'UAE-produced, good wet performance for the price'],
    ['name' => 'Nankang',  'note' => 'Taiwanese brand, long-standing budget option'],
    ['name' => 'Hifly',    'note' => 'Budget range for city and commuter use'],
];

$mid_brands = [
    ['name' => 'Maxxis',   'note' => 'Taiwanese — strong mid-range across all types'],
    ['name' => 'Nitto',    'note' => 'Japanese heritage, good SUV and 4WD range'],
    ['name' => 'Hankook',  'note' => 'Korean — OEM supplier to major manufacturers'],
];

$premium_brands = [
    ['name' => 'Toyo',       'note' => 'Japanese — performance and all-terrain range'],
    ['name' => 'Pirelli',    'note' => 'Italian — OEM on European and performance vehicles'],
    ['name' => 'Goodyear',   'note' => 'American — strong wet weather performance'],
    ['name' => 'Continental','note' => 'German — OEM on BMW, Mercedes, Audi'],
];

$faqs = [
    [
        'q' => 'Are budget tyres safe in New Zealand?',
        'a' => 'Yes — if they meet NZ road standards, which all tyres we stock do. Budget tyres are perfectly adequate for everyday city and commuter driving. The main differences between budget and premium are wet grip performance at high speed, tread life, and road noise. For a second car doing short urban trips at moderate speeds, budget tyres are a sensible and safe choice. We recommend them honestly when they suit the vehicle and how it\'s used.',
    ],
    [
        'q' => 'What is the cheapest tyre I can get in Manukau?',
        'a' => 'Pricing varies by size — call us on ' . $phone_local . ' with your tyre size and we\'ll give you a price on the spot. We stock budget options from brands including Farroad, Radar, Nankang, and Hifly. Balancing is included in the price.',
    ],
    [
        'q' => 'What\'s the difference between budget and premium tyres?',
        'a' => 'The main differences are wet braking distance, tread life, and road noise. Tests consistently show premium tyres stop shorter in the wet — in some cases several car lengths. For high-speed motorway driving or a vehicle used heavily in wet conditions, that difference matters. For urban city driving at lower speeds, budget tyres perform adequately. We\'ll give you an honest recommendation based on your vehicle and how you use it.',
    ],
    [
        'q' => 'Is wheel balancing included when you fit budget tyres?',
        'a' => 'Yes — balancing is included with every tyre fit regardless of brand or price point. We balance all four wheels on our ER85 touchscreen balancer as standard.',
    ],
    [
        'q' => 'Should I get a wheel alignment with new budget tyres?',
        'a' => 'Yes — alignment matters more with budget tyres, not less. Budget tyres already have shorter tread life than premium options. Running them on a misaligned vehicle accelerates wear even faster, meaning you\'ll need to replace them sooner. Alignment is ' . $alignment_price . ' and is available on the same visit.',
    ],
    [
        'q' => 'Do you fit budget tyres on all vehicle types?',
        'a' => 'Yes — cars, SUVs, vans, utes, and light trucks. Budget tyre availability varies by size — larger and less common sizes may only be available in mid-range or premium. Call us on ' . $phone_local . ' with your size and we\'ll confirm what\'s in stock.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-bt*,.taas-bt*::before,.taas-bt*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-bt{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.bt-w{max-width:1140px;margin:0 auto;padding:0 24px;}

.bt-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.bt-ey--yellow{background:#FFC800;color:#111;}
.bt-ey--dark{background:#1A1A1A;color:#FFC800;}

.bt-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.bt-h1 em{color:#FFC800;font-style:normal;}
.bt-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.bt-h2--white{color:#fff;}
.bt-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}

.bt-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.bt-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.bt-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.bt-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.bt-btn--outline:hover{background:#FFC800;color:#111;}

/* Hero */
.bt-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.bt-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.bt-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.bt-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.bt-hero__bc a{color:#555;text-decoration:none;}
.bt-hero__bc a:hover{color:#FFC800;}
.bt-hero__bc span{margin:0 6px;}
.bt-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.bt-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.bt-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.bt-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.bt-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.bt-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.bt-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.bt-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.bt-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

/* Trust */
.bt-trust{background:#FFC800;}
.bt-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.bt-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.bt-trust__icon{font-size:20px;flex-shrink:0;}
.bt-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

/* What budget means */
.bt-honest{background:#fff;padding:72px 0;}
.bt-honest__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.bt-honest__body{font-size:16px;color:#333;line-height:1.7;}
.bt-honest__body p+p{margin-top:16px;}
.bt-callout{background:#F7F7F5;border-radius:8px;padding:28px;border:1px solid #E8E8E4;}
.bt-callout h3{font-family:'Oswald',Arial,sans-serif;font-size:22px;font-weight:900;color:#111;margin-bottom:12px;}
.bt-callout ul{list-style:none;display:flex;flex-direction:column;gap:10px;}
.bt-callout li{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:#333;line-height:1.5;}
.bt-callout li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}

/* Brand tiers */
.bt-brands{background:#F7F7F5;padding:72px 0;}
.bt-brands__tiers{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:40px;}
.bt-tier{background:#fff;border-radius:8px;overflow:hidden;border:1px solid #E8E8E4;}
.bt-tier__header{padding:16px 20px;}
.bt-tier__header--budget{background:#111;color:#FFC800;}
.bt-tier__header--mid{background:#333;}
.bt-tier__header--premium{background:#1a1a1a;}
.bt-tier__title{font-family:'Oswald',Arial,sans-serif;font-size:20px;font-weight:900;color:#FFC800;}
.bt-tier__sub{font-size:12px;color:#888;margin-top:2px;}
.bt-tier__brands{padding:16px 20px;display:flex;flex-direction:column;gap:12px;}
.bt-tier__brand{display:flex;flex-direction:column;gap:2px;}
.bt-tier__brand-name{font-size:14px;font-weight:700;color:#111;}
.bt-tier__brand-note{font-size:12px;color:#888;}

/* Alignment upsell */
.bt-upsell{background:#1A1A1A;padding:56px 0;}
.bt-upsell__inner{display:grid;grid-template-columns:1fr auto;gap:32px;align-items:center;}
.bt-upsell h3{font-family:'Oswald',Arial,sans-serif;font-size:28px;font-weight:900;color:#FFC800;margin-bottom:10px;}
.bt-upsell p{font-size:15px;color:#888;line-height:1.6;}

/* Reviews */
.bt-reviews{background:#F7F7F5;padding:72px 0;}

/* Booking */
.bt-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.bt-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.bt-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.bt-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.bt-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.bt-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

/* CTA */
.bt-cta{background:#111;padding:72px 0;text-align:center;}
.bt-cta h2{color:#fff!important;margin-bottom:12px;}
.bt-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.bt-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.bt-cta__info{margin-top:24px;font-size:13px;color:#555;}

/* FAQ */
.bt-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.bt-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.bt-faq__item{border-bottom:1px solid #E8E8E4;}
.bt-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.bt-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.bt-faq__q[aria-expanded="true"]::after{content:'−';}
.bt-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

/* Related */
.bt-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.bt-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.bt-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.bt-related__link:hover{border-color:#FFC800;}
.bt-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .bt-hero__inner,.bt-honest__inner,.bt-upsell__inner,.bt-booking__inner{grid-template-columns:1fr;}
    .bt-hero__card{display:none;}
    .bt-trust__inner{grid-template-columns:1fr 1fr;}
    .bt-brands__tiers{grid-template-columns:1fr;}
    .bt-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .bt-hero,.bt-honest,.bt-brands,.bt-reviews,.bt-booking,.bt-cta,.bt-faq{padding:48px 0;}
    .bt-trust__inner{grid-template-columns:1fr 1fr;}
}
</style>

<div class="taas-bt">

<!-- HERO -->
<section class="bt-hero">
    <div class="bt-w">
        <div class="bt-hero__inner">
            <nav class="bt-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>Budget Tyres Manukau</span>
            </nav>
            <div>
                <span class="bt-ey bt-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="bt-h1">Budget Tyres<br><em>Manukau</em></h1>
                <p class="bt-hero__sub">
                    Safe, affordable tyres from brands including Farroad, Radar, Nankang, and Hifly.
                    Balancing included. Fitted at 139 Cavendish Drive — call us with your tyre size for availability and pricing.
                </p>
                <div class="bt-hero__btns">
                    <a href="#bt-booking" class="bt-btn bt-btn--primary">Get a Price</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="bt-btn bt-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
            <div class="bt-hero__card">
                <h3>Budget Tyres Include</h3>
                <ul>
                    <li>Wheel balancing — no extra charge</li>
                    <li>All common passenger sizes</li>
                    <li>Farroad, Radar, Nankang, Hifly</li>
                    <li>Fit while you wait or drop and collect</li>
                    <li>Alignment available same visit</li>
                    <li>Honest advice — no upsell pressure</li>
                </ul>
                <div class="bt-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call for pricing</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<div class="bt-trust" role="list">
    <div class="bt-w">
        <div class="bt-trust__inner">
            <?php foreach ([
                ['💵','Budget to Premium Brands'],
                ['🔄','Balancing Included'],
                ['🏆','MTA Assured Workshop'],
                ['⭐', $google_rating . ' Stars · ' . $google_reviews . ' Reviews'],
            ] as $t): ?>
            <div class="bt-trust__item" role="listitem">
                <span class="bt-trust__icon" aria-hidden="true"><?php echo $t[0]; ?></span>
                <span class="bt-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- WHAT BUDGET MEANS — White -->
<section class="bt-honest" aria-labelledby="bt-honest-h2">
    <div class="bt-w">
        <div class="bt-honest__inner">
            <div>
                <span class="bt-ey bt-ey--dark">Straight Talk</span>
                <h2 class="bt-h2" id="bt-honest-h2">What Budget Tyres Actually Mean</h2>
                <div class="bt-honest__body">
                    <p>Budget tyres are made by smaller manufacturers — often in China, Taiwan, or the UAE — at lower production costs. They meet New Zealand road safety standards and are perfectly adequate for everyday city and commuter driving.</p>
                    <p>The main differences versus premium tyres are wet braking distance, tread life, and road noise. Independent tests show premium tyres stop shorter in wet conditions — sometimes by several car lengths at motorway speeds. For urban driving at lower speeds, that gap is less significant.</p>
                    <p>We recommend budget tyres honestly when they suit the vehicle and how it's used. We recommend upgrading when they don't — for example, on vehicles that regularly travel motorway speeds in wet conditions, or where tread life matters more than upfront cost.</p>
                </div>
            </div>
            <div class="bt-callout">
                <h3>When Budget Tyres Make Sense</h3>
                <ul>
                    <li>Second or third vehicle doing low annual kilometres</li>
                    <li>City and suburban driving at moderate speeds</li>
                    <li>Older vehicles where the tyre cost approaches the car's value</li>
                    <li>Tight budget where the alternative is driving on worn tyres</li>
                    <li>Rental, seasonal, or short-term fitment</li>
                </ul>
                <div style="margin-top:20px;padding-top:20px;border-top:1px solid #E8E8E4;">
                    <h3 style="margin-bottom:8px;">When to Spend More</h3>
                    <ul>
                        <li>Primary vehicle doing high annual motorway kilometres</li>
                        <li>Performance vehicles or European cars with specific requirements</li>
                        <li>4WDs in off-road or heavy-duty use</li>
                        <li>Where tread life and fuel economy savings outweigh the price difference</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BRAND TIERS — Grey -->
<section class="bt-brands" aria-labelledby="bt-brands-h2">
    <div class="bt-w">
        <span class="bt-ey bt-ey--dark">What We Stock</span>
        <h2 class="bt-h2" id="bt-brands-h2">Budget, Mid-Range &amp; Premium — All Available</h2>
        <p class="bt-lead">We stock across all three tiers. Call with your tyre size and we'll tell you what's available at each price point.</p>
        <div class="bt-brands__tiers">
            <div class="bt-tier">
                <div class="bt-tier__header bt-tier__header--budget">
                    <div class="bt-tier__title">Budget</div>
                    <div class="bt-tier__sub">Everyday city &amp; commuter driving</div>
                </div>
                <div class="bt-tier__brands">
                    <?php foreach ($budget_brands as $b): ?>
                    <div class="bt-tier__brand">
                        <span class="bt-tier__brand-name"><?php echo esc_html($b['name']); ?></span>
                        <span class="bt-tier__brand-note"><?php echo esc_html($b['note']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="bt-tier">
                <div class="bt-tier__header bt-tier__header--mid">
                    <div class="bt-tier__title" style="color:#FFC800;">Mid-Range</div>
                    <div class="bt-tier__sub">Better performance, longer life</div>
                </div>
                <div class="bt-tier__brands">
                    <?php foreach ($mid_brands as $b): ?>
                    <div class="bt-tier__brand">
                        <span class="bt-tier__brand-name"><?php echo esc_html($b['name']); ?></span>
                        <span class="bt-tier__brand-note"><?php echo esc_html($b['note']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="bt-tier">
                <div class="bt-tier__header bt-tier__header--premium">
                    <div class="bt-tier__title" style="color:#FFC800;">Premium</div>
                    <div class="bt-tier__sub">Wet grip, tread life, performance</div>
                </div>
                <div class="bt-tier__brands">
                    <?php foreach ($premium_brands as $b): ?>
                    <div class="bt-tier__brand">
                        <span class="bt-tier__brand-name"><?php echo esc_html($b['name']); ?></span>
                        <span class="bt-tier__brand-note"><?php echo esc_html($b['note']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ALIGNMENT UPSELL — Dark -->
<section class="bt-upsell" aria-label="Alignment upsell">
    <div class="bt-w">
        <div class="bt-upsell__inner">
            <div>
                <h3>Get Alignment Done at the Same Time</h3>
                <p>Budget tyres have shorter tread life than premium. Running them on a misaligned vehicle shortens that life further — sometimes significantly. We recommend checking alignment whenever new tyres are fitted. <?php echo esc_html($alignment_price); ?>. Same visit, no extra trip.</p>
            </div>
            <div style="display:flex;flex-direction:column;gap:10px;min-width:220px;">
                <a href="<?php echo esc_url($site_url . '/wheel-alignment-manukau/'); ?>" class="bt-btn bt-btn--primary">Wheel Alignment →</a>
                <a href="<?php echo esc_url($site_url . '/wheel-balancing-manukau/'); ?>" class="bt-btn bt-btn--outline">Wheel Balancing →</a>
            </div>
        </div>
    </div>
</section>

<!-- REVIEWS — Grey -->
<section class="bt-reviews" aria-labelledby="bt-reviews-h2">
    <div class="bt-w">
        <span class="bt-ey bt-ey--dark">Customer Reviews</span>
        <h2 class="bt-h2" id="bt-reviews-h2"><?php echo esc_html($google_reviews); ?> Reviews · <?php echo esc_html($google_rating); ?>★ on Google</h2>
        <p class="bt-lead" style="margin-bottom:32px;">South Auckland's trusted independent workshop since <?php echo esc_html($established); ?>.</p>
        <?php if ($reviews_widget): echo do_shortcode($reviews_widget);
        else: ?>
        <p style="font-size:15px;color:#666;"><a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service" target="_blank" rel="noopener" style="color:#111;font-weight:700;">See our Google reviews →</a></p>
        <?php endif; ?>
    </div>
</section>

<!-- CF7 BOOKING — White -->
<section class="bt-booking" id="bt-booking" aria-labelledby="bt-booking-h2">
    <div class="bt-w">
        <div class="bt-booking__inner">
            <div>
                <span class="bt-ey bt-ey--dark">Get a Price</span>
                <h2 class="bt-h2" id="bt-booking-h2">Enquire About Budget Tyres</h2>
                <p class="bt-lead">Tell us your tyre size and vehicle — we'll confirm availability, give you pricing across all tiers, and book you in. Or call <?php echo esc_html($phone_local); ?> directly.</p>
                <ul class="bt-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>Balancing included with every fit</li>
                    <li>No upsell — honest pricing across all tiers</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="bt-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA — Dark -->
<section class="bt-cta" aria-labelledby="bt-cta-h2">
    <div class="bt-w">
        <span class="bt-ey bt-ey--yellow">Ready?</span>
        <h2 class="bt-h2 bt-h2--white" id="bt-cta-h2">Get Budget Tyres Fitted Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="bt-cta__btns">
            <a href="#bt-booking" class="bt-btn bt-btn--primary">Enquire Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="bt-btn bt-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="bt-btn bt-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="bt-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<!-- FAQ -->
<section class="bt-faq" aria-labelledby="bt-faq-h2">
    <div class="bt-w">
        <span class="bt-ey bt-ey--dark">FAQ</span>
        <h2 class="bt-h2" id="bt-faq-h2">Common Questions</h2>
        <div class="bt-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid = 'bt-faq-q-'.$i; $aid = 'bt-faq-a-'.$i; ?>
            <div class="bt-faq__item">
                <button id="<?php echo $qid; ?>" class="bt-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="bt-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RELATED -->
<section class="bt-related" aria-label="Related services">
    <div class="bt-w">
        <span class="bt-ey bt-ey--dark">Related Services</span>
        <h2 class="bt-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="bt-related__grid">
            <?php foreach ([
                ['Tyre Centre',        '/tyre-centre/'],
                ['Tyre Fitting',       '/tyre-fitting-manukau/'],
                ['Wheel Alignment',    '/wheel-alignment-manukau/'],
                ['Wheel Balancing',    '/wheel-balancing-manukau/'],
                ['4WD Tyres',          '/4wd-tyres-manukau/'],
                ['Puncture Repair',    '/tyre-centre/puncture-repair-manukau/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="bt-related__link"
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
      {"@type":"ListItem","position":3,"name":"Budget Tyres Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"Service","name":"Budget Tyres Manukau",
     "description":"Budget tyre supply and fitting at Tony Allen Auto Service, 139 Cavendish Drive, Manukau. Farroad, Radar, Nankang, Hifly. Balancing included. All vehicle types.",
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
    document.querySelectorAll('.bt-faq__q').forEach(function(btn){
        btn.addEventListener('click',function(){
            var exp=this.getAttribute('aria-expanded')==='true';
            document.querySelectorAll('.bt-faq__q').forEach(function(b){
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
