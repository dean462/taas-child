<?php
/**
 * Template Name: Engine Repairs Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Serves 4 engine sub-service pages:
 *   /engine-oil-leak-repair-manukau/
 *   /engine-noise-diagnosis-manukau/
 *   /engine-misfire-manukau/
 *   /engine-oil-consumption-manukau/
 *
 * Content pulled from post_meta (set via deploy runner).
 * Cross-links auto-generated from master services array.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$post_id       = get_the_ID();
$page_slug     = get_post_field('post_name', $post_id);
$phone_local   = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free    = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email         = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established   = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating        = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews       = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$ms_number     = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$customers     = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$mech_diag     = defined('TAAS_MECH_DIAG')     ? TAAS_MECH_DIAG     : 'from $175';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$phone_free_tel= preg_replace('/[^0-9+]/', '', $phone_free);
$years         = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Master services array — defines all 4 engine sub-services ───────────────
$engine_master = [
    'engine-oil-leak-repair-manukau' => [
        'name'   => 'Engine Oil Leak Repair',
        'badge'  => 'OL',
        'short'  => 'Rocker covers, sump gaskets, cam seals, crank seals — source identified before repair.',
        'price'  => 'Diagnostic ' . $scan_price . ' · Repair quoted individually',
    ],
    'engine-noise-diagnosis-manukau' => [
        'name'   => 'Engine Noise Diagnosis',
        'badge'  => 'EN',
        'short'  => 'Knocking, ticking, rattling — isolated using mechanical testing, not guesswork.',
        'price'  => 'Full mechanical diagnosis ' . $mech_diag,
    ],
    'engine-misfire-manukau' => [
        'name'   => 'Engine Misfire Diagnosis',
        'badge'  => 'MF',
        'short'  => 'Spark plugs, coils, injectors, compression — cause confirmed before parts ordered.',
        'price'  => 'Diagnostic scan ' . $scan_price . ' · Full diagnosis ' . $mech_diag,
    ],
    'engine-oil-consumption-manukau' => [
        'name'   => 'Oil Consumption Testing',
        'badge'  => 'OC',
        'short'  => 'Measured consumption rate, leak checks, valve seal and piston ring testing.',
        'price'  => 'Full mechanical diagnosis ' . $mech_diag,
    ],
];

// ── Current page data ────────────────────────────────────────────────────────
$current = $engine_master[$page_slug] ?? null;
$service_name = '';
$hero_price   = '';

if ($current) {
    $service_name = $current['name'];
    $hero_price   = $current['price'];
}

// Override from post_meta if set (runner data takes precedence)
$meta_name = get_post_meta($post_id, 'service_name', true);
if ($meta_name) $service_name = $meta_name;
if (!$service_name) $service_name = get_the_title();

// Clean service name for H1 — strip trailing location to prevent "Manukau Manukau"
$h1_name = preg_replace('/\s*(–|—)?\s*(Manukau|South Auckland)\s*$/i', '', $service_name);
$h1_name = trim($h1_name, ' -–—');

// ── Post meta content ────────────────────────────────────────────────────────
$what_it_is    = get_post_meta($post_id, 'what_it_is', true) ?: '';
$causes_raw    = get_post_meta($post_id, 'causes', true) ?: '';
$symptoms_raw  = get_post_meta($post_id, 'symptoms', true) ?: '';
$process_raw   = get_post_meta($post_id, 'our_process', true) ?: '';
$vehicles_note = get_post_meta($post_id, 'vehicles_note', true) ?: '';
$urgency_level = get_post_meta($post_id, 'urgency_level', true) ?: 'medium';
$urgency_msg   = get_post_meta($post_id, 'urgency_message', true) ?: '';
$price_signal  = get_post_meta($post_id, 'price_signal', true) ?: $hero_price;

// Parse pipe-separated fields
$causes   = $causes_raw   ? array_filter(array_map('trim', explode('|', $causes_raw)))   : [];
$symptoms = $symptoms_raw  ? array_filter(array_map('trim', explode('|', $symptoms_raw)))  : [];
$process  = $process_raw   ? array_filter(array_map('trim', explode('|', $process_raw)))   : [];

// ── Custom FAQs from post_meta ───────────────────────────────────────────────
$faqs = [];
for ($i = 1; $i <= 6; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $faqs[] = ['q' => $q, 'a' => $a];
}

// Add standard FAQs — always top up to 10
$standard_faqs = [
    ['q' => "How much does {$service_name} cost in Manukau?", 'a' => "The cost depends on the specific fault and your vehicle. Diagnostic scan {$scan_price}, full mechanical diagnosis {$mech_diag}. We provide a written estimate before starting any repair — no surprises. Call " . TAAS_PHONE_FREE . " for a ballpark figure."],
    ['q' => "How long does {$service_name} take?", 'a' => "Diagnosis typically takes a few hours. Repair time varies depending on the fault — some are same-day, others require parts to be ordered. We give you a clear timeframe once we've diagnosed the issue."],
    ['q' => "Do you provide a written estimate before starting work?", 'a' => "Always. We diagnose the fault, explain what we've found in plain English, and give you a written estimate before any work begins. No work starts without your approval. If the repair isn't worth the cost, we'll tell you that too."],
    ['q' => "Can I use my MBI policy for this repair?", 'a' => "If you have Mechanical Breakdown Insurance, engine repairs are one of the most common claims. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. Call your provider first, then bring your vehicle to us at 139 Cavendish Drive, Manukau. We liaise with the insurer and handle the claim process."],
    ['q' => "Do you work on European engines?", 'a' => "Yes. Our TAAS European division handles " . TAAS_EURO_BRANDS . " with factory-spec diagnostic equipment. European engines often have specific service intervals, torque specs, and fault patterns that generic workshops miss. We have the tools and knowledge to get it right."],
    ['q' => "Is it safe to drive my car if I think there's an engine problem?", 'a' => "It depends on the symptom. A minor oil leak or slight rough idle is usually safe for short distances — but book a diagnostic soon. If you hear knocking, see steam or white smoke, have a flashing check engine light, or your temperature gauge is in the red — stop driving and call us on " . TAAS_PHONE_FREE . ". Continuing to drive with a serious engine fault can turn a repairable problem into a replacement engine."],
    ['q' => "Can I pay for engine repairs with Afterpay or finance?", 'a' => "Yes. We accept Afterpay, Q Card, Gem Finance, and Aotea Finance — so you can spread the cost of larger repairs. We also accept Visa, Mastercard, EFTPOS, and cash. Let us know which option you plan to use when you book."],
    ['q' => "Do I need to book or can I just drive in?", 'a' => "For engine diagnostics and repairs, booking is recommended so we can allocate the right time and equipment for your vehicle. Call " . TAAS_PHONE_FREE . " or use our online enquiry form. Walk-ins are welcome for WOF inspections in the mornings."],
    ['q' => "What accreditations does Tony Allen Auto Service hold?", 'a' => "We are MTA Assured through the Motor Trade Association quality assurance programme, and NZTA Authorised for Warrant of Fitness inspections — station number " . TAAS_MS_NUMBER . ". Family-owned and operating from 139 Cavendish Drive, Manukau since " . TAAS_ESTABLISHED . " — " . $years . " years at the same address."],
    ['q' => "Where is Tony Allen Auto Service?", 'a' => "139 Cavendish Drive, Manukau, Auckland 2104. Open Monday to Friday, 7:30am to 5:00pm. Free off-street parking on site. Call " . TAAS_PHONE_FREE . " to book an engine diagnostic. We serve Papatoetoe, Mangere, Otahuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Otara, Botany and all of South Auckland."],
];
foreach ($standard_faqs as $sf) {
    if (count($faqs) >= 10) break;
    // Avoid duplicating questions already in custom FAQs
    $exists = false;
    foreach ($faqs as $existing) {
        if (stripos($existing['q'], substr($sf['q'], 0, 30)) !== false) { $exists = true; break; }
    }
    if (!$exists) $faqs[] = $sf;
}

// ── Urgency config (simplified) ──────────────────────────────────────────────
$urg_colours = [
    'high'   => ['border' => '#C0392B', 'bg' => '#fdf0ee'],
    'medium' => ['border' => '#FFC800', 'bg' => '#fffbea'],
    'low'    => ['border' => '#27ae60', 'bg' => '#eafaf1'],
];
$urg = $urg_colours[$urgency_level] ?? $urg_colours['medium'];

// ── Badge generator ──────────────────────────────────────────────────────────
function ers_badge($initials) {
    $len = strlen($initials);
    $fs = $len > 3 ? 9 : ($len > 2 ? 11 : 14);
    return '<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#1A1A1A"/><text x="20" y="21" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Schema ────────────────────────────────────────────────────────────────────
$schema_faqs = array_map(function($f){ return ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]]; }, $faqs);
$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'Engine Repairs','item'=>$site_url.'/engine-repairs/'],
            ['@type'=>'ListItem','position'=>3,'name'=>$service_name,'item'=>$page_url],
        ]],
        ['@type'=>'Service','@id'=>$page_url.'#service','name'=>$service_name.' — Manukau','serviceType'=>'Engine Repair','description'=>wp_trim_words($what_it_is, 40, '…'),
         'provider'=>['@type'=>'AutoRepair','@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','telephone'=>[TAAS_PHONE_LOCAL,TAAS_PHONE_FREE],'email'=>TAAS_EMAIL,
            'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
            'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
            'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],
            'openingHours'=>'Mo-Fr 07:30-17:00','foundingDate'=>'1985-10',
            'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
            'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)']],
         'areaServed'=>[['@type'=>'City','name'=>'Manukau'],['@type'=>'City','name'=>'South Auckland']]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.ers-hero__sub','.ers-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-engine-sub .site-content,
.page-template-template-engine-sub .entry-content,
.page-template-template-engine-sub .entry-header,
.page-template-template-engine-sub article,
.page-template-template-engine-sub #primary,
.page-template-template-engine-sub #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-engine-sub { overflow-x:hidden; }

.ers { font-family:var(--taas-font, 'Inter', Arial, sans-serif); color:var(--taas-body, #333); -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:100%; text-size-adjust:100%; overflow-x:hidden; }
.ers a { text-decoration:none; }
.ers-w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ── Breadcrumb ────────────────────────────────────────────────────────────── */
.ers-bc { background:#1A1A1A; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.ers-bc__inner { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:400; color:#666; }
.ers-bc__inner a { color:#888; transition:color .15s; }
.ers-bc__inner a:hover { color:var(--taas-yellow, #FFC800); }
.ers-bc__sep { color:#444; }

/* ── Phone strip ──────────────────────────────────────────────────────────── */
.ers-pstrip { background:var(--taas-yellow, #FFC800); padding:14px 0; }
.ers-pstrip__inner { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.ers-pstrip__number { font-size:28px; font-weight:900; color:var(--taas-dark, #1A1A1A); }
.ers-pstrip__number a { color:inherit; }
.ers-pstrip__number a:hover { opacity:.65; }
.ers-pstrip__right { display:flex; align-items:center; gap:20px; }
.ers-pstrip__hours { font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); }
.ers-pstrip__email { display:inline-block; background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); font-size:12px; font-weight:700; padding:6px 14px; border-radius:3px; }
.ers-pstrip__email:hover { opacity:.85; }

/* ── Finance strip ────────────────────────────────────────────────────────── */
.ers-finance { background:var(--taas-panel, #F7F7F5); padding:24px 0; border-top:1px solid var(--taas-border, #E8E8E4); border-bottom:1px solid var(--taas-border, #E8E8E4); }
.ers-finance__inner { display:flex; align-items:center; justify-content:center; gap:24px; flex-wrap:wrap; text-align:center; }
.ers-finance__text { font-size:14px; font-weight:300; color:#555; line-height:1.75; }
.ers-finance__text a { color:var(--taas-yellow, #FFC800); font-weight:600; }
.ers-finance__badges { display:flex; gap:12px; flex-wrap:wrap; }
.ers-finance__badge { font-size:12px; font-weight:700; color:var(--taas-dark, #1A1A1A); background:#fff; border:1px solid var(--taas-border, #E8E8E4); padding:4px 12px; border-radius:3px; }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.ers-hero { background:var(--taas-black, #111); padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px); }
.ers-hero__inner { display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:start; }
.ers-eye { display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; padding:4px 12px; border-radius:3px; margin-bottom:14px; }
.ers-eye--hero { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); }
.ers-eye--dark { background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800); }
.ers-eye--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); }
.ers-hero__h1 { font-size:var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight:800; color:var(--taas-white, #fff); letter-spacing:-0.02em; line-height:1.1; margin:0 0 16px; }
.ers-hero__h1 span { color:var(--taas-yellow, #FFC800); }
.ers-hero__sub { font-size:16px; font-weight:300; color:#aaa; max-width:540px; margin:0 0 16px; line-height:1.75; }
.ers-hero__price { font-size:15px; font-weight:700; color:var(--taas-yellow, #FFC800); margin-bottom:20px; }
.ers-hero__ctas { display:flex; gap:12px; flex-wrap:wrap; }
.ers-sidebar { background:#1e1e1e; border:1px solid #333; border-radius:var(--taas-radius, 6px); padding:24px; }
.ers-sidebar__title { font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; color:var(--taas-yellow, #FFC800); margin-bottom:14px; }
.ers-sidebar__list { list-style:none; padding:0; margin:0 0 20px; display:flex; flex-direction:column; gap:8px; }
.ers-sidebar__list li { font-size:13px; color:#ccc; padding-left:18px; position:relative; line-height:1.4; }
.ers-sidebar__list li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow, #FFC800); font-weight:700; }
.ers-sidebar hr { border:none; border-top:1px solid #333; margin:0 0 16px; }
.ers-sidebar__phone { display:block; font-size:22px; font-weight:800; color:var(--taas-yellow, #FFC800); text-decoration:none; margin-bottom:4px; }
.ers-sidebar__phone:hover { color:#fff; }
.ers-sidebar__detail { font-size:12px; color:#666; line-height:1.6; }

/* ── Trust ─────────────────────────────────────────────────────────────────── */
.ers-trust { background:var(--taas-yellow, #FFC800); padding:var(--taas-trust-pad, 18px) 0; }
.ers-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.ers-trust__item { font-size:var(--taas-trust-size, 14px); font-weight:600; color:var(--taas-dark, #1A1A1A); display:flex; align-items:center; gap:7px; white-space:nowrap; }
.ers-trust__item::before { content:'✓'; font-weight:900; }

/* ── Sections ──────────────────────────────────────────────────────────────── */
.ers-sec { padding:var(--taas-sec-pad, 72px) 0; }
.ers-sec--white { background:var(--taas-white, #fff); }
.ers-sec--grey  { background:var(--taas-panel, #F7F7F5); }
.ers-sec--dark  { background:var(--taas-dark, #1A1A1A); }
.ers-sec__h2 { font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:var(--taas-black, #111); letter-spacing:-0.01em; margin:0 0 12px; }
.ers-sec--dark .ers-sec__h2 { color:var(--taas-white, #fff); }
.ers-sec__sub { font-size:16px; font-weight:300; color:var(--taas-mid, #666); max-width:640px; margin:0 0 32px; line-height:1.75; }
.ers-sec--dark .ers-sec__sub { color:#aaa; }

/* ── Two-col layout ────────────────────────────────────────────────────────── */
.ers-two-col { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }

/* ── Urgency callout (simplified) ──────────────────────────────────────────── */
.ers-urgency { border-left:4px solid; padding:20px 24px; border-radius:0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; margin-top:24px; }
.ers-urgency__msg { font-size:15px; line-height:1.65; color:var(--taas-body, #333); }

/* ── Checklist ─────────────────────────────────────────────────────────────── */
.ers-checklist { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; }
.ers-checklist li { font-size:15px; font-weight:300; color:var(--taas-body, #333); line-height:1.75; padding-left:24px; position:relative; }
.ers-checklist li::before { content:'✓'; position:absolute; left:0; color:var(--taas-yellow, #FFC800); font-weight:700; }

/* ── Process steps ─────────────────────────────────────────────────────────── */
.ers-steps { display:flex; flex-direction:column; gap:0; margin-top:24px; }
.ers-step { display:grid; grid-template-columns:44px 1fr; gap:16px; padding:20px 0; border-bottom:1px solid var(--taas-border, #E8E8E4); }
.ers-step:last-child { border-bottom:none; }
.ers-step__num { width:40px; height:40px; background:var(--taas-dark, #1A1A1A); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:16px; font-weight:800; color:var(--taas-yellow, #FFC800); flex-shrink:0; }
.ers-step__title { font-size:15px; font-weight:700; color:var(--taas-black, #111); margin-bottom:4px; }
.ers-step__body { font-size:14px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; }

/* ── Sibling cards ─────────────────────────────────────────────────────────── */
.ers-related { display:grid; grid-template-columns:repeat(3, 1fr); gap:14px; margin-top:28px; }
.ers-card { background:var(--taas-white, #fff); border:1px solid var(--taas-border, #E8E8E4); border-radius:var(--taas-radius, 6px); padding:20px 18px; display:flex; flex-direction:column; gap:8px; text-decoration:none; transition:box-shadow .2s, transform .2s, border-color .2s; border-top:3px solid transparent; }
.ers-card:hover { box-shadow:0 4px 16px rgba(0,0,0,.08); transform:translateY(-2px); border-top-color:var(--taas-yellow, #FFC800); }
.ers-card__icon { width:40px; height:40px; }
.ers-card__title { font-size:14px; font-weight:700; color:var(--taas-black, #111); }
.ers-card__desc { font-size:13px; color:var(--taas-mid, #666); line-height:1.5; flex:1; }
.ers-card__link { font-size:12px; font-weight:700; color:var(--taas-yellow2, #e6b400); margin-top:auto; }
.ers-card:hover .ers-card__link { color:var(--taas-yellow, #FFC800); }

/* ── Callout ───────────────────────────────────────────────────────────────── */
.ers-callout { border-left:4px solid var(--taas-yellow, #FFC800); background:#fffbea; padding:24px 28px; border-radius:0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; margin-top:28px; }
.ers-callout__title { font-size:15px; font-weight:700; color:var(--taas-dark, #1A1A1A); margin-bottom:8px; }
.ers-callout__body { font-size:15px; color:var(--taas-body, #333); line-height:1.65; }

/* ── FAQ ───────────────────────────────────────────────────────────────────── */
.ers-faq__list { margin-top:28px; }
.ers-faq__item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.ers-faq__q { width:100%; text-align:left; background:none; border:none; padding:20px 40px 20px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-faq-q, 15px); font-weight:700; color:var(--taas-black, #111); cursor:pointer; position:relative; line-height:1.4; display:block; }
.ers-faq__q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:400; color:var(--taas-mid, #666); transition:transform .2s; }
.ers-faq__item--open .ers-faq__q::after { content:'−'; }
.ers-faq__a { display:none; padding:0 0 20px; font-size:var(--taas-faq-a, 15px); color:var(--taas-mid, #666); line-height:1.75; }
.ers-faq__item--open .ers-faq__a { display:block; }

/* ── CTA / Enquiry ─────────────────────────────────────────────────────────── */
.ers-cta__grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.ers-cta__phone { display:block; font-size:var(--taas-cta-phone, clamp(28px, 4vw, 40px)); font-weight:800; color:var(--taas-yellow, #FFC800); text-decoration:none; margin:16px 0 6px; }
.ers-cta__phone:hover { color:#fff; }
.ers-cta__detail { font-size:15px; color:#aaa; line-height:1.7; }
.ers-cta__detail strong { color:var(--taas-white, #fff); }
.ers-sec--dark .wpcf7 label { font-size:11px!important; font-weight:700!important; letter-spacing:.08em!important; text-transform:uppercase!important; color:#888!important; display:block!important; }
.ers-sec--dark .wpcf7 input[type="text"], .ers-sec--dark .wpcf7 input[type="email"], .ers-sec--dark .wpcf7 input[type="tel"], .ers-sec--dark .wpcf7 textarea { background:#1c1c1c!important; border:1px solid #333!important; color:#fff!important; border-radius:var(--taas-radius, 6px)!important; padding:12px 14px!important; width:100%!important; font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important; font-size:15px!important; font-weight:300!important; box-sizing:border-box!important; margin-top:4px!important; transition:border-color .15s!important; }
.ers-sec--dark .wpcf7 input::placeholder, .ers-sec--dark .wpcf7 textarea::placeholder { color:#666; }
.ers-sec--dark .wpcf7 input:focus, .ers-sec--dark .wpcf7 textarea:focus { outline:none!important; border-color:var(--taas-yellow, #FFC800)!important; }
.ers-sec--dark .wpcf7 textarea { min-height:100px!important; resize:vertical!important; }
.ers-sec--dark .wpcf7 input[type="submit"] { background:var(--taas-yellow, #FFC800)!important; color:var(--taas-dark, #1A1A1A)!important; font-weight:700!important; font-size:14px!important; letter-spacing:.04em!important; text-transform:uppercase!important; border:none!important; padding:14px 28px!important; border-radius:var(--taas-radius, 6px)!important; cursor:pointer!important; width:100%!important; margin-top:4px!important; }
.ers-sec--dark .wpcf7 input[type="submit"]:hover { background:var(--taas-yellow2, #e6b400); }

/* ── Buttons ───────────────────────────────────────────────────────────────── */
.ers-btn { display:inline-flex; align-items:center; gap:8px; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-weight:var(--taas-btn-wt, 700); font-size:var(--taas-btn-size, 14px); letter-spacing:.04em; text-transform:uppercase; padding:var(--taas-btn-pad, 14px 26px); border-radius:var(--taas-radius, 6px); transition:all .18s; border:2px solid transparent; text-decoration:none; cursor:pointer; }
.ers-btn--primary { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; border-color:var(--taas-yellow, #FFC800); }
.ers-btn--primary:hover { background:var(--taas-yellow2, #e6b400); border-color:var(--taas-yellow2, #e6b400); }
.ers-btn--outline { background:transparent; color:var(--taas-yellow, #FFC800)!important; border:2px solid var(--taas-yellow, #FFC800); }
.ers-btn--outline:hover { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; }

@media (max-width:960px) {
  .ers-hero__inner { grid-template-columns:1fr; }
  .ers-sidebar { display:none; }
  .ers-two-col { grid-template-columns:1fr; }
  .ers-related { grid-template-columns:repeat(2, 1fr); }
  .ers-cta__grid { grid-template-columns:1fr; gap:32px; }
}
@media (max-width:640px) {
  .ers-hero { padding:var(--taas-sec-pad-m, 48px) 0 40px; }
  .ers-sec { padding:var(--taas-sec-pad-m, 48px) 0; }
  .ers-hero__h1 { font-size:clamp(24px, 7vw, 36px); }
  .ers-hero__sub { font-size:14px; }
  .ers-hero__ctas { flex-direction:column; align-items:stretch; }
  .ers-hero__ctas .ers-btn { justify-content:center; }
  .ers-related { grid-template-columns:1fr; }
  .ers-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; padding:0 24px; }
  .ers-trust__item { font-size:12px; }
  .ers-cta__grid { display:flex; flex-direction:column-reverse; gap:32px; }
  .ers-pstrip__inner { flex-direction:column; text-align:center; }
  .ers-pstrip__right { flex-direction:column; gap:8px; }
  .ers-step { grid-template-columns:36px 1fr; gap:12px; padding:16px 0; }
  .ers-step__num { width:32px; height:32px; font-size:14px; }
  .ers-faq__a { font-size:14px; }
  .ers-cta__phone { font-size:clamp(24px, 6vw, 32px); }
}
</style>

<div class="ers">

<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════════════ -->
<nav class="ers-bc" aria-label="Breadcrumb">
  <div class="ers-w">
    <div class="ers-bc__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="ers-bc__sep">›</span>
      <a href="<?php echo esc_url($site_url . '/engine-repairs/'); ?>">Engine Repairs</a>
      <span class="ers-bc__sep">›</span>
      <span><?php echo esc_html($service_name); ?></span>
    </div>
  </div>
</nav>

<!-- ══ HERO ════════════════════════════════════════════════════════════════════ -->
<section class="ers-hero">
  <div class="ers-w">
    <div class="ers-hero__inner">
      <div>
        <span class="ers-eye ers-eye--hero">Engine Repairs — Manukau</span>
        <h1 class="ers-hero__h1"><?php echo esc_html($h1_name); ?><br><span>Manukau — South Auckland</span></h1>
        <p class="ers-hero__sub"><?php
          if ($what_it_is) {
              echo esc_html(wp_trim_words($what_it_is, 35, '…'));
          } else {
              echo esc_html($service_name) . ' — diagnosed and repaired in-house. Written estimate before work starts. ' . esc_html($years) . ' years of workshop experience.';
          }
        ?></p>
        <?php if ($price_signal): ?>
        <p class="ers-hero__price"><?php echo esc_html($price_signal); ?></p>
        <?php endif; ?>
        <div class="ers-hero__ctas">
          <a href="#enquire" class="ers-btn ers-btn--primary">Book <?php echo esc_html($service_name); ?></a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ers-btn ers-btn--outline"><?php echo esc_html($phone_free); ?></a>
        </div>
      </div>
      <div class="ers-sidebar">
        <div class="ers-sidebar__title">Engine Repair Services</div>
        <ul class="ers-sidebar__list">
          <li>Oil leak diagnosis & repair</li>
          <li>Engine noise investigation</li>
          <li>Misfire diagnosis & repair</li>
          <li>Oil consumption testing</li>
          <li>Head gasket replacement</li>
          <li>Timing chain service</li>
          <li>Engine mount replacement</li>
          <li>Compression & leak-down testing</li>
          <li>European engine specialists</li>
        </ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ers-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ers-sidebar__detail"><?php echo esc_html($phone_local); ?><br><?php echo esc_html($hours); ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ════════════════════════════════════════════════════════════ -->
<div class="ers-pstrip" role="region" aria-label="Contact">
  <div class="ers-w">
    <div class="ers-pstrip__inner">
      <div class="ers-pstrip__number"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></div>
      <div class="ers-pstrip__right">
        <span class="ers-pstrip__hours"><?php echo esc_html($hours); ?></span>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="ers-pstrip__email"><?php echo esc_html($email); ?></a>
      </div>
    </div>
  </div>
</div>

<!-- ══ TRUST STRIP ════════════════════════════════════════════════════════════ -->
<div class="ers-trust">
  <div class="ers-w">
    <div class="ers-trust__inner">
      <span class="ers-trust__item">MTA Assured</span>
      <span class="ers-trust__item">NZTA Authorised</span>
      <span class="ers-trust__item">Written estimate before work starts</span>
      <span class="ers-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> reviews</span>
      <span class="ers-trust__item">Since <?php echo esc_html($established); ?></span>
    </div>
  </div>
</div>

<!-- ══ WHAT IT IS ══════════════════════════════════════════════════════════════ -->
<?php if ($what_it_is): ?>
<section class="ers-sec ers-sec--white">
  <div class="ers-w">
    <span class="ers-eye ers-eye--dark"><?php echo esc_html($service_name); ?></span>
    <h2 class="ers-sec__h2">What is <?php echo esc_html($service_name); ?>?</h2>
    <p class="ers-sec__sub" style="max-width:800px;"><?php echo wp_kses_post($what_it_is); ?></p>
    <?php if ($urgency_msg): ?>
    <div class="ers-urgency" style="border-color:<?php echo $urg['border']; ?>;background:<?php echo $urg['bg']; ?>;">
      <p class="ers-urgency__msg"><?php echo esc_html($urgency_msg); ?></p>
    </div>
    <?php endif; ?>
    <?php if ($vehicles_note): ?>
    <div class="ers-callout" style="margin-top:24px;">
      <div class="ers-callout__title">Vehicle-specific note</div>
      <p class="ers-callout__body"><?php echo esc_html($vehicles_note); ?></p>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- ══ CAUSES & SYMPTOMS ══════════════════════════════════════════════════════ -->
<?php if ($causes || $symptoms): ?>
<section class="ers-sec ers-sec--grey">
  <div class="ers-w">
    <div class="ers-two-col">
      <?php if ($causes): ?>
      <div>
        <span class="ers-eye ers-eye--dark">Causes</span>
        <h2 class="ers-sec__h2">What causes this?</h2>
        <ul class="ers-checklist">
          <?php foreach ($causes as $c): ?>
          <li><?php echo wp_kses_post($c); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
      <?php if ($symptoms): ?>
      <div>
        <span class="ers-eye ers-eye--dark">Symptoms</span>
        <h2 class="ers-sec__h2">Warning signs</h2>
        <ul class="ers-checklist">
          <?php foreach ($symptoms as $s): ?>
          <li><?php echo wp_kses_post($s); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══ OUR PROCESS ════════════════════════════════════════════════════════════ -->
<?php if ($process): ?>
<section class="ers-sec ers-sec--white">
  <div class="ers-w">
    <span class="ers-eye ers-eye--dark">Our Process</span>
    <h2 class="ers-sec__h2">How we handle <?php echo esc_html($service_name); ?></h2>
    <div class="ers-steps">
      <?php foreach ($process as $i => $step):
        $parts = explode(' — ', $step, 2);
        $title = $parts[0];
        $body  = $parts[1] ?? '';
      ?>
      <div class="ers-step">
        <div class="ers-step__num"><?php echo ($i + 1); ?></div>
        <div>
          <div class="ers-step__title"><?php echo wp_kses_post($title); ?></div>
          <?php if ($body): ?><p class="ers-step__body"><?php echo esc_html($body); ?></p><?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="ers-callout">
      <div class="ers-callout__title">Diagnostic scan <?php echo esc_html($scan_price); ?> · Full mechanical diagnosis <?php echo esc_html($mech_diag); ?></div>
      <p class="ers-callout__body">All fees explained upfront. If you proceed with the repair, the diagnostic fee applies to the final invoice.</p>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══ FINANCE STRIP ══════════════════════════════════════════════════════════ -->
<div class="ers-finance" role="region" aria-label="Finance options">
  <div class="ers-w">
    <div class="ers-finance__inner">
      <span class="ers-finance__text">Spread the cost of engine repairs — <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">finance available</a></span>
      <div class="ers-finance__badges">
        <span class="ers-finance__badge">Afterpay</span>
        <span class="ers-finance__badge">Q Card</span>
        <span class="ers-finance__badge">Gem Finance</span>
        <span class="ers-finance__badge">Aotea Finance</span>
      </div>
    </div>
  </div>
</div>

<!-- ══ ENQUIRY / CTA ═════════════════════════════════════════════════════════ -->
<section class="ers-sec ers-sec--dark" id="enquire">
  <div class="ers-w">
    <div class="ers-cta__grid">
      <div>
        <span class="ers-eye ers-eye--yellow">Book or Enquire</span>
        <h2 class="ers-sec__h2">Book <?php echo esc_html($service_name); ?></h2>
        <p style="font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle make, model and what symptoms you've noticed.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="ers-cta__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="ers-cta__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#999;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
      </div>
      <div><?php echo do_shortcode(TAAS_CF7_GENERAL); ?></div>
    </div>
  </div>
</section>

<!-- ══ OTHER ENGINE SERVICES ══════════════════════════════════════════════════ -->
<section class="ers-sec ers-sec--grey">
  <div class="ers-w">
    <span class="ers-eye ers-eye--dark">Engine Repairs</span>
    <h2 class="ers-sec__h2">Other engine repair services</h2>
    <p class="ers-sec__sub">All engine work is carried out in-house at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
    <div class="ers-related">
      <?php foreach ($engine_master as $slug => $svc):
        if ($slug === $page_slug) continue; // skip current page
      ?>
      <a href="<?php echo esc_url($site_url . '/' . $slug . '/'); ?>" class="ers-card">
        <div class="ers-card__icon"><?php echo ers_badge($svc['badge']); ?></div>
        <div class="ers-card__title"><?php echo esc_html($svc['name']); ?></div>
        <p class="ers-card__desc"><?php echo esc_html($svc['short']); ?></p>
        <span class="ers-card__link"><?php echo esc_html($svc['name']); ?> →</span>
      </a>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:20px;"><a href="<?php echo esc_url($site_url . '/engine-repairs/'); ?>" style="font-size:14px;font-weight:700;color:var(--taas-yellow, #FFC800);">← Back to all Engine Repairs</a></p>
  </div>
</section>

<!-- ══ MBI ════════════════════════════════════════════════════════════════════ -->
<section class="ers-sec ers-sec--dark">
  <div class="ers-w" style="max-width:800px;text-align:center;">
    <span class="ers-eye ers-eye--yellow">MBI Approved Repairer</span>
    <h2 class="ers-sec__h2">Got an MBI policy? We handle the claim.</h2>
    <p style="font-size:16px;color:#aaa;line-height:1.7;margin-bottom:24px;">Engine repairs are one of the most common MBI claims. We're an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. Call your provider first, then bring the vehicle to us — we liaise with the insurer and get the work authorised.</p>
    <a href="<?php echo esc_url($site_url . '/mechanical-breakdown-insurance/'); ?>" class="ers-btn ers-btn--primary">MBI Information →</a>
  </div>
</section>

<!-- ══ REVIEWS ════════════════════════════════════════════════════════════════ -->
<section class="ers-sec ers-sec--white">
  <div class="ers-w">
    <span class="ers-eye ers-eye--dark"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="ers-sec__h2">What customers say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══ FAQ ════════════════════════════════════════════════════════════════════ -->
<section class="ers-sec ers-sec--grey">
  <div class="ers-w">
    <span class="ers-eye ers-eye--dark">FAQ</span>
    <h2 class="ers-sec__h2"><?php echo esc_html($service_name); ?> — Questions Answered</h2>
    <div class="ers-faq__list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'ers-faq-q-' . $fi;
        $aid = 'ers-faq-a-' . $fi;
      ?>
      <div class="ers-faq__item<?php echo $fi === 0 ? ' ers-faq__item--open' : ''; ?>">
        <button class="ers-faq__q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="ers-faq__a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div><!-- /.ers -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('.ers-faq__q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item = this.closest('.ers-faq__item');
      var wasOpen = item.classList.contains('ers-faq__item--open');
      document.querySelectorAll('.ers-faq__item--open').forEach(function(i){
        i.classList.remove('ers-faq__item--open');
        i.querySelector('.ers-faq__q').setAttribute('aria-expanded','false');
      });
      if(!wasOpen){
        item.classList.add('ers-faq__item--open');
        this.setAttribute('aria-expanded','true');
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
