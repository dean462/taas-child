<?php
/**
 * header.php — TAAS Child Theme
 * Built: May 2026
 * Navigation: HOME · SERVICES ▾ · WOF · FINANCE ▾ · MBI ▾ · ABOUT · BLOG · CONTACT
 * Services: mega-menu, 3 columns grouped by division
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page-wrap">

<!-- ══ TOP BAR ══════════════════════════════════════════════════════════ -->
<div class="taas-topbar">
  <div class="taas-topbar__inner">
    <div class="taas-topbar__left">
      <span class="taas-topbar__dot-wrap">
        <span class="taas-topbar__dot"></span>
        Mon–Fri 7:30am–5:00pm &nbsp;·&nbsp; Sat–Sun Closed
      </span>
      <span class="taas-topbar__sep">|</span>
      <span>139 Cavendish Drive, Manukau</span>
    </div>
    <div class="taas-topbar__right">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="#FFC800" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
      <a href="mailto:<?php echo defined('TAAS_EMAIL') ? esc_attr(TAAS_EMAIL) : 'enquiries@taas.co.nz'; ?>">
        <?php echo defined('TAAS_EMAIL') ? esc_html(TAAS_EMAIL) : 'enquiries@taas.co.nz'; ?>
      </a>
    </div>
  </div>
</div>

<!-- ══ MAIN HEADER ══════════════════════════════════════════════════════ -->
<header class="taas-header" id="taas-header">
  <div class="taas-header__inner">

    <!-- Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="taas-logo" aria-label="Tony Allen Auto Service — Home">
      <span class="taas-logo__top">Tony <span>Allen</span></span>
      <span class="taas-logo__bot">Auto Service Ltd &nbsp;·&nbsp; Est. 1985</span>
    </a>

    <!-- Nav -->
    <nav class="taas-nav" id="taas-nav" aria-label="Main navigation">

      <ul class="taas-nav__list">

        <li class="taas-nav__item">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="taas-nav__link">Home</a>
        </li>

        <!-- SERVICES — mega menu -->
        <li class="taas-nav__item taas-nav__item--has-mega" id="nav-services">
          <a href="<?php echo esc_url(home_url('/services/')); ?>" class="taas-nav__link taas-nav__link--drop" aria-haspopup="true" aria-expanded="false">
            Services
            <svg class="taas-nav__chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
          </a>
          <div class="taas-mega" role="region" aria-label="Services menu">
            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="taas-mega__view-all">View All Services →</a>
            <div class="taas-mega__cols">

              <div class="taas-mega__col">
                <h4 class="taas-mega__head">Repairs &amp; Servicing</h4>
                <a href="<?php echo esc_url(home_url('/vehicle-servicing/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                  Vehicle Servicing
                </a>
                <a href="<?php echo esc_url(home_url('/engine-repairs/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
                  Engine Repairs
                </a>
                <a href="<?php echo esc_url(home_url('/steering-and-suspension/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                  Steering &amp; Suspension
                </a>
                <a href="<?php echo esc_url(home_url('/cambelts-and-water-pumps/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                  Cambelts &amp; Water Pumps
                </a>
                <a href="<?php echo esc_url(home_url('/cooling-system/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 2v6m0 8v6M4.93 4.93l4.24 4.24m5.66 5.66 4.24 4.24M2 12h6m8 0h6M4.93 19.07l4.24-4.24m5.66-5.66 4.24-4.24"/></svg>
                  Cooling System
                </a>
                <a href="<?php echo esc_url(home_url('/transmission-service-and-repair/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
                  Transmission
                </a>
                <a href="<?php echo esc_url(home_url('/electric-hybrid-vehicle-servicing/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                  EV &amp; Hybrid
                </a>
              </div>

              <div class="taas-mega__col">
                <h4 class="taas-mega__head">Specialist Divisions</h4>
                <a href="<?php echo esc_url(home_url('/manukau-brake-clutch/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="12" y1="2" x2="12" y2="8"/><line x1="12" y1="16" x2="12" y2="22"/><line x1="2" y1="12" x2="8" y2="12"/><line x1="16" y1="12" x2="22" y2="12"/></svg>
                  Brakes &amp; Clutch
                </a>
                <a href="<?php echo esc_url(home_url('/auto-electrical/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                  Auto Electrical
                </a>
                <a href="<?php echo esc_url(home_url('/air-conditioning/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 10 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/></svg>
                  Air Conditioning
                </a>
                <a href="<?php echo esc_url(home_url('/tyre-centre/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                  Tyres &amp; Wheels
                </a>
                <a href="<?php echo esc_url(home_url('/european/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                  European Vehicles
                </a>
                <a href="<?php echo esc_url(home_url('/manukau-batteries/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="1" y="6" width="22" height="13" rx="2"/><line x1="7" y1="6" x2="7" y2="3"/><line x1="17" y1="6" x2="17" y2="3"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="12" y1="9" x2="12" y2="15"/></svg>
                  Manukau Batteries
                </a>
                <a href="<?php echo esc_url(home_url('/fleet-servicing/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                  Fleet Servicing
                </a>
              </div>

              <div class="taas-mega__col">
                <h4 class="taas-mega__head">More Services</h4>
                <a href="<?php echo esc_url(home_url('/wof/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                  Warrant of Fitness
                </a>
                <a href="<?php echo esc_url(home_url('/commercial-vehicles/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  Commercial Vehicles
                </a>
                <a href="<?php echo esc_url(home_url('/towing/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/></svg>
                  Towing
                </a>
                <a href="<?php echo esc_url(home_url('/diagnostic-scanning/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                  Diagnostic Scanning
                </a>
                <a href="<?php echo esc_url(home_url('/pre-purchase-inspection-manukau/')); ?>" class="taas-mega__link">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                  Pre-Purchase Inspection
                </a>
              </div>

            </div>
          </div>
        </li>

        <li class="taas-nav__item">
          <a href="<?php echo esc_url(home_url('/wof/')); ?>" class="taas-nav__link">WOF</a>
        </li>

        <!-- FINANCE -->
        <li class="taas-nav__item taas-nav__item--has-drop" id="nav-finance">
          <a href="<?php echo esc_url(home_url('/finance-options/')); ?>" class="taas-nav__link taas-nav__link--drop" aria-haspopup="true" aria-expanded="false">
            Finance
            <svg class="taas-nav__chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
          </a>
          <ul class="taas-drop" role="menu">
            <li><a href="<?php echo esc_url(home_url('/finance-options/')); ?>" class="taas-drop__link" role="menuitem">Finance Options</a></li>
            <li><a href="<?php echo esc_url(home_url('/afterpay-car-repairs/')); ?>" class="taas-drop__link" role="menuitem">Afterpay</a></li>
            <li><a href="<?php echo esc_url(home_url('/qcard-car-repairs/')); ?>" class="taas-drop__link" role="menuitem">Q Card</a></li>
            <li><a href="<?php echo esc_url(home_url('/gem-finance-car-repairs/')); ?>" class="taas-drop__link" role="menuitem">Gem Finance</a></li>
            <li><a href="<?php echo esc_url(home_url('/aotea-finance-car-repairs/')); ?>" class="taas-drop__link" role="menuitem">Aotea Finance</a></li>
          </ul>
        </li>

        <!-- MBI -->
        <li class="taas-nav__item taas-nav__item--has-drop" id="nav-mbi">
          <a href="<?php echo esc_url(home_url('/mechanical-breakdown-insurance/')); ?>" class="taas-nav__link taas-nav__link--drop" aria-haspopup="true" aria-expanded="false">
            MBI
            <svg class="taas-nav__chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
          </a>
          <ul class="taas-drop" role="menu">
            <li><a href="<?php echo esc_url(home_url('/mechanical-breakdown-insurance/')); ?>" class="taas-drop__link" role="menuitem">MBI Overview</a></li>
            <li><a href="<?php echo esc_url(home_url('/autosure-warranty-repairs-manukau/')); ?>" class="taas-drop__link" role="menuitem">Autosure</a></li>
            <li><a href="<?php echo esc_url(home_url('/provident-warranty-repairs-manukau/')); ?>" class="taas-drop__link" role="menuitem">Provident</a></li>
            <li><a href="<?php echo esc_url(home_url('/assurant-warranty-repairs-manukau/')); ?>" class="taas-drop__link" role="menuitem">Assurant</a></li>
            <li><a href="<?php echo esc_url(home_url('/janssen-warranty-repairs-manukau/')); ?>" class="taas-drop__link" role="menuitem">Janssen</a></li>
            <li><a href="<?php echo esc_url(home_url('/autolife-warranty-repairs-manukau/')); ?>" class="taas-drop__link" role="menuitem">Autolife</a></li>
          </ul>
        </li>

        <li class="taas-nav__item">
          <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="taas-nav__link">About</a>
        </li>

        <li class="taas-nav__item">
          <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="taas-nav__link">Blog</a>
        </li>

        <li class="taas-nav__item">
          <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="taas-nav__link">Contact</a>
        </li>

      </ul>
    </nav>

    <!-- Right — phone + CTA -->
    <div class="taas-header__right">
      <a href="tel:0800100876" class="taas-header__phone">0800 100 876</a>
      <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="taas-header__cta">Enquire Now</a>
    </div>

    <!-- Mobile hamburger -->
    <button class="taas-hamburger" id="taas-hamburger" aria-label="Open menu" aria-expanded="false" aria-controls="taas-nav">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>

<style>
/* ══ TOPBAR ═══════════════════════════════════════════════════════════════ */
.taas-topbar {
  background: #0D0D0D;
  border-bottom: 1px solid #1a1a1a;
  padding: 8px 0;
  font-size: 12px;
  color: #666;
}
.taas-topbar__inner {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.taas-topbar__left { display: flex; align-items: center; gap: 18px; }
.taas-topbar__dot-wrap { display: flex; align-items: center; gap: 7px; }
.taas-topbar__dot {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: #2ecc71;
  flex-shrink: 0;
  animation: taas-pulse 2s infinite;
}
@keyframes taas-pulse { 0%,100%{opacity:1} 50%{opacity:.4} }
.taas-topbar__sep { color: #2a2a2a; }
.taas-topbar__right { display: flex; align-items: center; gap: 7px; }
.taas-topbar__right a { color: #FFC800; font-weight: 700; font-size: 13px; text-decoration: none; }
.taas-topbar__right a:hover { opacity: .8; }

/* ══ HEADER ═══════════════════════════════════════════════════════════════ */
.taas-header {
  background: #fff;
  border-bottom: 1px solid #E8E8E4;
  position: sticky;
  top: 0;
  z-index: 1000;
  box-shadow: 0 2px 12px rgba(0,0,0,.06);
}
.taas-header__inner {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 70px;
  gap: 20px;
}

/* Logo */
.taas-logo {
  display: flex;
  flex-direction: column;
  line-height: 1;
  gap: 3px;
  text-decoration: none;
  flex-shrink: 0;
}
.taas-logo__top {
  font-family: 'Inter', Arial, sans-serif;
  font-size: 18px;
  font-weight: 900;
  color: #111;
  text-transform: uppercase;
  letter-spacing: .05em;
}
.taas-logo__top span { color: #FFC800; }
.taas-logo__bot {
  font-size: 9px;
  font-weight: 700;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: #999;
}

/* Nav list */
.taas-nav__list {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 2px;
  flex: 1;
  justify-content: center;
}
.taas-nav__item { position: relative; }
.taas-nav__link {
  display: flex;
  align-items: center;
  gap: 4px;
  font-family: 'Inter', Arial, sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: #333;
  padding: 8px 11px;
  border-radius: 4px;
  text-decoration: none;
  white-space: nowrap;
  transition: color .15s, background .15s;
  letter-spacing: .01em;
}
.taas-nav__link:hover { color: #111; background: #F7F7F5; }
.taas-nav__item.is-open > .taas-nav__link { color: #111; background: #F7F7F5; }
.taas-nav__chevron { transition: transform .2s; flex-shrink: 0; }
.taas-nav__item.is-open .taas-nav__chevron { transform: rotate(180deg); }

/* Right */
.taas-header__right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
.taas-header__phone {
  font-family: 'Inter', Arial, sans-serif;
  font-size: 14px;
  font-weight: 800;
  color: #111;
  text-decoration: none;
  white-space: nowrap;
  letter-spacing: .01em;
}
.taas-header__phone:hover { color: #333; }
.taas-header__cta {
  background: #FFC800;
  color: #1A1A1A;
  font-family: 'Inter', Arial, sans-serif;
  font-size: 12px;
  font-weight: 800;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 10px 18px;
  border-radius: 4px;
  text-decoration: none;
  white-space: nowrap;
  transition: background .15s;
}
.taas-header__cta:hover { background: #e6b400; }

/* ══ MEGA MENU ════════════════════════════════════════════════════════════ */
.taas-mega {
  position: absolute;
  top: calc(100% + 6px);
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  border: 1px solid #E8E8E4;
  border-top: 3px solid #FFC800;
  box-shadow: 0 16px 48px rgba(0,0,0,.12);
  padding: 24px;
  width: 700px;
  display: none;
  z-index: 500;
  border-radius: 0 0 6px 6px;
}
.taas-nav__item.is-open .taas-mega { display: block; }
.taas-mega__cols {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 8px;
}
.taas-mega__head {
  font-family: 'Inter', Arial, sans-serif;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: #FFC800;
  background: #111;
  padding: 6px 10px;
  margin-bottom: 8px;
  border-radius: 3px;
}
.taas-mega__link {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: 'Inter', Arial, sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: #444;
  padding: 7px 10px;
  border-radius: 4px;
  text-decoration: none;
  transition: color .15s, background .15s;
}
.taas-mega__link:hover { color: #111; background: #F7F7F5; }
.taas-mega__link svg { color: #FFC800; flex-shrink: 0; }

/* ══ SIMPLE DROPDOWN ══════════════════════════════════════════════════════ */
.taas-drop {
  position: absolute;
  top: calc(100% + 6px);
  left: 0;
  background: #fff;
  border: 1px solid #E8E8E4;
  border-top: 3px solid #FFC800;
  box-shadow: 0 16px 48px rgba(0,0,0,.12);
  padding: 8px;
  min-width: 210px;
  list-style: none;
  margin: 0;
  display: none;
  z-index: 500;
  border-radius: 0 0 6px 6px;
}
.taas-nav__item.is-open .taas-drop { display: block; }
.taas-drop__link {
  display: block;
  font-family: 'Inter', Arial, sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: #444;
  padding: 8px 14px;
  border-radius: 4px;
  text-decoration: none;
  transition: color .15s, background .15s;
}
.taas-drop__link:hover { color: #111; background: #F7F7F5; }

/* ══ HAMBURGER ════════════════════════════════════════════════════════════ */
.taas-hamburger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
  flex-shrink: 0;
}
.taas-hamburger span {
  display: block;
  width: 24px;
  height: 2px;
  background: #111;
  border-radius: 2px;
  transition: all .2s;
}
.taas-hamburger.is-open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.taas-hamburger.is-open span:nth-child(2) { opacity: 0; }
.taas-hamburger.is-open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

.taas-mega__view-all { display: none; }

/* ══ RESPONSIVE ═══════════════════════════════════════════════════════════ */
@media (max-width: 1024px) {
  .taas-nav { display: none; }
  .taas-nav.is-open {
    display: block;
    position: fixed;
    top: 70px;
    left: 0; right: 0; bottom: 0;
    background: #fff;
    overflow-y: auto;
    z-index: 999;
    padding: 16px;
    border-top: 1px solid #E8E8E4;
  }
  .taas-nav.is-open .taas-nav__list { flex-direction: column; align-items: stretch; gap: 0; }
  .taas-nav.is-open .taas-nav__link { padding: 14px 16px; font-size: 15px; border-bottom: 1px solid #f0f0f0; }
  .taas-mega, .taas-drop { position: static; transform: none; width: auto; box-shadow: none; border: none; border-top: none; background: #F7F7F5; padding: 8px 0 8px 16px; border-radius: 0; display: none; }
  .taas-nav.is-open .taas-nav__item.is-open .taas-mega { display: block; }
  .taas-nav.is-open .taas-nav__item.is-open .taas-drop { display: block; }
  .taas-mega__cols { grid-template-columns: 1fr; }
  .taas-mega__view-all {
    display: block;
    padding: 12px 16px;
    font-size: 14px;
    font-weight: 700;
    color: #FFC800;
    text-decoration: none;
    border-bottom: 1px solid #E8E8E4;
    margin-bottom: 4px;
  }
  .taas-hamburger { display: flex; }
  .taas-header__right { display: none; }
  .taas-topbar { display: none; }
}

/* ── Dropdown hover gap fix ─────────────────────────────────────── */
.taas-nav__item--has-drop,
.taas-nav__item--has-mega { position: relative; }
.taas-drop {
  top: calc(100% + 0px);
  padding-top: 6px;
}
.taas-nav__item--has-drop::after,
.taas-nav__item--has-mega::after {
  content: '';
  position: absolute;
  bottom: -6px;
  left: 0; right: 0;
  height: 6px;
}
</style>

<script>
(function(){
  var nav = document.getElementById('taas-nav');
  var hamburger = document.getElementById('taas-hamburger');

  // Hamburger toggle
  if (hamburger && nav) {
    hamburger.addEventListener('click', function(e) {
      e.stopPropagation();
      var open = nav.classList.toggle('is-open');
      hamburger.classList.toggle('is-open', open);
      hamburger.setAttribute('aria-expanded', open);
    });
  }

  // Dropdown / mega toggle
  var items = document.querySelectorAll('.taas-nav__item--has-mega, .taas-nav__item--has-drop');
  items.forEach(function(item) {
    var link = item.querySelector('.taas-nav__link--drop');
    var chevron = link ? link.querySelector('.taas-nav__chevron') : null;
    if (!link) return;

    // Chevron click — always toggle dropdown, never follow link
    if (chevron) {
      chevron.style.cursor = 'pointer';
      chevron.style.padding = '4px';
      chevron.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var wasOpen = item.classList.contains('is-open');
        items.forEach(function(i){ i.classList.remove('is-open'); i.querySelector('.taas-nav__link--drop') && i.querySelector('.taas-nav__link--drop').setAttribute('aria-expanded','false'); });
        if (!wasOpen) { item.classList.add('is-open'); link.setAttribute('aria-expanded', 'true'); }
      });
    }

    // Desktop — hover opens dropdown
    item.addEventListener('mouseenter', function() {
      if (window.innerWidth <= 1024) return;
      items.forEach(function(i){ i.classList.remove('is-open'); });
      item.classList.add('is-open');
      link.setAttribute('aria-expanded', 'true');
    });
    var _leaveTimer;
    item.addEventListener('mouseleave', function() {
      if (window.innerWidth <= 1024) return;
      _leaveTimer = setTimeout(function() {
        item.classList.remove('is-open');
        link.setAttribute('aria-expanded', 'false');
      }, 200);
    });
    item.addEventListener('mouseenter', function() {
      clearTimeout(_leaveTimer);
    });

    // Link click — check width at click time, not load time
    link.addEventListener('click', function(e) {
      if (window.innerWidth <= 1024) {
        // Mobile — toggle dropdown, don't navigate
        e.preventDefault();
        var wasOpen = item.classList.contains('is-open');
        items.forEach(function(i){ i.classList.remove('is-open'); i.querySelector('.taas-nav__link--drop') && i.querySelector('.taas-nav__link--drop').setAttribute('aria-expanded','false'); });
        if (!wasOpen) { item.classList.add('is-open'); link.setAttribute('aria-expanded', 'true'); }
      } else {
        // Desktop — click link text navigates, chevron handled above
        if (!e.target.closest('.taas-nav__chevron')) {
          window.location.href = this.getAttribute('href');
        }
      }
    });
  });

  // Close on outside click
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.taas-nav__item')) {
      items.forEach(function(i){ i.classList.remove('is-open'); });
    }
  });

  // Close on Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      items.forEach(function(i){ i.classList.remove('is-open'); });
    }
  });
})();
</script>
