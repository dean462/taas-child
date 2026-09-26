<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /
 * CSS namespace: .hp-
 * Rebuilt to Go-Live Standard — June 2026
 *
 * Section order (Homepage adaptation of Go-Live Standard):
 * Hero → Phone Strip → Trust Strip(grey) → Sub-brands → Stats →
 * Services → Why TAAS / Reviews → Finance → Enquiry(dark) → FAQ
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url    = get_site_url();
$page_url    = get_permalink();
$established = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years       = date('Y') - intval($established);
$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$email       = defined('TAAS_EMAIL')       ? TAAS_EMAIL       : 'enquiries@taas.co.nz';
$address     = defined('TAAS_ADDRESS')     ? TAAS_ADDRESS     : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours       = defined('TAAS_HOURS')       ? TAAS_HOURS       : 'Monday–Friday 7:30am–5:00pm';
$wof_price   = defined('TAAS_WOF_PRICE')  ? TAAS_WOF_PRICE   : '$80';
$rating      = defined('TAAS_RATING')      ? TAAS_RATING      : '4.2';
$reviews     = defined('TAAS_REVIEWS')     ? TAAS_REVIEWS      : '200+';
$customers   = defined('TAAS_CUSTOMERS')   ? TAAS_CUSTOMERS    : '10,000+';
$euro_brands = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS  : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$cf7_general = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$ms_number   = defined('TAAS_MS_NUMBER')   ? TAAS_MS_NUMBER   : 'MS 13890';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$mta_badge      = $site_url . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png';
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list   = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list       = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';

// Hero image
$hero_img = defined('TAAS_HERO_HOMEPAGE') ? TAAS_HERO_HOMEPAGE
          : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');

// ── FAQ (shared from taas-faqs.php + homepage-specific order) ────────────────
$faqs = [
    $taas_faqs['wof_cost'],
    $taas_faqs['services_overview'],
    $taas_faqs['all_makes'],
    $taas_faqs['european'],
    $taas_faqs['location'],
    $taas_faqs['booking'],
    $taas_faqs['suburbs'],
    $taas_faqs['years_trading'],
    $taas_faqs['diagnostic_scan'],
    $taas_faqs['finance'],
    $taas_faqs['wof_recheck'],
    $taas_faqs['tyre_brands'],
    $taas_faqs['mbi'],
    $taas_faqs['fleet'],
    $taas_faqs['service_duration'],
    $taas_faqs['extra_work'],
    $taas_faqs['estimates'],
];

// ── Schema ──────────────────────────────────────────────────────────────────
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => ['AutoRepair', 'LocalBusiness'],
            '@id'         => $site_url . '/#business',
            'name'        => 'Tony Allen Auto Service',
            'url'         => $site_url,
            'description' => 'Manukau\'s trusted mechanic since 1985. Seven specialist divisions under one roof — servicing, WOF, brakes, auto electrical, tyres, European vehicles, fleet. Family-owned at 139 Cavendish Drive, Manukau, South Auckland.',
            'telephone'   => [$phone_free, '+6492789556'],
            'email'       => $email,
            'foundingDate'=> '1985-10',
            'address'     => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '139 Cavendish Drive',
                'addressLocality' => 'Manukau',
                'addressRegion'   => 'Auckland',
                'postalCode'      => '2104',
                'addressCountry'  => 'NZ',
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => -36.9935,
                'longitude' => 174.8661,
            ],
            'openingHoursSpecification' => [[
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
                'opens'     => '07:30',
                'closes'    => '17:00',
            ]],
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => $rating,
                'reviewCount' => preg_replace('/\D/', '', $reviews),
                'bestRating'  => '5',
            ],
            'sameAs' => [
                'https://www.facebook.com/tonyallenautoservice/',
                'https://www.instagram.com/tonyallenautoservice/',
                'https://www.linkedin.com/company/7059060',
            ],
            'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance',
            'priceRange'      => '$$',
            'areaServed'      => 'South Auckland',
            'memberOf'        => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)'],
        ],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.hp-hero__sub', '.hp-faq-a']],
        [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url . '/'],
            ],
        ],
        [
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(function($f) {
                return ['@type' => 'Question', 'name' => $f['q'],
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($f['a'])]];
            }, $faqs),
        ],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<style>
/* ══ RESET & NAMESPACE ═══════════════════════════════════════════════════ */
.page-template-template-homepage .site-content,
.page-template-template-homepage .entry-content,
.page-template-template-homepage .entry-header,
.page-template-template-homepage article,
.page-template-template-homepage #primary,
.page-template-template-homepage #content {
  padding:0!important; margin:0!important; max-width:100%!important;
}
body.page-template-template-homepage { overflow-x:hidden; }
.taas-hp *, .taas-hp *::before, .taas-hp *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-hp {
  --y:    var(--taas-yellow, #FFC800);
  --y2:   var(--taas-yellow2, #e6b400);
  --blk:  #0D0D0D;
  --drk:  var(--taas-dark, #1A1A1A);
  --body: var(--taas-body, #333333);
  --mid:  var(--taas-mid, #666);
  --pnl:  var(--taas-panel, #F7F7F5);
  --wht:  var(--taas-white, #fff);
  --bdr:  var(--taas-border, #E8E8E4);
  --font: var(--taas-font, 'Inter', Arial, sans-serif);
  --wrap: var(--taas-container, 1140px);
  --r:    var(--taas-radius, 6px);
  font-family: var(--font);
  color: var(--body);
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  text-size-adjust: 100%;
}
.taas-hp a { text-decoration: none; color: inherit; }
.taas-hp img { max-width: 100%; display: block; }
.taas-hp .w { max-width: var(--wrap); margin: 0 auto; padding: 0 24px; }

/* ══ BUTTONS ═════════════════════════════════════════════════════════════ */
.hp-btn {
  display: inline-flex; align-items: center; gap: 9px;
  font-family: var(--font); font-weight: 600; font-size: 15px;
  letter-spacing: .04em; text-transform: uppercase;
  padding: 14px 28px; border-radius: var(--r);
  transition: all .18s; cursor: pointer; border: none;
  -webkit-font-smoothing: antialiased;
}
.hp-btn--yellow { background: var(--y); color: #1A1A1A !important; }
.hp-btn--yellow:hover { background: var(--y2); color: #1A1A1A !important; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(255,200,0,.3); }
.hp-btn--outline { background: transparent; color: var(--y) !important; border: 2px solid var(--y); }
.hp-btn--outline:hover { background: var(--y); color: #1A1A1A !important; }
.hp-btn--outline svg { fill: var(--y); }
.hp-btn--outline:hover svg { fill: #1A1A1A; }
.taas-hp a.hp-btn--outline,
.taas-hp a.hp-btn--outline:link,
.taas-hp a.hp-btn--outline:visited { color: var(--y) !important; }
.taas-hp a.hp-btn--outline:hover { color: #1A1A1A !important; }
.hp-btn--dark { background: var(--drk); color: var(--wht); }
.hp-btn--dark:hover { background: #222; transform: translateY(-2px); }

/* ══ EYEBROWS ════════════════════════════════════════════════════════════ */
.hp-eye {
  display: inline-block; font-size: 10px; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase;
  padding: 4px 12px; border-radius: 2px; margin-bottom: 14px;
}
.hp-eye--dark { background: var(--drk); color: var(--y); }
.hp-eye--yellow { background: var(--y); color: var(--drk); }
.hp-eye--border { background: transparent; border: 1px solid var(--bdr); color: var(--mid); }

/* ══ SECTION HEADS ═══════════════════════════════════════════════════════ */
.hp-sh { text-align: center; margin-bottom: 48px; }
.hp-h2 {
  font-family: var(--font); font-size: clamp(30px,4vw,46px);
  font-weight: 900; color: var(--blk); line-height: 1.05;
  text-transform: uppercase; letter-spacing: -.01em;
}
.hp-h2 span { color: var(--y); }
.hp-h2--white { color: var(--wht); }
.hp-sub { font-size: 16px; color: var(--mid); margin-top: 12px; line-height: 1.75; font-weight: 300; letter-spacing: -0.1px; max-width: 560px; }
.hp-sh .hp-sub { margin: 12px auto 0; }

/* ══ HERO ════════════════════════════════════════════════════════════════ */
.hp-hero {
  background: var(--blk);
  min-height: 600px;
  display: flex; align-items: center;
  position: relative; overflow: hidden;
  padding: 90px 0 80px;
}
.hp-hero--has-image {
  background-size: cover; background-position: center 40%;
}
.hp-hero::before {
  content: '';
  position: absolute; inset: 0; z-index: 0;
  background:
    repeating-linear-gradient(
      -55deg, transparent, transparent 60px,
      rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px
    ),
    rgba(13,13,13,.82);
  pointer-events: none;
}
.hp-hero::after {
  content: '';
  position: absolute; right: 0; top: 0; bottom: 0;
  width: 3px; background: var(--y); opacity: .5;
}
.hp-hero .w {
  position: relative; z-index: 1;
  display: grid; grid-template-columns: 1fr 360px;
  gap: 64px; align-items: center;
}
.hp-hero__eyebrow {
  display: flex; align-items: center; gap: 10px; margin-bottom: 24px;
}
.hp-hero__line { width: 36px; height: 2px; background: var(--y); opacity: .5; }
.hp-hero__eye-txt {
  font-size: 11px; font-weight: 700; letter-spacing: .18em;
  text-transform: uppercase; color: var(--y);
}
.hp-hero__h1 {
  font-family: var(--font);
  font-size: clamp(48px, 6vw, 76px);
  font-weight: 900; color: var(--wht);
  line-height: 1.0; letter-spacing: -.01em;
  text-transform: uppercase; margin-bottom: 26px;
}
.hp-hero__h1 em { color: var(--y); font-style: normal; display: block; }
.hp-hero__sub {
  font-size: 16px; color: #aaa; line-height: 1.75; font-weight: 300; letter-spacing: -0.1px;
  max-width: 500px; margin-bottom: 36px;
}
.hp-hero__ctas { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }

/* Hero trust card */
.hp-hero__card {
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.1);
  border-top: 3px solid var(--y);
  padding: 28px 24px;
}
.hp-hero__card-title {
  font-size: 10px; font-weight: 700; letter-spacing: .18em;
  text-transform: uppercase; color: var(--y); margin-bottom: 20px;
}
.hp-hero__trust-item {
  display: flex; align-items: flex-start; gap: 14px;
  padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,.07);
}
.hp-hero__trust-item:last-child { border-bottom: none; }
.hp-hero__trust-icon {
  width: 48px; height: 48px; flex-shrink: 0;
  background: rgba(255,200,0,.1); border: 1px solid rgba(255,200,0,.2);
  border-radius: var(--r);
  display: flex; align-items: center; justify-content: center;
  font-size: 17px;
}
.hp-hero__trust-icon--logo {
  width: 48px; height: 48px; flex-shrink: 0;
  background: transparent; border: none; padding: 0; border-radius: 0;
  display: flex; align-items: center; justify-content: center;
}
.hp-hero__trust-icon--logo img {
  max-width: 48px; max-height: 48px; width: auto; height: auto;
  object-fit: contain; display: block;
}
.hp-hero__trust-icon--google,
.hp-hero__trust-icon--nzta {
  width: 48px; height: 48px; flex-shrink: 0;
  background: transparent; border: none; padding: 0; border-radius: 0;
  display: flex; align-items: center; justify-content: center;
  overflow: visible;
}
.hp-hero__trust-label { font-size: 14px; font-weight: 700; color: var(--wht); line-height: 1.3; }
.hp-hero__trust-sub { font-size: 12px; color: #999; margin-top: 2px; }

/* Hero animations */
@keyframes hp-fadeup {
  from { opacity:0; transform:translateY(20px); }
  to   { opacity:1; transform:translateY(0); }
}
.hp-hero__eyebrow { animation: hp-fadeup .5s ease both; }
.hp-hero__h1      { animation: hp-fadeup .5s .1s ease both; }
.hp-hero__sub     { animation: hp-fadeup .5s .2s ease both; }
.hp-hero__ctas    { animation: hp-fadeup .5s .3s ease both; }
.hp-hero__card    { animation: hp-fadeup .6s .4s ease both; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════ */
.hp-pstrip { background: var(--y); padding: 18px 0; }
.hp-pstrip .w {
  display: flex; align-items: center;
  justify-content: space-between; gap: 24px;
}
.hp-pstrip__left { display: flex; align-items: center; gap: 16px; }
.hp-pstrip__lbl { font-size: 10px; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; color: #1A1A1A; }
.hp-pstrip__div { width: 1px; height: 28px; background: rgba(26,26,26,.2); }
.hp-pstrip__num {
  font-family: var(--font); font-size: 28px; font-weight: 900;
  color: #1A1A1A; letter-spacing: .01em; text-decoration: none;
  transition: opacity .15s;
}
.hp-pstrip__num:hover { opacity: .65; }
.hp-pstrip__hours { font-size: 13px; font-weight: 600; color: #1A1A1A; opacity: .75; }
.hp-pstrip__email {
  font-size: 15px; font-weight: 700; color: #FFC800;
  display: flex; align-items: center; gap: 8px;
  background: #1A1A1A; padding: 10px 20px; border-radius: 4px;
  text-decoration: none; transition: background .15s, transform .15s;
}
.hp-pstrip__email:hover { background: #333; color: #FFC800; transform: translateY(-1px); }
.hp-pstrip__email svg { fill: #FFC800; }
.taas-hp .hp-pstrip__email,
.taas-hp .hp-pstrip__email:link,
.taas-hp .hp-pstrip__email:visited { color: #FFC800 !important; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════ */
.hp-trust { background: var(--pnl); padding: 16px 0; border-bottom: 1px solid var(--bdr); }
.hp-trust__inner { display: flex; gap: 32px; align-items: center; justify-content: center; flex-wrap: wrap; }
.hp-trust__item { font-size: 13px; font-weight: 600; color: var(--drk); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.hp-trust__item::before { content: '\2713'; font-weight: 900; color: var(--y); }

/* ══ SUB-BRANDS ══════════════════════════════════════════════════════════ */
.hp-brands { background: var(--wht); padding: 72px 0 80px; }
.hp-brands-grid {
  display: grid; grid-template-columns: repeat(4,1fr); gap: 3px;
}
.hp-brand {
  background: var(--drk); padding: 34px 26px 30px;
  display: flex; flex-direction: column;
  position: relative; overflow: hidden;
  transition: transform .2s, box-shadow .2s;
  min-height: 290px; cursor: pointer;
}
.hp-brand::after {
  content: '';
  position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
  background: var(--y); transform: scaleX(0);
  transition: transform .25s; transform-origin: left;
}
.hp-brand:hover { transform: translateY(-5px); box-shadow: 0 20px 48px rgba(0,0,0,.35); }
.hp-brand:hover::after { transform: scaleX(1); }
.hp-brand__bg {
  position: absolute; right: 12px; bottom: -8px;
  font-family: var(--font); font-size: 110px; font-weight: 900;
  color: rgba(255,255,255,.03); line-height: 1;
  pointer-events: none; user-select: none;
}
.hp-brand__icon {
  width: 46px; height: 46px;
  background: rgba(255,200,0,.1); border: 1px solid rgba(255,200,0,.2);
  border-radius: var(--r); display: flex; align-items: center;
  justify-content: center; font-size: 20px; margin-bottom: 20px; flex-shrink: 0;
}
.hp-brand__icon--badge {
  width: 46px; height: 46px;
  background: transparent !important; border: none !important;
  border-radius: 0 !important;
  padding: 0; margin-bottom: 20px; flex-shrink: 0;
}
.hp-brand__name {
  font-family: var(--font); font-size: 17px; font-weight: 800;
  color: var(--wht); text-transform: uppercase; letter-spacing: .05em;
  margin-bottom: 6px; line-height: 1.2;
}
.hp-brand__tag {
  font-size: 11px; font-weight: 700; letter-spacing: .1em;
  text-transform: uppercase; color: var(--y); margin-bottom: 12px;
}
.hp-brand__desc { font-size: 14px; color: #999; line-height: 1.75; font-weight: 300; flex: 1; }
.hp-brand__link {
  margin-top: 22px; display: inline-flex; align-items: center;
  gap: 6px; font-size: 12px; font-weight: 700; letter-spacing: .08em;
  text-transform: uppercase; color: var(--y);
  transition: gap .15s;
}
.hp-brand:hover .hp-brand__link { gap: 10px; }

/* ══ STATS BAND ══════════════════════════════════════════════════════════ */
.hp-stats { background: var(--blk); padding: 0; }
.hp-stats .w {
  display: grid; grid-template-columns: repeat(4,1fr);
}
.hp-stat {
  padding: 44px 24px; text-align: center;
  border-right: 1px solid #1a1a1a;
  position: relative; overflow: hidden;
}
.hp-stat:last-child { border-right: none; }
.hp-stat::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: var(--y); transform: scaleX(0);
  transition: transform .3s; transform-origin: left;
}
.hp-stat:hover::before { transform: scaleX(1); }
.hp-stat__num {
  font-family: var(--font); font-size: 52px; font-weight: 900;
  color: var(--y); line-height: 1; margin-bottom: 6px;
}
.hp-stat__lbl { font-size: 12px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: #888; }

/* ══ SERVICES ════════════════════════════════════════════════════════════ */
.hp-services { background: var(--pnl); padding: 72px 0; }
.hp-svc-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; }
.hp-svc {
  background: var(--wht); border: 1px solid var(--bdr);
  border-top: 3px solid transparent; padding: 26px 22px;
  transition: border-top-color .2s, box-shadow .2s, transform .2s;
  text-decoration: none; display: block; color: inherit;
}
.hp-svc:hover {
  border-top-color: var(--y);
  box-shadow: 0 8px 24px rgba(0,0,0,.08);
  transform: translateY(-2px);
}
.hp-svc__icon { font-size: 26px; margin-bottom: 14px; display: block; line-height: 1; }
.hp-svc__icon svg { display: block; }
.hp-svc__name { font-size: 16px; font-weight: 700; color: var(--blk); margin-bottom: 7px; letter-spacing: -.01em; }
.hp-svc__desc { font-size: 14px; color: var(--mid); line-height: 1.75; font-weight: 300; }

/* ══ WHY TAAS ════════════════════════════════════════════════════════════ */
.hp-why { background: var(--wht); padding: 80px 0; }
.hp-why .w { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: start; }
.hp-checklist { list-style: none; display: flex; flex-direction: column; gap: 13px; margin-top: 28px; }
.taas-hp .hp-checklist li.hp-check {
  display: flex; align-items: flex-start; gap: 12px;
  font-size: 15px !important; font-weight: 300 !important; color: var(--body) !important;
  line-height: 1.75 !important; letter-spacing: -0.1px !important;
  padding: 0 !important; margin: 0 !important;
}
.hp-check__icon {
  width: 22px; height: 22px; background: var(--y); border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; margin-top: 1px; font-size: 11px; font-weight: 900; color: var(--drk);
}
.hp-accred-row { display: flex; flex-direction: column; gap: 10px; margin-top: 28px; }
.hp-accred-txt { font-size: 14px; font-weight: 300; color: var(--mid); line-height: 1.75; }
.hp-accred-txt strong { color: var(--body); display: block; font-size: 14px; font-weight: 700; margin-bottom: 1px; }

/* Reviews panel */
.hp-reviews {
  background: var(--pnl); border: 1px solid var(--bdr);
  border-left: 4px solid var(--y); padding: 28px;
}
.hp-reviews__head { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
.hp-stars { color: #f0b429; font-size: 18px; letter-spacing: 2px; }
.hp-rating { font-size: 28px; font-weight: 900; color: var(--blk); }
.hp-rcount { font-size: 13px; color: var(--mid); font-weight: 600; }
.hp-mta { margin-top: 28px; }
.hp-mta-wrap { display: flex; align-items: center; gap: 24px; flex-wrap: wrap; }
.hp-mta-wrap img { height: 90px; width: auto; }

/* ══ FINANCE ═════════════════════════════════════════════════════════════ */
.hp-finance { background: var(--pnl); padding: 72px 0; position: relative; overflow: hidden; }
.hp-finance .w { position: relative; z-index: 1; }
.hp-finance-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 14px; margin-top: 40px; }
.hp-fin-card {
  background: var(--wht); border: 1px solid var(--bdr);
  border-top: 3px solid transparent;
  padding: 28px 24px; border-radius: var(--r);
  transition: border-top-color .2s, box-shadow .2s, transform .2s;
}
.hp-fin-card:hover { border-top-color: var(--y); box-shadow: 0 8px 24px rgba(0,0,0,.08); transform: translateY(-2px); }
.hp-fin-card__name { font-size: 16px; font-weight: 800; color: var(--blk); margin-bottom: 8px; }
.hp-fin-card__desc { font-size: 14px; color: var(--mid); line-height: 1.75; font-weight: 300; }
.hp-fin-card__link { display: inline-block; margin-top: 14px; font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--drk); }

/* ══ ENQUIRY (dark) ══════════════════════════════════════════════════════ */
.hp-enquiry-section { background: var(--blk); padding: 72px 0; border-top: 3px solid var(--y); }
.hp-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.taas-hp .hp-enquiry__phone { display: block; font-size: clamp(28px,4vw,40px); font-weight: 800; color: #FFC800; text-decoration: none; margin: 16px 0 6px; transition: opacity .15s; }
.taas-hp .hp-enquiry__phone:hover { opacity: .65; }
.hp-enquiry__detail { font-size: 15px; font-weight: 300; color: #aaa; line-height: 1.75; }
.hp-enquiry__detail strong { color: #fff; font-weight: 700; }
.hp-enquiry__estimate {
  margin-top: 20px; padding: 14px 18px;
  background: rgba(255,200,0,.08); border-left: 3px solid var(--y);
  border-radius: 0 var(--r) var(--r) 0;
  font-size: 14px; font-weight: 600; color: var(--y); line-height: 1.5;
}
.hp-enquiry__finance-logos { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 20px; align-items: center; }
.hp-enquiry__fin-img { height: 32px; width: auto; object-fit: contain; background: #fff; border-radius: 6px; padding: 8px 14px; transition: transform .15s; }
.hp-enquiry__fin-img:hover { transform: scale(1.05); }
.hp-enquiry__fin-link { font-size: 12px; font-weight: 700; color: var(--y); text-decoration: none; margin-top: 8px; display: inline-block; }
.hp-enquiry__fin-link:hover { text-decoration: underline; }
.hp-enquiry__form-title { font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--y); margin-bottom: 16px; }

/* CF7 form styling in enquiry */
.hp-enquiry .wpcf7 p { margin: 0 0 16px 0 !important; }
.hp-enquiry .wpcf7 input[type="text"],
.hp-enquiry .wpcf7 input[type="email"],
.hp-enquiry .wpcf7 input[type="tel"],
.hp-enquiry .wpcf7 textarea,
.hp-enquiry .wpcf7 select {
  width: 100% !important; padding: 11px 14px !important;
  border: 1px solid #444 !important; border-radius: var(--r) !important;
  font-family: var(--font) !important; font-size: 14px !important;
  color: #fff !important; background: rgba(255,255,255,.06) !important;
  box-sizing: border-box !important; margin: 6px 0 0 0 !important; display: block !important;
}
.hp-enquiry .wpcf7 input:focus,
.hp-enquiry .wpcf7 textarea:focus { outline: none !important; border-color: var(--y) !important; }
.hp-enquiry .wpcf7 textarea { min-height: 100px !important; resize: vertical !important; }
.hp-enquiry .wpcf7 label { font-size: 13px !important; font-weight: 600 !important; color: #ccc !important; display: block !important; }
.hp-enquiry .wpcf7 input[type="submit"] {
  width: 100% !important; background: var(--y) !important; color: #1A1A1A !important;
  font-family: var(--font) !important; font-size: 14px !important; font-weight: 700 !important;
  padding: 13px !important; border: none !important; border-radius: var(--r) !important;
  cursor: pointer !important; letter-spacing: .03em !important; text-transform: uppercase !important; margin-top: 4px !important;
}
.hp-enquiry .wpcf7 input[type="submit"]:hover { background: var(--y2) !important; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════ */
.hp-faq { background: var(--wht); padding: 72px 0; }
.hp-faq .w { max-width: 800px; }
.hp-faq-list { margin-top: 40px; }
.hp-faq-item { border-bottom: 1px solid var(--bdr); }
.hp-faq-q {
  width: 100%; background: none; border: none; text-align: left;
  padding: 20px 0; font-family: var(--font); font-size: 16px; font-weight: 700; color: var(--blk);
  display: flex; justify-content: space-between; align-items: center;
  cursor: pointer; gap: 16px; user-select: none;
}
.hp-faq-q::after { content: '+'; font-size: 24px; font-weight: 400; color: var(--y); flex-shrink: 0; transition: transform .2s; }
.hp-faq-item.is-open .hp-faq-q::after { transform: rotate(45deg); }
.hp-faq-a { font-size: 15px; color: var(--mid); line-height: 1.75; font-weight: 300; padding-bottom: 20px; display: none; }
.hp-faq-a a { color: var(--y); font-weight: 600; text-decoration: underline; }
.hp-faq-item.is-open .hp-faq-a { display: block; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════ */
@media(max-width:1024px) {
  .hp-hero .w { grid-template-columns: 1fr; }
  .hp-hero__card { display: none; }
  .hp-brands-grid { grid-template-columns: repeat(2,1fr); }
  .hp-stats .w { grid-template-columns: repeat(2,1fr); }
  .hp-svc-grid { grid-template-columns: repeat(2,1fr); }
  .hp-why .w { grid-template-columns: 1fr; gap: 40px; }
  .hp-finance-grid { grid-template-columns: repeat(3,1fr); }
  .hp-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media(max-width:640px) {
  /* Layout */
  .hp-brands-grid { grid-template-columns: 1fr; gap: 2px; }
  .hp-stats .w { grid-template-columns: repeat(2,1fr); }
  .hp-svc-grid { grid-template-columns: 1fr; }
  .hp-finance-grid { grid-template-columns: 1fr; }
  .hp-brand__bg { display: none; }
  .hp-hero__ctas { flex-direction: column; align-items: stretch; }
  .hp-hero__ctas .hp-btn { justify-content: center; }

  /* Phone strip */
  .hp-pstrip .w { flex-direction: column; text-align: center; gap: 8px; }
  .hp-pstrip__lbl { display: none; }
  .hp-pstrip__div { display: none; }
  .hp-pstrip__num { font-size: 22px; }
  .hp-pstrip__hours { font-size: 12px; }

  /* Trust strip */
  .hp-trust__inner { display: grid; grid-template-columns: 1fr 1fr; gap: 6px 16px; justify-items: start; }
  .hp-trust__item { font-size: 12px; white-space: normal; }

  /* Section spacing */
  .hp-sh { margin-bottom: 28px; }
  .hp-hero { padding: 48px 0 40px; min-height: auto; }
  .hp-why { padding: 48px 0; }
  .hp-brands { padding: 48px 0; }
  .hp-services { padding: 48px 0; }
  .hp-finance { padding: 48px 0; }
  .hp-faq { padding: 48px 0; }
  .hp-enquiry-section { padding: 48px 0; }
  .hp-stats .hp-stat { padding: 28px 16px; }

  /* Type scale — mobile */
  .hp-hero__h1 { font-size: clamp(30px, 8vw, 48px); }
  .hp-hero__sub { font-size: 14px; margin-bottom: 28px; }
  .hp-h2 { font-size: clamp(22px, 6vw, 32px); }
  .hp-sub { font-size: 14px; }
  .hp-btn { font-size: 14px; padding: 12px 22px; }
  .hp-stat__num { font-size: 32px; }
  .hp-stat__lbl { font-size: 11px; }
  .hp-brand__name { font-size: 15px; }
  .hp-brand__tag { font-size: 10px; }
  .hp-brand__desc { font-size: 13px; }
  .hp-brand__link { font-size: 11px; }
  .hp-brand { min-height: 220px; padding: 24px 20px; }
  .hp-svc { padding: 20px 18px; }
  .hp-svc__name { font-size: 14px; }
  .hp-svc__desc { font-size: 13px; }
  .hp-checklist { gap: 10px; margin-top: 20px; }
  .taas-hp .hp-checklist li.hp-check { font-size: 14px !important; gap: 10px; }
  .hp-check__icon { width: 20px; height: 20px; font-size: 10px; }
  .hp-accred-txt { font-size: 14px; }
  .hp-accred-txt strong { font-size: 14px; }
  .hp-fin-card { padding: 20px 18px; }
  .hp-fin-card__name { font-size: 14px; }
  .hp-fin-card__desc { font-size: 13px; }
  .hp-faq-q { font-size: 14px; padding: 16px 0; }
  .hp-faq-a { font-size: 14px; padding-bottom: 16px; }

  /* Enquiry mobile — form first */
  .hp-enquiry { display: flex; flex-direction: column-reverse; gap: 32px; }
  .hp-enquiry__phone { font-size: clamp(24px,6vw,32px); }
  .hp-enquiry__detail { font-size: 14px; }
  .hp-enquiry__fin-img { height: 28px; padding: 6px 10px; }
}
</style>

<div class="taas-hp">

<!-- ══ HERO ═══════════════════════════════════════════════════════════════ -->
<section class="hp-hero<?php echo $hero_img ? ' hp-hero--has-image' : ''; ?>" aria-label="Homepage hero"<?php echo $hero_img ? ' style="background-image:url(\'' . esc_url($hero_img) . '\')"' : ''; ?>>
  <div class="w">
    <div class="hp-hero__left">
      <div class="hp-hero__eyebrow">
        <div class="hp-hero__line"></div>
        <span class="hp-hero__eye-txt">South Auckland's Largest Independent Workshop</span>
      </div>
      <h1 class="hp-hero__h1">
        Manukau&rsquo;s<br>
        <em>trusted mechanic</em>
        since 1985.
      </h1>
      <p class="hp-hero__sub">
        A South Auckland family workshop since 1985, with seven divisions under one roof.
        MTA Assured and NZTA Authorised, so your car&rsquo;s in good hands.
        Enquiries before 3pm answered same day, estimates within one business day.
      </p>
      <div class="hp-hero__ctas">
        <a href="/contact-us/" class="hp-btn hp-btn--yellow">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 3h-1V1h-2v2H8V1H6v2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg>
          Book Your Car In
        </a>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hp-btn hp-btn--outline">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
          <?php echo esc_html($phone_free); ?>
        </a>
      </div>
    </div>

    <div class="hp-hero__card" aria-hidden="true">
      <div class="hp-hero__card-title">Why customers choose TAAS</div>
      <div class="hp-hero__trust-item">
        <div class="hp-hero__trust-icon hp-hero__trust-icon--google">
          <svg width="44" height="44" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-label="Google Reviews">
            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
            <path fill="none" d="M0 0h48v48H0z"/>
          </svg>
        </div>
        <div>
          <div class="hp-hero__trust-label"><?php echo esc_html($rating); ?> Stars &nbsp;&middot;&nbsp; <?php echo esc_html($reviews); ?> Reviews</div>
          <div class="hp-hero__trust-sub">Google verified — real customers</div>
        </div>
      </div>
      <div class="hp-hero__trust-item">
        <div class="hp-hero__trust-icon hp-hero__trust-icon--logo">
          <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured" width="48" height="48" loading="eager" style="width:48px;height:48px;object-fit:contain;">
        </div>
        <div>
          <div class="hp-hero__trust-label">MTA Assured</div>
          <div class="hp-hero__trust-sub">Motor Trade Association accredited</div>
        </div>
      </div>
      <div class="hp-hero__trust-item">
        <div class="hp-hero__trust-icon hp-hero__trust-icon--logo">
          <svg width="34" height="38" viewBox="0 0 34 38" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M17 1L2 7V19C2 27.284 8.716 34.716 17 37C25.284 34.716 32 27.284 32 19V7L17 1Z" fill="rgba(255,200,0,0.15)" stroke="#FFC800" stroke-width="1.5"/>
            <text x="17" y="16" text-anchor="middle" font-family="Arial,sans-serif" font-size="9" font-weight="900" fill="#FFC800">EST.</text>
            <text x="17" y="27" text-anchor="middle" font-family="Arial,sans-serif" font-size="9" font-weight="900" fill="#FFC800">1985</text>
          </svg>
        </div>
        <div>
          <div class="hp-hero__trust-label"><?php echo esc_html($years); ?> Years in Manukau</div>
          <div class="hp-hero__trust-sub">Family-owned since October <?php echo esc_html($established); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PHONE STRIP ═══════════════════════════════════════════════════════ -->
<div class="hp-pstrip" role="complementary" aria-label="Contact details">
  <div class="w">
    <div class="hp-pstrip__left">
      <span class="hp-pstrip__lbl">Call us</span>
      <div class="hp-pstrip__div"></div>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hp-pstrip__num"><?php echo esc_html($phone_free); ?></a>
      <div class="hp-pstrip__div"></div>
      <span class="hp-pstrip__hours">Mon&ndash;Fri 7:30am&ndash;5:00pm</span>
    </div>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="hp-pstrip__email">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      <?php echo esc_html($email); ?>
    </a>
  </div>
</div>

<!-- ══ TRUST STRIP ═══════════════════════════════════════════════════════ -->
<div class="hp-trust"><div class="w">
  <div class="hp-trust__inner">
    <div class="hp-trust__item">MTA Assured</div>
    <div class="hp-trust__item">NZTA Authorised</div>
    <div class="hp-trust__item">Estimate Before We Start</div>
    <div class="hp-trust__item">Seven Divisions, One Workshop</div>
    <div class="hp-trust__item"><?php echo esc_html($rating); ?>&#9733; &middot; <?php echo esc_html($reviews); ?> Reviews</div>
    <div class="hp-trust__item">Since <?php echo esc_html($established); ?></div>
  </div>
</div></div>


<!-- ══ SUB-BRANDS — THE FOUR DOORS ═══════════════════════════════════════ -->
<section class="hp-brands" aria-labelledby="hp-brands-head">
  <div class="w">
    <div class="hp-sh">
      <h2 class="hp-h2" id="hp-brands-head">Find the <span>right service</span><br>for your situation</h2>
      <p class="hp-sub">Not every problem comes with a name. If you&rsquo;re not sure what your car needs, just give us a call and tell us what&rsquo;s happening &mdash; we&rsquo;ll take it from there.</p>
    </div>
    <div class="hp-brands-grid">

      <a href="<?php echo esc_url($site_url . '/services/'); ?>" class="hp-brand" style="text-decoration:none;">
        <div class="hp-brand__bg">1</div>
        <div class="hp-brand__icon hp-brand__icon--badge">
          <svg width="46" height="46" viewBox="0 0 46 46" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="23" cy="23" r="23" fill="#0D0D0D"/>
            <text x="23" y="28" text-anchor="middle" font-family="Inter, Arial, sans-serif" font-size="15" font-weight="700" font-style="italic" fill="#FFC800" letter-spacing="-0.5">TAAS</text>
          </svg>
        </div>
        <div class="hp-brand__name">Tony Allen<br>Auto Service</div>
        <div class="hp-brand__tag">Full-service workshop</div>
        <div class="hp-brand__desc">South Auckland's largest independent workshop. Servicing, diagnostics, WOF, auto electrical, steering &amp; suspension, tyres &mdash; all in-house.</div>
        <div class="hp-brand__link">All Services &rarr;</div>
      </a>

      <a href="<?php echo esc_url($site_url . '/manukau-brake-clutch/'); ?>" class="hp-brand" style="text-decoration:none;">
        <div class="hp-brand__bg">2</div>
        <div class="hp-brand__icon hp-brand__icon--badge">
          <svg width="46" height="46" viewBox="0 0 46 46" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="23" cy="23" r="23" fill="#0D0D0D"/>
            <text x="23" y="29" text-anchor="middle" font-family="Inter, Arial, sans-serif" font-size="18" font-weight="700" font-style="italic" fill="#FFC800" letter-spacing="-0.5">MBC</text>
          </svg>
        </div>
        <div class="hp-brand__name">Manukau<br>Brake &amp; Clutch</div>
        <div class="hp-brand__tag">Brake &amp; Clutch Specialists</div>
        <div class="hp-brand__desc">South Auckland&rsquo;s dedicated brake and clutch specialists. Brake replacements, repairs and machining; clutch replacements, repairs and fault diagnosis.</div>
        <div class="hp-brand__link">Learn More &rarr;</div>
      </a>

      <a href="<?php echo esc_url($site_url . '/manukau-batteries/'); ?>" class="hp-brand" style="text-decoration:none;">
        <div class="hp-brand__bg">3</div>
        <div class="hp-brand__icon hp-brand__icon--badge">
          <svg width="46" height="46" viewBox="0 0 46 46" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="23" cy="23" r="23" fill="#0D0D0D"/>
            <text x="23" y="29" text-anchor="middle" font-family="Inter, Arial, sans-serif" font-size="18" font-weight="700" font-style="italic" fill="#FFC800" letter-spacing="-0.5">MB</text>
          </svg>
        </div>
        <div class="hp-brand__name">Manukau<br>Batteries</div>
        <div class="hp-brand__tag">Battery Specialists</div>
        <div class="hp-brand__desc">Car, commercial, marine, and deep-cycle batteries. Supply and fit. If your car won&rsquo;t start, we&rsquo;ll get you sorted fast.</div>
        <div class="hp-brand__link">Learn More &rarr;</div>
      </a>

      <a href="<?php echo esc_url($site_url . '/european/'); ?>" class="hp-brand" style="text-decoration:none;">
        <div class="hp-brand__bg">4</div>
        <div class="hp-brand__icon hp-brand__icon--badge">
          <svg width="46" height="46" viewBox="0 0 46 46" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="23" cy="23" r="23" fill="#0D0D0D"/>
            <text x="23" y="28" text-anchor="middle" font-family="Inter, Arial, sans-serif" font-size="15" font-weight="700" font-style="italic" fill="#FFC800" letter-spacing="-0.5">EURO</text>
          </svg>
        </div>
        <div class="hp-brand__name">TAAS<br>European</div>
        <div class="hp-brand__tag">European Vehicle Specialists</div>
        <div class="hp-brand__desc"><?php echo esc_html($euro_brands); ?>. Specialist knowledge. Independent workshop pricing.</div>
        <div class="hp-brand__link">Learn More &rarr;</div>
      </a>

    </div>
  </div>
</section>


<!-- ══ STATS BAND ════════════════════════════════════════════════════════ -->
<div class="hp-stats" aria-label="TAAS by the numbers">
  <div class="w">
    <div class="hp-stat">
      <div class="hp-stat__num"><?php echo esc_html($years); ?></div>
      <div class="hp-stat__lbl">Years Trading</div>
    </div>
    <div class="hp-stat">
      <div class="hp-stat__num">7</div>
      <div class="hp-stat__lbl">Specialist Divisions</div>
    </div>
    <div class="hp-stat">
      <div class="hp-stat__num"><?php echo esc_html($rating); ?>&#9733;</div>
      <div class="hp-stat__lbl">Average Rating</div>
    </div>
    <div class="hp-stat">
      <div class="hp-stat__num"><?php echo esc_html($customers); ?></div>
      <div class="hp-stat__lbl">Customer Database</div>
    </div>
  </div>
</div>


<!-- ══ SERVICES GRID ═════════════════════════════════════════════════════ -->
<section class="hp-services" aria-labelledby="hp-svc-head">
  <div class="w">
    <div class="hp-sh">
      <span class="hp-eye hp-eye--border">What We Do</span>
      <h2 class="hp-h2" id="hp-svc-head">Everything your car needs.<br><span>Under one roof.</span></h2>
    </div>
    <div class="hp-svc-grid">
      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
        <div class="hp-svc__name">Servicing &amp; Maintenance</div>
        <div class="hp-svc__desc">Scheduled servicing, oil changes, filters, belts and fluids for all makes and models.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/wof/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="2"/><path d="m9 12 2 2 4-4"/></svg></span>
        <div class="hp-svc__name">Warrant of Fitness</div>
        <div class="hp-svc__desc">NZTA Authorised. WOF from <?php echo esc_html($wof_price); ?>. Walk-ins welcome mornings, bookings recommended.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/manukau-brake-clutch/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="9"/><line x1="12" y1="15" x2="12" y2="22"/><line x1="2" y1="12" x2="9" y2="12"/><line x1="15" y1="12" x2="22" y2="12"/></svg></span>
        <div class="hp-svc__name">Brakes &amp; Clutch</div>
        <div class="hp-svc__desc">Full brake system service, disc machining, clutch replacement, caliper rebuilds. All done in-house by Manukau Brake &amp; Clutch.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/auto-electrical/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
        <div class="hp-svc__name">Auto Electrical &amp; Diagnostics</div>
        <div class="hp-svc__desc">Fault diagnosis, auto electrical, sensors and wiring. We verify the fault before any part gets replaced.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/steering-and-suspension/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="9" x2="12" y2="2"/><line x1="9" y1="11" x2="2.6" y2="7.5"/><line x1="15" y1="11" x2="21.4" y2="7.5"/></svg></span>
        <div class="hp-svc__name">Steering &amp; Suspension</div>
        <div class="hp-svc__desc">Wheel alignment, shocks, struts, ball joints, tie rod ends and steering rack repair.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/air-conditioning/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="2" x2="12" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><path d="m20 16-4-4 4-4"/><path d="m4 8 4 4-4 4"/><path d="m16 4-4 4-4-4"/><path d="m8 20 4-4 4 4"/></svg></span>
        <div class="hp-svc__name">Air Conditioning</div>
        <div class="hp-svc__desc">AC regas, leak detection, and full system repairs. Not blowing cold? We find out why and fix it.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-centre/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="8"/><line x1="12" y1="16" x2="12" y2="22"/><line x1="2" y1="12" x2="8" y2="12"/><line x1="16" y1="12" x2="22" y2="12"/></svg></span>
        <div class="hp-svc__name">Tyres &amp; Wheels</div>
        <div class="hp-svc__desc">Supply and fit, wheel balancing and alignment. Budget through to premium brands stocked.</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/fleet-servicing/'); ?>" class="hp-svc">
        <span class="hp-svc__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></span>
        <div class="hp-svc__name">Fleet Servicing</div>
        <div class="hp-svc__desc">Dedicated B2B fleet servicing. Priority bookings, direct invoicing, one point of contact for your business vehicles.</div>
      </a>
    </div>
  </div>
</section>


<!-- ══ WHY TAAS + REVIEWS ════════════════════════════════════════════════ -->
<section class="hp-why" aria-labelledby="hp-why-head">
  <div class="w">
    <div>
      <span class="hp-eye hp-eye--dark">Why TAAS</span>
      <h2 class="hp-h2" style="margin-top:14px;" id="hp-why-head"><?php echo esc_html($years); ?> years.<br>Same <span>family.</span><br>Same street.</h2>
      <ul class="hp-checklist">
        <li class="hp-check"><span class="hp-check__icon">&check;</span>Independent, family-owned &amp; operated</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span><?php echo esc_html($division_count); ?> specialist divisions under one roof &mdash; servicing, brakes, tyres, batteries, auto electrical, European, fleet</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>Estimate before we start &mdash; nothing happens without your approval</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>We verify the fault before replacing any part</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>We explain what we find and what it costs &mdash; no jargon, no surprises</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>Finance available &mdash; <?php echo esc_html($finance_list); ?></li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>MBI approved repairer &mdash; <?php echo esc_html($mbi_list); ?></li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>MTA Assured &mdash; Motor Trade Association member</li>
        <li class="hp-check"><span class="hp-check__icon">&check;</span>NZTA Authorised &mdash; <?php echo esc_html($ms_number); ?></li>
      </ul>
      <div class="hp-mta" style="margin-top:24px;">
        <div class="hp-mta-wrap">
          <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured — Motor Trade Association member" width="120" loading="lazy">
          <div style="background:transparent;padding:0;display:inline-flex;align-items:center;gap:8px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 102" width="48" height="38" aria-hidden="true">
              <path fill="#AFBD22" d="M85.91,101.09c-11.2-1.2-12.29-21.9-13.53-44.24c-0.14-2.37-0.26-4.74-0.41-7.12C70.44,24.73,67.39,0,48.81,0C12.85,0,0,56.85,0,56.85h58.69l-0.89-7.12H10.59c8.15-35.53,43.04-61.04,50.43,0l0.88,7.12c2.48,24.09,9.47,43.58,24.22,44.29C86.21,101.14,85.99,101.1,85.91,101.09"/>
              <path fill="#003B5C" d="M88.82,49.73l1.41,7.12h39.14c-1.76,11.88-34.11,45.65-42.34,0l-1.41-7.12c-1.29-5.05-5.05-44.63-28.26-49.26c-0.48-0.09-0.98-0.18-1.49-0.24c-0.08-0.01-0.35-0.03-0.24-0.01l0.12,0.02c15.96,2.53,18.76,25.88,20.2,49.49c0.15,2.38,0.28,4.75,0.41,7.12c1.28,23.02,2.41,44.29,14.58,44.29c21.46,0,42.94-28.82,46.89-51.41H88.82z"/>
            </svg>
            <span style="font-family:'Inter',Arial,sans-serif;font-size:10px;font-weight:700;color:#003B5C;line-height:1.2;text-transform:uppercase;letter-spacing:.02em;">NZ<br>Transport<br>Agency</span>
          </div>
        </div>
      </div>
    </div>

    <div>
      <div class="hp-reviews">
        <div class="hp-reviews__head">
          <span class="hp-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <span class="hp-rating"><?php echo esc_html($rating); ?></span>
          <span class="hp-rcount"><?php echo esc_html($reviews); ?> Google Reviews</span>
        </div>
        <?php if ($reviews_widget) { echo do_shortcode($reviews_widget); } ?>
      </div>
    </div>
  </div>
</section>


<!-- ══ FINANCE ═══════════════════════════════════════════════════════════ -->
<section class="hp-finance" aria-labelledby="hp-fin-head">
  <div class="w">
    <div class="hp-sh">
      <span class="hp-eye hp-eye--dark">Flexible Payment</span>
      <h2 class="hp-h2" id="hp-fin-head">Don&rsquo;t let the cost <span>hold you back</span></h2>
      <p class="hp-sub" style="margin:12px auto 0;">Need it done now but the timing&rsquo;s tight? Four finance options available across all services. No pressure &mdash; just flexible options from a workshop you can trust.</p>
    </div>
    <div class="hp-finance-grid">
      <a href="<?php echo esc_url($site_url . '/afterpay-car-repairs/'); ?>" class="hp-fin-card" style="text-decoration:none;">
        <div class="hp-fin-card__name">Afterpay</div>
        <div class="hp-fin-card__desc">Split your repair into four fortnightly payments. No interest, no fees when paid on time.</div>
        <div class="hp-fin-card__link">Learn more &rarr;</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/aotea-finance-car-repairs/'); ?>" class="hp-fin-card" style="text-decoration:none;">
        <div class="hp-fin-card__name">Aotea Finance</div>
        <div class="hp-fin-card__desc">NZ-owned finance for car repairs. Fast approval, fixed repayments, no surprises.</div>
        <div class="hp-fin-card__link">Learn more &rarr;</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/gem-finance-car-repairs/'); ?>" class="hp-fin-card" style="text-decoration:none;">
        <div class="hp-fin-card__name">GEM Visa</div>
        <div class="hp-fin-card__desc">Use your GEM Visa card. Interest-free options available on qualifying purchases.</div>
        <div class="hp-fin-card__link">Learn more &rarr;</div>
      </a>
      <a href="<?php echo esc_url($site_url . '/qcard-car-repairs/'); ?>" class="hp-fin-card" style="text-decoration:none;">
        <div class="hp-fin-card__name">Q Card</div>
        <div class="hp-fin-card__desc">Q Card interest-free options on car repairs. Apply in-store or online.</div>
        <div class="hp-fin-card__link">Learn more &rarr;</div>
      </a>
    </div>
    <div style="text-align:center; margin-top:32px;">
      <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="hp-btn hp-btn--yellow">View All Finance Options</a>
    </div>
  </div>
</section>


<!-- ══ ENQUIRY SECTION (dark) ════════════════════════════════════════════ -->
<section class="hp-enquiry-section" id="hp-enquire" aria-labelledby="hp-enq-head">
  <div class="w">
    <div class="hp-enquiry">
      <div>
        <span class="hp-eye hp-eye--yellow">Get in Touch</span>
        <h2 class="hp-h2 hp-h2--white" id="hp-enq-head" style="margin-top:14px;">Ready to get <span>sorted?</span></h2>
        <p style="font-size:15px;font-weight:300;color:#aaa;line-height:1.75;letter-spacing:-0.1px;margin-top:12px;margin-bottom:8px;">Tell us what you need &mdash; servicing, WOF, repairs, tyres, diagnostics. We&rsquo;ll let you know what&rsquo;s needed and what it&rsquo;ll cost before you go ahead.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="hp-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="hp-enquiry__detail">
          <strong>Tony Allen Auto Service</strong><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>
          <?php echo esc_html($hours); ?> &middot; <?php echo esc_html($phone_local); ?>
        </div>
        <div class="hp-enquiry__estimate">Estimate before we start &mdash; nothing happens without your approval.</div>
        <div class="hp-enquiry__finance-logos">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-afterpay.png'); ?>" alt="Afterpay" class="hp-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-qcard.png'); ?>" alt="Q Card" class="hp-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-gem.png'); ?>" alt="GEM Finance" class="hp-enquiry__fin-img" height="32" loading="lazy">
          <img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/06/finance-logo-aotea.png'); ?>" alt="Aotea Finance" class="hp-enquiry__fin-img" height="32" loading="lazy">
        </div>
        <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="hp-enquiry__fin-link">Finance options &rarr;</a>
      </div>
      <div>
        <div class="hp-enquiry__form-title">Send Us Your Details</div>
        <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
        <p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--y);"><?php echo esc_html($phone_free); ?></a> or email <a href="mailto:<?php echo esc_attr($email); ?>" style="color:var(--y);font-weight:600;"><?php echo esc_html($email); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- ══ FAQ ═══════════════════════════════════════════════════════════════ -->
<section class="hp-faq" aria-labelledby="hp-faq-head">
  <div class="w">
    <div class="hp-sh">
      <span class="hp-eye hp-eye--border">Common Questions</span>
      <h2 class="hp-h2" id="hp-faq-head">Quick <span>answers</span></h2>
    </div>
    <div class="hp-faq-list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="hp-faq-item<?php echo $i === 0 ? ' is-open' : ''; ?>">
        <button class="hp-faq-q" type="button"><?php echo esc_html($faq['q']); ?></button>
        <div class="hp-faq-a"><?php echo wp_kses_post($faq['a']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<script>
document.querySelectorAll('.hp-faq-q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.hp-faq-item');
    var wasOpen = item.classList.contains('is-open');
    document.querySelectorAll('.hp-faq-item.is-open').forEach(function(i){ i.classList.remove('is-open'); });
    if (!wasOpen) item.classList.add('is-open');
  });
});
</script>

</div><!-- /.taas-hp -->

<?php get_footer(); ?>
