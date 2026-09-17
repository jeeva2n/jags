<?php
require_once __DIR__ . '/../includes/config.php';

$pageTitle = 'Social Responsibility';
$metaDesc  = 'JAGS Technologies promotes responsible engineering through workplace safety, environmental awareness, technical education, employee development and sustainable industrial practices.';
$ogImage   = BASE_URL . '/assets/images/hero/hero-ndt-mining.webp';

$jsonLd = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Social Responsibility', 'item' => BASE_URL . '/pages/social-responsibility.php'],
        ],
    ],
];

include __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero-media">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Responsible engineering and industrial safety in heavy industry" fetchpriority="high" decoding="async">
    </div>
    <div class="container">
        <span class="page-header-label">Social Responsibility</span>
        <h1 class="page-header-title">RESPONSIBLE ENGINEERING.<br>SAFER INDUSTRIES. STRONGER COMMUNITIES.</h1>
        <p class="page-header-desc">As an NDT and industrial inspection organisation, our work contributes directly to industrial safety, environmental protection and operational reliability.</p>
        <div class="page-hero-actions">
            <a href="#framework" class="btn btn-primary magnetic-btn" data-cursor="OPEN">OUR FRAMEWORK <span class="btn-arrow">&rarr;</span></a>
            <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-outline-white magnetic-btn">WORK WITH US</a>
        </div>
        <nav class="page-hero-crumbs" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/">Home</a><span>/</span><span>Social Responsibility</span>
        </nav>
    </div>
</section>

<div class="trust-strip">
    <span class="trust-item">Safety</span>
    <span class="trust-item">Sustainability</span>
    <span class="trust-item">Skills</span>
    <span class="trust-item">Community</span>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Beyond Our Services</span>
                <h2 class="section-title">RESPONSIBILITY IS<br>PART OF THE WORK</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    At JAGS Technologies, responsibility extends beyond the services we deliver.
                    We understand that inspection work contributes directly to
                    <strong>industrial safety, environmental protection and operational reliability</strong>.
                </p>
                <p class="section-desc" style="max-width:none;">
                    Our social responsibility philosophy is therefore closely connected with four
                    principles: safety, sustainability, skills and community.
                </p>
            </div>
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Inspection contributing to safety and asset reliability" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-ndt-mining.webp" alt="Non-destructive testing supporting safer industrial operations" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
            <div>
                <span class="section-label">Safety as a Responsibility</span>
                <h2 class="section-title">FINDING DEFECTS<br>BEFORE THEY FAIL</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:26px;">
                    Non-Destructive Testing helps industries identify defects before they develop
                    into serious failures. By supporting effective inspection and asset integrity
                    programs, NDT contributes to:
                </p>
                <ul class="check-list single">
                    <li>Safer industrial operations</li>
                    <li>Reduced equipment failure risk</li>
                    <li>Better maintenance planning</li>
                    <li>Improved asset reliability</li>
                    <li>Protection of people and property</li>
                    <li>Environmental risk reduction</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Environmental Responsibility</span>
            <h2 class="section-title">RESPONSIBLE INDUSTRIAL PRACTICE</h2>
            <p class="section-desc" style="margin:0 auto;">Responsible industrial operations require consideration of environmental impact. Our approach encourages:</p>
        </div>
        <div class="feature-grid">
            <?php
            $environment = [
                ['Resource Utilisation', 'Appropriate use of resources across inspection activities and operations.', 'M12 2v20M2 12h20M5 5l14 14M19 5 5 19'],
                ['Waste Management', 'Responsible handling and disposal practices in the field and workshop.', 'M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14'],
                ['Digital Documentation', 'Digital records where practical to reduce paper and material consumption.', 'M4 4h16v12H4Zm4 16h8m-4-4v4'],
                ['Material Efficiency', 'Reducing unnecessary material consumption in projects and packaging.', 'M21 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3m18 0H3m18 0v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8'],
                ['Responsible Practices', 'Environmentally responsible work practices on every site.', 'M12 22c4-3 8-6 8-11a8 8 0 1 0-16 0c0 5 4 8 8 11Zm0-11v6m0-6-3-3m3 3 3-3'],
                ['Environmental Awareness', 'Awareness of environmental risks during inspection activities.', 'M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Zm11 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z'],
            ];
            foreach ($environment as $i => $env):
            ?>
            <div class="feature-card reveal" data-cursor="EXPLORE">
                <div class="feature-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $env[2] ?>"/></svg>
                </div>
                <h3 class="feature-title"><?= e($env[0]) ?></h3>
                <p class="feature-desc"><?= e($env[1]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="image-band">
    <div class="image-band-media parallax-img" data-speed="0.15">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Building technical skills for the future of industrial inspection" loading="lazy" decoding="async">
    </div>
    <div class="image-band-overlay"></div>
    <div class="container">
        <div class="image-band-inner">
            <span class="section-label" style="color:var(--color-accent);">Building Technical Skills</span>
            <h2 class="image-band-title">THE FUTURE OF INSPECTION DEPENDS ON SKILLED PROFESSIONALS</h2>
            <p class="image-band-desc">We support knowledge development through technical awareness, NDT knowledge sharing, safety awareness, industry interaction, skill development and practical learning opportunities.</p>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Community &amp; Industry</span>
                <h2 class="section-title">SHARING KNOWLEDGE,<br>DEVELOPING PEOPLE</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    We believe companies can contribute to society by sharing knowledge, supporting
                    professional development and encouraging young engineers to understand the
                    importance of <strong>quality, safety and engineering integrity</strong>.
                </p>
                <p class="section-desc" style="max-width:none;">
                    From technical interaction to practical learning, our focus is on strengthening
                    the skills base that keeps industry safe and reliable.
                </p>
            </div>
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-rail-automotive.webp" alt="Knowledge sharing and professional development in inspection" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="framework">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Our Responsibility Framework</span>
            <h2 class="section-title">FOUR PILLARS</h2>
        </div>
        <div class="pillar-grid">
            <?php
            $pillars = [
                ['01', 'People', 'Safety, professional development and employee wellbeing.'],
                ['02', 'Industry', 'Quality, reliability and responsible inspection practices.'],
                ['03', 'Environment', 'Responsible resource use and environmental awareness.'],
                ['04', 'Community', 'Knowledge sharing, education and technical development.'],
            ];
            foreach ($pillars as $p):
            ?>
            <div class="pillar-card reveal" data-cursor="EXPLORE">
                <div class="pillar-num"><?= $p[0] ?></div>
                <h3 class="pillar-title"><?= e($p[1]) ?></h3>
                <p class="pillar-desc"><?= e($p[2]) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">BUILD SAFER, MORE<br>RELIABLE INDUSTRIES</h2>
            <p class="cta-desc">Partner with a team that treats safety, quality and responsibility as part of the job.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">GET IN TOUCH <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
