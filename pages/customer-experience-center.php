<?php
require_once __DIR__ . '/../includes/config.php';

$pageTitle = 'Customer Experience Center';
$metaDesc  = 'Explore NDT technologies, discuss inspection requirements and discover practical inspection solutions at the JAGS Technologies Customer Experience Center.';
$ogImage   = BASE_URL . '/assets/images/hero/hero-paut-aerospace.webp';

$faqs = [
    ['What is the JAGS Technologies Customer Experience Center?', 'It is a technical engagement space where customers can discuss inspection challenges, understand NDT technologies and explore practical inspection solutions with our engineering team, including demonstrations where applicable.'],
    ['Can I see NDT equipment demonstrated before deciding?', 'Yes. Depending on the technologies available at the center, demonstrations can help clarify the capabilities and limitations of a method before it is applied to your assets.'],
    ['Which inspection methods can be discussed at the center?', 'Conventional and advanced methods including UT, PAUT, TOFD, eddy current, tube inspection, MFL, remote visual inspection and digital inspection workflows, subject to availability.'],
    ['How do I book a technical discussion?', 'Contact our team with a short description of your asset, material and inspection requirement. We will arrange a technical discussion or visit to the Customer Experience Center.'],
];

$jsonLd = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Customer Experience Center', 'item' => BASE_URL . '/pages/customer-experience-center.php'],
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
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Customer experience center for advanced NDT technology" fetchpriority="high" decoding="async">
    </div>
    <div class="container">
        <span class="page-header-label">Customer Experience Center</span>
        <h1 class="page-header-title">EXPERIENCE THE TECHNOLOGY.<br>UNDERSTAND THE SOLUTION.</h1>
        <p class="page-header-desc">Choosing the right NDT method is an engineering decision. Engage with our technical team and understand inspection technologies for real industrial applications.</p>
        <div class="page-hero-actions">
            <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn" data-cursor="OPEN">BOOK A TECHNICAL DISCUSSION <span class="btn-arrow">&rarr;</span></a>
            <a href="#experience" class="btn btn-outline-white magnetic-btn">WHAT YOU CAN EXPERIENCE</a>
        </div>
        <nav class="page-hero-crumbs" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/">Home</a><span>/</span><span>Customer Experience Center</span>
        </nav>
    </div>
</section>

<div class="trust-strip">
    <span class="trust-item">Technology Demonstrations</span>
    <span class="trust-item">Technical Consultation</span>
    <span class="trust-item">Method Evaluation</span>
    <span class="trust-item">Project Planning</span>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Evaluating NDT methods for a specific industrial application" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
            <div>
                <span class="section-label">An Engineering Decision</span>
                <h2 class="section-title">THE RIGHT APPROACH<br>STARTS WITH UNDERSTANDING</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    Different materials, geometries, defect types, thicknesses and accessibility
                    conditions require different inspection approaches.
                </p>
                <p class="section-desc" style="max-width:none;">
                    The <strong>JAGS Technologies Customer Experience Center</strong> provides an
                    environment where customers can engage with our technical team, understand
                    inspection technologies and discuss solutions for real industrial applications.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt" id="experience">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">What You Can Experience</span>
            <h2 class="section-title">TECHNOLOGIES &amp; WORKFLOWS</h2>
        </div>
        <div class="chip-grid stagger-children">
            <?php
            $experience = [
                ['CNV', 'Conventional NDT Methods'], ['AUT', 'Advanced Ultrasonic Testing'],
                ['PAUT', 'Phased Array Ultrasonic Testing'], ['TOFD', 'Time of Flight Diffraction'],
                ['ECT', 'Eddy Current Technologies'], ['TUBE', 'Tube Inspection Solutions'],
                ['RVI', 'Remote Visual Inspection'], ['EQP', 'Inspection Equipment'],
                ['DIGI', 'Digital Inspection Workflows'], ['DATA', 'Data Acquisition &amp; Reporting'],
                ['ACC', 'NDT Accessories &amp; Solutions'],
            ];
            foreach ($experience as $x):
            ?>
            <div class="chip">
                <span class="chip-code"><?= $x[0] ?></span>
                <span class="chip-name"><?= $x[1] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Inside the Center</span>
            <h2 class="section-title">A CLOSER LOOK</h2>
        </div>
        <div class="gallery-grid reveal-scale">
            <div class="gallery-item span-2 span-row-2">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Advanced ultrasonic inspection technology demonstration" loading="lazy" decoding="async">
                <div class="gallery-caption">Advanced Ultrasonic Inspection</div>
            </div>
            <div class="gallery-item">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Weld inspection method evaluation" loading="lazy" decoding="async">
                <div class="gallery-caption">Weld Inspection</div>
            </div>
            <div class="gallery-item">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Heavy industry inspection applications" loading="lazy" decoding="async">
                <div class="gallery-caption">Heavy Industry</div>
            </div>
            <div class="gallery-item span-2">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-rail-automotive.webp" alt="Automated inspection for rail and automotive components" loading="lazy" decoding="async">
                <div class="gallery-caption">Automated Inspection</div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Technical Consultation</span>
            <h2 class="section-title">BRING US YOUR<br>INSPECTION CHALLENGE</h2>
        </div>
        <div class="consult-grid stagger-children">
            <?php
            $questions = [
                'How can we detect this defect?',
                'Which NDT method should we use?',
                'Can this inspection be performed without shutdown?',
                'How can we inspect inaccessible areas?',
                'Can we improve inspection coverage?',
                'How can we reduce inspection time?',
            ];
            foreach ($questions as $q):
            ?>
            <div class="consult-card">
                <p class="consult-text"><?= e($q) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Demonstration-Based Understanding</span>
            <h2 class="section-title">SEE IT TO UNDERSTAND IT</h2>
            <p class="section-desc" style="margin:0 auto;">Seeing an inspection technology in operation can provide a clearer understanding of its capabilities and limitations. The center supports:</p>
        </div>
        <div class="feature-grid">
            <?php
            $demo = [
                ['Technology Demonstrations', 'Observe inspection technologies applied to representative samples and geometries.', 'M12 2v4m0 12v4M2 12h4m12 0h4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8M19.1 4.9l-2.8 2.8M7.7 16.3l-2.8 2.8'],
                ['Client Discussions', 'Review your asset, operating conditions and inspection objectives in detail.', 'M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z'],
                ['Product Demonstrations', 'Understand equipment capability, workflow and reporting outputs.', 'M21 16V8a2 2 0 0 0-1-1.7l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.7l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z'],
                ['Method Evaluation', 'Compare methods for coverage, sensitivity, speed and access.', 'M4 4h16v16H4Zm4 4h8M8 12h8M8 16h5'],
                ['Technical Presentations', 'Structured sessions on new methods, standards and applications.', 'M2 3h20v14H2Zm5 19h10m-5-5v5'],
                ['Training &amp; Knowledge Sharing', 'Build team competency and confidence with technology.', 'M22 10 12 5 2 10l10 5 10-5ZM6 12v5c0 1 2.7 2.5 6 2.5s6-1.5 6-2.5v-5'],
            ];
            foreach ($demo as $i => $d):
            ?>
            <div class="feature-card reveal" data-cursor="EXPLORE">
                <div class="feature-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $d[2] ?>"/></svg>
                </div>
                <h3 class="feature-title"><?= $d[0] ?></h3>
                <p class="feature-desc"><?= e($d[1]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">From Problem to Solution</span>
            <h2 class="section-title">OUR ENGAGEMENT PROCESS</h2>
        </div>
        <div class="process-grid">
            <?php
            $process = [
                ['01', 'Understand', 'Understand the asset and inspection challenge.'],
                ['02', 'Analyze', 'Review material, geometry, accessibility and expected discontinuities.'],
                ['03', 'Recommend', 'Identify appropriate inspection technologies and methodologies.'],
                ['04', 'Demonstrate', 'Where applicable, demonstrate the technology or approach.'],
                ['05', 'Execute', 'Deploy the appropriate inspection solution.'],
                ['06', 'Report', 'Deliver structured results for engineering decision-making.'],
            ];
            foreach ($process as $p):
            ?>
            <div class="process-step reveal">
                <div class="process-step-num"><?= $p[0] ?></div>
                <h3 class="process-step-title"><?= e($p[1]) ?></h3>
                <p class="process-step-desc"><?= e($p[2]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="image-band">
    <div class="image-band-media parallax-img" data-speed="0.15">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Visit the JAGS Technologies customer experience center" loading="lazy" decoding="async">
    </div>
    <div class="image-band-overlay"></div>
    <div class="container">
        <div class="image-band-inner">
            <span class="section-label" style="color:var(--color-accent);">Visit Our Center</span>
            <h2 class="image-band-title">EVALUATING A NEW TECHNOLOGY OR SOLVING A DIFFICULT INSPECTION?</h2>
            <p class="image-band-desc">Whether you are evaluating a new NDT technology, planning an inspection campaign or looking for a solution to a difficult inspection challenge, our technical team is available to discuss your requirements.</p>
            <div class="page-hero-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn">BOOK A TECHNICAL DISCUSSION <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<section class="section" id="faq">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Frequently Asked Questions</span>
            <h2 class="section-title">VISITING THE CENTER</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($faqs as $i => $f): ?>
            <div class="faq-item">
                <button class="faq-question" type="button" aria-expanded="false" aria-controls="cec-faq-<?= $i + 1 ?>">
                    <span><?= e($f[0]) ?></span>
                    <span class="faq-icon" aria-hidden="true"></span>
                </button>
                <div class="faq-answer" id="cec-faq-<?= $i + 1 ?>">
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
            <h2 class="cta-title">HAVE AN INSPECTION<br>CHALLENGE?</h2>
            <p class="cta-desc">Tell us about your asset, material and inspection requirement. Our technical team will help identify an appropriate inspection approach.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">REQUEST A QUOTE <span class="btn-arrow">&rarr;</span></a>
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-outline-white magnetic-btn">TALK TO AN EXPERT</a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
