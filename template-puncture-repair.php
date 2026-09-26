<?php
/**
 * Template Name: Puncture Repair
 * Template Post Type: page
 *
 * PURPOSE: Puncture repair service page — Manukau.
 *          Conversion-heavy. Distress purchase — calm and reassuring first.
 *          Schema: Service + FAQPage + BreadcrumbList.
 *          URL: /tyre-centre/puncture-repair-manukau/
 *          Parent: /tyre-centre/
 *
 * PRICE: No price displayed — add TAAS_PUNCTURE_PRICE to taas-constants.php
 *        when pricing is confirmed. Placeholder logic is in place.
 *
 * INSTALL:
 *   1. Upload to /wp-content/themes/taas-child/
 *   2. Create page, slug: puncture-repair-manukau, parent: tyre-centre
 *   3. Set template, publish, run launch runner
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$google_rating  = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$google_reviews = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';

// ── Price — add to constants when confirmed ───────────────────────────────────
// define('TAAS_PUNCTURE_PRICE', 'from $XX incl. GST');
$puncture_price = defined('TAAS_PUNCTURE_PRICE') ? TAAS_PUNCTURE_PRICE : null;

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

// ── Content ───────────────────────────────────────────────────────────────────
$trust_signals = [
    ['icon' => '🩹', 'label' => 'Plug & Patch Repairs'],
    ['icon' => '✅', 'label' => 'Honest Assessment — No Upsell'],
    ['icon' => '🏆', 'label' => 'MTA Assured Workshop'],
    ['icon' => '⭐', 'label' => $google_rating . ' Stars · ' . $google_reviews . ' Reviews'],
];

$repairable = [
    'Nail or screw in the tread area — the most common puncture',
    'Small object penetration in the central tread',
    'Slow leak where the tyre is still holding pressure',
    'Tread puncture under 6mm in diameter',
];

$not_repairable = [
    'Sidewall damage — cannot be safely repaired, must be replaced',
    'Shoulder area damage — borderline, assessed case by case',
    'Tyre run flat — internal structure may be damaged even if it looks fine',
    'Large punctures over 6mm — too large for a safe repair',
    'Multiple punctures in close proximity',
    'Tyre with significant wear or existing damage',
];

$process = [
    [
        'step'  => '1',
        'title' => 'Remove & Inspect',
        'desc'  => 'The wheel comes off the vehicle so we can inspect the tyre properly inside and out. What looks like a simple nail can hide internal damage — we check before committing to a repair.',
    ],
    [
        'step'  => '2',
        'title' => 'Assess Repairability',
        'desc'  => 'We check the location, size, and angle of the puncture against industry repair standards. If it\'s not safely repairable, we tell you — no pressure to buy a new tyre from us if you\'d rather shop around.',
    ],
    [
        'step'  => '3',
        'title' => 'Plug & Patch',
        'desc'  => 'If repairable, we carry out a proper plug and patch repair — not just a roadside plug. The plug seals the hole from inside; the patch reinforces the repair. This is the industry-recommended method.',
    ],
    [
        'step'  => '4',
        'title' => 'Refit, Inflate & Balance',
        'desc'  => 'Tyre refitted and inflated to manufacturer spec. We rebalance after repair — a patch adds weight and an unbalanced tyre vibrates. Most tyre shops skip this step.',
    ],
];

$faqs = [
    [
        'q' => 'Can you repair my puncture today?',
        'a' => 'In most cases yes — puncture repairs are usually a same-day or wait-while-you-wait job. Call us on ' . $phone_local . ' before coming in and we\'ll confirm availability. Monday–Friday 7:30am–5:00pm.',
    ],
    [
        'q' => 'How do I know if my tyre can be repaired or needs replacing?',
        'a' => 'The key factors are location and size. A nail or screw in the central tread area is usually repairable. Sidewall damage is not — the sidewall flexes constantly under load and a repair won\'t hold safely. Bring the vehicle in and we\'ll assess it honestly. If it needs replacing, we\'ll tell you and give you pricing — no obligation.',
    ],
    [
        'q' => 'What is the difference between a plug repair and a plug and patch repair?',
        'a' => 'A roadside plug (the string type inserted from outside) is a temporary fix — it seals the hole but doesn\'t reinforce the tyre from inside. A proper plug and patch repair involves removing the tyre from the rim, cleaning the puncture from the inside, and applying both an internal plug and a patch over it. This is the permanent, industry-standard repair. It\'s what we do.',
    ],
    [
        'q' => 'My tyre went flat on the motorway. Can it still be repaired?',
        'a' => 'Possibly — it depends on what happened when it went flat. If you stopped quickly and drove only a short distance on a flat, the internal structure may be intact. If the tyre was driven on while flat for any distance, the sidewall usually delaminates internally and the tyre needs replacing even if it looks fine from outside. Bring it in and we\'ll check.',
    ],
    [
        'q' => 'Do you rebalance the tyre after a puncture repair?',
        'a' => 'Yes. A patch adds weight to the inside of the tyre, which affects balance. We rebalance every tyre after a puncture repair as standard. Most workshops don\'t — it\'s one of the reasons you might feel vibration after a repair done elsewhere.',
    ],
    [
        'q' => 'Can you repair a run-flat tyre?',
        'a' => 'Run-flat tyres are designed to be driven on while flat, but that doesn\'t mean the tyre is undamaged after doing so. Most run-flat tyre manufacturers recommend replacement after the tyre has been run flat, even for a short distance, because internal damage isn\'t always visible. We assess run-flat punctures case by case — if it\'s a simple nail in the tread and the tyre shows no sign of run-flat damage, repair may be possible.',
    ],
];

$suburbs = [
    'Papatoetoe', 'Otara', 'Flat Bush', 'Botany', 'Howick', 'Pakuranga',
    'Mangere', 'Mangere Bridge', 'Otahuhu', 'Manurewa', 'Takanini',
    'Papakura', 'Pukekohe', 'Wiri', 'Māngere East', 'Clover Park',
];

get_header();
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button { font-family: 'Inter', Arial, sans-serif !important; }

.taas-pr *, .taas-pr *::before, .taas-pr *::after { box-sizing: border-box; margin: 0; padding: 0; }
.taas-pr { font-family: 'Inter', Arial, sans-serif; color: #333; -webkit-font-smoothing: antialiased; }
.taas-pr__w { max-width: 1140px; margin: 0 auto; padding: 0 24px; }

/* ── Eyebrow ─────────────────────────────────────────────────────────────── */
.pr-eyebrow {
    display: inline-block; font-size: 11px; font-weight: 700;
    letter-spacing: .12em; text-transform: uppercase;
    padding: 4px 12px; border-radius: 3px; margin-bottom: 16px;
}
.pr-eyebrow--yellow { background: #FFC800; color: #111; }
.pr-eyebrow--dark   { background: #1A1A1A; color: #FFC800; }

/* ── Type ────────────────────────────────────────────────────────────────── */
.pr-h1 {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: clamp(44px, 7vw, 72px); font-weight: 900;
    color: #fff; line-height: 1.0; letter-spacing: -0.01em; margin-bottom: 16px;
}
.pr-h1 em { color: #FFC800; font-style: normal; }
.pr-h2 {
    font-family: 'Oswald', Arial, sans-serif;
    font-size: clamp(28px, 4vw, 44px); font-weight: 900;
    color: #111; line-height: 1.05; margin-bottom: 12px;
}
.pr-h2--white { color: #fff; }
.pr-lead { font-size: 16px; color: #666; line-height: 1.6; max-width: 600px; }

/* ── Buttons ─────────────────────────────────────────────────────────────── */
.pr-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 14px 28px; font-family: 'Inter', Arial, sans-serif;
    font-size: 15px; font-weight: 700; border-radius: 6px;
    text-decoration: none; transition: all .18s ease;
    border: 2px solid transparent; white-space: nowrap; cursor: pointer;
}
.pr-btn--primary { background: #FFC800; color: #1A1A1A; border-color: #FFC800; }
.pr-btn--primary:hover { background: #e6b400; border-color: #e6b400; }
.pr-btn--outline { background: transparent; color: #FFC800; border-color: #FFC800; }
.pr-btn--outline:hover { background: #FFC800; color: #111; }

/* ════════════════════════════════════════════════════════════════════
   HERO
   ════════════════════════════════════════════════════════════════════ */
.pr-hero {
    background: #111; padding: 72px 0 64px;
    position: relative; overflow: hidden;
}
.pr-hero::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(255,200,0,.06) 0%, transparent 70%);
    pointer-events: none;
}
.pr-hero__inner {
    display: grid; grid-template-columns: 1fr auto;
    gap: 32px 48px; align-items: start;
}
.pr-hero__breadcrumb { grid-column: 1/-1; font-size: 13px; color: #555; }
.pr-hero__breadcrumb a { color: #555; text-decoration: none; }
.pr-hero__breadcrumb a:hover { color: #FFC800; }
.pr-hero__breadcrumb span { margin: 0 6px; }
.pr-hero__sub { font-size: 17px; color: #aaa; line-height: 1.6; max-width: 540px; margin-bottom: 28px; }
.pr-hero__btns { display: flex; flex-wrap: wrap; gap: 12px; }

/* Hero card */
.pr-hero__card {
    background: #1a1a1a; border: 1px solid #2a2a2a;
    border-radius: 8px; padding: 24px; min-width: 240px; max-width: 280px;
}
.pr-hero__card h3 {
    font-size: 13px; font-weight: 700; color: #FFC800;
    letter-spacing: .08em; text-transform: uppercase; margin-bottom: 12px;
}
.pr-hero__card ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
.pr-hero__card li { font-size: 13px; color: #ccc; display: flex; align-items: flex-start; gap: 8px; line-height: 1.4; }
.pr-hero__card li::before { content: '✓'; color: #FFC800; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
.pr-hero__phone { margin-top: 20px; padding-top: 20px; border-top: 1px solid #2a2a2a; }
.pr-hero__phone a { display: block; font-size: 20px; font-weight: 800; color: #fff; text-decoration: none; }

/* ════════════════════════════════════════════════════════════════════
   TRUST STRIP
   ════════════════════════════════════════════════════════════════════ */
.pr-trust { background: #FFC800; }
.pr-trust__inner { display: grid; grid-template-columns: repeat(4,1fr); border-left: 1px solid rgba(0,0,0,.1); }
.pr-trust__item { display: flex; align-items: center; gap: 10px; padding: 16px 20px; border-right: 1px solid rgba(0,0,0,.1); }
.pr-trust__icon { font-size: 20px; flex-shrink: 0; }
.pr-trust__label { font-size: 13px; font-weight: 700; color: #111; line-height: 1.3; }

/* ════════════════════════════════════════════════════════════════════
   CAN / CANNOT — White
   ════════════════════════════════════════════════════════════════════ */
.pr-assess { background: #fff; padding: 72px 0; }
.pr-assess__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-top: 40px; }
.pr-assess__block { border-radius: 8px; overflow: hidden; border: 1px solid #E8E8E4; }
.pr-assess__header { padding: 20px 24px; font-family: 'Oswald', Arial, sans-serif; font-size: 20px; font-weight: 900; }
.pr-assess__header--yes { background: #111; color: #FFC800; }
.pr-assess__header--no  { background: #F7F7F5; color: #C0392B; }
.pr-assess__list { list-style: none; padding: 20px 24px; display: flex; flex-direction: column; gap: 12px; }
.pr-assess__item { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: #333; line-height: 1.5; }
.pr-assess__item--yes::before { content: '✓'; color: #27ae60; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
.pr-assess__item--no::before  { content: '✗'; color: #C0392B; font-weight: 700; flex-shrink: 0; margin-top: 1px; }

/* ════════════════════════════════════════════════════════════════════
   PROCESS — Grey
   ════════════════════════════════════════════════════════════════════ */
.pr-process { background: #F7F7F5; padding: 72px 0; }
.pr-process__block { background: #fff; border-radius: 8px; border: 1px solid #E8E8E4; margin-top: 40px; }
.pr-process__header { padding: 28px 28px 20px; border-bottom: 1px solid #E8E8E4; }
.pr-process__header h3 { font-family: 'Oswald', Arial, sans-serif; font-size: 22px; font-weight: 900; color: #111; margin-bottom: 6px; }
.pr-process__header p { font-size: 14px; color: #666; line-height: 1.5; }
.pr-steps { display: grid; grid-template-columns: 1fr 1fr; gap: 24px 40px; padding: 28px; }
.pr-step { display: flex; gap: 16px; align-items: flex-start; }
.pr-step__num {
    width: 32px; height: 32px; background: #FFC800; color: #111;
    font-size: 13px; font-weight: 800; border-radius: 50%;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.pr-step__content h4 { font-size: 14px; font-weight: 700; color: #111; margin-bottom: 4px; }
.pr-step__content p  { font-size: 14px; color: #555; line-height: 1.55; }

/* ════════════════════════════════════════════════════════════════════
   CALLOUT — White
   ════════════════════════════════════════════════════════════════════ */
.pr-callout { background: #fff; padding: 72px 0; border-top: 1px solid #E8E8E4; }
.pr-callout__inner { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
.pr-callout__box { background: #111; border-radius: 8px; padding: 32px; color: #fff; }
.pr-callout__box h3 { font-family: 'Oswald', Arial, sans-serif; font-size: 26px; font-weight: 900; color: #FFC800; margin-bottom: 12px; }
.pr-callout__box p  { font-size: 14px; color: #888; line-height: 1.6; margin-bottom: 20px; }

/* ════════════════════════════════════════════════════════════════════
   REVIEWS — Grey
   ════════════════════════════════════════════════════════════════════ */
.pr-reviews { background: #F7F7F5; padding: 72px 0; }

/* ════════════════════════════════════════════════════════════════════
   CF7 BOOKING — White
   ════════════════════════════════════════════════════════════════════ */
.pr-booking { background: #fff; padding: 72px 0; border-top: 1px solid #E8E8E4; }
.pr-booking__inner { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.pr-booking__checks { list-style: none; display: flex; flex-direction: column; gap: 12px; margin-top: 24px; }
.pr-booking__checks li { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #333; }
.pr-booking__checks li::before { content: '✓'; color: #FFC800; font-weight: 700; font-size: 16px; }
.pr-booking__form { background: #F7F7F5; border-radius: 8px; padding: 32px; border: 1px solid #E8E8E4; }

/* ════════════════════════════════════════════════════════════════════
   CTA — Dark
   ════════════════════════════════════════════════════════════════════ */
.pr-cta { background: #1A1A1A; padding: 72px 0; text-align: center; }
.pr-cta h2 { color: #fff !important; margin-bottom: 12px; }
.pr-cta p { font-size: 16px; color: #888; margin-bottom: 32px; }
.pr-cta__btns { display: flex; justify-content: center; flex-wrap: wrap; gap: 12px; }
.pr-cta__info { margin-top: 24px; font-size: 13px; color: #555; }

/* ════════════════════════════════════════════════════════════════════
   SUBURBS — White
   ════════════════════════════════════════════════════════════════════ */
.pr-suburbs { background: #fff; padding: 56px 0; border-top: 1px solid #E8E8E4; }
.pr-suburbs h2 { font-family: 'Oswald', Arial, sans-serif !important; font-size: 28px !important; font-weight: 900 !important; color: #111 !important; margin-bottom: 20px !important; }
.pr-suburb-pills { display: flex; flex-wrap: wrap; gap: 8px; }
.pr-suburb-pill {
    display: inline-block; padding: 6px 14px; background: #F7F7F5;
    border: 1px solid #E8E8E4; border-radius: 100px;
    font-size: 13px; font-weight: 500; color: #333;
    text-decoration: none; transition: all .15s ease;
}
.pr-suburb-pill:hover { background: #FFC800; border-color: #FFC800; color: #111; }

/* ════════════════════════════════════════════════════════════════════
   FAQ — White
   ════════════════════════════════════════════════════════════════════ */
.pr-faq { background: #fff; padding: 72px 0; border-top: 1px solid #E8E8E4; }
.pr-faq__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 48px; margin-top: 32px; }
.pr-faq__item { border-bottom: 1px solid #E8E8E4; }
.pr-faq__q {
    width: 100%; text-align: left; background: none; border: none;
    padding: 18px 36px 18px 0; font-family: 'Inter', Arial, sans-serif;
    font-size: 15px; font-weight: 700; color: #111;
    cursor: pointer; position: relative; line-height: 1.4; -webkit-font-smoothing: antialiased;
}
.pr-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 300; color: #FFC800; }
.pr-faq__q[aria-expanded="true"]::after { content: '−'; }
.pr-faq__a { display: none; padding: 0 0 18px; font-size: 14px; color: #555; line-height: 1.7; }

/* ════════════════════════════════════════════════════════════════════
   RESPONSIVE
   ════════════════════════════════════════════════════════════════════ */
@media (max-width: 900px) {
    .pr-hero__inner    { grid-template-columns: 1fr; }
    .pr-hero__card     { display: none; }
    .pr-trust__inner   { grid-template-columns: 1fr 1fr; }
    .pr-assess__grid   { grid-template-columns: 1fr; }
    .pr-steps          { grid-template-columns: 1fr; }
    .pr-callout__inner { grid-template-columns: 1fr; }
    .pr-booking__inner { grid-template-columns: 1fr; }
    .pr-faq__grid      { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .pr-hero, .pr-assess, .pr-process, .pr-callout,
    .pr-reviews, .pr-booking, .pr-cta, .pr-faq { padding: 48px 0; }
    .pr-trust__inner { grid-template-columns: 1fr 1fr; }
}
</style>

<div class="taas-pr">

<!-- ── HERO ──────────────────────────────────────────────────────────────────── -->
<section class="pr-hero">
    <div class="taas-pr__w">
        <div class="pr-hero__inner">

            <nav class="pr-hero__breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>Puncture Repair</span>
            </nav>

            <div>
                <span class="pr-eyebrow pr-eyebrow--yellow">Tyre Centre — Manukau</span>
                <h1 class="pr-h1">
                    Puncture Repair<br>
                    <em>Manukau</em>
                </h1>
                <p class="pr-hero__sub">
                    Nail in the tread? Slow leak you can't find? We assess every puncture honestly —
                    proper plug and patch repair if it's fixable, straight talk if it's not.
                    Rebalanced after every repair as standard.
                </p>
                <?php if ($puncture_price): ?>
                <div style="display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:6px;padding:10px 18px;font-size:14px;font-weight:600;color:#FFC800;margin-bottom:28px;">
                    Puncture repair <?php echo esc_html($puncture_price); ?>
                </div>
                <?php endif; ?>
                <div class="pr-hero__btns">
                    <a href="#pr-booking" class="pr-btn pr-btn--primary">Book a Repair</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>" class="pr-btn pr-btn--outline">
                        <?php echo esc_html($phone_local); ?>
                    </a>
                </div>
            </div>

            <div class="pr-hero__card">
                <h3>What We Do</h3>
                <ul>
                    <li>Honest repairability assessment</li>
                    <li>Full plug &amp; patch repair</li>
                    <li>Tyre removed for proper inspection</li>
                    <li>Rebalanced after every repair</li>
                    <li>All vehicle types</li>
                    <li>Same-day in most cases</li>
                </ul>
                <div class="pr-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call direct</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>">
                        <?php echo esc_html($phone_local); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" style="font-size:15px;color:#888;margin-top:4px;font-weight:600;display:block;">
                        <?php echo esc_html($phone_free); ?>
                    </a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ── TRUST STRIP ─────────────────────────────────────────────────────────── -->
<div class="pr-trust" role="list" aria-label="Trust signals">
    <div class="taas-pr__w">
        <div class="pr-trust__inner">
            <?php foreach ($trust_signals as $ts): ?>
            <div class="pr-trust__item" role="listitem">
                <span class="pr-trust__icon" aria-hidden="true"><?php echo $ts['icon']; ?></span>
                <span class="pr-trust__label"><?php echo esc_html($ts['label']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- ── CAN / CANNOT — White ──────────────────────────────────────────────── -->
<section class="pr-assess" aria-labelledby="pr-assess-h2">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--dark">Repairability</span>
        <h2 class="pr-h2" id="pr-assess-h2">Can Your Puncture Be Repaired?</h2>
        <p class="pr-lead">Not every puncture is repairable — and we won't tell you it is if it isn't. Here's what determines whether a repair is safe.</p>
        <div class="pr-assess__grid">
            <div class="pr-assess__block">
                <div class="pr-assess__header pr-assess__header--yes">✓ Usually Repairable</div>
                <ul class="pr-assess__list">
                    <?php foreach ($repairable as $item): ?>
                    <li class="pr-assess__item pr-assess__item--yes"><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="pr-assess__block">
                <div class="pr-assess__header pr-assess__header--no">✗ Not Repairable</div>
                <ul class="pr-assess__list">
                    <?php foreach ($not_repairable as $item): ?>
                    <li class="pr-assess__item pr-assess__item--no"><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <p style="margin-top:20px;font-size:14px;color:#666;font-style:italic;">
            Not sure? Bring it in. We assess every tyre at no charge before committing to a repair or replacement.
        </p>
    </div>
</section>


<!-- ── PROCESS — Grey ────────────────────────────────────────────────────── -->
<section class="pr-process" aria-labelledby="pr-process-h2">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--dark">Our Process</span>
        <h2 class="pr-h2" id="pr-process-h2">How We Repair a Puncture</h2>
        <p class="pr-lead">A proper repair — not a roadside plug. The industry-standard method, done right.</p>
        <div class="pr-process__block">
            <div class="pr-process__header">
                <h3>Plug &amp; Patch Repair — The Right Way</h3>
                <p>The tyre comes off the rim for a proper internal inspection and repair — not a string plug pushed in from outside. This is the permanent, safe method.</p>
            </div>
            <div class="pr-steps">
                <?php foreach ($process as $step): ?>
                <div class="pr-step">
                    <div class="pr-step__num"><?php echo esc_html($step['step']); ?></div>
                    <div class="pr-step__content">
                        <h4><?php echo esc_html($step['title']); ?></h4>
                        <p><?php echo esc_html($step['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<!-- ── CALLOUT — White ───────────────────────────────────────────────────── -->
<section class="pr-callout" aria-label="Why rebalance after repair">
    <div class="taas-pr__w">
        <div class="pr-callout__inner">
            <div>
                <span class="pr-eyebrow pr-eyebrow--dark">Most Shops Skip This</span>
                <h2 class="pr-h2">We Rebalance After Every Repair</h2>
                <p class="pr-lead" style="margin-bottom:20px;">
                    A puncture patch adds weight inside the tyre. If the tyre isn't rebalanced after repair, you'll feel vibration — especially at highway speed.
                </p>
                <p style="font-size:15px;color:#333;line-height:1.6;">
                    Most workshops repair the puncture, refit the tyre, and send you on your way. We put every repaired tyre back on the balancer before it goes back on the vehicle. It takes a few extra minutes. You shouldn't have to come back because of vibration from a repair we did.
                </p>
            </div>
            <div class="pr-callout__box">
                <h3>Need a New Tyre Instead?</h3>
                <p>If the puncture isn't repairable, we'll tell you straight and give you pricing on a replacement. We stock budget through premium brands and can fit and balance a replacement on the same visit.</p>
                <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="pr-btn pr-btn--primary">Tyre Centre →</a>
            </div>
        </div>
    </div>
</section>


<!-- ── REVIEWS — Grey ────────────────────────────────────────────────────── -->
<section class="pr-reviews" aria-labelledby="pr-reviews-h2">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--dark">Customer Reviews</span>
        <h2 class="pr-h2" id="pr-reviews-h2">
            <?php echo esc_html($google_reviews); ?> Reviews · <?php echo esc_html($google_rating); ?>★ on Google
        </h2>
        <p class="pr-lead" style="margin-bottom:32px;">South Auckland's trusted independent workshop since <?php echo esc_html($established); ?>.</p>
        <?php if ($reviews_widget): ?>
            <?php echo do_shortcode($reviews_widget); ?>
        <?php else: ?>
        <p style="color:#666;font-size:15px;">
            <a href="https://www.google.com/maps/place/Tony+Allen+Auto+Service" target="_blank" rel="noopener" style="color:#111;font-weight:700;">See our Google reviews →</a>
        </p>
        <?php endif; ?>
    </div>
</section>


<!-- ── CF7 BOOKING — White ───────────────────────────────────────────────── -->
<section class="pr-booking" id="pr-booking" aria-labelledby="pr-booking-h2">
    <div class="taas-pr__w">
        <div class="pr-booking__inner">
            <div>
                <span class="pr-eyebrow pr-eyebrow--dark">Book Online</span>
                <h2 class="pr-h2" id="pr-booking-h2">Book a Puncture Repair</h2>
                <p class="pr-lead">
                    Send us your details and we'll confirm availability. Most puncture repairs are same-day.
                    Or call us directly on <?php echo esc_html($phone_local); ?>.
                </p>
                <ul class="pr-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>Same-day in most cases</li>
                    <li>Rebalanced after every repair</li>
                    <li>We confirm within 1 business hour</li>
                </ul>
            </div>
            <div class="pr-booking__form">
                <?php if ($cf7_general): ?>
                    <?php echo do_shortcode($cf7_general); ?>
                <?php else: ?>
                    <p style="font-size:14px;color:#666;">
                        <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<!-- ── CTA — Dark ───────────────────────────────────────────────────────── -->
<section class="pr-cta" aria-labelledby="pr-cta-h2">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--yellow">Ready?</span>
        <h2 class="pr-h2" id="pr-cta-h2">Get Your Puncture Fixed Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="pr-cta__btns">
            <a href="#pr-booking" class="pr-btn pr-btn--primary">Book Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_free)); ?>" class="pr-btn pr-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_local)); ?>" class="pr-btn pr-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="pr-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>


<!-- ── SUBURBS ───────────────────────────────────────────────────────────── -->
<section class="pr-suburbs" aria-label="Areas served">
    <div class="taas-pr__w">
        <h2>Puncture Repairs Near You — South Auckland</h2>
        <div class="pr-suburb-pills">
            <?php foreach ($suburbs as $suburb): ?>
            <span class="pr-suburb-pill"><?php echo esc_html($suburb); ?></span>
            <?php endforeach; ?>
            <span class="pr-suburb-pill" style="background:#111;color:#FFC800;border-color:#111;">+ More</span>
        </div>
        <p style="margin-top:20px;font-size:14px;color:#666;">Based at 139 Cavendish Drive, Manukau — easy access from the southern motorway.</p>
    </div>
</section>


<!-- ── FAQ ──────────────────────────────────────────────────────────────── -->
<section class="pr-faq" aria-labelledby="pr-faq-h2">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--dark">FAQ</span>
        <h2 class="pr-h2" id="pr-faq-h2">Common Questions</h2>
        <div class="pr-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid = 'pr-faq-q-' . $i;
                $aid = 'pr-faq-a-' . $i;
            ?>
            <div class="pr-faq__item">
                <button id="<?php echo $qid; ?>" class="pr-faq__q"
                    aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                    aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="pr-faq__a"
                    role="region" aria-labelledby="<?php echo $qid; ?>"
                    style="<?php echo $i === 0 ? 'display:block;' : ''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ── RELATED ───────────────────────────────────────────────────────────── -->
<section style="background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;" aria-label="Related services">
    <div class="taas-pr__w">
        <span class="pr-eyebrow pr-eyebrow--dark">Related Services</span>
        <h2 class="pr-h2" style="margin-bottom:24px;">Tyre Centre Services</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
            <?php
            $related = [
                ['label' => 'Tyre Centre',        'url' => '/tyre-centre/'],
                ['label' => 'Tyre Fitting',        'url' => '/tyre-fitting-manukau/'],
                ['label' => 'Wheel Balancing',     'url' => '/wheel-balancing-manukau/'],
                ['label' => 'Wheel Alignment',     'url' => '/wheel-alignment-manukau/'],
            ];
            foreach ($related as $r):
            ?>
            <a href="<?php echo esc_url($site_url . $r['url']); ?>"
               style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:all .15s ease;"
               onmouseover="this.style.borderColor='#FFC800'"
               onmouseout="this.style.borderColor='#E8E8E4'">
                <?php echo esc_html($r['label']); ?>
                <span style="color:#FFC800;font-size:18px;">→</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</div><!-- /.taas-pr -->


<!-- ── SCHEMA ────────────────────────────────────────────────────────────── -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},
        {"@type":"ListItem","position":2,"name":"Tyre Centre","item":"<?php echo esc_js($site_url . '/tyre-centre/'); ?>"},
        {"@type":"ListItem","position":3,"name":"Puncture Repair Manukau","item":"<?php echo esc_js($page_url); ?>"}
      ]
    },
    {
      "@type": "Service",
      "@id": "<?php echo esc_js($page_url); ?>#service",
      "name": "Puncture Repair Manukau",
      "description": "Professional plug and patch puncture repairs at Tony Allen Auto Service, 139 Cavendish Drive, Manukau. Honest repairability assessment. Rebalanced after every repair. Same-day in most cases.",
      "serviceType": "Puncture Repair",
      "provider": {
        "@type": "AutoRepair",
        "@id": "<?php echo esc_js($site_url); ?>/#organization",
        "name": "Tony Allen Auto Service",
        "url": "<?php echo esc_js($site_url); ?>",
        "telephone": "<?php echo esc_js($phone_local); ?>",
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
          "ratingValue": "<?php echo esc_js($google_rating); ?>",
          "reviewCount": "<?php echo esc_js(preg_replace('/[^0-9]/', '', $google_reviews)); ?>",
          "bestRating": "5", "worstRating": "1"
        },
        "foundingDate": "<?php echo esc_js($established); ?>",
        "memberOf": {"@type":"Organization","name":"MTA New Zealand"}
      },
      "areaServed": [
        {"@type":"City","name":"Manukau"},{"@type":"City","name":"Papatoetoe"},
        {"@type":"City","name":"Mangere"},{"@type":"City","name":"South Auckland"}
      ]
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

<!-- ── FAQ JS ─────────────────────────────────────────────────────────────── -->
<script>
(function(){
    document.querySelectorAll('.pr-faq__q').forEach(function(btn){
        btn.addEventListener('click', function(){
            var expanded = this.getAttribute('aria-expanded') === 'true';
            document.querySelectorAll('.pr-faq__q').forEach(function(b){
                b.setAttribute('aria-expanded','false');
                var a = document.getElementById(b.getAttribute('aria-controls'));
                if(a) a.style.display='none';
            });
            if(!expanded){
                this.setAttribute('aria-expanded','true');
                var ans = document.getElementById(this.getAttribute('aria-controls'));
                if(ans) ans.style.display='block';
            }
        });
    });
}());
</script>

<?php get_footer(); ?>
