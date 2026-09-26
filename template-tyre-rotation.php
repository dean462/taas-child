<?php
/**
 * Template Name: Tyre Rotation Manukau
 * Template Post Type: page
 *
 * URL: /tyre-rotation-manukau/
 * Parent: /tyre-centre/
 *
 * Tone: Practical. Tyre rotation is a value-add service — sold on tyre
 *       life extension. Not a destination search but good supporting content.
 */

wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font-tr', 'https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap');

$phone_local    = '09 278 9556';
$phone_free     = '0800 100 876';
$hours          = defined('TAAS_HOURS')          ? TAAS_HOURS          : 'Monday–Friday 7:30am–5:00pm';
$established    = defined('TAAS_ESTABLISHED')    ? TAAS_ESTABLISHED    : '1985';
$google_rating  = defined('TAAS_RATING')         ? TAAS_RATING         : '4.2';
$google_reviews = defined('TAAS_REVIEWS')        ? TAAS_REVIEWS        : '200+';
$reviews_widget = defined('TAAS_REVIEWS_WIDGET') ? TAAS_REVIEWS_WIDGET : '';
$cf7_general    = defined('TAAS_CF7_GENERAL')    ? TAAS_CF7_GENERAL    : '';

$site_url      = get_site_url();
$page_url      = get_permalink();
$years_trading = date('Y') - intval($established);

$patterns = [
    ['name'=>'Forward Cross','desc'=>'Front tyres move straight back. Rears cross to opposite sides going forward. Common on FWD vehicles.','best'=>'Front-wheel drive cars'],
    ['name'=>'Rearward Cross','desc'=>'Rear tyres move straight forward. Fronts cross to opposite sides going rearward. Mirrors the forward cross.','best'=>'RWD and 4WD vehicles'],
    ['name'=>'X-Pattern','desc'=>'All four tyres cross diagonally. Front-left to rear-right, front-right to rear-left.','best'=>'FWD vehicles — more aggressive equalisation'],
    ['name'=>'Side-to-Side','desc'=>'Tyres swap left-to-right only. Used for directional tyres or staggered fitments where front and rear sizes differ.','best'=>'Vehicles with different front/rear sizes'],
];

$faqs = [
    [
        'q' => 'How often should I rotate my tyres?',
        'a' => 'Every 8,000–10,000km is a common recommendation, or every second oil change. The exact interval depends on your vehicle, driving style, and tyre type. Front-wheel drive vehicles wear front tyres significantly faster — more frequent rotation is beneficial. Check your vehicle owner\'s manual for the manufacturer\'s recommendation.',
    ],
    [
        'q' => 'What does tyre rotation actually do?',
        'a' => 'Tyre rotation moves tyres to different positions on the vehicle so they wear more evenly across the full set. Front tyres typically wear faster on front-wheel drive vehicles due to steering and power delivery. Rotating tyres evens out this differential wear — extending the life of the full set and ensuring they wear out around the same time.',
    ],
    [
        'q' => 'Can I rotate directional tyres?',
        'a' => 'Directional tyres — those with an asymmetric tread pattern designed to rotate in one direction — can only be rotated front-to-back on the same side. They cannot be crossed over to the opposite side without dismounting and re-mounting the tyre on the rim. We can do this if needed — call us on ' . $phone_local . '.',
    ],
    [
        'q' => 'Do you rebalance tyres after rotation?',
        'a' => 'We recommend it — and we\'ll advise you at the time based on how the tyres are wearing. If a tyre has developed a flat spot or has been wearing unevenly, rebalancing after rotation is worth doing. We can combine rotation and balance in one visit.',
    ],
    [
        'q' => 'Can I rotate tyres if the front and rear are different sizes?',
        'a' => 'If your vehicle has a staggered fitment — different sizes front and rear, common on performance and European vehicles — straight rotation is not possible. A side-to-side swap may be possible if the tyres are non-directional, but this requires dismounting and remounting. Call us on ' . $phone_local . ' with your vehicle details.',
    ],
];

get_header();
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=family=Inter:wght@400;500;600;700;800;900&display=swap">
<style>
body,p,li,td,span,div,a,label,input,textarea,select,button{font-family:'Inter',Arial,sans-serif!important;}
.taas-tr*,.taas-tr*::before,.taas-tr*::after{box-sizing:border-box;margin:0;padding:0;}
.taas-tr{font-family:'Inter',Arial,sans-serif;color:#333;-webkit-font-smoothing:antialiased;}
.tr-w{max-width:1140px;margin:0 auto;padding:0 24px;}
.tr-ey{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:4px 12px;border-radius:3px;margin-bottom:16px;}
.tr-ey--yellow{background:#FFC800;color:#111;}
.tr-ey--dark{background:#1A1A1A;color:#FFC800;}
.tr-h1{font-family:'Oswald',Arial,sans-serif;font-size:clamp(44px,7vw,72px);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-0.01em;margin-bottom:16px;}
.tr-h1 em{color:#FFC800;font-style:normal;}
.tr-h2{font-family:'Oswald',Arial,sans-serif;font-size:clamp(28px,4vw,44px);font-weight:900;color:#111;line-height:1.05;margin-bottom:12px;}
.tr-h2--white{color:#fff;}
.tr-lead{font-size:16px;color:#666;line-height:1.6;max-width:600px;}
.tr-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;border-radius:6px;text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;cursor:pointer;}
.tr-btn--primary{background:#FFC800;color:#1A1A1A;border-color:#FFC800;}
.tr-btn--primary:hover{background:#e6b400;border-color:#e6b400;}
.tr-btn--outline{background:transparent;color:#FFC800;border-color:#FFC800;}
.tr-btn--outline:hover{background:#FFC800;color:#111;}

.tr-hero{background:#111;padding:72px 0 64px;position:relative;overflow:hidden;}
.tr-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(255,200,0,.06) 0%,transparent 70%);pointer-events:none;}
.tr-hero__inner{display:grid;grid-template-columns:1fr auto;gap:32px 48px;align-items:start;}
.tr-hero__bc{grid-column:1/-1;font-size:13px;color:#555;}
.tr-hero__bc a{color:#555;text-decoration:none;}
.tr-hero__bc a:hover{color:#FFC800;}
.tr-hero__bc span{margin:0 6px;}
.tr-hero__sub{font-size:17px;color:#aaa;line-height:1.6;max-width:540px;margin-bottom:28px;}
.tr-hero__btns{display:flex;flex-wrap:wrap;gap:12px;}
.tr-hero__card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:24px;min-width:240px;max-width:280px;}
.tr-hero__card h3{font-size:13px;font-weight:700;color:#FFC800;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px;}
.tr-hero__card ul{list-style:none;display:flex;flex-direction:column;gap:8px;}
.tr-hero__card li{font-size:13px;color:#ccc;display:flex;align-items:flex-start;gap:8px;line-height:1.4;}
.tr-hero__card li::before{content:'✓';color:#FFC800;font-weight:700;flex-shrink:0;margin-top:1px;}
.tr-hero__phone{margin-top:20px;padding-top:20px;border-top:1px solid #2a2a2a;}
.tr-hero__phone a{display:block;font-size:20px;font-weight:800;color:#fff;text-decoration:none;}

.tr-trust{background:#FFC800;}
.tr-trust__inner{display:grid;grid-template-columns:repeat(4,1fr);border-left:1px solid rgba(0,0,0,.1);}
.tr-trust__item{display:flex;align-items:center;gap:10px;padding:16px 20px;border-right:1px solid rgba(0,0,0,.1);}
.tr-trust__icon{font-size:20px;flex-shrink:0;}
.tr-trust__label{font-size:13px;font-weight:700;color:#111;line-height:1.3;}

.tr-why{background:#fff;padding:72px 0;}
.tr-why__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tr-why__body p{font-size:16px;color:#333;line-height:1.7;}
.tr-why__body p+p{margin-top:16px;}
.tr-stat-card{background:#111;border-radius:8px;padding:28px;display:flex;flex-direction:column;gap:20px;}
.tr-stat{padding-bottom:20px;border-bottom:1px solid #2a2a2a;}
.tr-stat:last-child{padding-bottom:0;border-bottom:none;}
.tr-stat__num{font-family:'Oswald',Arial,sans-serif;font-size:40px;font-weight:900;color:#FFC800;line-height:1;}
.tr-stat__label{font-size:14px;color:#888;margin-top:4px;}

.tr-patterns{background:#F7F7F5;padding:72px 0;}
.tr-patterns__grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:32px;}
.tr-pattern-card{background:#fff;border:1px solid #E8E8E4;border-radius:8px;padding:22px;}
.tr-pattern-card h4{font-family:'Oswald',Arial,sans-serif;font-size:20px;font-weight:900;color:#111;margin-bottom:8px;}
.tr-pattern-card p{font-size:14px;color:#555;line-height:1.6;}
.tr-pattern-card__best{font-size:12px;color:#888;margin-top:8px;font-weight:600;}

.tr-booking{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tr-booking__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.tr-booking__checks{list-style:none;display:flex;flex-direction:column;gap:12px;margin-top:20px;}
.tr-booking__checks li{display:flex;align-items:center;gap:10px;font-size:14px;color:#333;}
.tr-booking__checks li::before{content:'✓';color:#FFC800;font-weight:700;font-size:16px;}
.tr-booking__form{background:#F7F7F5;border-radius:8px;padding:32px;border:1px solid #E8E8E4;}

.tr-cta{background:#111;padding:72px 0;text-align:center;}
.tr-cta h2{color:#fff!important;margin-bottom:12px;}
.tr-cta p{font-size:16px;color:#888;margin-bottom:32px;}
.tr-cta__btns{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;}
.tr-cta__info{margin-top:24px;font-size:13px;color:#555;}

.tr-faq{background:#fff;padding:72px 0;border-top:1px solid #E8E8E4;}
.tr-faq__grid{display:grid;grid-template-columns:1fr 1fr;gap:0 48px;margin-top:32px;}
.tr-faq__item{border-bottom:1px solid #E8E8E4;}
.tr-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 36px 18px 0;font-family:'Inter',Arial,sans-serif;font-size:15px;font-weight:700;color:#111;cursor:pointer;position:relative;line-height:1.4;-webkit-font-smoothing:antialiased;}
.tr-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:300;color:#FFC800;}
.tr-faq__q[aria-expanded="true"]::after{content:'−';}
.tr-faq__a{display:none;padding:0 0 18px;font-size:14px;color:#555;line-height:1.7;}

.tr-related{background:#F7F7F5;padding:56px 0;border-top:1px solid #E8E8E4;}
.tr-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:24px;}
.tr-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:#fff;border:1px solid #E8E8E4;border-radius:6px;text-decoration:none;font-size:14px;font-weight:700;color:#111;transition:border-color .15s ease;}
.tr-related__link:hover{border-color:#FFC800;}
.tr-related__link span{color:#FFC800;font-size:18px;}

@media(max-width:960px){
    .tr-hero__inner,.tr-why__inner,.tr-booking__inner{grid-template-columns:1fr;}
    .tr-hero__card{display:none;}
    .tr-trust__inner,.tr-patterns__grid{grid-template-columns:1fr 1fr;}
    .tr-faq__grid{grid-template-columns:1fr;}
}
@media(max-width:600px){
    .tr-hero,.tr-why,.tr-patterns,.tr-booking,.tr-cta,.tr-faq{padding:48px 0;}
    .tr-trust__inner{grid-template-columns:1fr 1fr;}
    .tr-patterns__grid{grid-template-columns:1fr;}
}
</style>

<div class="taas-tr">

<section class="tr-hero">
    <div class="tr-w">
        <div class="tr-hero__inner">
            <nav class="tr-hero__bc" aria-label="Breadcrumb">
                <a href="<?php echo esc_url($site_url); ?>">Home</a>
                <span>›</span>
                <a href="<?php echo esc_url($site_url.'/tyre-centre/'); ?>">Tyre Centre</a>
                <span>›</span>
                <span>Tyre Rotation Manukau</span>
            </nav>
            <div>
                <span class="tr-ey tr-ey--yellow">Tyre Centre — Manukau</span>
                <h1 class="tr-h1">Tyre Rotation<br><em>Manukau</em></h1>
                <p class="tr-hero__sub">Extend tyre life by rotating regularly. Done at 139 Cavendish Drive — combined with balancing, alignment, or your regular service in one visit.</p>
                <div class="tr-hero__btns">
                    <a href="#tr-booking" class="tr-btn tr-btn--primary">Book Tyre Rotation</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tr-btn tr-btn--outline"><?php echo esc_html($phone_local); ?></a>
                </div>
            </div>
            <div class="tr-hero__card">
                <h3>Tyre Rotation</h3>
                <ul>
                    <li>All rotation patterns — FWD, RWD, 4WD</li>
                    <li>Directional tyre rotation available</li>
                    <li>Combined with balance on request</li>
                    <li>Same visit as service or WOF</li>
                    <li>Extends full set tyre life</li>
                    <li>Call to confirm &amp; book</li>
                </ul>
                <div class="tr-hero__phone">
                    <span style="font-size:12px;color:#555;display:block;margin-bottom:4px;">Call to book</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>"><?php echo esc_html($phone_local); ?></a>
                    <span style="display:block;font-size:11px;color:#444;margin-top:8px;"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="tr-trust" role="list">
    <div class="tr-w">
        <div class="tr-trust__inner">
            <?php foreach ([
                ['🔃','All Rotation Patterns'],
                ['🔄','Combined with Balance'],
                ['🏆','MTA Assured Workshop'],
                ['⭐',$google_rating.' Stars · '.$google_reviews.' Reviews'],
            ] as $t): ?>
            <div class="tr-trust__item" role="listitem">
                <span class="tr-trust__icon"><?php echo $t[0]; ?></span>
                <span class="tr-trust__label"><?php echo esc_html($t[1]); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="tr-why" aria-labelledby="tr-why-h2">
    <div class="tr-w">
        <div class="tr-why__inner">
            <div>
                <span class="tr-ey tr-ey--dark">Why Rotate?</span>
                <h2 class="tr-h2" id="tr-why-h2">Tyre Rotation Extends the Life of Your Full Set</h2>
                <div class="tr-why__body">
                    <p>Tyres don't wear evenly. Front tyres on a front-wheel drive vehicle carry the steering forces and power delivery — they wear significantly faster than the rear. Without rotation, you end up replacing fronts long before rears, often disposing of rears that still have useful life left.</p>
                    <p>Regular rotation moves tyres to different positions so wear is distributed across all four. When done consistently, all four tyres reach the end of their life at roughly the same time — meaning you replace all four together rather than in mismatched pairs.</p>
                    <p>The practical result: you get more kilometres from the same set of tyres. On a quality set of tyres, regular rotation can add thousands of kilometres to the effective life of the set.</p>
                </div>
            </div>
            <div class="tr-stat-card">
                <div class="tr-stat">
                    <div class="tr-stat__num">8–10k</div>
                    <div class="tr-stat__label">Recommended rotation interval in kilometres</div>
                </div>
                <div class="tr-stat">
                    <div class="tr-stat__num">2×</div>
                    <div class="tr-stat__label">FWD front tyres can wear up to twice as fast as rears without rotation</div>
                </div>
                <div class="tr-stat">
                    <div class="tr-stat__num">1 visit</div>
                    <div class="tr-stat__label">Combine with your WOF, service, or alignment — no extra trip</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tr-patterns" aria-labelledby="tr-patterns-h2">
    <div class="tr-w">
        <span class="tr-ey tr-ey--dark">Rotation Patterns</span>
        <h2 class="tr-h2" id="tr-patterns-h2">Which Rotation Pattern Does Your Vehicle Need?</h2>
        <p class="tr-lead">The correct pattern depends on your vehicle's drivetrain and whether your tyres are directional. We determine the right pattern for your vehicle.</p>
        <div class="tr-patterns__grid">
            <?php foreach ($patterns as $p): ?>
            <div class="tr-pattern-card">
                <h4><?php echo esc_html($p['name']); ?></h4>
                <p><?php echo esc_html($p['desc']); ?></p>
                <p class="tr-pattern-card__best">Best for: <?php echo esc_html($p['best']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="tr-booking" id="tr-booking" aria-labelledby="tr-booking-h2">
    <div class="tr-w">
        <div class="tr-booking__inner">
            <div>
                <span class="tr-ey tr-ey--dark">Book Online</span>
                <h2 class="tr-h2" id="tr-booking-h2">Book a Tyre Rotation</h2>
                <p class="tr-lead">Best combined with a vehicle service, WOF, or wheel alignment in one visit. Call or enquire below.</p>
                <ul class="tr-booking__checks">
                    <li><?php echo esc_html($hours); ?></li>
                    <li>139 Cavendish Drive, Manukau</li>
                    <li>All drivetrain types — FWD, RWD, AWD, 4WD</li>
                    <li>Directional tyre rotation available</li>
                    <li>Combine with balance or alignment</li>
                </ul>
            </div>
            <div class="tr-booking__form">
                <?php if ($cf7_general): echo do_shortcode($cf7_general);
                else: ?>
                <p style="font-size:14px;color:#666;"><a href="<?php echo esc_url($site_url.'/contact-us/'); ?>" style="color:#111;font-weight:700;">Use our contact page →</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="tr-cta" aria-labelledby="tr-cta-h2">
    <div class="tr-w">
        <span class="tr-ey tr-ey--yellow">Ready?</span>
        <h2 class="tr-h2 tr-h2--white" id="tr-cta-h2">Book a Tyre Rotation Today</h2>
        <p>139 Cavendish Drive, Manukau &nbsp;·&nbsp; <?php echo esc_html($hours); ?></p>
        <div class="tr-cta__btns">
            <a href="#tr-booking" class="tr-btn tr-btn--primary">Book Online</a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_free)); ?>" class="tr-btn tr-btn--outline"><?php echo esc_html($phone_free); ?></a>
            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone_local)); ?>" class="tr-btn tr-btn--outline"><?php echo esc_html($phone_local); ?></a>
        </div>
        <div class="tr-cta__info">MTA Assured · Family-owned since <?php echo esc_html($established); ?> · <?php echo esc_html($years_trading); ?> years serving South Auckland</div>
    </div>
</section>

<section class="tr-faq" aria-labelledby="tr-faq-h2">
    <div class="tr-w">
        <span class="tr-ey tr-ey--dark">FAQ</span>
        <h2 class="tr-h2" id="tr-faq-h2">Common Questions</h2>
        <div class="tr-faq__grid">
            <?php foreach ($faqs as $i => $faq):
                $qid='tr-faq-q-'.$i; $aid='tr-faq-a-'.$i; ?>
            <div class="tr-faq__item">
                <button id="<?php echo $qid; ?>" class="tr-faq__q" aria-expanded="<?php echo $i===0?'true':'false'; ?>" aria-controls="<?php echo $aid; ?>">
                    <?php echo esc_html($faq['q']); ?>
                </button>
                <div id="<?php echo $aid; ?>" class="tr-faq__a" role="region" aria-labelledby="<?php echo $qid; ?>" style="<?php echo $i===0?'display:block;':''; ?>">
                    <?php echo wp_kses_post($faq['a']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="tr-related" aria-label="Related services">
    <div class="tr-w">
        <span class="tr-ey tr-ey--dark">Related Services</span>
        <h2 class="tr-h2" style="margin-bottom:0;">Also at TAAS Manukau</h2>
        <div class="tr-related__grid">
            <?php foreach ([
                ['Tyre Fitting',      '/tyre-fitting-manukau/'],
                ['Wheel Balancing',   '/wheel-balancing-manukau/'],
                ['Wheel Alignment',   '/wheel-alignment-manukau/'],
                ['Tyre Centre',       '/tyre-centre/'],
                ['Vehicle Servicing', '/vehicle-servicing/'],
                ['WOF Inspections',   '/wof/'],
            ] as $r): ?>
            <a href="<?php echo esc_url($site_url.$r[1]); ?>" class="tr-related__link"
               onmouseover="this.style.borderColor='#FFC800'" onmouseout="this.style.borderColor='#E8E8E4'">
                <?php echo esc_html($r[0]); ?> <span>→</span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</div>

<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@graph":[
    {"@type":"BreadcrumbList","itemListElement":[
      {"@type":"ListItem","position":1,"name":"Home","item":"<?php echo esc_js($site_url); ?>"},
      {"@type":"ListItem","position":2,"name":"Tyre Centre","item":"<?php echo esc_js($site_url.'/tyre-centre/'); ?>"},
      {"@type":"ListItem","position":3,"name":"Tyre Rotation Manukau","item":"<?php echo esc_js($page_url); ?>"}
    ]},
    {"@type":"FAQPage","mainEntity":[
      <?php echo implode(',', array_map(fn($f) => sprintf('{"@type":"Question","name":%s,"acceptedAnswer":{"@type":"Answer","text":%s}}', json_encode($f['q']), json_encode(strip_tags($f['a']))), $faqs)); ?>
    ]}
  ]
}
</script>
<script>
(function(){document.querySelectorAll('.tr-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var exp=this.getAttribute('aria-expanded')==='true';document.querySelectorAll('.tr-faq__q').forEach(function(b){b.setAttribute('aria-expanded','false');var a=document.getElementById(b.getAttribute('aria-controls'));if(a)a.style.display='none';});if(!exp){this.setAttribute('aria-expanded','true');var ans=document.getElementById(this.getAttribute('aria-controls'));if(ans)ans.style.display='block';}});});}());
</script>
<?php get_footer(); ?>
