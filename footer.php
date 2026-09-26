<?php
/**
 * footer.php — TAAS Child Theme
 * Built: May 2026
 * 4-column dark footer: brand + MTA badge | services | company | contact
 * Copyright: 2026
 */
$site_url  = get_site_url();
$mta_badge = $site_url . '/wp-content/uploads/2026/05/MTA-Logo-Full-Badge-blue.png';
?>

<footer class="taas-footer" id="taas-footer">
  <div class="taas-footer__inner">
    <div class="taas-footer__grid">

      <!-- Col 1: Brand + MTA badge -->
      <div class="taas-footer__brand">
        <div class="taas-footer__logo">Tony <span>Allen</span> Auto Service</div>
        <p class="taas-footer__tagline">South Auckland's largest independent automotive workshop. Seven specialist divisions under one roof. Family-owned since 1985.</p>
        <div class="taas-footer__mta">
          <img src="<?php echo esc_url($mta_badge); ?>" alt="MTA Assured — Motor Trade Association member" width="160" height="auto" loading="lazy">
        </div>
        <div class="taas-footer__social">
          <a href="https://www.facebook.com/tonyallenautoservice/" class="taas-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Tony Allen Auto Service on Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.instagram.com/tonyallenautoservice/" class="taas-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Tony Allen Auto Service on Instagram">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="https://www.linkedin.com/company/7059060/" class="taas-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Tony Allen Auto Service on LinkedIn">
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
        </div>
      </div>

      <!-- Col 2: Services -->
      <div class="taas-footer__col">
        <h4 class="taas-footer__head">Services</h4>
        <ul class="taas-footer__links">
          <li><a href="<?php echo esc_url(home_url('/wof/')); ?>">Warrant of Fitness</a></li>
          <li><a href="<?php echo esc_url(home_url('/vehicle-servicing/')); ?>">Vehicle Servicing</a></li>
          <li><a href="<?php echo esc_url(home_url('/manukau-brake-clutch/')); ?>">Brakes &amp; Clutch</a></li>
          <li><a href="<?php echo esc_url(home_url('/auto-electrical/')); ?>">Auto Electrical</a></li>
          <li><a href="<?php echo esc_url(home_url('/steering-and-suspension/')); ?>">Steering &amp; Suspension</a></li>
          <li><a href="<?php echo esc_url(home_url('/air-conditioning/')); ?>">Air Conditioning</a></li>
          <li><a href="<?php echo esc_url(home_url('/tyre-centre/')); ?>">Tyres &amp; Wheels</a></li>
          <li><a href="<?php echo esc_url(home_url('/european/')); ?>">European Vehicles</a></li>
          <li><a href="<?php echo esc_url(home_url('/fleet-servicing/')); ?>">Fleet Servicing</a></li>
        </ul>
      </div>

      <!-- Col 3: Company -->
      <div class="taas-footer__col">
        <h4 class="taas-footer__head">Company</h4>
        <ul class="taas-footer__links">
          <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>">About TAAS</a></li>
          <li><a href="<?php echo esc_url(home_url('/finance-options/')); ?>">Finance Options</a></li>
          <li><a href="<?php echo esc_url(home_url('/mechanical-breakdown-insurance/')); ?>">MBI — Warranty Repairs</a></li>
          <li><a href="<?php echo esc_url(home_url('/manukau-batteries/')); ?>">Manukau Batteries</a></li>
          <li><a href="<?php echo esc_url(home_url('/manukau-brake-clutch/')); ?>">Manukau Brake &amp; Clutch</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog &amp; Car Advice</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact Us</a></li>
        </ul>
      </div>

      <!-- Col 4: Contact -->
      <div class="taas-footer__col">
        <h4 class="taas-footer__head">Get In Touch</h4>

        <div class="taas-footer__contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <span>139 Cavendish Drive<br>Manukau, Auckland 2104</span>
        </div>

        <div class="taas-footer__contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.09 6.09l1.77-1.77a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          <span>
            <a href="tel:0800100876">0800 100 876</a><br>
            <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_LOCAL); ?>" style="color:#555">09 278 9556</a>
          </span>
        </div>

        <div class="taas-footer__contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <span><a href="mailto:<?php echo defined('TAAS_EMAIL') ? esc_attr(TAAS_EMAIL) : 'enquiries@taas.co.nz'; ?>"><?php echo defined('TAAS_EMAIL') ? esc_html(TAAS_EMAIL) : 'enquiries@taas.co.nz'; ?></a></span>
        </div>

        <div class="taas-footer__contact-item">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFC800" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <span>Mon–Fri 7:30am–5:00pm<br><span style="color:#3a3a3a">Sat–Sun Closed</span></span>
        </div>
      </div>

    </div><!-- /.taas-footer__grid -->

    <div class="taas-footer__bar">
      <span class="taas-footer__copy">&copy; <?php echo date('Y'); ?> Tony Allen Auto Service Ltd &nbsp;&middot;&nbsp; 139 Cavendish Drive, Manukau</span>
      <div class="taas-footer__bar-links">
        <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy</a>
        <a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms</a>
        <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">Cookies</a>
      </div>
    </div>

  </div><!-- /.taas-footer__inner -->
</footer>

<style>
.taas-footer {
  background: #0A0A0A;
  padding: 52px 0 0;
  font-family: 'Inter', Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
}
.taas-footer__inner {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 24px;
}
.taas-footer__grid {
  display: grid;
  grid-template-columns: 1.6fr 1fr 1fr 1fr;
  gap: 40px;
  padding-bottom: 44px;
}

/* Brand col */
.taas-footer__logo {
  font-size: 17px;
  font-weight: 900;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: .05em;
  margin-bottom: 12px;
}
.taas-footer__logo span { color: #FFC800; }
.taas-footer__tagline {
  font-size: 13px;
  color: #555;
  line-height: 1.65;
  max-width: 240px;
  margin-bottom: 20px;
}
.taas-footer__mta { display: inline-block; }
.taas-footer__mta img { display: block; height: 80px; width: auto; }

/* Cols */
.taas-footer__head {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: #FFC800;
  margin-bottom: 16px;
  margin-top: 0;
}
.taas-footer__links {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 9px;
}
.taas-footer__links li a {
  font-size: 13px;
  color: #555;
  text-decoration: none;
  transition: color .15s;
}
.taas-footer__links li a:hover { color: #aaa; }

/* Contact */
.taas-footer__contact-item {
  display: flex;
  gap: 10px;
  align-items: flex-start;
  margin-bottom: 14px;
  font-size: 13px;
  color: #555;
  line-height: 1.55;
}
.taas-footer__contact-item svg { flex-shrink: 0; margin-top: 2px; }
.taas-footer__contact-item a { color: #FFC800; text-decoration: none; }
.taas-footer__contact-item a:hover { text-decoration: underline; }

/* Social icons */
.taas-footer__social {
  display: flex;
  gap: 12px;
  margin-top: 24px;
}
.taas-footer__social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  background: #161616;
  border: 1px solid #222;
  border-radius: 4px;
  color: #555;
  transition: background .15s, color .15s, border-color .15s;
  text-decoration: none;
}
.taas-footer__social-link:hover {
  background: #FFC800;
  border-color: #FFC800;
  color: #0A0A0A;
}
.taas-footer__social-link svg {
  width: 16px;
  height: 16px;
}

/* Bar */
.taas-footer__bar {
  border-top: 1px solid #161616;
  padding: 16px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}
.taas-footer__copy { font-size: 12px; color: #3a3a3a; }
.taas-footer__bar-links { display: flex; gap: 18px; }
.taas-footer__bar-links a { font-size: 12px; color: #3a3a3a; text-decoration: none; }
.taas-footer__bar-links a:hover { color: #666; }

/* Responsive */
@media (max-width: 1024px) {
  .taas-footer__grid { grid-template-columns: 1fr 1fr; gap: 32px; }
}
@media (max-width: 600px) {
  .taas-footer__grid { grid-template-columns: 1fr; }
  .taas-footer__bar { flex-direction: column; text-align: center; gap: 10px; }
}
</style>

<?php wp_footer(); ?>
</div><!-- /#page-wrap -->
</body>
</html>
