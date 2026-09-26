<?php
/**
 * Tony Allen Auto Service — Suburb Content Library
 * taas.co.nz
 *
 * Single source of genuinely-local content for every location ("spoke") page,
 * keyed by suburb slug. Written ONCE here and reused across all clusters
 * (auto-electrical, WOF, tyres, MBC, aircon, cambelt, radiator, etc.).
 *
 * Why this exists:
 *   The spoke templates previously produced near-duplicate "doorway" pages —
 *   hub copy with the suburb name swapped in. Google and AI overviews treat
 *   that as thin/duplicate content. This library gives each suburb its own
 *   real local detail (true arterial roads, localities, route to the Manukau
 *   workshop) so every spoke is meaningfully different from its siblings.
 *
 * Accuracy note: content references real South Auckland roads/localities only
 *   (Great South Rd, Te Irirangi Dr, SH1/SH20, Roscommon Rd, etc.). Specific
 *   drive-time claims stay in each page's ACF `distance_note` (Dean's own data)
 *   — this library deliberately uses descriptive routes, not hard minute counts.
 *
 * Usage in a template:
 *   require_once get_stylesheet_directory() . '/taas-suburbs.php';
 *   $sub = taas_suburb_data($suburb_slug, $suburb_name);
 *   echo $sub['intro']; echo $sub['getting_here'];
 *   $local_faq = taas_suburb_local_faq($suburb_slug, $suburb_name, $service_label, $distance_note);
 */

if (!defined('ABSPATH')) { /* allow direct require in templates */ }

/**
 * Raw per-suburb data. Keys = slug used in URLs.
 */
function taas_suburbs_library() {
    return [
        'manukau' => [
            'name'         => 'Manukau',
            'distance'     => 'at our address on Cavendish Drive',
            'area'         => 'Manukau CBD, Wiri, Papatoetoe, Hunters Corner, Ōtara, and Māngere',
            'intro'        => "Our workshop sits in the heart of Manukau on Cavendish Drive, a few minutes from Westfield Manukau and the Manukau bus and train interchange. Being right in the Manukau City Centre, most customers drop the car off and walk to the shops or catch the train while we work.",
            'getting_here' => "We're on Cavendish Drive, just off Great South Road and a minute from the Manukau motorway interchange where SH1 meets SH20.",
            'nearby'       => ['Wiri', 'Puhinui', 'Clover Park', 'Papatoetoe'],
        ],
        'papatoetoe' => [
            'name'         => 'Papatoetoe',
            'distance'     => '~5 min via Great South Rd',
            'area'         => 'Papatoetoe, Hunters Corner, Manukau, Ōtāhuhu, Māngere, and Wiri',
            'intro'        => "Papatoetoe runs north from our Manukau base along Great South Road, taking in the busy Hunters Corner shopping strip and the Old Papatoetoe village around St George Street. It's one of South Auckland's most established suburbs and a big part of our local customer base.",
            'getting_here' => "From Papatoetoe we're a straight run south down Great South Road, or one exit along the Southern Motorway (SH1) to the Manukau turn-off.",
            'nearby'       => ['Hunters Corner', 'Puhinui', 'Wiri', 'Ōtāhuhu', 'Manukau'],
        ],
        'hunters-corner' => [
            'name'         => 'Hunters Corner',
            'distance'     => '~5 min via Lambie Drive',
            'area'         => 'Hunters Corner, Papatoetoe, Manukau, Ōtara, Wiri, and Middlemore',
            'intro'        => "Hunters Corner is the busy retail stretch of Great South Road in Papatoetoe, packed with shops and eateries. It's only a short drive south to our Manukau workshop.",
            'getting_here' => "Head south down Great South Road from Hunters Corner and we're a few minutes away on Cavendish Drive, Manukau.",
            'nearby'       => ['Papatoetoe', 'Puhinui', 'Wiri', 'Manukau'],
        ],
        'mangere' => [
            'name'         => 'Māngere',
            'distance'     => '~10 min from Māngere town centre',
            'area'         => 'Māngere, Māngere Bridge, Māngere East, Favona, Papatoetoe, and Ōtāhuhu',
            'intro'        => "Māngere lies west of Manukau toward the airport, served by the SH20 Southwestern Motorway and Massey Road, with the Māngere Town Centre at its hub. We look after plenty of Māngere households and airport-area work vehicles.",
            'getting_here' => "From Māngere it's a quick run east on SH20 to the Manukau interchange, then a minute to our Cavendish Drive workshop.",
            'nearby'       => ['Māngere Bridge', 'Favona', 'Ōtāhuhu', 'Wiri'],
        ],
        'mangere-bridge' => [
            'name'         => 'Māngere Bridge',
            'distance'     => '~12 min via SH20',
            'area'         => 'Māngere Bridge, Māngere, Onehunga, Favona, and Manukau',
            'intro'        => "Māngere Bridge sits on the northern shore of the Manukau Harbour around the Coronation Road village, just across the water from the airport. It's a tight-knit community we've served for years.",
            'getting_here' => "From Māngere Bridge the SH20 motorway brings you straight across to the Manukau interchange and our workshop.",
            'nearby'       => ['Māngere', 'Onehunga', 'Favona'],
        ],
        'otahuhu' => [
            'name'         => 'Ōtāhuhu',
            'distance'     => '~10 min via Great South Rd',
            'area'         => 'Ōtāhuhu, Māngere, Papatoetoe, Mt Wellington, Sylvia Park, and Manukau',
            'intro'        => "Ōtāhuhu sits on the narrow neck of land between the Manukau and Waitematā harbours, with its town centre strung along Great South Road and Mangere Road. It's a short, familiar drive from us.",
            'getting_here' => "From Ōtāhuhu it's a straightforward drive south on Great South Road, or a couple of stops down the Southern Motorway to Manukau.",
            'nearby'       => ['Māngere', 'Papatoetoe', 'Favona', 'Middlemore'],
        ],
        'wiri' => [
            'name'         => 'Wiri',
            'distance'     => '~5 min via Cavendish Drive',
            'area'         => 'Wiri, Manukau, Manurewa, Papatoetoe, Ōtara, and Takanini',
            'intro'        => "Wiri is the industrial and logistics heart of South Auckland — home to the inland port and a maze of warehousing around Wiri Station Road and Roscommon Road — and it's right on our doorstep. We service a lot of Wiri fleet and trade vehicles.",
            'getting_here' => "Wiri is only minutes from our Manukau workshop via Wiri Station Road or Great South Road.",
            'nearby'       => ['Manukau', 'Manurewa', 'Clendon', 'Puhinui'],
        ],
        'manurewa' => [
            'name'         => 'Manurewa',
            'distance'     => '~10 min via Great South Rd',
            'area'         => 'Manurewa, Clendon, Wiri, Manukau, Weymouth, and Takanini',
            'intro'        => "Manurewa stretches south of Manukau along Great South Road, centred on the Southmall shopping centre and the Browns Road shops. It's one of our busiest local catchments.",
            'getting_here' => "From Manurewa we're a short run north up Great South Road, or one exit on the Southern Motorway to Manukau.",
            'nearby'       => ['Clendon', 'Weymouth', 'Wiri', 'Takanini'],
        ],
        'flat-bush' => [
            'name'         => 'Flat Bush',
            'distance'     => '~15 min via Ormiston Rd',
            'area'         => 'Flat Bush, Ormiston, Clover Park, Ōtara, Manukau, Howick, and Dannemora',
            'intro'        => "Flat Bush is one of Auckland's fastest-growing areas — a newer residential district east of Manukau around the Ormiston Town Centre, Chapel Road and Murphys Road. Lots of newer vehicles and growing families in this part of town.",
            'getting_here' => "From Flat Bush, Te Irirangi Drive runs straight down to Manukau and our Cavendish Drive workshop.",
            'nearby'       => ['Ormiston', 'Botany', 'Ōtara', 'Clover Park'],
        ],
        'takanini' => [
            'name'         => 'Takanini',
            'distance'     => '~12 min via Great South Rd',
            'area'         => 'Takanini, Conifer Grove, Manurewa, Papakura, Wiri, Manukau, and Clendon',
            'intro'        => "Takanini sits south of Manukau just off the Southern Motorway, with its shops and fast-growing residential streets around Great South Road and Walters Road. We see plenty of Takanini commuters who service their cars on the way through.",
            'getting_here' => "From Takanini, hop on the Southern Motorway (SH1) heading north and it's a short drive to the Manukau exit and our workshop.",
            'nearby'       => ['Papakura', 'Manurewa', 'Conifer Grove', 'Opaheke'],
        ],
        'papakura' => [
            'name'         => 'Papakura',
            'distance'     => '~15 min via Great South Rd',
            'area'         => 'Papakura, Takanini, Manurewa, Clendon, Drury, and Manukau',
            'intro'        => "Papakura marks the southern end of metropolitan Auckland, with its town centre around Broadway and easy access off the Southern Motorway. It's worth the short trip north for a workshop that handles everything under one roof.",
            'getting_here' => "From Papakura the Southern Motorway (SH1) runs straight up to the Manukau interchange and our Cavendish Drive workshop.",
            'nearby'       => ['Takanini', 'Drury', 'Manurewa', 'Opaheke'],
        ],
        'otara' => [
            'name'         => 'Ōtara',
            'distance'     => '~8 min via East Tāmaki Rd',
            'area'         => 'Ōtara, East Tāmaki, Clover Park, Flat Bush, Hunters Corner, and Wiri',
            'intro'        => "Ōtara sits just east of Manukau, well known for the Ōtara town centre and its Saturday market, with East Tamaki Road and Te Irirangi Drive linking it straight to us.",
            'getting_here' => "From Ōtara it's only a few minutes to our workshop via East Tamaki Road or Te Irirangi Drive.",
            'nearby'       => ['Clover Park', 'Flat Bush', 'East Tāmaki', 'Manukau'],
        ],
        'botany' => [
            'name'         => 'Botany',
            'distance'     => '~20 min via Ti Rakau Drive',
            'area'         => 'Botany Downs, Botany Town Centre, Chapel Downs, Dannemora, Flat Bush, and Howick',
            'intro'        => "Botany is the retail hub of Auckland's eastern suburbs, centred on the Botany Town Centre where Te Irirangi Drive meets Ti Rakau Drive. We're an easy, motorway-free run down Te Irirangi for Botany drivers.",
            'getting_here' => "From Botany, Te Irirangi Drive runs directly south-west to Manukau and our Cavendish Drive workshop.",
            'nearby'       => ['Flat Bush', 'Howick', 'East Tāmaki', 'Dannemora'],
        ],
        'howick' => [
            'name'         => 'Howick',
            'distance'     => '~20 min via Ti Rakau Drive',
            'area'         => 'Howick, Pakuranga, Half Moon Bay, Bucklands Beach, Flat Bush, Clover Park, and Botany',
            'intro'        => "Howick is a coastal village in Auckland's east, centred on the historic Picton Street shops above the Hauraki Gulf beaches. It's a longer run for Howick drivers, but well worth it for our range of in-house specialist divisions.",
            'getting_here' => "From Howick, Pakuranga Road and Te Irirangi Drive bring you down through Botany to our Manukau workshop.",
            'nearby'       => ['Botany', 'Pakuranga', 'Flat Bush', 'Bucklands Beach'],
        ],
        'clover-park' => [
            'name'         => 'Clover Park',
            'distance'     => '~10 min via Ti Rakau Drive',
            'area'         => 'Clover Park, Ōtara, Flat Bush, Manukau, Howick, and Hunters Corner',
            'intro'        => "Clover Park is a compact residential suburb tucked between Ōtara and Manukau, just off Te Irirangi Drive — about as local to us as it gets.",
            'getting_here' => "Clover Park is only a few minutes from our workshop via Te Irirangi Drive into Manukau.",
            'nearby'       => ['Ōtara', 'Flat Bush', 'Manukau', 'Wiri'],
        ],
        'weymouth' => [
            'name'         => 'Weymouth',
            'distance'     => '~18 min via Weymouth Rd',
            'area'         => 'Weymouth, Wattle Downs, Manurewa, Clendon, Manukau, Wiri, and Takanini',
            'intro'        => "Weymouth occupies a peninsula on the Manukau Harbour south of Manurewa, reached via Weymouth Road and Roscommon Road. We look after a lot of Weymouth and Wattle Downs locals.",
            'getting_here' => "From Weymouth, Roscommon Road and Great South Road bring you north to our Manukau workshop.",
            'nearby'       => ['Manurewa', 'Clendon', 'Wattle Downs'],
        ],
        'clendon' => [
            'name'         => 'Clendon',
            'distance'     => '~15 min via Roscommon Rd',
            'area'         => 'Clendon Park, Manurewa, Weymouth, Manukau, Wiri, and Takanini',
            'intro'        => "Clendon Park sits within greater Manurewa to the south-west, built around the Clendon shopping centre off Roscommon Road. It's a short, direct drive to us up Roscommon.",
            'getting_here' => "From Clendon, Roscommon Road links straight up through Wiri to our Manukau workshop.",
            'nearby'       => ['Manurewa', 'Weymouth', 'Wiri', 'Wattle Downs'],
        ],
    ];
}

/**
 * Get the library entry for a slug, with a safe generic fallback for any
 * suburb not yet in the library (so a new page never renders empty).
 *
 * @param string $slug         Suburb slug (e.g. "papatoetoe").
 * @param string $display_name Fallback display name if slug is unknown.
 * @return array{name:string,intro:string,getting_here:string,nearby:array}
 */
function taas_suburb_data($slug, $display_name = '') {
    $lib  = taas_suburbs_library();
    $slug = sanitize_title($slug);

    if (isset($lib[$slug])) {
        return $lib[$slug];
    }

    $name = $display_name !== '' ? $display_name : ucwords(str_replace('-', ' ', $slug));
    return [
        'name'         => $name,
        'distance'     => 'a short drive from ' . $name,
        'area'         => $name . ', Manukau, and surrounding South Auckland suburbs',
        'intro'        => "{$name} is one of the South Auckland communities we serve from our Manukau workshop. As one of the largest independent workshops in the area, we look after drivers from right across the region.",
        'getting_here' => "We're at 139 Cavendish Drive, Manukau — easy to reach from {$name} via Great South Road or the Southern Motorway.",
        'nearby'       => ['Manukau', 'Wiri', 'Papatoetoe'],
        '_fallback'    => true,
    ];
}

/**
 * Build a single genuinely-local FAQ Q&A for a suburb. Service-aware so the
 * same suburb reads slightly differently across clusters, and location-focused
 * so it stays unique from the shared service FAQs.
 *
 * @param string $slug
 * @param string $suburb_name
 * @param string $service_label  e.g. "auto electrical help", "a WOF", "new tyres"
 * @param string $distance_note  optional ACF distance note (authoritative time)
 * @param string $phone          phone number to surface in the answer
 * @return array{q:string,a:string}
 */
function taas_suburb_local_faq($slug, $suburb_name, $service_label = 'service', $distance_note = '', $phone = '09 278 9556') {
    $sub  = taas_suburb_data($slug, $suburb_name);
    $name = $sub['name'] ?: $suburb_name;
    $dist = $distance_note ? ' ' . rtrim($distance_note, '.') . '.' : '';

    $q = "How do I get to your workshop from {$name}?";
    $a = rtrim($sub['getting_here'], '.') . '.' . $dist
       . " You'll find us at 139 Cavendish Drive, Manukau — open Monday to Friday, 7:30am–5:00pm. Call {$phone} ahead if you'd like to check availability for {$service_label}.";

    return ['q' => $q, 'a' => $a];
}

/**
 * Build a "do you cover {suburb}?" FAQ that surfaces the full local intro and
 * route in one Q&A — the single richest unique-content injection for a spoke.
 * Use this as the lead FAQ on clusters that don't already carry a body intro.
 *
 * @param string $slug
 * @param string $suburb_name
 * @param string $service_label  e.g. "a WOF", "new tyres", "brake work"
 * @param string $phone
 * @return array{q:string,a:string}
 */
function taas_suburb_coverage_faq($slug, $suburb_name, $service_label = 'service', $phone = '09 278 9556') {
    $sub  = taas_suburb_data($slug, $suburb_name);
    $name = $sub['name'] ?: $suburb_name;
    $q = "Do you cover {$name}?";
    $a = rtrim($sub['intro'], '.') . '. ' . rtrim($sub['getting_here'], '.') . '.'
       . " We're open Monday to Friday, 7:30am–5:00pm — call {$phone} for {$service_label}.";
    return ['q' => $q, 'a' => $a];
}

/**
 * Resolve the list of nearby areas for areaServed schema / "we also serve"
 * blurbs. Falls back to the library `nearby` list.
 *
 * @return string[] list of nearby locality names (display form)
 */
function taas_suburb_nearby($slug, $suburb_name = '') {
    $sub = taas_suburb_data($slug, $suburb_name);
    return isset($sub['nearby']) && is_array($sub['nearby']) ? $sub['nearby'] : [];
}

/**
 * Get formatted distance text for a suburb, with optional ACF override.
 * Handles the "from" duplication logic so templates don't have to.
 *
 * @param string $slug
 * @param string $suburb_name
 * @param string $acf_override  Optional ACF distance_note — if set, wins over library value
 * @return string e.g. "~5 min via Great South Rd from Papatoetoe"
 */
function taas_suburb_distance($slug, $suburb_name = '', $acf_override = '') {
    $sub  = taas_suburb_data($slug, $suburb_name);
    $name = $sub['name'] ?: $suburb_name;
    $dist = $acf_override ?: ($sub['distance'] ?? '');

    if (!$dist) return '';

    // Avoid "from X from Y" if distance already contains "from"
    if (stripos($dist, 'from') !== false || stripos($dist, 'at our') !== false) {
        return $dist;
    }
    return $dist . ' from ' . $name;
}

/**
 * Get area served string for a suburb (for schema + copy).
 *
 * @param string $slug
 * @param string $suburb_name
 * @return string e.g. "Papatoetoe, Hunters Corner, Manukau, Ōtāhuhu, Māngere, and Wiri"
 */
function taas_suburb_area($slug, $suburb_name = '') {
    $sub = taas_suburb_data($slug, $suburb_name);
    return $sub['area'] ?? $suburb_name;
}

/**
 * Get all suburb slugs in the library — useful for bulk operations,
 * sitemap generation, and checking coverage.
 *
 * @return string[] Array of suburb slugs
 */
function taas_suburb_slugs() {
    return array_keys(taas_suburbs_library());
}

/**
 * Build a complete set of suburb pill links for a service cluster.
 * Returns HTML-ready array of ['slug'=>..., 'name'=>..., 'url'=>...].
 *
 * @param string $url_pattern  sprintf pattern e.g. '/auto-electrical-%s/'
 * @param string $current_slug Currently active suburb (gets aria-current)
 * @return array
 */
function taas_suburb_pills($url_pattern, $current_slug = '') {
    $lib   = taas_suburbs_library();
    $pills = [];
    foreach ($lib as $slug => $data) {
        $pills[] = [
            'slug'    => $slug,
            'name'    => $data['name'],
            'url'     => sprintf($url_pattern, $slug),
            'current' => ($slug === $current_slug),
        ];
    }
    return $pills;
}
