<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Solutions';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Solutions</span>
        <h1 class="page-header-title">APPLICATION-FOCUSED<br>SOLUTIONS</h1>
        <p class="page-header-desc">NDT and automation solutions tailored to specific inspection applications.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="services-grid">
            <?php
            $solutions = [
                ['Surface Inspection', 'Surface crack and defect detection using MPI, PT and eddy current testing on ferromagnetic and non-ferromagnetic materials.', 'mpi'],
                ['Tube Inspection', 'Internal tube inspection for heat exchangers, condensers and boilers using multi-frequency eddy current testing.', 'eddy-current'],
                ['Weld Inspection', 'Comprehensive weld inspection with phased array ultrasonic testing, TOFD, MPI and penetrant testing methods.', 'paut-tofd'],
                ['Corrosion Mapping', 'Automated wall thickness measurement and corrosion mapping using phased array UT scanners.', 'paut-tofd'],
                ['Sorting & Detection', 'Automated sorting and crack detection on production lines using high-speed eddy current systems.', 'eddy-current'],
                ['Automated Component Inspection', 'Complete automated inspection cells with feeding, handling, inspection and data logging for production lines.', 'complete-solutions'],
                ['Production-Line Testing', 'Inline NDT integration with production management systems for real-time quality monitoring.', 'complete-solutions'],
            ];
            foreach ($solutions as $sol):
            ?>
            <div class="service-item">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <h3 class="service-title"><?= $sol[0] ?></h3>
                <p class="service-desc" style="margin-bottom: 16px;"><?= $sol[1] ?></p>
                <a href="<?= BASE_URL ?>/pages/products.php?cat=<?= $sol[2] ?>" class="tech-card-arrow">VIEW PRODUCTS <span class="btn-arrow">&rarr;</span></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">NEED A CUSTOM<br>SOLUTION?</h2>
            <p class="cta-desc">Our engineering team can design and build inspection solutions for your specific application.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">DISCUSS YOUR REQUIREMENT <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
