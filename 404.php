<?php
/**
 * 404 — Page not found / coming soon
 * Built to the August 2026 brief: dark hero, "You might be looking for" cards,
 * dark call strip. Static, no ACF, no schema.
 *
 * Staged go-live aware: if the requested URL is a drafted page, say it's
 * coming soon, and point the visitor to the live hub for that service.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';

$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$hours       = defined('TAAS_HOURS')       ? TAAS_HOURS       : 'Monday–Friday 7:30am–5:00pm';
$tel_free    = 'tel:' . preg_replace('/\D/', '', $phone_free);

// ── What was requested? ─────────────────────────────────────────────────────
$req_path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$req_slug = $req_path ? basename($req_path) : '';

// Is it a page we have built but not released yet?
$coming_soon = false;
if ($req_path) {
    $maybe = get_page_by_path($req_path, OBJECT, 'page');
    if ($maybe && in_array($maybe->post_status, ['draft', 'pending', 'future'], true)) {
        $coming_soon = true;
    }
}

// Best live hub for this URL (first keyword match wins).
$hub_map = [
    'wof'                 => ['/wof/', 'WOF Inspections'],
    'warrant'             => ['/wof/', 'WOF Inspections'],
    'brake'               => ['/manukau-brake-clutch/', 'Brakes & Clutch'],
    'clutch'              => ['/manukau-brake-clutch/', 'Brakes & Clutch'],
    'disc-skimming'       => ['/manukau-brake-clutch/', 'Brakes & Clutch'],
    'hybrid'              => ['/electric-hybrid-vehicle-servicing/', 'Electric & Hybrid Servicing'],
    'ev-'                 => ['/electric-hybrid-vehicle-servicing/', 'Electric & Hybrid Servicing'],
    'electric-vehicle'    => ['/electric-hybrid-vehicle-servicing/', 'Electric & Hybrid Servicing'],
    'phev'                => ['/electric-hybrid-vehicle-servicing/', 'Electric & Hybrid Servicing'],
    'auto-electric'       => ['/auto-electrical/', 'Auto Electrical'],
    'alternator'          => ['/auto-electrical/', 'Auto Electrical'],
    'starter'             => ['/auto-electrical/', 'Auto Electrical'],
    'warning-light'       => ['/diagnostic-scanning/', 'Diagnostic Scanning'],
    'diagnos'             => ['/diagnostic-scanning/', 'Diagnostic Scanning'],
    'battery'             => ['/manukau-batteries/', 'Manukau Batteries'],
    'batteries'           => ['/manukau-batteries/', 'Manukau Batteries'],
    'air-con'             => ['/air-conditioning/', 'Air Conditioning'],
    'aircon'              => ['/air-conditioning/', 'Air Conditioning'],
    'tyre'                => ['/tyre-centre/', 'Tyre Centre'],
    'wheel'               => ['/tyre-centre/', 'Tyre Centre'],
    'puncture'            => ['/tyre-centre/', 'Tyre Centre'],
    'tpms'                => ['/tyre-centre/', 'Tyre Centre'],
    'cambelt'             => ['/cambelts-and-water-pumps/', 'Cambelts & Water Pumps'],
    'timing'              => ['/cambelts-and-water-pumps/', 'Cambelts & Water Pumps'],
    'water-pump'          => ['/cambelts-and-water-pumps/', 'Cambelts & Water Pumps'],
    'radiator'            => ['/cooling-system/', 'Cooling System'],
    'overheat'            => ['/cooling-system/', 'Cooling System'],
    'cooling'             => ['/cooling-system/', 'Cooling System'],
    'head-gasket'         => ['/cooling-system/', 'Cooling System'],
    'shock'               => ['/steering-and-suspension/', 'Steering & Suspension'],
    'suspension'          => ['/steering-and-suspension/', 'Steering & Suspension'],
    'steering'            => ['/steering-and-suspension/', 'Steering & Suspension'],
    'ball-joint'          => ['/steering-and-suspension/', 'Steering & Suspension'],
    'transmission'        => ['/transmission-service-and-repair/', 'Transmission'],
    'cvt'                 => ['/transmission-service-and-repair/', 'Transmission'],
    'engine'              => ['/engine-repairs/', 'Engine Repairs'],
    'oil-leak'            => ['/engine-repairs/', 'Engine Repairs'],
    'afterpay'            => ['/afterpay-car-repairs/', 'Afterpay Car Repairs'],
    'finance'             => ['/finance-options/', 'Finance Options'],
    'warranty'            => ['/mechanical-breakdown-insurance/', 'Warranty & MBI Repairs'],
    'european'            => ['/european/', 'TAAS European'],
    'bmw'                 => ['/european/', 'TAAS European'],
    'mercedes'            => ['/european/', 'TAAS European'],
    'audi'                => ['/european/', 'TAAS European'],
    'volkswagen'          => ['/european/', 'TAAS European'],
    'fleet'               => ['/fleet-servicing/', 'Fleet Servicing'],
    'commercial'          => ['/commercial-vehicles/', 'Commercial Vehicles'],
    'towing'              => ['/towing/', 'Towing'],
    'pre-purchase'        => ['/pre-purchase-inspection-manukau/', 'Pre-Purchase Inspections'],
    'service'             => ['/vehicle-servicing/', 'Vehicle Servicing'],
    'servicing'           => ['/vehicle-servicing/', 'Vehicle Servicing'],
];
$suggest = null;
foreach ($hub_map as $needle => $hub) {
    if ($req_slug && strpos($req_slug, $needle) !== false) { $suggest = $hub; break; }
}

if ($coming_soon) {
    $eyebrow = 'Coming soon';
    $heading = 'This page is coming soon';
    $sub     = 'We’re finishing this page now. Everything you need is on our main service pages in the meantime — or give us a call.';
} else {
    $eyebrow = 'Page not found';
    $heading = 'We can’t find that page';
    $sub     = 'It may have moved, or the link may be out of date. Try one of our main pages below — or give us a call.';
}

$cards = [
    ['/wof/',                               'WOF Inspections',     'NZTA Authorised. Failures fixed and re-checked on-site.'],
    ['/vehicle-servicing/',                 'Vehicle Servicing',   'Essential, Standard and Premium services for all makes.'],
    ['/manukau-brake-clutch/',              'Brakes & Clutch',     'Manukau Brake & Clutch — pads, rotors, clutches, disc skimming.'],
    ['/auto-electrical/',                   'Auto Electrical',     'Fault finding, alternators, starters and warning lights.'],
    ['/tyre-centre/',                       'Tyre Centre',         'Tyres supplied and fitted, wheel alignment and balancing.'],
    ['/european/',                          'TAAS European',       'BMW, Mercedes-Benz, Audi, Volkswagen, Volvo and more.'],
    ['/manukau-batteries/',                 'Manukau Batteries',   'Car, 4WD and AGM batteries — supplied and fitted.'],
    ['/contact-us/',                        'Contact Us',          '139 Cavendish Drive, Manukau. ' . $hours . '.'],
];
// Don't repeat the suggested hub in the grid.
if ($suggest) {
    $cards = array_values(array_filter($cards, function ($c) use ($suggest) { return $c[0] !== $suggest[0]; }));
    $cards = array_slice($cards, 0, 8);
}

get_header();
?>

<style>
/* ══ 404 — SCOPED CSS ══════════════════════════════════════════════════ */
.taas-404 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); overflow-x: hidden; }
.taas-404 .w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 var(--taas-gutter, 24px); }

.taas-404__hero { background: var(--taas-black, #111); padding: 80px 0 68px; text-align: center; position: relative; }
.taas-404__hero::before {
  content: ''; position: absolute; inset: 0; pointer-events: none;
  background: repeating-linear-gradient(-55deg, transparent, transparent 60px, rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px);
}
.taas-404__hero .w { position: relative; z-index: 1; }
.taas-404__eye {
  display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A);
  font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
  padding: 6px 14px; margin-bottom: 18px; border-radius: 3px;
}
.taas-404__h1 {
  font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: #fff;
  letter-spacing: -.02em; line-height: 1.12; margin: 0 0 14px;
}
.taas-404__sub { font-size: 15px; font-weight: 300; line-height: 1.75; color: rgba(255,255,255,.72); max-width: 560px; margin: 0 auto 28px; }
.taas-404__btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

.taas-404__suggest {
  margin: 28px auto 0; max-width: 560px; background: rgba(255,200,0,.08); border: 1px solid rgba(255,200,0,.35);
  border-radius: var(--taas-radius, 6px); padding: 16px 20px; text-align: left;
}
.taas-404__suggest-lbl { font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 4px; }
.taas-404__suggest a { color: #fff; font-size: 17px; font-weight: 600; text-decoration: none; }
.taas-404__suggest a:hover { color: var(--taas-yellow, #FFC800); }

.taas-404__grid-wrap { background: var(--taas-panel, #F7F7F5); padding: 64px 0; }
.taas-404__h2 { font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; letter-spacing: -.01em; color: var(--taas-dark, #1A1A1A); margin: 0 0 28px; text-align: center; }
.taas-404__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
.taas-404__card {
  display: block; background: #fff; border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px);
  padding: 22px 20px; text-decoration: none; transition: border-color .15s, transform .15s;
}
.taas-404__card:hover { border-color: var(--taas-yellow, #FFC800); transform: translateY(-2px); }
.taas-404__card h3 { font-size: 16px; font-weight: 600; color: var(--taas-dark, #1A1A1A); margin: 0 0 6px; }
.taas-404__card p { font-size: 14px; font-weight: 300; line-height: 1.6; color: var(--taas-mid, #666); margin: 0; }
.taas-404__card span { display: inline-block; margin-top: 10px; font-size: 12px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--taas-dark, #1A1A1A); }

.taas-404__cta { background: var(--taas-dark, #1A1A1A); padding: 56px 0; text-align: center; }
.taas-404__cta h2 { color: #fff; font-size: clamp(22px, 3vw, 30px); font-weight: 700; margin: 0 0 10px; }
.taas-404__cta p { color: rgba(255,255,255,.65); font-size: 15px; font-weight: 300; margin: 0 0 24px; }
.taas-404__cta-hours { margin-top: 16px; font-size: 13px; color: rgba(255,255,255,.45); }

@media (max-width: 960px) { .taas-404__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) {
  .taas-404__hero { padding: 60px 0 52px; }
  .taas-404__sub, .taas-404__cta p { font-size: 14px; }
  .taas-404__grid { grid-template-columns: 1fr; }
  .taas-404__btns .taas-btn { width: 100%; justify-content: center; }
}
</style>

<main class="taas-404">

  <section class="taas-404__hero">
    <div class="w">
      <span class="taas-404__eye"><?php echo esc_html($eyebrow); ?></span>
      <h1 class="taas-404__h1"><?php echo esc_html($heading); ?></h1>
      <p class="taas-404__sub"><?php echo esc_html($sub); ?></p>
      <div class="taas-404__btns">
        <a class="taas-btn taas-btn--primary" href="<?php echo esc_url(home_url('/')); ?>">Back to homepage</a>
        <a class="taas-btn taas-btn--outline" href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact us</a>
      </div>
      <?php if ($suggest) : ?>
      <div class="taas-404__suggest">
        <div class="taas-404__suggest-lbl">Looking for this?</div>
        <a href="<?php echo esc_url(home_url($suggest[0])); ?>"><?php echo esc_html($suggest[1]); ?> →</a>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="taas-404__grid-wrap">
    <div class="w">
      <h2 class="taas-404__h2">You might be looking for</h2>
      <div class="taas-404__grid">
        <?php foreach ($cards as $c) : ?>
        <a class="taas-404__card" href="<?php echo esc_url(home_url($c[0])); ?>">
          <h3><?php echo esc_html($c[1]); ?></h3>
          <p><?php echo esc_html($c[2]); ?></p>
          <span>View →</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="taas-404__cta">
    <div class="w">
      <h2>Give us a call</h2>
      <p>Not sure where to start? Tell us what the car is doing and we’ll point you in the right direction.</p>
      <a class="taas-btn taas-btn--primary" href="<?php echo esc_attr($tel_free); ?>">Call <?php echo esc_html($phone_free); ?></a>
      <div class="taas-404__cta-hours"><?php echo esc_html($hours); ?> · Local <?php echo esc_html($phone_local); ?></div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
