<?php
/**
 * Template Name: MBC Sub-Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * Manukau Brake & Clutch — individual service pages
 *
 * ACF fields:
 *   service_name      text    "Brake Pad Replacement"
 *   price_signal      text    "From $120 per axle — parts + labour"
 *   urgency_level     text    "high" | "medium" | "low"
 *   urgency_message   text    "Worn pads can damage discs — don't delay"
 *   what_it_is        textarea
 *   symptoms          textarea  pipe-separated
 *   our_process       textarea  pipe-separated steps
 *   related_1_label   text
 *   related_1_url     text
 *   related_2_label   text
 *   related_2_url     text
 *   related_3_label   text
 *   related_3_url     text
 *   custom_faq_q1/a1  text/textarea
 *   custom_faq_q2/a2  text/textarea
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$has_acf        = function_exists('get_field');
$site_url       = get_site_url();
$page_url       = get_permalink();

$service_name   = ($has_acf ? get_field('service_name')   : null) ?: get_the_title();
$price_signal   = ($has_acf ? get_field('price_signal')   : null) ?: '';
$urgency_level  = ($has_acf ? get_field('urgency_level')  : null) ?: 'medium';
$urgency_msg    = ($has_acf ? get_field('urgency_message'): null) ?: 'Book an inspection — catching brake faults early prevents more costly repairs.';
$what_it_is     = ($has_acf ? get_field('what_it_is')     : null) ?: '';
$symptoms_raw   = ($has_acf ? get_field('symptoms')       : null) ?: '';
$process_raw    = ($has_acf ? get_field('our_process')    : null) ?: '';
$related_1_label= ($has_acf ? get_field('related_1_label'): null) ?: 'Disc Skimming';
$related_1_url  = ($has_acf ? get_field('related_1_url')  : null) ?: '/disc-skimming-manukau/';
$related_2_label= ($has_acf ? get_field('related_2_label'): null) ?: 'Brake Discs';
$related_2_url  = ($has_acf ? get_field('related_2_url')  : null) ?: '/brake-discs-manukau/';
$related_3_label= ($has_acf ? get_field('related_3_label'): null) ?: 'MBC Hub';
$related_3_url  = ($has_acf ? get_field('related_3_url')  : null) ?: '/manukau-brake-clutch/';
$faq_q1         = ($has_acf ? get_field('custom_faq_q1')  : null) ?: '';
$faq_a1         = ($has_acf ? get_field('custom_faq_a1')  : null) ?: '';
$faq_q2         = ($has_acf ? get_field('custom_faq_q2')  : null) ?: '';
$faq_a2         = ($has_acf ? get_field('custom_faq_a2')  : null) ?: '';

$symptoms = $symptoms_raw ? array_filter(array_map('trim', explode('|', $symptoms_raw))) : [];
$process  = $process_raw  ? array_filter(array_map('trim', explode('|', $process_raw)))  : [];

$urgency_colours = ['high' => '#C0392B', 'medium' => '#E67E22', 'low' => '#27AE60'];
$urgency_colour  = $urgency_colours[$urgency_level] ?? $urgency_colours['medium'];

$schema = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'Service',
        'name'     => $service_name,
        'url'      => $page_url,
        'provider' => ['@type' => 'AutoRepair', 'name' => 'Manukau Brake & Clutch — Tony Allen Auto Service',
                       'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive',
                                     'addressLocality' => 'Manukau', 'postalCode' => '2104', 'addressCountry' => 'NZ'],
                       'telephone' => TAAS_PHONE_FREE],
        'areaServed' => ['@type' => 'City', 'name' => 'Manukau'],
    ],
];

if ($faq_q1 || $faq_q2) {
    $faqs = [];
    if ($faq_q1 && $faq_a1) $faqs[] = ['@type'=>'Question','name'=>$faq_q1,'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq_a1]];
    if ($faq_q2 && $faq_a2) $faqs[] = ['@type'=>'Question','name'=>$faq_q2,'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq_a2]];
    if ($faqs) $schema[] = ['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>$faqs];
}

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.mbcs-wrap { max-width: var(--taas-container); margin: 0 auto; padding: 0 24px; }
.mbcs-hero { background: var(--taas-black); padding: 72px 0 64px; }
.mbcs-hero__inner { max-width: var(--taas-container); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 280px; gap: 48px; align-items: start; }
.mbcs-hero__eyebrow { display: inline-block; background: var(--taas-yellow); color: var(--taas-dark); font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 18px; }
.mbcs-hero h1 { font-size: clamp(30px, 5vw, 50px); font-weight: 800; color: var(--taas-white); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.mbcs-hero h1 span { color: var(--taas-yellow); }
.mbcs-hero__sub { font-size: 17px; color: #aaa; margin: 0 0 24px; line-height: 1.6; max-width: 520px; }
.mbcs-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.mbcs-hero__price { display: inline-block; background: rgba(255,200,0,0.12); border: 1px solid rgba(255,200,0,0.3); border-radius: var(--taas-radius); padding: 10px 16px; font-size: 14px; color: var(--taas-yellow); font-weight: 600; margin-bottom: 20px; }
.mbcs-sidebar { background: #1e1e1e; border: 1px solid #333; border-radius: var(--taas-radius); padding: 24px; }
.mbcs-sidebar__title { font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--taas-yellow); margin-bottom: 14px; }
.mbcs-sidebar__list { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 8px; }
.mbcs-sidebar__list li { font-size: 13px; color: #ccc; padding-left: 18px; position: relative; }
.mbcs-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow); font-weight: 700; }
.mbcs-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 16px; }
.mbcs-sidebar__phone { display: block; font-size: 22px; font-weight: 800; color: var(--taas-yellow); text-decoration: none; margin-bottom: 4px; }
.mbcs-sidebar__phone:hover { color: #fff; }
.mbcs-sidebar__detail { font-size: 12px; color: #666; line-height: 1.6; }

.mbcs-urgency { padding: 14px 20px 14px 20px; border-left: 4px solid <?php echo $urgency_colour; ?>; background: #fff8f8; margin: 0; }
.mbcs-urgency p { font-size: 14px; color: #333; margin: 0; line-height: 1.5; }
.mbcs-urgency strong { color: <?php echo $urgency_colour; ?>; }

.mbcs-section { padding: 64px 0; }
.mbcs-section--white { background: var(--taas-white); }
.mbcs-section--grey  { background: var(--taas-panel); }
.mbcs-section--dark  { background: var(--taas-dark); }
.mbcs-section__eyebrow { display: inline-block; background: var(--taas-dark); color: var(--taas-yellow); font-size: 10px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.mbcs-section--dark .mbcs-section__eyebrow { background: var(--taas-yellow); color: var(--taas-dark); }
.mbcs-section__heading { font-size: clamp(22px, 2.8vw, 30px); font-weight: 700; color: var(--taas-black); letter-spacing: -0.01em; margin: 0 0 20px; }
.mbcs-section--dark .mbcs-section__heading { color: var(--taas-white); }

.mbcs-what { font-size: 16px; color: var(--taas-body); line-height: 1.75; }
.mbcs-symptoms { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.mbcs-symptoms li { font-size: 15px; color: var(--taas-body); padding-left: 24px; position: relative; line-height: 1.5; }
.mbcs-symptoms li::before { content: '⚠'; position: absolute; left: 0; color: var(--taas-alert); font-size: 13px; }
.mbcs-process { list-style: none; padding: 0; margin: 0; counter-reset: step; display: flex; flex-direction: column; gap: 12px; }
.mbcs-process li { font-size: 15px; color: var(--taas-body); padding-left: 44px; position: relative; line-height: 1.55; min-height: 32px; display: flex; align-items: flex-start; }
.mbcs-process li::before { counter-increment: step; content: counter(step); position: absolute; left: 0; top: 0; width: 28px; height: 28px; background: var(--taas-dark); color: var(--taas-yellow); border-radius: 50%; font-size: 12px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

.mbcs-related { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 8px; }
.mbcs-related__card { background: var(--taas-panel); border: 1px solid var(--taas-border); border-radius: var(--taas-radius); padding: 18px 20px; text-decoration: none; transition: border-color 0.2s; }
.mbcs-related__card:hover { border-color: var(--taas-yellow); }
.mbcs-related__label { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-mid); margin-bottom: 6px; }
.mbcs-related__title { font-size: 15px; font-weight: 700; color: var(--taas-black); }

.mbcs-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.mbcs-faq__item { border-bottom: 1px solid var(--taas-border); padding: 16px 0; }
.mbcs-faq__q { font-size: 16px; font-weight: 600; color: var(--taas-black); margin-bottom: 8px; }
.mbcs-faq__a { font-size: 15px; color: var(--taas-mid); line-height: 1.7; }

.mbcs-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.mbcs-enquiry__phone { display: block; font-size: clamp(26px, 4vw, 38px); font-weight: 800; color: var(--taas-yellow); text-decoration: none; margin: 14px 0 6px; }
.mbcs-enquiry__phone:hover { color: #fff; }
.mbcs-enquiry__detail { font-size: 15px; color: #aaa; line-height: 1.7; }
.mbcs-enquiry__detail strong { color: var(--taas-white); }
.mbcs-section--dark .wpcf7 label, .mbcs-section--dark .wpcf7 span:not(.wpcf7-spinner), .mbcs-section--dark .wpcf7 div:not(.wpcf7-response-output), .mbcs-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; }
.mbcs-section--dark .wpcf7 input[type="text"], .mbcs-section--dark .wpcf7 input[type="email"], .mbcs-section--dark .wpcf7 input[type="tel"], .mbcs-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius); padding: 10px 14px; width: 100%; font-family: var(--taas-font); font-size: 15px; }
.mbcs-section--dark .wpcf7 input::placeholder, .mbcs-section--dark .wpcf7 textarea::placeholder { color: #666; }
.mbcs-section--dark .wpcf7 input:focus, .mbcs-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow); }
.mbcs-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow); color: var(--taas-dark); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius); cursor: pointer; width: 100%; margin-top: 4px; }
.mbcs-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2); }

@media (max-width: 900px) {
  .mbcs-hero__inner { grid-template-columns: 1fr; }
  .mbcs-related { grid-template-columns: 1fr 1fr; }
  .mbcs-enquiry { grid-template-columns: 1fr; gap: 32px; }
}
@media (max-width: 600px) {
  .mbcs-hero { padding: 48px 0 40px; }
  .mbcs-section { padding: 48px 0; }
  .mbcs-related { grid-template-columns: 1fr; }
}
</style>

<section class="mbcs-hero">
  <div class="mbcs-hero__inner">
    <div>
      <span class="mbcs-hero__eyebrow">Manukau Brake &amp; Clutch</span>
      <h1><?php echo esc_html($service_name); ?><br><span>Manukau</span></h1>
      <?php if ($price_signal): ?>
      <div class="mbcs-hero__price"><?php echo esc_html($price_signal); ?></div>
      <?php endif; ?>
      <?php if ($urgency_msg): ?>
      <div class="mbcs-urgency" style="margin-bottom:24px;"><p><strong>Note: </strong><?php echo esc_html($urgency_msg); ?></p></div>
      <?php endif; ?>
      <div class="mbcs-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Book Now</a>
        <a href="tel:0800100876" class="taas-btn taas-btn--outline">0800 100 876</a>
      </div>
    </div>
    <div class="mbcs-sidebar">
      <div class="mbcs-sidebar__title">Quick Info</div>
      <ul class="mbcs-sidebar__list">
        <li>139 Cavendish Drive, Manukau</li>
        <li>Mon–Fri 7:30am–5:00pm</li>
        <li>All makes &amp; models</li>
        <li>In-house disc skimming lathe</li>
        <li>MTA Assured workshop</li>
      </ul>
      <hr>
      <a href="tel:0800100876" class="mbcs-sidebar__phone">0800 100 876</a>
      <div class="mbcs-sidebar__detail"><?php echo TAAS_PHONE_LOCAL; ?><br>enquiries@taas.co.nz</div>
    </div>
  </div>
</section>

<?php if ($what_it_is): ?>
<section class="mbcs-section mbcs-section--white">
  <div class="mbcs-wrap">
    <span class="mbcs-section__eyebrow">About This Service</span>
    <h2 class="mbcs-section__heading">What Is <?php echo esc_html($service_name); ?>?</h2>
    <p class="mbcs-what"><?php echo nl2br(wp_kses_post($what_it_is)); ?></p>
  </div>
</section>
<?php endif; ?>

<?php if ($symptoms): ?>
<section class="mbcs-section mbcs-section--grey">
  <div class="mbcs-wrap">
    <span class="mbcs-section__eyebrow">Warning Signs</span>
    <h2 class="mbcs-section__heading">Signs You Need <?php echo esc_html($service_name); ?></h2>
    <ul class="mbcs-symptoms">
      <?php foreach ($symptoms as $s) echo '<li>' . esc_html($s) . '</li>'; ?>
    </ul>
  </div>
</section>
<?php endif; ?>

<?php if ($process): ?>
<section class="mbcs-section mbcs-section--white">
  <div class="mbcs-wrap">
    <span class="mbcs-section__eyebrow">Our Process</span>
    <h2 class="mbcs-section__heading">How We Approach <?php echo esc_html($service_name); ?></h2>
    <ol class="mbcs-process">
      <?php foreach ($process as $p) echo '<li>' . esc_html($p) . '</li>'; ?>
    </ol>
  </div>
</section>
<?php endif; ?>

<section class="mbcs-section mbcs-section--grey">
  <div class="mbcs-wrap">
    <span class="mbcs-section__eyebrow">Related Services</span>
    <h2 class="mbcs-section__heading">You Might Also Need</h2>
    <div class="mbcs-related">
      <a href="<?php echo esc_url($site_url . $related_1_url); ?>" class="mbcs-related__card">
        <div class="mbcs-related__label">Related service</div>
        <div class="mbcs-related__title"><?php echo esc_html($related_1_label); ?> →</div>
      </a>
      <a href="<?php echo esc_url($site_url . $related_2_url); ?>" class="mbcs-related__card">
        <div class="mbcs-related__label">Related service</div>
        <div class="mbcs-related__title"><?php echo esc_html($related_2_label); ?> →</div>
      </a>
      <a href="<?php echo esc_url($site_url . $related_3_url); ?>" class="mbcs-related__card">
        <div class="mbcs-related__label">Related service</div>
        <div class="mbcs-related__title"><?php echo esc_html($related_3_label); ?> →</div>
      </a>
    </div>
  </div>
</section>

<?php if ($faq_q1 || $faq_q2): ?>
<section class="mbcs-section mbcs-section--white">
  <div class="mbcs-wrap">
    <span class="mbcs-section__eyebrow">FAQ</span>
    <h2 class="mbcs-section__heading">Common Questions</h2>
    <div class="mbcs-faq__list">
      <?php if ($faq_q1 && $faq_a1): ?>
      <div class="mbcs-faq__item"><p class="mbcs-faq__q"><?php echo esc_html($faq_q1); ?></p><p class="mbcs-faq__a"><?php echo wp_kses_post($faq_a1); ?></p></div>
      <?php endif; ?>
      <?php if ($faq_q2 && $faq_a2): ?>
      <div class="mbcs-faq__item"><p class="mbcs-faq__q"><?php echo esc_html($faq_q2); ?></p><p class="mbcs-faq__a"><?php echo wp_kses_post($faq_a2); ?></p></div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="mbcs-section mbcs-section--dark" id="enquire">
  <div class="mbcs-wrap">
    <div class="mbcs-enquiry">
      <div>
        <span class="mbcs-section__eyebrow">Book or Enquire</span>
        <h2 class="mbcs-section__heading"><?php echo esc_html($service_name); ?> — Book Now</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle make, model and what you're experiencing.</p>
        <a href="tel:<?php echo str_replace(' ','',TAAS_PHONE_FREE); ?>" class="mbcs-enquiry__phone"><?php echo TAAS_PHONE_FREE; ?></a>
        <div class="mbcs-enquiry__detail"><strong>Manukau Brake &amp; Clutch — Tony Allen Auto Service</strong><br>139 Cavendish Drive, Manukau<br>Mon–Fri 7:30am–5:00pm · Local: <?php echo TAAS_PHONE_LOCAL; ?></div>
      </div>
      <div><?php echo do_shortcode(TAAS_CF7_GENERAL); ?></div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
