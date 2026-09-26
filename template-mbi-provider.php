<?php
/**
 * Template Name: MBI Provider Spoke
 * Template Post Type: page
 *
 * ACF fields:
 *   provider_name     — e.g. "Autosure"
 *   provider_tagline  — short subheading for hero
 *   provider_desc_1   — body paragraph 1
 *   provider_desc_2   — body paragraph 2 (optional)
 *   provider_logo     — image (ACF image field, returns ID) — optional
 *   provider_website  — external URL (optional)
 *
 * Post meta (set via runner):
 *   claims_phone, cover_summary, excess_info, ev_cover, roadside, max_vehicle, mbi_provider_id
 *
 * Tony Allen Auto Service — taas.co.nz
 * Go-Live Standard: 21 June 2026
 */

// ── Load shared files ────────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

// ── Enqueue ──────────────────────────────────────────────────────────────────
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants → local vars ───────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$euro_brands    = defined('TAAS_EURO_BRANDS')    ? TAAS_EURO_BRANDS    : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';

$site_url       = get_site_url();
$page_url       = get_permalink();
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Hero image (shared with hub) ─────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_MBI') && TAAS_HERO_MBI
    ? esc_url(get_site_url() . TAAS_HERO_MBI)
    : esc_url(get_site_url() . '/wp-content/uploads/2026/06/hero-mbi.webp');

// ── ACF fields ───────────────────────────────────────────────────────────────
$post_id          = get_the_ID();
$provider_name    = (get_field('provider_name', $post_id) ?: get_post_meta($post_id, 'provider_name', true)) ?: 'MBI Provider';
$provider_tagline = (get_field('provider_tagline', $post_id) ?: get_post_meta($post_id, 'provider_tagline', true)) ?: "Approved {$provider_name} repairer in Manukau. We liaise with your insurer and manage the claim process.";
$desc_1           = (get_field('provider_desc_1', $post_id) ?: get_post_meta($post_id, 'provider_desc_1', true)) ?: "Tony Allen Auto Service is an approved repairer for {$provider_name} mechanical breakdown insurance. If your vehicle breaks down and you hold a {$provider_name} policy, bring it to 139 Cavendish Drive, Manukau. We contact {$provider_name}, arrange authorisation, complete the repair, and invoice them directly.";
$desc_2           = (get_field('provider_desc_2', $post_id) ?: get_post_meta($post_id, 'provider_desc_2', true)) ?: "We manage the claim process from diagnosis through to completion. Any costs not covered by your policy will be discussed with you before work begins.";
$provider_website = (get_field('provider_website', $post_id) ?: get_post_meta($post_id, 'provider_website', true)) ?: '';
$provider_logo    = false;

// Provider-specific detail fields
$claims_phone   = get_post_meta($post_id, 'claims_phone', true) ?: '';
$cover_summary  = get_post_meta($post_id, 'cover_summary', true) ?: '';
$excess_info    = get_post_meta($post_id, 'excess_info', true) ?: '';
$ev_cover       = get_post_meta($post_id, 'ev_cover', true) ?: '';
$roadside       = get_post_meta($post_id, 'roadside', true) ?: '';
$max_vehicle    = get_post_meta($post_id, 'max_vehicle', true) ?: '';
$mbi_provider_id = get_post_meta($post_id, 'mbi_provider_id', true) ?: '';

// ── Provider → FAQ key mapping ───────────────────────────────────────────────
$faq_prefix_map = [
    'autosure'  => 'mbi_autosure',
    'assurant'  => 'mbi_assurant',
    'provident' => 'mbi_provident',
    'janssen'   => 'mbi_janssen',
    'autolife'  => 'mbi_autolife',
];

// Determine provider ID from ACF field or provider name
$pid = $mbi_provider_id;
if (!$pid) {
    $name_lower = strtolower(trim($provider_name));
    if (strpos($name_lower, 'autosure') !== false) { $pid = 'autosure'; }
    elseif (strpos($name_lower, 'assurant') !== false || strpos($name_lower, 'protecta') !== false) { $pid = 'assurant'; }
    elseif (strpos($name_lower, 'provident') !== false) { $pid = 'provident'; }
    elseif (strpos($name_lower, 'janssen') !== false) { $pid = 'janssen'; }
    elseif (strpos($name_lower, 'autolife') !== false) { $pid = 'autolife'; }
}

$faq_prefix = isset($faq_prefix_map[$pid]) ? $faq_prefix_map[$pid] : '';

// ── Other MBI providers (for cross-links) ────────────────────────────────────
$all_providers = [
    'autosure'  => ['name' => 'Autosure',            'slug' => 'autosure-warranty-repairs-manukau'],
    'assurant'  => ['name' => 'Assurant',             'slug' => 'assurant-warranty-repairs-manukau'],
    'provident' => ['name' => 'Provident Insurance',  'slug' => 'provident-warranty-repairs-manukau'],
    'janssen'   => ['name' => 'Janssen Insurance',    'slug' => 'janssen-warranty-repairs-manukau'],
    'autolife'  => ['name' => 'Autolife',             'slug' => 'autolife-warranty-repairs-manukau'],
];

// ── Covered / not covered ────────────────────────────────────────────────────
$covered = ['Engine and internal components', 'Automatic and manual transmission', 'Electrical systems and alternator', 'Steering and suspension components', 'Fuel system components', 'Air conditioning system', 'Clutch and differential', 'Cooling system', 'Roadside assistance (policy dependent)'];
$not_covered = ['Routine maintenance (oil, filters, belts)', 'Tyres, brake pads, wiper blades', 'Normal wear-and-tear items', 'Pre-existing faults at time of policy', 'Accident or collision damage', 'Modifications from factory specification'];

// ── Process steps ────────────────────────────────────────────────────────────
$steps = [
    ['num' => '01', 'title' => 'Call us first', 'text' => "Call {$phone_free} before authorising any repairs. Authorisation from {$provider_name} must be obtained before work begins — without it, the claim may not be valid."],
    ['num' => '02', 'title' => 'Diagnosis', 'text' => "We inspect the vehicle and confirm the fault. Our lead diagnostician Raj verifies the issue before any parts are ordered or replaced."],
    ['num' => '03', 'title' => 'Authorisation', 'text' => "We contact {$provider_name} directly. We provide the diagnosis, estimate, and any supporting information required. Authorisation is typically arranged within one business day."],
    ['num' => '04', 'title' => 'Repair & invoice', 'text' => "Once authorised, we carry out the repair and invoice {$provider_name} for all covered amounts. Your excess and any items outside your coverage are confirmed with you before work is completed."],
];

// ── FAQs from shared library ─────────────────────────────────────────────────
$faqs = [];

// Provider-specific FAQs from library
if ($faq_prefix) {
    $provider_faq_keys = [
        $faq_prefix . '_approved',
        $faq_prefix . '_breakdown',
        $faq_prefix . '_claims_phone',
        $faq_prefix . '_cover',
        $faq_prefix . '_servicing',
        $faq_prefix . '_other_providers',
    ];

    // Add the 7th key (varies by provider)
    $seventh_key_map = [
        'mbi_autosure'  => 'mbi_autosure_roadside',
        'mbi_assurant'  => 'mbi_assurant_protecta',
        'mbi_provident' => 'mbi_provident_ev',
        'mbi_janssen'   => 'mbi_janssen_ev',
        'mbi_autolife'  => 'mbi_autolife_claims_speed',
    ];
    if (isset($seventh_key_map[$faq_prefix])) {
        $provider_faq_keys[] = $seventh_key_map[$faq_prefix];
    }

    foreach ($provider_faq_keys as $key) {
        if (isset($taas_faqs[$key])) {
            $faqs[] = $taas_faqs[$key];
        }
    }
}

// Add generic MBI FAQs to reach 10+
$generic_mbi_keys = ['mbi_what_is', 'mbi_exclusions', 'mbi_vs_warranty', 'mbi_service_at_taas'];
foreach ($generic_mbi_keys as $key) {
    if (isset($taas_faqs[$key]) && count($faqs) < 12) {
        $faqs[] = $taas_faqs[$key];
    }
}

// Fallback if library not loaded
if (empty($faqs)) {
    $faqs = [
        ['q' => "Is Tony Allen Auto Service an approved {$provider_name} repairer?", 'a' => "Yes. Tony Allen Auto Service is an approved repairer for {$provider_name} MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, {$provider_name} pays the balance directly to us. We are at 139 Cavendish Drive, Manukau."],
        ['q' => "What do I do if my car breaks down and I have {$provider_name}?", 'a' => "Call {$phone_free} before authorising any repairs. {$provider_name} must authorise the work before it begins. Bring your vehicle to 139 Cavendish Drive, Manukau."],
        ['q' => 'What is Mechanical Breakdown Insurance?', 'a' => 'MBI covers the cost of repairing or replacing mechanical and electrical components that fail due to sudden or unforeseen breakdown. It fills the gap left by standard car insurance.'],
        ['q' => "Does regular servicing at TAAS keep my {$provider_name} policy valid?", 'a' => "Yes. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements of {$provider_name} and all other MBI providers we work with. Keep all service invoices."],
        ['q' => 'What is not covered by MBI?', 'a' => 'Common exclusions include routine maintenance, wear and tear, pre-existing faults, accident damage, modifications from factory specification, and failures from neglect or improper maintenance.'],
        ['q' => 'Is MBI the same as a warranty?', 'a' => 'MBI is technically an insurance product, not a warranty — regulated differently with rights under the Insurance Law Reform Act and Consumer Guarantees Act.'],
        ['q' => "What other MBI providers does TAAS work with?", 'a' => "Alongside {$provider_name}, we are an approved repairer for Autosure, Assurant, Provident, Janssen Insurance, and Autolife."],
    ];
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = [
        '@type'          => 'Question',
        'name'           => $faq['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($faq['a'])],
    ];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'MBI — Approved Repairer', 'item' => $site_url . '/mechanical-breakdown-insurance/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $provider_name, 'item' => $page_url],
            ],
        ],
        [
            '@type'       => ['AutoRepair', 'LocalBusiness'],
            '@id'         => $site_url . '/#organization',
            'name'        => 'Tony Allen Auto Service',
            'url'         => $site_url,
            'telephone'   => [$phone_free, $phone_local],
            'email'       => $email,
            'foundingDate'=> '1985-10',
            'description' => 'Approved ' . $provider_name . ' repairer. NZTA Authorised (' . $ms_number . '). MTA Assured. Family-owned since 1985. ' . $division_count . ' specialist divisions.',
            'address'     => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
            'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => str_replace('+', '', $reviews), 'bestRating' => '5'],
            'sameAs'      => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
            'memberOf'    => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ],
];

get_header();
?>
<div class="taas-mp">
<?php
// Resolve provider logo after get_header
$_logo_id = (int) get_post_meta($post_id, 'provider_logo', true);
if ($_logo_id) {
    $_logo_src = wp_get_attachment_image_src($_logo_id, 'full');
    if ($_logo_src) {
        $provider_logo = [
            'url'    => $_logo_src[0],
            'width'  => $_logo_src[1],
            'height' => $_logo_src[2],
            'alt'    => get_post_meta($_logo_id, '_wp_attachment_image_alt', true) ?: $provider_name . ' logo',
        ];
    }
}
?>
<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>

<style>
/* ── Reset ──────────────────────────────────────────────────────────── */
.page-template-template-mbi-provider .site-content,
.page-template-template-mbi-provider .entry-content,
.page-template-template-mbi-provider .entry-header,
.page-template-template-mbi-provider article,
.page-template-template-mbi-provider #primary,
.page-template-template-mbi-provider #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-mp *, .taas-mp *::before, .taas-mp *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-mp { font-family:var(--taas-font, 'Inter', Arial, sans-serif); color:#333; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }
.taas-mp a { text-decoration:none; }
.mp-w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ── Breadcrumb ──────────────────────────────────────────────────────── */
.mp-breadcrumb { background:#1A1A1A; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.mp-breadcrumb__inner { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:400; color:#666; flex-wrap:wrap; }
.mp-breadcrumb__inner a { color:#888; transition:color .15s; }
.mp-breadcrumb__inner a:hover { color:var(--taas-yellow, #FFC800); }
.mp-breadcrumb__sep { color:#444; }

/* ── Hero ────────────────────────────────────────────────────────────── */
.mp-hero { background:var(--taas-black, #111); padding:var(--taas-sec-pad, 72px) 0 64px; position:relative; }
.mp-hero__bg { position:absolute; inset:0; z-index:0; background:url('<?php echo $hero_img; ?>') center 40% / cover no-repeat; }
.mp-hero__bg::after { content:''; position:absolute; inset:0; background:rgba(13,13,13,0.82); }
.mp-hero > .mp-w { position:relative; z-index:1; }
.mp-hero__inner { display:grid; grid-template-columns:1fr 340px; gap:48px; align-items:center; }
.mp-hero__eye { display:inline-block; background:var(--taas-yellow, #FFC800); color:#1A1A1A; font-size:11px; font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; padding:5px 14px; margin-bottom:16px; }
.mp-hero__h1 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight:800; color:#fff; line-height:1.1; letter-spacing:-0.02em; margin-bottom:14px; }
.mp-hero__h1 span { color:var(--taas-yellow, #FFC800); }
.mp-hero__sub { font-size:16px; font-weight:300; color:#aaa; line-height:1.75; margin-bottom:28px; }
.mp-hero__btns { display:flex; gap:12px; flex-wrap:wrap; }
.mp-hero__card { background:#1A1A1A; border:1px solid #2a2a2a; border-top:3px solid var(--taas-yellow, #FFC800); padding:28px; }
.mp-hero__card-logo { background:#fff; border-radius:var(--taas-radius, 6px); padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; justify-content:center; min-height:56px; }
.mp-hero__card-logo img { max-height:40px; max-width:160px; width:auto; display:block; object-fit:contain; }
.mp-hero__card-title { font-size:10px; font-weight:800; letter-spacing:.14em; text-transform:uppercase; color:var(--taas-yellow, #FFC800); margin-bottom:16px; }
.mp-card-row { display:flex; align-items:flex-start; gap:12px; padding:10px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.mp-card-row:last-child { border-bottom:none; }
.mp-card-tick { width:18px; height:18px; background:var(--taas-yellow, #FFC800); border-radius:2px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:900; color:#1A1A1A; }
.mp-card-text { font-size:13px; font-weight:300; color:#ccc; line-height:1.75; }
.mp-card-text strong { color:#fff; display:block; font-size:14px; font-weight:600; margin-bottom:2px; }

/* ── Phone strip ─────────────────────────────────────────────────────── */
.mp-phone-strip { background:var(--taas-yellow, #FFC800); padding:14px 0; }
.mp-phone-strip__inner { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.mp-phone-strip__number { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:28px; font-weight:900; color:var(--taas-dark, #1A1A1A); }
.mp-phone-strip__number a { color:inherit; }
.mp-phone-strip__number a:hover { opacity:0.65; }
.mp-phone-strip__right { display:flex; align-items:center; gap:20px; }
.mp-phone-strip__hours { font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); }
.mp-phone-strip__email { display:inline-block; background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); font-size:12px; font-weight:700; padding:6px 14px; border-radius:3px; }
.mp-phone-strip__email:hover { opacity:.85; }

/* ── Trust strip ─────────────────────────────────────────────────────── */
.mp-trust { background:var(--taas-panel, #F7F7F5); padding:18px 0; border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mp-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.mp-trust__item { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); white-space:nowrap; }
.mp-trust__item::before { content:'✓'; font-weight:900; color:var(--taas-yellow, #FFC800); }

/* ── Shared section ──────────────────────────────────────────────────── */
.mp-sec { padding:var(--taas-sec-pad, 72px) 0; }
.mp-sec-eye { display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.mp-sec-eye--yellow { background:var(--taas-yellow, #FFC800); color:#1A1A1A; }
.mp-sec-eye--dark   { background:#1A1A1A; color:var(--taas-yellow, #FFC800); }
.mp-sec-h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:var(--taas-black, #111); letter-spacing:-0.01em; margin-bottom:12px; }
.mp-body { font-size:16px; font-weight:300; color:#444; line-height:1.75; margin-bottom:16px; }

/* ── Process ─────────────────────────────────────────────────────────── */
.mp-process { background:#fff; }
.mp-process__steps { display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:var(--taas-border, #E8E8E4); margin-top:40px; }
.mp-step { background:#fff; padding:28px 20px; }
.mp-step__num { font-size:11px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:var(--taas-yellow, #FFC800); margin-bottom:12px; }
.mp-step__title { font-size:16px; font-weight:700; color:#111; margin-bottom:8px; border-top:3px solid var(--taas-yellow, #FFC800); padding-top:12px; }
.mp-step__text { font-size:14px; font-weight:300; color:#555; line-height:1.75; }

/* ── Cover grid ──────────────────────────────────────────────────────── */
.mp-cover { background:var(--taas-panel, #F7F7F5); }
.mp-cover__grid { display:grid; grid-template-columns:1fr 1fr; gap:3px; margin-top:32px; }
.mp-cover-col { padding:28px; }
.mp-cover-col--yes { background:#fff; border-top:3px solid var(--taas-yellow, #FFC800); }
.mp-cover-col--no  { background:#fff; border-top:3px solid var(--taas-border, #E8E8E4); }
.mp-cover-col__head { font-size:14px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; margin-bottom:16px; }
.mp-cover-col--yes .mp-cover-col__head { color:#111; }
.mp-cover-col--no  .mp-cover-col__head { color:#aaa; }
.mp-cover-item { display:flex; align-items:flex-start; gap:8px; font-size:14px; font-weight:300; color:#555; padding:5px 0; line-height:1.75; }
.mp-cover-item::before { flex-shrink:0; font-size:12px; font-weight:700; margin-top:1px; }
.mp-cover-col--yes .mp-cover-item::before { content:'✓'; color:var(--taas-yellow, #FFC800); }
.mp-cover-col--no  .mp-cover-item::before { content:'✕'; color:#ccc; }

/* ── Finance strip ───────────────────────────────────────────────────── */
.mp-finance { background:var(--taas-panel, #F7F7F5); padding:24px 0; border-top:1px solid var(--taas-border, #E8E8E4); border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mp-finance__inner { display:flex; align-items:center; justify-content:center; gap:24px; flex-wrap:wrap; text-align:center; }
.mp-finance__text { font-size:14px; font-weight:300; color:#555; line-height:1.75; }
.mp-finance__text a { color:var(--taas-yellow, #FFC800); font-weight:600; }
.mp-finance__badges { display:flex; gap:12px; flex-wrap:wrap; align-items:center; }
.mp-finance__badge { font-size:12px; font-weight:700; color:var(--taas-dark, #1A1A1A); background:#fff; border:1px solid var(--taas-border, #E8E8E4); padding:4px 12px; border-radius:3px; white-space:nowrap; }

/* ── Why TAAS ────────────────────────────────────────────────────────── */
.mp-why { background:#fff; }
.mp-checklist { list-style:none; display:flex; flex-direction:column; gap:12px; margin-top:16px; }
.mp-checklist li { display:flex; align-items:flex-start; gap:12px; font-size:15px; font-weight:300; color:#333; line-height:1.75; }
.mp-checklist li .mp-tick { flex-shrink:0; margin-top:2px; }

/* ── Buttons ─────────────────────────────────────────────────────────── */
.mp-btn { display:inline-flex; align-items:center; gap:8px; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-weight:700; font-size:14px; letter-spacing:.04em; text-transform:uppercase; padding:14px 26px; border-radius:var(--taas-radius, 6px); transition:all .18s; }
.mp-btn--primary { background:var(--taas-yellow, #FFC800); color:#1A1A1A!important; }
.mp-btn--primary:hover { background:var(--taas-yellow2, #e6b400); transform:translateY(-1px); }
.mp-btn--outline { background:transparent; color:var(--taas-yellow, #FFC800)!important; border:2px solid var(--taas-yellow, #FFC800); }
.mp-btn--outline:hover { background:var(--taas-yellow, #FFC800); color:#1A1A1A!important; }
.mp-btn--dark { background:#1A1A1A; color:#fff!important; }
.mp-btn--dark:hover { background:#000; }

/* ── Dark enquiry ────────────────────────────────────────────────────── */
.mp-enquiry { background:var(--taas-black, #111111); padding:var(--taas-sec-pad, 72px) 0; }
.mp-enquiry__inner { display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:start; }
.mp-enquiry__h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:#fff; margin-bottom:16px; }
.mp-enquiry__sub { font-size:16px; font-weight:300; color:#888; line-height:1.75; margin-bottom:24px; }
.mp-enquiry__phone { display:block; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:32px; font-weight:900; color:var(--taas-yellow, #FFC800); margin-bottom:20px; }
.mp-enquiry__phone:hover { opacity:.7; }
.mp-enquiry__detail { font-size:14px; font-weight:300; color:#888; line-height:1.75; margin-bottom:6px; }
.mp-enquiry__detail a { color:#aaa; }
.mp-enquiry__detail a:hover { color:var(--taas-yellow, #FFC800); }
.mp-enquiry__drumbeat { font-size:13px; font-weight:600; color:var(--taas-yellow, #FFC800); margin-top:20px; }
.mp-enquiry__finance { margin-top:20px; display:flex; gap:10px; flex-wrap:wrap; }
.mp-enquiry__finance-badge { font-size:11px; font-weight:700; color:#aaa; background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); padding:4px 10px; border-radius:3px; }

/* CF7 dark styling */
.mp-enquiry .wpcf7-form input[type="text"],
.mp-enquiry .wpcf7-form input[type="email"],
.mp-enquiry .wpcf7-form input[type="tel"],
.mp-enquiry .wpcf7-form select,
.mp-enquiry .wpcf7-form textarea {
  background:#1c1c1c!important; border:1px solid #333!important; color:#fff!important;
  border-radius:var(--taas-radius, 6px)!important; padding:12px 14px!important; font-size:15px!important;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important; font-weight:300!important;
  width:100%!important; box-sizing:border-box!important;
  margin-top:4px!important; transition:border-color .15s!important;
}
.mp-enquiry .wpcf7-form input:focus,
.mp-enquiry .wpcf7-form textarea:focus { border-color:var(--taas-yellow, #FFC800)!important; outline:none!important; }
.mp-enquiry .wpcf7-form textarea { min-height:100px!important; resize:vertical!important; }
.mp-enquiry .wpcf7-form label { font-size:11px!important; font-weight:700!important; letter-spacing:.08em!important; text-transform:uppercase!important; color:#888!important; display:block!important; }
.mp-enquiry .wpcf7-form input[type="submit"] {
  background:var(--taas-yellow, #FFC800)!important; color:var(--taas-dark, #1A1A1A)!important; border:none!important;
  padding:14px 28px!important; font-size:14px!important; font-weight:700!important;
  width:100%!important; cursor:pointer!important; margin-top:4px!important;
  letter-spacing:.04em!important; text-transform:uppercase!important; border-radius:var(--taas-radius, 6px)!important;
}
.mp-enquiry .wpcf7-form input[type="submit"]:hover { background:var(--taas-yellow2, #e6b400)!important; }

/* ── Reviews ─────────────────────────────────────────────────────────── */
.mp-reviews { background:var(--taas-panel, #F7F7F5); padding:var(--taas-sec-pad, 72px) 0; }

/* ── Related ─────────────────────────────────────────────────────────── */
.mp-related { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mp-related__grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-top:32px; }
.mp-related__card { background:var(--taas-panel, #F7F7F5); border:1px solid var(--taas-border, #E8E8E4); padding:20px; transition:border-color .15s; display:block; }
.mp-related__card:hover { border-color:var(--taas-yellow, #FFC800); }
.mp-related__card-title { font-size:15px; font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:6px; }
.mp-related__card-text { font-size:13px; font-weight:300; color:#666; line-height:1.75; }

/* ── FAQ ──────────────────────────────────────────────────────────────── */
.mp-faq { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mp-faq__list { max-width:780px; margin:40px auto 0; }
.mp-faq__item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mp-faq__item:first-child { border-top:1px solid var(--taas-border, #E8E8E4); }
.mp-faq__q {
  width:100%; background:none; border:none; text-align:left; cursor:pointer;
  padding:20px 40px 20px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:15px; font-weight:700; color:var(--taas-black, #111);
  position:relative; line-height:1.4;
}
.mp-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:300; color:var(--taas-yellow, #FFC800); }
.mp-faq__q[aria-expanded="true"]::after { content:'−'; }
.mp-faq__a { display:none; padding:0 40px 20px 0; font-size:15px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .mp-hero__inner, .mp-enquiry__inner { grid-template-columns:1fr; gap:40px; }
  .mp-hero__card { display:none; }
  .mp-process__steps { grid-template-columns:1fr 1fr; }
  .mp-cover__grid { grid-template-columns:1fr; }
}
@media (max-width:640px) {
  /* Layout */
  .mp-process__steps { grid-template-columns:1fr; }
  .mp-hero__btns { flex-direction:column; align-items:stretch; }
  .mp-hero__btns .mp-btn { justify-content:center; text-align:center; }
  .mp-enquiry__inner { flex-direction:column-reverse; }

  /* Section spacing */
  .mp-hero { padding:48px 0 40px; }
  .mp-sec, .mp-enquiry, .mp-reviews, .mp-related, .mp-faq { padding:48px 0; }

  /* Type scale */
  .mp-hero__h1 { font-size:clamp(24px, 7vw, 36px); }
  .mp-hero__sub { font-size:14px; margin-bottom:24px; }
  .mp-btn { font-size:13px; padding:12px 20px; }
  .mp-sec-h2 { font-size:clamp(20px, 5vw, 28px); }
  .mp-body { font-size:14px; }
  .mp-step__title { font-size:14px; }
  .mp-step__text { font-size:13px; }
  .mp-step { padding:20px; }
  .mp-cover-item { font-size:13px; }
  .mp-cover-col { padding:20px; }
  .mp-checklist li { font-size:13px; gap:10px; }
  .mp-enquiry__h2 { font-size:clamp(22px, 6vw, 30px); }
  .mp-enquiry__phone { font-size:24px; }
  .mp-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .mp-faq__a { font-size:13px; }

  /* Phone strip */
  .mp-phone-strip__inner { flex-direction:column; text-align:center; }
  .mp-phone-strip__right { flex-direction:column; gap:8px; }

  /* Trust strip */
  .mp-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .mp-trust__item { font-size:12px; }
}
</style>


<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════════════ -->
<nav class="mp-breadcrumb" aria-label="Breadcrumb">
  <div class="mp-w">
    <div class="mp-breadcrumb__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="mp-breadcrumb__sep">›</span>
      <a href="<?php echo esc_url($site_url . '/mechanical-breakdown-insurance/'); ?>">MBI</a>
      <span class="mp-breadcrumb__sep">›</span>
      <span><?php echo esc_html($provider_name); ?></span>
    </div>
  </div>
</nav>


<!-- ══ HERO ══════════════════════════════════════════════════════════════════ -->
<section class="mp-hero" aria-labelledby="mp-h1">
  <div class="mp-hero__bg"></div>
  <div class="mp-w">
    <div class="mp-hero__inner">
      <div>
        <span class="mp-hero__eye">MBI Approved Repairer · Manukau</span>
        <h1 class="mp-hero__h1" id="mp-h1">
          <?php echo esc_html($provider_name); ?> Approved<br>
          <span>Repairer Manukau</span>
        </h1>
        <p class="mp-hero__sub"><?php echo esc_html($provider_tagline); ?></p>
        <div class="mp-hero__btns">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mp-btn mp-btn--primary">Call <?php echo esc_html($phone_free); ?></a>
          <a href="#mp-enquiry" class="mp-btn mp-btn--outline">Send Enquiry</a>
        </div>
        <p style="font-size:13px;font-weight:300;color:#666;margin-top:16px;">MTA Assured · NZTA Authorised (<?php echo esc_html($ms_number); ?>)</p>
      </div>

      <div class="mp-hero__card" aria-hidden="true">
        <?php if ($provider_logo): ?>
        <div class="mp-hero__card-logo">
          <img src="<?php echo esc_url($provider_logo['url']); ?>"
               alt="<?php echo esc_attr($provider_logo['alt']); ?>"
               width="<?php echo esc_attr($provider_logo['width']); ?>"
               height="<?php echo esc_attr($provider_logo['height']); ?>">
        </div>
        <?php endif; ?>
        <div class="mp-hero__card-title">How It Works</div>
        <div class="mp-card-row">
          <div class="mp-card-tick">1</div>
          <div class="mp-card-text"><strong>Call us first</strong>Authorisation needed before repairs begin</div>
        </div>
        <div class="mp-card-row">
          <div class="mp-card-tick">2</div>
          <div class="mp-card-text"><strong>We diagnose</strong>Fault confirmed — no guesswork</div>
        </div>
        <div class="mp-card-row">
          <div class="mp-card-tick">3</div>
          <div class="mp-card-text"><strong>We contact <?php echo esc_html($provider_name); ?></strong>Authorisation arranged by us</div>
        </div>
        <div class="mp-card-row">
          <div class="mp-card-tick">4</div>
          <div class="mp-card-text"><strong>We invoice your provider</strong>Covered amounts billed direct — we confirm any balance with you first</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ═══════════════════════════════════════════════════════════ -->
<div class="mp-phone-strip" role="region" aria-label="Contact">
  <div class="mp-w">
    <div class="mp-phone-strip__inner">
      <div class="mp-phone-strip__number"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></div>
      <div class="mp-phone-strip__right">
        <span class="mp-phone-strip__hours"><?php echo esc_html($hours); ?></span>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="mp-phone-strip__email"><?php echo esc_html($email); ?></a>
      </div>
    </div>
  </div>
</div>


<!-- ══ TRUST STRIP ══════════════════════════════════════════════════════════ -->
<div class="mp-trust" role="region" aria-label="Trust signals">
  <div class="mp-w">
    <div class="mp-trust__inner">
      <div class="mp-trust__item">Approved <?php echo esc_html($provider_name); ?> repairer</div>
      <div class="mp-trust__item">MTA Assured</div>
      <div class="mp-trust__item">NZTA Authorised</div>
      <div class="mp-trust__item"><?php echo esc_html($years); ?> years in South Auckland</div>
      <div class="mp-trust__item">Estimate before we start</div>
    </div>
  </div>
</div>


<!-- ══ PROCESS ══════════════════════════════════════════════════════════════ -->
<section class="mp-sec mp-process" aria-labelledby="mp-process-head">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">The Process</span>
    <h2 class="mp-sec-h2" id="mp-process-head">How <?php echo esc_html($provider_name); ?> MBI repairs work at TAAS</h2>
    <p class="mp-body"><?php echo esc_html($desc_1); ?></p>
    <?php if ($desc_2): ?><p class="mp-body"><?php echo esc_html($desc_2); ?></p><?php endif; ?>
    <div class="mp-process__steps">
      <?php foreach ($steps as $step): ?>
      <div class="mp-step">
        <div class="mp-step__num"><?php echo esc_html($step['num']); ?></div>
        <div class="mp-step__title"><?php echo esc_html($step['title']); ?></div>
        <div class="mp-step__text"><?php echo esc_html($step['text']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ WHAT IS COVERED ═════════════════════════════════════════════════════ -->
<section class="mp-sec mp-cover" aria-labelledby="mp-cover-head">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">MBI Coverage</span>
    <h2 class="mp-sec-h2" id="mp-cover-head">What <?php echo esc_html($provider_name); ?> MBI typically covers</h2>
    <p class="mp-body">Coverage varies by policy tier. Always check your policy documents or call <?php echo esc_html($provider_name); ?> directly to confirm what is and is not covered under your specific plan.</p>
    <div class="mp-cover__grid">
      <div class="mp-cover-col mp-cover-col--yes">
        <div class="mp-cover-col__head">✓ Typically Covered</div>
        <?php foreach ($covered as $item): ?><div class="mp-cover-item"><?php echo esc_html($item); ?></div><?php endforeach; ?>
      </div>
      <div class="mp-cover-col mp-cover-col--no">
        <div class="mp-cover-col__head">✕ Not Covered</div>
        <?php foreach ($not_covered as $item): ?><div class="mp-cover-item"><?php echo esc_html($item); ?></div><?php endforeach; ?>
      </div>
    </div>
    <p style="font-size:12px;font-weight:300;color:#aaa;margin-top:16px;line-height:1.75;">Coverage details based on typical MBI policy terms. Confirm specifics with <?php echo esc_html($provider_name); ?>.</p>
  </div>
</section>


<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════════ -->
<div class="mp-finance" role="region" aria-label="Finance options">
  <div class="mp-w">
    <div class="mp-finance__inner">
      <span class="mp-finance__text">Excess or uncovered repairs? <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">Split the cost</a> —</span>
      <div class="mp-finance__badges">
        <span class="mp-finance__badge">Afterpay</span>
        <span class="mp-finance__badge">Q Card</span>
        <span class="mp-finance__badge">Gem Finance</span>
        <span class="mp-finance__badge">Aotea Finance</span>
      </div>
    </div>
  </div>
</div>


<!-- ══ WHY TAAS ═════════════════════════════════════════════════════════════ -->
<section class="mp-sec mp-why" aria-labelledby="mp-why-head">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">Why Choose TAAS</span>
    <h2 class="mp-sec-h2" id="mp-why-head">Why <?php echo esc_html($provider_name); ?> policyholders choose Tony Allen Auto Service</h2>
    <?php
    $tick = '<svg class="mp-tick" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    ?>
    <ul class="mp-checklist">
      <li><?php echo $tick; ?>Approved repairer for <?php echo esc_html($provider_name); ?> and 4 other MBI providers</li>
      <li><?php echo $tick; ?>MTA Assured — satisfies the servicing requirements of all MBI providers</li>
      <li><?php echo $tick; ?>Trading since <?php echo esc_html($established); ?> — <?php echo esc_html($years); ?> years of experience with MBI claims</li>
      <li><?php echo $tick; ?><?php echo esc_html($division_count); ?> specialist divisions under one roof — most repairs handled in-house</li>
      <li><?php echo $tick; ?>European vehicle specialists — MBI claims on <?php echo esc_html($euro_brands); ?></li>
      <li><?php echo $tick; ?>Raj leads diagnostics — fault confirmed before any parts are replaced</li>
      <li><?php echo $tick; ?>Full servicing capability — keep your MBI valid with regular servicing at TAAS</li>
      <li><?php echo $tick; ?>Finance available for excess payments — <?php echo esc_html($finance_list); ?></li>
      <li><?php echo $tick; ?><?php echo esc_html($rating); ?>★ Google rating from <?php echo esc_html($reviews); ?> reviews</li>
      <li><?php echo $tick; ?>Estimate before we start — nothing happens without your approval</li>
    </ul>
  </div>
</section>


<!-- ══ DARK ENQUIRY ═════════════════════════════════════════════════════════ -->
<section class="mp-enquiry" id="mp-enquiry" aria-labelledby="mp-enquiry-head">
  <div class="mp-w">
    <div class="mp-enquiry__inner">
      <div>
        <h2 class="mp-enquiry__h2" id="mp-enquiry-head">Got a <?php echo esc_html($provider_name); ?> policy?<br>We're your Manukau repairer.</h2>
        <p class="mp-enquiry__sub">Call us or send an enquiry. Enquiries before 3pm answered same day, estimates within one business day.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mp-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <p class="mp-enquiry__detail"><a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a></p>
        <p class="mp-enquiry__detail"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
        <p class="mp-enquiry__detail"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener"><?php echo esc_html($address); ?></a></p>
        <p class="mp-enquiry__detail"><?php echo esc_html($hours); ?></p>
        <p class="mp-enquiry__drumbeat">Estimate before we start — nothing happens without your approval.</p>
        <div class="mp-enquiry__finance">
          <span class="mp-enquiry__finance-badge">Afterpay</span>
          <span class="mp-enquiry__finance-badge">Q Card</span>
          <span class="mp-enquiry__finance-badge">Gem</span>
          <span class="mp-enquiry__finance-badge">Aotea</span>
        </div>
      </div>
      <div>
        <?php if ($cf7_general): ?>
          <?php echo do_shortcode($cf7_general); ?>
        <?php else: ?>
          <p style="color:#888;font-size:14px;font-weight:300;line-height:1.75;">Contact form loading — please call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow, #FFC800);"><?php echo esc_html($phone_free); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<?php if ($reviews_widget): ?>
<!-- ══ REVIEWS ══════════════════════════════════════════════════════════════ -->
<section class="mp-reviews" aria-label="Customer reviews">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">Google Reviews</span>
    <h2 class="mp-sec-h2">What our customers say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>
<?php endif; ?>


<?php if ($claims_phone || $provider_website): ?>
<!-- ══ PROVIDER CONTACT ═════════════════════════════════════════════════════ -->
<section style="background:var(--taas-panel, #F7F7F5);padding:48px 0;border-top:1px solid var(--taas-border, #E8E8E4);" aria-label="Provider contact">
  <div class="mp-w" style="max-width:720px;text-align:center;">
    <span class="mp-sec-eye mp-sec-eye--dark"><?php echo esc_html($provider_name); ?> Direct</span>
    <h2 class="mp-sec-h2">Need to contact <?php echo esc_html($provider_name); ?>?</h2>
    <p class="mp-body" style="text-align:center;">If you need to check your policy, confirm coverage, or start a claim directly with <?php echo esc_html($provider_name); ?>:</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:16px;">
      <?php if ($claims_phone): ?>
      <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $claims_phone)); ?>" class="mp-btn mp-btn--dark"><?php echo esc_html($provider_name); ?> Claims: <?php echo esc_html($claims_phone); ?></a>
      <?php endif; ?>
      <?php if ($provider_website): ?>
      <a href="<?php echo esc_url($provider_website); ?>" target="_blank" rel="noopener" class="mp-btn mp-btn--outline"><?php echo esc_html($provider_name); ?> Website ↗</a>
      <?php endif; ?>
    </div>
    <p style="font-size:13px;font-weight:300;color:#999;margin-top:16px;line-height:1.75;">Then bring your vehicle to <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a> — we handle the rest.</p>
  </div>
</section>
<?php endif; ?>


<!-- ══ RELATED ══════════════════════════════════════════════════════════════ -->
<section class="mp-related" aria-labelledby="mp-related-head">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">Other MBI Providers</span>
    <h2 class="mp-sec-h2" id="mp-related-head">We also work with</h2>
    <div class="mp-related__grid">
      <?php foreach ($all_providers as $key => $prov):
        if ($key === $pid) continue;
      ?>
      <a href="<?php echo esc_url($site_url . '/' . $prov['slug'] . '/'); ?>" class="mp-related__card">
        <div class="mp-related__card-title"><?php echo esc_html($prov['name']); ?></div>
        <p class="mp-related__card-text">Approved <?php echo esc_html($prov['name']); ?> repairer — full claim management at 139 Cavendish Drive, Manukau.</p>
      </a>
      <?php endforeach; ?>
      <a href="<?php echo esc_url($site_url . '/mechanical-breakdown-insurance/'); ?>" class="mp-related__card">
        <div class="mp-related__card-title">All MBI Providers</div>
        <p class="mp-related__card-text">Compare all five MBI providers we work with and how the claim process works.</p>
      </a>
      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="mp-related__card">
        <div class="mp-related__card-title">Vehicle Servicing</div>
        <p class="mp-related__card-text">Regular servicing keeps your MBI valid. MTA Assured workshop.</p>
      </a>
    </div>
  </div>
</section>


<!-- ══ FAQ ══════════════════════════════════════════════════════════════════ -->
<section class="mp-faq" aria-labelledby="mp-faq-head">
  <div class="mp-w">
    <span class="mp-sec-eye mp-sec-eye--yellow">Common Questions</span>
    <h2 class="mp-sec-h2" id="mp-faq-head"><?php echo esc_html($provider_name); ?> Questions Answered</h2>
    <div class="mp-faq__list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'mp-faq-q-' . $fi;
        $aid = 'mp-faq-a-' . $fi;
      ?>
      <div class="mp-faq__item">
        <button class="mp-faq__q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div class="mp-faq__a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $fi === 0 ? 'display:block;' : ''; ?>">
          <?php echo wp_kses_post($faq['a']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- /.taas-mp -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('.taas-mp .mp-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var open = this.getAttribute('aria-expanded') === 'true';
      document.querySelectorAll('.taas-mp .mp-faq__q').forEach(function(b){
        b.setAttribute('aria-expanded','false');
        var a = document.getElementById(b.getAttribute('aria-controls'));
        if(a) a.style.display='none';
      });
      if(!open){
        this.setAttribute('aria-expanded','true');
        var ans = document.getElementById(this.getAttribute('aria-controls'));
        if(ans) ans.style.display='block';
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
