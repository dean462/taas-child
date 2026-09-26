<?php
/**
 * Template Name: Wheel Balancing
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /wheel-balancing-manukau/
 * Parent: /tyre-centre/
 *
 * Standalone service page. ER85 touchscreen balancer.
 * Static, dynamic, and run-out in a single spin.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$established    = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$years          = date('Y') - intval($established);
$rating         = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$reviews        = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$customers      = defined('TAAS_CUSTOMERS')       ? TAAS_CUSTOMERS       : '10,000+';
$balance_price  = defined('TAAS_BALANCE_PRICE')   ? TAAS_BALANCE_PRICE   : 'from $25 per wheel incl. GST';
$alignment_price= defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$phone_free_tel = preg_replace('/[^0-9+]/', '', TAAS_PHONE_FREE);
$maps_url       = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

$symptoms = [
    'Steering wheel vibrating — especially at 80–100 km/h',
    'Vibration felt through the seat or floor at highway speeds',
    'Humming or droning noise that changes with speed',
    'Tyres wearing unevenly in patches or cups',
    'Steering feels shaky or unsettled at certain speeds',
    'Vibration disappears at low speed but returns faster',
    'New tyres fitted and vibration started shortly after',
];

$process_steps = [
    ['title' => 'Wheel-Off Removal', 'desc' => 'Each wheel and tyre assembly is removed individually. Balancing can only be done accurately off the car — on-car balancers mask some imbalance types.'],
    ['title' => 'Run-Out Measurement', 'desc' => 'The wheel is mounted on our ER85 touchscreen balancer. In a single spin it detects static imbalance, dynamic imbalance, and lateral/radial run-out — the three distinct causes of vibration. Accuracy to 0.1mm.'],
    ['title' => 'Weight Placement', 'desc' => 'The machine specifies the exact amount and position of weight required. Clip-on weights for steel wheels, stick-on weights for alloys — the right method for the wheel type.'],
    ['title' => 'Verification Spin', 'desc' => "After weights are placed, the wheel is spun again to confirm balance is within tolerance. We don't skip this step."],
    ['title' => 'Refit & Torque', 'desc' => 'Wheels refitted to manufacturer torque spec. Not hand-tight, not over-torqued — correct spec, confirmed with a torque wrench.'],
    ['title' => 'Road Test', 'desc' => 'We road test after balancing to confirm vibration is gone. If anything persists, we investigate further — it could indicate a tyre fault, wheel damage, or a worn hub bearing.'],
];

$why_points = [
    'Vibration is uncomfortable and gets worse, not better, over time',
    'Unbalanced wheels cause cupping and patchy tyre wear — shortening tyre life',
    'Steering components and wheel bearings wear faster under constant vibration',
    'Highway driving becomes unsafe when vibration affects steering control',
    'Balancing is one of the lowest-cost jobs — relative to what it prevents',
];

$faqs = [
    ['q' => 'How much does wheel balancing cost?', 'a' => 'Wheel balancing ' . $balance_price . '. We balance all four wheels as standard. Pricing may vary for oversized 4WD or commercial tyres — we always confirm before starting.'],
    ['q' => 'What is the difference between balancing and alignment?', 'a' => 'Balancing corrects weight distribution of each wheel and tyre — stops vibration. Alignment adjusts the angles of all four wheels — corrects pulling and uneven wear. Separate jobs that fix different problems. A car can be perfectly aligned but still vibrate from an imbalanced wheel.'],
    ['q' => 'How do I know if my wheels are out of balance?', 'a' => 'Steering wheel vibration that appears at certain speeds — typically 80–100 km/h. Front wheel imbalance is felt in the steering. Rear wheel imbalance is felt in the seat. The only accurate way to confirm is putting the wheel on a balancer.'],
    ['q' => 'How often should I get wheels balanced?', 'a' => 'Every time new tyres are fitted (always included), then every 10,000–15,000 km or immediately if vibration starts. A pothole or kerb strike can knock balance out.'],
    ['q' => 'What is run-out and why does it matter?', 'a' => "Run-out is when a tyre or wheel is not perfectly round — it wobbles as it spins. Standard balancers miss this. Our ER85 detects both weight imbalance and run-out in a single spin. Without run-out detection, you can chase a vibration problem that never fully resolves."],
    ['q' => 'Can a new tyre be out of balance?', 'a' => 'Yes. New tyres always need balancing when fitted. A new tyre that has not been balanced will cause vibration. If you had tyres fitted elsewhere and started vibrating, bring it in — straightforward to check and fix.'],
    ['q' => 'My car still vibrates after balancing — what else could it be?', 'a' => 'Tyre run-out (tyre is out of round), wheel damage (bent rim), worn wheel bearings, or worn suspension. Our ER85 detects run-out during balancing, so we usually catch tyre and wheel issues at the same time.'],
    ['q' => 'Is balancing included when you fit new tyres?', 'a' => 'Yes — always. We never fit tyres without balancing them.'],
    ['q' => 'Do you balance alloy wheels?', 'a' => 'Yes. Stick-on weights for alloys — placed behind the spokes so they are not visible. Clip-on weights for steel wheels. The right method for the wheel type.'],
    ['q' => 'Where is your workshop?', 'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . TAAS_HOURS . '. Call ' . TAAS_PHONE_FREE . ' to book.'],
];

$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]];
}
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tyre Centre', 'item' => $site_url . '/tyre-centre/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Wheel Balancing', 'item' => $page_url],
    ]],
    ['@type' => ['AutoRepair', 'LocalBusiness'],
     'name' => 'Tony Allen Auto Service — Wheel Balancing',
     'url' => $page_url,
     'description' => 'Wheel balancing in Manukau, South Auckland. ER85 touchscreen balancer — static, dynamic and run-out measured in a single spin. ' . $balance_price . '. Included with new tyre fitting.',
     'telephone' => [TAAS_PHONE_LOCAL, TAAS_PHONE_FREE],
     'email' => TAAS_EMAIL,
     'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
     'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
     'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
     'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => TAAS_RATING, 'reviewCount' => preg_replace('/\D+/', '', TAAS_REVIEWS), 'bestRating' => '5'],
     'foundingDate' => '1985-10-01',
     'areaServed' => 'South Auckland',
     'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
     'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association New Zealand'],
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.wb-hero h1', '.wb-section__heading', '.wb-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-wheel-balancing .site-content,
.page-template-template-wheel-balancing .entry-content,
.page-template-template-wheel-balancing .entry-header,
.page-template-template-wheel-balancing article,
.page-template-template-wheel-balancing #primary,
.page-template-template-wheel-balancing #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-wheel-balancing { overflow-x:hidden; }

.wb-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.wb-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 300px; gap: 48px; align-items: start; }
.wb-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.wb-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 12px; }
.wb-hero h1 span { color: var(--taas-yellow, #FFC800); }
.wb-hero__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 600; color: var(--taas-yellow, #FFC800); margin: 0 0 12px; }
.wb-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 540px; margin: 0 0 28px; line-height: 1.65; }
.wb-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.wb-sidebar { background: #1e1e1e; border: 1px solid #333; border-radius: var(--taas-radius, 6px); padding: 24px; }
.wb-sidebar__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 14px; }
.wb-sidebar__list { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 8px; }
.wb-sidebar__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: #ccc; padding-left: 18px; position: relative; line-height: 1.4; }
.wb-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }
.wb-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 16px; }
.wb-sidebar__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 22px; font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin-bottom: 4px; }
.wb-sidebar__phone:hover { color: #fff; }
.wb-sidebar__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; color: #666; line-height: 1.6; }

.wb-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.wb-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.wb-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.wb-trust__item::before { content: '✓'; font-weight: 900; }

.wb-section { padding: var(--taas-sec-pad, 72px) 0; }
.wb-section--white { background: var(--taas-white, #FFFFFF); }
.wb-section--grey  { background: var(--taas-panel, #F7F7F5); }
.wb-section--dark  { background: var(--taas-dark, #1A1A1A); }
.wb-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.wb-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.wb-section--dark .wb-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.wb-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.wb-section--dark .wb-section__heading { color: var(--taas-white, #FFFFFF); }
.wb-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 28px; line-height: 1.65; }
.wb-section--dark .wb-section__sub { color: #aaa; }

.wb-symptoms { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.wb-symptom { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); padding: 14px 14px 14px 38px; background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); position: relative; line-height: 1.4; }
.wb-symptom::before { content: '⚠'; position: absolute; left: 14px; top: 14px; }

.wb-process { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; counter-reset: step; }
.wb-step { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 24px; counter-increment: step; position: relative; }
.wb-step::before { content: counter(step); position: absolute; top: 20px; right: 20px; width: 32px; height: 32px; background: var(--taas-yellow, #FFC800); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 800; color: var(--taas-dark, #1A1A1A); }
.wb-step__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 8px; padding-right: 44px; }
.wb-step__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.6; }

.wb-callout { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; }
.wb-callout__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.wb-callout__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); line-height: 1.65; }

.wb-faq { max-width: 780px; }
.wb-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.wb-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.wb-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.wb-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.wb-faq__item--open .wb-faq__q::after { content: '−'; }
.wb-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.wb-faq__item--open .wb-faq__a { display: block; }

.wb-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.wb-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.wb-enquiry__phone:hover { color: #fff; }
.wb-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.wb-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }
.wb-section--dark .wpcf7 label, .wb-section--dark .wpcf7 span:not(.wpcf7-spinner), .wb-section--dark .wpcf7 div:not(.wpcf7-response-output), .wb-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.wb-section--dark .wpcf7 input[type="text"], .wb-section--dark .wpcf7 input[type="email"], .wb-section--dark .wpcf7 input[type="tel"], .wb-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.wb-section--dark .wpcf7 input::placeholder, .wb-section--dark .wpcf7 textarea::placeholder { color: #666; }
.wb-section--dark .wpcf7 input:focus, .wb-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.wb-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.wb-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

@media (max-width: 960px) {
  .wb-hero__inner { grid-template-columns: 1fr; }
  .wb-symptoms { grid-template-columns: 1fr; }
  .wb-process { grid-template-columns: 1fr; }
  .wb-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 640px) {
  .wb-hero { padding: 48px 0 40px; }
  .wb-hero h1 { font-size: clamp(24px, 6vw, 38px); }
  .wb-hero__sub { font-size: 14px; }
  .wb-hero__ctas { flex-direction: column; align-items: stretch; }
  .wb-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .wb-section { padding: 48px 0; }
  .wb-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .wb-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .wb-trust__item { font-size: 12px; }
  .wb-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .wb-faq__a { font-size: 13px; }
  .wb-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .wb-sidebar__phone { font-size: 20px; }
  .wb-callout { padding: 20px 22px; }
}
</style>

<section class="wb-hero">
  <div class="wb-hero__inner">
    <div>
      <span class="wb-hero__eyebrow">Tyre Centre — Manukau</span>
      <h1>Wheel Balancing<br><span>Manukau — South Auckland</span></h1>
      <p class="wb-hero__price">Wheel balancing <?php echo esc_html($balance_price); ?></p>
      <p class="wb-hero__sub">Steering vibrating at speed? ER85 touchscreen balancer — static, dynamic and run-out measured in a single spin. Included with new tyre fitting. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
      <div class="wb-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book Balancing</a>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      </div>
    </div>
    <div class="wb-sidebar">
      <div class="wb-sidebar__title">What We Check</div>
      <ul class="wb-sidebar__list">
        <li>Static imbalance</li>
        <li>Dynamic imbalance</li>
        <li>Lateral & radial run-out</li>
        <li>0.1mm accuracy</li>
        <li>Clip-on or stick-on weights</li>
        <li>Verification spin</li>
        <li>Refit to torque spec</li>
        <li>Road test confirmation</li>
      </ul>
      <hr>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wb-sidebar__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      <div class="wb-sidebar__detail"><?php echo esc_html(TAAS_PHONE_LOCAL); ?><br>Mon–Fri 7:30am–5:00pm</div>
    </div>
  </div>
</section>

<div class="wb-trust">
  <div class="wb-trust__inner">
    <div class="wb-trust__item">MTA Assured</div>
    <div class="wb-trust__item">NZTA Authorised</div>
    <div class="wb-trust__item">ER85 Touchscreen Balancer</div>
    <div class="wb-trust__item">Run-Out Detection</div>
    <div class="wb-trust__item">Included With New Tyres</div>
    <div class="wb-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  </div>
</div>

<section class="wb-section wb-section--white">
  <div class="wb-section__inner">
    <span class="wb-section__eyebrow">Warning Signs</span>
    <h2 class="wb-section__heading">Is Your Wheel Balance Off?</h2>
    <p class="wb-section__sub">If you recognise any of these, book a balance check. Vibration does not fix itself — it gets worse and causes secondary damage.</p>
    <div class="wb-symptoms">
      <?php foreach ($symptoms as $sym) : ?>
      <div class="wb-symptom"><?php echo esc_html($sym); ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="wb-section wb-section--grey">
  <div class="wb-section__inner">
    <span class="wb-section__eyebrow">Our Process</span>
    <h2 class="wb-section__heading">How We Balance Wheels</h2>
    <p class="wb-section__sub">Six steps — wheel-off, measured, corrected, verified, torqued, road tested.</p>
    <div class="wb-process">
      <?php foreach ($process_steps as $step) : ?>
      <div class="wb-step">
        <div class="wb-step__title"><?php echo esc_html($step['title']); ?></div>
        <p class="wb-step__body"><?php echo esc_html($step['desc']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="wb-section wb-section--white">
  <div class="wb-section__inner">
    <span class="wb-section__eyebrow">Why It Matters</span>
    <h2 class="wb-section__heading">Why Balanced Wheels Matter</h2>
    <ul style="list-style:none;padding:0;margin:0 0 28px;display:flex;flex-direction:column;gap:10px;max-width:720px;">
      <?php foreach ($why_points as $point) : ?>
      <li style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-body,#333);padding-left:20px;position:relative;line-height:1.5;"><span style="position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;">✓</span><?php echo esc_html($point); ?></li>
      <?php endforeach; ?>
    </ul>
    <div style="background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;max-width:720px;">
      <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-black,#111);margin-bottom:8px;">Our Equipment — ER85 Touchscreen Balancer</div>
      <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-mid,#666);line-height:1.6;">Detects static imbalance, dynamic imbalance, and lateral/radial run-out in a single spin. Accuracy to 0.1mm. Most balancers only detect weight imbalance — the ER85 catches the problems others miss.</p>
    </div>
  </div>
</section>

<section class="wb-section wb-section--grey">
  <div class="wb-section__inner">
    <span class="wb-section__eyebrow">Pricing</span>
    <h2 class="wb-section__heading">Wheel Balancing Pricing</h2>
    <div class="wb-callout">
      <div class="wb-callout__title">Wheel balancing <?php echo esc_html($balance_price); ?></div>
      <p class="wb-callout__body">All four wheels balanced as standard. Included with every new tyre fitting. Oversized 4WD or commercial tyres may vary — we confirm the estimate before starting. Wheel alignment also recommended: <?php echo esc_html($alignment_price); ?>.</p>
    </div>
  </div>
</section>

<section class="wb-section wb-section--dark" id="enquire">
  <div class="wb-section__inner">
    <div class="wb-enquiry">
      <div>
        <span class="wb-section__eyebrow">Book or Enquire</span>
        <h2 class="wb-section__heading">Book Wheel Balancing</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle and we will book you in.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wb-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="wb-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<section class="wb-section wb-section--white">
  <div class="wb-section__inner">
    <span class="wb-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="wb-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<section class="wb-section wb-section--grey">
  <div class="wb-section__inner">
    <div class="wb-faq">
      <span class="wb-section__eyebrow">FAQ</span>
      <h2 class="wb-section__heading">Wheel Balancing — Common Questions</h2>
      <div class="wb-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="wb-faq__item">
          <button class="wb-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="wb-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.wb-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.wb-faq__item');
    var wasOpen = item.classList.contains('wb-faq__item--open');
    document.querySelectorAll('.wb-faq__item--open').forEach(function(i){ i.classList.remove('wb-faq__item--open'); });
    if (!wasOpen) item.classList.add('wb-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
