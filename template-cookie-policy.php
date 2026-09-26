<?php
/**
 * Template Name: Cookie Policy
 * Description: Cookie & Analytics Policy — what our site uses
 * Built: July 2026
 */

require_once get_stylesheet_directory() . '/taas-constants.php';

$phone_free  = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$email       = defined('TAAS_EMAIL')        ? TAAS_EMAIL        : 'enquiries@taas.co.nz';
$address     = defined('TAAS_ADDRESS')      ? TAAS_ADDRESS      : '139 Cavendish Drive, Manukau, Auckland 2104';

get_header();
?>

<style>
/* ══ COOKIE POLICY — SCOPED CSS ═══════════════════════════════════════ */
.cp { font-family: var(--taas-font, 'Inter', Arial, sans-serif); overflow-x: hidden; -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
.cp .w { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }

/* ── Hero ── */
.cp-hero {
  background: var(--taas-black, #111111);
  padding: 80px 0 60px;
  text-align: center;
  position: relative;
}
.cp-hero::before {
  content: '';
  position: absolute; inset: 0;
  background: repeating-linear-gradient(
    -55deg, transparent, transparent 60px,
    rgba(255,200,0,.02) 60px, rgba(255,200,0,.02) 61px
  );
  pointer-events: none;
}
.cp-hero .w { position: relative; z-index: 1; }
.cp-hero__eye {
  display: inline-block;
  background: var(--taas-yellow, #FFC800);
  color: var(--taas-dark, #1A1A1A);
  font-size: 10px; font-weight: 800;
  letter-spacing: .16em; text-transform: uppercase;
  padding: 6px 14px; margin-bottom: 20px;
}
.cp-hero__h1 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: var(--taas-h1-spoke, clamp(34px, 5vw, 50px));
  font-weight: 800; color: #fff;
  margin: 0 0 12px; line-height: 1.15;
}
.cp-hero__sub {
  font-size: 16px; color: rgba(255,255,255,.55);
  max-width: 540px; margin: 0 auto; line-height: 1.6;
  font-weight: 300;
}

/* ── Content ── */
.cp-content {
  background: #fff;
  padding: 64px 0 72px;
}
.cp-content__inner {
  max-width: 780px;
  margin: 0 auto;
}
.cp-content h2 {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 22px; font-weight: 700;
  color: var(--taas-dark, #1A1A1A);
  margin: 48px 0 12px;
  padding-top: 16px;
}
.cp-content h2:first-of-type { margin-top: 0; padding-top: 0; }
.cp-content p {
  font-size: 16px; color: var(--taas-body, #333);
  line-height: 1.75; margin-bottom: 16px;
  font-weight: 300;
}
.cp-content ul {
  margin: 0 0 20px 0; padding-left: 20px;
  list-style: none;
}
.cp-content ul li {
  font-size: 15px; color: var(--taas-body, #333);
  line-height: 1.7; margin-bottom: 8px;
  padding-left: 20px; position: relative;
  font-weight: 300;
}
.cp-content ul li::before {
  content: '·';
  position: absolute; left: 0;
  color: var(--taas-yellow, #FFC800);
  font-weight: 900; font-size: 20px;
  line-height: 1.5;
}
.cp-content strong { font-weight: 600; color: var(--taas-dark, #1A1A1A); }
.cp-content a { color: var(--taas-dark, #1A1A1A); text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--taas-yellow, #FFC800); text-decoration-thickness: 2px; }
.cp-content a:hover { color: var(--taas-yellow, #FFC800); }

/* ── Cookie table ── */
.cp-table {
  width: 100%;
  border-collapse: collapse;
  margin: 16px 0 24px;
  font-size: 14px;
}
.cp-table th {
  background: var(--taas-dark, #1A1A1A);
  color: #fff;
  font-weight: 600;
  text-align: left;
  padding: 12px 16px;
  font-size: 12px;
  letter-spacing: .06em;
  text-transform: uppercase;
}
.cp-table td {
  padding: 12px 16px;
  border-bottom: 1px solid var(--taas-border, #E8E8E4);
  color: var(--taas-body, #333);
  font-weight: 300;
  line-height: 1.6;
  vertical-align: top;
}
.cp-table tr:last-child td { border-bottom: none; }
.cp-table tr:nth-child(even) td { background: var(--taas-panel, #F7F7F5); }

.cp-updated {
  font-size: 13px; color: var(--taas-mid, #666);
  margin-top: 48px; padding-top: 24px;
  border-top: 1px solid var(--taas-border, #E8E8E4);
}

/* ── CTA ── */
.cp-cta {
  background: var(--taas-dark, #1A1A1A);
  padding: 48px 0;
  text-align: center;
}
.cp-cta__text {
  font-size: 16px; color: rgba(255,255,255,.6);
  margin-bottom: 12px;
  font-weight: 300;
}
.cp-cta__phone {
  font-family: var(--taas-font, 'Inter', Arial, sans-serif);
  font-size: 28px; font-weight: 900;
  color: var(--taas-yellow, #FFC800);
  text-decoration: none;
  transition: opacity .15s;
}
.cp-cta__phone:hover { opacity: .65; }
.cp-cta__email {
  display: block; margin-top: 8px;
  font-size: 14px; color: rgba(255,255,255,.4);
  text-decoration: none;
}
.cp-cta__email:hover { color: rgba(255,255,255,.6); }

/* ── Responsive ── */
@media (max-width: 640px) {
  .cp-hero { padding: 60px 0 44px; }
  .cp-content { padding: 44px 0 52px; }
  .cp-content h2 { font-size: 19px; }
  .cp-content p { font-size: 14px; }
  .cp-content ul li { font-size: 14px; }
  .cp-table { font-size: 13px; }
  .cp-table th, .cp-table td { padding: 10px 12px; }
}
</style>

<div class="cp">

<!-- ══ HERO ════════════════════════════════════════════════════════════ -->
<section class="cp-hero">
  <div class="w">
    <div class="cp-hero__eye">Legal</div>
    <h1 class="cp-hero__h1">Cookie &amp; Analytics Policy</h1>
    <p class="cp-hero__sub">What our website uses, why, and how you can manage it.</p>
  </div>
</section>

<!-- ══ CONTENT ═════════════════════════════════════════════════════════ -->
<section class="cp-content">
  <div class="w">
    <div class="cp-content__inner">

      <h2>What are cookies</h2>
      <p>Cookies are small text files stored on your device when you visit a website. They help the site work properly, remember your preferences, and understand how visitors use the site. Some cookies are set by us and some are set by third-party services we use.</p>

      <h2>What our site uses</h2>
      <p>We believe in being upfront about what runs on our website. Here is a complete list of the cookies and analytics tools used on taas.co.nz.</p>

      <table class="cp-table">
        <thead>
          <tr>
            <th>Service</th>
            <th>Purpose</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>WordPress</strong></td>
            <td>Session management and form submissions. Required for the website to function.</td>
            <td>Essential</td>
          </tr>
          <tr>
            <td><strong>Cloudflare</strong></td>
            <td>Website security, performance optimisation, and content delivery. Cloudflare may set cookies to identify trusted traffic and protect against malicious requests.</td>
            <td>Essential</td>
          </tr>
          <tr>
            <td><strong>Google Analytics (GA4)</strong></td>
            <td>Helps us understand how visitors use our website &mdash; which pages are visited, how long people stay, and what devices they use. This data is anonymous and aggregated. No personally identifiable information is collected.</td>
            <td>Analytics</td>
          </tr>
          <tr>
            <td><strong>Microsoft Clarity</strong></td>
            <td>Records anonymous session data including scroll depth, clicks, and page interactions. This helps us identify where visitors get stuck or confused so we can improve the site. Clarity does not collect personal information.</td>
            <td>Analytics</td>
          </tr>
          <tr>
            <td><strong>Trustindex</strong></td>
            <td>Displays our Google reviews on the website. Reviews are public content sourced from our Google Business Profile. Trustindex may set cookies to load the review widget.</td>
            <td>Third-party widget</td>
          </tr>
        </tbody>
      </table>

      <h2>What we do not use</h2>
      <p>We want to be clear about what is not on our site:</p>
      <ul>
        <li><strong>No advertising cookies</strong> &mdash; we do not run ads on our website and do not use cookies to serve or track advertising</li>
        <li><strong>No retargeting</strong> &mdash; we do not track you across other websites or show you TAAS ads elsewhere based on your visit</li>
        <li><strong>No data selling</strong> &mdash; we do not sell, rent, or trade any visitor data to third parties</li>
        <li><strong>No social media trackers</strong> &mdash; we do not embed Facebook, Instagram, or other social media tracking pixels</li>
      </ul>

      <h2>Google Analytics in detail</h2>
      <p>We use Google Analytics 4 (GA4) to understand how people find and use our website. GA4 collects information such as:</p>
      <ul>
        <li>Pages you visit and how long you spend on each page</li>
        <li>How you arrived at our site (search engine, direct, referral)</li>
        <li>Your general location (city level, not street address)</li>
        <li>Device type, browser, and screen size</li>
        <li>Actions you take on the site (form submissions, phone taps, FAQ interactions)</li>
      </ul>
      <p>This data is anonymous. We cannot identify you personally from GA4 data. Google&rsquo;s privacy policy is available at <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">policies.google.com/privacy</a>.</p>

      <h2>Microsoft Clarity in detail</h2>
      <p>Microsoft Clarity helps us see how visitors interact with our website by recording anonymous session replays and generating heatmaps. This shows us where people click, how far they scroll, and whether any part of the site is confusing or difficult to use.</p>
      <p>Clarity automatically masks sensitive content such as form inputs so that any text you type into enquiry forms is not visible in session recordings. Microsoft&rsquo;s privacy statement is available at <a href="https://privacy.microsoft.com/en-us/privacystatement" target="_blank" rel="noopener noreferrer">privacy.microsoft.com</a>.</p>

      <h2>Managing cookies</h2>
      <p>You can control or delete cookies through your browser settings. Most browsers allow you to:</p>
      <ul>
        <li>See what cookies are stored and delete them individually</li>
        <li>Block all cookies or only third-party cookies</li>
        <li>Set your browser to notify you when a cookie is being set</li>
      </ul>
      <p>Please note that blocking essential cookies may affect how the website functions, including the ability to submit enquiry forms.</p>
      <p>To opt out of Google Analytics specifically, you can install the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics Opt-out Browser Add-on</a>.</p>

      <h2>New Zealand privacy law</h2>
      <p>New Zealand does not currently have a law requiring websites to display cookie consent banners (unlike the EU&rsquo;s GDPR). However, we believe in transparency. This page tells you exactly what our site uses so you can make an informed decision about your visit.</p>
      <p>For more detail on how we handle personal information, see our <a href="/privacy-policy/">Privacy Policy</a>.</p>

      <h2>Changes to this policy</h2>
      <p>If we add new analytics tools or change how we use cookies, we will update this page. If we ever introduce advertising or retargeting (we have no plans to), this page will be updated before any such tools are activated.</p>

      <h2>Contact us</h2>
      <p>If you have any questions about cookies or analytics on our website, contact us:</p>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
        <li><strong>Phone:</strong> <a href="tel:0800100876"><?php echo esc_html($phone_free); ?></a></li>
        <li><strong>Address:</strong> <?php echo esc_html($address); ?></li>
      </ul>

      <p class="cp-updated">Last updated: <?php echo date('F Y'); ?></p>

    </div>
  </div>
</section>

<!-- ══ CTA ═════════════════════════════════════════════════════════════ -->
<section class="cp-cta">
  <div class="w">
    <p class="cp-cta__text">Questions about our website? Get in touch.</p>
    <a href="tel:0800100876" class="cp-cta__phone"><?php echo esc_html($phone_free); ?></a>
    <a href="mailto:<?php echo esc_attr($email); ?>" class="cp-cta__email"><?php echo esc_html($email); ?></a>
  </div>
</section>

</div>

<?php get_footer(); ?>
