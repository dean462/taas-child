<?php
/**
 * TAAS Shared FAQ Library — taas-faqs.php
 * Single source of truth for FAQ questions and answers shared across templates.
 *
 * Loaded in child theme root alongside taas-constants.php.
 * Requires taas-constants.php to be loaded first.
 *
 * Usage in templates:
 *   require_once get_stylesheet_directory() . '/taas-constants.php';
 *   require_once get_stylesheet_directory() . '/taas-faqs.php';
 *
 *   $faqs = [
 *       $taas_faqs['wof_cost'],
 *       $taas_faqs['finance'],
 *       $taas_faqs['location'],
 *       // Page-specific FAQs inline
 *       ['q' => 'How much does a brake service cost?', 'a' => '...'],
 *   ];
 *
 * One file update propagates to every template that references the key.
 *
 * Created: June 2026
 * Author: Dean Allen & Claude
 */

// ── Local vars from constants (prefixed to avoid collisions) ────────────────
$_fq_phone   = defined('TAAS_PHONE_FREE')  ? TAAS_PHONE_FREE  : '0800 100 876';
$_fq_local   = defined('TAAS_PHONE_LOCAL') ? TAAS_PHONE_LOCAL : '09 278 9556';
$_fq_wof     = defined('TAAS_WOF_PRICE')  ? TAAS_WOF_PRICE   : '$80';
$_fq_est     = defined('TAAS_ESTABLISHED') ? TAAS_ESTABLISHED : '1985';
$_fq_years   = date('Y') - intval($_fq_est);
$_fq_rating  = defined('TAAS_RATING')     ? TAAS_RATING      : '4.2';
$_fq_reviews = defined('TAAS_REVIEWS')    ? TAAS_REVIEWS     : '200+';
$_fq_euro    = defined('TAAS_EURO_BRANDS') ? TAAS_EURO_BRANDS : 'Audi, BMW, Volkswagen, Skoda, Mercedes-Benz, Land Rover, Range Rover & more';
$_fq_hours   = defined('TAAS_HOURS')      ? TAAS_HOURS       : 'Monday–Friday 7:30am–5:00pm';
$_fq_email   = defined('TAAS_EMAIL')      ? TAAS_EMAIL       : 'enquiries@taas.co.nz';
$_fq_cust    = defined('TAAS_CUSTOMERS')  ? TAAS_CUSTOMERS   : '10,000+';
$_fq_finance = defined('TAAS_FINANCE_LIST') ? TAAS_FINANCE_LIST : 'Afterpay, Q Card, GEM, Aotea Finance';
$_fq_mbi     = defined('TAAS_MBI_LIST')    ? TAAS_MBI_LIST    : 'Autosure, Assurant, Provident, Janssen, Autolife';
$_fq_site    = get_site_url();
$_fq_maps    = 'https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau';
$_fq_scan    = defined('TAAS_SCAN_PRICE') ? TAAS_SCAN_PRICE  : '$75';
$_fq_diag    = defined('TAAS_MECH_DIAG')  ? TAAS_MECH_DIAG   : 'from $175';
$_fq_division = defined('TAAS_DIVISION_COUNT') ? TAAS_DIVISION_COUNT : '7';
$_fq_ms      = defined('TAAS_MS_NUMBER') ? TAAS_MS_NUMBER : 'MS 13890';
$_fq_brake   = defined('TAAS_BRAKE_PRICE')   ? TAAS_BRAKE_PRICE   : 'from $380';
$_fq_clutch  = defined('TAAS_CLUTCH_PRICE')  ? TAAS_CLUTCH_PRICE  : 'from $800';
$_fq_aircon  = defined('TAAS_AIRCON_PRICE')  ? TAAS_AIRCON_PRICE  : 'from $280';
$_fq_service = defined('TAAS_SERVICE_PRICE') ? TAAS_SERVICE_PRICE : 'from $230';
$_fq_cambelt = defined('TAAS_CAMBELT_PRICE') ? TAAS_CAMBELT_PRICE : 'from $800';
$_fq_battery = defined('TAAS_BATTERY_PRICE') ? TAAS_BATTERY_PRICE : 'from $180 fitted';
$_fq_ae_diag = defined('TAAS_AUTOELEC_DIAG') ? TAAS_AUTOELEC_DIAG : 'from $175';
$_fq_svc_ess = defined('TAAS_SVC_ESS_CAR')  ? TAAS_SVC_ESS_CAR  : '$229';
$_fq_svc_std = defined('TAAS_SVC_STD_CAR')  ? TAAS_SVC_STD_CAR  : '$329';
$_fq_svc_prem= defined('TAAS_SVC_PREM_CAR') ? TAAS_SVC_PREM_CAR : '$429';

$taas_faqs = [];


/* ═══════════════════════════════════════════════════════════════════════════
   WOF
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['wof_cost'] = [
    'q' => 'How much does a WOF cost at TAAS?',
    'a' => 'A Warrant of Fitness at Tony Allen Auto Service costs ' . $_fq_wof . ' incl. GST — all makes, all models, no hidden charges. We are NZTA Authorised (station number ' . $_fq_ms . ') at 139 Cavendish Drive, Manukau. Walk-ins welcome mornings, bookings recommended. Call ' . $_fq_phone . ' to book. If your vehicle fails, we offer a free re-inspection within 28 days.',
];

$taas_faqs['wof_recheck'] = [
    'q' => 'Do you offer a free re-inspection if my car fails a WOF?',
    'a' => 'Yes. If your vehicle fails its WOF at TAAS, we offer a free re-inspection within 28 days once the required repairs are completed — whether we do the repairs or you take it elsewhere. If we carry out the repairs, we re-inspect the same day where possible. If your vehicle was checked at another workshop, the free re-inspection is with that company.',
];

$taas_faqs['wof_fail'] = [
    'q' => 'What happens if my car fails its WOF?',
    'a' => 'We give you a printed report listing every item that failed and why. We explain each item in plain English — what it means, how urgent it is, and what the repair options are. We provide an estimate for the repairs and wait for your approval before doing any work. Free re-inspection within 28 days once the repairs are completed.',
];

$taas_faqs['wof_fail_detail'] = [
    'q' => 'What happens if my vehicle fails its WOF?',
    'a' => 'We give you a written repair estimate — no obligation to proceed. The re-inspection is free within 28 days. You can have the work done here, take it somewhere else, or do it yourself — the recheck is free either way. Because we run ' . $_fq_division . ' specialist divisions under one roof, we can often handle repairs on the same visit — subject to the work required and parts availability.',
];

$taas_faqs['wof_appointment'] = [
    'q' => 'Do I need an appointment for a WOF in Manukau?',
    'a' => 'Walk-ins are welcome mornings, Monday to Friday at <a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>. Afternoons fill quickly, so booking ahead is strongly recommended. Most WOF inspections are completed in 30–45 minutes while you wait. Call <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '">' . $_fq_phone . '</a> to book a time.',
];

$taas_faqs['wof_frequency_2026'] = [
    'q' => 'How often do I need a WOF — including the 2026 rule changes?',
    'a' => 'From <strong>1 November 2026</strong>, WOF frequency changes for many vehicles. Vehicles aged 4–14 years registered from November 2019 move to two-yearly inspections. Vehicles over 14 years old remain on annual WOFs — no change. Pre-2000 vehicles move from 6-monthly to annual. New vehicles get their first WOF at 4 years instead of 3. A large proportion of the South Auckland fleet is over 14 years old and is unaffected. Not sure? Call us on <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '">' . $_fq_phone . '</a>.',
];

$taas_faqs['wof_checklist'] = [
    'q' => 'What do they check in a New Zealand WOF?',
    'a' => 'A NZ WOF covers 12 mandatory safety areas: tyres and tread depth, brakes and brake lines, steering and suspension, lights and indicators, windscreen and wipers, seatbelts, body and structural condition, exhaust, fuel system, doors and glazing, speedometer, and from 2026 — ADAS safety system warning lights.',
];

$taas_faqs['wof_fine_2026'] = [
    'q' => 'What is the fine for an expired WOF in 2026?',
    'a' => 'Currently $200. From <strong>1 November 2026</strong>, driving with a WOF expired by more than two months increases to <strong>$350</strong>. Non-compliant tyres attract fines of up to $1,000. Source: NZTA.',
];

$taas_faqs['wof_older_vehicles'] = [
    'q' => 'Do you WOF older vehicles, utes, and 4WDs?',
    'a' => 'Yes. We inspect all light vehicle types: older Japanese imports, modern SUVs, utes (Toyota Hilux, Ford Ranger, Mitsubishi Triton, Holden Colorado, Mazda BT-50), vans, and light commercial vehicles. Our team has been working on South Auckland\'s vehicle fleet for over ' . $_fq_years . ' years.',
];

$taas_faqs['wof_reminders'] = [
    'q' => 'Do you send WOF reminder notifications?',
    'a' => 'Yes — free automated WOF reminder service. We email you when your WOF is coming up, or text if we don\'t have an email on file. Ask us to add you at your next visit or call <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '">' . $_fq_phone . '</a>. You\'ll never miss a WOF expiry again.',
];

$taas_faqs['wof_accreditation'] = [
    'q' => 'Are you an NZTA-authorised WOF inspection station?',
    'a' => 'Yes. Tony Allen Auto Service is NZTA Authorised (' . $_fq_ms . ') and MTA Assured — independently assessed. We use regularly calibrated, fully certified testing equipment. ' . $_fq_years . ' years at the same address in Manukau.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   DIAGNOSTICS
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['diagnostic_scan'] = [
    'q' => 'Can I get a diagnostic scan without committing to repairs?',
    'a' => 'Yes. A diagnostic scan is ' . $_fq_scan . ' and reads fault codes across all vehicle systems. You receive a printout of the results with an explanation of what the codes mean. There is no pressure to proceed with any repairs. If further diagnostics are required to isolate the specific fault, we explain what is involved and provide an estimate before going ahead.',
];

$taas_faqs['diagnose_first'] = [
    'q' => 'Do you diagnose before recommending repairs?',
    'a' => 'Always. We never guess and replace. Raj, our lead diagnostics technician, verifies the fault using manufacturer-level diagnostic tools before any part gets replaced. A diagnostic scan is ' . $_fq_scan . ' — you receive a printout of results. If further diagnostics are required to isolate the specific fault, we provide a separate estimate. This approach saves you money and avoids unnecessary parts replacement.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   ESTIMATES & PRICING
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['estimates'] = [
    'q' => 'Do you provide estimates before starting work?',
    'a' => 'Yes. For any repair or service beyond a standard WOF, we provide an estimate before we start and wait for your approval before proceeding. If we find anything additional during the job, we contact you with an explanation and a separate estimate. Nothing gets done without your say-so — no surprises on the invoice.',
];

$taas_faqs['extra_work'] = [
    'q' => 'What happens if you find extra work during my service?',
    'a' => 'We always call you first. If our technicians find anything beyond the original job, we contact you with an explanation of what we have found, why it matters, and an estimate before doing any additional work. Nothing gets done without your approval. No surprises on the invoice.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['finance'] = [
    'q' => 'Do you offer finance or payment plans?',
    'a' => 'Yes. We offer four finance options: ' . $_fq_finance . '. Spread the cost of larger repairs with flexible payment terms. No pressure — just options when you need them. Ask when you enquire or visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance page</a> for full details.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   LOCATION & HOURS
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['location'] = [
    'q' => 'Where are you located and what are your hours?',
    'a' => '<a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau, Auckland 2104</a>. Monday to Friday, 7:30am to 5:00pm. Closed Saturday and Sunday. Just off Great South Road, one minute from the Manukau motorway interchange where SH1 meets SH20. Serving all of South Auckland for ' . $_fq_years . ' years.',
];

$taas_faqs['location_short'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book.',
];

$taas_faqs['suburbs'] = [
    'q' => 'What suburbs do you cover from Manukau?',
    'a' => 'We serve all of South Auckland from 139 Cavendish Drive, Manukau — including Papatoetoe, Ōtāhuhu, Māngere, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany, Howick, Clover Park, Weymouth, and Clendon. ' . $_fq_years . ' years at the same address. Most South Auckland suburbs are within 15 minutes.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   BOOKING
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['booking'] = [
    'q' => 'Do I need to book or can I walk in?',
    'a' => 'Bookings are recommended for servicing, repairs, and diagnostics so we can allocate the right technician and time. WOF walk-ins are welcome mornings. Call ' . $_fq_phone . ' or send an enquiry through our website to book.',
];

$taas_faqs['service_duration'] = [
    'q' => 'How long will my service take?',
    'a' => 'A WOF takes around 30 to 45 minutes. Vehicle servicing depends on the tier — an Essential service is typically completed within an hour, a Standard service takes around an hour, and a Premium service takes approximately an hour and a half. Brake and clutch repairs are usually completed same day where parts are available. Call ' . $_fq_phone . ' and we will let you know what to expect for your specific vehicle.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   BUSINESS / TRUST
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['years_trading'] = [
    'q' => 'How long have you been in business?',
    'a' => 'Tony Allen Auto Service was established in October ' . $_fq_est . ' — ' . $_fq_years . ' years at the same address on Cavendish Drive, Manukau. Family-owned and operated. MTA Assured and NZTA Authorised. South Auckland\'s largest independent workshop.',
];

$taas_faqs['services_overview'] = [
    'q' => 'What services does Tony Allen Auto Service offer?',
    'a' => 'Seven specialist divisions under one roof: full <a href="' . esc_url($_fq_site . '/vehicle-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">vehicle servicing</a> and repairs, <a href="' . esc_url($_fq_site . '/wof/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">WOF inspections</a> (NZTA Authorised), <a href="' . esc_url($_fq_site . '/manukau-brake-clutch/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">brakes and clutch</a> (Manukau Brake & Clutch), <a href="' . esc_url($_fq_site . '/auto-electrical/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">auto electrical and diagnostics</a>, <a href="' . esc_url($_fq_site . '/steering-and-suspension/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">steering and suspension</a>, <a href="' . esc_url($_fq_site . '/air-conditioning/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">air conditioning</a>, and <a href="' . esc_url($_fq_site . '/tyre-centre/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">tyres and wheels</a>. Plus specialist <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">European vehicle servicing</a>, <a href="' . esc_url($_fq_site . '/fleet-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">fleet servicing</a> for businesses, and <a href="' . esc_url($_fq_site . '/manukau-batteries/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">Manukau Batteries</a>. All at 139 Cavendish Drive, Manukau — seven divisions, one workshop, everything under one roof.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MAKES & MODELS
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['all_makes'] = [
    'q' => 'Do you service all makes and models?',
    'a' => 'Yes. We work on all makes and models including Japanese, Korean, European, and American vehicles. Our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a> specialises in ' . $_fq_euro . ' with factory-spec diagnostic equipment. Independent workshop pricing, dealer-level capability.',
];

$taas_faqs['european'] = [
    'q' => 'Do you work on European vehicles?',
    'a' => 'Yes. TAAS European is our dedicated division for European vehicles — ' . $_fq_euro . '. We carry factory-spec diagnostic tools that read manufacturer-specific fault codes generic scanners cannot access. Same workshop, same team, independent pricing. Call ' . $_fq_phone . ' to confirm capability for your specific model.',
];

$taas_faqs['dealer_vs_independent'] = [
    'q' => 'Do I need to go back to the dealer for servicing?',
    'a' => 'No. Under New Zealand consumer law, you can have your vehicle serviced at any qualified workshop without affecting your manufacturer warranty — provided the correct parts, fluids and service intervals are followed. Tony Allen Auto Service is MTA Assured and services all vehicles to manufacturer specification. Many of our ' . $_fq_cust . ' customers switched from dealer servicing and saved hundreds of dollars annually with no impact on their warranty.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   SPECIALIST VEHICLES
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['hybrid_ev'] = [
    'q' => 'Can you service hybrid and electric vehicles?',
    'a' => 'Yes. We service Toyota, Nissan, Honda and other hybrid systems as well as BEV, PHEV and MHEV vehicles. Hybrid servicing follows the standard petrol schedule with additional HV battery health, cooling system and regenerative braking checks. EV servicing covers the 12V battery, HV coolant, brake fluid, cabin filters, HV system scan, and a full visual inspection of all HV cables. See our <a href="' . esc_url($_fq_site . '/electric-hybrid-vehicle-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">EV & hybrid page</a> for more.',
];

$taas_faqs['diesel'] = [
    'q' => 'Do you service diesel vehicles?',
    'a' => 'Yes. Diesel services follow the same three-tier structure with additional diesel-specific checks including fuel filter inspection, DPF status via diagnostic scan (soot load and regeneration cycle data), turbocharger inspection, and AdBlue levels where applicable. If your DPF requires a forced regeneration, we will advise and provide an estimate before proceeding. See our <a href="' . esc_url($_fq_site . '/diesel-vehicle-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">diesel servicing page</a>.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI & WARRANTY
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi'] = [
    'q' => 'Are you an approved MBI repairer?',
    'a' => 'Yes. TAAS is an approved repairer for ' . $_fq_mbi . ' mechanical breakdown insurance. We handle all MBI claims correctly and efficiently.',
];

$taas_faqs['warranty_safe'] = [
    'q' => 'Will using an independent workshop void my warranty?',
    'a' => 'No. Under New Zealand consumer law, you can have your vehicle serviced at any qualified workshop without affecting your manufacturer warranty, provided the correct parts, fluids and service intervals are followed. We use the correct oil grades, genuine-equivalent filters, and follow manufacturer service schedules. We stamp your service book at every visit.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FLEET
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['fleet'] = [
    'q' => 'Do you offer fleet servicing for business vehicles?',
    'a' => 'Yes. We invoice businesses direct — no driver reimbursements, no upfront payment. We also work through SG Fleet NZ, ORIX NZ, Custom Fleet, and Fleet Partners. Cars, vans, utes, and light trucks up to 6.5 tonne. Key drop box for after-hours drop-off, and all seven workshop divisions available. Call ' . $_fq_phone . ' and ask for Dean to set up an account.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   TYRES
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['tyre_brands'] = [
    'q' => 'What brands of tyres do you stock?',
    'a' => 'We can supply almost any tyre brand — Toyo, Maxxis, Goodyear, Continental, Pirelli, Hifly, Rovelo, Vitora, and more. Budget through to premium. Call ' . $_fq_phone . ' with your tyre size for an estimate.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   SERVICING
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['service_cost'] = [
    'q' => 'How much does a car service cost in Manukau?',
    'a' => 'Servicing at Tony Allen Auto Service starts from ' . $_fq_svc_ess . ' for a standard car. The exact price depends on the service level (Essential, Standard or Premium) and the vehicle type — European vehicles, utes, and larger engines cost more due to oil specification and capacity. We have five vehicle categories with clear pricing for each. Call ' . $_fq_phone . ' for an estimate.',
];

$taas_faqs['service_included'] = [
    'q' => 'What is included in a full car service?',
    'a' => 'Our Premium service includes engine oil and filter, all fluid levels checked and topped up, cooling system pressure test, full brake inspection with wheels removed and discs measured, OBD diagnostic scan, air and cabin filter inspection, cambelt condition recorded, battery health test, full suspension and steering assessment, tyre rotation if required, and a thorough road test. If any additional work is needed, we provide a written estimate and wait for your approval.',
];

$taas_faqs['service_frequency'] = [
    'q' => 'How often should I get my car serviced in New Zealand?',
    'a' => 'We recommend an Essential service between major services if you are doing high kilometres. A Standard service is suitable every 10,000km or 12 months. A Premium service at your manufacturer\'s specified interval gives you 12 months of safe motoring — it is the most thorough option and the one most of our customers choose. Vehicles doing predominantly short trips or stop-start driving may benefit from more frequent servicing.',
];

$taas_faqs['logbook'] = [
    'q' => 'What is a logbook service?',
    'a' => 'A logbook service follows the maintenance schedule specified by your vehicle\'s manufacturer. It ensures every check, filter, fluid and component is serviced at the correct interval. We carry out logbook services for all makes and models — and we stamp your service book. This maintains your service record whether the vehicle is under warranty or not.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   BRAKES & CLUTCH
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['brake_disc'] = [
    'q' => 'Do you do brake repairs and disc machining?',
    'a' => 'Yes. Manukau Brake & Clutch (MBC) is our specialist brake and clutch division. Full brake system service, disc machining and skimming in-house, clutch replacement, and hydraulic work.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   AUTO ELECTRICAL
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['auto_electrical_services'] = [
    'q' => 'What auto electrical services do you offer?',
    'a' => 'ECU and fault code diagnostics, dashboard warning lights, battery supply and fit, alternator and starter motor repair, ABS and SRS fault diagnosis, wiring fault repair, central locking and windows, immobiliser and key programming. All led by Raj, our Lead Diagnostics & Auto Electrical Technician. Diagnostic scan ' . $_fq_scan . '.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   ACCREDITATIONS & GUARANTEE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['accreditations'] = [
    'q' => 'What accreditations does TAAS hold?',
    'a' => 'Tony Allen Auto Service is MTA Assured through the Motor Trade Association quality assurance programme, and NZTA Authorised for Warrant of Fitness inspections — station number ' . $_fq_ms . '. Family-owned and operating from 139 Cavendish Drive, Manukau since ' . $_fq_est . ' — ' . $_fq_years . ' years at the same address.',
];

$taas_faqs['workmanship_guarantee'] = [
    'q' => 'Do you guarantee your work?',
    'a' => 'Yes. All repairs carried out by Tony Allen Auto Service are backed by our workmanship guarantee. If anything is not right after a service or repair, call us on ' . $_fq_phone . ' and we will make it right.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['finance_payment_plans'] = [
    'q' => 'Does Tony Allen Auto Service offer payment plans?',
    'a' => 'Yes. We offer four finance options: ' . $_fq_finance . '. BNPL options split your bill into four fortnightly payments at 0% interest. Interest-free card options give you up to six months to pay. Aotea Finance provides personal loans for all credit circumstances.',
];

$taas_faqs['finance_which_option'] = [
    'q' => 'Which payment option is best for me?',
    'a' => 'It depends on your repair cost and situation. For smaller repairs and everyday servicing, Afterpay are the quickest to set up. For repairs over $250, Gem Finance gives you six months interest-free. Q Card offers at least three months with nothing to pay. If you have had credit difficulties, Aotea Finance considers all circumstances.',
];

$taas_faqs['finance_combine'] = [
    'q' => 'Can I combine two payment options?',
    'a' => 'We are not able to split a single invoice across multiple finance providers. You would need to select one option per transaction. If you are unsure, call us on ' . $_fq_phone . ' and we can talk it through.',
];

$taas_faqs['finance_arrange_before'] = [
    'q' => 'Do I need to arrange finance before I bring my vehicle in?',
    'a' => 'For Afterpay, you need an active account and the in-store card set up on your phone before you arrive. For Q Card and Gem Finance, applying in advance means your account is ready at collection. We recommend not leaving it to the day of collection.',
];

$taas_faqs['finance_minimum'] = [
    'q' => 'Is there a minimum repair cost to use these options?',
    'a' => 'Afterpay, and Q Card have no stated minimum, though individual spend limits apply. Gem Finance requires a minimum transaction of $250. Aotea Finance terms vary — contact them directly for current thresholds.',
];

$taas_faqs['finance_wof_repairs'] = [
    'q' => 'Do you offer interest-free finance for WOF failures?',
    'a' => 'Yes. If your vehicle fails its WOF and needs repairs, all four finance options are available for the repair work. Most WOF repairs qualify. If parts need to be ordered, our team will advise on timing.',
];

$taas_faqs['finance_is_taas_provider'] = [
    'q' => 'Is TAAS a finance provider?',
    'a' => 'No. Tony Allen Auto Service is a merchant partner with each of these finance providers. We do not provide financial advice or credit. All finance agreements are directly between you and the provider. Please read their terms carefully before applying.',
];

$taas_faqs['finance_fleet'] = [
    'q' => 'Can I use these options for fleet or commercial vehicle repairs?',
    'a' => 'These finance products are consumer-facing. For business fleet servicing, TAAS Fleet offers direct invoicing arrangements. Call ' . $_fq_phone . ' or email ' . $_fq_email . ' to discuss fleet accounts.',
];

$taas_faqs['finance_afterpay_manukau'] = [
    'q' => 'Can I use Afterpay to pay for car repairs in Manukau?',
    'a' => 'Yes. Tony Allen Auto Service at 139 Cavendish Drive, Manukau accepts Afterpay in-store for servicing, repairs, WOF failure work, tyres, and parts. You pay 25% when you collect your vehicle and the remaining three instalments are deducted automatically every two weeks. Set up the Afterpay app and add the digital card to your phone wallet before you arrive.',
];

$taas_faqs['finance_missed_payment'] = [
    'q' => 'What happens if I miss a payment on Afterpay?',
    'a' => 'Late fees apply. Afterpay charges a late fee capped at 25% of the order value or $68, whichever is less. Afterpay may also pause your account until the missed payment is cleared. Tony Allen Auto Service is not involved in payment collection — that sits entirely between you and the provider.',
];

$taas_faqs['finance_afterpay_setup'] = [
    'q' => 'How do I set up Afterpay on my phone before I arrive?',
    'a' => 'Download the Afterpay app from the App Store or Google Play. Create an account and complete the identity verification — a credit check applies under NZ law. Once approved, add the Afterpay Card to your phone wallet via Apple Pay, Google Pay, or Samsung Pay. When you collect your vehicle from Tony Allen Auto Service, tap your phone at the EFTPOS terminal to pay.',
];

$taas_faqs['finance_eftpos_cards'] = [
    'q' => 'Do you accept EFTPOS and credit cards as well as finance?',
    'a' => 'Yes. We accept cash, EFTPOS, Visa, and Mastercard alongside all four finance options. Finance is there if you need it, but there is no requirement to use it. Most customers pay by EFTPOS or card on the day.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE — AFTERPAY SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['afterpay_any_repair'] = [
    'q' => 'Can I use Afterpay for any repair at Tony Allen Auto Service?',
    'a' => 'Yes. Afterpay is accepted across our full range of services — WOF, routine servicing, brakes, tyres, engine work, cambelt, suspension, clutch, diagnostics, and more. The only limit is your individual Afterpay spend limit. Check your available balance in the Afterpay app before booking if your job is a larger one.',
];

$taas_faqs['afterpay_account_setup'] = [
    'q' => 'Do I need an Afterpay account before I come in?',
    'a' => 'Yes. You need an active Afterpay account and the digital Afterpay Card added to your phone\'s wallet (Apple Pay, Google Pay, or Samsung Pay) before paying in-store. Download the Afterpay app, complete sign-up, and set up the in-store card in the In-store tab before your collection appointment. It only takes a few minutes.',
];

$taas_faqs['afterpay_spend_limit'] = [
    'q' => 'How much can I spend with Afterpay?',
    'a' => 'Afterpay sets individual spend limits based on your payment history, account age, and a credit assessment. New customers start with a lower limit that can increase over time with consistent on-time payments. Your current available limit is shown in the Afterpay app. We recommend checking before booking in for a large repair.',
];

$taas_faqs['afterpay_interest_free'] = [
    'q' => 'Is Afterpay really interest-free?',
    'a' => 'Yes — when you pay all four instalments on time, there is no interest charged at all. If you miss a payment, a late fee may apply, capped at 25% of your order total or $68 NZD — whichever is less. See afterpay.com for full terms.',
];

$taas_faqs['afterpay_missed_payment'] = [
    'q' => 'What happens if I miss an Afterpay payment?',
    'a' => 'Afterpay sends reminder notifications before each payment date. You can also reschedule a payment in the Afterpay app up to three times per year. If a payment is missed, a late fee may apply and your account may be paused until the balance is cleared. Late fees are capped — they will never exceed 25% of your order total or $68.',
];

$taas_faqs['afterpay_how_to_pay'] = [
    'q' => 'How do I pay with Afterpay when I pick up my vehicle?',
    'a' => 'Before you arrive, open the Afterpay app and ensure the digital Afterpay Card is added to your phone\'s wallet. When you collect your vehicle, let our service desk know you\'re paying with Afterpay and tap your phone at the payment terminal. The first instalment — 25% of the total — is charged immediately. The remaining three are deducted automatically every two weeks.',
];

$taas_faqs['afterpay_credit_score'] = [
    'q' => 'Will using Afterpay affect my credit score?',
    'a' => 'Afterpay performs a credit check when you first sign up — this may be visible to other lenders and could impact your credit score. For existing customers, credit checks for spend limit increases are not visible to other lenders and will not affect your score. Making consistent on-time payments may have a positive effect on your credit history.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE — ZIP SPOKE
═══════════════════════════════════════════════════════════════════════════ */


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE — Q CARD SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['qcard_any_repair'] = [
    'q' => 'Can I use Q Card for any repair at Tony Allen Auto Service?',
    'a' => 'Yes. Q Card is accepted across our full range of services — WOF, routine servicing, brakes, tyres, engine work, cambelt, suspension, clutch, and diagnostics. Your Q Card credit limit applies.',
];

$taas_faqs['qcard_how_to_get'] = [
    'q' => 'How do I get a Q Card?',
    'a' => 'You can apply online at qcard.co.nz. You\'ll need NZ photo ID and proof of income. Approval is usually fast — you can use your card straight away once approved.',
];

$taas_faqs['qcard_spend_limit'] = [
    'q' => 'How much can I spend with Q Card?',
    'a' => 'Your Q Card credit limit is set when you apply. Check your available balance before booking a large repair. Limits can increase over time with a good payment history.',
];

$taas_faqs['qcard_interest_free'] = [
    'q' => 'How long is the Q Card interest-free period?',
    'a' => 'Q Card offers a minimum of 3 months no payments and no interest on in-store purchases. Longer terms may be available — ask our service desk when you come in.',
];

$taas_faqs['qcard_repayments'] = [
    'q' => 'Do I need to make repayments during the interest-free period?',
    'a' => 'Yes. A minimum monthly repayment is required during the interest-free period. If minimum repayments are not made, you may lose your interest-free promotion. Check your Q Card terms at qcard.co.nz.',
];

$taas_faqs['qcard_after_promo'] = [
    'q' => 'What happens after the Q Card interest-free period?',
    'a' => 'Once the interest-free period ends, the standard Q Card interest rate applies to any remaining balance. It\'s best to pay off the balance before the period ends to avoid interest charges.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE — GEM FINANCE SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['gem_any_repair'] = [
    'q' => 'Can I use Gem Visa for any repair at Tony Allen Auto Service?',
    'a' => 'Yes. Gem Visa is accepted across our full range of services — WOF, routine servicing, brakes, tyres, engine work, cambelt, suspension, clutch, and diagnostics. An interest-free period may apply on purchases of $250 or more — check your current Gem Visa offer.',
];

$taas_faqs['gem_account_setup'] = [
    'q' => 'Do I need a Gem Visa card before I come in?',
    'a' => 'Yes. You need an active Gem Visa card with available credit. If you don\'t have one yet, apply at latitudefinancial.co.nz. Once approved, you can use it straight away.',
];

$taas_faqs['gem_spend_limit'] = [
    'q' => 'How much can I spend with Gem Visa?',
    'a' => 'Your Gem Visa credit limit is set when you apply and can increase over time. Check your available balance in your Gem Visa account before booking a large repair.',
];

$taas_faqs['gem_interest_free'] = [
    'q' => 'Is Gem Visa interest-free?',
    'a' => 'Gem Visa interest-free periods are available on qualifying purchases — typically $250 or more. During the interest-free period, no interest is charged provided you make the minimum monthly repayment. Once the period ends, the standard interest rate applies to any remaining balance.',
];

$taas_faqs['gem_how_to_pay'] = [
    'q' => 'How do I apply a Gem Visa interest-free offer at pickup?',
    'a' => 'When collecting your vehicle, let our service desk know you\'d like to apply an interest-free promotion to your Gem Visa. We\'ll process the payment accordingly. Make sure your offer is current — check your Gem Visa account before coming in.',
];

$taas_faqs['gem_missed_payment'] = [
    'q' => 'What happens if I miss a Gem Visa payment?',
    'a' => 'Missing a minimum repayment may result in a late fee and the loss of your interest-free promotion. Contact Gem directly on 0800 500 505 if you\'re having difficulty with repayments.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FINANCE — AOTEA FINANCE SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['aotea_any_repair'] = [
    'q' => 'Can I use Aotea Finance for any repair at Tony Allen Auto Service?',
    'a' => 'Yes. Aotea Finance can be used for the full range of repairs and servicing at Tony Allen Auto Service — WOF, routine servicing, brakes, tyres, engine work, cambelt, suspension, and more. Your approved finance amount applies.',
];

$taas_faqs['aotea_how_to_apply'] = [
    'q' => 'How do I apply for Aotea Finance?',
    'a' => 'Apply online at aoteafinance.co.nz/contact/ before your visit. You\'ll need NZ photo ID and proof of income. Aotea Finance will assess your application and confirm your approval and loan amount.',
];

$taas_faqs['aotea_interest'] = [
    'q' => 'Is Aotea Finance interest-free?',
    'a' => 'No. Aotea Finance is a personal loan product — interest applies to the loan amount. The advantage is fixed repayments over a set term, so you always know exactly what you\'ll pay. There are no variable rates or hidden fees.',
];

$taas_faqs['aotea_approval_time'] = [
    'q' => 'How quickly is Aotea Finance approved?',
    'a' => 'Aotea Finance aims to process applications quickly. Apply online before your visit and they will contact you to confirm your approval. Once approved, call us to book your vehicle in.',
];

$taas_faqs['aotea_declined_elsewhere'] = [
    'q' => 'What if I\'ve been declined for finance elsewhere?',
    'a' => 'Aotea Finance considers all financial situations — including those who have been declined by other lenders. They are a NZ-owned lender focused on helping New Zealanders get back on the road. It\'s worth applying.',
];

$taas_faqs['aotea_arrange_before'] = [
    'q' => 'Do I need to arrange Aotea Finance before coming to TAAS?',
    'a' => 'Yes. Apply and get approved with Aotea Finance before booking your vehicle in. Once approved, contact us on ' . $_fq_phone . ' and we\'ll coordinate the rest.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_what_is'] = [
    'q' => 'What is Mechanical Breakdown Insurance?',
    'a' => 'Mechanical Breakdown Insurance (MBI) covers the cost of repairing or replacing mechanical and electrical components that fail due to sudden or unforeseen breakdown. It fills the gap left by your standard car insurance, which covers accidents, theft, and fire but not mechanical failures. Think of it as an extended warranty backed by an insurance company — when your engine, transmission, or air conditioning fails, MBI pays for the repair minus your excess.',
];

$taas_faqs['mbi_all_providers'] = [
    'q' => 'Does TAAS work with all four MBI providers?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Autosure, Assurant (formerly Protecta), Provident, Janssen Insurance, and Autolife. If you hold a policy with any of these providers and your vehicle breaks down, bring it to 139 Cavendish Drive, Manukau. We liaise with your insurer directly.',
];

$taas_faqs['mbi_breakdown_steps'] = [
    'q' => 'What do I do if my car breaks down and I have MBI?',
    'a' => 'Call your MBI provider before authorising any repair work — this is critical. They need to confirm you are at an approved repairer and authorise the work before it begins. Without prior authorisation, the claim may be declined. If you are unsure of the process, call us on ' . $_fq_phone . ' and we will guide you through it.',
];

$taas_faqs['mbi_servicing_valid'] = [
    'q' => 'Does my vehicle need to be serviced to keep MBI valid?',
    'a' => 'Yes. All four providers require your vehicle to be serviced at regular intervals at a qualified workshop. Keep all service invoices. Most providers require servicing at a registered MTA workshop — Tony Allen Auto Service is MTA Assured, which satisfies the workshop requirements of all four providers. Failure to provide service records is one of the most common reasons MBI claims are declined.',
];

$taas_faqs['mbi_claim_help'] = [
    'q' => 'Can TAAS help me make an MBI claim?',
    'a' => 'Yes. Once you have contacted your insurer and they have confirmed us as an authorised repairer, bring your vehicle in and we handle the rest. We liaise with the insurer, provide the fault diagnosis, and get the repair authorised before starting work. You pay the excess, your insurer pays the balance.',
];

$taas_faqs['mbi_vs_warranty'] = [
    'q' => 'Is MBI the same as a warranty?',
    'a' => 'MBI is often called an extended warranty, but it is technically an insurance product — which means it is regulated differently and you have rights under the Insurance Law Reform Act and Consumer Guarantees Act. The distinction matters if a claim is declined. Read your policy wording carefully.',
];

$taas_faqs['mbi_exclusions'] = [
    'q' => 'What is not covered by MBI?',
    'a' => 'Common exclusions across all providers include routine maintenance (oil changes, filters, tyres, brake pads), wear and tear, pre-existing faults at time of purchase, accident damage, modifications from factory specification, and failures resulting from neglect or improper maintenance. Always read your policy wording for the full exclusions list.',
];

$taas_faqs['mbi_service_at_taas'] = [
    'q' => 'Can I use TAAS as my regular service provider to keep my MBI valid?',
    'a' => 'Yes. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements of all four MBI providers we work with. Regular servicing at TAAS keeps your MBI policy valid and your vehicle in the best condition to avoid claims in the first place. We are at 139 Cavendish Drive, Manukau — call ' . $_fq_phone . ' to book.',
];

$taas_faqs['mbi_european'] = [
    'q' => 'Does TAAS handle MBI claims on European vehicles?',
    'a' => 'Yes. TAAS European is our specialist European vehicle division, covering Audi, BMW, Volkswagen, Mercedes-Benz, Volvo, and more. If your European vehicle breaks down and you hold an MBI policy, we handle the claim process the same way — diagnosis, insurer liaison, authorisation, and repair. ' . $_fq_division . ' divisions under one roof means the right specialist works on your vehicle.',
];

$taas_faqs['mbi_cost'] = [
    'q' => 'How much does MBI cost?',
    'a' => 'MBI pricing varies by provider, policy tier, vehicle age, odometer reading, and cover period. Policies are purchased through the provider directly or through a motor vehicle trader at the time of purchase. Tony Allen Auto Service does not sell MBI policies — we are the approved repairer who carries out the work when you need to make a claim.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — AUTOSURE SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_autosure_approved'] = [
    'q' => 'Is Tony Allen Auto Service an approved Autosure repairer?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Autosure MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, Autosure pays the balance directly to us. We are at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_autosure_breakdown'] = [
    'q' => 'What do I do if my car breaks down and I have Autosure?',
    'a' => 'Call Autosure on 0800 809 700 before authorising any repairs. They will confirm your policy is active and authorise the work. Then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We diagnose the fault, contact Autosure, obtain authorisation, and carry out the repair.',
];

$taas_faqs['mbi_autosure_claims_phone'] = [
    'q' => 'What is the Autosure claims phone number?',
    'a' => 'The Autosure claims line is 0800 809 700. Call them to confirm your policy is active, then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We liaise with Autosure directly from there.',
];

$taas_faqs['mbi_autosure_cover'] = [
    'q' => 'What does Autosure MBI cover?',
    'a' => 'Autosure offers two tiers — Extreme Plus and Essential. Extreme Plus covers engine, transmission, turbo, fuel system, electrical, clutch, differential, suspension, steering, air conditioning, and cooling. Vehicles up to 20 years old and 200,000 km are eligible. Includes unlimited AA Roadservice for the life of the policy.',
];

$taas_faqs['mbi_autosure_servicing'] = [
    'q' => 'Does regular servicing at TAAS keep my Autosure policy valid?',
    'a' => 'Yes. Autosure requires your vehicle to be serviced at regular intervals and service records to be current. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements. Keep all invoices — failure to provide service records is one of the most common reasons Autosure claims are declined.',
];

$taas_faqs['mbi_autosure_other_providers'] = [
    'q' => 'What other MBI providers does TAAS work with besides Autosure?',
    'a' => 'Alongside Autosure, we are an approved repairer for Assurant (formerly Protecta), Provident, Janssen Insurance, and Autolife. If you hold a policy with any of these providers, bring your vehicle to 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_autosure_roadside'] = [
    'q' => 'Does Autosure include roadside assistance?',
    'a' => 'Yes. Autosure Extreme Plus includes unlimited AA Roadservice for the life of the policy. This covers breakdowns, flat tyres, flat batteries, and lockouts anywhere in New Zealand. Contact AA Roadservice on 0800 500 222 for roadside assistance.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — ASSURANT SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_assurant_approved'] = [
    'q' => 'Is Tony Allen Auto Service an approved Assurant repairer?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Assurant (formerly Protecta) MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, Assurant pays the balance directly to us. We are at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_assurant_breakdown'] = [
    'q' => 'What do I do if my car breaks down and I have Assurant?',
    'a' => 'Call Assurant on 0800 776 832 before authorising any repairs. They will confirm your policy is active and authorise the work. Then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We diagnose the fault, contact Assurant, obtain authorisation, and carry out the repair.',
];

$taas_faqs['mbi_assurant_claims_phone'] = [
    'q' => 'What is the Assurant claims phone number?',
    'a' => 'The Assurant claims line is 0800 776 832. Call them to confirm your policy is active, then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We liaise with Assurant directly from there.',
];

$taas_faqs['mbi_assurant_cover'] = [
    'q' => 'What does Assurant MBI cover?',
    'a' => 'Assurant offers three tiers — Optimum, Maxi, and Kinetic. All tiers cover major mechanical, electrical, and electronic components including labour. Vehicles up to 15 years old or 250,000 km are eligible. Includes towing, rental car allowance, roadside assistance, and travel costs for breakdowns over 100 km from home.',
];

$taas_faqs['mbi_assurant_servicing'] = [
    'q' => 'Does regular servicing at TAAS keep my Assurant policy valid?',
    'a' => 'Yes. Assurant requires servicing to follow your Vehicle Service Programme and be carried out by a registered MTA workshop. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements. Keep all invoices — failure to provide service records is one of the most common reasons claims are declined.',
];

$taas_faqs['mbi_assurant_other_providers'] = [
    'q' => 'What other MBI providers does TAAS work with besides Assurant?',
    'a' => 'Alongside Assurant, we are an approved repairer for Autosure, Provident, Janssen Insurance, and Autolife. If you hold a policy with any of these providers, bring your vehicle to 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_assurant_protecta'] = [
    'q' => 'Is Assurant the same as Protecta Insurance?',
    'a' => 'Yes. Assurant completed its rebrand from Protecta Insurance in December 2024 following Assurant Inc\'s acquisition of Protecta in 2022. The same NZ team, same policies, same service — now under the global Assurant brand. If you hold a former Protecta policy, bring your vehicle to Tony Allen Auto Service and we handle the claim process exactly the same way.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — PROVIDENT SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_provident_approved'] = [
    'q' => 'Is Tony Allen Auto Service an approved Provident repairer?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Provident Insurance MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, Provident pays the balance directly to us. We are at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_provident_breakdown'] = [
    'q' => 'What do I do if my car breaks down and I have Provident?',
    'a' => 'Call Provident Claims on 0800 676 864 — available 24/7. They will identify the nearest authorised repair facility and authorise the work. Present your policy booklet when you arrive at Tony Allen Auto Service, 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_provident_claims_phone'] = [
    'q' => 'What is the Provident claims phone number?',
    'a' => 'The Provident claims line is 0800 676 864, available 24/7. Call them to confirm your policy is active, then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We liaise with Provident directly from there.',
];

$taas_faqs['mbi_provident_cover'] = [
    'q' => 'What does Provident MBI cover?',
    'a' => 'Provident offers cover for 1, 2, or 3 years with a range of excess options. Covers sudden or unforeseen mechanical and electrical failure of major components including engine, transmission, brakes, suspension, air conditioning, and more. Includes full NZ roadside assistance with towing, lost keys, flat tyre, and flat battery support.',
];

$taas_faqs['mbi_provident_servicing'] = [
    'q' => 'Does regular servicing at TAAS keep my Provident policy valid?',
    'a' => 'Yes. Provident requires your vehicle to be serviced at regular intervals at a qualified workshop. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements. Keep all invoices — failure to provide service records is one of the most common reasons Provident claims are declined.',
];

$taas_faqs['mbi_provident_other_providers'] = [
    'q' => 'What other MBI providers does TAAS work with besides Provident?',
    'a' => 'Alongside Provident, we are an approved repairer for Autosure, Assurant (formerly Protecta), Janssen Insurance, and Autolife. If you hold a policy with any of these providers, bring your vehicle to 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_provident_ev'] = [
    'q' => 'Does Provident cover electric and hybrid vehicles?',
    'a' => 'Yes. Provident offers EV Shield and Hybrid Shield policies specifically designed for electric and hybrid vehicles. These cover EV-specific components including traction battery and drivetrain. Tony Allen Auto Service has technicians in EV qualification training with high-voltage access — we handle Provident EV and hybrid claims.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — JANSSEN SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_janssen_approved'] = [
    'q' => 'Is Tony Allen Auto Service an approved Janssen repairer?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Janssen Insurance MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, Janssen pays the balance directly to us. We are at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_janssen_breakdown'] = [
    'q' => 'What do I do if my car breaks down and I have Janssen?',
    'a' => 'Call Janssen on 0800 526 7736 (0800 JANSSEN) before any work begins. Do not authorise repairs without prior approval. Then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We diagnose the fault, contact Janssen, obtain authorisation, and carry out the repair.',
];

$taas_faqs['mbi_janssen_claims_phone'] = [
    'q' => 'What is the Janssen claims phone number?',
    'a' => 'The Janssen claims line is 0800 526 7736 (0800 JANSSEN). Call them to confirm your policy is active, then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We liaise with Janssen directly from there.',
];

$taas_faqs['mbi_janssen_cover'] = [
    'q' => 'What does Janssen MBI cover?',
    'a' => 'Janssen offers multiple tiers including Elite Cover (up to $10,000 claim entitlement) and Elite Cover Plus. A key differentiator is that only one excess applies per claim event, even if multiple components require repair simultaneously. Includes unlimited roadside assistance with no dollar limit, a $2,000 customer care package for hire car and accommodation, and free policy transfer when selling your vehicle.',
];

$taas_faqs['mbi_janssen_servicing'] = [
    'q' => 'Does regular servicing at TAAS keep my Janssen policy valid?',
    'a' => 'Yes. Janssen requires service invoices to be provided before a claim proceeds. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements. Keep all invoices — failure to provide service records is one of the most common reasons Janssen claims are declined.',
];

$taas_faqs['mbi_janssen_other_providers'] = [
    'q' => 'What other MBI providers does TAAS work with besides Janssen?',
    'a' => 'Alongside Janssen, we are an approved repairer for Autosure, Assurant (formerly Protecta), Provident, and Autolife. If you hold a policy with any of these providers, bring your vehicle to 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_janssen_ev'] = [
    'q' => 'Does Janssen cover electric and hybrid vehicles?',
    'a' => 'Yes. Janssen offers Elite Eco Cover specifically designed for hybrid and EV vehicles, covering traction battery and EV-specific components. Tony Allen Auto Service has technicians in EV qualification training with high-voltage access — we handle Janssen EV and hybrid claims.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MBI — AUTOLIFE SPOKE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbi_autolife_approved'] = [
    'q' => 'Is Tony Allen Auto Service an approved Autolife repairer?',
    'a' => 'Yes. Tony Allen Auto Service is an approved repairer for Autolife MBI policies. We handle the claim process from diagnosis through to invoice — you pay the excess, Autolife pays the balance directly to us. We are at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_autolife_breakdown'] = [
    'q' => 'What do I do if my car breaks down and I have Autolife?',
    'a' => 'Call Autolife on 0800 288 654 before authorising any repairs. Complete the online claim form with your service records. Then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. The repairer contacts Autolife for authorisation, you pay the excess, and Autolife pays the balance directly.',
];

$taas_faqs['mbi_autolife_claims_phone'] = [
    'q' => 'What is the Autolife claims phone number?',
    'a' => 'The Autolife claims line is 0800 288 654. Call them to confirm your policy is active, then bring your vehicle to Tony Allen Auto Service at 139 Cavendish Drive, Manukau. We liaise with Autolife directly from there.',
];

$taas_faqs['mbi_autolife_cover'] = [
    'q' => 'What does Autolife MBI cover?',
    'a' => 'Autolife provides standard cover of $4,000 to $5,000 per claim depending on odometer reading. Covers engine, transmission, electrical systems, steering, suspension, air conditioning, fuel system, and more. Includes 24/7 roadside assistance with towing to any licensed MTA mechanic at no additional cost, and a rental car allowance for up to 5 days. Vehicles must be NZ registered, post-2000, and under 200,000 km at policy start.',
];

$taas_faqs['mbi_autolife_servicing'] = [
    'q' => 'Does regular servicing at TAAS keep my Autolife policy valid?',
    'a' => 'Yes. Autolife requires your vehicle to be serviced at regular intervals at a qualified workshop. Tony Allen Auto Service is MTA Assured, which satisfies the servicing requirements. Keep all invoices — failure to provide service records is one of the most common reasons Autolife claims are declined.',
];

$taas_faqs['mbi_autolife_other_providers'] = [
    'q' => 'What other MBI providers does TAAS work with besides Autolife?',
    'a' => 'Alongside Autolife, we are an approved repairer for Autosure, Assurant (formerly Protecta), Provident, and Janssen Insurance. If you hold a policy with any of these providers, bring your vehicle to 139 Cavendish Drive, Manukau.',
];

$taas_faqs['mbi_autolife_claims_speed'] = [
    'q' => 'How fast does Autolife pay claims?',
    'a' => 'Autolife reports that 96.5% of claim payments are made within 14 days, and 99.5% within 21 days. Once authorised, we carry out the repair and invoice Autolife directly — you only pay the excess. Policies also include a 7-day free look period on new policies if you change your mind.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   CONTACT PAGE
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['contact_booking'] = [
    'q' => 'How do I book a WOF or service at TAAS?',
    'a' => 'Fill in the enquiry form above or call <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '">' . $_fq_phone . '</a> — we will confirm a time that suits you. We are open Monday to Friday, 7:30am–5:00pm at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['contact_response_time'] = [
    'q' => 'How quickly will you get back to me after I send an enquiry?',
    'a' => 'We respond to all enquiries within a couple of hours during business hours. We will call or email to confirm your booking and let you know pricing before any work begins.',
];

$taas_faqs['contact_location'] = [
    'q' => 'Where are you located and how do I find you?',
    'a' => 'We are at <a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau, Auckland 2104</a> — near the Cavendish Drive KFC, on the main road through the Manukau industrial area. Free off-street parking is available on site.',
];

$taas_faqs['contact_loan_cars'] = [
    'q' => 'Do you offer loan cars while my vehicle is being repaired?',
    'a' => 'We do not offer loan cars — with over 12 staff and the volume of vehicles we service, it is simply not something we can manage at our scale. What we do instead is work as fast as possible to get your vehicle diagnosed, repaired, and back on the road. Getting you mobile again quickly is the priority.',
];

$taas_faqs['contact_estimate'] = [
    'q' => 'Can I get an estimate before bringing my car in?',
    'a' => 'Yes. Send us your registration number and a description of what is needed using the form above and we will give you an estimate. For diagnostic work, a brief assessment is required first — we will confirm the cost of that upfront.',
];

$taas_faqs['contact_parking'] = [
    'q' => 'Is there parking available at the workshop?',
    'a' => 'Yes. Free off-street parking is available on site at 139 Cavendish Drive, Manukau. Drive in and park near the main entrance — our team will direct you from there.',
];

$taas_faqs['contact_payment'] = [
    'q' => 'What payment and finance options do you accept?',
    'a' => 'We accept Visa, Mastercard, EFTPOS, and cash. For larger repairs, we offer ' . $_fq_finance . ' — so you can spread the cost across interest-free instalments. <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">View all finance options</a>.',
];

$taas_faqs['contact_dropoff'] = [
    'q' => 'What should I bring when dropping my car off?',
    'a' => 'Bring your vehicle key and let us know exactly what is happening — any warning lights, noises, or symptoms. If you have a service history or previous invoices from another workshop, those help too. For WOF inspections, just drive in — no paperwork needed.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   PRE-PURCHASE INSPECTION
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ppi_vs_wof'] = [
    'q' => 'What is the difference between a WOF and a pre-purchase inspection?',
    'a' => 'A WOF confirms a vehicle meets the minimum legal safety standard to be on the road today. It does not check engine condition, oil health, cambelt history, transmission behaviour under load, air conditioning, or whether there is finance registered against the vehicle. A pre-purchase inspection covers all of those plus a detailed assessment of future repair costs — giving you the full picture before you commit to buying.',
];

$taas_faqs['ppi_cost'] = [
    'q' => 'How much does a pre-purchase inspection cost in Manukau?',
    'a' => 'We offer three tiers: Basic at ' . (defined('TAAS_PPI_BASIC') ? TAAS_PPI_BASIC : '$149') . ', Standard at ' . (defined('TAAS_PPI_STANDARD') ? TAAS_PPI_STANDARD : '$229') . ', and Premium at ' . (defined('TAAS_PPI_PREMIUM') ? TAAS_PPI_PREMIUM : '$329') . '. The right tier depends on the vehicle value and complexity. For most used vehicle purchases, the Standard tier covers everything you need. Premium is recommended for European vehicles, hybrids, EVs, and higher-value purchases. Call us on ' . $_fq_phone . ' and we can recommend the best option for your situation.',
];

$taas_faqs['ppi_can_bring'] = [
    'q' => 'Can I bring a car I am thinking of buying to Tony Allen for an inspection?',
    'a' => 'Yes — that is exactly what this service is for. You or the seller brings the vehicle to our workshop at <a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>. We inspect it independently and give you an honest written report. We have no relationship with the seller — our job is to tell you what the vehicle actually needs.',
];

$taas_faqs['ppi_duration'] = [
    'q' => 'How long does a pre-purchase inspection take?',
    'a' => 'Basic inspections take 45–60 minutes, Standard takes 60–75 minutes, and Premium takes 75–90 minutes. We recommend booking ahead so we can allocate the right amount of time for your vehicle. Call ' . $_fq_phone . ' to book.',
];

$taas_faqs['ppi_what_checks'] = [
    'q' => 'What does a pre-purchase inspection check that a WOF does not?',
    'a' => 'Engine compression and condition, oil and fluid health, cambelt history and service records, transmission behaviour under load, air conditioning performance, brake disc thickness against minimum specification, suspension assessment beyond WOF requirements, power features, and — on the Premium tier — a Carjam vehicle history report and finance owing check. A WOF checks none of these.',
];

$taas_faqs['ppi_finance_check'] = [
    'q' => 'Do you check for finance owing on a vehicle?',
    'a' => 'Yes — the Premium tier includes a Carjam vehicle history report which checks the Personal Property Securities Register (PPSR) for any finance registered against the vehicle. If there is money owing, you need to know before you buy. The Basic and Standard tiers do not include this check, but you can run your own PPSR search at <a href="https://www.ppsr.govt.nz" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">ppsr.govt.nz</a>.',
];

$taas_faqs['ppi_hybrid_ev'] = [
    'q' => 'Can you inspect hybrid or electric vehicles?',
    'a' => 'Yes. Our Premium tier includes hybrid and EV battery health assessment, PHEV brake caliper seizing checks, and regenerative braking system assessment. We have technicians in EV qualification programmes and carry diagnostic equipment for Toyota, Nissan, Honda, and other hybrid systems. See our <a href="' . esc_url($_fq_site . '/electric-hybrid-vehicle-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">EV and hybrid servicing page</a> for more.',
];

$taas_faqs['ppi_found_wrong'] = [
    'q' => 'What happens if you find something wrong during the inspection?',
    'a' => 'We include repair cost estimates for everything we identify in your written report. You can use these to negotiate the purchase price down, ask the seller to fix the issues before you buy, or walk away with confidence. The report gives you the information — the decision is yours.',
];

$taas_faqs['ppi_written_report'] = [
    'q' => 'Do I get a written report?',
    'a' => 'Yes — every tier includes a written report. The Basic tier provides a checklist report with a verbal debrief. The Standard and Premium tiers include a detailed written report with condition ratings, repair cost estimates, and an overall purchase recommendation — buy, buy with conditions, or do not buy.',
];

$taas_faqs['ppi_mobile'] = [
    'q' => 'Can you inspect a car at the seller\'s address?',
    'a' => 'No — the vehicle needs to be brought to our workshop at 139 Cavendish Drive, Manukau. Our diagnostic and inspection equipment is workshop-based, and a proper inspection requires a hoist, scan tools, and road test facilities. You or the seller can bring the vehicle to us.',
];

$taas_faqs['ppi_compression'] = [
    'q' => 'What is a relative compression test?',
    'a' => 'A relative compression test measures compression across all cylinders using starter motor current draw analysis through the OBD port. It identifies whether any individual cylinder is significantly weaker than the others — an early indicator of head gasket issues, worn piston rings, or valve problems. It is faster and less invasive than a traditional mechanical compression test and is included in our Premium tier.',
];

$taas_faqs['ppi_cheap_car'] = [
    'q' => 'Should I get a pre-purchase inspection on a cheap car?',
    'a' => 'Especially on a cheap car. Budget vehicles are more likely to have deferred maintenance, hidden faults, and expensive repairs around the corner. A ' . (defined('TAAS_PPI_BASIC') ? TAAS_PPI_BASIC : '$149') . ' Basic inspection can save you thousands by identifying a vehicle that will cost more to fix than it is worth. It is the best ' . (defined('TAAS_PPI_BASIC') ? TAAS_PPI_BASIC : '$149') . ' you will spend.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   ENGINE REPAIRS HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['engine_what_repairs'] = [
    'q' => 'What engine repairs do you do at Tony Allen Auto Service?',
    'a' => 'Oil leak diagnosis and repair, engine noise investigation, misfire diagnosis and repair, oil consumption testing, head gasket replacement, timing chain and cambelt work, engine mounts, valve cover gaskets, and general mechanical repairs. All makes and models, including European vehicles through our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a>.',
];

$taas_faqs['engine_cost'] = [
    'q' => 'How much does an engine repair cost in Manukau?',
    'a' => 'It depends on the fault. A diagnostic assessment starts at ' . $_fq_scan . ' for a scan, with a full mechanical diagnosis ' . $_fq_diag . '. We give you a written estimate before starting any repair work — no surprises, no pressure. Common repairs like oil leak fixes or engine mount replacement start from a few hundred dollars. Head gaskets and timing work are larger jobs — we estimate these individually.',
];

$taas_faqs['engine_symptoms'] = [
    'q' => 'How do I know if my engine has a problem?',
    'a' => 'Warning signs include unusual noises (knocking, ticking, rattling), oil on the ground where you park, blue or white smoke from the exhaust, a rough idle or loss of power, the check engine light on your dashboard, or higher-than-normal oil consumption between services. If you notice any of these, book a diagnostic sooner rather than later — small engine faults become expensive if left.',
];

$taas_faqs['engine_diagnose_first'] = [
    'q' => 'Do you diagnose before recommending repairs?',
    'a' => 'Always. We assess the fault, confirm the cause, and give you a clear written estimate before any work begins. We keep you informed at every stage. No guesswork, no replacing parts on a hunch.',
];

$taas_faqs['engine_oil_leak'] = [
    'q' => 'Can you fix engine oil leaks?',
    'a' => 'Yes. Oil leaks are one of the most common engine repairs we carry out. Rocker cover gaskets, sump gaskets, cam seals, crank seals, and oil cooler seals are all done in-house. We identify the source of the leak first — sometimes what looks like one leak is actually two — then estimate the repair accurately.',
];

$taas_faqs['engine_misfire'] = [
    'q' => 'What causes an engine misfire?',
    'a' => 'The most common causes are worn spark plugs or ignition coils, fuel injector faults, vacuum leaks, low compression from worn valves or piston rings, and timing issues. We use scan data and live testing to identify which cylinder is misfiring and why before recommending parts. A misfire left unchecked can damage your catalytic converter.',
];

$taas_faqs['engine_check_light'] = [
    'q' => 'Is it safe to drive with the check engine light on?',
    'a' => 'A solid check engine light means a fault has been stored — not immediately dangerous, but get it scanned soon. A flashing check engine light means an active misfire or serious fault — stop driving and call us on ' . $_fq_phone . '. Continued driving with a flashing light can cause expensive catalytic converter damage.',
];

$taas_faqs['engine_european'] = [
    'q' => 'Do you work on European engines?',
    'a' => 'Yes. Our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a> handles ' . $_fq_euro . ' with factory-spec diagnostic equipment. European engines often have specific service requirements and fault patterns that generic workshops miss. We have the tools and knowledge to diagnose and repair them correctly.',
];

$taas_faqs['engine_head_gasket'] = [
    'q' => 'Can you replace a head gasket?',
    'a' => 'Yes. Head gasket replacement is a significant job but one we carry out regularly. We pressure-test the cooling system, check for combustion gases in the coolant, and confirm the head gasket is the issue before providing an estimate. We also check the cylinder head for warping and machine it if necessary. See our <a href="' . esc_url($_fq_site . '/head-gasket-repair-manukau/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">head gasket page</a>.',
];

$taas_faqs['engine_finance'] = [
    'q' => 'Do you offer finance for engine repairs?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. Engine repairs can be unexpected expenses, so spreading the cost makes sense. See our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['engine_mbi'] = [
    'q' => 'Got an MBI policy? We handle the claim.',
    'a' => 'Engine repairs are one of the most common MBI claims. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. Call your provider first, then bring your vehicle to us. We liaise with the insurer, get the work authorised, and carry out the repair. See our <a href="' . esc_url($_fq_site . '/mechanical-breakdown-insurance/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">MBI page</a>.',
];

$taas_faqs['engine_location'] = [
    'q' => 'Where is your engine repair workshop?',
    'a' => '<a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau, Auckland 2104</a>. Open Monday to Friday, 7:30am to 5:00pm. Call ' . $_fq_phone . ' to book a diagnostic. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   STEERING & SUSPENSION HUB
═══════════════════════════════════════════════════════════════════════════ */

$_fq_susp  = defined('TAAS_SUSPENSION_PRICE') ? TAAS_SUSPENSION_PRICE : 'from $300';
$_fq_align = defined('TAAS_ALIGNMENT_PRICE')  ? TAAS_ALIGNMENT_PRICE  : 'from $100 incl. GST';

$taas_faqs['ss_pulling'] = [
    'q' => 'My car is pulling to one side — is that a steering or suspension problem?',
    'a' => 'Pulling to one side is most commonly caused by incorrect wheel alignment, uneven tyre pressure, or a sticking brake caliper — not always a steering or suspension fault. However, worn tie rod ends, a damaged control arm, or a collapsed suspension bush can also cause pulling. The quickest way to find out is to bring it in — we check alignment, tyres, and steering and suspension components as part of the same inspection. Call us on <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">' . $_fq_phone . '</a> to book.',
];

$taas_faqs['ss_shocks'] = [
    'q' => 'How do I know if my shock absorbers need replacing?',
    'a' => 'The clearest signs are excessive bouncing on uneven roads, the vehicle squatting heavily under braking, a wallowing feeling through corners, or the vehicle sitting noticeably lower on one corner. Worn shocks also cause WOF failure — the inspector will test each corner for damping. If you notice any of these, book an inspection before your next WOF to avoid a failure on the day.',
];

$taas_faqs['ss_ball_joint'] = [
    'q' => 'What is a ball joint and why does it matter?',
    'a' => 'A ball joint is a pivot point connecting the suspension control arm to the wheel hub. It allows the wheel to move up and down with the suspension while also turning with the steering. A severely worn or failed ball joint can separate — which causes immediate loss of steering control. This is why ball joint condition is checked at every WOF. Symptoms of a worn ball joint include clunking over bumps, vibration through the steering wheel, and uneven tyre wear.',
];

$taas_faqs['ss_alignment_after'] = [
    'q' => 'Do you need to do a wheel alignment after replacing suspension parts?',
    'a' => 'Yes — always. Any time a steering or suspension component is replaced, the geometry changes. Fitting new control arms, tie rods, ball joints, or shock absorbers without carrying out a <a href="' . esc_url($_fq_site . '/wheel-alignment-manukau/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">wheel alignment</a> afterwards means the vehicle is likely to pull to one side and wear tyres unevenly. We carry out alignment as part of every repair where the geometry is affected.',
];

$taas_faqs['ss_shudder'] = [
    'q' => 'My steering wheel shudders at certain speeds — what causes that?',
    'a' => 'Steering wheel shudder at a specific speed — typically 80–110 km/h — is most commonly caused by wheel balance. However, shudder at all speeds, or vibration worse through corners, can indicate worn tie rod ends, wheel bearings, or bushes. A wheel balance check is the first step, but if that does not resolve it, a steering and suspension inspection is needed.',
];

$taas_faqs['ss_wof_fail'] = [
    'q' => 'My car failed its WOF for steering or suspension — what happens next?',
    'a' => 'We carry out the repair and then recheck the failed items on the same visit where possible — you do not need to rebook for the WOF check. We advise on what is required and confirm the cost before starting any repair. Call us on <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">' . $_fq_phone . '</a> to discuss your WOF failure.',
];

$taas_faqs['ss_cost'] = [
    'q' => 'How much does a steering or suspension repair cost in Manukau?',
    'a' => 'Steering and suspension repairs start ' . $_fq_susp . ' depending on the vehicle and parts required. Wheel alignment is ' . $_fq_align . ' and is included after any geometry-affecting repair. We provide an estimate before any work begins. Call us on <a href="tel:' . preg_replace('/\s+/', '', $_fq_phone) . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">' . $_fq_phone . '</a> for a specific estimate.',
];

$taas_faqs['ss_european'] = [
    'q' => 'Do you work on European vehicle steering and suspension?',
    'a' => 'Yes. Our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a> covers all European makes including ' . $_fq_euro . '. European vehicles often require specific part specifications and torque settings — we source OE-quality parts and follow manufacturer procedures.',
];

$taas_faqs['ss_drive_broken'] = [
    'q' => 'Can I drive with a broken shock absorber or worn suspension bush?',
    'a' => 'A worn shock absorber significantly increases braking distance and reduces vehicle stability — particularly in wet conditions or emergency manoeuvres. Worn bushes allow excessive wheel movement which accelerates tyre wear and affects handling. Neither is safe to ignore, and both are WOF fail items. If the vehicle is bouncing, clunking, or handling differently, get it checked promptly.',
];

$taas_faqs['ss_duration'] = [
    'q' => 'How long does a steering or suspension repair typically take?',
    'a' => 'Most steering and suspension repairs are completed within a day. Shock absorber or bush replacements typically take 2–4 hours depending on the vehicle. Steering rack replacement may take longer. We advise on timing when you book.',
];

$taas_faqs['ss_finance'] = [
    'q' => 'Do you offer finance for steering and suspension repairs?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. A steering or suspension repair is not something to delay because of cost — it is safety-critical. See our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a>.',
];

$taas_faqs['ss_location'] = [
    'q' => 'Where is your steering and suspension workshop?',
    'a' => '<a href="' . esc_url($_fq_maps) . '" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau, Auckland 2104</a>. Open Monday to Friday, 7:30am to 5:00pm. In-house WOF suspension test lane. Call ' . $_fq_phone . ' to book.',
];

unset($_fq_susp, $_fq_align);


/* ═══════════════════════════════════════════════════════════════════════════
   CAMBELT & WATER PUMP HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['cb_when_replace'] = [
    'q' => 'How do I know when my cambelt needs replacing?',
    'a' => 'Check your vehicle\'s service manual for the manufacturer\'s recommended interval — this varies from 60,000 km on some older Japanese engines up to 200,000 km on some newer models. We apply caution on any cambelt that has reached 150,000 km regardless of the stated interval, because rubber degrades with age as well as with use. If you do not know when the belt was last replaced, treat it as due. Call us on ' . $_fq_phone . ' and we can advise on your specific vehicle.',
];

$taas_faqs['cb_water_pump'] = [
    'q' => 'Do I need to replace the water pump at the same time as the cambelt?',
    'a' => 'Yes, in almost all cases. The water pump is driven by the cambelt on most vehicles, which means it is fully accessible during a cambelt replacement — the labour is already done. Fitting a new water pump at the same time adds relatively little to the cost. If the water pump fails later, you pay full labour again to access it. We include the water pump as standard in every cambelt kit replacement.',
];

$taas_faqs['cb_vs_chain'] = [
    'q' => 'What is the difference between a timing belt and a timing chain?',
    'a' => 'A timing belt (also called a cambelt) is made of reinforced rubber and has a fixed replacement interval — it must be replaced proactively before it snaps. A timing chain is made of metal and theoretically lasts the life of the engine if oil changes are kept up. In practice, chains stretch and tensioners wear, particularly on engines with poor oil change history. Timing chains are not maintenance-free — they should be inspected for stretch and noise.',
];

$taas_faqs['cb_snaps'] = [
    'q' => 'What happens if a cambelt snaps while driving?',
    'a' => 'On an interference engine — which covers the majority of modern vehicles — a snapped cambelt causes the pistons and valves to collide. This typically results in bent valves, damaged pistons, and in severe cases a destroyed cylinder head or engine block. An engine rebuild or replacement is often the result. This is why cambelt replacement is treated as urgent preventative maintenance, not optional.',
];

$taas_faqs['cb_duration'] = [
    'q' => 'How long does a cambelt replacement take?',
    'a' => 'Most cambelt replacements take between 4 and 8 hours depending on the vehicle. Some engines require more access work — particularly European models where significant dismantling is needed. We will give you a time estimate when you book and recommend planning for a full day. Booking is required for cambelt work — call us on ' . $_fq_phone . ' to arrange a time.',
];

$taas_faqs['cb_high_km'] = [
    'q' => 'My car has done 180,000 km — should I still replace the cambelt even if it looks fine?',
    'a' => 'Yes. Visual inspection of a cambelt is not reliable — rubber can appear intact but have internal degradation that is not visible until the belt fails. We apply caution on any cambelt over 150,000 km regardless of manufacturer interval. At 180,000 km the risk of a snap — and the cost of the engine damage that follows — far outweighs the cost of replacement.',
];

$taas_faqs['cb_cost'] = [
    'q' => 'How much does a cambelt replacement cost in Manukau?',
    'a' => 'Cambelt replacement cost depends on the vehicle make and model — access difficulty and the number of components in the kit vary significantly. As a guide, most cambelt replacements done on time fall in the range of $800 to $1,500, compared with $5,000 or more for the engine rebuild that follows a snapped belt. We always provide a written estimate before starting any work. Call us on ' . $_fq_phone . ' with your vehicle details for an estimate.',
];

$taas_faqs['cb_european'] = [
    'q' => 'Do you work on European vehicle cambelts?',
    'a' => 'Yes. Our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a> covers all European makes including Audi, BMW, Volkswagen, Peugeot, and Renault. European cambelt replacements are often more labour-intensive — we follow manufacturer procedures and use OE-quality parts.',
];

$taas_faqs['cb_finance'] = [
    'q' => 'Do you offer finance for cambelt replacement?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. A cambelt replacement is not something to delay because of cost — finance means you can get it done now and pay over time. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> or ask when you call.',
];

$taas_faqs['cb_warranty'] = [
    'q' => 'Will replacing the cambelt affect my vehicle warranty?',
    'a' => 'No. Under New Zealand consumer law you can have time-based maintenance like a cambelt carried out at any qualified workshop without affecting your manufacturer warranty, provided the correct parts and procedures are followed. We use OE-quality kits, follow manufacturer procedures, and record the work so your service history stays complete.',
];

$taas_faqs['cb_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We service all South Auckland suburbs.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   COOLING SYSTEM HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['cs_temp_warning'] = [
    'q' => 'My temperature warning light came on — what should I do?',
    'a' => 'Pull over immediately and turn the engine off. Do not continue driving — an overheating engine can cause head gasket failure and severe engine damage within minutes. Let the engine cool for at least 20 minutes before checking the coolant level. Do not open the radiator cap while the engine is hot. Call us on ' . $_fq_phone . ' and we can advise on next steps.',
];

$taas_faqs['cs_flush_interval'] = [
    'q' => 'How often should I flush the coolant in my car?',
    'a' => 'We recommend a coolant flush every 2 years as a minimum, regardless of mileage. Most manufacturers specify an interval between 2 and 5 years. Old coolant loses its corrosion inhibitors and becomes acidic, which accelerates damage to aluminium components — radiators, water pumps, and heater cores. Fresh coolant at the correct concentration also provides better overheating protection.',
];

$taas_faqs['cs_overheat_causes'] = [
    'q' => 'What causes a car to overheat?',
    'a' => 'The most common causes are a coolant leak (from a hose, radiator, water pump, or head gasket), a failed thermostat, a blocked radiator, a failed radiator fan, or a failed water pump. The root cause matters — adding coolant and hoping the problem goes away will only delay a more expensive failure.',
];

$taas_faqs['cs_flush_vs_radiator'] = [
    'q' => 'What is the difference between a coolant flush and a radiator flush?',
    'a' => 'They refer to the same service. The entire cooling system — radiator, engine block, heater core, hoses — is drained, flushed with clean water, and refilled with fresh coolant at the correct concentration. Some workshops only drain and refill without flushing, which leaves contaminated coolant in the system. We carry out a full flush each time.',
];

$taas_faqs['cs_head_gasket_signs'] = [
    'q' => 'How do I know if my head gasket has blown?',
    'a' => 'Common signs include white smoke from the exhaust, a sweet smell from the exhaust, milky or frothy oil on the dipstick, unexplained coolant loss without a visible external leak, and the engine overheating repeatedly. A blown head gasket is always the consequence of overheating — the root cause must be fixed at the same time.',
];

$taas_faqs['cs_radiator_repair'] = [
    'q' => 'Can you repair a radiator or does it need to be replaced?',
    'a' => 'It depends on the type and location of the damage. Small leaks from fittings or connections can often be repaired. Radiators with significant stone damage, severe corrosion, or internal blockage usually require replacement. We assess the condition before recommending repair or replacement — and give you a written estimate before proceeding.',
];

$taas_faqs['cs_cost'] = [
    'q' => 'How much does a cooling system repair cost in Manukau?',
    'a' => 'It depends on the fault. A coolant flush is a straightforward service. A thermostat replacement is relatively inexpensive. A head gasket replacement is a significant job. We always provide a written estimate before starting any work — call us on ' . $_fq_phone . ' and describe the symptoms for an initial assessment.',
];

$taas_faqs['cs_european'] = [
    'q' => 'Do you work on European vehicle cooling systems?',
    'a' => 'Yes. Our <a href="' . esc_url($_fq_site . '/european/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">TAAS European division</a> covers all European makes. European cooling systems often have specific coolant specifications and plastic components that require careful handling. We use correct-spec coolant and follow manufacturer procedures.',
];

$taas_faqs['cs_finance'] = [
    'q' => 'Do you offer finance for cooling system repairs?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. A cooling system repair is not something to delay — overheating causes exponentially more expensive damage the longer it is left. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> or ask when you call.',
];

$taas_faqs['cs_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We service Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   TRANSMISSION HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['trans_signs'] = [
    'q' => 'How do I know if my transmission needs servicing?',
    'a' => 'The most common signs are slipping gears (engine revs rise but the car does not accelerate), harsh or delayed shifting, shuddering under acceleration, a burning smell, or a transmission warning light. Any of these should be investigated promptly — transmission problems get more expensive the longer they are left. Call us on ' . $_fq_phone . ' and describe what you are experiencing.',
];

$taas_faqs['trans_cost'] = [
    'q' => 'How much does transmission repair cost in Manukau?',
    'a' => 'It depends entirely on the type of transmission and the nature of the fault. A fluid service is the least expensive. Solenoid and sensor replacements are moderate. A full rebuild is significant — typically $2,500 to $5,000 or more depending on the transmission. We always diagnose first (mechanical diagnosis ' . $_fq_diag . ') and provide a clear estimate before starting any work. Call ' . $_fq_phone . ' with your vehicle details.',
];

$taas_faqs['trans_flush_damage'] = [
    'q' => 'Can a transmission flush damage an older automatic?',
    'a' => 'A machine flush on a high-mileage automatic that has never been serviced can dislodge debris and cause problems. We assess the fluid condition first — if the fluid is severely degraded or burnt, we may recommend a drain-and-fill instead of a machine exchange, or advise that a fluid service is unlikely to resolve the existing damage. We do not perform a machine flush on a transmission that we believe will not benefit from one.',
];

$taas_faqs['trans_rebuild'] = [
    'q' => 'Do you carry out full transmission rebuilds?',
    'a' => 'Full rebuilds are carried out by a trusted transmission specialist. We diagnose the fault, remove the transmission, and manage the rebuild process on your behalf. The specialist carries out the internal rebuild, we refit and road test. This is the honest approach — a rebuild requires specialist tooling and knowledge that a general workshop should not pretend to have.',
];

$taas_faqs['trans_interval'] = [
    'q' => 'How often should I service my transmission?',
    'a' => 'Conventional automatics: every 40,000 to 60,000 km. CVT transmissions: every 40,000 km — non-negotiable. DSG and dual-clutch: per manufacturer intervals, typically every 40,000 to 60,000 km. Manual gearboxes: gearbox oil every 60,000 to 80,000 km. If you tow, carry heavy loads, or drive in frequent stop-start traffic, service more often.',
];

$taas_faqs['trans_types'] = [
    'q' => 'What is the difference between automatic, CVT, and DSG transmissions?',
    'a' => 'A conventional automatic uses a torque converter and fixed gear sets. A CVT (continuously variable transmission) uses a belt or chain on variable pulleys — no fixed gears. A DSG (direct-shift gearbox) uses two clutch packs controlled by a computer, giving automatic convenience with manual-like efficiency. Each type requires different fluid, different service intervals, and different diagnostic approaches.',
];

$taas_faqs['trans_slipping'] = [
    'q' => 'My transmission is slipping — is it safe to drive?',
    'a' => 'No. A slipping transmission is actively destroying itself from the inside. The clutch packs overheat, the fluid breaks down, and debris circulates through the valve body and solenoids. What might be a solenoid or fluid issue today becomes a full rebuild next week. Stop driving and call us on ' . $_fq_phone . '.',
];

$taas_faqs['trans_european'] = [
    'q' => 'Do you work on European vehicle transmissions?',
    'a' => 'Yes. Our TAAS European division covers ' . $_fq_euro . '. European transmissions — particularly ZF automatics, Aisin units, and VW/Audi DSG gearboxes — have specific fluid requirements and service procedures that we follow to manufacturer specification.',
];

$taas_faqs['trans_cvt'] = [
    'q' => 'What does a CVT transmission service involve?',
    'a' => 'A CVT service involves draining the old CVT fluid and replacing it with the correct CVT-specific fluid for your vehicle. CVT fluid is not the same as conventional automatic transmission fluid — using the wrong type causes immediate damage. We also check the belt/chain condition and inspect for leaks. CVT fluid degrades faster than conventional auto fluid, which is why the 40,000 km interval is critical.',
];

$taas_faqs['trans_finance'] = [
    'q' => 'Do you offer finance for transmission repairs?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. Transmission repairs can be significant, and delaying them always makes the final bill larger. Finance lets you get the repair done now. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['trans_mbi'] = [
    'q' => 'Is transmission failure covered by mechanical breakdown insurance?',
    'a' => 'In most cases, yes. Transmission component failure is commonly covered under MBI policies. Tony Allen Auto Service is an approved repairer for Autosure, Assurant, Provident, Janssen, and Autolife. We handle MBI claims directly — call your provider first, then bring your vehicle to us. See our <a href="' . esc_url($_fq_site . '/mechanical-breakdown-insurance/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">MBI page</a> for more.',
];

$taas_faqs['trans_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book a diagnostic appointment. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   EV & HYBRID HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ev_dealer'] = [
    'q' => 'Do I have to service my EV or hybrid at the dealer?',
    'a' => 'No. Once the factory warranty has expired, there is no obligation to use the dealer. For vehicles still under warranty, check your terms — most manufacturers allow servicing at any qualified workshop provided the correct schedule, parts, and fluids are used. We carry the diagnostic tools to read EV and hybrid fault codes, HV battery cell data, and all system data. Our technicians are completing EV-specific qualification training. Call ' . $_fq_phone . ' to discuss your vehicle.',
];

$taas_faqs['ev_hv_battery'] = [
    'q' => 'Can you work on the high-voltage battery system?',
    'a' => 'Yes. Two of our technicians are trained in high-voltage systems and are completing formal EV qualification programmes. We carry out HV battery health assessments, read individual cell data, diagnose HV system faults, and carry out in-car repairs on HV components. Where a full HV battery pack requires replacement, we advise on the options and manage the process.',
];

$taas_faqs['ev_brake_fluid'] = [
    'q' => 'Why does my hybrid or EV still need brake fluid changes?',
    'a' => 'Brake fluid absorbs moisture from the air regardless of how often the brakes are physically used. On vehicles with regenerative braking, the physical brakes are used less — but the moisture absorption still happens. Degraded brake fluid has a lower boiling point, causing brake fade under heavy braking. We change brake fluid to the manufacturer interval on all hybrid and EV models, using the correct procedure for regenerative brake systems.',
];

$taas_faqs['ev_battery_health'] = [
    'q' => 'How do you check hybrid battery health?',
    'a' => 'We connect our diagnostic equipment and read the HV battery management system data — individual cell voltages, state of charge balance, temperature management, and total capacity versus original specification. We then advise what the data means for your vehicle — whether the battery is performing normally for its age and mileage, or whether degradation warrants attention.',
];

$taas_faqs['ev_models'] = [
    'q' => 'What EV and hybrid models do you service?',
    'a' => 'All makes and models — Japanese, Korean, European, and Chinese. Toyota hybrid range, Nissan Leaf and Ariya, Honda e:HEV range, Mitsubishi Outlander PHEV, Hyundai Ioniq range, Kia EV range, BYD, MG, GWM/Haval, Volvo, Volkswagen ID range, and more. The NZ EV market is changing fast — new makes arrive regularly. Call ' . $_fq_phone . ' with your make, model, and year.',
];

$taas_faqs['ev_warning_light'] = [
    'q' => 'My hybrid warning light is on — what does it mean?',
    'a' => 'A hybrid system warning indicates the vehicle has detected a fault in the hybrid drive system — the HV battery, inverter, electric motor, or associated sensors. The vehicle often reduces power or disables electric drive as a precaution. We carry out a full diagnostic scan to identify the specific fault codes and advise on what is required.',
];

$taas_faqs['ev_less_servicing'] = [
    'q' => 'Do EVs need less servicing than petrol cars?',
    'a' => 'EVs have fewer moving parts and no engine oil to change, but they still need regular servicing. Brake fluid, coolant (EVs have their own cooling circuit for the battery and motor), cabin filters, tyres, suspension, steering, and 12V battery all require maintenance. The service intervals may be different, but skipping them causes the same problems as on any vehicle.',
];

$taas_faqs['ev_tyres'] = [
    'q' => 'Can you source EV tyres?',
    'a' => 'Yes. EV and hybrid vehicles are heavier than their petrol equivalents and produce instant torque — both factors that affect tyre wear. We source low rolling resistance tyres designed for EV weight and torque characteristics. Call ' . $_fq_phone . ' with your tyre size and we will confirm availability.',
];

$taas_faqs['ev_chinese'] = [
    'q' => 'What about Chinese EV brands — BYD, MG, GWM?',
    'a' => 'We service all Chinese EV and hybrid brands sold in New Zealand — BYD, MG, GWM/Haval, LDV, and new arrivals as they enter the market. These vehicles use the same fundamental EV and hybrid technology as Japanese and Korean brands. Our diagnostic equipment covers them and our technicians are trained on their systems.',
];

$taas_faqs['ev_cost_compare'] = [
    'q' => 'Is EV servicing more expensive than petrol car servicing?',
    'a' => 'Not necessarily. A standard EV service (brake fluid, coolant check, cabin filter, tyre rotation, diagnostic check) is comparable to a basic petrol service. There is no oil or oil filter to change on a BEV. Some components like HV battery cooling systems are unique to EVs, but routine servicing costs are similar. Call ' . $_fq_phone . ' for an estimate on your specific vehicle.',
];

$taas_faqs['ev_finance'] = [
    'q' => 'Do you offer finance for EV and hybrid repairs?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. EV-specific repairs — particularly HV battery work — can be significant. Finance options help you get the work done without delay. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['ev_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MANUKAU BRAKE & CLUTCH (MBC HUB)
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mbc_brake_cost'] = [
    'q' => 'How much do brake repairs cost in Manukau?',
    'a' => 'Brake pad and rotor replacement starts ' . $_fq_brake . '. This includes new pads and rotor machining or replacement — we never fit pads only. Final price depends on your vehicle make and model. Call ' . $_fq_phone . ' for an estimate.',
];

$taas_faqs['mbc_clutch_cost'] = [
    'q' => 'How much does clutch replacement cost?',
    'a' => 'Clutch replacement starts ' . $_fq_clutch . '. This includes the clutch disc, pressure plate, and release bearing as a kit. Flywheel replacement is additional if required — we inspect the flywheel and advise before proceeding. Call ' . $_fq_phone . ' with your vehicle details.',
];

$taas_faqs['mbc_pads_only'] = [
    'q' => 'Why don\'t you just replace brake pads on their own?',
    'a' => 'New pads on a worn or grooved rotor will not bed in correctly. They wear unevenly, they squeal, and the grooves from the old pads transfer into the new ones. We always replace pads with rotor machining or replacement — it costs a little more upfront but lasts significantly longer and performs correctly from day one.',
];

$taas_faqs['mbc_disc_skimming'] = [
    'q' => 'What is disc skimming?',
    'a' => 'Disc skimming (also called disc machining) resurfaces the brake rotor to a flat, smooth finish. It removes grooves, light scoring, and minor warping caused by heat and wear. Skimmed rotors paired with new pads bed in correctly and provide consistent braking. We skim on-site at our Manukau workshop.',
];

$taas_faqs['mbc_wof_brakes'] = [
    'q' => 'Can you fix WOF brake failures?',
    'a' => 'Yes. Brakes are one of the most common WOF failure items. We repair the fault and re-inspect on-site — you do not need to go elsewhere for re-inspection. NZTA Authorised. Same-day where possible, subject to parts availability.',
];

$taas_faqs['mbc_brake_signs'] = [
    'q' => 'How do I know if my brakes need replacing?',
    'a' => 'Common signs: squealing or grinding noise when braking, vibration through the brake pedal, the vehicle pulling to one side under braking, a longer stopping distance, or a brake warning light on the dashboard. If you notice any of these, get them checked promptly. Call ' . $_fq_phone . '.',
];

$taas_faqs['mbc_clutch_signs'] = [
    'q' => 'How do I know if my clutch needs replacing?',
    'a' => 'The most common sign is slipping — engine revs rise but the vehicle does not accelerate. Other signs: difficulty selecting gears, a high or changing bite point, juddering on take-off, or a burning smell from the clutch. A slipping clutch gets worse rapidly and damages the flywheel the longer you drive on it.',
];

$taas_faqs['mbc_european'] = [
    'q' => 'Do you work on European vehicle brakes and clutch?',
    'a' => 'Yes. Our TAAS European division covers all European makes. European brake and clutch systems often have specific requirements — electronic handbrakes, brake pad wear sensors, dual-mass flywheels — that we follow to manufacturer specification.',
];

$taas_faqs['mbc_finance'] = [
    'q' => 'Do you offer finance for brake and clutch repairs?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. Brake and clutch repairs are safety-critical — they should not be delayed because of cost. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['mbc_mbi'] = [
    'q' => 'Is brake or clutch failure covered by MBI?',
    'a' => 'Brake components that fail mechanically (callipers, master cylinder, ABS module) are often covered. Clutch failure is commonly covered. Wear items (pads, rotors, clutch disc) are typically excluded from MBI as they are considered consumables. We handle MBI claims directly — approved repairer for ' . $_fq_mbi . '. See our <a href="' . esc_url($_fq_site . '/mechanical-breakdown-insurance/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">MBI page</a> for more.',
];

$taas_faqs['mbc_duration'] = [
    'q' => 'How long do brake repairs take?',
    'a' => 'A pad and rotor replacement is typically completed same-day. Calliper rebuilds and more complex work may take longer. We advise on expected timeframe when you book. Booking is recommended for brake work. Call ' . $_fq_phone . '.',
];

$taas_faqs['mbc_location'] = [
    'q' => 'Where is Manukau Brake & Clutch?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104 — part of Tony Allen Auto Service. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   BRAKE HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['brake_cost'] = [
    'q' => 'How much do brake repairs cost in Manukau?',
    'a' => 'Brake pad and rotor replacement starts ' . $_fq_brake . '. This includes new pads and rotor machining or replacement — we never fit pads only. Final price depends on your vehicle. Call ' . $_fq_phone . ' for an estimate.',
];

$taas_faqs['brake_pads_only'] = [
    'q' => 'Why don\'t you just replace brake pads?',
    'a' => 'New pads on a worn or grooved rotor will not bed in correctly. The grooves from the old pads transfer into the new ones, they wear unevenly, and they squeal. Every brake job we do includes rotor machining or replacement alongside new pads — because that is the only way to guarantee the repair lasts and performs correctly.',
];

$taas_faqs['brake_signs'] = [
    'q' => 'How do I know if my brakes need replacing?',
    'a' => 'The most common signs are a squealing or grinding noise when braking, vibration or pulsing through the brake pedal, the vehicle pulling to one side under braking, a longer stopping distance than normal, or a brake warning light on the dashboard. Any of these warrants immediate inspection. Call ' . $_fq_phone . '.',
];

$taas_faqs['brake_wof_fail'] = [
    'q' => 'Can you fix WOF brake failures?',
    'a' => 'Yes. Brakes are one of the most common WOF failure items. We repair the fault and re-inspect on-site — you do not need to go elsewhere for re-inspection. NZTA Authorised. Same-day where possible, subject to parts availability.',
];

$taas_faqs['brake_disc_skimming'] = [
    'q' => 'What is disc skimming and when is it needed?',
    'a' => 'Disc skimming resurfaces the brake rotor to a flat, smooth finish. It removes grooves, scoring, and minor warping from heat and wear. A skimmed rotor paired with new pads beds in correctly and provides even, consistent braking. We skim on-site. If the rotor is below minimum thickness or badly damaged, we replace it instead.',
];

$taas_faqs['brake_fluid'] = [
    'q' => 'How often should brake fluid be changed?',
    'a' => 'We recommend every 2 years as a minimum. Brake fluid absorbs moisture from the air — even in a sealed system. Moisture lowers the boiling point, which causes brake fade under heavy or sustained braking. Degraded fluid also corrodes internal brake components over time.',
];

$taas_faqs['brake_grinding'] = [
    'q' => 'My brakes are making a grinding noise — is it safe to drive?',
    'a' => 'No. A grinding noise means metal-on-metal contact — the pad friction material is completely worn through and the steel backing plate is grinding into the rotor. This damages the rotor surface rapidly and increases stopping distance. Pull over and call ' . $_fq_phone . '. Continuing to drive on grinding brakes causes significantly more expensive damage.',
];

$taas_faqs['brake_european'] = [
    'q' => 'Do you work on European vehicle brakes?',
    'a' => 'Yes. Our TAAS European division covers all European makes. European brake systems often have specific requirements — electronic handbrakes, pad wear sensors, ceramic compounds, and specific rotor specifications. We follow manufacturer data for every vehicle.',
];

$taas_faqs['brake_finance'] = [
    'q' => 'Do you offer finance for brake repairs?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. Brake repairs are safety-critical — they should never be delayed because of cost. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['brake_duration'] = [
    'q' => 'How long do brake repairs take?',
    'a' => 'A pad and rotor replacement is typically completed same-day. More complex work — calliper rebuilds, drum brake overhauls — may take longer. We advise on expected timeframe when you book. Booking is recommended for brake work.',
];

$taas_faqs['brake_disc_vs_drum'] = [
    'q' => 'What is the difference between disc brakes and drum brakes?',
    'a' => 'Disc brakes use a rotor (disc) with callipers that squeeze pads against the rotor surface. Drum brakes use a drum with internal shoes that push outward against the drum surface. Most modern vehicles have discs on the front and either discs or drums on the rear. We service both types.',
];

$taas_faqs['brake_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   CLUTCH HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['clutch_cost'] = [
    'q' => 'How much does clutch replacement cost in Manukau?',
    'a' => 'Clutch replacement starts ' . $_fq_clutch . '. This includes the clutch disc, pressure plate, and release bearing as a complete kit. Flywheel replacement is additional if required — we inspect the flywheel and advise before proceeding. Price varies by vehicle. Call ' . $_fq_phone . ' for an estimate.',
];

$taas_faqs['clutch_signs'] = [
    'q' => 'How do I know if my clutch needs replacing?',
    'a' => 'The most common sign is slipping — engine revs rise but the vehicle does not accelerate, especially under load or in higher gears. Other signs: difficulty selecting gears, a high or changing bite point, juddering on take-off, or a burning smell. A slipping clutch gets worse rapidly. Call ' . $_fq_phone . '.',
];

$taas_faqs['clutch_disc_only'] = [
    'q' => 'Can I just replace the clutch disc?',
    'a' => 'We always replace the clutch as a complete kit — disc, pressure plate, and release bearing together. The gearbox has to come out to access the clutch, and the labour is the same regardless of which components you replace. Fitting a new disc against a worn pressure plate means the new disc wears faster and you pay the same labour cost again sooner.',
];

$taas_faqs['clutch_dmf'] = [
    'q' => 'What is a dual-mass flywheel?',
    'a' => 'A dual-mass flywheel (DMF) uses two plates connected by springs to absorb drivetrain vibration. They are common on European vehicles and modern Japanese and Korean models. DMFs cannot be repaired — when they fail (rattling noise, judder, difficulty engaging gears), they must be replaced. This adds to the cost of a clutch job, but fitting a new clutch to a worn DMF will cause the clutch to fail prematurely.',
];

$taas_faqs['clutch_duration'] = [
    'q' => 'How long does clutch replacement take?',
    'a' => 'Typically 4–8 hours depending on the vehicle. Some models require additional components to be removed for access. We advise on expected timeframe when you book. Booking is required for clutch work.',
];

$taas_faqs['clutch_mbi'] = [
    'q' => 'Is clutch failure covered by MBI?',
    'a' => 'Clutch failure is commonly covered under MBI policies. Wear items (the clutch disc itself) may be excluded as a consumable, but catastrophic failure — pressure plate, release bearing, or hydraulic components — is typically covered. Tony Allen Auto Service is an approved repairer for ' . $_fq_mbi . '. We handle claims directly. See our <a href="' . esc_url($_fq_site . '/mechanical-breakdown-insurance/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">MBI page</a> for more.',
];

$taas_faqs['clutch_wear'] = [
    'q' => 'What causes a clutch to wear out?',
    'a' => 'Normal wear from use — the clutch disc friction material wears down over tens of thousands of kilometres. Aggressive driving, riding the clutch in traffic, and towing accelerate wear. Oil contamination from a leaking rear main seal also destroys clutch material rapidly. Some vehicles are simply harder on clutches than others due to engine torque and driving conditions.',
];

$taas_faqs['clutch_spongy'] = [
    'q' => 'My clutch pedal feels spongy — what is wrong?',
    'a' => 'A spongy or soft clutch pedal usually indicates a hydraulic fault — air in the system, a leaking master cylinder, or a failing slave cylinder. The hydraulic system uses brake fluid to transmit pedal pressure to the clutch fork. Leaks or air ingress reduce the pressure and make the pedal feel soft. This is a separate repair from the clutch itself.',
];

$taas_faqs['clutch_european'] = [
    'q' => 'Do you work on European vehicle clutches?',
    'a' => 'Yes. Our TAAS European division covers all European makes. European clutch systems frequently use dual-mass flywheels, concentric slave cylinders (built into the bell housing), and specific torque procedures. We follow manufacturer data for every vehicle.',
];

$taas_faqs['clutch_finance'] = [
    'q' => 'Do you offer finance for clutch replacement?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted. Interest-free options available on most. A clutch replacement is a significant job — finance options help you get it done without delay. Visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['clutch_vs_gearbox'] = [
    'q' => 'What is the connection between clutch and gearbox?',
    'a' => 'The clutch connects the engine to the gearbox. When you press the clutch pedal, the clutch disc separates from the flywheel, disconnecting engine power from the gearbox so you can change gears. A worn clutch affects gear selection; a worn gearbox affects how gears engage. We diagnose which component is at fault before recommending any work. For gearbox-specific faults, see our <a href="' . esc_url($_fq_site . '/manual-gearbox-repair-manukau/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">manual gearbox repair</a> page.',
];

$taas_faqs['clutch_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book. We serve Papatoetoe, Māngere, Ōtāhuhu, Wiri, Ōtara, Flat Bush, Manurewa, Takanini, Papakura, Botany and all of South Auckland.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   DISC SKIMMING HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ds_what_is'] = [
    'q' => 'What is disc skimming?',
    'a' => 'Disc skimming (also called disc machining or rotor resurfacing) removes a thin layer from the brake rotor surface to restore it to a flat, smooth finish. It removes grooves, light scoring, and minor warping caused by heat and wear. The result is a fresh surface that allows new brake pads to bed in correctly.',
];

$taas_faqs['ds_skim_vs_replace'] = [
    'q' => 'When should rotors be skimmed vs replaced?',
    'a' => 'Rotors can be skimmed if they are above minimum thickness after machining and have no cracks. If a rotor is already at or below minimum thickness, badly cracked, or severely warped, it must be replaced. We measure every rotor before and after skimming to confirm it meets specification.',
];

$taas_faqs['ds_cost'] = [
    'q' => 'How much does disc skimming cost?',
    'a' => 'Contact us for pricing — cost depends on the rotor type and condition. Call ' . $_fq_phone . ' with your vehicle details.',
];

$taas_faqs['ds_onsite'] = [
    'q' => 'Do you skim rotors on-site?',
    'a' => 'Yes. We machine brake rotors on-site at our Manukau workshop. No need to send rotors away — we do it here.',
];

$taas_faqs['ds_new_pads'] = [
    'q' => 'Why pair disc skimming with new pads?',
    'a' => 'New pads on a grooved rotor will not make full contact with the surface. They ride on the high spots, wear unevenly, and the old groove pattern transfers into the new pads. Skimming removes the old pattern and gives the new pads a flat surface to bed into — resulting in even wear, no squeal, and consistent braking.',
];

$taas_faqs['ds_rotor_types'] = [
    'q' => 'Can you skim all types of rotors?',
    'a' => 'We skim standard cast iron rotors. Composite rotors, drilled rotors, and some slotted rotors may not be suitable for skimming depending on their design. We assess the rotor and advise before proceeding.',
];

$taas_faqs['ds_duration'] = [
    'q' => 'How long does disc skimming take?',
    'a' => 'Typically completed same-day as part of a brake pad and rotor service. Skimming itself takes minutes per rotor — the majority of time is removing and refitting the wheels and callipers.',
];

$taas_faqs['ds_finance'] = [
    'q' => 'Do you offer finance?',
    'a' => 'Yes — ' . $_fq_finance . ' accepted.',
];

$taas_faqs['ds_location'] = [
    'q' => 'Where is your workshop?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. Call ' . $_fq_phone . '.',
];

$taas_faqs['ds_better_than_new'] = [
    'q' => 'Is disc skimming better than rotor replacement?',
    'a' => 'If the rotor has enough material remaining and is in good condition, skimming is more cost-effective than replacement and gives an equally good result. If the rotor is too thin, cracked, or severely damaged, replacement is the only option. We measure and advise honestly.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   AUTO ELECTRICAL HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ae_services'] = [
    'q' => 'What auto electrical services do you offer in Manukau?',
    'a' => 'Tony Allen Auto Service provides full auto electrical diagnosis and repair from our workshop at 139 Cavendish Drive, Manukau. Services include ECU diagnostics, dashboard warning light diagnosis, battery supply and fit, alternator and starter motor repair, ABS and SRS fault diagnosis, central locking, electric window repair, immobiliser and key programming, wiring fault tracing, EGR and emission faults, TPMS reset, and lighting. All work is led by Raj, our Lead Diagnostics & Auto Electrical Technician, who verifies the fault before recommending any parts.',
];

$taas_faqs['ae_diagnostic_cost'] = [
    'q' => 'How much does an auto electrical diagnostic cost at Tony Allen Auto Service?',
    'a' => 'A diagnostic scan starts ' . $_fq_scan . ' — this reads all fault codes across every module in the vehicle, not just the engine. A full diagnostic starts ' . $_fq_ae_diag . ' and includes live data analysis, component-level testing, and wiring checks where required. All fees are explained upfront before any work begins. If you proceed with the repair, the diagnostic fee is applied to the final invoice. Call ' . $_fq_phone . ' to book.',
];

$taas_faqs['ae_diagnose_first'] = [
    'q' => 'Do you diagnose before replacing parts?',
    'a' => 'Yes — always. This is a core principle at Tony Allen Auto Service. A scan tool code tells you where to look, not what to replace. Raj verifies the fault through live data, component testing, and wiring checks before recommending any parts. This approach avoids unnecessary replacements and gets the car fixed properly on the first visit.',
];

$taas_faqs['ae_european'] = [
    'q' => 'Can you work on European vehicle electrical systems?',
    'a' => 'Yes. We carry factory-specification diagnostic equipment for European vehicles including ' . $_fq_euro . ' through our TAAS European division. European ECUs require brand-specific scan tools — generic OBD readers miss a significant portion of fault data on these vehicles. Our equipment reads all manufacturer-specific modules.',
];

$taas_faqs['ae_check_engine'] = [
    'q' => 'My check engine light is on — is it safe to drive?',
    'a' => 'A solid check engine light usually means a stored fault code that is not immediately critical — but get it scanned promptly to prevent further damage. A flashing check engine light means a serious active fault such as an engine misfire — stop driving and call us on ' . $_fq_phone . '. Do not ignore a flashing light as continued driving can cause catalytic converter damage.',
];

$taas_faqs['ae_scan_vs_diag'] = [
    'q' => 'Why is a diagnostic scan not the same as a full diagnosis?',
    'a' => 'A scan reads the fault codes stored in the vehicle\'s control units — it tells you what the car is reporting. A diagnosis is the investigation that follows: testing the actual components, reading live sensor data, checking wiring, measuring voltage drops, and confirming which part has actually failed. The scan gives us the starting point. The diagnosis gives us the answer. That distinction is why we price them separately and why we get cars fixed first time.',
];

$taas_faqs['ae_scan_duration'] = [
    'q' => 'How long does a diagnostic scan take?',
    'a' => 'A standard scan takes 30 to 60 minutes depending on the vehicle and the number of modules. Full diagnostics involving intermittent faults, wiring tracing, or multiple interconnected systems may require 2 to 4 hours. We give you a timeframe and cost estimate before proceeding with any extended testing.',
];

$taas_faqs['ae_airbag'] = [
    'q' => 'Can you reset my airbag light?',
    'a' => 'We diagnose and repair the cause of an SRS warning light — clock spring faults, seat belt pretensioners, crash sensor issues, and occupant detection problems. We do not simply clear the code. The SRS light is on because a component in your airbag system has failed, and clearing it without fixing the fault means your airbags may not deploy in a crash. Call ' . $_fq_phone . ' to book a diagnosis.',
];

$taas_faqs['ae_aftermarket'] = [
    'q' => 'Do you handle aftermarket wiring issues?',
    'a' => 'Yes. Poorly installed aftermarket accessories — towbars, stereos, dashcams, spotlights, and auxiliary lighting — are one of the most common causes of electrical faults we see. We trace the wiring, repair the damage, and install a proper circuit with correct fusing and earthing. If a previous installer has cut into the factory loom, we repair that too.',
];

$taas_faqs['ae_fleet'] = [
    'q' => 'Do you do fleet auto electrical work?',
    'a' => 'Yes. Fleet electrical work is a core part of what we do at Tony Allen Auto Service. We carry out auto electrical repairs for fleet operators, lease companies, and light commercial operators across South Auckland. Direct invoicing to fleet management companies is available. See our <a href="' . esc_url($_fq_site . '/fleet-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">fleet servicing page</a> or call ' . $_fq_phone . ' to discuss your fleet requirements.',
];

$taas_faqs['ae_location'] = [
    'q' => 'Where is your auto electrical workshop?',
    'a' => 'Tony Allen Auto Service is at 139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. We serve all of South Auckland including Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany, Howick, and surrounding suburbs. Call ' . $_fq_phone . ' to book a diagnostic.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   AIR CONDITIONING HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ac_regas_cost'] = [
    'q' => 'How much does a car air conditioning regas cost in Manukau?',
    'a' => 'A standard regas and dye test starts ' . $_fq_aircon . ' at Tony Allen Auto Service. We test the system first and always tell you what we find before starting any work. If additional repairs are needed, we provide an estimate before proceeding. Call ' . $_fq_phone . ' for a current estimate on your specific vehicle.',
];

$taas_faqs['ac_signs'] = [
    'q' => 'How do I know if my car\'s air conditioning needs regassing or repairing?',
    'a' => 'The most obvious sign is warm or less-cold air from the vents — but not all AC problems are simply low refrigerant. If the air smells musty, the system cools then warms intermittently, you hear a noise when the compressor kicks in, or the system does not work at all, there is likely a fault beyond a regas. We carry out a system diagnosis first so we fix the actual problem.',
];

$taas_faqs['ac_common_faults'] = [
    'q' => 'What are the most common car air conditioning problems?',
    'a' => 'The most common issues we see at our Manukau workshop are refrigerant leaks (systems gradually lose gas over time through micro-leaks in hoses and O-rings), compressor faults (usually a loud noise when AC is on — the most expensive component), blocked or dirty cabin filters (reduces airflow and causes musty smells), and faulty blend doors or actuators (cause heating and cooling to work incorrectly). Most are diagnosable and repairable in a single visit.',
];

$taas_faqs['ac_duration'] = [
    'q' => 'How long does a car air conditioning service take?',
    'a' => 'A standard regas takes around 45 to 60 minutes. If we need to carry out a full diagnosis first, allow 1 to 1.5 hours. Repairs involving the compressor, condenser, or evaporator take longer — we advise you of the timeframe when we provide your estimate. Open ' . $_fq_hours . ' at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['ac_all_makes'] = [
    'q' => 'Can you work on all makes and models?',
    'a' => 'Yes — we service air conditioning on all makes including Japanese, Korean, European, and American vehicles. This includes complex dual-zone and automatic climate control systems. For European vehicles including ' . $_fq_euro . ' we have the correct refrigerant specifications and system knowledge these vehicles require.',
];

$taas_faqs['ac_safe_to_drive'] = [
    'q' => 'Is it safe to drive with a broken air conditioner?',
    'a' => 'In most cases yes — a faulty AC is not usually a safety risk. However, a refrigerant leak left long-term can allow moisture into the system, causing compressor damage and turning a simple regas into a much more expensive repair. In summer, particularly with children or pets in the vehicle, a non-functioning AC is a real practical problem. In winter, a faulty AC affects windscreen demisting — that is a safety issue.',
];

$taas_faqs['ac_refrigerant'] = [
    'q' => 'What refrigerant does my car use?',
    'a' => 'Most vehicles manufactured before approximately 2017 use R134a refrigerant. Many newer models use R1234yf, which is more environmentally friendly but more expensive. We carry both and our equipment handles both types. We check which refrigerant your vehicle requires before starting any work.',
];

$taas_faqs['ac_musty_smell'] = [
    'q' => 'Why does my car AC smell musty?',
    'a' => 'A musty or mouldy smell usually comes from bacterial or fungal growth on the evaporator, which sits inside the dashboard in a dark, damp environment. We carry out an antibacterial treatment to eliminate the smell, and a cabin filter replacement at the same time if it is due. This is a common issue, especially after winter when the AC has not been used for several months.',
];

$taas_faqs['ac_custom_hoses'] = [
    'q' => 'Can you manufacture custom AC hoses and pipes?',
    'a' => 'Yes — we manufacture replacement AC hoses and pipes on-site for vehicles where standard parts are unavailable or discontinued. This is particularly useful for older vehicles, imports, and European models where OEM parts have long lead times or are no longer manufactured.',
];

$taas_faqs['ac_finance'] = [
    'q' => 'Do you offer finance for air conditioning repairs?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. You can spread the cost of your AC repair over time. Ask when you book or visit our <a href="' . esc_url($_fq_site . '/finance-options/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['ac_location'] = [
    'q' => 'Where is your air conditioning workshop?',
    'a' => 'Tony Allen Auto Service is at 139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. We serve all of South Auckland including Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany, Howick, and surrounding suburbs. Call ' . $_fq_phone . ' to book.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   EUROPEAN HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['euro_makes'] = [
    'q' => 'What European makes do you service?',
    'a' => 'TAAS European services Audi, Volkswagen, BMW, Mercedes-Benz, Land Rover, Porsche, MINI, Škoda, Volvo, Peugeot, and Renault. We carry factory-specification diagnostic equipment for these makes and have been servicing European vehicles since ' . $_fq_est . '.',
];

$taas_faqs['euro_warranty'] = [
    'q' => 'Will servicing at TAAS void my European car\'s warranty?',
    'a' => 'No. Under the Consumer Guarantees Act, you are entitled to have your vehicle serviced at any qualified workshop without voiding your manufacturer warranty — provided the service is carried out to manufacturer specification. We use the correct grade oils and OEM-equivalent parts and document everything.',
];

$taas_faqs['euro_diagnostics'] = [
    'q' => 'Do you have the right diagnostic equipment for European vehicles?',
    'a' => 'Yes. European vehicles — particularly VAG group (Volkswagen, Audi, Škoda) and BMW — require brand-specific diagnostic tools to access the full range of ECU data. Generic OBD readers miss a significant portion of fault information on these vehicles. We use factory-specification equipment to diagnose European systems accurately.',
];

$taas_faqs['euro_pricing'] = [
    'q' => 'How does TAAS pricing compare to a European dealer?',
    'a' => 'Independent workshop rates are typically 30 to 50 percent lower than franchise dealer labour rates. We do not have showroom overheads, service department revenue targets, or depreciation-funded facilities to recover through your invoice. You pay for the work, not the showroom.',
];

$taas_faqs['euro_cambelt'] = [
    'q' => 'Do you do cambelt replacements on European cars?',
    'a' => 'Yes. Cambelt replacement is critical on most European engines — many are interference engines where belt failure causes immediate internal engine damage. Intervals vary by make and model. We replace the full kit: belt, tensioner, idlers and water pump. Cambelt replacement starts ' . $_fq_cambelt . '.',
];

$taas_faqs['euro_vag'] = [
    'q' => 'Can you service Audi and Volkswagen with VAG-specific tools?',
    'a' => 'Yes. VAG group vehicles (Volkswagen, Audi, Škoda, SEAT) share platforms and require VAG-specific diagnostic tools to access the full range of fault codes, live data, and adaptation channels. Generic tools miss the majority of this data. We have full VAG diagnostic capability.',
];

$taas_faqs['euro_porsche_mini'] = [
    'q' => 'Do you work on Porsche and MINI?',
    'a' => 'Yes. Porsche Cayenne, Macan, Boxster, and Cayman models are serviced here. MINI is built on a BMW platform and shares diagnostic requirements — we service Cooper, Countryman, and Clubman models. Both makes benefit from our independent pricing versus main dealer rates.',
];

$taas_faqs['euro_service_cost'] = [
    'q' => 'What does a European car service cost at TAAS?',
    'a' => 'A standard logbook service starts ' . $_fq_service . '. European vehicles may require specific oil grades (such as VW 504/507 or BMW LL-04) which can affect the price. We advise the cost for your specific vehicle before booking. WOF is a fixed ' . $_fq_wof . '. Diagnostic scan starts ' . $_fq_scan . '.',
];

$taas_faqs['euro_finance'] = [
    'q' => 'Do you offer finance for European car repairs?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. European car repairs can involve higher parts costs — spreading the payment makes it manageable.',
];

$taas_faqs['euro_location'] = [
    'q' => 'Where is your European specialist workshop?',
    'a' => 'Tony Allen Auto Service is at 139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. We serve all of South Auckland including Papatoetoe, Māngere, Ōtāhuhu, Wiri, Manurewa, Flat Bush, Takanini, Papakura, Ōtara, Botany, Howick, and surrounding suburbs. Call ' . $_fq_phone . ' to book.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   MANUKAU BATTERIES HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['mb_location'] = [
    'q' => 'Where is Manukau Batteries located?',
    'a' => 'Manukau Batteries is at 139 Cavendish Drive, Manukau, Auckland 2104 — part of Tony Allen Auto Service. Open ' . $_fq_hours . '. Walk-ins welcome mornings.',
];

$taas_faqs['mb_cost'] = [
    'q' => 'How much does a car battery cost fitted?',
    'a' => 'Car batteries start ' . $_fq_battery . ' — includes supply, fitting, and old battery disposal. The exact price depends on your vehicle specification. Call ' . $_fq_phone . ' with your registration number and we will confirm before you come in.',
];

$taas_faqs['mb_types'] = [
    'q' => 'What types of batteries do you stock?',
    'a' => 'We stock car, 4WD, AGM, stop-start, marine, deep cycle, and motorcycle batteries. Authorised Neuton Power and Bosch dealer through YHI Automotive NZ.',
];

$taas_faqs['mb_free_test'] = [
    'q' => 'Do you offer free battery testing?',
    'a' => 'Yes — free load test, voltage check, and cranking amp assessment on any vehicle. No appointment needed. We also test your alternator and starter motor at no charge.',
];

$taas_faqs['mb_same_day'] = [
    'q' => 'Can you fit a battery on the same day?',
    'a' => 'In most cases yes. We carry a full range at 139 Cavendish Drive. Call ahead on ' . $_fq_local . ' to confirm stock for your specific vehicle.',
];

$taas_faqs['mb_european_bms'] = [
    'q' => 'Do European cars need battery registration?',
    'a' => 'Yes. BMW, Mercedes-Benz, Audi, Volkswagen, Volvo, and most European vehicles have a battery management system (BMS) that must be updated when a new battery is fitted. Without registration, the charging system can shorten the new battery\'s life significantly. BMS registration is included at Manukau Batteries.',
];

$taas_faqs['mb_keeps_going_flat'] = [
    'q' => 'What if my battery keeps going flat?',
    'a' => 'A battery that keeps going flat is often a symptom of an alternator fault, not a battery problem. We test both before recommending any replacement. Fitting a new battery will not fix the problem if the alternator is not charging correctly.',
];

$taas_faqs['mb_brands'] = [
    'q' => 'What battery brands do you carry?',
    'a' => 'Neuton Power is our preferred brand — full range stocked. We are also an authorised Bosch dealer through YHI Automotive NZ. We choose Neuton Power because in ' . $_fq_years . ' years of fitting batteries at this workshop, it has consistently proven reliable.',
];

$taas_faqs['mb_recycle'] = [
    'q' => 'Do you recycle old batteries?',
    'a' => 'Yes — old batteries collected and recycled responsibly at no charge with every supply and fit job.',
];

$taas_faqs['mb_marine'] = [
    'q' => 'Do you supply batteries for boats and jet skis?',
    'a' => 'Yes. We stock starting, deep cycle, and dual-purpose marine batteries. Built for on-water vibration and high electrical demand. Call ' . $_fq_phone . ' with your application details.',
];

$taas_faqs['mb_finance'] = [
    'q' => 'Can I pay for a battery with Afterpay?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. Spread the cost over time.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   FLEET HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['fleet_setup'] = [
    'q' => 'How do we set up a fleet account with Tony Allen Auto Service?',
    'a' => 'Call ' . $_fq_phone . ' and ask for Dean. He handles all fleet accounts personally — fleet size, vehicle types, billing arrangements. We invoice companies direct or through your fleet management company. Most accounts are set up in a single conversation.',
];

$taas_faqs['fleet_billing'] = [
    'q' => 'Can you handle direct billing to our fleet management company?',
    'a' => 'Yes. We invoice directly to companies — no upfront driver payment required. We also invoice through SG Fleet NZ, ORIX NZ, Custom Fleet, and Fleet Partners. Invoices reference your job number or purchase order. Call Dean to set up the arrangement that works for your business.',
];

$taas_faqs['fleet_vehicle_types'] = [
    'q' => 'What vehicle types and sizes do you service?',
    'a' => 'Passenger cars, SUVs, 4WDs, vans, utes, and light trucks up to approximately 6.5 tonne. All makes and models including Japanese, Korean, and European fleet vehicles. If you are unsure whether we can handle your vehicle type, call Dean on ' . $_fq_phone . ' for a straight answer.',
];

$taas_faqs['fleet_turnaround'] = [
    'q' => 'How quickly can fleet vehicles be turned around?',
    'a' => 'Scheduled servicing and general repairs are completed same day in most cases. Complex repairs depend on the fault and parts availability — we advise on timeframes before work begins and call you if anything changes. WOF inspections are completed promptly and we recheck failure items on the same visit where possible.',
];

$taas_faqs['fleet_afterhours'] = [
    'q' => 'Is after-hours vehicle drop-off available?',
    'a' => 'Yes. Key drop box available for after-hours drop-off at 139 Cavendish Drive, Manukau. Drivers can drop the vehicle before or after business hours. Leave the key with a note of the registration, company name, and work required. We contact you the following business morning.',
];

$taas_faqs['fleet_wof'] = [
    'q' => 'Do you carry out WOF inspections for fleet vehicles?',
    'a' => 'Yes — NZTA Authorised with an on-site WOF test lane. We carry out WOF inspections for fleet vehicles and can complete any required repair and recheck on the same visit in most cases, minimising vehicle downtime.',
];

$taas_faqs['fleet_european'] = [
    'q' => 'Can you service European fleet vehicles?',
    'a' => 'Yes. We carry factory-specification diagnostic equipment for European makes including Audi, Volkswagen, BMW, Mercedes-Benz, Land Rover, and more. European fleet vehicles are serviced through our TAAS European division at the same address.',
];

$taas_faqs['fleet_ev'] = [
    'q' => 'Do you handle hybrid and EV fleet vehicles?',
    'a' => 'Yes. We have high-voltage qualified technicians and service hybrid and EV fleet vehicles including Toyota, Nissan, BMW, and Volvo PHEV. Regenerative brake service, battery health checks, and standard servicing all available.',
];

$taas_faqs['fleet_location'] = [
    'q' => 'Where is your fleet workshop?',
    'a' => 'Tony Allen Auto Service, 139 Cavendish Drive, Manukau, Auckland 2104. Central South Auckland — minutes from Wiri, Māngere, Ōtāhuhu, and the wider Manukau industrial area. Open ' . $_fq_hours . '. Key drop box for after-hours.',
];

$taas_faqs['fleet_contact'] = [
    'q' => 'Who do we contact for fleet enquiries?',
    'a' => 'Dean Allen — Owner / General Manager. Call ' . $_fq_phone . ' and ask for Dean, or email dean@taas.co.nz. Dean handles all fleet accounts personally — no account managers, no layers.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   COMMERCIAL VEHICLES HUB
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['comm_vehicle_types'] = [
    'q' => 'What commercial vehicles do you service?',
    'a' => 'We service utes, vans, SUVs, and light trucks up to approximately 6.5 tonne. All makes including Ford Ranger, Toyota Hilux, Nissan Navara, Mitsubishi Triton, Isuzu D-MAX, Toyota HiAce, Ford Transit, Mercedes Sprinter, VW Transporter, Hyundai iLoad, and more. Japanese, Korean, and European.',
];

$taas_faqs['comm_service_cost'] = [
    'q' => 'How much does a commercial vehicle service cost?',
    'a' => 'A standard logbook service starts ' . $_fq_service . '. Commercial vehicles with diesel engines, larger oil capacities, or specific manufacturer requirements may cost more. We confirm the price for your specific vehicle before booking. WOF is a fixed ' . $_fq_wof . '.',
];

$taas_faqs['comm_diesel'] = [
    'q' => 'Can you service diesel utes and vans?',
    'a' => 'Yes — diesel servicing is a core part of what we do. DPF diagnostics and regeneration, EGR cleaning, turbo checks, injector testing, fuel system diagnosis. Modern diesel vehicles have complex emission systems that need specialist knowledge. We have the diagnostic equipment for all makes.',
];

$taas_faqs['comm_wof'] = [
    'q' => 'Do you do WOF inspections for commercial vehicles?',
    'a' => 'Yes — NZTA Authorised with an on-site WOF test lane. We carry out WOF inspections and can complete any required repair and recheck on the same visit in most cases. WOF is ' . $_fq_wof . ' for vehicles up to 3.5 tonne.',
];

$taas_faqs['comm_wait'] = [
    'q' => 'Can I wait while my vehicle is serviced?',
    'a' => 'Walk-ins are welcome mornings for smaller jobs. For a full service or repair, we recommend booking so we can allocate the right time slot. We understand your vehicle is your income — we aim to get you back on the road same day for routine servicing.',
];

$taas_faqs['comm_same_day'] = [
    'q' => 'I need my work vehicle back the same day — can you do that?',
    'a' => 'Scheduled servicing and general repairs are completed same day in most cases. We understand downtime costs you money — that is why we aim for same-day turnaround on routine work. Complex repairs depend on parts availability — we advise on timeframes before starting.',
];

$taas_faqs['comm_cambelt'] = [
    'q' => 'Do you handle cambelt replacement on commercial vehicles?',
    'a' => 'Yes. Many commercial diesel engines are interference engines where belt failure causes catastrophic damage. We replace the full kit — belt, tensioner, idlers, and water pump. Cambelt replacement starts ' . $_fq_cambelt . '. If you do not know when yours was last done, treat it as due.',
];

$taas_faqs['comm_finance'] = [
    'q' => 'Do you offer finance for commercial vehicle repairs?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. An unexpected repair on your work vehicle should not stop your business. Spread the cost over time.',
];

$taas_faqs['comm_fleet_accounts'] = [
    'q' => 'Do you also offer fleet accounts?',
    'a' => 'Yes. If you have three or more vehicles, a fleet account with direct invoicing may suit you better. Dean handles all fleet accounts personally — call ' . $_fq_phone . ' and ask for Dean, or visit our <a href="' . esc_url($_fq_site . '/fleet-servicing/') . '" style="color:var(--taas-yellow,#FFC800);font-weight:600;">fleet servicing page</a>.',
];

$taas_faqs['comm_location'] = [
    'q' => 'Where is your workshop?',
    'a' => 'Tony Allen Auto Service, 139 Cavendish Drive, Manukau, Auckland 2104. Central South Auckland — minutes from Wiri, Māngere, Ōtāhuhu, and the wider Manukau industrial area. Open ' . $_fq_hours . '. Call ' . $_fq_phone . ' to book.',
];




/* ═══════════════════════════════════════════════════════════════════════════
   TOWING
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['tow_own_truck'] = [
    'q' => 'Do you have your own tow truck?',
    'a' => 'No — towing is arranged through a trusted tow operator we work with regularly. We organise everything for you. You deal with us, not a random tow company. The vehicle is towed directly to our workshop at 139 Cavendish Drive, Manukau.',
];

$taas_faqs['tow_cost'] = [
    'q' => 'How much does it cost to tow my car to your workshop?',
    'a' => 'Towing cost depends on the distance and the vehicle type. We will confirm the cost before the tow is dispatched so there are no surprises. The towing fee is separate from the repair — we provide an estimate for the repair once the vehicle is at our workshop and we have diagnosed the fault.',
];

$taas_faqs['tow_where'] = [
    'q' => 'Can you tow my car anywhere?',
    'a' => 'We arrange towing to our workshop at 139 Cavendish Drive, Manukau. This is not a general towing service — it is specifically for vehicles that need to come to us for diagnosis and repair.',
];

$taas_faqs['tow_breakdown'] = [
    'q' => 'What should I do if my car breaks down?',
    'a' => 'Pull over safely and turn on your hazard lights. If you are on a motorway, stay in the vehicle with your seatbelt on. Call us on ' . $_fq_phone . ' — we will arrange a tow to our workshop and start the process of getting your car diagnosed and repaired.',
];

$taas_faqs['tow_arrival'] = [
    'q' => 'What happens when my car arrives at the workshop?',
    'a' => 'We diagnose the fault, contact you with what we find, and provide an estimate before starting any repair work. No work is carried out without your approval. If parts are needed, we advise on timeframes.',
];

$taas_faqs['tow_afterhours'] = [
    'q' => 'Is towing available after hours?',
    'a' => 'Our workshop is open ' . $_fq_hours . '. If your vehicle breaks down after hours, call ' . $_fq_phone . ' and leave a message with your details. We will arrange the tow and contact you the next business morning. You can also use our key drop box at 139 Cavendish Drive if the vehicle arrives outside business hours.',
];

$taas_faqs['tow_4wd'] = [
    'q' => 'Can you tow a 4WD or van?',
    'a' => 'Yes — the tow operators we work with can handle cars, utes, SUVs, vans, and light trucks. Let us know the vehicle type when you call so we can send the right truck.',
];

$taas_faqs['tow_unattended'] = [
    'q' => 'Do I need to be with the vehicle for the tow?',
    'a' => 'Not necessarily. If you cannot be with the vehicle, let us know the location, registration number, and where the key is. We will coordinate with the tow operator. The vehicle will be towed to our workshop and secured until we can assess it.',
];

$taas_faqs['tow_finance'] = [
    'q' => 'Can I pay for towing and repairs with Afterpay?',
    'a' => 'Repair costs can be spread across ' . $_fq_finance . '. The towing fee is paid separately to the tow operator. Call us to discuss your options.',
];

$taas_faqs['tow_location'] = [
    'q' => 'Where is your workshop?',
    'a' => 'Tony Allen Auto Service, 139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. We serve all of South Auckland. Call ' . $_fq_phone . '.',
];
/* ═══════════════════════════════════════════════════════════════════════════
   PRE-PURCHASE INSPECTION
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['ppi_duration'] = [
    'q' => 'How long does a pre-purchase inspection take?',
    'a' => 'It depends on the level you choose, but most inspections are completed within a few hours of drop-off. We\'ll give you a specific timeframe when you book.',
];

$taas_faqs['ppi_mobile'] = [
    'q' => 'Can I bring the car to you, or do you do mobile inspections?',
    'a' => 'Bring the vehicle to our workshop at <a href="https://www.google.com/maps/search/?api=1&query=Tony+Allen+Auto+Service+139+Cavendish+Drive+Manukau" target="_blank" rel="noopener" style="color:var(--taas-yellow,#FFC800);font-weight:600;">139 Cavendish Drive, Manukau</a>. All our diagnostic equipment, hoists, and brake rollers are here — a workshop inspection is far more thorough than anything we could do on site.',
];

$taas_faqs['ppi_seller_refuses'] = [
    'q' => 'What if the seller won\'t let me get an inspection?',
    'a' => 'That\'s a red flag. Any honest seller should be happy for an independent inspection. If they refuse, seriously consider walking away.',
];

$taas_faqs['ppi_present'] = [
    'q' => 'Do I need to be present during the inspection?',
    'a' => 'No. Drop the vehicle off and we\'ll call you when it\'s done. We walk you through the report and findings in person or by phone.',
];

$taas_faqs['ppi_any_make'] = [
    'q' => 'Can you inspect any make and model?',
    'a' => 'Yes. We inspect all Japanese, Korean, European, and Australian vehicles. Our European specialist division covers ' . $_fq_euro . '.',
];

$taas_faqs['ppi_problems'] = [
    'q' => 'What happens if the inspection finds problems?',
    'a' => 'You\'ll know about them before you buy. Our Standard and Premium reports include estimated repair costs so you can factor them into your purchase decision or negotiation. If you go ahead with the purchase, we can carry out any repairs.',
];

$taas_faqs['ppi_report'] = [
    'q' => 'Is the inspection report just for me?',
    'a' => 'Yes. The report is prepared for the named customer only and cannot be relied upon by third parties. This is standard practice for independent inspections.',
];

$taas_faqs['ppi_carjam'] = [
    'q' => 'What does the Carjam add-on include?',
    'a' => 'A full vehicle history report covering ownership count, odometer reading history, finance and security interests, stolen vehicle check, accident and write-off flags, and import details. Available with any inspection level for $25.',
];

$taas_faqs['ppi_body_paint'] = [
    'q' => 'Do you check the body and paint?',
    'a' => 'We note the visual condition of body panels and paint as a general observation. However, panel and paint assessment is outside our field of expertise — if cosmetic condition is important to your purchase decision, we recommend getting a specialist panel and paint report.',
];

$taas_faqs['ppi_vs_aa'] = [
    'q' => 'What\'s the difference between your inspection and an AA inspection?',
    'a' => 'We\'re a full-service workshop with specialist diagnostic equipment, brake rollers, hoists, and ' . $_fq_years . ' years of mechanical expertise. Our inspection is done by the same technicians who repair these vehicles every day — they know exactly what to look for. We also offer three inspection levels so you can match the depth to the vehicle and your budget.',
];


/* ═══════════════════════════════════════════════════════════════════════════
   ABOUT US
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['about_ownership'] = [
    'q' => 'Who owns Tony Allen Auto Service?',
    'a' => 'Tony Allen Auto Service is owned by Mike Allen and Dean Allen. Mike co-founded the business with his father Tony in October 1985. Dean joined as an apprentice in 2004 and now runs day-to-day operations as General Manager.',
];

$taas_faqs['about_how_long'] = [
    'q' => 'How long has TAAS been operating?',
    'a' => 'Tony Allen Auto Service has been operating since October 1985 — over ' . $_fq_years . ' years — trading from the same address at 139 Cavendish Drive, Manukau throughout.',
];

$taas_faqs['about_franchise'] = [
    'q' => 'Is TAAS a franchise?',
    'a' => 'No. Tony Allen Auto Service is a 100% independent, family-owned workshop. Not part of any franchise or chain. All decisions are made locally by the Allen family.',
];

$taas_faqs['about_accreditations'] = [
    'q' => 'What accreditations does TAAS hold?',
    'a' => 'TAAS is MTA Assured through the Motor Trade Association quality assurance programme, and NZTA Authorised for Warrant of Fitness inspections — station number ' . $_fq_ms . '. We are also an approved repairer for five MBI providers: ' . $_fq_mbi . '.',
];

$taas_faqs['about_divisions'] = [
    'q' => 'What divisions does TAAS have?',
    'a' => 'Tony Allen Auto Service, Manukau Brake & Clutch, TAAS Tyre & WOF Centre, TAAS Auto Electrical & Air Conditioning, TAAS European, TAAS Fleet, Manukau Batteries — ' . $_fq_division . ' specialist divisions under one roof at 139 Cavendish Drive, Manukau. Approximately 12 staff.',
];

$taas_faqs['about_european'] = [
    'q' => 'Do you service European vehicles?',
    'a' => 'Yes. TAAS European is our specialist European vehicle division. We service ' . $_fq_euro . ' with factory-spec diagnostic equipment at independent pricing.',
];

$taas_faqs['about_location'] = [
    'q' => 'Where is Tony Allen Auto Service?',
    'a' => '139 Cavendish Drive, Manukau, Auckland 2104. Open ' . $_fq_hours . '. We have been at the same address since ' . $_fq_est . '. Call ' . $_fq_phone . ' to book.',
];

$taas_faqs['about_finance'] = [
    'q' => 'Do you offer finance options for car repairs?',
    'a' => 'Yes. We accept ' . $_fq_finance . ' — so you can spread the cost of larger repairs. We also accept Visa, Mastercard, EFTPOS, and cash.',
];


// ── Clean up internal vars ──────────────────────────────────────────────────
/* ═══════════════════════════════════════════════════════════════════════════
   VEHICLE SERVICING — hub page FAQs
═══════════════════════════════════════════════════════════════════════════ */

$taas_faqs['svc_which_tier'] = [
    'q' => 'Which service level do I need?',
    'a' => 'Most of our customers choose the Premium service because it covers everything your vehicle needs for the next 12 months of safe motoring — full diagnostic scan, wheels-off brake inspection, all filters checked, and a thorough road test. Essential is an oil and filter change with basic safety checks. Standard adds a full brake assessment, suspension checks, and battery test. If you are not sure, call us and we will check your service history and recommend what is actually due.',
];

$taas_faqs['svc_dealer'] = [
    'q' => 'Do I need to go back to the dealer for servicing?',
    'a' => 'No. Under New Zealand consumer law, you can have your vehicle serviced at any qualified workshop without affecting your manufacturer warranty — provided the correct parts, fluids and service intervals are followed. Tony Allen Auto Service is MTA Assured and services all vehicles to manufacturer specification. Many of our customers switched from dealer servicing and saved hundreds of dollars annually with no impact on their warranty.',
];

$taas_faqs['svc_hybrid'] = [
    'q' => 'Can you service hybrid and electric vehicles?',
    'a' => 'Yes. We service Toyota, Nissan, Honda and other hybrid systems as well as BEV, PHEV and MHEV vehicles. Hybrid servicing follows the standard petrol schedule with additional HV battery health, cooling system and regenerative braking checks. EV servicing covers the 12V battery, HV coolant, brake fluid, cabin filters, HV system scan, and a full visual inspection of all HV cables. See our <a href="' . $_fq_site . '/electric-hybrid-vehicle-servicing/" style="color:var(--taas-yellow,#FFC800);font-weight:600;">EV &amp; hybrid page</a> for more.',
];

$taas_faqs['svc_european'] = [
    'q' => 'Can you service European vehicles?',
    'a' => 'Yes — our TAAS European division services ' . $_fq_euro . ' with the correct oil grades, filters, reset procedures and brand-specific diagnostic tools. European vehicles are priced separately to account for specification oil and additional time. See our <a href="' . $_fq_site . '/european/" style="color:var(--taas-yellow,#FFC800);font-weight:600;">European vehicles page</a>.',
];

$taas_faqs['svc_price_vary'] = [
    'q' => 'Why does the price vary by vehicle type?',
    'a' => 'The main variables are engine oil specification and capacity. A Toyota Corolla takes around 4 litres of standard synthetic oil. A Hilux diesel takes 7–8 litres. A BMW or Mercedes requires manufacturer-specification oil that costs significantly more per litre. Larger vehicles also take more time. We have five vehicle categories — Car, SUV/V6, Ute/V8, European Standard, and European Performance — so you can see the exact price for your vehicle before you book.',
];

$taas_faqs['svc_additional_work'] = [
    'q' => 'What happens if you find something wrong during my service?',
    'a' => 'We provide a written estimate for any additional work and wait for your approval before proceeding. Nothing happens without your say-so. If the issue is safety-critical, we will explain why and recommend addressing it — but the decision is always yours.',
];

$taas_faqs['svc_booking'] = [
    'q' => 'Do I need to book or can I just drive in?',
    'a' => 'Booking is recommended so we can allocate the right amount of time for your vehicle and service level. Walk-ins are welcome mornings only, subject to availability. Call ' . $_fq_phone . ' to book — we can usually fit you in within a day or two.',
];

$taas_faqs['svc_finance'] = [
    'q' => 'Do you offer finance for car servicing?',
    'a' => 'Yes — we accept ' . $_fq_finance . '. Spread the cost of your service with no interest on most options. See our <a href="' . $_fq_site . '/finance-options/" style="color:var(--taas-yellow,#FFC800);font-weight:600;">finance options page</a> for details.',
];

$taas_faqs['svc_diesel'] = [
    'q' => 'Do you service diesel vehicles?',
    'a' => 'Yes. Diesel services follow the same three-tier structure with additional diesel-specific checks including fuel filter inspection, DPF status via diagnostic scan (soot load and regeneration cycle data), turbocharger inspection, and AdBlue levels where applicable. If your DPF requires a forced regeneration, we will advise and quote before proceeding.',
];


unset($_fq_phone, $_fq_local, $_fq_wof, $_fq_est, $_fq_years, $_fq_rating,
      $_fq_reviews, $_fq_euro, $_fq_hours, $_fq_email, $_fq_cust, $_fq_finance,
      $_fq_mbi, $_fq_site, $_fq_maps, $_fq_scan, $_fq_diag, $_fq_division, $_fq_ms,
      $_fq_brake, $_fq_clutch, $_fq_aircon, $_fq_service, $_fq_cambelt, $_fq_battery,
      $_fq_ae_diag, $_fq_svc_ess, $_fq_svc_std, $_fq_svc_prem);
