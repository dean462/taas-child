<?php
/**
 * Template Name: Contact Us
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz/contact-us/
 * Go-Live Standard: 21 June 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. WP Admin → Pages → Contact Us → Template → "Contact Us"
 * 3. Purge Cloudflare cache
 */

// ── Load shared files ────────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';

$phone_local    = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')        ? TAAS_ADDRESS        : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7            = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '[contact-form-7 id="e31b60d" title="General Enquiry"]';
$divisions      = defined('TAAS_DIVISIONS')      ? TAAS_DIVISIONS      : 'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';

$site_url       = get_site_url();
$page_url       = get_permalink();
$years          = date('Y') - intval($established);
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Hero image ───────────────────────────────────────────────────────────────
$hero_img = defined('TAAS_HERO_CONTACT') && TAAS_HERO_CONTACT
    ? esc_url(get_site_url() . TAAS_HERO_CONTACT)
    : esc_url(get_site_url() . '/wp-content/uploads/2026/06/hero-contact.webp');

// ── FAQs from shared library ─────────────────────────────────────────────────
$faqs = [
    $taas_faqs['contact_booking'],
    $taas_faqs['contact_response_time'],
    $taas_faqs['contact_location'],
    $taas_faqs['contact_loan_cars'],
    $taas_faqs['contact_estimate'],
    $taas_faqs['contact_parking'],
    $taas_faqs['contact_payment'],
    $taas_faqs['contact_dropoff'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = [
        '@type'          => 'Question',
        'name'           => $faq['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($faq['a'])],
    ];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'         => ['AutoRepair', 'LocalBusiness'],
            '@id'           => $site_url . '/#organization',
            'name'          => 'Tony Allen Auto Service',
            'alternateName' => 'TAAS',
            'url'           => $site_url,
            'telephone'     => [$phone_local, $phone_free],
            'email'         => $email,
            'foundingDate'  => '1985-10',
            'address'       => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
            'geo'           => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
            'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']],
            'sameAs'        => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'],
            'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/[^0-9]/', '', $reviews), 'bestRating' => '5', 'worstRating' => '1'],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance',
            'memberOf'      => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        [
            '@type'       => 'ContactPage',
            'url'         => $page_url,
            'name'        => 'Contact Tony Allen Auto Service — Manukau',
            'description' => 'Contact TAAS to book a vehicle service, WOF, or ask about repairs. Located at 139 Cavendish Drive, Manukau, South Auckland.',
            'mainEntity'  => ['@type' => 'AutoRepair', '@id' => $site_url . '/#organization'],
        ],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact Us', 'item' => $page_url],
        ]],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-cu">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════ */
.page-template-template-contact-us .site-content,
.page-template-template-contact-us .entry-content,
.page-template-template-contact-us .entry-header,
.page-template-template-contact-us article,
.page-template-template-contact-us #primary,
.page-template-template-contact-us #content {
  padding:0!important; margin:0!important; max-width:100%!important;
}
.taas-cu *, .taas-cu *::before, .taas-cu *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-cu {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  color:var(--taas-body, #333333);
  -webkit-font-smoothing:antialiased;
  -webkit-text-size-adjust:100%;
  text-size-adjust:100%;
  overflow-x:hidden;
}
.taas-cu a { text-decoration:none; color:inherit; }
.taas-cu .w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ═══════════════════════════════════════════════════════ */
.cu-breadcrumb { background:#1A1A1A; padding:14px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.cu-breadcrumb__inner { display:flex; align-items:center; gap:8px; font-size:12px; font-weight:400; color:#666; }
.cu-breadcrumb__inner a { color:#888; transition:color .15s; }
.cu-breadcrumb__inner a:hover { color:var(--taas-yellow, #FFC800); }
.cu-breadcrumb__sep { color:#444; }

/* ══ HERO ═════════════════════════════════════════════════════════════ */
.cu-hero {
  background:var(--taas-black, #111111);
  border-bottom:3px solid var(--taas-yellow, #FFC800);
  padding:72px 0 60px;
  position:relative;
  overflow:hidden;
  text-align:center;
}
.cu-hero__bg {
  position:absolute; inset:0; z-index:0;
  background:url('<?php echo $hero_img; ?>') center 35% / cover no-repeat;
}
.cu-hero__bg::after {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,0.82);
}
.cu-hero .w { position:relative; z-index:1; }
.cu-eye {
  display:inline-block; background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A);
  font-size:10px; font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; padding:4px 12px; border-radius:3px;
  margin-bottom:20px;
}
.cu-hero h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:clamp(34px, 5.5vw, 54px);
  font-weight:800; color:#fff;
  line-height:1.1;
  letter-spacing:-0.02em; margin-bottom:18px;
}
.cu-hero h1 span { color:var(--taas-yellow, #FFC800); }
.cu-hero__sub {
  font-size:16px; font-weight:300; color:#999;
  max-width:500px; margin:0 auto 28px;
  line-height:1.75;
}
.cu-trust {
  display:flex; justify-content:center;
  flex-wrap:wrap; gap:10px 28px; margin-top:24px;
}
.cu-trust__item {
  display:flex; align-items:center; gap:7px;
  font-size:13px; color:#999; font-weight:600;
}
.cu-trust__item svg { width:14px; height:14px; fill:var(--taas-yellow, #FFC800); flex-shrink:0; }
.cu-trust__item img { flex-shrink:0; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════ */
.cu-strip { background:var(--taas-yellow, #FFC800); padding:18px 0; }
.cu-strip__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.cu-strip__item { font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); }

/* ══ BODY ═════════════════════════════════════════════════════════════ */
.cu-body { padding:var(--taas-sec-pad, 72px) 0; background:#fff; }
.cu-grid {
  display:grid;
  grid-template-columns:1fr 380px;
  gap:48px; align-items:start;
}

/* ══ FORM PANEL ═══════════════════════════════════════════════════════ */
.cu-form-panel {
  background:var(--taas-panel, #F7F7F5);
  border:1px solid var(--taas-border, #E8E8E4);
  border-top:4px solid var(--taas-yellow, #FFC800);
  border-radius:var(--taas-radius, 6px);
  padding:40px;
}
.cu-form-panel h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:22px; font-weight:800;
  color:#1A1A1A; text-transform:uppercase;
  letter-spacing:.06em; margin-bottom:6px;
}
.cu-form-panel__sub { font-size:14px; font-weight:300; color:#666; line-height:1.75; margin-bottom:32px; }

/* CF7 overrides — light theme */
.taas-cu .wpcf7 label {
  display:block!important; font-size:13px!important;
  font-weight:700!important; color:#666!important;
  margin-bottom:7px!important; letter-spacing:.01em!important;
  text-transform:uppercase!important;
}
.taas-cu .wpcf7 input[type="text"],
.taas-cu .wpcf7 input[type="email"],
.taas-cu .wpcf7 input[type="tel"],
.taas-cu .wpcf7 input[type="date"],
.taas-cu .wpcf7 select,
.taas-cu .wpcf7 textarea {
  width:100%!important;
  padding:14px 16px!important;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important;
  font-size:15px!important; font-weight:300!important;
  color:#1A1A1A!important;
  background:#fff!important;
  border:1px solid var(--taas-border, #E8E8E4)!important;
  border-radius:var(--taas-radius, 6px)!important;
  box-sizing:border-box!important;
  transition:border-color .15s!important;
  -webkit-appearance:none!important;
  height:auto!important;
}
.taas-cu .wpcf7 input[type="text"]:focus,
.taas-cu .wpcf7 input[type="email"]:focus,
.taas-cu .wpcf7 input[type="tel"]:focus,
.taas-cu .wpcf7 select:focus,
.taas-cu .wpcf7 textarea:focus {
  outline:none!important;
  border-color:var(--taas-yellow, #FFC800)!important;
  box-shadow:0 0 0 3px rgba(255,200,0,.12)!important;
}
.taas-cu .wpcf7 input::placeholder,
.taas-cu .wpcf7 textarea::placeholder { color:#aaa!important; }
.taas-cu .wpcf7 textarea { min-height:140px!important; resize:vertical!important; }
.taas-cu .taas-cf7-row { display:grid!important; grid-template-columns:1fr 1fr!important; gap:16px!important; margin-bottom:16px!important; }
.taas-cu .taas-cf7-col { display:flex!important; flex-direction:column!important; }
.taas-cu .taas-cf7-field { margin-bottom:16px!important; }
.taas-cu .wpcf7 input.taas-cf7-submit {
  background:var(--taas-yellow, #FFC800)!important; color:#1A1A1A!important;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important; font-size:14px!important;
  font-weight:800!important; letter-spacing:.07em!important;
  text-transform:uppercase!important; padding:16px 32px!important;
  border:none!important; border-radius:var(--taas-radius, 6px)!important;
  cursor:pointer!important; margin-top:8px!important;
  width:auto!important; height:auto!important;
  transition:background .15s!important;
}
.taas-cu .wpcf7 input.taas-cf7-submit:hover { background:var(--taas-yellow2, #e6b400)!important; }
.taas-cu .wpcf7 .wpcf7-not-valid { border-color:var(--taas-alert, #C0392B)!important; }
.taas-cu .wpcf7 .wpcf7-not-valid-tip { font-size:12px!important; color:var(--taas-alert, #C0392B)!important; margin-top:4px!important; display:block!important; }
.taas-cu .wpcf7 .wpcf7-response-output { margin-top:16px!important; padding:14px 18px!important; font-size:14px!important; border-radius:var(--taas-radius, 6px)!important; border:none!important; font-weight:600!important; }
.taas-cu .wpcf7 .wpcf7-mail-sent-ok { background:#1a3a2a!important; color:#4caf7d!important; }
.taas-cu .wpcf7 .wpcf7-validation-errors { background:#3a1a1a!important; color:#e57373!important; }

/* ══ SIDEBAR ═════════════════════════════════════════════════════════ */
.cu-sidebar { display:flex; flex-direction:column; gap:20px; }
.cu-info-card {
  background:var(--taas-panel, #F7F7F5);
  border:1px solid var(--taas-border, #E8E8E4);
  border-top:3px solid var(--taas-yellow, #FFC800);
  border-radius:var(--taas-radius, 6px);
  padding:28px;
}
.cu-info-card h3 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:14px; font-weight:800;
  color:#1A1A1A; text-transform:uppercase;
  letter-spacing:.12em; margin-bottom:20px;
}
.cu-info-row {
  display:flex; align-items:flex-start; gap:14px;
  padding:14px 0; border-bottom:1px solid var(--taas-border, #E8E8E4);
}
.cu-info-row:last-child { border-bottom:none; padding-bottom:0; }
.cu-info-icon {
  width:36px; height:36px; flex-shrink:0;
  background:rgba(255,200,0,.1); border:1px solid rgba(255,200,0,.2);
  border-radius:var(--taas-radius, 6px);
  display:flex; align-items:center; justify-content:center;
}
.cu-info-icon svg { width:16px; height:16px; fill:var(--taas-yellow, #FFC800); }
.cu-info-lbl { font-size:11px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#999; display:block; margin-bottom:3px; }
.cu-info-val { font-size:14px; font-weight:300; color:#1A1A1A; line-height:1.75; }
.cu-info-val a { color:#1A1A1A; }
.cu-info-val a:hover { color:var(--taas-yellow, #FFC800); }

/* What happens next */
.cu-next-card {
  background:var(--taas-panel, #F7F7F5);
  border:1px solid var(--taas-border, #E8E8E4);
  border-radius:var(--taas-radius, 6px);
  padding:28px;
}
.cu-next-card h3 {
  font-size:14px; font-weight:700; letter-spacing:.1em;
  text-transform:uppercase; color:#1A1A1A; margin-bottom:20px;
}
.cu-step { display:flex; gap:14px; margin-bottom:18px; }
.cu-step:last-child { margin-bottom:0; }
.cu-step__num {
  width:28px; height:28px; flex-shrink:0;
  background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A);
  border-radius:50%; display:flex; align-items:center;
  justify-content:center; font-size:13px; font-weight:900;
  margin-top:1px;
}
.cu-step__text { font-size:13px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; }
.cu-step__text strong { color:#1A1A1A; display:block; margin-bottom:3px; font-size:14px; font-weight:600; }

/* Map */
.cu-map { border-radius:var(--taas-radius, 6px); overflow:hidden; }
.cu-map iframe { width:100%; height:220px; border:0; display:block; filter:grayscale(30%); }

/* ══ WHY SECTION ══════════════════════════════════════════════════════ */
.cu-why { background:var(--taas-panel, #F7F7F5); border-top:1px solid var(--taas-border, #E8E8E4); padding:64px 0; }
.cu-why h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:clamp(22px,2.5vw,32px);
  font-weight:800; color:#1A1A1A;
  text-transform:uppercase; text-align:center;
  letter-spacing:.04em; margin-bottom:8px;
}
.cu-why__sub { text-align:center; color:var(--taas-mid, #666); font-size:15px; font-weight:300; margin-bottom:44px; }
.cu-why-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
.cu-why-item {
  background:#fff; border:1px solid var(--taas-border, #E8E8E4);
  border-top:3px solid var(--taas-yellow, #FFC800);
  padding:28px 24px; border-radius:var(--taas-radius, 6px);
  text-align:center;
}
.cu-why-item svg { width:36px; height:36px; fill:var(--taas-yellow, #FFC800); margin-bottom:16px; }
.cu-why-item h3 { font-size:16px; font-weight:800; color:#1A1A1A; margin-bottom:10px; }
.cu-why-item p { font-size:14px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; }

/* ══ REVIEWS ══════════════════════════════════════════════════════════ */
.cu-reviews { background:#fff; padding:64px 0; border-top:1px solid var(--taas-border, #E8E8E4); }
.cu-reviews h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:clamp(22px,2.5vw,32px);
  font-weight:800; color:#1A1A1A;
  text-transform:uppercase; text-align:center;
  letter-spacing:.04em; margin-bottom:36px;
}

/* ══ FAQ ══════════════════════════════════════════════════════════════ */
.cu-faq { padding:var(--taas-sec-pad, 72px) 0; background:#fff; }
.cu-sh { text-align:center; margin-bottom:48px; }
.cu-h2 { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700; color:var(--taas-black, #111); letter-spacing:-0.01em; margin:12px 0 8px; }
.cu-h2 span { color:var(--taas-yellow, #FFC800); }
.cu-sh__sub { font-size:16px; font-weight:300; color:var(--taas-mid, #666); margin-top:8px; }
.cu-eye--border { border:1px solid var(--taas-border, #E8E8E4); color:var(--taas-mid, #666); background:transparent; }
.cu-faq-list { max-width:780px; margin:0 auto; }
.cu-faq-item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.cu-faq-item:first-child { border-top:1px solid var(--taas-border, #E8E8E4); }
.cu-faq-q { width:100%; text-align:left; background:none; border:none; padding:18px 40px 18px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:15px; font-weight:700; color:#1A1A1A; cursor:pointer; position:relative; line-height:1.4; }
.cu-faq-q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:300; color:var(--taas-yellow, #FFC800); transition:transform .2s; }
.cu-faq-item.is-open .cu-faq-q::after { content:'−'; }
.cu-faq-a { display:none; padding:0 40px 20px 0; }
.cu-faq-item.is-open .cu-faq-a { display:block; }
.cu-faq-a p { font-size:15px; font-weight:300; color:var(--taas-mid, #666); line-height:1.75; margin:0; }
.cu-faq-a a { color:var(--taas-yellow, #FFC800); font-weight:600; text-decoration:none; }
.cu-faq-a a:hover { text-decoration:underline; }

/* ══ CTA BAND ════════════════════════════════════════════════════════ */
.cu-cta { background:var(--taas-dark, #1A1A1A); border-top:1px solid var(--taas-border, #E8E8E4); padding:var(--taas-sec-pad, 72px) 0; text-align:center; }
.cu-cta h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px));
  font-weight:700; color:#fff;
  text-transform:uppercase; margin-bottom:10px;
}
.cu-cta h2 span { color:var(--taas-yellow, #FFC800); }
.cu-cta p { color:var(--taas-mid, #666); font-size:15px; font-weight:300; margin-bottom:28px; }
.cu-cta__btns { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; }
.cu-btn {
  display:inline-flex; align-items:center; gap:9px;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-weight:700; font-size:14px;
  letter-spacing:.04em; text-transform:uppercase;
  padding:14px 26px; border-radius:var(--taas-radius, 6px);
  transition:all .18s; cursor:pointer;
}
.cu-btn--yellow { background:var(--taas-yellow, #FFC800); color:#1A1A1A!important; }
.cu-btn--yellow:hover { background:var(--taas-yellow2, #e6b400); color:#1A1A1A!important; transform:translateY(-1px); }
.cu-btn--outline { background:transparent; color:var(--taas-yellow, #FFC800)!important; border:2px solid var(--taas-yellow, #FFC800); }
.cu-btn--outline:hover { background:var(--taas-yellow, #FFC800); color:#1A1A1A!important; }
.cu-cta__phone { color:var(--taas-yellow, #FFC800)!important; font-family:var(--taas-font, 'Inter', Arial, sans-serif)!important; font-size:32px!important; font-weight:900!important; text-decoration:none!important; display:block!important; margin-bottom:20px!important; }
.cu-cta__phone:hover { opacity:.7; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════ */
@media (max-width:900px) {
  .cu-grid { grid-template-columns:1fr; }
  .cu-why-grid { grid-template-columns:1fr; gap:16px; }
}
@media (max-width:640px) {
  .taas-cu .taas-cf7-row { grid-template-columns:1fr!important; }
  .cu-form-panel { padding:28px 20px; }
  .cu-hero { padding:48px 0 40px; }
  .cu-hero h1 { font-size:clamp(26px, 7vw, 38px); }
  .cu-hero__sub { font-size:14px; }
  .cu-body { padding:48px 0; }
  .cu-why { padding:48px 0; }
  .cu-faq { padding:48px 0; }
  .cu-cta { padding:48px 0; }
  .cu-btn { font-size:13px; padding:12px 20px; }
  .cu-cta h2 { font-size:clamp(24px, 6vw, 36px); }
  .cu-cta__btns { flex-direction:column; align-items:stretch; }
  .cu-cta__btns .cu-btn { justify-content:center; text-align:center; }
  .cu-cta__phone { font-size:28px!important; }
  .cu-h2 { font-size:clamp(22px, 6vw, 32px); }
  .cu-faq-q { font-size:14px; padding:16px 32px 16px 0; }
  .cu-faq-a p { font-size:13px; }
  .cu-sh { margin-bottom:32px; }
  .cu-trust { flex-direction:column; gap:8px; align-items:center; }
  .cu-trust__item { font-size:12px; }
  .cu-info-card { padding:20px; }
  .cu-next-card { padding:20px; }
  .cu-strip__inner { flex-direction:column; gap:8px; }
  .cu-strip__item { font-size:12px; }
}
</style>


<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════════════ -->
<nav class="cu-breadcrumb" aria-label="Breadcrumb">
  <div class="w">
    <div class="cu-breadcrumb__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="cu-breadcrumb__sep">›</span>
      <span>Contact Us</span>
    </div>
  </div>
</nav>


<!-- ══ HERO ══════════════════════════════════════════════════════════════════ -->
<section class="cu-hero" aria-label="Contact page hero">
  <div class="cu-hero__bg"></div>
  <div class="w">
    <span class="cu-eye">Get In Touch</span>
    <h1>Contact <span>Tony Allen</span><br>Auto Service</h1>
    <p class="cu-hero__sub">Send an enquiry, book a service, or give us a call. We'll get back to you fast.</p>
    <div class="cu-trust">
      <div class="cu-trust__item">
        <svg width="20" height="20" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-label="Google Reviews" style="flex-shrink:0;">
          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        </svg>
        <?php echo esc_html($rating); ?> Stars &nbsp;&middot;&nbsp; <?php echo esc_html($reviews); ?> Reviews
      </div>
      <div class="cu-trust__item">
        <img src="<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png" alt="MTA Assured" width="36" height="28" loading="lazy" style="flex-shrink:0;object-fit:contain;">
        MTA Assured
      </div>
      <div class="cu-trust__item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 102" width="36" height="27" aria-label="NZTA" style="flex-shrink:0;">
          <path fill="#AFBD22" d="M85.91,101.09c-11.2-1.2-12.29-21.9-13.53-44.24c-0.14-2.37-0.26-4.74-0.41-7.12C70.44,24.73,67.39,0,48.81,0C12.85,0,0,56.85,0,56.85h58.69l-0.89-7.12H10.59c8.15-35.53,43.04-61.04,50.43,0l0.88,7.12c2.48,24.09,9.47,43.58,24.22,44.29C86.21,101.14,85.99,101.1,85.91,101.09"/>
          <path fill="#003B5C" d="M88.82,49.73l1.41,7.12h39.14c-1.76,11.88-34.11,45.65-42.34,0l-1.41-7.12c-1.29-5.05-5.05-44.63-28.26-49.26c-0.48-0.09-0.98-0.18-1.49-0.24c-0.08-0.01-0.35-0.03-0.24-0.01l0.12,0.02c15.96,2.53,18.76,25.88,20.2,49.49c0.15,2.38,0.28,4.75,0.41,7.12c1.28,23.02,2.41,44.29,14.58,44.29c21.46,0,42.94-28.82,46.89-51.41H88.82z"/>
        </svg>
        NZTA Authorised
      </div>
      <div class="cu-trust__item">
        <svg viewBox="0 0 24 24" style="width:14px;height:14px;fill:var(--taas-yellow, #FFC800);flex-shrink:0;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
        <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:inherit;">139 Cavendish Drive, Manukau</a>
      </div>
    </div>
  </div>
</section>


<!-- ══ TRUST STRIP ═══════════════════════════════════════════════════════════ -->
<div class="cu-strip">
  <div class="w">
    <div class="cu-strip__inner">
      <span class="cu-strip__item">✓ MTA Assured</span>
      <span class="cu-strip__item">✓ NZTA Authorised</span>
      <span class="cu-strip__item">✓ Family-owned since <?php echo esc_html($established); ?></span>
      <span class="cu-strip__item">✓ <?php echo esc_html($rating); ?>★ Google · <?php echo esc_html($reviews); ?> reviews</span>
    </div>
  </div>
</div>


<!-- ══ BODY ═══════════════════════════════════════════════════════════════════ -->
<section class="cu-body" aria-label="Contact form and information">
  <div class="w">
    <div class="cu-grid">

      <!-- Form panel -->
      <div class="cu-form-panel">
        <h2>Send an Enquiry</h2>
        <p class="cu-form-panel__sub">Fill in your details and we'll get back to you within a couple of hours during business hours.</p>
        <?php echo do_shortcode($cf7); ?>
      </div>

      <!-- Sidebar -->
      <div class="cu-sidebar">

        <!-- Contact info -->
        <div class="cu-info-card">
          <h3>Contact Details</h3>

          <div class="cu-info-row">
            <div class="cu-info-icon">
              <svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            </div>
            <div>
              <span class="cu-info-lbl">Freephone</span>
              <div class="cu-info-val"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a></div>
            </div>
          </div>

          <div class="cu-info-row">
            <div class="cu-info-icon">
              <svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            </div>
            <div>
              <span class="cu-info-lbl">Local</span>
              <div class="cu-info-val"><a href="tel:<?php echo esc_attr($phone_tel); ?>"><?php echo esc_html($phone_local); ?></a></div>
            </div>
          </div>

          <div class="cu-info-row">
            <div class="cu-info-icon">
              <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            </div>
            <div>
              <span class="cu-info-lbl">Email</span>
              <div class="cu-info-val"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
            </div>
          </div>

          <div class="cu-info-row">
            <div class="cu-info-icon">
              <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div>
              <span class="cu-info-lbl">Address</span>
              <div class="cu-info-val"><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow, #FFC800);text-decoration:none;">139 Cavendish Drive,<br>Manukau, Auckland 2104</a></div>
            </div>
          </div>

          <div class="cu-info-row">
            <div class="cu-info-icon">
              <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
            </div>
            <div>
              <span class="cu-info-lbl">Hours</span>
              <div class="cu-info-val"><?php echo esc_html($hours); ?><br><span style="color:#555;font-size:13px;">Saturday &amp; Sunday: Closed</span></div>
            </div>
          </div>
        </div>

        <!-- What happens next -->
        <div class="cu-next-card">
          <h3>What happens next</h3>
          <div class="cu-step">
            <div class="cu-step__num">1</div>
            <div class="cu-step__text">
              <strong>We receive your enquiry</strong>
              All enquiries are reviewed during business hours — usually within a couple of hours.
            </div>
          </div>
          <div class="cu-step">
            <div class="cu-step__num">2</div>
            <div class="cu-step__text">
              <strong>We look up your vehicle</strong>
              Your rego lets us check your make, model, and year before we call — so we can give you accurate pricing straight away.
            </div>
          </div>
          <div class="cu-step">
            <div class="cu-step__num">3</div>
            <div class="cu-step__text">
              <strong>We confirm your booking</strong>
              We'll call or email to lock in a time that works for you. No pressure, no upsell.
            </div>
          </div>
        </div>

        <!-- Map -->
        <div class="cu-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3192.7!2d174.878!3d-36.997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d0d48a2b8e5f4c7%3A0x500ef868479640!2s139+Cavendish+Drive%2C+Manukau%2C+Auckland+2104!5e0!3m2!1sen!2snz!4v1"
            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            title="Tony Allen Auto Service — 139 Cavendish Drive, Manukau">
          </iframe>
        </div>

      </div><!-- /.cu-sidebar -->

    </div><!-- /.cu-grid -->
  </div>
</section>


<!-- ══ WHY TAAS ═══════════════════════════════════════════════════════════════ -->
<section class="cu-why" aria-labelledby="cu-why-head">
  <div class="w">
    <h2 id="cu-why-head">Why South Auckland Drivers<br>Choose <span style="color:var(--taas-yellow, #FFC800)">TAAS</span></h2>
    <p class="cu-why__sub">Independent. Honest. Family-owned since <?php echo esc_html($established); ?>.</p>
    <div class="cu-why-grid">
      <div class="cu-why-item">
        <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
          <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
          <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
          <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        </svg>
        <h3><?php echo esc_html($rating); ?> Star Rating</h3>
        <p><?php echo esc_html($reviews); ?> Google reviews from real customers across South Auckland. MTA Assured workshop.</p>
      </div>
      <div class="cu-why-item">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        <h3>Seven Specialist Divisions</h3>
        <p><?php echo esc_html($divisions); ?> — all under one roof in Manukau.</p>
      </div>
      <div class="cu-why-item">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><path d="m9 12 2 2 4-4"/></svg>
        <h3>Straight Answers</h3>
        <p>We explain what's needed and what can wait. No jargon, no pressure. Transparent pricing before we start.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ REVIEWS ════════════════════════════════════════════════════════════════ -->
<?php if ($reviews_widget) : ?>
<section class="cu-reviews" aria-label="Customer reviews">
  <div class="w">
    <h2>What Our Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>
<?php endif; ?>


<!-- ══ FAQ ════════════════════════════════════════════════════════════════════ -->
<section class="cu-faq" aria-labelledby="cu-faq-head">
  <div class="w">
    <div class="cu-sh">
      <span class="cu-eye cu-eye--border">Common Questions</span>
      <h2 class="cu-h2" id="cu-faq-head">Quick <span>Answers</span></h2>
      <p class="cu-sh__sub">Everything you need to know before you book.</p>
    </div>
    <div class="cu-faq-list">
      <?php foreach ($faqs as $fi => $faq): ?>
      <div class="cu-faq-item<?php echo $fi === 0 ? ' is-open' : ''; ?>">
        <button class="cu-faq-q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($faq['q']); ?></button>
        <div class="cu-faq-a">
          <p><?php echo wp_kses_post($faq['a']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ CTA BAND ═══════════════════════════════════════════════════════════════ -->
<section class="cu-cta" aria-label="Call to action">
  <div class="w">
    <h2>Prefer to <span>Call?</span></h2>
    <p>Talk to the workshop directly &mdash; Mon&ndash;Fri, 7:30am&ndash;5:00pm.</p>
    <div class="cu-cta__btns">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cu-btn cu-btn--yellow">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
        Call <?php echo esc_html($phone_free); ?>
      </a>
      <a href="mailto:<?php echo esc_attr($email); ?>" class="cu-btn cu-btn--outline">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
        Email Us
      </a>
    </div>
  </div>
</section>

</div><!-- /.taas-cu -->

<script>
(function(){
  document.querySelectorAll('.cu-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.cu-faq-item');
      var isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.cu-faq-item').forEach(function(i){
        i.classList.remove('is-open');
        i.querySelector('.cu-faq-q').setAttribute('aria-expanded','false');
      });
      if(!isOpen){
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded','true');
      }
    });
  });
})();
</script>

<?php get_footer(); ?>
