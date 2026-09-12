<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'About';
$metaDesc = 'JAGS Technologies supplies NDT equipment, inspection systems and automation, from application study through installation, training and service.';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">About</span>
        <h1 class="page-header-title">ABOUT JAGS<br>TECHNOLOGIES</h1>
        <p class="page-header-desc">Engineering and technology company focused on NDT and industrial automation.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Our Mission</span>
                <h2 class="section-title">ENGINEERING PRECISION.<br>INSPECTION EXCELLENCE.</h2>
                <p class="section-desc" style="margin-bottom: 24px;">
                    JAGS Technologies is an engineering and technology company focused on
                    NDT equipment sales, inspection systems, industrial automation and
                    customized engineering solutions.
                </p>
                <p class="section-desc">
                    We provide complete solutions from application study through method
                    selection, equipment selection, mechanical design, electrical integration,
                    manufacturing, calibration, installation, training and ongoing service.
                </p>
            </div>
            <div class="split-image img-reveal has-scan">
                <img src="<?= BASE_URL ?>/assets/images/placeholder.png" alt="About JAGS Technologies">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <h2 class="section-title">CORE<br>CAPABILITIES</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-number">01</div>
                <h3 class="value-title">NDT Equipment</h3>
                <p class="value-desc">Complete range of NDT instruments including eddy current, phased array, TOFD, MPI and penetrant testing systems with probes and accessories.</p>
            </div>
            <div class="value-card">
                <div class="value-number">02</div>
                <h3 class="value-title">Industrial Automation</h3>
                <p class="value-desc">Customized automation solutions from feeding and handling to robotic inspection, PLC/HMI control and data traceability systems.</p>
            </div>
            <div class="value-card">
                <div class="value-number">03</div>
                <h3 class="value-title">Application Engineering</h3>
                <p class="value-desc">Understanding customer inspection requirements and recommending optimal NDT solutions through method selection and system design.</p>
            </div>
            <div class="value-card">
                <div class="value-number">04</div>
                <h3 class="value-title">Service & Support</h3>
                <p class="value-desc">Professional installation, commissioning, operator training and after-sales service with spares and calibration support.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <h2 class="section-title">10-STEP<br>ENGINEERING WORKFLOW</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px;">
            <?php
            $workflow = [
                ['01', 'Application Study'],
                ['02', 'Method Selection'],
                ['03', 'Equipment Selection'],
                ['04', 'Mechanical Design'],
                ['05', 'PLC Integration'],
                ['06', 'Manufacturing'],
                ['07', 'Calibration & FAT'],
                ['08', 'Installation'],
                ['09', 'Training'],
                ['10', 'Service & Support'],
            ];
            foreach ($workflow as $wf):
            ?>
            <div style="text-align: center; padding: 24px 12px;">
                <div style="font-size: 2rem; font-weight: 900; color: var(--color-brand); opacity: 0.2; margin-bottom: 8px;"><?= $wf[0] ?></div>
                <div style="font-size: 0.8rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; color: var(--color-text-secondary);"><?= $wf[1] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">PARTNER WITH<br>JAGS TECHNOLOGIES</h2>
            <p class="cta-desc">Let us help you find the right NDT or automation solution for your application.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">GET IN TOUCH <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
