<?php
/**
 * Template Name: MBI Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /mechanical-breakdown-insurance/
 * Go-Live Standard: 21 June 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. WP Admin → Pages → Mechanical Breakdown Insurance → Template → "MBI Hub"
 * 3. Purge Cloudflare cache
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

// ── Hero image ───────────────────────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_MBI') && TAAS_HERO_MBI
    ? esc_url(get_site_url() . TAAS_HERO_MBI)
    : esc_url(get_site_url() . '/wp-content/uploads/2026/06/hero-mbi.webp');

// ── MBI Providers ────────────────────────────────────────────────────────────
$providers = [
    [
        'id'       => 'autosure',
        'name'     => 'Autosure',
        'slug'     => 'autosure-warranty-repairs-manukau',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/mbi-logo-autosure-1.png',
        'since'    => '50+ years',
        'badge'    => 'NZ Owned',
        'featured' => true,
        'tagline'  => 'NZ\'s Leading MBI Provider — 50+ Years',
        'about'    => 'Autosure is one of New Zealand\'s most recognised MBI providers, operating for over 50 years with a network of more than 700 authorised repairers nationwide. Policies are underwritten by Autosure Insurance Limited, which holds a B++ (Good) financial strength rating from A.M. Best.',
        'cover'    => 'Two tiers — Extreme Plus and Essential. Extreme Plus covers engine, transmission, turbo, fuel system, electrical, clutch, differential, suspension, steering, air conditioning and cooling. Vehicles up to 20 years old and 200,000 km. Includes unlimited AA Roadservice for the life of the policy.',
        'claim'    => 'Call Autosure before any repairs start. They locate your nearest authorised repairer and authorise the work. Servicing records must be current — keep all receipts.',
        'claims_ph'=> '0800 809 700',
        'website'  => 'https://autosure.co.nz',
        'facts'    => [
            ['val' => '50+',  'lbl' => 'Years operating'],
            ['val' => '700+', 'lbl' => 'Authorised repairers NZ'],
            ['val' => 'B++',  'lbl' => 'A.M. Best rating'],
        ],
    ],
    [
        'id'       => 'assurant',
        'name'     => 'Assurant',
        'slug'     => 'assurant-warranty-repairs-manukau',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/mbi-logo-assurant-1.png',
        'since'    => 'Formerly Protecta',
        'badge'    => 'Formerly Protecta',
        'featured' => false,
        'tagline'  => '35+ Years — Formerly Protecta Insurance',
        'about'    => 'Assurant (formerly Protecta Insurance) completed its rebrand in December 2024 following Assurant Inc\'s acquisition of Protecta in 2022. The same NZ team, same policies, same service — now under the global Assurant brand. Policies are issued by Protecta Insurance NZ Ltd as agent for Virginia Surety Company Inc (A+ financial strength rating from A.M. Best).',
        'cover'    => 'Three tiers — Optimum, Maxi, and Kinetic. All tiers cover major mechanical, electrical, and electronic components including labour. Vehicles up to 15 years old or 250,000 km. Includes towing, rental car allowance, roadside assistance, and travel costs for breakdowns over 100 km from home.',
        'claim'    => 'Contact Assurant before authorising any repairs. Servicing must follow your Vehicle Service Programme and be carried out by a registered MTA workshop. Claims team available to guide the process.',
        'claims_ph'=> '0800 776 832',
        'website'  => 'https://www.assurant.nz',
        'facts'    => [
            ['val' => '35+', 'lbl' => 'Years in NZ market'],
            ['val' => 'A+',  'lbl' => 'A.M. Best rating (VSC)'],
            ['val' => '3',   'lbl' => 'Cover tiers available'],
        ],
    ],
    [
        'id'       => 'provident',
        'name'     => 'Provident Insurance',
        'slug'     => 'provident-warranty-repairs-manukau',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/mbi-logo-provident-1.png',
        'since'    => '100% NZ Owned',
        'badge'    => '100% NZ Owned',
        'featured' => false,
        'tagline'  => '100% New Zealand Owned — 30+ Years',
        'about'    => 'Provident Insurance Corporation Limited is a 100% New Zealand owned motor insurance specialist with over 30 years of operation. They hold a B+ (Good) financial strength rating from A.M. Best. Policies are available exclusively through Provident Authorised motor vehicle traders.',
        'cover'    => 'Cover for 1, 2, or 3 years with a range of excess options. Covers sudden or unforeseen mechanical and electrical failure of major components including engine, transmission, brakes, suspension, air conditioning, and more. Includes full NZ roadside assistance (towing, lost keys, flat tyre, flat battery). EV Shield and Hybrid Shield policies available for electric and hybrid vehicles.',
        'claim'    => 'Call Provident Claims on 0800 676 864 (24/7). They identify the nearest authorised repair facility and authorise the work. Present your policy booklet to the repairer on arrival.',
        'claims_ph'=> '0800 676 864',
        'website'  => 'https://www.providentinsurance.co.nz',
        'facts'    => [
            ['val' => '30+',  'lbl' => 'Years operating'],
            ['val' => 'B+',   'lbl' => 'A.M. Best rating'],
            ['val' => '24/7', 'lbl' => 'Roadside assistance'],
        ],
    ],
    [
        'id'       => 'janssen',
        'name'     => 'Janssen Insurance',
        'slug'     => 'janssen-warranty-repairs-manukau',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/mbi-logo-janssen-1.png',
        'since'    => '25+ years',
        'badge'    => 'EV & Hybrid Specialist',
        'featured' => false,
        'tagline'  => '25+ Years — Single Excess Per Claim',
        'about'    => 'Janssen Insurance has been providing MBI in New Zealand for over 25 years. All products are underwritten by Quest Insurance, a licensed insurer regulated by the RBNZ. A key differentiator: only one excess applies per claim event, even if multiple components require repair simultaneously.',
        'cover'    => 'Multiple tiers including Elite Cover (up to $10,000 claim entitlement) and Elite Cover Plus. Includes unlimited roadside assistance callouts with no dollar limit, $2,000 customer care package for hire car and accommodation during repairs, and free policy transfer when selling your vehicle. Elite Eco Cover for hybrid and EV vehicles covers traction battery and EV-specific components.',
        'claim'    => 'Call Janssen on 0800 526 7736 (0800 JANSSEN) before any work begins. Do not authorise repairs without prior approval. Service invoices must be provided before a claim proceeds.',
        'claims_ph'=> '0800 526 7736',
        'website'  => 'https://www.jansseninsurance.co.nz',
        'facts'    => [
            ['val' => '25+',  'lbl' => 'Years operating'],
            ['val' => '1',    'lbl' => 'Excess per claim event'],
            ['val' => '$10k', 'lbl' => 'Max claim entitlement'],
        ],
    ],
    [
        'id'       => 'autolife',
        'name'     => 'Autolife',
        'slug'     => 'autolife-warranty-repairs-manukau',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/mbi-logo-autolife-1.png',
        'since'    => 'Subsidiary of Beneficial Insurance',
        'badge'    => '96.5% Claims Paid in 14 Days',
        'featured' => false,
        'tagline'  => 'Fast Claims — 96.5% Paid Within 14 Days',
        'about'    => 'Autolife is a fully owned subsidiary of Beneficial Insurance Limited, a licensed NZ insurer. Their standout claim is speed: 96.5% of claim payments are made within 14 days, and 99.5% within 21 days. Policies are available directly online — no dealer required. Vehicles must be NZ registered, post-2000, and under 200,000 km.',
        'cover'    => 'Standard cover of $4,000–$5,000 per claim (depending on odometer). Covers engine, transmission, electrical systems, steering, suspension, air conditioning, fuel system and more. Includes 24/7 roadside assistance with towing to any licensed MTA mechanic at no additional cost, and rental car allowance for up to 5 days. 7-day free look period on new policies.',
        'claim'    => 'Call Autolife on 0800 288 654 before authorising any repairs. Complete the online claim form with service records. The repairer contacts Autolife for authorisation, you pay the excess to the garage, and Autolife pays the balance directly.',
        'claims_ph'=> '0800 288 654',
        'website'  => 'https://autolife.co.nz',
        'facts'    => [
            ['val' => '96.5%', 'lbl' => 'Claims paid within 14 days'],
            ['val' => '200k',  'lbl' => 'Max km at policy start'],
            ['val' => '7 day', 'lbl' => 'Free look period'],
        ],
    ],
];

// ── FAQs from shared library ─────────────────────────────────────────────────
$faqs = [
    $taas_faqs['mbi_what_is'],
    $taas_faqs['mbi_all_providers'],
    $taas_faqs['mbi_breakdown_steps'],
    $taas_faqs['mbi_servicing_valid'],
    $taas_faqs['mbi_claim_help'],
    $taas_faqs['mbi_vs_warranty'],
    $taas_faqs['mbi_exclusions'],
    $taas_faqs['mbi_service_at_taas'],
    $taas_faqs['mbi_european'],
    $taas_faqs['mbi_cost'],
];

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
            '@type'       => ['AutoRepair', 'LocalBusiness'],
            '@id'         => $site_url . '/#organization',
            'name'        => 'Tony Allen Auto Service',
            'url'         => $site_url,
            'telephone'   => [$phone_local, $phone_free],
            'email'       => $email,
            'foundingDate'=> '1985-10',
            'description' => 'NZTA Authorised (' . $ms_number . '). MBI approved repairer for Autosure, Assurant, Provident, Janssen and Autolife. MTA Assured. Family-owned since 1985.',
            'address'     => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
            'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'],
            'sameAs'      => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
            'memberOf'    => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Mechanical Breakdown Insurance', 'item' => $page_url],
        ]],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-mbi">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════════ */
.page-template-template-mbi .site-content,
.page-template-template-mbi .entry-content,
.page-template-template-mbi .entry-header,
.page-template-template-mbi article,
.page-template-template-mbi #primary,
.page-template-template-mbi #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-mbi *, .taas-mbi *::before, .taas-mbi *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-mbi { font-family:var(--taas-font, 'Inter', Arial, sans-serif); color:#333; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }
.taas-mbi a { text-decoration:none; }
.mbi-w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ══════════════════════════════════════════════════════════════ */
.mbi-breadcrumb { background:#1A1A1A; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.mbi-breadcrumb__inner { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:400; color:#666; }
.mbi-breadcrumb__inner a { color:#888; transition:color .15s; }
.mbi-breadcrumb__inner a:hover { color:var(--taas-yellow, #FFC800); }
.mbi-breadcrumb__sep { color:#444; }

/* ══ HERO ═════════════════════════════════════════════════════════════════════ */
.mbi-hero {
  background:var(--taas-black, #111111);
  padding:var(--taas-sec-pad, 72px) 0 60px;
  position:relative;
}
.mbi-hero__bg {
  position:absolute; inset:0; z-index:0;
  background:url('<?php echo $hero_img; ?>') center 40% / cover no-repeat;
}
.mbi-hero__bg::after {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,0.82);
}
.mbi-hero > .mbi-w { position:relative; z-index:1; }
.mbi-hero__inner { display:grid; grid-template-columns:1fr 300px; gap:56px; align-items:center; }
.mbi-hero__eye {
  display:inline-block; margin-bottom:20px;
  background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A);
  font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; padding:4px 12px; border-radius:3px;
}
.mbi-hero__h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight:800;
  color:#fff; letter-spacing:-0.02em;
  line-height:1.1; margin-bottom:20px;
}
.mbi-hero__h1 em { color:var(--taas-yellow, #FFC800); font-style:normal; }
.mbi-hero__sub { font-size:16px; font-weight:300; color:#999; line-height:1.75; max-width:520px; margin-bottom:32px; }
.mbi-hero__ctas { display:flex; gap:14px; flex-wrap:wrap; }
.mbi-hero__providers { display:flex; flex-wrap:wrap; gap:8px; margin-top:24px; }
.mbi-hero__pill { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); color:#aaa; font-size:12px; font-weight:600; padding:5px 14px; transition:background .15s, color .15s, border-color .15s; }
.mbi-hero__pill:hover { background:rgba(255,200,0,.12); border-color:var(--taas-yellow, #FFC800); color:var(--taas-yellow, #FFC800); }

/* Hero card */
.mbi-hero__card { background:rgba(255,200,0,.05); border:1px solid rgba(255,200,0,.2); border-top:3px solid var(--taas-yellow, #FFC800); padding:24px 20px; }
.mbi-hero__card-title { font-size:10px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:var(--taas-yellow, #FFC800); margin-bottom:16px; }
.mbi-card-row { display:flex; align-items:flex-start; gap:12px; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.mbi-card-row:last-child { border-bottom:none; padding-bottom:0; }
.mbi-card-tick { width:20px; height:20px; flex-shrink:0; margin-top:1px; display:flex; align-items:center; justify-content:center; }
.mbi-card-text { font-size:13px; font-weight:300; color:#ccc; line-height:1.75; }
.mbi-card-text strong { color:#fff; display:block; font-size:14px; font-weight:600; }

/* Buttons */
.mbi-btn {
  display:inline-flex; align-items:center; gap:8px;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-weight:700; font-size:14px;
  letter-spacing:.04em; text-transform:uppercase;
  padding:14px 26px; border-radius:var(--taas-radius, 6px); transition:all .18s;
}
.mbi-btn--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; }
.mbi-btn--yellow:hover { background:var(--taas-yellow2, #e6b400); transform:translateY(-1px); }
.mbi-btn--dark { background:var(--taas-dark, #1A1A1A); color:#fff!important; }
.mbi-btn--dark:hover { background:#000; transform:translateY(-1px); }
.mbi-btn--outline { background:transparent; color:var(--taas-yellow, #FFC800)!important; border:2px solid var(--taas-yellow, #FFC800); }
.mbi-btn--outline:hover { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; }
.mbi-btn--sm { padding:10px 18px; font-size:12px; }
.mbi-btn--ext::after { content:' ↗'; font-size:11px; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════════ */
.mbi-phone-strip { background:var(--taas-yellow, #FFC800); padding:14px 0; }
.mbi-phone-strip__inner { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.mbi-phone-strip__number { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:28px; font-weight:900; color:var(--taas-dark, #1A1A1A); letter-spacing:-0.01em; }
.mbi-phone-strip__number a { color:inherit; }
.mbi-phone-strip__number a:hover { opacity:0.65; }
.mbi-phone-strip__right { display:flex; align-items:center; gap:20px; }
.mbi-phone-strip__hours { font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); }
.mbi-phone-strip__email { display:inline-block; background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); font-size:12px; font-weight:700; letter-spacing:.04em; padding:6px 14px; border-radius:3px; transition:opacity .15s; }
.mbi-phone-strip__email:hover { opacity:.85; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════════ */
.mbi-trust { background:var(--taas-panel, #F7F7F5); padding:18px 0; border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mbi-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.mbi-trust__item { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); white-space:nowrap; }
.mbi-trust__item::before { content:'✓'; font-weight:900; color:var(--taas-yellow, #FFC800); }

/* ══ SECTION SHARED ══════════════════════════════════════════════════════════ */
.mbi-sec-eye { display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.mbi-sec-eye--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); }
.mbi-sec-eye--dark { background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); }
.mbi-sec-h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700;
  color:var(--taas-black, #111111); letter-spacing:-0.01em; margin-bottom:12px;
}
.mbi-sec-h2--white { color:#fff; }
.mbi-body { font-size:16px; font-weight:300; color:#555; line-height:1.75; margin-bottom:16px; }
.mbi-body:last-child { margin-bottom:0; }

/* ══ WHAT IS MBI ═════════════════════════════════════════════════════════════ */
.mbi-what { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mbi-what__inner { display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:start; }
.mbi-cover-grid { display:grid; grid-template-columns:1fr 1fr; gap:3px; margin-top:8px; }
.mbi-cover-col { padding:20px; }
.mbi-cover-col--yes { background:var(--taas-panel, #F7F7F5); border-top:3px solid var(--taas-yellow, #FFC800); }
.mbi-cover-col--no  { background:var(--taas-panel, #F7F7F5); border-top:3px solid var(--taas-border, #E8E8E4); }
.mbi-cover-col__head { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:16px; font-weight:900; text-transform:uppercase; letter-spacing:.06em; margin-bottom:12px; }
.mbi-cover-col--yes .mbi-cover-col__head { color:var(--taas-dark, #1A1A1A); }
.mbi-cover-col--no  .mbi-cover-col__head { color:#999; }
.mbi-cover-item { display:flex; align-items:flex-start; gap:8px; font-size:14px; font-weight:300; color:#555; line-height:1.75; padding:5px 0; }
.mbi-cover-item::before { flex-shrink:0; margin-top:1px; font-size:12px; font-weight:900; }
.mbi-cover-col--yes .mbi-cover-item::before { content:'✓'; color:var(--taas-yellow, #FFC800); }
.mbi-cover-col--no  .mbi-cover-item::before { content:'✕'; color:#ccc; }

/* ══ PROVIDER CARDS ══════════════════════════════════════════════════════════ */
.mbi-providers { background:var(--taas-panel, #F7F7F5); padding:var(--taas-sec-pad, 72px) 0; }
.mbi-providers__grid { display:flex; flex-direction:column; gap:20px; margin-top:40px; }
.mbi-pcard {
  background:#fff; border:1px solid var(--taas-border, #E8E8E4);
  border-left:4px solid var(--taas-border, #E8E8E4);
  display:grid; grid-template-columns:200px 1fr auto;
  transition:border-color .2s;
}
.mbi-pcard--featured { border-left-color:var(--taas-yellow, #FFC800); }
.mbi-pcard:hover { border-left-color:var(--taas-yellow, #FFC800); }
.mbi-pcard__logo {
  background:var(--taas-panel, #F7F7F5); border-right:1px solid var(--taas-border, #E8E8E4);
  padding:24px 16px;
  display:flex; flex-direction:column;
  align-items:center; justify-content:center; gap:12px; text-align:center;
}
.mbi-pcard__logo-img { max-width:160px; max-height:56px; width:auto; height:auto; object-fit:contain; display:block; }
.mbi-pcard__name { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:20px; font-weight:900; color:#0D0D0D; text-transform:uppercase; }
.mbi-pcard__badge { display:inline-block; font-size:10px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); padding:2px 8px; }
.mbi-pcard__since { font-size:11px; color:#999; }
.mbi-pcard__body { padding:24px 28px; }
.mbi-pcard__tagline { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:18px; font-weight:900; color:#0D0D0D; text-transform:uppercase; margin-bottom:10px; }
.mbi-pcard__about { font-size:14px; font-weight:300; color:#666; line-height:1.75; margin-bottom:12px; }
.mbi-pcard__detail { margin-bottom:14px; }
.mbi-pcard__detail-head { font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--taas-dark, #1A1A1A); margin-bottom:4px; padding-left:8px; border-left:3px solid var(--taas-yellow, #FFC800); }
.mbi-pcard__detail-text { font-size:13px; font-weight:300; color:#555; line-height:1.75; }
.mbi-pcard__facts { display:flex; gap:20px; padding-top:14px; border-top:1px solid var(--taas-border, #E8E8E4); flex-wrap:wrap; }
.mbi-fact__val { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:24px; font-weight:900; color:var(--taas-dark, #1A1A1A); line-height:1; }
.mbi-fact__lbl { font-size:11px; color:#999; font-weight:600; letter-spacing:.06em; text-transform:uppercase; }
.mbi-pcard__cta {
  border-left:1px solid var(--taas-border, #E8E8E4); padding:24px 20px;
  display:flex; flex-direction:column;
  gap:10px; justify-content:center; min-width:160px;
}
.mbi-pcard__claims { font-size:12px; color:#999; text-align:center; line-height:1.75; }
.mbi-pcard__claims strong { display:block; color:#333; font-size:13px; }

/* ══ HOW IT WORKS ════════════════════════════════════════════════════════════ */
.mbi-how { background:var(--taas-dark, #1A1A1A); padding:var(--taas-sec-pad, 72px) 0; }
.mbi-steps { display:grid; grid-template-columns:repeat(4,1fr); gap:0; margin-top:40px; }
.mbi-step { padding:28px 24px; border-right:1px solid rgba(255,255,255,.08); }
.mbi-step:last-child { border-right:none; }
.mbi-step__num { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:48px; font-weight:900; color:rgba(255,200,0,.2); line-height:1; margin-bottom:12px; }
.mbi-step__title { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:18px; font-weight:900; color:#fff; text-transform:uppercase; border-top:3px solid var(--taas-yellow, #FFC800); padding-top:12px; margin-bottom:8px; }
.mbi-step__text { font-size:14px; font-weight:300; color:#888; line-height:1.75; }
.mbi-step__text a { color:var(--taas-yellow, #FFC800); }

/* ══ FINANCE STRIP ═══════════════════════════════════════════════════════════ */
.mbi-finance { background:var(--taas-panel, #F7F7F5); padding:24px 0; border-top:1px solid var(--taas-border, #E8E8E4); border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mbi-finance__inner { display:flex; align-items:center; justify-content:center; gap:24px; flex-wrap:wrap; text-align:center; }
.mbi-finance__text { font-size:14px; font-weight:300; color:#555; line-height:1.75; }
.mbi-finance__text a { color:var(--taas-dark, #1A1A1A); font-weight:600; text-decoration:underline; text-decoration-color:var(--taas-yellow, #FFC800); text-decoration-thickness:2px; text-underline-offset:3px; }
.mbi-finance__badges { display:flex; gap:12px; flex-wrap:wrap; align-items:center; }
.mbi-finance__badge { font-size:12px; font-weight:700; color:var(--taas-dark, #1A1A1A); background:#fff; border:1px solid var(--taas-border, #E8E8E4); padding:4px 12px; border-radius:3px; white-space:nowrap; }

/* ══ WHY TAAS ════════════════════════════════════════════════════════════════ */
.mbi-why { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mbi-checklist { list-style:none; display:flex; flex-direction:column; gap:14px; margin-top:8px; }
.mbi-checklist li { display:flex; align-items:flex-start; gap:12px; font-size:15px; font-weight:300; color:#333; line-height:1.75; }
.mbi-checklist li::before { content:''; width:22px; height:22px; flex-shrink:0; margin-top:1px; background:var(--taas-yellow, #FFC800) url("data:image/svg+xml,%3Csvg viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 11l5 5 7-7' stroke='%231A1A1A' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/contain no-repeat; border-radius:3px; }

/* ══ DARK ENQUIRY ════════════════════════════════════════════════════════════ */
.mbi-enquiry { background:var(--taas-black, #111111); padding:var(--taas-sec-pad, 72px) 0; }
.mbi-enquiry__inner { display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:start; }
.mbi-enquiry__h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:#fff; margin-bottom:16px; }
.mbi-enquiry__sub { font-size:16px; font-weight:300; color:#888; line-height:1.75; margin-bottom:24px; }
.mbi-enquiry__phone { display:block; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:32px; font-weight:900; color:var(--taas-yellow, #FFC800); margin-bottom:20px; }
.mbi-enquiry__phone:hover { opacity:.7; }
.mbi-enquiry__detail { font-size:14px; font-weight:300; color:#888; line-height:1.75; margin-bottom:6px; }
.mbi-enquiry__detail a { color:#aaa; }
.mbi-enquiry__detail a:hover { color:var(--taas-yellow, #FFC800); }
.mbi-enquiry__drumbeat { font-size:13px; font-weight:600; color:var(--taas-yellow, #FFC800); margin-top:20px; letter-spacing:.02em; }
.mbi-enquiry__finance { margin-top:20px; display:flex; gap:10px; flex-wrap:wrap; }
.mbi-enquiry__finance-badge { font-size:11px; font-weight:700; color:#aaa; background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); padding:4px 10px; border-radius:3px; }

/* CF7 dark styling */
.mbi-enquiry .wpcf7-form input[type="text"],
.mbi-enquiry .wpcf7-form input[type="email"],
.mbi-enquiry .wpcf7-form input[type="tel"],
.mbi-enquiry .wpcf7-form select,
.mbi-enquiry .wpcf7-form textarea {
  background:#1c1c1c!important; border:1px solid #333!important; color:#fff!important;
  border-radius:var(--taas-radius, 6px)!important; padding:12px 14px!important; font-size:15px!important;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important; font-weight:300!important;
  width:100%!important; box-sizing:border-box!important;
  margin-top:4px!important; transition:border-color .15s!important;
}
.mbi-enquiry .wpcf7-form input:focus,
.mbi-enquiry .wpcf7-form textarea:focus { border-color:var(--taas-yellow, #FFC800)!important; outline:none!important; }
.mbi-enquiry .wpcf7-form textarea { min-height:100px!important; resize:vertical!important; }
.mbi-enquiry .wpcf7-form label { font-size:11px!important; font-weight:700!important; letter-spacing:.08em!important; text-transform:uppercase!important; color:#888!important; display:block!important; }
.mbi-enquiry .wpcf7-form input[type="submit"] {
  background:var(--taas-yellow, #FFC800)!important; color:var(--taas-dark, #1A1A1A)!important; border:none!important;
  padding:14px 28px!important; font-size:14px!important; font-weight:700!important;
  width:100%!important; cursor:pointer!important; margin-top:4px!important;
  letter-spacing:.04em!important; text-transform:uppercase!important; border-radius:var(--taas-radius, 6px)!important;
  transition:background .15s!important;
}
.mbi-enquiry .wpcf7-form input[type="submit"]:hover { background:var(--taas-yellow2, #e6b400)!important; }

/* ══ REVIEWS ═════════════════════════════════════════════════════════════════ */
.mbi-reviews { background:var(--taas-panel, #F7F7F5); padding:var(--taas-sec-pad, 72px) 0; }

/* ══ RELATED ═════════════════════════════════════════════════════════════════ */
.mbi-related { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mbi-related__grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:20px; margin-top:32px; }
.mbi-related__card { background:var(--taas-panel, #F7F7F5); border:1px solid var(--taas-border, #E8E8E4); padding:24px; transition:border-color .15s; display:block; }
.mbi-related__card:hover { border-color:var(--taas-yellow, #FFC800); }
.mbi-related__card-title { font-size:16px; font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px; }
.mbi-related__card-text { font-size:14px; font-weight:300; color:#666; line-height:1.75; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════════ */
.mbi-faq { background:#fff; padding:var(--taas-sec-pad, 72px) 0; }
.mbi-faq__list { max-width:780px; margin:40px auto 0; }
.mbi-faq__item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.mbi-faq__item:first-child { border-top:1px solid var(--taas-border, #E8E8E4); }
.mbi-faq__q {
  width:100%; background:none; border:none; text-align:left; cursor:pointer;
  padding:20px 40px 20px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:15px; font-weight:700; color:var(--taas-black, #111);
  position:relative; line-height:1.4;
}
.mbi-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:300; color:var(--taas-yellow, #FFC800); transition:transform .2s; }
.mbi-faq__q[aria-expanded="true"]::after { content:'−'; }
.mbi-faq__a { display:none; padding:0 40px 20px 0; font-size:15px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .mbi-hero__inner, .mbi-what__inner, .mbi-enquiry__inner { grid-template-columns:1fr; gap:40px; }
  .mbi-hero__card { display:none; }
  .mbi-pcard { grid-template-columns:minmax(0,1fr); }
  .mbi-pcard > * { min-width:0; }
  .mbi-pcard__logo { flex-wrap:wrap; row-gap:8px; }
  .mbi-pcard__logo { flex-direction:row; padding:16px 20px; border-right:none; border-bottom:1px solid var(--taas-border, #E8E8E4); justify-content:flex-start; }
  .mbi-pcard__cta { border-left:none; border-top:1px solid var(--taas-border, #E8E8E4); flex-direction:row; flex-wrap:wrap; padding:16px 20px; }
  .mbi-steps { grid-template-columns:1fr 1fr; }
  .mbi-cover-grid { grid-template-columns:1fr; }
  .mbi-related__grid { grid-template-columns:1fr; }
}
@media (max-width:640px) {
  /* Layout */
  .mbi-steps { grid-template-columns:1fr; }
  .mbi-step { border-right:none; border-bottom:1px solid rgba(255,255,255,.08); }
  .mbi-hero__ctas { flex-direction:column; align-items:stretch; }
  .mbi-hero__ctas .mbi-btn { justify-content:center; text-align:center; }
  .mbi-enquiry__inner { flex-direction:column-reverse; }

  /* Section spacing */
  .mbi-hero { padding:48px 0 40px; }
  .mbi-what, .mbi-providers, .mbi-how, .mbi-why, .mbi-enquiry, .mbi-reviews, .mbi-related, .mbi-faq { padding:48px 0; }

  /* Type scale */
  .mbi-hero__h1 { font-size:clamp(26px, 7vw, 38px); }
  .mbi-hero__sub { font-size:14px; margin-bottom:24px; }
  .mbi-btn { font-size:13px; padding:12px 20px; }
  .mbi-sec-h2 { font-size:clamp(20px, 5vw, 28px); }
  .mbi-body { font-size:14px; }
  .mbi-step__num { font-size:36px; }
  .mbi-step__title { font-size:15px; }
  .mbi-step__text { font-size:13px; }
  .mbi-pcard__name { font-size:18px; }
  .mbi-pcard__tagline { font-size:15px; }
  .mbi-pcard__about { font-size:13px; }
  .mbi-pcard__detail-text { font-size:12px; }
  .mbi-pcard__body { padding:20px 18px; }
  .mbi-pcard__cta { flex-direction:column; }
  .mbi-pcard__cta .mbi-btn { width:100%; }
  .mbi-pcard__logo-img { max-width:120px; max-height:44px; }
  .mbi-pcard__about, .mbi-pcard__detail-text { overflow-wrap:anywhere; }
  /* Shorter cards on phones — full cover and claim detail lives on each provider's page */
  .mbi-pcard__detail { display:none; }
  .mbi-pcard__about { margin-bottom:14px; }
  .mbi-fact__val { font-size:20px; }
  .mbi-fact__lbl { font-size:10px; }
  .mbi-checklist li { font-size:13px; gap:10px; }
  .mbi-checklist li::before { width:18px; height:18px; }
  .mbi-cover-item { font-size:13px; }
  .mbi-enquiry__h2 { font-size:clamp(22px, 6vw, 30px); }
  .mbi-enquiry__phone { font-size:24px; }
  .mbi-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .mbi-faq__a { font-size:13px; }
  .mbi-related__card-text { font-size:13px; }

  /* Phone strip */
  .mbi-phone-strip__inner { flex-direction:column; text-align:center; }
  .mbi-phone-strip__right { flex-direction:column; gap:8px; }

  /* Trust strip */
  .mbi-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .mbi-trust__item { font-size:12px; }

  /* Hero provider pills */
  .mbi-hero__providers { gap:6px; }
  .mbi-hero__pill { font-size:11px; padding:4px 10px; }
}
</style>


<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════════════ -->
<nav class="mbi-breadcrumb" aria-label="Breadcrumb">
  <div class="mbi-w">
    <div class="mbi-breadcrumb__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="mbi-breadcrumb__sep">›</span>
      <span>Mechanical Breakdown Insurance</span>
    </div>
  </div>
</nav>


<!-- ══ HERO ═══════════════════════════════════════════════════════════════════ -->
<section class="mbi-hero" aria-labelledby="mbi-h1">
  <div class="mbi-hero__bg"></div>
  <div class="mbi-w">
    <div class="mbi-hero__inner">
      <div>
        <div class="mbi-hero__eye">Mechanical Breakdown Insurance</div>
        <h1 class="mbi-hero__h1" id="mbi-h1">
          MBI Claims <em>Done Right</em><br>
          at TAAS Manukau.
        </h1>
        <p class="mbi-hero__sub">
          Tony Allen Auto Service is an approved repairer for five MBI providers. If your vehicle breaks down and you hold a policy, bring it to <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);text-decoration:underline;">139 Cavendish Drive, Manukau</a>. We handle the insurer, you get back on the road.
        </p>
        <div class="mbi-hero__ctas">
          <a href="#mbi-providers" class="mbi-btn mbi-btn--yellow">View MBI Providers</a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbi-btn mbi-btn--outline">Call <?php echo esc_html($phone_free); ?></a>
        </div>
        <div class="mbi-hero__providers">
          <?php foreach ($providers as $p): ?>
          <a href="<?php echo esc_url($site_url . '/' . $p['slug'] . '/'); ?>" class="mbi-hero__pill"><?php echo esc_html($p['name']); ?></a>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="mbi-hero__card" aria-hidden="true">
        <div class="mbi-hero__card-title">Approved Repairer For</div>
        <?php foreach ($providers as $p): ?>
        <div class="mbi-card-row">
          <div class="mbi-card-tick"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
          <div class="mbi-card-text">
            <strong><a href="<?php echo esc_url($site_url . '/' . $p['slug'] . '/'); ?>" style="color:inherit;"><?php echo esc_html($p['name']); ?></a></strong>
            <?php echo esc_html($p['tagline']); ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ═══════════════════════════════════════════════════════════ -->
<div class="mbi-phone-strip" role="region" aria-label="Contact">
  <div class="mbi-w">
    <div class="mbi-phone-strip__inner">
      <div class="mbi-phone-strip__number"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></div>
      <div class="mbi-phone-strip__right">
        <span class="mbi-phone-strip__hours"><?php echo esc_html($hours); ?></span>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="mbi-phone-strip__email"><?php echo esc_html($email); ?></a>
      </div>
    </div>
  </div>
</div>


<!-- ══ TRUST STRIP ═══════════════════════════════════════════════════════════ -->
<div class="mbi-trust" role="region" aria-label="Trust signals">
  <div class="mbi-w">
    <div class="mbi-trust__inner">
      <div class="mbi-trust__item">Approved repairer — 5 MBI providers</div>
      <div class="mbi-trust__item">MTA Assured</div>
      <div class="mbi-trust__item">NZTA Authorised</div>
      <div class="mbi-trust__item"><?php echo esc_html($years); ?> years in South Auckland</div>
      <div class="mbi-trust__item"><?php echo esc_html($rating); ?>★ from <?php echo esc_html($reviews); ?> reviews</div>
    </div>
  </div>
</div>


<!-- ══ WHAT IS MBI ═══════════════════════════════════════════════════════════ -->
<section class="mbi-what" aria-labelledby="mbi-what-head">
  <div class="mbi-w">
    <div class="mbi-what__inner">
      <div>
        <span class="mbi-sec-eye mbi-sec-eye--yellow">What is MBI?</span>
        <h2 class="mbi-sec-h2" id="mbi-what-head">Mechanical Breakdown Insurance — What It Covers</h2>
        <p class="mbi-body">Mechanical Breakdown Insurance covers the cost of repairing or replacing mechanical and electrical components that fail due to sudden or unforeseen breakdown. It fills the gap left by your standard car insurance, which only covers accidents, theft, and fire — not mechanical failures.</p>
        <p class="mbi-body">Think of it as an extended warranty backed by an insurance company. When your transmission fails, your engine overheats, or your air conditioning stops working, MBI pays for the repair — you just pay the excess and we handle the rest with your provider.</p>
        <p class="mbi-body">All five providers we work with require your vehicle to be serviced at regular intervals and at an approved workshop to keep your policy valid. As an MTA Assured workshop, TAAS satisfies the servicing requirements of all five.</p>
      </div>

      <div>
        <h3 style="font-family:var(--taas-font, 'Inter', Arial, sans-serif);font-size:18px;font-weight:700;color:#0D0D0D;margin-bottom:16px;">What MBI typically covers vs doesn't cover</h3>
        <div class="mbi-cover-grid">
          <div class="mbi-cover-col mbi-cover-col--yes">
            <div class="mbi-cover-col__head">✓ Typically Covered</div>
            <div class="mbi-cover-item">Engine and internal components</div>
            <div class="mbi-cover-item">Automatic and manual transmission</div>
            <div class="mbi-cover-item">Electrical systems and alternator</div>
            <div class="mbi-cover-item">Steering and suspension</div>
            <div class="mbi-cover-item">Fuel system and turbo</div>
            <div class="mbi-cover-item">Air conditioning</div>
            <div class="mbi-cover-item">Clutch and differential</div>
            <div class="mbi-cover-item">Cooling system</div>
            <div class="mbi-cover-item">Roadside assistance and towing</div>
          </div>
          <div class="mbi-cover-col mbi-cover-col--no">
            <div class="mbi-cover-col__head">✕ Not Covered</div>
            <div class="mbi-cover-item">Routine maintenance (oil, filters)</div>
            <div class="mbi-cover-item">Tyres, brake pads, wiper blades</div>
            <div class="mbi-cover-item">Wear and tear items</div>
            <div class="mbi-cover-item">Pre-existing faults at purchase</div>
            <div class="mbi-cover-item">Accident or collision damage</div>
            <div class="mbi-cover-item">Modifications from factory spec</div>
            <div class="mbi-cover-item">Neglect or improper maintenance</div>
            <div class="mbi-cover-item">Cosmetic damage, glass, bodywork</div>
          </div>
        </div>
        <p style="font-size:12px;font-weight:300;color:#999;margin-top:12px;line-height:1.75;">Coverage varies by provider and policy tier. Always read your policy wording for the full list of covered components and exclusions.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ PROVIDER CARDS ═══════════════════════════════════════════════════════ -->
<section class="mbi-providers" id="mbi-providers" aria-labelledby="mbi-providers-head">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--yellow">Approved Providers</span>
    <h2 class="mbi-sec-h2" id="mbi-providers-head">Five MBI Providers — One Approved Workshop</h2>
    <p class="mbi-body" style="max-width:640px;">If you hold a policy with any of these providers, TAAS is an approved repairer. Bring your vehicle to <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-dark, #1A1A1A);font-weight:600;text-decoration:underline;text-decoration-color:var(--taas-yellow, #FFC800);text-decoration-thickness:2px;text-underline-offset:3px;">139 Cavendish Drive, Manukau</a> — we liaise with your insurer and manage the claim process.</p>

    <div class="mbi-providers__grid">
      <?php foreach ($providers as $p):
        $featured_cls = $p['featured'] ? ' mbi-pcard--featured' : '';
      ?>
      <div class="mbi-pcard<?php echo $featured_cls; ?>" id="provider-<?php echo esc_attr($p['id']); ?>">
        <div class="mbi-pcard__logo">
          <?php if (!empty($p['logo'])): ?>
          <img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?> logo" class="mbi-pcard__logo-img" loading="lazy">
          <?php endif; ?>
          <div class="mbi-pcard__name"><a href="<?php echo esc_url($site_url . '/' . $p['slug'] . '/'); ?>" style="color:inherit;border-bottom:2px solid var(--taas-yellow, #FFC800);"><?php echo esc_html($p['name']); ?></a></div>
          <span class="mbi-pcard__badge"><?php echo esc_html($p['badge']); ?></span>
          <div class="mbi-pcard__since"><?php echo esc_html($p['since']); ?></div>
        </div>

        <div class="mbi-pcard__body">
          <div class="mbi-pcard__tagline"><?php echo esc_html($p['tagline']); ?></div>
          <p class="mbi-pcard__about"><?php echo esc_html($p['about']); ?></p>
          <div class="mbi-pcard__detail">
            <div class="mbi-pcard__detail-head">What's covered</div>
            <p class="mbi-pcard__detail-text"><?php echo esc_html($p['cover']); ?></p>
          </div>
          <div class="mbi-pcard__detail">
            <div class="mbi-pcard__detail-head">Making a claim</div>
            <p class="mbi-pcard__detail-text"><?php echo esc_html($p['claim']); ?></p>
          </div>
          <div class="mbi-pcard__facts">
            <?php foreach ($p['facts'] as $f): ?>
            <div>
              <div class="mbi-fact__val"><?php echo esc_html($f['val']); ?></div>
              <div class="mbi-fact__lbl"><?php echo esc_html($f['lbl']); ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="mbi-pcard__cta">
          <a href="<?php echo esc_url($site_url . '/' . $p['slug'] . '/'); ?>" class="mbi-btn mbi-btn--yellow mbi-btn--sm" style="justify-content:center;">
            Full <?php echo esc_html($p['name']); ?> Details
          </a>
          <a href="<?php echo esc_url($p['website']); ?>" class="mbi-btn mbi-btn--dark mbi-btn--sm mbi-btn--ext" target="_blank" rel="noopener noreferrer" style="justify-content:center;">
            <?php echo esc_html($p['name']); ?> Website
          </a>
          <div class="mbi-pcard__claims">
            <strong>Claims</strong>
            <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $p['claims_ph']); ?>"><?php echo esc_html($p['claims_ph']); ?></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ HOW IT WORKS ═════════════════════════════════════════════════════════ -->
<section class="mbi-how" aria-labelledby="mbi-how-head">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--dark">The Process</span>
    <h2 class="mbi-sec-h2 mbi-sec-h2--white" id="mbi-how-head">What happens when you break down</h2>
    <div class="mbi-steps">
      <div class="mbi-step">
        <div class="mbi-step__num">1</div>
        <div class="mbi-step__title">Call your MBI provider first</div>
        <p class="mbi-step__text">Before any repairs start, call your insurer. This is critical — if work starts without authorisation, the claim may be declined. Have your policy number and registration ready.</p>
      </div>
      <div class="mbi-step">
        <div class="mbi-step__num">2</div>
        <div class="mbi-step__title">Bring your vehicle to TAAS</div>
        <p class="mbi-step__text">Drive or tow your vehicle to <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a>. We are an approved repairer for all five providers. Call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a> if you need help coordinating.</p>
      </div>
      <div class="mbi-step">
        <div class="mbi-step__num">3</div>
        <div class="mbi-step__title">We diagnose and liaise</div>
        <p class="mbi-step__text">Our technicians diagnose the fault and contact your insurer to describe the nature of the claim, the estimated repair cost, and to seek authorisation to proceed.</p>
      </div>
      <div class="mbi-step">
        <div class="mbi-step__num">4</div>
        <div class="mbi-step__title">Repairs completed, you pay the excess</div>
        <p class="mbi-step__text">Once authorised, we carry out the repairs. When complete, you pay the excess to us. Your MBI provider pays the balance of the invoice directly to TAAS.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════════ -->
<div class="mbi-finance" role="region" aria-label="Finance options">
  <div class="mbi-w">
    <div class="mbi-finance__inner">
      <span class="mbi-finance__text">Excess or uncovered repairs? <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">Split the cost</a> —</span>
      <div class="mbi-finance__badges">
        <span class="mbi-finance__badge">Afterpay</span>
        <span class="mbi-finance__badge">Q Card</span>
        <span class="mbi-finance__badge">Gem Finance</span>
        <span class="mbi-finance__badge">Aotea Finance</span>
      </div>
    </div>
  </div>
</div>


<!-- ══ WHY TAAS ═══════════════════════════════════════════════════════════════ -->
<section class="mbi-why" aria-labelledby="mbi-why-head">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--yellow">Why Choose TAAS</span>
    <h2 class="mbi-sec-h2" id="mbi-why-head">Why South Auckland MBI holders choose TAAS</h2>
    <ul class="mbi-checklist">
      <li>Approved repairer for <?php echo esc_html($mbi_list); ?></li>
      <li>MTA Assured — satisfies the servicing requirements of all five providers</li>
      <li>Trading since <?php echo esc_html($established); ?> — <?php echo esc_html($years); ?> years of experience with MBI claims</li>
      <li><?php echo esc_html($division_count); ?> specialist divisions under one roof — most repairs handled in-house</li>
      <li>Raj leads diagnostics — fault confirmed before parts are replaced</li>
      <li>Full servicing capability — keep your MBI valid with regular servicing at TAAS</li>
      <li>European vehicle specialists — MBI claims on <?php echo esc_html($euro_brands); ?></li>
      <li>Finance available for excess payments and uncovered work — <?php echo esc_html($finance_list); ?></li>
      <li><?php echo esc_html($rating); ?>★ Google rating from <?php echo esc_html($reviews); ?> reviews</li>
      <li>Estimate before we start — nothing happens without your approval</li>
    </ul>
  </div>
</section>


<!-- ══ DARK ENQUIRY ══════════════════════════════════════════════════════════ -->
<section class="mbi-enquiry" id="mbi-enquiry" aria-labelledby="mbi-enquiry-head">
  <div class="mbi-w">
    <div class="mbi-enquiry__inner">
      <div>
        <h2 class="mbi-enquiry__h2" id="mbi-enquiry-head">Got an MBI policy?<br>We're your repairer.</h2>
        <p class="mbi-enquiry__sub">Call us or send an enquiry. Enquiries before 3pm answered same day, estimates within one business day.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="mbi-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <p class="mbi-enquiry__detail"><a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a></p>
        <p class="mbi-enquiry__detail"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
        <p class="mbi-enquiry__detail"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener"><?php echo esc_html($address); ?></a></p>
        <p class="mbi-enquiry__detail"><?php echo esc_html($hours); ?></p>
        <p class="mbi-enquiry__drumbeat">Estimate before we start — nothing happens without your approval.</p>
        <div class="mbi-enquiry__finance">
          <span class="mbi-enquiry__finance-badge">Afterpay</span>
          <span class="mbi-enquiry__finance-badge">Q Card</span>
          <span class="mbi-enquiry__finance-badge">Gem</span>
          <span class="mbi-enquiry__finance-badge">Aotea</span>
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
<!-- ══ REVIEWS ═══════════════════════════════════════════════════════════════ -->
<section class="mbi-reviews" aria-label="Customer reviews">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--yellow">Google Reviews</span>
    <h2 class="mbi-sec-h2">What our customers say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>
<?php endif; ?>


<!-- ══ RELATED SERVICES ═════════════════════════════════════════════════════ -->
<section class="mbi-related" aria-labelledby="mbi-related-head">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--yellow">Related Services</span>
    <h2 class="mbi-sec-h2" id="mbi-related-head">Keep your vehicle covered</h2>
    <div class="mbi-related__grid">
      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="mbi-related__card">
        <div class="mbi-related__card-title">Vehicle Servicing</div>
        <p class="mbi-related__card-text">Regular servicing keeps your MBI valid. Essential, Standard and Premium services <?php echo esc_html(defined('TAAS_SERVICE_PRICE') ? TAAS_SERVICE_PRICE : 'from $230'); ?>.</p>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical/'); ?>" class="mbi-related__card">
        <div class="mbi-related__card-title">Auto Electrical &amp; Diagnostics</div>
        <p class="mbi-related__card-text">Specialist fault diagnosis with Raj. Diagnostic scan <?php echo esc_html(defined('TAAS_SCAN_PRICE') ? TAAS_SCAN_PRICE : 'from $75'); ?> — printout included, no pressure to proceed.</p>
      </a>
      <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="mbi-related__card">
        <div class="mbi-related__card-title">Finance Options</div>
        <p class="mbi-related__card-text">Split your excess or uncovered repairs with Afterpay, Q Card, Gem Finance, or Aotea Finance.</p>
      </a>
    </div>
  </div>
</section>


<!-- ══ FAQ ═══════════════════════════════════════════════════════════════════ -->
<section class="mbi-faq" aria-labelledby="mbi-faq-head">
  <div class="mbi-w">
    <span class="mbi-sec-eye mbi-sec-eye--yellow">Common Questions</span>
    <h2 class="mbi-sec-h2" id="mbi-faq-head">MBI Questions Answered</h2>
    <div class="mbi-faq__list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'mbi-faq-q-' . $fi;
        $aid = 'mbi-faq-a-' . $fi;
      ?>
      <div class="mbi-faq__item">
        <button class="mbi-faq__q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div class="mbi-faq__a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $fi === 0 ? 'display:block;' : ''; ?>">
          <?php echo wp_kses_post($faq['a']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- /.taas-mbi -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('.taas-mbi .mbi-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var open = this.getAttribute('aria-expanded') === 'true';
      document.querySelectorAll('.taas-mbi .mbi-faq__q').forEach(function(b){
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
