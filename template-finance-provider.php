<?php
/**
 * Template Name: Finance Provider Spoke
 * Template Post Type: page
 *
 * ACF fields:
 *   provider_name      — e.g. "Afterpay" or "Gem Finance"
 *   provider_tagline   — short tagline shown in hero
 *   provider_logo_url  — URL to provider logo (optional — falls back to name text)
 *   provider_badge     — e.g. "Interest-Free" or "NZ-Owned"
 *   provider_desc_1    — first body paragraph
 *   provider_desc_2    — second body paragraph (optional)
 *   provider_steps     — JSON array of steps: [{"step": "text"}, ...]
 *   provider_facts     — JSON array: [{"val": "4", "lbl": "Payments"}, ...]
 *   provider_cta_label — CTA button label, e.g. "Visit Gem Finance"
 *   provider_cta_url   — external URL or internal
 *   hub_page_slug      — e.g. "finance-options"
 *   hub_page_label     — e.g. "Finance Options"
 *
 * Tony Allen Auto Service — taas.co.nz
 * Built: May 2026
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-fp', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Shared libraries ─────────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$cf7_finance    = defined('TAAS_CF7_FINANCE')    ? TAAS_CF7_FINANCE    : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$customers      = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$ms_number      = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$division_count = defined('TAAS_DIVISION_COUNT')? TAAS_DIVISION_COUNT : '7';

$site_url       = get_site_url();
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$years          = (int)date('Y') - (int)$established;
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img       = get_site_url() . (defined('TAAS_HERO_FINANCE') ? TAAS_HERO_FINANCE : '/wp-content/uploads/2026/06/hero-finance.webp');

// ── ACF fields ────────────────────────────────────────────────────────────────
$post_id         = get_the_ID();
$provider_name   = (get_field('provider_name',   $post_id) ?: get_post_meta($post_id, 'provider_name', true)) ?: 'Finance';
$provider_id     = (get_field('provider_id',     $post_id) ?: get_post_meta($post_id, 'provider_id', true)) ?: '';
$provider_tagline= get_field('provider_tagline', $post_id) ?: get_post_meta($post_id, 'provider_tagline', true) ?: 'Flexible payment options for car repairs in Manukau.';
$suburb_name    = (get_field('suburb_name',    $post_id) ?: get_post_meta($post_id, 'suburb_name', true)) ?: 'Manukau';
$provider_logo   = get_field('provider_logo_url', $post_id) ?: get_post_meta($post_id, 'provider_logo_url', true) ?: '';
$provider_badge  = get_field('provider_badge',  $post_id) ?: get_post_meta($post_id, 'provider_badge', true) ?: 'Finance Option';
$desc_1          = get_field('provider_desc_1', $post_id) ?: get_post_meta($post_id, 'provider_desc_1', true) ?: "Pay for your car repairs with {$provider_name} at Tony Allen Auto Service. We accept {$provider_name} across all services — WOF, servicing, brakes, tyres, engine work, and more.";
$desc_2          = get_field('provider_desc_2', $post_id) ?: get_post_meta($post_id, 'provider_desc_2', true) ?: '';
$steps_raw       = get_field('provider_steps',  $post_id) ?: get_post_meta($post_id, 'provider_steps', true) ?: '';
$facts_raw       = get_field('provider_facts',  $post_id) ?: get_post_meta($post_id, 'provider_facts', true) ?: '';
$cta_label       = get_field('provider_cta_label', $post_id) ?: get_post_meta($post_id, 'provider_cta_label', true) ?: "Visit {$provider_name}";
$cta_url         = get_field('provider_cta_url',   $post_id) ?: get_post_meta($post_id, 'provider_cta_url', true) ?: '#';
$hub_slug        = get_field('hub_page_slug',   $post_id) ?: get_post_meta($post_id, 'hub_page_slug', true) ?: 'finance-options';
$hub_label       = get_field('hub_page_label',  $post_id) ?: get_post_meta($post_id, 'hub_page_label', true) ?: 'Finance Options';
$distance_note   = get_field('distance_note',   $post_id) ?: get_post_meta($post_id, 'distance_note', true) ?: '';
$area_raw        = get_field('area_served',     $post_id) ?: get_post_meta($post_id, 'area_served', true) ?: '';

// area_served: support both array and newline-separated textarea
if (is_array($area_raw)) {
    $area_served = array_filter($area_raw);
} else {
    $area_served = array_filter(array_map('trim', explode("\n", $area_raw)));
}

// Build distance string — avoids "from X from Y" when distance_note already contains "from"
$is_location_page = ($suburb_name !== 'Manukau');
if ($distance_note) {
    $distance_text = (stripos($distance_note, 'from') !== false)
        ? $distance_note
        : $distance_note . ' from ' . $suburb_name;
} else {
    $distance_text = '';
}

// Parse JSON fields
$steps = [];
if ($steps_raw) {
    $parsed = (is_array($steps_raw) ? $steps_raw : json_decode($steps_raw, true));
    if (is_array($parsed)) $steps = $parsed;
}
if (empty($steps)) {
    $steps = [
        ['step' => "Get a repair estimate from Tony Allen Auto Service"],
        ['step' => "Apply for or log in to your {$provider_name} account"],
        ['step' => "Use {$provider_name} at checkout when collecting your vehicle"],
        ['step' => "Repay according to your {$provider_name} plan"],
    ];
}

$facts = [];
if ($facts_raw) {
    $parsed = is_array($facts_raw) ? $facts_raw : json_decode($facts_raw, true);
    if (is_array($parsed)) $facts = $parsed;
}

// ── Services list ─────────────────────────────────────────────────────────────
$services = [
    ['label'=>'Warrant of Fitness (WOF)', 'url'=>'/wof/'],
    ['label'=>'Vehicle Servicing',         'url'=>'/vehicle-servicing/'],
    ['label'=>'Brake Repairs',             'url'=>'/manukau-brake-clutch/'],
    ['label'=>'Engine Repairs',            'url'=>'/engine-repairs/'],
    ['label'=>'Tyres & Wheels',            'url'=>'/tyre-centre/'],
    ['label'=>'Steering & Suspension',     'url'=>'/steering-and-suspension/'],
    ['label'=>'Clutch Replacement',        'url'=>'/clutch-repair-manukau/'],
    ['label'=>'Auto Electrical',           'url'=>'/auto-electrical/'],
    ['label'=>'Air Conditioning',          'url'=>'/air-conditioning/'],
    ['label'=>'Cambelts & Water Pumps',    'url'=>'/cambelts-and-water-pumps/'],
    ['label'=>'European Vehicles',         'url'=>'/european/'],
    ['label'=>'Commercial Vehicles',       'url'=>'/commercial-vehicles/'],
];

// ── FAQs — from shared library when provider_id matches, generic fallback ────
$faq_map = [
    'afterpay' => ['afterpay_any_repair','afterpay_account_setup','afterpay_spend_limit','afterpay_interest_free','afterpay_missed_payment','afterpay_how_to_pay','afterpay_credit_score'],
    'zip'      => ['zip_any_repair','zip_account_setup','zip_spend_limit','zip_interest_free','zip_how_to_pay','zip_missed_payment','zip_credit_score'],
    'qcard'    => ['qcard_any_repair','qcard_how_to_get','qcard_spend_limit','qcard_interest_free','qcard_repayments','qcard_after_promo'],
    'gem'      => ['gem_any_repair','gem_account_setup','gem_spend_limit','gem_interest_free','gem_how_to_pay','gem_missed_payment'],
    'aotea'    => ['aotea_any_repair','aotea_how_to_apply','aotea_interest','aotea_approval_time','aotea_declined_elsewhere','aotea_arrange_before'],
];

if ($provider_id && isset($faq_map[$provider_id]) && !$is_location_page) {
    // Cherry-pick provider-specific FAQs from shared library
    $faqs = [];
    foreach ($faq_map[$provider_id] as $key) {
        if (isset($taas_faqs[$key])) $faqs[] = $taas_faqs[$key];
    }
    // Append shared FAQs
    $faqs[] = $taas_faqs['finance_fleet'];
    $faqs[] = $taas_faqs['location'];
    $faqs[] = $taas_faqs['accreditations'];
    $faqs[] = $taas_faqs['estimates'];
    $faqs[] = $taas_faqs['finance_eftpos_cards'];
} else {
    // Generic fallback FAQs with provider_name interpolation
    $faqs = [
        ['q'=>"Can I use {$provider_name} for any service at Tony Allen Auto Service?",'a'=>"{$provider_name} is available across all of our services — WOF, routine servicing, brakes, tyres, engine work, cambelts, suspension, clutch, diagnostics, and more. Check your {$provider_name} account for your available limit or spending cap before booking a larger repair."],
        ['q'=>"Do I need a {$provider_name} account before I come in?",'a'=>"Yes. You'll need an active {$provider_name} account set up before paying. Check the {$provider_name} website or app for how to get started — it usually only takes a few minutes to apply."],
        ['q'=>"How do I pay with {$provider_name} when I collect my vehicle?",'a'=>"When you're ready to collect your vehicle, let our service desk know you're paying with {$provider_name}. We'll process the payment through our terminal. Make sure your account has sufficient limit or credit available."],
        ['q'=>"Where is Tony Allen Auto Service?",'a'=>"We're at 139 Cavendish Drive, Manukau, Auckland 2104" . ($distance_text ? " — {$distance_text}" : "") . ". Open Monday to Friday, 7:30am to 5:00pm. We've been at the same address since 1985."],
        ['q'=>"Can I use {$provider_name} for fleet or commercial vehicle repairs?",'a'=>"{$provider_name} is a consumer finance product. For commercial fleet servicing and account-based invoicing, speak with our team about TAAS Fleet arrangements — call {$phone_free} or email {$email}."],
        ['q'=>"What accreditations does Tony Allen Auto Service hold?",'a'=>"We are MTA Assured through the Motor Trade Association quality assurance programme, and NZTA Authorised for Warrant of Fitness inspections — station number {$ms_number}. Family-owned and operating from 139 Cavendish Drive, Manukau since 1985."],
        ['q'=>"Do you provide a written estimate before starting work?",'a'=>"Always. We diagnose the issue, explain what's needed in plain English, and give you a clear written estimate. You decide whether to proceed. No pressure, no surprises — and you can use {$provider_name} to spread the cost if the bill is larger than expected."],
        ['q'=>"What other finance options do you offer?",'a'=>"Alongside {$provider_name}, we accept Afterpay, Q Card, Gem Finance, and Aotea Finance. We also accept Visa, Mastercard, EFTPOS, and cash. Visit our finance options page to compare all four providers side by side."],
    ];
    if ($is_location_page) {
        $faqs[] = ['q'=>"Where is the nearest mechanic to {$suburb_name} that accepts {$provider_name}?",'a'=>"Tony Allen Auto Service is at 139 Cavendish Drive, Manukau" . ($distance_text ? " — {$distance_text}" : "") . ". We accept {$provider_name} across all services. {$years} years in South Auckland, MTA Assured, NZTA Authorised. Call {$phone_free} to book."];
    }
}

// ── Schema ────────────────────────────────────────────────────────────────────
$page_url = get_permalink();
$schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
                ['@type'=>'ListItem','position'=>2,'name'=>$hub_label,'item'=>$site_url.'/'.$hub_slug.'/'],
                ['@type'=>'ListItem','position'=>3,'name'=>$provider_name,'item'=>$page_url],
            ],
        ],
        [
            '@type'           => ['AutoRepair','LocalBusiness'],
            '@id'             => $site_url . '/#organization',
            'name'            => 'Tony Allen Auto Service',
            'url'             => $site_url,
            'telephone'       => [$phone_free, $phone_local],
            'email'           => $email,
            'address'         => ['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
            'geo'             => ['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
            'openingHoursSpecification' => [['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
            'foundingDate'    => '1985-10',
            'aggregateRating' => ['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>str_replace('+','',$reviews),'bestRating'=>'5'],
            'sameAs'          => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
            'memberOf'        => ['@type'=>'Organization','name'=>'MTA New Zealand'],
            'speakable'       => ['@type'=>'SpeakableSpecification','cssSelector'=>['.fp-hero__h1','.fp-hero__sub']],
        ],
        [
            '@type'        => 'FAQPage',
            'mainEntity'   => array_map(function($f) {
                return ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
            }, $faqs),
        ],
    ],
];

get_header();
?>

<script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>

<style>
/* ── Reset ──────────────────────────────────────────────────────────── */
.page-template-template-finance-provider .site-content,
.page-template-template-finance-provider .entry-content,
.page-template-template-finance-provider .entry-header,
.page-template-template-finance-provider article,
.page-template-template-finance-provider #primary,
.page-template-template-finance-provider #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-finance-provider { overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }

/* ── Finance Provider Spoke ─────────────────────────────────────────────── */
.fp-w { max-width:var(--taas-container,1140px); margin:0 auto; padding:0 24px; }

/* Breadcrumb */
.fp-bread { background:#0D0D0D; border-bottom:1px solid rgba(255,255,255,.06); padding:12px 0; }
.fp-bread a, .fp-bread span { font-size:12px; color:#888; text-decoration:none; }
.fp-bread a:hover { color:#FFC800; }
.fp-bread span[aria-current] { color:#ccc; }
.fp-bread span:not([aria-current]) { margin:0 6px; }

/* Hero */
.fp-hero { background:var(--taas-black,#111); padding:72px 0 64px; position:relative; }
.fp-hero__bg { position:absolute; inset:0; z-index:0; background:url('<?php echo esc_url($hero_img); ?>') center 40% / cover no-repeat; }
.fp-hero__bg::after { content:''; position:absolute; inset:0; background:rgba(13,13,13,0.82); }
.fp-hero > .fp-w { position:relative; z-index:1; }
.fp-hero__inner { display:grid; grid-template-columns:1fr 360px; gap:48px; align-items:center; }
.fp-hero__eye { display:inline-block; background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; padding:5px 14px; margin-bottom:16px; }
.fp-hero__h1 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight:800; color:#fff; line-height:1.1; letter-spacing:-0.02em; margin-bottom:16px; }
.fp-hero__h1 span { color:var(--taas-yellow,#FFC800); }
.fp-hero__sub { font-size:17px; color:#aaa; line-height:1.6; margin-bottom:28px; max-width:560px; }
.fp-hero__btns { display:flex; gap:12px; flex-wrap:wrap; }
.fp-hero__card { background:#1A1A1A; border:1px solid #2a2a2a; border-top:3px solid var(--taas-yellow,#FFC800); padding:32px; }
.fp-hero__card-title { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:20px; }
.fp-card-row { display:flex; align-items:flex-start; gap:12px; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.fp-card-row:last-child { border-bottom:none; }
.fp-card-tick { width:20px; height:20px; background:var(--taas-yellow,#FFC800); border-radius:2px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:900; color:#1A1A1A; }
.fp-card-text { font-size:14px; color:#ccc; line-height:1.6; }

/* Trust strip */
.fp-trust { background:var(--taas-yellow,#FFC800); padding:18px 0; }
.fp-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.fp-trust__item { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:#1A1A1A; white-space:nowrap; }
.fp-trust__item::before { content:'✓'; font-weight:900; }

/* How it works */
.fp-how { background:#fff; padding:72px 0; }
.fp-sec-eye { display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.fp-sec-eye--yellow { background:var(--taas-yellow,#FFC800); color:#1A1A1A; }
.fp-sec-eye--dark   { background:#1A1A1A; color:var(--taas-yellow,#FFC800); }
.fp-sec-h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:var(--taas-black, #111); letter-spacing:-0.01em; margin-bottom:12px; }
.fp-body { font-size:16px; color:#444; line-height:1.78; margin-bottom:16px; }
.fp-steps { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-top:40px; }
.fp-step { background:#F7F7F5; padding:24px; border-top:3px solid var(--taas-yellow,#FFC800); }
.fp-step__num { font-family:'Inter',Arial,sans-serif; font-size:32px; font-weight:900; color:var(--taas-yellow,#FFC800); line-height:1; margin-bottom:12px; }
.fp-step__text { font-size:14px; color:#444; line-height:1.6; }

/* Facts */
.fp-facts { display:flex; gap:32px; flex-wrap:wrap; margin-top:32px; }
.fp-fact { background:#F7F7F5; padding:20px 28px; border-left:4px solid var(--taas-yellow,#FFC800); min-width:120px; }
.fp-fact__val { font-family:'Inter',Arial,sans-serif; font-size:32px; font-weight:900; color:#111; line-height:1; }
.fp-fact__lbl { font-size:12px; color:#666; margin-top:4px; text-transform:uppercase; letter-spacing:.06em; }

/* Services */
.fp-services { background:#F7F7F5; padding:72px 0; }
.fp-services__grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; margin-top:32px; }
.fp-checklist { list-style:none; display:flex; flex-direction:column; gap:10px; }
.fp-checklist li { display:flex; align-items:flex-start; gap:12px; font-size:15px; color:#333; line-height:1.6; }
.fp-checklist li::before { content:''; width:22px; height:22px; flex-shrink:0; margin-top:1px;
  background:var(--taas-yellow,#FFC800) url("data:image/svg+xml,%3Csvg viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 11l5 5 7-7' stroke='%231A1A1A' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/contain no-repeat; border-radius:3px; }
.fp-checklist li a { color:#333; text-decoration:none; transition:color .15s; }
.fp-checklist li a:hover { color:#FFC800; }
.fp-contact-card { background:#fff; border:1px solid #E8E8E4; border-top:3px solid var(--taas-yellow,#FFC800); padding:28px; }
.fp-contact-card h3 { font-size:16px; font-weight:700; color:#111; margin-bottom:20px; text-transform:uppercase; letter-spacing:.06em; }
.fp-contact-row { display:flex; flex-direction:column; gap:3px; padding:12px 0; border-bottom:1px solid #E8E8E4; }
.fp-contact-row:last-child { border-bottom:none; }
.fp-contact-label { font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; }
.fp-contact-val { font-size:15px; font-weight:600; color:#1A1A1A; }
.fp-contact-val a { color:#1A1A1A; }
.fp-contact-val a:hover { color:var(--taas-yellow,#FFC800); }

/* Buttons */
.fp-btn { display:inline-flex; align-items:center; gap:8px; font-weight:700; font-size:14px; letter-spacing:.04em; text-transform:uppercase; padding:14px 26px; border-radius:var(--taas-radius,6px); transition:all .18s; text-decoration:none; }

/* Contact Form 7 styling */
.fp-contact-card .wpcf7-form input[type="text"],
.fp-contact-card .wpcf7-form input[type="email"],
.fp-contact-card .wpcf7-form input[type="tel"],
.fp-contact-card .wpcf7-form select,
.fp-contact-card .wpcf7-form textarea {
  background:#F7F7F5!important; border:1px solid #E8E8E4!important; color:#1A1A1A!important;
  border-radius:6px!important; padding:12px 14px!important; font-size:15px!important;
  font-family:'Inter',Arial,sans-serif!important; width:100%!important; box-sizing:border-box!important;
  margin-top:4px!important;
}
.fp-contact-card .wpcf7-form textarea { min-height:100px!important; resize:vertical!important; }
.fp-contact-card .wpcf7-form input[type="submit"] {
  background:#FFC800!important; color:#1A1A1A!important; border:none!important;
  padding:14px 28px!important; font-size:15px!important; font-weight:700!important;
  width:100%!important; cursor:pointer!important; margin-top:4px!important;
  letter-spacing:.04em!important; text-transform:uppercase!important; border-radius:6px!important;
}
.fp-contact-card .wpcf7-form input[type="submit"]:hover { background:#e6b400!important; }
.fp-contact-card .wpcf7-form label { font-size:13px; font-weight:600; color:#666; text-transform:uppercase; letter-spacing:.04em; }
.fp-btn--primary { background:var(--taas-yellow,#FFC800); color:#1A1A1A !important; }
.fp-btn--primary:hover { background:#e6b400; transform:translateY(-1px); }
.fp-btn--outline { background:transparent; color:var(--taas-yellow,#FFC800) !important; border:2px solid var(--taas-yellow,#FFC800); }
.fp-btn--outline:hover { background:var(--taas-yellow,#FFC800); color:#1A1A1A !important; }
.fp-btn--dark { background:#1A1A1A; color:#fff !important; }
.fp-btn--dark:hover { background:#000; }
.fp-btn--yellow-dark { display:inline-block; background:var(--taas-yellow,#FFC800); color:#1A1A1A !important; font-weight:700; font-size:14px; letter-spacing:.04em; text-transform:uppercase; padding:14px 26px; text-decoration:none; }

/* CTA section */
.fp-cta { background:#1A1A1A; padding:72px 0; text-align:center; }
.fp-cta__h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:#fff; margin-bottom:12px; }
.fp-cta__h2 span { color:var(--taas-yellow,#FFC800); }
.fp-cta__sub { font-size:16px; color:#888; margin-bottom:32px; }
.fp-cta__phone { display:block; font-size:clamp(28px,4vw,44px); font-weight:900; color:var(--taas-yellow,#FFC800); text-decoration:none; letter-spacing:-.01em; margin-bottom:24px; transition:opacity .15s; }
.fp-cta__phone:hover { opacity:.7; }
.fp-cta__btns { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }

/* FAQ */
.fp-faq { background:#fff; padding:72px 0; }
.fp-faq__list { max-width:780px; margin:40px auto 0; }
.fp-faq__item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.fp-faq__item:first-child { border-top:1px solid var(--taas-border, #E8E8E4); }
.fp-faq__q { width:100%; background:none; border:none; text-align:left; padding:20px 40px 20px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-faq-q, 15px); font-weight:700; color:var(--taas-black, #111); cursor:pointer; position:relative; line-height:1.4; }
.fp-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:300; color:var(--taas-yellow, #FFC800); transition:transform .2s; }
.fp-faq__q[aria-expanded="true"]::after { content:'−'; }
.fp-faq__a { font-size:var(--taas-faq-a, 15px); color:var(--taas-mid, #666); line-height:1.75; padding:0 40px 20px 0; display:none; }
.fp-faq__item--open .fp-faq__a { display:block; }

/* Responsive */
@media(max-width:1024px){
  .fp-hero__inner { grid-template-columns:1fr; }
  .fp-hero__card { display:none; }
  .fp-services__grid { grid-template-columns:1fr; }
  .fp-faq__grid { grid-template-columns:1fr; }
}
@media(max-width:640px){
  /* Layout */
  .fp-steps { grid-template-columns:1fr; }
  .fp-step { border-right:none; }

  /* Section spacing */
  .fp-hero { padding:48px 0 40px; }
  .fp-how { padding:48px 0; }
  .fp-services { padding:48px 0; }
  .fp-cta { padding:48px 0; }
  .fp-faq { padding:48px 0; }

  /* Type scale */
  .fp-hero__h1 { font-size:clamp(24px, 7vw, 36px); }
  .fp-hero__sub { font-size:14px; margin-bottom:24px; }
  .fp-hero__btns { flex-direction:column; align-items:stretch; }
  .fp-hero__btns .fp-btn { justify-content:center; text-align:center; }
  .fp-btn { font-size:13px; padding:12px 20px; }
  .fp-sec-h2 { font-size:clamp(20px, 5vw, 28px); }
  .fp-body { font-size:14px; }
  .fp-step__num { font-size:24px; }
  .fp-step__text { font-size:13px; }
  .fp-step { padding:20px; }
  .fp-fact__val { font-size:24px; }
  .fp-fact__lbl { font-size:11px; }
  .fp-fact { padding:16px 20px; }
  .fp-checklist li { font-size:13px; }
  .fp-cta__h2 { font-size:clamp(22px, 6vw, 32px); }
  .fp-cta__sub { font-size:14px; }
  .fp-cta__phone { font-size:clamp(24px, 6vw, 36px); }
  .fp-cta__btns { flex-direction:column; align-items:stretch; }
  .fp-cta__btns .fp-btn { justify-content:center; text-align:center; }
  .fp-faq__q { font-size:14px; }
  .fp-faq__a { font-size:13px; }

  /* Trust strip */
  .fp-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .fp-trust__item { font-size:12px; }

  /* New sections — stack grids */
  div[style*="grid-template-columns:repeat(3"] { grid-template-columns:1fr!important; }
  div[style*="grid-template-columns:repeat(2"] { grid-template-columns:1fr!important; }
}
</style>

<!-- ══ BREADCRUMB ══════════════════════════════════════════════════════════ -->
<nav class="fp-bread" aria-label="Breadcrumb">
  <div class="fp-w">
    <a href="<?php echo esc_url($site_url); ?>">Home</a>
    <span>›</span>
    <a href="<?php echo esc_url($site_url . '/' . $hub_slug . '/'); ?>"><?php echo esc_html($hub_label); ?></a>
    <span>›</span>
    <span aria-current="page"><?php echo esc_html($provider_name); ?></span>
  </div>
</nav>

<!-- ══ HERO ══════════════════════════════════════════════════════════════════ -->
<section class="fp-hero" aria-labelledby="fp-h1">
  <div class="fp-hero__bg"></div>
  <div class="fp-w">
    <div class="fp-hero__inner">
      <div>
        <span class="fp-hero__eye">Finance Options · <?php echo esc_html($suburb_name); ?></span>
        <h1 class="fp-hero__h1" id="fp-h1">
          <?php echo esc_html($provider_name); ?> Car Repairs<br>
          <span><?php echo esc_html($suburb_name); ?></span>
        </h1>
        <p class="fp-hero__sub"><?php echo esc_html($provider_tagline); ?><?php if ($distance_text): ?> Our workshop is at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:underline;">139 Cavendish Drive, Manukau</a> — <?php echo esc_html($distance_text); ?>.<?php endif; ?></p>
        <div class="fp-hero__btns">
          <a href="<?php echo esc_url($cta_url); ?>" class="fp-btn fp-btn--primary" <?php echo (strpos($cta_url, 'http') === 0) ? 'target="_blank" rel="noopener"' : ''; ?>>
            <?php echo esc_html($cta_label); ?>
          </a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fp-btn fp-btn--outline">
            Call <?php echo esc_html($phone_free); ?>
          </a>
        </div>
      </div>

      <div class="fp-hero__card" aria-hidden="true">
        <div class="fp-hero__card-title">Accepted At TAAS For</div>
        <?php foreach (array_slice($services, 0, 6) as $svc): ?>
        <div class="fp-card-row">
          <div class="fp-card-tick">✓</div>
          <div class="fp-card-text"><?php echo esc_html($svc['label']); ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══ TRUST STRIP ══════════════════════════════════════════════════════════ -->
<div class="fp-trust" role="region" aria-label="Trust signals">
  <div class="fp-w">
    <div class="fp-trust__inner">
      <div class="fp-trust__item"><?php echo esc_html($provider_name); ?> accepted</div>
      <div class="fp-trust__item">MTA Assured workshop</div>
      <div class="fp-trust__item"><?php echo esc_html($years); ?> years in South Auckland</div>
      <?php if ($distance_text): ?>
      <div class="fp-trust__item"><?php echo esc_html($distance_text); ?></div>
      <?php else: ?>
      <div class="fp-trust__item">All services covered</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- ══ HOW IT WORKS ═════════════════════════════════════════════════════════ -->
<section class="fp-how" aria-labelledby="fp-how-head">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--yellow">How It Works</span>
    <h2 class="fp-sec-h2" id="fp-how-head">Paying with <?php echo esc_html($provider_name); ?> at TAAS</h2>
    <p class="fp-body"><?php echo esc_html($desc_1); ?></p>
    <?php if ($desc_2): ?><p class="fp-body"><?php echo esc_html($desc_2); ?></p><?php endif; ?>

    <?php if (!empty($facts)): ?>
    <div class="fp-facts">
      <?php foreach ($facts as $fact): ?>
      <div class="fp-fact">
        <div class="fp-fact__val"><?php echo esc_html($fact['val']); ?></div>
        <div class="fp-fact__lbl"><?php echo esc_html($fact['lbl']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="fp-steps" style="margin-top:48px;">
      <?php foreach ($steps as $i => $step): ?>
      <div class="fp-step">
        <div class="fp-step__num"><?php echo ($i + 1); ?></div>
        <div class="fp-step__text"><?php echo esc_html($step['step'] ?? $step); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ WHY TAAS ═════════════════════════════════════════════════════════════ -->
<section style="background:var(--taas-dark, #1A1A1A);padding:var(--taas-sec-pad, 72px) 0;" aria-labelledby="fp-why-head">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--yellow">Why Choose TAAS</span>
    <h2 class="fp-sec-h2" style="color:#fff;" id="fp-why-head"><?php echo esc_html($years); ?> Years. Same Family. Same Street.</h2>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:32px;">
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);padding:28px 24px;">
        <div style="font-size:15px;font-weight:700;color:#FFC800;margin-bottom:10px;">MTA Assured</div>
        <p style="font-size:14px;color:#999;line-height:1.65;">Motor Trade Association quality assurance programme. Independent auditing of workshop standards, training, and customer service.</p>
      </div>
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);padding:28px 24px;">
        <div style="font-size:15px;font-weight:700;color:#FFC800;margin-bottom:10px;">NZTA Authorised</div>
        <p style="font-size:14px;color:#999;line-height:1.65;">Authorised for Warrant of Fitness inspections. Station number <?php echo esc_html($ms_number); ?>. WOF from <?php echo defined('TAAS_WOF_PRICE') ? esc_html(TAAS_WOF_PRICE) : '$80'; ?>.</p>
      </div>
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);padding:28px 24px;">
        <div style="font-size:15px;font-weight:700;color:#FFC800;margin-bottom:10px;"><?php echo esc_html($division_count); ?> Divisions</div>
        <p style="font-size:14px;color:#999;line-height:1.65;"><?php echo esc_html(defined('TAAS_DIVISIONS') ? TAAS_DIVISIONS : 'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries'); ?> — all under one roof. One workshop, one invoice, one finance transaction.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ TYPICAL COSTS ═══════════════════════════════════════════════════════ -->
<section style="background:var(--taas-white, #fff);padding:var(--taas-sec-pad, 72px) 0;" aria-labelledby="fp-costs-head">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--yellow">Typical Repair Costs</span>
    <h2 class="fp-sec-h2" id="fp-costs-head">What can you use <?php echo esc_html($provider_name); ?> for?</h2>
    <p class="fp-body"><?php echo esc_html($provider_name); ?> is accepted across every service at Tony Allen Auto Service. Here are some common repairs and approximate costs to help you plan.</p>
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:16px;margin-top:28px;">
      <?php
      $wof_p       = defined('TAAS_WOF_PRICE')      ? TAAS_WOF_PRICE      : '$80';
      $svc_p       = defined('TAAS_SERVICE_PRICE')   ? TAAS_SERVICE_PRICE   : 'from $230';
      $brake_p     = defined('TAAS_BRAKE_PRICE')     ? TAAS_BRAKE_PRICE     : 'from $380';
      $cambelt_p   = defined('TAAS_CAMBELT_PRICE')   ? TAAS_CAMBELT_PRICE   : 'from $800';
      $clutch_p    = defined('TAAS_CLUTCH_PRICE')    ? TAAS_CLUTCH_PRICE    : 'from $800';
      $susp_p      = defined('TAAS_SUSPENSION_PRICE')? TAAS_SUSPENSION_PRICE: 'from $300';
      $elec_p      = defined('TAAS_AUTOELEC_DIAG')   ? TAAS_AUTOELEC_DIAG   : 'from $175';
      $aircon_p    = defined('TAAS_AIRCON_PRICE')    ? TAAS_AIRCON_PRICE    : 'from $280';
      $cost_examples = [
          ['service' => 'WOF inspection', 'range' => $wof_p],
          ['service' => 'Car service', 'range' => $svc_p],
          ['service' => 'Brake pads & machine rotors', 'range' => $brake_p],
          ['service' => 'Cambelt & water pump', 'range' => $cambelt_p],
          ['service' => 'Clutch replacement', 'range' => $clutch_p],
          ['service' => 'Steering & suspension', 'range' => $susp_p],
          ['service' => 'Auto electrical diagnosis', 'range' => $elec_p],
          ['service' => 'Air con gas & dye', 'range' => $aircon_p],
      ];
      foreach ($cost_examples as $ex): ?>
      <div style="display:flex;justify-content:space-between;padding:14px 18px;background:#F7F7F5;border-left:3px solid #FFC800;">
        <span style="font-size:14px;color:#333;font-weight:500;"><?php echo esc_html($ex['service']); ?></span>
        <span style="font-size:14px;color:#1A1A1A;font-weight:700;"><?php echo esc_html($ex['range']); ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="font-size:12px;color:#666;margin-top:16px;">Indicative only. Actual costs depend on vehicle make, model, and condition. We provide a written estimate before any work begins.</p>
  </div>
</section>

<!-- ══ SERVICES ═════════════════════════════════════════════════════════════ -->
<section class="fp-services" aria-labelledby="fp-services-head">
  <div class="fp-w">
    <div class="fp-services__grid">
      <div>
        <span class="fp-sec-eye fp-sec-eye--yellow">Accepted For</span>
        <h2 class="fp-sec-h2" id="fp-services-head"><?php echo esc_html($provider_name); ?> works across all TAAS services</h2>
        <p class="fp-body">WOF, servicing, brakes, engine work — use <?php echo esc_html($provider_name); ?> to spread the cost of any repair.</p>
        <ul class="fp-checklist" style="margin-top:20px;">
          <?php foreach ($services as $svc): ?>
          <li><a href="<?php echo esc_url($site_url . $svc['url']); ?>"><?php echo esc_html($svc['label']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="fp-contact-card">
        <h3>Book or Enquire</h3>
        <?php if ($cf7_finance): ?>
          <?php echo do_shortcode($cf7_finance); ?>
        <?php else: ?>
        <div class="fp-contact-row">
          <span class="fp-contact-label">Address</span>
          <span class="fp-contact-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener"><?php echo esc_html($address); ?></a></span>
        </div>
        <div class="fp-contact-row">
          <span class="fp-contact-label">Phone</span>
          <span class="fp-contact-val">
            <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a>
            &nbsp;·&nbsp;
            <a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a>
          </span>
        </div>
        <div class="fp-contact-row">
          <span class="fp-contact-label">Email</span>
          <span class="fp-contact-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
        </div>
        <div class="fp-contact-row">
          <span class="fp-contact-label">Hours</span>
          <span class="fp-contact-val"><?php echo esc_html($hours); ?></span>
        </div>
        <div style="margin-top:20px;display:flex;flex-direction:column;gap:10px;">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fp-btn fp-btn--primary" style="justify-content:center;">Call <?php echo esc_html($phone_free); ?></a>
          <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="fp-btn fp-btn--dark" style="justify-content:center;">Send Enquiry</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($is_location_page): ?>
<!-- ══ LOCATION ═════════════════════════════════════════════════════════════ -->
<section class="fp-how" style="border-top:1px solid var(--taas-border, #E8E8E4);" aria-labelledby="fp-location-head">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--yellow"><?php echo esc_html($suburb_name); ?></span>
    <h2 class="fp-sec-h2" id="fp-location-head"><?php echo esc_html($provider_name); ?> Mechanic Near <?php echo esc_html($suburb_name); ?></h2>
    <p class="fp-body">Tony Allen Auto Service is at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;font-weight:600;">139 Cavendish Drive, Manukau</a><?php echo $distance_text ? ' — ' . esc_html($distance_text) : ''; ?>. We have been serving <?php echo esc_html($suburb_name); ?> and surrounding South Auckland suburbs since <?php echo esc_html($established); ?>. MTA Assured, NZTA Authorised, and accepting <?php echo esc_html($provider_name); ?> across every service.</p>
    <p class="fp-body">Whether your vehicle needs a WOF, a routine service, or a larger repair like a cambelt or clutch replacement — you can use <?php echo esc_html($provider_name); ?> to spread the cost. We provide a clear written estimate before any work begins. No pressure, no surprises.</p>

    <?php if (!empty($area_served)): ?>
    <div style="margin-top:28px;">
      <h3 style="font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#999;margin-bottom:14px;">Also serving</h3>
      <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <?php foreach ($area_served as $area): ?>
        <span style="background:#F7F7F5;border:1px solid #E8E8E4;padding:6px 14px;font-size:13px;font-weight:600;color:#333;"><?php echo esc_html($area); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php if ($reviews_widget): ?>
<!-- ══ REVIEWS ══════════════════════════════════════════════════════════════ -->
<section class="fp-how" aria-label="Customer reviews">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--yellow">Google Reviews</span>
    <h2 class="fp-sec-h2">What our customers say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>
<?php endif; ?>

<!-- ══ COMPARE OPTIONS ══════════════════════════════════════════════════════ -->
<section class="fp-services" style="padding:var(--taas-sec-pad-m, 48px) 0;text-align:center;" aria-label="Compare finance options">
  <div class="fp-w" style="max-width:720px;">
    <span class="fp-sec-eye fp-sec-eye--dark">Not Sure?</span>
    <h2 class="fp-sec-h2">Compare all four finance options</h2>
    <p class="fp-body" style="text-align:center;">We offer Afterpay, Q Card, Gem Finance, and Aotea Finance. Each works differently — see them side by side to find the right fit for your repair.</p>
    <a href="<?php echo esc_url($site_url . '/' . $hub_slug . '/'); ?>" class="fp-btn fp-btn--primary" style="margin-top:12px;">Compare All Options</a>
  </div>
</section>

<!-- ══ CTA ══════════════════════════════════════════════════════════════════ -->
<section class="fp-cta" aria-label="Book now">
  <div class="fp-w">
    <h2 class="fp-cta__h2">Ready to pay with <span><?php echo esc_html($provider_name); ?>?</span><?php if ($is_location_page): ?><br><?php echo esc_html($suburb_name); ?> drivers — we're nearby.<?php endif; ?></h2>
    <p class="fp-cta__sub"><?php echo esc_html($hours); ?> · <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#999;text-decoration:underline;">139 Cavendish Drive, Manukau</a></p>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fp-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="fp-cta__btns">
      <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="fp-btn fp-btn--primary">Send Enquiry</a>
      <a href="<?php echo esc_url($site_url . '/' . $hub_slug . '/'); ?>" class="fp-btn fp-btn--outline">All Finance Options</a>
    </div>
  </div>
</section>

<!-- ══ FAQ ══════════════════════════════════════════════════════════════════ -->
<section class="fp-faq" aria-labelledby="fp-faq-head">
  <div class="fp-w">
    <span class="fp-sec-eye fp-sec-eye--dark">Common Questions</span>
    <h2 class="fp-sec-h2" id="fp-faq-head"><?php echo esc_html($provider_name); ?> Questions Answered</h2>
    <div class="fp-faq__list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'fp-faq-q-' . $fi;
        $aid = 'fp-faq-a-' . $fi;
      ?>
      <div class="fp-faq__item">
        <button class="fp-faq__q" aria-expanded="false" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div class="fp-faq__a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>">
          <?php echo wp_kses_post($faq['a']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.fp-faq__q').forEach(function(btn) {
  btn.addEventListener('click', function() {
    var item = this.closest('.fp-faq__item');
    var isOpen = item.classList.contains('fp-faq__item--open');
    document.querySelectorAll('.fp-faq__item--open').forEach(function(el) {
      el.classList.remove('fp-faq__item--open');
      el.querySelector('.fp-faq__q').setAttribute('aria-expanded', 'false');
    });
    if (!isOpen) {
      item.classList.add('fp-faq__item--open');
      this.setAttribute('aria-expanded', 'true');
    }
  });
});
</script>

<?php get_footer(); ?>
