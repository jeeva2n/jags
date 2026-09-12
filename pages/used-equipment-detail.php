<?php
require_once __DIR__ . '/../includes/config.php';
$slug = trim($_GET['slug'] ?? '');
$item = ue_equipment_by_slug($slug);
if (!$item) {
    http_response_code(404);
    include __DIR__ . '/../404.php';
    exit;
}
$category = ue_category($item['category']);
$imgSrc = ue_item_image($item);
$pageTitle = e($item['name']) . ' - Used Equipment';
$metaDesc = e($item['shortDescription']);
$ogType  = 'product';
$ogImage = $imgSrc !== '' ? $imgSrc : default_og_image();
$jsonLd  = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Product',
    'name'        => $item['name'],
    'description' => $item['shortDescription'],
    'image'       => $ogImage,
    'category'    => $category['code'] ?? $item['category'],
    'url'         => canonical_url(),
];
if ($item['manufacturer'] !== '') {
    $jsonLd['brand'] = ['@type' => 'Brand', 'name' => $item['manufacturer']];
}
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Used Equipment / <?= e($category['code'] ?? $item['category']) ?></span>
        <h1 class="page-header-title"><?= e($item['name']) ?></h1>
        <p class="page-header-desc"><?= e($item['manufacturer']) ?><?= $item['model'] ? ' &middot; ' . e($item['model']) : '' ?> &middot; <?= e($item['condition']) ?> &middot; <?= e($item['availability']) ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <?php if ($imgSrc !== ''): ?>
                <div class="split-image img-reveal has-scan">
                    <img src="<?= e($imgSrc) ?>" alt="<?= e($item['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="scan-line"></div>
                </div>
                <?php else: ?>
                <div class="split-image">
                    <div class="ue-ph ue-ph--lg" role="img" aria-label="<?= e($item['name']) ?>" style="background: linear-gradient(135deg, var(--color-bg-dark), var(--color-bg-dark-alt));">
                        <span class="ue-ph-code"><?= e($category['code'] ?? 'EQ') ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="split-content">
                <span class="split-number"><?= e($category['code'] ?? $item['category']) ?> &mdash; USED EQUIPMENT</span>
                <h2 class="split-title" style="margin-bottom: 16px;"><?= e($item['name']) ?></h2>

                <div class="ue-item-meta" style="margin-bottom: 24px;">
                    <span class="ue-pill ue-pill--brand"><?= e($category['code'] ?? $item['category']) ?></span>
                    <span class="ue-pill"><?= e($item['condition']) ?></span>
                    <span class="ue-pill"><?= e($item['availability']) ?></span>
                </div>

                <p class="section-desc" style="margin-bottom: 32px;"><?= e($item['shortDescription']) ?></p>

                <div class="ue-info-grid" style="margin-bottom: 32px;">
                    <div class="ue-info-item"><span class="ue-info-label">Manufacturer</span><span class="ue-info-value"><?= e($item['manufacturer']) ?></span></div>
                    <div class="ue-info-item"><span class="ue-info-label">Model</span><span class="ue-info-value"><?= e($item['model']) ?></span></div>
                    <div class="ue-info-item"><span class="ue-info-label">Condition</span><span class="ue-info-value"><?= e($item['condition']) ?></span></div>
                    <div class="ue-info-item"><span class="ue-info-label">Availability</span><span class="ue-info-value"><?= e($item['availability']) ?></span></div>
                </div>

                <div class="ue-detail-actions">
                    <a href="<?= BASE_URL ?>/pages/contact.php?equipment=<?= e(urlencode($item['name'])) ?>" class="btn btn-primary magnetic-btn">
                        ENQUIRE ABOUT THIS EQUIPMENT
                        <span class="btn-arrow">&rarr;</span>
                    </a>
                    <a href="<?= BASE_URL ?>/used-equipment" class="btn btn-secondary magnetic-btn">&larr; BACK TO USED EQUIPMENT</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: var(--color-bg-alt); padding-top: 0;">
    <div class="container">
        <div class="ue-detail-columns">
            <div>
                <span class="section-label">Description</span>
                <h2 class="section-title">ABOUT THIS EQUIPMENT</h2>
                <p class="section-desc" style="margin-bottom: 24px;"><?= e($item['description'] ?? $item['shortDescription']) ?></p>
                <ul class="split-list">
                    <?php foreach (($item['features'] ?? []) as $feature): ?>
                    <li><?= e($feature) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div>
                <span class="section-label">Specifications</span>
                <h2 class="section-title">TECHNICAL<br>SPECIFICATIONS</h2>
                <ul class="split-list">
                    <?php foreach ($item['specifications'] as $spec): ?>
                    <li><?= e($spec) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-content" style="text-align: center;">
            <span class="section-label" style="padding-left: 0;">Need More Information?</span>
            <h2 class="section-title" style="margin-bottom: 16px;">ASK ABOUT THIS EQUIPMENT</h2>
            <p class="section-desc" style="margin: 0 auto 40px; text-align: center;">Request specifications, photographs, pricing or a technical inspection report from our sales team.</p>
            <a href="<?= BASE_URL ?>/pages/contact.php?equipment=<?= e(urlencode($item['name'])) ?>" class="btn btn-primary magnetic-btn">
                SEND AN ENQUIRY
                <span class="btn-arrow">&rarr;</span>
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>