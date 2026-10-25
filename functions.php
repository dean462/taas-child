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

    // Set aside raw-text blocks whole (script, style, head, svg, etc.). Tokenising
    // them broke on JS like "i<n" and left the rest of the page unlinked.
    $protected = [];
    $html = preg_replace_callback(
        '#<(script|style|head|textarea|noscript|svg|title)\b[^>]*>.*?</\1\s*>#is',
        function ($m) use (&$protected) {
            $key = "\x01TAASP" . count($protected) . "\x01";
            $protected[$key] = $m[0];
            return $key;
        },
        $html
    );
    if ($html === null) return func_get_arg(0);

    $skip  = ['a', 'button', 'select', 'option'];
    $depth = array_fill_keys($skip, 0);
    $parts = preg_split('/(<!--.*?-->|<[^>]+>)/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
    if ($parts === false) return func_get_arg(0);

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
    return strtr(implode('', $parts), $protected);
}

add_action('template_redirect', function() {
    if (is_admin() || is_feed() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) return;
    ob_start('taas_linkify_contacts');
}, 99);

// ═══════════════════════════════════════════════════════════════════════════
// No links to unpublished pages
// Suburb pills, related-service cards and make/brand lists across the theme
// link to spoke pages, and many spokes are held as drafts on purpose (see the
// suburb page policy in the SEO rules). Any internal link whose path belongs
// to a page that exists but is not published is turned into plain text, so
// the name still shows (e.g. the suburbs we cover) but nobody hits a 404.
// Only draft/pending/private pages are affected: published pages, posts,
// redirects and external links are left alone. Pages are looked up once each
// and the result is page-cached by Breeze, so the cost is small.
// ═══════════════════════════════════════════════════════════════════════════
function taas_path_is_unpublished_page($path) {
    static $cache = [];
    $path = trim($path, '/');
    if ($path === '' || preg_match('#^(wp-|feed|\?)|\.[a-z0-9]{2,5}$#i', $path)) return false;
    if (array_key_exists($path, $cache)) return $cache[$path];
    $pg = get_page_by_path($path, OBJECT, 'page');
    return $cache[$path] = ($pg && $pg->post_status !== 'publish');
}

function taas_unlink_unpublished($html) {
    if (stripos($html, '<a') === false) return $html;
    $home = wp_parse_url(home_url(), PHP_URL_HOST);
    return preg_replace_callback(
        '#<a\b([^>]*?)\bhref\s*=\s*(["\'])([^"\']*)\2([^>]*)>(.*?)</a>#is',
        function ($m) use ($home) {
            $url  = html_entity_decode($m[3]);
            $host = wp_parse_url($url, PHP_URL_HOST);
            if ($host && strcasecmp($host, $home) !== 0) return $m[0];
            if (!$host && (strpos($url, '/') !== 0 || strpos($url, '//') === 0)) return $m[0];
            $path = (string) wp_parse_url($url, PHP_URL_PATH);
            if (!taas_path_is_unpublished_page($path)) return $m[0];
            $attrs = preg_replace('#\s(target|rel)\s*=\s*(["\']).*?\2#i', '', $m[1] . $m[4]);
            return '<span' . rtrim($attrs) . '>' . $m[5] . '</span>';
        },
        $html
    );
}

add_action('template_redirect', function() {
    if (is_admin() || is_feed() || wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) return;
    if (is_user_logged_in() && current_user_can('edit_pages')) return; // editors still see draft links
    ob_start('taas_unlink_unpublished');
}, 98);

add_action('wp_head', function() {
    echo '<style>a.taas-autolink{color:inherit;font-weight:600;text-decoration:underline!important;text-decoration-color:#FFC800!important;text-decoration-thickness:2px!important;text-underline-offset:3px}a.taas-autolink[href^="tel:"]{white-space:nowrap}a.taas-autolink:hover{opacity:.65}</style>' . "\n";
}, 99);

add_action( 'wp_enqueue_scripts', 'taas_child_enqueue_styles' );
function taas_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'taas-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', array(), null );
    wp_enqueue_style( 'taas-global', get_stylesheet_directory_uri() . '/taas-global.css', array( 'parent-style' ), (string) filemtime( get_stylesheet_directory() . '/taas-global.css' ) );
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
    $wa_url      = function_exists('taas_whatsapp_url') ? taas_whatsapp_url( "Hi TAAS, I have a question about my vehicle. My rego is: " ) : '';
    ?>
    <div id="taas-sticky-cta" class="<?php echo $wa_url ? 'has-chat' : ''; ?>" aria-label="Quick contact">
        <a href="tel:<?php echo esc_attr( $phone_tel ); ?>" class="taas-sticky__call">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <span><?php echo esc_html( $phone_label ); ?></span>
        </a>
        <?php if ( $wa_url ) : ?>
        <a href="<?php echo esc_url( $wa_url ); ?>" class="taas-sticky__chat" target="_blank" rel="noopener">
            <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5a9.5 9.5 0 0 0-8.2 14.3L2.5 21.5l4.8-1.3A9.5 9.5 0 1 0 12 2.5z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path transform="translate(6.2 6.2) scale(.48)" fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <span>Chat with us</span>
        </a>
        <?php endif; ?>
        <a href="<?php echo esc_url( $enquiry_url ); ?>" class="taas-sticky__enquire">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
            <span>Enquire</span>
        </a>
    </div>
    <?php if ( $wa_url ) : ?>
    <a href="<?php echo esc_url( $wa_url ); ?>" id="taas-chat-float" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp">
        <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5a9.5 9.5 0 0 0-8.2 14.3L2.5 21.5l4.8-1.3A9.5 9.5 0 1 0 12 2.5z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path transform="translate(6.2 6.2) scale(.48)" fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
        <span>Chat with us</span>
    </a>
    <?php endif; ?>
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
    .taas-sticky__chat {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        padding: 14px 12px; font-family: 'Inter', Arial, sans-serif; font-size: 14px; font-weight: 700;
        text-decoration: none; letter-spacing: .03em; text-transform: uppercase;
        background: #25D366; color: #fff !important;
    }
    .taas-sticky__chat:hover { background: #1ebe5b; }
    #taas-sticky-cta.has-chat { grid-template-columns: 1fr 1fr 1fr; }
    #taas-sticky-cta.has-chat a {
        flex-direction: column; gap: 3px; padding: 9px 4px 10px;
        font-size: 11px; letter-spacing: .02em; line-height: 1.2; text-align: center; white-space: nowrap;
    }
    #taas-sticky-cta.has-chat .taas-sticky__call, #taas-sticky-cta.has-chat .taas-sticky__enquire { border: 0; }
    #taas-chat-float {
        display: none; position: fixed; right: 22px; bottom: 22px; z-index: 9998;
        align-items: center; gap: 10px; padding: 13px 20px 13px 16px;
        background: #25D366; color: #fff !important; border-radius: 999px;
        font-family: 'Inter', Arial, sans-serif; font-size: 15px; font-weight: 700; text-decoration: none;
        box-shadow: 0 6px 24px rgba(0,0,0,.25); transition: transform .15s, box-shadow .15s;
    }
    #taas-chat-float:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,.3); }
    @media (min-width: 769px) { #taas-chat-float { display: inline-flex; } }
    @media print { #taas-chat-float, #taas-sticky-cta { display: none !important; } }
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
        // Find the on-page enquiry form. Only look inside the page body at real,
        // visible sections (a <link id="contact-form-7-css"> in <head> used to
        // match here, so the button scrolled to nothing).
        var target = null;
        var cf7 = document.querySelector('body .wpcf7');
        if (cf7) target = cf7.closest('section, [id]') || cf7;
        if (!target) {
            var cands = document.querySelectorAll('body section[id*="enquir"], body section[id*="-book"], body div[id*="enquir"]');
            for (var i = 0; i < cands.length; i++) {
                if (cands[i].offsetHeight > 0) { target = cands[i]; break; }
            }
        }
        if (target && target.offsetHeight > 0) {
            if (target.id) enquireBtn.setAttribute('href', '#' + target.id);
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


// ── 0. Tracking gate ────────────────────────────────────────────────────────
// Live site only (taas.co.nz), and never for logged-in staff, so test visits
// don't pollute the data. On staging, add ?ga_test=1 to a URL to load GA4 in
// debug mode for checking (shows in GA4 DebugView).
function taas_tracking_enabled() {
    if (is_admin() || is_user_logged_in()) return isset($_GET['ga_test']);
    $host = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : '';
    if (in_array($host, ['taas.co.nz', 'www.taas.co.nz'], true)) return true;
    return isset($_GET['ga_test']);
}
function taas_tracking_debug() {
    $host = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : '';
    return !in_array($host, ['taas.co.nz', 'www.taas.co.nz'], true) || is_user_logged_in();
}

// ── 0b. Google Analytics 4 base tag ─────────────────────────────────────────
add_action('wp_head', function() {
    if (!defined('TAAS_GA4_ID') || !taas_tracking_enabled()) return;
    $id = esc_js(TAAS_GA4_ID);
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id; ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo $id; ?>'<?php echo taas_tracking_debug() ? ", {debug_mode: true}" : ''; ?>);
    </script>
    <?php
}, 0);


// ── 1. Microsoft Clarity ────────────────────────────────────────────────────
add_action('wp_head', function() {
    if (!defined('TAAS_CLARITY_ID') || !taas_tracking_enabled()) return;
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
        var mail = e.target.closest('a[href^="mailto:"]');
        if (mail && typeof gtag === 'function') {
            gtag('event', 'email_click', { page_name: document.title.split('|')[0].trim() });
        }
        var wa = e.target.closest('a[href*="wa.me"]');
        if (wa && !wa.closest('#taas-sticky-cta') && wa.id !== 'taas-chat-float' && typeof gtag === 'function') {
            gtag('event', 'whatsapp_click', { page_name: document.title.split('|')[0].trim(), click_location: 'in_page' });
        }
    });
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
            var stickyLink = e.target.closest('#taas-sticky-cta a, #taas-chat-float');
            if (!stickyLink) return;
            var href = stickyLink.getAttribute('href') || '';
            var type = href.indexOf('tel:') === 0 ? 'phone' : (href.indexOf('wa.me') > -1 ? 'whatsapp' : 'enquire');
            gtag('event', 'sticky_cta_click', {
                page_name: pageName,
                click_type: type,
                click_location: stickyLink.id === 'taas-chat-float' ? 'desktop_float' : 'mobile_bar'
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


// ── Estimate prompt + WhatsApp — site-wide helpers ──────────────────────────
// WhatsApp buttons only render once TAAS_WHATSAPP is set in taas-constants.php.

function taas_whatsapp_number() {
    $n = defined('TAAS_WHATSAPP') ? preg_replace('/\D+/', '', TAAS_WHATSAPP) : '';
    return $n;
}

function taas_whatsapp_url( $text = '' ) {
    $n = taas_whatsapp_number();
    if ( ! $n ) return '';
    if ( $text === '' ) {
        $text = "Hi TAAS, I'd like an estimate. My rego is: ";
    }
    return 'https://wa.me/' . $n . '?text=' . rawurlencode( $text );
}

// One-line prompt, plain text (used inside existing enquiry notes).
function taas_estimate_prompt_text() {
    $email = defined('TAAS_EMAIL') ? TAAS_EMAIL : 'enquiries@taas.co.nz';
    return taas_whatsapp_number()
        ? 'Want an estimate? Send photos, your rego or a fail sheet with the form, by email to ' . $email . ', or on WhatsApp.'
        : 'Want an estimate? Send photos, your rego or a fail sheet with the form, or by email to ' . $email . '.';
}

// Full block with buttons. $dark = true for use on dark sections.
function taas_estimate_prompt( $dark = false, $wa_text = '' ) {
    $email = defined('TAAS_EMAIL') ? TAAS_EMAIL : 'enquiries@taas.co.nz';
    $wa    = taas_whatsapp_url( $wa_text );
    $fg    = $dark ? '#BBBBBB' : '#555555';
    $head  = $dark ? '#FFFFFF' : '#1A1A1A';
    $bg    = $dark ? 'rgba(255,255,255,.04)' : '#F7F7F5';
    $bd    = $dark ? 'rgba(255,255,255,.1)' : '#E8E8E4';
    ob_start(); ?>
    <div class="taas-est" style="background:<?php echo $bg; ?>;border:1px solid <?php echo $bd; ?>;border-left:3px solid #FFC800;border-radius:6px;padding:18px 20px;margin:0 0 24px;font-family:var(--taas-font,'Inter',Arial,sans-serif);">
      <div style="font-size:15px;font-weight:700;color:<?php echo $head; ?>;margin-bottom:6px;">Want an estimate? Send us photos.</div>
      <p style="font-size:14px;font-weight:300;line-height:1.75;color:<?php echo $fg; ?>;margin:0 0 14px;">Photos of the problem, your rego, a WOF fail sheet or another workshop's estimate all help us price it properly. Attach them to the form<?php echo $wa ? ', email them, or send them on WhatsApp.' : ', or email them.'; ?></p>
      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <?php if ( $wa ) : ?>
        <a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" class="taas-est__wa" style="display:inline-flex;align-items:center;gap:8px;background:#25D366;color:#0B3B1E;font-size:13px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:10px 16px;border-radius:6px;text-decoration:none;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3zM12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2z"/></svg>
          WhatsApp us
        </a>
        <?php endif; ?>
        <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo rawurlencode('Estimate request'); ?>" style="display:inline-flex;align-items:center;gap:8px;background:transparent;color:<?php echo $head; ?>;border:2px solid <?php echo $dark ? '#FFC800' : '#1A1A1A'; ?>;font-size:13px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:8px 16px;border-radius:6px;text-decoration:none;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
          Email us
        </a>
      </div>
    </div>
    <?php
    return ob_get_clean();
}

// CF7 file upload field styling.
add_action( 'wp_head', function () {
    if ( ! function_exists( 'wpcf7' ) ) return;
    echo '<style>.wpcf7 input[type="file"]{display:block!important;width:100%!important;padding:10px 13px!important;border:1px dashed #C9C9C2!important;border-radius:4px!important;background:#FAFAF8!important;font-family:\'Inter\',Arial,sans-serif!important;font-size:13px!important;color:#555!important;box-sizing:border-box!important;}.wpcf7 .taas-file-hint{display:block!important;font-size:12px!important;font-weight:300!important;color:#888!important;margin-top:6px!important;text-transform:none!important;letter-spacing:normal!important;line-height:1.6!important;}.wpcf7 p.taas-file-hint{margin:0 0 14px!important;font-size:13px!important;}.wpcf7 .wpcf7-radio{display:flex!important;flex-wrap:wrap;gap:8px 22px;margin-top:6px}.wpcf7 .wpcf7-radio .wpcf7-list-item{margin:0!important}.wpcf7 .wpcf7-radio label,.wpcf7 .wpcf7-checkbox label{display:inline-flex!important;flex-direction:row!important;align-items:flex-start!important;gap:8px;text-transform:none!important;letter-spacing:normal!important;font-size:14px!important;cursor:pointer}.wpcf7 .wpcf7-radio input,.wpcf7 .wpcf7-checkbox input{display:inline-block!important;width:auto!important;margin:3px 0 0!important;flex-shrink:0}.wpcf7 .wpcf7-list-item-label{display:inline!important;width:auto!important}</style>';
}, 100 );

// ═══════════════════════════════════════════════════════════════════════════
// Page-level meta description override (taas_meta_description post meta)
// AIOSEO reads descriptions from its own table, which the WordPress connector
// can't write. When a page has taas_meta_description set, it replaces the
// AIOSEO description and the Facebook/Twitter descriptions. Pages without it
// are untouched, so AIOSEO stays the default everywhere else.
// ═══════════════════════════════════════════════════════════════════════════
function taas_meta_description_override() {
    if (!is_singular()) return '';
    return trim((string) get_post_meta(get_queried_object_id(), 'taas_meta_description', true));
}
add_filter('aioseo_description', function ($desc) {
    $o = taas_meta_description_override();
    return $o !== '' ? $o : $desc;
}, 20);
add_filter('aioseo_facebook_tags', function ($tags) {
    $o = taas_meta_description_override();
    if ($o !== '' && is_array($tags)) $tags['og:description'] = $o;
    return $tags;
}, 20);
add_filter('aioseo_twitter_tags', function ($tags) {
    $o = taas_meta_description_override();
    if ($o !== '' && is_array($tags)) $tags['twitter:description'] = $o;
    return $tags;
}, 20);
