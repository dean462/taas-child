<?php
/**
 * Template Name: Steering & Suspension Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /steering-and-suspension/
 * CSS namespace: .ssh-
 *
 * Section order (Go-Live Standard):
 * Hero → Phone Strip → Trust → Steering Services → Suspension Services →
 * Warning Signs → Educational → Pricing → Finance Strip → Enquiry →
 * Reviews → Suburbs → FAQ → Related
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url      = get_site_url();
$page_url      = get_permalink();
$established   = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years_trading = date('Y') - intval($established);
$phone_free    = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free_tel= str_replace(' ', '', $phone_free);
$email         = defined('TAAS_EMAIL')   ? TAAS_EMAIL   : 'enquiries@taas.co.nz';
$hours         = defined('TAAS_HOURS')   ? TAAS_HOURS   : 'Monday–Friday 7:30am–5:00pm';
$rating        = defined('TAAS_RATING')  ? TAAS_RATING  : '4.2';
$reviews       = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$cf7_general   = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$ms_number     = defined('TAAS_MS_NUMBER')   ? TAAS_MS_NUMBER   : 'MS 13890';
$customers     = defined('TAAS_CUSTOMERS')   ? TAAS_CUSTOMERS   : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list  = defined('TAAS_FINANCE_LIST') ? TAAS_FINANCE_LIST : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list      = defined('TAAS_MBI_LIST')     ? TAAS_MBI_LIST     : 'Autosure, Assurant, Provident, Janssen, Autolife';
$susp_price    = defined('TAAS_SUSPENSION_PRICE') ? TAAS_SUSPENSION_PRICE : 'from $300';
$align_price   = defined('TAAS_ALIGNMENT_PRICE')  ? TAAS_ALIGNMENT_PRICE  : 'from $100 incl. GST';
$euro_brands   = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// Hero image
$hero_image = defined('TAAS_HERO_SUSPENSION') ? TAAS_HERO_SUSPENSION
            : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');

// ── Badge helper ─────────────────────────────────────────────────────────────
function ssh_mono($initials, $size = 40) {
    $fs = strlen($initials) > 2 ? 11 : 14;
    return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 ' . $size . ' ' . $size . '" fill="none"><rect width="' . $size . '" height="' . $size . '" rx="8" fill="#1A1A1A"/><text x="' . ($size/2) . '" y="' . ($size/2 + 5) . '" text-anchor="middle" font-family="Inter,Arial,sans-serif" font-size="' . $fs . '" font-weight="700" fill="#FFC800">' . esc_html($initials) . '</text></svg>';
}

// ── Steering services ────────────────────────────────────────────────────────
$steering_services = [
    ['icon' => ssh_mono('SR'), 'title' => 'Steering Rack Repair', 'desc' => 'Leaking, heavy, or knocking steering rack — repaired or replaced. We diagnose before recommending replacement.', 'url' => '/steering-rack-repair-manukau/', 'cta' => 'Steering Rack →'],
    ['icon' => ssh_mono('PS'), 'title' => 'Power Steering Repair', 'desc' => 'Heavy steering, whining pump, or leaking fluid. Hydraulic and electric power steering systems serviced.', 'url' => '/power-steering-repair-manukau/', 'cta' => 'Power Steering →'],
    ['icon' => ssh_mono('TR'), 'title' => 'Tie Rod Replacement', 'desc' => 'Worn tie rod ends cause steering wander and uneven tyre wear. Replaced in pairs where required — wheel alignment included.', 'url' => '/tie-rod-replacement-manukau/', 'cta' => 'Tie Rods →'],
    ['icon' => ssh_mono('WA'), 'title' => 'Wheel Alignment', 'desc' => 'Four-wheel laser alignment ' . esc_html($align_price) . '. Before-and-after print-out. Done after any steering or suspension repair.', 'url' => '/wheel-alignment-manukau/', 'cta' => 'Wheel Alignment →'],
];

$suspension_services = [
    ['icon' => ssh_mono('SA'), 'title' => 'Shock Absorber Replacement', 'desc' => 'Worn shocks cause bouncing, poor braking, and WOF failure. Replaced in axle pairs. All makes including heavy SUVs and utes.', 'url' => '/shock-absorber-replacement-manukau/', 'cta' => 'Shock Absorbers →'],
    ['icon' => ssh_mono('BJ'), 'title' => 'Ball Joint Replacement', 'desc' => 'A failed ball joint is a loss-of-control event. Any clunking, vibration, or uneven wear gets checked before it becomes a WOF failure.', 'url' => '/ball-joint-replacement-manukau/', 'cta' => 'Ball Joints →'],
    ['icon' => ssh_mono('SB'), 'title' => 'Suspension Bush Replacement', 'desc' => 'Worn bushes cause noise, vibration, and poor handling. Rubber or polyurethane — pressed and fitted in-house.', 'url' => '/suspension-bush-replacement-manukau/', 'cta' => 'Suspension Bushes →'],
    ['icon' => ssh_mono('CA'), 'title' => 'Control Arm Replacement', 'desc' => 'Bent or worn control arms affect steering geometry and cause tyre wear. Replaced with correct-spec parts — alignment carried out after.', 'url' => '/control-arm-replacement-manukau/', 'cta' => 'Control Arms →'],
];

// ── Warning signs ────────────────────────────────────────────────────────────
$signs = [
    'Vehicle pulling left or right — steering wheel off-centre on a straight road',
    'Clunking or knocking noise over bumps or when turning',
    'Steering wheel vibrating or shuddering at certain speeds',
    'Excessive body roll through corners — vehicle feels unstable',
    'Bouncing or wallowing — vehicle does not settle after a bump',
    'Uneven or rapid tyre wear — one edge worn before the other',
    'Steering feels heavy, vague, or requires more effort than usual',
    'Vehicle sitting low on one corner — collapsed spring or shock',
    'Car failed WOF for steering or suspension',
];

// ── Suburbs (17 — including Botany) ──────────────────────────────────────────
$suburbs = [
    ['name' => 'Manukau',        'slug' => 'manukau'],
    ['name' => 'Papatoetoe',     'slug' => 'papatoetoe'],
    ['name' => 'Māngere',        'slug' => 'mangere'],
    ['name' => 'Māngere Bridge', 'slug' => 'mangere-bridge'],
    ['name' => 'Ōtāhuhu',       'slug' => 'otahuhu'],
    ['name' => 'Wiri',           'slug' => 'wiri'],
    ['name' => 'Ōtara',         'slug' => 'otara'],
    ['name' => 'Hunters Corner', 'slug' => 'hunters-corner'],
    ['name' => 'Clover Park',    'slug' => 'clover-park'],
    ['name' => 'Flat Bush',      'slug' => 'flat-bush'],
    ['name' => 'Manurewa',       'slug' => 'manurewa'],
    ['name' => 'Clendon',        'slug' => 'clendon'],
    ['name' => 'Weymouth',       'slug' => 'weymouth'],
    ['name' => 'Takanini',       'slug' => 'takanini'],
    ['name' => 'Papakura',       'slug' => 'papakura'],
    ['name' => 'Howick',         'slug' => 'howick'],
    ['name' => 'Botany',         'slug' => 'botany'],
];

// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['ss_pulling'],
    $taas_faqs['ss_shocks'],
    $taas_faqs['ss_ball_joint'],
    $taas_faqs['ss_alignment_after'],
    $taas_faqs['ss_shudder'],
    $taas_faqs['ss_wof_fail'],
    $taas_faqs['ss_cost'],
    $taas_faqs['ss_european'],
    $taas_faqs['ss_drive_broken'],
    $taas_faqs['ss_duration'],
    $taas_faqs['ss_finance'],
    $taas_faqs['ss_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => ['AutoRepair', 'LocalBusiness'],
            '@id'         => $site_url . '/#organization',
            'name'        => 'Tony Allen Auto Service',
            'url'         => $site_url,
            'description' => 'Steering and suspension repairs in Manukau, South Auckland. Shock absorbers, ball joints, tie rods, steering racks, bushes, control arms. Wheel alignment after every repair. ' . $years_trading . ' years trading.',
            'telephone'   => [$phone_local, $phone_free],
            'email'       => $email,
            'address'     => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive',
                              'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland',
                              'postalCode' => '2104', 'addressCountry' => 'NZ'],
            'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
            'foundingDate'=> '1985-10',
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
                'opens' => '07:30', 'closes' => '17:00']],
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating,
                                  'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'],
            'sameAs'         => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'paymentAccepted'=> 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'priceRange'     => '$$',
            'areaServed'     => 'South Auckland',
            'memberOf'       => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.ssh-hero__sub', '.ssh-faq__a:first-of-type']],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Steering & Suspension', 'item' => $page_url],
            ],
        ],
        [
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(function($f) {
                return ['@type' => 'Question', 'name' => $f['q'],
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($f['a'])]];
            }, $faqs),
        ],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ══ RESET ════════════════════════════════════════════════════════════════ */
.page-template-template-steering-suspension .site-content,
.page-template-template-steering-suspension .entry-content,
.page-template-template-steering-suspension .entry-header,
.page-template-template-steering-suspension article,
.page-template-template-steering-suspension #primary,
.page-template-template-steering-suspension #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-steering-suspension { overflow-x:hidden; }
.taas-ssh *, .taas-ssh *::before, .taas-ssh *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-ssh { font-family:var(--taas-font,'Inter',Arial,sans-serif); -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }
.ssh-w { max-width:var(--taas-container,1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ══════════════════════════════════════════════════════════ */
.ssh-bc { background:var(--taas-black,#111111); padding:14px 0 0; }
.ssh-bc__list { list-style:none; display:flex; gap:6px; align-items:center; font-size:12px; color:#666; }
.ssh-bc__list a { color:#888; text-decoration:none; }
.ssh-bc__list a:hover { color:var(--taas-yellow,#FFC800); }
.ssh-bc__sep { color:#444; }
.ssh-bc__current { color:#aaa; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.ssh-hero { background:var(--taas-black,#111111); padding:0 0 60px; position:relative; }
.ssh-hero--has-image { background-size:cover; background-position:center 40%; }
.ssh-hero--has-image::before { content:''; position:absolute; inset:0; background:rgba(13,13,13,0.82); }
.ssh-hero__inner { position:relative; z-index:1; display:grid; grid-template-columns:1fr 280px; gap:48px; align-items:start; padding-top:32px; }
.ssh-hero__eyebrow { display:inline-block; background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:5px 14px; border-radius:3px; margin-bottom:20px; }
.ssh-hero h1 { font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px)); font-weight:800; color:#fff; letter-spacing:-0.02em; line-height:1.1; margin-bottom:16px; }
.ssh-hero h1 span { color:var(--taas-yellow,#FFC800); }
.ssh-hero__sub { font-size:16px; font-weight:300; color:#aaa; max-width:560px; margin-bottom:16px; line-height:1.75; letter-spacing:-0.1px; }
.ssh-hero__signal { display:inline-block; background:rgba(255,200,0,.1); border:1px solid rgba(255,200,0,.25); border-radius:var(--taas-radius,6px); padding:10px 18px; font-size:14px; font-weight:600; color:var(--taas-yellow,#FFC800); margin-bottom:24px; }
.ssh-hero__ctas { display:flex; gap:12px; flex-wrap:wrap; }
.ssh-hero__urgency { margin-top:24px; background:rgba(192,57,43,.12); border:1px solid rgba(192,57,43,.35); border-left:4px solid var(--taas-alert,#C0392B); border-radius:var(--taas-radius,6px); padding:14px 18px; font-size:14px; font-weight:300; color:#f5a0a0; line-height:1.75; max-width:580px; }
.ssh-hero__urgency strong { color:#ff6b6b; font-weight:700; }
.ssh-sidebar { background:#1e1e1e; border:1px solid #333; border-radius:var(--taas-radius,6px); padding:24px; }
.ssh-sidebar__title { font-size:11px; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:14px; }
.ssh-sidebar__list { list-style:none; display:flex; flex-direction:column; gap:8px; margin-bottom:20px; }
.ssh-sidebar__list li { font-size:13px; color:#ccc; padding-left:18px; position:relative; line-height:1.4; }
.ssh-sidebar__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow,#FFC800); font-weight:700; }
.ssh-sidebar hr { border:none; border-top:1px solid #333; margin-bottom:16px; }
.ssh-sidebar__phone { display:block; font-size:22px; font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-bottom:4px; line-height:1.1; }
.ssh-sidebar__phone:hover { opacity:.65; }
.ssh-sidebar__detail { font-size:12px; color:#666; line-height:1.6; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════ */
.ssh-pstrip { background:var(--taas-yellow,#FFC800); padding:18px 0; }
.ssh-pstrip__inner { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
.ssh-pstrip__left { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.ssh-pstrip__lbl { font-size:10px; font-weight:800; letter-spacing:.16em; text-transform:uppercase; color:var(--taas-dark,#1A1A1A); }
.ssh-pstrip__num { font-size:28px; font-weight:900; color:var(--taas-dark,#1A1A1A); text-decoration:none; }
.ssh-pstrip__num:hover { opacity:.65; }
.ssh-pstrip__hours { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); opacity:.75; }
.ssh-pstrip__email { display:inline-flex; align-items:center; gap:6px; background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); font-size:13px; font-weight:600; padding:8px 16px; border-radius:var(--taas-radius,6px); text-decoration:none; transition:background .15s; }
.ssh-pstrip__email:hover { background:#333; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════ */
.ssh-trust { background:var(--taas-panel,#F7F7F5); padding:16px 0; border-bottom:1px solid var(--taas-border,#E8E8E4); }
.ssh-trust__inner { display:flex; gap:32px; align-items:center; justify-content:center; flex-wrap:wrap; }
.ssh-trust__item { font-size:13px; font-weight:600; color:var(--taas-dark,#1A1A1A); display:flex; align-items:center; gap:7px; white-space:nowrap; }
.ssh-trust__item::before { content:'✓'; font-weight:900; color:var(--taas-yellow,#FFC800); }

/* ══ SECTIONS ════════════════════════════════════════════════════════════ */
.ssh-section { padding:72px 0; }
.ssh-section--white { background:var(--taas-white,#FFFFFF); }
.ssh-section--grey  { background:var(--taas-panel,#F7F7F5); }
.ssh-section--dark  { background:var(--taas-dark,#1A1A1A); }
.ssh-eyebrow { display:inline-block; font-size:var(--taas-eye-size,10px); font-weight:700; letter-spacing:var(--taas-eye-ls,0.12em); text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px; }
.ssh-eyebrow--dark { background:var(--taas-dark,#1A1A1A); color:var(--taas-yellow,#FFC800); }
.ssh-eyebrow--yellow { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }
.ssh-h2 { font-size:var(--taas-h2,clamp(26px,3.5vw,36px)); font-weight:700; color:var(--taas-black,#111111); letter-spacing:-0.01em; margin-bottom:12px; line-height:1.15; }
.ssh-h2--white { color:var(--taas-white,#FFFFFF); }
.ssh-lead { font-size:16px; font-weight:300; color:var(--taas-mid,#666666); max-width:640px; margin-bottom:32px; line-height:1.75; letter-spacing:-0.1px; }
.ssh-section--dark .ssh-lead { color:#aaa; }

/* ══ SERVICE CARDS ═══════════════════════════════════════════════════════ */
.ssh-svc-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:16px; }
.ssh-svc-card { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:24px; display:flex; flex-direction:column; gap:10px; text-decoration:none; transition:border-color .15s,box-shadow .15s; border-top:3px solid transparent; }
.ssh-svc-card:hover { border-top-color:var(--taas-yellow,#FFC800); box-shadow:0 4px 16px rgba(0,0,0,.08); }
.ssh-svc-card__title { font-size:16px; font-weight:700; color:var(--taas-black,#111111); }
.ssh-svc-card__desc { font-size:14px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; flex:1; }
.ssh-svc-card__link { font-size:13px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; }
.ssh-svc-card:hover .ssh-svc-card__link { text-decoration:underline; }
.ssh-wof-banner { background:var(--taas-panel,#F7F7F5); border-left:5px solid var(--taas-yellow,#FFC800); border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; padding:20px 24px; margin-top:32px; display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap; }
.ssh-wof-banner p { font-size:15px; font-weight:300; color:var(--taas-body,#333333); margin:0; line-height:1.75; }
.ssh-wof-banner strong { color:var(--taas-black,#111111); font-weight:700; }

/* ══ WARNING SIGNS ═══════════════════════════════════════════════════════ */
.ssh-signs__inner { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.ssh-signs-list { list-style:none; display:flex; flex-direction:column; }
.ssh-signs-item { display:flex; align-items:flex-start; gap:14px; padding:14px 0; border-bottom:1px solid #2a2a2a; font-size:15px; font-weight:300; color:#ccc; line-height:1.75; }
.ssh-signs-item:last-child { border-bottom:none; }
.ssh-signs-item::before { content:'!'; color:#fff; background:var(--taas-alert,#C0392B); font-size:10px; font-weight:900; width:20px; height:20px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px; }
.ssh-signs__card { background:#161616; border:1px solid #2a2a2a; border-radius:var(--taas-radius,6px); padding:32px; }
.ssh-signs__card h3 { font-size:18px; font-weight:700; color:var(--taas-yellow,#FFC800); margin-bottom:12px; }
.ssh-signs__card p { font-size:14px; font-weight:300; color:#888; line-height:1.75; margin-bottom:20px; }

/* ══ EDUCATIONAL ═════════════════════════════════════════════════════════ */
.ssh-edu { max-width:780px; }
.ssh-edu p { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; margin-bottom:20px; }
.ssh-edu h3 { font-size:18px; font-weight:700; color:var(--taas-black,#111111); margin:32px 0 12px; }
.ssh-edu__alert { background:rgba(192,57,43,.06); border-left:4px solid var(--taas-alert,#C0392B); border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; padding:16px 20px; margin-bottom:28px; }
.ssh-edu__alert p { font-size:14px; font-weight:300; color:var(--taas-body,#333333); line-height:1.75; margin-bottom:12px; }
.ssh-edu__alert p:last-child { margin-bottom:0; }
.ssh-edu__alert strong { color:var(--taas-alert,#C0392B); font-weight:700; }

/* ══ PRICING ═════════════════════════════════════════════════════════════ */
.ssh-pricing { max-width:780px; }
.ssh-pricing p { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; margin-bottom:20px; }
.ssh-pricing__cards { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:24px; }
.ssh-pricing__card { background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); padding:20px; border-top:3px solid var(--taas-yellow,#FFC800); }
.ssh-pricing__card-label { font-size:14px; font-weight:700; color:var(--taas-black,#111111); margin-bottom:6px; }
.ssh-pricing__card-price { font-size:22px; font-weight:800; color:var(--taas-yellow,#FFC800); }
.ssh-pricing__card-note { font-size:13px; font-weight:300; color:var(--taas-mid,#666666); margin-top:6px; line-height:1.5; }

/* ══ FINANCE STRIP ═══════════════════════════════════════════════════════ */
.ssh-finance { background:var(--taas-panel,#F7F7F5); padding:40px 0; border-top:1px solid var(--taas-border,#E8E8E4); }
.ssh-finance__inner { text-align:center; }
.ssh-finance__heading { font-size:18px; font-weight:700; color:var(--taas-dark,#1A1A1A); margin-bottom:6px; }
.ssh-finance__sub { font-size:15px; font-weight:300; color:var(--taas-mid,#666666); margin-bottom:24px; line-height:1.75; }
.ssh-finance__logos { display:flex; align-items:center; justify-content:center; gap:28px; flex-wrap:wrap; }
.ssh-finance__logo-img { height:36px; width:auto; object-fit:contain; transition:transform .15s; }
.ssh-finance__logo-img:hover { transform:scale(1.05); }
.ssh-finance__link { display:inline-block; margin-top:16px; font-size:14px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; }
.ssh-finance__link:hover { text-decoration:underline; }

/* ══ ENQUIRY ═════════════════════════════════════════════════════════════ */
.ssh-enquiry { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.ssh-enquiry__phone { display:block; font-size:clamp(28px,4vw,40px); font-weight:800; color:var(--taas-yellow,#FFC800); text-decoration:none; margin:16px 0 6px; }
.ssh-enquiry__phone:hover { opacity:.65; }
.ssh-enquiry__detail { font-size:15px; font-weight:300; color:#aaa; line-height:1.75; }
.ssh-enquiry__detail strong { color:var(--taas-white,#FFFFFF); font-weight:700; }
.ssh-enquiry__estimate { margin-top:20px; padding:14px 18px; background:rgba(255,200,0,.08); border-left:3px solid var(--taas-yellow,#FFC800); border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0; font-size:14px; font-weight:600; color:var(--taas-yellow,#FFC800); line-height:1.5; }
.ssh-enquiry__finance-logos { display:flex; gap:10px; flex-wrap:wrap; margin-top:20px; align-items:center; }
.ssh-enquiry__fin-img { height:32px; width:auto; object-fit:contain; background:#fff; border-radius:6px; padding:8px 14px; transition:transform .15s; }
.ssh-enquiry__fin-img:hover { transform:scale(1.05); }
.ssh-enquiry__fin-link { font-size:12px; font-weight:700; color:var(--taas-yellow,#FFC800); text-decoration:none; margin-top:8px; display:inline-block; }
.ssh-enquiry__fin-link:hover { text-decoration:underline; }
.ssh-enquiry__form-title { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--taas-yellow,#FFC800); margin-bottom:16px; }
/* Dark form */
.ssh-section--dark .wpcf7 label { font-size:11px!important; font-weight:700!important; letter-spacing:.08em!important; text-transform:uppercase!important; color:#888!important; display:block!important; }
.ssh-section--dark .wpcf7 input[type="text"], .ssh-section--dark .wpcf7 input[type="email"], .ssh-section--dark .wpcf7 input[type="tel"], .ssh-section--dark .wpcf7 textarea { background:#1c1c1c!important; border:1px solid #333!important; color:#fff!important; border-radius:var(--taas-radius,6px)!important; padding:12px 14px!important; width:100%!important; font-size:15px!important; font-family:var(--taas-font,'Inter',Arial,sans-serif)!important; font-weight:300!important; box-sizing:border-box!important; margin-top:4px!important; transition:border-color .15s!important; }
.ssh-section--dark .wpcf7 input::placeholder, .ssh-section--dark .wpcf7 textarea::placeholder { color:#666; }
.ssh-section--dark .wpcf7 input:focus, .ssh-section--dark .wpcf7 textarea:focus { outline:none!important; border-color:var(--taas-yellow,#FFC800)!important; }
.ssh-section--dark .wpcf7 textarea { min-height:100px!important; resize:vertical!important; }
.ssh-section--dark .wpcf7 input[type="submit"] { background:var(--taas-yellow,#FFC800)!important; color:var(--taas-dark,#1A1A1A)!important; font-weight:700!important; font-size:14px!important; letter-spacing:.04em!important; text-transform:uppercase!important; border:none!important; padding:14px 28px!important; border-radius:var(--taas-radius,6px)!important; cursor:pointer!important; width:100%!important; margin-top:4px!important; }
.ssh-section--dark .wpcf7 input[type="submit"]:hover { background:var(--taas-yellow2,#e6b400)!important; }

/* ══ SUBURB PILLS ════════════════════════════════════════════════════════ */
.ssh-suburb-pills { display:flex; flex-wrap:wrap; gap:8px; margin-top:16px; }
.ssh-suburb-pill { display:inline-block; padding:7px 18px; background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:100px; font-size:14px; font-weight:500; color:var(--taas-body,#333333); text-decoration:none; transition:all .15s; }
.ssh-suburb-pill:hover { background:var(--taas-yellow,#FFC800); border-color:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }

/* ══ RELATED ═════════════════════════════════════════════════════════════ */
.ssh-related__grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:12px; margin-top:24px; }
.ssh-related__link { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:var(--taas-white,#FFFFFF); border:1px solid var(--taas-border,#E8E8E4); border-radius:var(--taas-radius,6px); text-decoration:none; font-size:14px; font-weight:700; color:var(--taas-black,#111111); transition:border-color .15s; }
.ssh-related__link:hover { border-color:var(--taas-yellow,#FFC800); }
.ssh-related__link span { color:var(--taas-yellow,#FFC800); font-size:18px; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════ */
.ssh-faq__list { display:flex; flex-direction:column; max-width:780px; margin:28px auto 0; }
.ssh-faq__item { border-bottom:1px solid var(--taas-border,#E8E8E4); }
.ssh-faq__q { width:100%; text-align:left; background:none; border:none; padding:18px 40px 18px 0; font-size:15px; font-weight:700; color:var(--taas-black,#111111); cursor:pointer; position:relative; line-height:1.4; display:block; font-family:inherit; }
.ssh-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:400; color:var(--taas-mid,#666666); transition:transform .2s; }
.ssh-faq__item--open .ssh-faq__q::after { content:'−'; }
.ssh-faq__a { display:none; padding:0 0 18px; font-size:15px; font-weight:300; color:var(--taas-mid,#666666); line-height:1.75; }
.ssh-faq__a a { color:var(--taas-yellow,#FFC800); font-weight:600; text-decoration:none; }
.ssh-faq__a a:hover { text-decoration:underline; }
.ssh-faq__item--open .ssh-faq__a { display:block; }

/* ══ BUTTONS ═════════════════════════════════════════════════════════════ */
.ssh-btn { display:inline-flex; align-items:center; gap:8px; padding:14px 28px; border-radius:var(--taas-radius,6px); font-size:var(--taas-btn-size,14px); font-weight:700; text-decoration:none; text-transform:uppercase; letter-spacing:.05em; transition:background .15s,color .15s,border-color .15s,transform .15s; border:2px solid transparent; white-space:nowrap; }
.ssh-btn--primary { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); border-color:var(--taas-yellow,#FFC800); }
.ssh-btn--primary:hover { background:var(--taas-yellow2,#e6b400); border-color:var(--taas-yellow2,#e6b400); transform:translateY(-1px); }
.ssh-btn--outline { background:transparent; color:var(--taas-yellow,#FFC800); border:2px solid var(--taas-yellow,#FFC800); }
.ssh-btn--outline:hover { background:var(--taas-yellow,#FFC800); color:var(--taas-dark,#1A1A1A); }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media (max-width:960px) {
  .ssh-hero__inner { grid-template-columns:1fr; }
  .ssh-sidebar { display:none; }
  .ssh-svc-grid { grid-template-columns:1fr; }
  .ssh-signs__inner { grid-template-columns:1fr; }
  .ssh-enquiry { grid-template-columns:1fr; gap:32px; }
  .ssh-pricing__cards { grid-template-columns:1fr; }
}
@media (max-width:640px) {
  .ssh-hero { padding-bottom:40px; }
  .ssh-hero h1 { font-size:clamp(28px,7vw,42px); }
  .ssh-hero__sub { font-size:14px; }
  .ssh-hero__ctas { flex-direction:column; align-items:stretch; }
  .ssh-hero__ctas .ssh-btn { justify-content:center; text-align:center; }
  .ssh-section { padding:48px 0; }
  .ssh-h2 { font-size:clamp(22px,5vw,28px); }
  .ssh-lead { font-size:14px; }
  .ssh-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .ssh-trust__item { font-size:12px; }
  .ssh-faq__q { font-size:14px; padding:16px 32px 16px 0; }
  .ssh-faq__a { font-size:14px; }
  /* Body text — all 14px on mobile */
  .ssh-edu p { font-size:14px; }
  .ssh-pricing p { font-size:14px; }
  .ssh-signs-item { font-size:14px; }
  .ssh-signs__card p { font-size:13px; }
  .ssh-wof-banner p { font-size:14px; }
  .ssh-enquiry__detail { font-size:14px; }
  .ssh-svc-card__desc { font-size:13px; }
  .ssh-finance__heading { font-size:16px; }
  .ssh-finance__sub { font-size:14px; }
  .ssh-enquiry__phone { font-size:clamp(24px,6vw,32px); }
  /* Mobile: form first, contact below */
  .ssh-enquiry { display:flex; flex-direction:column-reverse; gap:32px; }
  /* Phone strip */
  .ssh-pstrip__inner { flex-direction:column; text-align:center; gap:6px; }
  .ssh-pstrip__left { flex-direction:column; gap:4px; }
  .ssh-pstrip__lbl { display:none; }
  .ssh-pstrip__num { font-size:22px; }
  .ssh-pstrip__hours { font-size:12px; }
  /* Finance */
  .ssh-finance__logos { gap:16px; }
  .ssh-finance__logo-img { height:28px; }
  .ssh-enquiry__fin-img { height:28px; padding:6px 10px; }
}
</style>

<div class="taas-ssh">

<!-- ══ BREADCRUMB ════════════════════════════════════════════════════════ -->
<nav class="ssh-bc" aria-label="Breadcrumb"><div class="ssh-w">
  <ol class="ssh-bc__list">
    <li><a href="<?php echo esc_url($site_url); ?>">Home</a></li>
    <li class="ssh-bc__sep">›</li>
    <li><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a></li>
    <li class="ssh-bc__sep">›</li>
    <li class="ssh-bc__current">Steering &amp; Suspension</li>
  </ol>
</div></nav>

<!-- ══ HERO ══════════════════════════════════════════════════════════════ -->
<section class="ssh-hero<?php echo $hero_image ? ' ssh-hero--has-image' : ''; ?>"<?php echo $hero_image ? ' style="background-image:url(' . esc_url($site_url . $hero_image) . ');"' : ''; ?>>
  <div class="ssh-w">
    <div class="ssh-hero__inner">
      <div>
        <span class="ssh-hero__eyebrow">Steering &amp; Suspension — Manukau</span>
        <h1>Steering &amp; Suspension<br><span>Repairs — Manukau</span></h1>
        <p class="ssh-hero__sub">Shock absorbers, ball joints, steering racks, tie rods, bushes, and control arms. In-house WOF suspension test lane. Wheel alignment after every repair. All makes and models. Suspension repairs <?php echo esc_html($susp_price); ?>.</p>
        <div class="ssh-hero__signal">Estimate before we start · WOF test lane on-site · Wheel alignment included</div>
        <div class="ssh-hero__ctas">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssh-btn ssh-btn--primary">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <?php echo esc_html($phone_free); ?>
          </a>
          <a href="#ssh-enquire" class="ssh-btn ssh-btn--outline">Book Online</a>
        </div>
        <div class="ssh-hero__urgency">
          <strong>⚠ Do not ignore steering or suspension faults.</strong> A worn ball joint or failed tie rod end can cause loss of vehicle control without warning. If your vehicle is pulling, clunking, or handling differently — get it checked before your next trip.
        </div>
      </div>
      <div class="ssh-sidebar">
        <div class="ssh-sidebar__title">We Service</div>
        <ul class="ssh-sidebar__list">
          <li>Steering rack repair &amp; replacement</li>
          <li>Power steering — hydraulic &amp; electric</li>
          <li>Tie rod ends</li>
          <li>Shock absorbers — all makes</li>
          <li>Ball joints</li>
          <li>Suspension bushes — rubber &amp; poly</li>
          <li>Control arms</li>
          <li>Coil springs</li>
          <li>Wheel alignment after every repair</li>
          <li>WOF suspension test lane on-site</li>
        </ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ssh-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ══════════════════════════════════════════════════════ -->
<div class="ssh-pstrip"><div class="ssh-w">
  <div class="ssh-pstrip__inner">
    <div class="ssh-pstrip__left">
      <span class="ssh-pstrip__lbl">Book Now</span>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssh-pstrip__num"><?php echo esc_html($phone_free); ?></a>
      <span class="ssh-pstrip__hours"><?php echo esc_html($hours); ?></span>
    </div>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="ssh-pstrip__email">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      <?php echo esc_html($email); ?>
    </a>
  </div>
</div></div>

<!-- ══ TRUST ═════════════════════════════════════════════════════════════ -->
<div class="ssh-trust"><div class="ssh-w">
  <div class="ssh-trust__inner">
    <div class="ssh-trust__item">MTA Assured</div>
    <div class="ssh-trust__item">NZTA Authorised</div>
    <div class="ssh-trust__item">Estimate Before We Start</div>
    <div class="ssh-trust__item">WOF Suspension Test Lane</div>
    <div class="ssh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="ssh-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div></div>

<!-- ══ STEERING SERVICES ════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--white">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">Steering Services</span>
    <h2 class="ssh-h2">Steering Repairs &amp; Service — All In-House</h2>
    <p class="ssh-lead">Rack and pinion, power steering, tie rod ends and steering joints. Diagnosed and repaired at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
    <div class="ssh-svc-grid">
      <?php foreach ($steering_services as $svc): ?>
      <a href="<?php echo esc_url($site_url . $svc['url']); ?>" class="ssh-svc-card">
        <?php echo $svc['icon']; ?>
        <div class="ssh-svc-card__title"><?php echo esc_html($svc['title']); ?></div>
        <div class="ssh-svc-card__desc"><?php echo esc_html($svc['desc']); ?></div>
        <span class="ssh-svc-card__link"><?php echo $svc['cta']; ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ SUSPENSION SERVICES ══════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--grey">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">Suspension Services</span>
    <h2 class="ssh-h2">Suspension Repairs — Shocks, Ball Joints &amp; More</h2>
    <p class="ssh-lead">Shock absorbers, ball joints, suspension bushes, and control arms. Wheel alignment carried out after every suspension repair.</p>
    <div class="ssh-svc-grid">
      <?php foreach ($suspension_services as $svc): ?>
      <a href="<?php echo esc_url($site_url . $svc['url']); ?>" class="ssh-svc-card">
        <?php echo $svc['icon']; ?>
        <div class="ssh-svc-card__title"><?php echo esc_html($svc['title']); ?></div>
        <div class="ssh-svc-card__desc"><?php echo esc_html($svc['desc']); ?></div>
        <span class="ssh-svc-card__link"><?php echo $svc['cta']; ?></span>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="ssh-wof-banner">
      <p><strong>WOF suspension failure?</strong> We carry out the repair and recheck the failed items on the same visit where possible. No need to rebook — call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-black,#111111);"><?php echo esc_html($phone_free); ?></a>.</p>
      <a href="<?php echo esc_url($site_url . '/wof/'); ?>" class="ssh-btn ssh-btn--primary" style="flex-shrink:0;">WOF Information →</a>
    </div>
  </div>
</section>

<!-- ══ WARNING SIGNS ════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--dark">
  <div class="ssh-w">
    <div class="ssh-signs__inner">
      <div>
        <span class="ssh-eyebrow ssh-eyebrow--yellow">Warning Signs</span>
        <h2 class="ssh-h2 ssh-h2--white">Signs Your Steering or Suspension Needs Attention</h2>
        <p class="ssh-lead" style="color:#888;">Any of these is worth getting checked — leaving steering or suspension faults causes tyre wear, WOF failure, and in serious cases loss of vehicle control.</p>
        <ul class="ssh-signs-list">
          <?php foreach ($signs as $sign): ?>
          <li class="ssh-signs-item"><?php echo esc_html($sign); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="ssh-signs__card">
        <h3>Not Sure What You Are Hearing?</h3>
        <p>Describe the noise, when it happens, and whether it is worse turning left or right, going over bumps, or at speed. We can usually narrow down the likely cause over the phone before you book.</p>
        <p>If the noise appeared suddenly or the vehicle is handling very differently — do not wait. Call us directly.</p>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssh-btn ssh-btn--primary"><?php echo esc_html($phone_free); ?></a>
          <a href="#ssh-enquire" class="ssh-btn ssh-btn--outline">Book Online</a>
        </div>
        <div style="margin-top:16px;font-size:12px;color:#555;"><?php echo esc_html($hours); ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ══ UNDERSTANDING S&S ════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--white">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">Understanding Your Vehicle</span>
    <h2 class="ssh-h2">How Your Steering &amp; Suspension Works — and Why It Matters</h2>
    <div class="ssh-edu">
      <p>Steering and suspension are two separate systems that work together to keep your vehicle safe, stable, and controllable. When one degrades, the other suffers — and the driver pays the price in tyre wear, poor handling, and ultimately a WOF failure or loss of control.</p>

      <h3>Steering — How You Control Direction</h3>
      <p>Your steering system converts the movement of the steering wheel into the precise turning of the front wheels. The steering rack sits across the front of the vehicle and connects to each wheel via tie rod ends. Power steering — either hydraulic or electric — assists the driver so the wheel turns easily at low speed and remains stable at highway speed. When any part of this system wears — a leaking steering rack, worn tie rod ends, a failing power steering pump — the vehicle becomes harder to control, pulls to one side, or develops play in the steering wheel.</p>

      <h3>Suspension — What Keeps You on the Road</h3>
      <p>The suspension system absorbs road surface imperfections so the cabin remains comfortable, keeps the tyres in firm contact with the road so the vehicle brakes and corners effectively, and controls body roll so the vehicle remains stable through turns. Shock absorbers, coil springs, ball joints, suspension bushes, and control arms all work together. When shock absorbers wear, the vehicle bounces and the tyres lose contact with the road — braking distance increases significantly.</p>

      <h3>Why This Is Safety-Critical — Not Just Comfort</h3>
      <div class="ssh-edu__alert">
        <p><strong>Worn suspension increases braking distance.</strong> Most drivers do not realise this. When shock absorbers are worn, the tyres lose contact with the road surface during braking — the vehicle takes longer to stop. In wet conditions, the effect is even more pronounced.</p>
        <p><strong>A failed ball joint means immediate loss of steering control.</strong> A ball joint connects the control arm to the wheel hub. If it separates — and severely worn ball joints can separate without warning — the wheel collapses and the vehicle becomes unsteerable. This is why ball joint condition is checked at every WOF.</p>
      </div>

      <h3>The WOF Connection</h3>
      <p>Steering and suspension components are among the most common WOF failure items. Our workshop has an in-house suspension test lane — the same equipment used during WOF inspections — so we can identify problems before your WOF and carry out the repair and recheck on the same visit where possible.</p>
      <p>If your vehicle has failed a WOF for steering or suspension, or you want to avoid a failure, call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;"><?php echo esc_html($phone_free); ?></a>. We provide an estimate before any work begins.</p>
    </div>
  </div>
</section>

<!-- ══ PRICING ═══════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--grey">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">Pricing</span>
    <h2 class="ssh-h2">How Much Do Steering &amp; Suspension Repairs Cost?</h2>
    <div class="ssh-pricing">
      <p>Steering and suspension repair costs vary depending on the vehicle, the component, and whether parts are available same-day. A tie rod replacement on a Japanese sedan is a very different job to a steering rack replacement on a European SUV.</p>
      <p>We understand that pricing uncertainty stops people from calling. That is why we always provide an estimate before starting any work. No surprises, no unapproved charges.</p>
      <div class="ssh-pricing__cards">
        <div class="ssh-pricing__card">
          <div class="ssh-pricing__card-label">Suspension Repairs</div>
          <div class="ssh-pricing__card-price"><?php echo esc_html($susp_price); ?></div>
          <p class="ssh-pricing__card-note">Depends on vehicle and parts required</p>
        </div>
        <div class="ssh-pricing__card">
          <div class="ssh-pricing__card-label">Wheel Alignment</div>
          <div class="ssh-pricing__card-price"><?php echo esc_html($align_price); ?></div>
          <p class="ssh-pricing__card-note">Included after every geometry repair</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ FINANCE STRIP ════════════════════════════════════════════════════ -->
<div class="ssh-finance"><div class="ssh-w">
  <div class="ssh-finance__inner">
    <div class="ssh-finance__heading">Safety Shouldn't Wait — Finance Available</div>
    <p class="ssh-finance__sub">Steering and suspension repairs are safety-critical. Spread the cost with interest-free options.</p>
    <div class="ssh-finance__logos">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="ssh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="ssh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="ssh-finance__logo-img" height="36" loading="lazy">
      <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="ssh-finance__logo-img" height="36" loading="lazy">
    </div>
    <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="ssh-finance__link">View all finance options →</a>
  </div>
</div></div>

<!-- ══ ENQUIRY ═══════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--dark" id="ssh-enquire" style="border-top:3px solid var(--taas-yellow,#FFC800);">
  <div class="ssh-w">
    <div class="ssh-enquiry">
      <div>
        <span class="ssh-eyebrow ssh-eyebrow--yellow">Book or Enquire</span>
        <h2 class="ssh-h2 ssh-h2--white">Book a Steering &amp; Suspension Check</h2>
        <p style="font-size:15px;font-weight:300;color:#aaa;line-height:1.75;letter-spacing:-0.1px;margin-bottom:8px;">Tell us what your vehicle is doing — pulling, clunking, bouncing, vibrating. We will advise on the next step.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ssh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ssh-enquiry__detail">
          <strong>Tony Allen Auto Service</strong><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>
          <?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?>
        </div>
        <div class="ssh-enquiry__estimate">Estimate before we start — nothing happens without your approval.</div>
        <div class="ssh-enquiry__finance-logos">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="ssh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="ssh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="ssh-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="ssh-enquiry__fin-img" height="32" loading="lazy">
        </div>
        <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="ssh-enquiry__fin-link">Finance options →</a>
      </div>
      <div>
        <div class="ssh-enquiry__form-title">Send Us Your Details</div>
        <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
        <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow,#FFC800);"><?php echo esc_html($phone_free); ?></a> or email <a href="mailto:<?php echo esc_attr($email); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;"><?php echo esc_html($email); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ══ REVIEWS ═══════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--white">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="ssh-h2">What Customers Say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══ SUBURBS ═══════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--grey">
  <div class="ssh-w">
    <h2 class="ssh-h2">Steering &amp; Suspension Repairs — South Auckland Areas</h2>
    <p style="font-size:14px;font-weight:300;color:var(--taas-mid,#666666);margin-bottom:16px;line-height:1.75;">Serving all South Auckland suburbs from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
    <div class="ssh-suburb-pills">
      <?php foreach ($suburbs as $s): ?>
      <a href="<?php echo esc_url($site_url . '/shock-absorber-replacement-' . $s['slug'] . '/'); ?>" class="ssh-suburb-pill"><?php echo esc_html($s['name']); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ FAQ ═══════════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--white">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">FAQ</span>
    <h2 class="ssh-h2">Steering &amp; Suspension FAQ</h2>
    <div class="ssh-faq__list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="ssh-faq__item<?php echo $i === 0 ? ' ssh-faq__item--open' : ''; ?>">
        <button class="ssh-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="ssh-faq__a"><?php echo wp_kses_post($faq['a']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ RELATED ═══════════════════════════════════════════════════════════ -->
<section class="ssh-section ssh-section--grey">
  <div class="ssh-w">
    <span class="ssh-eyebrow ssh-eyebrow--dark">Related Services</span>
    <h2 class="ssh-h2">Often Done at the Same Visit</h2>
    <div class="ssh-related__grid">
      <?php foreach ([
        ['label' => 'Wheel Alignment',    'url' => '/wheel-alignment-manukau/'],
        ['label' => 'Warrant of Fitness',  'url' => '/wof/'],
        ['label' => 'Tyre Centre',         'url' => '/tyre-centre/'],
        ['label' => 'Brakes &amp; Clutch', 'url' => '/manukau-brake-clutch/'],
        ['label' => 'Vehicle Servicing',   'url' => '/vehicle-servicing/'],
        ['label' => 'Finance Options',     'url' => '/finance-options/'],
      ] as $r): ?>
      <a href="<?php echo esc_url($site_url . $r['url']); ?>" class="ssh-related__link"><?php echo $r['label']; ?><span>→</span></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- .taas-ssh -->

<script>
(function(){
  document.querySelectorAll('.ssh-faq__q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = this.closest('.ssh-faq__item');
      var wasOpen = item.classList.contains('ssh-faq__item--open');
      document.querySelectorAll('.ssh-faq__item--open').forEach(function(el){
        el.classList.remove('ssh-faq__item--open');
        el.querySelector('.ssh-faq__q').setAttribute('aria-expanded','false');
      });
      if (!wasOpen) {
        item.classList.add('ssh-faq__item--open');
        this.setAttribute('aria-expanded','true');
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
