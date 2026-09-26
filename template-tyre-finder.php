<?php
/**
 * Template Name: Tyre Finder
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /tyre-finder/
 * Cascading dropdowns: width → profile → rim
 * Results table with enquiry CTA.
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
$cf7_general = defined('TAAS_CF7_GENERAL') ? TAAS_CF7_GENERAL : '';
$phone_free_tel = preg_replace('/[^0-9+]/', '', TAAS_PHONE_FREE);
$maps_url = 'https://www.google.com/maps/place/Tony+Allen+Auto+Service,+139+Cavendish+Drive,+Manukau+2104';

$json_path  = get_stylesheet_directory() . '/taas-tyres-web.json';
$tyres_json = file_exists($json_path) ? file_get_contents($json_path) : '[]';

$schema = ['@context'=>'https://schema.org','@graph'=>[
    ['@type'=>'BreadcrumbList','itemListElement'=>[
        ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$site_url.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Tyre Centre','item'=>$site_url.'/tyre-centre/'],
        ['@type'=>'ListItem','position'=>3,'name'=>'Tyre Finder','item'=>$site_url.'/tyre-finder/'],
    ]],
    ['@type'=>['AutoRepair','LocalBusiness'],'name'=>'Tony Allen Auto Service','url'=>$site_url,
     'telephone'=>[TAAS_PHONE_FREE,TAAS_PHONE_LOCAL],'email'=>TAAS_EMAIL,
     'address'=>['@type'=>'PostalAddress','streetAddress'=>'139 Cavendish Drive','addressLocality'=>'Manukau','addressRegion'=>'Auckland','postalCode'=>'2104','addressCountry'=>'NZ'],
     'geo'=>['@type'=>'GeoCoordinates','latitude'=>-36.9936,'longitude'=>174.8671],
     'foundingDate'=>'1985-10-01','paymentAccepted'=>'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance',
    ],
    ['@type'=>'SpeakableSpecification','cssSelector'=>['.tf-hero h1','.tf-section__heading']],
]];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
.page-template-template-tyre-finder .site-content,.page-template-template-tyre-finder .entry-content,.page-template-template-tyre-finder .entry-header,.page-template-template-tyre-finder article,.page-template-template-tyre-finder #primary,.page-template-template-tyre-finder #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-tyre-finder{overflow-x:hidden;}

.tf-hero{background:var(--taas-black,#111);padding:var(--taas-sec-pad,72px) 0 60px;}
.tf-hero__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tf-hero__eyebrow{display:inline-block;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-eye-size,11px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:20px;}
.tf-hero h1{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.tf-hero h1 span{color:var(--taas-yellow,#FFC800);}
.tf-hero__sub{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;max-width:600px;margin:0 0 0;line-height:1.65;}

.tf-search{background:var(--taas-dark,#1A1A1A);padding:0 0 48px;}
.tf-search__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tf-search__form{display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:12px;align-items:end;background:#2a2a2a;border:1px solid #444;border-radius:var(--taas-radius,6px);padding:24px;}
.tf-search__group{display:flex;flex-direction:column;gap:6px;}
.tf-search__label{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);}
.tf-search__select{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;padding:12px 14px;border-radius:var(--taas-radius,6px);border:1px solid #555;background:#1e1e1e;color:#fff;appearance:none;-webkit-appearance:none;cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23FFC800' stroke-width='2' fill='none'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;}
.tf-search__select:disabled{opacity:0.4;cursor:not-allowed;}
.tf-search__btn{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;padding:12px 28px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);cursor:pointer;white-space:nowrap;}
.tf-search__btn:hover{background:var(--taas-yellow2,#e6b400);}
.tf-search__btn:disabled{opacity:0.4;cursor:not-allowed;}

.tf-section{padding:var(--taas-sec-pad,72px) 0;}
.tf-section--white{background:var(--taas-white,#fff);}
.tf-section--grey{background:var(--taas-panel,#F7F7F5);}
.tf-section--dark{background:var(--taas-dark,#1A1A1A);}
.tf-section__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}
.tf-section__heading{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;}

.tf-results{margin-top:8px;}
.tf-results__summary{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-body,#333);margin-bottom:20px;}
.tf-results__summary strong{color:var(--taas-black,#111);}
.tf-table{width:100%;border-collapse:collapse;border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);overflow:hidden;}
.tf-table th{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:var(--taas-mid,#666);text-align:left;padding:12px 16px;background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tf-table td{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:14px;color:var(--taas-body,#333);padding:12px 16px;border-bottom:1px solid var(--taas-border,#E8E8E4);}
.tf-table tr:last-child td{border-bottom:none;}
.tf-table tr:hover td{background:#fffbea;}
.tf-stock-yes{color:#27ae60;font-weight:600;font-size:12px;}
.tf-stock-no{color:var(--taas-alert,#C0392B);font-weight:600;font-size:12px;}
.tf-enquire-btn{display:inline-block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:12px;font-weight:700;padding:6px 14px;background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-radius:var(--taas-radius,6px);text-decoration:none;white-space:nowrap;}
.tf-enquire-btn:hover{background:var(--taas-yellow2,#e6b400);}

.tf-callout{border-left:4px solid var(--taas-yellow,#FFC800);background:#fffbea;padding:24px 28px;border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;margin-top:28px;}
.tf-callout__title{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-dark,#1A1A1A);margin-bottom:8px;}
.tf-callout__body{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:var(--taas-body,#333);line-height:1.65;}

.tf-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tf-enquiry__phone{display:block;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:clamp(28px,4vw,40px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:16px 0 6px;}
.tf-enquiry__phone:hover{color:#fff;}
.tf-enquiry__detail{font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;color:#aaa;line-height:1.7;}
.tf-enquiry__detail strong{color:var(--taas-white,#fff);}
.tf-section--dark .wpcf7 label,.tf-section--dark .wpcf7 span:not(.wpcf7-spinner),.tf-section--dark .wpcf7 div:not(.wpcf7-response-output),.tf-section--dark .wpcf7 p{color:#ccc!important;font-size:14px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.tf-section--dark .wpcf7 input[type="text"],.tf-section--dark .wpcf7 input[type="email"],.tf-section--dark .wpcf7 input[type="tel"],.tf-section--dark .wpcf7 textarea{background:#2a2a2a;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:10px 14px;width:100%;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;}
.tf-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);font-family:var(--taas-font,'Inter',Arial,sans-serif);font-weight:700;font-size:15px;letter-spacing:0.05em;text-transform:uppercase;border:none;padding:14px 32px;border-radius:var(--taas-radius,6px);cursor:pointer;width:100%;margin-top:4px;}

@media(max-width:960px){.tf-search__form{grid-template-columns:1fr 1fr;}.tf-enquiry{grid-template-columns:1fr;gap:32px;}}
@media(max-width:640px){
  .tf-hero{padding:48px 0 40px;}.tf-hero h1{font-size:clamp(28px,7vw,42px);}.tf-hero__sub{font-size:14px;}
  .tf-search__form{grid-template-columns:1fr;}.tf-search{padding:0 0 32px;}
  .tf-section{padding:48px 0;}.tf-section__heading{font-size:clamp(20px,5vw,28px);}
  .tf-table th,.tf-table td{padding:8px 10px;font-size:12px;}
  .tf-enquiry__phone{font-size:clamp(24px,6vw,32px);}
  .tf-callout{padding:20px 22px;}
}
</style>

<section class="tf-hero">
  <div class="tf-hero__inner">
    <span class="tf-hero__eyebrow">Tyre Centre — Manukau</span>
    <h1>Tyre Finder<br><span>Search Our Stock</span></h1>
    <p class="tf-hero__sub">Enter your tyre width, profile and rim diameter. Budget to premium brands — over 1,400 tyres available.</p>
  </div>
</section>

<div class="tf-search">
  <div class="tf-search__inner">
    <div class="tf-search__form">
      <div class="tf-search__group">
        <label class="tf-search__label" for="tf-width">Width</label>
        <select id="tf-width" class="tf-search__select"><option value="">Select width</option></select>
      </div>
      <div class="tf-search__group">
        <label class="tf-search__label" for="tf-profile">Profile</label>
        <select id="tf-profile" class="tf-search__select" disabled><option value="">Select profile</option></select>
      </div>
      <div class="tf-search__group">
        <label class="tf-search__label" for="tf-rim">Rim</label>
        <select id="tf-rim" class="tf-search__select" disabled><option value="">Select rim</option></select>
      </div>
      <button id="tf-reset" class="tf-search__btn" style="background:transparent;border:1px solid #555;color:#aaa;" type="button">Reset</button>
    </div>
  </div>
</div>

<section class="tf-section tf-section--white" id="tf-results-section" style="display:none;">
  <div class="tf-section__inner">
    <h2 class="tf-section__heading">Results</h2>
    <div id="tf-results" class="tf-results"></div>
    <div class="tf-callout">
      <div class="tf-callout__title">Contact for pricing</div>
      <p class="tf-callout__body">We do not show tyre prices online. Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> with your tyre size or rego and we will give you an estimate. Finance available via Afterpay, Q Card and GEM Finance.</p>
    </div>
  </div>
</section>

<section class="tf-section tf-section--grey" id="tf-help" style="display:block;">
  <div class="tf-section__inner">
    <h2 class="tf-section__heading">Where to Find Your Tyre Size</h2>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;max-width:720px;margin-bottom:16px;">Your tyre size is printed on the sidewall of every tyre — look for a number like <strong style="color:var(--taas-black,#111);">205/55R16</strong>. The first number (205) is the width in mm. The second (55) is the profile — the height as a percentage of the width. R16 is the rim diameter in inches.</p>
    <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:var(--taas-mid,#666);line-height:1.7;max-width:720px;">You can also find the recommended tyre size on a sticker inside the driver's door, or in your vehicle handbook. If you are unsure, call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="color:var(--taas-yellow,#FFC800);font-weight:600;text-decoration:none;"><?php echo esc_html(TAAS_PHONE_FREE); ?></a> with your rego and we will look it up.</p>
  </div>
</section>

<section class="tf-section tf-section--dark" id="enquire">
  <div class="tf-section__inner">
    <div class="tf-enquiry">
      <div>
        <h2 class="tf-section__heading" style="color:var(--taas-white,#fff);">Get a Tyre Estimate</h2>
        <p style="font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:16px;color:#aaa;line-height:1.65;margin-bottom:8px;">Tell us your tyre size or vehicle rego — we will come back with pricing.</p>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="tf-enquiry__phone"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>
        <div class="tf-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:#aaa;text-decoration:underline;">139 Cavendish Drive, Manukau</a><br>Mon–Fri 7:30am–5:00pm · <?php echo esc_html(TAAS_PHONE_LOCAL); ?></div>
      </div>
      <div><?php echo do_shortcode($cf7_general); ?></div>
    </div>
  </div>
</section>

<script>
(function(){
  var allTyres = <?php echo $tyres_json; ?>;
  var widthEl = document.getElementById('tf-width');
  var profileEl = document.getElementById('tf-profile');
  var rimEl = document.getElementById('tf-rim');
  var resetBtn = document.getElementById('tf-reset');
  var resultsSection = document.getElementById('tf-results-section');
  var resultsDiv = document.getElementById('tf-results');
  var helpSection = document.getElementById('tf-help');

  // Populate widths
  var widths = [];
  allTyres.forEach(function(t){ var w = t.width; if (w && widths.indexOf(w) === -1) widths.push(w); });
  widths.sort(function(a,b){ return parseFloat(a) - parseFloat(b); });
  widths.forEach(function(w){ var o = document.createElement('option'); o.value = w; o.textContent = w; widthEl.appendChild(o); });

  widthEl.addEventListener('change', function(){
    profileEl.innerHTML = '<option value="">Select profile</option>';
    rimEl.innerHTML = '<option value="">Select rim</option>';
    profileEl.disabled = true;
    rimEl.disabled = true;
    resultsSection.style.display = 'none';
    helpSection.style.display = 'block';
    if (!this.value) return;
    var profiles = [];
    allTyres.forEach(function(t){ if (t.width === widthEl.value && t.profile && profiles.indexOf(t.profile) === -1) profiles.push(t.profile); });
    profiles.sort(function(a,b){ return parseFloat(a) - parseFloat(b); });
    profiles.forEach(function(p){ var o = document.createElement('option'); o.value = p; o.textContent = p === '-' ? 'Full height' : p; profileEl.appendChild(o); });
    profileEl.disabled = false;
  });

  profileEl.addEventListener('change', function(){
    rimEl.innerHTML = '<option value="">Select rim</option>';
    rimEl.disabled = true;
    resultsSection.style.display = 'none';
    helpSection.style.display = 'block';
    if (!this.value) return;
    var rims = [];
    allTyres.forEach(function(t){ if (t.width === widthEl.value && t.profile === profileEl.value && t.rim && rims.indexOf(t.rim) === -1) rims.push(t.rim); });
    rims.sort(function(a,b){ return parseFloat(a) - parseFloat(b); });
    rims.forEach(function(r){ var o = document.createElement('option'); o.value = r; o.textContent = 'R' + r; rimEl.appendChild(o); });
    rimEl.disabled = false;
  });

  rimEl.addEventListener('change', function(){
    if (!this.value) { resultsSection.style.display = 'none'; helpSection.style.display = 'block'; return; }
    var matches = allTyres.filter(function(t){ return t.width === widthEl.value && t.profile === profileEl.value && t.rim === rimEl.value; });
    matches.sort(function(a,b){ return (a.brand||'').localeCompare(b.brand||'') || (a.pattern||'').localeCompare(b.pattern||''); });

    var sizeLabel = widthEl.value + '/' + (profileEl.value === '-' ? '' : profileEl.value) + 'R' + rimEl.value;
    var html = '<div class="tf-results__summary"><strong>' + matches.length + '</strong> tyres found for <strong>' + sizeLabel + '</strong></div>';

    if (matches.length) {
      html += '<table class="tf-table"><thead><tr><th>Brand</th><th>Pattern</th><th>Size</th><th>Load</th><th>Stock</th><th></th></tr></thead><tbody>';
      matches.forEach(function(t){
        var stock = t.instock ? '<span class="tf-stock-yes">In Stock</span>' : '<span class="tf-stock-no">Order In</span>';
        html += '<tr><td><strong>' + (t.brand||'') + '</strong></td><td>' + (t.pattern||'') + '</td><td>' + (t.size||'') + '</td><td>' + (t.load||'') + '</td><td>' + stock + '</td><td><a href="#enquire" class="tf-enquire-btn">Enquire</a></td></tr>';
      });
      html += '</tbody></table>';
    } else {
      html += '<p style="font-family:Inter,Arial,sans-serif;font-size:15px;color:#666;">No tyres found for this size. We may be able to source it — call <a href="tel:' + '<?php echo esc_attr($phone_free_tel); ?>' + '" style="color:#FFC800;font-weight:600;"><?php echo esc_html(TAAS_PHONE_FREE); ?></a>.</p>';
    }
    resultsDiv.innerHTML = html;
    resultsSection.style.display = 'block';
    helpSection.style.display = 'none';
    resultsSection.scrollIntoView({behavior:'smooth',block:'start'});
  });

  resetBtn.addEventListener('click', function(){
    widthEl.value = '';
    profileEl.innerHTML = '<option value="">Select profile</option>';
    rimEl.innerHTML = '<option value="">Select rim</option>';
    profileEl.disabled = true;
    rimEl.disabled = true;
    resultsSection.style.display = 'none';
    helpSection.style.display = 'block';
  });
})();
</script>

<?php get_footer(); ?>
