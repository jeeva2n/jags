<?php
require_once __DIR__ . '/includes/config.php';

header('Content-Type: application/xml; charset=utf-8');

function sitemap_url(string $loc, string $priority = '0.6', string $changefreq = 'weekly'): void {
    echo '  <url>' . "\n";
    echo '    <loc>' . e($loc) . '</loc>' . "\n";
    echo '    <changefreq>' . e($changefreq) . '</changefreq>' . "\n";
    echo '    <priority>' . e($priority) . '</priority>' . "\n";
    echo '  </url>' . "\n";
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

/* Static public pages */
sitemap_url(BASE_URL . '/', '1.0', 'daily');
sitemap_url(BASE_URL . '/pages/about.php', '0.7');
sitemap_url(BASE_URL . '/pages/products.php', '0.8', 'daily');
sitemap_url(BASE_URL . '/pages/automation.php', '0.7');
sitemap_url(BASE_URL . '/pages/industries.php', '0.7');
sitemap_url(BASE_URL . '/pages/solutions.php', '0.6');
sitemap_url(BASE_URL . '/pages/projects.php', '0.6');
sitemap_url(BASE_URL . '/pages/contact.php', '0.7');
sitemap_url(BASE_URL . '/used-equipment', '0.8', 'daily');
sitemap_url(BASE_URL . '/pages/privacy-policy.php', '0.2', 'yearly');
sitemap_url(BASE_URL . '/pages/terms-of-service.php', '0.2', 'yearly');

/* Products (active only) */
foreach (getProducts() as $p) {
    if (!isset($p['slug']) || $p['slug'] === '') continue;
    sitemap_url(BASE_URL . '/pages/product-detail.php?slug=' . rawurlencode($p['slug']), '0.6', 'weekly');
}

/* Used equipment (active only) */
foreach (ue_equipment() as $item) {
    if (!isset($item['slug']) || $item['slug'] === '') continue;
    sitemap_url(BASE_URL . '/used-equipment/' . rawurlencode($item['slug']), '0.6', 'weekly');
}

echo '</urlset>' . "\n";