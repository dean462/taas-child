<?php
/**
 * TAAS — Local proof section for suburb pages
 *
 * Shows real, suburb-specific workshop data on WOF and battery suburb pages:
 * how many customers from that suburb we look after, how many came in over
 * the last 12 months, recent jobs (vehicle + work, no names or plates), a
 * directions link from the suburb, and a link to the sister page for the same
 * suburb (WOF <-> battery). Data lives in WordPress (see taas_local_proof_data) and is
 * refreshed monthly from the MechanicDesk export. The data is hidden post
 * meta (taas_local_proof) on the WOF hub page, kept out of this repo on purpose.
 *
 * Display rules (so thin numbers never look weak):
 *  - customer count shown only when 25+; rounded down to the nearest 10 from 50
 *  - 12-month count shown only when 10+
 *  - jobs list shown when there are 2+ jobs
 *  - the whole section is skipped if there's nothing to show
 */

if (!defined('ABSPATH')) exit;

function taas_local_proof_data($slug) {
    static $data = null;
    if ($data === null) {
        // Stored in WordPress, not in the theme repo, because it is built from
        // customer records: hidden post meta "taas_local_proof" on the WOF hub
        // page (/wof/). JSON string or array.
        $hub  = get_page_by_path('wof', OBJECT, 'page');
        $raw  = $hub ? get_post_meta($hub->ID, 'taas_local_proof', true) : '';
        $data = is_string($raw) ? json_decode($raw, true) : $raw;
        if (!is_array($data)) $data = [];
    }
    $slug = sanitize_title($slug);
    return isset($data[$slug]) && is_array($data[$slug]) ? $data[$slug] : null;
}

/**
 * @param string $slug         suburb slug, e.g. 'papatoetoe'
 * @param string $suburb_name  display name, e.g. 'Papatoetoe'
 * @param string $context      'wof' or 'battery'
 */
function taas_local_proof_section($slug, $suburb_name, $context = 'wof') {
    $d = taas_local_proof_data($slug);
    $customers = $d ? (int) ($d['customers'] ?? 0) : 0;
    $last12    = $d ? (int) ($d['last12'] ?? 0) : 0;
    $jobs      = $d && !empty($d['jobs']) && is_array($d['jobs']) ? array_slice($d['jobs'], 0, 6) : [];

    $stats = [];
    if ($customers >= 25) {
        $shown = $customers >= 50 ? (floor($customers / 10) * 10) . '+' : (string) $customers;
        $stats[] = ['num' => $shown, 'label' => $suburb_name . ' customers on our books'];
    }
    if ($last12 >= 10) {
        $stats[] = ['num' => (string) $last12, 'label' => $suburb_name . ' vehicles in for work in the last 12 months'];
    }
    if (count($jobs) < 2) $jobs = [];

    $sister_url  = $context === 'wof'
        ? home_url('/car-battery-' . sanitize_title($slug) . '/')
        : home_url('/wof-inspection-' . sanitize_title($slug) . '/');
    $sister_text = $context === 'wof'
        ? 'Need a battery? Car batteries for ' . $suburb_name . ' drivers'
        : 'WOF due? WOF inspections for ' . $suburb_name . ' drivers';
    $dir_url = 'https://www.google.com/maps/dir/?api=1&origin=' . rawurlencode($suburb_name . ', Auckland')
             . '&destination=' . rawurlencode('Tony Allen Auto Service, 139 Cavendish Drive, Manukau');

    ob_start(); ?>
<style>
.lp{background:#F7F7F5;padding:var(--taas-sec-pad,72px) 0;border-top:1px solid #E8E8E4}
.lp__w{max-width:1100px;margin:0 auto;padding:0 24px}
.lp__eyebrow{display:block;font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#999;margin-bottom:10px}
.lp__h2{font-size:clamp(24px,3.2vw,34px);font-weight:800;color:#1A1A1A;line-height:1.2;margin:0 0 18px}
.lp__h2 span{color:#FFC800;background:#1A1A1A;padding:0 8px}
.lp__stats{display:flex;flex-wrap:wrap;gap:16px;margin:0 0 28px}
.lp__stat{background:#fff;border:1px solid #E8E8E4;border-top:3px solid #FFC800;padding:18px 22px;min-width:220px;flex:1}
.lp__num{display:block;font-size:34px;font-weight:800;color:#1A1A1A;line-height:1}
.lp__label{display:block;font-size:14px;color:#666;margin-top:6px;line-height:1.5}
.lp__jobs-h{font-size:16px;font-weight:700;color:#1A1A1A;margin:0 0 12px}
.lp__jobs{list-style:none;margin:0 0 10px;padding:0;display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:8px 24px}
.lp__jobs li{font-size:15px;color:#333;line-height:1.5;padding-left:18px;position:relative}
.lp__jobs li::before{content:"";position:absolute;left:0;top:.6em;width:8px;height:8px;background:#FFC800}
.lp__note{font-size:12px;color:#999;margin:4px 0 22px}
.lp__links{display:flex;flex-wrap:wrap;gap:12px}
.lp__link{display:inline-block;font-size:14px;font-weight:600;color:#1A1A1A;text-decoration:none;border:2px solid #1A1A1A;padding:10px 16px}
.lp__link:hover{opacity:.65}
@media (max-width:640px){.lp{padding:48px 0}.lp__stat{min-width:0}.lp__num{font-size:28px}.lp__jobs{grid-template-columns:1fr}}
</style>
<section class="lp" aria-labelledby="lp-head-<?php echo esc_attr($slug); ?>">
  <div class="lp__w">
    <?php if ($stats || $jobs) : ?>
    <span class="lp__eyebrow">From our workshop records</span>
    <h2 class="lp__h2" id="lp-head-<?php echo esc_attr($slug); ?>">Looking after <span><?php echo esc_html($suburb_name); ?></span> drivers</h2>
    <?php else : ?>
    <span class="lp__eyebrow">Getting here</span>
    <h2 class="lp__h2" id="lp-head-<?php echo esc_attr($slug); ?>">Coming from <span><?php echo esc_html($suburb_name); ?></span></h2>
    <?php endif; ?>
    <?php if ($stats) : ?>
    <div class="lp__stats">
      <?php foreach ($stats as $s) : ?>
      <div class="lp__stat"><span class="lp__num"><?php echo esc_html($s['num']); ?></span><span class="lp__label"><?php echo esc_html($s['label']); ?></span></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($jobs) : ?>
    <h3 class="lp__jobs-h">Recent jobs for <?php echo esc_html($suburb_name); ?> customers</h3>
    <ul class="lp__jobs">
      <?php foreach ($jobs as $j) : ?><li><?php echo esc_html($j); ?></li><?php endforeach; ?>
    </ul>
    <p class="lp__note">Taken from our job records and updated monthly. We never show customer names or number plates.</p>
    <?php endif; ?>
    <div class="lp__links">
      <a class="lp__link" href="<?php echo esc_url($dir_url); ?>" target="_blank" rel="noopener">Directions from <?php echo esc_html($suburb_name); ?></a>
      <a class="lp__link" href="<?php echo esc_url($sister_url); ?>"><?php echo esc_html($sister_text); ?></a>
    </div>
  </div>
</section>
<?php
    return ob_get_clean();
}
