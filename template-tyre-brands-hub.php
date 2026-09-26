<?php
/**
 * Template Name: Tyre Brands Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /tyre-brands/
 * Lists all tyre brands with links to individual brand pages.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url   = get_site_url();
$established = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years      = date('Y') - intval($established);
$rating     = defined('TAAS_RATING')  ? TAAS_RATING  : '4.2';
$reviews    = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$customers  = defined('TAAS_CUSTOMERS') ? TAAS_CUSTOMERS : '10,000+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$phone_free_tel = preg_replace('/[^0-9+]/', '', TAAS_PHONE_FREE);
$maps_url = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

$brands = [
    ['name'=>'Maxxis',      'slug'=>'maxxis',      'origin'=>'Taiwan',     'tier'=>'Mid-Premium', 'count'=>'344', 'desc'=>'All-terrain, highway terrain, mud terrain, passenger and commercial. The backbone of our 4WD range — AT811, MT772, AT771.'],
    ['name'=>'Continental', 'slug'=>'continental', 'origin'=>'Germany',    'tier'=>'Premium',     'count'=>'241', 'desc'=>'UltraContact, SportContact, EcoContact, VanContact. Premium compound technology — wet grip, low noise, long life.'],
    ['name'=>'Goodyear',    'slug'=>'goodyear',    'origin'=>'USA',        'tier'=>'Premium',     'count'=>'308', 'desc'=>'Eagle F1, Optilife, Wrangler, Assurance. Performance, SUV and commercial — broad range across all vehicle types.'],
    ['name'=>'Rovelo',      'slug'=>'rovelo',      'origin'=>'China',      'tier'=>'Budget',      'count'=>'197', 'desc'=>'Ridgetrak AT/RT, Sport A1, RHP-780. Quality budget option — strong value for everyday driving and light off-road.'],
    ['name'=>'Hifly',       'slug'=>'hifly',       'origin'=>'China',      'tier'=>'Budget',      'count'=>'182', 'desc'=>'HF201, AT601, SUPER2000. Budget passenger, commercial and all-terrain. Good value for city commuting.'],
    ['name'=>'Vitora',      'slug'=>'vitora',      'origin'=>'China',      'tier'=>'Budget',      'count'=>'99',  'desc'=>'Citylife, Sportlife, Worklife, Countrylife. Budget range covering passenger, performance, commercial and off-road.'],
    ['name'=>'Wanli',       'slug'=>'wanli',       'origin'=>'China',      'tier'=>'Budget',      'count'=>'59',  'desc'=>'Budget passenger tyres — available in select sizes.'],
];

$faqs = [
    ['q'=>'What tyre brands do you carry?','a'=>'Maxxis, Continental, Goodyear, Hifly, Rovelo, Vitora and Wanli. Budget to premium — over 1,400 tyres in stock.'],
    ['q'=>'Which brand do you recommend?','a'=>'It depends on how you drive and what matters to you. Maxxis and Continental are our most popular for quality and value. Hifly and Rovelo are the best budget options. We recommend based on your vehicle and driving — not margin.'],
    ['q'=>'Do you carry 4WD tyre brands?','a'=>'Yes. Maxxis is our core 4WD brand — AT811, AT771, MT772, MT764 in all-terrain, highway terrain and mud terrain patterns. Goodyear Wrangler, Continental CrossContact, and budget alternatives from Hifly and Rovelo also available.'],
    ['q'=>'Is Continental better than Maxxis?','a'=>'Continental is a premium brand with advanced compound technology — excellent wet grip, low noise, and long life. Maxxis offers outstanding value in the mid-premium segment, especially for 4WDs and SUVs. Both are quality brands — the right choice depends on your priorities and budget.'],
    ['q'=>'Are budget tyres safe?','a'=>'Yes. All tyres we stock meet international safety standards. Budget tyres use simpler compounds and tread designs — they do the job for lower-mileage and city driving. They may not perform as well in extreme wet conditions or last as long as premium alternatives, but they are safe for normal driving.'],
    ['q'=>'Can I get a specific brand you do not stock?','a'=>'We can source most brands through our supplier network. Call ' . TAAS_PHONE_FREE . ' with the size and brand you need and we will check availability and pricing.'],
    ['q'=>'Do you price-match tyre retailers?','a'=>'We are not a tyre retailer — we are a workshop that supplies, fits, balances and aligns. Our pricing includes professional fitting, not just the rubber. Contact us for an estimate on your size.'],
    ['q'=>'How do I find tyres in my size?','a'=>'Use our tyre finder — enter your width, profile and rim size to see all available options across brands. Or call ' . TAAS_PHONE_FREE . ' with your tyre size or vehicle rego.'],
    ['q'=>'Do you fit tyres I have bought elsewhere?','a'=>'Yes. Bring your tyres in and we will fit, balance and align.'],
    ['q'=>'Where is your tyre shop?','a'=>'139 Cavendish Drive, Manukau, Auckland 2104. Open ' . TAAS_HOURS . '. Call ' . TAAS_PHONE_FREE . '.'],
];

$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Tyre Centre','item'=>$site_url.'/tyre-centre/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Tyre Brands','item'=>$site_url.'/tyre-brands/'],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'name'=>'Tony Allen Auto Service','url'=>$site_url,
     'telephone'=>[TAAS_PHONE_FREE,TAAS_PHONE_LOCAL],'email'=>TAAS_EMAIL,
     'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'foundingDate'=>'1985-10-01','paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
    ],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.tbh-hero h1','.tbh-section__heading','.tbh-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-tyre-brands-hub .site-content,.page-template-template-tyre-brands-hub .entry-content,.page-template-template-tyre-brands-hub .entry-header,.page-template-template-tyre-brands-hub article,.page-template-template-tyre-brands-hub #primary,.page-template-template-tyre-brands-hub #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-tyre-brands-hub{overflow-x:hidden;}

.tbh-hero{background:var(--taas-black,#111);padding:var(--taas-sec-pad,72px) 0 60px;}
.tbh-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tbh-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,11px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.tbh-hero h1{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.tbh-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tbh-hero__sub{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;max-width:600px;margin:0 0 28px;line-height:1.65;}
.tbh-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}

.tbh-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.tbh-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.tbh-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.tbh-trust__item::before{content:'✓';font-weight:900;}

.tbh-section{padding:var(--taas-sec-pad,72px) 0;}
.tbh-section--white{background:var(--taas-white,#fff);}
.tbh-section--grey{background:var(--taas-panel,#F7F7F5);}
.tbh-section--dark{background:var(--taas-dark,#1A1A1A);}
.tbh-section__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tbh-section__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.tbh-section--dark .tbh-section__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.tbh-section__heading{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;}
.tbh-section--dark .tbh-section__heading{color:var(--taas-white,#fff);}
.tbh-section__sub{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 28px;line-height:1.65;}

.tbh-brands{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:14px;}
.tbh-brand{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:28px 24px;text-decoration:none;display:flex;flex-direction:column;gap:8px;transition:box-shadow 0.2s,transform 0.2s,border-color 0.2s;border-top:3px solid transparent;}
.tbh-brand:hover{box-shadow:0 4px 16px rgba(0,0,0,0.1);transform:translateY(-2px);border-top-color:var(--taas-yellow,#FFC800);}
.tbh-brand__head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;}
.tbh-brand__name{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:20px;font-weight:800;color:var(--taas-black,#111);}
.tbh-brand__tier{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:10px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:3px 8px;border-radius:3px;white-space:nowrap;}
.tbh-brand__tier--premium{background:#111;color:#FFC800;}
.tbh-brand__tier--mid{background:#fffbea;color:#1A1A1A;border:1px solid #FFC800;}
.tbh-brand__tier--budget{background:var(--taas-panel,#F7F7F5);color:var(--taas-mid,#666);border:1px solid var(--taas-border,#E8E8E4);}
.tbh-brand__origin{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;color:var(--taas-mid,#666);}
.tbh-brand__desc{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-mid,#666);line-height:1.5;flex:1;}
.tbh-brand__foot{display:flex;justify-content:space-between;align-items:center;margin-top:auto;}
.tbh-brand__count{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;color:var(--taas-mid,#666);}
.tbh-brand__link{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;color:var(--taas-yellow2,#e6b400);}
.tbh-brand:hover .tbh-brand__link{color:var(--taas-yellow,#FFC800);}

.tbh-faq{max-width:780px;}
.tbh-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;}
.tbh-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tbh-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.tbh-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.tbh-faq__item--open .tbh-faq__q::after{content:'−';}
.tbh-faq__a{display:none;padding:0 0 18px;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-mid,#666);line-height:1.7;}
.tbh-faq__item--open .tbh-faq__a{display:block;}

.tbh-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tbh-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.tbh-enquiry__phone:hover{color:#fff;}
.tbh-enquiry__detail{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:#aaa;line-height:1.7;}
.tbh-enquiry__detail strong{color:var(--taas-white,#fff);}
.tbh-section--dark .wpcf7 label,.tbh-section--dark .wpcf7 span:not(.wpcf7-spinner),.tbh-section--dark .wpcf7 div:not(.wpcf7-response-output),.tbh-section--dark .wpcf7 p{color:#ccc!important;font-size:14px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.tbh-section--dark .wpcf7 input[type="text"],.tbh-section--dark .wpcf7 input[type="email"],.tbh-section--dark .wpcf7 input[type="tel"],.tbh-section--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.tbh-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:15px;letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}

@media(max-width:960px){.tbh-enquiry{grid-template-columns:1fr;gap:32px;}}
@media(max-width:640px){
  .tbh-hero{padding:48px 0 40px;}.tbh-hero h1{font-size:clamp(28px,7vw,42px);}.tbh-hero__sub{font-size:14px;}
  .tbh-hero__ctas{flex-direction:column;align-items:stretch;}.tbh-hero__ctas .taas-btn{justify-content:center;text-align:center;}
  .tbh-section{padding:48px 0;}.tbh-section__heading{font-size:clamp(20px,5vw,28px);}
  .tbh-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.tbh-trust__item{font-size:12px;}
  .tbh-faq__q{font-size:14px;padding:16px 32px 16px 0;}.tbh-faq__a{font-size:13px;}
  .tbh-enquiry__phone{font-size:clamp(24px,6vw,32px);}
  .tbh-brands{grid-template-columns:1fr;}
}
</style>

<section class="tbh-hero">
  <div class="tbh-hero__inner">
    <span class="tbh-hero__eyebrow">Tyre Centre — Manukau</span>
    <h1>Tyre Brands<br><span>We Carry</span></h1>
    <p class="tbh-hero__sub">Budget to premium. 7 brands, over 1,400 tyres in stock. Fitted, balanced and aligned on-site at 139 Cavendish Drive, Manukau. We recommend based on your vehicle and driving style — not margin.</p>
    <div class="tbh-hero__ctas">
      <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>" class="taas-btn taas-btn--primary">Search by Size</a>
      <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="taas-btn taas-btn--outline"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
    </div>
  </div>
</section>

<div class="tbh-trust">
  <div class="tbh-trust__inner">
    <div class="tbh-trust__item">MTA Assured</div>
    <div class="tbh-trust__item">NZTA Authorised</div>
    <div class="tbh-trust__item">7 Brands in Stock</div>
    <div class="tbh-trust__item">Estimate Before We Start</div>
    <div class="tbh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  </div>
</div>

<section class="tbh-section tbh-section--white">
  <div class="tbh-section__inner">
    <span class="tbh-section__eyebrow">Our Brands</span>
    <h2 class="tbh-section__heading">Tyre Brands — Budget to Premium</h2>
    <p class="tbh-section__sub">Every brand fitted to the same standard. We carry stock across all sizes and patterns — if we do not have your exact size in stock, we source it within 1–2 working days.</p>
    <div class="tbh-brands">
      <?php foreach ($brands as $b) :
        $tier_class = strpos(strtolower($b['tier']), 'premium') !== false ? 'premium' : (strpos(strtolower($b['tier']), 'mid') !== false ? 'mid' : 'budget');
      ?>
      <a href="<?php echo esc_url($site_url . '/tyre-brands/' . $b['slug'] . '-tyres/'); ?>" class="tbh-brand">
        <div class="tbh-brand__head">
          <div>
            <div class="tbh-brand__name"><?php echo esc_html($b['name']); ?></div>
            <div class="tbh-brand__origin"><?php echo esc_html($b['origin']); ?></div>
          </div>
          <span class="tbh-brand__tier tbh-brand__tier--<?php echo $tier_class; ?>"><?php echo esc_html($b['tier']); ?></span>
        </div>
        <p class="tbh-brand__desc"><?php echo esc_html($b['desc']); ?></p>
        <div class="tbh-brand__foot">
          <span class="tbh-brand__count"><?php echo esc_html($b['count']); ?> sizes available</span>
          <span class="tbh-brand__link"><?php echo esc_html($b['name']); ?> Tyres →</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="tbh-section tbh-section--dark" id="enquire">
  <div class="tbh-section__inner">
    <div class="tbh-enquiry">
      <div>
        <span class="tbh-section__eyebrow">Book or Enquire</span>
        <h2 class="tbh-section__heading">Get a Tyre Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your tyre size or vehicle rego — we will come back with options across budget and premium brands.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tbh-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="tbh-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<section class="tbh-section tbh-section--white">
  <div class="tbh-section__inner">
    <span class="tbh-section__eyebrow"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</span>
    <h2 class="tbh-section__heading">What Customers Say</h2>
    <?php echo do_shortcode($reviews_widget); ?>
  </div>
</section>

<section class="tbh-section tbh-section--grey">
  <div class="tbh-section__inner">
    <div class="tbh-faq">
      <span class="tbh-section__eyebrow">FAQ</span>
      <h2 class="tbh-section__heading">Tyre Brands — Common Questions</h2>
      <div class="tbh-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="tbh-faq__item">
          <button class="tbh-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="tbh-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll('.tbh-faq__q').forEach(function(btn){
  btn.addEventListener('click',function(){
    var item=this.closest('.tbh-faq__item');
    var wasOpen=item.classList.contains('tbh-faq__item--open');
    document.querySelectorAll('.tbh-faq__item--open').forEach(function(i){i.classList.remove('tbh-faq__item--open');});
    if(!wasOpen)item.classList.add('tbh-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
