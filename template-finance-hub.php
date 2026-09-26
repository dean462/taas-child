<?php
/**
 * Template Name: Finance Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /finance-options/
 * Built: May 2026 · Zip removed: July 2026
 *
 * Deploy:
 * 1. Upload to wp-content/themes/taas-child/
 * 2. Purge Cloudflare cache
 */

// ── Enqueue global assets ─────────────────────────────────────────────────────
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

// ── Constants ─────────────────────────────────────────────────────────────────
$phone_local    = defined('TAAS_PHONE_LOCAL')   ? TAAS_PHONE_LOCAL   : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')    ? TAAS_PHONE_FREE    : '0800 100 876';
$email          = defined('TAAS_EMAIL')         ? TAAS_EMAIL         : 'enquiries@taas.co.nz';
$address        = defined('TAAS_ADDRESS')       ? TAAS_ADDRESS       : '139 Cavendish Drive, Manukau, Auckland 2104';
$hours          = defined('TAAS_HOURS')         ? TAAS_HOURS         : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')   ? TAAS_ESTABLISHED   : '1985';
$rating         = defined('TAAS_RATING')        ? TAAS_RATING        : '4.2';
$reviews        = defined('TAAS_REVIEWS')       ? TAAS_REVIEWS       : '200+';
$cf7_finance    = defined('TAAS_CF7_FINANCE')   ? TAAS_CF7_FINANCE   : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')   ? TAAS_CF7_GENERAL   : '';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET')? TAAS_REVIEWS_WIDGET: '';
$customers      = defined('TAAS_CUSTOMERS')     ? TAAS_CUSTOMERS     : '10,000+';
$ms_number      = defined('TAAS_MS_NUMBER')     ? TAAS_MS_NUMBER     : 'MS 13890';

$site_url       = get_site_url();
$page_url       = get_permalink();
$phone_tel      = preg_replace('/[^0-9+]/', '', $phone_local);
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$years          = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

$hero_img = defined('TAAS_HERO_FINANCE') ? get_site_url() . TAAS_HERO_FINANCE : get_site_url() . '/wp-content/uploads/2026/06/hero-finance.webp';

// ── Finance providers (4 — Zip removed July 2026) ────────────────────────────
$providers = [
    [
        'id'       => 'afterpay',
        'name'     => 'Afterpay',
        'slug'     => 'afterpay-car-repairs',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/finance-logo-afterpay.png',
        'logo_alt' => 'Afterpay logo',
        'badge'    => 'Most Popular',
        'featured' => true,
        'tagline'  => 'Pay in 4 — Always Interest-Free',
        'descs'    => [
            'Afterpay splits your repair or service bill into four equal fortnightly payments. You pay the first 25% when you collect your vehicle — Afterpay pays us in full. The remaining three instalments are automatically deducted from your linked card every two weeks. No interest. No annual fees. No catch when you pay on time.',
            'Set up the Afterpay app and add the digital Afterpay Card to your phone\'s wallet (Apple Pay, Google Pay, or Samsung Pay) before arriving. A credit check applies at sign-up as required under NZ law. Spend limits apply and vary by customer.',
        ],
        'facts'    => [
            ['val' => '4',     'lbl' => 'Fortnightly Payments'],
            ['val' => '0%',    'lbl' => 'Interest Always'],
            ['val' => '6 wks', 'lbl' => 'To Pay Off'],
        ],
        'cta1_label' => 'Full Afterpay Details',
        'cta1_url'   => '/afterpay-car-repairs/',
        'cta1_ext'   => false,
        'cta2_label' => 'Visit Afterpay',
        'cta2_url'   => 'https://www.afterpay.com/en-NZ/how-it-works',
        'cta2_ext'   => true,
        'terms_label'=> 'Terms and conditions',
        'terms_url'  => 'https://www.afterpay.com/en-NZ/terms-of-service',
    ],
    [
        'id'       => 'qcard',
        'name'     => 'Q Card',
        'slug'     => 'qcard-car-repairs',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/finance-logo-qcard.png',
        'logo_alt' => 'Q Card logo',
        'badge'    => 'Credit Card',
        'featured' => false,
        'tagline'  => '3 Months — No Payments, No Interest',
        'descs'    => [
            'Q Card gives cardholders a minimum of three months with no payments and no interest when used in-store. It\'s a Mastercard accepted at thousands of New Zealand businesses, including Tony Allen Auto Service. Apply online before your visit.',
        ],
        'facts'    => [
            ['val' => '3 mo', 'lbl' => 'Min. Interest-Free'],
            ['val' => '0%',   'lbl' => 'During Qualifying Period'],
        ],
        'cta1_label' => 'Full Q Card Details',
        'cta1_url'   => '/qcard-car-repairs/',
        'cta1_ext'   => false,
        'cta2_label' => 'Apply for Q Card',
        'cta2_url'   => 'https://www.qcard.co.nz/apply-q-mastercard/',
        'cta2_ext'   => true,
        'terms_label'=> 'Terms and conditions',
        'terms_url'  => 'https://www.qcard.co.nz/important-information/#qcard',
    ],
    [
        'id'       => 'gem',
        'name'     => 'Gem Finance',
        'slug'     => 'gem-finance-car-repairs',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/finance-logo-gem.png',
        'logo_alt' => 'Gem Finance logo',
        'badge'    => 'Finance Card',
        'featured' => false,
        'tagline'  => '6 Months Interest-Free on $250+',
        'descs'    => [
            'Gem Finance (by Latitude Financial Services) offers six months interest-free on qualifying purchases over $250. If you\'re facing a larger repair bill — a cambelt, engine repair, or suspension overhaul — Gem gives you breathing room to spread the cost without paying interest during the promotional period.',
        ],
        'facts'    => [
            ['val' => '6 mo',  'lbl' => 'Interest-Free'],
            ['val' => '$250+', 'lbl' => 'Min. Purchase'],
        ],
        'cta1_label' => 'Full Gem Finance Details',
        'cta1_url'   => '/gem-finance-car-repairs/',
        'cta1_ext'   => false,
        'cta2_label' => 'Apply for Gem',
        'cta2_url'   => 'https://apply.gemvisa.co.nz/eapps/faces/LongAppRetail/personal.xhtml',
        'cta2_ext'   => true,
        'terms_label'=> 'Terms and conditions',
        'terms_url'  => 'https://www.gemfinance.co.nz/credit-cards/gem-visa-card/#rates',
    ],
    [
        'id'       => 'aotea',
        'name'     => 'Aotea Finance',
        'slug'     => 'aotea-finance-car-repairs',
        'logo'     => get_site_url() . '/wp-content/uploads/2026/06/finance-logo-aotea.png',
        'logo_alt' => 'Aotea Finance logo',
        'badge'    => 'Personal Lending',
        'featured' => false,
        'tagline'  => 'Flexible Lending — Everyone Considered',
        'descs'    => [
            'Aotea Finance takes a different approach to personal lending. They treat every application as an individual and have the flexibility to assist people in a wide range of circumstances, including those who may not qualify through mainstream lenders. Apply online for a no-obligation pre-approval before you bring your vehicle in.',
        ],
        'facts'    => [
            ['val' => 'All',    'lbl' => 'Circumstances Considered'],
            ['val' => 'Online', 'lbl' => 'Pre-Approval Available'],
        ],
        'cta1_label' => 'Full Aotea Finance Details',
        'cta1_url'   => '/aotea-finance-car-repairs/',
        'cta1_ext'   => false,
        'cta2_label' => 'Apply Online',
        'cta2_url'   => 'https://www.aoteafinance.co.nz/apply-online/',
        'cta2_ext'   => true,
        'terms_label'=> 'Terms and conditions',
        'terms_url'  => 'https://www.aoteafinance.co.nz/terms-and-conditions/',
    ],
];

// ── FAQs ──────────────────────────────────────────────────────────────────────
$faqs = [
    ['q'=>'Does Tony Allen Auto Service offer payment plans?',
     'a'=>'Yes. We offer four finance options: Afterpay, Q Card, Gem Finance, and Aotea Finance. Afterpay splits your bill into four fortnightly payments at 0% interest. Interest-free card options give you up to six months to pay. Aotea Finance provides personal loans for all credit circumstances.'],
    ['q'=>'Which payment option is best for me?',
     'a'=>'It depends on your repair cost and situation. For smaller repairs and everyday servicing, Afterpay is the quickest to set up. For repairs over $250, Gem Finance gives you six months interest-free. Q Card offers at least three months with nothing to pay. If you have had credit difficulties, Aotea Finance considers all circumstances.'],
    ['q'=>'Can I combine two payment options?',
     'a'=>'We are not able to split a single invoice across multiple finance providers. You would need to select one option per transaction. If you are unsure, call us on ' . $phone_free . ' and we can talk it through.'],
    ['q'=>'Do I need to arrange finance before I bring my vehicle in?',
     'a'=>'For Afterpay, you need an active account and the in-store card set up on your phone before you arrive. For Q Card and Gem Finance, applying in advance means your account is ready at collection. We recommend not leaving it to the day of collection.'],
    ['q'=>'Is there a minimum repair cost to use these options?',
     'a'=>'Afterpay and Q Card have no stated minimum, though individual spend limits apply. Gem Finance requires a minimum transaction of $250. Aotea Finance terms vary — contact them directly for current thresholds.'],
    ['q'=>'Do you offer interest-free finance for WOF failures?',
     'a'=>'Yes. If your vehicle fails its WOF and needs repairs, all four finance options are available for the repair work. Most WOF repairs qualify. If parts need to be ordered, our team will advise on timing.'],
    ['q'=>'Is TAAS a finance provider?',
     'a'=>'No. Tony Allen Auto Service is a merchant partner with each of these finance providers. We do not provide financial advice or credit. All finance agreements are directly between you and the provider. Please read their terms carefully before applying.'],
    ['q'=>'Can I use these options for fleet or commercial vehicle repairs?',
     'a'=>'These finance products are consumer-facing. For business fleet servicing, TAAS Fleet offers direct invoicing arrangements. Call ' . $phone_free . ' or email ' . $email . ' to discuss fleet accounts.'],
    ['q'=>'Can I use Afterpay to pay for car repairs in Manukau?',
     'a'=>'Yes. Tony Allen Auto Service at 139 Cavendish Drive, Manukau accepts Afterpay in-store for servicing, repairs, WOF failure work, tyres, and parts. You pay 25% when you collect your vehicle and the remaining three instalments are deducted automatically every two weeks. Set up the Afterpay app and add the digital card to your phone wallet before you arrive.'],
    ['q'=>'What happens if I miss a payment on Afterpay?',
     'a'=>'Late fees apply. Afterpay charges a late fee capped at 25% of the order value or $68, whichever is less. Afterpay may pause your account until the missed payment is cleared. Tony Allen Auto Service is not involved in payment collection — that sits entirely between you and the provider.'],
    ['q'=>'How do I set up Afterpay on my phone before I arrive?',
     'a'=>'Download the Afterpay app from the App Store or Google Play. Create an account and complete the identity verification — a credit check applies under NZ law. Once approved, add the Afterpay Card to your phone wallet via Apple Pay, Google Pay, or Samsung Pay. When you collect your vehicle from Tony Allen Auto Service, tap your phone at the EFTPOS terminal to pay.'],
    ['q'=>'Do you accept EFTPOS and credit cards as well as finance?',
     'a'=>'Yes. We accept cash, EFTPOS, Visa, and Mastercard alongside all four finance options. Finance is there if you need it, but there is no requirement to use it. Most customers pay by EFTPOS or card on the day.'],
];

// ── Comparison table (4 providers) ───────────────────────────────────────────
$compare = [
    ['Feature',          'Afterpay',      'Q Card',        'Gem Finance',  'Aotea Finance'],
    ['Type',             'BNPL',          'Credit card',   'Finance card', 'Personal loan'],
    ['Interest-free',    '0% on time',    '3+ months',     '6 months',     'No'],
    ['Repayments',       '4 × fortnight', 'None required', 'Monthly',      'Monthly'],
    ['Min. amount',      'None stated',   'None stated',   '$250',         'None stated'],
    ['Credit check',     'Yes (sign-up)', 'Yes',           'Yes',          'Yes'],
    ['All credit types', 'No',            'No',            'No',           'Yes'],
    ['Pay in-store',     'Tap phone',     'Tap card',      'Tap card',     'N/A'],
];

// ── Schema ────────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['a']]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'telephone'=>[$phone_local,$phone_free],'email'=>$email,'foundingDate'=>'1985-10','description'=>'NZTA Authorised — '.$ms_number.'. MTA Assured. South Auckland\'s largest independent workshop. Accepts Afterpay, Q Card, Gem Finance, Aotea Finance.','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D/','',$reviews),'bestRating'=>'5'],'sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance','speakable'=>['@type'=>'SpeakableSpecification','cssSelector'=>['.fh-hero__h1','.fh-hero__sub','.fh-sec-h2']]],
        ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
        ['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Finance Options','item'=>$page_url]]],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>

<div class="taas-fh">

<style>
/* ══ RESET ════════════════════════════════════════════════════════════════════ */
.page-template-template-finance-hub .site-content,
.page-template-template-finance-hub .entry-content,
.page-template-template-finance-hub .entry-header,
.page-template-template-finance-hub article,
.page-template-template-finance-hub #primary,
.page-template-template-finance-hub #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-finance-hub { overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
.taas-fh *, .taas-fh *::before, .taas-fh *::after { box-sizing:border-box; margin:0; padding:0; }
.taas-fh { font-family:var(--taas-font, 'Inter', Arial, sans-serif); color:var(--taas-body, #333333); -webkit-font-smoothing:antialiased; }
.taas-fh a { text-decoration:none; }
.fh-w { max-width:var(--taas-container, 1140px); margin:0 auto; padding:0 24px; }

/* ══ BREADCRUMB ══════════════════════════════════════════════════════════════ */
.fh-breadcrumb { background:#0d0d0d; border-bottom:1px solid #1a1a1a; padding:10px 0; }
.fh-breadcrumb__inner { font-size:13px; color:#666; font-family:var(--taas-font,'Inter',Arial,sans-serif); }
.fh-breadcrumb a { color:#888; text-decoration:none; }
.fh-breadcrumb a:hover { color:var(--taas-yellow,#FFC800); }
.fh-breadcrumb__sep { margin:0 8px; color:#444; }
.fh-breadcrumb strong { color:#aaa; font-weight:600; }

/* ══ PHONE STRIP ═════════════════════════════════════════════════════════════ */
.fh-phone-strip { background:var(--taas-yellow,#FFC800); padding:13px 0; }
.fh-phone-strip__label { font-size:14px; font-weight:600; color:var(--taas-dark,#1A1A1A); }
.fh-phone-strip a { font-family:var(--taas-font,'Inter',Arial,sans-serif); font-size:19px; font-weight:800; color:#1A1A1A; text-decoration:none; letter-spacing:-0.01em; display:inline-flex; align-items:center; gap:6px; }
.fh-phone-strip a:hover { opacity:0.65; }

/* ══ HERO ═════════════════════════════════════════════════════════════════════ */
.fh-hero {
  background:var(--taas-black, #111111);
  padding:var(--taas-hero-pad, 72px) 0 var(--taas-hero-pad-b, 60px);
  position:relative;
}
.fh-hero__bg {
  position:absolute; inset:0; z-index:0;
  background:url('<?php echo esc_url($hero_img); ?>') center 40% / cover no-repeat;
}
.fh-hero__bg::after {
  content:''; position:absolute; inset:0;
  background:rgba(13,13,13,0.82);
}
.fh-hero > .fh-w { position:relative; z-index:1; }
.fh-hero__inner { display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:start; }
.fh-hero__eye {
  display:inline-block; background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A);
  font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; padding:4px 12px; border-radius:3px; margin-bottom:20px;
}
.fh-hero__h1 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight:800;
  color:var(--taas-white, #fff); letter-spacing:-0.02em;
  line-height:1.1; margin:0 0 16px;
}
.fh-hero__h1 em { color:var(--taas-yellow, #FFC800); font-style:normal; }
.fh-hero__sub { font-size:17px; color:#aaa; line-height:1.75; max-width:540px; margin:0 0 28px; letter-spacing:-0.1px; font-weight:300; }
.fh-hero__pills { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:32px; }
.fh-hero__pill { background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.15); color:#ccc; font-size:13px; font-weight:600; padding:6px 16px; border-radius:var(--taas-radius, 6px); text-decoration:none; transition:background .15s,color .15s; }
.fh-hero__pill:hover { background:rgba(255,200,0,.15); border-color:var(--taas-yellow, #FFC800); color:var(--taas-yellow, #FFC800); }
.fh-hero__ctas { display:flex; gap:12px; flex-wrap:wrap; }

/* Hero sidebar card */
.fh-hero__card { background:rgba(255,200,0,.05); border:1px solid rgba(255,200,0,.2); border-top:3px solid var(--taas-yellow, #FFC800); border-radius:var(--taas-radius, 6px); padding:24px 20px; }
.fh-hero__card-title { font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em); text-transform:uppercase; color:var(--taas-yellow, #FFC800); margin-bottom:16px; }
.fh-stat { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid rgba(255,255,255,.07); }
.fh-stat:last-child { border-bottom:none; padding-bottom:0; }
.fh-stat__icon { font-size:18px; flex-shrink:0; width:28px; text-align:center; }
.fh-stat__text { font-size:13px; color:#aaa; line-height:1.4; }
.fh-stat__text strong { color:#fff; display:block; }

/* ══ BUTTONS ═════════════════════════════════════════════════════════════════ */
.fh-btn {
  display:inline-flex; align-items:center; gap:8px;
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-weight:var(--taas-btn-wt, 700); font-size:var(--taas-btn-size, 14px);
  letter-spacing:.04em; text-transform:uppercase;
  padding:var(--taas-btn-pad, 14px 26px); border-radius:var(--taas-radius, 6px); transition:all .18s; border:2px solid transparent; cursor:pointer;
}
.fh-btn--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; border-color:var(--taas-yellow, #FFC800); }
.fh-btn--yellow:hover { background:var(--taas-yellow2, #e6b400); border-color:var(--taas-yellow2, #e6b400); }
.fh-btn--dark { background:var(--taas-dark, #1A1A1A); color:var(--taas-white, #fff)!important; border-color:var(--taas-dark, #1A1A1A); }
.fh-btn--dark:hover { background:#000; border-color:#000; }
.fh-btn--outline { background:transparent; color:var(--taas-yellow, #FFC800)!important; border:2px solid var(--taas-yellow, #FFC800); }
.fh-btn--outline:hover { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A)!important; }
.fh-btn--outline-dark { background:transparent; color:var(--taas-white, #fff)!important; border:2px solid rgba(255,255,255,.3); }
.fh-btn--outline-dark:hover { background:rgba(255,255,255,.1); border-color:rgba(255,255,255,.5); }
.fh-btn--full { display:flex; justify-content:center; width:100%; }

/* ══ TRUST STRIP ═════════════════════════════════════════════════════════════ */
.fh-trust { background:var(--taas-panel, #F7F7F5); border-bottom:1px solid var(--taas-border, #E8E8E4); padding:18px 0; }
.fh-trust__inner { display:flex; gap:40px; align-items:center; justify-content:center; flex-wrap:wrap; }
.fh-trust__item { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:14px; font-weight:600; color:var(--taas-dark, #1A1A1A); display:flex; align-items:center; gap:7px; white-space:nowrap; }
.fh-trust__item::before { content:'✓'; font-weight:900; }

/* ══ SECTIONS ════════════════════════════════════════════════════════════════ */
.fh-section { padding:var(--taas-sec-pad, 72px) 0; background:var(--taas-white, #fff); }
.fh-section--grey { background:var(--taas-panel, #F7F7F5); }
.fh-section--dark { background:var(--taas-dark, #1A1A1A); }
.fh-sec-eye {
  display:inline-block; background:var(--taas-dark, #1A1A1A); color:var(--taas-yellow, #FFC800);
  font-size:var(--taas-eye-size, 10px); font-weight:700; letter-spacing:var(--taas-eye-ls, 0.12em);
  text-transform:uppercase; padding:4px 10px; border-radius:3px; margin-bottom:14px;
}
.fh-sec-eye--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); }
.fh-sec-h2 {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight:700;
  color:var(--taas-black, #111111); letter-spacing:-0.01em; margin:0 0 12px;
}
.fh-sec-h2--white { color:var(--taas-white, #fff); }
.fh-sec-intro { font-size:16px; color:var(--taas-mid, #666666); line-height:1.75; max-width:640px; margin:0 0 36px; font-weight:300; letter-spacing:-0.1px; }
.fh-sec-intro--dark { color:#aaa; }

/* ══ PROVIDER CARDS ══════════════════════════════════════════════════════════ */
.fh-providers { display:flex; flex-direction:column; gap:24px; }
.fh-pcard {
  background:var(--taas-white, #fff); border:1px solid var(--taas-border, #E8E8E4);
  border-left:4px solid var(--taas-border, #E8E8E4); border-radius:var(--taas-radius, 6px);
  display:grid; grid-template-columns:200px 1fr 200px; transition:border-color .2s;
}
.fh-pcard--featured { border-left-color:var(--taas-yellow, #FFC800); }
.fh-pcard:hover { border-left-color:var(--taas-yellow, #FFC800); }
.fh-pcard__logo {
  border-right:1px solid var(--taas-border, #E8E8E4); padding:28px 20px;
  display:flex; flex-direction:column; align-items:center; justify-content:center; gap:14px;
  background:var(--taas-panel, #F7F7F5);
}
.fh-pcard__logo-img { max-width:160px; max-height:56px; width:auto; height:auto; object-fit:contain; display:block; }
.fh-pcard__logo-ph {
  width:140px; min-height:64px; background:var(--taas-border, #E8E8E4);
  display:flex; align-items:center; justify-content:center; padding:10px;
}
.fh-pcard__logo-ph span { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:18px; font-weight:900; color:var(--taas-dark, #1A1A1A); text-transform:uppercase; }
.fh-pcard__badge {
  display:inline-block; font-size:var(--taas-eye-size, 10px); font-weight:800;
  letter-spacing:.1em; text-transform:uppercase; padding:3px 10px; flex-shrink:0; line-height:1.4;
}
.fh-pcard__badge--yellow { background:var(--taas-yellow, #FFC800); color:var(--taas-dark, #1A1A1A); }
.fh-pcard__badge--grey { background:var(--taas-white, #fff); color:var(--taas-body, #333); border:1px solid #D0D0CC; }
.fh-pcard__body { padding:28px; }
.fh-pcard__name {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:var(--taas-card-title, 18px); font-weight:700; color:var(--taas-black, #111111);
  margin:0 0 4px;
}
.fh-pcard__tagline { font-size:13px; font-weight:700; color:var(--taas-yellow, #FFC800); letter-spacing:.06em; text-transform:uppercase; margin-bottom:14px; }
.fh-pcard__desc { font-size:14px; color:var(--taas-mid, #666666); line-height:1.75; margin-bottom:10px; font-weight:300; }
.fh-pcard__desc:last-of-type { margin-bottom:18px; }
.fh-pcard__facts { display:flex; gap:28px; flex-wrap:wrap; padding:16px 0; border-top:1px solid var(--taas-border, #E8E8E4); border-bottom:1px solid var(--taas-border, #E8E8E4); }
.fh-fact__val { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:28px; font-weight:900; color:var(--taas-yellow, #FFC800); line-height:1; }
.fh-fact__lbl { font-size:11px; color:#999; font-weight:600; letter-spacing:.06em; text-transform:uppercase; }
.fh-pcard__cta {
  border-left:1px solid var(--taas-border, #E8E8E4); padding:28px 20px;
  display:flex; flex-direction:column; gap:10px; justify-content:center;
}
.fh-terms { font-size:11px; color:#999; text-align:center; }
.fh-terms a { color:#999; text-decoration:underline; }

/* ══ HOW IT WORKS ════════════════════════════════════════════════════════════ */
.fh-steps { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
.fh-step { padding:28px 24px; border-right:1px solid var(--taas-border, #E8E8E4); }
.fh-step:last-child { border-right:none; }
.fh-step__num { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:48px; font-weight:900; color:#EBEBEA; line-height:1; margin-bottom:12px; }
.fh-step__title { font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:var(--taas-card-title, 16px); font-weight:700; color:var(--taas-black, #111111); border-top:3px solid var(--taas-yellow, #FFC800); padding-top:12px; margin-bottom:8px; }
.fh-step__text { font-size:14px; color:var(--taas-mid, #666666); line-height:1.75; font-weight:300; }

/* ══ COMPARISON — desktop table, mobile cards ════════════════════════════════ */
.fh-compare-mobile { display:none; }
.fh-compare-card {
  background:var(--taas-white, #fff); border:1px solid var(--taas-border, #E8E8E4); border-top:3px solid var(--taas-yellow, #FFC800);
  border-radius:var(--taas-radius, 6px); padding:0; margin-bottom:16px;
}
.fh-compare-card__name {
  font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:16px; font-weight:800;
  color:var(--taas-dark, #1A1A1A); text-transform:uppercase; letter-spacing:.04em;
  padding:16px 18px; border-bottom:1px solid var(--taas-border, #E8E8E4);
}
.fh-compare-card__row { display:flex; justify-content:space-between; align-items:center; padding:10px 18px; border-bottom:1px solid #F0F0EE; }
.fh-compare-card__row:last-child { border-bottom:none; }
.fh-compare-card__label { font-size:12px; font-weight:600; color:#999; text-transform:uppercase; letter-spacing:.04em; }
.fh-compare-card__value { font-size:14px; font-weight:700; color:var(--taas-dark, #1A1A1A); text-align:right; }
.fh-table-wrap { overflow-x:auto; }
.fh-table { width:100%; border-collapse:collapse; font-size:14px; }
.fh-table thead th {
  background:var(--taas-dark, #1A1A1A); color:var(--taas-white, #fff);
  font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
  padding:14px 16px; text-align:left; border-right:1px solid rgba(255,255,255,.08);
}
.fh-table thead th:first-child { color:var(--taas-yellow, #FFC800); }
.fh-table thead th:last-child { border-right:none; }
.fh-table tbody td, .fh-table tbody th {
  padding:12px 16px; border-bottom:1px solid var(--taas-border, #E8E8E4);
  border-right:1px solid var(--taas-border, #E8E8E4); color:var(--taas-body, #333);
}
.fh-table tbody th { font-weight:700; color:var(--taas-dark, #1A1A1A); background:var(--taas-panel, #F7F7F5); }
.fh-table tbody td:last-child, .fh-table tbody th:last-child { border-right:none; }
.fh-table tbody tr:last-child td, .fh-table tbody tr:last-child th { border-bottom:none; }
.fh-table tbody tr:nth-child(even) td { background:#FAFAF8; }
.fh-table caption { font-size:11px; color:#999; text-align:left; padding:8px 0; caption-side:bottom; }

/* ══ FAQ ═════════════════════════════════════════════════════════════════════ */
.fh-faq-list { max-width:780px; margin:0 auto; }
.fh-faq-item { border-bottom:1px solid var(--taas-border, #E8E8E4); }
.fh-faq-item:first-child { border-top:1px solid var(--taas-border, #E8E8E4); }
.fh-faq-q {
  width:100%; background:none; border:none; text-align:left; cursor:pointer;
  padding:20px 40px 20px 0; font-family:var(--taas-font, 'Inter', Arial, sans-serif);
  font-size:15px; font-weight:700; color:var(--taas-black, #111111);
  position:relative; line-height:1.4;
}
.fh-faq-q::after { content:'+'; position:absolute; right:0; top:50%; transform:translateY(-50%); font-size:22px; font-weight:300; color:var(--taas-yellow, #FFC800); transition:transform .2s; }
.fh-faq-q[aria-expanded="true"]::after { content:'−'; }
.fh-faq-a { display:none; padding:0 40px 20px 0; }
.fh-faq-a p { margin:0; font-size:15px; color:var(--taas-mid, #666666); line-height:1.75; font-weight:300; }

/* ══ ENQUIRY ═════════════════════════════════════════════════════════════════ */
.fh-enquiry { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:start; }
.fh-enquiry__phone { display:block; font-family:var(--taas-font, 'Inter', Arial, sans-serif); font-size:clamp(28px, 4vw, 40px); font-weight:800; color:var(--taas-yellow, #FFC800); text-decoration:none; margin:16px 0 6px; }
.fh-enquiry__phone:hover { opacity:.65; }
.fh-enquiry__detail { font-size:15px; color:#aaa; line-height:1.75; font-weight:300; }
.fh-enquiry__detail strong { color:var(--taas-white, #FFFFFF); }

/* Dark CF7 form styling */
.fh-form-dark .wpcf7-form input[type="text"],
.fh-form-dark .wpcf7-form input[type="email"],
.fh-form-dark .wpcf7-form input[type="tel"],
.fh-form-dark .wpcf7-form select,
.fh-form-dark .wpcf7-form textarea {
  background:#1c1c1c!important; border:1px solid rgba(255,255,255,.12)!important;
  color:#fff!important; border-radius:6px!important;
  padding:13px 16px!important; font-size:15px!important;
  font-family:var(--taas-font)!important;
  width:100%!important; box-sizing:border-box!important;
  transition:border-color .15s!important; height:auto!important;
  line-height:1.5!important; margin-top:6px!important;
}
.fh-form-dark .wpcf7-form textarea { min-height:110px!important; resize:vertical!important; }
.fh-form-dark .wpcf7-form input:focus,
.fh-form-dark .wpcf7-form textarea:focus {
  border-color:#FFC800!important; outline:none!important;
  box-shadow:0 0 0 3px rgba(255,200,0,.12)!important;
}
.fh-form-dark .wpcf7-form input::placeholder,
.fh-form-dark .wpcf7-form textarea::placeholder { color:#666!important; }
.fh-form-dark .wpcf7-form label {
  color:#999!important; font-size:12px!important; font-weight:700!important;
  display:block!important; text-transform:uppercase!important; letter-spacing:.08em!important;
}
.fh-form-dark .wpcf7-form input[type="submit"],
.fh-form-dark .wpcf7-form .wpcf7-submit {
  background:#FFC800!important; color:#1A1A1A!important;
  border:none!important; padding:15px 32px!important;
  font-size:15px!important; font-weight:700!important;
  font-family:var(--taas-font)!important;
  border-radius:6px!important; cursor:pointer!important;
  width:100%!important; margin-top:4px!important;
  letter-spacing:.03em!important; text-transform:uppercase!important;
  transition:opacity .15s!important;
}
.fh-form-dark .wpcf7-form input[type="submit"]:hover { opacity:.88!important; }
.fh-form-dark .wpcf7-form .wpcf7-not-valid-tip { color:#C0392B!important; font-size:12px!important; }
.fh-form-dark .wpcf7-form .wpcf7-response-output { border:1px solid rgba(255,255,255,.1)!important; color:#999!important; font-size:14px!important; padding:14px!important; border-radius:6px!important; margin-top:16px!important; }

/* ══ DISCLAIMER ═════════════════════════════════════════════════════════════ */
.fh-disclaimer { background:var(--taas-panel, #F7F7F5); border-top:1px solid var(--taas-border, #E8E8E4); padding:20px 0; }
.fh-disclaimer p { font-size:12px; color:#999; line-height:1.6; }

/* ══ RESPONSIVE ══════════════════════════════════════════════════════════════ */
@media (max-width:1024px) {
  .fh-hero__inner { grid-template-columns:1fr; }
  .fh-hero__card { display:none; }
  .fh-pcard { grid-template-columns:1fr; }
  .fh-pcard__logo { flex-direction:row; padding:16px 20px; border-right:none; border-bottom:1px solid var(--taas-border, #E8E8E4); justify-content:flex-start; }
  .fh-pcard__cta { border-left:none; border-top:1px solid var(--taas-border, #E8E8E4); flex-direction:row; flex-wrap:wrap; padding:16px 20px; }
  .fh-btn--full { flex:1; min-width:140px; }
  .fh-enquiry { grid-template-columns:1fr; gap:32px; }
  .fh-trust__inner { flex-direction:column; gap:8px; align-items:flex-start; padding:0 24px; }
  .fh-trust__item { font-size:12px; }
  .fh-steps { grid-template-columns:1fr 1fr; }
}
@media (max-width:640px) {
  .fh-steps { grid-template-columns:1fr; }
  .fh-step { border-right:none; border-bottom:1px solid var(--taas-border, #E8E8E4); }
  .fh-hero { padding:var(--taas-sec-pad-m, 48px) 0 40px; }
  .fh-section { padding:var(--taas-sec-pad-m, 48px) 0; }
  .fh-hero__h1 { font-size:clamp(28px, 7vw, 42px); }
  .fh-hero__sub { font-size:15px; }
  .fh-hero__ctas { flex-direction:column; align-items:stretch; }
  .fh-hero__ctas .fh-btn { justify-content:center; text-align:center; }
  .fh-hero__pill { font-size:12px; padding:5px 12px; }
  .fh-btn { font-size:13px; padding:12px 20px; }
  .fh-pcard__name { font-size:16px; }
  .fh-pcard__body { padding:20px 18px; }
  .fh-pcard__cta { flex-direction:column; }
  .fh-fact__val { font-size:22px; }
  .fh-step__num { font-size:36px; }
  .fh-step__title { font-size:15px; }
  .fh-compare-desktop { display:none; }
  .fh-compare-mobile { display:block; }
  .fh-phone-strip a { font-size:17px; }
  .fh-enquiry { display:flex; flex-direction:column-reverse; gap:32px; }
  .fh-enquiry__phone { font-size:clamp(24px, 6vw, 32px); }
}
</style>


<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════════════ -->
<nav class="fh-breadcrumb" aria-label="Breadcrumb">
  <div class="fh-w">
    <div class="fh-breadcrumb__inner">
      <a href="<?php echo esc_url($site_url); ?>">Home</a>
      <span class="fh-breadcrumb__sep">›</span>
      <strong>Finance Options</strong>
    </div>
  </div>
</nav>


<!-- ══ HERO ═══════════════════════════════════════════════════════════════════ -->
<section class="fh-hero" aria-labelledby="fh-h1">
  <div class="fh-hero__bg"></div>
  <div class="fh-w">
    <div class="fh-hero__inner">
      <div>
        <div class="fh-hero__eye">Finance Options</div>
        <h1 class="fh-hero__h1" id="fh-h1">
          Pay for your repairs<br>
          <em>on your terms.</em>
        </h1>
        <p class="fh-hero__sub">Four ways to spread the cost of any repair — from buy now pay later and interest-free cards to personal loans for all credit circumstances. No pressure, no hidden fees. Flexible options from a workshop you can trust.</p>
        <div class="fh-hero__pills">
          <?php foreach ($providers as $p): ?>
          <a href="<?php echo esc_url(home_url('/' . $p['slug'] . '/')); ?>" class="fh-hero__pill"><?php echo esc_html($p['name']); ?></a>
          <?php endforeach; ?>
        </div>
        <div class="fh-hero__ctas">
          <a href="#fh-providers" class="fh-btn fh-btn--yellow">View Finance Options</a>
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fh-btn fh-btn--outline">Call <?php echo esc_html($phone_free); ?></a>
        </div>
      </div>

      <div class="fh-hero__card" aria-hidden="true">
        <div class="fh-hero__card-title">Why choose TAAS</div>
        <div class="fh-stat">
          <div class="fh-stat__icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="#FFC800"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
          <div class="fh-stat__text"><strong><?php echo esc_html($rating); ?>★ Google Rating</strong><?php echo esc_html($reviews); ?> verified reviews</div>
        </div>
        <div class="fh-stat">
          <div class="fh-stat__icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="#FFC800"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg></div>
          <div class="fh-stat__text"><strong>Family-owned since <?php echo esc_html($established); ?></strong><?php echo esc_html($years); ?> years in South Auckland</div>
        </div>
        <div class="fh-stat">
          <div class="fh-stat__icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="#FFC800"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
          <div class="fh-stat__text"><strong>MTA Assured</strong>NZTA Authorised</div>
        </div>
        <div class="fh-stat">
          <div class="fh-stat__icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="#FFC800"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg></div>
          <div class="fh-stat__text"><strong>4 finance options</strong>BNPL, interest-free &amp; personal loans</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ PHONE STRIP ═══════════════════════════════════════════════════════════ -->
<div class="fh-phone-strip">
  <div class="fh-w" style="display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;">
    <span class="fh-phone-strip__label">Need help choosing?</span>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:4px;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a>
  </div>
</div>


<!-- ══ TRUST STRIP ════════════════════════════════════════════════════════════ -->
<div class="fh-trust" role="region" aria-label="Trust signals">
  <div class="fh-w">
    <div class="fh-trust__inner">
      <div class="fh-trust__item">4 Finance Options Available</div>
      <div class="fh-trust__item">MTA Assured</div>
      <div class="fh-trust__item">NZTA Authorised</div>
      <div class="fh-trust__item"><?php echo esc_html($reviews); ?> Google Reviews</div>
    </div>
  </div>
</div>


<!-- ══ PROVIDER CARDS ════════════════════════════════════════════════════════ -->
<section class="fh-section" id="fh-providers" aria-labelledby="fh-providers-head">
  <div class="fh-w">
    <span class="fh-sec-eye">Payment Options</span>
    <h2 class="fh-sec-h2" id="fh-providers-head">Choose how you want to pay</h2>
    <p class="fh-sec-intro">All four options are available across our full range of services. Each has different terms — pick the one that suits your repair cost and budget.</p>

    <div class="fh-providers">
      <?php foreach ($providers as $p):
        $featured_cls = $p['featured'] ? ' fh-pcard--featured' : '';
        $badge_cls = $p['featured'] ? 'fh-pcard__badge--yellow' : 'fh-pcard__badge--grey';
      ?>
      <article class="fh-pcard<?php echo $featured_cls; ?>" id="provider-<?php echo esc_attr($p['id']); ?>" aria-label="<?php echo esc_attr($p['name']); ?> payment option">

        <div class="fh-pcard__logo">
          <?php if (!empty($p['logo'])): ?>
          <img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['logo_alt']); ?>" class="fh-pcard__logo-img" loading="lazy">
          <?php else: ?>
          <div class="fh-pcard__logo-ph"><span><?php echo esc_html($p['name']); ?></span></div>
          <?php endif; ?>
          <span class="fh-pcard__badge <?php echo $badge_cls; ?>"><?php echo esc_html($p['badge']); ?></span>
        </div>

        <div class="fh-pcard__body">
          <div class="fh-pcard__name"><?php echo esc_html($p['name']); ?></div>
          <div class="fh-pcard__tagline"><?php echo esc_html($p['tagline']); ?></div>
          <?php foreach ($p['descs'] as $desc): ?>
          <p class="fh-pcard__desc"><?php echo esc_html($desc); ?></p>
          <?php endforeach; ?>
          <div class="fh-pcard__facts">
            <?php foreach ($p['facts'] as $f): ?>
            <div>
              <div class="fh-fact__val"><?php echo esc_html($f['val']); ?></div>
              <div class="fh-fact__lbl"><?php echo esc_html($f['lbl']); ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="fh-pcard__cta">
          <a href="<?php echo esc_url($p['cta1_url']); ?>"
             class="fh-btn fh-btn--dark fh-btn--full"
             <?php echo $p['cta1_ext'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
            <?php echo esc_html($p['cta1_label']); ?>
          </a>
          <?php if (!empty($p['cta2_label'])): ?>
          <a href="<?php echo esc_url($p['cta2_url']); ?>"
             class="fh-btn fh-btn--outline fh-btn--full" style="margin-top:8px;"
             <?php echo !empty($p['cta2_ext']) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
            <?php echo esc_html($p['cta2_label']); ?>
          </a>
          <?php endif; ?>
          <?php if (!empty($p['terms_label'])): ?>
          <p class="fh-terms"><a href="<?php echo esc_url($p['terms_url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($p['terms_label']); ?></a></p>
          <?php endif; ?>
        </div>

      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ HOW IT WORKS ══════════════════════════════════════════════════════════ -->
<section class="fh-section fh-section--grey" aria-labelledby="fh-how-head">
  <div class="fh-w">
    <span class="fh-sec-eye">The Process</span>
    <h2 class="fh-sec-h2" id="fh-how-head">Using finance at TAAS is straightforward</h2>
    <p class="fh-sec-intro">Set up your chosen provider before you book. Pay when you collect your vehicle.</p>
    <div class="fh-steps">
      <div class="fh-step">
        <div class="fh-step__num">1</div>
        <div class="fh-step__title">Choose your option</div>
        <p class="fh-step__text">Compare the four providers on this page and pick the one that suits your repair size and credit situation.</p>
      </div>
      <div class="fh-step">
        <div class="fh-step__num">2</div>
        <div class="fh-step__title">Set up your account</div>
        <p class="fh-step__text">Apply through your chosen provider before your appointment. For Afterpay, make sure the in-store card is set up on your phone.</p>
      </div>
      <div class="fh-step">
        <div class="fh-step__num">3</div>
        <div class="fh-step__title">Book your repair</div>
        <p class="fh-step__text">Call us on <?php echo esc_html($phone_free); ?> or use our booking form. Let us know which finance option you plan to use.</p>
      </div>
      <div class="fh-step">
        <div class="fh-step__num">4</div>
        <div class="fh-step__title">Pay at collection</div>
        <p class="fh-step__text">When your vehicle is ready, pay at the service desk. Afterpay: tap your phone. Q Card and Gem: tap your card.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ COMPARISON TABLE ══════════════════════════════════════════════════════ -->
<section class="fh-section" aria-labelledby="fh-compare-head">
  <div class="fh-w">
    <span class="fh-sec-eye">Side by Side</span>
    <h2 class="fh-sec-h2" id="fh-compare-head">Compare all four options</h2>
    <p class="fh-sec-intro">A quick reference to help you choose. Always read the provider's full terms before applying.</p>
    <div class="fh-table-wrap fh-compare-desktop">
      <table class="fh-table">
        <caption>Finance options at Tony Allen Auto Service, Manukau. Correct at <?php echo date('Y'); ?>. Subject to change — always verify with each provider.</caption>
        <thead>
          <tr>
            <?php foreach ($compare[0] as $h): ?>
            <th scope="col"><?php echo esc_html($h); ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($compare, 1) as $row): ?>
          <tr>
            <?php foreach ($row as $ci => $cell):
              $tag = $ci === 0 ? 'th' : 'td';
              $scope = $ci === 0 ? ' scope="row"' : '';
            ?>
            <<?php echo $tag; ?><?php echo $scope; ?>><?php echo esc_html($cell); ?></<?php echo $tag; ?>>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Mobile: each provider as a card -->
    <div class="fh-compare-mobile">
      <?php
      $headers = $compare[0];
      $rows    = array_slice($compare, 1);
      for ($pi = 1; $pi <= 4; $pi++):
        $pname = $headers[$pi];
      ?>
      <div class="fh-compare-card">
        <div class="fh-compare-card__name"><?php echo esc_html($pname); ?></div>
        <?php foreach ($rows as $row): ?>
        <div class="fh-compare-card__row">
          <span class="fh-compare-card__label"><?php echo esc_html($row[0]); ?></span>
          <span class="fh-compare-card__value"><?php echo esc_html($row[$pi]); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endfor; ?>
      <p style="font-size:11px;color:#999;margin-top:12px;">Correct at <?php echo date('Y'); ?>. Subject to change — always verify with each provider.</p>
    </div>
  </div>
</section>


<!-- ══ ENQUIRY ════════════════════════════════════════════════════════════════ -->
<section class="fh-section fh-section--dark" id="fh-book" aria-labelledby="fh-book-head">
  <div class="fh-w">
    <div class="fh-enquiry">
      <div>
        <span class="fh-sec-eye fh-sec-eye--yellow">Get in Touch</span>
        <h2 class="fh-sec-h2 fh-sec-h2--white" id="fh-book-head">Ready to book your repair?</h2>
        <p style="font-size:16px;color:#aaa;line-height:1.75;font-weight:300;margin-bottom:8px;">Let us know which finance option you plan to use so we can have everything ready when you arrive. Estimate before we start — nothing happens without your approval.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="fh-enquiry__detail">
          <strong>Tony Allen Auto Service</strong><br>
          <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;"><?php echo esc_html($address); ?></a><br>
          <?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?>
        </div>
      </div>
      <div class="fh-form-dark">
      <?php if ($cf7_general): ?>
        <?php echo do_shortcode($cf7_general); ?>
      <?php elseif ($cf7_finance): ?>
        <?php echo do_shortcode($cf7_finance); ?>
      <?php else: ?>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="fh-btn fh-btn--yellow fh-btn--full">Call <?php echo esc_html($phone_free); ?></a>
          <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="fh-btn fh-btn--outline fh-btn--full"><?php echo esc_html($phone_local); ?></a>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="fh-btn fh-btn--outline fh-btn--full"><?php echo esc_html($email); ?></a>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<?php if ($reviews_widget): ?>
<!-- ══ REVIEWS ════════════════════════════════════════════════════════════════ -->
<section class="fh-section fh-section--grey" aria-label="Customer reviews">
  <div class="fh-w">
    <span class="fh-sec-eye fh-sec-eye--yellow">Google Reviews</span>
    <h2 class="fh-sec-h2"><?php echo esc_html($reviews); ?> customers have reviewed Tony Allen Auto Service</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>
<?php endif; ?>


<!-- ══ FAQ ════════════════════════════════════════════════════════════════════ -->
<section class="fh-section" aria-labelledby="fh-faq-head">
  <div class="fh-w">
    <span class="fh-sec-eye">Questions</span>
    <h2 class="fh-sec-h2" id="fh-faq-head">Finance questions answered</h2>
    <p class="fh-sec-intro">Common questions about paying for car repairs with finance at Tony Allen Auto Service, Manukau.</p>
    <div class="fh-faq-list">
      <?php foreach ($faqs as $fi => $faq):
        $qid = 'fh-faq-q-' . $fi;
        $aid = 'fh-faq-a-' . $fi;
      ?>
      <div class="fh-faq-item">
        <button class="fh-faq-q" aria-expanded="<?php echo $fi === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo $aid; ?>" id="<?php echo $qid; ?>">
          <?php echo esc_html($faq['q']); ?>
        </button>
        <div class="fh-faq-a" id="<?php echo $aid; ?>" role="region" aria-labelledby="<?php echo $qid; ?>"<?php echo $fi === 0 ? ' style="display:block;"' : ''; ?>>
          <p><?php echo esc_html($faq['a']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ DISCLAIMER ═════════════════════════════════════════════════════════════ -->
<div class="fh-disclaimer">
  <div class="fh-w">
    <p>Afterpay, Q Card, Gem Finance (Latitude), and Aotea Finance are independent third-party providers. Tony Allen Auto Service is a merchant partner and does not provide financial advice or credit. Finance is subject to each provider's terms, conditions, and approval criteria. Always read the provider's terms before applying. Interest and fees may apply after any promotional period.</p>
  </div>
</div>

</div><!-- /.taas-fh -->

<script>
(function(){
  'use strict';
  document.querySelectorAll('.taas-fh .fh-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var open = this.getAttribute('aria-expanded') === 'true';
      document.querySelectorAll('.taas-fh .fh-faq-q').forEach(function(b){
        b.setAttribute('aria-expanded','false');
        var a = document.getElementById(b.getAttribute('aria-controls'));
        if(a) a.style.display='none';
      });
      if(!open){
        this.setAttribute('aria-expanded','true');
        var ans = document.getElementById(this.getAttribute('aria-controls'));
        if(ans) ans.style.display='block';
      }
    });
  });
}());
</script>

<?php get_footer(); ?>
