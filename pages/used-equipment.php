<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Used Equipment for Sale';
$metaDesc = 'Browse JAGS Technologies available used, refurbished and certified NDT equipment, probes and inspection systems for sale.';
$categories = ue_categories();
$selectedCat = $_GET['cat'] ?? null;
if ($selectedCat && !ue_category($selectedCat)) {
    $selectedCat = null;
}
$items = $selectedCat ? ue_equipment_by_category($selectedCat) : ue_equipment();
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Used Equipment</span>
        <h1 class="page-header-title">USED EQUIPMENT<br>FOR SALE</h1>
        <p class="page-header-desc">Browse our available used equipment and specialized inspection products.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="filter-bar" role="navigation" aria-label="Equipment category filters">
            <button class="filter-btn <?= !$selectedCat ? 'active' : '' ?>" onclick="window.location.href='<?= BASE_URL ?>/used-equipment'" aria-current="<?= !$selectedCat ? 'page' : 'false' ?>">ALL</button>
            <?php foreach ($categories as $cat): ?>
            <button class="filter-btn <?= $selectedCat === $cat['slug'] ? 'active' : '' ?>" onclick="window.location.href='<?= BASE_URL ?>/used-equipment?cat=<?= e($cat['slug']) ?>'" aria-current="<?= $selectedCat === $cat['slug'] ? 'page' : 'false' ?>"><?= e($cat['code']) ?></button>
            <?php endforeach; ?>
        </div>

        <?php if (empty($items)): ?>
        <div style="text-align: center; padding: 80px 0;">
            <p style="font-size: var(--fs-lg); color: var(--color-text-muted);">No used equipment is currently available in this category. New listings are added regularly.</p>
            <a href="<?= BASE_URL ?>/used-equipment" class="btn btn-primary magnetic-btn" style="margin-top: 24px;">VIEW ALL EQUIPMENT <span class="btn-arrow">&rarr;</span></a>
        </div>
        <?php else: ?>
        <div class="ue-list-grid">
            <?php foreach ($items as $item): $cat = ue_category($item['category']); $imgSrc = ue_item_image($item); ?>
            <article class="ue-item" data-cursor="OPEN">
                <a href="<?= BASE_URL ?>/used-equipment/<?= e($item['slug']) ?>" class="ue-item-image" aria-label="<?= e($item['name']) ?>">
                    <?php if ($imgSrc !== ''): ?>
                    <img src="<?= e($imgSrc) ?>" alt="<?= e($item['name']) ?>" loading="lazy" decoding="async">
                    <?php else: ?>
                    <div class="ue-ph" role="img" aria-label="<?= e($item['name']) ?>">
                        <span class="ue-ph-code"><?= e($cat['code'] ?? 'EQ') ?></span>
                    </div>
                    <?php endif; ?>
                </a>
                <div class="ue-item-body">
                    <div class="ue-item-meta">
                        <span class="ue-pill ue-pill--brand"><?= e($cat['code'] ?? $item['category']) ?></span>
                        <span class="ue-pill"><?= e($item['condition']) ?></span>
                        <span class="ue-pill"><?= e($item['availability']) ?></span>
                    </div>
                    <h3 class="ue-item-title"><a href="<?= BASE_URL ?>/used-equipment/<?= e($item['slug']) ?>"><?= e($item['name']) ?></a></h3>
                    <p class="ue-item-model">
                        <span><?= e($item['manufacturer']) ?></span>
                        <?php if ($item['model']): ?> &middot; <span><?= e($item['model']) ?></span><?php endif; ?>
                    </p>
                    <p class="ue-item-desc"><?= e($item['shortDescription']) ?></p>
                    <?php if (!empty($item['specifications'])): ?>
                    <ul class="ue-item-specs">
                        <?php foreach (array_slice($item['specifications'], 0, 2) as $spec): ?>
                        <li><?= e($spec) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="ue-item-actions">
                        <a href="<?= BASE_URL ?>/used-equipment/<?= e($item['slug']) ?>" class="btn btn-secondary magnetic-btn">VIEW DETAILS</a>
                        <a href="<?= BASE_URL ?>/pages/contact.php?equipment=<?= e(urlencode($item['name'])) ?>" class="btn btn-primary magnetic-btn">ENQUIRE NOW</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>