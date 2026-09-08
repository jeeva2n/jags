<?php
require_once __DIR__ . '/../includes/config.php';
$slug = $_GET['slug'] ?? '';
$product = getProduct($slug);
if (!$product) {
    header('Location: ' . BASE_URL . '/pages/products.php');
    exit;
}
$pageTitle = $product['name'];
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label"><?= e($product['category_name'] ?? 'Products') ?></span>
        <h1 class="page-header-title"><?= e($product['name']) ?></h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <?php if ($product['image']): ?>
                <div class="split-image img-reveal">
                    <img src="<?= BASE_URL ?>/<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
                </div>
                <?php else: ?>
                <div class="split-image img-reveal">
                    <img src="https://picsum.photos/seed/p-<?= e($product['slug']) ?>/800/600" alt="<?= e($product['name']) ?>">
                </div>
                <?php endif; ?>
            </div>

            <div class="split-content">
                <span class="split-number"><?= e($product['category_name'] ?? '') ?></span>
                <h2 class="split-title" style="margin-bottom: 16px;"><?= e($product['name']) ?></h2>

                <?php if ($product['description']): ?>
                <p class="section-desc" style="margin-bottom: 32px;"><?= e($product['description']) ?></p>
                <?php endif; ?>

                <?php if ($product['features']): ?>
                <div style="margin-bottom: 32px;">
                    <h4 style="font-size: 0.8rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 12px;">Features</h4>
                    <ul class="split-list">
                        <?php foreach (explode("\n", $product['features']) as $feature): ?>
                        <li><?= e(trim($feature)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if ($product['applications']): ?>
                <div style="margin-bottom: 32px;">
                    <h4 style="font-size: 0.8rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 12px;">Applications</h4>
                    <ul class="split-list">
                        <?php foreach (explode("\n", $product['applications']) as $app): ?>
                        <li><?= e(trim($app)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-primary magnetic-btn">
                    REQUEST A QUOTE
                    <span class="btn-arrow">&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="section-header">
            <span class="section-label">Related Products</span>
            <h2 class="section-title">MORE IN <?= strtoupper(e($product['category_name'] ?? 'CATEGORY')) ?></h2>
        </div>

        <?php
        $related = getProducts($product['category_id'], 3);
        $related = array_filter($related, fn($p) => $p['id'] != $product['id']);
        if ($related):
        ?>
        <div class="product-grid">
            <?php foreach (array_slice($related, 0, 3) as $rel): ?>
            <a href="<?= BASE_URL ?>/pages/product-detail.php?slug=<?= $rel['slug'] ?>" class="product-card">
                <div class="product-card-image">
                    <?php if ($rel['image']): ?>
                    <img src="<?= BASE_URL ?>/<?= e($rel['image']) ?>" alt="<?= e($rel['name']) ?>">
                    <?php else: ?>
                    <img src="https://picsum.photos/seed/p-<?= e($rel['slug']) ?>/600/400" alt="<?= e($rel['name']) ?>">
                    <?php endif; ?>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat"><?= e($rel['category_name'] ?? '') ?></span>
                    <h3 class="product-card-title"><?= e($rel['name']) ?></h3>
                    <p class="product-card-desc"><?= e($rel['short_description'] ?? '') ?></p>
                    <span class="product-card-link">EXPLORE <span class="btn-arrow">&rarr;</span></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
