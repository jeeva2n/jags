<?php
require_once __DIR__ . '/includes/config.php';
http_response_code(404);
$pageTitle = 'Page Not Found';
$metaDesc  = 'The page you were looking for could not be found on JAGS Technologies.';
$noindex   = true;
include __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Error 404</span>
        <h1 class="page-header-title">PAGE NOT<br>FOUND</h1>
        <p class="page-header-desc">The page you were looking for does not exist, was moved, or is temporarily unavailable.</p>
    </div>
</div>

<section class="section">
    <div class="container" style="text-align: center;">
        <div class="cta-content" style="max-width: 560px; margin: 0 auto;">
            <span class="section-label" style="padding-left: 0;">Let&rsquo;s get you back on track</span>
            <h2 class="section-title" style="margin-bottom: 16px;">LOOKING FOR NDT EQUIPMENT OR AUTOMATION?</h2>
            <p class="section-desc" style="margin: 0 auto 40px; text-align: center;">Explore our complete range of NDT instruments, inspection systems, used equipment and industrial automation solutions.</p>
            <div class="cta-actions" style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?= BASE_URL ?>/" class="btn btn-primary magnetic-btn">GO TO HOMEPAGE <span class="btn-arrow">&rarr;</span></a>
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-secondary magnetic-btn">CONTACT US</a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>