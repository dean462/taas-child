<?php
/**
 * Template Name: Tyre Brand Page
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /tyre-brands/[brand]-tyres/
 * Content from post_meta. JSON supplies catalogue.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

$site_url   = get_site_url();
$post_id    = get_the_ID();
$established = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$years      = date('Y') - intval($established);
$rating     = defined('TAAS_RATING')  ? TAAS_RATING  : '4.2';
$reviews    = defined('TAAS_REVIEWS') ? TAAS_REVIEWS : '200+';
$customers  = defined('TAAS_CUSTOMERS') ? TAAS_CUSTOMERS : '10,000+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$phone_free_tel = preg_replace('/[^0-9+]/', '', TAAS_PHONE_FREE);
$maps_url = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

$brand_name    = get_post_meta($post_id, 'brand_name', true) ?: get_the_title();
$brand_slug    = get_post_meta($post_id, 'brand_slug', true) ?: sanitize_title($brand_name);
$brand_origin  = get_post_meta($post_id, 'brand_origin', true) ?: '';
$brand_tier    = get_post_meta($post_id, 'brand_tier', true) ?: 'mid';
$brand_summary = get_post_meta($post_id, 'brand_summary', true) ?: '';
$brand_strengths = get_post_meta($post_id, 'brand_strengths', true) ?: '';
$brand_vehicles  = get_post_meta($post_id, 'brand_vehicles', true) ?: '';

$strengths = $brand_strengths ? array_filter(array_map('trim', explode(',', $brand_strengths))) : [];
$vehicles  = $brand_vehicles  ? array_filter(array_map('trim', explode(',', $brand_vehicles)))  : [];

// Load JSON
$json_path  = get_stylesheet_directory() . '/taas-tyres-web.json';
$tyres_json = file_exists($json_path) ? file_get_contents($json_path) : '[]';

$tier_labels = ['budget'=>'Budget','mid'=>'Mid-Range','premium'=>'Premium','mid-premium'=>'Mid-Premium'];
$tier_label  = isset($tier_labels[$brand_tier]) ? $tier_labels[$brand_tier] : ucfirst($brand_tier);

$faqs = [
    ['q'=>"Do you carry {$brand_name} tyres?",'a'=>"Yes. We stock {$brand_name} tyres across a wide range of sizes and patterns. Use the catalogue below or our tyre finder to check availability in your size."],
    ['q'=>"How much do {$brand_name} tyres cost?",'a'=>"Pricing depends on size and pattern. Contact us on " . TAAS_PHONE_FREE . " with your tyre size or rego for an estimate. Finance available via Afterpay, Q Card and GEM Finance."],
    ['q'=>"Do you fit and balance {$brand_name} tyres?",'a'=>"Yes — supply, fit, balance and alignment all done on-site. One stop, one visit."],
    ['q'=>"Can you order a {$brand_name} size not shown?",'a'=>"We can source most sizes through our supplier network. Call " . TAAS_PHONE_FREE . " with the size you need."],
    ['q'=>"Where is your tyre shop?",'a'=>"139 Cavendish Drive, Manukau, Auckland 2104. Open " . TAAS_HOURS . ". Call " . TAAS_PHONE_FREE . "."],
];

$schema_faqs = [];
foreach ($faqs as $faq) { $schema_faqs[] = ['@type'=>'Question','name'=>$faq['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['a']]]; }
$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Tyre Centre','item'=>$site_url.'/tyre-centre/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Tyre Brands','item'=>$site_url.'/tyre-brands/'],
        ['@type'=>'ListItem','position'=>4,'name'=>$brand_name.' Tyres','item'=>get_permalink()],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'name'=>'Tony Allen Auto Service','url'=>$site_url,
     'telephone'=>[TAAS_PHONE_FREE,TAAS_PHONE_LOCAL],'email'=>TAAS_EMAIL,
     'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'foundingDate'=>'1985-10-01','paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
    ],
    ['@type'=>'FAQPage','mainEntity'=>$schema_faqs],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.tbp-hero h1','.tbp-section__heading','.tbp-faq__q']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-tyre-brand .site-content,.page-template-template-tyre-brand .entry-content,.page-template-template-tyre-brand .entry-header,.page-template-template-tyre-brand article,.page-template-template-tyre-brand #primary,.page-template-template-tyre-brand #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-tyre-brand{overflow-x:hidden;}

.tbp-hero{background:var(--taas-black,#111);padding:var(--taas-sec-pad,72px) 0 60px;}
.tbp-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tbp-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,11px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.tbp-hero h1{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h1-spoke,clamp(30px,5vw,50px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 12px;}
.tbp-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tbp-hero__sub{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;max-width:600px;margin:0 0 28px;line-height:1.65;}
.tbp-hero__ctas{display:flex;gap:12px;flex-wrap:wrap;}

.tbp-trust{background:var(--taas-yellow,#FFC800);padding:18px 0;}
.tbp-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;gap:40px;align-items:center;justify-content:center;flex-wrap:wrap;}
.tbp-trust__item{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.tbp-trust__item::before{content:'✓';font-weight:900;}

.tbp-section{padding:var(--taas-sec-pad,72px) 0;}
.tbp-section--white{background:var(--taas-white,#fff);}
.tbp-section--grey{background:var(--taas-panel,#F7F7F5);}
.tbp-section--dark{background:var(--taas-dark,#1A1A1A);}
.tbp-section__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tbp-section__eyebrow{display:inline-block;background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 10px;border-radius:3px;margin-bottom:14px;}
.tbp-section--dark .tbp-section__eyebrow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.tbp-section__heading{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;}
.tbp-section--dark .tbp-section__heading{color:var(--taas-white,#fff);}
.tbp-section__sub{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);max-width:640px;margin:0 0 28px;line-height:1.65;}

.tbp-catalogue{margin-top:28px;}
.tbp-rim-group{margin-bottom:24px;}
.tbp-rim-group__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;font-weight:700;color:var(--taas-black,#111);padding:10px 16px;background:var(--taas-panel,#F7F7F5);border-radius:var(--taas-radius,6px) var(--taas-radius,6px) 0 0;border:1px solid var(--taas-border,#E8E8E4);border-bottom:none;}
.tbp-table{width:100%;border-collapse:collapse;border:1px solid var(--taas-border,#E8E8E4);border-radius:0 0 var(--taas-radius,6px) var(--taas-radius,6px);overflow:hidden;}
.tbp-table th{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--taas-mid,#666);text-align:left;padding:10px 16px;background:var(--taas-white,#fff);border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tbp-table td{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333);padding:10px 16px;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tbp-table tr:last-child td{border-bottom:none;}
.tbp-table tr:hover td{background:#fffbea;}
.tbp-stock-yes{color:#27ae60;font-weight:600;font-size:12px;}
.tbp-stock-no{color:var(--taas-alert,#C0392B);font-weight:600;font-size:12px;}

.tbp-faq{max-width:780px;}
.tbp-faq__list{display:flex;flex-direction:column;gap:0;margin-top:28px;}
.tbp-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tbp-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.tbp-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.tbp-faq__item--open .tbp-faq__q::after{content:'−';}
.tbp-faq__a{display:none;padding:0 0 18px;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-mid,#666);line-height:1.7;}
.tbp-faq__item--open .tbp-faq__a{display:block;}

.tbp-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tbp-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.tbp-enquiry__phone:hover{color:#fff;}
.tbp-enquiry__detail{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:#aaa;line-height:1.7;}
.tbp-enquiry__detail strong{color:var(--taas-white,#fff);}
.tbp-section--dark .wpcf7 label,.tbp-section--dark .wpcf7 span:not(.wpcf7-spinner),.tbp-section--dark .wpcf7 div:not(.wpcf7-response-output),.tbp-section--dark .wpcf7 p{color:#ccc!important;font-size:14px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.tbp-section--dark .wpcf7 input[type="text"],.tbp-section--dark .wpcf7 input[type="email"],.tbp-section--dark .wpcf7 input[type="tel"],.tbp-section--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.tbp-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:15px;letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}

@media(max-width:960px){.tbp-enquiry{grid-template-columns:1fr;gap:32px;}.tbp-table{font-size:13px;}}
@media(max-width:640px){
  .tbp-hero{padding:48px 0 40px;}.tbp-hero h1{font-size:clamp(24px,6vw,38px);}.tbp-hero__sub{font-size:14px;}
  .tbp-hero__ctas{flex-direction:column;align-items:stretch;}.tbp-hero__ctas .taas-btn{justify-content:center;text-align:center;}
  .tbp-section{padding:48px 0;}.tbp-section__heading{font-size:clamp(20px,5vw,28px);}
  .tbp-trust__inner{flex-direction:column;gap:8px;align-items:flex-start;}.tbp-trust__item{font-size:12px;}
  .tbp-table th,.tbp-table td{padding:8px 10px;font-size:12px;}
  .tbp-faq__q{font-size:14px;}.tbp-faq__a{font-size:13px;}
  .tbp-enquiry__phone{font-size:clamp(24px,6vw,32px);}
}
</style>

<section class="tbp-hero">
  <div class="tbp-hero__inner">
    <span class="tbp-hero__eyebrow">Tyre Brands — <?php echo esc_html($brand_name); ?></span>
    <h1><?php echo esc_html($brand_name); ?> Tyres<br><span>Manukau — South Auckland</span></h1>
    <p class="tbp-hero__sub"><?php echo $brand_summary ? wp_kses_post($brand_summary) : esc_html($brand_name) . ' tyres supplied, fitted and balanced at 139 Cavendish Drive, Manukau. ' . esc_html($tier_label) . ' range.'; ?></p>
    <div class="tbp-hero__ctas">
      <a href="#enquire" class="taas-btn taas-btn--primary">Get an Estimate</a>
      <a href="<?php echo esc_url($site_url . '/tyre-finder/'); ?>" class="taas-btn taas-btn--outline">Search by Size</a>
    </div>
  </div>
</section>

<div class="tbp-trust">
  <div class="tbp-trust__inner">
    <div class="tbp-trust__item">MTA Assured</div>
    <div class="tbp-trust__item">NZTA Authorised</div>
    <div class="tbp-trust__item">Supply, Fit & Balance</div>
    <div class="tbp-trust__item"><?php echo esc_html($tier_label); ?> Brand</div>
    <div class="tbp-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div>
  </div>
</div>

<?php if (!empty($strengths)) : ?>
<section class="tbp-section tbp-section--white">
  <div class="tbp-section__inner">
    <span class="tbp-section__eyebrow">About <?php echo esc_html($brand_name); ?></span>
    <h2 class="tbp-section__heading"><?php echo esc_html($brand_name); ?> — <?php echo esc_html($brand_origin); ?></h2>
    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;max-width:720px;">
      <?php foreach ($strengths as $s) : ?>
      <li style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-body,#333);padding-left:20px;position:relative;line-height:1.5;"><span style="position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;">✓</span><?php echo esc_html($s); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>

<section class="tbp-section tbp-section--grey">
  <div class="tbp-section__inner">
    <span class="tbp-section__eyebrow">Catalogue</span>
    <h2 class="tbp-section__heading"><?php echo esc_html($brand_name); ?> Tyres — Available Sizes</h2>
    <p class="tbp-section__sub">Showing all <?php echo esc_html($brand_name); ?> tyres in our catalogue. Contact us for pricing — <?php echo esc_html(TAAS_PHONE_FREE); ?>.</p>
    <div id="tbp-catalogue" class="tbp-catalogue"><p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-mid,#666);">Loading catalogue...</p></div>
  </div>
</section>

<section class="tbp-section tbp-section--dark" id="enquire">
  <div class="tbp-section__inner">
    <div class="tbp-enquiry">
      <div>
        <span class="tbp-section__eyebrow">Book or Enquire</span>
        <h2 class="tbp-section__heading">Get a <?php echo esc_html($brand_name); ?> Tyre Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your tyre size or vehicle rego and we will come back with <?php echo esc_html($brand_name); ?> pricing.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tbp-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="tbp-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<section class="tbp-section tbp-section--white">
  <div class="tbp-section__inner">
    <div class="tbp-faq">
      <span class="tbp-section__eyebrow">FAQ</span>
      <h2 class="tbp-section__heading"><?php echo esc_html($brand_name); ?> Tyres — Questions</h2>
      <div class="tbp-faq__list">
        <?php foreach ($faqs as $faq) : ?>
        <div class="tbp-faq__item">
          <button class="tbp-faq__q"><?php echo esc_html($faq['q']); ?></button>
          <div class="tbp-faq__a"><p><?php echo wp_kses_post($faq['a']); ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  var allTyres = <?php echo $tyres_json; ?>;
  var brandSlug = <?php echo wp_json_encode($brand_slug); ?>;
  var filtered = allTyres.filter(function(t){ return t.brand && t.brand.toLowerCase() === brandSlug.toLowerCase(); });

  // Group by rim size
  var groups = {};
  filtered.forEach(function(t){
    var rim = t.rim || '?';
    if (!groups[rim]) groups[rim] = [];
    groups[rim].push(t);
  });

  var rimKeys = Object.keys(groups).sort(function(a,b){ return parseFloat(a) - parseFloat(b); });
  var container = document.getElementById('tbp-catalogue');
  if (!rimKeys.length) { container.innerHTML = '<p style="font-family:Inter,Arial,sans-serif;font-size:15px;color:#666;">No tyres found for this brand. Contact us for availability.</p>'; return; }

  var html = '<p style="font-family:Inter,Arial,sans-serif;font-size:14px;color:#666;margin-bottom:20px;">' + filtered.length + ' sizes available</p>';
  rimKeys.forEach(function(rim){
    var tyres = groups[rim];
    tyres.sort(function(a,b){ return (a.size||'').localeCompare(b.size||''); });
    html += '<div class="tbp-rim-group">';
    html += '<div class="tbp-rim-group__title">R' + rim + ' — ' + tyres.length + ' sizes</div>';
    html += '<table class="tbp-table"><thead><tr><th>Size</th><th>Pattern</th><th>Load</th><th>Stock</th></tr></thead><tbody>';
    tyres.forEach(function(t){
      var stock = t.instock ? '<span class="tbp-stock-yes">In Stock</span>' : '<span class="tbp-stock-no">Order In</span>';
      html += '<tr><td>' + (t.size||'') + '</td><td>' + (t.pattern||'') + '</td><td>' + (t.load||'') + '</td><td>' + stock + '</td></tr>';
    });
    html += '</tbody></table></div>';
  });
  container.innerHTML = html;
})();

document.querySelectorAll('.tbp-faq__q').forEach(function(btn){
  btn.addEventListener('click',function(){
    var item=this.closest('.tbp-faq__item');
    var wasOpen=item.classList.contains('tbp-faq__item--open');
    document.querySelectorAll('.tbp-faq__item--open').forEach(function(i){i.classList.remove('tbp-faq__item--open');});
    if(!wasOpen)item.classList.add('tbp-faq__item--open');
  });
});
</script>

<?php get_footer(); ?>
