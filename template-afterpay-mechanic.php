<?php
/**
 * Template Name: Afterpay Car Repairs
 * Template Post Type: page
 *
 * Deploy to: taas.co.nz/afterpay-car-repairs/
 * WordPress page: create page, set template to "Afterpay Mechanic"
 *
 * Shared constants (define in functions.php or WPCode):
 *   TAAS_EMAIL, TAAS_ADDRESS, TAAS_HOURS, TAAS_CF7_FINANCE,
 *   TAAS_REVIEWS_WIDGET, TAAS_GOOGLE_REVIEWS, TAAS_GOOGLE_RATING,
 *   TAAS_ESTABLISHED
 *
 * Phone numbers: hardcoded directly (constants unreliable on this host)
 */

// ── Phone numbers — hardcoded ──────────────────────────────────────────────
$phone_local = '09 278 9556';
$phone_free  = '0800 100 876';

// ── Shared constants ───────────────────────────────────────────────────────
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Mon–Fri 7:30am–5:00pm';
$cf7_finance    = defined('TAAS_CF7_FINANCE')    ? TAAS_CF7_FINANCE    : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$google_reviews = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$google_rating  = defined('TAAS_GOOGLE_RATING')  ? TAAS_GOOGLE_RATING  : '4.2';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';

// ── Derived ────────────────────────────────────────────────────────────────
$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

// ── Afterpay FAQs ──────────────────────────────────────────────────────────
$faqs = [
    [
        'q' => 'Can I use Afterpay for any repair at Tony Allen Auto Service?',
        'a' => 'Yes. Afterpay is accepted across our full range of services — WOF, routine servicing, brakes, tyres, engine work, cambelt, suspension, clutch, diagnostics, and more. The only limit is your individual Afterpay spend limit. Check your available balance in the Afterpay app before booking if your job is a larger one.',
    ],
    [
        'q' => 'Do I need an Afterpay account before I come in?',
        'a' => 'Yes. You need an active Afterpay account and the digital Afterpay Card added to your phone\'s wallet (Apple Pay, Google Pay, or Samsung Pay) before paying in-store. Download the Afterpay app, complete sign-up, and set up the in-store card in the In-store tab before your collection appointment. It only takes a few minutes.',
    ],
    [
        'q' => 'How much can I spend with Afterpay?',
        'a' => 'Afterpay sets individual spend limits based on your payment history, account age, and a credit assessment. New customers start with a lower limit that can increase over time with consistent on-time payments. Your current available limit is shown in the Afterpay app. We recommend checking before booking in for a large repair.',
    ],
    [
        'q' => 'Is Afterpay really interest-free?',
        'a' => 'Yes — when you pay all four instalments on time, there is no interest charged at all. If you miss a payment, a late fee may apply, capped at 25% of your order total or $68 NZD — whichever is less. See afterpay.com for full terms.',
    ],
    [
        'q' => 'What happens if I miss a payment?',
        'a' => 'Afterpay sends reminder notifications before each payment date. You can also reschedule a payment in the Afterpay app up to three times per year. If a payment is missed, a late fee may apply and your account may be paused until the balance is cleared. Late fees are capped — they will never exceed 25% of your order total or $68.',
    ],
    [
        'q' => 'How do I pay with Afterpay when I pick up my vehicle?',
        'a' => 'Before you arrive, open the Afterpay app and ensure the digital Afterpay Card is added to your phone\'s wallet. When you collect your vehicle, let our service desk know you\'re paying with Afterpay and tap your phone at the payment terminal. The first instalment — 25% of the total — is charged immediately. The remaining three are deducted automatically every two weeks.',
    ],
    [
        'q' => 'Will using Afterpay affect my credit score?',
        'a' => 'Afterpay performs a credit check when you first sign up — this may be visible to other lenders and could impact your credit score. For existing customers, credit checks for spend limit increases are not visible to other lenders and will not affect your score. Making consistent on-time payments may have a positive effect on your credit history.',
    ],
    [
        'q' => 'Can I use Afterpay for fleet or commercial vehicle repairs?',
        'a' => 'Afterpay is a consumer finance product designed for individuals. For commercial fleet servicing and account-based invoicing, speak with our team about TAAS Fleet arrangements. Call ' . $phone_free . ' or email ' . $email . '.',
    ],
];

// ── Services covered (with page URLs) ─────────────────────────────────────
$services = [
    ['label' => 'Warrant of Fitness (WOF)',     'url' => '/wof/'],
    ['label' => 'Vehicle Servicing',             'url' => '/services/vehicle-servicing/'],
    ['label' => 'Brake Repairs & Replacement',   'url' => '/services/brake-repairs/'],
    ['label' => 'Engine Repairs & Overhaul',     'url' => '/services/engine-repairs/'],
    ['label' => 'Tyres & Wheels',                'url' => '/services/tyres-and-wheels/'],
    ['label' => 'Suspension & Steering',         'url' => '/services/suspension-and-steering/'],
    ['label' => 'Clutch Replacement',            'url' => '/services/clutch-replacement/'],
    ['label' => 'Auto Electrical',               'url' => '/services/auto-electrical/'],
    ['label' => 'Diagnostic Scanning',           'url' => '/services/diagnostic-scanning/'],
    ['label' => 'Cambelt & Water Pump',          'url' => '/services/cambelt-and-water-pump/'],
    ['label' => 'Air Conditioning Service',      'url' => '/services/air-conditioning/'],
    ['label' => 'Transmission Service',          'url' => '/services/transmission-service/'],
];

// ── Service areas ──────────────────────────────────────────────────────────
$service_areas = [
    ['Manukau', 'afterpay-mechanic-manukau'],
    ['Papatoetoe', 'afterpay-mechanic-papatoetoe'],
    ['Mangere', 'afterpay-mechanic-mangere'],
    ['Mangere Bridge', 'afterpay-mechanic-mangere-bridge'],
    ['Otahuhu', 'afterpay-mechanic-otahuhu'],
    ['Wiri', 'afterpay-mechanic-wiri'],
    ['Otara', 'afterpay-mechanic-otara'],
    ['Hunters Corner', 'afterpay-mechanic-hunters-corner'],
    ['Clover Park', 'afterpay-mechanic-clover-park'],
    ['Flat Bush', 'afterpay-mechanic-flat-bush'],
    ['Manurewa', 'afterpay-mechanic-manurewa'],
    ['Clendon', 'afterpay-mechanic-clendon'],
    ['Weymouth', 'afterpay-mechanic-weymouth'],
    ['Takanini', 'afterpay-mechanic-takanini'],
    ['Papakura', 'afterpay-mechanic-papakura'],
    ['Howick', 'afterpay-mechanic-howick'],
];

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

get_header();
?>
<!-- ═══════════════════════════════════════════════════════════════════
     AFTERPAY MECHANIC — Tony Allen Auto Service
     Template: template-afterpay-mechanic.php
     URL: taas.co.nz/afterpay-car-repairs/
     ═══════════════════════════════════════════════════════════════════ -->

<style>
/* ── CSS custom properties — TAAS brand colours ────────────────────── */
:root {
    --taas-black:   #111111;
    --taas-dark:    #1a1a1a;
    --taas-darker:  #141414;
    --taas-yellow:  #FFC800;
    --taas-yellow2: #e6b400;
    --taas-white:   #ffffff;
    --taas-grey:    #cccccc;
    --taas-mid:     #444444;
    --taas-radius:  6px;
    --taas-shadow:  0 4px 24px rgba(0,0,0,.45);
    --container:    1140px;
}

/* ── Reset / base ──────────────────────────────────────────────────── */
.taas-ap * { box-sizing: border-box; margin: 0; padding: 0; }
.taas-ap {
    font-family: 'Inter', Arial, sans-serif;
    color: var(--taas-grey);
    background: var(--taas-dark);
    line-height: 1.6;
    font-size: 16px !important;
}
.taas-ap a { color: var(--taas-yellow); text-decoration: none; }
.taas-ap a:hover { text-decoration: underline; }
.taas-container { max-width: var(--container); margin: 0 auto; padding: 0 20px; }

/* ── Breadcrumb ─────────────────────────────────────────────────────── */
.taas-breadcrumb {
    background: var(--taas-darker);
    border-bottom: 1px solid #222;
    padding: 10px 20px;
    font-size: 13px;
    color: #666;
}
.taas-breadcrumb a { color: #888; }
.taas-breadcrumb a:hover { color: var(--taas-yellow); }
.taas-breadcrumb__sep { margin: 0 8px; color: #444; }
.taas-breadcrumb strong { color: #aaa; }

/* ── Hero ──────────────────────────────────────────────────────────── */
.taas-hero {
    background: linear-gradient(135deg, #0d0d0d 0%, #1c1c1c 60%, #1a1400 100%);
    border-bottom: 4px solid var(--taas-yellow);
    padding: 70px 20px 60px;
    text-align: center;
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
.taas-hero::after {
    content: 'AFTERPAY';
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 180px;
    font-weight: 900;
    color: rgba(255,200,0,0.04);
    line-height: 1;
    pointer-events: none;
    user-select: none;
    letter-spacing: -0.02em;
    z-index: 0;
}
.taas-hero > * { position: relative; z-index: 1; }
.taas-hero__eyebrow {
    display: inline-block;
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    padding: 4px 14px;
    border-radius: 3px;
    margin-bottom: 18px;
}
.taas-hero h1 {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: clamp(36px, 6vw, 58px);
    font-weight: 900;
    color: var(--taas-white);
    line-height: 1.1;
    margin-bottom: 16px;
    letter-spacing: -.01em;
}
.taas-hero h1 span { color: var(--taas-yellow); }
.taas-hero__sub {
    font-size: 19px;
    color: #cccccc;
    max-width: 620px;
    margin: 0 auto 30px;
    line-height: 1.6;
}
.taas-hero__ctas { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }

/* ── Afterpay stat card ─────────────────────────────────────────────── */
.taas-ap-card {
    display: inline-flex;
    gap: 0;
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-top: 4px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    margin-top: 28px;
    overflow: hidden;
}
.taas-ap-card__cell {
    padding: 18px 28px;
    text-align: center;
    border-right: 1px solid #222;
}
.taas-ap-card__cell:last-child { border-right: none; }
.taas-ap-card__val {
    font-size: 2.2rem;
    font-weight: 900;
    color: var(--taas-yellow);
    line-height: 1;
}
.taas-ap-card__lbl {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: #666;
    font-weight: 600;
    margin-top: 4px;
}

/* ── Buttons ────────────────────────────────────────────────────────── */
.taas-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 14px 28px;
    border-radius: var(--taas-radius);
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    border: none;
    transition: transform .15s, box-shadow .15s;
    text-decoration: none !important;
}
.taas-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.4); }
.taas-btn--primary  { background: var(--taas-yellow); color: #111111 !important; }
.taas-btn--outline  { background: transparent; color: var(--taas-yellow) !important; border: 2px solid var(--taas-yellow); }
.taas-btn--dark     { background: var(--taas-black); color: var(--taas-white) !important; border: 1px solid #333; }

/* ── Trust strip ────────────────────────────────────────────────────── */
.taas-trust {
    background: var(--taas-yellow);
    padding: 18px 20px;
}
.taas-trust__inner {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px 40px;
    max-width: var(--container);
    margin: 0 auto;
}
.taas-trust__item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--taas-black);
    font-weight: 700;
    font-size: 15px;
}
.taas-trust__item svg { flex-shrink: 0; }

/* ── Sections ───────────────────────────────────────────────────────── */
.taas-section { padding: 64px 20px; }
.taas-section--alt { background: var(--taas-darker); }
.taas-section__title {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: clamp(26px, 3.5vw, 40px);
    font-weight: 900;
    color: var(--taas-white);
    margin-bottom: 10px;
    line-height: 1.15;
}
.taas-section__title span { color: var(--taas-yellow); }
.taas-section__sub { color: #bbb; margin-bottom: 36px; max-width: 640px; font-size: 17px; line-height: 1.7; }
.taas-label {
    display: inline-block;
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 3px;
    margin-bottom: 16px;
}

/* ── How it works steps ─────────────────────────────────────────────── */
.taas-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3px;
    background: #222;
    border-radius: var(--taas-radius);
    overflow: hidden;
    margin-top: 36px;
}
.taas-step {
    background: var(--taas-black);
    padding: 32px 24px;
}
.taas-step__num {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: 3.5rem;
    font-weight: 900;
    color: #222;
    line-height: 1;
    margin-bottom: 12px;
}
.taas-step__title {
    font-family: 'Inter', Arial, sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--taas-white);
    letter-spacing: .02em;
    margin-bottom: 8px;
}
.taas-step__text { font-family: 'Inter', Arial, sans-serif; font-size: 14px; color: #888; line-height: 1.6; }
.taas-step__badge {
    display: inline-block;
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-size: 12px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 3px;
    margin-top: 12px;
}

/* ── Services grid ──────────────────────────────────────────────────── */
.taas-services {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 3px;
    background: #222;
    border-radius: var(--taas-radius);
    overflow: hidden;
    margin-top: 32px;
}
.taas-service-item {
    background: var(--taas-black);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    color: #ccc;
    text-decoration: none;
    transition: background .15s, color .15s;
}
.taas-service-item:hover {
    background: #1a1a0d;
    color: var(--taas-yellow);
    text-decoration: none;
}
.taas-service-item::before {
    content: '✓';
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-weight: 900;
    font-size: 13px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* ── Eligibility checklist ──────────────────────────────────────────── */
.taas-checklist { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
.taas-checklist li {
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-left: 4px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    padding: 14px 16px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 15px;
    color: #ddd;
    line-height: 1.5;
}
.taas-checklist li::before {
    content: '✓';
    color: var(--taas-yellow);
    font-weight: 700;
    font-size: 15px;
    flex-shrink: 0;
    margin-top: 1px;
}

/* ── Info box ───────────────────────────────────────────────────────── */
.taas-info-box {
    background: #111500;
    border: 1px solid #2a2a00;
    border-left: 4px solid var(--taas-yellow);
    border-radius: 0 var(--taas-radius) var(--taas-radius) 0;
    padding: 18px 20px;
    margin-top: 20px;
    font-size: 15px;
    color: #bbb;
    line-height: 1.7;
}
.taas-info-box strong { color: var(--taas-yellow); }

/* ── Comparison table ───────────────────────────────────────────────── */
.taas-table-wrap { overflow-x: auto; margin-top: 32px; }
.taas-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    background: var(--taas-black);
    border-radius: var(--taas-radius);
    overflow: hidden;
    box-shadow: var(--taas-shadow);
    min-width: 600px;
}
.taas-table thead { background: var(--taas-yellow); }
.taas-table thead th {
    color: var(--taas-black);
    font-weight: 700;
    padding: 13px 18px;
    text-align: left;
    font-size: 13px;
    letter-spacing: .05em;
    text-transform: uppercase;
}
.taas-table tbody tr { border-bottom: 1px solid #222; transition: background .1s; }
.taas-table tbody tr:hover { background: #1f1f1f; }
.taas-table tbody tr:last-child { border-bottom: none; }
.taas-table td { padding: 13px 18px; vertical-align: middle; color: #bbb; font-size: 15px; }
.taas-table td:first-child { color: var(--taas-white); font-weight: 600; }
.taas-tick  { color: #4caf50; font-weight: 700; }
.taas-dash  { color: #555; }

/* ── FAQ accordion ──────────────────────────────────────────────────── */
.taas-faq { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.taas-faq__item {
    background: var(--taas-black);
    border: 1px solid #252525;
    border-radius: var(--taas-radius);
    overflow: hidden;
}
.taas-faq__q {
    width: 100%;
    background: none;
    border: none;
    color: var(--taas-white);
    text-align: left;
    padding: 18px 20px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    transition: color .15s;
    font-family: inherit;
}
.taas-faq__q:hover { color: var(--taas-yellow); }
.taas-faq__q[aria-expanded="true"] { color: var(--taas-yellow); }
.taas-faq__icon {
    flex-shrink: 0;
    width: 22px; height: 22px;
    border: 2px solid currentColor;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-style: normal;
    transition: transform .25s;
    font-size: 16px;
    line-height: 1;
}
.taas-faq__q[aria-expanded="true"] .taas-faq__icon { transform: rotate(45deg); }
.taas-faq__a {
    display: none;
    padding: 0 20px 20px;
    color: #bbb;
    line-height: 1.75;
    font-size: 16px;
}

/* ── Service area pills ─────────────────────────────────────────────── */
.taas-pills { display: flex; flex-wrap: wrap; gap: 10px; list-style: none; }
.taas-pills li span {
    display: inline-block;
    background: #1e1e1e;
    border: 1px solid #2a2a2a;
    color: #999;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 14px;
}

/* ── Two-col layout ─────────────────────────────────────────────────── */
.taas-two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

/* ── Contact card ───────────────────────────────────────────────────── */
.taas-contact-card {
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-top: 4px solid var(--taas-yellow);
    border-radius: var(--taas-radius);
    padding: 28px;
}
.taas-contact-card h3 { color: var(--taas-white); margin-bottom: 18px; font-size: 18px; }
.taas-contact-card__row {
    display: flex; gap: 12px; align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px solid #1e1e1e;
    font-size: 15px;
}
.taas-contact-card__row:last-child { border-bottom: none; }
.taas-contact-card__label { color: #555; min-width: 80px; font-size: 12px; text-transform: uppercase; letter-spacing: .06em; padding-top: 2px; }
.taas-contact-card__val { color: #bbb; }
.taas-contact-card__val a { color: var(--taas-yellow); }

/* ── Other options ──────────────────────────────────────────────────── */
.taas-options {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 16px;
    margin-top: 28px;
}
.taas-option-card {
    background: var(--taas-black);
    border: 1px solid #2a2a2a;
    border-top: 3px solid #2a2a2a;
    border-radius: var(--taas-radius);
    padding: 22px 20px;
    transition: border-top-color .2s;
}
.taas-option-card:hover { border-top-color: var(--taas-yellow); }
.taas-option-card__name { color: var(--taas-white); font-weight: 700; font-size: 16px; margin-bottom: 6px; }
.taas-option-card__desc { color: #777; font-size: 14px; line-height: 1.55; }

/* ── Reviews ────────────────────────────────────────────────────────── */
.taas-reviews-header { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
.taas-star-score {
    background: var(--taas-yellow);
    color: var(--taas-black);
    font-weight: 900;
    font-size: 26px;
    padding: 10px 16px;
    border-radius: var(--taas-radius);
    line-height: 1;
}
.taas-review-meta { color: #aaa; font-size: 14px; }
.taas-review-meta strong { color: var(--taas-white); font-size: 17px; display: block; }
.taas-stars { color: var(--taas-yellow); letter-spacing: 2px; font-size: 18px; }

/* ── Footer CTA ─────────────────────────────────────────────────────── */
.taas-footer-cta {
    background: linear-gradient(135deg, #111 0%, #1a1400 100%);
    border-top: 4px solid var(--taas-yellow);
    text-align: center;
    padding: 60px 20px;
}
.taas-footer-cta h2 { color: var(--taas-white); font-size: clamp(22px, 3vw, 34px); margin-bottom: 10px; }
.taas-footer-cta p { color: #aaa; margin-bottom: 28px; font-size: 17px; }

/* ── Disclaimer ─────────────────────────────────────────────────────── */
.taas-disclaimer {
    background: #0d0d0d;
    border-top: 1px solid #1e1e1e;
    padding: 20px;
    font-size: 12px;
    color: #444;
    text-align: center;
    line-height: 1.6;
}
.taas-disclaimer a { color: #555; text-decoration: underline; }

/* ── CF7 form — dark theme ──────────────────────────────────────────── */
.taas-ap .wpcf7-form { font-size: 15px; }
.taas-ap .wpcf7-form p { margin-bottom: 20px !important; }
.taas-ap .wpcf7-form .wpcf7-form-control-wrap { display: block !important; width: 100% !important; }
.taas-ap .wpcf7-form input[type="text"],
.taas-ap .wpcf7-form input[type="email"],
.taas-ap .wpcf7-form input[type="tel"],
.taas-ap .wpcf7-form select,
.taas-ap .wpcf7-form textarea {
    background: #1c1c1c !important;
    color: #ffffff !important;
    border: 1px solid #383838 !important;
    border-radius: 5px !important;
    padding: 14px 18px !important;
    font-size: 15px !important;
    width: 100% !important;
    box-sizing: border-box !important;
    transition: border-color .15s !important;
    height: auto !important;
    line-height: 1.5 !important;
    margin-top: 6px !important;
}
.taas-ap .wpcf7-form textarea { min-height: 120px !important; resize: vertical !important; }
.taas-ap .wpcf7-form input:focus,
.taas-ap .wpcf7-form textarea:focus {
    border-color: var(--taas-yellow) !important;
    outline: none !important;
    background: #212121 !important;
    box-shadow: 0 0 0 3px rgba(255,200,0,.1) !important;
}
.taas-ap .wpcf7-form label {
    color: #777 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    display: block !important;
    text-transform: uppercase !important;
    letter-spacing: .08em !important;
}
.taas-ap .wpcf7-form .wpcf7-submit,
.taas-ap .wpcf7-form input[type="submit"] {
    background: var(--taas-yellow) !important;
    color: #111111 !important;
    border: none !important;
    padding: 15px 32px !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    border-radius: 5px !important;
    cursor: pointer !important;
    width: 100% !important;
    margin-top: 4px !important;
    transition: opacity .15s, transform .1s !important;
}
.taas-ap .wpcf7-form input[type="submit"]:hover { opacity: .88 !important; transform: translateY(-1px) !important; }
.taas-ap .wpcf7-form .wpcf7-not-valid-tip { color: #ff6b6b !important; font-size: 12px !important; margin-top: 4px !important; }
.taas-ap .wpcf7-form .wpcf7-response-output {
    border: 1px solid var(--taas-yellow) !important;
    color: #bbb !important;
    background: #1a1a1a !important;
    font-size: 14px !important;
    padding: 14px 18px !important;
    border-radius: 5px !important;
    margin-top: 16px !important;
}

/* ── Responsive ─────────────────────────────────────────────────────── */
@media (max-width: 900px) {
    .taas-steps { grid-template-columns: repeat(2, 1fr); }
    .taas-two-col { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .taas-hero { padding: 50px 16px 44px; }
    .taas-hero::after { display: none; }
    .taas-section { padding: 44px 16px; }
    .taas-steps { grid-template-columns: 1fr; }
    .taas-ap-card { flex-direction: column; }
    .taas-ap-card__cell { border-right: none; border-bottom: 1px solid #222; }
    .taas-ap-card__cell:last-child { border-bottom: none; }
}
</style>

<div class="taas-ap" id="taas-main">

<!-- ════════════════════════════════════════════════════════════════════
     BREADCRUMB
     ════════════════════════════════════════════════════════════════════ -->
<nav class="taas-breadcrumb" aria-label="Breadcrumb">
    <div class="taas-container">
        <a href="<?php echo esc_url($site_url); ?>/">Home</a>
        <span class="taas-breadcrumb__sep">›</span>
        <a href="<?php echo esc_url($site_url); ?>/finance-options/">Finance Options</a>
        <span class="taas-breadcrumb__sep">›</span>
        <strong>Afterpay Car Repairs</strong>
    </div>
</nav>

<!-- ════════════════════════════════════════════════════════════════════
     HERO
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-hero" aria-label="Page hero">
    <div>
        <span class="taas-hero__eyebrow">Manukau's Afterpay Mechanic — Est. <?php echo esc_html($established); ?></span>

        <h1>Car Repairs &amp; Servicing.<br>
        <span>Pay It in 4.</span></h1>

        <p class="taas-hero__sub">
            Tony Allen Auto Service accepts Afterpay across all repairs and services. Get your vehicle sorted today and split the cost into four equal, interest-free fortnightly payments. No interest. No annual fees.
        </p>

        <div class="taas-hero__ctas">
            <a href="#book" class="taas-btn taas-btn--primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                Book Now
            </a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--outline">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                <?php echo esc_html($phone_free); ?>
            </a>
        </div>

        <div class="taas-ap-card">
            <div class="taas-ap-card__cell">
                <div class="taas-ap-card__val">4</div>
                <div class="taas-ap-card__lbl">Payments</div>
            </div>
            <div class="taas-ap-card__cell">
                <div class="taas-ap-card__val">0%</div>
                <div class="taas-ap-card__lbl">Interest</div>
            </div>
            <div class="taas-ap-card__cell">
                <div class="taas-ap-card__val">6 wks</div>
                <div class="taas-ap-card__lbl">To Pay Off</div>
            </div>
            <div class="taas-ap-card__cell">
                <div class="taas-ap-card__val">All</div>
                <div class="taas-ap-card__lbl">Makes &amp; Models</div>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     TRUST STRIP
     ════════════════════════════════════════════════════════════════════ -->
<div class="taas-trust" role="region" aria-label="Trust indicators">
    <div class="taas-trust__inner">
        <div class="taas-trust__item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            MTA Assured Workshop
        </div>
        <div class="taas-trust__item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <?php echo esc_html($google_rating); ?>★ · <?php echo esc_html($google_reviews); ?> Google Reviews
        </div>
        <div class="taas-trust__item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Interest-Free Always
        </div>
        <div class="taas-trust__item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v4h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            All Makes &amp; Models
        </div>
        <div class="taas-trust__item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            Trading since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> Years
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════════════════
     HOW IT WORKS
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="how-heading">
    <div class="taas-container">
        <span class="taas-label">How It Works</span>
        <h2 class="taas-section__title" id="how-heading">Four Steps. <span>Zero Interest.</span></h2>
        <p class="taas-section__sub">Afterpay splits your repair or service bill into four equal payments over six weeks. You pay the first instalment at the time of collection — Afterpay covers us in full, and you settle the rest fortnightly from your debit or credit card.</p>

        <div class="taas-steps">
            <div class="taas-step">
                <div class="taas-step__num">01</div>
                <div class="taas-step__title">Book Your Vehicle In</div>
                <p class="taas-step__text">Call us on <?php echo esc_html($phone_free); ?> or book online. Let us know you'd like to pay with Afterpay.</p>
            </div>
            <div class="taas-step">
                <div class="taas-step__num">02</div>
                <div class="taas-step__title">We Complete the Work</div>
                <p class="taas-step__text">Our technicians carry out the repair or service. We call before starting any additional work.</p>
            </div>
            <div class="taas-step">
                <div class="taas-step__num">03</div>
                <div class="taas-step__title">Pay Your First Instalment</div>
                <p class="taas-step__text">At checkout you pay 25% of the total. Afterpay pays us the full amount immediately.</p>
                <span class="taas-step__badge">25% due today</span>
            </div>
            <div class="taas-step">
                <div class="taas-step__num">04</div>
                <div class="taas-step__title">Three More Payments</div>
                <p class="taas-step__text">The remaining three equal instalments are automatically deducted every two weeks — always interest-free.</p>
                <span class="taas-step__badge">Every 2 weeks</span>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     SERVICES COVERED
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="services-heading">
    <div class="taas-container">
        <span class="taas-label">What's Covered</span>
        <h2 class="taas-section__title" id="services-heading">Use Afterpay Across <span>All Our Services</span></h2>
        <p class="taas-section__sub">Afterpay is accepted for all repairs and servicing at Tony Allen Auto Service — WOF, brakes, engine work, the lot. Split any job into four payments with no interest.</p>

        <div class="taas-services">
            <?php foreach ($services as $service): ?>
            <a href="<?php echo esc_url($site_url . $service['url']); ?>" class="taas-service-item"><?php echo esc_html($service['label']); ?></a>
            <?php endforeach; ?>
        </div>

        <p style="margin-top:20px;font-size:15px;color:#666;">Not sure if your repair is covered? Call us on <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"><?php echo esc_html($phone_free); ?></a> and we'll confirm before you come in.</p>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     ELIGIBILITY & KEY FACTS
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="elig-heading">
    <div class="taas-container">
        <span class="taas-label">Eligibility &amp; Key Facts</span>
        <h2 class="taas-section__title" id="elig-heading">What You Need <span>to Know</span></h2>

        <div class="taas-two-col" style="margin-top:36px;">
            <div>
                <h3 style="color:var(--taas-white);font-size:18px;margin-bottom:4px;">To use Afterpay you must:</h3>
                <ul class="taas-checklist">
                    <li>Be a New Zealand resident</li>
                    <li>Be 18 years of age or older</li>
                    <li>Have a valid debit or credit card to link to your account</li>
                    <li>Consent to a credit check at sign-up (required by NZ law)</li>
                    <li>Download the Afterpay app to set up your account</li>
                    <li>Set up the digital Afterpay Card in your phone's wallet before arriving in-store</li>
                </ul>

                <div class="taas-info-box" style="margin-top:24px;">
                    <strong>Spend Limits</strong><br>
                    New Afterpay customers start with a lower spend limit. Your limit can increase over time with consistent on-time payments. Check your available limit in the Afterpay app before booking a large job.
                </div>
            </div>

            <div>
                <h3 style="color:var(--taas-white);font-size:18px;margin-bottom:4px;">Fees &amp; interest</h3>
                <ul class="taas-checklist">
                    <li>No interest — ever</li>
                    <li>No annual fees</li>
                    <li>No hidden fees when you pay on time</li>
                    <li>Late fee applies if a payment is missed — capped at 25% of the order or $68 NZD, whichever is less</li>
                    <li>Orders under $40: one-off late fee capped at 25% of the total</li>
                    <li>Orders $40 and over: $10 late fee, then up to $7 if still unpaid after 7 days, until the cap is reached</li>
                </ul>

                <div class="taas-info-box" style="margin-top:24px;">
                    <strong>Using Afterpay In-Store</strong><br>
                    Set up the digital Afterpay Card in the Afterpay app before you arrive. Go to the <em>In-store</em> tab and add the card to your phone's digital wallet. At checkout, tap to pay with Apple Pay, Google Pay, or Samsung Pay.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     COMPARISON TABLE
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="compare-heading">
    <div class="taas-container">
        <span class="taas-label">Quick Comparison</span>
        <h2 class="taas-section__title" id="compare-heading">Afterpay vs <span>Other Finance Options</span></h2>
        <p class="taas-section__sub">All four payment options are accepted at Tony Allen Auto Service. Here's how Afterpay compares.</p>

        <div class="taas-table-wrap">
            <table class="taas-table" aria-label="Finance option comparison">
                <thead>
                    <tr>
                        <th>Provider</th>
                        <th>Interest-Free</th>
                        <th>Payments</th>
                        <th>Min. Purchase</th>
                        <th>How to Apply</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-left:3px solid var(--taas-yellow);">
                        <td>Afterpay</td>
                        <td><span class="taas-tick">✓ Always</span></td>
                        <td>4 × fortnightly</td>
                        <td>Subject to spend limit</td>
                        <td>Afterpay app</td>
                    </tr>
                    <tr>
                        <td>QCard</td>
                        <td><span class="taas-tick">✓ Min. 3 months</span></td>
                        <td>Flexible</td>
                        <td>None stated</td>
                        <td>Online (before visit)</td>
                    </tr>
                    <tr>
                        <td>Gem Finance</td>
                        <td><span class="taas-tick">✓ 6 months</span></td>
                        <td>Flexible</td>
                        <td>$250+</td>
                        <td>Online (before visit)</td>
                    </tr>
                    <tr>
                        <td>Aotea Finance</td>
                        <td><span class="taas-dash">— Interest applies</span></td>
                        <td>Agreed schedule</td>
                        <td>None stated</td>
                        <td>Online pre-approval</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="margin-top:16px;font-size:13px;color:#555;">Terms and eligibility subject to each provider's conditions. <a href="<?php echo esc_url($site_url); ?>/finance-options/" style="color:var(--taas-yellow);">View all finance options →</a></p>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     FAQ ACCORDION
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="faq-heading">
    <div class="taas-container">
        <span class="taas-label">Common Questions</span>
        <h2 class="taas-section__title" id="faq-heading">Afterpay at TAAS — <span>Frequently Asked</span></h2>

        <ul class="taas-faq" role="list" style="margin-top:32px;">
            <?php foreach ($faqs as $i => $faq): ?>
            <li class="taas-faq__item">
                <button class="taas-faq__q"
                        id="faq-btn-<?php echo $i; ?>"
                        aria-expanded="false"
                        aria-controls="faq-ans-<?php echo $i; ?>">
                    <?php echo esc_html($faq['q']); ?>
                    <i class="taas-faq__icon" aria-hidden="true">+</i>
                </button>
                <div class="taas-faq__a"
                     id="faq-ans-<?php echo $i; ?>"
                     role="region"
                     aria-labelledby="faq-btn-<?php echo $i; ?>">
                    <p><?php echo wp_kses_post($faq['a']); ?></p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     SERVICE AREA
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="area-heading">
    <div class="taas-container">
        <span class="taas-label">Service Area</span>
        <h2 class="taas-section__title" id="area-heading">Serving South Auckland <span>&amp; Manukau</span></h2>
        <p class="taas-section__sub">Tony Allen Auto Service is located at 139 Cavendish Drive, Manukau. We're the go-to Afterpay mechanic for drivers across South Auckland, including the following areas:</p>

        <ul class="taas-pills" aria-label="Areas served">
            <?php foreach ($service_areas as $area): ?>
            <li>
                <a href="<?php echo esc_url($site_url . '/' . $area[1] . '/'); ?>"
                   style="display:inline-block;background:var(--taas-black);border:1px solid #2a2a2a;color:#999;padding:7px 16px;border-radius:20px;font-size:13px;text-decoration:none;transition:all .15s;"
                   onmouseover="this.style.background='#FFC800';this.style.color='#111';"
                   onmouseout="this.style.background='var(--taas-black)';this.style.color='#999';">
                    Afterpay <?php echo esc_html($area[0]); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <p style="margin-top:20px;font-size:15px;color:#666;">Can't find your suburb? If you can drive to Manukau we can help. Call <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>.</p>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     CONTACT & BOOKING FORM
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" id="book" aria-labelledby="book-heading">
    <div class="taas-container">
        <div class="taas-two-col">
            <div>
                <span class="taas-label">Book Now</span>
                <h2 class="taas-section__title" id="book-heading">Ready to Book? <span>We're Ready.</span></h2>
                <p style="color:#bbb;font-size:17px;line-height:1.75;margin-bottom:24px;">
                    Call us or use the form. Let us know you'd like to pay with Afterpay and we'll have everything ready when you arrive.
                </p>
                <div class="taas-contact-card">
                    <h3>Tony Allen Auto Service</h3>
                    <div class="taas-contact-card__row">
                        <span class="taas-contact-card__label">Address</span>
                        <span class="taas-contact-card__val"><?php echo esc_html($address); ?></span>
                    </div>
                    <div class="taas-contact-card__row">
                        <span class="taas-contact-card__label">Hours</span>
                        <span class="taas-contact-card__val"><?php echo esc_html($hours); ?></span>
                    </div>
                    <div class="taas-contact-card__row">
                        <span class="taas-contact-card__label">Phone</span>
                        <span class="taas-contact-card__val">
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>"><?php echo esc_html($phone_free); ?></a>
                        </span>
                    </div>
                    <div class="taas-contact-card__row">
                        <span class="taas-contact-card__label">Email</span>
                        <span class="taas-contact-card__val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
                    </div>
                    <div class="taas-contact-card__row">
                        <span class="taas-contact-card__label">Payment</span>
                        <span class="taas-contact-card__val">Afterpay, QCard, Gem Finance, Aotea Finance, EFTPOS, Visa, Mastercard</span>
                    </div>
                </div>
            </div>

            <div>
                <?php
                // ── Handle native fallback form submission ────────────────
                $taas_form_sent    = false;
                $taas_form_error   = '';
                $taas_form_nonce   = 'taas_ap_enquiry';

                if ( isset($_POST['taas_ap_submit']) && wp_verify_nonce($_POST['_taas_nonce'] ?? '', $taas_form_nonce) ) {
                    $f_name    = sanitize_text_field($_POST['taas_name']    ?? '');
                    $f_phone   = sanitize_text_field($_POST['taas_phone']   ?? '');
                    $f_email   = sanitize_email($_POST['taas_email']        ?? '');
                    $f_vehicle = sanitize_text_field($_POST['taas_vehicle'] ?? '');
                    $f_msg     = sanitize_textarea_field($_POST['taas_msg'] ?? '');

                    if ( $f_name && $f_phone && $f_msg ) {
                        $to      = $email; // enquiries@taas.co.nz
                        $subject = 'Afterpay Finance Enquiry — ' . $f_name;
                        $body    = "Name: {$f_name}\nPhone: {$f_phone}\nEmail: {$f_email}\nVehicle: {$f_vehicle}\n\nMessage:\n{$f_msg}\n\n(Sent via Afterpay page fallback form)";
                        $headers = ['Content-Type: text/plain; charset=UTF-8'];
                        if ( $f_email ) {
                            $headers[] = 'Reply-To: ' . $f_email;
                        }
                        if ( wp_mail($to, $subject, $body, $headers) ) {
                            $taas_form_sent = true;
                        } else {
                            $taas_form_error = 'Sorry, something went wrong. Please call us on ' . esc_html($phone_free) . '.';
                        }
                    } else {
                        $taas_form_error = 'Please fill in your name, phone number, and a message.';
                    }
                }
                ?>

                <?php if ($cf7_finance): ?>
                    <?php echo do_shortcode($cf7_finance); ?>
                <?php elseif ($taas_form_sent): ?>
                    <div style="background:var(--taas-black);border:1px solid #2a2a2a;border-top:4px solid var(--taas-yellow);border-radius:var(--taas-radius);padding:36px;text-align:center;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--taas-yellow)" stroke-width="2" style="margin-bottom:16px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <h3 style="color:var(--taas-white);font-size:20px;margin-bottom:10px;">Message Sent</h3>
                        <p style="color:#bbb;font-size:16px;line-height:1.6;">Thanks — we'll be in touch shortly. If it's urgent, call us directly on <a href="tel:0800100876" style="color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a>.</p>
                    </div>
                <?php else: ?>
                <!-- Native fallback form — used when TAAS_CF7_FINANCE is not set -->
                <div style="background:var(--taas-black);border:1px solid #2a2a2a;border-top:4px solid var(--taas-yellow);border-radius:var(--taas-radius);padding:28px;">
                    <h3 style="color:var(--taas-white);font-size:18px;margin-bottom:6px;">Send an Enquiry</h3>
                    <p style="color:#888;font-size:14px;margin-bottom:24px;">Use this form or call us directly on <a href="tel:0800100876" style="color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a>.</p>

                    <?php if ($taas_form_error): ?>
                    <p style="color:#ff6b6b;font-size:14px;background:#1a0000;border:1px solid #440000;border-radius:4px;padding:10px 14px;margin-bottom:20px;"><?php echo esc_html($taas_form_error); ?></p>
                    <?php endif; ?>

                    <form method="post" action="<?php echo esc_attr(get_permalink() . '#book'); ?>" novalidate>
                        <?php wp_nonce_field($taas_form_nonce, '_taas_nonce'); ?>
                        <input type="hidden" name="taas_ap_submit" value="1">

                        <p style="margin-bottom:16px;">
                            <label for="taas_name" style="display:block;color:#999;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">Your Name *</label>
                            <input type="text" id="taas_name" name="taas_name" required
                                   value="<?php echo esc_attr($_POST['taas_name'] ?? ''); ?>"
                                   placeholder="e.g. Sarah Johnson"
                                   style="width:100%;background:#1c1c1c;color:#fff;border:1px solid #383838;border-radius:5px;padding:14px 18px;font-size:15px;box-sizing:border-box;">
                        </p>
                        <p style="margin-bottom:16px;">
                            <label for="taas_phone" style="display:block;color:#999;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">Phone Number *</label>
                            <input type="tel" id="taas_phone" name="taas_phone" required
                                   value="<?php echo esc_attr($_POST['taas_phone'] ?? ''); ?>"
                                   placeholder="e.g. 021 123 4567"
                                   style="width:100%;background:#1c1c1c;color:#fff;border:1px solid #383838;border-radius:5px;padding:14px 18px;font-size:15px;box-sizing:border-box;">
                        </p>
                        <p style="margin-bottom:16px;">
                            <label for="taas_email" style="display:block;color:#999;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">Email (optional)</label>
                            <input type="email" id="taas_email" name="taas_email"
                                   value="<?php echo esc_attr($_POST['taas_email'] ?? ''); ?>"
                                   placeholder="e.g. sarah@example.com"
                                   style="width:100%;background:#1c1c1c;color:#fff;border:1px solid #383838;border-radius:5px;padding:14px 18px;font-size:15px;box-sizing:border-box;">
                        </p>
                        <p style="margin-bottom:16px;">
                            <label for="taas_vehicle" style="display:block;color:#999;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">Vehicle (make, model, year)</label>
                            <input type="text" id="taas_vehicle" name="taas_vehicle"
                                   value="<?php echo esc_attr($_POST['taas_vehicle'] ?? ''); ?>"
                                   placeholder="e.g. 2018 Toyota Corolla"
                                   style="width:100%;background:#1c1c1c;color:#fff;border:1px solid #383838;border-radius:5px;padding:14px 18px;font-size:15px;box-sizing:border-box;">
                        </p>
                        <p style="margin-bottom:20px;">
                            <label for="taas_msg" style="display:block;color:#999;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px;">What do you need done? *</label>
                            <textarea id="taas_msg" name="taas_msg" required rows="4"
                                      placeholder="e.g. Need a WOF and full service — want to pay with Afterpay"
                                      style="width:100%;background:#1c1c1c;color:#fff;border:1px solid #383838;border-radius:5px;padding:14px 18px;font-size:15px;box-sizing:border-box;resize:vertical;min-height:110px;"><?php echo esc_textarea($_POST['taas_msg'] ?? ''); ?></textarea>
                        </p>
                        <button type="submit" class="taas-btn taas-btn--primary" style="width:100%;justify-content:center;">
                            Send Enquiry
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     REVIEWS
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section taas-section--alt" aria-labelledby="reviews-heading">
    <div class="taas-container">
        <span class="taas-label">Google Reviews</span>
        <h2 class="taas-section__title" id="reviews-heading">
            Trusted by South Auckland Drivers — <span><?php echo esc_html($years_trading); ?> Years</span>
        </h2>

        <div class="taas-reviews-header">
            <div class="taas-star-score"><?php echo esc_html($google_rating); ?></div>
            <div class="taas-review-meta">
                <strong><span class="taas-stars">★★★★☆</span> Google Rating</strong>
                Based on <?php echo esc_html($google_reviews); ?> verified reviews
            </div>
        </div>

        <?php if ($reviews_widget): ?>
            <?php echo do_shortcode($reviews_widget); ?>
        <?php else: ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">
            <div style="background:var(--taas-black);border:1px solid #252525;border-top:4px solid var(--taas-yellow);border-radius:var(--taas-radius);padding:28px;">
                <p style="color:#fff;font-size:18px;font-weight:700;margin-bottom:10px;">Used Afterpay with us recently?</p>
                <p style="color:#bbb;font-size:16px;line-height:1.7;margin-bottom:20px;">Your feedback helps South Auckland drivers find a trustworthy workshop. Takes less than a minute.</p>
                <a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service/@-36.993,174.879,15z" target="_blank" rel="noopener noreferrer"
                   style="display:inline-flex;align-items:center;gap:10px;background:var(--taas-yellow);color:#111;font-weight:700;font-size:16px;padding:13px 24px;border-radius:var(--taas-radius);text-decoration:none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Leave a Google Review
                </a>
            </div>
            <div style="background:var(--taas-black);border:1px solid #252525;border-radius:var(--taas-radius);padding:28px;">
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:16px;">
                    <div style="background:var(--taas-yellow);color:#111;font-weight:900;font-size:26px;padding:10px 16px;border-radius:var(--taas-radius);line-height:1;"><?php echo esc_html($google_rating); ?></div>
                    <div>
                        <strong style="color:#fff;font-size:17px;display:block;">★★★★☆ Google Rating</strong>
                        <span style="color:#aaa;font-size:14px;">Based on <?php echo esc_html($google_reviews); ?> verified reviews</span>
                    </div>
                </div>
                <p style="color:#bbb;font-size:15px;line-height:1.6;">Tony Allen Auto Service has been serving South Auckland since <?php echo esc_html($established); ?>. Our <?php echo esc_html($google_reviews); ?> Google reviews reflect <?php echo esc_html($years_trading); ?> years of honest, reliable service to the local community.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     OTHER FINANCE OPTIONS
     ════════════════════════════════════════════════════════════════════ -->
<section class="taas-section" aria-labelledby="options-heading">
    <div class="taas-container">
        <span class="taas-label">More Ways to Pay</span>
        <h2 class="taas-section__title" id="options-heading">Other Finance Options <span>at TAAS</span></h2>
        <p class="taas-section__sub">Afterpay isn't the only flexible payment option we accept. If Afterpay doesn't suit your situation, we have three other options available.</p>

        <div class="taas-options">
            <div class="taas-option-card">
                <div class="taas-option-card__name">QCard</div>
                <div class="taas-option-card__desc">Minimum 3 months no payments, no interest on in-store purchases.</div>
            </div>
            <div class="taas-option-card">
                <div class="taas-option-card__name">Gem Finance</div>
                <div class="taas-option-card__desc">Six months interest-free on purchases over $250.</div>
            </div>
            <div class="taas-option-card">
                <div class="taas-option-card__name">Aotea Finance</div>
                <div class="taas-option-card__desc">Flexible personal lending. All circumstances considered.</div>
            </div>
        </div>

        <p style="margin-top:28px;">
            <a href="<?php echo esc_url($site_url); ?>/finance-options/" class="taas-btn taas-btn--outline">View All Finance Options →</a>
        </p>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════════════
     FOOTER CTA
     ════════════════════════════════════════════════════════════════════ -->
<div class="taas-footer-cta">
    <div class="taas-container">
        <h2>Ready to Book Your Repair?</h2>
        <p>Get your vehicle sorted today — split the cost over 6 weeks with Afterpay. Call us on <?php echo esc_html($phone_free); ?> or book online.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="#book" class="taas-btn taas-btn--primary">Book Now</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="taas-btn taas-btn--outline">
                Call <?php echo esc_html($phone_free); ?>
            </a>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════════════════
     DISCLAIMER
     ════════════════════════════════════════════════════════════════════ -->
<div class="taas-disclaimer">
    <div class="taas-container">
        Afterpay is provided by Afterpay NZ Limited. Late fees, eligibility criteria and terms &amp; conditions apply. Credit checks are required for new customers as required by NZ law. Spend limits apply and vary by customer — new customers start with a lower limit. Late fees are capped at 25% of the order total or $68 NZD, whichever is less. Tony Allen Auto Service Ltd is an independent Afterpay merchant — for account enquiries contact Afterpay directly via the app or
        <a href="https://help.afterpay.com/hc/en-nz" target="_blank" rel="noopener noreferrer">Afterpay Help Centre</a>.
        See <a href="https://www.afterpay.com/en-NZ/terms-of-service" target="_blank" rel="noopener noreferrer">afterpay.com/en-NZ</a> for full terms.
    </div>
</div>

</div><!-- /.taas-ap -->

<!-- ════════════════════════════════════════════════════════════════════
     SCHEMA MARKUP — AutoRepair + FAQPage
     ════════════════════════════════════════════════════════════════════ -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": ["AutoRepair","LocalBusiness"],
      "@id": "<?php echo esc_js($site_url); ?>/#organization",
      "name": "Tony Allen Auto Service",
      "alternateName": "TAAS",
      "url": "<?php echo esc_js($site_url); ?>",
      "telephone": "<?php echo esc_js($phone_local); ?>",
      "email": "<?php echo esc_js($email); ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo esc_js($address); ?>",
        "addressLocality": "Manukau",
        "addressRegion": "Auckland",
        "addressCountry": "NZ"
      },
      "openingHours": "Mo-Fr 07:30-17:00",
      "paymentAccepted": "Afterpay, QCard, Gem Finance, Aotea Finance, Cash, EFTPOS, Visa, Mastercard",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo esc_js($google_rating); ?>",
        "reviewCount": "<?php echo esc_js(preg_replace('/[^0-9]/', '', $google_reviews)); ?>",
        "bestRating": "5",
        "worstRating": "1"
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        <?php
        $schema_faqs = [];
        foreach ($faqs as $faq) {
            $schema_faqs[] = '{"@type":"Question","name":' . json_encode($faq['q']) . ',"acceptedAnswer":{"@type":"Answer","text":' . json_encode(wp_strip_all_tags($faq['a'])) . '}}';
        }
        echo implode(",\n        ", $schema_faqs);
        ?>
      ]
    }
  ]
}
</script>

<!-- ════════════════════════════════════════════════════════════════════
     FAQ ACCORDION JS — vanilla, no jQuery dependency
     ════════════════════════════════════════════════════════════════════ -->
<script>
(function () {
    'use strict';
    document.querySelectorAll('.taas-faq__q').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            // Close all
            document.querySelectorAll('.taas-faq__q').forEach(function (b) {
                b.setAttribute('aria-expanded', 'false');
                var ans = document.getElementById(b.getAttribute('aria-controls'));
                if (ans) ans.style.display = 'none';
            });
            // Toggle clicked
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
