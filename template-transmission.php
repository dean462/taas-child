<?php
/**
 * Template Name: Transmission Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /transmission-service-and-repair/
 * CSS namespace: .trx
 * Rebuilt to Go-Live Standard — June 2026
 * Full rebuilds sublet to specialist — in-car repairs in-house.
 * Section order: Breadcrumb → Hero(img) → Phone strip → Trust(grey) →
 *   Educational + Types + Callout → Services → Problems(dark) → Process →
 *   Pricing → Finance strip → Enquiry(dark) → Reviews → Related → FAQ → Closing CTA
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$mech_diag      = defined('TAAS_MECH_DIAG')      ? TAAS_MECH_DIAG      : 'from $175';
$euro_brands    = defined('TAAS_EURO_BRANDS')     ? TAAS_EURO_BRANDS    : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Hero image ───────────────────────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_TRANSMISSION') ? TAAS_HERO_TRANSMISSION : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

// ── Badge helper ─────────────────────────────────────────────────────────────
function trx_badge($initials, $size = 56) {
    $fs = strlen($initials) > 2 ? 14 : 18;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#111111"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="700" letter-spacing="0.5">'.$initials.'</text></svg>';
}

// ── Finance providers ────────────────────────────────────────────────────────
$finance = [
    ['name' => 'Afterpay',      'logo' => ''],
    ['name' => 'Q Card',        'logo' => ''],
    ['name' => 'GEM Finance',   'logo' => ''],
    ['name' => 'Aotea Finance', 'logo' => ''],
];

// ── Service cards ────────────────────────────────────────────────────────────
$services = [
    ['badge' => 'AT', 'title' => 'Automatic Transmission Service', 'desc' => 'Fluid and filter service, solenoid replacement, torque converter diagnosis, and in-car repairs on conventional automatic transmissions.', 'url' => '/automatic-transmission-service-manukau/', 'cta' => 'Automatic Service →'],
    ['badge' => 'MG', 'title' => 'Manual Gearbox Repair',         'desc' => 'Clutch replacement, synchro diagnosis, gear selection faults, gearbox oil service, and bearing replacement on manual transmissions.', 'url' => '/manual-gearbox-repair-manukau/',           'cta' => 'Manual Gearbox →'],
    ['badge' => 'CV', 'title' => 'CVT Transmission Service',      'desc' => 'CVT fluid service every 40,000 km — non-negotiable. Belt and pulley inspection, judder diagnosis, and valve body repair.', 'url' => '/cvt-transmission-service-manukau/',        'cta' => 'CVT Service →'],
    ['badge' => 'TF', 'title' => 'Transmission Fluid Change',     'desc' => 'Drain-and-fill or machine exchange. Correct fluid specification for your transmission type — auto, CVT, DSG, or manual.', 'url' => '/transmission-fluid-change-manukau/',       'cta' => 'Fluid Change →'],
];

// ── Transmission types ───────────────────────────────────────────────────────
$types = [
    ['title' => 'Conventional Automatic',      'text' => 'Uses a torque converter and planetary gear sets. The most common type in New Zealand. Requires periodic fluid and filter service. Solenoids control gear selection — when they fail, shifting becomes harsh or delayed.'],
    ['title' => 'Manual Gearbox',              'text' => 'Driver selects gears via a clutch pedal and gear lever. Synchromesh rings allow smooth gear changes. Gearbox oil needs replacing, and clutch components wear over time. Simpler than automatics but still requires skilled diagnosis when faults occur.'],
    ['title' => 'CVT — Continuously Variable', 'text' => 'Uses a belt or chain on variable pulleys instead of fixed gears. Common on Japanese vehicles — Nissan, Subaru, Honda, Toyota. Extremely sensitive to fluid condition. CVT fluid must be changed every 40,000 km — this is not optional. Neglected CVTs fail catastrophically.'],
    ['title' => 'DSG / Dual-Clutch',           'text' => 'Two clutch packs controlled by a mechatronic unit — one for odd gears, one for even. Found on Volkswagen, Audi, Skoda, and some other European vehicles. Requires DSG fluid service at manufacturer intervals. Mechatronic unit faults cause jerking, hesitation, and warning lights.'],
];

// ── Common problems ──────────────────────────────────────────────────────────
$problems = [
    ['title' => 'Slipping',                 'text' => 'Engine revs climb but the vehicle does not accelerate. Caused by worn clutch packs in automatics, low fluid level, or a failing torque converter. In manual gearboxes, a worn clutch disc causes the same symptom. Driving with a slipping transmission accelerates internal damage.'],
    ['title' => 'Harsh or Delayed Shifting', 'text' => 'The transmission bangs into gear or pauses before engaging. Usually caused by a faulty shift solenoid, degraded fluid that has lost its friction properties, or a valve body fault. On DSG transmissions, mechatronic unit failure causes similar symptoms.'],
    ['title' => 'Shudder on Take-Off',      'text' => 'The vehicle vibrates or judders when pulling away from a stop. In automatics, this is often a torque converter lockup clutch fault. In CVTs, it indicates belt slip or valve body issues. In manuals, a worn or contaminated clutch causes judder.'],
    ['title' => 'Fluid Leak',               'text' => 'Transmission fluid under the vehicle — typically red or dark brown. Leaks from pan gaskets, output shaft seals, cooler lines, or the torque converter seal. Any fluid loss reduces lubrication and cooling inside the transmission. Even a slow leak needs attention.'],
    ['title' => 'Overheating',               'text' => 'Transmission fluid breaks down rapidly above 120°C. Caused by low fluid, towing without a transmission cooler, stop-start traffic with degraded fluid, or a blocked cooler. Overheated transmissions lose hydraulic pressure and shift erratically before failing.'],
    ['title' => 'Warning Light',             'text' => 'Transmission warning light or check engine light with transmission fault codes. Modern transmissions are electronically controlled — the ECU monitors solenoids, speed sensors, fluid temperature, and clutch engagement. A warning light means the ECU has detected something outside normal parameters.'],
];

// ── Process ──────────────────────────────────────────────────────────────────
$process = [
    ['title' => 'Diagnostic Scan',      'text' => 'Read all transmission fault codes and live data. Check solenoid commands, speed sensor readings, fluid temperature, and clutch engagement data.'],
    ['title' => 'Road Test',            'text' => 'Replicate the fault in real conditions. Assess shift quality, timing, and behaviour at different speeds and loads.'],
    ['title' => 'Fluid Inspection',     'text' => 'Check fluid level, colour, smell, and consistency. Burnt or contaminated fluid tells us how much damage has already occurred.'],
    ['title' => 'Visual Inspection',    'text' => 'Look for external leaks, damaged cooler lines, and loose connections. Check mounts and linkage.'],
    ['title' => 'Diagnosis & Estimate', 'text' => 'Confirm the fault. Advise whether the repair is an in-car job or requires specialist rebuild. Provide a clear estimate before any work starts.'],
    ['title' => 'Repair & Road Test',   'text' => 'Carry out the repair — in-house for in-car work, specialist for full rebuilds. Road test after repair to confirm the fault is resolved.'],
];

// ── Related services ─────────────────────────────────────────────────────────
$related = [
    ['label' => 'Vehicle Servicing',     'url' => '/vehicle-servicing/'],
    ['label' => 'Engine Repairs',        'url' => '/engine-repairs/'],
    ['label' => 'Diagnostic Scanning',   'url' => '/diagnostic-scanning/'],
    ['label' => 'Cooling System',        'url' => '/cooling-system/'],
    ['label' => 'TAAS European',         'url' => '/european/'],
    ['label' => 'Cambelt & Water Pump',  'url' => '/cambelts-and-water-pumps/'],
    ['label' => 'Clutch Repair',         'url' => '/clutch-servicing-repair-and-replacement/'],
    ['label' => 'Finance Options',       'url' => '/finance-options/'],
    ['label' => 'MBI Approved Repairer', 'url' => '/mechanical-breakdown-insurance/'],
    ['label' => 'Commercial Vehicles',   'url' => '/commercial-vehicles/'],
];
// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['trans_signs'],
    $taas_faqs['trans_cost'],
    $taas_faqs['trans_flush_damage'],
    $taas_faqs['trans_rebuild'],
    $taas_faqs['trans_interval'],
    $taas_faqs['trans_types'],
    $taas_faqs['trans_slipping'],
    $taas_faqs['trans_european'],
    $taas_faqs['trans_cvt'],
    $taas_faqs['trans_finance'],
    $taas_faqs['trans_mbi'],
    $taas_faqs['trans_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>$site_url.'/services/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Transmission Service & Repair','item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Transmission service and repair in Manukau, South Auckland. Automatic, manual, CVT, and DSG. In-car repairs in-house, full rebuilds through specialist. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.trx-hero__sub','.trx-faq__item:first-of-type .trx-faq__a']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-transmission .site-content,.page-template-template-transmission .entry-content,.page-template-template-transmission .entry-header,.page-template-template-transmission article,.page-template-template-transmission #primary,.page-template-template-transmission #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-transmission{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}

.trx-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}

/* ── Breadcrumb ───────────────────────────────────────────────────────────── */
.trx-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}
.trx-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}
.trx-crumb__inner a{color:#999;text-decoration:none;}
.trx-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}
.trx-crumb__sep{margin:0 8px;color:#444;}
.trx-crumb__cur{color:#bbb;}

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.trx-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}
.trx-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}
.trx-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.trx-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}
.trx-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.trx-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.trx-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.trx-hero h1 span{color:var(--taas-yellow,#FFC800);}
.trx-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.trx-hero__price{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:11px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);margin-bottom:24px;line-height:1.5;}
.trx-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.trx-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}
.trx-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.trx-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.trx-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}
.trx-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.trx-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}
.trx-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.trx-sidebar__phone:hover{opacity:.65;}
.trx-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.6;}

/* ── Phone strip ──────────────────────────────────────────────────────────── */
.trx-phonestrip{background:var(--taas-yellow,#FFC800);}
.trx-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}
.trx-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}
.trx-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}
.trx-phonestrip__num:hover{opacity:.65;}

/* ── Trust strip (grey) ───────────────────────────────────────────────────── */
.trx-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}
.trx-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}
.trx-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.trx-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}

/* ── Sections ─────────────────────────────────────────────────────────────── */
.trx-section{padding:var(--taas-sec-pad,72px) 0;}
.trx-section--white{background:var(--taas-white,#fff);}
.trx-section--grey{background:var(--taas-panel,#F7F7F5);}
.trx-section--dark{background:var(--taas-dark,#1A1A1A);}
.trx-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.trx-h2--white{color:var(--taas-white,#fff);}
.trx-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}
.trx-section--dark .trx-lead{color:#aaa;}

/* ── Educational body ─────────────────────────────────────────────────────── */
.trx-content{max-width:780px;}
.trx-content p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 16px;}

/* ── Type cards ───────────────────────────────────────────────────────────── */
.trx-types{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:28px;max-width:880px;}
.trx-type{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;}
.trx-type h3{font-size:16px;font-weight:700;color:var(--taas-black,#111);margin:0 0 10px;}
.trx-type p{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin:0;}
.trx-callout{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:20px 24px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:32px;max-width:780px;}
.trx-callout__title{font-size:14px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:6px;}
.trx-callout__body{font-size:14px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;}

/* ── Service cards ────────────────────────────────────────────────────────── */
.trx-services{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-top:28px;}
.trx-svc{display:flex;gap:16px;padding:24px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color .15s;align-items:flex-start;}
.trx-svc:hover{border-color:var(--taas-yellow,#FFC800);}
.trx-svc__body{flex:1;}
.trx-svc__title{font-size:16px;font-weight:700;color:var(--taas-black,#111);margin-bottom:8px;}
.trx-svc__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:10px;}
.trx-svc__cta{font-size:13px;font-weight:700;color:var(--taas-yellow2,#e6b400);}

/* ── Problems (dark) ──────────────────────────────────────────────────────── */
.trx-problems{display:grid;grid-template-columns:1fr 1fr;gap:20px;max-width:880px;}
.trx-problem{padding:20px;border-bottom:1px solid #2a2a2a;}
.trx-problem h3{font-size:15px;font-weight:700;color:var(--taas-white,#fff);margin:0 0 8px;}
.trx-problem p{font-size:14px;font-weight:300;color:#aaa;line-height:1.75;margin:0;}

/* ── Process ──────────────────────────────────────────────────────────────── */
.trx-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.trx-step{display:flex;align-items:flex-start;gap:16px;padding:18px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.trx-step:last-child{border-bottom:none;}
.trx-step__num{width:34px;height:34px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.trx-step__body{flex:1;}
.trx-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}
.trx-step__text{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}

/* ── Pricing ──────────────────────────────────────────────────────────────── */
.trx-pricing{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;max-width:640px;}
.trx-pricing__row{display:flex;justify-content:space-between;align-items:baseline;padding:10px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);font-size:14px;font-weight:300;}
.trx-pricing__row:last-child{border-bottom:none;}
.trx-pricing__label{color:var(--taas-body,#333);font-weight:600;}
.trx-pricing__value{color:var(--taas-black,#111);font-weight:700;}

/* ── Finance strip ────────────────────────────────────────────────────────── */
.trx-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}
.trx-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}
.trx-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}
.trx-finance__text strong{font-weight:700;color:var(--taas-black,#111);}
.trx-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}
.trx-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.trx-fin img{max-height:20px;width:auto;display:block;}
.trx-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}
.trx-finance__link:hover{text-decoration:underline;}

/* ── Enquiry (dark) ───────────────────────────────────────────────────────── */
.trx-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.trx-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}
.trx-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.6;}
.trx-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}
.trx-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}
.trx-enquiry__phone:hover{opacity:.65;}
.trx-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.7;margin-bottom:20px;}
.trx-enquiry__detail strong{color:#fff;font-weight:700;}
.trx-enquiry__detail a{color:#aaa;text-decoration:underline;}
.trx-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}
.trx-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.trx-enquiry__badge img{max-height:18px;width:auto;display:block;}
.trx-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.7;}
.trx-enquiry__note strong{color:#fff;font-weight:700;}
.trx-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.trx-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}
.trx-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.trx-section--dark .wpcf7 label,.trx-section--dark .wpcf7 p,.trx-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}
.trx-section--dark .wpcf7 input[type="text"],.trx-section--dark .wpcf7 input[type="email"],.trx-section--dark .wpcf7 input[type="tel"],.trx-section--dark .wpcf7 textarea,.trx-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.trx-section--dark .wpcf7 input::placeholder,.trx-section--dark .wpcf7 textarea::placeholder{color:#666;}
.trx-section--dark .wpcf7 input:focus,.trx-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.trx-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}
.trx-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* ── FAQ ──────────────────────────────────────────────────────────────────── */
.trx-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}
.trx-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.trx-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.trx-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.trx-faq__item--open .trx-faq__q::after{content:'−';}
.trx-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.trx-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.trx-faq__a a:hover{text-decoration:underline;}
.trx-faq__item--open .trx-faq__a{display:block;}

/* ── Related / closing CTA / buttons ──────────────────────────────────────── */
.trx-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.trx-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.trx-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.trx-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.trx-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.trx-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}
.trx-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}
.trx-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.trx-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.trx-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.trx-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.trx-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}
.trx-btn--dark:hover{background:#000;}
.trx-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.trx-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

/* ── Responsive ───────────────────────────────────────────────────────────── */
@media(max-width:960px){
  .trx-hero__inner{grid-template-columns:1fr;}
  .trx-enquiry{grid-template-columns:1fr;gap:32px;}
  .trx-sidebar{display:none;}
  .trx-types,.trx-services,.trx-problems{grid-template-columns:1fr;}
}
@media(max-width:640px){
  .trx-hero{padding:48px 0 40px;}
  .trx-hero h1{font-size:clamp(26px,7vw,38px);}
  .trx-hero__sub{font-size:14px;}
  .trx-section{padding:48px 0;}
  .trx-h2{font-size:clamp(22px,5vw,28px);}
  .trx-lead{font-size:14px;}
  .trx-pricing{padding:24px;}
  .trx-pricing__row{flex-direction:column;gap:2px;padding:12px 0;}
  .trx-pricing__label{font-size:13px;}
  .trx-pricing__value{font-size:15px;}
  .trx-content p,.trx-callout__body,.trx-step__text,.trx-enquiry__list li,.trx-finance__text{font-size:14px;}
  .trx-type p,.trx-svc__desc,.trx-problem p{font-size:13px;}
  .trx-trust__inner{gap:8px 20px;}
  .trx-trust__item{font-size:12px;}
  .trx-phonestrip__num{font-size:17px;}
  .trx-faq__q{font-size:14px;padding:16px 32px 16px 0;}
  .trx-faq__a{font-size:13px;}
  .trx-hero__ctas{flex-direction:column;align-items:stretch;}
  .trx-hero__ctas .trx-btn{justify-content:center;text-align:center;}
  .trx-enquiry{display:flex;flex-direction:column-reverse;}
  .trx-close{flex-direction:column;align-items:flex-start;}
}
</style>

<!-- ── BREADCRUMB ───────────────────────────────────────────────────────────── -->
<nav class="trx-crumb" aria-label="Breadcrumb"><div class="trx-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="trx-crumb__sep">›</span><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a><span class="trx-crumb__sep">›</span><span class="trx-crumb__cur">Transmission Service &amp; Repair</span></div></nav>

<!-- ── HERO ─────────────────────────────────────────────────────────────────── -->
<section class="trx-hero"<?php if ($hero_bg) echo ' style="' . $hero_bg . '"'; ?>>
  <div class="trx-w">
    <div class="trx-hero__inner">
      <div>
        <span class="trx-eye trx-eye--yellow">Transmission — Manukau</span>
        <h1>Transmission Service<br>&amp; Repair <span>Manukau</span></h1>
        <p class="trx-hero__sub">Automatic, manual, CVT, and DSG transmission service and repair. In-car repairs done in-house. Full rebuilds through a trusted specialist. We diagnose accurately, advise honestly, and carry out the work to a high standard. <?php echo esc_html($years); ?> years of workshop experience.</p>
        <div class="trx-hero__price">Diagnosis <?php echo esc_html($mech_diag); ?> · Repair — estimate after diagnosis</div>
        <div class="trx-hero__ctas">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-btn trx-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
          <a href="#trx-enquire" class="trx-btn trx-btn--outline">Book Online</a>
        </div>
      </div>
      <div class="trx-sidebar">
        <div class="trx-sidebar__title">At a Glance</div>
        <ul class="trx-sidebar__list"><li>Auto, manual, CVT, DSG</li><li>In-car repairs in-house</li><li>Full rebuilds via specialist</li><li>Diagnose before we recommend</li><li>Estimate before we start</li><li>All makes &amp; models</li><li>Finance available</li></ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="trx-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ── PHONE STRIP ──────────────────────────────────────────────────────────── -->
<div class="trx-phonestrip"><div class="trx-phonestrip__inner"><span class="trx-phonestrip__label">Transmission warning light on, or shifting rough?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<!-- ── TRUST STRIP ──────────────────────────────────────────────────────────── -->
<div class="trx-trust"><div class="trx-trust__inner"><div class="trx-trust__item">MTA Assured</div><div class="trx-trust__item">NZTA Authorised</div><div class="trx-trust__item">Diagnose First</div><div class="trx-trust__item">Estimate Before We Start</div><div class="trx-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="trx-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<!-- ── UNDERSTANDING TRANSMISSIONS ── White ─────────────────────────────────── -->
<section class="trx-section trx-section--white"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Understanding Transmissions</span>
  <h2 class="trx-h2">What Does a Transmission Do and Why Does It Matter?</h2>
  <div class="trx-content">
    <p>The transmission transfers engine power to the wheels. It is one of the most complex and expensive components in any vehicle — second only to the engine itself. Every time you accelerate, slow down, or change speed, the transmission is selecting the right gear ratio to match engine power to road conditions.</p>
    <p>Transmission fluid is the most overlooked maintenance item on most vehicles. It is not just a lubricant — it is the hydraulic medium that controls gear selection, the coolant that prevents overheating, and the friction modifier that allows clutch packs to engage smoothly. When the fluid degrades, everything inside the transmission starts to fail. Most transmission problems we see could have been prevented with a fluid service done at the right time.</p>
  </div>
  <div class="trx-types"><?php foreach ($types as $t): ?><div class="trx-type"><h3><?php echo esc_html($t['title']); ?></h3><p><?php echo esc_html($t['text']); ?></p></div><?php endforeach; ?></div>
  <div class="trx-callout">
    <div class="trx-callout__title">In-House vs Specialist Rebuild</div>
    <div class="trx-callout__body">We carry out all in-car transmission repairs in-house — solenoid replacement, sensor diagnostics, fluid services, mechatronic unit work, torque converter replacement, and clutch jobs. Where a full internal rebuild is required, we arrange this through a trusted transmission specialist and manage the entire process on your behalf. This is the honest approach — a rebuild requires specialist tooling and knowledge that a general workshop should not pretend to have. You deal with us throughout.</div>
  </div>
</div></section>

<!-- ── SERVICES ── Grey ────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--grey"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Our Services</span>
  <h2 class="trx-h2">Transmission Services at Tony Allen Auto Service</h2>
  <div class="trx-services"><?php foreach ($services as $s): ?>
    <a href="<?php echo esc_url($site_url . $s['url']); ?>" class="trx-svc"><div><?php echo trx_badge($s['badge']); ?></div><div class="trx-svc__body"><div class="trx-svc__title"><?php echo esc_html($s['title']); ?></div><div class="trx-svc__desc"><?php echo esc_html($s['desc']); ?></div><div class="trx-svc__cta"><?php echo esc_html($s['cta']); ?></div></div></a>
  <?php endforeach; ?></div>
</div></section>

<!-- ── COMMON PROBLEMS ── Dark ─────────────────────────────────────────────── -->
<section class="trx-section trx-section--dark"><div class="trx-w">
  <span class="trx-eye trx-eye--yellow">Common Problems</span>
  <h2 class="trx-h2 trx-h2--white">Transmission Problems We See Every Week</h2>
  <p class="trx-lead">These are the faults South Auckland drivers describe when they call us. Every one of them gets worse with time — and more expensive.</p>
  <div class="trx-problems"><?php foreach ($problems as $p): ?><div class="trx-problem"><h3><?php echo esc_html($p['title']); ?></h3><p><?php echo esc_html($p['text']); ?></p></div><?php endforeach; ?></div>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-btn trx-btn--primary" style="margin-top:32px;">Describe Your Symptoms — Call <?php echo esc_html($phone_free); ?></a>
</div></section>

<!-- ── PROCESS ── Grey ─────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--grey"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Our Process</span>
  <h2 class="trx-h2">How We Diagnose and Repair Transmissions</h2>
  <p class="trx-lead">Fault confirmed before parts are replaced. Estimate before we start. No guesswork.</p>
  <div class="trx-steps"><?php foreach ($process as $i => $step): ?>
    <div class="trx-step"><div class="trx-step__num"><?php echo $i+1; ?></div><div class="trx-step__body"><div class="trx-step__title"><?php echo esc_html($step['title']); ?></div><div class="trx-step__text"><?php echo esc_html($step['text']); ?></div></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── PRICING ── White ────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--white"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Pricing</span>
  <h2 class="trx-h2">How Much Does Transmission Repair Cost?</h2>
  <p class="trx-lead">We always provide an estimate after diagnosis and before starting any work — no surprises.</p>
  <div class="trx-pricing">
    <div class="trx-pricing__row"><span class="trx-pricing__label">Diagnostic assessment</span><span class="trx-pricing__value"><?php echo esc_html($mech_diag); ?></span></div>
    <div class="trx-pricing__row"><span class="trx-pricing__label">Transmission fluid service</span><span class="trx-pricing__value">Contact for pricing</span></div>
    <div class="trx-pricing__row"><span class="trx-pricing__label">Solenoid / sensor repair</span><span class="trx-pricing__value">Estimate after diagnosis</span></div>
    <div class="trx-pricing__row"><span class="trx-pricing__label">Clutch replacement</span><span class="trx-pricing__value">Estimate after inspection</span></div>
    <div class="trx-pricing__row"><span class="trx-pricing__label">Full rebuild (via specialist)</span><span class="trx-pricing__value">Call for estimate</span></div>
  </div>
</div></section>

<!-- ── FINANCE STRIP ────────────────────────────────────────────────────────── -->
<div class="trx-finance"><div class="trx-finance__inner">
  <div class="trx-finance__text"><strong>Finance available</strong> — don't delay a transmission repair because of cost.</div>
  <div class="trx-finance__logos"><?php foreach ($finance as $f): ?><span class="trx-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="trx-finance__link">View finance options →</a>
</div></div>

<!-- ── ENQUIRY ── Dark ─────────────────────────────────────────────────────── -->
<section id="trx-enquire" class="trx-section trx-section--dark"><div class="trx-w"><div class="trx-enquiry">
  <div>
    <span class="trx-eye trx-eye--yellow">Book or Enquire</span>
    <h2 class="trx-h2 trx-h2--white">Transmission Service — <span style="color:var(--taas-yellow);">Enquire Now</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your vehicle make, model, and what symptoms you are noticing — slipping, harsh shifting, shudder, warning light, fluid leak. We will advise on next steps.</p>
    <ul class="trx-enquiry__list"><?php foreach (['Diagnose the fault before recommending any work','Written estimate before any repair begins','In-car repairs done in-house — rebuilds via specialist','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="trx-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="trx-enquiry__badges"><?php foreach ($finance as $f): ?><span class="trx-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="trx-enquiry__note"><strong>Estimate before we start.</strong> We confirm the cost before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="trx-enquiry__form">
    <div class="trx-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ── REVIEWS ── White ────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--white"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Customer Reviews</span>
  <h2 class="trx-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- ── RELATED ── Grey ─────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--grey"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Related Services</span>
  <h2 class="trx-h2">Connected Services</h2>
  <div class="trx-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url . $r['url']); ?>" class="trx-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="trx-section trx-section--white"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">Common Questions</span>
  <h2 class="trx-h2">Transmission Service &amp; Repair — FAQ</h2>
  <div class="trx-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="trx-faq__item<?php echo $i === 0 ? ' trx-faq__item--open' : ''; ?>"><button class="trx-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="trx-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="trx-a-<?php echo $i; ?>" class="trx-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── CLOSING CTA ── Grey ─────────────────────────────────────────────────── -->
<section class="trx-section trx-section--grey"><div class="trx-w">
  <span class="trx-eye trx-eye--dark">South Auckland</span>
  <h2 class="trx-h2">Transmission Service &amp; Repair — Manukau</h2>
  <p class="trx-lead" style="margin-bottom:0;">Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="trx-close">
    <div class="trx-close__text">Transmission problems get worse — and more expensive — every day you wait.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="trx-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="trx-btn trx-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#trx-enquire" class="trx-btn trx-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.trx-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.trx-faq__item');var wasOpen=item.classList.contains('trx-faq__item--open');document.querySelectorAll('.trx-faq__item--open').forEach(function(el){el.classList.remove('trx-faq__item--open');el.querySelector('.trx-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('trx-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
