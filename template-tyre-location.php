<?php
/**
 * Template Name: Tyre Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Tyre location spoke pages — two URL sets:
 *   Set 1 (branded): /tony-allen-tyres-[suburb]/
 *   Set 2 (cluster):  /tyres/[suburb]/
 *
 * Content from post_meta (suburb_name, suburb_slug, page_set).
 * Self-contained suburb array — no taas-suburbs.php dependency.
 * 16 standard suburbs.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url        = get_site_url();
$post_id         = get_the_ID();
$page_url        = get_permalink();
$phone_local     = defined('TAAS_PHONE_LOCAL')     ? TAAS_PHONE_LOCAL     : '09 278 9556';
$phone_free      = defined('TAAS_PHONE_FREE')      ? TAAS_PHONE_FREE      : '0800 100 876';
$email           = defined('TAAS_EMAIL')           ? TAAS_EMAIL           : 'enquiries@taas.co.nz';
$address         = defined('TAAS_ADDRESS')         ? TAAS_ADDRESS         : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours           = defined('TAAS_HOURS')           ? TAAS_HOURS           : 'Monday–Friday 7:30am–5:00pm';
$established     = defined('TAAS_ESTABLISHED')     ? TAAS_ESTABLISHED     : '1985';
$rating          = defined('TAAS_RATING')          ? TAAS_RATING          : '4.2';
$reviews         = defined('TAAS_REVIEWS')         ? TAAS_REVIEWS         : '200+';
$customers       = defined('TAAS_CUSTOMERS')       ? TAAS_CUSTOMERS       : '10,000+';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$balance_price   = defined('TAAS_BALANCE_PRICE')   ? TAAS_BALANCE_PRICE   : 'from $25 per wheel incl. GST';
$tpms_price      = defined('TAAS_TPMS_PRICE')      ? TAAS_TPMS_PRICE      : 'from $75';
$reviews_widget  = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general     = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$phone_free_tel  = preg_replace('/[^0-9+]/', '', $phone_free);
$years           = date('Y') - intval($established);
$maps_url        = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

// ── Post meta ────────────────────────────────────────────────────────────────
$suburb_name = get_post_meta($post_id, 'suburb_name', true) ?: get_the_title();
$suburb_slug = get_post_meta($post_id, 'suburb_slug', true) ?: sanitize_title($suburb_name);
$page_set    = get_post_meta($post_id, 'page_set', true) ?: 'cluster';

// ── Self-contained suburb data ───────────────────────────────────────────────
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
$is_branded     = ($page_set === 'branded');

// ── Branded vs Cluster content ──────────────────────────────────────────────
if ($is_branded) {
    $hero_eyebrow = 'Tony Allen Tyres — ' . $suburb_name;
    $hero_h1      = 'Tony Allen Tyres ' . $suburb_name;
    $hero_h1_span = 'Your Local Tyre Shop';
    $hero_sub     = 'Tony Allen Auto Service — family-owned since ' . $established . '. Trusted by ' . $customers . ' customers across South Auckland for tyre supply, fitting, balancing and alignment. ' . ucfirst($distance_text) . ' from ' . $suburb_name . '.';
    $expect_heading = 'Why ' . $suburb_name . ' Drivers Choose Tony Allen';
    $expect_p1    = 'Tony Allen Auto Service has been fitting tyres in South Auckland since ' . $established . '. When you come to us for tyres, you are dealing with a family-owned independent workshop — not a tyre retail chain. We recommend the right tyre for your vehicle and driving style, not the one with the biggest margin.';
    $expect_p2    = 'Every set of tyres is fitted, balanced and aligned on-site in a single visit. We carry Maxxis, Continental, Goodyear, Hifly, Rovelo and more — budget through to premium. Our technicians fit hundreds of sets a year and our 3D laser alignment hoist ensures your new tyres wear evenly from day one.';
    $expect_p3    = 'We are at 139 Cavendish Drive, Manukau — ' . $distance_text . ' from ' . $suburb_name . '. Walk-ins welcome mornings, booking recommended for afternoons.';
    $trust_extra  = 'Family-Owned Since ' . $established;
} else {
    $hero_eyebrow = 'Tyres — ' . $suburb_name;
    $hero_h1      = 'Tyres ' . $suburb_name;
    $hero_h1_span = 'South Auckland';
    $hero_sub     = 'Tyre supply, fitting, wheel alignment and balancing for ' . $suburb_name . ' and surrounding areas. Budget to premium brands for cars, SUVs, 4WDs and light commercial. ' . $years . ' years of workshop experience, serving ' . $customers . ' customers.';
    $expect_heading = 'Tyre Service for ' . $suburb_name . ' Drivers';
    $expect_p1    = 'If you are in ' . $suburb_name . ' and need new tyres, a puncture repaired, or your alignment checked — we are ' . $distance_text . ' away at 139 Cavendish Drive, Manukau.';
    $expect_p2    = 'We supply, fit and balance tyres in one visit — no need to book at one shop and fit at another. Budget to premium brands available, and we will recommend based on your vehicle and how you drive, not on margin. Wheel alignment is done on-site with our 3D laser alignment hoist — recommended every time new tyres are fitted.';
    $expect_p3    = 'Walk-ins are welcome mornings. Booking is recommended for afternoons — call ' . $phone_free . ' or send us your details below.';
    $trust_extra  = '7 Brands in Stock';
}

// ── FAQs (different per page set) ───────────────────────────────────────────
if ($is_branded) {
    $faqs = [
        ['q' => "Why choose Tony Allen for tyres near {$suburb_name}?", 'a' => "Tony Allen Auto Service is a family-owned workshop trading since {$established} — not a tyre retail chain. We supply, fit, balance and align in one visit. We recommend tyres based on your vehicle and driving, not margin. Over {$customers} customers trust us across South Auckland."],
        ['q' => "Is Tony Allen Auto Service a good tyre shop?", 'a' => "We are rated {$rating} stars from {$reviews} Google reviews. MTA Assured, NZTA Authorised, and we have been fitting tyres in South Auckland for over {$years} years. We carry Maxxis, Continental, Goodyear, Hifly and more."],
        ['q' => "How far is Tony Allen from {$suburb_name}?", 'a' => "We are {$distance_text} from {$suburb_name} {$current_suburb['route']}. 139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}."],
        ['q' => "Does Tony Allen do wheel alignment?", 'a' => "Yes. 3D laser wheel alignment on our dedicated alignment hoist — {$alignment_price}. Recommended with every new set of tyres. We check and adjust front and rear geometry."],
        ['q' => "What tyre brands does Tony Allen carry?", 'a' => "Maxxis, Continental, Goodyear, Hifly, Rovelo, Vitora and Wanli. Budget to premium — over 1,400 tyres available. We recommend based on how you drive, not margin."],
        ['q' => "Can I get 4WD tyres at Tony Allen?", 'a' => "Yes. All-terrain, highway terrain and mud terrain. Maxxis AT811, MT772, AT771 are our most popular. Continental CrossContact, Goodyear Wrangler and budget alternatives also available."],
        ['q' => "Does Tony Allen offer tyre finance?", 'a' => "Yes. Afterpay, Q Card and GEM Finance accepted. Apply in-store or set up on your phone before you arrive."],
        ['q' => "Can Tony Allen fit tyres I bought online?", 'a' => "Yes. Bring your tyres in and we will fit, balance and align them. Check the size and load rating match your vehicle before purchasing."],
        ['q' => "Does Tony Allen do puncture repairs?", 'a' => "Yes. Plug and patch repairs where the tyre is safely repairable. If the damage is in the sidewall or too large, we will tell you straight — we do not repair tyres that are not safe."],
        ['q' => "What are Tony Allen's opening hours?", 'a' => "{$hours}. Walk-ins welcome mornings — booking recommended for afternoons. 139 Cavendish Drive, Manukau — {$distance_text} from {$suburb_name}."],
    ];
} else {
    $faqs = [
        ['q' => "Where can I get tyres fitted near {$suburb_name}?", 'a' => "Tony Allen Auto Service at 139 Cavendish Drive, Manukau — {$distance_text} {$current_suburb['route']} from {$suburb_name}. We supply, fit and balance tyres for cars, SUVs, 4WDs and light commercial vehicles. Call {$phone_free} for an estimate."],
        ['q' => "How much do tyres cost near {$suburb_name}?", 'a' => "Tyre prices depend on size, brand and availability. We carry budget to premium brands including Maxxis, Continental, Goodyear, Hifly and more. Wheel alignment {$alignment_price}. Balancing {$balance_price}. Call with your tyre size or rego for an estimate."],
        ['q' => "Do you do wheel alignment near {$suburb_name}?", 'a' => "Yes. 3D laser wheel alignment on our dedicated alignment hoist — {$alignment_price}. Front and rear geometry checked and adjusted. We are {$distance_text} from {$suburb_name} {$current_suburb['route']}."],
        ['q' => "Can you repair a puncture near {$suburb_name}?", 'a' => "Yes. Plug and patch repairs where the tyre is safely repairable. If the puncture is in the sidewall or too close to a previous repair, we will tell you honestly — some punctures require a new tyre."],
        ['q' => "What tyre brands do you carry?", 'a' => "Maxxis, Continental, Goodyear, Hifly, Rovelo, Vitora, Wanli and more. Budget to premium — we recommend based on your vehicle and driving style, not margin."],
        ['q' => "Do you fit tyres I have bought elsewhere?", 'a' => "Yes. Bring your tyres in and we will fit, balance and align. Make sure the size and load rating match your vehicle before purchasing."],
        ['q' => "Do you do 4WD and SUV tyres?", 'a' => "Yes. All-terrain, highway terrain and mud terrain patterns. Maxxis Bravo, Continental CrossContact, Goodyear Wrangler and budget alternatives. Fitted and balanced on-site."],
        ['q' => "How often should I get a wheel alignment?", 'a' => "After fitting new tyres, after any suspension work, or if you notice uneven tyre wear or steering pull. At minimum, check alignment annually. Alignment {$alignment_price}."],
        ['q' => "Can I pay with Afterpay?", 'a' => "Yes. We accept Afterpay, Q Card and GEM Finance. Apply in-store or set up before you arrive."],
        ['q' => "What are your opening hours?", 'a' => "{$hours}. Walk-ins welcome mornings — booking recommended for afternoons. 139 Cavendish Drive, Manukau — {$distance_text} from {$suburb_name}."],
    ];
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]];
}
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tyre Centre', 'item' => $site_url . '/tyre-centre/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => ($is_branded ? 'Tony Allen Tyres ' : 'Tyres ') . $suburb_name, 'item' => $page_url],
    ]],
    ['@type' => ['AutoRepair', 'LocalBusiness'],
     'name' => 'Tony Allen Auto Service',
     'url' => $site_url,
     'telephone' => [$phone_free, $phone_local],
     'email' => $email,
     'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
     'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
     'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
     'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'],
     'foundingDate' => '1985-10-01',
     'areaServed' => $suburb_name . ', South Auckland',
     'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
     'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association New Zealand'],
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.tsl-hero h1', '.tsl-section__heading', '.tsl-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-tyre-location .site-content,
.page-template-template-tyre-location .entry-content,
.page-template-template-tyre-location .entry-header,
.page-template-template-tyre-location article,
.page-template-template-tyre-location #primary,
.page-template-template-tyre-location #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-tyre-location { overflow-x:hidden; }

.tsl-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.tsl-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.tsl-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.tsl-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 12px; }
.tsl-hero h1 span { color: var(--taas-yellow, #FFC800); }
.tsl-hero__distance { font-family: var(--taas-font, 'Inter', Arial, sans-serif); display: inline-block; background: rgba(255,200,0,0.15); color: var(--taas-yellow, #FFC800); font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 100px; margin-bottom: 16px; }
.tsl-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 620px; margin: 0 0 28px; line-height: 1.65; }
.tsl-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }

.tsl-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.tsl-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.tsl-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.tsl-trust__item::before { content: '✓'; font-weight: 900; }

.tsl-section { padding: var(--taas-sec-pad, 72px) 0; }
.tsl-section--white { background: var(--taas-white, #FFFFFF); }
.tsl-section--grey  { background: var(--taas-panel, #F7F7F5); }
.tsl-section--dark  { background: var(--taas-dark, #1A1A1A); }
.tsl-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.tsl-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.tsl-section--dark .tsl-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.tsl-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.tsl-section--dark .tsl-section__heading { color: var(--taas-white, #FFFFFF); }
.tsl-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 28px; line-height: 1.65; }
.tsl-section--dark .tsl-section__sub { color: #aaa; }

.tsl-services { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
.tsl-service { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px 18px; display: flex; flex-direction: column; gap: 6px; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s; border-top: 3px solid transparent; }
.tsl-service:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); transform: translateY(-2px); border-top-color: var(--taas-yellow, #FFC800); }
.tsl-service__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); }
.tsl-service__desc { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; flex: 1; }
.tsl-service__link { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; color: var(--taas-yellow2, #e6b400); margin-top: auto; }
.tsl-service:hover .tsl-service__link { color: var(--taas-yellow, #FFC800); }

.tsl-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; list-style: none; padding: 0; }
.tsl-pills li a { display: inline-block; padding: 7px 18px; border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; background: var(--taas-white, #FFFFFF); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); text-decoration: none; transition: all 0.15s; }
.tsl-pills li a:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 600; }
.tsl-pills li a[aria-current="page"] { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 700; pointer-events: none; }

.tsl-faq { max-width: 780px; }
.tsl-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.tsl-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.tsl-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.tsl-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.tsl-faq__item--open .tsl-faq__q::after { content: '−'; }
.tsl-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.tsl-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.tsl-faq__a a:hover { text-decoration: underline; }
.tsl-faq__item--open .tsl-faq__a { display: block; }

.tsl-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.tsl-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.tsl-enquiry__phone:hover { color: #fff; }
.tsl-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.tsl-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

.tsl-section--dark .wpcf7 label, .tsl-section--dark .wpcf7 span:not(.wpcf7-spinner), .tsl-section--dark .wpcf7 div:not(.wpcf7-response-output), .tsl-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.tsl-section--dark .wpcf7 input[type="text"], .tsl-section--dark .wpcf7 input[type="email"], .tsl-section--dark .wpcf7 input[type="tel"], .tsl-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.tsl-section--dark .wpcf7 input::placeholder, .tsl-section--dark .wpcf7 textarea::placeholder { color: #666; }
.tsl-section--dark .wpcf7 input:focus, .tsl-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.tsl-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.tsl-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

@media (max-width: 960px) {
  .tsl-services { grid-template-columns: 1fr; }
  .tsl-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 640px) {
  .tsl-hero { padding: 48px 0 40px; }
  .tsl-hero h1 { font-size: clamp(24px, 6vw, 38px); }
  .tsl-hero__sub { font-size: 14px; }
  .tsl-hero__ctas { flex-direction: column; align-items: stretch; }
  .tsl-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .tsl-section { padding: 48px 0; }
  .tsl-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .tsl-section__sub { font-size: 14px; }
  .tsl-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .tsl-trust__item { font-size: 12px; }
  .tsl-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .tsl-faq__a { font-size: 13px; }
  .tsl-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
}
</style>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO                                                                      -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-hero">
  <div class="tsl-hero__inner">
    <span class="tsl-hero__eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
    <h1><?php echo esc_html($hero_h1); ?><br><span><?php echo esc_html($hero_h1_span); ?></span></h1>
    <span class="tsl-hero__distance"><?php echo esc_html($distance_text); ?> <?php echo esc_html($current_suburb['route']); ?> · <?php echo esc_html($hours); ?></span>
    <p class="tsl-hero__sub"><?php echo esc_html($hero_sub); ?></p>
    <div class="tsl-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Get a Tyre Estimate</a>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- TRUST                                                                     -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div class="tsl-trust">
  <div class="tsl-trust__inner">
    <div class="tsl-trust__item">MTA Assured</div>
    <div class="tsl-trust__item">NZTA Authorised</div>
    <div class="tsl-trust__item">Supply, Fit & Balance</div>
    <div class="tsl-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="tsl-trust__item"><?php echo esc_html($trust_extra); ?></div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- WHAT TO EXPECT                                                            -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--white">
  <div class="tsl-section__inner">
    <span class="tsl-section__eyebrow">What to Expect</span>
    <h2 class="tsl-section__heading"><?php echo esc_html($expect_heading); ?></h2>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;max-width:720px;"><?php if ($is_branded) : echo esc_html($expect_p1); else : ?><?php echo esc_html(str_replace('139 Cavendish Drive, Manukau', '', $expect_p1)); ?><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.<?php endif; ?></p>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;max-width:720px;"><?php echo esc_html($expect_p2); ?></p>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;max-width:720px;"><?php echo esc_html($expect_p3); ?></p>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- SERVICES                                                                  -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--grey">
  <div class="tsl-section__inner">
    <span class="tsl-section__eyebrow">Services</span>
    <h2 class="tsl-section__heading">Tyre Services Available</h2>
    <p class="tsl-section__sub">All services at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a> — <?php echo esc_html($distance_text); ?> from <?php echo esc_html($suburb_name); ?>.</p>
    <div class="tsl-services">
      <a href="<?php echo esc_url($site_url . '/tyre-fitting-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">Tyre Fitting</div>
        <p class="tsl-service__desc">New tyres supplied, fitted and balanced. All sizes — cars, SUVs, 4WDs, light commercial.</p>
        <span class="tsl-service__link">Tyre Fitting →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wheel-alignment-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">Wheel Alignment</div>
        <p class="tsl-service__desc">3D laser alignment — <?php echo esc_html($alignment_price); ?>. Prevents uneven wear.</p>
        <span class="tsl-service__link">Wheel Alignment →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wheel-balancing-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">Wheel Balancing</div>
        <p class="tsl-service__desc">ER85 balancer — <?php echo esc_html($balance_price); ?>. Included with new tyre fitting.</p>
        <span class="tsl-service__link">Wheel Balancing →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-rotation-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">Tyre Rotation</div>
        <p class="tsl-service__desc">Even out wear across all four tyres. Every 8,000–10,000 km.</p>
        <span class="tsl-service__link">Tyre Rotation →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-centre/puncture-repair-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">Puncture Repair</div>
        <p class="tsl-service__desc">Plug and patch repairs. Honest assessment if the tyre needs replacing.</p>
        <span class="tsl-service__link">Puncture Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tpms-reset-manukau/'); ?>" class="tsl-service">
        <div class="tsl-service__title">TPMS Reset</div>
        <p class="tsl-service__desc">Tyre pressure warning light — reset and sensor diagnosis. <?php echo esc_html($tpms_price); ?>.</p>
        <span class="tsl-service__link">TPMS Reset →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>" class="tsl-service" style="border-top-color:var(--taas-yellow,#FFC800);">
        <div class="tsl-service__title">Search Our Tyre Stock</div>
        <p class="tsl-service__desc">Enter your tyre size to see what we have available — budget to premium.</p>
        <span class="tsl-service__link">Tyre Finder →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="tsl-service">
        <div class="tsl-service__title">All Tyre Services</div>
        <p class="tsl-service__desc">See the full range — brands, finder, 4WD, budget and run-flat tyres.</p>
        <span class="tsl-service__link">Tyre Centre Hub →</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--white">
  <div class="tsl-section__inner">
    <span class="tsl-section__eyebrow">Pricing</span>
    <h2 class="tsl-section__heading">Tyre Pricing for <?php echo esc_html($suburb_name); ?> Customers</h2>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:20px;max-width:720px;">Tyre prices depend on size, brand and availability. Call us with your tyre size or vehicle rego and we will give you an estimate. The following services are priced separately.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
      <div style="background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;text-align:center;">
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:6px;">Wheel Alignment</div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:20px;font-weight:800;color:var(--taas-black,#111);"><?php echo esc_html($alignment_price); ?></div>
      </div>
      <div style="background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;text-align:center;">
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:6px;">Wheel Balancing</div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:20px;font-weight:800;color:var(--taas-black,#111);"><?php echo esc_html($balance_price); ?></div>
      </div>
      <div style="background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;text-align:center;">
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--taas-mid,#666);margin-bottom:6px;">TPMS Reset</div>
        <div style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:20px;font-weight:800;color:var(--taas-black,#111);"><?php echo esc_html($tpms_price); ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--dark" id="enquire">
  <div class="tsl-section__inner">
    <div class="tsl-enquiry">
      <div>
        <span class="tsl-section__eyebrow">Book or Enquire</span>
        <h2 class="tsl-section__heading">Get a Tyre Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your tyre size or vehicle rego — we will come back with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tsl-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="tsl-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html($phone_local); ?><br><?php echo esc_html($distance_text); ?> from <?php echo esc_html($suburb_name); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- SUBURBS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--grey">
  <div class="tsl-section__inner">
    <span class="tsl-section__eyebrow">South Auckland</span>
    <h2 class="tsl-section__heading"><?php echo $is_branded ? 'Tony Allen Tyres — All Locations' : 'Tyre Shop Near You'; ?></h2>
    <p class="tsl-section__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="tsl-pills">
      <?php foreach ($suburbs as $slug => $data) :
          $is_current = ($slug === $suburb_slug);
          $pill_url   = $is_branded
              ? $site_url . '/tony-allen-tyres-' . $slug . '/'
              : $site_url . '/tyres/' . $slug . '/';
          $pill_label = $is_branded
              ? 'Tony Allen Tyres ' . $data['name']
              : 'Tyres ' . $data['name'];
      ?>
      <li><a href="<?php echo esc_url($pill_url); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>><?php echo esc_html($pill_label); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- FAQ                                                                       -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--white">
  <div class="tsl-section__inner">
    <div class="tsl-faq">
      <span class="tsl-section__eyebrow">FAQ</span>
      <h2 class="tsl-section__heading"><?php echo $is_branded ? 'Tony Allen Tyres ' . esc_html($suburb_name) . ' — Questions' : 'Tyres ' . esc_html($suburb_name) . ' — Common Questions'; ?></h2>
      <div class="tsl-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="tsl-faq__item">
          <button class="tsl-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="tsl-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- REVIEWS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tsl-section tsl-section--grey">
  <div class="tsl-section__inner">
    <span class="tsl-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="tsl-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<script>
document.querySelectorAll('.tsl-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.tsl-faq__item');
    var wasOpen = item.classList.contains('tsl-faq__item--open');
    document.querySelectorAll('.tsl-faq__item--open').forEach(function(i){ i.classList.remove('tsl-faq__item--open'); });
    if (!wasOpen) item.classList.add('tsl-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
