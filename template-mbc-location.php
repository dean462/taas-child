<?php
/**
 * Template Name: MBC Location
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL pattern: /brakes-[suburb]/
 *
 * ACF fields:
 *   suburb_name   text
 *   suburb_slug   text
 *   distance_note text
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-suburbs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$has_acf       = function_exists('get_field');
$site_url      = get_site_url();
$page_url      = get_permalink();
$suburb_name   = ($has_acf ? get_field('suburb_name')   : null) ?: 'South Auckland';
$suburb_slug   = ($has_acf ? get_field('suburb_slug')   : null) ?: sanitize_title($suburb_name);
$distance_note = ($has_acf ? get_field('distance_note') : null) ?: 'a short drive from ' . $suburb_name;
$sub           = taas_suburb_data($suburb_slug, $suburb_name);

$faqs = [
    ['q' => 'Do you do brake repairs near ' . $suburb_name . '?',
     'a' => 'Yes. Manukau Brake & Clutch at 139 Cavendish Drive, Manukau is ' . $distance_note . '. We carry out brake pads, disc replacement, disc skimming, drum brakes, calipers, ABS repair and clutch work — all in-house.'],
    ['q' => 'How much do brake pads cost near ' . $suburb_name . '?',
     'a' => 'Brake pad replacement prices vary by vehicle make and model. Call us on ' . TAAS_PHONE_LOCAL . ' with your registration number for a price before you come in from ' . $suburb_name . '. We inspect disc condition at the same time — no charge for the assessment.'],
    ['q' => 'Do you do disc skimming near ' . $suburb_name . '?',
     'a' => 'Yes. We carry out disc skimming in-house on our own brake lathe — no outsourcing. This means same-day turnaround in most cases. Discs are measured before we recommend skimming or replacement.'],
    ['q' => 'How do I know if my brakes need replacing?',
     'a' => 'Common signs include squealing or grinding noise, a pulsating or spongy brake pedal, the vehicle pulling to one side under braking, longer stopping distances, or a brake warning light on the dash. Any of these warrant an inspection.'],
    ['q' => 'Do you repair ABS brakes near ' . $suburb_name . '?',
     'a' => 'Yes. We diagnose and repair ABS faults including wheel speed sensors, ABS pump and modulator. We use factory-spec diagnostic equipment to read fault codes before recommending any work.'],
    ['q' => 'Where are you relative to ' . $suburb_name . '?',
     'a' => 'We are at 139 Cavendish Drive, Manukau — ' . $distance_note . '. Open Monday to Friday 7:30am–5:00pm.'],
];

array_unshift($faqs, taas_suburb_coverage_faq($suburb_slug, $suburb_name, 'brake or clutch work', TAAS_PHONE_LOCAL));

$schema_faqs = array_map(fn($f) => [
    '@type' => 'Question', 'name' => $f['q'],
    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
], $faqs);

$schema = [
    ['@context'=>'https://schema.org','@type'=>['AutoRepair','LocalBusiness'],
     'name' => 'Manukau Brake & Clutch — Brake Repairs ' . $suburb_name,
     'url'  => $page_url,
     'telephone' => [TAAS_PHONE_LOCAL, TAAS_PHONE_FREE], 'email' => TAAS_EMAIL,
     'address' => ['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive',
                   'addressLocality'=>'Manukau','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo' => ['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'openingHoursSpecification' => [['@type'=>'OpeningHoursSpecification',
         'dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],
         'opens'=>'07:30','closes'=>'17:00']],
     'areaServed' => $suburb_name . ', South Auckland'],
    ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Manukau Brake & Clutch','item'=>$site_url.'/manukau-brake-clutch/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Brakes '.$suburb_name,'item'=>$page_url],
    ]],
    ['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>$schema_faqs],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';

$suburbs_all = [
    ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Manukau','slug'=>'manukau'],
    ['label'=>'Māngere','slug'=>'mangere'],['label'=>'Ōtāhuhu','slug'=>'otahuhu'],
    ['label'=>'Wiri','slug'=>'wiri'],['label'=>'Manurewa','slug'=>'manurewa'],
    ['label'=>'Flat Bush','slug'=>'flat-bush'],['label'=>'Takanini','slug'=>'takanini'],
    ['label'=>'Papakura','slug'=>'papakura'],['label'=>'Ōtara','slug'=>'otara'],
    ['label'=>'Botany','slug'=>'botany'],['label'=>'Howick','slug'=>'howick'],
    ['label'=>'Clover Park','slug'=>'clover-park'],['label'=>'Weymouth','slug'=>'weymouth'],
    ['label'=>'Clendon','slug'=>'clendon'],['label'=>'Hunters Corner','slug'=>'hunters-corner'],
];
?>
<style>
.mbcl-hero { background: var(--taas-black); padding: 72px 0 64px; }
.mbcl-hero__inner { max-width: var(--taas-container); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 280px; gap: 48px; align-items: start; }
.mbcl-hero__eyebrow { display: inline-block; background: var(--taas-yellow); color: var(--taas-dark); font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 18px; }
.mbcl-hero h1 { font-size: clamp(30px,5vw,50px); font-weight: 800; color: var(--taas-white); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 14px; }
.mbcl-hero h1 span { color: var(--taas-yellow); }
.mbcl-hero__sub { font-size: 16px; color: #aaa; margin: 0 0 24px; line-height: 1.65; max-width: 500px; }
.mbcl-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.mbcl-sidebar { background: #1e1e1e; border: 1px solid #333; border-radius: var(--taas-radius); padding: 22px; }
.mbcl-sidebar__title { font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--taas-yellow); margin-bottom: 12px; }
.mbcl-sidebar__list { list-style: none; padding: 0; margin: 0 0 18px; display: flex; flex-direction: column; gap: 7px; }
.mbcl-sidebar__list li { font-size: 13px; color: #ccc; padding-left: 18px; position: relative; line-height: 1.4; }
.mbcl-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow); font-weight: 700; }
.mbcl-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 14px; }
.mbcl-sidebar__phone { display: block; font-size: 20px; font-weight: 800; color: var(--taas-yellow); text-decoration: none; margin-bottom: 4px; }
.mbcl-sidebar__phone:hover { color: #fff; }
.mbcl-sidebar__detail { font-size: 12px; color: #666; line-height: 1.6; }

.mbcl-trust { background: var(--taas-yellow); }
.mbcl-trust__inner { max-width: var(--taas-container); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: repeat(4,1fr); }
.mbcl-trust__item { padding: 14px 16px; border-right: 1px solid rgba(0,0,0,0.1); text-align: center; }
.mbcl-trust__item:last-child { border-right: none; }
.mbcl-trust__value { display: block; font-size: 15px; font-weight: 800; color: var(--taas-dark); }
.mbcl-trust__label { font-size: 11px; font-weight: 600; color: #444; text-transform: uppercase; letter-spacing: 0.08em; }

.mbcl-section { padding: 64px 0; }
.mbcl-section--white { background: var(--taas-white); }
.mbcl-section--grey  { background: var(--taas-panel); }
.mbcl-section--dark  { background: var(--taas-dark); }
.mbcl-section__inner { max-width: var(--taas-container); margin: 0 auto; padding: 0 24px; }
.mbcl-section__eyebrow { display: inline-block; background: var(--taas-dark); color: var(--taas-yellow); font-size: 10px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 12px; }
.mbcl-section--dark .mbcl-section__eyebrow { background: var(--taas-yellow); color: var(--taas-dark); }
.mbcl-section__heading { font-size: clamp(22px,2.8vw,32px); font-weight: 700; color: var(--taas-black); letter-spacing: -0.01em; margin: 0 0 14px; }
.mbcl-section--dark .mbcl-section__heading { color: var(--taas-white); }
.mbcl-section__body { font-size: 16px; color: var(--taas-body); line-height: 1.75; margin-bottom: 16px; }

.mbcl-services { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; }
.mbcl-service { background: var(--taas-white); border: 1px solid var(--taas-border); border-radius: var(--taas-radius); padding: 20px 16px; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s; display: flex; flex-direction: column; gap: 8px; }
.mbcl-service:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); transform: translateY(-2px); }
.mbcl-service__icon { font-size: 20px; }
.mbcl-service__title { font-size: 14px; font-weight: 700; color: var(--taas-black); }
.mbcl-service__link { font-size: 12px; font-weight: 700; color: var(--taas-yellow2); margin-top: auto; }

.mbcl-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 20px; list-style: none; padding: 0; }
.mbcl-pills li a { display: inline-block; padding: 6px 16px; border: 1px solid var(--taas-border); border-radius: 100px; background: var(--taas-white); font-size: 13px; color: var(--taas-body); text-decoration: none; transition: all 0.15s; }
.mbcl-pills li a:hover, .mbcl-pills li a[aria-current="page"] { background: var(--taas-yellow); border-color: var(--taas-yellow); color: var(--taas-dark); font-weight: 600; }

.mbcl-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 24px; }
.mbcl-faq__item { border-bottom: 1px solid var(--taas-border); padding: 16px 0; }
.mbcl-faq__q { font-size: 15px; font-weight: 600; color: var(--taas-black); margin-bottom: 6px; }
.mbcl-faq__a { font-size: 14px; color: var(--taas-mid); line-height: 1.7; }

.mbcl-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.mbcl-enquiry__phone { display: block; font-size: clamp(26px,3.5vw,36px); font-weight: 800; color: var(--taas-yellow); text-decoration: none; margin: 12px 0 6px; }
.mbcl-enquiry__phone:hover { color: #fff; }
.mbcl-enquiry__detail { font-size: 14px; color: #aaa; line-height: 1.7; }
.mbcl-enquiry__detail strong { color: var(--taas-white); }
.mbcl-section--dark .wpcf7 label, .mbcl-section--dark .wpcf7 span:not(.wpcf7-spinner), .mbcl-section--dark .wpcf7 div:not(.wpcf7-response-output), .mbcl-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; }
.mbcl-section--dark .wpcf7 input[type="text"], .mbcl-section--dark .wpcf7 input[type="email"], .mbcl-section--dark .wpcf7 input[type="tel"], .mbcl-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius); padding: 10px 14px; width: 100%; font-family: var(--taas-font); font-size: 15px; }
.mbcl-section--dark .wpcf7 input::placeholder, .mbcl-section--dark .wpcf7 textarea::placeholder { color: #666; }
.mbcl-section--dark .wpcf7 input:focus, .mbcl-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow); }
.mbcl-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow); color: var(--taas-dark); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius); cursor: pointer; width: 100%; margin-top: 4px; }
.mbcl-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2); }

@media (max-width: 900px) {
  .mbcl-hero__inner { grid-template-columns: 1fr; }
  .mbcl-services { grid-template-columns: repeat(2,1fr); }
  .mbcl-enquiry { grid-template-columns: 1fr; gap: 28px; }
  .mbcl-trust__inner { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 600px) {
  .mbcl-hero { padding: 48px 0 40px; }
  .mbcl-section { padding: 48px 0; }
  .mbcl-services { grid-template-columns: 1fr 1fr; }
  .mbcl-trust__inner { grid-template-columns: 1fr; }
}
</style>

<section class="mbcl-hero">
  <div class="mbcl-hero__inner">
    <div>
      <span class="mbcl-hero__eyebrow">Manukau Brake &amp; Clutch</span>
      <h1>Brake Repairs<br><span><?php echo esc_html($suburb_name); ?></span></h1>
      <p class="mbcl-hero__sub">Manukau Brake &amp; Clutch at 139 Cavendish Drive — <?php echo esc_html($distance_note); ?>. Brake pads, discs, disc skimming, drum brakes, calipers, ABS repair and clutch work. All makes and models.</p>
      <div class="mbcl-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book a Brake Check</a>
        <a href="tel:0800100876" class="taas-btn taas-btn--outline">0800 100 876</a>
      </div>
    </div>
    <div class="mbcl-sidebar">
      <div class="mbcl-sidebar__title">Brake Services</div>
      <ul class="mbcl-sidebar__list">
        <li>Brake pads — all makes</li>
        <li>Brake disc replacement</li>
        <li>Disc skimming — in-house lathe</li>
        <li>Drum brakes &amp; shoes</li>
        <li>Caliper repair</li>
        <li>ABS brake repair</li>
        <li>Brake fluid flush</li>
        <li>Handbrake repair</li>
        <li>Clutch replacement</li>
      </ul>
      <hr>
      <a href="tel:0800100876" class="mbcl-sidebar__phone">0800 100 876</a>
      <div class="mbcl-sidebar__detail"><?php echo TAAS_PHONE_LOCAL; ?><br>Mon–Fri 7:30am–5:00pm</div>
    </div>
  </div>
</section>

<div class="mbcl-trust">
  <div class="mbcl-trust__inner">
    <div class="mbcl-trust__item"><span class="mbcl-trust__value">In-House</span><span class="mbcl-trust__label">Disc skimming lathe</span></div>
    <div class="mbcl-trust__item"><span class="mbcl-trust__value"><?php echo esc_html($distance_note); ?></span><span class="mbcl-trust__label">From <?php echo esc_html($suburb_name); ?></span></div>
    <div class="mbcl-trust__item"><span class="mbcl-trust__value">All Makes</span><span class="mbcl-trust__label">Cars, utes, vans, 4WD</span></div>
    <div class="mbcl-trust__item"><span class="mbcl-trust__value">MTA Assured</span><span class="mbcl-trust__label">Qualified technicians</span></div>
  </div>
</div>

<section class="mbcl-section mbcl-section--white">
  <div class="mbcl-section__inner">
    <span class="mbcl-section__eyebrow">Brake Repairs Near <?php echo esc_html($suburb_name); ?></span>
    <h2 class="mbcl-section__heading">Manukau Brake &amp; Clutch — Serving <?php echo esc_html($suburb_name); ?></h2>
    <p class="mbcl-section__body">Manukau Brake &amp; Clutch operates from 139 Cavendish Drive, Manukau — <?php echo esc_html($distance_note); ?>. We are a specialist brake and clutch division with an in-house brake lathe. This means disc skimming is done on site, same day in most cases — no outsourcing, no delay, no markup from an external machining shop.</p>
    <p class="mbcl-section__body">We inspect before we quote. Brake pad replacement always includes a disc condition check — we measure thickness and surface condition and advise whether skimming or replacement is needed. New pads on worn or uneven discs is a false economy that costs more in the long run.</p>
  </div>
</section>

<section class="mbcl-section mbcl-section--grey">
  <div class="mbcl-section__inner">
    <span class="mbcl-section__eyebrow">What We Do</span>
    <h2 class="mbcl-section__heading">Brake Services Near <?php echo esc_html($suburb_name); ?></h2>
    <div class="mbcl-services">
      <a href="<?php echo esc_url($site_url . '/brake-pads-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">🛑</div><div class="mbcl-service__title">Brake Pads</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/brake-discs-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">⭕</div><div class="mbcl-service__title">Brake Discs</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/disc-skimming-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">🔄</div><div class="mbcl-service__title">Disc Skimming</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/drum-brakes-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">🥁</div><div class="mbcl-service__title">Drum Brakes</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/brake-caliper-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">🔧</div><div class="mbcl-service__title">Brake Calipers</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/abs-brake-repair-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">⚡</div><div class="mbcl-service__title">ABS Repair</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/brake-fluid-flush-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">💧</div><div class="mbcl-service__title">Brake Fluid</div><span class="mbcl-service__link">Learn more →</span></a>
      <a href="<?php echo esc_url($site_url . '/clutch-replacement-manukau/'); ?>" class="mbcl-service"><div class="mbcl-service__icon">⚙️</div><div class="mbcl-service__title">Clutch Replacement</div><span class="mbcl-service__link">Learn more →</span></a>
    </div>
  </div>
</section>

<section class="mbcl-section mbcl-section--white">
  <div class="mbcl-section__inner">
    <span class="mbcl-section__eyebrow">South Auckland</span>
    <h2 class="mbcl-section__heading">Brake Repairs — Other Areas</h2>
    <ul class="mbcl-pills">
      <?php foreach ($suburbs_all as $s):
        if ($s['slug'] === $suburb_slug): ?>
      <li><span aria-current="page" style="display:inline-block;padding:8px 14px;border-radius:4px;background:var(--taas-yellow);color:var(--taas-dark);font-weight:700;">Brakes <?php echo esc_html($s['label']); ?> — you're here</span></li>
      <?php else: ?>
      <li><a href="<?php echo esc_url($site_url . '/brakes-' . $s['slug'] . '/'); ?>">
        Brakes <?php echo esc_html($s['label']); ?>
      </a></li>
      <?php endif; endforeach; ?>
    </ul>
  </div>
</section>

<section class="mbcl-section mbcl-section--grey">
  <div class="mbcl-section__inner">
    <span class="mbcl-section__eyebrow">FAQ</span>
    <h2 class="mbcl-section__heading">Questions — Brake Repairs Near <?php echo esc_html($suburb_name); ?></h2>
    <div class="mbcl-faq__list">
      <?php foreach ($faqs as $f): ?>
      <div class="mbcl-faq__item">
        <p class="mbcl-faq__q"><?php echo esc_html($f['q']); ?></p>
        <p class="mbcl-faq__a"><?php echo wp_kses_post($f['a']); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="mbcl-section mbcl-section--dark" id="enquire">
  <div class="mbcl-section__inner">
    <div class="mbcl-enquiry">
      <div>
        <span class="mbcl-section__eyebrow">Book or Enquire</span>
        <h2 class="mbcl-section__heading">Brake Repairs Near <?php echo esc_html($suburb_name); ?></h2>
        <p style="font-size:15px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle and what you're experiencing. We'll advise and get you booked in.</p>
        <a href="tel:<?php echo str_replace(' ','',TAAS_PHONE_FREE); ?>" class="mbcl-enquiry__phone"><?php echo TAAS_PHONE_FREE; ?></a>
        <div class="mbcl-enquiry__detail"><strong>Manukau Brake &amp; Clutch</strong><br>139 Cavendish Drive, Manukau<br>Mon–Fri 7:30am–5:00pm · <?php echo TAAS_PHONE_LOCAL; ?></div>
      </div>
      <div><?php echo do_shortcode(TAAS_CF7_GENERAL); ?></div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
