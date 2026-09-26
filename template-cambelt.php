<?php
/**
 * Template Name: Cambelt & Water Pump Hub
 * Template Post Type: page
 *
 * Tony Allen Auto Service — taas.co.nz
 * URL: /cambelts-and-water-pumps/
 * CSS namespace: .cbh
 * Rebuilt to Go-Live Standard — June 2026
 * Section order: Breadcrumb → Hero(img) → Phone strip → Trust(grey) →
 *   Interval guide → Services → Finance strip → Educational → Why → Enquiry(dark)
 *   → Reviews → Related → FAQ → Suburbs/CTA
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-faqs.php';
wp_enqueue_style('taas-global', get_stylesheet_directory_uri() . '/taas-global.css');
wp_enqueue_style('taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

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
$phone_free_tel = preg_replace('/[^0-9+]/', '', $phone_free);
$maps_url       = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

// ── Hero image: page-specific → site default → solid dark fallback ────────────
$hero_img = defined('TAAS_HERO_CAMBELT') ? TAAS_HERO_CAMBELT : (defined('TAAS_HERO_DEFAULT') ? TAAS_HERO_DEFAULT : '');
$hero_bg  = $hero_img ? "background:linear-gradient(180deg,rgba(17,17,17,.86) 0%,rgba(17,17,17,.92) 100%),url('" . esc_url($hero_img) . "') center 38%/cover no-repeat;" : '';

// ── Badge helper ─────────────────────────────────────────────────────────────
function cbh_mono($initials, $size = 40) {
    $fs = strlen($initials) > 2 ? 11 : 14;
    return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" xmlns="http://www.w3.org/2000/svg"><circle cx="'.($size/2).'" cy="'.($size/2).'" r="'.($size/2).'" fill="#1A1A1A"/><text x="'.($size/2).'" y="'.($size/2+1).'" text-anchor="middle" dominant-baseline="central" fill="#FFC800" font-family="Inter,Arial,sans-serif" font-size="'.$fs.'" font-weight="800">'.$initials.'</text></svg>';
}

// ── Finance providers ────────────────────────────────────────────────────────
// To show real logos, paste each media-library URL into 'logo'. Empty = clean text badge.
$finance = [
    ['name' => 'Afterpay',      'logo' => ''],
    ['name' => 'Q Card',        'logo' => ''],
    ['name' => 'GEM Finance',   'logo' => ''],
    ['name' => 'Aotea Finance', 'logo' => ''],
];

// ── Services ─────────────────────────────────────────────────────────────────
$services = [
    ['icon' => cbh_mono('CB'), 'title' => 'Cambelt Replacement', 'desc' => 'Full cambelt kit replacement — belt, idlers, tensioner, and water pump replaced together. Manufacturer intervals or earlier if history is unknown.', 'url' => '/cambelt-replacement-manukau/', 'cta' => 'Cambelt Replacement →'],
    ['icon' => cbh_mono('WP'), 'title' => 'Water Pump Replacement', 'desc' => 'Water pump replaced during cambelt service — labour is already done. Standalone water pump replacement also available for chain-driven engines.', 'url' => '/water-pump-replacement-manukau/', 'cta' => 'Water Pump →'],
    ['icon' => cbh_mono('TC'), 'title' => 'Timing Chain Service', 'desc' => 'Timing chain inspection and service — chain stretch assessment, guide and tensioner condition check, and full replacement where required.', 'url' => '/timing-chain-service-manukau/', 'cta' => 'Timing Chain →'],
    ['icon' => cbh_mono('IT'), 'title' => 'Idlers & Tensioners', 'desc' => 'Idler pulleys and tensioners replaced as part of every cambelt kit. Worn idlers cause belt misalignment and premature failure even on a new belt.', 'url' => '#cbh-enquire', 'cta' => 'Enquire →'],
    ['icon' => cbh_mono('VS'), 'title' => 'Vehicle History Check', 'desc' => 'Unsure when your cambelt was last done? We can check service history and advise. If history is unknown, we recommend replacement regardless of km.', 'url' => '#cbh-enquire', 'cta' => 'Enquire →'],
    ['icon' => cbh_mono('IA'), 'title' => 'Interval Advice', 'desc' => 'Every make and model has a different cambelt interval — from 60,000 km up to 200,000 km. We advise the correct interval for your specific vehicle.', 'url' => '#cbh-enquire', 'cta' => 'Enquire →'],
];

// ── Interval guide ───────────────────────────────────────────────────────────
$intervals = [
    ['brand' => 'Japanese Vehicles', 'km' => '60,000–100,000 km', 'note' => 'Toyota, Honda, Nissan, Subaru, Mitsubishi — intervals vary by engine. Many Honda and Subaru engines at 90,000–100,000 km. Always check your specific model.'],
    ['brand' => 'European Vehicles', 'km' => '60,000–120,000 km', 'note' => 'Volkswagen, Audi, BMW diesel, Peugeot, Renault — often shorter intervals and more labour-intensive to access. Age limit also applies.'],
    ['brand' => 'Newer Models', 'km' => 'Up to 200,000 km', 'note' => 'Some newer engines specify extended intervals. We apply caution on any cambelt over 150,000 km regardless of the stated interval — rubber ages even without use.'],
];

// ── Why points ───────────────────────────────────────────────────────────────
$why_points = [
    'Full kit approach — belt, water pump, idlers, and tensioner replaced together',
    'Estimate before we start — no surprise invoices',
    'Manufacturer intervals followed, or sooner if history is unknown',
    'Caution applied on any belt over 150,000 km regardless of stated interval',
    'All makes and models — Japanese, Korean, European',
    $customers . ' customers serviced — South Auckland\'s largest independent workshop',
    'MTA Assured workshop — established in Manukau since ' . $established,
    'NZTA Authorised — ' . $ms_number,
];

// ── Suburbs (17) ─────────────────────────────────────────────────────────────
$suburbs = [
    ['name' => 'Manukau', 'slug' => 'manukau'], ['name' => 'Papatoetoe', 'slug' => 'papatoetoe'],
    ['name' => 'Māngere', 'slug' => 'mangere'], ['name' => 'Māngere Bridge', 'slug' => 'mangere-bridge'],
    ['name' => 'Ōtāhuhu', 'slug' => 'otahuhu'], ['name' => 'Wiri', 'slug' => 'wiri'],
    ['name' => 'Ōtara', 'slug' => 'otara'], ['name' => 'Hunters Corner', 'slug' => 'hunters-corner'],
    ['name' => 'Clover Park', 'slug' => 'clover-park'], ['name' => 'Flat Bush', 'slug' => 'flat-bush'],
    ['name' => 'Manurewa', 'slug' => 'manurewa'], ['name' => 'Clendon', 'slug' => 'clendon'],
    ['name' => 'Weymouth', 'slug' => 'weymouth'], ['name' => 'Takanini', 'slug' => 'takanini'],
    ['name' => 'Papakura', 'slug' => 'papakura'], ['name' => 'Howick', 'slug' => 'howick'],
    ['name' => 'Botany', 'slug' => 'botany'],
];

// ── FAQ from shared library ──────────────────────────────────────────────────
$faqs = [
    $taas_faqs['cb_when_replace'],
    $taas_faqs['cb_water_pump'],
    $taas_faqs['cb_vs_chain'],
    $taas_faqs['cb_snaps'],
    $taas_faqs['cb_duration'],
    $taas_faqs['cb_high_km'],
    $taas_faqs['cb_cost'],
    $taas_faqs['cb_european'],
    $taas_faqs['cb_finance'],
    $taas_faqs['cb_warranty'],
    $taas_faqs['cb_location'],
];

// ── Schema ───────────────────────────────────────────────────────────────────
$schema_faqs = [];
foreach ($faqs as $faq) {
    $schema_faqs[] = ['@type' => 'Question', 'name' => $faq['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($faq['a'])]];
}
$schema = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $site_url],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $site_url . '/services/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Cambelts & Water Pumps', 'item' => $page_url],
        ]],
        ['@type' => ['AutoRepair', 'LocalBusiness'], '@id' => $site_url . '/#organization', 'name' => 'Tony Allen Auto Service', 'url' => $site_url, 'description' => 'Cambelt and water pump replacement in Manukau, South Auckland. Full kit — belt, water pump, idlers, tensioner. All makes and models. NZTA Authorised. MTA Assured. Established ' . $established . '.', 'telephone' => [$phone_free, $phone_local], 'email' => $email, 'foundingDate' => '1985-10', 'address' => ['@type' => 'PostalAddress', 'streetAddress' => '139 Cavendish Drive', 'addressLocality' => 'Manukau', 'addressRegion' => 'Auckland', 'postalCode' => '2104', 'addressCountry' => 'NZ'], 'geo' => ['@type' => 'GeoCoordinates', 'latitude' => -36.9936, 'longitude' => 174.8671], 'openingHoursSpecification' => [['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '07:30', 'closes' => '17:00']], 'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $rating, 'reviewCount' => preg_replace('/\D+/', '', $reviews), 'bestRating' => '5'], 'paymentAccepted' => 'Cash, EFTPOS, Visa, Mastercard, Afterpay, Q Card, GEM Finance, Aotea Finance', 'priceRange' => '$$', 'areaServed' => 'South Auckland', 'sameAs' => ['https://www.facebook.com/tonyallenautoservice/', 'https://www.instagram.com/tonyallenautoservice/', 'https://www.linkedin.com/company/7059060'], 'memberOf' => ['@type' => 'Organization', 'name' => 'Motor Trade Association (MTA)']],
        ['@type' => 'SpeakableSpecification', 'cssSelector' => ['.cbh-hero__sub', '.cbh-faq__item:first-of-type .cbh-faq__a']],
        ['@type' => 'FAQPage', 'mainEntity' => $schema_faqs],
    ],
];

get_header();
echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . '</script>';
?>
<style>
/* ── Reset ─────────────────────────────────────────────────────────────────── */
.page-template-template-cambelt .site-content,.page-template-template-cambelt .entry-content,.page-template-template-cambelt .entry-header,.page-template-template-cambelt article,.page-template-template-cambelt #primary,.page-template-template-cambelt #content{padding:0!important;margin:0!important;max-width:100%!important;}
body.page-template-template-cambelt{overflow-x:hidden; -webkit-text-size-adjust:100%; text-size-adjust:100%; }
body,h1,h2,h3,h4,h5,h6,p,li,td,span,div,a,label,input,textarea,select,button{font-family:var(--taas-font,'Inter',Arial,sans-serif);}

.cbh-w{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;}

/* ── Breadcrumb ───────────────────────────────────────────────────────────── */
.cbh-crumb{background:var(--taas-black,#111);border-bottom:1px solid #242424;}
.cbh-crumb__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:11px 24px;font-size:13px;font-weight:300;color:#777;}
.cbh-crumb__inner a{color:#999;text-decoration:none;}
.cbh-crumb__inner a:hover{color:var(--taas-yellow,#FFC800);}
.cbh-crumb__sep{margin:0 8px;color:#444;}
.cbh-crumb__cur{color:#bbb;}

/* ── Hero ──────────────────────────────────────────────────────────────────── */
.cbh-hero{background:var(--taas-black,#111);padding:64px 0 56px;position:relative;overflow:hidden;}
.cbh-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 85% 50%,rgba(255,200,0,.06) 0%,transparent 65%);pointer-events:none;}
.cbh-hero__inner{display:grid;grid-template-columns:1fr 290px;gap:48px;align-items:start;position:relative;z-index:1;}
.cbh-eye{display:inline-block;font-size:var(--taas-eye-size,10px);font-weight:700;letter-spacing:var(--taas-eye-ls,0.12em);text-transform:uppercase;padding:5px 13px;border-radius:3px;margin-bottom:16px;}
.cbh-eye--yellow{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.cbh-eye--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-yellow,#FFC800);}
.cbh-hero h1{font-size:var(--taas-h1-hub,clamp(34px,5.5vw,54px));font-weight:800;color:var(--taas-white,#fff);letter-spacing:-0.02em;line-height:1.1;margin:0 0 16px;}
.cbh-hero h1 span{color:var(--taas-yellow,#FFC800);}
.cbh-hero__sub{font-size:16px;font-weight:300;color:#bbb;max-width:560px;margin:0 0 22px;line-height:1.75;}
.cbh-hero__signal{display:inline-block;background:rgba(255,200,0,.1);border:1px solid rgba(255,200,0,.25);border-radius:var(--taas-radius,6px);padding:11px 18px;font-size:14px;font-weight:500;color:var(--taas-yellow,#FFC800);margin-bottom:24px;line-height:1.5;}
.cbh-hero__ctas{display:flex;flex-wrap:wrap;gap:12px;}
.cbh-hero__urgency{margin-top:24px;background:rgba(192,57,43,.14);border:1px solid rgba(192,57,43,.35);border-left:4px solid var(--taas-alert,#C0392B);border-radius:var(--taas-radius,6px);padding:14px 18px;font-size:14px;font-weight:300;color:#f3b0b0;line-height:1.75;max-width:600px;}
.cbh-hero__urgency strong{color:#ff7a7a;font-weight:700;}
.cbh-sidebar{background:#1c1c1c;border:1px solid #313131;border-radius:var(--taas-radius,6px);padding:24px;}
.cbh-sidebar__title{font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--taas-yellow,#FFC800);margin-bottom:14px;}
.cbh-sidebar__list{list-style:none;padding:0;margin:0 0 20px;display:flex;flex-direction:column;gap:8px;}
.cbh-sidebar__list li{font-size:13px;font-weight:300;color:#ccc;padding-left:18px;position:relative;line-height:1.5;}
.cbh-sidebar__list li::before{content:'✓';position:absolute;left:0;color:var(--taas-yellow,#FFC800);font-weight:700;}
.cbh-sidebar hr{border:none;border-top:1px solid #313131;margin:0 0 16px;}
.cbh-sidebar__phone{display:block;font-size:22px;font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin-bottom:4px;line-height:1.1;}
.cbh-sidebar__phone:hover{opacity:.65;}
.cbh-sidebar__detail{font-size:12px;font-weight:300;color:#888;line-height:1.6;}

/* ── Phone strip ──────────────────────────────────────────────────────────── */
.cbh-phonestrip{background:var(--taas-yellow,#FFC800);}
.cbh-phonestrip__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;text-align:center;}
.cbh-phonestrip__label{font-size:14px;font-weight:600;color:var(--taas-dark,#1A1A1A);}
.cbh-phonestrip__num{display:inline-flex;align-items:center;gap:8px;font-size:19px;font-weight:800;color:var(--taas-dark,#1A1A1A);text-decoration:none;letter-spacing:-0.01em;}
.cbh-phonestrip__num:hover{opacity:.65;}

/* ── Trust strip (grey) ───────────────────────────────────────────────────── */
.cbh-trust{background:var(--taas-panel,#F7F7F5);border-bottom:1px solid var(--taas-border,#E8E8E4);}
.cbh-trust__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:16px 24px;display:flex;gap:36px;align-items:center;justify-content:center;flex-wrap:wrap;}
.cbh-trust__item{font-size:14px;font-weight:600;color:var(--taas-body,#333);display:flex;align-items:center;gap:7px;white-space:nowrap;}
.cbh-trust__item::before{content:'✓';color:var(--taas-yellow,#FFC800);font-weight:900;}

/* ── Sections ─────────────────────────────────────────────────────────────── */
.cbh-section{padding:var(--taas-sec-pad,72px) 0;}
.cbh-section--white{background:var(--taas-white,#fff);}
.cbh-section--grey{background:var(--taas-panel,#F7F7F5);}
.cbh-section--dark{background:var(--taas-dark,#1A1A1A);}
.cbh-h2{font-size:var(--taas-h2,clamp(26px,3.5vw,36px));font-weight:700;color:var(--taas-black,#111);letter-spacing:-0.01em;margin:0 0 12px;line-height:1.15;}
.cbh-h2--white{color:var(--taas-white,#fff);}
.cbh-lead{font-size:16px;font-weight:300;color:var(--taas-mid,#666);max-width:660px;margin:0 0 32px;line-height:1.75;}
.cbh-section--dark .cbh-lead{color:#aaa;}

/* ── Educational body ─────────────────────────────────────────────────────── */
.cbh-edu{max-width:780px;}
.cbh-edu p{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0 0 20px;}
.cbh-edu h3{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin:32px 0 12px;}
.cbh-edu__alert{background:rgba(192,57,43,.06);border-left:4px solid var(--taas-alert,#C0392B);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:16px 20px;margin:0 0 28px;}
.cbh-edu__alert p{font-size:14px;font-weight:300;color:var(--taas-body,#333);line-height:1.75;margin:0;}
.cbh-edu__alert strong{color:var(--taas-alert,#C0392B);font-weight:700;}
.cbh-edu a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.cbh-edu a:hover{text-decoration:underline;}

/* ── Interval cards ───────────────────────────────────────────────────────── */
.cbh-int-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;}
.cbh-int-card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;border-top:3px solid var(--taas-yellow,#FFC800);}
.cbh-int-card__brand{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:6px;}
.cbh-int-card__km{font-size:24px;font-weight:800;color:var(--taas-yellow2,#e6b400);margin-bottom:6px;}
.cbh-int-card__note{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.cbh-caution{margin-top:28px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-left:5px solid var(--taas-alert,#C0392B);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;padding:20px 24px;max-width:840px;}
.cbh-caution p{font-size:15px;font-weight:300;color:var(--taas-body,#333);margin:0;line-height:1.75;}
.cbh-caution strong{color:var(--taas-alert,#C0392B);font-weight:700;}

/* ── Service cards ────────────────────────────────────────────────────────── */
.cbh-svc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;}
.cbh-svc-card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:24px;display:flex;flex-direction:column;gap:10px;text-decoration:none;transition:border-color .15s,box-shadow .15s;border-top:3px solid transparent;}
.cbh-svc-card:hover{border-top-color:var(--taas-yellow,#FFC800);box-shadow:0 4px 16px rgba(0,0,0,.08);}
.cbh-svc-card__title{font-size:16px;font-weight:700;color:var(--taas-black,#111);}
.cbh-svc-card__desc{font-size:14px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;flex:1;}
.cbh-svc-card__link{font-size:13px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;}

/* ── Finance strip ────────────────────────────────────────────────────────── */
.cbh-finance{background:#FFFBEA;border-top:1px solid #F0E4B8;border-bottom:1px solid #F0E4B8;padding:26px 0;}
.cbh-finance__inner{max-width:var(--taas-container,1140px);margin:0 auto;padding:0 24px;display:flex;align-items:center;justify-content:center;gap:20px 28px;flex-wrap:wrap;text-align:center;}
.cbh-finance__text{font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}
.cbh-finance__text strong{font-weight:700;color:var(--taas-black,#111);}
.cbh-finance__logos{display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:center;}
.cbh-fin{display:inline-flex;align-items:center;height:34px;padding:0 14px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:5px;font-size:12px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.cbh-fin img{max-height:20px;width:auto;display:block;}
.cbh-finance__link{font-size:14px;font-weight:700;color:var(--taas-yellow2,#e6b400);text-decoration:none;white-space:nowrap;}
.cbh-finance__link:hover{text-decoration:underline;}

/* ── Why (grey) ───────────────────────────────────────────────────────────── */
.cbh-why__inner{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.cbh-why__points{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;}
.cbh-why__point{display:flex;gap:12px;align-items:flex-start;font-size:15px;font-weight:300;color:var(--taas-body,#333);line-height:1.6;}
.cbh-why__point::before{content:'✓';color:var(--taas-dark,#1A1A1A);background:var(--taas-yellow,#FFC800);font-size:11px;font-weight:700;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;}
.cbh-why__card{background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);padding:32px;}
.cbh-why__card h3{font-size:18px;font-weight:700;color:var(--taas-black,#111);margin-bottom:12px;}
.cbh-why__card p{font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;margin-bottom:20px;}
.cbh-why__links{display:flex;flex-direction:column;gap:10px;margin-bottom:24px;}
.cbh-why__links a{display:flex;align-items:center;gap:8px;font-size:14px;color:var(--taas-yellow2,#e6b400);text-decoration:none;font-weight:600;}
.cbh-why__links a:hover{text-decoration:underline;}

/* ── Enquiry (dark) ───────────────────────────────────────────────────────── */
.cbh-enquiry{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.cbh-enquiry__list{list-style:none;padding:0;display:flex;flex-direction:column;gap:12px;margin:0 0 22px;}
.cbh-enquiry__list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;font-weight:300;color:#ccc;line-height:1.6;}
.cbh-enquiry__list li span{color:var(--taas-yellow,#FFC800);font-weight:700;font-size:15px;flex-shrink:0;}
.cbh-enquiry__phone{display:block;font-size:clamp(28px,4vw,38px);font-weight:800;color:var(--taas-yellow,#FFC800);text-decoration:none;margin:0 0 6px;line-height:1.1;}
.cbh-enquiry__phone:hover{opacity:.65;}
.cbh-enquiry__detail{font-size:14px;font-weight:300;color:#aaa;line-height:1.7;margin-bottom:20px;}
.cbh-enquiry__detail strong{color:#fff;font-weight:700;}
.cbh-enquiry__detail a{color:#aaa;text-decoration:underline;}
.cbh-enquiry__badges{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px;}
.cbh-enquiry__badge{display:inline-flex;align-items:center;height:30px;padding:0 12px;background:#fff;border-radius:5px;font-size:11px;font-weight:700;color:var(--taas-dark,#1A1A1A);}
.cbh-enquiry__badge img{max-height:18px;width:auto;display:block;}
.cbh-enquiry__note{padding:14px 18px;background:#252525;border-left:3px solid var(--taas-yellow,#FFC800);border-radius:0 var(--taas-radius,6px) var(--taas-radius,6px) 0;font-size:14px;font-weight:300;color:#ccc;line-height:1.7;}
.cbh-enquiry__note strong{color:#fff;font-weight:700;}
.cbh-enquiry__note a{color:var(--taas-yellow,#FFC800);font-weight:700;text-decoration:none;}
.cbh-enquiry__form{background:#252525;border:1px solid #383838;border-radius:var(--taas-radius,6px);padding:30px;}
.cbh-enquiry__form-title{font-size:16px;font-weight:700;color:#fff;margin-bottom:18px;}
.cbh-section--dark .wpcf7 label,.cbh-section--dark .wpcf7 p,.cbh-section--dark .wpcf7 span:not(.wpcf7-spinner){color:#ccc!important;font-size:14px;font-weight:300;}
.cbh-section--dark .wpcf7 input[type="text"],.cbh-section--dark .wpcf7 input[type="email"],.cbh-section--dark .wpcf7 input[type="tel"],.cbh-section--dark .wpcf7 textarea,.cbh-section--dark .wpcf7 select{background:#1c1c1c;border:1px solid #444;color:#fff;border-radius:var(--taas-radius,6px);padding:11px 14px;width:100%;box-sizing:border-box;font-size:15px;font-family:var(--taas-font,'Inter',Arial,sans-serif);}
.cbh-section--dark .wpcf7 input::placeholder,.cbh-section--dark .wpcf7 textarea::placeholder{color:#666;}
.cbh-section--dark .wpcf7 input:focus,.cbh-section--dark .wpcf7 textarea:focus{outline:none;border-color:var(--taas-yellow,#FFC800);}
.cbh-section--dark .wpcf7 input[type="submit"]{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border:none;border-radius:var(--taas-radius,6px);padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;cursor:pointer;width:100%;text-transform:uppercase;letter-spacing:0.06em;margin-top:4px;transition:background .15s;}
.cbh-section--dark .wpcf7 input[type="submit"]:hover{background:var(--taas-yellow2,#e6b400);}

/* ── FAQ ──────────────────────────────────────────────────────────────────── */
.cbh-faq__list{display:flex;flex-direction:column;gap:0;margin:28px auto 0;max-width:780px;}
.cbh-faq__item{border-bottom:1px solid var(--taas-border,#E8E8E4);}
.cbh-faq__q{width:100%;text-align:left;background:none;border:none;padding:18px 40px 18px 0;font-family:var(--taas-font,'Inter',Arial,sans-serif);font-size:15px;font-weight:700;color:var(--taas-black,#111);cursor:pointer;position:relative;line-height:1.4;display:block;}
.cbh-faq__q::after{content:'+';position:absolute;right:0;top:50%;transform:translateY(-50%);font-size:22px;font-weight:400;color:var(--taas-mid,#666);}
.cbh-faq__item--open .cbh-faq__q::after{content:'−';}
.cbh-faq__a{display:none;padding:0 0 18px;font-size:15px;font-weight:300;color:var(--taas-mid,#666);line-height:1.75;}
.cbh-faq__a a{color:var(--taas-yellow2,#e6b400);font-weight:600;text-decoration:none;}
.cbh-faq__a a:hover{text-decoration:underline;}
.cbh-faq__item--open .cbh-faq__a{display:block;}

/* ── Related / pills / closing CTA / buttons ──────────────────────────────── */
.cbh-related__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;margin-top:24px;}
.cbh-related__link{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:var(--taas-radius,6px);text-decoration:none;font-size:14px;font-weight:700;color:var(--taas-black,#111);transition:border-color .15s;}
.cbh-related__link:hover{border-color:var(--taas-yellow,#FFC800);}
.cbh-related__link span{color:var(--taas-yellow,#FFC800);font-size:18px;}
.cbh-suburb-pills{display:flex;flex-wrap:wrap;gap:8px;margin-top:16px;}
.cbh-suburb-pill{display:inline-block;padding:7px 18px;background:var(--taas-white,#fff);border:1px solid var(--taas-border,#E8E8E4);border-radius:100px;font-size:14px;font-weight:500;color:var(--taas-body,#333);text-decoration:none;transition:all .15s;}
.cbh-suburb-pill:hover{background:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}
.cbh-close{margin-top:40px;border-top:1px solid var(--taas-border,#E8E8E4);padding-top:32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.cbh-close__text{font-size:16px;font-weight:700;color:var(--taas-black,#111);}
.cbh-close__text span{display:block;font-size:13px;font-weight:300;color:var(--taas-mid,#666);margin-top:4px;}
.cbh-close__ctas{display:flex;gap:12px;flex-wrap:wrap;}
.cbh-btn{display:inline-flex;align-items:center;gap:8px;padding:14px 28px;font-size:var(--taas-btn-size,14px);font-weight:700;border-radius:var(--taas-radius,6px);text-decoration:none;transition:all .18s ease;border:2px solid transparent;white-space:nowrap;}
.cbh-btn--primary{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);border-color:var(--taas-yellow,#FFC800);}
.cbh-btn--primary:hover{background:var(--taas-yellow2,#e6b400);border-color:var(--taas-yellow2,#e6b400);}
.cbh-btn--dark{background:var(--taas-dark,#1A1A1A);color:var(--taas-white,#fff);border-color:var(--taas-dark,#1A1A1A);}
.cbh-btn--dark:hover{background:#000;}
.cbh-btn--outline{background:transparent;color:var(--taas-yellow,#FFC800);border-color:var(--taas-yellow,#FFC800);}
.cbh-btn--outline:hover{background:var(--taas-yellow,#FFC800);color:var(--taas-dark,#1A1A1A);}

/* ── Responsive ───────────────────────────────────────────────────────────── */
@media(max-width:960px){
  .cbh-hero__inner,.cbh-why__inner{grid-template-columns:1fr;}
  .cbh-enquiry{grid-template-columns:1fr;gap:32px;}
  .cbh-sidebar{display:none;}
  .cbh-svc-grid,.cbh-int-grid{grid-template-columns:1fr 1fr;}
}
@media(max-width:640px){
  .cbh-hero{padding:48px 0 40px;}
  .cbh-hero h1{font-size:clamp(28px,7vw,42px);}
  .cbh-hero__sub{font-size:14px;}
  .cbh-section{padding:48px 0;}
  .cbh-h2{font-size:clamp(22px,5vw,28px);}
  .cbh-lead{font-size:14px;}
  .cbh-edu p,.cbh-caution p,.cbh-why__point,.cbh-why__card p,.cbh-enquiry__list li,.cbh-finance__text{font-size:14px;}
  .cbh-int-card__note,.cbh-svc-card__desc{font-size:13px;}
  .cbh-trust__inner{gap:8px 20px;}
  .cbh-trust__item{font-size:12px;}
  .cbh-phonestrip__num{font-size:17px;}
  .cbh-svc-grid,.cbh-int-grid{grid-template-columns:1fr;}
  .cbh-faq__q{font-size:14px;padding:16px 32px 16px 0;}
  .cbh-faq__a{font-size:13px;}
  .cbh-hero__ctas{flex-direction:column;align-items:stretch;}
  .cbh-hero__ctas .cbh-btn{justify-content:center;text-align:center;}
  .cbh-enquiry{display:flex;flex-direction:column-reverse;}
  .cbh-close{flex-direction:column;align-items:flex-start;}
}
</style>

<!-- ── BREADCRUMB ───────────────────────────────────────────────────────────── -->
<nav class="cbh-crumb" aria-label="Breadcrumb"><div class="cbh-crumb__inner"><a href="<?php echo esc_url($site_url); ?>">Home</a><span class="cbh-crumb__sep">›</span><a href="<?php echo esc_url($site_url . '/services/'); ?>">Services</a><span class="cbh-crumb__sep">›</span><span class="cbh-crumb__cur">Cambelts &amp; Water Pumps</span></div></nav>

<!-- ── HERO ─────────────────────────────────────────────────────────────────── -->
<section class="cbh-hero"<?php if ($hero_bg) echo ' style="' . $hero_bg . '"'; ?>>
  <div class="cbh-w">
    <div class="cbh-hero__inner">
      <div>
        <span class="cbh-eye cbh-eye--yellow">Cambelts &amp; Water Pumps — Manukau</span>
        <h1>Cambelt &amp; Water<br><span>Pump Replacement</span></h1>
        <p class="cbh-hero__sub">Full cambelt kit — belt, water pump, idlers, and tensioners replaced together. Estimate before we start. All makes and models. <?php echo esc_html($years); ?> years of workshop experience in South Auckland.</p>
        <div class="cbh-hero__signal">Full kit — belt, pump, idlers &amp; tensioner · Estimate before we start · All makes &amp; models</div>
        <div class="cbh-hero__ctas">
          <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbh-btn cbh-btn--primary"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>Call <?php echo esc_html($phone_free); ?></a>
          <a href="#cbh-enquire" class="cbh-btn cbh-btn--outline">Book Online</a>
        </div>
        <div class="cbh-hero__urgency"><strong>⚠ Do not delay a cambelt replacement.</strong> A snapped cambelt on an interference engine causes immediate, catastrophic engine damage — bent valves, damaged pistons, potential engine write-off. The replacement cost is a fraction of an engine rebuild.</div>
      </div>
      <div class="cbh-sidebar">
        <div class="cbh-sidebar__title">What We Replace</div>
        <ul class="cbh-sidebar__list">
          <li>Cambelt (timing belt)</li><li>Water pump — same labour</li><li>Idler pulleys</li><li>Belt tensioner</li><li>Cam &amp; crank seals where applicable</li><li>Timing chain tensioners</li><li>All makes &amp; models</li>
        </ul>
        <hr>
        <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbh-sidebar__phone"><?php echo esc_html($phone_free); ?></a>
        <div class="cbh-sidebar__detail"><?php echo esc_html($phone_local); ?><br>Mon–Fri 7:30am–5:00pm</div>
      </div>
    </div>
  </div>
</section>

<!-- ── PHONE STRIP ──────────────────────────────────────────────────────────── -->
<div class="cbh-phonestrip"><div class="cbh-phonestrip__inner"><span class="cbh-phonestrip__label">Cambelt due, or history unknown?</span><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbh-phonestrip__num"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg><?php echo esc_html($phone_free); ?></a></div></div>

<!-- ── TRUST STRIP ──────────────────────────────────────────────────────────── -->
<div class="cbh-trust"><div class="cbh-trust__inner"><div class="cbh-trust__item">MTA Assured</div><div class="cbh-trust__item">NZTA Authorised</div><div class="cbh-trust__item">Estimate Before We Start</div><div class="cbh-trust__item">Full Kit Approach</div><div class="cbh-trust__item"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Reviews</div><div class="cbh-trust__item">Since <?php echo esc_html($established); ?></div></div></div>

<!-- ── INTERVAL GUIDE ── Grey ──────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--grey"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Replacement Intervals</span>
  <h2 class="cbh-h2">When Does Your Cambelt Need Replacing?</h2>
  <p class="cbh-lead">Intervals vary widely by make and model — from 60,000 km on some older Japanese engines to 200,000 km on some newer vehicles. Age matters as much as kilometres.</p>
  <div class="cbh-int-grid"><?php foreach ($intervals as $iv): ?>
    <div class="cbh-int-card"><div class="cbh-int-card__brand"><?php echo esc_html($iv['brand']); ?></div><div class="cbh-int-card__km"><?php echo esc_html($iv['km']); ?></div><p class="cbh-int-card__note"><?php echo esc_html($iv['note']); ?></p></div>
  <?php endforeach; ?></div>
  <div class="cbh-caution"><p><strong>Our recommendation:</strong> Regardless of the manufacturer's specified interval, we recommend replacement on any cambelt that has reached <strong>150,000 km</strong>, any belt where the replacement history is unknown, and any belt showing age-related cracking or hardening. The cost of a new cambelt is always less than the cost of an engine rebuild.</p></div>
</div></section>

<!-- ── SERVICES ── White ──────────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--white"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Our Services</span>
  <h2 class="cbh-h2">Cambelt &amp; Water Pump Services — All In-House</h2>
  <p class="cbh-lead">Everything done at <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>. No outsourcing. Estimate before we start.</p>
  <div class="cbh-svc-grid"><?php foreach ($services as $svc): ?>
    <a href="<?php echo (strpos($svc['url'], '#') === 0) ? esc_attr($svc['url']) : esc_url($site_url . $svc['url']); ?>" class="cbh-svc-card"><?php echo $svc['icon']; ?><div class="cbh-svc-card__title"><?php echo esc_html($svc['title']); ?></div><div class="cbh-svc-card__desc"><?php echo esc_html($svc['desc']); ?></div><span class="cbh-svc-card__link"><?php echo $svc['cta']; ?></span></a>
  <?php endforeach; ?></div>
</div></section>

<!-- ── FINANCE STRIP ────────────────────────────────────────────────────────── -->
<div class="cbh-finance"><div class="cbh-finance__inner">
  <div class="cbh-finance__text"><strong>Finance available</strong> — spread the cost of your cambelt over time, interest-free options available.</div>
  <div class="cbh-finance__logos"><?php foreach ($finance as $f): ?><span class="cbh-fin"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
  <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>" class="cbh-finance__link">View finance options →</a>
</div></div>

<!-- ── WHAT IS A CAMBELT ── White ──────────────────────────────────────────── -->
<section class="cbh-section cbh-section--white"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Understanding Your Cambelt</span>
  <h2 class="cbh-h2">What Is a Cambelt — and Why Does It Matter?</h2>
  <div class="cbh-edu">
    <p>A cambelt — also called a timing belt — is a reinforced rubber belt that connects the crankshaft to the camshaft inside your engine. It controls the precise timing of your engine's valves, ensuring they open and close at exactly the right moment relative to the pistons. Without it, the engine does not run.</p>

    <h3>Interference Engines — Why a Snapped Belt Is Catastrophic</h3>
    <p>The majority of modern vehicles use what is called an interference engine. In an interference engine, the pistons and valves occupy the same space inside the cylinder — just never at the same time. The cambelt ensures this timing is maintained. When a cambelt snaps on an interference engine, the pistons and valves collide. The result is bent valves, damaged pistons, and in severe cases a destroyed cylinder head or engine block. An engine rebuild or full replacement is often the outcome — typically $5,000 or more, compared to a cambelt replacement typically in the range of $800–$1,500 when done on time.</p>
    <div class="cbh-edu__alert"><p><strong>The key point:</strong> A cambelt does not give warning signs before it fails. It does not stretch, squeal, or slip. It works — until it snaps. This is why cambelt replacement is time-and-kilometre-based preventative maintenance, not a repair you wait for symptoms to trigger.</p></div>

    <h3>Why the Water Pump Is Replaced at the Same Time</h3>
    <p>On most vehicles, the water pump is driven by the cambelt — which means it is fully accessible only when the cambelt is removed. Fitting a new water pump during a cambelt replacement adds relatively little to the cost because the labour to access it is already done. If the water pump fails six months after a cambelt replacement, you pay the full labour cost again to access it. We include the water pump as standard in every cambelt kit replacement — belt, water pump, idler pulleys, and tensioner.</p>

    <h3>Cambelt vs Timing Chain — What Does Your Vehicle Have?</h3>
    <p>A timing chain is a metal chain that does the same job as a cambelt. Timing chains are designed to last the life of the engine — but only if oil changes are maintained. In practice, chains stretch and tensioners wear, particularly on engines with poor oil change history. Timing chains are not maintenance-free. If your engine has a timing chain rather than a belt, we inspect for chain stretch, tensioner wear, and guide condition — and carry out replacement where required. Not sure which your vehicle has? Call us on <a href="tel:<?php echo esc_attr($phone_free_tel); ?>"><?php echo esc_html($phone_free); ?></a> with your make and model and we will advise.</p>
  </div>
</div></section>

<!-- ── WHY CHOOSE TAAS ── Grey ─────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--grey"><div class="cbh-w"><div class="cbh-why__inner">
  <div>
    <span class="cbh-eye cbh-eye--dark">Why Choose TAAS</span>
    <h2 class="cbh-h2">South Auckland's Cambelt Workshop Since <?php echo esc_html($established); ?></h2>
    <p class="cbh-lead" style="margin-bottom:24px;">We replace cambelts properly — full kit, correct interval, with the water pump and associated components done at the same time. Not just the belt.</p>
    <ul class="cbh-why__points"><?php foreach ($why_points as $pt): ?><li class="cbh-why__point"><?php echo esc_html($pt); ?></li><?php endforeach; ?></ul>
  </div>
  <div class="cbh-why__card">
    <h3>Often Done at the Same Visit</h3>
    <p>If your vehicle is in for a cambelt, it makes sense to carry out other time-based service items at the same time — cam seals, coolant flush, spark plugs. One visit, less total labour cost.</p>
    <div class="cbh-why__links"><?php foreach ([['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Cooling System Service','url'=>'/cooling-system/'],['label'=>'Warrant of Fitness','url'=>'/wof/'],['label'=>'Finance Options','url'=>'/finance-options/']] as $ex): ?><a href="<?php echo esc_url($site_url . $ex['url']); ?>"><span>→</span><?php echo esc_html($ex['label']); ?></a><?php endforeach; ?></div>
    <a href="#cbh-enquire" class="cbh-btn cbh-btn--dark">Book a Cambelt Service</a>
  </div>
</div></div></section>

<!-- ── ENQUIRY ── Dark ─────────────────────────────────────────────────────── -->
<section id="cbh-enquire" class="cbh-section cbh-section--dark"><div class="cbh-w"><div class="cbh-enquiry">
  <div>
    <span class="cbh-eye cbh-eye--yellow">Book or Enquire</span>
    <h2 class="cbh-h2 cbh-h2--white">Enquire About Cambelt &amp; <span style="color:var(--taas-yellow);">Water Pump Service</span></h2>
    <p style="font-size:16px;font-weight:300;color:#aaa;line-height:1.75;margin-bottom:20px;">Tell us your make, model and year — or your kilometres if you know them — and we'll advise on the correct interval and give you an estimate before any work begins.</p>
    <ul class="cbh-enquiry__list"><?php foreach (['Full kit — belt, water pump, idlers, and tensioner','Written estimate before any work begins','All makes and models — Japanese, Korean, European','Finance available — pay over time'] as $ck): ?><li><span>✓</span><?php echo esc_html($ck); ?></li><?php endforeach; ?></ul>
    <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbh-enquiry__phone"><?php echo esc_html($phone_free); ?></a>
    <div class="cbh-enquiry__detail"><strong>Tony Allen Auto Service</strong><br><a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener">139 Cavendish Drive, Manukau</a><br><?php echo esc_html($hours); ?> · <?php echo esc_html($phone_local); ?></div>
    <div class="cbh-enquiry__badges"><?php foreach ($finance as $f): ?><span class="cbh-enquiry__badge"><?php if (!empty($f['logo'])): ?><img src="<?php echo esc_url($f['logo']); ?>" alt="<?php echo esc_attr($f['name']); ?>"><?php else: echo esc_html($f['name']); endif; ?></span><?php endforeach; ?></div>
    <div class="cbh-enquiry__note"><strong>Estimate before we start.</strong> We confirm the price for your specific vehicle before any work begins — no surprise invoices. <a href="<?php echo esc_url($site_url . '/finance-options/'); ?>">Finance options →</a></div>
  </div>
  <div class="cbh-enquiry__form">
    <div class="cbh-enquiry__form-title">Send Us Your Details</div>
    <?php if ($cf7_general): echo do_shortcode($cf7_general); else: ?>
    <p style="font-size:14px;font-weight:300;color:#ccc;">Call <a href="tel:<?php echo esc_attr($phone_free_tel); ?>" style="font-weight:700;color:var(--taas-yellow);"><?php echo esc_html($phone_free); ?></a> or <a href="<?php echo esc_url($site_url . '/contact-us/'); ?>" style="font-weight:700;color:var(--taas-yellow);">use our contact form</a>.</p>
    <?php endif; ?>
  </div>
</div></div></section>

<!-- ── REVIEWS ── White ────────────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--white"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Customer Reviews</span>
  <h2 class="cbh-h2"><?php echo esc_html($rating); ?>★ · <?php echo esc_html($reviews); ?> Google Reviews</h2>
  <?php if ($reviews_widget) echo do_shortcode($reviews_widget); ?>
</div></section>

<!-- ── RELATED ── Grey ─────────────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--grey"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Related Services</span>
  <h2 class="cbh-h2">Often Done at the Same Time</h2>
  <div class="cbh-related__grid"><?php foreach ([['label'=>'Vehicle Servicing','url'=>'/vehicle-servicing/'],['label'=>'Cooling System Service','url'=>'/cooling-system/'],['label'=>'Engine Repairs','url'=>'/engine-repairs/'],['label'=>'Steering & Suspension','url'=>'/steering-and-suspension/'],['label'=>'Warrant of Fitness','url'=>'/wof/'],['label'=>'Finance Options','url'=>'/finance-options/']] as $r): ?><a href="<?php echo esc_url($site_url . $r['url']); ?>" class="cbh-related__link"><?php echo esc_html($r['label']); ?><span>→</span></a><?php endforeach; ?></div>
</div></section>

<!-- ── FAQ ── White ─────────────────────────────────────────────────────────── -->
<section class="cbh-section cbh-section--white"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">Common Questions</span>
  <h2 class="cbh-h2">Cambelt &amp; Water Pump FAQ</h2>
  <div class="cbh-faq__list"><?php foreach ($faqs as $i => $faq): ?>
    <div class="cbh-faq__item<?php echo $i === 0 ? ' cbh-faq__item--open' : ''; ?>"><button class="cbh-faq__q" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-controls="cbh-a-<?php echo $i; ?>"><?php echo esc_html($faq['q']); ?></button><div id="cbh-a-<?php echo $i; ?>" class="cbh-faq__a"><?php echo wp_kses_post($faq['a']); ?></div></div>
  <?php endforeach; ?></div>
</div></section>

<!-- ── SUBURBS + CLOSING CTA ── Grey ───────────────────────────────────────── -->
<section class="cbh-section cbh-section--grey"><div class="cbh-w">
  <span class="cbh-eye cbh-eye--dark">South Auckland</span>
  <h2 class="cbh-h2">Cambelt Replacement Near You</h2>
  <p class="cbh-lead" style="margin-bottom:0;">Serving all South Auckland suburbs from <a href="<?php echo esc_url($maps_url); ?>" target="_blank" rel="noopener" style="color:var(--taas-yellow2);font-weight:600;">139 Cavendish Drive, Manukau</a>.</p>
  <div class="cbh-suburb-pills"><?php foreach ($suburbs as $s): ?><a href="<?php echo esc_url($site_url . '/cambelt-replacement-' . $s['slug'] . '/'); ?>" class="cbh-suburb-pill"><?php echo esc_html($s['name']); ?></a><?php endforeach; ?></div>
  <div class="cbh-close">
    <div class="cbh-close__text">Don't risk a snapped cambelt.<span>Open <?php echo esc_html($hours); ?> · Sat &amp; Sun closed</span></div>
    <div class="cbh-close__ctas"><a href="tel:<?php echo esc_attr($phone_free_tel); ?>" class="cbh-btn cbh-btn--primary"><?php echo esc_html($phone_free); ?></a><a href="#cbh-enquire" class="cbh-btn cbh-btn--dark">Book Online</a></div>
  </div>
</div></section>

<script>
(function(){document.querySelectorAll('.cbh-faq__q').forEach(function(btn){btn.addEventListener('click',function(){var item=this.closest('.cbh-faq__item');var wasOpen=item.classList.contains('cbh-faq__item--open');document.querySelectorAll('.cbh-faq__item--open').forEach(function(el){el.classList.remove('cbh-faq__item--open');el.querySelector('.cbh-faq__q').setAttribute('aria-expanded','false');});if(!wasOpen){item.classList.add('cbh-faq__item--open');this.setAttribute('aria-expanded','true');}});});}());
</script>

<?php get_footer(); ?>
