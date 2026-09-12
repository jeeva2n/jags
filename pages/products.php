<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Products';
$metaDesc = 'Browse JAGS Technologies NDT equipment and accessories — eddy current, PAUT & TOFD, MPI, penetrant testing, probes, calibration blocks and more.';
$ndtCategories = getCategories('ndt');
$automationCategories = getCategories('automation');
$selectedCat = $_GET['cat'] ?? null;
$products = $selectedCat ? getProducts(getCategory($selectedCat)['id'] ?? null) : getProducts();
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Products</span>
        <h1 class="page-header-title">NDT EQUIPMENT<br>& ACCESSORIES</h1>
        <p class="page-header-desc">Complete range of NDT instruments, probes, calibration blocks and accessories.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="filter-bar">
            <button class="filter-btn <?= !$selectedCat ? 'active' : '' ?>" onclick="window.location.href='<?= BASE_URL ?>/pages/products.php'">ALL</button>
            <?php foreach ($ndtCategories as $cat): ?>
            <button class="filter-btn <?= $selectedCat === $cat['slug'] ? 'active' : '' ?>" onclick="window.location.href='<?= BASE_URL ?>/pages/products.php?cat=<?= $cat['slug'] ?>'"><?= strtoupper($cat['name']) ?></button>
            <?php endforeach; ?>
            <?php foreach ($automationCategories as $cat): ?>
            <button class="filter-btn <?= $selectedCat === $cat['slug'] ? 'active' : '' ?>" onclick="window.location.href='<?= BASE_URL ?>/pages/products.php?cat=<?= $cat['slug'] ?>'"><?= strtoupper($cat['name']) ?></button>
            <?php endforeach; ?>
        </div>

        <?php if (empty($products)): ?>
        <div style="text-align: center; padding: 80px 0;">
            <p style="font-size: var(--fs-lg); color: var(--color-text-muted);">No products available in this category yet. Products will be added through the admin panel.</p>
        </div>
        <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
            <a href="<?= BASE_URL ?>/pages/product-detail.php?slug=<?= $product['slug'] ?>" class="product-card">
                <div class="product-card-image">
                    <?php if ($product['image']): ?>
                    <img src="<?= BASE_URL ?>/<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" loading="lazy" decoding="async">
                    <?php else: ?>
                    <img src="<?= placeholder_img() ?>" alt="<?= e($product['name']) ?>" loading="lazy" decoding="async">
                    <?php endif; ?>
                </div>
                <div class="product-card-body">
                    <span class="product-card-cat"><?= e($product['category_name'] ?? '') ?></span>
                    <h3 class="product-card-title"><?= e($product['name']) ?></h3>
                    <p class="product-card-desc"><?= e($product['short_description'] ?? '') ?></p>
                    <span class="product-card-link">EXPLORE <span class="btn-arrow">&rarr;</span></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
