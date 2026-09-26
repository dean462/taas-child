<?php
/**
 * Template Name: Terms and Conditions
 * Description: Terms & Conditions — TAAS workshop terms
 * Built: July 2026
 */

require_once get_stylesheet_directory() . '/taas-constants.php';

$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$phone_local = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$email       = defined('TAAS_EMAIL')        ? TAAS_EMAIL        : 'enquiries@taas.co.nz';
$address     = defined('TAAS_ADDRESS')      ? TAAS_ADDRESS      : '139 Cavendish Drive, Manukau, Auckland 2104';
$established = defined('TAAS_ESTABLISHED')  ? TAAS_ESTABLISHED  : '1985';
$hours       = defined('TAAS_HOURS')        ? TAAS_HOURS        : 'Monday–Friday 7:30am–5:00pm';
$finance_list = defined('TAAS_FINANCE_LIST') ? TAAS_FINANCE_LIST : 'Afterpay, Q Card, GEM, Aotea Finance';

get_header();
?>

<style>
/* ══ TERMS & CONDITIONS — SCOPED CSS ══════════════════════════════════ */
.tc { font-family: var(--taas-font, 'Inter', Arial, sans-serif); overflow-x: hidden; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
.tc .w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }

/* ── Hero ── */
.tc-hero {
  background: var(--taas-black, #111111);
  padding: 80px 0 60px;
  text-align: center;
  position: relative;
}
.tc-hero::before {
  content: '';
  position: absolute; inset: 0;
  background: repeating-linear-gradient(
    -55deg, transparent, transparent 60px,
    rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px
  );
  pointer-events: none;
}
.tc-hero .w { position: relative; z-index: 1; }
.tc-hero__eye {
  display: inline-block;
  background: var(--taas-yellow, #FFC800);
  color: var(--taas-dark, #1A1A1A);
  font-size: 10px; font-weight: 800;
  letter-spacing: .16em; text-transform: uppercase;
  padding: 6px 14px; margin-bottom: 20px;
}
.tc-hero__h1 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: var(--taas-h1-spoke, clamp(34px, 5vw, 50px));
  font-weight: 800; color: #fff;
  margin: 0 0 12px; line-height: 1.15;
}
.tc-hero__sub {
  font-size: 16px; color: rgba(255,255,255,.55);
  max-width: 540px; margin: 0 auto; line-height: 1.6;
  font-weight: 300;
}

/* ── Content ── */
.tc-content {
  background: #fff;
  padding: 64px 0 72px;
}
.tc-content__inner {
  max-width: 780px;
  margin: 0 auto;
}
.tc-content h2 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 22px; font-weight: 700;
  color: var(--taas-dark, #1A1A1A);
  margin: 48px 0 12px;
  padding-top: 16px;
}
.tc-content h2:first-of-type { margin-top: 0; padding-top: 0; }
.tc-content p {
  font-size: 16px; color: var(--taas-body, #333);
  line-height: 1.75; margin-bottom: 16px;
  font-weight: 300;
}
.tc-content ul {
  margin: 0 0 20px 0; padding-left: 20px;
  list-style: none;
}
.tc-content ul li {
  font-size: 15px; color: var(--taas-body, #333);
  line-height: 1.7; margin-bottom: 8px;
  padding-left: 20px; position: relative;
  font-weight: 300;
}
.tc-content ul li::before {
  content: '·';
  position: absolute; left: 0;
  color: var(--taas-yellow, #FFC800);
  font-weight: 900; font-size: 20px;
  line-height: 1.5;
}
.tc-content strong { font-weight: 600; color: var(--taas-dark, #1A1A1A); }
.tc-content a { color: var(--taas-dark, #1A1A1A); text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--taas-yellow, #FFC800); text-decoration-thickness: 2px; }
.tc-content a:hover { color: var(--taas-yellow, #FFC800); }

.tc-updated {
  font-size: 13px; color: var(--taas-mid, #666);
  margin-top: 48px; padding-top: 24px;
  border-top: 1px solid var(--taas-border, #E8E8E4);
}

/* ── CTA ── */
.tc-cta {
  background: var(--taas-dark, #1A1A1A);
  padding: 48px 0;
  text-align: center;
}
.tc-cta__text {
  font-size: 16px; color: rgba(255,255,255,.6);
  margin-bottom: 12px;
  font-weight: 300;
}
.tc-cta__phone {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 28px; font-weight: 900;
  color: var(--taas-yellow, #FFC800);
  text-decoration: none;
  transition: opacity .15s;
}
.tc-cta__phone:hover { opacity: .65; }
.tc-cta__email {
  display: block; margin-top: 8px;
  font-size: 14px; color: rgba(255,255,255,.4);
  text-decoration: none;
}
.tc-cta__email:hover { color: rgba(255,255,255,.6); }

/* ── Responsive ── */
@media (max-width: 640px) {
  .tc-hero { padding: 60px 0 44px; }
  .tc-content { padding: 44px 0 52px; }
  .tc-content h2 { font-size: 19px; }
  .tc-content p { font-size: 14px; }
  .tc-content ul li { font-size: 14px; }
}
</style>

<div class="tc">

<!-- ══ HERO ════════════════════════════════════════════════════════════ -->
<section class="tc-hero">
  <div class="w">
    <div class="tc-hero__eye">Legal</div>
    <h1 class="tc-hero__h1">Terms &amp; Conditions</h1>
    <p class="tc-hero__sub">The terms that apply when you use our services at Tony Allen Auto Service.</p>
  </div>
</section>

<!-- ══ CONTENT ═════════════════════════════════════════════════════════ -->
<section class="tc-content">
  <div class="w">
    <div class="tc-content__inner">

      <h2>About these terms</h2>
      <p>These terms and conditions apply to all services provided by Tony Allen Auto Service Ltd (TAAS), operating from <?php echo esc_html($address); ?>. By requesting a service, submitting an enquiry, or leaving your vehicle with us, you agree to these terms.</p>
      <p>We are a family-owned independent workshop, MTA Assured and NZTA Authorised, operating since <?php echo esc_html($established); ?>.</p>

      <h2>Estimates and pricing</h2>
      <p>All pricing provided by TAAS is an <strong>estimate</strong>, not a fixed quote. An estimate is our best assessment of the likely cost based on the information available at the time, including your description of the issue, a visual inspection, and our experience with similar vehicles.</p>
      <p>We provide an estimate before we start any work. Nothing happens without your approval. If we find that the actual cost will exceed the estimate, we will contact you to explain what we have found and provide an updated estimate before proceeding.</p>
      <p>Estimates are valid for 14 days from the date provided. Parts pricing may change due to supplier costs, exchange rates, or availability.</p>

      <h2>Approval to proceed</h2>
      <p>We require your approval before beginning any work on your vehicle. Approval can be given verbally (in person or by phone) or in writing (email or text). If we are unable to reach you and the vehicle is unsafe to drive, we will make the vehicle safe but will not carry out further repairs until we have your approval.</p>

      <h2>Additional work</h2>
      <p>During a service or repair, our technicians may identify additional issues that were not part of the original estimate. If this happens, we will contact you to explain what we have found, provide a separate estimate for the additional work, and only proceed with your approval.</p>
      <p>We will never carry out work you have not agreed to.</p>

      <h2>Diagnostic fees</h2>
      <p>Some faults require diagnostic investigation before we can provide an estimate for the repair. Where a diagnostic fee applies, this will be communicated to you before we begin. The diagnostic fee covers the technician&rsquo;s time and the use of diagnostic equipment. It is payable regardless of whether you choose to proceed with the repair.</p>

      <h2>Payment</h2>
      <p>Payment is due when your vehicle is ready for collection. We accept the following payment methods:</p>
      <ul>
        <li>EFTPOS</li>
        <li>Visa and Mastercard</li>
        <li>Cash</li>
        <li>Direct credit (by prior arrangement for fleet and trade accounts only)</li>
      </ul>
      <p>Your vehicle will not be released until payment has been received in full, unless a prior arrangement has been made.</p>

      <h2>Finance options</h2>
      <p>We offer payment plans through the following finance providers: <?php echo esc_html($finance_list); ?>.</p>
      <p>These are independent third-party finance providers. TAAS is a merchant partner and does not provide financial advice, assess your eligibility, or make lending decisions. Each finance provider has their own terms, conditions, fees, and approval criteria. You should review the provider&rsquo;s terms before applying.</p>
      <p>Finance arrangements must be confirmed before work is completed. Finance availability is subject to the provider&rsquo;s approval process and may not be available for all services or amounts.</p>

      <h2>Workmanship warranty</h2>
      <p>We stand behind our work. If a repair carried out by TAAS develops a fault that is directly attributable to our workmanship, we will rectify it at no additional charge, provided the issue is reported within a reasonable timeframe and the vehicle has not been modified or repaired elsewhere in a way that affects our original work.</p>
      <p>This warranty covers our labour and workmanship only. It does not cover wear and tear, customer-supplied parts, pre-existing conditions, or damage caused by continued use after a fault was identified.</p>

      <h2>Parts warranty</h2>
      <p>Parts fitted by TAAS carry the manufacturer&rsquo;s warranty, not a TAAS warranty. If a part fails within the manufacturer&rsquo;s warranty period, we will assist with the warranty claim process. You will not be charged for labour to remove and refit a warranty-replacement part where TAAS originally fitted the part.</p>
      <p>Warranty does not apply to parts you have supplied yourself. If you supply your own parts, you accept responsibility for their quality and suitability, and any manufacturer warranty claim is between you and your supplier.</p>

      <h2>WOF inspections</h2>
      <p>Warrant of Fitness (WOF) inspections are carried out in accordance with NZTA requirements. A WOF pass or fail is determined by the vehicle&rsquo;s condition at the time of inspection against the NZTA checklist. TAAS does not guarantee that a vehicle will pass its WOF.</p>
      <p>If your vehicle fails its WOF, you may have the repairs carried out at TAAS or at any workshop of your choosing. A free recheck is available regardless of who carries out the repairs, provided the vehicle is returned within 28 days of the original inspection.</p>

      <h2>Vehicle collection</h2>
      <p>Once your vehicle is ready, we will notify you by phone, text, or email. Vehicles should be collected during our business hours: <?php echo esc_html($hours); ?>.</p>
      <p>If your vehicle is not collected within 5 working days of notification, a storage fee of $15 per day (incl. GST) may apply. TAAS accepts no liability for vehicles left on our premises beyond 10 working days after notification of completion.</p>

      <h2>Sublet services</h2>
      <p>Certain specialist work may be sublet to third-party providers. This includes but is not limited to towing services and full transmission rebuilds. Where work is sublet, we will inform you and the third-party provider&rsquo;s own terms and warranty will apply to their portion of the work. TAAS coordinates the process so you deal with us, not the subcontractor.</p>

      <h2>Uncollected vehicles</h2>
      <p>If a vehicle is left at our premises for more than 30 days after we have notified you that it is ready for collection (or after you have declined to proceed with an estimate), TAAS reserves the right to take action to recover storage costs in accordance with the Uncollected Goods Act 2006.</p>

      <h2>Limitation of liability</h2>
      <p>TAAS will take reasonable care with your vehicle while it is in our custody. Our liability for any loss or damage is limited to the reasonable cost of repair or, where repair is not possible, the market value of the vehicle at the time the loss or damage occurred.</p>
      <p>TAAS is not liable for loss or damage caused by pre-existing conditions, normal wear and tear, or faults that could not reasonably have been detected during the agreed scope of work. We are not liable for consequential losses such as loss of income, missed appointments, or alternative transport costs.</p>
      <p>Nothing in these terms limits or excludes any rights you have under the Consumer Guarantees Act 1993 or the Fair Trading Act 1986.</p>

      <h2>Dispute resolution</h2>
      <p>If you are not satisfied with any aspect of our service, please contact us first. Most issues can be resolved by talking directly with our team.</p>
      <ul>
        <li><strong>Step 1:</strong> Contact us at <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a> or call <a href="tel:0800100876"><?php echo esc_html($phone_free); ?></a></li>
        <li><strong>Step 2:</strong> If we cannot resolve the issue directly, you may contact the <strong>Motor Trade Association (MTA)</strong> for mediation assistance. As an MTA Assured member, we are committed to fair resolution</li>
        <li><strong>Step 3:</strong> If the matter remains unresolved, you may take a claim to the <strong>Disputes Tribunal</strong> (for claims up to $30,000) or the <strong>District Court</strong></li>
      </ul>

      <h2>Changes to these terms</h2>
      <p>We may update these terms from time to time. Any changes will be posted on this page with an updated date below. The terms that apply to your service are the terms in effect at the time you requested or agreed to the work.</p>

      <h2>Contact us</h2>
      <p>If you have any questions about these terms, contact us:</p>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
        <li><strong>Phone:</strong> <a href="tel:0800100876"><?php echo esc_html($phone_free); ?></a></li>
        <li><strong>Address:</strong> <?php echo esc_html($address); ?></li>
      </ul>

      <p class="tc-updated">Last updated: <?php echo date('F Y'); ?></p>

    </div>
  </div>
</section>

<!-- ══ CTA ═════════════════════════════════════════════════════════════ -->
<section class="tc-cta">
  <div class="w">
    <p class="tc-cta__text">Questions about our terms? Get in touch.</p>
    <a href="tel:0800100876" class="tc-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="tc-cta__email"><?php echo esc_html($email); ?></a>
  </div>
</section>

</div>

<?php get_footer(); ?>
