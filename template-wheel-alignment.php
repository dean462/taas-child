<?php
/**
 * Template Name: Wheel Alignment
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /wheel-alignment-manukau/
 * Parent: /tyre-centre/
 *
 * Standalone service page — not a hub.
 * Rich educational content: symptoms, process, why it matters.
 * 3D laser alignment, before-and-after print-out.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url        = get_site_url();
$page_url        = get_permalink();
$established     = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$years           = date('Y') - intval($established);
$rating          = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$reviews         = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$customers       = defined('TAAS_CUSTOMERS')       ? TAAS_CUSTOMERS       : '10,000+';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$balance_price   = defined('TAAS_BALANCE_PRICE')   ? TAAS_BALANCE_PRICE   : 'from $25 per wheel incl. GST';
$reviews_widget  = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general     = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$phone_free_tel  = preg_replace('/[^0-9+]/', '', TAAS_PHONE_FREE);
$maps_url        = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

// ── Content ──────────────────────────────────────────────────────────────────
$symptoms = [
    'Car pulling left or right — steering wheel off-centre',
    'Uneven or rapid tyre wear — one edge worn before the other',
    'Steering feels loose, wandering, or vague',
    'Vehicle drifts on straight, flat roads',
    'New tyres wearing out too fast',
    'Noticed a knock after a pothole or kerb hit',
    'Steering wheel not centred on a straight road',
];

$process_steps = [
    ['title' => 'Suspension & Tyre Check', 'desc' => 'Before any alignment, we inspect suspension components, tyre condition, and tyre pressures. Worn ball joints or damaged tyres make alignment impossible to hold — we find these first.'],
    ['title' => '3D Laser Four-Wheel Alignment', 'desc' => 'We use a 3D laser alignment system to measure all four wheels simultaneously — camber, caster, and toe on every corner. Print-out before and after so you can see exactly what was adjusted.'],
    ['title' => 'Adjustment to Manufacturer Spec', 'desc' => "All four wheels are adjusted to the vehicle manufacturer's specified tolerances. Not a best-guess — the actual values your vehicle was designed for, pulled from the alignment system database."],
    ['title' => 'Test Drive & Confirmation', 'desc' => 'We road test after alignment to confirm straight tracking and centred steering. If anything is still off, we recheck before returning the vehicle.'],
];

$why_points = [
    'Tyres last significantly longer with correct alignment — typically 20–30% more life',
    'Fuel economy improves — misaligned wheels create rolling resistance the engine fights constantly',
    'Safer handling — correct geometry means the car responds predictably in emergency manoeuvres',
    'Protects suspension — misalignment puts stress on ball joints, tie rods, and wheel bearings',
    'A wheel knocked out of alignment by a pothole can cause tyre wear in weeks, not months',
];

$faqs = [
    ['q' => 'How much does a wheel alignment cost in Manukau?', 'a' => 'Four-wheel alignment ' . $alignment_price . '. That covers the full 3D laser alignment check, suspension inspection, tyre pressure reset, and a before-and-after print-out. We always give you the total price before we start.'],
    ['q' => 'What causes a wheel to go out of alignment?', 'a' => "Potholes, kerb strikes, and general road wear over time. Suspension work — replacing a control arm, ball joint, or strut — can also shift alignment angles and should always be followed by a check. Even normal driving gradually shifts alignment, which is why the 12-month or 20,000 km interval exists."],
    ['q' => 'How often should I get a wheel alignment?', 'a' => "Every 12 months or 20,000 km — whichever comes first. Also immediately after any significant pothole, kerb strike, or suspension work. South Auckland roads can knock alignment out faster than the annual schedule suggests."],
    ['q' => 'Can bad wheel alignment damage my car?', 'a' => 'Yes. Misalignment causes uneven tyre wear, increases fuel consumption, and puts ongoing stress on suspension components including ball joints, tie rods, and wheel bearings. Alignment is one of the cheapest preventative maintenance items — compared to the damage it prevents.'],
    ['q' => 'Do you do wheel alignment on 4WDs and SUVs?', 'a' => 'Yes — we align all vehicle types including cars, SUVs, 4WDs, utes, and vans. Some 4WD vehicles have additional alignment points. Our 3D laser alignment system covers the full range.'],
    ['q' => 'My new tyres are already wearing unevenly — what is wrong?', 'a' => 'New tyres wearing unevenly almost always means the alignment was not checked when the tyres were fitted. Uneven wear within the first few thousand kilometres is a clear sign the geometry is off. Bring the vehicle in as soon as you notice it — the sooner we correct it, the more tyre life you save.'],
    ['q' => 'What does a wheel alignment print-out show?', 'a' => "Our 3D laser system produces a before-and-after print-out showing camber, caster, and toe on all four corners, compared against the manufacturer's range. Green values are within spec, red values were out. We always provide this print-out."],
    ['q' => 'Is wheel alignment the same as wheel balancing?', 'a' => 'No. Alignment adjusts the angles of the wheels relative to the vehicle — camber, caster, and toe. Balancing distributes weight evenly around the wheel so it spins without vibration. Both are important but they address different problems. Alignment fixes pulling and uneven wear. Balancing fixes vibration at speed.'],
    ['q' => 'Do you check alignment when fitting new tyres?', 'a' => 'We recommend it every time and will advise you when the tyres are fitted. Fitting new tyres without alignment means any existing misalignment will immediately start wearing the new rubber unevenly.'],
    ['q' => 'Where is your alignment workshop?', 'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . TAAS_HOURS . '. Call ' . TAAS_PHONE_FREE . ' to book. Dedicated alignment hoist on-site.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]];
}
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tyre Centre', 'item' => $site_url . '/tyre-centre/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Wheel Alignment', 'item' => $page_url],
    ]],
    ['@type' => ['AutoRepair', 'LocalBusiness'],
     'name' => 'Tony Allen Auto Service — Wheel Alignment',
     'url' => $page_url,
     'description' => 'Four-wheel 3D laser alignment in Manukau, South Auckland. Camber, caster and toe measured and adjusted to manufacturer spec. Before-and-after print-out included. ' . $alignment_price . '.',
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
     'sameAs' => ['https://www.facebook.com/tikitikiracing/', 'https://www.google.com/maps/place/Tony+Allen+Auto+Service'],
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.wa-hero h1', '.wa-section__heading', '.wa-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-wheel-alignment .site-content,
.page-template-template-wheel-alignment .entry-content,
.page-template-template-wheel-alignment .entry-header,
.page-template-template-wheel-alignment article,
.page-template-template-wheel-alignment #primary,
.page-template-template-wheel-alignment #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-wheel-alignment { overflow-x:hidden; }

.wa-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.wa-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 300px; gap: 48px; align-items: start; }
.wa-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.wa-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 12px; }
.wa-hero h1 span { color: var(--taas-yellow, #FFC800); }
.wa-hero__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 600; color: var(--taas-yellow, #FFC800); margin: 0 0 12px; }
.wa-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 540px; margin: 0 0 28px; line-height: 1.65; }
.wa-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.wa-sidebar { background: #1e1e1e; border: 1px solid #333; border-radius: var(--taas-radius, 6px); padding: 24px; }
.wa-sidebar__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 14px; }
.wa-sidebar__list { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 8px; }
.wa-sidebar__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: #ccc; padding-left: 18px; position: relative; line-height: 1.4; }
.wa-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }
.wa-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 16px; }
.wa-sidebar__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 22px; font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin-bottom: 4px; }
.wa-sidebar__phone:hover { color: #fff; }
.wa-sidebar__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; color: #666; line-height: 1.6; }

.wa-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.wa-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.wa-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.wa-trust__item::before { content: '✓'; font-weight: 900; }

.wa-section { padding: var(--taas-sec-pad, 72px) 0; }
.wa-section--white { background: var(--taas-white, #FFFFFF); }
.wa-section--grey  { background: var(--taas-panel, #F7F7F5); }
.wa-section--dark  { background: var(--taas-dark, #1A1A1A); }
.wa-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.wa-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.wa-section--dark .wa-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.wa-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.wa-section--dark .wa-section__heading { color: var(--taas-white, #FFFFFF); }
.wa-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 28px; line-height: 1.65; }
.wa-section--dark .wa-section__sub { color: #aaa; }

.wa-symptoms { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.wa-symptom { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); padding: 14px 14px 14px 22px; background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); position: relative; line-height: 1.4; }
.wa-symptom::before { content: '⚠'; position: absolute; left: 14px; top: 14px; font-size: 14px; }
.wa-symptom { padding-left: 38px; }

.wa-process { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; counter-reset: step; }
.wa-step { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 24px; counter-increment: step; position: relative; }
.wa-step::before { content: counter(step); position: absolute; top: 20px; right: 20px; width: 32px; height: 32px; background: var(--taas-yellow, #FFC800); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 800; color: var(--taas-dark, #1A1A1A); }
.wa-step__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 8px; padding-right: 44px; }
.wa-step__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.6; }

.wa-edu { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.wa-edu__panel { background: var(--taas-dark, #1A1A1A); border-radius: var(--taas-radius, 6px); padding: 32px 28px; }
.wa-edu__panel-title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 16px; }
.wa-edu__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.wa-edu__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: #ccc; padding-left: 20px; position: relative; line-height: 1.5; }
.wa-edu__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }

.wa-callout { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; }
.wa-callout__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.wa-callout__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); line-height: 1.65; }

.wa-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; list-style: none; padding: 0; }
.wa-pills li a { display: inline-block; padding: 7px 18px; border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; background: var(--taas-white, #FFFFFF); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); text-decoration: none; transition: all 0.15s; }
.wa-pills li a:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 600; }

.wa-faq { max-width: 780px; }
.wa-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.wa-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.wa-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.wa-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.wa-faq__item--open .wa-faq__q::after { content: '−'; }
.wa-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.wa-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.wa-faq__a a:hover { text-decoration: underline; }
.wa-faq__item--open .wa-faq__a { display: block; }

.wa-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.wa-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.wa-enquiry__phone:hover { color: #fff; }
.wa-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.wa-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

.wa-section--dark .wpcf7 label, .wa-section--dark .wpcf7 span:not(.wpcf7-spinner), .wa-section--dark .wpcf7 div:not(.wpcf7-response-output), .wa-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.wa-section--dark .wpcf7 input[type="text"], .wa-section--dark .wpcf7 input[type="email"], .wa-section--dark .wpcf7 input[type="tel"], .wa-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.wa-section--dark .wpcf7 input::placeholder, .wa-section--dark .wpcf7 textarea::placeholder { color: #666; }
.wa-section--dark .wpcf7 input:focus, .wa-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.wa-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.wa-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

@media (max-width: 960px) {
  .wa-hero__inner { grid-template-columns: 1fr; }
  .wa-symptoms { grid-template-columns: 1fr; }
  .wa-process { grid-template-columns: 1fr; }
  .wa-edu { grid-template-columns: 1fr; }
  .wa-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 640px) {
  .wa-hero { padding: 48px 0 40px; }
  .wa-hero h1 { font-size: clamp(24px, 6vw, 38px); }
  .wa-hero__sub { font-size: 14px; }
  .wa-hero__ctas { flex-direction: column; align-items: stretch; }
  .wa-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .wa-section { padding: 48px 0; }
  .wa-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .wa-section__sub { font-size: 14px; }
  .wa-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .wa-trust__item { font-size: 12px; }
  .wa-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .wa-faq__a { font-size: 13px; }
  .wa-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .wa-sidebar__phone { font-size: 20px; }
  .wa-callout { padding: 20px 22px; }
}
</style>

<section class="wa-hero">
  <div class="wa-hero__inner">
    <div>
      <span class="wa-hero__eyebrow">Tyre Centre — Manukau</span>
      <h1>Wheel Alignment<br><span>Manukau — South Auckland</span></h1>
      <p class="wa-hero__price">Four-wheel alignment <?php echo esc_html($alignment_price); ?></p>
      <p class="wa-hero__sub">Car pulling to one side? Tyres wearing unevenly? Steering off-centre? 3D laser four-wheel alignment at 139 Cavendish Drive — before-and-after print-out included. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
      <div class="wa-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book Alignment</a>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      </div>
    </div>
    <div class="wa-sidebar">
      <div class="wa-sidebar__title">What We Check</div>
      <ul class="wa-sidebar__list">
        <li>Four-wheel alignment — all angles</li>
        <li>Camber, caster & toe</li>
        <li>Tyre pressure reset</li>
        <li>Suspension inspection</li>
        <li>Before & after print-out</li>
        <li>Road test confirmation</li>
        <li>Cars, SUVs, 4WDs, utes, vans</li>
      </ul>
      <hr>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wa-sidebar__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      <div class="wa-sidebar__detail"><?php echo esc_html(TAAS_PHONE_LOCAL); ?><br>Mon–Fri 7:30am–5:00pm</div>
    </div>
  </div>
</section>

<div class="wa-trust">
  <div class="wa-trust__inner">
    <div class="wa-trust__item">MTA Assured</div>
    <div class="wa-trust__item">NZTA Authorised</div>
    <div class="wa-trust__item">3D Laser Equipment</div>
    <div class="wa-trust__item">Print-Out Included</div>
    <div class="wa-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  </div>
</div>

<section class="wa-section wa-section--white">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow">Warning Signs</span>
    <h2 class="wa-section__heading">Is Your Wheel Alignment Off?</h2>
    <p class="wa-section__sub">Any one of these is worth getting checked — ignoring them costs tyre life and can accelerate suspension wear.</p>
    <div class="wa-symptoms">
      <?php foreach ($symptoms as $sym) : ?>
      <div class="wa-symptom"><?php echo esc_html($sym); ?></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="wa-section wa-section--grey">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow">Our Process</span>
    <h2 class="wa-section__heading">How We Do Wheel Alignment</h2>
    <p class="wa-section__sub">Measured, adjusted, confirmed — with a print-out before and after so you can see exactly what changed.</p>
    <div class="wa-process">
      <?php foreach ($process_steps as $step) : ?>
      <div class="wa-step">
        <div class="wa-step__title"><?php echo esc_html($step['title']); ?></div>
        <p class="wa-step__body"><?php echo esc_html($step['desc']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="wa-section wa-section--white">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow">Why It Matters</span>
    <div class="wa-edu">
      <div>
        <h2 class="wa-section__heading">Why Correct Alignment Saves You Money</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:20px;">Wheel alignment is one of the lowest-cost preventative maintenance items on your vehicle — and one of the highest-value, because of what it prevents.</p>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
          <?php foreach ($why_points as $point) : ?>
          <li style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-body,#333);padding-left:20px;position:relative;line-height:1.5;"><span style="position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;">✓</span><?php echo esc_html($point); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <div class="wa-edu__panel">
          <div class="wa-edu__panel-title">Check Every 12 Months or 20,000 km</div>
          <ul class="wa-edu__list">
            <li>Manufacturer-recommended interval for most vehicles</li>
            <li>Sooner after pothole, kerb strike, or suspension work</li>
            <li>South Auckland roads accelerate alignment drift</li>
            <li>20–30% more tyre life with correct alignment</li>
            <li>A pothole can cause tyre wear in weeks, not months</li>
          </ul>
        </div>
        <div style="background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;margin-top:16px;">
          <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-black,#111);margin-bottom:8px;">Our Equipment</div>
          <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-mid,#666);line-height:1.6;"><strong style="color:var(--taas-black,#111);">3D Laser Four-Wheel Alignment System</strong> — measures all four corners simultaneously with live readouts against manufacturer specifications. Covers the full vehicle range including cars, SUVs, 4WDs, utes, and vans.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="wa-section wa-section--grey">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow">Pricing</span>
    <h2 class="wa-section__heading">Wheel Alignment Pricing</h2>
    <div class="wa-callout">
      <div class="wa-callout__title">Four-wheel alignment <?php echo esc_html($alignment_price); ?></div>
      <p class="wa-callout__body">Covers the full 3D laser alignment check, suspension inspection, tyre pressure reset, and a before-and-after print-out. We always give you the total estimate before we start. Finance available via Afterpay, Q Card and GEM Finance.</p>
    </div>
  </div>
</section>

<section class="wa-section wa-section--dark" id="enquire">
  <div class="wa-section__inner">
    <div class="wa-enquiry">
      <div>
        <span class="wa-section__eyebrow">Book or Enquire</span>
        <h2 class="wa-section__heading">Book a Wheel Alignment</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle make and model — we will confirm availability and book you in.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wa-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="wa-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<section class="wa-section wa-section--white">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="wa-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<section class="wa-section wa-section--grey">
  <div class="wa-section__inner">
    <span class="wa-section__eyebrow">South Auckland</span>
    <h2 class="wa-section__heading">Wheel Alignment Near You</h2>
    <p class="wa-section__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="wa-pills">
      <?php
      $suburbs = [
          ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Manukau','slug'=>'manukau'],
          ['label'=>'Māngere','slug'=>'mangere'],['label'=>'Ōtāhuhu','slug'=>'otahuhu'],
          ['label'=>'Wiri','slug'=>'wiri'],['label'=>'Manurewa','slug'=>'manurewa'],
          ['label'=>'Flat Bush','slug'=>'flat-bush'],['label'=>'Takanini','slug'=>'takanini'],
          ['label'=>'Papakura','slug'=>'papakura'],['label'=>'Ōtara','slug'=>'otara'],
          ['label'=>'Botany','slug'=>'botany'],['label'=>'Howick','slug'=>'howick'],
          ['label'=>'Clover Park','slug'=>'clover-park'],['label'=>'Weymouth','slug'=>'weymouth'],
          ['label'=>'Clendon','slug'=>'clendon'],['label'=>'Hunters Corner','slug'=>'hunters-corner'],
      ];
      foreach ($suburbs as $s) {
          echo '<li><a href="' . esc_url($site_url . '/wheel-alignment-' . $s['slug'] . '/') . '">Alignment ' . esc_html($s['label']) . '</a></li>';
      }
      ?>
    </ul>
  </div>
</section>

<section class="wa-section wa-section--white">
  <div class="wa-section__inner">
    <div class="wa-faq">
      <span class="wa-section__eyebrow">FAQ</span>
      <h2 class="wa-section__heading">Wheel Alignment — Common Questions</h2>
      <div class="wa-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="wa-faq__item">
          <button class="wa-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="wa-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.wa-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.wa-faq__item');
    var wasOpen = item.classList.contains('wa-faq__item--open');
    document.querySelectorAll('.wa-faq__item--open').forEach(function(i){ i.classList.remove('wa-faq__item--open'); });
    if (!wasOpen) item.classList.add('wa-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
