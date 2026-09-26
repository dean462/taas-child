<?php
/**
 * Template Name: Tyre Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Serves 7 tyre sub-service pages via master array:
 *   - Tyre Fitting (/tyre-fitting-manukau/)
 *   - Tyre Rotation (/tyre-rotation-manukau/)
 *   - 4WD Tyres (/4wd-tyres-manukau/)
 *   - Budget Tyres (/budget-tyres-manukau/)
 *   - Run-Flat Tyres (/run-flat-tyres-manukau/)
 *   - Puncture Repair (/tyre-centre/puncture-repair-manukau/)
 *   - TPMS Reset (/tpms-reset-manukau/)
 *
 * Content pulled from post_meta (set via runner).
 * Cross-links auto-generated from master services array.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url        = get_site_url();
$page_url        = get_permalink();
$post_id         = get_the_ID();
$page_slug       = get_post_field('post_name', $post_id);
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
$puncture_price  = defined('TAAS_PUNCTURE_PRICE')  ? TAAS_PUNCTURE_PRICE  : null;
$reviews_widget  = defined('TAAS_REVIEWS_WIDGET')  ? TAAS_REVIEWS_WIDGET  : '';
$cf7_general     = defined('TAAS_CF7_GENERAL')     ? TAAS_CF7_GENERAL     : '';
$phone_free_tel  = preg_replace('/[^0-9+]/', '', $phone_free);
$years           = date('Y') - intval($established);
$maps_url        = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

// ── Content replacement — swap hardcoded values for constants ─────────────
function tss_replace_constants($text) {
    global $phone_free, $phone_local, $alignment_price, $balance_price, $tpms_price, $hours;
    $replacements = [
        'call us on 09 278 9556' => 'call us on ' . $phone_free,
        'Call us on 09 278 9556' => 'Call us on ' . $phone_free,
        'call on 09 278 9556'    => 'call on ' . $phone_free,
    ];
    return str_replace(array_keys($replacements), array_values($replacements), $text);
}

// ── Master services array ────────────────────────────────────────────────────
$tyre_master = [
    'tyre-fitting-manukau' => [
        'name'       => 'Tyre Fitting',
        'badge'      => 'TF',
        'short'      => 'New tyres fitted, balanced and aligned. All makes and sizes.',
        'hero_price' => 'Contact for tyre pricing — fitting, balancing and alignment included',
        'price'      => 'Tyre prices depend on size, brand and availability. Wheel alignment ' . $alignment_price . '. Balancing ' . $balance_price . ' (included with new tyre fitting).',
        'urgency'    => 'medium',
        'url'        => '/tyre-fitting-manukau/',
    ],
    'tyre-rotation-manukau' => [
        'name'       => 'Tyre Rotation',
        'badge'      => 'TR',
        'short'      => 'Even out wear across all four tyres. Extend tyre life.',
        'hero_price' => 'Contact for pricing — often done at the same time as a service',
        'price'      => 'Contact us for tyre rotation pricing. Often combined with a vehicle service for efficiency.',
        'urgency'    => 'low',
        'url'        => '/tyre-rotation-manukau/',
    ],
    '4wd-tyres-manukau' => [
        'name'       => '4WD & SUV Tyres',
        'badge'      => '4WD',
        'short'      => 'All-terrain, highway terrain and mud terrain. Fitted and balanced.',
        'hero_price' => 'Contact for 4WD tyre pricing — depends on size and pattern',
        'price'      => '4WD tyre prices vary by size, brand and tread pattern. We carry Maxxis Bravo, Continental CrossContact, Goodyear Wrangler and budget alternatives. Call with your tyre size for an estimate.',
        'urgency'    => 'medium',
        'url'        => '/4wd-tyres-manukau/',
    ],
    'budget-tyres-manukau' => [
        'name'       => 'Budget Tyres',
        'badge'      => 'BT',
        'short'      => 'Quality budget options. Same fitting standard as premium.',
        'hero_price' => 'Contact for pricing — budget options for most sizes',
        'price'      => 'Budget tyre prices depend on size and availability. We carry Hifly, Rovelo, Vitora and other quality budget brands. Fitted, balanced and aligned to the same standard as premium tyres.',
        'urgency'    => 'low',
        'url'        => '/budget-tyres-manukau/',
    ],
    'run-flat-tyres-manukau' => [
        'name'       => 'Run-Flat Tyres',
        'badge'      => 'RF',
        'short'      => 'Supply and fit run-flat tyres for BMW, Mercedes-Benz, MINI.',
        'hero_price' => 'Contact for run-flat tyre pricing — vehicle-specific sizing',
        'price'      => 'Run-flat tyre prices depend on the vehicle and size. Common on BMW, Mercedes-Benz, MINI and some Audi vehicles. We source and fit the correct specification for your vehicle.',
        'urgency'    => 'medium',
        'url'        => '/run-flat-tyres-manukau/',
    ],
    'puncture-repair-manukau' => [
        'name'       => 'Puncture Repair',
        'badge'      => 'PR',
        'short'      => 'Plug and patch where repairable. Honest assessment if not.',
        'hero_price' => $puncture_price ? ('Puncture repair ' . $puncture_price) : 'Contact for puncture repair pricing',
        'price'      => $puncture_price ? ('Puncture repair ' . $puncture_price . '. Not all punctures are repairable — sidewall damage, repairs too close to the edge, or previous repairs in the same area mean the tyre needs replacing. We assess honestly.') : 'Contact us for puncture repair pricing. Not all punctures are repairable — sidewall damage, repairs too close to the edge, or previous repairs in the same area mean the tyre needs replacing. We assess honestly.',
        'urgency'    => 'high',
        'url'        => '/tyre-centre/puncture-repair-manukau/',
    ],
    'tpms-reset-manukau' => [
        'name'       => 'TPMS Reset',
        'badge'      => 'TPMS',
        'short'      => 'Tyre pressure monitoring reset and sensor diagnosis.',
        'hero_price' => 'TPMS reset ' . $tpms_price . ' — sensor replacement additional',
        'price'      => 'TPMS reset ' . $tpms_price . '. Sensor replacement additional — sensor prices vary by vehicle. Call with your vehicle details for an estimate.',
        'urgency'    => 'low',
        'url'        => '/tpms-reset-manukau/',
    ],
];

// ── Current page data ────────────────────────────────────────────────────────
$current = isset($tyre_master[$page_slug]) ? $tyre_master[$page_slug] : null;
if (!$current) { $current = ['name' => get_the_title(), 'badge' => 'TC', 'short' => '', 'hero_price' => '', 'price' => '', 'urgency' => 'medium', 'url' => '/' . $page_slug . '/']; }

$service_name  = $current['name'];
$badge         = $current['badge'];
$default_price = isset($current['price']) ? $current['price'] : '';
$hero_price    = isset($current['hero_price']) ? $current['hero_price'] : $default_price;
$urgency_level = $current['urgency'];

// ── Post meta fields (set via runner) ────────────────────────────────────────
$what_it_is    = tss_replace_constants(get_post_meta($post_id, 'what_it_is', true) ?: '');
$causes_raw    = tss_replace_constants(get_post_meta($post_id, 'causes', true) ?: '');
$symptoms_raw  = tss_replace_constants(get_post_meta($post_id, 'symptoms', true) ?: '');
$process_raw   = tss_replace_constants(get_post_meta($post_id, 'our_process', true) ?: '');
$urgency_msg   = tss_replace_constants(get_post_meta($post_id, 'urgency_message', true) ?: '');
$price_signal  = tss_replace_constants(get_post_meta($post_id, 'price_signal', true) ?: '') ?: $default_price;
$vehicles_note = tss_replace_constants(get_post_meta($post_id, 'vehicles_note', true) ?: '');

$causes   = $causes_raw  ? array_filter(array_map('trim', explode('|', $causes_raw)))  : [];
$symptoms = $symptoms_raw ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw  ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

// Custom FAQs (up to 3)
$custom_faqs = [];
for ($i = 1; $i <= 3; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => tss_replace_constants($q), 'a' => tss_replace_constants($a)];
}

// ── Build FAQs (minimum 10) ─────────────────────────────────────────────────
$faqs = [];
$faqs[] = ['q' => "What is {$service_name}?", 'a' => $what_it_is ?: "Contact Tony Allen Auto Service on {$phone_free} for information about {$service_name}."];
if ($causes_raw) {
    $faqs[] = ['q' => "Why would I need {$service_name}?", 'a' => implode('. ', $causes) . '.'];
}
if ($symptoms_raw) {
    $faqs[] = ['q' => "How do I know I need {$service_name}?", 'a' => 'Signs to look for: ' . strtolower(implode('; ', $symptoms)) . '.'];
}
$faqs[] = ['q' => "How much does {$service_name} cost?", 'a' => $price_signal . '. All pricing explained upfront — no surprises.'];
if ($process_raw) {
    $faqs[] = ['q' => "What is your process for {$service_name}?", 'a' => implode('. ', $process) . '.'];
}
$faqs[] = ['q' => "Do I need a wheel alignment after new tyres?", 'a' => "We recommend a wheel alignment after fitting new tyres — it ensures even wear and extends tyre life. Alignment {$alignment_price}. Without it, new tyres can develop uneven wear within months."];
$faqs[] = ['q' => "Do you do 4WD and SUV tyres?", 'a' => "Yes. We carry all-terrain, highway terrain and mud terrain patterns. Brands include Maxxis, Continental, Goodyear and budget alternatives. Fitted, balanced and aligned on-site."];
$faqs[] = ['q' => "Can I pay with finance?", 'a' => "Yes. We accept Afterpay, Q Card and GEM Finance. Apply in-store or set up your account before you arrive."];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q' => "Do you fit tyres I have bought elsewhere?", 'a' => "Yes. Bring your tyres in and we will fit, balance and align. Check the size and load rating match your vehicle before purchasing — call {$phone_free} if unsure."];
$faqs[] = ['q' => "Where is your tyre shop?", 'a' => "139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}. Call {$phone_free} to book or drop in."];

// Pad to minimum 10 if needed
if (count($faqs) < 10) {
    $padding_faqs = [
        ['q' => "How long does tyre fitting take?", 'a' => "Tyre fitting for a standard set of four takes around 45 minutes to an hour, including balancing. Alignment is an additional 30 to 45 minutes if required."],
        ['q' => "How often should I check my tyre pressure?", 'a' => "At least once a month and before any long journey. Correct pressure improves fuel economy, tyre life and handling. Check with the tyres cold — the recommended pressures are on a sticker inside the driver's door or in your vehicle handbook."],
        ['q' => "What is the legal minimum tread depth in New Zealand?", 'a' => "1.5mm across the full width of the tyre that contacts the road. Below this depth the tyre will fail a WOF inspection and your stopping distances increase significantly, especially in wet conditions."],
    ];
    foreach ($padding_faqs as $pf) {
        if (count($faqs) >= 10) break;
        $faqs[] = $pf;
    }
}

// ── Badge helper ─────────────────────────────────────────────────────────────
function tss_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2 + 1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Urgency colours ──────────────────────────────────────────────────────────
$urgency_colors = [
    'high'   => ['bg' => '#C0392B', 'border' => '#A93226', 'text' => '#fff', 'label' => 'Urgent'],
    'medium' => ['bg' => '#fffbea', 'border' => '#FFC800', 'text' => '#1A1A1A', 'label' => 'Book Soon'],
    'low'    => ['bg' => '#F7F7F5', 'border' => '#E8E8E4', 'text' => '#333', 'label' => 'When Convenient'],
];
$uc = isset($urgency_colors[$urgency_level]) ? $urgency_colors[$urgency_level] : $urgency_colors['medium'];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']]];
}
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tyre Centre', 'item' => $site_url . '/tyre-centre/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $service_name, 'item' => $page_url],
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
     'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
     'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association New Zealand'],
    ],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.tss-hero h1', '.tss-section__heading', '.tss-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-tyre-sub-service .site-content,
.page-template-template-tyre-sub-service .entry-content,
.page-template-template-tyre-sub-service .entry-header,
.page-template-template-tyre-sub-service article,
.page-template-template-tyre-sub-service #primary,
.page-template-template-tyre-sub-service #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-tyre-sub-service { overflow-x:hidden; }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.tss-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.tss-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.tss-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.tss-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 12px; }
.tss-hero h1 span { color: var(--taas-yellow, #FFC800); }
.tss-hero__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 600; color: var(--taas-yellow, #FFC800); margin: 0 0 12px; }
.tss-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 600px; margin: 0 0 28px; line-height: 1.65; }
.tss-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }

/* ── Trust ──────────────────────────────────────────────────────────────────── */
.tss-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.tss-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.tss-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.tss-trust__item::before { content: '✓'; font-weight: 900; }

/* ── Sections ──────────────────────────────────────────────────────────────── */
.tss-section { padding: var(--taas-sec-pad, 72px) 0; }
.tss-section--white { background: var(--taas-white, #FFFFFF); }
.tss-section--grey  { background: var(--taas-panel, #F7F7F5); }
.tss-section--dark  { background: var(--taas-dark, #1A1A1A); }
.tss-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.tss-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.tss-section--dark .tss-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.tss-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.tss-section--dark .tss-section__heading { color: var(--taas-white, #FFFFFF); }
.tss-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 28px; line-height: 1.65; }
.tss-section--dark .tss-section__sub { color: #aaa; }

/* ── Content cards ─────────────────────────────────────────────────────────── */
.tss-causes { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.tss-cause { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px; }
.tss-cause__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 6px; }
.tss-cause__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; }

.tss-process { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; counter-reset: step; }
.tss-step { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px; position: relative; counter-increment: step; }
.tss-step::before { content: counter(step); position: absolute; top: 16px; right: 16px; width: 28px; height: 28px; background: var(--taas-yellow, #FFC800); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; font-weight: 800; color: var(--taas-dark, #1A1A1A); }
.tss-step__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 6px; padding-right: 40px; }
.tss-step__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; }

/* ── Urgency banner ────────────────────────────────────────────────────────── */
.tss-urgency { padding: 16px 24px; border-radius: var(--taas-radius, 6px); margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
.tss-urgency__label { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase; white-space: nowrap; margin-top: 2px; }
.tss-urgency__text { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; line-height: 1.5; }

/* ── Cross-links ───────────────────────────────────────────────────────────── */
.tss-related { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
.tss-related-card { background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px 18px; display: flex; flex-direction: column; gap: 6px; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s; border-top: 3px solid transparent; }
.tss-related-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); transform: translateY(-2px); border-top-color: var(--taas-yellow, #FFC800); }
.tss-related-card__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); }
.tss-related-card__desc { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; flex: 1; }
.tss-related-card__link { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; color: var(--taas-yellow2, #e6b400); margin-top: auto; }
.tss-related-card:hover .tss-related-card__link { color: var(--taas-yellow, #FFC800); }

/* ── Pricing callout ───────────────────────────────────────────────────────── */
.tss-callout { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; }
.tss-callout__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.tss-callout__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); line-height: 1.65; }

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.tss-faq { max-width: 780px; }
.tss-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.tss-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.tss-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.tss-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.tss-faq__item--open .tss-faq__q::after { content: '−'; }
.tss-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.tss-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.tss-faq__a a:hover { text-decoration: underline; }
.tss-faq__item--open .tss-faq__a { display: block; }

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.tss-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.tss-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.tss-enquiry__phone:hover { color: #fff; }
.tss-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.tss-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

/* ── CF7 on dark ───────────────────────────────────────────────────────────── */
.tss-section--dark .wpcf7 label, .tss-section--dark .wpcf7 span:not(.wpcf7-spinner), .tss-section--dark .wpcf7 div:not(.wpcf7-response-output), .tss-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.tss-section--dark .wpcf7 input[type="text"], .tss-section--dark .wpcf7 input[type="email"], .tss-section--dark .wpcf7 input[type="tel"], .tss-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.tss-section--dark .wpcf7 input::placeholder, .tss-section--dark .wpcf7 textarea::placeholder { color: #666; }
.tss-section--dark .wpcf7 input:focus, .tss-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.tss-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.tss-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media (max-width: 960px) {
  .tss-causes { grid-template-columns: 1fr; }
  .tss-related { grid-template-columns: 1fr; }
  .tss-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 640px) {
  .tss-hero { padding: 48px 0 40px; }
  .tss-hero h1 { font-size: clamp(24px, 6vw, 38px); }
  .tss-hero__sub { font-size: 14px; }
  .tss-hero__ctas { flex-direction: column; align-items: stretch; }
  .tss-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .tss-section { padding: 48px 0; }
  .tss-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .tss-section__sub { font-size: 14px; }
  .tss-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .tss-trust__item { font-size: 12px; }
  .tss-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .tss-faq__a { font-size: 13px; }
  .tss-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .tss-callout { padding: 20px 22px; }
  .tss-process { grid-template-columns: 1fr; }
}
</style>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO                                                                      -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-hero">
  <div class="tss-hero__inner">
    <span class="tss-hero__eyebrow">Tyre Centre — Manukau</span>
    <h1><?php echo esc_html($service_name); ?><br><span>Manukau — South Auckland</span></h1>
    <?php if ($hero_price) : ?><p class="tss-hero__price"><?php echo esc_html($hero_price); ?></p><?php endif; ?>
    <p class="tss-hero__sub"><?php echo esc_html($current['short']); ?> Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>. MTA Assured workshop — <?php echo $years; ?> years of experience.</p>
    <div class="tss-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Get an Estimate</a>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- TRUST                                                                     -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div class="tss-trust">
  <div class="tss-trust__inner">
    <div class="tss-trust__item">MTA Assured</div>
    <div class="tss-trust__item">NZTA Authorised</div>
    <div class="tss-trust__item">Estimate Before We Start</div>
    <div class="tss-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="tss-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- WHAT IT IS                                                                -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<?php if ($what_it_is) : ?>
<section class="tss-section tss-section--white">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow">What Is It</span>
    <h2 class="tss-section__heading"><?php echo esc_html($service_name); ?></h2>
    <?php if ($urgency_msg) : ?>
    <div class="tss-urgency" style="background:<?php echo $uc['bg']; ?>;border:1px solid <?php echo $uc['border']; ?>;color:<?php echo $uc['text']; ?>;">
      <span class="tss-urgency__label" style="color:<?php echo $uc['text']; ?>;"><?php echo esc_html($uc['label']); ?></span>
      <span class="tss-urgency__text"><?php echo wp_kses_post($urgency_msg); ?></span>
    </div>
    <?php endif; ?>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;max-width:720px;"><?php echo wp_kses_post($what_it_is); ?></p>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- CAUSES / REASONS                                                          -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<?php if (!empty($causes)) : ?>
<section class="tss-section tss-section--grey">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow">Why You Might Need This</span>
    <h2 class="tss-section__heading">Common Reasons for <?php echo esc_html($service_name); ?></h2>
    <div class="tss-causes">
      <?php foreach ($causes as $cause) :
        $parts = explode(':', $cause, 2);
        $title = trim($parts[0]);
        $body  = isset($parts[1]) ? trim($parts[1]) : '';
      ?>
      <div class="tss-cause">
        <div class="tss-cause__title"><?php echo wp_kses_post($title); ?></div>
        <?php if ($body) : ?><p class="tss-cause__body"><?php echo wp_kses_post($body); ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PROCESS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<?php if (!empty($process)) : ?>
<section class="tss-section tss-section--white">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow">Our Process</span>
    <h2 class="tss-section__heading">How We Handle <?php echo esc_html($service_name); ?></h2>
    <div class="tss-process">
      <?php foreach ($process as $step) :
        $parts = explode(':', $step, 2);
        $title = trim($parts[0]);
        $body  = isset($parts[1]) ? trim($parts[1]) : '';
      ?>
      <div class="tss-step">
        <div class="tss-step__title"><?php echo wp_kses_post($title); ?></div>
        <?php if ($body) : ?><p class="tss-step__body"><?php echo wp_kses_post($body); ?></p><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-section tss-section--grey">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow">Pricing</span>
    <h2 class="tss-section__heading"><?php echo esc_html($service_name); ?> — Pricing</h2>
    <div class="tss-callout">
      <div class="tss-callout__title"><?php echo esc_html($service_name); ?></div>
      <p class="tss-callout__body"><?php echo wp_kses_post($price_signal); ?> Finance available via Afterpay, Q Card and GEM Finance.</p>
    </div>
    <?php if ($vehicles_note) : ?>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-mid,#666);line-height:1.6;margin-top:16px;"><?php echo wp_kses_post($vehicles_note); ?></p>
    <?php endif; ?>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-section tss-section--dark" id="enquire">
  <div class="tss-section__inner">
    <div class="tss-enquiry">
      <div>
        <span class="tss-section__eyebrow">Book or Enquire</span>
        <h2 class="tss-section__heading">Get an Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle and what you need — we will come back with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tss-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="tss-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html($phone_local); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- RELATED SERVICES                                                          -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-section tss-section--white">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow">Also at TAAS</span>
    <h2 class="tss-section__heading">Other Tyre Services</h2>
    <div class="tss-related">
      <?php
      $count = 0;
      foreach ($tyre_master as $slug => $svc) {
          if ($slug === $page_slug || $count >= 6) continue;
          echo '<a href="' . esc_url($site_url . $svc['url']) . '" class="tss-related-card">';
          echo '<div style="display:flex;align-items:center;gap:10px;">' . tss_badge($svc['badge'], 32) . '<div class="tss-related-card__title">' . esc_html($svc['name']) . '</div></div>';
          echo '<p class="tss-related-card__desc">' . esc_html($svc['short']) . '</p>';
          echo '<span class="tss-related-card__link">' . esc_html($svc['name']) . ' →</span>';
          echo '</a>';
          $count++;
      }
      ?>
      <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="tss-related-card" style="border-top-color:var(--taas-yellow,#FFC800);">
        <div class="tss-related-card__title">← Back to Tyre Centre</div>
        <p class="tss-related-card__desc">See all tyre services, pricing, brands and location pages.</p>
        <span class="tss-related-card__link">Tyre Centre Hub →</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- REVIEWS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-section tss-section--grey">
  <div class="tss-section__inner">
    <span class="tss-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="tss-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- FAQ                                                                       -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tss-section tss-section--white">
  <div class="tss-section__inner">
    <div class="tss-faq">
      <span class="tss-section__eyebrow">FAQ</span>
      <h2 class="tss-section__heading">Common Questions — <?php echo esc_html($service_name); ?></h2>
      <div class="tss-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="tss-faq__item">
          <button class="tss-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="tss-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.tss-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.tss-faq__item');
    var wasOpen = item.classList.contains('tss-faq__item--open');
    document.querySelectorAll('.tss-faq__item--open').forEach(function(i){ i.classList.remove('tss-faq__item--open'); });
    if (!wasOpen) item.classList.add('tss-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
