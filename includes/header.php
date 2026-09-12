<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$siteName    = getSetting('company_name', SITE_NAME);
$siteTagline = getSetting('tagline', SITE_TAGLINE);
$siteMeta    = getSetting('meta_description', 'Advanced NDT Equipment & Industrial Automation Solutions');

$pageTitle  = $pageTitle  ?? '';
$metaDesc   = trim($metaDesc ?? $siteMeta);
$canonical  = $canonical  ?? canonical_url();
$ogType     = $ogType     ?? 'website';
$ogImage    = $ogImage    ?? default_og_image();
$ogTitle    = $ogTitle    ?? ($pageTitle !== '' ? $pageTitle : $siteName);
$ogDesc     = $ogDesc     ?? $metaDesc;
$noindex    = !empty($noindex);
$jsonLd     = $jsonLd     ?? [];
if (!is_array($jsonLd) || (isset($jsonLd['@context']) && isset($jsonLd['@type']))) {
    $jsonLd = [$jsonLd];
}
$htmlTitle  = $pageTitle !== '' ? $pageTitle . ' | ' . $siteName : $siteName . ' | ' . $siteTagline;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($htmlTitle) ?></title>
    <meta name="description" content="<?= e($metaDesc) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <?php if ($noindex): ?>
    <meta name="robots" content="noindex, nofollow, noarchive">
    <?php endif; ?>

    <meta property="og:type" content="<?= e($ogType) ?>">
    <meta property="og:site_name" content="<?= e($siteName) ?>">
    <meta property="og:title" content="<?= e($ogTitle) ?>">
    <meta property="og:description" content="<?= e($ogDesc) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($ogTitle) ?>">
    <meta name="twitter:description" content="<?= e($ogDesc) ?>">
    <meta name="twitter:image" content="<?= e($ogImage) ?>">

    <?php foreach ($jsonLd as $__ld): if (!is_array($__ld)) continue; ?>
    <script type="application/ld+json"><?= json_encode($__ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endforeach; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/animations.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
</head>
<body data-page="<?= $currentPage ?>">

<div class="custom-cursor" id="cursor">
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>
    <div class="cursor-label"></div>
</div>

<div class="page-transition-overlay" id="pageTransition"></div>

<header class="site-header" id="siteHeader">
    <div class="header-inner">
        <a href="<?= BASE_URL ?>/" class="logo" aria-label="<?= e($siteName) ?> — Home">
            <img src="<?= BASE_URL ?>/assets/images/jags.png" alt="<?= e($siteName) ?> Logo" class="logo-img" width="304" height="152">
            <!-- <span class="logo-text">JAGS<span class="logo-accent"> TECHNOLOGIES</span></span> -->
        </a>

        <nav class="main-nav" id="mainNav">
            <ul class="nav-list">
                <li class="nav-item <?= $currentPage === 'index' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/">Home</a>
                </li>
                <li class="nav-item <?= $currentPage === 'about' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/about.php">About</a>
                </li>
                <li class="nav-item has-dropdown <?= in_array($currentPage, ['used-equipment', 'used-equipment-detail']) ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/used-equipment">Used Equipment</a>
                    <div class="nav-dropdown">
                        <div class="dropdown-inner">
                            <div class="dropdown-col">
                                <span class="dropdown-label">Equipment Categories</span>
                                <ul>
                                    <?php foreach (ue_categories() as $ueCat): ?>
                                    <li><a href="<?= BASE_URL ?>/used-equipment?cat=<?= e($ueCat['slug']) ?>"><?= e($ueCat['code']) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item has-dropdown <?= in_array($currentPage, ['products', 'product-detail']) ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/products.php">NDT Equipment</a>
                    <div class="nav-dropdown">
                        <div class="dropdown-inner">
                            <div class="dropdown-col">
                                <span class="dropdown-label">NDT Technologies</span>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=eddy-current">Eddy Current</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=paut-tofd">PAUT & TOFD</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=mpi">MPI</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=pt-systems">PT Systems</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-col">
                                <span class="dropdown-label">Accessories</span>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=probes-accessories">Probes & Accessories</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=calibration-blocks">Calibration Blocks</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item has-dropdown <?= $currentPage === 'automation' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/automation.php">Automation</a>
                    <div class="nav-dropdown">
                        <div class="dropdown-inner">
                            <div class="dropdown-col">
                                <span class="dropdown-label">Automation Systems</span>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#feeding">Feeding & Handling</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#inspection-machines">Inspection Machines</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#robotics">Robotics & Vision</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-col">
                                <span class="dropdown-label">Control & Data</span>
                                <ul>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#plc-hmi">PLC / HMI</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#data">Data & Traceability</a></li>
                                    <li><a href="<?= BASE_URL ?>/pages/automation.php#complete">Complete Solutions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= $currentPage === 'industries' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/industries.php">Industries</a>
                </li>
                <li class="nav-item <?= $currentPage === 'solutions' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/solutions.php">Solutions</a>
                </li>
                <li class="nav-item <?= $currentPage === 'projects' ? 'active' : '' ?>">
                    <a href="<?= BASE_URL ?>/pages/projects.php">Projects</a>
                </li>
            </ul>
        </nav>

        <a href="<?= BASE_URL ?>/pages/contact.php" class="btn-header-cta magnetic-btn" data-cursor="OPEN">GET A QUOTE</a>

        <button class="mobile-toggle" id="mobileToggle" aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobileMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<div class="mobile-menu" id="mobileMenu" aria-label="Mobile navigation" hidden>
    <div class="mobile-menu-inner">
        <ul class="mobile-nav-list">
            <li><a href="<?= BASE_URL ?>/">Home</a></li>
            <li><a href="<?= BASE_URL ?>/pages/about.php">About</a></li>
            <li class="mobile-nav-group">
                <span class="mobile-nav-label">Used Equipment</span>
                <ul>
                    <li><a href="<?= BASE_URL ?>/used-equipment">All Used Equipment</a></li>
                    <?php foreach (ue_categories() as $ueCat): ?>
                    <li><a href="<?= BASE_URL ?>/used-equipment?cat=<?= e($ueCat['slug']) ?>"><?= e($ueCat['code']) ?> &mdash; <?= e($ueCat['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="mobile-nav-group">
                <span class="mobile-nav-label">NDT Equipment</span>
                <ul>
                    <li><a href="<?= BASE_URL ?>/pages/products.php">All Products</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=eddy-current">Eddy Current</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=paut-tofd">PAUT & TOFD</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=mpi">MPI</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/products.php?cat=pt-systems">PT Systems</a></li>
                </ul>
            </li>
            <li class="mobile-nav-group">
                <span class="mobile-nav-label">Automation</span>
                <ul>
                    <li><a href="<?= BASE_URL ?>/pages/automation.php">Overview</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/automation.php#feeding">Feeding & Handling</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/automation.php#inspection-machines">Inspection Machines</a></li>
                    <li><a href="<?= BASE_URL ?>/pages/automation.php#robotics">Robotics & Vision</a></li>
                </ul>
            </li>
            <li><a href="<?= BASE_URL ?>/pages/industries.php">Industries</a></li>
            <li><a href="<?= BASE_URL ?>/pages/solutions.php">Solutions</a></li>
            <li><a href="<?= BASE_URL ?>/pages/projects.php">Projects</a></li>
            <li><a href="<?= BASE_URL ?>/pages/contact.php" class="mobile-cta">GET A QUOTE</a></li>
        </ul>
    </div>
</div>
