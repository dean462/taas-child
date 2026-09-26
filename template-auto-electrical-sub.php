<?php
/**
 * Template Name: Auto Electrical Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Serves all 16 auto electrical sub-service pages.
 * Content pulled from post_meta (set via runner).
 * Cross-links auto-generated from master services array.
 * CSS namespace: .aes-
 *
 * Rebuilt June 2026 — full design system compliance
 * Section order: Hero → Trust → What is it → Causes → Process → Pricing → Enquiry → Related → Reviews → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$post_id       = get_the_ID();
$page_slug     = get_post_field('post_name', $post_id);
$phone_free    = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$phone_local   = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$email         = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address       = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours         = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established   = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating        = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews       = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$customers     = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$scan_price    = defined('TAAS_SCAN_PRICE')    ? TAAS_SCAN_PRICE    : 'from $75';
$autoelec_diag = defined('TAAS_AUTOELEC_DIAG') ? TAAS_AUTOELEC_DIAG : 'from $175';
$alt_test      = defined('TAAS_ALT_TEST')      ? TAAS_ALT_TEST      : 'from $85';
$starter_test  = defined('TAAS_STARTER_TEST')  ? TAAS_STARTER_TEST  : 'from $85';
$battery_price = defined('TAAS_BATTERY_PRICE') ? TAAS_BATTERY_PRICE : 'from $180 fitted';
$wiring_diag   = defined('TAAS_WIRING_DIAG')   ? TAAS_WIRING_DIAG   : 'from $85 per hour';
$tpms_price    = defined('TAAS_TPMS_PRICE')    ? TAAS_TPMS_PRICE    : 'from $45';
$lighting_diag = defined('TAAS_LIGHTING_DIAG') ? TAAS_LIGHTING_DIAG : 'from $85';
$window_diag   = defined('TAAS_WINDOW_DIAG')   ? TAAS_WINDOW_DIAG   : 'from $85';
$abs_diag      = defined('TAAS_ABS_DIAG')      ? TAAS_ABS_DIAG      : 'from $85';
$srs_diag      = defined('TAAS_SRS_DIAG')      ? TAAS_SRS_DIAG      : 'from $85';
$egr_diag      = defined('TAAS_EGR_DIAG')      ? TAAS_EGR_DIAG      : 'from $85';
$cl_diag       = defined('TAAS_CL_DIAG')       ? TAAS_CL_DIAG       : 'from $85';
$immob_diag    = defined('TAAS_IMMOB_DIAG')    ? TAAS_IMMOB_DIAG    : 'from $85';
$euro_brands   = defined('TAAS_EURO_BRANDS')   ? TAAS_EURO_BRANDS   : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general   = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget= defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET : '';
$phone_tel     = preg_replace('/[^0-9+]/', '', $phone_free);
$years         = date('Y') - intval($established);
$maps_url      = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
$review_count  = preg_replace('/\D+/', '', $reviews);

// ── Content replacement — swap hardcoded values for constants in post_meta ──
function aes_replace_constants($text) {
    global $phone_free, $phone_local, $euro_brands, $scan_price, $autoelec_diag,
           $alt_test, $starter_test, $battery_price, $hours, $established;
    $replacements = [
        'BMW, Mercedes-Benz, Audi, Volkswagen, Volvo, Peugeot, Renault'   => $euro_brands,
        'BMW, Mercedes-Benz, Audi, Volkswagen, Volvo, Peugeot and Renault' => $euro_brands,
        'Audi, Volkswagen, BMW, Mercedes-Benz, Land Rover, Porsche, MINI, Škoda' => $euro_brands,
        'call us on 09 278 9556' => 'call us on ' . $phone_free,
        'Call us on 09 278 9556' => 'Call us on ' . $phone_free,
        'call on 09 278 9556'    => 'call on ' . $phone_free,
        'Diagnostic from $85'       => 'Diagnostic scan ' . $scan_price,
        'Diagnostic check from $85' => 'Diagnostic scan ' . $scan_price,
        'scan from $85'             => 'scan ' . $scan_price,
        'Scan from $85'             => 'Diagnostic scan ' . $scan_price,
    ];
    return str_replace(array_keys($replacements), array_values($replacements), $text);
}

// ── Master services array ────────────────────────────────────────────────────
$ae_master = [
    'diagnostic-scanning' => ['name'=>'Diagnostic Scanning','badge'=>'DS','short'=>'ECU fault codes, live data, all modules. Factory-spec equipment.','hero_price'=>'Diagnostic scan '.$scan_price.' · Full diagnostic '.$autoelec_diag,'price'=>'Diagnostic scan '.$scan_price.' · Full diagnostic '.$autoelec_diag,'urgency'=>'medium'],
    'dashboard-warning-lights-manukau' => ['name'=>'Dashboard Warning Lights','badge'=>'DW','short'=>'Engine light, ABS, SRS, TPMS, oil — every warning light diagnosed.','hero_price'=>'Warning light scan '.$scan_price.' — diagnosis and repair additional','price'=>'Diagnostic scan '.$scan_price,'urgency'=>'medium'],
    'car-wont-start-manukau' => ['name'=>"Car Won't Start",'badge'=>'CS','short'=>"Dead flat, clicks, cranks but won't fire — cause diagnosed, not guessed.",'hero_price'=>'Diagnostic scan '.$scan_price.' — repair additional depending on cause','price'=>'Diagnostic scan '.$scan_price,'urgency'=>'high'],
    'auto-electrical-battery' => ['name'=>'Car Battery','badge'=>'CB','short'=>'Load testing, supply and fit. BMS registration for European vehicles.','hero_price'=>'Car batteries '.$battery_price.' — diagnostic scan '.$scan_price,'price'=>'Car batteries '.$battery_price.' · Diagnostic scan '.$scan_price,'urgency'=>'high'],
    'auto-electrical-alternator' => ['name'=>'Alternator Repair','badge'=>'AR','short'=>'Battery light on, flat battery, dimming lights. Output tested first.','hero_price'=>'Alternator testing '.$alt_test.' — replacement additional','price'=>'Alternator testing '.$alt_test.' · Diagnostic scan '.$scan_price,'urgency'=>'medium'],
    'auto-electrical-starter-motor' => ['name'=>'Starter Motor','badge'=>'SM','short'=>'Click but no crank. Solenoid vs motor fault identified before parts ordered.','hero_price'=>'Starter motor testing '.$starter_test.' — replacement additional','price'=>'Starter motor testing '.$starter_test.' · Diagnostic scan '.$scan_price,'urgency'=>'high'],
    'abs-fault-diagnosis-manukau' => ['name'=>'ABS Fault Diagnosis','badge'=>'ABS','short'=>'ABS warning light, wheel speed sensors, ABS module diagnosis.','hero_price'=>'ABS diagnostic '.$scan_price.' — sensor and module repair additional','price'=>'ABS diagnostic '.$abs_diag.' — parts additional','urgency'=>'medium'],
    'srs-airbag-repair-manukau' => ['name'=>'SRS & Airbag','badge'=>'SRS','short'=>'SRS warning light, clock spring, pretensioner, sensor faults.','hero_price'=>'SRS diagnostic '.$scan_price.' — repair additional','price'=>'SRS diagnostic '.$srs_diag.' — parts additional','urgency'=>'high'],
    'traction-stability-control-manukau' => ['name'=>'Traction & Stability','badge'=>'TCS','short'=>'ESC, TCS, VSC warning lights. Often shares sensors with ABS.','hero_price'=>'Diagnostic scan '.$scan_price.' — sensor and module repair additional','price'=>'Diagnostic scan '.$scan_price,'urgency'=>'medium'],
    'egr-repair-manukau' => ['name'=>'EGR & Emission Faults','badge'=>'EGR','short'=>'Engine light, rough idle, excess smoke. EGR cleaning or replacement.','hero_price'=>'EGR diagnostic '.$scan_price.' — cleaning or replacement additional','price'=>'EGR diagnostic '.$egr_diag.' — call for pricing','urgency'=>'medium'],
    'auto-electrical-central-locking' => ['name'=>'Central Locking','badge'=>'CL','short'=>'Actuator failure, wiring fault, key fob programming.','hero_price'=>'Central locking diagnostic '.$scan_price.' — actuator and parts additional','price'=>'Central locking diagnostic '.$cl_diag.' — parts additional','urgency'=>'low'],
    'electric-window-repair-manukau' => ['name'=>'Electric Windows','badge'=>'EW','short'=>'Motor, regulator, or switch fault. Diagnosed before parts ordered.','hero_price'=>'Window fault diagnosis '.$scan_price.' — motor, regulator and parts additional','price'=>'Window fault diagnosis '.$window_diag.' — parts additional','urgency'=>'low'],
    'auto-electrical-immobiliser' => ['name'=>'Immobiliser & Keys','badge'=>'IK','short'=>'Immobiliser triggered, key programming, transponder faults.','hero_price'=>'Immobiliser diagnostic '.$scan_price.' — programming additional','price'=>'Immobiliser diagnostic '.$immob_diag.' — call for pricing','urgency'=>'high'],
    'auto-electrical-lighting' => ['name'=>'Lighting & Headlights','badge'=>'LH','short'=>'Headlight adjustment, HID/xenon, LED issues, wiring faults.','hero_price'=>'Lighting diagnosis '.$scan_price.' — parts and fitting additional','price'=>'Lighting diagnosis '.$lighting_diag.' — parts additional','urgency'=>'low'],
    'wiring-fault-repair-manukau' => ['name'=>'Wiring Fault Repair','badge'=>'WF','short'=>'Intermittent faults, chafed wiring, rodent damage, aftermarket issues.','hero_price'=>'Wiring diagnostic '.$wiring_diag.' — depends on fault extent','price'=>'Wiring diagnostic '.$wiring_diag.' — depends on fault extent','urgency'=>'medium'],
    'tpms-reset-manukau' => ['name'=>'TPMS Reset','badge'=>'TPMS','short'=>'Tyre pressure monitoring light. Reset and sensor replacement.','hero_price'=>'TPMS reset '.$tpms_price.' — sensor replacement additional','price'=>'TPMS reset '.$tpms_price.' · Sensor replacement — call for pricing','urgency'=>'low'],
];

// ── Current page data ────────────────────────────────────────────────────────
$current = isset($ae_master[$page_slug]) ? $ae_master[$page_slug] : null;
if (!$current) { $current = ['name'=>get_the_title(),'badge'=>'AE','short'=>'','urgency'=>'medium']; }

$service_name   = $current['name'];
$badge          = $current['badge'];
$default_price  = isset($current['price']) ? $current['price'] : '';
$hero_price     = isset($current['hero_price']) ? $current['hero_price'] : $default_price;
$urgency_level  = isset($current['urgency']) ? $current['urgency'] : 'medium';

// Post meta fields (set via runner) — run through constant replacement
$what_it_is     = aes_replace_constants(get_post_meta($post_id, 'what_it_is', true) ?: '');
$causes_raw     = aes_replace_constants(get_post_meta($post_id, 'causes', true) ?: '');
$symptoms_raw   = aes_replace_constants(get_post_meta($post_id, 'symptoms', true) ?: '');
$process_raw    = aes_replace_constants(get_post_meta($post_id, 'our_process', true) ?: '');
$urgency_msg    = aes_replace_constants(get_post_meta($post_id, 'urgency_message', true) ?: '');
$price_signal   = aes_replace_constants(get_post_meta($post_id, 'price_signal', true) ?: '') ?: $default_price;
$vehicles_note  = aes_replace_constants(get_post_meta($post_id, 'vehicles_note', true) ?: '');

// Override urgency from post_meta if set
$urgency_meta = get_post_meta($post_id, 'urgency_level', true);
if ($urgency_meta) $urgency_level = $urgency_meta;

$causes   = $causes_raw   ? array_filter(array_map('trim', explode('|', $causes_raw)))   : [];
$symptoms = $symptoms_raw  ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw   ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

// Custom FAQs (up to 3)
$custom_faqs = [];
for ($i = 1; $i <= 3; $i++) {
    $q = get_post_meta($post_id, "custom_faq_q{$i}", true);
    $a = get_post_meta($post_id, "custom_faq_a{$i}", true);
    if ($q && $a) $custom_faqs[] = ['q' => aes_replace_constants($q), 'a' => aes_replace_constants($a)];
}

// ── Build FAQs ───────────────────────────────────────────────────────────────
$faqs = [];
$faqs[] = ['q'=>"What is {$service_name}?",'a'=>$what_it_is ?: "Contact Tony Allen Auto Service on {$phone_free} for information about {$service_name}."];
if ($causes_raw) {
    $faqs[] = ['q'=>"What causes {$service_name} problems?",'a'=>implode('. ', $causes) . '.'];
}
if ($symptoms_raw) {
    $faqs[] = ['q'=>"How do I know if I need {$service_name}?",'a'=>'Common signs include: ' . strtolower(implode('; ', $symptoms)) . '.'];
}
// Pricing FAQ — always show both tiers, no doubling
$price_text = $price_signal ?: '';
$has_scan = (strpos($price_text, $scan_price) !== false);
$has_full = (strpos($price_text, $autoelec_diag) !== false);
if (!$price_text || $price_text === "Diagnostic scan {$scan_price}") {
    $price_text = "Diagnostic scan {$scan_price} · full diagnostic {$autoelec_diag}";
} elseif ($has_scan && !$has_full) {
    $price_text .= " · full diagnostic {$autoelec_diag}";
} elseif (!$has_scan && !$has_full) {
    $price_text .= ". Diagnostic scan {$scan_price} · full diagnostic {$autoelec_diag}";
}
$faqs[] = ['q'=>"How much does {$service_name} cost in Manukau?",'a'=>$price_text . '. All fees explained upfront — if you proceed, the diagnostic fee applies to the final invoice.'];
$faqs[] = ['q'=>"Do you diagnose before replacing parts?",'a'=>"Yes — always. Raj verifies the fault before recommending any parts. Scan tool codes tell you where to look, not what to replace. We test, confirm, then recommend."];
$faqs[] = ['q'=>"Can you do this on European vehicles?",'a'=>"Yes. We carry factory-spec diagnostic equipment for {$euro_brands} through our TAAS European division."];
$faqs[] = ['q'=>"Is it safe to drive with this fault?",'a'=>$urgency_msg ?: "It depends on the severity. Call us on {$phone_free} and describe the symptoms — we can advise whether it is safe to drive in or needs towing."];
foreach ($custom_faqs as $cf) { $faqs[] = $cf; }
$faqs[] = ['q'=>"How long does {$service_name} take?",'a'=>"Timeframe depends on the fault complexity and whether parts are required. A diagnostic scan takes 30 to 60 minutes. Repairs involving parts can range from same-day to 2 to 3 days if specialist parts need ordering. We give you a timeframe when you book in."];
$faqs[] = ['q'=>"Where is your auto electrical workshop?",'a'=>"Tony Allen Auto Service, 139 Cavendish Drive, Manukau, Auckland 2104. Open {$hours}. Call {$phone_free} to book."];

// Ensure minimum 10 FAQs
if (count($faqs) < 10) {
    $faqs[] = ['q'=>"Do you offer fleet auto electrical services?",'a'=>"Yes. Fleet electrical work is a core part of what we do. Direct invoicing to fleet management companies available. See our fleet servicing page or call {$phone_free}."];
}

// ── Badge helper ─────────────────────────────────────────────────────────────
function aes_badge($initials, $size = 40) {
    $len = strlen($initials);
    $fs = $len > 3 ? intval($size * 0.225) : ($len > 2 ? intval($size * 0.275) : intval($size * 0.35));
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Urgency colours ──────────────────────────────────────────────────────────
$urgency_colors = [
    'high'   => ['bg'=>'#C0392B','border'=>'#A93226','text'=>'#fff','label'=>'Urgent — Book Now'],
    'medium' => ['bg'=>'#fffbea','border'=>'#FFC800','text'=>'#1A1A1A','label'=>'Book Soon'],
    'low'    => ['bg'=>'var(--taas-panel, #F7F7F5)','border'=>'var(--taas-border, #E8E8E4)','text'=>'#333','label'=>'When Convenient'],
];
$uc = isset($urgency_colors[$urgency_level]) ? $urgency_colors[$urgency_level] : $urgency_colors['medium'];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $i => $faq) {
    $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['a']]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type'=>'BreadcrumbList','itemListElement'=>[
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
            ['@type'=>'ListItem','position'=>2,'name'=>'Auto Electrical','item'=>$site_url.'/auto-electrical/'],
            ['@type'=>'ListItem','position'=>3,'name'=>$service_name,'item'=>$page_url],
        ]],
        ['@type'=>['AutoRepair','LocalBusiness'],
         '@id'=>$site_url.'/#organization',
         'name'=>'Tony Allen Auto Service',
         'url'=>$site_url,
         'telephone'=>[$phone_free,$phone_local],
         'email'=>$email,
         'foundingDate'=>'1985-10',
         'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
         'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
         'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],
         'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>$review_count,'bestRating'=>'5'],
         'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
         'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],
         'paymentAccepted'=>['Cash','EFTPOS','Visa','Mastercard','Afterpay','Zip','Q Card','Gem Finance'],
        ],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'SpeakableSpecification','cssSelector'=>['.aes-hero__sub','.aes-faq__a:first-of-type p']],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-auto-electrical-sub .site-content,
.page-template-template-auto-electrical-sub .entry-content,
.page-template-template-auto-electrical-sub .entry-header,
.page-template-template-auto-electrical-sub article,
.page-template-template-auto-electrical-sub #primary,
.page-template-template-auto-electrical-sub #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-auto-electrical-sub { overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%; }

/* ── Typography — all headings explicit ────────────────────────────────────── */
.aes-hero h1, .aes-sec__h2, .aes-cause__title, .aes-step__title, .aes-faq__q { font-family: var(--taas-font, 'Inter', Arial, sans-serif); }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.aes-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; text-align: center; }
.aes-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.aes-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.aes-hero h1 { font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.aes-hero h1 span { color: var(--taas-yellow, #FFC800); }
.aes-hero__sub { font-size: 16px; color: #aaa; max-width: 600px; margin: 0 auto 12px; line-height: 1.75; }
.aes-hero__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 600; color: var(--taas-yellow, #FFC800); margin-bottom: 24px; }
.aes-hero__urgency { display: inline-block; padding: 6px 16px; border-radius: var(--taas-radius, 6px); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 24px; }
.aes-hero__ctas { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

/* ── Trust strip ───────────────────────────────────────────────────────────── */
.aes-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.aes-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.aes-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.aes-trust__item::before { content: '✓'; font-weight: 900; }

/* ── Sections ──────────────────────────────────────────────────────────────── */
.aes-sec { padding: var(--taas-sec-pad, 72px) 0; }
.aes-sec--white { background: var(--taas-white, #FFFFFF); }
.aes-sec--grey  { background: var(--taas-panel, #F7F7F5); }
.aes-sec--dark  { background: var(--taas-dark, #1A1A1A); }
.aes-sec__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.aes-sec__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.aes-sec--dark .aes-sec__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.aes-sec__h2 { font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.aes-sec--dark .aes-sec__h2 { color: var(--taas-white, #FFFFFF); }
.aes-sec__body { font-size: 16px; color: var(--taas-body, #333333); line-height: 1.75; max-width: 780px; margin: 0 0 24px; }

/* ── Causes grid ───────────────────────────────────────────────────────────── */
.aes-causes { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-top: 24px; }
.aes-cause { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px; border-left: 4px solid var(--taas-yellow, #FFC800); }
.aes-cause__title { font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 4px; }

/* ── Process steps ─────────────────────────────────────────────────────────── */
.aes-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 24px; counter-reset: step; }
.aes-step { background: var(--taas-panel, #F7F7F5); border-radius: var(--taas-radius, 6px); padding: 24px 20px; counter-increment: step; }
.aes-step::before { content: counter(step); display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 28px; font-weight: 800; color: var(--taas-yellow, #FFC800); margin-bottom: 8px; }
.aes-step__title { font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); margin-bottom: 4px; }
.aes-step__desc { font-size: 14px; color: var(--taas-mid, #666666); line-height: 1.75; }

/* ── Pricing callout ───────────────────────────────────────────────────────── */
.aes-price-box { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; margin-top: 24px; }
.aes-price-box__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.aes-price-box__body { font-size: 15px; color: var(--taas-body, #333333); line-height: 1.75; }

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.aes-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.aes-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.aes-enquiry__phone:hover{opacity:.65;}
.aes-enquiry__detail { font-size: 15px; color: #aaa; line-height: 1.75; }
.aes-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

/* ── CF7 dark ──────────────────────────────────────────────────────────────── */
.aes-sec--dark .wpcf7 label, .aes-sec--dark .wpcf7 span:not(.wpcf7-spinner), .aes-sec--dark .wpcf7 div:not(.wpcf7-response-output), .aes-sec--dark .wpcf7 p { color: #ccc !important; font-size: 14px; }
.aes-sec--dark .wpcf7 input[type="text"], .aes-sec--dark .wpcf7 input[type="email"], .aes-sec--dark .wpcf7 input[type="tel"], .aes-sec--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.aes-sec--dark .wpcf7 input::placeholder, .aes-sec--dark .wpcf7 textarea::placeholder { color: #666; }
.aes-sec--dark .wpcf7 input:focus, .aes-sec--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.aes-sec--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: var(--taas-btn-size, 14px); letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.aes-sec--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

/* ── Cross-links ───────────────────────────────────────────────────────────── */
.aes-xlinks { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 24px; }
.aes-xlink { display: flex; align-items: center; gap: 10px; padding: 14px 16px; background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); text-decoration: none; transition: border-color 0.15s, box-shadow 0.15s; }
.aes-xlink:hover { border-color: var(--taas-yellow, #FFC800); box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
.aes-xlink__name { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; font-weight: 600; color: var(--taas-black, #111111); }

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.aes-faq { max-width: 780px; margin: 28px auto 0; }
.aes-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.aes-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.aes-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); }
.aes-faq__item--open .aes-faq__q::after { content: '−'; }
.aes-faq__a { display: none; padding: 0 0 18px; }
.aes-faq__a p { font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.75; margin: 0; }
.aes-faq__item--open .aes-faq__a { display: block; }

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media (max-width: 960px) {
  .aes-causes { grid-template-columns: 1fr; }
  .aes-enquiry { grid-template-columns: 1fr; gap: 32px; }
  .aes-xlinks { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {.aes-enquiry{display:flex;flex-direction:column-reverse;}
  .aes-hero { padding: 48px 0 40px; }
  .aes-hero h1 { font-size: clamp(26px, 6vw, 38px); }
  .aes-hero__sub { font-size: 14px; }
  .aes-hero__ctas { flex-direction: column; align-items: stretch; }
  .aes-hero__ctas .taas-btn { text-align: center; }
  .aes-sec { padding: 48px 0; }
  .aes-sec__h2 { font-size: clamp(22px, 5vw, 30px); }
  .aes-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .aes-trust__item { font-size: 12px; }
  .aes-xlinks { grid-template-columns: 1fr; }
  .aes-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .aes-faq__a p { font-size: 13px; }
  .aes-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .aes-steps { grid-template-columns: 1fr; }
}
</style>

<!-- 1. HERO -->
<section class="aes-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
  <div class="aes-hero__inner">
    <span class="aes-hero__eyebrow">Auto Electrical — Manukau</span>
    <h1><?php echo esc_html($service_name); ?><br><span>Manukau — South Auckland</span></h1>
    <p class="aes-hero__sub"><?php echo esc_html($current['short']); ?> Led by Raj — Lead Diagnostics & Auto Electrical Technician. Fault confirmed before any parts are replaced.</p>
    <?php if ($hero_price) : ?>
      <div class="aes-hero__price"><?php echo esc_html($hero_price); ?></div>
    <?php endif; ?>
    <div class="aes-hero__urgency" style="background:<?php echo $uc['bg']; ?>;color:<?php echo $uc['text']; ?>;border:1px solid <?php echo $uc['border']; ?>;"><?php echo esc_html($uc['label']); ?></div>
    <div class="aes-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Book a Diagnostic</a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html($phone_free); ?></a>
    </div>
  </div>
</section>

<!-- 2. TRUST STRIP -->
<div class="aes-trust">
  <div class="aes-trust__inner">
    <div class="aes-trust__item">MTA Assured</div>
    <div class="aes-trust__item">NZTA Authorised</div>
    <div class="aes-trust__item">Fault Confirmed First</div>
    <div class="aes-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="aes-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div>

<!-- 3. WHAT IS IT -->
<?php if ($what_it_is) : ?>
<section class="aes-sec aes-sec--white">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">What Is It</span>
    <h2 class="aes-sec__h2"><?php echo esc_html($service_name); ?> — Explained</h2>
    <div class="aes-sec__body"><?php echo wp_kses_post($what_it_is); ?></div>
    <?php if ($vehicles_note) : ?>
      <p style="font-size:14px;color:var(--taas-mid, #666666);line-height:1.75;font-style:italic;"><?php echo wp_kses_post($vehicles_note); ?></p>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<!-- 4. CAUSES -->
<?php if ($causes) : ?>
<section class="aes-sec aes-sec--grey">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">Causes</span>
    <h2 class="aes-sec__h2">What Causes <?php echo esc_html($service_name); ?> Problems</h2>
    <div class="aes-causes">
      <?php foreach ($causes as $c) : ?>
      <div class="aes-cause"><div class="aes-cause__title"><?php echo wp_kses_post($c); ?></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 5. PROCESS -->
<?php if ($process) : ?>
<section class="aes-sec aes-sec--white">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">Our Process</span>
    <h2 class="aes-sec__h2">How We Diagnose & Repair <?php echo esc_html($service_name); ?></h2>
    <div class="aes-steps">
      <?php foreach ($process as $step) :
        $parts = explode(':', $step, 2);
        $title = trim($parts[0]);
        $desc  = isset($parts[1]) ? trim($parts[1]) : '';
      ?>
      <div class="aes-step">
        <div class="aes-step__title"><?php echo esc_html($title); ?></div>
        <?php if ($desc) : ?><div class="aes-step__desc"><?php echo esc_html($desc); ?></div><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- 6. PRICING -->
<section class="aes-sec aes-sec--grey">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">Pricing</span>
    <h2 class="aes-sec__h2"><?php echo esc_html($service_name); ?> — Pricing Guide</h2>
    <div class="aes-price-box">
      <div class="aes-price-box__title"><?php echo esc_html($service_name); ?></div>
      <p class="aes-price-box__body"><?php echo wp_kses_post($price_signal); ?>. All fees explained upfront before any work begins. If you proceed with the repair, the diagnostic fee is applied to the final invoice. Call <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="color:var(--taas-yellow2, #e6b400);font-weight:600;text-decoration:none;"><?php echo esc_html($phone_free); ?></a> for an estimate specific to your vehicle.</p>
    </div>
  </div>
</section>

<!-- 7. ENQUIRY — immediately after pricing -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Zip</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="aes-sec aes-sec--dark" id="enquire">
  <div class="aes-sec__inner">
    <div class="aes-enquiry">
      <div>
        <span class="aes-sec__eyebrow">Enquire Now</span>
        <h2 class="aes-sec__h2">Book <?php echo esc_html($service_name); ?></h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;margin-bottom:8px;">Tell us your vehicle make, model and what symptoms you have. We'll come back to you with an estimate.</p>
        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="aes-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="aes-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br><?php echo esc_html($hours); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<!-- 8. RELATED SERVICES -->
<section class="aes-sec aes-sec--grey">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">Other Auto Electrical Services</span>
    <h2 class="aes-sec__h2">Related Services</h2>
    <div class="aes-xlinks">
      <?php
      foreach ($ae_master as $slug => $svc) {
          if ($slug === $page_slug) continue;
          echo '<a href="' . esc_url($site_url . '/' . $slug . '/') . '" class="aes-xlink">';
          echo '<div>' . aes_badge($svc['badge'], 32) . '</div>';
          echo '<div class="aes-xlink__name">' . esc_html($svc['name']) . '</div>';
          echo '</a>';
      }
      ?>
    </div>
  </div>
</section>

<!-- 9. REVIEWS -->
<section class="aes-sec aes-sec--white">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="aes-sec__h2">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<!-- 10. FAQ -->
<section class="aes-sec aes-sec--grey">
  <div class="aes-sec__inner">
    <span class="aes-sec__eyebrow">FAQ</span>
    <h2 class="aes-sec__h2"><?php echo esc_html($service_name); ?> — Common Questions</h2>
    <div class="aes-faq">
      <?php foreach ($faqs as $i => $faq) : ?>
      <div class="aes-faq__item<?php echo $i===0?' aes-faq__item--open':''; ?>">
        <button class="aes-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="aes-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.aes-faq__q').forEach(function(btn){
  btn.addEventListener('click',function(){
    var item = this.closest('.aes-faq__item');
    var wasOpen = item.classList.contains('aes-faq__item--open');
    document.querySelectorAll('.aes-faq__item--open').forEach(function(i){ i.classList.remove('aes-faq__item--open'); });
    if(!wasOpen) item.classList.add('aes-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
