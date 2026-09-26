<?php
/**
 * Template Name: Cooling System Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /cooling-system/
 * CSS namespace: .csh
 * Rebuilt to Go-Live Standard — June 2026
 * Section order: Breadcrumb → Hero(img) → Phone strip → Trust(grey) →
 *   Educational → Services → Finance strip → Why → Enquiry(dark)
 *   → Reviews → Related → FAQ → Closing CTA
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$years          = date('Y') - intval($established);
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Cooling system pricing ───────────────────────────────────────────────────
$cs_flush       = defined('TAAS_CS_FLUSH')       ? TAAS_CS_FLUSH       : 'from $250';
$cs_thermostat  = defined('TAAS_CS_THERMOSTAT')  ? TAAS_CS_THERMOSTAT  : 'from $200';
$cs_radiator    = defined('TAAS_CS_RADIATOR')    ? TAAS_CS_RADIATOR    : 'from $800';
$cs_heatercore  = defined('TAAS_CS_HEATERCORE')  ? TAAS_CS_HEATERCORE  : 'from $1,500';
$cs_headgasket  = defined('TAAS_CS_HEADGASKET')  ? TAAS_CS_HEADGASKET  : 'from $3,000';
$cs_headmachine = defined('TAAS_CS_HEADMACHINE') ? TAAS_CS_HEADMACHINE : '$400–$600';

// ── Hero image ───────────────────────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_COOLING') ? TAAS_HERO_COOLING : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

// ── Badge helper ─────────────────────────────────────────────────────────────
function csh_mono($initials, $size = 40) {
    $fs = strlen($initials) > 2 ? 11 : 14;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Finance providers ────────────────────────────────────────────────────────
$finance = [
    ['name' => 'Afterpay',      'logo' => ''],
    ['name' => 'Q Card',        'logo' => ''],
    ['name' => 'GEM Finance',   'logo' => ''],
    ['name' => 'Aotea Finance', 'logo' => ''],
];

// ── Services (10) ────────────────────────────────────────────────────────────
$services = [
    ['icon'=>csh_mono('RR'),'title'=>'Radiator Repair & Replacement','desc'=>'Stone damage, corrosion, or internal blockage — we repair or replace radiators on all makes. Full pressure test before and after.','url'=>'/radiator-repair-manukau/','cta'=>'Radiator Repair →'],
    ['icon'=>csh_mono('CF'),'title'=>'Coolant Flush','desc'=>'Remove old, contaminated coolant and replace with fresh fluid at the correct concentration. Recommended every 2 years or per manufacturer spec.','url'=>'/coolant-flush-manukau/','cta'=>'Coolant Flush →'],
    ['icon'=>csh_mono('WP'),'title'=>'Water Pump Replacement','desc'=>'A failed water pump stops coolant circulation and causes overheating. Usually replaced at the same time as the cambelt — same labour cost.','url'=>'/water-pump-replacement-manukau/','cta'=>'Water Pump →'],
    ['icon'=>csh_mono('TS'),'title'=>'Thermostat Replacement','desc'=>'A stuck-open or stuck-closed thermostat causes overheating or poor fuel economy. Inexpensive to replace — expensive to ignore.','url'=>'/thermostat-replacement-manukau/','cta'=>'Thermostat →'],
    ['icon'=>csh_mono('WL'),'title'=>'Coolant Leak Repair','desc'=>'Coolant leaks from hoses, the radiator, water pump, or head gasket. We locate the source and repair it before the engine overheats.','url'=>'/coolant-leak-repair-manukau/','cta'=>'Leak Repair →'],
    ['icon'=>csh_mono('WH'),'title'=>'Radiator Hose Replacement','desc'=>'Radiator hoses split and crack with age and heat cycling. A burst hose causes immediate coolant loss and overheating. Upper and lower hoses replaced.','url'=>'/radiator-hoses-manukau/','cta'=>'Hose Replacement →'],
    ['icon'=>csh_mono('HC'),'title'=>'Heater Core Repair','desc'=>'A leaking heater core causes wet carpets, fogged windows, and a sweet coolant smell inside the cabin. A significant job — done properly the first time.','url'=>'/heater-core-repair-manukau/','cta'=>'Heater Core →'],
    ['icon'=>csh_mono('OE'),'title'=>'Overheating Engine','desc'=>'Engine running hot or temperature warning light on? Pull over immediately. We diagnose the cause — do not drive an overheating engine.','url'=>'/overheating-engine-manukau/','cta'=>'Overheating →'],
    ['icon'=>csh_mono('CT'),'title'=>'Coolant Temperature Sensor','desc'=>'A faulty coolant temp sensor causes incorrect gauge readings, poor fuel economy, and engine management faults. Diagnosed and replaced.','url'=>'/coolant-temperature-sensor-manukau/','cta'=>'Sensor →'],
    ['icon'=>csh_mono('HG'),'title'=>'Head Gasket Repair','desc'=>'A blown head gasket is the result of sustained overheating. White smoke, milky oil, or unexplained coolant loss — get it diagnosed before it gets worse.','url'=>'/head-gasket-repair-manukau/','cta'=>'Head Gasket →'],
];

// ── Why points ───────────────────────────────────────────────────────────────
$why_points = [
    'Diagnose first — we find the actual fault before recommending any work',
    'Estimate before we start — no surprise invoices',
    'Coolant flush recommended every 2 years or per manufacturer spec',
    'All makes and models — Japanese, Korean, European',
    $customers . ' customers serviced — South Auckland\'s largest independent workshop',
    'MTA Assured workshop — Manukau since ' . $established,
    'NZTA Authorised — ' . $ms_number,
    'Finance available — Afterpay, Q Card, GEM, Aotea',
];
// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['cs_temp_warning'],
    $taas_faqs['cs_flush_interval'],
    $taas_faqs['cs_overheat_causes'],
    $taas_faqs['cs_flush_vs_radiator'],
    $taas_faqs['cs_head_gasket_signs'],
    $taas_faqs['cs_radiator_repair'],
    $taas_faqs['cs_cost'],
    $taas_faqs['cs_european'],
    $taas_faqs['cs_finance'],
    $taas_faqs['cs_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq['a'])]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Cooling System', 'item' => $page_url],
        ]],
        ['@type' => ['AutoRepair', 'LocalBusiness'], '@id' => $site_url . '/#organization', 'name' => 'Tony Allen Auto Service', 'url' => $site_url, 'description' => 'Cooling system repairs in Manukau, South Auckland. Radiator repair, coolant flush, water pump, thermostat, heater core, head gasket. All makes and models. MTA Assured. NZTA Authorised. Established ' . $established . '.', 'telephone' => [$phone_free, $phone_local], 'email' => $email, 'foundingDate' => '1985-10', 'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'], 'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671], 'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']], 'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'], 'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance', 'priceRange' => '$$', 'areaServed' => 'South Auckland', 'sameAs' => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'], 'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)']],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.csh-hero__sub', '.csh-faq__item:first-of-type .csh-faq__a']],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-cooling-system .site-content,.page-template-template-cooling-system .entry-content,.page-template-template-cooling-system .entry-header,.page-template-template-cooling-system article,.page-template-template-cooling-system #primary,.page-template-template-cooling-system #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-cooling-system{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}

.csh-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}

/* ── Breadcrumb ───────────────────────────────────────────────────────────── */
.csh-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}
.csh-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}
.csh-crumb__inner a{color:#999;text-decoration:none;}
.csh-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}
.csh-crumb__sep{margin:0 8px;color:#444;}
.csh-crumb__cur{color:#bbb;}

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.csh-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}
.csh-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}
.csh-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.csh-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}
.csh-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.csh-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.csh-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.csh-hero h1 span{color:var(--taas-yellow,#FFC800);}
.csh-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.csh-hero__signal{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:11px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);margin-bottom:24px;line-height:1.5;}
.csh-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.csh-hero__urgency{margin-top:24px;background:rgba(192,57,43,.14);border:1px solid rgba(192,57,43,.35);border-left:4px solid var(--taas-alert,#C0392B);border-radius:var(--taas-radius,6px);padding:14px 18px;font-size:14px;font-weight:300;color:#f3b0b0;line-height:1.75;max-width:600px;}
.csh-hero__urgency strong{color:#ff7a7a;font-weight:700;}
.csh-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}
.csh-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.csh-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.csh-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}
.csh-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.csh-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}
.csh-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.csh-sidebar__phone:hover{opacity:.65;}
.csh-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.6;}

/* ── Phone strip ──────────────────────────────────────────────────────────── */
.csh-phonestrip{background:var(--taas-yellow,#FFC800);}
.csh-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}
.csh-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}
.csh-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}
.csh-phonestrip__num:hover{opacity:.65;}

/* ── Trust strip (grey) ───────────────────────────────────────────────────── */
.csh-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}
.csh-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}
.csh-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.csh-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}

/* ── Sections ─────────────────────────────────────────────────────────────── */
.csh-section{padding:var(--taas-sec-pad,72px) 0;}
.csh-section--white{background:var(--taas-white,#fff);}
.csh-section--grey{background:var(--taas-panel,#F7F7F5);}
.csh-section--dark{background:var(--taas-dark,#1A1A1A);}
.csh-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.csh-h2--white{color:var(--taas-white,#fff);}
.csh-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}
.csh-section--dark .csh-lead{color:#aaa;}

/* ── Educational body ─────────────────────────────────────────────────────── */
.csh-edu{max-width:780px;}
.csh-edu p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 20px;}
.csh-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin:32px 0 12px;}
.csh-edu__alert{background:rgba(192,57,43,.06);border-left:4px solid var(--taas-alert,#C0392B);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:16px 20px;margin:0 0 28px;}
.csh-edu__alert p{font-size:14px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0;}
.csh-edu__alert strong{color:var(--taas-alert,#C0392B);font-weight:700;}
.csh-edu a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.csh-edu a:hover{text-decoration:underline;}

/* ── Service cards ────────────────────────────────────────────────────────── */
.csh-svc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;}
.csh-svc-card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;display:flex;flex-direction:column;gap:10px;text-decoration:none;transition:border-color .15s,box-shadow .15s;border-top:3px solid transparent;}
.csh-svc-card:hover{border-top-color:var(--taas-yellow,#FFC800);box-shadow:0 4px 16px rgba(0,0,0,.08);}
.csh-svc-card__title{font-size:16px;font-weight:700;color:var(--taas-black,#111);}
.csh-svc-card__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;flex:1;}
.csh-svc-card__link{font-size:13px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;}

/* ── Finance strip ────────────────────────────────────────────────────────── */
.csh-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}
.csh-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}
.csh-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}
.csh-finance__text strong{font-weight:700;color:var(--taas-black,#111);}
.csh-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}
.csh-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.csh-fin img{max-height:20px;width:auto;display:block;}
.csh-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}
.csh-finance__link:hover{text-decoration:underline;}

/* ── Why (grey) ───────────────────────────────────────────────────────────── */
.csh-why__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.csh-why__points{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;}
.csh-why__point{display:flex;gap:12px;align-items:flex-start;font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}
.csh-why__point::before{content:'✓';color:var(--taas-dark,#1A1A1A);background:var(--taas-yellow,#FFC800);font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.csh-why__card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;}
.csh-why__card h3{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:12px;}
.csh-why__card p{font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:20px;}
.csh-why__links{display:flex;flex-direction:column;gap:10px;margin-bottom:24px;}
.csh-why__links a{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--taas-yellow2,#e6b400);text-decoration:none;font-weight:600;}
.csh-why__links a:hover{text-decoration:underline;}

/* ── Enquiry (dark) ───────────────────────────────────────────────────────── */
.csh-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.csh-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}
.csh-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.6;}
.csh-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}
.csh-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}
.csh-enquiry__phone:hover{opacity:.65;}
.csh-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.7;margin-bottom:20px;}
.csh-enquiry__detail strong{color:#fff;font-weight:700;}
.csh-enquiry__detail a{color:#aaa;text-decoration:underline;}
.csh-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}
.csh-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.csh-enquiry__badge img{max-height:18px;width:auto;display:block;}
.csh-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.7;}
.csh-enquiry__note strong{color:#fff;font-weight:700;}
.csh-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.csh-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}
.csh-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.csh-section--dark .wpcf7 label,.csh-section--dark .wpcf7 p,.csh-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}
.csh-section--dark .wpcf7 input[type="text"],.csh-section--dark .wpcf7 input[type="email"],.csh-section--dark .wpcf7 input[type="tel"],.csh-section--dark .wpcf7 textarea,.csh-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.csh-section--dark .wpcf7 input::placeholder,.csh-section--dark .wpcf7 textarea::placeholder{color:#666;}
.csh-section--dark .wpcf7 input:focus,.csh-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.csh-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}
.csh-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* ── FAQ ──────────────────────────────────────────────────────────────────── */
.csh-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}
.csh-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.csh-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.csh-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.csh-faq__item--open .csh-faq__q::after{content:'−';}
.csh-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.csh-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.csh-faq__a a:hover{text-decoration:underline;}
.csh-faq__item--open .csh-faq__a{display:block;}

/* ── Related / closing CTA / buttons ──────────────────────────────────────── */
.csh-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.csh-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.csh-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.csh-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.csh-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.csh-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}
.csh-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}
.csh-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.csh-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.csh-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.csh-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.csh-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}
.csh-btn--dark:hover{background:#000;}
.csh-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.csh-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

/* ── Responsive ───────────────────────────────────────────────────────────── */
@media(max-width:960px){
  .csh-hero__inner,.csh-why__inner{grid-template-columns:1fr;}
  .csh-enquiry{grid-template-columns:1fr;gap:32px;}
  .csh-sidebar{display:none;}
  .csh-svc-grid{grid-template-columns:1fr 1fr;}
}
@media(max-width:640px){
  .csh-hero{padding:48px 0 40px;}
  .csh-hero h1{font-size:clamp(28px,7vw,42px);}
  .csh-hero__sub{font-size:14px;}
  .csh-section{padding:48px 0;}
  .csh-h2{font-size:clamp(22px,5vw,28px);}
  .csh-lead{font-size:14px;}
  .csh-edu p,.csh-why__point,.csh-why__card p,.csh-enquiry__list li,.csh-finance__text{font-size:14px;}
  .csh-edu__alert p,.csh-svc-card__desc{font-size:13px;}
  .csh-trust__inner{gap:8px 20px;}
  .csh-trust__item{font-size:12px;}
  .csh-phonestrip__num{font-size:17px;}
  .csh-svc-grid{grid-template-columns:1fr;}
  .csh-faq__q{font-size:14px;padding:16px 32px 16px 0;}
  .csh-faq__a{font-size:13px;}
  .csh-hero__ctas{flex-direction:column;align-items:stretch;}
  .csh-hero__ctas .csh-btn{justify-content:center;text-align:center;}
  .csh-enquiry{display:flex;flex-direction:column-reverse;}
  .csh-close{flex-direction:column;align-items:flex-start;}
}
</style>

<!-- ── BREADCRUMB ───────────────────────────────────────────────────────────── -->
<nav class="csh-crumb" aria-label="Breadcrumb"><div class="csh-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="csh-crumb__sep">›</span><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a><span class="csh-crumb__sep">›</span><span class="csh-crumb__cur">Cooling System</span></div></nav>

<!-- ── HERO ─────────────────────────────────────────────────────────────────── -->
<section class="csh-hero"<?php if ($hero_bg) echo ' style="' . $hero_bg . '"'; ?>>
  <div class="csh-w">
    <div class="csh-hero__inner">
      <div>
        <span class="csh-eye csh-eye--yellow">Cooling System — Manukau</span>
        <h1>Cooling System<br><span>Repairs &amp; Service</span></h1>
        <p class="csh-hero__sub">Radiator repair, coolant flush, thermostat, water pump, hoses, heater core, and head gasket. Diagnosed properly, repaired in-house. <?php echo esc_html($years); ?> years of workshop experience in South Auckland.</p>
        <div class="csh-hero__signal">Diagnose first · Estimate before any work begins · All makes &amp; models</div>
        <div class="csh-hero__ctas">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="csh-btn csh-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
          <a href="#csh-enquire" class="csh-btn csh-btn--outline">Book Online</a>
        </div>
        <div class="csh-hero__urgency"><strong>⚠ Temperature warning light on? Pull over immediately.</strong> An overheating engine causes head gasket failure and serious engine damage within minutes. Turn off the engine and call us on <?php echo esc_html($phone_free); ?>.</div>
      </div>
      <div class="csh-sidebar">
        <div class="csh-sidebar__title">We Service</div>
        <ul class="csh-sidebar__list"><li>Radiator repair &amp; replacement</li><li>Coolant flush &amp; refill</li><li>Water pump replacement</li><li>Thermostat replacement</li><li>Coolant leak repair</li><li>Radiator hose replacement</li><li>Heater core repair</li><li>Overheating diagnosis</li><li>Coolant temp sensors</li><li>Head gasket repair</li></ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="csh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="csh-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ── PHONE STRIP ──────────────────────────────────────────────────────────── -->
<div class="csh-phonestrip"><div class="csh-phonestrip__inner"><span class="csh-phonestrip__label">Engine running hot? Do not keep driving.</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="csh-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<!-- ── TRUST STRIP ──────────────────────────────────────────────────────────── -->
<div class="csh-trust"><div class="csh-trust__inner"><div class="csh-trust__item">MTA Assured</div><div class="csh-trust__item">NZTA Authorised</div><div class="csh-trust__item">Diagnose First</div><div class="csh-trust__item">Estimate Before We Start</div><div class="csh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="csh-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<!-- ── HOW YOUR COOLING SYSTEM WORKS ── White ──────────────────────────────── -->
<section class="csh-section csh-section--white"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">Understanding Your Vehicle</span>
  <h2 class="csh-h2">How Your Cooling System Works — and Why It Matters</h2>
  <div class="csh-edu">
    <p>Your engine generates enormous heat during combustion — temperatures inside the cylinders reach over 2,000°C. The cooling system's job is to remove that heat and maintain the engine at its optimal operating temperature, typically around 90–100°C. Without it, the engine would overheat and destroy itself within minutes.</p>
    <p>Coolant — a mixture of water and antifreeze/corrosion inhibitor — circulates through passages in the engine block, absorbing heat. The water pump drives this circulation. The thermostat controls flow: when the engine is cold, it keeps coolant in the engine to warm up faster; when it reaches operating temperature, it opens and allows coolant to flow through the radiator where air passing over the fins cools it down. The cooled fluid returns to the engine and the cycle repeats continuously.</p>

    <h3>Why Overheating Destroys Engines</h3>
    <p>When the cooling system fails — a leak, a stuck thermostat, a failed water pump, a blocked radiator — the engine temperature rises rapidly. The cylinder head expands faster than the engine block because it is made of different material (usually aluminium on a cast iron block). This differential expansion warps the head and crushes the head gasket. Once the head gasket fails, coolant enters the combustion chambers and oil passages. Coolant in the oil destroys engine bearings. Oil in the coolant blocks the radiator. A thermostat replacement — typically <?php echo esc_html($cs_thermostat); ?> — ignored becomes a head gasket job that can run <?php echo esc_html($cs_headgasket); ?> or more. If the head is warped, machining typically adds <?php echo esc_html($cs_headmachine); ?> on top. If bearings are damaged, you are looking at an engine rebuild.</p>
    <div class="csh-edu__alert"><p><strong>If your temperature warning light comes on, pull over immediately and turn the engine off.</strong> Do not continue driving "just to the next exit" or "home." Every minute of driving at elevated temperature increases the damage exponentially. Let the engine cool completely before checking the coolant level. Do not open the radiator cap while the engine is hot — pressurised coolant will spray out and cause serious burns.</p></div>

    <h3>Coolant Is Not Just Water</h3>
    <p>Modern coolant contains corrosion inhibitors that protect the aluminium and copper components inside your cooling system — the radiator, water pump, heater core, and engine block passages. Over time, these inhibitors break down and the coolant becomes acidic. Acidic coolant eats aluminium from the inside — you cannot see this happening until a radiator develops pinhole leaks, a water pump seal fails, or a heater core starts weeping inside the cabin. A coolant flush — typically <?php echo esc_html($cs_flush); ?> — every two years can prevent radiator replacements that start <?php echo esc_html($cs_radiator); ?> and heater core replacements <?php echo esc_html($cs_heatercore); ?> or more. It is one of the most cost-effective preventative maintenance items on the vehicle.</p>

    <h3>How One Failure Cascades</h3>
    <p>Cooling system failures are interconnected. A small coolant leak drops the level. Low coolant reduces the system's ability to absorb heat. The engine runs hotter. Higher temperatures accelerate hose degradation. A weakened hose bursts. Now coolant loss is rapid. The engine overheats. The head gasket fails. Coolant enters the oil. Bearings are damaged. Each step in that chain was preventable — and each step was cheaper than the one that followed. This is why we diagnose the root cause, not just the symptom that brought the vehicle in.</p>
  </div>
</div></section>

<!-- ── SERVICES ── Grey ────────────────────────────────────────────────────── -->
<section class="csh-section csh-section--grey"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">Our Services</span>
  <h2 class="csh-h2">Cooling System Services — All In-House</h2>
  <p class="csh-lead">Everything done at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>. Diagnose first, estimate before we start.</p>
  <div class="csh-svc-grid"><?php foreach ($services as $svc): ?>
    <a href="<?php echo esc_url($site_url . $svc['url']); ?>" class="csh-svc-card"><?php echo $svc['icon']; ?><div class="csh-svc-card__title"><?php echo esc_html($svc['title']); ?></div><div class="csh-svc-card__desc"><?php echo esc_html($svc['desc']); ?></div><span class="csh-svc-card__link"><?php echo $svc['cta']; ?></span></a>
  <?php endforeach; ?></div>
</div></section>

<!-- ── FINANCE STRIP ────────────────────────────────────────────────────────── -->
<div class="csh-finance"><div class="csh-finance__inner">
  <div class="csh-finance__text"><strong>Finance available</strong> — don't delay a cooling system repair because of cost.</div>
  <div class="csh-finance__logos"><?php foreach ($finance as $f): ?><span class="csh-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="csh-finance__link">View finance options →</a>
</div></div>

<!-- ── WHY CHOOSE TAAS ── White ────────────────────────────────────────────── -->
<section class="csh-section csh-section--white"><div class="csh-w"><div class="csh-why__inner">
  <div>
    <span class="csh-eye csh-eye--dark">Why Choose TAAS</span>
    <h2 class="csh-h2">South Auckland's Cooling System Workshop Since <?php echo esc_html($established); ?></h2>
    <p class="csh-lead" style="margin-bottom:24px;">We diagnose the root cause, not just the symptom. A coolant top-up does not fix a leak. A radiator replacement does not fix a blown head gasket. We find what actually failed and why.</p>
    <ul class="csh-why__points"><?php foreach ($why_points as $pt): ?><li class="csh-why__point"><?php echo esc_html($pt); ?></li><?php endforeach; ?></ul>
  </div>
  <div class="csh-why__card">
    <h3>Often Done at the Same Visit</h3>
    <p>Cooling system work often connects to cambelt, water pump, or general servicing. One visit, less total labour cost.</p>
    <div class="csh-why__links"><?php foreach ([['label'=>'Cambelts & Water Pumps','url'=>'/cambelts-and-water-pumps/'],['label'=>'Engine Repairs','url'=>'/engine-repairs/'],['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Finance Options','url'=>'/finance-options/']] as $ex): ?><a href="<?php echo esc_url($site_url . $ex['url']); ?>"><span>→</span><?php echo esc_html($ex['label']); ?></a><?php endforeach; ?></div>
    <a href="#csh-enquire" class="csh-btn csh-btn--dark">Book a Service</a>
  </div>
</div></div></section>

<!-- ── ENQUIRY ── Dark ─────────────────────────────────────────────────────── -->
<section id="csh-enquire" class="csh-section csh-section--dark"><div class="csh-w"><div class="csh-enquiry">
  <div>
    <span class="csh-eye csh-eye--yellow">Book or Enquire</span>
    <h2 class="csh-h2 csh-h2--white">Enquire About Cooling System <span style="color:var(--taas-yellow);">Service</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us what symptoms you are noticing — overheating, coolant loss, warning light, wet carpet, sweet smell — and your vehicle make and model. We will advise on next steps.</p>
    <ul class="csh-enquiry__list"><?php foreach (['Diagnose first — find the actual fault','Written estimate before any work begins','All makes and models — including European','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="csh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="csh-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="csh-enquiry__badges"><?php foreach ($finance as $f): ?><span class="csh-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="csh-enquiry__note"><strong>Estimate before we start.</strong> We confirm the cost before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="csh-enquiry__form">
    <div class="csh-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ── REVIEWS ── White ────────────────────────────────────────────────────── -->
<section class="csh-section csh-section--white"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">Customer Reviews</span>
  <h2 class="csh-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- ── RELATED ── Grey ─────────────────────────────────────────────────────── -->
<section class="csh-section csh-section--grey"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">Related Services</span>
  <h2 class="csh-h2">Often Done at the Same Visit</h2>
  <div class="csh-related__grid"><?php foreach ([['label'=>'Cambelts & Water Pumps','url'=>'/cambelts-and-water-pumps/'],['label'=>'Engine Repairs','url'=>'/engine-repairs/'],['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Steering & Suspension','url'=>'/steering-and-suspension/'],['label'=>'Warrant of Fitness','url'=>'/wof/'],['label'=>'Finance Options','url'=>'/finance-options/']] as $r): ?><a href="<?php echo esc_url($site_url . $r['url']); ?>" class="csh-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="csh-section csh-section--white"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">Common Questions</span>
  <h2 class="csh-h2">Cooling System FAQ</h2>
  <div class="csh-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="csh-faq__item<?php echo $i === 0 ? ' csh-faq__item--open' : ''; ?>"><button class="csh-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="csh-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="csh-a-<?php echo $i; ?>" class="csh-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── CLOSING CTA ── Grey ─────────────────────────────────────────────────── -->
<section class="csh-section csh-section--grey"><div class="csh-w">
  <span class="csh-eye csh-eye--dark">South Auckland</span>
  <h2 class="csh-h2">Cooling System Repairs — Manukau</h2>
  <p class="csh-lead" style="margin-bottom:0;">Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="csh-close">
    <div class="csh-close__text">Don't ignore an overheating engine.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="csh-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="csh-btn csh-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#csh-enquire" class="csh-btn csh-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.csh-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.csh-faq__item');var wasOpen=item.classList.contains('csh-faq__item--open');document.querySelectorAll('.csh-faq__item--open').forEach(function(el){el.classList.remove('csh-faq__item--open');el.querySelector('.csh-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('csh-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
