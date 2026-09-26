<?php
/**
 * Template Name: Services Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /services/
 * Built: May 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. WP Admin → Pages → Services → Template → "Services Hub" → Update
 * 3. Set AIOSEO title, description, focus keyword
 * 4. Purge Cloudflare cache
 */

// ── Enqueue global assets ─────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email          = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating         = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews        = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$cf7_general    = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET: '';
$euro_brands    = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$wof_price      = defined('TAAS_WOF_PRICE')    ? TAAS_WOF_PRICE     : '$80';
$ms_number      = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT')? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')  ? TAAS_FINANCE_LIST  : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')      ? TAAS_MBI_LIST      : 'Autosure, Assurant, Provident, Janssen, Autolife';

$site_url       = get_site_url();
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$img_base       = $site_url . '/wp-content/uploads/2026/06/';

$hero_img       = $site_url . '/wp-content/uploads/2026/06/hero-services.webp';

// ── Service images (update paths after uploading to Media Library) ───────────
$service_images = [
  'Warrant of Fitness'   => $img_base . 'svc-wof.webp',
  'Vehicle Servicing'    => $img_base . 'svc-vehicle-servicing.webp',
  'Tyres & Wheels'       => $img_base . 'svc-tyres.webp',
  'Brakes'               => $img_base . 'svc-brakes.webp',
  'Engine Repairs'       => $img_base . 'svc-engine-repair.webp',
  'Auto Electrical'      => $img_base . 'svc-auto-electrical.webp',
  'Diagnostic Scanning'  => $img_base . 'svc-diagnostics.webp',
  'Cambelt & Water Pump' => $img_base . 'svc-cambelts.webp',
  'Clutch Repair'        => $img_base . 'svc-clutch.webp',
  'Transmission Service' => $img_base . 'svc-transmission.webp',
  'Steering & Suspension'=> $img_base . 'svc-suspension.webp',
  'Cooling System'       => $img_base . 'svc-cooling.webp',
  'Air Conditioning'     => $img_base . 'svc-aircon.webp',
  'Electric & Hybrid'    => $img_base . 'svc-ev-hybrid.webp',
  'European Vehicles'    => $img_base . 'svc-european.webp',
  'Battery Centre'       => $img_base . 'svc-batteries-3.webp',
  'Wheel Alignment'      => $img_base . 'svc-wheel-balancing.webp',
  'Wheel Balancing'      => $img_base . 'svc-wheel-alignment.webp',
  'Commercial Vehicles'  => $img_base . 'svc-commercial.webp',
  'Fleet Servicing'      => $img_base . 'svc-fleet.webp',
  'Towing'               => $img_base . 'svc-towing.webp',
  'Mechanical Warranty'  => $img_base . 'svc-ppi.webp',
];

// ── Service data ──────────────────────────────────────────────────────────────
$services = [

    // ── MOST POPULAR ─────────────────────────────────────────────────────────
    ['title'=>'Warrant of Fitness',       'sub'=>'NZTA-authorised inspections — $80 flat rate',               'url'=>'/wof/',                                            'group'=>'popular',    'featured'=>true],
    ['title'=>'Vehicle Servicing',        'sub'=>'Full & interim services — all makes and models',             'url'=>'/vehicle-servicing/',                              'group'=>'popular',    'featured'=>true],
    ['title'=>'Tyres & Wheels',           'sub'=>'Supply, fit and balance — leading brands stocked',           'url'=>'/tyre-centre/',                                 'group'=>'popular',    'featured'=>true],
    ['title'=>'Brakes',                   'sub'=>'Pads, rotors, calipers — full brake system repairs',              'url'=>'/manukau-brake-clutch/',                                'group'=>'popular',    'featured'=>true],

    // ── SPECIALIST SERVICES ───────────────────────────────────────────────────
    ['title'=>'Engine Repairs',           'sub'=>'Diagnostics, head gaskets, timing, oil leaks — sorted in-house','url'=>'/engine-repairs/',                        'group'=>'specialist', 'featured'=>false],
    ['title'=>'Auto Electrical',          'sub'=>'Wiring, alternators, starters & ECU diagnostics',            'url'=>'/auto-electrical/',                       'group'=>'specialist', 'featured'=>false],
    ['title'=>'Diagnostic Scanning',      'sub'=>'Check engine light? We read every fault code',               'url'=>'/diagnostic-scanning/',                   'group'=>'specialist', 'featured'=>false],
    ['title'=>'Cambelt & Water Pump',     'sub'=>'Don\'t risk an engine failure — replace on schedule',        'url'=>'/cambelts-and-water-pumps/',              'group'=>'specialist', 'featured'=>false],
    ['title'=>'Clutch Repair',            'sub'=>'Slipping or stiff? Full clutch service in-house',            'url'=>'/clutch-repair-manukau/',                      'group'=>'specialist', 'featured'=>false],
    ['title'=>'Transmission Service',     'sub'=>'Auto and manual gearbox service and repair',                 'url'=>'/transmission-service-and-repair/',       'group'=>'specialist', 'featured'=>false],
    ['title'=>'Steering & Suspension',    'sub'=>'Computerised alignment, shocks, struts, ball joints and rack repairs',        'url'=>'/steering-and-suspension/',               'group'=>'specialist', 'featured'=>false],
    ['title'=>'Cooling System',           'sub'=>'Radiator, thermostat & coolant — prevent overheating',       'url'=>'/cooling-system/',                        'group'=>'specialist', 'featured'=>false],
    ['title'=>'Air Conditioning',         'sub'=>'Regas, leak detection & full AC system repair',              'url'=>'/air-conditioning/',           'group'=>'specialist', 'featured'=>false],
    ['title'=>'Electric & Hybrid',        'sub'=>'Servicing and repairs for EV and hybrid vehicles',            'url'=>'/electric-hybrid-vehicle-servicing/','group'=>'specialist','featured'=>false],
    ['title'=>'European Vehicles',        'sub'=>$euro_brands . '. Specialist servicing',                      'url'=>'/european/',                                       'group'=>'specialist', 'featured'=>false],

    // ── WORKSHOP & FLEET ──────────────────────────────────────────────────────
    ['title'=>'Battery Centre',           'sub'=>'Test, supply and fit — all vehicle types',                   'url'=>'/manukau-batteries/',                         'group'=>'workshop',   'featured'=>false],
    ['title'=>'Wheel Alignment',          'sub'=>'Laser computerised alignment — straight tracking guaranteed', 'url'=>'/wheel-alignment-manukau/',                       'group'=>'workshop',   'featured'=>false],
    ['title'=>'Wheel Balancing',          'sub'=>'Precision balancing — stops vibration through the steering wheel',        'url'=>'/wheel-balancing-manukau/',                       'group'=>'workshop',   'featured'=>false],
    ['title'=>'Commercial Vehicles',      'sub'=>'Vans, light trucks and campervans — all repairs covered',    'url'=>'/commercial-vehicles/',    'group'=>'workshop',   'featured'=>false],
    ['title'=>'Fleet Servicing',          'sub'=>'B2B fleet servicing & repairs. Lease company repairs. Direct invoicing','url'=>'/fleet-servicing/',                                'group'=>'workshop',   'featured'=>false, 'badge'=>'Fleet Accounts Welcome'],
    ['title'=>'Mechanical Warranty',      'sub'=>'MBI approved — Autosure, Assurant, Provident & more',       'url'=>'/mechanical-breakdown-insurance/',                  'group'=>'workshop',   'featured'=>false, 'badge'=>'MBI Approved'],

    // ── ARRANGED ──────────────────────────────────────────────────────────────
    ['title'=>'Towing',                   'sub'=>'Arranged via trusted partners — we coordinate for you',      'url'=>'/towing/',                                'group'=>'arranged',   'featured'=>false],
];

// Group services
$groups = ['popular'=>[], 'specialist'=>[], 'workshop'=>[], 'arranged'=>[]];
foreach ($services as $s) { $groups[$s['group']][] = $s; }

// ── Service SVG icons (inline, no external files) ────────────────────────────
$service_icons = [
  'Warrant of Fitness'  => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="12" y="6" width="24" height="36" rx="2"/><path d="M19 6V4a5 5 0 0110 0v2"/><polyline points="19 24 22 27 29 20"/><line x1="18" y1="33" x2="30" y2="33"/><line x1="18" y1="37" x2="26" y2="37"/></svg>',
  'Vehicle Servicing'   => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M30 8a8 8 0 01-1 15.9L17 36l-4 4-3-3 4-4L26.1 21A8 8 0 0130 8z"/><circle cx="32" cy="16" r="2"/></svg>',
  'Tyres & Wheels'      => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="18"/><circle cx="24" cy="24" r="10"/><circle cx="24" cy="24" r="3"/><line x1="24" y1="14" x2="24" y2="17"/><line x1="24" y1="31" x2="24" y2="34"/><line x1="14" y1="24" x2="17" y2="24"/><line x1="31" y1="24" x2="34" y2="24"/></svg>',
  'Brakes'              => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="16"/><circle cx="24" cy="24" r="6"/><circle cx="24" cy="24" r="2"/><path d="M12 18l4 2"/><path d="M12 30l4-2"/><path d="M36 18l-4 2"/><path d="M36 30l-4-2"/></svg>',
  'Engine Repairs'      => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="14" y="12" width="20" height="24" rx="2"/><path d="M18 12V8h4v4"/><path d="M26 12V8h4v4"/><line x1="14" y1="20" x2="34" y2="20"/><line x1="14" y1="28" x2="34" y2="28"/><path d="M10 18v12"/><path d="M38 18v12"/><line x1="22" y1="36" x2="22" y2="40"/><line x1="26" y1="36" x2="26" y2="40"/></svg>',
  'Auto Electrical'     => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="26 6 12 26 22 26 20 42 36 20 26 20 26 6"/></svg>',
  'Diagnostic Scanning' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="8" width="24" height="18" rx="2"/><line x1="8" y1="22" x2="32" y2="22"/><path d="M16 26v6h8"/><line x1="12" y1="14" x2="20" y2="14"/><line x1="12" y1="18" x2="16" y2="18"/><circle cx="26" cy="15" r="2"/><path d="M36 20l6 6"/><circle cx="36" cy="20" r="4" stroke-dasharray="2 2"/></svg>',
  'Cambelt & Water Pump'=> '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="16" r="8"/><circle cx="34" cy="32" r="6"/><path d="M23 12l8 16"/><path d="M9 20l19 8"/><circle cx="16" cy="16" r="2"/><circle cx="34" cy="32" r="2"/></svg>',
  'Clutch Repair'       => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="14"/><circle cx="24" cy="24" r="8"/><circle cx="24" cy="24" r="3"/><path d="M24 10v4"/><path d="M24 34v4"/><path d="M10 24h4"/><path d="M34 24h4"/></svg>',
  'Transmission Service'=> '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="20" r="8"/><circle cx="32" cy="28" r="8"/><circle cx="16" cy="20" r="3"/><circle cx="32" cy="28" r="3"/></svg>',
  'Steering & Suspension'=> '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="14"/><circle cx="24" cy="24" r="2"/><path d="M24 10v6"/><path d="M24 32v6"/><path d="M12 18l5 3"/><path d="M31 27l5 3"/><path d="M12 30l5-3"/><path d="M31 21l5-3"/></svg>',
  'Cooling System'      => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M24 6v28"/><path d="M20 10l4-4 4 4"/><circle cx="24" cy="38" r="6"/><path d="M18 38h-4a2 2 0 01-2-2V18"/><path d="M30 38h4a2 2 0 002-2V18"/><line x1="16" y1="18" x2="20" y2="18"/><line x1="16" y1="22" x2="20" y2="22"/></svg>',
  'Air Conditioning'    => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M24 4v40"/><path d="M17 8l7 6 7-6"/><path d="M17 40l7-6 7 6"/><path d="M4 24h40"/><path d="M8 17l6 7-6 7"/><path d="M40 17l-6 7 6 7"/></svg>',
  'Electric & Hybrid'   => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="14" y="22" width="20" height="16" rx="3"/><path d="M20 22v-6a4 4 0 018 0v6"/><line x1="22" y1="30" x2="22" y2="34"/><line x1="26" y1="30" x2="26" y2="34"/><polygon points="24 10 20 16 24 16 22 22 28 14 24 14 24 10" fill="currentColor" stroke="none" opacity=".3"/><polygon points="24 10 20 16 24 16 22 22 28 14 24 14 24 10"/></svg>',
  'European Vehicles'   => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="20" r="12"/><path d="M18 44l2-14h8l2 14"/><path d="M24 8v6"/><path d="M18.3 11l3 5.2"/><path d="M29.7 11l-3 5.2"/><path d="M14 18h5"/><path d="M29 18h5"/></svg>',
  'Battery Centre'      => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="14" width="32" height="24" rx="3"/><line x1="16" y1="14" x2="16" y2="10"/><line x1="32" y1="14" x2="32" y2="10"/><line x1="16" y1="26" x2="22" y2="26"/><line x1="30" y1="23" x2="30" y2="29"/><line x1="27" y1="26" x2="33" y2="26"/></svg>',
  'Wheel Alignment'     => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="14"/><circle cx="24" cy="24" r="4"/><line x1="24" y1="4" x2="24" y2="10"/><line x1="24" y1="38" x2="24" y2="44"/><line x1="4" y1="24" x2="10" y2="24"/><line x1="38" y1="24" x2="44" y2="24"/></svg>',
  'Wheel Balancing'     => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="14"/><circle cx="24" cy="24" r="8"/><circle cx="24" cy="24" r="2"/><path d="M20 14l4 6 4-6" fill="currentColor" opacity=".2"/><path d="M20 14l4 6 4-6"/></svg>',
  'Commercial Vehicles' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="14" width="26" height="18" rx="2"/><polygon points="30 18 38 18 42 24 42 32 30 32 30 18"/><circle cx="12" cy="36" r="4"/><circle cx="36" cy="36" r="4"/><line x1="16" y1="32" x2="32" y2="32"/></svg>',
  'Fleet Servicing'     => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="10" width="20" height="14" rx="2"/><polygon points="26 14 32 14 36 18 36 24 26 24 26 14"/><circle cx="12" cy="26" r="3"/><circle cx="32" cy="26" r="3"/><rect x="14" y="18" width="20" height="14" rx="2" opacity=".4"/><polygon points="34 22 40 22 44 26 44 32 34 32 34 22" opacity=".4"/><circle cx="20" cy="34" r="3" opacity=".4"/><circle cx="40" cy="34" r="3" opacity=".4"/></svg>',
  'Mechanical Warranty' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M24 4L6 12v12c0 11 8 18 18 22 10-4 18-11 18-22V12L24 4z"/><polyline points="17 24 22 29 31 20"/></svg>',
  'Towing'              => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="20" y="18" width="22" height="14" rx="2"/><circle cx="28" cy="36" r="4"/><circle cx="38" cy="36" r="4"/><path d="M20 28H8l-2 4v4h8"/><circle cx="10" cy="36" r="3"/><path d="M6 28l4-10h10"/></svg>',
];

// Schema
$sh_faqs = [
  $taas_faqs['services_overview'],
  $taas_faqs['all_makes'],
  $taas_faqs['wof_cost'],
  $taas_faqs['booking'],
  $taas_faqs['european'],
  $taas_faqs['brake_disc'],
  $taas_faqs['auto_electrical_services'],
  $taas_faqs['warranty_safe'],
  $taas_faqs['accreditations'],
  $taas_faqs['suburbs'],
  $taas_faqs['finance'],
  $taas_faqs['workmanship_guarantee'],
];

$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
                ['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>$site_url.'/services/'],
            ],
        ],
        [
            '@type'           => ['AutoRepair','LocalBusiness'],
            '@id'             => $site_url . '/#organization',
            'name'            => 'Tony Allen Auto Service',
            'url'             => $site_url,
            'telephone'       => [$phone_free, $phone_local],
            'email'           => $email,
            'foundingDate'    => '1985-10',
            'address'         => ['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
            'geo'             => ['@type'=>'GeoCoordinates','latitude'=>-36.9935,'longitude'=>174.8661],
            'openingHoursSpecification' => [['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
            'aggregateRating' => ['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],
            'sameAs'          => ['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'priceRange'      => '$$',
            'areaServed'      => 'South Auckland',
            'memberOf'        => ['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.sh-hero__sub', '.sh-faq [role="region"]']],
        [
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(function($f){ return ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }, $sh_faqs),
        ],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-sh">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════════ */
.page-template-template-services-hub .site-content,
.page-template-template-services-hub .entry-content,
.page-template-template-services-hub .entry-header,
.page-template-template-services-hub article,
.page-template-template-services-hub #primary,
.page-template-template-services-hub #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-sh *, .taas-sh *::before, .taas-sh *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-sh { font-family:var(--taas-font); color:#333; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }
.taas-sh a { text-decoration:none; }
.sh-w { max-width:1140px; margin:0 auto; padding:0 24px; }

/* ══ HERO ═════════════════════════════════════════════════════════════════════ */
.sh-hero {
  background:#0D0D0D url('<?php echo esc_url($hero_img); ?>') center 40% / cover no-repeat;
  padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px);
  border-bottom:3px solid #FFC800; text-align:center;
  position:relative;
}
.sh-hero::before {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,.82);
  pointer-events:none;
}
.sh-hero .sh-w { position:relative; z-index:1; }
.sh-hero__eye {
  display:inline-flex; align-items:center; gap:10px; margin-bottom:20px;
  font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#FFC800;
}
.sh-hero__eye::before, .sh-hero__eye::after { content:''; width:32px; height:2px; background:#FFC800; }
.sh-hero__h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight:800;
  color:#fff; letter-spacing:-0.02em;
  line-height:1.1; margin-bottom:18px;
}
.sh-hero__h1 em { color:#FFC800; font-style:normal; }
.sh-hero__sub { font-size:17px; color:#999; max-width:600px; margin:0 auto 32px; line-height:1.75; font-weight:300; letter-spacing:-0.1px; }
.sh-hero__ctas { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }

/* Buttons */
.sh-btn {
  display:inline-flex; align-items:center; gap:8px;
  font-family:var(--taas-font); font-weight:var(--taas-btn-wt, 600); font-size:var(--taas-btn-size, 15px);
  letter-spacing:.04em; text-transform:uppercase;
  padding:var(--taas-btn-pad, 14px 28px); border-radius:var(--taas-radius, 6px); transition:all .18s;
}
.sh-btn--yellow { background:#FFC800; color:#1A1A1A!important; }
.sh-btn--yellow:hover { background:#e6b400; transform:translateY(-1px); }
.sh-btn--outline { background:transparent; color:#FFC800!important; border:2px solid #FFC800; }
.sh-btn--outline:hover { background:#FFC800; color:#1A1A1A!important; }
.sh-btn--dark { background:#1A1A1A; color:#fff!important; }
.sh-btn--dark:hover { background:#000; transform:translateY(-1px); }

/* ══ TRUST STRIP ══════════════════════════════════════════════════════════════ */
.sh-trust { background:var(--taas-yellow, #FFC800); padding:var(--taas-trust-pad, 18px) 0; }
.sh-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.sh-trust__item { display:flex; align-items:center; gap:8px; font-size:var(--taas-trust-size, 14px); font-weight:var(--taas-trust-wt, 600); color:var(--taas-dark, #1A1A1A); white-space:nowrap; }
.sh-trust__item::before { content:'✓'; font-weight:900; }

/* ══ SECTION WRAPPER ══════════════════════════════════════════════════════════ */
.sh-section { padding:var(--taas-sec-pad, 72px) 0; background:#fff; }
.sh-section--grey { background:#F7F7F5; }
.sh-section--dark { background:#1A1A1A; }
.sh-section-head {
  display:flex; align-items:baseline; gap:16px;
  border-bottom:2px solid #E8E8E4; padding-bottom:14px; margin-bottom:36px;
}
.sh-section--dark .sh-section-head { border-bottom-color:rgba(255,255,255,.08); }
.sh-section-head__h2 {
  font-family:var(--taas-font);
  font-size:clamp(22px,2.5vw,30px); font-weight:900;
  color:#0D0D0D; text-transform:uppercase;
}
.sh-section--dark .sh-section-head__h2 { color:#fff; }
.sh-section-head__count { font-size:11px; color:#999; letter-spacing:.1em; text-transform:uppercase; margin-left:auto; }

/* ══ FEATURED GRID (2×2) ══════════════════════════════════════════════════════ */
.sh-featured-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:16px; }
.sh-card--featured {
  position:relative; overflow:hidden;
  background:#0D0D0D; border:1px solid #2a2a2a;
  display:block; min-height:220px;
  border-top:3px solid transparent;
  transition:border-color .2s, transform .2s;
}
.sh-card--featured:hover { border-color:#FFC800; transform:translateY(-2px); }
.sh-card--featured__ph {
  position:absolute; inset:0;
  background:linear-gradient(135deg,#1a1a1a 0%,#0d0d0d 100%);
  background-size:cover; background-position:center;
}
.sh-card--featured__ph::after {
  content:''; position:absolute; inset:0;
  background:linear-gradient(135deg,rgba(13,13,13,.78) 0%,rgba(13,13,13,.65) 100%);
}
.sh-card--featured__ph svg {
  position:absolute; right:20px; top:20px;
  width:80px; height:80px; color:#FFC800; opacity:.1; z-index:1;
}
.sh-card--featured:hover .sh-card--featured__ph svg { opacity:.18; }
.sh-card--featured__body {
  position:relative; padding:28px 26px;
  display:flex; flex-direction:column;
  justify-content:flex-end; min-height:220px; z-index:1;
}
.sh-card--featured__title {
  font-family:var(--taas-font);
  font-size:26px; font-weight:900; color:#fff;
  text-transform:uppercase; margin-bottom:6px;
}
.sh-card--featured__sub { font-size:14px; color:#aaa; line-height:1.4; margin-bottom:16px; }
.sh-card--featured__arrow {
  position:absolute; top:20px; right:20px;
  background:#FFC800; color:#111; width:34px; height:34px;
  border-radius:50%; display:flex; align-items:center;
  justify-content:center; font-size:16px; font-weight:900;
  transition:transform .2s;
}
.sh-card--featured:hover .sh-card--featured__arrow { transform:translateX(3px); }

/* ══ STANDARD CARD GRID ═══════════════════════════════════════════════════════ */
.sh-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
.sh-card {
  background:#fff; border:1px solid #E8E8E4;
  border-top:3px solid transparent;
  display:block; text-decoration:none;
  transition:border-color .2s, transform .2s, box-shadow .2s;
  position:relative;
}
.sh-section--grey .sh-card { background:#fff; }
.sh-section--dark .sh-card { background:#222; border-color:rgba(255,255,255,.06); }
.sh-card:hover { border-top-color:#FFC800; transform:translateY(-2px); box-shadow:0 8px 24px rgba(0,0,0,.1); }
.sh-card--coming-soon { opacity:.5; pointer-events:none; cursor:default; }
.sh-card--arranged { border-style:dashed; }
.sh-card__ph { width:100%; height:140px; background:#F7F7F5; display:flex; align-items:center; justify-content:center; overflow:hidden; }
.sh-card__ph img { width:100%; height:100%; object-fit:cover; display:block; }
.sh-section--dark .sh-card__ph { background:#2a2a2a; }
.sh-card__ph-icon { font-size:28px; }
.sh-card__ph svg { width:52px; height:52px; color:#bbb; opacity:.6; }
.sh-section--dark .sh-card__ph svg { color:#FFC800; opacity:.35; }
.sh-card__content { padding:16px 18px 20px; }
.sh-card__badge {
  display:inline-block; font-size:10px; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase;
  background:#FFC800; color:#1A1A1A;
  padding:2px 8px; margin-bottom:8px;
}
.sh-card__badge--arranged { background:transparent; border:1px solid #ccc; color:#999; }
.sh-card__badge--soon { background:#E8E8E4; color:#999; }
.sh-card__title {
  font-family:var(--taas-font);
  font-size:18px; font-weight:900; color:#0D0D0D;
  text-transform:uppercase; margin-bottom:6px;
}
.sh-section--dark .sh-card__title { color:#fff; }
.sh-card__sub { font-size:13px; color:#666; line-height:1.5; }
.sh-section--dark .sh-card__sub { color:#888; }

/* ══ CONTACT SECTION ══════════════════════════════════════════════════════════ */
.sh-contact { background:#F7F7F5; padding:64px 0; }
.sh-contact__inner { display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:start; }
.sh-contact__label { font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#FFC800; background:#1A1A1A; padding:5px 14px; display:inline-block; margin-bottom:16px; }
.sh-contact__h2 {
  font-family:var(--taas-font);
  font-size:clamp(28px,3.5vw,40px); font-weight:900;
  color:#0D0D0D; text-transform:uppercase; line-height:1.05; margin-bottom:12px;
}
.sh-contact__lead { font-size:17px; color:#666; line-height:1.75; font-weight:300; letter-spacing:-0.1px; margin-bottom:28px; }
.sh-contact-card { background:#fff; border:1px solid #E8E8E4; border-top:3px solid #FFC800; padding:24px; }
.sh-contact-card h3 { font-size:13px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; margin-bottom:16px; }
.sh-contact-row { display:flex; flex-direction:column; gap:3px; padding:12px 0; border-bottom:1px solid #E8E8E4; }
.sh-contact-row:last-child { border-bottom:none; }
.sh-contact-label { font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:#999; }
.sh-contact-val { font-size:15px; font-weight:600; color:#1A1A1A; }
.sh-contact-val a { color:#1A1A1A; }
.sh-contact-val a:hover { color:#FFC800; }
.sh-form-wrap { background:#fff; border:1px solid #E8E8E4; border-top:3px solid #FFC800; padding:28px; }
.sh-form-wrap .wpcf7-form input[type="text"],
.sh-form-wrap .wpcf7-form input[type="email"],
.sh-form-wrap .wpcf7-form input[type="tel"],
.sh-form-wrap .wpcf7-form select,
.sh-form-wrap .wpcf7-form textarea {
  background:#F9F9F7!important; border:1px solid #E8E8E4!important; color:#1A1A1A!important;
  border-radius:6px!important; padding:12px 14px!important; font-size:15px!important;
  font-family:var(--taas-font)!important; width:100%!important; box-sizing:border-box!important;
  margin-top:4px!important;
}
.sh-form-wrap .wpcf7-form textarea { min-height:100px!important; resize:vertical!important; }
.sh-form-wrap .wpcf7-form input[type="submit"] {
  background:#FFC800!important; color:#1A1A1A!important; border:none!important;
  padding:14px 28px!important; font-size:15px!important; font-weight:700!important;
  width:100%!important; cursor:pointer!important; margin-top:4px!important;
  letter-spacing:.04em!important; text-transform:uppercase!important;
}

/* ══ FINANCE STRIP ════════════════════════════════════════════════════════════ */
.sh-finance { background:#1A1A1A; padding:48px 0; text-align:center; }
.sh-finance__h2 {
  font-family:var(--taas-font);
  font-size:clamp(24px,3vw,34px); font-weight:900;
  color:#fff; text-transform:uppercase; margin-bottom:8px;
}
.sh-finance__sub { font-size:15px; color:#999; margin-bottom:28px; }
.sh-finance__providers {
  display:flex; flex-wrap:wrap; gap:12px;
  justify-content:center; margin-bottom:28px;
}
.sh-finance__pill {
  background:rgba(255,200,0,.07); border:1px solid rgba(255,200,0,.2);
  color:#bbb; font-size:13px; font-weight:600; padding:8px 18px; letter-spacing:.04em;
  text-decoration:none; transition:background .15s, color .15s, border-color .15s;
}
a.sh-finance__pill:hover { background:rgba(255,200,0,.15); border-color:rgba(255,200,0,.5); color:#FFC800; }

/* ══ CTA BAND ═════════════════════════════════════════════════════════════════ */
.sh-cta { background:#0D0D0D; padding:72px 0; text-align:center; }
.sh-cta__h2 {
  font-family:var(--taas-font);
  font-size:clamp(32px,4.5vw,54px); font-weight:900;
  color:#fff; text-transform:uppercase; margin-bottom:8px;
}
.sh-cta__h2 span { color:#FFC800; }
.sh-cta__sub { font-size:17px; color:#999; margin-bottom:32px; line-height:1.75; font-weight:300; letter-spacing:-0.1px; }
.sh-cta__phone { font-family:var(--taas-font); font-size:42px; font-weight:900; color:#FFC800; text-decoration:none; display:block; margin-bottom:24px; transition:opacity .15s; }
.sh-cta__phone:hover { opacity:.7; }
.sh-cta__btns { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }

/* ══ RESPONSIVE ═══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .sh-featured-grid { grid-template-columns:1fr; }
  .sh-grid { grid-template-columns:repeat(2,1fr); }
  .sh-contact__inner { grid-template-columns:1fr; }
}
@media (max-width:640px) {
  /* Layout */
  .sh-grid { grid-template-columns:1fr; }
  .sh-featured-grid { grid-template-columns:1fr; }
  .sh-contact__inner { grid-template-columns:1fr; gap:28px; }

  /* Section spacing */
  .sh-hero { padding:48px 0 40px; }
  .sh-section { padding:var(--taas-sec-pad-m, 48px) 0; }
  .sh-contact { padding:40px 0; }
  .sh-finance { padding:40px 0; }
  .sh-cta { padding:48px 0; }
  .sh-faq { padding:40px 0; }
  .sh-section-head { margin-bottom:24px; }

  /* Type scale */
  .sh-hero__h1 { font-size:clamp(26px, 7vw, 36px); }
  .sh-hero__sub { font-size:14px; }
  .sh-section-head__h2 { font-size:clamp(18px, 5vw, 24px); }
  .sh-card--featured__title { font-size:20px; }
  .sh-card--featured__sub { font-size:13px; }
  .sh-card--featured { min-height:180px; }
  .sh-card--featured__body { min-height:180px; }
  .sh-card__title { font-size:15px; }
  .sh-card__sub { font-size:12px; }
  .sh-card__ph { height:100px; }
  .sh-card__ph svg { width:40px; height:40px; }
  .sh-contact__h2 { font-size:clamp(22px, 5vw, 30px); }
  .sh-contact__lead { font-size:14px; }
  .sh-finance__h2 { font-size:clamp(20px, 5vw, 28px); }
  .sh-finance__sub { font-size:13px; }
  .sh-finance__pill { font-size:12px; padding:6px 14px; }
  .sh-cta__h2 { font-size:clamp(24px, 6vw, 36px); }
  .sh-cta__phone { font-size:28px; }
  .sh-cta__sub { font-size:14px; }
  .sh-cta__btns { flex-direction:column; align-items:center; width:100%; }
  .sh-cta__btns .sh-btn { width:100%; justify-content:center; text-align:center; }
  .sh-btn { font-size:13px; padding:12px 20px; }

  /* Trust strip */
  .sh-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .sh-trust__item { font-size:12px; }

  /* Hero CTAs */
  .sh-hero__ctas { flex-direction:column; align-items:stretch; }
  .sh-hero__ctas .sh-btn { justify-content:center; text-align:center; }

  /* FAQ */
  .sh-faq button { font-size:13px!important; padding:14px 28px 14px 0!important; }
  .sh-faq [role="region"] { font-size:12px!important; }
  div[style*="grid-template-columns:1fr 1fr"] { grid-template-columns:1fr!important; }
}
</style>


<!-- ══ HERO ═══════════════════════════════════════════════════════════════════ -->
<section class="sh-hero" aria-label="Services at Tony Allen Auto Service">
  <div class="sh-w">
    <div class="sh-hero__eye">All Services</div>
    <h1 class="sh-hero__h1">
      Seven Specialist Divisions.<br>
      <em>One Address.</em>
    </h1>
    <p class="sh-hero__sub">
      Everything from a WOF to European diagnostics, EV and hybrid servicing to fleet repairs — all under one roof at 139 Cavendish Drive, Manukau. MTA Assured. NZTA Authorised. Trading since <?php echo esc_html($established); ?>.
    </p>
    <div class="sh-hero__ctas">
      <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="sh-btn sh-btn--yellow">Book a Service</a>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="sh-btn sh-btn--outline">Call <?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>


<!-- ══ TRUST STRIP ════════════════════════════════════════════════════════════ -->
<div class="sh-trust" role="region" aria-label="Trust signals">
  <div class="sh-w">
    <div class="sh-trust__inner">
      <div class="sh-trust__item">MTA Assured</div>
      <div class="sh-trust__item">NZTA Authorised</div>
      <div class="sh-trust__item"><?php echo esc_html($years); ?> years in South Auckland</div>
      <div class="sh-trust__item"><?php echo esc_html($rating); ?>★ Google · <?php echo esc_html($reviews); ?> reviews</div>
      <div class="sh-trust__item"><?php echo esc_html($hours); ?></div>
    </div>
  </div>
</div>


<!-- ══ MOST POPULAR ═══════════════════════════════════════════════════════════ -->
<section class="sh-section" aria-labelledby="sh-popular-head">
  <div class="sh-w">
    <div class="sh-section-head">
      <h2 class="sh-section-head__h2" id="sh-popular-head">Most Popular Services</h2>
      <span class="sh-section-head__count"><?php echo count($groups['popular']); ?> services</span>
    </div>
    <div class="sh-featured-grid">
      <?php foreach ($groups['popular'] as $s): ?>
      <a href="<?php echo esc_url($site_url . $s['url']); ?>" class="sh-card--featured">
        <div class="sh-card--featured__ph"<?php if (!empty($service_images[$s['title']])): ?> style="background-image:url('<?php echo esc_url($service_images[$s['title']]); ?>')"<?php endif; ?>><?php echo $service_icons[$s['title']] ?? ''; ?></div>
        <div class="sh-card--featured__body">
          <div class="sh-card--featured__arrow">→</div>
          <div class="sh-card--featured__title"><?php echo esc_html($s['title']); ?></div>
          <div class="sh-card--featured__sub"><?php echo esc_html($s['sub']); ?></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ SPECIALIST SERVICES ════════════════════════════════════════════════════ -->
<section class="sh-section sh-section--grey" aria-labelledby="sh-specialist-head">
  <div class="sh-w">
    <div class="sh-section-head">
      <h2 class="sh-section-head__h2" id="sh-specialist-head">Specialist Services</h2>
      <span class="sh-section-head__count"><?php echo count($groups['specialist']); ?> services</span>
    </div>
    <div class="sh-grid">
      <?php foreach ($groups['specialist'] as $s):
        $is_coming = !empty($s['coming_soon']);
        $tag_open  = $is_coming ? '<div class="sh-card sh-card--coming-soon">' : '<a href="' . esc_url($site_url . $s['url']) . '" class="sh-card">';
        $tag_close = $is_coming ? '</div>' : '</a>';
        echo $tag_open;
      ?>
        <div class="sh-card__ph">
          <?php if (!empty($service_images[$s['title']])): ?>
            <img src="<?php echo esc_url($service_images[$s['title']]); ?>" alt="<?php echo esc_attr($s['title']); ?> — Tony Allen Auto Service" loading="lazy">
          <?php else: ?>
            <?php echo $service_icons[$s['title']] ?? ''; ?>
          <?php endif; ?>
        </div>
        <div class="sh-card__content">
          <?php if ($is_coming): ?><span class="sh-card__badge sh-card__badge--soon">Coming Soon</span><?php endif; ?>
          <div class="sh-card__title"><?php echo esc_html($s['title']); ?></div>
          <p class="sh-card__sub"><?php echo esc_html($s['sub']); ?></p>
        </div>
      <?php echo $tag_close; endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ WORKSHOP & FLEET ═══════════════════════════════════════════════════════ -->
<section class="sh-section sh-section--dark" aria-labelledby="sh-workshop-head">
  <div class="sh-w">
    <div class="sh-section-head">
      <h2 class="sh-section-head__h2" id="sh-workshop-head">Workshop & Fleet Services</h2>
      <span class="sh-section-head__count" style="color:#888;"><?php echo count($groups['workshop']); ?> services</span>
    </div>
    <div class="sh-grid">
      <?php foreach ($groups['workshop'] as $s): ?>
      <a href="<?php echo esc_url($site_url . $s['url']); ?>" class="sh-card">
        <div class="sh-card__ph">
          <?php if (!empty($service_images[$s['title']])): ?>
            <img src="<?php echo esc_url($service_images[$s['title']]); ?>" alt="<?php echo esc_attr($s['title']); ?> — Tony Allen Auto Service" loading="lazy">
          <?php else: ?>
            <?php echo $service_icons[$s['title']] ?? ''; ?>
          <?php endif; ?>
        </div>
        <div class="sh-card__content">
          <?php if (!empty($s['badge'])): ?>
          <span class="sh-card__badge"><?php echo esc_html($s['badge']); ?></span>
          <?php endif; ?>
          <div class="sh-card__title"><?php echo esc_html($s['title']); ?></div>
          <p class="sh-card__sub"><?php echo esc_html($s['sub']); ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ CONTACT / BOOKING ══════════════════════════════════════════════════════ -->
<section class="sh-contact" aria-labelledby="sh-contact-head">
  <div class="sh-w">
    <div class="sh-contact__inner">
      <div>
        <span class="sh-contact__label">Get in Touch</span>
        <h2 class="sh-contact__h2" id="sh-contact-head">Book a Service<br>or Ask Us Anything</h2>
        <p class="sh-contact__lead">Fill in the form and we'll get back to you — usually same day. Or call us directly. We're here <?php echo esc_html($hours); ?>.</p>
        <div class="sh-contact-card">
          <h3>Tony Allen Auto Service</h3>
          <div class="sh-contact-row">
            <span class="sh-contact-label">Address</span>
            <span class="sh-contact-val"><a href="https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau" target="_blank" rel="noopener noreferrer"><?php echo esc_html($address); ?></a></span>
          </div>
          <div class="sh-contact-row">
            <span class="sh-contact-label">Hours</span>
            <span class="sh-contact-val"><?php echo esc_html($hours); ?></span>
          </div>
          <div class="sh-contact-row">
            <span class="sh-contact-label">Phone</span>
            <span class="sh-contact-val">
              <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a>
              &nbsp;·&nbsp;
              <a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a>
            </span>
          </div>
          <div class="sh-contact-row">
            <span class="sh-contact-label">Email</span>
            <span class="sh-contact-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
          </div>
        </div>
      </div>
      <div class="sh-form-wrap">
        <?php if ($cf7_general): ?>
          <?php echo do_shortcode($cf7_general); ?>
        <?php else: ?>
          <p style="font-size:15px;color:#666;margin-bottom:20px;">Call or email to book — we'll confirm your appointment promptly.</p>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="sh-btn sh-btn--yellow" style="display:block;text-align:center;margin-bottom:12px;">Call <?php echo esc_html($phone_free); ?></a>
          <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="sh-btn sh-btn--dark" style="display:block;text-align:center;">Call <?php echo esc_html($phone_local); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ══ FINANCE STRIP ══════════════════════════════════════════════════════════ -->
<div class="sh-finance" role="region" aria-label="Payment options">
  <div class="sh-w">
    <h2 class="sh-finance__h2">Flexible Payment Options</h2>
    <p class="sh-finance__sub">Pay your way — interest-free options available for all repairs.</p>
    <div class="sh-finance__providers">
      <a href="<?php echo esc_url($site_url . '/afterpay-car-repairs/'); ?>" class="sh-finance__pill">Afterpay</a>
      <a href="<?php echo esc_url($site_url . '/qcard-car-repairs/'); ?>" class="sh-finance__pill">Q Card</a>
      <a href="<?php echo esc_url($site_url . '/gem-finance-car-repairs/'); ?>" class="sh-finance__pill">Gem by Latitude</a>
      <a href="<?php echo esc_url($site_url . '/aotea-finance-car-repairs/'); ?>" class="sh-finance__pill">Aotea Finance</a>
      <span class="sh-finance__pill">Visa &amp; Mastercard</span>
    </div>
    <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="sh-btn sh-btn--yellow">View Finance Options</a>
  </div>
</div>


<!-- ══ ARRANGED SERVICES ══════════════════════════════════════════════════════ -->
<section class="sh-section sh-section--grey" aria-labelledby="sh-arranged-head">
  <div class="sh-w">
    <div class="sh-section-head">
      <h2 class="sh-section-head__h2" id="sh-arranged-head">Arranged Services</h2>
      <span class="sh-section-head__count">Via trusted partners</span>
    </div>
    <div class="sh-grid">
      <?php foreach ($groups['arranged'] as $s): ?>
      <a href="<?php echo esc_url($site_url . $s['url']); ?>" class="sh-card sh-card--arranged">
        <div class="sh-card__ph">
          <?php if (!empty($service_images[$s['title']])): ?>
            <img src="<?php echo esc_url($service_images[$s['title']]); ?>" alt="<?php echo esc_attr($s['title']); ?> — Tony Allen Auto Service" loading="lazy">
          <?php else: ?>
            <?php echo $service_icons[$s['title']] ?? ''; ?>
          <?php endif; ?>
        </div>
        <div class="sh-card__content">
          <span class="sh-card__badge sh-card__badge--arranged">Partner Service</span>
          <div class="sh-card__title"><?php echo esc_html($s['title']); ?></div>
          <p class="sh-card__sub"><?php echo esc_html($s['sub']); ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ FAQ ══════════════════════════════════════════════════════════════════════ -->
<section class="sh-section sh-faq" aria-labelledby="sh-faq-head">
  <div class="sh-w">
    <div class="sh-section-head">
      <h2 class="sh-section-head__h2" id="sh-faq-head">Common Questions</h2>
      <span class="sh-section-head__count"><?php echo count($sh_faqs); ?> answers</span>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 48px;max-width:100%;">
      <?php foreach ($sh_faqs as $i => $faq):
        $qid = 'sh-faq-q-' . $i;
        $aid = 'sh-faq-a-' . $i;
      ?>
      <div class="sh-faq__item" style="border-bottom:1px solid #E8E8E4;">
        <button id="<?php echo $qid; ?>" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>"
          style="width:100%;text-align:left;background:none;border:none;padding:16px 36px 16px 0;font-family:var(--taas-font);font-size:var(--taas-faq-q, 15px);font-weight:700;color:#1A1A1A;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;">
          <?php echo esc_html($faq['q']); ?>
          <span style="position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:20px;font-weight:300;color:#FFC800;line-height:1;"><?php echo $i===0?'−':'+'; ?></span>
        </button>
        <div id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>"
          style="<?php echo $i===0?'':'display:none;'; ?>padding:0 36px 16px 0;font-size:var(--taas-faq-a, 15px);color:#666;line-height:1.7;">
          <?php echo wp_kses_post($faq['a']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
(function(){
  document.querySelectorAll('.sh-faq button').forEach(function(btn){
    btn.addEventListener('click',function(){
      var open=this.getAttribute('aria-expanded')==='true';
      var ans=document.getElementById(this.getAttribute('aria-controls'));
      var icon=this.querySelector('span');
      document.querySelectorAll('.sh-faq button').forEach(function(b){
        b.setAttribute('aria-expanded','false');
        var a=document.getElementById(b.getAttribute('aria-controls'));
        if(a)a.style.display='none';
        var ic=b.querySelector('span');if(ic)ic.textContent='+';
      });
      if(!open){this.setAttribute('aria-expanded','true');ans.style.display='';if(icon)icon.textContent='−';}
    });
  });
})();
</script>


<!-- ══ CTA BAND ════════════════════════════════════════════════════════════════ -->
<section class="sh-cta" aria-label="Book now">
  <div class="sh-w">
    <h2 class="sh-cta__h2">Ready to <span>Book?</span></h2>
    <p class="sh-cta__sub"><?php echo esc_html($hours); ?> · 139 Cavendish Drive, Manukau</p>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="sh-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="sh-cta__btns">
      <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="sh-btn sh-btn--yellow">Book Online</a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="sh-btn sh-btn--outline">Call <?php echo esc_html($phone_local); ?></a>
    </div>
  </div>
</section>

</div><!-- /.taas-sh -->

<?php get_footer(); ?>
