<?php
/**
 * Template Name: Thank You
 * Description: CF7 redirect target. Confirms the enquiry, sets expectations,
 *              fires GA4 generate_lead once per real submission. Noindexed.
 * Built: September 2026
 */

require_once get_stylesheet_directory() . '/taas-constants.php';

$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$hours       = defined('TAAS_HOURS')       ? TAAS_HOURS       : 'Monday–Friday 7:30am–5:00pm';
$tel_free    = 'tel:' . preg_replace('/\D/', '', $phone_free);

// Keep this page out of search results.
add_filter('wp_robots', function ($robots) {
    $robots['noindex']  = true;
    $robots['nofollow'] = true;
    return $robots;
});

// Is the workshop open right now? (site timezone, Mon–Fri 7:30–17:00)
$now_day  = (int) wp_date('N');            // 1 = Mon … 7 = Sun
$now_mins = (int) wp_date('G') * 60 + (int) wp_date('i');
$is_open  = $now_day <= 5 && $now_mins >= 450 && $now_mins < 1020;

if ($is_open) {
    $next_step = 'We’re in the workshop now. One of the team will get back to you shortly.';
} elseif ($now_day >= 6 || ($now_day === 5 && $now_mins >= 1020)) {
    $next_step = 'We’re closed for the weekend. We’ll be in touch first thing Monday from 7:30am.';
} else {
    $next_step = 'We’re closed right now. We’ll be in touch first thing when we open at 7:30am.';
}

// Where they came from (set by the CF7 redirect in functions.php).
$from = isset($_GET['from']) ? esc_url_raw(wp_unslash($_GET['from'])) : '';
$from_path = $from ? wp_parse_url($from, PHP_URL_PATH) : '';
$back_url  = ($from_path && strpos($from_path, '/') === 0) ? home_url($from_path) : home_url('/services/');

get_header();
?>

<style>
/* ══ THANK YOU — SCOPED CSS ════════════════════════════════════════════ */
.ty { font-family: var(--taas-font, 'Inter', Arial, sans-serif); overflow-x: hidden; }
.ty .w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 var(--taas-gutter, 24px); }

.ty-hero { background: var(--taas-black, #111); padding: 88px 0 72px; text-align: center; position: relative; }
.ty-hero::before {
  content: ''; position: absolute; inset: 0; pointer-events: none;
  background: repeating-linear-gradient(-55deg, transparent, transparent 60px, rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px);
}
.ty-hero .w { position: relative; z-index: 1; }
.ty-tick {
  width: 64px; height: 64px; border-radius: 50%; margin: 0 auto 24px;
  background: var(--taas-yellow, #FFC800); display: flex; align-items: center; justify-content: center;
}
.ty-eye {
  display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A);
  font-size: 11px; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
  padding: 6px 14px; margin-bottom: 18px; border-radius: 3px;
}
.ty-h1 {
  font-size: var(--taas-h1-spoke, clamp(30px, 5vw, 50px)); font-weight: 800; color: #fff;
  letter-spacing: -.02em; line-height: 1.12; margin: 0 0 14px;
}
.ty-sub { font-size: 17px; font-weight: 300; line-height: 1.7; color: rgba(255,255,255,.72); max-width: 580px; margin: 0 auto; }

.ty-steps { background: var(--taas-white, #fff); padding: 64px 0; }
.ty-h2 { font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; letter-spacing: -.01em; color: var(--taas-dark, #1A1A1A); margin: 0 0 28px; text-align: center; }
.ty-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.ty-card { border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 26px 24px; }
.ty-num {
  width: 32px; height: 32px; border-radius: 50%; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800);
  font-weight: 800; font-size: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;
}
.ty-card h3 { font-size: 17px; font-weight: 600; color: var(--taas-dark, #1A1A1A); margin: 0 0 8px; }
.ty-card p { font-size: 15px; line-height: 1.65; color: var(--taas-body, #333); margin: 0; }

.ty-cta { background: var(--taas-dark, #1A1A1A); padding: 56px 0; text-align: center; }
.ty-cta h2 { color: #fff; font-size: clamp(22px, 3vw, 30px); font-weight: 700; margin: 0 0 10px; }
.ty-cta p { color: rgba(255,255,255,.65); font-size: 16px; margin: 0 0 26px; }
.ty-cta__btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
.ty-cta__hours { margin-top: 18px; font-size: 13px; color: rgba(255,255,255,.45); }

@media (max-width: 800px) {
  .ty-hero { padding: 64px 0 52px; }
  .ty-grid { grid-template-columns: 1fr; }
  .ty-cta__btns .taas-btn { width: 100%; justify-content: center; }
}
</style>

<main class="ty">

  <section class="ty-hero">
    <div class="w">
      <div class="ty-tick" aria-hidden="true">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
      </div>
      <span class="ty-eye">Enquiry received</span>
      <h1 class="ty-h1">Thanks — we’ve got your enquiry</h1>
      <p class="ty-sub"><?php echo esc_html($next_step); ?></p>
    </div>
  </section>

  <section class="ty-steps">
    <div class="w">
      <h2 class="ty-h2">What happens next</h2>
      <div class="ty-grid">
        <div class="ty-card">
          <div class="ty-num">1</div>
          <h3>We read your enquiry</h3>
          <p>Your details go straight to our front counter team at Cavendish Drive.</p>
        </div>
        <div class="ty-card">
          <div class="ty-num">2</div>
          <h3>We get back to you</h3>
          <p>By phone or email, whichever you asked for — with a time, a price guide, or the questions we need answered.</p>
        </div>
        <div class="ty-card">
          <div class="ty-num">3</div>
          <h3>We book you in</h3>
          <p>Bring the car to 139 Cavendish Drive, Manukau, at the time we agree.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ty-cta">
    <div class="w">
      <h2>Need us sooner?</h2>
      <p>If it’s urgent, give us a call — it’s the fastest way to reach the team.</p>
      <div class="ty-cta__btns">
        <a class="taas-btn taas-btn--primary" href="<?php echo esc_attr($tel_free); ?>">Call <?php echo esc_html($phone_free); ?></a>
        <a class="taas-btn taas-btn--outline" href="<?php echo esc_url($back_url); ?>">Back to where you were</a>
      </div>
      <div class="ty-cta__hours"><?php echo esc_html($hours); ?> · Local <?php echo esc_html($phone_local); ?></div>
    </div>
  </section>

</main>

<script>
/* GA4 generate_lead — fires once per real submission (?sent=1), not on refresh or direct visits. */
(function () {
  var params = new URLSearchParams(window.location.search);
  if (params.get('sent') !== '1') return;
  var key = 'taas_lead_' + (params.get('t') || '');
  try { if (sessionStorage.getItem(key)) return; sessionStorage.setItem(key, '1'); } catch (e) {}
  if (typeof gtag === 'function') {
    gtag('event', 'generate_lead', {
      form_id: params.get('form') || '',
      source_page: params.get('from') || ''
    });
  }
  // Tidy the address bar so a refresh doesn't re-fire.
  if (window.history && history.replaceState) {
    history.replaceState(null, '', window.location.pathname);
  }
})();
</script>

<?php get_footer(); ?>
