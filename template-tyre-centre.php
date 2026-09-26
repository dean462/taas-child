<?php
/**
 * Template Name: Tyre Centre Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /tyre-centre/
 * Division: TAAS Tyre & WOF Centre
 *
 * 90K+ SC impressions at 0.2% CTR — this page fixes that.
 * Hub links to: 7 sub-services (master array), wheel alignment,
 * wheel balancing, tyre finder, brand pages, location spokes.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$established    = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years_trading  = date('Y') - intval($established);
$maps_url       = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';
$alignment_price = defined('TAAS_ALIGNMENT_PRICE') ? TAAS_ALIGNMENT_PRICE : 'from $100 incl. GST';
$balance_price   = defined('TAAS_BALANCE_PRICE')   ? TAAS_BALANCE_PRICE   : 'from $25 per wheel incl. GST';
$tpms_price      = defined('TAAS_TPMS_PRICE')      ? TAAS_TPMS_PRICE      : 'from $75';
$customers       = defined('TAAS_CUSTOMERS')        ? TAAS_CUSTOMERS       : '10,000+';

// ── Schema ───────────────────────────────────────────────────────────────────
$schema = ['@context' => 'https://schema.org', '@graph' => [
    [
        '@type'       => ['AutoRepair', 'LocalBusiness'],
        'name'        => 'Tony Allen Auto Service — Tyre Centre',
        'url'         => $site_url . '/tyre-centre/',
        'description' => 'Tyre supply, fitting, wheel alignment and balancing in Manukau, South Auckland. Budget to premium tyres for cars, SUVs, 4WDs and light commercial. MTA Assured workshop, trading since 1985.',
        'telephone'   => [TAAS_PHONE_LOCAL, TAAS_PHONE_FREE],
        'email'       => TAAS_EMAIL,
        'address'     => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive',
                          'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland',
                          'postalCode' => '2104', 'addressCountry' => 'NZ'],
        'geo'         => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671],
        'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
            'opens' => '07:30', 'closes' => '17:00']],
        'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => TAAS_RATING,
                              'reviewCount' => preg_replace('/\D+/', '', TAAS_REVIEWS), 'bestRating' => '5'],
        'foundingDate' => '1985-10-01',
        'priceRange'   => '$$',
        'areaServed'   => 'South Auckland',
        'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
        'memberOf'     => ['@type' => 'Organization', 'name' => 'Motor Trade Association New Zealand'],
        'sameAs'       => [
            'https://www.facebook.com/tikitikiracing/',
            'https://www.google.com/maps/place/Tony+Allen+Auto+Service'
        ],
    ],
    [
        '@type'      => 'FAQPage',
        'mainEntity' => [
            ['@type'=>'Question','name'=>'What tyre services do you offer?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Tyre supply and fitting, wheel alignment (3D laser), wheel balancing, tyre rotation, puncture repair, TPMS reset and diagnosis, budget tyres, 4WD and SUV tyres, and run-flat tyres. We supply, fit and balance in one visit at 139 Cavendish Drive, Manukau.']],
            ['@type'=>'Question','name'=>'How much does a wheel alignment cost?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Wheel alignment '.$alignment_price.'. 3D laser alignment on our dedicated alignment hoist — front and rear geometry checked and adjusted. Recommended after any new tyre fitting, suspension work, or if you notice uneven tyre wear or steering pull.']],
            ['@type'=>'Question','name'=>'How much does wheel balancing cost?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Wheel balancing '.$balance_price.'. Done on our ER85 touchscreen balancer — static, dynamic and run-out measured in a single spin. Balancing is included when we fit new tyres.']],
            ['@type'=>'Question','name'=>'How do I know when I need new tyres?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'The legal minimum tread depth in New Zealand is 1.5mm. Look for the tread wear indicators — small raised bars between the main grooves. If the tread is level with these bars, the tyre needs replacing. Other signs include visible sidewall damage, cracking, bulges, or uneven wear across the tread face. We check tyres as part of every WOF and service.']],
            ['@type'=>'Question','name'=>'Do you fit tyres I have bought elsewhere?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. Bring your tyres in and we will fit, balance and align. We recommend checking the size and load rating match your vehicle before purchasing — if you are unsure, call us on '.TAAS_PHONE_FREE.' and we will confirm.']],
            ['@type'=>'Question','name'=>'Can you help me choose the right tyre for my vehicle?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. Tell us your vehicle make and model, or your tyre size, and we will recommend options across budget, mid-range and premium brands. We carry Maxxis, Continental, Goodyear, Hifly and more — and can source any brand you need.']],
            ['@type'=>'Question','name'=>'Do you do 4WD and SUV tyres?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. We carry all-terrain, highway terrain and mud terrain patterns for 4WDs and SUVs. Brands include Maxxis Bravo, Continental CrossContact, Goodyear Wrangler and budget alternatives. We also fit and balance larger-diameter rims common on 4WD vehicles.']],
            ['@type'=>'Question','name'=>'What is the difference between budget and premium tyres?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Budget tyres use a simpler rubber compound and tread design. They do the job for lower-mileage drivers and city commuting. Premium tyres use advanced compounds that grip better in wet conditions, last longer, and produce less road noise. The right choice depends on how and where you drive — we help you decide.']],
            ['@type'=>'Question','name'=>'How often should I rotate my tyres?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Every 8,000 to 10,000 km, or at every service. Rotation moves tyres between positions so they wear evenly — front tyres typically wear faster on front-wheel-drive vehicles. Regular rotation extends tyre life and keeps handling predictable.']],
            ['@type'=>'Question','name'=>'Do you offer finance for tyre purchases?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. We accept Afterpay, Q Card and GEM Finance. Spread the cost of tyres, alignment and any other work done at the same time. Apply in-store or set up your account before you arrive.']],
            ['@type'=>'Question','name'=>'Where is your tyre shop?',
             'acceptedAnswer'=>['@type'=>'Answer','text'=>'139 Cavendish Drive, Manukau, Auckland 2104. Open Monday to Friday, 7:30am to 5:00pm. Call '.TAAS_PHONE_FREE.' or drop in. Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany and all of South Auckland.']],
        ],
    ],
    [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url.'/'],
            ['@type'=>'ListItem','position'=>2,'name'=>'Tyre Centre','item'=>$site_url.'/tyre-centre/'],
        ],
    ],
    [
        '@type' => 'SpeakableSpecification',
        'cssSelector' => ['.tc-hero h1', '.tc-section__heading', '.tc-faq__q'],
    ],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-tyre-centre .site-content,
.page-template-template-tyre-centre .entry-content,
.page-template-template-tyre-centre .entry-header,
.page-template-template-tyre-centre article,
.page-template-template-tyre-centre #primary,
.page-template-template-tyre-centre #content { padding:0!important; margin:0!important; max-width:100%!important; }
body.page-template-template-tyre-centre { overflow-x:hidden; }

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.tc-hero { background: var(--taas-black, #111111); padding: var(--taas-sec-pad, 72px) 0 60px; }
.tc-hero__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 300px; gap: 48px; align-items: start; }
.tc-hero__eyebrow { display: inline-block; background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 11px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 12px; border-radius: 3px; margin-bottom: 20px; }
.tc-hero h1 { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h1-hub, clamp(34px, 5.5vw, 54px)); font-weight: 800; color: var(--taas-white, #FFFFFF); letter-spacing: -0.02em; line-height: 1.1; margin: 0 0 16px; }
.tc-hero h1 span { color: var(--taas-yellow, #FFC800); }
.tc-hero__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: #aaa; max-width: 540px; margin: 0 0 28px; line-height: 1.65; }
.tc-hero__ctas { display: flex; gap: 12px; flex-wrap: wrap; }
.tc-sidebar { background: #1e1e1e; border: 1px solid #333; border-radius: var(--taas-radius, 6px); padding: 24px; }
.tc-sidebar__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 14px; }
.tc-sidebar__list { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 8px; }
.tc-sidebar__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: #ccc; padding-left: 18px; position: relative; line-height: 1.4; }
.tc-sidebar__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }
.tc-sidebar hr { border: none; border-top: 1px solid #333; margin: 0 0 16px; }
.tc-sidebar__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 22px; font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin-bottom: 4px; line-height: 1.1; }
.tc-sidebar__phone:hover { color: #fff; }
.tc-sidebar__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; color: #666; line-height: 1.6; }

/* ── Trust strip ───────────────────────────────────────────────────────────── */
.tc-trust { background: var(--taas-yellow, #FFC800); padding: 18px 0; }
.tc-trust__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; display: flex; gap: 40px; align-items: center; justify-content: center; flex-wrap: wrap; }
.tc-trust__item { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 600; color: var(--taas-dark, #1A1A1A); display: flex; align-items: center; gap: 7px; white-space: nowrap; }
.tc-trust__item::before { content: '✓'; font-weight: 900; }

/* ── Sections ──────────────────────────────────────────────────────────────── */
.tc-section { padding: var(--taas-sec-pad, 72px) 0; }
.tc-section--white { background: var(--taas-white, #FFFFFF); }
.tc-section--grey  { background: var(--taas-panel, #F7F7F5); }
.tc-section--dark  { background: var(--taas-dark, #1A1A1A); }
.tc-section__inner { max-width: var(--taas-container, 1140px); margin: 0 auto; padding: 0 24px; }
.tc-section__eyebrow { display: inline-block; background: var(--taas-dark, #1A1A1A); color: var(--taas-yellow, #FFC800); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-eye-size, 10px); font-weight: 700; letter-spacing: var(--taas-eye-ls, 0.12em); text-transform: uppercase; padding: 4px 10px; border-radius: 3px; margin-bottom: 14px; }
.tc-section--dark .tc-section__eyebrow { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); }
.tc-section__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: var(--taas-h2, clamp(26px, 3.5vw, 36px)); font-weight: 700; color: var(--taas-black, #111111); letter-spacing: -0.01em; margin: 0 0 12px; }
.tc-section--dark .tc-section__heading { color: var(--taas-white, #FFFFFF); }
.tc-section__sub { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 16px; color: var(--taas-mid, #666666); max-width: 640px; margin: 0 0 36px; line-height: 1.65; }
.tc-section--dark .tc-section__sub { color: #aaa; }

/* ── Service cards ─────────────────────────────────────────────────────────── */
.tc-services { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
.tc-service { background: var(--taas-panel, #F7F7F5); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 20px 18px; display: flex; flex-direction: column; gap: 8px; text-decoration: none; transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s; border-top: 3px solid transparent; }
.tc-service:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); transform: translateY(-2px); border-top-color: var(--taas-yellow, #FFC800); }
.tc-service__icon { width: 40px; height: 40px; flex-shrink: 0; }
.tc-service__icon svg { display: block; }
.tc-service__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; font-weight: 700; color: var(--taas-black, #111111); }
.tc-service__desc { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; flex: 1; }
.tc-service__link { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; color: var(--taas-yellow2, #e6b400); margin-top: auto; }
.tc-service:hover .tc-service__link { color: var(--taas-yellow, #FFC800); }

/* ── Educational columns ───────────────────────────────────────────────────── */
.tc-edu { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.tc-edu__panel { background: var(--taas-dark, #1A1A1A); border-radius: var(--taas-radius, 6px); padding: 32px 28px; }
.tc-edu__panel-title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-yellow, #FFC800); margin-bottom: 16px; }
.tc-edu__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
.tc-edu__list li { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: #ccc; padding-left: 20px; position: relative; line-height: 1.5; }
.tc-edu__list li::before { content: '✓'; position: absolute; left: 0; color: var(--taas-yellow, #FFC800); font-weight: 700; }

/* ── Callout box ───────────────────────────────────────────────────────────── */
.tc-callout { border-left: 4px solid var(--taas-yellow, #FFC800); background: #fffbea; padding: 24px 28px; border-radius: 0 var(--taas-radius, 6px) var(--taas-radius, 6px) 0; margin: 24px 0; }
.tc-callout__title { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-dark, #1A1A1A); margin-bottom: 8px; }
.tc-callout__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-body, #333333); line-height: 1.65; margin-bottom: 12px; }

/* ── Finder CTA card ───────────────────────────────────────────────────────── */
.tc-finder { background: var(--taas-dark, #1A1A1A); border-radius: var(--taas-radius, 6px); padding: 40px; display: grid; grid-template-columns: 1fr auto; gap: 32px; align-items: center; margin-top: 40px; }
.tc-finder__heading { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(20px, 3vw, 28px); font-weight: 700; color: var(--taas-white, #FFFFFF); margin: 0 0 8px; }
.tc-finder__body { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.6; }

/* ── Pricing cards ─────────────────────────────────────────────────────────── */
.tc-pricing { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 28px; }
.tc-price-card { background: var(--taas-white, #FFFFFF); border: 1px solid var(--taas-border, #E8E8E4); border-radius: var(--taas-radius, 6px); padding: 28px 24px; text-align: center; }
.tc-price-card__label { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--taas-mid, #666666); margin-bottom: 8px; }
.tc-price-card__price { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(22px, 3vw, 30px); font-weight: 800; color: var(--taas-black, #111111); margin-bottom: 8px; }
.tc-price-card__note { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 13px; color: var(--taas-mid, #666666); line-height: 1.5; }

/* ── Suburb pills ──────────────────────────────────────────────────────────── */
.tc-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; list-style: none; padding: 0; }
.tc-pills li a { display: inline-block; padding: 7px 18px; border: 1px solid var(--taas-border, #E8E8E4); border-radius: 100px; background: var(--taas-white, #FFFFFF); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 14px; color: var(--taas-body, #333333); text-decoration: none; transition: all 0.15s; }
.tc-pills li a:hover { background: var(--taas-yellow, #FFC800); border-color: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-weight: 600; }

/* ── FAQ ────────────────────────────────────────────────────────────────────── */
.tc-faq { max-width: 780px; }
.tc-faq__list { display: flex; flex-direction: column; gap: 0; margin-top: 28px; }
.tc-faq__item { border-bottom: 1px solid var(--taas-border, #E8E8E4); }
.tc-faq__q { width: 100%; text-align: left; background: none; border: none; padding: 18px 40px 18px 0; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; font-weight: 700; color: var(--taas-black, #111111); cursor: pointer; position: relative; line-height: 1.4; display: block; }
.tc-faq__q::after { content: '+'; position: absolute; right: 0; top: 50%; transform: translateY(-50%); font-size: 22px; font-weight: 400; color: var(--taas-mid, #666666); transition: transform 0.2s; }
.tc-faq__item--open .tc-faq__q::after { content: '−'; }
.tc-faq__a { display: none; padding: 0 0 18px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: var(--taas-mid, #666666); line-height: 1.7; }
.tc-faq__a a { color: var(--taas-yellow, #FFC800); font-weight: 600; text-decoration: none; }
.tc-faq__a a:hover { text-decoration: underline; }
.tc-faq__item--open .tc-faq__a { display: block; }

/* ── Enquiry ───────────────────────────────────────────────────────────────── */
.tc-enquiry { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.tc-enquiry__phone { display: block; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: var(--taas-yellow, #FFC800); text-decoration: none; margin: 16px 0 6px; }
.tc-enquiry__phone:hover { color: #fff; }
.tc-enquiry__detail { font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; color: #aaa; line-height: 1.7; }
.tc-enquiry__detail strong { color: var(--taas-white, #FFFFFF); }

/* ── CF7 on dark ───────────────────────────────────────────────────────────── */
.tc-section--dark .wpcf7 label, .tc-section--dark .wpcf7 span:not(.wpcf7-spinner), .tc-section--dark .wpcf7 div:not(.wpcf7-response-output), .tc-section--dark .wpcf7 p { color: #ccc !important; font-size: 14px; font-family: var(--taas-font, 'Inter', Arial, sans-serif); }
.tc-section--dark .wpcf7 input[type="text"], .tc-section--dark .wpcf7 input[type="email"], .tc-section--dark .wpcf7 input[type="tel"], .tc-section--dark .wpcf7 textarea { background: #2a2a2a; border: 1px solid #444; color: #fff; border-radius: var(--taas-radius, 6px); padding: 10px 14px; width: 100%; font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-size: 15px; }
.tc-section--dark .wpcf7 input::placeholder, .tc-section--dark .wpcf7 textarea::placeholder { color: #666; }
.tc-section--dark .wpcf7 input:focus, .tc-section--dark .wpcf7 textarea:focus { outline: none; border-color: var(--taas-yellow, #FFC800); }
.tc-section--dark .wpcf7 input[type="submit"] { background: var(--taas-yellow, #FFC800); color: var(--taas-dark, #1A1A1A); font-family: var(--taas-font, 'Inter', Arial, sans-serif); font-weight: 700; font-size: 15px; letter-spacing: 0.05em; text-transform: uppercase; border: none; padding: 14px 32px; border-radius: var(--taas-radius, 6px); cursor: pointer; width: 100%; margin-top: 4px; }
.tc-section--dark .wpcf7 input[type="submit"]:hover { background: var(--taas-yellow2, #e6b400); }

/* ── Responsive ────────────────────────────────────────────────────────────── */
@media (max-width: 960px) {
  .tc-hero__inner { grid-template-columns: 1fr; }
  .tc-services { grid-template-columns: repeat(2, 1fr); }
  .tc-edu { grid-template-columns: 1fr; }
  .tc-enquiry { grid-template-columns: 1fr; gap: 32px; }
  .tc-pricing { grid-template-columns: 1fr; }
  .tc-finder { grid-template-columns: 1fr; text-align: center; }
}
@media (max-width: 640px) {
  .tc-hero { padding: 48px 0 40px; }
  .tc-hero h1 { font-size: clamp(28px, 7vw, 42px); }
  .tc-hero__sub { font-size: 14px; }
  .tc-hero__ctas { flex-direction: column; align-items: stretch; }
  .tc-hero__ctas .taas-btn { justify-content: center; text-align: center; }
  .tc-section { padding: 48px 0; }
  .tc-section__heading { font-size: clamp(20px, 5vw, 28px); }
  .tc-section__sub { font-size: 14px; }
  .tc-services { grid-template-columns: 1fr; }
  .tc-trust__inner { flex-direction: column; gap: 8px; align-items: flex-start; }
  .tc-trust__item { font-size: 12px; }
  .tc-faq__q { font-size: 14px; padding: 16px 32px 16px 0; }
  .tc-faq__a { font-size: 13px; }
  .tc-enquiry__phone { font-size: clamp(24px, 6vw, 32px); }
  .tc-sidebar__phone { font-size: 20px; }
  .tc-finder { padding: 28px 24px; }
  .tc-finder__heading { font-size: clamp(18px, 5vw, 24px); }
  .tc-callout { padding: 20px 22px; }
}
</style>

<?php
// ── SVG badge helper ─────────────────────────────────────────────────────────
function tc_badge($initials) {
    $len = strlen($initials);
    $fs = $len > 3 ? 9 : ($len > 2 ? 11 : 14);
    return '<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="#1A1A1A"/><text x="20" y="21" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}
?>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- HERO                                                                      -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-hero">
  <div class="tc-hero__inner">
    <div>
      <span class="tc-hero__eyebrow">Tyre Centre — Manukau</span>
      <h1>Tyres<br><span>Manukau — South Auckland</span></h1>
      <p class="tc-hero__sub">Supply, fit and balance — all in one visit. Budget to premium tyres for cars, SUVs, 4WDs and light commercial. 3D laser wheel alignment on-site. Serving <?php echo esc_html($customers); ?> customers since <?php echo esc_html($established); ?>.</p>
      <div class="tc-hero__ctas">
        <a href="#enquire" class="taas-btn taas-btn--primary">Get a Tyre Estimate</a>
        <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      </div>
    </div>
    <div class="tc-sidebar">
      <div class="tc-sidebar__title">What We Do</div>
      <ul class="tc-sidebar__list">
        <li>Tyre supply, fit & balance</li>
        <li>3D laser wheel alignment</li>
        <li>Wheel balancing (ER85)</li>
        <li>Tyre rotation</li>
        <li>Puncture repairs</li>
        <li>TPMS reset & diagnosis</li>
        <li>4WD & SUV tyres</li>
        <li>Budget & premium options</li>
        <li>Run-flat tyres</li>
        <li>Fleet tyre management</li>
      </ul>
      <hr>
      <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" class="tc-sidebar__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
      <div class="tc-sidebar__detail"><?php echo esc_html(TAAS_PHONE_LOCAL); ?><br>Mon–Fri 7:30am–5:00pm</div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- TRUST STRIP                                                               -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<div class="tc-trust">
  <div class="tc-trust__inner">
    <div class="tc-trust__item">MTA Assured</div>
    <div class="tc-trust__item">NZTA Authorised</div>
    <div class="tc-trust__item">Supply, Fit & Balance</div>
    <div class="tc-trust__item">Estimate Before We Start</div>
    <div class="tc-trust__item"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- UNDERSTANDING YOUR TYRES                                                  -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--white">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow">Why Tyres Matter</span>
    <div class="tc-edu">
      <div>
        <h2 class="tc-section__heading">Understanding Your Tyres</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;">Your tyres are the only part of your car that touches the road. Every time you brake, accelerate, turn or drive in the rain, it comes down to four patches of rubber — each roughly the size of your hand. When those patches are worn, damaged or incorrectly inflated, your car cannot do what you ask it to.</p>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:16px;">Tread depth is the single biggest factor. New tyres start at 7–8mm of tread. At 3mm, wet braking distance starts to increase significantly. At 1.5mm — the legal minimum in New Zealand — the tyre has lost most of its ability to disperse water and will fail a WOF inspection. The tread wear indicators moulded into every tyre show you exactly when you have reached that point.</p>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;margin-bottom:20px;">Uneven wear is the other thing to watch. If one edge of the tread is wearing faster than the other, or if the centre is wearing but the edges are not, there is a problem — alignment, inflation, or suspension. Fitting new tyres without fixing the cause means the same wear pattern will come back. That is why we check alignment on every tyre fitting and recommend a full alignment where needed.</p>
        <div class="tc-callout">
          <div class="tc-callout__title">Tyres are checked at every WOF</div>
          <p class="tc-callout__body">Tread depth below 1.5mm, sidewall damage, bulges, cracking, uneven wear and incorrect tyre sizes are all WOF failure points. We check tyres as part of every WOF and every service — if something needs attention, we tell you before it becomes a problem.</p>
          <a href="<?php echo esc_url($site_url . '/wof/'); ?>" style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;">WOF Information →</a>
        </div>
      </div>
      <div class="tc-edu__panel">
        <div class="tc-edu__panel-title">Signs It Is Time for New Tyres</div>
        <ul class="tc-edu__list">
          <li>Tread level with wear indicators (1.5mm)</li>
          <li>Visible sidewall cracks, cuts or bulges</li>
          <li>Steering vibration at highway speed</li>
          <li>Vehicle pulling to one side under braking</li>
          <li>Uneven wear — one edge, centre, or cupping</li>
          <li>Tyres older than 6 years (check DOT date)</li>
          <li>Puncture too close to sidewall to repair safely</li>
          <li>WOF failure on tyre condition</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- SERVICES                                                                  -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--grey">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow">Services</span>
    <h2 class="tc-section__heading">Tyre Services — Manukau</h2>
    <p class="tc-section__sub">All work carried out on-site at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive</a>. Supply, fit and balance in one visit.</p>
    <div class="tc-services">
      <a href="<?php echo esc_url($site_url . '/tyre-fitting-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('TF'); ?></div>
        <div class="tc-service__title">Tyre Fitting</div>
        <p class="tc-service__desc">New tyres fitted, balanced and aligned. All makes and sizes — passenger, SUV, 4WD, light commercial.</p>
        <span class="tc-service__link">Tyre Fitting →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wheel-alignment-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('WA'); ?></div>
        <div class="tc-service__title">Wheel Alignment</div>
        <p class="tc-service__desc">3D laser alignment — front and rear geometry checked and adjusted. Prevents uneven tyre wear and steering pull.</p>
        <span class="tc-service__link">Wheel Alignment →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/wheel-balancing-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('WB'); ?></div>
        <div class="tc-service__title">Wheel Balancing</div>
        <p class="tc-service__desc">ER85 touchscreen balancer — static, dynamic and run-out measured in a single spin. Eliminates vibration.</p>
        <span class="tc-service__link">Wheel Balancing →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-rotation-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('TR'); ?></div>
        <div class="tc-service__title">Tyre Rotation</div>
        <p class="tc-service__desc">Move tyres between positions to even out wear. Recommended every 8,000–10,000 km or at every service.</p>
        <span class="tc-service__link">Tyre Rotation →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/4wd-tyres-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('4WD'); ?></div>
        <div class="tc-service__title">4WD & SUV Tyres</div>
        <p class="tc-service__desc">All-terrain, highway terrain and mud terrain. Maxxis Bravo, Continental, Goodyear and budget options fitted.</p>
        <span class="tc-service__link">4WD Tyres →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/budget-tyres-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('BT'); ?></div>
        <div class="tc-service__title">Budget Tyres</div>
        <p class="tc-service__desc">Quality budget options for everyday driving. Fitted, balanced and aligned — same service standard as premium.</p>
        <span class="tc-service__link">Budget Tyres →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/run-flat-tyres-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('RF'); ?></div>
        <div class="tc-service__title">Run-Flat Tyres</div>
        <p class="tc-service__desc">Supply and fit run-flat tyres for BMW, Mercedes-Benz, MINI and other vehicles equipped from factory.</p>
        <span class="tc-service__link">Run-Flat Tyres →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tyre-centre/puncture-repair-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('PR'); ?></div>
        <div class="tc-service__title">Puncture Repair</div>
        <p class="tc-service__desc">Plug and patch repairs where the tyre is repairable. Honest assessment — if it cannot be repaired safely, we tell you.</p>
        <span class="tc-service__link">Puncture Repair →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/tpms-reset-manukau/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('TPMS'); ?></div>
        <div class="tc-service__title">TPMS Reset</div>
        <p class="tc-service__desc">Tyre pressure monitoring system reset and sensor diagnosis. Required after tyre fitting, rotation or sensor replacement.</p>
        <span class="tc-service__link">TPMS Reset →</span>
      </a>
    </div>

    <!-- Tyre Finder CTA -->
    <div class="tc-finder">
      <div>
        <h3 class="tc-finder__heading">Know Your Tyre Size? Search Our Stock</h3>
        <p class="tc-finder__body">Enter your width, profile and rim diameter to see what we have available. Budget and premium brands — filtered by your exact size.</p>
      </div>
      <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>" class="taas-btn taas-btn--primary" style="white-space:nowrap;">Search Tyres →</a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- PRICING                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--white">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow">Pricing</span>
    <h2 class="tc-section__heading">Tyre Service Pricing</h2>
    <p class="tc-section__sub">Tyre supply pricing depends on size, brand and pattern — call us or use the <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">tyre finder</a> to check availability. The services below are priced as follows.</p>
    <div class="tc-pricing">
      <div class="tc-price-card">
        <div class="tc-price-card__label">Wheel Alignment</div>
        <div class="tc-price-card__price"><?php echo esc_html($alignment_price); ?></div>
        <div class="tc-price-card__note">3D laser alignment — front and rear geometry checked and adjusted</div>
      </div>
      <div class="tc-price-card">
        <div class="tc-price-card__label">Wheel Balancing</div>
        <div class="tc-price-card__price"><?php echo esc_html($balance_price); ?></div>
        <div class="tc-price-card__note">ER85 touchscreen balancer — included with new tyre fitting</div>
      </div>
      <div class="tc-price-card">
        <div class="tc-price-card__label">TPMS Reset</div>
        <div class="tc-price-card__price"><?php echo esc_html($tpms_price); ?></div>
        <div class="tc-price-card__note">Sensor diagnosis and system reset — sensor replacement additional</div>
      </div>
    </div>
    <div class="tc-callout" style="margin-top:28px;">
      <div class="tc-callout__title">Tyre pricing — contact for an estimate</div>
      <p class="tc-callout__body">Tyre prices depend on size, brand and availability. Call us on <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> with your tyre size or vehicle rego and we will give you an estimate on the spot. Finance available via Afterpay, Q Card and GEM Finance.</p>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- ENQUIRY                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--dark" id="enquire">
  <div class="tc-section__inner">
    <div class="tc-enquiry">
      <div>
        <span class="tc-section__eyebrow">Book or Enquire</span>
        <h2 class="tc-section__heading">Get a Tyre Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your vehicle make, model and tyre size — or just your rego number — and we will come back with an estimate.</p>
        <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>" class="tc-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="tc-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode(TAAS_CF7_GENERAL); ?></div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- RELATED SERVICES                                                          -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--grey">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow">Also at TAAS</span>
    <h2 class="tc-section__heading">Related Services</h2>
    <p class="tc-section__sub">Tyre work often overlaps with these services — all available at the same workshop.</p>
    <div class="tc-services" style="grid-template-columns:repeat(3,1fr);">
      <a href="<?php echo esc_url($site_url . '/wof/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('WOF'); ?></div>
        <div class="tc-service__title">WOF Inspections</div>
        <p class="tc-service__desc">Tyres are a key WOF checkpoint. Get your WOF and tyres sorted in the same visit.</p>
        <span class="tc-service__link">WOF Info →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/steering-and-suspension/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('SS'); ?></div>
        <div class="tc-service__title">Steering & Suspension</div>
        <p class="tc-service__desc">Worn suspension causes uneven tyre wear. We fix the cause so your new tyres last.</p>
        <span class="tc-service__link">Steering & Suspension →</span>
      </a>
      <a href="<?php echo esc_url($site_url . '/vehicle-servicing/'); ?>" class="tc-service">
        <div class="tc-service__icon"><?php echo tc_badge('VS'); ?></div>
        <div class="tc-service__title">Vehicle Servicing</div>
        <p class="tc-service__desc">Tyre condition is checked at every service. Regular servicing catches wear early.</p>
        <span class="tc-service__link">Servicing Info →</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- REVIEWS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--white">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow"><?php echo esc_html(TAAS_RATING); ?>★ · <?php echo esc_html(TAAS_REVIEWS); ?> Reviews</span>
    <h2 class="tc-section__heading">What Customers Say</h2>
    <?php echo do_shortcode(TAAS_REVIEWS_WIDGET); ?>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- SUBURBS                                                                   -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--grey">
  <div class="tc-section__inner">
    <span class="tc-section__eyebrow">South Auckland</span>
    <h2 class="tc-section__heading">Tyre Shop Near You</h2>
    <p class="tc-section__sub">Serving all of South Auckland from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;">139 Cavendish Drive, Manukau</a>.</p>
    <ul class="tc-pills">
      <?php
      $suburbs = [
          ['label'=>'Papatoetoe','slug'=>'papatoetoe'],['label'=>'Manukau','slug'=>'manukau'],
          ['label'=>'Māngere','slug'=>'mangere'],['label'=>'Ōtāhuhu','slug'=>'otahuhu'],
          ['label'=>'Wiri','slug'=>'wiri'],['label'=>'Manurewa','slug'=>'manurewa'],
          ['label'=>'Flat Bush','slug'=>'flat-bush'],['label'=>'Takanini','slug'=>'takanini'],
          ['label'=>'Papakura','slug'=>'papakura'],['label'=>'Ōtara','slug'=>'otara'],
          ['label'=>'Botany','slug'=>'botany'],['label'=>'Howick','slug'=>'howick'],
          ['label'=>'Clover Park','slug'=>'clover-park'],['label'=>'Weymouth','slug'=>'weymouth'],
          ['label'=>'Clendon','slug'=>'clendon'],['label'=>'Hunters Corner','slug'=>'hunters-corner'],
      ];
      foreach ($suburbs as $s) {
          echo '<li><a href="' . esc_url($site_url . '/tyres/' . $s['slug'] . '/') . '">Tyres ' . esc_html($s['label']) . '</a></li>';
      }
      ?>
    </ul>

    <h3 style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;font-weight:700;color:var(--taas-black,#111);margin:32px 0 12px;">Tyre Brands</h3>
    <ul class="tc-pills">
      <?php
      $brands = ['Maxxis','Continental','Goodyear','Hifly','Rovelo','Vitora','Wanli'];
      foreach ($brands as $b) {
          echo '<li><a href="' . esc_url($site_url . '/tyre-brands/' . sanitize_title($b) . '-tyres/') . '">' . esc_html($b) . ' Tyres</a></li>';
      }
      ?>
    </ul>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════════════════════ -->
<!-- FAQ                                                                       -->
<!-- ══════════════════════════════════════════════════════════════════════════ -->
<section class="tc-section tc-section--white">
  <div class="tc-section__inner">
    <div class="tc-faq">
      <span class="tc-section__eyebrow">FAQ</span>
      <h2 class="tc-section__heading">Common Questions — Tyres</h2>
      <div class="tc-faq__list">
        <div class="tc-faq__item"><button class="tc-faq__q">What tyre services do you offer?</button><div class="tc-faq__a"><p>Tyre supply and fitting, wheel alignment (3D laser), wheel balancing (ER85), tyre rotation, puncture repair, TPMS reset and diagnosis, budget tyres, 4WD and SUV tyres, and run-flat tyres. All work done on-site at 139 Cavendish Drive, Manukau — supply, fit and balance in one visit.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">How much does a wheel alignment cost?</button><div class="tc-faq__a"><p>Wheel alignment <?php echo esc_html($alignment_price); ?>. 3D laser alignment on our dedicated alignment hoist — front and rear geometry checked and adjusted. Recommended after any new tyre fitting, suspension work, or if you notice uneven tyre wear or steering pull.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">How much does wheel balancing cost?</button><div class="tc-faq__a"><p>Wheel balancing <?php echo esc_html($balance_price); ?>. Done on our ER85 touchscreen balancer — static, dynamic and run-out measured in a single spin. Balancing is included when we fit new tyres.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">How do I know when I need new tyres?</button><div class="tc-faq__a"><p>The legal minimum tread depth in New Zealand is 1.5mm. Look for the tread wear indicators — small raised bars between the main grooves. If the tread is level with these bars, the tyre needs replacing. Other signs include visible sidewall damage, cracking, bulges, or uneven wear across the tread face. We check tyres as part of every <a href="<?php echo esc_url($site_url . '/wof/'); ?>">WOF</a> and service.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">Do you fit tyres I have bought elsewhere?</button><div class="tc-faq__a"><p>Yes. Bring your tyres in and we will fit, balance and align. We recommend checking the size and load rating match your vehicle before purchasing — if you are unsure, call us on <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> and we will confirm.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">Can you help me choose the right tyre for my vehicle?</button><div class="tc-faq__a"><p>Yes. Tell us your vehicle make and model, or your tyre size, and we will recommend options across budget, mid-range and premium brands. We carry Maxxis, Continental, Goodyear, Hifly and more — and can source any brand you need. Use the <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>">tyre finder</a> to search by size.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">Do you do 4WD and SUV tyres?</button><div class="tc-faq__a"><p>Yes. We carry all-terrain, highway terrain and mud terrain patterns for 4WDs and SUVs. Brands include Maxxis Bravo, Continental CrossContact, Goodyear Wrangler and budget alternatives. We also fit and balance larger-diameter rims common on 4WD vehicles. See our <a href="<?php echo esc_url($site_url . '/4wd-tyres-manukau/'); ?>">4WD tyres page</a>.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">What is the difference between budget and premium tyres?</button><div class="tc-faq__a"><p>Budget tyres use a simpler rubber compound and tread design. They do the job for lower-mileage drivers and city commuting. Premium tyres use advanced compounds that grip better in wet conditions, last longer, and produce less road noise. The right choice depends on how and where you drive — we help you decide without pushing you toward the most expensive option.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">How often should I rotate my tyres?</button><div class="tc-faq__a"><p>Every 8,000 to 10,000 km, or at every service. Rotation moves tyres between positions so they wear evenly — front tyres typically wear faster on front-wheel-drive vehicles. Regular rotation extends tyre life and keeps handling predictable. See our <a href="<?php echo esc_url($site_url . '/tyre-rotation-manukau/'); ?>">tyre rotation page</a>.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">Do you offer finance for tyre purchases?</button><div class="tc-faq__a"><p>Yes. We accept Afterpay, Q Card and GEM Finance. Spread the cost of tyres, alignment and any other work done at the same time. Apply in-store or set up your account before you arrive. See our <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">finance options</a>.</p></div></div>
        <div class="tc-faq__item"><button class="tc-faq__q">Where is your tyre shop?</button><div class="tc-faq__a"><p><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau, Auckland 2104</a>. Open Monday to Friday, 7:30am to 5:00pm. Call <a href="tel:<?php echo str_replace(' ', '', TAAS_PHONE_FREE); ?>"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> or drop in. Serving Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany and all of South Auckland.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ toggle ──────────────────────────────────────────────────────────── -->
<script>
document.querySelectorAll('.tc-faq__q').forEach(function(btn){
  btn.addEventListener('click', function(){
    var item = this.closest('.tc-faq__item');
    var wasOpen = item.classList.contains('tc-faq__item--open');
    document.querySelectorAll('.tc-faq__item--open').forEach(function(i){ i.classList.remove('tc-faq__item--open'); });
    if (!wasOpen) item.classList.add('tc-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
