<?php
require_once __DIR__ . '/includes/config.php';

header('Content-Type: text/plain; charset=utf-8');

$basePath = (string)parse_url(BASE_URL, PHP_URL_PATH);

$disallows = [
    $basePath . '/admin/',
    $basePath . '/api/',
    $basePath . '/private_uploads/',
    $basePath . '/includes/',
];

echo "User-agent: *\n";
foreach ($disallows as $d) {
    echo "Disallow: " . e($d) . "\n";
}
echo "\nSitemap: " . e(BASE_URL . '/sitemap.xml') . "\n";