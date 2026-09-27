<?php
/**
 * TAAS Child Theme functions
 * All pages use custom PHP templates — this file loads shared assets only.
 */

require_once get_stylesheet_directory() . '/taas-constants.php';
require_once get_stylesheet_directory() . '/taas-deploy.php'; // GitHub → Cloudways auto-deploy

// ── Page titles ─────────────────────────────────────────────────────────────
// Parent is a block theme; our classic header.php needs this so WordPress
// (and AIOSEO) output the <title> tag.
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
});

// ── Retired Zip pages → Finance Options (301) ──────────────────────────────
// Zip exited NZ (July 2026). Old /zip-car-repairs/ and /zip-mechanic-*/ URLs
// may still be indexed from the previous site.
add_action('template_redirect', function() {
    if (!is_404()) return;
    $path = trim((string) wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    if (preg_match('#^zip-(car-repairs|mechanic-[a-z-]+)$#', $path)) {
        wp_safe_redirect(home_url('/finance-options/'), 301);
        exit;
    }
});

// ── Auto-link contact details ───────────────────────────────────────────────
// Turns every TAAS phone number, email and street address in visible page text
// into a tappable link (tel:, mailto:, Google Maps). Runs once on the final
// HTML so it covers templates, FAQ library answers and stored page content.
// Skips anything already inside <a>, <button>, <script>, <style>, <head>,
// <textarea>, <select>, <title> — and never touches tag attributes, so schema
// JSON and meta tags stay plain text.
function taas_linkify_contacts($html) {
    if (!is_string($html) || stripos($html, '<html') === false) return $html;

    $maps = defined('TAAS_MAPS_URL') ? TAAS_MAPS_URL
          : 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';

    $rules = [
        // 0800 100 876 (spaces, dashes or none)
        '/\b0800[ \x{00A0}-]?100[ \x{00A0}-]?876\b/u' => function ($m) {
            return '<a href="tel:0800100876" class="taas-autolink">' . $m[0] . '</a>';
        },
        // 09 278 9556
        '/(?<![\d-])09[ \x{00A0}-]?278[ \x{00A0}-]?9556\b/u' => function ($m) {
            return '<a href="tel:092789556" class="taas-autolink">' . $m[0] . '</a>';
        },
        // enquiries@taas.co.nz
        '/\benquiries@taas\.co\.nz\b/i' => function ($m) {
            return '<a href="mailto:enquiries@taas.co.nz" class="taas-autolink">' . $m[0] . '</a>';
        },
        // 139 Cavendish Drive[, Manukau[, Auckland[ 2104]]]
        '/139 Cavendish (?:Drive|Dr\.?)(?:,? Manukau(?:,? Auckland)?(?: 2104)?)?/u' => function ($m) use ($maps) {
            return '<a href="' . esc_url($maps) . '" target="_blank" rel="noopener" class="taas-autolink">' . $m[0] . '</a>';
        },
    ];

    $skip  = ['a', 'button', 'script', 'style', 'head', 'textarea', 'select', 'option', 'title', 'noscript', 'svg'];
    $depth = array_fill_keys($skip, 0);
    $parts = preg_split('/(<!--.*?-->|<[^>]+>)/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
    if ($parts === false) return $html;

    foreach ($parts as $i => $part) {
        if ($part === '') continue;
        if ($part[0] === '<') {
            if (preg_match('#^<(/?)([a-zA-Z][a-zA-Z0-9-]*)#', $part, $t)) {
                $tag = strtolower($t[2]);
                if (isset($depth[$tag]) && substr($part, -2) !== '/>') {
                    $depth[$tag] += ($t[1] === '/') ? -1 : 1;
                    if ($depth[$tag] < 0) $depth[$tag] = 0;
                }
            }
            continue;
        }
        if (array_sum($depth) > 0) continue;
        if (!preg_match('/0800|09[ \x{00A0}-]?278|enquiries@|Cavendish/u', $part)) continue;
        foreach ($rules as $re => $cb) {
            $part = preg_replace_callback($re, $cb, $part);
        }
        $parts[$i] = $part;
    }
    return implode('', $parts);
}

add_action('template_redirect', function() {
    if (is_admin() || is_feed() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) return;
    ob_start('taas_linkify_contacts');
}, 99);

add_action('wp_head', function() {
    echo '<style>.taas-autolink{color:inherit;text-decoration:underline;text-decoration-thickness:1px;text-underline-offset:2px}.taas-autolink:hover{text-decoration-thickness:2px}</style>' . "\n";
}, 99);

add_action( 'wp_enqueue_scripts', 'taas_child_enqueue_styles' );
function taas_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'taas-global', get_stylesheet_directory_uri() . '/taas-global.css', array( 'parent-style' ), '1.0.0' );
}

add_filter( 'theme_page_templates', 'taas_register_templates' );
function taas_register_templates( $templates ) {
    $templates['template-wof.php']                      = 'WOF Hub';
    $templates['template-wof-location.php']             = 'WOF Location Spoke';
    $templates['template-homepage.php']                 = 'Homepage';
    $templates['template-contact.php']                  = 'Contact';
    $templates['template-services-hub.php']             = 'Services Hub';
    $templates['template-sub-service.php']              = 'Sub Service';
    $templates['template-european.php']                 = 'TAAS European';
    $templates['template-auto-electrical-location.php'] = 'Auto Electrical Location';
    $templates['template-afterpay-mechanic.php']        = 'Finance Location';
    $templates['template-mb-location.php']              = 'Manukau Batteries Location';
    $templates['template-mb-battery-type.php']          = 'MB Battery Type';
    $templates['template-symptom-emergency.php']        = 'Symptom Emergency';
    $templates['template-blog-info.php']                = 'Blog Article';
    return $templates;
}

add_filter( 'template_include', 'taas_load_templates' );
function taas_load_templates( $template ) {
    if ( is_page() ) {
        $page_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( $page_template && $page_template !== 'default' ) {
            $child_path = get_stylesheet_directory() . '/' . $page_template;
            if ( file_exists( $child_path ) ) {
                return $child_path;
            }
        }
    }
    return $template;
}


// Finance Provider Spoke template
add_filter( 'theme_page_templates', function($templates) { $templates['template-finance-provider.php'] = 'Finance Provider Spoke'; return $templates; });

// MBI Provider Spoke template
add_filter( 'theme_page_templates', function($templates) { $templates['template-mbi-provider.php'] = 'MBI Provider Spoke'; return $templates; });

// Afterpay Car Repairs template
add_filter( 'theme_page_templates', function( $t ) { $t['template-afterpay-mechanic.php'] = 'Afterpay Car Repairs'; return $t; } );


// Gem Finance Car Repairs template
add_filter( 'theme_page_templates', function( $t ) { $t['template-gem-finance-car-repairs.php'] = 'Gem Finance Car Repairs'; return $t; } );

// Q Card Car Repairs template
add_filter( 'theme_page_templates', function( $t ) { $t['template-qcard-car-repairs.php'] = 'Q Card Car Repairs'; return $t; } );

// Aotea Finance Car Repairs template
add_filter( 'theme_page_templates', function( $t ) { $t['template-aotea-finance-car-repairs.php'] = 'Aotea Finance Car Repairs'; return $t; } );

// ── Disable comments site-wide ───────────────────────────────────────────────
add_action( 'admin_init', function() {
    // Remove comments metabox from posts and pages
    remove_meta_box( 'commentsdiv',       'post', 'normal' );
    remove_meta_box( 'commentsdiv',       'page', 'normal' );
    remove_meta_box( 'trackbacksdiv',     'post', 'normal' );
    remove_meta_box( 'commentstatusdiv',  'post', 'normal' );
    remove_meta_box( 'commentstatusdiv',  'page', 'normal' );
} );
add_action( 'admin_menu', function() {
    // Remove Comments from admin sidebar
    remove_menu_page( 'edit-comments.php' );
} );
// Close comments on the front end
add_filter( 'comments_open',  '__return_false', 20, 2 );
add_filter( 'pings_open',     '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
// Remove comments from admin bar
add_action( 'wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'comments' );
} );


// taas_og_image_fallback
add_action('wp_head', function() {
    $tyre_templates = [
        'template-wheel-alignment.php',
        'template-wheel-balancing.php',
        'template-tyre-centre.php',
        'template-tyre-location.php',
        'template-puncture-repair.php',
        'template-mbi-provider.php',
        'template-finance-provider.php',
        'template-wof-location.php',
        'template-afterpay-mechanic.php',
        'template-mbi.php',
    ];
    $current = get_page_template_slug();
    if (!in_array($current, $tyre_templates)) return;
    // Only output if AIOSEO hasn't already set one
    $og_image_url = home_url('/wp-content/uploads/2026/05/taas-og-image.png');
    echo '<meta property="og:image" content="' . esc_url($og_image_url) . '" />' . "\n";
    echo '<meta property="og:image:width" content="1200" />' . "\n";
    echo '<meta property="og:image:height" content="630" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($og_image_url) . '" />' . "\n";
}, 1); // priority 1 = before AIOSEO (priority 10)


// ── Mobile sticky CTA bar — site-wide ───────────────────────────────────────
add_action( 'wp_footer', 'taas_mobile_sticky_cta' );
function taas_mobile_sticky_cta() {
    $phone_tel   = '0800100876';
    $phone_label = '0800 100 876';
    $enquiry_url = '/contact-us/';
    ?>
    <div id="taas-sticky-cta" aria-label="Quick contact">
        <a href="tel:<?php echo esc_attr( $phone_tel ); ?>" class="taas-sticky__call">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <span><?php echo esc_html( $phone_label ); ?></span>
        </a>
        <a href="<?php echo esc_url( $enquiry_url ); ?>" class="taas-sticky__enquire">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            <span>Enquire</span>
        </a>
    </div>
    <style>
    #taas-sticky-cta {
        display: none;
        position: fixed;
        bottom: 0; left: 0; right: 0;
        z-index: 9999;
        background: #111111;
        border-top: 3px solid #FFC800;
        grid-template-columns: 1fr 1fr;
        box-shadow: 0 -4px 24px rgba(0,0,0,.4);
        transition: transform .3s ease;
        transform: translateY(100%);
    }
    #taas-sticky-cta.is-visible { transform: translateY(0); }
    .taas-sticky__call,
    .taas-sticky__enquire {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 12px;
        font-family: 'Inter', Arial, sans-serif;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        letter-spacing: .03em;
        text-transform: uppercase;
        transition: background .15s;
    }
    .taas-sticky__call {
        background: #FFC800;
        color: #1A1A1A;
        border-right: 1px solid rgba(0,0,0,.15);
    }
    .taas-sticky__call:hover { background: #e6b400; }
    .taas-sticky__enquire {
        background: #1A1A1A;
        color: #FFC800;
        border-left: 1px solid rgba(255,200,0,.15);
    }
    .taas-sticky__enquire:hover { background: #222; }
    @media (max-width: 768px) {
        #taas-sticky-cta { display: grid; }
        /* Push page content up so bar doesn't cover footer */
        body { padding-bottom: 58px; }
    }
    @media (min-width: 769px) {
        #taas-sticky-cta { display: none !important; }
        body { padding-bottom: 0; }
    }
    </style>
    <script>
    (function() {
        var bar = document.getElementById('taas-sticky-cta');
        if (!bar) return;
        var shown = false;
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300 && !shown) {
                bar.classList.add('is-visible');
                shown = true;
            }
        }, { passive: true });

        // Smart enquiry — scroll to on-page form if one exists
        var enquireBtn = bar.querySelector('.taas-sticky__enquire');
        if (!enquireBtn) return;
        // Find enquiry section by common ID patterns across all templates
        var target = document.querySelector('[id*="enquir"], [id*="-book"], [id*="contact"]');
        // Fallback: find any section containing a CF7 form
        if (!target) {
            var cf7 = document.querySelector('.wpcf7');
            if (cf7) target = cf7.closest('section');
        }
        if (target) {
            enquireBtn.setAttribute('href', '#' + (target.id || ''));
            enquireBtn.addEventListener('click', function(e) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    })();
    </script>
    <?php
}


// ── CF7 form spacing — site-wide ─────────────────────────────────────────────
add_action( 'wp_head', 'taas_cf7_form_styles', 99 );
function taas_cf7_form_styles() {
    if ( ! function_exists( 'wpcf7' ) ) return;
    echo '<style>
.wpcf7 form p{margin:0!important;padding:0!important;}
.wpcf7 form br{display:none!important;}
.wpcf7 form label{display:block!important;font-size:13px!important;font-weight:600!important;color:#333!important;margin:0 0 14px 0!important;padding:0!important;}
.wpcf7 .wpcf7-form-control-wrap{display:block!important;margin-top:5px!important;margin-bottom:0!important;}
.wpcf7 input[type="text"],
.wpcf7 input[type="email"],
.wpcf7 input[type="tel"],
.wpcf7 input[type="date"],
.wpcf7 textarea,
.wpcf7 select{width:100%!important;padding:10px 13px!important;border:1px solid #E5E5E0!important;border-radius:4px!important;font-family:\'Inter\',Arial,sans-serif!important;font-size:14px!important;color:#333!important;background:#fff!important;box-sizing:border-box!important;display:block!important;margin:0!important;box-shadow:none!important;}
.wpcf7 input:focus,.wpcf7 textarea:focus,.wpcf7 select:focus{outline:none!important;border-color:#FFC800!important;box-shadow:none!important;}
.wpcf7 textarea{min-height:90px!important;resize:vertical!important;}
.wpcf7 input[type="submit"],.wpcf7 .wpcf7-submit{width:100%!important;background:#FFC800!important;color:#1A1A1A!important;font-family:\'Inter\',Arial,sans-serif!important;font-size:14px!important;font-weight:700!important;padding:13px!important;border:none!important;border-radius:4px!important;cursor:pointer!important;letter-spacing:.04em!important;text-transform:uppercase!important;display:block!important;margin:0!important;box-shadow:none!important;}
.wpcf7 input[type="submit"]:hover,.wpcf7 .wpcf7-submit:hover{background:#e6b400!important;}
</style>';
}



// ═══════════════════════════════════════════════════════════════════════════
// TRACKING STACK — Clarity, CF7 page source, phone clicks, CTA tracking
// All constants from taas-constants.php — single-file update propagates
// ═══════════════════════════════════════════════════════════════════════════


// ── 1. Microsoft Clarity ────────────────────────────────────────────────────
add_action('wp_head', function() {
    if (is_admin() || !defined('TAAS_CLARITY_ID')) return;
    ?>
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "<?php echo esc_js(TAAS_CLARITY_ID); ?>");
    </script>
    <?php
}, 1);


// ── 2. CF7 Hidden Page Source ───────────────────────────────────────────────
// Auto-injects page title + URL into every CF7 form submission
// Result: every email shows "Sent from: Vehicle Servicing" + the page URL
add_filter('wpcf7_form_hidden_fields', function($fields) {
    $fields['page_source'] = is_singular() ? get_the_title() : 'Unknown';
    $fields['page_url']    = is_singular() ? get_permalink() : home_url($_SERVER['REQUEST_URI']);
    return $fields;
});


// ── 3. Phone Click Tracking ────────────────────────────────────────────────
// Fires GA4 phone_click event on every tel: tap with page name + click location
add_action('wp_footer', function() {
    if (is_admin() || !defined('TAAS_GA4_ID')) return;
    ?>
    <script>
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href^="tel:"]');
        if (!link || typeof gtag !== 'function') return;
        gtag('event', 'phone_click', {
            page_name: document.title.split('|')[0].trim(),
            phone_number: link.href.replace('tel:', ''),
            click_location: link.closest('#taas-sticky-cta') ? 'sticky_bar' :
                           link.closest('[class*="hero"]') ? 'hero' :
                           link.closest('[class*="enquir"]') ? 'enquiry_section' :
                           link.closest('[class*="phone"]') ? 'phone_strip' :
                           link.closest('[class*="pstrip"]') ? 'phone_strip' :
                           link.closest('[class*="cta"]') ? 'cta_section' : 'other'
        });
    });
    </script>
    <?php
}, 20);


// ── 4. CTA & Interaction Tracking ──────────────────────────────────────────
// Tracks: cta_click, faq_open, modal_open, form_submit, sticky_cta_click
add_action('wp_footer', function() {
    if (is_admin() || !defined('TAAS_GA4_ID')) return;
    ?>
    <script>
    (function() {
        if (typeof gtag !== 'function') return;
        var pageName = document.title.split('|')[0].trim();

        // CTA button clicks (yellow buttons, outline buttons, dark buttons)
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('a[class*="btn--yellow"], a[class*="btn--primary"], a[class*="btn--outline"], a[class*="btn--dark"], a[class*="btn-yellow"], a[class*="btn-primary"]');
            if (!btn || btn.closest('#taas-sticky-cta') || btn.getAttribute('href').indexOf('tel:') === 0) return;
            gtag('event', 'cta_click', {
                page_name: pageName,
                cta_text: btn.textContent.trim().substring(0, 50),
                cta_url: btn.getAttribute('href') || ''
            });
        });

        // Sticky bar clicks (non-phone — the "Enquire" side)
        document.addEventListener('click', function(e) {
            var stickyLink = e.target.closest('#taas-sticky-cta a');
            if (!stickyLink) return;
            var isPhone = stickyLink.getAttribute('href').indexOf('tel:') === 0;
            gtag('event', 'sticky_cta_click', {
                page_name: pageName,
                click_type: isPhone ? 'phone' : 'enquire'
            });
        });

        // FAQ accordion opens
        document.addEventListener('click', function(e) {
            var faqBtn = e.target.closest('[class*="faq__q"], [class*="faq__question"], button[aria-expanded]');
            if (!faqBtn) return;
            var questionText = faqBtn.textContent.replace(/[+−×✕]/g, '').trim().substring(0, 80);
            gtag('event', 'faq_open', {
                page_name: pageName,
                question: questionText
            });
        });

        // Modal opens (service tier modals etc.)
        document.addEventListener('click', function(e) {
            var trigger = e.target.closest('[data-modal]');
            if (!trigger) return;
            gtag('event', 'modal_open', {
                page_name: pageName,
                modal_name: trigger.getAttribute('data-modal') || 'unknown'
            });
        });

        // CF7 form submissions
        document.addEventListener('wpcf7mailsent', function(e) {
            gtag('event', 'form_submit', {
                page_name: pageName,
                form_id: e.detail.contactFormId || '',
                page_url: window.location.pathname
            });
        });
    })();
    </script>
    <?php
}, 21);


// ── CF7 → Thank You redirect ────────────────────────────────────────────────
// After a successful send, go to /thank-you/ so GA4 can fire generate_lead.
// Short delay lets the form_submit event above go out first.
add_action('wp_footer', function() {
    if (is_admin()) return;
    ?>
    <script>
    document.addEventListener('wpcf7mailsent', function(e) {
        var url = '<?php echo esc_js(home_url('/thank-you/')); ?>'
            + '?sent=1'
            + '&form=' + encodeURIComponent((e.detail && e.detail.contactFormId) || '')
            + '&from=' + encodeURIComponent(window.location.pathname)
            + '&t=' + Date.now();
        setTimeout(function() { window.location.href = url; }, 400);
    });
    </script>
    <?php
}, 22);
