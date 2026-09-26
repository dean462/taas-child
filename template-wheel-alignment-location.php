<?php
/**
 * Template Name: Wheel Alignment Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Wheel alignment location spoke pages.
 * URL: /wheel-alignment-[suburb]/
 * Self-contained suburb array — no taas-suburbs.php dependency.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url        = get_site_url();
$post_id         = get_the_ID();
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

$suburb_name = get_post_meta($post_id, 'suburb_name', true) ?: get_the_title();
$suburb_slug = get_post_meta($post_id, 'suburb_slug', true) ?: sanitize_title($suburb_name);

$suburbs = [
    'papatoetoe'     => ['name' => 'Papatoetoe',     'distance' => '~5 min',  'route' => 'via Great South Rd'],
    'manukau'        => ['name' => 'Manukau',         'distance' => 'at our workshop', 'route' => 'Cavendish Drive'],
    'mangere'        => ['name' => 'Māngere',         'distance' => '~10 min', 'route' => 'from Māngere town centre'],
    'otahuhu'        => ['name' => 'Ōtāhuhu',        'distance' => '~10 min', 'route' => 'via Great South Rd'],
    'wiri'           => ['name' => 'Wiri',            'distance' => '~5 min',  'route' => 'via Cavendish Drive'],
    'manurewa'       => ['name' => 'Manurewa',        'distance' => '~10 min', 'route' => 'via Great South Rd'],
    'flat-bush'      => ['name' => 'Flat Bush',       'distance' => '~15 min', 'route' => 'via Ormiston Rd'],
    'takanini'       => ['name' => 'Takanini',        'distance' => '~12 min', 'route' => 'via Great South Rd'],
    'papakura'       => ['name' => 'Papakura',        'distance' => '~15 min', 'route' => 'via Great South Rd'],
    'otara'          => ['name' => 'Ōtara',           'distance' => '~8 min',  'route' => 'via East Tāmaki Rd'],
    'botany'         => ['name' => 'Botany',          'distance' => '~20 min', 'route' => 'via Ti Rakau Drive'],
    'howick'         => ['name' => 'Howick',          'distance' => '~20 min', 'route' => 'via Ti Rakau Drive'],
    'clover-park'    => ['name' => 'Clover Park',     'distance' => '~10 min', 'route' => 'via Ti Rakau Drive'],
    'weymouth'       => ['name' => 'Weymouth',        'distance' => '~18 min', 'route' => 'via Weymouth Rd'],
    'clendon'        => ['name' => 'Clendon',         'distance' => '~15 min', 'route' => 'via Roscommon Rd'],
    'hunters-corner' => ['name' => 'Hunters Corner',  'distance' => '~5 min',  'route' => 'via Lambie Drive'],
];

$current_suburb = isset($suburbs[$suburb_slug]) ? $suburbs[$suburb_slug] : ['name' => $suburb_name, 'distance' => 'nearby', 'route' => ''];
$distance_text  = $current_suburb['distance'];

$faqs = [
    ['q' => "Where can I get a wheel alignment near {$suburb_name}?", 'a' => "Tony Allen Auto Service at 139 Cavendish Drive, Manukau — {$distance_text} {$current_suburb['route']} from {$suburb_name}. 3D laser four-wheel alignment on our dedicated hoist. Call " . TAAS_PHONE_FREE . " to book."],
    ['q' => "How much does a wheel alignment cost near {$suburb_name}?", 'a' => "Four-wheel alignment {$alignment_price}. Includes suspension inspection, tyre pressure reset, and before-and-after print-out. Estimate given before we start."],
    ['q' => 'What causes wheels to go out of alignment?', 'a' => 'Potholes, kerb strikes, and general road wear. Suspension repairs also shift alignment angles. South Auckland roads can knock alignment out faster than usual — check annually or after any significant impact.'],
    ['q' => 'How often should I get a wheel alignment?', 'a' => 'Every 12 months or 20,000 km — whichever comes first. Also after potholes, kerb strikes, or suspension work. If your car is pulling or tyres are wearing unevenly, get it checked immediately.'],
    ['q' => 'Do you align 4WDs and SUVs?', 'a' => 'Yes. Our 3D laser alignment system covers all vehicle types — cars, SUVs, 4WDs, utes, and vans.'],
    ['q' => 'Is alignment included when you fit new tyres?', 'a' => "We recommend alignment with every new tyre fitting. Fitting new tyres without checking alignment means any existing misalignment immediately starts wearing the new rubber. Alignment {$alignment_price} — worth it for the tyre life you save."],
    ['q' => 'What is the difference between alignment and balancing?', 'a' => "Alignment adjusts the angles of the wheels — fixes pulling and uneven wear. Balancing distributes weight evenly around the wheel — fixes vibration at speed. Different problems, different solutions. We do both on-site."],
    ['q' => 'Do you do a print-out?', 'a' => 'Yes — before and after. The print-out shows camber, caster, and toe on all four corners compared to manufacturer spec. Green values are within spec, red were out of range. Your record that the work was done correctly.'],
    ['q' => 'Can I pay with finance?', 'a' => 'Yes. Afterpay, Q Card, and GEM Finance accepted.'],
    ['q' => 'What are your hours?', 'a' => TAAS_HOURS . ". Walk-ins welcome mornings — booking recommended for afternoons. {$distance_text} from {$suburb_name}."],
];

$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]];
}
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tyre Centre', 'item' => $site_url . '/tyre-centre/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => 'Wheel Alignment', 'item' => $site_url . '/wheel-alignment-manukau/'],
        ['@type' => 'ListItem', 'position' => 4, 'name' => 'Alignment ' . $suburb_name, 'item' => $page_url],
    ]],
    ['@type' => ['AutoRepair', 'LocalBusiness'],
     'name' => 'Tony Allen Auto Service',
     'url' => $site_url,
     'telephone' => [TAAS_PHONE_FREE, TAAS_PHONE_LOCAL],
     'email' => TAAS_EMAIL,
     'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
     'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
     'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
     'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => TAAS_RATING, 'reviewCount' => preg_replace('/\D+/', '', TAAS_REVIEWS), 'bestRating' => '5'],
     'foundingDate' => '1985-10-01',
     'areaServed' => $suburb_name . ', South Auckland',
     'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.wal-hero h1', '.wal-section__heading', '.wal-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-wheel-alignment-location .site-content,
.page-template-template-wheel-alignment-location .entry-content,
.page-template-template-wheel-alignment-location .entry-header,
.page-template-template-wheel-alignment-location article,
.page-template-template-wheel-alignment-location #primary,
.page-template-template-wheel-alignment-location #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-wheel-alignment-location { overflow-x:hidden; }

.wal-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.wal-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.wal-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.wal-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 12px; }
.wal-hero h1 span { color: var(--taas-yellow, #FFC800); }
.wal-hero__distance { font-family: var(--taas-font, 'Inter', Arial, sans-serif); display: inline-block; background: rgba(255,200,0,0.15); color: var(--taas-yellow, #FFC800); font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 100px; margin-bottom: 16px; }
.wal-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 620px; margin: 0 0 28px; line-height: 1.65; }
.wal-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }

.wal-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.wal-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.wal-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.wal-trust__item::before { content: '✓'; font-weight: 900; }

.wal-section { padding: var(--taas-sec-pad, 72px) 0; }
.wal-section--white { background: var(--taas-white, #FFFFFF); }
.wal-section--grey  { background: var(--taas-panel, #F7F7F5); }
.wal-section--dark  { background: var(--taas-dark, #1A1A1A); }
.wal-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.wal-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.wal-section--dark .wal-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.wal-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.wal-section--dark .wal-section__heading { color: var(--taas-white, #FFFFFF); }
.wal-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 28px; line-height: 1.65; }
.wal-section--dark .wal-section__sub { color: #aaa; }

.wal-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; list-style: none; padding: 0; }
.wal-pills li a { display: inline-block; padding: 7px 18px; border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; background: var(--taas-white, #FFFFFF); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); text-decoration: none; transition: all 0.15s; }
.wal-pills li a:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 600; }
.wal-pills li a[aria-current="page"] { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 700; pointer-events: none; }

.wal-faq { max-width: 780px; }
.wal-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.wal-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.wal-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.wal-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.wal-faq__item--open .wal-faq__q::after { content: '−'; }
.wal-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.wal-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.wal-faq__item--open .wal-faq__a { display: block; }

.wal-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.wal-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.wal-enquiry__phone:hover { color: #fff; }
.wal-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.wal-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }
.wal-section--dark .wpcf7 label, .wal-section--dark .wpcf7 span:not(.wpcf7-spinner), .wal-section--dark .wpcf7 div:not(.wpcf7-response-output), .wal-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.wal-section--dark .wpcf7 input[type="text"], .wal-section--dark .wpcf7 input[type="email"], .wal-section--dark .wpcf7 input[type="tel"], .wal-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.wal-section--dark .wpcf7 input::placeholder, .wal-section--dark .wpcf7 textarea::placeholder { color: #666; }
.wal-section--dark .wpcf7 input:focus, .wal-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.wal-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.wal-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

@media (max-width: 960px) { .wal-enquiry { grid-template-columns: 1fr; gap: 32px; } }
@media (max-width: 640px) {
  .wal-hero { padding: 48px 0 40px; }
  .wal-hero h1 { font-size: clamp(24px, 6vw, 38px); }
  .wal-hero__sub { font-size: 14px; }
  .wal-hero__ctas { flex-direction: column; align-items: stretch; }
  .wal-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .wal-section { padding: 48px 0; }
  .wal-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .wal-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .wal-trust__item { font-size: 12px; }
  .wal-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .wal-faq__a { font-size: 13px; }
  .wal-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
}
</style>

<section class="wal-hero">
  <div class="wal-hero__inner">
    <span class="wal-hero__eyebrow">Wheel Alignment — <?php echo esc_html($suburb_name); ?></span>
    <h1>Wheel Alignment <?php echo esc_html($suburb_name); ?><br><span>South Auckland</span></h1>
    <span class="wal-hero__distance"><?php echo esc_html($distance_text); ?> <?php echo esc_html($current_suburb['route']); ?> · <?php echo esc_html(TAAS_HOURS); ?></span>
    <p class="wal-hero__sub">3D laser four-wheel alignment for <?php echo esc_html($suburb_name); ?> drivers. Camber, caster, and toe measured and adjusted to manufacturer spec — before-and-after print-out included. <?php echo esc_html($alignment_price); ?>.</p>
    <div class="wal-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Book Alignment</a>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
    </div>
  </div>
</section>

<div class="wal-trust">
  <div class="wal-trust__inner">
    <div class="wal-trust__item">MTA Assured</div>
    <div class="wal-trust__item">NZTA Authorised</div>
    <div class="wal-trust__item">3D Laser Equipment</div>
    <div class="wal-trust__item">Print-Out Included</div>
    <div class="wal-trust__item"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</div>
  </div>
</div>

<section class="wal-section wal-section--white">
  <div class="wal-section__inner">
    <span class="wal-section__eyebrow">What to Expect</span>
    <h2 class="wal-section__heading">Wheel Alignment for <?php echo esc_html($suburb_name); ?> Drivers</h2>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;max-width:720px;">If you are in <?php echo esc_html($suburb_name); ?> and your car is pulling, your steering is off-centre, or your tyres are wearing unevenly — we are <?php echo esc_html($distance_text); ?> away at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;max-width:720px;">We use a 3D laser alignment system to measure all four wheels simultaneously. Camber, caster, and toe on every corner — compared against the manufacturer's values for your vehicle. You get a before-and-after print-out so you can see exactly what was adjusted.</p>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;max-width:720px;">Four-wheel alignment <?php echo esc_html($alignment_price); ?>. Includes suspension inspection, tyre pressure reset, and road test. Walk-ins welcome mornings — call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> to book.</p>
  </div>
</section>

<section class="wal-section wal-section--grey">
  <div class="wal-section__inner">
    <span class="wal-section__eyebrow">Pricing</span>
    <h2 class="wal-section__heading">Alignment Pricing</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <div style="background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;text-align:center;">
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:6px;">Four-Wheel Alignment</div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:24px;font-weight:800;color:var(--taas-black,#111);"><?php echo esc_html($alignment_price); ?></div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:var(--taas-mid,#666);margin-top:6px;">3D laser · print-out included</div>
      </div>
      <div style="background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;text-align:center;">
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:6px;">Wheel Balancing</div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:24px;font-weight:800;color:var(--taas-black,#111);"><?php echo esc_html($balance_price); ?></div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:13px;color:var(--taas-mid,#666);margin-top:6px;">included with new tyre fitting</div>
      </div>
    </div>
  </div>
</section>

<section class="wal-section wal-section--dark" id="enquire">
  <div class="wal-section__inner">
    <div class="wal-enquiry">
      <div>
        <span class="wal-section__eyebrow">Book or Enquire</span>
        <h2 class="wal-section__heading">Book a Wheel Alignment</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle make and model — we will confirm availability and book you in.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="wal-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="wal-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?><br><?php echo esc_html($distance_text); ?> from <?php echo esc_html($suburb_name); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<section class="wal-section wal-section--white">
  <div class="wal-section__inner">
    <span class="wal-section__eyebrow">South Auckland</span>
    <h2 class="wal-section__heading">Wheel Alignment Near You</h2>
    <ul class="wal-pills">
      <?php foreach ($suburbs as $slug => $data) :
          $is_current = ($slug === $suburb_slug);
      ?>
      <li><a href="<?php echo esc_url($site_url . '/wheel-alignment-' . $slug . '/'); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>>Alignment <?php echo esc_html($data['name']); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="wal-section wal-section--grey">
  <div class="wal-section__inner">
    <div class="wal-faq">
      <span class="wal-section__eyebrow">FAQ</span>
      <h2 class="wal-section__heading">Wheel Alignment <?php echo esc_html($suburb_name); ?> — Questions</h2>
      <div class="wal-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="wal-faq__item">
          <button class="wal-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="wal-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="wal-section wal-section--white">
  <div class="wal-section__inner">
    <span class="wal-section__eyebrow"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</span>
    <h2 class="wal-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<script>
document.querySelectorAll('.wal-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.wal-faq__item');
    var wasOpen = item.classList.contains('wal-faq__item--open');
    document.querySelectorAll('.wal-faq__item--open').forEach(function(i){ i.classList.remove('wal-faq__item--open'); });
    if (!wasOpen) item.classList.add('wal-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
