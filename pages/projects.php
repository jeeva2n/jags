<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Projects';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Projects</span>
        <h1 class="page-header-title">ENGINEERED<br>INSPECTION SOLUTIONS</h1>
        <p class="page-header-desc">Customized NDT and automation solutions across industries.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php
        $projects = getProjects();
        if (empty($projects)):
        ?>
        <div style="text-align: center; padding: 80px 0;">
            <p style="font-size: var(--fs-lg); color: var(--color-text-muted); margin-bottom: 16px;">Project showcase coming soon.</p>
            <p style="font-size: var(--fs-sm); color: var(--color-text-muted);">Our engineering team is currently documenting completed projects.</p>
        </div>
        <?php else: ?>
        <div class="project-grid">
            <?php foreach ($projects as $proj): ?>
            <div class="project-card">
                <div class="project-card-image">
                    <?php if ($proj['image']): ?>
                    <img src="<?= BASE_URL ?>/<?= e($proj['image']) ?>" alt="<?= e($proj['title']) ?>">
                    <?php else: ?>
                    <img src="https://picsum.photos/seed/project-<?= e(urlencode($proj['title'])) ?>/600/600" alt="<?= e($proj['title']) ?>">
                    <?php endif; ?>
                </div>
                <div class="project-card-body">
                    <span class="project-card-tag"><?= e($proj['industry'] ?? '') ?></span>
                    <h3 class="project-card-title"><?= e($proj['title']) ?></h3>
                    <p class="project-card-desc"><?= e($proj['description'] ?? '') ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">HAVE AN INSPECTION<br>CHALLENGE?</h2>
            <p class="cta-desc">Tell us about your application and let our team design the right solution.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">REQUEST A QUOTE <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
