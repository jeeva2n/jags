<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'jags_technologies');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', 'http://localhost/n');
define('SITE_NAME', 'JAGS Technologies');
define('SITE_TAGLINE', 'Engineering Precision. Inspection Excellence.');

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

function getSetting($key, $default = '') {
    $db = getDB();
    $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $row = $stmt->fetch();
    return $row ? $row['setting_value'] : $default;
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

function getProduct($slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.slug = ? AND p.is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getCategory($slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM categories WHERE slug = ? AND is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getIndustry($slug) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM industries WHERE slug = ? AND is_active = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function isActivePage($page) {
    $current = basename($_SERVER['PHP_SELF'], '.php');
    return $current === $page ? 'active' : '';
}
