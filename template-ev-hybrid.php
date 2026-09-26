<?php
/**
 * Template Name: EV & Hybrid Hub
 * Template Post Type: page
 * URL: /electric-hybrid-vehicle-servicing/
 *
 * Tony Allen Auto Service — taas.co.nz
 * CSS namespace: .evh
 * Green accent (#4ade80) retained as EV differentiator.
 * Rebuilt to Go-Live Standard — June 2026
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
$euro_brands    = defined('TAAS_EURO_BRANDS')     ? TAAS_EURO_BRANDS    : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Hero image ───────────────────────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_EV') ? TAAS_HERO_EV : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.88) 0%,rgba(17,17,17,.93) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

// ── Finance providers ────────────────────────────────────────────────────────
$finance = [
    ['name' => 'Q Card', 'logo' => ''], ['name' => 'GEM Finance', 'logo' => ''],
    ['name' => 'Aotea Finance', 'logo' => ''],
];

// ── EV types ─────────────────────────────────────────────────────────────────
$ev_types = [
    ['abbr' => 'BEV',  'name' => 'Battery Electric',    'desc' => 'Fully electric — no petrol engine. Charges from the wall. Tesla, Nissan Leaf, BYD, MG ZS EV, Hyundai Ioniq 5, Kia EV6.'],
    ['abbr' => 'HEV',  'name' => 'Full Hybrid',         'desc' => 'Petrol engine plus electric motor. Charges itself by driving — no plug required. Toyota Prius, RAV4 Hybrid, Corolla Hybrid, Honda e:HEV.'],
    ['abbr' => 'PHEV', 'name' => 'Plug-in Hybrid',      'desc' => 'Larger battery than a hybrid — charges from the wall and runs on electric first. Mitsubishi Outlander PHEV, Kia Niro PHEV, Hyundai Tucson PHEV.'],
    ['abbr' => 'MHEV', 'name' => 'Mild Hybrid',         'desc' => 'Small battery assists the petrol engine — often invisible to owners. Very common. Many Suzuki, Volvo, Land Rover, and Ford models.'],
];

// ── Service cards ────────────────────────────────────────────────────────────
$services = [
    ['badge' => 'HV', 'title' => 'Hybrid Vehicle Servicing',  'desc' => 'Scheduled servicing for all hybrid types — HEV, PHEV, MHEV. Oil, filters, brakes, coolant, and hybrid-specific checks.', 'url' => '/hybrid-vehicle-servicing-manukau/',  'cta' => 'Hybrid Servicing →'],
    ['badge' => 'EV', 'title' => 'Electric Vehicle Servicing', 'desc' => 'BEV service — brake fluid, coolant, cabin filter, tyres, suspension, 12V battery, and diagnostic health check.', 'url' => '/electric-vehicle-servicing-manukau/', 'cta' => 'EV Servicing →'],
    ['badge' => 'BC', 'title' => 'Hybrid Battery Check',      'desc' => 'HV battery health assessment — individual cell data, state of charge balance, capacity vs original specification.', 'url' => '/hybrid-battery-check-manukau/',      'cta' => 'Battery Check →'],
    ['badge' => 'PH', 'title' => 'PHEV Servicing',            'desc' => 'Plug-in hybrid service — covers both the petrol engine service schedule and EV-specific components.', 'url' => '/phev-servicing-manukau/',              'cta' => 'PHEV Service →'],
    ['badge' => 'EB', 'title' => 'EV Brake Service',          'desc' => 'Regenerative brake system service — fluid change, pad inspection, calliper service. EVs use brakes differently.', 'url' => '/ev-brake-service-manukau/',           'cta' => 'EV Brakes →'],
];

// ── What we service ──────────────────────────────────────────────────────────
$same_as_petrol = ['Warrant of Fitness — NZTA Authorised on-site','Scheduled servicing — oil, filters, brake fluid','Brakes — pads, rotors, callipers','Tyres — supply, fit, and wheel alignment','Steering and suspension','Air conditioning — electric compressor systems','12V auxiliary battery — supply and fit','Cooling system — EVs have their own coolant circuit','Windscreen, wipers, lights','Diagnostic scanning — all EV/hybrid systems'];
$ev_specific = ['High-voltage battery health check — cell data analysis','HV system diagnosis and repair — trained technicians','Inverter and drive motor — diagnosis and in-car repair','Regenerative brake system service and fluid change','HV battery 12V auxiliary replacement','EV-specific tyre sourcing — low rolling resistance','Hybrid transmission service — CVT and eCVT','Thermal management system — battery cooling','On-board charger diagnosis','DSG and dual-clutch service on PHEV models'];

// ── Vehicles ─────────────────────────────────────────────────────────────────
$vehicles = [
    ['region' => 'Japanese',               'makes' => ['Toyota — Prius, RAV4 Hybrid, Corolla Hybrid, Yaris Cross, C-HR, bZ4X','Nissan — Leaf, Ariya, e-Power variants','Honda — Jazz e:HEV, Civic e:HEV, HR-V e:HEV, ZR-V e:HEV','Mitsubishi — Outlander PHEV, Eclipse Cross PHEV','Lexus — UX300e, NX450h+, RX450h, ES300h','Suzuki — mild hybrid range (S-Cross, Swift, Vitara MHEV)']],
    ['region' => 'Korean',                 'makes' => ['Hyundai — Ioniq 5, Ioniq 6, Kona Electric, Tucson PHEV','Kia — EV6, EV9, Niro EV, Niro PHEV, Sportage PHEV']],
    ['region' => 'Chinese — Growing Fast', 'makes' => ['BYD — Atto 3, Seal, Dolphin, Sealion 6 PHEV','MG — ZS EV, MG4, HS PHEV','GWM / Haval — H6 HEV, Jolion HEV','LDV — eT60 (commercial EV ute)','New makes arriving — Chery, Xpeng, Zeekr — call us']],
    ['region' => 'European',               'makes' => ['Volvo — mild hybrid range, XC40 Recharge','BMW / MINI — mild hybrid and PHEV variants','Volkswagen Group — ID.4, Golf GTE, Passat GTE','Peugeot — e-208, e-2008']],
];

// ── Suburbs (17) ─────────────────────────────────────────────────────────────
$suburbs = [
    ['name'=>'Manukau','slug'=>'manukau'],['name'=>'Papatoetoe','slug'=>'papatoetoe'],['name'=>'Māngere','slug'=>'mangere'],['name'=>'Māngere Bridge','slug'=>'mangere-bridge'],['name'=>'Ōtāhuhu','slug'=>'otahuhu'],['name'=>'Wiri','slug'=>'wiri'],['name'=>'Ōtara','slug'=>'otara'],['name'=>'Hunters Corner','slug'=>'hunters-corner'],['name'=>'Clover Park','slug'=>'clover-park'],['name'=>'Flat Bush','slug'=>'flat-bush'],['name'=>'Manurewa','slug'=>'manurewa'],['name'=>'Clendon','slug'=>'clendon'],['name'=>'Weymouth','slug'=>'weymouth'],['name'=>'Takanini','slug'=>'takanini'],['name'=>'Papakura','slug'=>'papakura'],['name'=>'Howick','slug'=>'howick'],['name'=>'Botany','slug'=>'botany'],
];

// ── Related ──────────────────────────────────────────────────────────────────
$related = [
    ['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'WOF Inspections','url'=>'/wof/'],['label'=>'Diagnostic Scanning','url'=>'/diagnostic-scanning/'],['label'=>'Tyres & Wheel Alignment','url'=>'/tyre-centre/'],['label'=>'Air Conditioning','url'=>'/air-conditioning/'],['label'=>'Steering & Suspension','url'=>'/steering-and-suspension/'],['label'=>'TAAS European','url'=>'/european/'],['label'=>'Transmission Service','url'=>'/transmission-service-and-repair/'],['label'=>'Finance Options','url'=>'/finance-options/'],['label'=>'Fleet Servicing','url'=>'/fleet-servicing/'],
];
// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['ev_dealer'],
    $taas_faqs['ev_hv_battery'],
    $taas_faqs['ev_brake_fluid'],
    $taas_faqs['ev_battery_health'],
    $taas_faqs['ev_models'],
    $taas_faqs['ev_warning_light'],
    $taas_faqs['ev_less_servicing'],
    $taas_faqs['ev_tyres'],
    $taas_faqs['ev_chinese'],
    $taas_faqs['ev_cost_compare'],
    $taas_faqs['ev_finance'],
    $taas_faqs['ev_location'],
];

// ── Badge helper (green fill for EV) ─────────────────────────────────────────
function evh_badge($initials, $size = 56) {
    $fs = strlen($initials) > 2 ? 14 : 18;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#111111"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#4ade80" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="700" letter-spacing="0.5">'.$initials.'</text></svg>';
}

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>$site_url.'/services/'],['@type'=>'ListItem','position'=>3,'name'=>'EV & Hybrid Vehicle Servicing','item'=>$page_url]]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Electric and hybrid vehicle servicing in Manukau, South Auckland. BEV, HEV, PHEV, MHEV — all makes. HV-trained technicians. Battery health checks. Inverter and motor repair. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance'],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.evh-hero__sub','.evh-faq__item:first-of-type .evh-faq__a']],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-ev-hybrid .site-content,.page-template-template-ev-hybrid .entry-content,.page-template-template-ev-hybrid .entry-header,.page-template-template-ev-hybrid article,.page-template-template-ev-hybrid #primary,.page-template-template-ev-hybrid #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-ev-hybrid{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
:root{--ev-green:#4ade80;--ev-green-dim:rgba(74,222,128,.08);--ev-green-border:rgba(74,222,128,.2);}
.evh-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.evh-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}.evh-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}.evh-crumb__inner a{color:#999;text-decoration:none;}.evh-crumb__inner a:hover{color:var(--ev-green);}.evh-crumb__sep{margin:0 8px;color:#444;}.evh-crumb__cur{color:#bbb;}
.evh-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}.evh-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 70% at 85% 40%,rgba(255,200,0,.05) 0%,transparent 55%),radial-gradient(ellipse 40% 40% at 10% 80%,var(--ev-green-dim) 0%,transparent 60%);pointer-events:none;}.evh-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;position:relative;z-index:1;}
.evh-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}.evh-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}.evh-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}.evh-eye--green{background:rgba(74,222,128,.12);color:var(--ev-green);border:1px solid var(--ev-green-border);}
.evh-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}.evh-hero h1 span{color:var(--ev-green);}
.evh-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 20px;line-height:1.75;}
.evh-hero__statement{margin-bottom:24px;padding:14px 18px;background:var(--ev-green-dim);border:1px solid var(--ev-green-border);border-left:4px solid var(--ev-green);border-radius:var(--taas-radius,6px);font-size:14px;font-weight:300;color:#a3e6b8;line-height:1.75;max-width:560px;}.evh-hero__statement strong{color:var(--ev-green);font-weight:700;}
.evh-hero__tags{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px;}.evh-hero__tag{padding:5px 14px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:100px;font-size:12px;font-weight:700;color:#ccc;letter-spacing:.06em;}.evh-hero__tag strong{color:var(--taas-yellow,#FFC800);}
.evh-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.evh-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}.evh-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--ev-green);margin-bottom:14px;}.evh-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}.evh-sidebar__list li{font-size:12px;font-weight:300;color:#ccc;line-height:1.4;}.evh-sidebar__list li strong{display:block;font-size:10px;text-transform:uppercase;letter-spacing:.1em;color:#555;margin-bottom:1px;font-weight:700;}.evh-sidebar__list li em{font-style:normal;color:var(--ev-green);}.evh-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}.evh-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}.evh-sidebar__phone:hover{opacity:.65;}.evh-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.6;}
.evh-phonestrip{background:var(--taas-yellow,#FFC800);}.evh-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.evh-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.evh-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.evh-phonestrip__num:hover{opacity:.65;}
.evh-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}.evh-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}.evh-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}.evh-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}
.evh-section{padding:var(--taas-sec-pad,72px) 0;}.evh-section--white{background:var(--taas-white,#fff);}.evh-section--grey{background:var(--taas-panel,#F7F7F5);}.evh-section--dark{background:var(--taas-dark,#1A1A1A);}
.evh-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}.evh-h2--white{color:var(--taas-white,#fff);}
.evh-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}.evh-section--dark .evh-lead{color:#aaa;}
.evh-content{max-width:780px;}.evh-content p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 16px;}
.evh-types{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:28px;}.evh-type{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:20px;}.evh-type__abbr{font-size:28px;font-weight:800;color:var(--ev-green);line-height:1;margin-bottom:6px;}.evh-type__name{font-size:12px;font-weight:700;color:var(--taas-black,#111);text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;}.evh-type__desc{font-size:13px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.evh-services{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;margin-top:28px;}.evh-svc{display:flex;gap:16px;padding:24px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;transition:border-color .15s;align-items:flex-start;}.evh-svc:hover{border-color:var(--ev-green);}.evh-svc__body{flex:1;}.evh-svc__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:6px;}.evh-svc__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:8px;}.evh-svc__cta{font-size:13px;font-weight:700;color:var(--ev-green);}
.evh-wws{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:28px;max-width:880px;}.evh-wws__col{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;}.evh-wws__heading{font-size:14px;font-weight:700;color:var(--taas-black,#111);padding-bottom:10px;border-bottom:2px solid var(--taas-yellow,#FFC800);margin-bottom:16px;}.evh-wws__col--ev .evh-wws__heading{border-color:var(--ev-green);}.evh-wws__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}.evh-wws__item{display:flex;gap:10px;font-size:13px;font-weight:300;color:var(--taas-body,#333);line-height:1.5;}.evh-wws__item::before{content:'→';color:var(--taas-yellow,#FFC800);font-weight:700;flex-shrink:0;}.evh-wws__col--ev .evh-wws__item::before{content:'⚡';color:var(--ev-green);}
.evh-dealer{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;max-width:880px;}.evh-dealer__body{font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}.evh-dealer__body p{margin:0 0 16px;}.evh-dealer__card{background:var(--taas-black,#111);border-radius:var(--taas-radius,6px);padding:28px;}.evh-dealer__quote{font-size:18px;font-weight:700;color:var(--taas-white,#fff);line-height:1.35;margin-bottom:20px;border-left:4px solid var(--taas-yellow,#FFC800);padding-left:16px;}.evh-dealer__facts{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;}.evh-dealer__fact{display:flex;gap:10px;font-size:14px;font-weight:300;color:#aaa;line-height:1.5;}.evh-dealer__fact::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:700;flex-shrink:0;}
.evh-vehicles{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-top:28px;}.evh-vehicle{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:var(--taas-radius,6px);padding:24px;}.evh-vehicle__region{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#555;margin-bottom:12px;}.evh-vehicle__region--hot{color:var(--ev-green);}.evh-vehicle__list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;}.evh-vehicle__item{font-size:13px;font-weight:300;color:#aaa;line-height:1.5;padding-left:12px;border-left:2px solid #2a2a2a;}
.evh-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}.evh-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}.evh-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}.evh-finance__text strong{font-weight:700;color:var(--taas-black,#111);}.evh-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}.evh-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.evh-fin img{max-height:20px;width:auto;display:block;}.evh-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}.evh-finance__link:hover{text-decoration:underline;}
.evh-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}.evh-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}.evh-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.6;}.evh-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}.evh-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}.evh-enquiry__phone:hover{opacity:.65;}.evh-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.7;margin-bottom:20px;}.evh-enquiry__detail strong{color:#fff;font-weight:700;}.evh-enquiry__detail a{color:#aaa;text-decoration:underline;}.evh-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}.evh-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}.evh-enquiry__badge img{max-height:18px;width:auto;display:block;}.evh-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.7;}.evh-enquiry__note strong{color:#fff;font-weight:700;}.evh-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.evh-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}.evh-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.evh-section--dark .wpcf7 label,.evh-section--dark .wpcf7 p,.evh-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}.evh-section--dark .wpcf7 input[type="text"],.evh-section--dark .wpcf7 input[type="email"],.evh-section--dark .wpcf7 input[type="tel"],.evh-section--dark .wpcf7 textarea,.evh-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}.evh-section--dark .wpcf7 input::placeholder,.evh-section--dark .wpcf7 textarea::placeholder{color:#666;}.evh-section--dark .wpcf7 input:focus,.evh-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--ev-green);}.evh-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}.evh-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.evh-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}.evh-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}.evh-related__link:hover{border-color:var(--ev-green);}.evh-related__link span{color:var(--ev-green);font-size:18px;}
.evh-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}.evh-suburb-pill{display:inline-block;padding:7px 18px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:14px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}.evh-suburb-pill:hover{background:var(--ev-green);border-color:var(--ev-green);color:var(--taas-dark,#1A1A1A);}
.evh-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}.evh-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}.evh-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}.evh-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.evh-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}.evh-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}.evh-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}.evh-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}.evh-faq__item--open .evh-faq__q::after{content:'−';}.evh-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}.evh-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}.evh-faq__a a:hover{text-decoration:underline;}.evh-faq__item--open .evh-faq__a{display:block;}
.evh-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}.evh-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}.evh-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}.evh-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}.evh-btn--dark:hover{background:#000;}.evh-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}.evh-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
@media(max-width:960px){.evh-hero__inner,.evh-dealer,.evh-enquiry{grid-template-columns:1fr;}.evh-sidebar{display:none;}.evh-types{grid-template-columns:1fr 1fr;}.evh-wws,.evh-vehicles{grid-template-columns:1fr;}}
@media(max-width:640px){.evh-hero{padding:48px 0 40px;}.evh-hero h1{font-size:clamp(26px,7vw,38px);}.evh-hero__sub{font-size:14px;}.evh-section{padding:48px 0;}.evh-h2{font-size:clamp(22px,5vw,28px);}.evh-lead{font-size:14px;}.evh-content p,.evh-dealer__body,.evh-enquiry__list li,.evh-finance__text{font-size:14px;}.evh-type__desc,.evh-svc__desc,.evh-wws__item,.evh-vehicle__item,.evh-dealer__fact{font-size:13px;}.evh-trust__inner{gap:8px 20px;}.evh-trust__item{font-size:12px;}.evh-phonestrip__num{font-size:17px;}.evh-types{grid-template-columns:1fr;}.evh-faq__q{font-size:14px;padding:16px 32px 16px 0;}.evh-faq__a{font-size:13px;}.evh-hero__ctas{flex-direction:column;align-items:stretch;}.evh-hero__ctas .evh-btn{justify-content:center;text-align:center;}.evh-enquiry{display:flex;flex-direction:column-reverse;}.evh-close{flex-direction:column;align-items:flex-start;}}
</style>

<nav class="evh-crumb" aria-label="Breadcrumb"><div class="evh-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="evh-crumb__sep">›</span><a href="<?php echo esc_url($site_url.'/services/'); ?>">Services</a><span class="evh-crumb__sep">›</span><span class="evh-crumb__cur">EV &amp; Hybrid Vehicle Servicing</span></div></nav>

<section class="evh-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="evh-w"><div class="evh-hero__inner">
  <div>
    <span class="evh-eye evh-eye--green">Electric &amp; Hybrid — Manukau</span>
    <h1>EV &amp; Hybrid Vehicle<br><span>Servicing &amp; Repairs</span></h1>
    <p class="evh-hero__sub">All makes and models. BEV, HEV, PHEV, MHEV. HV-trained technicians. Battery health checks. Inverter and motor repairs. South Auckland's independent EV and hybrid specialist. <?php echo esc_html($years); ?> years of workshop experience.</p>
    <div class="evh-hero__statement"><strong>You do not need to go back to the dealer.</strong> Out of warranty? An independent workshop with the right training and equipment is entirely appropriate — and significantly more affordable.</div>
    <div class="evh-hero__tags"><?php foreach ($ev_types as $t): ?><span class="evh-hero__tag"><strong><?php echo esc_html($t['abbr']); ?></strong> <?php echo esc_html($t['name']); ?></span><?php endforeach; ?></div>
    <div class="evh-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evh-btn evh-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#evh-enquire" class="evh-btn evh-btn--outline">Book Online</a>
    </div>
  </div>
  <div class="evh-sidebar">
    <div class="evh-sidebar__title">Our EV Capability</div>
    <ul class="evh-sidebar__list"><li><strong>HV System Access</strong><em>Yes — trained technicians</em></li><li><strong>EV Qualifications</strong><em>2 technicians in training</em></li><li><strong>Battery Cell Data</strong><em>Toyota, Nissan, Honda + more</em></li><li><strong>Inverter / Motor</strong><em>Diagnosis &amp; in-car repair</em></li><li><strong>Regen Brake Service</strong><em>Yes — correct procedure</em></li><li><strong>EV Tyres</strong><em>Sourced fast — low rolling resistance</em></li></ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="evh-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="evh-phonestrip"><div class="evh-phonestrip__inner"><span class="evh-phonestrip__label">EV or hybrid — need servicing or a diagnostic?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evh-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<div class="evh-trust"><div class="evh-trust__inner"><div class="evh-trust__item">MTA Assured</div><div class="evh-trust__item">NZTA Authorised</div><div class="evh-trust__item">HV-Trained Technicians</div><div class="evh-trust__item">All EV Types</div><div class="evh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="evh-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<!-- UNDERSTANDING -->
<section class="evh-section evh-section--white"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Understanding EV &amp; Hybrid Servicing</span>
  <h2 class="evh-h2">Do Electric and Hybrid Vehicles Need Servicing?</h2>
  <div class="evh-content">
    <p>Yes. An electric vehicle has fewer moving parts than a petrol car — no engine oil, no spark plugs, no exhaust system — but it still has brakes, suspension, steering, tyres, coolant, cabin filters, and a 12V battery that all need regular maintenance. Hybrids have all of that plus a petrol engine to service as well.</p>
    <p>The difference is not that EVs need less servicing — it is that they need different servicing. Brake fluid still absorbs moisture regardless of how little the physical brakes are used. The HV battery has its own cooling circuit that needs monitoring. EV tyres wear faster because of the vehicle weight and instant torque. And the 12V auxiliary battery — the one that starts the car and runs the electronics — fails just like any other 12V battery.</p>
    <p>The dealer is not your only option. Once the factory warranty expires, any qualified workshop with the right diagnostic equipment and training can service your EV or hybrid. We have that equipment, our technicians are completing EV-specific qualifications, and we are significantly more affordable than the dealer alternative.</p>
  </div>
  <div class="evh-types"><?php foreach ($ev_types as $t): ?><div class="evh-type"><div class="evh-type__abbr"><?php echo esc_html($t['abbr']); ?></div><div class="evh-type__name"><?php echo esc_html($t['name']); ?></div><div class="evh-type__desc"><?php echo esc_html($t['desc']); ?></div></div><?php endforeach; ?></div>
</div></section>

<section class="evh-section evh-section--grey"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Our Services</span>
  <h2 class="evh-h2">EV &amp; Hybrid Services</h2>
  <div class="evh-services"><?php foreach ($services as $s): ?><a href="<?php echo esc_url($site_url.$s['url']); ?>" class="evh-svc"><div><?php echo evh_badge($s['badge']); ?></div><div class="evh-svc__body"><div class="evh-svc__title"><?php echo esc_html($s['title']); ?></div><div class="evh-svc__desc"><?php echo esc_html($s['desc']); ?></div><div class="evh-svc__cta"><?php echo esc_html($s['cta']); ?></div></div></a><?php endforeach; ?></div>
</div></section>

<section class="evh-section evh-section--white"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Full Service List</span>
  <h2 class="evh-h2">Everything We Service on EV &amp; Hybrid Vehicles</h2>
  <div class="evh-wws">
    <div class="evh-wws__col"><div class="evh-wws__heading">Same as Any Vehicle</div><ul class="evh-wws__list"><?php foreach ($same_as_petrol as $item): ?><li class="evh-wws__item"><?php echo esc_html($item); ?></li><?php endforeach; ?></ul></div>
    <div class="evh-wws__col evh-wws__col--ev"><div class="evh-wws__heading">EV &amp; Hybrid Specific</div><ul class="evh-wws__list"><?php foreach ($ev_specific as $item): ?><li class="evh-wws__item"><?php echo esc_html($item); ?></li><?php endforeach; ?></ul></div>
  </div>
</div></section>

<section class="evh-section evh-section--grey"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Dealer vs Independent</span>
  <h2 class="evh-h2">Why Choose an Independent Workshop?</h2>
  <div class="evh-dealer">
    <div class="evh-dealer__body">
      <p>The dealer servicing model is built on the assumption that you have no alternative. For vehicles under factory warranty, check your terms — most manufacturers allow servicing at any qualified workshop provided the correct schedule, parts, and fluids are used.</p>
      <p>For out-of-warranty EVs and hybrids, the decision is straightforward. We carry the same diagnostic tools the dealer uses — we read the same fault codes, the same live data, and the same battery cell information. The difference is cost. Dealer labour rates in Auckland are typically over $200 per hour. Ours are well under that — for the same diagnostic depth and repair quality. On a job that takes four or five hours, the saving is significant.</p>
      <p>We are not anti-dealer. There are warranty repairs and recall work that must go through the dealer network. But for routine servicing, brake fluid changes, tyre replacements, suspension work, diagnostic scanning, and most repairs — an independent workshop with the right capability is the sensible choice.</p>
    </div>
    <div class="evh-dealer__card">
      <div class="evh-dealer__quote">Same diagnostic data. Same repair quality. Less cost. No upselling.</div>
      <ul class="evh-dealer__facts"><li class="evh-dealer__fact">HV system access — trained technicians</li><li class="evh-dealer__fact">Battery cell data reading — Toyota, Nissan, Honda + more</li><li class="evh-dealer__fact">Inverter and drive motor diagnosis</li><li class="evh-dealer__fact">Correct EV service procedures followed</li><li class="evh-dealer__fact">MTA Assured — <?php echo esc_html($years); ?> years trading</li><li class="evh-dealer__fact"><?php echo esc_html($customers); ?> customers serviced</li></ul>
    </div>
  </div>
</div></section>

<section class="evh-section evh-section--dark"><div class="evh-w">
  <span class="evh-eye evh-eye--yellow">Vehicles We Service</span>
  <h2 class="evh-h2 evh-h2--white">Every EV &amp; Hybrid Make in New Zealand</h2>
  <p class="evh-lead">The NZ EV market is changing fast. New makes arrive regularly — if your vehicle is not listed, call us. We almost certainly cover it.</p>
  <div class="evh-vehicles"><?php foreach ($vehicles as $v): ?><div class="evh-vehicle"><div class="evh-vehicle__region<?php echo strpos($v['region'],'Chinese')!==false?' evh-vehicle__region--hot':''; ?>"><?php echo esc_html($v['region']); ?></div><ul class="evh-vehicle__list"><?php foreach ($v['makes'] as $m): ?><li class="evh-vehicle__item"><?php echo esc_html($m); ?></li><?php endforeach; ?></ul></div><?php endforeach; ?></div>
</div></section>

<div class="evh-finance"><div class="evh-finance__inner">
  <div class="evh-finance__text"><strong>Finance available</strong> — EV-specific repairs can be significant. Don't delay.</div>
  <div class="evh-finance__logos"><?php foreach ($finance as $f): ?><span class="evh-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" class="evh-finance__link">View finance options →</a>
</div></div>

<section id="evh-enquire" class="evh-section evh-section--dark"><div class="evh-w"><div class="evh-enquiry">
  <div>
    <span class="evh-eye evh-eye--yellow">Book or Enquire</span>
    <h2 class="evh-h2 evh-h2--white">EV &amp; Hybrid Servicing — <span style="color:var(--ev-green);">Enquire Now</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your make, model, year, and whether it is BEV, hybrid, or plug-in hybrid. We will advise what service is due and provide an estimate.</p>
    <ul class="evh-enquiry__list"><?php foreach (['HV-trained technicians — battery, inverter, motor','Written estimate before any work begins','All EV and hybrid types — Japanese, Korean, Chinese, European','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="evh-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="evh-enquiry__badges"><?php foreach ($finance as $f): ?><span class="evh-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="evh-enquiry__note"><strong>Estimate before we start.</strong> We confirm the cost before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="evh-enquiry__form">
    <div class="evh-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--ev-green);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--ev-green);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="evh-section evh-section--white"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Customer Reviews</span>
  <h2 class="evh-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<section class="evh-section evh-section--grey"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Related Services</span>
  <h2 class="evh-h2">Connected Services</h2>
  <div class="evh-related__grid"><?php foreach ($related as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="evh-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<section class="evh-section evh-section--white"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Common Questions</span>
  <h2 class="evh-h2">EV &amp; Hybrid Servicing — FAQ</h2>
  <div class="evh-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="evh-faq__item<?php echo $i===0?' evh-faq__item--open':''; ?>"><button class="evh-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="evh-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="evh-a-<?php echo $i; ?>" class="evh-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<section class="evh-section evh-section--grey"><div class="evh-w">
  <span class="evh-eye evh-eye--dark">Service Areas</span>
  <h2 class="evh-h2">EV &amp; Hybrid Servicing Across South Auckland</h2>
  <div class="evh-suburb-pills"><?php foreach ($suburbs as $s): ?><a href="<?php echo esc_url($site_url.'/hybrid-vehicle-service-'.$s['slug'].'/'); ?>" class="evh-suburb-pill"><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
  <div class="evh-close">
    <div class="evh-close__text">South Auckland's independent EV &amp; hybrid specialist.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="evh-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="evh-btn evh-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#evh-enquire" class="evh-btn evh-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.evh-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.evh-faq__item');var wasOpen=item.classList.contains('evh-faq__item--open');document.querySelectorAll('.evh-faq__item--open').forEach(function(el){el.classList.remove('evh-faq__item--open');el.querySelector('.evh-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('evh-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
