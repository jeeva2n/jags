<?php
require_once __DIR__ . '/../includes/config.php';

$pageTitle = 'Company Profile';
$metaDesc  = 'JAGS Technologies provides advanced NDT inspection, industrial inspection and asset integrity solutions for oil & gas, power, manufacturing, marine, infrastructure and engineering industries across India.';
$ogImage   = BASE_URL . '/assets/images/hero/hero-weld-inspection.webp';

$faqs = [
    ['What is NDT inspection?', 'Non-Destructive Testing (NDT) is a range of inspection techniques used to evaluate the condition, integrity and quality of materials, components and structures without causing damage to the asset being examined.'],
    ['Which NDT method is suitable for weld inspection?', 'The most suitable method depends on material, thickness, geometry and the type of discontinuity expected. Weld inspection commonly uses Ultrasonic Testing (UT), Phased Array Ultrasonic Testing (PAUT), TOFD, Radiographic Testing (RT), Magnetic Particle Testing (MT) and Liquid Penetrant Testing (PT), often in combination.'],
    ['What is the difference between conventional and advanced NDT?', 'Conventional NDT covers established methods such as UT, RT, MT, PT and VT. Advanced NDT includes techniques such as PAUT, TOFD, AUT, LRUT, ECT, RFECT, IRIS, MFL, RVI, infrared thermography and ACFM, offering higher coverage, faster scanning or access to difficult geometries.'],
    ['Can NDT be performed during plant operation?', 'Many inspection activities can be planned around operating conditions, including on-stream inspection. Feasibility depends on access, temperature, insulation, safety requirements and the inspection objective. Our team reviews each application to advise on the appropriate approach.'],
    ['How do I select the right NDT method?', 'Method selection considers material, geometry, thickness, accessibility, operating conditions, expected defect mechanism, inspection objective and applicable standards. JAGS Technologies supports clients through this decision with an application-focused review.'],
    ['Does JAGS Technologies provide NDT services across India?', 'Yes. JAGS Technologies supports industrial clients across India, including oil & gas, petrochemical, power, manufacturing, marine, infrastructure and heavy engineering sectors, with both conventional and advanced NDT capabilities.'],
];

$jsonLd = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Company Profile', 'item' => BASE_URL . '/pages/company-profile.php'],
        ],
    ],
    [
        '@context' => 'https://schema.org',
        '@type'    => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question',
            'name'  => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
        ], $faqs),
    ],
];

include __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero-media">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Non-destructive testing and weld inspection" fetchpriority="high" decoding="async">
    </div>
    <div class="container">
        <span class="page-header-label">Company Profile</span>
        <h1 class="page-header-title">ENGINEERING CONFIDENCE<br>THROUGH PRECISION INSPECTION</h1>
        <p class="page-header-desc">An NDT-focused technology and inspection solutions company helping industries maintain the safety, reliability, integrity and performance of critical assets.</p>
        <div class="page-hero-actions">
            <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn" data-cursor="OPEN">REQUEST AN INSPECTION <span class="btn-arrow">&rarr;</span></a>
            <a href="#capabilities" class="btn btn-outline-white magnetic-btn">OUR CAPABILITIES</a>
        </div>
        <nav class="page-hero-crumbs" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/">Home</a><span>/</span><span>Company Profile</span>
        </nav>
    </div>
</section>

<div class="trust-strip">
    <span class="trust-item">NDT Expertise</span>
    <span class="trust-item">Advanced Inspection</span>
    <span class="trust-item">Qualified Professionals</span>
    <span class="trust-item">Safety Focus</span>
    <span class="trust-item">Technical Support</span>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Phased array ultrasonic testing of an aerospace component" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
            <div>
                <span class="section-label">Who We Are</span>
                <h2 class="section-title">RELIABLE INSPECTION FOR<br>CRITICAL ASSETS</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    <strong>JAGS Technologies</strong> is an NDT-focused technology and inspection
                    solutions company dedicated to helping industries maintain the safety,
                    reliability, integrity and performance of critical assets.
                </p>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    In industries where a small defect can lead to significant operational,
                    financial or safety consequences, reliable inspection is not simply a
                    compliance requirement &mdash; it is an essential part of responsible engineering.
                </p>
                <p class="section-desc" style="max-width:none;">
                    From welds and pipelines to pressure equipment, storage tanks, structures,
                    machinery and critical components, our inspection services identify
                    discontinuities and potential defects without compromising the usability of the asset.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt" id="philosophy">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Our Inspection Philosophy</span>
            <h2 class="section-title">BEYOND DETECTING DEFECTS</h2>
            <p class="section-desc" style="margin:0 auto;">Effective NDT provides clear technical information that supports better engineering decisions. Our philosophy is built around seven principles.</p>
        </div>
        <div class="feature-grid">
            <?php
            $principles = [
                ['Accuracy', 'Reliable inspection results and controlled examination procedures.', 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm0 15a5 5 0 1 1 5-5 5 5 0 0 1-5 5Z'],
                ['Integrity', 'Transparent reporting and professional technical practices.', 'M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5Z'],
                ['Safety', 'Inspection methodologies designed around personnel and asset safety.', 'M12 3 2 20h20Zm0 6v5m0 3h.01'],
                ['Reliability', 'Consistent service delivery and dependable inspection data.', 'm9 12 2 2 4-4m-3-8 7 3v6c0 5-3.4 9.4-8 11-4.6-1.6-8-6-8-11V5Z'],
                ['Technology', 'Appropriate use of conventional and advanced NDT technologies.', 'M12 2v4m0 12v4M2 12h4m12 0h4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8M19.1 4.9l-2.8 2.8M7.7 16.3l-2.8 2.8'],
                ['Traceability', 'Structured documentation and inspection records.', 'M4 4h16v16H4Zm4 4h8M8 12h8M8 16h5'],
                ['Customer Focus', 'Solutions aligned with project requirements and operating conditions.', 'M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 10v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8'],
            ];
            foreach ($principles as $i => $p):
            ?>
            <div class="feature-card reveal" data-cursor="EXPLORE">
                <div class="feature-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $p[2] ?>"/></svg>
                </div>
                <h3 class="feature-title"><?= e($p[0]) ?></h3>
                <p class="feature-desc"><?= e($p[1]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section" id="capabilities">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Comprehensive Capabilities</span>
            <h2 class="section-title">CONVENTIONAL &amp; ADVANCED NDT</h2>
        </div>
        <div class="capability-grid">
            <div class="capability-panel reveal-left">
                <span class="capability-tag">Conventional NDT</span>
                <h3 class="capability-title">Established Inspection Methods</h3>
                <ul class="check-list single">
                    <li>Ultrasonic Testing (UT)</li>
                    <li>Radiographic Testing (RT)</li>
                    <li>Magnetic Particle Testing (MT)</li>
                    <li>Liquid Penetrant Testing (PT)</li>
                    <li>Visual Testing (VT)</li>
                </ul>
            </div>
            <div class="capability-panel is-dark reveal-right has-scan">
                <div class="scan-line"></div>
                <span class="capability-tag">Advanced NDT</span>
                <h3 class="capability-title">Higher Coverage &amp; Access</h3>
                <ul class="check-list single">
                    <li>Phased Array Ultrasonic Testing (PAUT)</li>
                    <li>Time of Flight Diffraction (TOFD)</li>
                    <li>Automated Ultrasonic Testing (AUT)</li>
                    <li>Long Range Ultrasonic Testing (LRUT)</li>
                    <li>Eddy Current Testing (ECT) &amp; RFECT</li>
                    <li>Internal Rotary Inspection System (IRIS)</li>
                    <li>Magnetic Flux Leakage (MFL) &amp; ACFM</li>
                    <li>Remote Visual Inspection (RVI) &amp; Thermography</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="image-band">
    <div class="image-band-media parallax-img" data-speed="0.15">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Industrial NDT inspection in a heavy engineering environment" loading="lazy" decoding="async">
    </div>
    <div class="image-band-overlay"></div>
    <div class="container">
        <div class="image-band-inner">
            <span class="section-label" style="color:var(--color-accent);">More Than Inspection</span>
            <h2 class="image-band-title">A TECHNICAL PARTNER THROUGH THE ASSET LIFECYCLE</h2>
            <p class="image-band-desc">From fabrication and construction to commissioning, operation, maintenance and integrity assessment &mdash; whether you need a single inspection assignment, shutdown support or an ongoing inspection program.</p>
            <div class="image-band-stat">
                <div>
                    <div class="stat-number" data-count="14">0</div>
                    <div class="stat-label" style="color:rgba(255,255,255,0.55);">Inspection Methods</div>
                </div>
                <div>
                    <div class="stat-number" data-count="100">0</div>
                    <div class="stat-label" style="color:rgba(255,255,255,0.55);">Traceable Reporting</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Industries We Support</span>
            <h2 class="section-title">SECTORS WE SERVE</h2>
        </div>
        <div class="chip-grid stagger-children">
            <?php
            $industries = [
                ['O&G', 'Oil &amp; Gas'], ['PETRO', 'Petrochemical'], ['REF', 'Refineries'],
                ['PWR', 'Power Generation'], ['MFG', 'Manufacturing'], ['HVY', 'Heavy Engineering'],
                ['MAR', 'Marine &amp; Shipbuilding'], ['INFRA', 'Infrastructure'], ['CONS', 'Construction'],
                ['PROC', 'Process Industries'], ['PIPE', 'Pipelines'], ['PV', 'Pressure Vessels'],
                ['TANK', 'Storage Tanks'], ['BOIL', 'Boilers &amp; Heat Exchangers'],
            ];
            foreach ($industries as $ind):
            ?>
            <div class="chip">
                <span class="chip-code"><?= $ind[0] ?></span>
                <span class="chip-name"><?= $ind[1] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="quote-block reveal-scale">
            <div class="quote-mark">&ldquo;</div>
            <p class="quote-text">Inspection intelligence for <strong>safer, more reliable assets</strong> &mdash; combining technology, expertise and accountability across every stage of the asset lifecycle.</p>
        </div>
    </div>
</section>

<section class="section" id="faq">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Frequently Asked Questions</span>
            <h2 class="section-title">NDT QUESTIONS,<br>ANSWERED</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($faqs as $i => $f): ?>
            <div class="faq-item">
                <button class="faq-question" type="button" aria-expanded="false" aria-controls="faq-a-<?= $i + 1 ?>">
                    <span><?= e($f[0]) ?></span>
                    <span class="faq-icon" aria-hidden="true"></span>
                </button>
                <div class="faq-answer" id="faq-a-<?= $i + 1 ?>">
                    <div class="faq-answer-inner"><?= e($f[1]) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">NEED RELIABLE NDT<br>&amp; INSPECTION SUPPORT?</h2>
            <p class="cta-desc">Talk to our technical team about your inspection requirements.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">REQUEST AN INSPECTION <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
