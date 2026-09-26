<?php
/**
 * Template Name: Privacy Policy
 * Description: Privacy Policy — NZ Privacy Act 2020 compliant
 * Built: June 2026
 */

require_once get_stylesheet_directory() . '/taas-constants.php';

$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$email       = defined('TAAS_EMAIL')        ? TAAS_EMAIL        : 'enquiries@taas.co.nz';
$address     = defined('TAAS_ADDRESS')      ? TAAS_ADDRESS      : '139 Cavendish Drive, Manukau, Auckland 2104';
$established = defined('TAAS_ESTABLISHED')  ? TAAS_ESTABLISHED  : '1985';

get_header();
?>

<style>
/* ══ PRIVACY POLICY — SCOPED CSS ═══════════════════════════════════════ */
.pp { font-family: var(--taas-font, 'Inter', Arial, sans-serif); overflow-x: hidden; }
.pp .w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }

/* ── Hero ── */
.pp-hero {
  background: var(--taas-black, #111111);
  padding: 80px 0 60px;
  text-align: center;
  position: relative;
}
.pp-hero::before {
  content: '';
  position: absolute; inset: 0;
  background: repeating-linear-gradient(
    -55deg, transparent, transparent 60px,
    rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px
  );
  pointer-events: none;
}
.pp-hero .w { position: relative; z-index: 1; }
.pp-hero__eye {
  display: inline-block;
  background: var(--taas-yellow, #FFC800);
  color: var(--taas-dark, #1A1A1A);
  font-size: 10px; font-weight: 800;
  letter-spacing: .16em; text-transform: uppercase;
  padding: 6px 14px; margin-bottom: 20px;
}
.pp-hero__h1 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: var(--taas-h1-spoke, clamp(34px, 5vw, 50px));
  font-weight: 800; color: #fff;
  margin: 0 0 12px; line-height: 1.15;
}
.pp-hero__sub {
  font-size: 16px; color: rgba(255,255,255,.55);
  max-width: 540px; margin: 0 auto; line-height: 1.6;
}

/* ── Content ── */
.pp-content {
  background: #fff;
  padding: 64px 0 72px;
}
.pp-content__inner {
  max-width: 780px;
  margin: 0 auto;
}
.pp-content h2 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 22px; font-weight: 700;
  color: var(--taas-dark, #1A1A1A);
  margin: 48px 0 12px;
  padding-top: 16px;
}
.pp-content h2:first-of-type { margin-top: 0; padding-top: 0; }
.pp-content p {
  font-size: 16px; color: var(--taas-body, #333);
  line-height: 1.75; margin-bottom: 16px;
  font-weight: 300;
}
.pp-content ul {
  margin: 0 0 20px 0; padding-left: 20px;
  list-style: none;
}
.pp-content ul li {
  font-size: 15px; color: var(--taas-body, #333);
  line-height: 1.7; margin-bottom: 8px;
  padding-left: 20px; position: relative;
  font-weight: 300;
}
.pp-content ul li::before {
  content: '·';
  position: absolute; left: 0;
  color: var(--taas-yellow, #FFC800);
  font-weight: 900; font-size: 20px;
  line-height: 1.5;
}
.pp-content strong { font-weight: 600; color: var(--taas-dark, #1A1A1A); }
.pp-content a { color: var(--taas-dark, #1A1A1A); text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--taas-yellow, #FFC800); text-decoration-thickness: 2px; }
.pp-content a:hover { color: var(--taas-yellow, #FFC800); }

.pp-updated {
  font-size: 13px; color: var(--taas-mid, #666);
  margin-top: 48px; padding-top: 24px;
  border-top: 1px solid var(--taas-border, #E8E8E4);
}

/* ── CTA ── */
.pp-cta {
  background: var(--taas-dark, #1A1A1A);
  padding: 48px 0;
  text-align: center;
}
.pp-cta__text {
  font-size: 16px; color: rgba(255,255,255,.6);
  margin-bottom: 12px;
}
.pp-cta__phone {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 28px; font-weight: 900;
  color: var(--taas-yellow, #FFC800);
  text-decoration: none;
  transition: opacity .15s;
}
.pp-cta__phone:hover { opacity: .7; }
.pp-cta__email {
  display: block; margin-top: 8px;
  font-size: 14px; color: rgba(255,255,255,.4);
  text-decoration: none;
}
.pp-cta__email:hover { color: rgba(255,255,255,.6); }

/* ── Responsive ── */
@media (max-width: 640px) {
  .pp-hero { padding: 60px 0 44px; }
  .pp-content { padding: 44px 0 52px; }
  .pp-content h2 { font-size: 19px; }
}
</style>

<div class="pp">

<!-- ══ HERO ════════════════════════════════════════════════════════════ -->
<section class="pp-hero">
  <div class="w">
    <div class="pp-hero__eye">Legal</div>
    <h1 class="pp-hero__h1">Privacy Policy</h1>
    <p class="pp-hero__sub">How we collect, use, and protect your personal information at Tony Allen Auto Service.</p>
  </div>
</section>

<!-- ══ CONTENT ═════════════════════════════════════════════════════════ -->
<section class="pp-content">
  <div class="w">
    <div class="pp-content__inner">

      <h2>Who we are</h2>
      <p>Tony Allen Auto Service Ltd (TAAS) is a family-owned automotive workshop operating from <?php echo esc_html($address); ?> since <?php echo esc_html($established); ?>. This privacy policy explains how we collect, use, store, and protect personal information in accordance with the New Zealand Privacy Act 2020.</p>

      <h2>What information we collect</h2>
      <p>When you contact us, book a service, or submit an enquiry through our website, we may collect:</p>
      <ul>
        <li>Your name</li>
        <li>Phone number</li>
        <li>Email address</li>
        <li>Vehicle registration number (optional on most forms)</li>
        <li>Details about your vehicle or the service you need</li>
      </ul>
      <p>We only collect information that is necessary to respond to your enquiry, book your service, or carry out repairs on your vehicle.</p>

      <h2>How we collect your information</h2>
      <p>We collect personal information when you:</p>
      <ul>
        <li>Submit an enquiry or booking form on our website</li>
        <li>Call us or email us directly</li>
        <li>Visit our workshop and provide your details for a service or WOF</li>
        <li>Use a finance option through one of our partner providers</li>
      </ul>

      <h2>Why we collect your information</h2>
      <p>We use your personal information to:</p>
      <ul>
        <li>Respond to your enquiry or booking request</li>
        <li>Contact you about your vehicle &mdash; service updates, completed work, or follow-up</li>
        <li>Process payments and invoices</li>
        <li>Maintain service history records for your vehicle</li>
        <li>Meet our legal obligations (e.g. WOF records required by NZTA)</li>
      </ul>
      <p>We do not use your information for unsolicited marketing unless you have opted in.</p>

      <h2>How we store your information</h2>
      <p>Your information is stored in the following systems:</p>
      <ul>
        <li><strong>Workshop management system</strong> &mdash; service history, invoices, and vehicle records are stored in our workshop management software (Mechanic Desk)</li>
        <li><strong>Website database</strong> &mdash; form submissions are stored in our WordPress database hosted on Cloudways (DigitalOcean, Sydney data centre)</li>
        <li><strong>Email delivery</strong> &mdash; form submissions are delivered via Brevo, a transactional email service. Brevo processes your name, email, phone number, and message content to deliver the enquiry to our team</li>
        <li><strong>Accounting</strong> &mdash; invoicing and payment records are processed through Xero</li>
      </ul>
      <p>All systems are password-protected and access is limited to authorised TAAS staff.</p>

      <h2>Third-party services</h2>
      <p>Our website uses the following third-party services that may collect data:</p>
      <ul>
        <li><strong>Google Analytics (GA4)</strong> &mdash; collects anonymous website usage data (pages visited, time on site, device type, general location). No personally identifiable information is collected by GA4. Data is processed by Google</li>
        <li><strong>Cloudflare</strong> &mdash; provides website security and performance. Cloudflare may set performance cookies and processes IP addresses for security purposes</li>
        <li><strong>Trustindex</strong> &mdash; displays Google reviews on our website. Reviews are public content sourced from Google Business Profile</li>
        <li><strong>Brevo</strong> &mdash; delivers form submission emails from our website to our team. Brevo&rsquo;s privacy policy is available at <a href="https://www.brevo.com/legal/privacypolicy/" target="_blank" rel="noopener noreferrer">brevo.com/legal/privacypolicy</a></li>
      </ul>
      <p>We do not sell, rent, or trade your personal information to any third party.</p>

      <h2>Finance providers</h2>
      <p>If you choose to use a finance option (Afterpay, Q Card, GEM Finance, or Aotea Finance), you will be redirected to that provider&rsquo;s own application process. TAAS does not collect or store your financial information. Each finance provider has their own privacy policy and terms, which you should review before applying.</p>

      <h2>Cookies</h2>
      <p>Our website uses cookies for the following purposes:</p>
      <ul>
        <li><strong>Essential cookies</strong> &mdash; required for the website to function (session management, form submissions)</li>
        <li><strong>Analytics cookies</strong> &mdash; Google Analytics uses cookies to understand how visitors use our website. This data is anonymous and aggregated</li>
        <li><strong>Performance cookies</strong> &mdash; Cloudflare may set cookies to optimise website delivery and security</li>
      </ul>
      <p>We do not use advertising or tracking cookies. New Zealand does not currently require cookie consent banners, but we believe in transparency about what our site uses.</p>

      <h2>Your rights under the Privacy Act 2020</h2>
      <p>Under the New Zealand Privacy Act 2020, you have the right to:</p>
      <ul>
        <li><strong>Access</strong> your personal information &mdash; you can request a copy of any personal data we hold about you</li>
        <li><strong>Correct</strong> your information &mdash; if any details we hold are inaccurate, you can ask us to update them</li>
        <li><strong>Request deletion</strong> &mdash; you can ask us to delete your personal information, subject to any legal obligations we have to retain certain records (e.g. tax records, WOF inspection records)</li>
      </ul>
      <p>To exercise any of these rights, contact us at <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a> or call <a href="tel:0800100876"><?php echo esc_html($phone_free); ?></a>. We will respond within 20 working days as required by the Privacy Act.</p>

      <h2>Data retention</h2>
      <p>We retain your personal information only for as long as it is needed for the purpose it was collected, or as required by law. Service and WOF records are retained as required by NZTA regulations. Enquiry form submissions are retained for 12 months then deleted unless they relate to an ongoing customer relationship.</p>

      <h2>Data breaches</h2>
      <p>In the event of a data breach that poses a risk of serious harm, we will notify the Office of the Privacy Commissioner and any affected individuals as required under the Privacy Act 2020.</p>

      <h2>Changes to this policy</h2>
      <p>We may update this privacy policy from time to time. Any changes will be posted on this page with an updated date below. We encourage you to review this page periodically.</p>

      <h2>Contact us</h2>
      <p>If you have any questions about this privacy policy or how we handle your personal information, contact us:</p>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
        <li><strong>Phone:</strong> <a href="tel:0800100876"><?php echo esc_html($phone_free); ?></a></li>
        <li><strong>Address:</strong> <?php echo esc_html($address); ?></li>
      </ul>
      <p>You also have the right to lodge a complaint with the <strong>Office of the Privacy Commissioner</strong> at <a href="https://www.privacy.org.nz" target="_blank" rel="noopener noreferrer">privacy.org.nz</a> if you believe your privacy has been breached.</p>

      <p class="pp-updated">Last updated: <?php echo date('F Y'); ?></p>

    </div>
  </div>
</section>

<!-- ══ CTA ═════════════════════════════════════════════════════════════ -->
<section class="pp-cta">
  <div class="w">
    <p class="pp-cta__text">Questions about your privacy? Get in touch.</p>
    <a href="tel:0800100876" class="pp-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="pp-cta__email"><?php echo esc_html($email); ?></a>
  </div>
</section>

</div>

<?php get_footer(); ?>
