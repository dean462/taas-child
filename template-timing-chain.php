<?php
/**
 * Template Name: Timing Chain Service
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /timing-chain-service-manukau/
 * Dual parent: links to both Cambelts & Water Pumps and Engine Repairs
 * CSS namespace: .tcs
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url       = get_site_url();
$page_url       = get_permalink();
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$years          = date('Y') - intval($established);
$phone_local    = defined('TAAS_PHONE_LOCAL')    ? TAAS_PHONE_LOCAL    : '09 278 9556';
$phone_free     = defined('TAAS_PHONE_FREE')     ? TAAS_PHONE_FREE     : '0800 100 876';
$email          = defined('TAAS_EMAIL')          ? TAAS_EMAIL          : 'enquiries@taas.co.nz';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$rating         = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$reviews        = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';
$ms_number      = defined('TAAS_MS_NUMBER')      ? TAAS_MS_NUMBER      : 'MS 13890';
$customers      = defined('TAAS_CUSTOMERS')      ? TAAS_CUSTOMERS      : '10,000+';
$scan_price     = defined('TAAS_SCAN_PRICE')     ? TAAS_SCAN_PRICE     : 'from $75';
$mech_diag      = defined('TAAS_MECH_DIAG')      ? TAAS_MECH_DIAG      : 'from $175';
$euro_brands    = defined('TAAS_EURO_BRANDS')    ? TAAS_EURO_BRANDS    : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Problem engines ──────────────────────────────────────────────────────────
$problem_engines = [
    ['make' => 'Volkswagen / Audi', 'engines' => 'TSI 1.4, TSI 1.8, TSI 2.0', 'note' => 'Early TSI engines (2008–2013) are known for timing chain tensioner failure and chain stretch. Rattling on cold start is the first sign. Later revisions improved the design but the original engines remain problematic.'],
    ['make' => 'Nissan', 'engines' => 'HR16DE, QR25DE, MR20DD', 'note' => 'The HR16DE in Tiida, Note, and Juke models is known for chain stretch and guide wear. The QR25 in X-Trail and Altima also develops chain noise with age. Oil change history is the biggest factor.'],
    ['make' => 'Ford', 'engines' => 'EcoBoost 1.0L, EcoBoost 2.0L', 'note' => 'The 1.0L three-cylinder EcoBoost has a known timing belt (not chain) but the 2.0L EcoBoost uses a chain that can stretch. Low oil levels and extended service intervals accelerate wear.'],
    ['make' => 'BMW', 'engines' => 'N47 diesel, N20 petrol', 'note' => 'The N47 diesel is notorious for timing chain failure — the chain is at the rear of the engine, making replacement extremely labour-intensive. The N20 petrol also develops chain stretch. Both require specialist diagnosis.'],
    ['make' => 'Hyundai / Kia', 'engines' => 'Theta II 2.0/2.4', 'note' => 'Theta II engines in Tucson, Sportage, Sonata, and Optima are known for timing chain and bearing issues, often linked to oil starvation from manufacturing debris. Proactive inspection is recommended.'],
];

// ── FAQs (10) ────────────────────────────────────────────────────────────────
$faqs = [
    ['q' => 'How much does a timing chain replacement cost in Manukau?', 'a' => 'Timing chain replacement is one of the more expensive engine repairs because of the labour involved in accessing the chain — particularly on European vehicles where the chain can be at the rear of the engine. Costs vary widely by make, model, and the extent of the work required. We always provide an estimate after diagnosis before starting any work. Call us on ' . $phone_free . ' with your vehicle details.'],
    ['q' => 'How do I know if my car has a timing belt or a timing chain?', 'a' => 'Your vehicle has one or the other — never both. Generally, if your service manual specifies a timing belt replacement interval (e.g. 100,000 km), you have a belt. If it does not, you likely have a chain. However, the only certain way is to check for your specific engine. Call us on ' . $phone_free . ' with your make, model, year, and engine size and we will confirm which your vehicle has.'],
    ['q' => 'My engine rattles on cold start — is that the timing chain?', 'a' => 'A rattle on cold start that fades after a few seconds is the most common symptom of a worn timing chain tensioner. The tensioner relies on oil pressure to maintain chain tension — when the engine is cold and oil pressure has not yet built up, the chain has slack and rattles against the guides. This will get progressively worse and should be inspected before the chain jumps a tooth or snaps.'],
    ['q' => 'Can a stretched timing chain be fixed without full replacement?', 'a' => 'In some cases, replacing just the tensioner and guides can resolve the noise and restore correct tension. However, if the chain itself has stretched beyond specification, it must be replaced — a new tensioner cannot compensate for a stretched chain. We measure chain stretch during diagnosis and advise whether a tensioner-only repair or full chain replacement is required.'],
    ['q' => 'Will regular oil changes prevent timing chain problems?', 'a' => 'Regular oil changes with the correct specification oil are the single most effective way to prevent timing chain problems. The chain, tensioner, and guides all run in engine oil — clean oil maintains hydraulic pressure in the tensioner and reduces wear on the chain and guides. The vehicles we see most often for chain failures almost always have poor oil change history.'],
    ['q' => 'Is it safe to drive with a timing chain noise?', 'a' => 'A mild rattle on cold start that clears within seconds is not immediately dangerous — but it will get worse. A persistent rattle, rough running, or engine management light means the chain has stretched significantly and could jump a tooth or snap. On an interference engine, a snapped chain causes the same catastrophic damage as a snapped cambelt — pistons hit valves. Do not ignore timing chain noise. Call us on ' . $phone_free . '.'],
    ['q' => 'What is the difference between a timing chain and a timing belt?', 'a' => 'A timing belt is made of reinforced rubber with a fixed replacement interval — typically 60,000 to 150,000 km. A timing chain is made of metal and is designed to last the life of the engine — but only if oil changes are maintained. Chains do not have a fixed replacement interval, but they are not maintenance-free. We service both at our <a href="' . $site_url . '/cambelts-and-water-pumps/">cambelts and water pumps</a> workshop.'],
    ['q' => 'Do you work on European vehicle timing chains?', 'a' => 'Yes. Our <a href="' . $site_url . '/european/">TAAS European division</a> covers ' . $euro_brands . '. European timing chain work is often more complex — the BMW N47 chain is at the rear of the engine, VW TSI chains require significant dismantling. We have the tools and experience for these jobs.'],
    ['q' => 'Do you offer finance for timing chain replacement?', 'a' => 'Yes — Afterpay, Q Card, GEM Finance, and Aotea Finance accepted. Timing chain work can be expensive, particularly on European vehicles — finance means you can get it done now rather than risk further damage. Visit our <a href="' . $site_url . '/finance-options/">finance page</a> or ask when you call.'],
    ['q' => 'Where is your workshop?', 'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $hours . '. Call ' . $phone_free . ' to book a diagnostic. We service all South Auckland suburbs.'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq['a'])]]; }
$schema = ['@context' => 'https://schema.org', '@graph' => [
    ['@type' => 'BreadcrumbList', 'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],
        ['@type'=>'ListItem','position'=>2,'name'=>'Services','item'=>$site_url.'/services/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Timing Chain Service','item'=>$page_url],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'Timing chain inspection, diagnosis, and replacement in Manukau, South Auckland. Chain stretch assessment, tensioner replacement, full chain kits. All makes including European. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'MTA New Zealand']],
    ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>
<style>
.page-template-template-timing-chain .site-content,.page-template-template-timing-chain .entry-content,.page-template-template-timing-chain .entry-header,.page-template-template-timing-chain article,.page-template-template-timing-chain #primary,.page-template-template-timing-chain #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-timing-chain{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}

.tcs-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tcs-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;}
.tcs-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.07) 0%,transparent 65%);pointer-events:none;}
.tcs-hero__inner{display:grid;grid-template-columns:1fr 280px;gap:48px;align-items:start;}
.tcs-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.tcs-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.tcs-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.tcs-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.tcs-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tcs-hero__sub{font-size:16px;color:#aaa;max-width:560px;margin:0 0 20px;line-height:1.65;}
.tcs-hero__signal{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:10px 18px;font-size:14px;font-weight:600;color:var(--taas-yellow,#FFC800);margin-bottom:24px;}
.tcs-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.tcs-hero__urgency{margin-top:24px;background:rgba(192,57,43,.12);border:1px solid rgba(192,57,43,.35);border-left:4px solid var(--taas-alert,#C0392B);border-radius:var(--taas-radius,6px);padding:14px 18px;font-size:14px;color:#f5a0a0;line-height:1.6;max-width:580px;}
.tcs-hero__urgency strong{color:#ff6b6b;}
.tcs-sidebar{background:#1e1e1e;border:1px solid #333;border-radius:var(--taas-radius,6px);padding:24px;}
.tcs-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.tcs-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.tcs-sidebar__list li{font-size:13px;color:#ccc;padding-left:18px;position:relative;line-height:1.4;}
.tcs-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.tcs-sidebar hr{border:none;border-top:1px solid #333;margin:0 0 16px;}
.tcs-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;}
.tcs-sidebar__phone:hover{color:#fff;}
.tcs-sidebar__detail{font-size:12px;color:#666;line-height:1.6;}
.tcs-trust{background:var(--taas-yellow,#FFC800);padding:var(--taas-trust-pad,18px) 0;}
.tcs-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.tcs-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.tcs-trust__item::before{content:'✓';font-weight:900;}
.tcs-section{padding:var(--taas-sec-pad,72px) 0;}
.tcs-section--white{background:var(--taas-white,#fff);}
.tcs-section--grey{background:var(--taas-panel,#F7F7F5);}
.tcs-section--dark{background:var(--taas-dark,#1A1A1A);}
.tcs-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.tcs-h2--white{color:var(--taas-white,#fff);}
.tcs-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.65;}
.tcs-section--dark .tcs-lead{color:#aaa;}
.tcs-engine-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:28px;}
.tcs-engine-card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;border-top:3px solid var(--taas-yellow,#FFC800);}
.tcs-engine-card__make{font-size:16px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}
.tcs-engine-card__engines{font-size:13px;font-weight:600;color:var(--taas-yellow2,#e6b400);margin-bottom:8px;}
.tcs-engine-card__note{font-size:14px;color:var(--taas-mid,#666);line-height:1.6;}
.tcs-signs{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;}
.tcs-signs li{display:flex;align-items:flex-start;gap:14px;padding:14px 0;border-bottom:1px solid #2a2a2a;font-size:15px;color:#ccc;line-height:1.5;}
.tcs-signs li:last-child{border-bottom:none;}
.tcs-signs li::before{content:'!';color:#fff;background:var(--taas-alert,#C0392B);font-size:10px;font-weight:900;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.tcs-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}
.tcs-step{display:flex;align-items:flex-start;gap:16px;padding:16px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tcs-step:last-child{border-bottom:none;}
.tcs-step__num{width:32px;height:32px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.tcs-step__text{font-size:15px;color:var(--taas-body,#333);line-height:1.5;}
.tcs-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tcs-enquiry__form{background:var(--taas-panel,#F7F7F5);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;}
.tcs-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:20px;}
.tcs-enquiry__form .wpcf7-form label,.tcs-enquiry__form .wpcf7-form p{color:var(--taas-body,#333)!important;font-size:13px;font-weight:600;}
.tcs-enquiry__form .wpcf7-form input[type="text"],.tcs-enquiry__form .wpcf7-form input[type="email"],.tcs-enquiry__form .wpcf7-form input[type="tel"],.tcs-enquiry__form .wpcf7-form textarea,.tcs-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}
.tcs-enquiry__form .wpcf7-form input:focus,.tcs-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}
.tcs-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}
.tcs-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.tcs-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.tcs-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.tcs-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.tcs-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}
.tcs-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tcs-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.tcs-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.tcs-faq__item--open .tcs-faq__q::after{content:'−';}
.tcs-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.7;}
.tcs-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.tcs-faq__a a:hover{text-decoration:underline;}
.tcs-faq__item--open .tcs-faq__a{display:block;}
.tcs-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.tcs-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.tcs-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.tcs-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.tcs-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

@media(max-width:960px){.tcs-hero__inner,.tcs-enquiry{grid-template-columns:1fr;}.tcs-sidebar{display:none;}.tcs-engine-grid{grid-template-columns:1fr;}}
@media(max-width:640px){.tcs-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.tcs-hero h1{font-size:clamp(28px,7vw,42px);}.tcs-section{padding:var(--taas-sec-pad-m,48px) 0;}.tcs-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.tcs-trust__item{font-size:12px;}.tcs-faq__q{font-size:14px;padding:16px 32px 16px 0;}.tcs-faq__a{font-size:13px;}.tcs-hero__ctas{flex-direction:column;align-items:stretch;}.tcs-hero__ctas .tcs-btn{justify-content:center;text-align:center;}}
</style>

<!-- ── HERO ────────────────────────────────────────────────────────────────── -->
<section class="tcs-hero"><div class="tcs-w"><div class="tcs-hero__inner">
  <div>
    <nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url); ?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/services/'); ?>" style="color:#555;text-decoration:none;">Services</a><span style="margin:0 6px;">›</span><span style="color:#888;">Timing Chain Service</span></nav>
    <span class="tcs-eye tcs-eye--yellow">Timing Chain Service — Manukau</span>
    <h1>Timing Chain<br><span>Service &amp; Replacement</span></h1>
    <p class="tcs-hero__sub">Chain stretch assessment, tensioner replacement, and full timing chain kits. Diagnosed properly before parts are recommended. All makes and models including European. <?php echo esc_html($years); ?> years of workshop experience.</p>
    <div class="tcs-hero__signal">Estimate after diagnosis · Chain stretch measured · All makes including European</div>
    <div class="tcs-hero__ctas">
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tcs-btn tcs-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
      <a href="#tcs-enquire" class="tcs-btn tcs-btn--outline">Book a Diagnostic</a>
    </div>
    <div class="tcs-hero__urgency"><strong>⚠ Do not ignore timing chain noise.</strong> A stretched or failing timing chain can cause engine damage as serious as a snapped cambelt. If you hear a rattling noise on cold start, have a rough idle, or your engine management light is on — get it inspected.</div>
  </div>
  <div class="tcs-sidebar">
    <div class="tcs-sidebar__title">What We Check</div>
    <ul class="tcs-sidebar__list">
      <li>Chain stretch measurement</li><li>Tensioner condition &amp; pressure</li><li>Guide &amp; rail condition</li><li>Oil condition &amp; pressure</li><li>Engine management codes</li><li>Camshaft position correlation</li><li>Full replacement where required</li><li>All makes including European</li>
    </ul>
    <hr>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tcs-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="tcs-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
  </div>
</div></div></section>

<div class="tcs-trust" role="list"><div class="tcs-trust__inner"><div class="tcs-trust__item" role="listitem">MTA Assured</div><div class="tcs-trust__item" role="listitem">NZTA Authorised</div><div class="tcs-trust__item" role="listitem">Diagnosis Before Parts</div><div class="tcs-trust__item" role="listitem">Estimate Before Work</div><div class="tcs-trust__item" role="listitem"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="tcs-trust__item" role="listitem">Since <?php echo esc_html($established); ?></div></div></div>

<!-- ── WHAT IS A TIMING CHAIN ── White ─────────────────────────────────────── -->
<section class="tcs-section tcs-section--white"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Understanding Timing Chains</span>
  <h2 class="tcs-h2">What Is a Timing Chain — and Why Does It Fail?</h2>
  <div style="max-width:780px;font-size:16px;color:var(--taas-mid);line-height:1.75;">
    <p style="margin-bottom:20px;">A timing chain does the same job as a cambelt — it connects the crankshaft to the camshaft and ensures the engine's valves open and close at exactly the right time relative to the pistons. The difference is material: a cambelt is reinforced rubber with a fixed replacement interval; a timing chain is metal and is designed to last the life of the engine.</p>
    <p style="margin-bottom:20px;">In practice, "designed to last" and "actually lasts" are two different things. Timing chains stretch. Tensioners lose pressure. Guides crack and wear. And the single biggest cause of all three is the same thing: poor oil change history.</p>

    <h3 style="font-size:18px;font-weight:700;color:var(--taas-black);margin:32px 0 12px;">The Oil Change Connection</h3>
    <p style="margin-bottom:20px;">A timing chain runs in engine oil. The hydraulic tensioner that keeps the chain taut relies on oil pressure to function. The plastic or metal guides that prevent the chain from slapping against the engine block are lubricated by oil. When oil changes are skipped or extended, sludge builds up — the tensioner loses hydraulic pressure, the chain wears faster against dirty guides, and stretch accelerates. The vehicles we see most often for timing chain failure almost always have one thing in common: irregular oil change history.</p>

    <div style="background:rgba(255,200,0,.06);border-left:4px solid var(--taas-yellow);border-radius:0 var(--taas-radius) var(--taas-radius) 0;padding:16px 20px;margin-bottom:28px;">
      <p style="font-size:14px;color:var(--taas-body);line-height:1.65;margin:0;"><strong style="color:var(--taas-dark);">The key point:</strong> Regular oil changes with the correct specification oil are the single most effective way to prevent timing chain problems. If you have kept up with your oil changes, your chain is likely fine. If you have not — or you do not know the vehicle's service history — a timing chain inspection is worthwhile.</p>
    </div>

    <h3 style="font-size:18px;font-weight:700;color:var(--taas-black);margin:32px 0 12px;">How Chain Stretch Progresses</h3>
    <p style="margin-bottom:20px;">Chain stretch does not happen suddenly. It starts with a slight rattle on cold start — the tensioner has lost enough pressure overnight that the chain has slack for a few seconds until oil pressure builds. This stage is fixable with a tensioner replacement. If ignored, the chain stretches further — the rattle lasts longer, the engine management light comes on (camshaft position codes), and performance drops. Eventually the chain can jump a tooth — causing immediate timing damage — or snap entirely, with the same catastrophic result as a snapped cambelt on an interference engine.</p>
    <p style="margin-bottom:0;">The window between "mild rattle on cold start" and "chain jumped a tooth" can be months or it can be weeks. Do not wait to find out which. Call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow2);font-weight:600;"><?php echo esc_html($phone_free); ?></a> if you are hearing timing chain noise.</p>
  </div>
</div></section>

<!-- ── PROBLEM ENGINES ── Grey ─────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--grey"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Known Problem Engines</span>
  <h2 class="tcs-h2">Vehicles Known for Timing Chain Problems</h2>
  <p class="tcs-lead">Some engines are significantly more prone to timing chain issues than others. If you own one of these vehicles, proactive inspection is worthwhile — especially if the oil change history is unknown.</p>
  <div class="tcs-engine-grid"><?php foreach ($problem_engines as $pe): ?>
    <div class="tcs-engine-card">
      <div class="tcs-engine-card__make"><?php echo esc_html($pe['make']); ?></div>
      <div class="tcs-engine-card__engines"><?php echo esc_html($pe['engines']); ?></div>
      <p class="tcs-engine-card__note"><?php echo esc_html($pe['note']); ?></p>
    </div>
  <?php endforeach; ?></div>
  <p style="margin-top:24px;font-size:14px;color:var(--taas-mid);">Not sure if your vehicle is affected? Call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow2);font-weight:600;"><?php echo esc_html($phone_free); ?></a> with your make, model, year, and engine size.</p>
</div></section>

<!-- ── WARNING SIGNS ── Dark ───────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--dark"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--yellow">Warning Signs</span>
  <h2 class="tcs-h2 tcs-h2--white">Signs Your Timing Chain Needs Attention</h2>
  <p style="font-size:15px;color:#888;line-height:1.6;margin-bottom:24px;">If your vehicle is showing any of these symptoms, get it inspected before the chain jumps or snaps.</p>
  <ul class="tcs-signs">
    <li>Rattling noise from the engine on cold start — the most common early symptom of a worn tensioner or stretched chain</li>
    <li>Rattle that persists longer each time — chain stretch is progressing</li>
    <li>Engine management light — timing chain stretch triggers camshaft position sensor codes</li>
    <li>Rough idle that improves as the engine warms up</li>
    <li>Reduced performance or fuel economy</li>
    <li>In severe cases: engine misfiring, chain jumping a tooth, or complete chain failure causing catastrophic engine damage</li>
  </ul>
  <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tcs-btn tcs-btn--primary" style="margin-top:24px;">Call <?php echo esc_html($phone_free); ?> — Describe Your Symptoms</a>
</div></section>

<!-- ── PROCESS ── White ────────────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--white"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Our Process</span>
  <h2 class="tcs-h2">How We Diagnose and Repair Timing Chains</h2>
  <p class="tcs-lead">We do not guess. Every timing chain job follows a structured diagnostic process — so you get an accurate assessment and a repair that lasts.</p>
  <div class="tcs-steps"><?php foreach ([
    'Electronic fault code scan — read engine management codes related to timing and camshaft position',
    'Oil condition inspection — old or degraded oil is a primary cause of chain wear',
    'Physical inspection — check chain slack, tensioner condition, and guide condition where accessible',
    'Assess severity — determine whether tensioner replacement or full chain replacement is required',
    'Estimate provided — full cost confirmed before any work begins',
    'Oil change carried out first where required — clean oil before the engine runs post-repair',
    'Timing chain and tensioner replacement — full kit where required, including guides and rails',
    'Engine management codes cleared, timing verified, and vehicle road tested',
  ] as $i => $step): ?>
    <div class="tcs-step"><div class="tcs-step__num"><?php echo $i+1; ?></div><div class="tcs-step__text"><?php echo esc_html($step); ?></div></div>
  <?php endforeach; ?></div>
  <div style="margin-top:28px;border-left:4px solid var(--taas-yellow);background:#fffbea;padding:16px 20px;border-radius:0 var(--taas-radius) var(--taas-radius) 0;max-width:780px;">
    <p style="font-size:14px;color:var(--taas-body);line-height:1.6;margin:0;"><strong>Diagnostic scan <?php echo esc_html($scan_price); ?> · Full mechanical diagnosis <?php echo esc_html($mech_diag); ?>.</strong> The diagnostic fee applies to the final invoice if you proceed with the repair.</p>
  </div>
</div></section>

<!-- ── ENQUIRY ── Grey ─────────────────────────────────────────────────────── -->
<section id="tcs-enquire" class="tcs-section tcs-section--grey"><div class="tcs-w"><div class="tcs-enquiry">
  <div>
    <span class="tcs-eye tcs-eye--dark">Book a Diagnostic</span>
    <h2 class="tcs-h2">Timing Chain <span style="color:var(--taas-yellow2);">Inspection</span></h2>
    <p style="font-size:16px;color:var(--taas-mid);line-height:1.6;margin-bottom:16px;">Tell us your vehicle make, model, and what you are hearing. We will advise whether it needs immediate attention.</p>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin-bottom:6px;"><?php echo esc_html($phone_free); ?></a>
    <p style="font-size:15px;color:var(--taas-mid);line-height:1.7;"><strong style="color:var(--taas-black);"><?php echo esc_html($phone_local); ?></strong><br><?php echo esc_html($hours); ?><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a></p>
    <p style="margin-top:20px;font-size:14px;color:var(--taas-body);line-height:1.6;"><strong>Finance available:</strong> Afterpay, Q Card, GEM Finance, Aotea Finance. <a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="color:var(--taas-yellow2);font-weight:600;">View finance options →</a></p>
  </div>
  <div class="tcs-enquiry__form">
    <div class="tcs-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;color:var(--taas-mid);">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-black);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="font-weight:700;color:var(--taas-black);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ── REVIEWS ── White ────────────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--white"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Customer Reviews</span>
  <h2 class="tcs-h2"><?php echo esc_html($rating); ?> Stars · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- ── RELATED ── Grey ─────────────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--grey"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Related Services</span>
  <h2 class="tcs-h2">Timing Chain Work Connects To</h2>
  <div class="tcs-related__grid"><?php foreach ([
    ['label'=>'Cambelts & Water Pumps','url'=>'/cambelts-and-water-pumps/'],
    ['label'=>'Engine Repairs','url'=>'/engine-repairs/'],
    ['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],
    ['label'=>'Cooling System','url'=>'/cooling-system/'],
    ['label'=>'TAAS European','url'=>'/european/'],
    ['label'=>'Finance Options','url'=>'/finance-options/'],
  ] as $r): ?><a href="<?php echo esc_url($site_url.$r['url']); ?>" class="tcs-related__link"><?php echo esc_html($r['label']); ?><span style="color:var(--taas-yellow);font-size:18px;">→</span></a><?php endforeach; ?></div>
</div></section>

<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="tcs-section tcs-section--white"><div class="tcs-w">
  <span class="tcs-eye tcs-eye--dark">Common Questions</span>
  <h2 class="tcs-h2">Timing Chain Service — FAQ</h2>
  <div class="tcs-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="tcs-faq__item<?php echo $i===0?' tcs-faq__item--open':''; ?>"><button class="tcs-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="tcs-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="tcs-a-<?php echo $i; ?>" class="tcs-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<script>
(function(){document.querySelectorAll('.tcs-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.tcs-faq__item');var wasOpen=item.classList.contains('tcs-faq__item--open');document.querySelectorAll('.tcs-faq__item--open').forEach(function(el){el.classList.remove('tcs-faq__item--open');el.querySelector('.tcs-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('tcs-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
