<?php
/**
 * TAAS Spoke Render Partial
 * Used by all spoke (suburb/sub-service) location pages.
 * Rebuilt to Go-Live Standard — June 2026.
 *
 * Required $SPOKE keys:
 *   ns                — short namespace for body class (legacy compatibility)
 *   parent_label / parent_url  — for breadcrumb
 *   this_label        — breadcrumb current page
 *   hero_eye          — yellow eyebrow text
 *   hero_h1_top / hero_h1_bot — H1 split across two lines (bot = yellow span)
 *   hero_sub          — hero subhead paragraph
 *   hero_signal       — yellow signal pill text
 *   hero_cta_primary / hero_cta_secondary — button labels
 *   phonestrip_label  — yellow strip text
 *   trust_items       — array of trust strip strings
 *   edu_eye / edu_h2 / edu_body — educational content section
 *   finance_label / finance_sub — finance strip copy
 *   why_h2 / why_lead / why_points  — Why TAAS section
 *   why_card_title / why_card_p / why_card_links  — Why right card
 *   enquiry_h2_a / enquiry_h2_b — H2 split with yellow span
 *   enquiry_sub       — enquiry subhead
 *   enquiry_list      — array of ticked points
 *   enquiry_brand     — strong line ("Tony Allen Auto Service" or division name)
 *   related_h2 / related_links  — related services
 *   faqs              — array of q/a pairs
 *   faq_h2_suffix     — FAQ heading suffix
 *   close_text        — closing CTA top line
 *   distance_text / suburb_name / area_served
 *   hero_bg           — inline style string for hero background
 *   finance           — array of finance providers
 *   phone_free / phone_free_tel / phone_local
 *   hours / maps_url / site_url / cf7 / reviews_widget / rating / reviews
 *   body_template_class — page-template-XXX class for scoped reset
 */

if (empty($SPOKE) || !is_array($SPOKE)) return;
$S = $SPOKE;
?>
<style>
.<?php echo esc_attr($S['body_template_class']); ?> .site-content,.<?php echo esc_attr($S['body_template_class']); ?> .entry-content,.<?php echo esc_attr($S['body_template_class']); ?> .entry-header,.<?php echo esc_attr($S['body_template_class']); ?> article,.<?php echo esc_attr($S['body_template_class']); ?> #primary,.<?php echo esc_attr($S['body_template_class']); ?> #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.<?php echo esc_attr($S['body_template_class']); ?>{overflow-x:hidden;}
body.<?php echo esc_attr($S['body_template_class']); ?>,body.<?php echo esc_attr($S['body_template_class']); ?> h1,body.<?php echo esc_attr($S['body_template_class']); ?> h2,body.<?php echo esc_attr($S['body_template_class']); ?> h3,body.<?php echo esc_attr($S['body_template_class']); ?> h4,body.<?php echo esc_attr($S['body_template_class']); ?> h5,body.<?php echo esc_attr($S['body_template_class']); ?> h6,body.<?php echo esc_attr($S['body_template_class']); ?> p,body.<?php echo esc_attr($S['body_template_class']); ?> li,body.<?php echo esc_attr($S['body_template_class']); ?> td,body.<?php echo esc_attr($S['body_template_class']); ?> span,body.<?php echo esc_attr($S['body_template_class']); ?> div,body.<?php echo esc_attr($S['body_template_class']); ?> a,body.<?php echo esc_attr($S['body_template_class']); ?> label,body.<?php echo esc_attr($S['body_template_class']); ?> input,body.<?php echo esc_attr($S['body_template_class']); ?> textarea,body.<?php echo esc_attr($S['body_template_class']); ?> select,body.<?php echo esc_attr($S['body_template_class']); ?> button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}
</style>

<nav class="spoke-crumb" aria-label="Breadcrumb"><div class="spoke-crumb__inner"><a href="<?php echo esc_url($S['site_url']); ?>">Home</a><span class="spoke-crumb__sep">›</span><a href="<?php echo esc_url($S['parent_url']); ?>"><?php echo $S['parent_label']; ?></a><span class="spoke-crumb__sep">›</span><span class="spoke-crumb__cur"><?php echo esc_html($S['this_label']); ?></span></div></nav>

<section class="spoke-hero"<?php if (!empty($S['hero_bg'])) echo ' style="' . $S['hero_bg'] . '"'; ?>>
  <div class="spoke-w"><div class="spoke-hero__inner">
    <span class="spoke-eye spoke-eye--yellow"><?php echo $S['hero_eye']; ?></span>
    <h1><?php echo $S['hero_h1_top']; ?><br><span><?php echo $S['hero_h1_bot']; ?></span></h1>
    <p class="spoke-hero__sub"><?php echo $S['hero_sub']; ?></p>
    <div class="spoke-hero__signal"><?php echo $S['hero_signal']; ?></div>
    <div class="spoke-hero__ctas">
      <a href="tel:<?php echo esc_attr($S['phone_free_tel']); ?>" class="spoke-btn spoke-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($S['hero_cta_primary']); ?></a>
      <a href="#spoke-enquire" class="spoke-btn spoke-btn--outline"><?php echo esc_html($S['hero_cta_secondary']); ?></a>
    </div>
  </div></div>
</section>

<div class="spoke-phonestrip"><div class="spoke-phonestrip__inner"><span class="spoke-phonestrip__label"><?php echo $S['phonestrip_label']; ?></span><a href="tel:<?php echo esc_attr($S['phone_free_tel']); ?>" class="spoke-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($S['phone_free']); ?></a></div></div>

<div class="spoke-trust"><div class="spoke-trust__inner">
  <?php foreach ($S['trust_items'] as $t): ?>
    <div class="spoke-trust__item"><?php echo $t; ?></div>
  <?php endforeach; ?>
</div></div>

<section class="spoke-section spoke-section--white"><div class="spoke-w" style="text-align:center;">
  <span class="spoke-eye spoke-eye--dark"><?php echo $S['edu_eye']; ?></span>
  <h2 class="spoke-h2"><?php echo $S['edu_h2']; ?></h2>
  <div class="spoke-edu" style="text-align:left;"><?php echo $S['edu_body']; ?></div>
</div></section>

<div class="spoke-finance"><div class="spoke-finance__inner">
  <div class="spoke-finance__text"><strong><?php echo $S['finance_label']; ?></strong> <?php echo $S['finance_sub']; ?></div>
  <div class="spoke-finance__logos"><?php foreach ($S['finance'] as $f): ?><span class="spoke-fin"><?php echo esc_html($f['name']); ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($S['site_url'] . '/finance-options/'); ?>" class="spoke-finance__link">View finance options →</a>
</div></div>

<section class="spoke-section spoke-section--grey"><div class="spoke-w"><div class="spoke-why__inner">
  <div>
    <span class="spoke-eye spoke-eye--dark">Why <?php echo esc_html($S['suburb_name']); ?> Chooses TAAS</span>
    <h2 class="spoke-h2"><?php echo $S['why_h2']; ?></h2>
    <p class="spoke-lead" style="margin-bottom:24px;"><?php echo $S['why_lead']; ?></p>
    <ul class="spoke-why__points">
      <?php foreach ($S['why_points'] as $pt): ?><li class="spoke-why__point"><?php echo wp_kses_post($pt); ?></li><?php endforeach; ?>
    </ul>
  </div>
  <div class="spoke-why__card">
    <h3><?php echo $S['why_card_title']; ?></h3>
    <p><?php echo $S['why_card_p']; ?></p>
    <div class="spoke-why__links">
      <?php foreach ($S['why_card_links'] as $ex): ?>
        <a href="<?php echo esc_url($S['site_url'] . $ex['url']); ?>"><span>→</span><?php echo $ex['label']; ?></a>
      <?php endforeach; ?>
    </div>
    <a href="#spoke-enquire" class="spoke-btn spoke-btn--dark"><?php echo esc_html($S['hero_cta_secondary']); ?></a>
  </div>
</div></div></section>

<section id="spoke-enquire" class="spoke-section spoke-section--dark"><div class="spoke-w"><div class="spoke-enquiry">
  <div>
    <span class="spoke-eye spoke-eye--yellow">Book or Enquire</span>
    <h2 class="spoke-h2 spoke-h2--white"><?php echo $S['enquiry_h2_a']; ?> <span style="color:var(--taas-yellow);"><?php echo esc_html($S['enquiry_h2_b']); ?></span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;"><?php echo $S['enquiry_sub']; ?></p>
    <ul class="spoke-enquiry__list">
      <?php foreach ($S['enquiry_list'] as $ck): ?>
        <li><span>✓</span><?php echo wp_kses_post($ck); ?></li>
      <?php endforeach; ?>
    </ul>
    <a href="tel:<?php echo esc_attr($S['phone_free_tel']); ?>" class="spoke-enquiry__phone"><?php echo esc_html($S['phone_free']); ?></a>
    <div class="spoke-enquiry__detail"><strong><?php echo $S['enquiry_brand']; ?></strong><br><a href="<?php echo esc_url($S['maps_url']); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a> · <?php echo esc_html($S['distance_text']); ?><br><?php echo esc_html($S['hours']); ?> · <?php echo esc_html($S['phone_local']); ?></div>
    <div class="spoke-enquiry__badges"><?php foreach ($S['finance'] as $f): ?><span class="spoke-enquiry__badge"><?php echo esc_html($f['name']); ?></span><?php endforeach; ?></div>
    <div class="spoke-enquiry__note"><strong>Estimate before we start.</strong> Written quote before any work — nothing happens without your approval. <a href="<?php echo esc_url($S['site_url'] . '/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="spoke-enquiry__form">
    <div class="spoke-enquiry__form-title">Send Us Your Details</div>
    <?php if (!empty($S['cf7'])): echo do_shortcode($S['cf7']); else: ?>
      <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($S['phone_free_tel']); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($S['phone_free']); ?></a> or <a href="<?php echo esc_url($S['site_url'] . '/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<section class="spoke-section spoke-section--white"><div class="spoke-w">
  <span class="spoke-eye spoke-eye--dark">Customer Reviews</span>
  <h2 class="spoke-h2"><?php echo esc_html($S['rating']); ?>★ · <?php echo esc_html($S['reviews']); ?> Google Reviews</h2>
  <?php if (!empty($S['reviews_widget'])) echo do_shortcode($S['reviews_widget']); ?>
</div></section>

<section class="spoke-section spoke-section--grey"><div class="spoke-w">
  <span class="spoke-eye spoke-eye--dark">Related Services</span>
  <h2 class="spoke-h2"><?php echo $S['related_h2']; ?></h2>
  <div class="spoke-related__grid">
    <?php foreach ($S['related_links'] as $r): ?>
      <a href="<?php echo esc_url($S['site_url'] . $r['url']); ?>" class="spoke-related__link"><?php echo $r['label']; ?><span>→</span></a>
    <?php endforeach; ?>
  </div>
</div></section>

<section class="spoke-section spoke-section--white"><div class="spoke-w">
  <span class="spoke-eye spoke-eye--dark">Common Questions</span>
  <h2 class="spoke-h2"><?php echo esc_html($S['faq_h2_suffix']); ?></h2>
  <div class="spoke-faq__list">
    <?php foreach ($S['faqs'] as $i => $faq): ?>
      <div class="spoke-faq__item<?php echo $i === 0 ? ' spoke-faq__item--open' : ''; ?>"><button class="spoke-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="spoke-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="spoke-a-<?php echo $i; ?>" class="spoke-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
    <?php endforeach; ?>
  </div>
</div></section>

<section class="spoke-section spoke-section--grey"><div class="spoke-w">
  <span class="spoke-eye spoke-eye--dark"><?php echo esc_html($S['suburb_name']); ?></span>
  <h2 class="spoke-h2"><?php echo esc_html($S['this_label']); ?></h2>
  <p class="spoke-lead" style="margin-bottom:0;">Serving <?php echo esc_html($S['area_served']); ?> from <a href="<?php echo esc_url($S['maps_url']); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a> — <?php echo esc_html($S['distance_text']); ?>.</p>
  <div class="spoke-close">
    <div class="spoke-close__text"><?php echo $S['close_text']; ?><span>Open <?php echo esc_html($S['hours']); ?> · Sat &amp; Sun closed</span></div>
    <div class="spoke-close__ctas"><a href="tel:<?php echo esc_attr($S['phone_free_tel']); ?>" class="spoke-btn spoke-btn--primary"><?php echo esc_html($S['phone_free']); ?></a><a href="#spoke-enquire" class="spoke-btn spoke-btn--dark"><?php echo esc_html($S['hero_cta_secondary']); ?></a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.spoke-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.spoke-faq__item');var wasOpen=item.classList.contains('spoke-faq__item--open');document.querySelectorAll('.spoke-faq__item--open').forEach(function(el){el.classList.remove('spoke-faq__item--open');el.querySelector('.spoke-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('spoke-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<script>document.body.classList.add('spoke-page');</script>
