<?php
/**
 * Template Name: Sub-Service Page
 * Template Post Type: page
 *
 * PURPOSE: Individual service/fault pages — battery, alternator, ABS, headlights,
 *          central locking, DPF etc. One template, deployed across all sub-services.
 *          Content is specific to the fault/service — not a suburb. No location
 *          variables. Answers WHAT, WHY, HOW, HOW MUCH — the four things Google AIO
 *          and generative engines extract. Every H2 answers a real search question.
 *
 * ACF FIELDS (set per page in WP Admin):
 *   service_name        string   "Car Battery Replacement"
 *   service_category    string   "Auto Electrical"
 *   service_hub_url     string   "/services/auto-electrical/"
 *   service_hub_label   string   "Auto Electrical"
 *   urgency_level       select   high | medium | low
 *   urgency_message     string   "Safe to drive short distances — book within 48hrs"
 *   price_signal        string   "Batteries from $120 fitted · Diagnostic from $85"
 *   specialist_name     string   "Raj"
 *   specialist_role     string   "Lead Diagnostics & Auto Electrical Technician"
 *   what_it_is          text     Plain-English explanation of the service/fault
 *   causes              text     What causes this fault (pipe-separated list OR prose)
 *   symptoms            text     Warning signs the customer notices (pipe-separated)
 *   our_process         text     How TAAS approaches this job (pipe-separated steps)
 *   vehicles_note       text     Any make/model specific notes (optional)
 *   related_1_label     string   "Alternator Repair"
 *   related_1_url       string   "/auto-electrical-alternator/"
 *   related_2_label     string   "Car Won't Start"
 *   related_2_url       string   "/car-wont-start-manukau/"
 *   related_3_label     string   "Diagnostic Scanning"
 *   related_3_url       string   "/services/diagnostic-scanning/"
 *   custom_faq_q1/a1    string   Optional extra FAQ
 *   custom_faq_q2/a2    string   Optional extra FAQ
 *
 * DEPLOY: One page per sub-service in WP Admin. Assign this template.
 *         Fill ACF fields. Publish. Submit URL in Search Console.
 *
 * LIVE CONTENT EXAMPLE: Car Battery Replacement (highest non-brand KW — 4,618 impressions)
 *   All fallback values below reflect this page. Swap ACF fields for every other service.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

// ── ACF fields ────────────────────────────────────────────────────────────────
$has_acf = function_exists('get_field');

$service_name      = ($has_acf ? get_field('service_name')      : null) ?: 'Car Battery Replacement';
$service_category  = ($has_acf ? get_field('service_category')  : null) ?: 'Auto Electrical';
$service_hub_url   = ($has_acf ? get_field('service_hub_url')   : null) ?: '/services/auto-electrical/';
$service_hub_label = ($has_acf ? get_field('service_hub_label') : null) ?: 'Auto Electrical';
$urgency_level     = ($has_acf ? get_field('urgency_level')     : null) ?: 'medium'; // high | medium | low
$urgency_message   = ($has_acf ? get_field('urgency_message')   : null) ?: 'Safe to drive short distances — but book within 48 hours. A failing battery can leave you stranded without warning.';
$price_signal      = ($has_acf ? get_field('price_signal')      : null) ?: 'Car batteries from $120 fitted · Diagnostic check from $85';
$specialist_name   = ($has_acf ? get_field('specialist_name')   : null) ?: 'Raj';
$specialist_role   = ($has_acf ? get_field('specialist_role')   : null) ?: 'Lead Diagnostics & Auto Electrical Technician';
$hide_specialist   = ($has_acf ? get_field('hide_specialist_intro') : null) ?: false;

$what_it_is = ($has_acf ? get_field('what_it_is') : null) ?:
    'Your car battery provides the electrical charge needed to start the engine and powers all electrical systems when the alternator is not running. Most car batteries last 3–5 years in New Zealand conditions — heat, short trips, and age all accelerate wear. When a battery begins to fail, it may still start the car on a good morning but leave you stranded when conditions are less favourable — cold weather, lights left on, or a battery that is simply too weak to crank a cold engine.';

// Pipe-separated lists — split into arrays for rendering
$causes_raw = ($has_acf ? get_field('causes') : null) ?:
    'Battery age — most batteries last 3–5 years|Excessive heat or cold cycling|Short trips that prevent full recharge|Parasitic drain — something drawing power when the car is off|Faulty alternator not recharging the battery|Lights or accessories left on|Original battery at end of factory life';

$symptoms_raw = ($has_acf ? get_field('symptoms') : null) ?:
    'Engine slow to crank — takes longer than usual to start|Battery warning light on the dashboard|Lights dimmer than normal|Electrical accessories behaving oddly — radio resetting, windows slow|Car clicks but won\'t start|Completely dead — no lights, no response at all|Battery swollen or leaking (visible when checking under the bonnet)';

$process_raw = ($has_acf ? get_field('our_process') : null) ?:
    'Test the existing battery — we load-test the battery to check its actual capacity, not just resting voltage|Test the charging system — a bad alternator kills new batteries, so we check alternator output before recommending replacement|Check for parasitic drain — if your battery keeps going flat, we identify what is drawing power overnight|Supply and fit the right battery — we carry batteries suited to the South Auckland climate and vehicle range. We match the correct capacity (CCA and Ah) for your specific vehicle|Dispose of the old battery responsibly — all old batteries are recycled through approved channels|Road test and confirm — we confirm charging voltage after fitting to make sure the alternator is keeping the new battery charged correctly';

$vehicles_note = ($has_acf ? get_field('vehicles_note') : null) ?:
    'Some vehicles — particularly European makes such as BMW, Mercedes-Benz, Volkswagen and Audi — require battery registration after replacement. This programmes the new battery into the vehicle\'s power management system. Skipping this step on these vehicles can cause flat batteries and electrical gremlins within weeks. Raj carries out battery registration as part of the job on affected vehicles — always ask your workshop if your car requires this.';

$related_1_label = ($has_acf ? get_field('related_1_label') : null) ?: 'Alternator Repair & Replacement';
$related_1_url   = ($has_acf ? get_field('related_1_url')   : null) ?: '/auto-electrical-alternator/';
$related_2_label = ($has_acf ? get_field('related_2_label') : null) ?: 'Car Won\'t Start — Help';
$related_2_url   = ($has_acf ? get_field('related_2_url')   : null) ?: '/car-wont-start-manukau/';
$related_3_label = ($has_acf ? get_field('related_3_label') : null) ?: 'Diagnostic Scanning';
$related_3_url   = ($has_acf ? get_field('related_3_url')   : null) ?: '/services/diagnostic-scanning/';

$faq_q1 = ($has_acf ? get_field('custom_faq_q1') : null) ?: '';
$faq_a1 = ($has_acf ? get_field('custom_faq_a1') : null) ?: '';
$faq_q2 = ($has_acf ? get_field('custom_faq_q2') : null) ?: '';
$faq_a2 = ($has_acf ? get_field('custom_faq_a2') : null) ?: '';

// ── Parse pipe-separated fields ───────────────────────────────────────────────
$causes   = array_filter(array_map('trim', explode('|', $causes_raw)));
$symptoms = array_filter(array_map('trim', explode('|', $symptoms_raw)));
$process  = array_filter(array_map('trim', explode('|', $process_raw)));

// ── Phone — hardcoded (mirrors WOF + AE templates) ────────────────────────────
$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free  = defined('TAAS_PHONE_FREE') ? TAAS_PHONE_FREE : '0800 100 876';

// ── Shared constants ──────────────────────────────────────────────────────────
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Mon–Fri 7:30am–5:00pm';
$cf7_wof        = defined('TAAS_CF7_WOF')        ? TAAS_CF7_WOF        : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$reviews_count = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$rating  = defined('TAAS_RATING')  ? TAAS_RATING  : '4.2';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';

// ── Derived ───────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

// ── Urgency colours ───────────────────────────────────────────────────────────
$urgency_config = [
    'high'   => ['bg' => '#3a0000', 'border' => '#cc0000', 'badge_bg' => '#cc0000', 'badge_text' => '#fff',    'icon' => '🔴', 'label' => 'Book Today'],
    'medium' => ['bg' => '#2a1800', 'border' => '#f5c518', 'badge_bg' => '#f5c518', 'badge_text' => '#111',   'icon' => '🟡', 'label' => 'Book Soon'],
    'low'    => ['bg' => '#001a0d', 'border' => '#2e7d32', 'badge_bg' => '#2e7d32', 'badge_text' => '#fff',    'icon' => '🟢', 'label' => 'When Convenient'],
];
$urg = $urgency_config[$urgency_level] ?? $urgency_config['medium'];

// ── FAQs — driven entirely by ACF custom fields ──────────────────────────────
// No hardcoded fallbacks. Each sub-service page sets its own FAQs via ACF.
// Supports custom_faq_q1/a1 through q4/a4.
$faqs = [];
if ($faq_q1 && $faq_a1) $faqs[] = ['q' => $faq_q1, 'a' => $faq_a1];
if ($faq_q2 && $faq_a2) $faqs[] = ['q' => $faq_q2, 'a' => $faq_a2];

// Additional FAQ fields
$faq_q3 = ($has_acf ? get_field('custom_faq_q3') : null) ?: '';
$faq_a3 = ($has_acf ? get_field('custom_faq_a3') : null) ?: '';
$faq_q4 = ($has_acf ? get_field('custom_faq_q4') : null) ?: '';
$faq_a4 = ($has_acf ? get_field('custom_faq_a4') : null) ?: '';
$faq_q5 = ($has_acf ? get_field('custom_faq_q5') : null) ?: '';
$faq_a5 = ($has_acf ? get_field('custom_faq_a5') : null) ?: '';
$faq_q6 = ($has_acf ? get_field('custom_faq_q6') : null) ?: '';
$faq_a6 = ($has_acf ? get_field('custom_faq_a6') : null) ?: '';
if ($faq_q3 && $faq_a3) $faqs[] = ['q' => $faq_q3, 'a' => $faq_a3];
if ($faq_q4 && $faq_a4) $faqs[] = ['q' => $faq_q4, 'a' => $faq_a4];
if ($faq_q5 && $faq_a5) $faqs[] = ['q' => $faq_q5, 'a' => $faq_a5];
if ($faq_q6 && $faq_a6) $faqs[] = ['q' => $faq_q6, 'a' => $faq_a6];

// Generic fallback only if no custom FAQs at all
if (empty($faqs)) {
    $faqs[] = [
        'q' => 'How do I book ' . strtolower($service_name) . ' at Tony Allen Auto Service?',
        'a'  => 'Call us on ' . $phone_free . ' or use the Book Online button. We are open Monday to Friday, 7:30am to 5:00pm at 139 Cavendish Drive, Manukau.',
    ];
    $faqs[] = [
        'q' => 'How much does ' . strtolower($service_name) . ' cost in Manukau?',
        'a'  => 'We estimate after diagnosis — ' . $price_signal . '. Call us on ' . $phone_free . ' and describe what your vehicle is doing.',
    ];
    $faqs[] = [
        'q' => 'Do you work on all makes and models?',
        'a'  => 'Yes — all makes and models including Japanese, Korean, and European vehicles. Tony Allen Auto Service has been in Manukau since 1985.',
    ];
}

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap">
<!-- ═══════════════════════════════════════════════════════════════════
     Sub-Service Page — Tony Allen Auto Service
     Template: template-sub-service.php
     Live example: <?php echo esc_html($service_name); ?> Manukau
     ═══════════════════════════════════════════════════════════════════ -->

<style>
/* ── CSS custom properties — consistent across all TAAS templates ──── */
/* ── Body resets ──────────────────────────────────────────────────────── */
body{-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;overflow-x:hidden;}
:root {
    --taas-black:   #111111;
    --taas-dark:    #1a1a1a;
    --taas-darker:  #141414;
    --taas-yellow:  #f5c518;
    --taas-yellow2: #e6b800;
    --taas-white:   #ffffff;
    --taas-grey:    #cccccc;
    --taas-mid:     #444444;
    --taas-radius:  6px;
    --taas-shadow:  0 4px 24px rgba(0,0,0,.45);
    --container:    1140px;
}

/* ── Reset / base ──────────────────────────────────────────────────── */
.taas-ss * { box-sizing: border-box; margin: 0; padding: 0; }
.taas-ss {
    font-family: 'Inter', Arial, sans-serif;
    color: var(--taas-grey);
    background: var(--taas-dark);
    line-height: 1.6;
    font-size: 16px !important;
}
.taas-ss a { color: var(--taas-yellow); text-decoration: none; }
.taas-ss a:hover { text-decoration: underline; }
.taas-container { max-width: var(--container); margin: 0 auto; padding: 0 20px; }

/* ── Breadcrumb ────────────────────────────────────────────────────── */
.taas-breadcrumb {
    background: var(--taas-darker);
    border-bottom: 1px solid #222;
    padding: 12px 20px;
    font-size: 13px;
    color: #666;
}
.taas-breadcrumb a { color: #888; text-decoration: none; }
.taas-breadcrumb a:hover { color: var(--taas-yellow); }
.taas-breadcrumb__sep { margin: 0 8px; color: #444; }

/* ── Hero — sub-service specific: tighter, more focused ───────────── */
.taas-hero {
    background: linear-gradient(135deg, #0d0d0d 0%, #181818 55%, #1a1400 100%);
    border-bottom: 4px solid var(--taas-yellow);
    padding: 56px 20px 48px;
    position: relative;
    overflow: hidden;
}
.taas-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/images/workshop-bg.webp') center/cover no-repeat;
    opacity: .06;
    z-index: 0;
}
.taas-hero > .taas-container { position: relative; z-index: 1; }
.taas-hero__meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.taas-hero__category {
    display: inline-block;
    background: rgba(245,197,24,.15);
    border: 1px solid rgba(245,197,24,.3);
    color: var(--taas-yellow);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 3px;
    text-decoration: none !important;
}
.taas-hero__category:hover { background: rgba(245,197,24,.25); }
.taas-hero__location-badge {
    display: inline-block;
    background: #222;
    border: 1px solid #333;
    color: #aaa;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 3px;
}
.taas-hero h1 {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: clamp(38px, 5.5vw, 58px);
    font-weight: 900;
    color: var(--taas-white);
    line-height: 1.05;
    margin-bottom: 16px;
    letter-spacing: -.01em;
    text-transform: uppercase;
    max-width: 820px;
}
.taas-hero h1 span { color: var(--taas-yellow); }
.taas-hero__intro {
    font-size: 18px;
    color: #bbb;
    max-width: 680px;
    line-height: 1.7;
    margin-bottom: 28px;
}
.taas-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.taas-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 13px 26px;
    border-radius: var(--taas-radius);
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    border: none;
    transition: transform .15s, box-shadow .15s;
    text-decoration: none !important;
}
.taas-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.4); }
.taas-btn--primary { background: var(--taas-yellow); color: #111111 !important; }
.taas-btn--outline { background: transparent; color: var(--taas-yellow) !important; border: 2px solid var(--taas-yellow); }
.taas-btn--outline:hover { background: var(--taas-yellow) !important; color: #111 !important; }
.taas-btn--ghost   { background: #222; color: #ccc !important; border: 1px solid #333; font-size: 14px; padding: 10px 18px; }
.taas-hero__price-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #111;
    border: 1px solid #2a2a2a;
    border-left: 3px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    padding: 10px 16px;
    margin-top: 20px;
    font-size: 15px;
    color: #ccc;
}
.taas-hero__price-pill strong { color: var(--taas-yellow); }

/* ── Trust strip ───────────────────────────────────────────────────── */
.taas-trust { background: var(--taas-yellow); padding: 16px 20px; }
.taas-trust__inner {
    display: flex; flex-wrap: wrap; justify-content: center;
    gap: 18px 36px; max-width: var(--container); margin: 0 auto;
}
.taas-trust__item {
    display: flex; align-items: center; gap: 8px;
    color: var(--taas-black); font-weight: 700; font-size: 14px;
}

/* ── Urgency band ──────────────────────────────────────────────────── */
.taas-urgency {
    border-left: 5px solid <?php echo esc_attr($urg['border']); ?>;
    background: <?php echo esc_attr($urg['bg']); ?>;
    border-radius: 0 var(--taas-radius) var(--taas-radius) 0;
    padding: 18px 22px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
}
.taas-urgency__badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: <?php echo esc_attr($urg['badge_bg']); ?>;
    color: <?php echo esc_attr($urg['badge_text']); ?>;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 3px;
    white-space: nowrap;
    flex-shrink: 0;
    margin-top: 2px;
}
.taas-urgency__text { color: #ccc; font-size: 16px; line-height: 1.6; }
.taas-urgency__text strong { color: var(--taas-white); }

/* ── Sections ──────────────────────────────────────────────────────── */
.taas-section { padding: 60px 20px; }
.taas-section--alt { background: var(--taas-darker); }
.taas-section--tight { padding: 40px 20px; }
.taas-section__title {
    font-size: clamp(24px, 3.2vw, 36px);
    font-weight: 800;
    color: var(--taas-white);
    margin-bottom: 10px;
    line-height: 1.2;
}
.taas-section__title span { color: var(--taas-yellow); }
.taas-section__sub { color: #bbb; margin-bottom: 32px; max-width: 680px; font-size: 17px; line-height: 1.7; }

/* ── Symptom / causes grid ─────────────────────────────────────────── */
.taas-fault-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 12px;
    list-style: none;
}
.taas-fault-grid li {
    background: var(--taas-black);
    border: 1px solid #252525;
    border-radius: var(--taas-radius);
    padding: 14px 18px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    color: #ccc;
    font-size: 15px;
    line-height: 1.5;
}
.taas-fault-grid li .taas-fault-icon {
    color: var(--taas-yellow);
    font-weight: 800;
    flex-shrink: 0;
    margin-top: 1px;
}

/* ── Process steps ─────────────────────────────────────────────────── */
.taas-process { display: flex; flex-direction: column; gap: 0; list-style: none; }
.taas-process__step {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    padding: 22px 0;
    border-bottom: 1px solid #1c1c1c;
}
.taas-process__step:last-child { border-bottom: none; }
.taas-process__num {
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-weight: 900;
    font-size: 15px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}
.taas-process__content { flex: 1; }
.taas-process__label {
    font-size: 17px;
    font-weight: 700;
    color: var(--taas-white);
    margin-bottom: 6px;
    line-height: 1.3;
}
.taas-process__desc {
    font-size: 15px;
    color: #999;
    line-height: 1.75;
}

/* ── Pricing card ──────────────────────────────────────────────────── */
.taas-pricing-card {
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-top: 4px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    padding: 28px;
}
.taas-pricing-card h3 { color: var(--taas-white); font-size: 20px; margin-bottom: 6px; }
.taas-pricing-card__signal {
    font-size: 26px;
    font-weight: 900;
    color: var(--taas-yellow);
    margin-bottom: 4px;
    line-height: 1.2;
}
.taas-pricing-card__note { font-size: 14px; color: #777; margin-bottom: 20px; line-height: 1.6; }
.taas-pricing-card__items { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.taas-pricing-card__items li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #1c1c1c;
    font-size: 15px;
    gap: 12px;
}
.taas-pricing-card__items li:last-child { border-bottom: none; }
.taas-pricing-card__items .item-label { color: #bbb; flex: 1; }
.taas-pricing-card__items .item-note { color: #666; font-size: 13px; }
.taas-pricing-disclaimer {
    margin-top: 16px;
    font-size: 13px;
    color: #555;
    line-height: 1.6;
    border-top: 1px solid #1c1c1c;
    padding-top: 14px;
}

/* ── Two-col layout ────────────────────────────────────────────────── */
.taas-two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; }
@media (max-width: 768px) { .taas-two-col { grid-template-columns: 1fr; } }

/* ── Related services ──────────────────────────────────────────────── */
.taas-related { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 14px; list-style: none; }
.taas-related__item {
    background: var(--taas-black);
    border: 1px solid #252525;
    border-radius: var(--taas-radius);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    text-decoration: none !important;
    transition: border-color .15s, background .15s;
}
.taas-related__item:hover {
    border-color: var(--taas-yellow);
    background: #161600;
}
.taas-related__label { color: var(--taas-white); font-weight: 600; font-size: 16px; }
.taas-related__arrow { color: var(--taas-yellow); font-size: 20px; flex-shrink: 0; }

/* ── Specialist card (sidebar) ─────────────────────────────────────── */
.taas-specialist-card {
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-top: 4px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    padding: 24px;
    position: sticky;
    top: 20px;
}
.taas-specialist-card__name { font-size: 20px; font-weight: 800; color: var(--taas-white); margin-bottom: 3px; }
.taas-specialist-card__role {
    font-size: 12px; font-weight: 700; color: var(--taas-yellow);
    text-transform: uppercase; letter-spacing: .1em; margin-bottom: 14px;
}
.taas-specialist-card p { color: #999; font-size: 15px; line-height: 1.7; margin-bottom: 16px; }
.taas-specialist-card__cta {
    display: flex; flex-direction: column; gap: 10px;
}

/* ── FAQ accordion ─────────────────────────────────────────────────── */
.taas-faq { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.taas-faq__item { background: var(--taas-black); border: 1px solid #252525; border-radius: var(--taas-radius); overflow: hidden; }
.taas-faq__q {
    width: 100%; background: none; border: none; color: var(--taas-white);
    text-align: left; padding: 18px 20px; font-size: 17px; font-weight: 600;
    cursor: pointer; display: flex; justify-content: space-between;
    align-items: center; gap: 12px; transition: color .15s;
}
.taas-faq__q:hover,
.taas-faq__q[aria-expanded="true"] { color: var(--taas-yellow); }
.taas-faq__icon {
    flex-shrink: 0; width: 22px; height: 22px;
    border: 2px solid currentColor; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-style: normal; transition: transform .25s;
}
.taas-faq__q[aria-expanded="true"] .taas-faq__icon { transform: rotate(45deg); }
.taas-faq__a { display: none; padding: 0 20px 20px; color: #bbb; line-height: 1.75; font-size: 16px; }
.taas-faq__a p { margin-top: 0; }

/* ── Contact card ──────────────────────────────────────────────────── */
.taas-contact-card { background: var(--taas-black); border: 1px solid #2a2a2a; border-top: 4px solid var(--taas-yellow); border-radius: var(--taas-radius); padding: 28px; }
.taas-contact-card h3 { color: var(--taas-white); margin-bottom: 18px; font-size: 18px; }
.taas-contact-card__row { display: flex; gap: 12px; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid #1c1c1c; font-size: 15px; }
.taas-contact-card__row:last-child { border-bottom: none; }
.taas-contact-card__label { color: #666; min-width: 80px; font-size: 13px; text-transform: uppercase; letter-spacing: .06em; padding-top: 2px; }
.taas-contact-card__val { color: var(--taas-grey); }
.taas-contact-card__val a { color: var(--taas-yellow); }

/* ── Footer CTA ────────────────────────────────────────────────────── */
.taas-footer-cta {
    background: linear-gradient(135deg, #111 0%, #1a1600 100%);
    border-top: 4px solid var(--taas-yellow);
    text-align: center; padding: 56px 20px;
}
.taas-footer-cta h2 { color: var(--taas-white); font-size: clamp(20px,2.8vw,30px); margin-bottom: 10px; }
.taas-footer-cta p { color: #aaa; margin-bottom: 26px; font-size: 17px; }

/* ── CF7 dark theme — same as all TAAS templates ───────────────────── */
.taas-ss .wpcf7-form { font-size: 15px; }
.taas-ss .wpcf7-form p { margin-bottom: 20px !important; }
.taas-ss .wpcf7-form .wpcf7-form-control-wrap { display: block !important; width: 100% !important; }
.taas-ss .wpcf7-form input[type="text"],
.taas-ss .wpcf7-form input[type="email"],
.taas-ss .wpcf7-form input[type="tel"],
.taas-ss .wpcf7-form textarea,
.taas-ss .wpcf7-form select {
    background: #1c1c1c !important; color: #fff !important;
    border: 1px solid #383838 !important; border-radius: 5px !important;
    padding: 14px 18px !important; font-size: 15px !important;
    width: 100% !important; box-sizing: border-box !important;
    height: auto !important; line-height: 1.5 !important; margin-top: 6px !important;
    transition: border-color .15s !important;
}
.taas-ss .wpcf7-form input:focus, .taas-ss .wpcf7-form textarea:focus {
    border-color: var(--taas-yellow) !important; outline: none !important;
    background: #212121 !important; box-shadow: 0 0 0 3px rgba(245,197,24,.12) !important;
}
.taas-ss .wpcf7-form input::placeholder, .taas-ss .wpcf7-form textarea::placeholder { color: #555 !important; }
.taas-ss .wpcf7-form label { color: #999 !important; font-size: 12px !important; font-weight: 700 !important; display: block !important; text-transform: uppercase !important; letter-spacing: .08em !important; }
.taas-ss .wpcf7-form .wpcf7-submit, .taas-ss .wpcf7-form input[type="submit"] {
    background: var(--taas-yellow) !important; color: #111 !important; border: none !important;
    padding: 15px 32px !important; font-size: 16px !important; font-weight: 700 !important;
    border-radius: 5px !important; cursor: pointer !important; width: 100% !important;
    margin-top: 4px !important; transition: opacity .15s !important; letter-spacing: .02em !important;
}
.taas-ss .wpcf7-form .wpcf7-response-output {
    border: 1px solid var(--taas-yellow) !important; color: #bbb !important;
    background: #1a1a1a !important; font-size: 14px !important;
    padding: 14px 18px !important; border-radius: 5px !important; margin-top: 16px !important;
}

/* ── Utility ───────────────────────────────────────────────────────── */
@media (max-width: 600px) {.taas-contact-card{margin-bottom:24px;}
    .taas-hero { padding: 40px 16px 36px; }
    .taas-section { padding: 44px 16px; }
    .taas-two-col { grid-template-columns: 1fr; }
}
</style>

<div class="taas-ss" id="taas-main">

<!-- ════════════════════════════════════════════════════════════════════
     BREADCRUMB — helps Google understand page hierarchy + GEO entity chain
     ════════════════════════════════════════════════════════════════════ -->
<nav class="taas-breadcrumb" aria-label="Breadcrumb">
    <div class="taas-container">
        <a href="/">Home</a>
        <span class="taas-breadcrumb__sep">›</span>
        <a href="<?php echo esc_url($service_hub_url); ?>"><?php echo esc_html($service_hub_label); ?></a>
        <span class="taas-breadcrumb__sep">›</span>
        <span><?php echo esc_html($service_name); ?></span>
    </div>
</nav>

<!-- ════════════════════════════════════════════════════════════════════
     HERO — specific service focus, not suburb browsing
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-hero" aria-label="Page hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>>
    <div class="taas-container">

        <div class="taas-hero__meta">
            <a href="<?php echo esc_url($service_hub_url); ?>" class="taas-hero__category">
                <?php echo esc_html($service_hub_label); ?>
            </a>
            <span class="taas-hero__location-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle;margin-right:4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Manukau, South Auckland
            </span>
        </div>

        <h1><?php echo esc_html($service_name); ?></h1>

        <p class="taas-hero__intro">
            Tony Allen Auto Service — South Auckland's trusted workshop since <?php echo esc_html($established); ?>. <?php echo esc_html($specialist_name); ?> and the team carry out <?php echo esc_html(strtolower($service_name)); ?> for all makes and models at 139 Cavendish Drive, Manukau. Estimate before we start. No surprises.
        </p>

        <div class="taas-hero__ctas">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--primary">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                Call <?php echo esc_html($phone_free); ?>
            </a>
            <a href="/contact-us/" class="taas-btn taas-btn--outline">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Book Online
            </a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>" class="taas-btn taas-btn--ghost">
                <?php echo esc_html($phone_local); ?>
            </a>
        </div>

        <div class="taas-hero__price-pill">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <strong><?php echo esc_html($price_signal); ?></strong>
        </div>

    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     TRUST STRIP
     ════════════════════════════════════════════════════════════════════ -->
<div class="taas-trust" role="region" aria-label="Trust indicators">
    <div class="taas-trust__inner">
        <div class="taas-trust__item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            All Makes &amp; Models
        </div>
        <div class="taas-trust__item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Estimate First
        </div>
        <div class="taas-trust__item">
            <img src="https://www.gstatic.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="Google" style="height:18px;width:18px;display:inline-block;vertical-align:middle;">
            <?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews_count); ?> Google Reviews
        </div>
        <div class="taas-trust__item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Trading Since <?php echo esc_html($established); ?> — <?php echo esc_html($years_trading); ?> Years
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '';
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';
        </div>
        <div class="taas-trust__item">
            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png" alt="MTA Assured" style="height:22px;width:auto;display:inline-block;vertical-align:middle;">
            MTA Assured
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════════════════
     URGENCY BAND — answers "is it safe to drive?" immediately
     Colour-coded by urgency_level ACF field
     ════════════════════════════════════════════════════════════════════ -->
<div class="taas-section taas-section--tight" style="background:var(--taas-darker);padding-top:32px;padding-bottom:32px;">
    <div class="taas-container">
        <div class="taas-urgency" role="alert">
            <span class="taas-urgency__badge">
                <?php echo $urg['icon']; ?> <?php echo esc_html($urg['label']); ?>
            </span>
            <p class="taas-urgency__text">
                <strong>Is it safe to drive?</strong> <?php echo esc_html($urgency_message); ?>
                &nbsp;<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" style="color:var(--taas-yellow);font-weight:700;">Call <?php echo esc_html($phone_free); ?></a> if unsure.
            </p>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════════════════
     WHAT IT IS — answers "what is X" for GEO + AIO extraction
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="what-heading">
    <div class="taas-container">
        <div class="taas-two-col" style="gap:52px;">
            <div>
                <h2 class="taas-section__title" id="what-heading">
                    What Is <span><?php echo esc_html($service_name); ?></span>?
                </h2>
                <p style="color:#bbb;font-size:17px;line-height:1.85;margin-bottom:22px;">
                    <?php echo wp_kses_post($what_it_is); ?>
                </p>
                <p style="color:#bbb;font-size:17px;line-height:1.85;">
                    <?php if ( ! $hide_specialist ): ?>
                    At Tony Allen Auto Service, <?php echo esc_html($service_name); ?> is handled by <?php echo esc_html($specialist_name); ?> — our <?php echo esc_html($specialist_role); ?>. Every job starts with a proper assessment, not an assumption. We tell you what we find before we start any work.
                    <?php endif; ?>
                </p>

                <?php if (!empty($vehicles_note)): ?>
                <div style="background:#1a1400;border-left:4px solid var(--taas-yellow);border-radius:0 var(--taas-radius) var(--taas-radius) 0;padding:16px 20px;margin-top:24px;font-size:15px;color:#bbb;line-height:1.75;">
                    <strong style="color:var(--taas-yellow);display:block;margin-bottom:6px;">Vehicle-Specific Note</strong>
                    <?php echo esc_html($vehicles_note); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Specialist sidebar card -->
            <div>
                <div class="taas-specialist-card">
                    <div class="taas-specialist-card__name"><?php echo esc_html($specialist_name); ?></div>
                    <div class="taas-specialist-card__role"><?php echo esc_html($specialist_role); ?></div>
                    <?php if ( $hide_specialist ): ?>
                    <p>Call us on <?php echo esc_html($phone_free); ?> and we will advise on next steps. We carry out a full diagnosis and contact you with an estimate before any work begins.</p>
                    <p>All makes and models. Estimate before we start — no surprise invoices.</p>
                    <?php else: ?>
                    <p>Handling your <?php echo esc_html(strtolower($service_name)); ?> at TAAS. <?php echo esc_html($specialist_name); ?> tests the full system — not just the obvious part — so the fault is fixed properly the first time.</p>
                    <p>All makes and models. We estimate after diagnosis. Call us to describe what your vehicle is doing and we'll give you an honest assessment.</p>
                    <?php endif; ?>
                    <div class="taas-specialist-card__cta">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--primary" style="justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                            Call <?php echo esc_html($phone_free); ?>
                        </a>
                        <a href="/contact-us/" class="taas-btn taas-btn--outline" style="justify-content:center;">Book Online</a>
                        <div style="text-align:center;font-size:13px;color:#555;padding-top:4px;">139 Cavendish Drive, Manukau · <?php echo esc_html($hours); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     CAUSES — answers "what causes X" — GEO + featured snippet target
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="causes-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="causes-heading">
            What Causes <span><?php echo esc_html($service_name); ?> Issues</span>?
        </h2>
        <p class="taas-section__sub">Understanding why the fault occurs helps you know whether it's an isolated incident or part of a larger problem. <?php echo esc_html($specialist_name); ?> checks for all of these during the assessment.</p>

        <ul class="taas-fault-grid">
            <?php foreach ($causes as $cause):
                // Split "short title — explanation" on em dash if present
                $parts = explode(' — ', $cause, 2);
                $title = trim($parts[0]);
                $desc  = isset($parts[1]) ? trim($parts[1]) : '';
            ?>
            <li>
                <span class="taas-fault-icon">—</span>
                <span>
                    <strong style="color:var(--taas-white);display:block;margin-bottom:3px;"><?php echo wp_kses_post($title); ?></strong>
                    <?php if ($desc): ?><span style="font-size:14px;color:#888;"><?php echo esc_html($desc); ?></span><?php endif; ?>
                </span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     SYMPTOMS — answers "signs of X" — AIO extraction target
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="symptoms-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="symptoms-heading">
            Warning Signs — <span>Does This Sound Like Your Vehicle?</span>
        </h2>
        <p class="taas-section__sub">These are the symptoms South Auckland drivers describe when they call us about <?php echo esc_html(strtolower($service_name)); ?>. If your vehicle is showing any of these, call <?php echo esc_html($phone_free); ?> or book in today.</p>

        <ul class="taas-fault-grid">
            <?php foreach ($symptoms as $symptom): ?>
            <li>
                <span class="taas-fault-icon" style="color:#f5c518;">⚠</span>
                <span style="color:#ccc;"><?php echo esc_html($symptom); ?></span>
            </li>
            <?php endforeach; ?>
        </ul>

        <div style="margin-top:28px;text-align:center;">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--primary">
                Call <?php echo esc_html($phone_free); ?> — Describe Your Symptoms
            </a>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     OUR PROCESS — answers "how does X work" — builds confidence
     Numbered steps = AIO extraction format
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="process-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="process-heading">
            How We Handle <span><?php echo esc_html($service_name); ?></span> at TAAS
        </h2>
        <p class="taas-section__sub">
            At Tony Allen Auto Service, we do not guess. <?php echo esc_html($specialist_name); ?> follows a structured process for every <?php echo esc_html(strtolower($service_name)); ?> job — so you get an accurate diagnosis and a repair that lasts.
        </p>

        <ol class="taas-process" role="list">
            <?php foreach ($process as $idx => $step):
                $step_parts = explode(' — ', $step, 2);
                $step_title = trim($step_parts[0]);
                $step_desc  = isset($step_parts[1]) ? trim($step_parts[1]) : '';
            ?>
            <li class="taas-process__step">
                <div class="taas-process__num"><?php echo $idx + 1; ?></div>
                <div class="taas-process__content">
                    <div class="taas-process__label"><?php echo esc_html($step_title); ?></div>
                    <?php if ($step_desc): ?>
                        <div class="taas-process__desc"><?php echo esc_html($step_desc); ?></div>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     PRICING — answers "how much does X cost" — #1 commercial intent signal
     Honest signal only — not a fixed quote
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="pricing-heading">
    <div class="taas-container">
        <div class="taas-two-col" style="gap:48px;">
            <div>
                <h2 class="taas-section__title" id="pricing-heading">
                    How Much Does <span><?php echo esc_html($service_name); ?></span> Cost in Manukau?
                </h2>
                <p style="color:#bbb;font-size:17px;line-height:1.85;margin-bottom:18px;">
                    <?php if ( $hide_specialist ): ?>
                    Towing costs are set by the towing company — not by us. <a href="https://towingandrecovery.co.nz" target="_blank" rel="noopener" style="color:var(--taas-yellow);">Towing and Recovery</a> can advise current rates when you call. If your insurance includes roadside assistance, towing may already be covered.
                </p>
                <p style="color:#bbb;font-size:17px;line-height:1.85;margin-bottom:24px;">
                    Once your vehicle is with us, we always provide an estimate before starting any repair work. You will never be charged for work you have not approved.
                    <?php else: ?>
                    We understand that pricing anxiety stops people calling. So here is an honest guide. We will always give you an estimate before any work starts — what you see below is a general price guide.
                </p>
                <p style="color:#bbb;font-size:17px;line-height:1.85;margin-bottom:24px;">
                    The final price for <?php echo esc_html(strtolower($service_name)); ?> depends on your specific vehicle, the parts required, and whether additional faults are found during our assessment. What we will never do is start work without your approval.
                    <?php endif; ?>
                </p>
                <div style="background:#1a1400;border-left:4px solid var(--taas-yellow);border-radius:0 var(--taas-radius) var(--taas-radius) 0;padding:16px 20px;font-size:16px;color:#ccc;line-height:1.75;">
                    <strong style="color:var(--taas-yellow);">Afterpay, Q Card, Gem Finance &amp; Aotea Finance accepted.</strong> Spread the cost with interest-free options. <a href="/finance-options/" style="color:var(--taas-yellow);">Learn more →</a>
                </div>
            </div>

            <div class="taas-pricing-card">
                <h3><?php echo esc_html($service_name); ?> — Price Guide</h3>
                <div class="taas-pricing-card__signal"><?php echo esc_html($price_signal); ?></div>
                <div class="taas-pricing-card__note">Price indication only. Estimate provided before work starts. Prices include GST.</div>
                <ul class="taas-pricing-card__items">
                    <li>
                        <span class="item-label">Assessment &amp; diagnosis</span>
                        <span class="item-note">Estimated upfront</span>
                    </li>
                    <li>
                        <span class="item-label">Estimate before work</span>
                        <span class="item-note" style="color:#4caf50;font-weight:700;">✓ Always</span>
                    </li>
                    <li>
                        <span class="item-label">Payment options</span>
                        <span class="item-note">Afterpay · Zip · Q Card · Gem · Aotea</span>
                    </li>
                    <li>
                        <span class="item-label">Parts warranty</span>
                        <span class="item-note">Manufacturer warranty applies</span>
                    </li>
                </ul>
                <div class="taas-pricing-disclaimer">
                    Price varies by vehicle make, model and parts availability. Call <?php echo esc_html($phone_free); ?> for a same-day estimate on your specific vehicle.
                </div>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"
                   class="taas-btn taas-btn--primary" style="width:100%;justify-content:center;margin-top:18px;">
                    Get an Estimate — Call <?php echo esc_html($phone_free); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     RELATED SERVICES — internal linking for SEO + user journey
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="related-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="related-heading">
            Related Services — <span>Often Diagnosed Together</span>
        </h2>
        <p class="taas-section__sub">These services are frequently related to <?php echo esc_html(strtolower($service_name)); ?>. <?php echo esc_html($specialist_name); ?> will flag if any of these need attention during your visit.</p>

        <ul class="taas-related">
            <?php
            $related = [
                [$related_1_label, $related_1_url],
                [$related_2_label, $related_2_url],
                [$related_3_label, $related_3_url],
                [$service_hub_label . ' — Full Service List', $service_hub_url],
            ];
            foreach ($related as $rel):
                if (!$rel[0] || !$rel[1]) continue;
            ?>
            <li>
                <a href="<?php echo esc_url($rel[1]); ?>" class="taas-related__item">
                    <span class="taas-related__label"><?php echo esc_html($rel[0]); ?></span>
                    <span class="taas-related__arrow">→</span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     FAQ — featured snippet + AIO extraction target
     Every question is a real search query. Every answer is TAAS-specific.
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="faq-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="faq-heading">
            <?php echo esc_html($service_name); ?> Manukau — <span>Questions Answered</span>
        </h2>
        <p class="taas-section__sub">Real questions from South Auckland drivers — answered honestly by the team at Tony Allen Auto Service.</p>

        <ul class="taas-faq" id="taas-faq-list">
            <?php foreach ($faqs as $idx => $faq): ?>
            <li class="taas-faq__item">
                <button class="taas-faq__q"
                        aria-expanded="<?php echo $idx === 0 ? 'true' : 'false'; ?>"
                        aria-controls="faq-ss-<?php echo $idx; ?>">
                    <?php echo esc_html($faq['q']); ?>
                    <i class="taas-faq__icon" aria-hidden="true">+</i>
                </button>
                <div class="taas-faq__a" id="faq-ss-<?php echo $idx; ?>"
                     <?php echo $idx === 0 ? 'style="display:block;"' : ''; ?>>
                    <p><?php echo nl2br(wp_kses_post($faq['a'])); ?></p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     BOOK / CONTACT
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" id="book" aria-labelledby="book-heading">
    <div class="taas-container">
        <h2 class="taas-section__title" id="book-heading">
            Enquire <span>Now</span>
        </h2>
        <p class="taas-section__sub">Call us or fill in the form and we'll get back to you. Estimate provided before any work begins.</p>

        <div class="taas-two-col">
            <div>
                <?php if ($cf7_general): ?>
                    <?php echo do_shortcode($cf7_general); ?>
                <?php else: ?>
                    <div style="background:var(--taas-black);border:1px solid #2a2a2a;border-top:4px solid var(--taas-yellow);border-radius:var(--taas-radius);padding:32px;">
                        <h3 style="color:var(--taas-white);font-size:19px;margin-bottom:8px;">Book or Enquire</h3>
                        <p style="color:#bbb;margin-bottom:24px;font-size:16px;line-height:1.75;">Tell us what your vehicle is doing. <?php echo esc_html($specialist_name); ?> will give you an honest assessment of what is involved before you commit.</p>
                        <div style="display:flex;flex-direction:column;gap:12px;">
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>"
                               class="taas-btn taas-btn--primary" style="justify-content:center;font-size:17px;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                                Call <?php echo esc_html($phone_local); ?>
                            </a>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"
                               class="taas-btn taas-btn--outline" style="justify-content:center;font-size:17px;">
                                Freephone <?php echo esc_html($phone_free); ?>
                            </a>
                            <a href="mailto:<?php echo esc_attr($email); ?>"
                               class="taas-btn taas-btn--outline" style="justify-content:center;font-size:17px;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                Email <?php echo esc_html($email); ?>
                            </a>
                        </div>
                        <p style="margin-top:18px;font-size:13px;color:#555;">Open <?php echo esc_html($hours); ?>. Call ahead to confirm availability.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="taas-contact-card">
                <h3>Visit Us in Manukau</h3>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Address</span>
                    <span class="taas-contact-card__val"><?php echo esc_html($address); ?></span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Phone</span>
                    <span class="taas-contact-card__val">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    </span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Toll-free</span>
                    <span class="taas-contact-card__val">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"><?php echo esc_html($phone_free); ?></a>
                    </span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Email</span>
                    <span class="taas-contact-card__val">
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                    </span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Hours</span>
                    <span class="taas-contact-card__val"><?php echo esc_html($hours); ?></span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Specialist</span>
                    <span class="taas-contact-card__val" style="color:var(--taas-yellow);font-weight:700;">
                        <?php echo esc_html($specialist_name); ?> — <?php echo esc_html($specialist_role); ?>
                    </span>
                </div>
                <div class="taas-contact-card__row">
                    <span class="taas-contact-card__label">Finance</span>
                    <span class="taas-contact-card__val">Afterpay · Zip · Q Card · Gem · Aotea</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     FOOTER CTA
     ════════════════════════════════════════════════════════════════════ -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Zip</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<div class="taas-footer-cta">
    <div class="taas-container">
        <h2><?php echo esc_html($service_name); ?> in Manukau — Book Today</h2>
        <p><?php echo esc_html($specialist_name); ?> and the team are ready. Call us or book online — estimate before we start.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--primary">
                Call <?php echo esc_html($phone_free); ?>
            </a>
            <a href="/contact-us/" class="taas-btn taas-btn--outline">Book Online</a>
        </div>
        <p style="margin-top:20px;font-size:14px;">
            <a href="<?php echo esc_url($service_hub_url); ?>" style="color:#666;">
                ← Back to <?php echo esc_html($service_hub_label); ?>
            </a>
        </p>
    </div>
</div>

</div><!-- /.taas-ss -->

<!-- ════════════════════════════════════════════════════════════════════
     SCHEMA — Service + FAQPage + BreadcrumbList
     GEO: explicit entity associations for AI answer extraction
     ════════════════════════════════════════════════════════════════════ -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},
        {"@type":"ListItem","position":2,"name":"<?php echo esc_js($service_hub_label); ?>","item":"<?php echo esc_js($site_url . $service_hub_url); ?>"},
        {"@type":"ListItem","position":3,"name":"<?php echo esc_js($service_name); ?>","item":"<?php echo esc_js($page_url); ?>"}
      ]
    },
    {
      "@type": "Service",
      "@id": "<?php echo esc_js($page_url); ?>#service",
      "name": "<?php echo esc_js($service_name); ?>",
      "description": "<?php echo esc_js(substr($what_it_is, 0, 300)); ?>",
      "serviceType": "<?php echo esc_js($service_category); ?>",
      "provider": {
        "@type": "AutoRepair",
        "@id": "<?php echo esc_js($site_url); ?>/#organization",
        "name": "Tony Allen Auto Service",
        "alternateName": "TAAS",
        "url": "<?php echo esc_js($site_url); ?>",
        "telephone": "<?php echo esc_js($phone_local); ?>",
        "email": "<?php echo esc_js($email); ?>",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "139 Cavendish Drive",
          "addressLocality": "Manukau",
          "addressRegion": "Auckland",
          "addressCountry": "NZ",
          "postalCode": "2104"
        },
        "openingHours": "Mo-Fr 07:30-17:00",
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "<?php echo esc_js($rating); ?>",
          "reviewCount": "<?php echo esc_js(preg_replace('/[^0-9]/', '', $reviews_count)); ?>",
          "bestRating": "5",
          "worstRating": "1"
        },
        "foundingDate": "<?php echo esc_js($established); ?>",
        "memberOf": {"@type":"Organization","name":"Motor Trade Association (MTA)"},
        "paymentAccepted": "Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance",
        "hasCredential": {"@type":"EducationalOccupationalCredential","name":"NZTA Authorised Vehicle Inspector","credentialCategory":"Licence"}
      },
      "areaServed": [
        {"@type":"City","name":"Manukau"},
        {"@type":"City","name":"Papatoetoe"},
        {"@type":"City","name":"Mangere"},
        {"@type":"City","name":"Otara"},
        {"@type":"City","name":"South Auckland"}
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "<?php echo esc_js($service_name); ?>",
        "itemListElement": [
          {
            "@type": "Offer",
            "name": "<?php echo esc_js($service_name); ?> — Manukau",
            "description": "<?php echo esc_js($price_signal); ?>",
            "seller": {"@type":"AutoRepair","name":"Tony Allen Auto Service"}
          }
        ]
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php
        $schema_faqs = [];
        foreach ($faqs as $faq) {
            $schema_faqs[] = sprintf(
                '{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}',
                json_encode($faq['q']),
                json_encode(strip_tags($faq['a']))
            );
        }
        echo implode(",\n        ", $schema_faqs);
        ?>
      ]
    }
  ]
}
</script>

<!-- ════════════════════════════════════════════════════════════════════
     FAQ ACCORDION JS — vanilla, no jQuery, consistent across all templates
     ════════════════════════════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';
    document.querySelectorAll('.taas-faq__q').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            document.querySelectorAll('.taas-faq__q').forEach(function (b) {
                b.setAttribute('aria-expanded', 'false');
                var ans = document.getElementById(b.getAttribute('aria-controls'));
                if (ans) ans.style.display = 'none';
            });
            if (!expanded) {
                this.setAttribute('aria-expanded', 'true');
                var answer = document.getElementById(this.getAttribute('aria-controls'));
                if (answer) answer.style.display = 'block';
            }
        });
    });
}());
</script>

<?php get_footer(); ?>
