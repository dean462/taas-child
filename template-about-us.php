<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /about-us/
 * Built: May 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. WP Admin → Pages → About Us → Template → "About Us" → Update
 * 3. Set AIOSEO title, description, focus keyword
 * 4. Purge Cloudflare cache
 */

// ── Enqueue global assets ─────────────────────────────────────────────────────
require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email          = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating         = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews        = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$ms_number      = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET: '';

$site_url       = get_site_url();
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$mta_badge      = $site_url . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png';
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$euro_brands    = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$divisions      = defined('TAAS_DIVISIONS') ? TAAS_DIVISIONS : 'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries';
$customers      = defined('TAAS_CUSTOMERS') ? TAAS_CUSTOMERS : '10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';

// ── Schema ────────────────────────────────────────────────────────────────────
$schema = [
  '@context' => 'https://schema.org',
  '@type'    => ['AutoRepair','LocalBusiness'],
  'name'     => 'Tony Allen Auto Service',
  'url'      => $site_url,
  'description' => 'South Auckland\'s largest independent workshop. MTA Assured, NZTA Authorised. Family-owned since 1985.',
  'foundingDate' => '1985-10',
  'founder'  => ['@type' => 'Person', 'name' => 'Mike Allen'],
  'address'  => [
    '@type'           => 'PostalAddress',
    'streetAddress'   => '139 Cavendish Drive',
    'addressLocality' => 'Manukau',
    'addressRegion'   => 'Auckland',
    'postalCode'      => '2104',
    'addressCountry'  => 'NZ',
  ],
  'geo'      => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
  'telephone' => [$phone_local, $phone_free],
  'email'     => $email,
  'openingHoursSpecification' => [[
    '@type'     => 'OpeningHoursSpecification',
    'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
    'opens'     => '07:30',
    'closes'    => '17:00',
  ]],
  'numberOfEmployees' => ['@type' => 'QuantitativeValue', 'value' => 12],
  'aggregateRating'   => [
    '@type'       => 'AggregateRating',
    'ratingValue' => $rating,
    'reviewCount' => preg_replace('/\D+/', '', $reviews),
    'bestRating'  => '5',
  ],
  'memberOf' => ['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],
  'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
  'speakable' => ['@type'=>'SpeakableSpecification','cssSelector'=>['.au-hero__h1','.au-hero__intro']],
  'sameAs' => [
    'https://www.facebook.com/tonyallenautoservice/',
    'https://www.instagram.com/tonyallenautoservice/',
    'https://www.linkedin.com/company/7059060',
  ],
];

// FAQPage schema for About Us
$au_faqs_schema = [
    $taas_faqs['about_ownership'],
    $taas_faqs['about_how_long'],
    $taas_faqs['about_franchise'],
    $taas_faqs['about_accreditations'],
    $taas_faqs['about_divisions'],
    $taas_faqs['about_european'],
    $taas_faqs['about_location'],
    $taas_faqs['about_finance'],
];
$schema_faq_page = [
  '@context'   => 'https://schema.org',
  '@type'      => 'FAQPage',
  'mainEntity' => array_map(function($f) {
    return ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
  }, $au_faqs_schema),
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
echo '<script type="application/ld+json">' . wp_json_encode($schema_faq_page, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-about">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════════ */
.page-template-template-about-us .site-content,
.page-template-template-about-us .entry-content,
.page-template-template-about-us .entry-header,
.page-template-template-about-us article,
.page-template-template-about-us #primary,
.page-template-template-about-us #content { padding:0!important; margin:0!important; max-width:100%!important; }
.taas-about *, .taas-about *::before, .taas-about *::after { box-sizing:border-box; margin:0; padding:0; }

/* ══ BASE ═════════════════════════════════════════════════════════════════════ */
.taas-about {
  font-family:'Inter',Arial,sans-serif;
  color:#333333;
  font-size:16px;
  line-height:1.75;
  -webkit-font-smoothing:antialiased;
  overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;
}
.taas-about a { color:#FFC800; text-decoration:none; }
.taas-about .au-w { max-width:1140px; margin:0 auto; padding:0 32px; }

/* ══ EYEBROW ══════════════════════════════════════════════════════════════════ */
.taas-about .au-eye {
  display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:700;
  letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase;
  padding:4px 10px; border-radius:3px; margin-bottom:18px;
}
.au-eye--dark  { background:#1A1A1A; color:#FFC800; }
.au-eye--light { background:#FFC800; color:#1A1A1A; }
.au-eye--muted { background:transparent; color:#999; padding:0; letter-spacing:.14em; }

/* ══ HERO ═════════════════════════════════════════════════════════════════════ */
.taas-about .au-hero {
  background:var(--taas-black, #111111);
  padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px);
  position:relative;
}
.taas-about .au-hero__bg {
  position:absolute; inset:0; z-index:0;
  background:url('<?php echo esc_url(get_site_url()); ?>/wp-content/uploads/2026/06/hero-about.webp') center 55% / cover no-repeat;
}
.taas-about .au-hero__bg::after {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,0.82);
}
.taas-about .au-hero > .au-w { position:relative; z-index:1; }
.taas-about .au-hero__inner {
  display:grid; grid-template-columns:1fr 380px;
  gap:64px; align-items:center;
}
.taas-about .au-hero__tag {
  font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; color:#FFC800;
  display:flex; align-items:center; gap:12px; margin-bottom:20px;
}
.taas-about .au-hero__tag::before { content:''; width:40px; height:2px; background:#FFC800; }
.taas-about .au-hero__h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight:800;
  line-height:1.1; color:#fff;
  letter-spacing:-0.02em; margin-bottom:24px;
}
.taas-about .au-hero__h1 em { color:#FFC800; font-style:normal; }
.taas-about .au-hero__intro { font-size:16px; color:#999; line-height:1.75; max-width:520px; margin-bottom:32px; }
.taas-about .au-hero__ctas { display:flex; gap:14px; flex-wrap:wrap; }

/* Stat card */
.taas-about .au-hero__stats {
  background:rgba(255,200,0,.05);
  border:1px solid rgba(255,200,0,.18);
  border-top:3px solid #FFC800;
  padding:28px 24px;
}
.taas-about .au-stat { padding:14px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.taas-about .au-stat:last-child { border-bottom:none; padding-bottom:0; }
.taas-about .au-stat__num {
  font-family:'Inter',Arial,sans-serif;
  font-size:40px; font-weight:900; color:#FFC800;
  line-height:1; margin-bottom:2px;
}
.taas-about .au-stat__label { font-size:12px; color:#888; letter-spacing:.06em; }

/* ══ BUTTONS ══════════════════════════════════════════════════════════════════ */
.taas-about .au-btn {
  display:inline-flex; align-items:center; gap:8px;
  font-family:'Inter',Arial,sans-serif; font-weight:700; font-size:14px;
  letter-spacing:.04em; text-transform:uppercase;
  padding:14px 26px; border-radius:6px;
  transition:all .18s; text-decoration:none;
}
.au-btn--yellow { background:#FFC800; color:#1A1A1A!important; }
.au-btn--yellow:hover { background:#e6b400; transform:translateY(-1px); }
.au-btn--dark { background:#1A1A1A; color:#fff!important; }
.au-btn--dark:hover { background:#000; transform:translateY(-1px); }
.au-btn--outline-yellow { background:transparent; color:#FFC800!important; border:2px solid #FFC800; }
.au-btn--outline-yellow:hover { background:#FFC800; color:#1A1A1A!important; }
.au-btn--outline-dark { background:transparent; color:#1A1A1A!important; border:2px solid #1A1A1A; }
.au-btn--outline-dark:hover { background:#1A1A1A; color:#FFC800!important; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════════ */
.taas-about .au-phonestrip{background:var(--taas-yellow,#FFC800);padding:13px 0;}
.taas-about .au-phonestrip__inner{max-width:1140px;margin:0 auto;padding:0 32px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}
.taas-about .au-phonestrip__label{font-size:14px;font-weight:600;color:#1A1A1A;}
.taas-about .au-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:#1A1A1A;text-decoration:none;}
.taas-about .au-phonestrip__num:hover{opacity:.65;}
.taas-about .au-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:18px 0;}
.taas-about .au-trust__inner {
  display:flex; gap:40px; align-items:center;
  justify-content:center; flex-wrap:wrap;
}
.taas-about .au-trust__item { display:flex; align-items:center; gap:8px; font-size:14px; font-weight:600; color:#1A1A1A; white-space:nowrap; }
.taas-about .au-trust__item::before { content:'✓'; font-weight:900; }

/* ══ STORY (white) ════════════════════════════════════════════════════════════ */
.taas-about .au-story { background:#fff; padding:72px 0; }
.taas-about .au-story__inner { display:grid; grid-template-columns:1fr 420px; gap:80px; align-items:center; }
.taas-about .au-story__year {
  font-family:'Inter',Arial,sans-serif;
  font-size:clamp(80px,10vw,140px); font-weight:900;
  color:#F0F0EE; line-height:.85; margin-bottom:-12px; display:block; user-select:none;
}
.taas-about .au-story__h2 {
  font-family:'Inter',Arial,sans-serif;
  font-size:clamp(28px,3.5vw,42px); font-weight:900;
  color:#0D0D0D; text-transform:uppercase; line-height:1.05; margin-bottom:28px;
}
.taas-about .au-story__body p { font-size:16px; color:#555; line-height:1.75; margin-bottom:20px; }
.taas-about .au-story__body p:last-child { margin-bottom:0; }
/* Story image placeholder — drops out when real photo added */
.taas-about .au-story__img-wrap { position:relative; }
.taas-about .au-story__img-ph {
  width:100%; aspect-ratio:3/4;
  background:#1A1A1A;
  display:flex; align-items:center; justify-content:center;
  position:relative; z-index:1;
}
.taas-about .au-story__img-ph span { font-size:13px; color:#555; font-weight:600; letter-spacing:.1em; text-transform:uppercase; }
.taas-about .au-story__img-accent { display:none; }

/* ══ WHY INDEPENDENT (grey) ═══════════════════════════════════════════════════ */
.taas-about .au-indep { background:#F7F7F5; padding:72px 0; }
.taas-about .au-section-head { max-width:660px; margin:0 auto 40px; text-align:center; }
.taas-about .au-section-h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700;
  color:var(--taas-black, #111111); letter-spacing:-0.01em; line-height:1.2; margin-bottom:14px;
}
.taas-about .au-section-h2--white { color:#fff; }
.taas-about .au-section-intro { font-size:16px; color:#666; line-height:1.75; }
.taas-about .au-reason-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:3px; }
.taas-about .au-reason-card { background:#fff; padding:40px 32px; }
.taas-about .au-reason-card__num {
  font-family:'Inter',Arial,sans-serif;
  font-size:42px; font-weight:900; color:#EBEBEA; line-height:1; margin-bottom:16px;
}
.taas-about .au-reason-card__title {
  font-family:'Inter',Arial,sans-serif; font-size:22px; font-weight:900;
  color:#0D0D0D; text-transform:uppercase; letter-spacing:.03em;
  border-top:3px solid #FFC800; padding-top:14px; margin-bottom:12px;
}
.taas-about .au-reason-card__body { font-size:15px; color:#666; line-height:1.75; }

/* ══ DIVISIONS (dark) ═════════════════════════════════════════════════════════ */
.taas-about .au-divisions { background:#1A1A1A; padding:72px 0; }
.taas-about .au-div-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:3px; margin-top:40px; }
.taas-about .au-div-card {
  background:#222; padding:32px 24px;
  text-decoration:none; display:block;
  border-top:3px solid transparent;
  transition:border-color .2s, background .2s;
}
.taas-about .au-div-card:hover { background:#282828; border-color:#FFC800; }
.taas-about .au-div-card__icon { font-size:26px; margin-bottom:14px; display:block; line-height:1; }
.taas-about .au-div-card__icon svg { display:block; }
.taas-about .au-div-card__name {
  font-family:'Inter',Arial,sans-serif; font-size:18px; font-weight:900;
  color:#fff; text-transform:uppercase; letter-spacing:.03em; margin-bottom:8px;
}
.taas-about .au-div-card__desc { font-size:13px; color:#888; line-height:1.75; margin-bottom:14px; }
.taas-about .au-div-card__link { font-size:11px; font-weight:700; color:#FFC800; letter-spacing:.1em; text-transform:uppercase; }

/* ══ TEAM (white) ═════════════════════════════════════════════════════════════ */
.taas-about .au-team { background:#fff; padding:72px 0; }
.taas-about .au-team-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:28px; margin-top:40px; }
.taas-about .au-team-card { text-align:center; }
.taas-about .au-team-card__photo {
  width:100%; aspect-ratio:3/4; object-fit:cover; object-position:top;
  display:block; margin-bottom:18px;
  filter:grayscale(20%); transition:filter .3s;
}
.taas-about .au-team-card:hover .au-team-card__photo { filter:grayscale(0%); }
.taas-about .au-team-card__name {
  font-family:'Inter',Arial,sans-serif; font-size:19px; font-weight:900;
  color:#0D0D0D; text-transform:uppercase; letter-spacing:.03em; margin-bottom:4px;
}
.taas-about .au-team-card__role {
  font-size:10px; font-weight:700; color:#FFC800;
  background:#1A1A1A; display:inline-block;
  padding:3px 10px; letter-spacing:.08em;
  text-transform:uppercase; margin-bottom:10px; line-height:1.75;
}
.taas-about .au-team-card__bio { font-size:13px; color:#666; line-height:1.75; }

/* ══ FLEET (dark) ═════════════════════════════════════════════════════════════ */
.taas-about .au-fleet { background:#1A1A1A; padding:72px 0; }
.taas-about .au-fleet__inner { display:grid; grid-template-columns:1fr 1fr; gap:80px; align-items:start; }
.taas-about .au-fleet__label { font-size:10px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:#FFC800; margin-bottom:16px; display:block; }
.taas-about .au-fleet__h2 {
  font-family:'Inter',Arial,sans-serif;
  font-size:clamp(28px,3vw,42px); font-weight:900;
  color:#fff; text-transform:uppercase; line-height:1.05; margin-bottom:20px;
}
.taas-about .au-fleet__body { color:#aaa; font-size:16px; line-height:1.75; }
.taas-about .au-fleet__body p { margin-bottom:16px; }
.taas-about .au-fleet__body p:last-child { margin-bottom:0; }
.taas-about .au-partners { margin-top:32px; }
.taas-about .au-partners__label { font-size:10px; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:#555; margin-bottom:12px; display:block; }
.taas-about .au-partner-tags { display:flex; flex-wrap:wrap; gap:8px; }
.taas-about .au-tag {
  background:rgba(255,200,0,.07); border:1px solid rgba(255,200,0,.18);
  color:#bbb; font-size:12px; font-weight:600; padding:5px 14px; letter-spacing:.05em;
}
.taas-about .au-benefits { border-left:3px solid #FFC800; padding-left:32px; }
.taas-about .au-benefit { padding:18px 0; border-bottom:1px solid rgba(255,255,255,.06); }
.taas-about .au-benefit:last-child { border-bottom:none; }
.taas-about .au-benefit__title {
  font-family:'Inter',Arial,sans-serif; font-size:17px; font-weight:900;
  color:#fff; text-transform:uppercase; letter-spacing:.03em; margin-bottom:4px;
}
.taas-about .au-benefit__desc { font-size:14px; color:#999; line-height:1.75; }

/* ══ CTA BAND (yellow) ════════════════════════════════════════════════════════ */
.taas-about .au-cta { background:var(--taas-dark, #1A1A1A); padding:var(--taas-sec-pad, 72px) 0; text-align:center; }
.taas-about .au-cta__inner { }
.taas-about .au-cta__h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700;
  color:var(--taas-white, #fff); line-height:1.2; margin-bottom:12px;
}
.taas-about .au-cta__sub { color:#5a4800; font-size:15px; margin-top:6px; }
.taas-about .au-cta__phone { display:block; font-size:var(--taas-cta-phone, 40px); font-weight:800; color:var(--taas-yellow, #FFC800); text-decoration:none; margin-bottom:8px; line-height:1.1; }
.taas-about .au-cta__phone:hover{opacity:.65;}
.taas-about .au-cta__btns { display:flex; gap:14px; flex-wrap:wrap; flex-shrink:0; }

/* ══ AWARDS ═══════════════════════════════════════════════════════════════════ */
.taas-about .au-awards { background:#F7F7F5; padding:48px 0; border-top:1px solid #E8E8E4; }
.taas-about .au-awards__inner { display:flex; align-items:center; justify-content:space-between; gap:32px; flex-wrap:wrap; }
.taas-about .au-awards__label { font-size:11px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:#999; margin-bottom:10px; }
.taas-about .au-awards__list { display:flex; flex-wrap:wrap; gap:8px; }
.taas-about .au-award-pill { background:#fff; border:1px solid #E8E8E4; font-size:13px; font-weight:600; color:#333; padding:8px 14px; }

/* ══ RESPONSIVE ═══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .taas-about .au-hero__inner,
  .taas-about .au-story__inner,
  .taas-about .au-fleet__inner { grid-template-columns:1fr; gap:40px; }
  .taas-about .au-hero__stats { display:none; }
  .taas-about .au-div-grid { grid-template-columns:repeat(2,1fr); }
  .taas-about .au-team-grid { grid-template-columns:repeat(3,1fr); }
  .taas-about .au-reason-grid { grid-template-columns:1fr 1fr; }
  .taas-about .au-story__img-accent { display:none; }
  .taas-about .au-benefits { border-left:none; padding-left:0; border-top:3px solid #FFC800; padding-top:28px; }
}
@media (max-width:640px){.taas-about .au-phonestrip__num{font-size:17px;}}
@media (max-width:640px) {
  /* Layout */
  .taas-about .au-reason-grid,
  .taas-about .au-div-grid,
  .taas-about .au-team-grid { grid-template-columns:1fr; }
  .taas-about .au-cta__inner { flex-direction:column; text-align:center; }
  .taas-about .au-cta__btns { justify-content:center; flex-direction:column; align-items:stretch; }
  .taas-about .au-cta__btns .au-btn { justify-content:center; text-align:center; }
  .taas-about .au-hero__ctas { flex-direction:column; align-items:stretch; }
  .taas-about .au-hero__ctas .au-btn { justify-content:center; text-align:center; }
  .taas-about .au-awards__inner { flex-direction:column; align-items:flex-start; }
  .taas-about .au-w { padding:0 20px; }

  /* Section spacing */
  .taas-about .au-hero { padding:48px 0 40px; }
  .taas-about .au-story { padding:48px 0; }
  .taas-about .au-indep { padding:48px 0; }
  .taas-about .au-divisions { padding:48px 0; }
  .taas-about .au-team { padding:48px 0; }
  .taas-about .au-fleet { padding:48px 0; }
  .taas-about .au-faq { padding:48px 0; }
  .taas-about .au-cta { padding:48px 0; }

  /* Type scale */
  .taas-about .au-hero__h1 { font-size:clamp(26px, 7vw, 38px); }
  .taas-about .au-hero__intro { font-size:14px; margin-bottom:24px; }
  .taas-about .au-btn { font-size:14px; padding:12px 20px; }
  .taas-about .au-section-h2 { font-size:clamp(22px, 6vw, 32px); }
  .taas-about .au-section-intro { font-size:14px; }
  .taas-about .au-story__h2 { font-size:clamp(22px, 6vw, 32px); }
  .taas-about .au-story__body p { font-size:14px; }
  .taas-about .au-story__year { font-size:clamp(60px, 15vw, 100px); }
  .taas-about .au-reason-card { padding:28px 22px; }
  .taas-about .au-reason-card__num { font-size:32px; }
  .taas-about .au-reason-card__title { font-size:18px; }
  .taas-about .au-reason-card__body { font-size:13px; }
  .taas-about .au-div-card { padding:24px 20px; }
  .taas-about .au-div-card__name { font-size:16px; }
  .taas-about .au-div-card__desc { font-size:12px; }
  .taas-about .au-team-card__name { font-size:17px; }
  .taas-about .au-team-card__bio { font-size:12px; }
  .taas-about .au-fleet__h2 { font-size:clamp(22px, 6vw, 32px); }
  .taas-about .au-fleet__body { font-size:14px; }
  .taas-about .au-benefit__title { font-size:15px; }
  .taas-about .au-benefit__desc { font-size:13px; }
  .taas-about .au-cta__h2 { font-size:clamp(22px, 6vw, 32px); }
  .taas-about .au-cta__sub { font-size:13px; }
  .taas-about .au-stat__num { font-size:32px; }
  .taas-about .au-stat__label { font-size:11px; }

  /* FAQ */
  .au-faq__btn { font-size:14px!important; padding:16px 32px 16px 0!important; }
  .au-faq__ans { font-size:14px!important; }

  /* Trust strip */
  .taas-about .au-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; }
  .taas-about .au-trust__item { font-size:12px; }

  /* Section heads */
  .taas-about .au-section-head { margin-bottom:32px; }
  .taas-about .au-team-grid,
  .taas-about .au-div-grid { margin-top:32px; }
}
</style>


<!-- ══ HERO ═══════════════════════════════════════════════════════════════════ -->
<section class="au-hero" aria-label="About Tony Allen Auto Service">
  <div class="au-hero__bg"></div>
  <div class="au-w">
    <div class="au-hero__inner">
      <div>
        <div class="au-hero__tag">About Tony Allen Auto Service</div>
        <h1 class="au-hero__h1">
          South Auckland's<br>
          Largest <em>Independent</em><br>
          Workshop.
        </h1>
        <p class="au-hero__intro">
          Family-owned since October <?php echo esc_html($established); ?>. MTA Assured. NZTA Authorised. Twelve staff across seven specialist divisions — all under one roof at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#FFC800;text-decoration:underline;">139 Cavendish Drive, Manukau</a>. A family business that's been keeping South Auckland moving for over <?php echo esc_html($years); ?> years.
        </p>
        <div class="au-hero__ctas">
          <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" class="au-btn au-btn--yellow">Book a Service</a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="au-btn au-btn--outline-yellow">Call <?php echo esc_html($phone_free); ?></a>
        </div>
      </div>

      <div class="au-hero__stats" aria-hidden="true">
        <div class="au-stat">
          <div class="au-stat__num"><?php echo esc_html($years); ?>+</div>
          <div class="au-stat__label">Years trading in South Auckland</div>
        </div>
        <div class="au-stat">
          <div class="au-stat__num">12</div>
          <div class="au-stat__label">Workshop staff across 7 divisions</div>
        </div>
        <div class="au-stat">
          <div class="au-stat__num">10k+</div>
          <div class="au-stat__label">Customers in our database</div>
        </div>
        <div class="au-stat">
          <div class="au-stat__num"><?php echo esc_html($rating); ?>★</div>
          <div class="au-stat__label"><?php echo esc_html($reviews); ?> Google reviews</div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ═════════════════════════════════════════════════════════ -->
<div class="au-phonestrip"><div class="au-phonestrip__inner"><span class="au-phonestrip__label">Talk to us today</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="au-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<!-- ══ TRUST STRIP ═══════════════════════════════════════════════════════════ -->
<div class="au-trust" role="region" aria-label="Trust signals">
  <div class="au-w">
    <div class="au-trust__inner">
      <div class="au-trust__item">MTA Assured</div>
      <div class="au-trust__item">NZTA Authorised</div>
      <div class="au-trust__item">Family-owned since <?php echo esc_html($established); ?></div>
      <div class="au-trust__item"><?php echo esc_html($rating); ?>★ Google · <?php echo esc_html($reviews); ?> reviews</div>
      <div class="au-trust__item">5 MBI Providers</div>
    </div>
  </div>
</div>


<!-- ══ ORIGIN STORY ═══════════════════════════════════════════════════════════ -->
<section class="au-story" aria-labelledby="au-story-head">
  <div class="au-w">
    <div class="au-story__inner">
      <div>
        <span class="au-story__year"><?php echo esc_html($established); ?></span>
        <span class="au-eye au-eye--muted">Our Story</span>
        <h2 class="au-story__h2" id="au-story-head"><?php echo esc_html($years); ?> years in.<br>Still building.</h2>
        <div class="au-story__body">
          <p>Tony Allen Auto Service has been at 139 Cavendish Drive since October <?php echo esc_html($established); ?>. Mike and Dean Allen run the business together with seven specialist divisions operating under one roof — servicing and repairs, brakes and clutch, tyres, auto electrical and air conditioning, European vehicles, fleet, and batteries. Twelve staff. A customer database that's passed <?php echo esc_html($customers); ?> contacts. And a workshop that's investing in capability, equipment &amp; culture.</p>
          <p>Two technicians are completing EV and hybrid vehicle qualification. Our diagnostic equipment covers European, Japanese, and Korean platforms at factory level. We're an approved repairer for five MBI (mechanical breakdown insurance) providers, a direct supplier to SG Fleet and three other fleet management companies, and we accept four consumer finance options so cost doesn't have to be a barrier to safe, reliable transport.</p>
          <p>South Auckland runs on vehicles — logistics, trades, families getting to work and school. We take that seriously. The workshop the Allen Family built is the foundation. What Mike, Dean, and the team are building on it is a full-service automotive operation designed for the next decade &amp; beyond.</p>
        </div>
      </div>

      <div class="au-story__img-wrap">
        <img src="<?php echo esc_url(home_url('/wp-content/uploads/2026/05/taas-img_2372.jpg')); ?>"
             alt="Tony Allen Auto Service — 139 Cavendish Drive, Manukau"
             width="1400" height="1050"
             loading="lazy"
             style="width:100%;height:100%;object-fit:cover;object-position:center 30%;display:block;border-radius:6px;">
        <div class="au-story__img-accent"></div>
      </div>
    </div>
  </div>
</section>


<!-- ══ WHY INDEPENDENT ════════════════════════════════════════════════════════ -->
<section class="au-indep" aria-labelledby="au-indep-head">
  <div class="au-w">
    <div class="au-section-head">
      <span class="au-eye au-eye--light">Why Choose Independent</span>
      <h2 class="au-section-h2" id="au-indep-head">What you get when you choose an independent workshop.</h2>
      <p class="au-section-intro">Franchised chains operate on targets. Dealers operate on margins. An independent workshop operates on reputation — because reputation is all it has.</p>
    </div>
    <div class="au-reason-grid">
      <div class="au-reason-card">
        <div class="au-reason-card__num">01</div>
        <div class="au-reason-card__title">No Franchise Rules</div>
        <p class="au-reason-card__body">TAAS is not part of a national chain. There are no head-office upsell targets, no monthly quotas for recommended work, and no standardised pricing that doesn't reflect the actual job. Every recommendation is made by the technician who looked at your car.</p>
      </div>
      <div class="au-reason-card">
        <div class="au-reason-card__num">02</div>
        <div class="au-reason-card__title">You Know Who's Working on Your Car</div>
        <p class="au-reason-card__body">At TAAS, the technicians have names and histories. Raj is the lead diagnostics and auto electrical specialist. Hayden is a technician with a four-year apprenticeship. Corey runs the service operation. These are people you'll see again next time.</p>
      </div>
      <div class="au-reason-card">
        <div class="au-reason-card__num">03</div>
        <div class="au-reason-card__title">Independent Doesn't Mean Unsophisticated</div>
        <p class="au-reason-card__body">TAAS runs factory-level diagnostic equipment, services European vehicles that many independent workshops turn away, and holds approved repairer status with five MBI insurance providers. The difference from a franchise is ownership and accountability — not capability.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ SEVEN DIVISIONS ════════════════════════════════════════════════════════ -->
<section class="au-divisions" aria-labelledby="au-div-head">
  <div class="au-w">
    <div class="au-section-head">
      <span class="au-eye au-eye--dark">What We Do</span>
      <h2 class="au-section-h2 au-section-h2--white" id="au-div-head">Seven specialist divisions.<br>One address.</h2>
      <p class="au-section-intro" style="color:#888;"><?php echo esc_html($divisions); ?> — all under one roof. Each division is staffed by people who focus on that one thing, every day.</p>
    </div>
    <div class="au-div-grid">

      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
        <div class="au-div-card__name">TAAS Servicing &amp; Repairs</div>
        <p class="au-div-card__desc">Scheduled servicing, logbook servicing, and full mechanical inspections for all makes and models. Does not void manufacturer warranty.</p>
        <span class="au-div-card__link">Servicing Info →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/manukau-brake-clutch/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/><line x1="2" y1="12" x2="9" y2="12"/><line x1="15" y1="12" x2="22" y2="12"/></svg></span>
        <div class="au-div-card__name">Manukau Brake &amp; Clutch</div>
        <p class="au-div-card__desc">Specialist brake and clutch division. Serving retail and trade customers across South Auckland.</p>
        <span class="au-div-card__link">MBC Info →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/manukau-batteries/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg></span>
        <div class="au-div-card__name">Manukau Batteries</div>
        <p class="au-div-card__desc">Car, commercial, marine and deep-cycle batteries. Supply and fit. If your car won't start, we'll get you sorted fast.</p>
        <span class="au-div-card__link">Batteries Info →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h2"/><path d="M9 3v2"/><path d="m9 12 2 2 4-4"/></svg></span>
        <div class="au-div-card__name">TAAS Tyre &amp; WOF Centre</div>
        <p class="au-div-card__desc">NZTA Authorised WOF station — <?php echo defined('TAAS_WOF_PRICE') ? esc_html(TAAS_WOF_PRICE) : '$80'; ?> fixed. Supply and fit tyres, balancing, alignment. Walk-ins welcome mornings.</p>
        <span class="au-div-card__link">Tyre &amp; WOF Info →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/auto-electrical/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
        <div class="au-div-card__name">TAAS Auto Electrical &amp; Air Conditioning</div>
        <p class="au-div-card__desc">Diagnostic scanning, fault code interpretation, alternators, starters, wiring. AC regas and repairs. Fault confirmed before parts are replaced.</p>
        <span class="au-div-card__link">Auto Electrical →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/european/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></span>
        <div class="au-div-card__name">TAAS European</div>
        <p class="au-div-card__desc"><?php echo esc_html($euro_brands); ?>. Factory-spec diagnostics. Independent pricing.</p>
        <span class="au-div-card__link">European Vehicles →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/fleet-servicing/'); ?>" class="au-div-card">
        <span class="au-div-card__icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></span>
        <div class="au-div-card__name">TAAS Fleet</div>
        <p class="au-div-card__desc">B2B fleet servicing and repairs. Lease company vehicles welcome. Direct invoicing to fleet management companies.</p>
        <span class="au-div-card__link">Fleet Servicing →</span>
      </a>

      <a href="<?php echo esc_url($site_url . '/services/'); ?>" class="au-div-card">
        <span class="au-div-card__icon" style="font-size:32px;color:#FFC800;font-family:'Inter',Arial,sans-serif;font-weight:900;">+</span>
        <div class="au-div-card__name">All Services</div>
        <p class="au-div-card__desc">Air conditioning, cooling systems, cambelts, suspension, transmission, EV and hybrid, towing — full service list.</p>
        <span class="au-div-card__link">View All →</span>
      </a>

    </div>
  </div>
</section>


<!-- ══ MEET THE TEAM ══════════════════════════════════════════════════════════ -->
<section class="au-team" aria-labelledby="au-team-head">
  <div class="au-w">
    <div class="au-section-head">
      <span class="au-eye au-eye--light">The Team</span>
      <h2 class="au-section-h2" id="au-team-head">The people who work on your car.</h2>
      <p class="au-section-intro">Not avatars, not a brand voice. Real technicians with qualifications, specialisations, and accountability for the work they do.</p>
    </div>
    <div class="au-team-grid">

      <?php
      $team = [
        ['name'=>'Mike Allen',       'role'=>'Owner / Director',                              'bio'=>'Co-founded Tony Allen Auto Service in October 1985. Built the business from one workshop bay to South Auckland\'s largest independent workshop over four decades.'],
        ['name'=>'Dean Allen',       'role'=>'Owner / General Manager',               'bio'=>'Joined TAAS in 2004 as an apprentice. Qualified technician, WOF inspector, Advanced Technician — Service Manager 2014, General Manager 2022.'],
        ['name'=>'Corey',            'role'=>'Service Manager',                       'bio'=>'Runs the service operation end-to-end. Customer-focused, detail-oriented, and the person making sure your vehicle moves through the workshop on time.'],
        ['name'=>'Aneez',            'role'=>'Customer Service',                      'bio'=>'First point of contact for customers. Handles bookings, updates, and follow-ups — keeping communication clear from drop-off to collection.'],
        ['name'=>'Tanzeel',          'role'=>'Workshop Foreman',                      'bio'=>'Keeps the workshop floor running efficiently. Coordinates workflow and holds the standard on job card completion and quality of work. NZTA WOF authority holder.'],
        ['name'=>'Raj',              'role'=>'Lead Diagnostics &amp; Auto Electrical','bio'=>'TAAS diagnostics and auto electrical specialist. Fault diagnosis, electrical systems, alternators, wiring — fault confirmed before any parts are replaced. NZTA WOF authority holder.'],
        ['name'=>'Hayden',           'role'=>'Technician',                  'bio'=>'Four-year apprenticeship completed. Broad mechanical skill range across servicing, brakes, and general repairs. Also looks after our tyre shop.'],
        ['name'=>'Mana',             'role'=>'Technician',                            'bio'=>'Strong problem-solving and attention to detail. Works across a wide range of mechanical services with a focus on getting it right first time. NZTA WOF authority holder.'],
        ['name'=>'Kiritnesh',        'role'=>'Technician',                            'bio'=>'Versatile technician working across a range of services, including our tyre shop. Developing his skills and a reliable part of the workshop team day to day.'],
        ['name'=>'Lushen Govender',  'role'=>'Technician',                            'bio'=>'Recently joined the TAAS workshop team, working across servicing and general mechanical repairs.'],
        ['name'=>'Tom Le Blanc',     'role'=>'Technician',                            'bio'=>'Recently joined the TAAS workshop team, working across servicing and general mechanical repairs.'],
        ['name'=>'Lincoln',          'role'=>'Apprentice Technician',                 'bio'=>'Progressing through his apprenticeship across the workshop and tyre shop under qualified supervision — part of TAAS\'s commitment to developing the next generation.'],
      ];
      foreach ($team as $member): ?>
      <div class="au-team-card">
        <?php
          // Photo: set 'photo' => media URL on the member, or upload a file named
          // staff-<first-name>.jpg (e.g. staff-lushen.jpg) and it is picked up here.
          $photo = !empty($member['photo']) ? $member['photo'] : '';
          if (!$photo) {
              $first = sanitize_title(strtok($member['name'], ' '));
              $att   = get_posts(['post_type'=>'attachment','name'=>'staff-' . $first,'posts_per_page'=>1,'fields'=>'ids']);
              if ($att) $photo = wp_get_attachment_image_url($att[0], 'medium_large');
          }
        ?>
        <?php if ($photo): ?>
        <div style="width:100%;aspect-ratio:3/4;background:#1A1A1A;margin-bottom:18px;overflow:hidden;">
          <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr(wp_strip_all_tags($member['name'] . ', ' . html_entity_decode($member['role']))); ?> at Tony Allen Auto Service" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;">
        </div>
        <?php else: ?>
        <div style="width:100%;aspect-ratio:3/4;background:#1A1A1A;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
          <span style="font-size:11px;color:#444;font-weight:600;letter-spacing:.1em;text-transform:uppercase;">Photo<br>Coming Soon</span>
        </div>
        <?php endif; ?>
        <div class="au-team-card__name"><?php echo $member['name']; ?></div>
        <div class="au-team-card__role"><?php echo $member['role']; ?></div>
        <p class="au-team-card__bio"><?php echo esc_html($member['bio']); ?></p>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ══ FLEET & TRADE ══════════════════════════════════════════════════════════ -->
<section class="au-fleet" aria-labelledby="au-fleet-head">
  <div class="au-w">
    <div class="au-fleet__inner">
      <div>
        <span class="au-fleet__label">B2B Fleet Services</span>
        <h2 class="au-fleet__h2" id="au-fleet-head">Your workshop partner in South Auckland</h2>
        <div class="au-fleet__body">
          <p>TAAS Fleet exists for one reason — businesses need a workshop they can rely on. Whether you run two utes or two hundred vehicles, we offer the same thing: consistent service, transparent pricing, and vehicles back on the road fast. If downtime costs you money, this is the workshop you want on your supplier list.</p>
          <p>We work directly with businesses across South Auckland — trades companies, transport operators, logistics providers, and any business running light commercial vehicles. One point of contact, documented processes, and a workshop that understands commercial urgency.</p>
          <p>If your vehicles are owned by a lease or fleet management company, we invoice them directly — matching their required format, reference codes, and authorisation process. We're already set up with several of New Zealand's largest fleet management companies.</p>
        </div>
        <div class="au-partners">
          <span class="au-partners__label">Lease &amp; fleet company relationships</span>
          <div class="au-partner-tags">
            <span class="au-tag">SG Fleet NZ</span>
            <span class="au-tag">FleetPartners</span>
            <span class="au-tag">Custom Fleet</span>
            <span class="au-tag">Orix</span>
          </div>
        </div>
      </div>

      <div class="au-benefits">
        <div class="au-benefit">
          <div class="au-benefit__title">Direct B2B Relationship</div>
          <p class="au-benefit__desc">You deal with us directly. One point of contact, consistent pricing, and a workshop that knows your vehicles and your expectations. No call centres, no ticket systems.</p>
        </div>
        <div class="au-benefit">
          <div class="au-benefit__title">Lease Company Invoicing</div>
          <p class="au-benefit__desc">If your vehicles are lease company owned, we invoice the fleet management company directly — matching their required format, reference codes, and authorisation process. No admin burden back on your team.</p>
        </div>
        <div class="au-benefit">
          <div class="au-benefit__title">Scheduled Maintenance Windows</div>
          <p class="au-benefit__desc">Fleet vehicles are booked into dedicated maintenance windows to keep them moving. A vehicle off the road is a cost — and we schedule accordingly.</p>
        </div>
        <div class="au-benefit">
          <div class="au-benefit__title">Tyre &amp; Wheel Supply</div>
          <p class="au-benefit__desc">Fleet tyre and wheel procurement handled through Tyremax and YHI. Consistent supply, competitive pricing, single point of contact for your account.</p>
        </div>
        <div class="au-benefit">
          <div class="au-benefit__title">MBI Approved Repairer</div>
          <p class="au-benefit__desc">Approved for Autosure, Assurant, Provident, Janssen and Autolife. MBI claims handled correctly and efficiently — first time, every time.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ FAQ ══════════════════════════════════════════════════════════════════ -->
<section class="au-faq" aria-labelledby="au-faq-head">
  <div class="au-w">
    <div class="au-section-head">
      <span class="au-eye au-eye--light">Common Questions</span>
      <h2 class="au-section-h2" id="au-faq-head">Questions About Tony Allen Auto Service</h2>
    </div>
    <div style="max-width:800px;margin:0 auto;">
      <?php foreach ($au_faqs_schema as $i => $faq): ?>
      <div class="au-faq__item" style="border-bottom:1px solid #E8E8E4;">
        <button class="au-faq__btn"
          aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"
          style="width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#1A1A1A;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;">
          <?php echo esc_html($faq['q']); ?>
          <span class="au-faq__icon" style="position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;line-height:1;"><?php echo $i === 0 ? '−' : '+'; ?></span>
        </button>
        <div class="au-faq__ans" style="<?php echo $i === 0 ? '' : 'display:none;'; ?>padding:0 40px 20px 0;font-size:15px;color:#666;line-height:1.75;">
          <?php echo esc_html($faq['a']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>
.au-faq { background:#F7F7F5; padding:72px 0; }
</style>


<!-- ══ CTA BAND ════════════════════════════════════════════════════════════════ -->
<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:1140px;margin:0 auto;padding:0 32px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section class="au-cta" aria-label="Book a service">
  <div class="au-w">
    <div class="au-cta__inner">
      <h2 class="au-cta__h2">Ready to book your vehicle in?</h2>
      <p style="font-size:17px;color:#888;line-height:1.75;max-width:520px;margin:0 auto 28px;letter-spacing:-0.1px;font-weight:300;"><?php echo esc_html($years); ?> years at the same address. Call us.</p>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="au-cta__phone"><?php echo esc_html($phone_free); ?></a>
      <a href="tel:<?php echo esc_attr($phone_tel); ?>" style="font-size:16px;color:#888;text-decoration:none;"><?php echo esc_html($phone_local); ?></a>
      <p style="font-size:13px;color:#666;margin-top:12px;"><?php echo esc_html($hours); ?> · <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#888;text-decoration:underline;"><?php echo esc_html($address); ?></a></p>
    </div>
  </div>
</section>


<!-- ══ AWARDS ══════════════════════════════════════════════════════════════════ -->
<section class="au-awards" aria-label="Industry recognition">
  <div class="au-w">
    <div class="au-awards__inner">
      <div>
        <div class="au-awards__label">Industry recognition</div>
        <div class="au-awards__list">
          <span class="au-award-pill">🏆 MTA Best General Repairer — South Auckland 2010</span>
          <span class="au-award-pill">MTA Awards Finalist 2012</span>
          <span class="au-award-pill">MTA Awards Finalist 2014</span>
          <span class="au-award-pill">2 Degrees Business Awards Nominee 2026</span>
        </div>
      </div>
      <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured — Motor Trade Association" style="height:70px;width:auto;" loading="lazy">
    </div>
  </div>
</section>

</div><!-- /.taas-about -->

<script>
(function(){
  document.querySelectorAll('.au-faq__btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      var ans=this.nextElementSibling;
      var icon=this.querySelector('.au-faq__icon');
      var open=this.getAttribute('aria-expanded')==='true';
      document.querySelectorAll('.au-faq__btn').forEach(function(b){
        b.setAttribute('aria-expanded','false');
        b.nextElementSibling.style.display='none';
        b.querySelector('.au-faq__icon').textContent='+';
      });
      if(!open){this.setAttribute('aria-expanded','true');ans.style.display='';icon.textContent='−';}
    });
  });
})();
</script>
<?php get_footer(); ?>
