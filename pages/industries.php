<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Industries';
$industries = getIndustries();
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Industries</span>
        <h1 class="page-header-title">INDUSTRIES<br>WE SERVE</h1>
        <p class="page-header-desc">NDT and automation solutions across diverse industrial sectors.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="industry-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php
            $icons = ['Automotive' => 'AUT', 'Aerospace' => 'ARS', 'Oil & Gas' => 'O&G', 'Power Plants' => 'PWR', 'Railways' => 'RYL', 'Foundries' => 'FND', 'Forging' => 'FRG', 'Fabrication' => 'FAB', 'General Engineering' => 'GEN'];
            foreach ($industries as $ind):
            ?>
            <div class="industry-card" data-cursor="EXPLORE" style="aspect-ratio: 16/10;">
                <div class="industry-card-placeholder" style="padding: 0;">
                    <img src="https://picsum.photos/seed/ind-<?= e(urlencode(strtolower(str_replace(' ', '-', $ind['name'])))) ?>/600/400" alt="<?= e($ind['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="industry-card-overlay">
                    <h3 class="industry-card-title"><?= e($ind['name']) ?></h3>
                    <p class="industry-card-sub"><?= e($ind['description']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">LOOKING FOR AN<br>NDT SOLUTION?</h2>
            <p class="cta-desc">Tell us about your industry and application. We will recommend the right inspection technology.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">GET IN TOUCH <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
