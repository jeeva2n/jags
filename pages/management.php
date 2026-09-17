<?php
require_once __DIR__ . '/../includes/config.php';

$pageTitle = 'Management';
$metaDesc  = 'Meet the management and technical leadership behind JAGS Technologies, delivering professional NDT, industrial inspection and asset integrity solutions.';
$ogImage   = BASE_URL . '/assets/images/hero/hero-paut-aerospace.webp';

$jsonLd = [
    [
        '@context' => 'https://schema.org',
        '@type'    => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => BASE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Management', 'item' => BASE_URL . '/pages/management.php'],
        ],
    ],
];

include __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
    <div class="page-hero-media">
        <img src="<?= BASE_URL ?>/assets/images/hero/hero-paut-aerospace.webp" alt="Technical leadership in advanced ultrasonic inspection" fetchpriority="high" decoding="async">
    </div>
    <div class="container">
        <span class="page-header-label">Management</span>
        <h1 class="page-header-title">LEADERSHIP DRIVEN BY ENGINEERING,<br>INTEGRITY &amp; ACCOUNTABILITY</h1>
        <p class="page-header-desc">Behind every reliable inspection program is a team that understands the importance of technical accuracy, safety and accountability.</p>
        <div class="page-hero-actions">
            <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn" data-cursor="OPEN">TALK TO OUR TEAM <span class="btn-arrow">&rarr;</span></a>
            <a href="#principles" class="btn btn-outline-white magnetic-btn">OUR PRINCIPLES</a>
        </div>
        <nav class="page-hero-crumbs" aria-label="Breadcrumb">
            <a href="<?= BASE_URL ?>/">Home</a><span>/</span><span>Management</span>
        </nav>
    </div>
</section>

<div class="trust-strip">
    <span class="trust-item">Engineering Knowledge</span>
    <span class="trust-item">Field Experience</span>
    <span class="trust-item">Quality Systems</span>
    <span class="trust-item">Customer-Focused Execution</span>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Our Philosophy</span>
                <h2 class="section-title">TECHNICAL ACCURACY<br>AND ACCOUNTABILITY</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    At JAGS Technologies, our management philosophy combines
                    <strong>engineering knowledge, field experience, quality systems
                    and customer-focused execution</strong>.
                </p>
                <p class="section-desc" style="max-width:none; margin-bottom:22px;">
                    Our leadership team works closely with technical personnel, project teams
                    and clients to ensure inspection activities are planned and executed with
                    the appropriate methodology, resources and quality controls.
                </p>
                <p class="section-desc" style="max-width:none;">
                    We believe successful NDT relationships are built through consistency,
                    communication, technical competence and accountability &mdash; making us a
                    trusted inspection partner rather than simply a service provider.
                </p>
            </div>
            <div class="split-image img-reveal has-scan">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-rail-automotive.webp" alt="Inspection team coordinating an industrial testing program" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt" id="principles">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Management Principles</span>
            <h2 class="section-title">HOW WE LEAD</h2>
        </div>
        <div class="feature-grid">
            <?php
            $principles = [
                ['Technical Excellence', 'Inspection decisions can have significant consequences. We place strong emphasis on technical competence, appropriate methodology and adherence to applicable procedures and standards.', 'M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5Z'],
                ['Safety First', 'Industrial inspection often takes place in challenging environments such as operating plants, confined spaces, elevated structures and shutdown environments. Safety is built into planning and execution.', 'M12 3 2 20h20Zm0 6v5m0 3h.01'],
                ['Quality Without Compromise', 'Our objective is to deliver inspection results that clients can confidently use for engineering, maintenance and asset integrity decisions.', 'm9 12 2 2 4-4m-3-8 7 3v6c0 5-3.4 9.4-8 11-4.6-1.6-8-6-8-11V5Z'],
                ['Client Partnership', 'We aim to understand the client&rsquo;s actual problem &mdash; not simply the requested inspection technique &mdash; and to recommend the method best suited to the application.', 'M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 10v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8'],
            ];
            foreach ($principles as $i => $p):
            ?>
            <div class="feature-card reveal" data-cursor="EXPLORE">
                <div class="feature-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="<?= $p[2] ?>"/></svg>
                </div>
                <h3 class="feature-title"><?= $p[0] ?></h3>
                <p class="feature-desc"><?= $p[1] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan" style="aspect-ratio:4/3;">
                <img src="<?= BASE_URL ?>/assets/images/hero/hero-weld-inspection.webp" alt="Selecting the correct inspection method for a weld" loading="lazy" decoding="async">
                <div class="scan-line"></div>
            </div>
            <div>
                <span class="section-label">Method Selection</span>
                <h2 class="section-title">THE RIGHT METHOD<br>DEPENDS ON THE APPLICATION</h2>
                <p class="section-desc" style="max-width:none; margin-bottom:26px;">
                    The most suitable inspection approach is never a default. Our team evaluates
                    each application across the factors that determine performance and coverage:
                </p>
                <ul class="check-list">
                    <li>Material</li>
                    <li>Geometry</li>
                    <li>Thickness</li>
                    <li>Accessibility</li>
                    <li>Operating conditions</li>
                    <li>Expected defect mechanism</li>
                    <li>Inspection objective</li>
                    <li>Applicable standards</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <span class="section-label" style="padding-left:0;">Technical &amp; Project Coordination</span>
            <h2 class="section-title">A STRUCTURED<br>INSPECTION WORKFLOW</h2>
        </div>
        <div class="auto-flow">
            <?php
            $flow = [
                ['01', 'Client'],
                ['02', 'Project Mgmt'],
                ['03', 'Inspection Planning'],
                ['04', 'Qualified Personnel'],
                ['05', 'Examination'],
                ['06', 'Data Evaluation'],
                ['07', 'Reporting'],
                ['08', 'Client Decision'],
            ];
            $last = count($flow) - 1;
            foreach ($flow as $i => $node):
            ?>
            <div class="auto-flow-node">
                <div style="font-size:var(--fs-xs); font-weight:700; letter-spacing:var(--ls-widest); color:var(--color-accent); margin-bottom:6px;"><?= $node[0] ?></div>
                <div class="auto-flow-label"><?= e($node[1]) ?></div>
            </div>
            <?php if ($i !== $last): ?><span class="auto-flow-arrow">&rarr;</span><?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="quote-block reveal-scale">
            <div class="quote-mark">&ldquo;</div>
            <p class="quote-text">Consistency <strong>+</strong> communication <strong>+</strong> technical competence <strong>+</strong> accountability &mdash; the foundation of long-term technical relationships.</p>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">LET&rsquo;S DISCUSS YOUR<br>INSPECTION PROGRAM</h2>
            <p class="cta-desc">Talk to our leadership and technical team about the right approach for your assets.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">TALK TO OUR TEAM <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
