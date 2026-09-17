<?php
require_once __DIR__ . '/../includes/config.php';

$pageTitle = 'Global Partners';
$metaDesc  = 'JAGS Technologies collaborates with technology providers and industry partners to deliver advanced NDT, inspection and asset integrity solutions across India and international markets.';
$ogImage   = BASE_URL . '/assets/images/hero/hero-rail-automotive.webp';

$jsonLd = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Global Partners', 'item' => BASE_URL . '/pages/global-partners.php'],
        ],
    ],
];

include __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero-media">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-rail-automotive.webp" alt="Global inspection technology for rail and automotive industries" fetchpriority="high" decoding="async">
    </div>
    <div class="container">
        <span class="page-header-label">Global Partners</span>
        <h1 class="page-header-title">GLOBAL TECHNOLOGY.<br>INDUSTRIAL INSPECTION EXPERTISE.</h1>
        <p class="page-header-desc">Connecting advanced inspection technology, engineering expertise and local industrial requirements to deliver practical NDT solutions.</p>
        <div class="page-hero-actions">
            <a href="#partner" class="btn btn-primary magnetic-btn" data-cursor="OPEN">PARTNER WITH US <span class="btn-arrow">&rarr;</span></a>
            <a href="#ecosystem" class="btn btn-outline-white magnetic-btn">TECHNOLOGY ECOSYSTEM</a>
        </div>
        <nav class="page-hero-crumbs" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/">Home</a><span>/</span><span>Global Partners</span>
        </nav>
    </div>
</section>

<div class="trust-strip">
    <span class="trust-item">Technology Capability</span>
    <span class="trust-item">Knowledge Sharing</span>
    <span class="trust-item">Application Expertise</span>
    <span class="trust-item">After-Sales Support</span>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Advanced sensor and phased array inspection technology" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
            <div>
                <span class="section-label">Why Partnerships</span>
                <h2 class="section-title">CONNECTING GLOBAL<br>TECHNOLOGY WITH INDUSTRY</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    Modern asset inspection is evolving rapidly. New inspection technologies,
                    advanced sensors, automated systems and digital data platforms are changing
                    how industries evaluate the condition of critical assets.
                </p>
                <p class="section-desc" style="max-width:none;">
                    JAGS Technologies seeks to connect <strong>global inspection technology,
                    engineering expertise and local industrial requirements</strong> to deliver
                    practical NDT solutions that work in real operating environments.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Our Partnership Philosophy</span>
            <h2 class="section-title">VALUE FOR CLIENTS,<br>NOT JUST TECHNOLOGY</h2>
        </div>
        <div class="feature-grid">
            <?php
            $values = [
                ['Technology Capability', 'Access to advanced inspection platforms and methods suited to demanding applications.', 'M12 2v4m0 12v4M2 12h4m12 0h4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8M19.1 4.9l-2.8 2.8M7.7 16.3l-2.8 2.8'],
                ['Technical Support', 'Application guidance and engineering support through selection, setup and execution.', 'M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5Z'],
                ['Equipment Reliability', 'Dependable instruments and systems that perform consistently in the field.', 'm9 12 2 2 4-4m-3-8 7 3v6c0 5-3.4 9.4-8 11-4.6-1.6-8-6-8-11V5Z'],
                ['Knowledge Sharing', 'Continuous exchange of technical know-how between partners and our team.', 'M12 2a7 7 0 0 0-4 12.7V19h8v-4.3A7 7 0 0 0 12 2Zm-3 19h6'],
                ['Application Expertise', 'Turning technology into working inspection solutions for specific defects and geometries.', 'M4 4h16v16H4Zm4 4h8M8 12h8M8 16h5'],
                ['Training &amp; Competency', 'Building operator skill and confidence for correct, repeatable use of technology.', 'M22 10 12 5 2 10l10 5 10-5ZM6 12v5c0 1 2.7 2.5 6 2.5s6-1.5 6-2.5v-5'],
                ['Project Support', 'Partner-backed assistance for complex inspections and engineered applications.', 'M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z'],
                ['After-Sales Assistance', 'Ongoing service, spares and technical assistance beyond the initial supply.', 'M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.7 21a2 2 0 0 1-3.4 0'],
            ];
            foreach ($values as $i => $v):
            ?>
            <div class="feature-card reveal" data-cursor="EXPLORE">
                <div class="feature-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $v[2] ?>"/></svg>
                </div>
                <h3 class="feature-title"><?= $v[0] ?></h3>
                <p class="feature-desc"><?= e($v[1]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="image-band" id="ecosystem">
    <div class="image-band-media parallax-img" data-speed="0.15">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Advanced NDT technology ecosystem in heavy industry" loading="lazy" decoding="async">
    </div>
    <div class="image-band-overlay"></div>
    <div class="container">
        <div class="image-band-inner">
            <span class="section-label" style="color:var(--color-accent);">Advanced Technology Ecosystem</span>
            <h2 class="image-band-title">TECHNOLOGY THAT SOLVES REAL INSPECTION PROBLEMS</h2>
            <p class="image-band-desc">Our technology ecosystem supports applications across advanced ultrasonics, eddy current, tube and tank inspection, remote visual inspection and digital integrity monitoring.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Applications We Support</span>
            <h2 class="section-title">INSPECTION TECHNOLOGY<br>ECOSYSTEM</h2>
        </div>
        <div class="chip-grid stagger-children">
            <?php
            $ecosystem = [
                ['AUT', 'Advanced Ultrasonic Testing'], ['PAUT', 'Phased Array Ultrasonic Testing'],
                ['TOFD', 'Time of Flight Diffraction'], ['AUT-S', 'Automated Ultrasonic Inspection'],
                ['LRUT', 'Long Range Ultrasonic Testing'], ['ECT', 'Eddy Current Testing'],
                ['TUBE', 'Tube Inspection'], ['TANK', 'Tank Floor Inspection'],
                ['RVI', 'Remote Visual Inspection'], ['DIGI', 'Digital Inspection Solutions'],
                ['AIM', 'Asset Integrity Monitoring'],
            ];
            foreach ($ecosystem as $eco):
            ?>
            <div class="chip">
                <span class="chip-code"><?= $eco[0] ?></span>
                <span class="chip-name"><?= $eco[1] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Local Understanding</span>
                <h2 class="section-title">GLOBAL STANDARDS.<br>LOCAL UNDERSTANDING.</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    International technology becomes valuable only when it is correctly applied
                    to the client&rsquo;s operating environment.
                </p>
                <p class="section-desc" style="max-width:none;">
                    JAGS Technologies combines technology with an understanding of
                    <strong>Indian industrial conditions, project requirements, inspection
                    practices and client expectations</strong> &mdash; so that advanced methods
                    deliver practical results on site.
                </p>
            </div>
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Applying global NDT technology to local industrial conditions" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="partner">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Partner With Us</span>
            <h2 class="section-title">WE WELCOME COLLABORATION</h2>
        </div>
        <div class="partner-grid">
            <?php
            $partners = [
                ['Manufacturers', 'NDT Technology Manufacturers', 'Bring advanced inspection platforms to the Indian market with local application and service support.'],
                ['Equipment', 'Inspection Equipment Manufacturers', 'Extend reach with a partner who understands industrial inspection workflows and site conditions.'],
                ['Engineering', 'Engineering Companies', 'Collaborate on inspection planning, engineered systems and integrated project delivery.'],
                ['Solutions', 'Industrial Solution Providers', 'Combine complementary capabilities to serve process, power and manufacturing clients.'],
                ['Services', 'Inspection Service Organizations', 'Expand method coverage and technology access for demanding inspection campaigns.'],
                ['R&amp;D', 'Research &amp; Technology Organizations', 'Advance new inspection methods, digital workflows and asset integrity approaches.'],
            ];
            foreach ($partners as $p):
            ?>
            <div class="partner-card reveal" data-cursor="CONNECT">
                <div class="partner-tag"><?= $p[0] ?></div>
                <h3 class="partner-title"><?= $p[1] ?></h3>
                <p class="partner-desc"><?= e($p[2]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="note-box reveal" style="margin-top:40px;">
            <span class="note-box-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8h.01M11 12h1v4h1"/></svg>
            </span>
            <p><strong>A note on partner claims:</strong> verified partner profiles are published with logo, company name, country, technology supplied, partnership scope and authorisation or certification. JAGS Technologies does not publish partnership claims without supporting documentation.</p>
        </div>

        <div class="page-hero-actions" style="justify-content:center; margin-top:48px;">
            <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn">CONNECT WITH JAGS TECHNOLOGIES <span class="btn-arrow">&rarr;</span></a>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">LOOKING FOR AN NDT<br>TECHNOLOGY PARTNER IN INDIA?</h2>
            <p class="cta-desc">Let&rsquo;s explore how we can bring advanced inspection technology to your clients and markets.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">START A CONVERSATION <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
