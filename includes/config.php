<?php
/*
 * Environment-driven configuration.
 *
 * For production, set the following environment variables (or export them in
 * your hosting control panel / .env loader) so no secret or domain is
 * hard-coded in this file:
 *
 *   APP_BASE_URL  e.g. https://www.your-domain.com   (no trailing slash)
 *   APP_ENV       development | production            (optional, auto-detected)
 *   DB_HOST, DB_NAME, DB_USER, DB_PASS                (database credentials)
 */
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'jags_technologies');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

if (getenv('APP_BASE_URL')) {
    define('BASE_URL', rtrim(getenv('APP_BASE_URL'), '/'));
} elseif (!empty($_SERVER['HTTP_HOST'])) {
    // Development / LAN preview: derive the base URL from the request host so
    // the site works from any device on the network, e.g. http://192.168.0.119/n.
    // Production always sets APP_BASE_URL, so this path only runs locally.
    $__scheme = is_request_secure() ? 'https' : 'http';
    $__host   = (string)$_SERVER['HTTP_HOST'];
    $__doc    = rtrim(str_replace('\\', '/', (string)($_SERVER['DOCUMENT_ROOT'] ?? '')), '/');
    $__app    = str_replace('\\', '/', (string)realpath(__DIR__ . '/..'));
    $__path   = ($__doc !== '' && $__app !== '' && strpos($__app, $__doc) === 0)
        ? substr($__app, strlen($__doc))
        : '';
    define('BASE_URL', $__scheme . '://' . $__host . $__path);
    unset($__scheme, $__host, $__doc, $__app, $__path);
} else {
    define('BASE_URL', 'http://localhost/n');
}
define('SITE_NAME', 'JAGS Technologies');
define('SITE_TAGLINE', 'Engineering Precision. Inspection Excellence.');

function is_request_secure(): bool {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }
    return (int)($_SERVER['SERVER_PORT'] ?? 0) === 443;
}

$__appEnv = getenv('APP_ENV');
if ($__appEnv === false || $__appEnv === '') {
    $__appHost = (string)parse_url(BASE_URL, PHP_URL_HOST);
    $__appEnv  = (in_array($__appHost, ['localhost', '127.0.0.1'], true) || str_ends_with($__appHost, '.local'))
        ? 'development'
        : 'production';
}
define('APP_ENV', $__appEnv);
unset($__appEnv, $__appHost);

/* ---------------- Security headers ---------------- */
if (!headers_sent()) {
    header_remove('X-Powered-By');

    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header(
        "Content-Security-Policy: default-src 'self'; " .
        "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com; " .
        "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
        "font-src 'self' https://fonts.gstatic.com data:; " .
        "img-src 'self' data:; " .
        "frame-src https://www.google.com https://maps.google.com; " .
        "connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'"
    );

    if (is_request_secure()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

/* ---------------- Session cookie hardening ---------------- */
if (function_exists('session_status') && session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => is_request_secure(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

/* ---------------- Canonical URL helper ---------------- */
function canonical_url(): string {
    $path    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
    $baseUrl = parse_url(BASE_URL, PHP_URL_PATH) ?: '/';
    $rel     = ($baseUrl !== '/' && $baseUrl !== '' && strpos($path, $baseUrl) === 0)
        ? substr($path, strlen($baseUrl))
        : $path;
    if ($rel === '' ) $rel = '/';

    if (preg_match('#^/used-equipment/([a-z0-9\-]+)/?$#', $rel, $m)) {
        return BASE_URL . '/used-equipment/' . $m[1];
    }
    if ($rel === '/used-equipment' || $rel === '/used-equipment/') {
        return BASE_URL . '/used-equipment';
    }
    if ($rel === '/' || $rel === '/index.php') {
        return BASE_URL . '/';
    }
    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    if ($script !== '') {
        $srel = ($baseUrl !== '/' && $baseUrl !== '' && strpos($script, $baseUrl) === 0)
            ? substr($script, strlen($baseUrl))
            : $script;
        // Product detail pages differ by slug: each must self-canonicalise to
        // its own URL so sitemap.xml and canonical stay in sync. Only the slug
        // parameter is preserved; filters/tracking parameters are never added.
        if (preg_match('#/pages/product-detail\.php$#i', $srel)) {
            $slug = (string)($_GET['slug'] ?? '');
            if ($slug !== '' && preg_match('/^[a-z0-9][a-z0-9\-]{0,99}$/i', $slug)) {
                return BASE_URL . '/pages/product-detail.php?slug=' . rawurlencode($slug);
            }
            return BASE_URL . '/pages/product-detail.php';
        }
        return BASE_URL . $srel;
    }
    return BASE_URL . $rel;
}

function placeholder_img(): string {
    return BASE_URL . '/assets/images/placeholder.png';
}

function default_og_image(): string {
    return BASE_URL . '/assets/images/jags-og.png';
}

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die('Database connection failed. Please run database/setup.sql first.');
        }
    }
    return $pdo;
}

function getSetting(string $key, string $default = '') {
    $db = getDB();
    $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $row = $stmt->fetch();
    $value = $row ? $row['setting_value'] : '';
    return ($value === '' || $value === null) ? $default : $value;
}

function image_uri(?string $dbPath, string $fallback = '') {
    if (!empty($dbPath)) {
        return BASE_URL . '/' . ltrim($dbPath, '/');
    }
    return $fallback;
}

function getCategories($type = null) {
    $db = getDB();
    if ($type) {
        $stmt = $db->prepare("SELECT * FROM categories WHERE type = ? AND is_active = 1 ORDER BY sort_order");
        $stmt->execute([$type]);
    } else {
        $stmt = $db->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY type, sort_order");
    }
    return $stmt->fetchAll();
}

function getProducts($categoryId = null, $limit = null) {
    $db = getDB();
    $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_active = 1";
    $params = [];
    if ($categoryId) {
        $sql .= " AND p.category_id = ?";
        $params[] = $categoryId;
    }
    $sql .= " ORDER BY p.sort_order, p.created_at DESC";
    if ($limit) {
        $sql .= " LIMIT " . (int)$limit;
    }
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getIndustries() {
    $db = getDB();
    return $db->query("SELECT * FROM industries WHERE is_active = 1 ORDER BY sort_order")->fetchAll();
}

function getProjects($limit = null) {
    $db = getDB();
    $sql = "SELECT * FROM projects WHERE is_active = 1 ORDER BY sort_order DESC, created_at DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return $db->query($sql)->fetchAll();
}

function getTimelineStages() {
    $db = getDB();
    return $db->query("SELECT * FROM timeline_stages WHERE is_active = 1 ORDER BY sort_order")->fetchAll();
}

function getProduct(string $slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.slug = ? AND p.is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getCategory(string $slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM categories WHERE slug = ? AND is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getIndustry(string $slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM industries WHERE slug = ? AND is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function seo_product_meta(?array $p): string {
    $name = trim((string)($p['name'] ?? ''));
    $cat  = trim((string)($p['category_name'] ?? ''));
    $body = trim((string)($p['short_description'] ?? ''));
    if ($body === '') {
        $body = trim((string)($p['description'] ?? ''));
    }
    $body = preg_replace('/\s+/u', ' ', $body);
    $meta = $name !== '' ? $name . ' — ' . $body : $body;
    if (trim($meta, ' —') === '') {
        $meta = ($name !== '' ? $name : 'NDT equipment') . ' by JAGS Technologies' . ($cat !== '' ? ' — ' . $cat : '');
    }
    $limit = function_exists('mb_strlen');
    if ($limit && mb_strlen($meta) > 158) {
        $meta = mb_substr($meta, 0, 155);
        if (preg_match('/^(.*?)\s\S*$/u', $meta, $m)) { $meta = $m[1]; }
        $meta = rtrim($meta, ' ,;—·') . '…';
    } elseif (!$limit && strlen($meta) > 158) {
        $meta = substr($meta, 0, 155);
        if (preg_match('/^(.*?)\s\S*$/', $meta, $m)) { $meta = $m[1]; }
        $meta = rtrim($meta, ' ,;—·') . '…';
    }
    return $meta;
}

function e(?string $str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function isActivePage(string $page) {
    $current = basename($_SERVER['PHP_SELF'], '.php');
    return $current === $page ? 'active' : '';
}

require_once __DIR__ . '/used-equipment.php';
