<?php
/**
 * Template Name: Disc Skimming Hub
 * Template Post Type: page
 * URL: /disc-skimming/
 *
 * Tony Allen Auto Service — taas.co.nz
 * On-site disc skimming / brake rotor machining.
 * CSS namespace: .dsk (disc skimming)
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

$site_url=get_site_url();$page_url=get_permalink();
$phone_local=defined('TAAS_PHONE_LOCAL')?TAAS_PHONE_LOCAL:'09 278 9556';$phone_free=defined('TAAS_PHONE_FREE')?TAAS_PHONE_FREE:'0800 100 876';
$email=defined('TAAS_EMAIL')?TAAS_EMAIL:'enquiries@taas.co.nz';$hours=defined('TAAS_HOURS')?TAAS_HOURS:'Monday\xe2\x80\x93Friday 7:30am\xe2\x80\x935:00pm';
$established=defined('TAAS_ESTABLISHED')?TAAS_ESTABLISHED:'1985';$rating=defined('TAAS_RATING')?TAAS_RATING:'4.2';$reviews=defined('TAAS_REVIEWS')?TAAS_REVIEWS:'200+';
$reviews_widget=defined('TAAS_REVIEWS_WIDGET')?TAAS_REVIEWS_WIDGET:'';$cf7_general=defined('TAAS_CF7_GENERAL')?TAAS_CF7_GENERAL:'';
$ms_number=defined('TAAS_MS_NUMBER')?TAAS_MS_NUMBER:'MS 13890';$customers=defined('TAAS_CUSTOMERS')?TAAS_CUSTOMERS:'10,000+';
$division_count = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$finance_list    = defined('TAAS_FINANCE_LIST')   ? TAAS_FINANCE_LIST   : 'Afterpay, Q Card, GEM, Aotea Finance';
$mbi_list        = defined('TAAS_MBI_LIST')       ? TAAS_MBI_LIST       : 'Autosure, Assurant, Provident, Janssen, Autolife';
$phone_free_tel=preg_replace('/[^0-9+]/','',$phone_free);$years=date('Y')-intval($established);
$maps_url='https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$hero_img = defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

$faqs = [
    $taas_faqs['ds_what_is'],
    $taas_faqs['ds_skim_vs_replace'],
    $taas_faqs['ds_cost'],
    $taas_faqs['ds_onsite'],
    $taas_faqs['ds_new_pads'],
    $taas_faqs['ds_rotor_types'],
    $taas_faqs['ds_duration'],
    $taas_faqs['ds_finance'],
    $taas_faqs['ds_location'],
    $taas_faqs['ds_better_than_new'],
];

$schema_faqs=[];foreach($faqs as $faq){$schema_faqs[]=['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>strip_tags($faq['a'])]];}
$schema=['@context'=>'https://schema.org','@graph'=>[
['@type'=>'BreadcrumbList','itemListElement'=>[['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url],['@type'=>'ListItem','position'=>2,'name'=>'Manukau Brake & Clutch','item'=>$site_url.'/manukau-brake-clutch/'],['@type'=>'ListItem','position'=>3,'name'=>'Disc Skimming','item'=>$page_url]]],
['@type'=>['AutoRepair','LocalBusiness'],'@id'=>$site_url.'/#organization','name'=>'Tony Allen Auto Service','url'=>$site_url,'description'=>'On-site brake disc skimming in Manukau, South Auckland. Rotor resurfacing removes grooves and scoring. Paired with new pads for correct bedding. MTA Assured. NZTA Authorised. Established '.$established.'.','telephone'=>[$phone_free,$phone_local],'email'=>$email,'foundingDate'=>'1985-10','address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],'openingHoursSpecification'=>[['@type'=>'OpeningHoursSpecification','dayOfWeek'=>['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens'=>'07:30','closes'=>'17:00']],'aggregateRating'=>['@type'=>'AggregateRating','ratingValue'=>$rating,'reviewCount'=>preg_replace('/\\D+/','',$reviews),'bestRating'=>'5'],'priceRange'=>'$$','areaServed'=>'South Auckland','sameAs'=>['https://www.facebook.com/tonyallenautoservice/','https://www.instagram.com/tonyallenautoservice/','https://www.linkedin.com/company/7059060'],'memberOf'=>['@type'=>'Organization','name'=>'Motor Trade Association (MTA)'],'paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, Gem Finance, Aotea Finance'],
['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
['@type'=>'SpeakableSpecification','cssSelector'=>['.dsk-hero__sub','.dsk-faq__a:first-of-type']],
]];

get_header();
echo '<script type="application/ld+json">'.wp_json_encode($schema,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
?>

<style>
.page-template-template-disc-skimming-hub .site-content,.page-template-template-disc-skimming-hub .entry-content,.page-template-template-disc-skimming-hub .entry-header,.page-template-template-disc-skimming-hub article,.page-template-template-disc-skimming-hub #primary,.page-template-template-disc-skimming-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-disc-skimming-hub{overflow-x:hidden;-webkit-text-size-adjust:100%;text-size-adjust:100%;font-weight:300;}
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif)!important;}
.dsk-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}.dsk-hero{background:var(--taas-black,#111);padding:72px 0 60px;position:relative;overflow:hidden;text-align:center;}.dsk-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 60% at 50% 40%,rgba(255,200,0,.07) 0%,transparent 60%);pointer-events:none;}.dsk-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}.dsk-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}.dsk-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}.dsk-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 auto 16px;max-width:700px;}.dsk-hero h1 span{color:var(--taas-yellow,#FFC800);}.dsk-hero__sub{font-size:16px;color:#aaa;max-width:600px;margin:0 auto 24px;line-height:1.75;}.dsk-hero__ctas{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.dsk-phonestrip{background:var(--taas-yellow,#FFC800);}.dsk-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}.dsk-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}.dsk-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}.dsk-phonestrip__num:hover{opacity:.65;}
.dsk-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);padding:var(--taas-trust-pad,18px) 0;}.dsk-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}.dsk-trust__item{font-size:var(--taas-trust-size,14px);font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}.dsk-trust__item::before{content:'✓';font-weight:900;}
.dsk-section{padding:var(--taas-sec-pad,72px) 0;}.dsk-section--white{background:var(--taas-white,#fff);}.dsk-section--grey{background:var(--taas-panel,#F7F7F5);}.dsk-section--dark{background:var(--taas-dark,#1A1A1A);}.dsk-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}.dsk-h2--white{color:var(--taas-white,#fff);}.dsk-lead{font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 32px;line-height:1.75;}.dsk-content{max-width:780px;font-size:16px;color:var(--taas-body,#333);line-height:1.75;}.dsk-content p{margin-bottom:16px;}
.dsk-steps{display:flex;flex-direction:column;gap:0;max-width:780px;}.dsk-step{display:flex;align-items:flex-start;gap:16px;padding:18px 0;border-bottom:1px solid var(--taas-border,#E8E8E4);}.dsk-step:last-child{border-bottom:none;}.dsk-step__num{width:34px;height:34px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-size:14px;font-weight:800;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}.dsk-step__body{flex:1;}.dsk-step__title{font-size:15px;font-weight:700;color:var(--taas-black,#111);margin-bottom:4px;}.dsk-step__text{font-size:14px;color:var(--taas-mid,#666);line-height:1.75;}
.dsk-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}.dsk-enquiry__form{background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:32px;}.dsk-enquiry__form-title{font-size:16px;font-weight:700;color:var(--taas-yellow,#FFC800);margin-bottom:20px;}.dsk-enquiry__form .wpcf7-form label,.dsk-enquiry__form .wpcf7-form p{color:#ccc!important;font-size:13px;font-weight:600;}.dsk-enquiry__form .wpcf7-form input[type="text"],.dsk-enquiry__form .wpcf7-form input[type="email"],.dsk-enquiry__form .wpcf7-form input[type="tel"],.dsk-enquiry__form .wpcf7-form textarea,.dsk-enquiry__form .wpcf7-form select{background:var(--taas-white,#fff);border:1px solid #555;border-radius:var(--taas-radius,6px);padding:12px 14px;font-size:15px;color:var(--taas-black,#111);width:100%;box-sizing:border-box;}.dsk-enquiry__form .wpcf7-form input:focus,.dsk-enquiry__form .wpcf7-form textarea:focus{border-color:var(--taas-yellow,#FFC800);outline:none;}.dsk-enquiry__form .wpcf7-form input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;transition:background .15s;}.dsk-enquiry__form .wpcf7-form input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}
.dsk-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}.dsk-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}.dsk-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.dsk-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;max-width:780px;}.dsk-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}.dsk-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-faq-q,15px);font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}.dsk-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}.dsk-faq__item--open .dsk-faq__q::after{content:'−';}.dsk-faq__a{display:none;padding:0 0 18px;font-size:var(--taas-faq-a,15px);color:var(--taas-mid,#666);line-height:1.75;}.dsk-faq__item--open .dsk-faq__a{display:block;}
.dsk-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}.dsk-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}.dsk-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}.dsk-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}.dsk-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
@media(max-width:960px){.dsk-enquiry{grid-template-columns:1fr;}}
@media(max-width:640px){.dsk-phonestrip__num{font-size:17px;}.dsk-enquiry{display:flex;flex-direction:column-reverse;}.dsk-hero{padding:var(--taas-sec-pad-m,48px) 0 40px;}.dsk-hero h1{font-size:clamp(26px,7vw,38px);}.dsk-section{padding:var(--taas-sec-pad-m,48px) 0;}.dsk-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.dsk-trust__item{font-size:12px;}.dsk-faq__q{font-size:14px;padding:16px 32px 16px 0;}.dsk-faq__a{font-size:13px;}.dsk-hero__ctas{flex-direction:column;align-items:stretch;}.dsk-hero__ctas .dsk-btn{justify-content:center;text-align:center;}}
</style>

<section class="dsk-hero"<?php if ($hero_bg) echo ' style="'.$hero_bg.'"'; ?>><div class="dsk-w">
<nav style="font-size:13px;color:#555;margin-bottom:20px;" aria-label="Breadcrumb"><a href="<?php echo esc_url($site_url);?>" style="color:#555;text-decoration:none;">Home</a><span style="margin:0 6px;">›</span><a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/');?>" style="color:#555;text-decoration:none;">Manukau Brake & Clutch</a><span style="margin:0 6px;">›</span><span style="color:#888;">Disc Skimming</span></nav>
<span class="dsk-eye dsk-eye--yellow">Disc Skimming — Manukau</span>
<h1>Brake Disc Skimming<br><span>On-Site in Manukau</span></h1>
<p class="dsk-hero__sub">Brake rotor resurfacing done on-site at our Manukau workshop. Removes grooves, scoring, and minor warping. Paired with new pads for correct bedding and even braking. <?php echo esc_html($years);?> years of workshop experience.</p>
<div class="dsk-hero__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel);?>" class="dsk-btn dsk-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free);?></a><a href="#dsk-enquire" class="dsk-btn dsk-btn--outline">Book Online</a></div>
</div></section>

<div class="dsk-phonestrip"><div class="dsk-phonestrip__inner"><span class="dsk-phonestrip__label">Need your rotors skimmed?</span><a href="tel:<?php echo esc_attr($phone_free_tel);?>" class="dsk-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free);?></a></div></div>
<div class="dsk-trust" role="list"><div class="dsk-trust__inner"><div class="dsk-trust__item" role="listitem">MTA Assured</div><div class="dsk-trust__item" role="listitem">On-Site Machining</div><div class="dsk-trust__item" role="listitem">Same-Day Service</div><div class="dsk-trust__item" role="listitem">All Makes &amp; Models</div><div class="dsk-trust__item" role="listitem"><?php echo esc_html($rating);?>★ · <?php echo esc_html($reviews);?> Reviews</div></div></div>

<section class="dsk-section dsk-section--white"><div class="dsk-w">
<span class="dsk-eye dsk-eye--dark">Understanding Disc Skimming</span>
<h2 class="dsk-h2">What Is Disc Skimming and Why Does It Matter?</h2>
<div class="dsk-content">
<p>Every time you brake, the pads grip the rotor surface. Over thousands of stops, that surface develops grooves — a physical impression of the old pad material worn into the metal. When you fit new pads to a grooved rotor, the new pads cannot make full contact. They ride on the high points between the grooves, overheat at the contact spots, wear unevenly, and squeal.</p>
<p>Disc skimming removes a thin, precise layer from the rotor surface using a lathe. The result is a flat, smooth finish — as close to new as a used rotor can get. New pads bed into a skimmed rotor evenly, wear correctly, and deliver consistent stopping power without noise or vibration.</p>
<p>Not every rotor can be skimmed. If the rotor is below minimum thickness or has cracks, it must be replaced. We measure every rotor before and after machining to confirm it meets specification.</p>
</div>
</div></section>

<section class="dsk-section dsk-section--grey"><div class="dsk-w">
<span class="dsk-eye dsk-eye--dark">Our Process</span>
<h2 class="dsk-h2">How We Skim Your Rotors</h2>
<div class="dsk-steps">
<div class="dsk-step"><div class="dsk-step__num">1</div><div class="dsk-step__body"><div class="dsk-step__title">Measure</div><div class="dsk-step__text">Rotor thickness measured with a micrometer. Compared to minimum specification for your vehicle. If below minimum — replacement, not skimming.</div></div></div>
<div class="dsk-step"><div class="dsk-step__num">2</div><div class="dsk-step__body"><div class="dsk-step__title">Inspect</div><div class="dsk-step__text">Check for cracks, heat spots, and runout (wobble). Cracked rotors cannot be skimmed — they must be replaced.</div></div></div>
<div class="dsk-step"><div class="dsk-step__num">3</div><div class="dsk-step__body"><div class="dsk-step__title">Skim</div><div class="dsk-step__text">Rotor mounted on the lathe and machined to a flat, true surface. Both sides cut in a single pass for parallelism.</div></div></div>
<div class="dsk-step"><div class="dsk-step__num">4</div><div class="dsk-step__body"><div class="dsk-step__title">Re-Measure</div><div class="dsk-step__text">Thickness confirmed above minimum specification after skimming. Runout checked — must be within tolerance.</div></div></div>
<div class="dsk-step"><div class="dsk-step__num">5</div><div class="dsk-step__body"><div class="dsk-step__title">Fit & Bed</div><div class="dsk-step__text">Skimmed rotors refitted with new pads. Correct bedding procedure followed — controlled stops to transfer pad material evenly.</div></div></div>
</div>
</div></section>

<div style="background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:22px 0;"><div style="max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:16px 24px;flex-wrap:wrap;text-align:center;font-family:var(--taas-font,Inter,Arial,sans-serif);"><span style="font-size:15px;font-weight:300;color:#333;"><strong style="font-weight:700;color:#111;">Split the Cost</strong> — Interest-free options available</span><span style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:center;"><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Afterpay</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Q Card</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">GEM</span><span style="display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border:1px solid #E8E8E4;border-radius:5px;font-size:11px;font-weight:700;color:#1A1A1A;">Aotea</span></span><a href="<?php echo esc_url($site_url.'/finance-options/'); ?>" style="font-size:13px;font-weight:700;color:#e6b400;text-decoration:none;white-space:nowrap;">Finance Options →</a></div></div>
<section id="dsk-enquire" class="dsk-section dsk-section--dark"><div class="dsk-w"><div class="dsk-enquiry">
<div><span class="dsk-eye dsk-eye--yellow">Book Today</span><h2 class="dsk-h2 dsk-h2--white">Disc Skimming — <span style="color:var(--taas-yellow);">Enquire Now</span></h2><a href="tel:<?php echo esc_attr($phone_free_tel);?>" style="display:block;font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow);text-decoration:none;margin:16px 0 6px;"><?php echo esc_html($phone_free);?></a><div style="font-size:15px;color:#aaa;line-height:1.75;"><strong style="color:var(--taas-white);"><?php echo esc_html($phone_local);?></strong><br><?php echo esc_html($hours);?><br><a href="<?php echo esc_url($maps_url);?>" target="_blank" rel="noopener" style="color:var(--taas-yellow);font-weight:600;">139 Cavendish Drive, Manukau</a></div></div>
<div class="dsk-enquiry__form"><div class="dsk-enquiry__form-title">Send Us Your Details</div><?php if($cf7_general):echo do_shortcode($cf7_general);else:?><p style="font-size:15px;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel);?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free);?></a> or <a href="<?php echo esc_url($site_url.'/contact-us/');?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p><?php endif;?></div>
</div></div></section>

<section class="dsk-section dsk-section--grey"><div class="dsk-w">
<span class="dsk-eye dsk-eye--dark">Related Services</span><h2 class="dsk-h2">Connected Services</h2>
<div class="dsk-related__grid"><a href="<?php echo esc_url($site_url.'/brake-repairs-manukau/');?>" class="dsk-related__link">Brake Repairs<span style="color:var(--taas-yellow);font-size:18px;">→</span></a><a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/');?>" class="dsk-related__link">Manukau Brake &amp; Clutch<span style="color:var(--taas-yellow);font-size:18px;">→</span></a><a href="<?php echo esc_url($site_url.'/wof/');?>" class="dsk-related__link">WOF Inspections<span style="color:var(--taas-yellow);font-size:18px;">→</span></a><a href="<?php echo esc_url($site_url.'/wheel-alignment-manukau/');?>" class="dsk-related__link">Wheel Alignment<span style="color:var(--taas-yellow);font-size:18px;">→</span></a><a href="<?php echo esc_url($site_url.'/vehicle-servicing/');?>" class="dsk-related__link">Vehicle Servicing<span style="color:var(--taas-yellow);font-size:18px;">→</span></a></div>
</div></section>

<section class="dsk-section dsk-section--white"><div class="dsk-w"><span class="dsk-eye dsk-eye--dark">Customer Reviews</span><h2 class="dsk-h2"><?php echo esc_html($rating);?> Stars · <?php echo esc_html($reviews);?> Google Reviews</h2><?php if($reviews_widget)echo do_shortcode($reviews_widget);?></div></section>

<section class="dsk-section dsk-section--grey"><div class="dsk-w"><span class="dsk-eye dsk-eye--dark">Common Questions</span><h2 class="dsk-h2">Disc Skimming — FAQ</h2>
<div class="dsk-faq__list"><?php foreach($faqs as $i=>$faq):?><div class="dsk-faq__item<?php echo $i===0?' dsk-faq__item--open':'';?>"><button class="dsk-faq__q" aria-expanded="<?php echo $i===0?'true':'false';?>" aria-controls="dsk-a-<?php echo $i;?>"><?php echo esc_html($faq['q']);?></button><div id="dsk-a-<?php echo $i;?>" class="dsk-faq__a"><?php echo wp_kses_post($faq['a']);?></div></div><?php endforeach;?></div>
</div></section>

<div style="background:var(--taas-panel);padding:24px 0;text-align:center;"><a href="<?php echo esc_url($site_url.'/manukau-brake-clutch/');?>" style="font-size:14px;font-weight:700;color:var(--taas-body);text-decoration:none;">← Back to Manukau Brake &amp; Clutch</a></div>

<script>(function(){document.querySelectorAll('.dsk-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.dsk-faq__item');var wasOpen=item.classList.contains('dsk-faq__item--open');document.querySelectorAll('.dsk-faq__item--open').forEach(function(el){el.classList.remove('dsk-faq__item--open');el.querySelector('.dsk-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('dsk-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());</script>
<?php get_footer(); ?>
