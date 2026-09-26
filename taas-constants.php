<?php
/**
 * TAAS Constants — single source of truth.
 * Update here, propagates instantly across the entire site.
 *
 * Loaded via functions.php:
 * require_once get_stylesheet_directory() . '/taas-constants.php';
 */

// ── Contact ──────────────────────────────────────────────────────────────────
define('TAAS_PHONE_LOCAL',    '09 278 9556');
define('TAAS_PHONE_FREE',     '0800 100 876');
define('TAAS_EMAIL',          'enquiries@taas.co.nz');
define('TAAS_ADDRESS',        '139 Cavendish Drive, Manukau, Auckland 2104');
define('TAAS_HOURS',          'Monday–Friday 7:30am–5:00pm');

// ── Business facts ───────────────────────────────────────────────────────────
define('TAAS_ESTABLISHED',    '1985');
define('TAAS_RATING',         '4.2');
define('TAAS_REVIEWS',        '200+');
define('TAAS_MS_NUMBER',      'MS 13890');
define('TAAS_CUSTOMERS',      '10,000+');

// ── Divisions & brands ───────────────────────────────────────────────────────
define('TAAS_DIVISIONS',      'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries');
define('TAAS_EURO_BRANDS',    'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more');
define('TAAS_DIVISION_COUNT', '7');
define('TAAS_FINANCE_LIST',   'Afterpay, Q Card, GEM, Aotea Finance');
define('TAAS_MBI_LIST',       'Autosure, Assurant, Provident, Janssen, Autolife');

// ── Pricing — services ───────────────────────────────────────────────────────
define('TAAS_WOF_PRICE',      '$80');
define('TAAS_SERVICE_PRICE',  'from $229');

// ── Pricing — vehicle servicing tiers (5 categories × 3 tiers) ──────────────
//    Car (up to 5L) | SUV/V6 (5–7L) | Ute/V8 (7L+) | Euro Std | Euro Perf
define('TAAS_SVC_ESS_CAR',    '$229');
define('TAAS_SVC_STD_CAR',    '$329');
define('TAAS_SVC_PREM_CAR',   '$429');
define('TAAS_SVC_ESS_SUV',    '$269');
define('TAAS_SVC_STD_SUV',    '$369');
define('TAAS_SVC_PREM_SUV',   '$469');
define('TAAS_SVC_ESS_UTE',    '$319');
define('TAAS_SVC_STD_UTE',    '$419');
define('TAAS_SVC_PREM_UTE',   '$519');
define('TAAS_SVC_ESS_EUROS',  '$259');
define('TAAS_SVC_STD_EUROS',  '$359');
define('TAAS_SVC_PREM_EUROS', '$459');
define('TAAS_SVC_ESS_EUROP',  '$349');
define('TAAS_SVC_STD_EUROP',  '$449');
define('TAAS_SVC_PREM_EUROP', '$549');
define('TAAS_MECH_DIAG',      'from $175');
define('TAAS_BRAKE_PRICE',    'from $380');
define('TAAS_CAMBELT_PRICE',  'from $800');
define('TAAS_CLUTCH_PRICE',   'from $800');
define('TAAS_SUSPENSION_PRICE','from $300');
define('TAAS_AIRCON_PRICE',   'from $280');

// ── Pricing — cooling system ────────────────────────────────────────────────
define('TAAS_CS_FLUSH',       'from $250');
define('TAAS_CS_THERMOSTAT',  'from $200');
define('TAAS_CS_RADIATOR',    'from $800');
define('TAAS_CS_HEATERCORE',  'from $1,500');
define('TAAS_CS_HEADGASKET',  'from $3,000');
define('TAAS_CS_HEADMACHINE', '$400–$600');

// ── Pricing — auto electrical ────────────────────────────────────────────────
define('TAAS_SCAN_PRICE',     'from $75');
define('TAAS_AUTOELEC_DIAG',  'from $175');
define('TAAS_ALT_TEST',       'from $85');
define('TAAS_STARTER_TEST',   'from $85');
define('TAAS_WIRING_DIAG',    'from $175 per hour');
define('TAAS_TPMS_PRICE',     'from $75');
define('TAAS_LIGHTING_DIAG',  'from $85');
define('TAAS_WINDOW_DIAG',    'from $85');
define('TAAS_ABS_DIAG',       'from $75');
define('TAAS_SRS_DIAG',       'from $75');
define('TAAS_EGR_DIAG',       'from $75');
define('TAAS_CL_DIAG',        'from $85');
define('TAAS_IMMOB_DIAG',     'from $75');

// ── Pricing — tyres & alignment ──────────────────────────────────────────────
define('TAAS_ALIGNMENT_PRICE','from $100 incl. GST');
define('TAAS_BALANCE_PRICE',  'from $25 per wheel incl. GST');

// ── Pricing — batteries (Manukau Batteries) ──────────────────────────────────
define('TAAS_BATTERY_PRICE',  'from $180 fitted');


// ── Pricing — pre-purchase inspection ────────────────────────────────────
define('TAAS_PPI_BASIC',      '$149');
define('TAAS_PPI_STANDARD',   '$249');
define('TAAS_PPI_PREMIUM',    '$299');

// ── Forms (CF7 shortcodes) ───────────────────────────────────────────────────
define('TAAS_CF7_WOF',        '[contact-form-7 id="bdcfc93" title="WOF Booking"]');
define('TAAS_CF7_FINANCE',    '[contact-form-7 id="cadd266" title="Finance Enquiry"]');
define('TAAS_CF7_GENERAL',    '[contact-form-7 id="e31b60d" title="General Enquiry"]');

// ── Reviews widget ───────────────────────────────────────────────────────────
define('TAAS_REVIEWS_WIDGET', '[trustindex no-registration=google]');

// ── Tracking ────────────────────────────────────────────────────────────────
define('TAAS_GA4_ID',      'G-4FW7EPYH68');
define('TAAS_CLARITY_ID',  'x59kh44zun');

// ── Hero images ─────────────────────────────────────────────────────────────
define('TAAS_HERO_DEFAULT', '/wp-content/uploads/2026/06/hero-services.webp');
define('TAAS_HERO_FINANCE', '/wp-content/uploads/2026/06/hero-finance.webp');
define('TAAS_HERO_MBI',     '/wp-content/uploads/2026/06/hero-mbi.webp');
define('TAAS_HERO_CONTACT', '/wp-content/uploads/2026/06/hero-contact.webp');

// ── Contact links ────────────────────────────────────────────────────────────
// Use these in templates so phone numbers, email and address are always tappable.
if (!defined('TAAS_MAPS_URL')) {
    define('TAAS_MAPS_URL', 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau');
}

if (!function_exists('taas_phone')) {
    function taas_phone($number = null, $class = '') {
        $num = $number ?: TAAS_PHONE_FREE;
        $tel = preg_replace('/[^0-9+]/', '', $num);
        $cls = $class ? ' class="' . esc_attr($class) . '"' : '';
        return '<a href="tel:' . esc_attr($tel) . '"' . $cls . '>' . esc_html($num) . '</a>';
    }
}

if (!function_exists('taas_email')) {
    function taas_email($class = '') {
        $cls = $class ? ' class="' . esc_attr($class) . '"' : '';
        return '<a href="mailto:' . esc_attr(TAAS_EMAIL) . '"' . $cls . '>' . esc_html(TAAS_EMAIL) . '</a>';
    }
}

if (!function_exists('taas_address')) {
    function taas_address($class = '') {
        $cls = $class ? ' class="' . esc_attr($class) . '"' : '';
        return '<a href="' . esc_url(TAAS_MAPS_URL) . '" target="_blank" rel="noopener"' . $cls . '>' . esc_html(TAAS_ADDRESS) . '</a>';
    }
}
