<?php
session_start();
require_once __DIR__ . '/../../includes/config.php';

/* ---------------- Auth ---------------- */

function admin_authed(): bool {
    return isset($_SESSION['admin_id']);
}

function require_auth(): void {
    if (!admin_authed()) {
        header('Location: ' . BASE_URL . '/admin/login.php');
        exit;
    }
}

function seed_admin_credentials(): void {
    $db = getDB();
    if (!getSetting('admin_username') || !getSetting('admin_password_hash')) {
        $stmt = $db->prepare(
            "INSERT INTO site_settings (setting_key, setting_value) VALUES
             ('admin_username', 'admin'),
             ('admin_password_hash', ?)
             ON DUPLICATE KEY UPDATE setting_key = setting_key"
        );
        $stmt->execute([password_hash('admin123', PASSWORD_DEFAULT)]);
    }
}

function credentials_are_default(): bool {
    return getSetting('admin_username') === 'admin'
        && password_verify('admin123', getSetting('admin_password_hash'));
}

function admin_login(string $user, string $pass): bool {
    $username = getSetting('admin_username');
    $hash     = getSetting('admin_password_hash');
    if ($username !== '' && $pass !== '' && hash_equals((string)$username, $user) && password_verify($pass, (string)$hash)) {
        session_regenerate_id(true);
        $_SESSION['admin_id']    = 1;
        $_SESSION['admin_user']  = $user;
        return true;
    }
    return false;
}

function admin_current_user(): string {
    return $_SESSION['admin_user'] ?? '';
}

/* ---------------- CSRF ---------------- */

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function csrf_ok(): bool {
    $token = $_POST['csrf'] ?? $_GET['csrf'] ?? '';
    return $token !== '' && isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

/* ---------------- Flash ---------------- */

function set_flash(string $msg): void {
    $_SESSION['flash'] = $msg;
}

function get_flash(): string {
    $msg = $_SESSION['flash'] ?? '';
    unset($_SESSION['flash']);
    return $msg;
}

/* ---------------- Helpers ---------------- */

function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
    $text = trim($text, '-');
    return $text !== '' ? $text : 'item';
}

function opt_rows(string $table, string $label_field = 'name', string $order = 'name'): array {
    $db = getDB();
    $stmt = $db->query("SELECT id, $label_field FROM $table ORDER BY $order");
    $out = [];
    foreach ($stmt->fetchAll() as $row) {
        $out[$row['id']] = $row[$label_field];
    }
    return $out;
}

function upload_image(string $fileKey): array {
    if (empty($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => true, 'path' => ''];
    }
    if ($_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'error' => 'Upload failed (error code ' . $_FILES[$fileKey]['error'] . ').'];
    }
    if ($_FILES[$fileKey]['size'] > 2 * 1024 * 1024) {
        return ['ok' => false, 'error' => 'Image must be under 2MB.'];
    }
    $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
        return ['ok' => false, 'error' => 'Only JPG, PNG, WEBP or GIF images allowed.'];
    }
    $dir = __DIR__ . '/../../assets/uploads';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $filename = date('Ymd') . '-' . bin2hex(random_bytes(6)) . '.' . $ext;
    if (!move_uploaded_file($_FILES[$fileKey]['tmp_name'], $dir . '/' . $filename)) {
        return ['ok' => false, 'error' => 'Could not save the uploaded file.'];
    }
    return ['ok' => true, 'path' => 'assets/uploads/' . $filename];
}

function badge(bool $on): string {
    return $on
        ? '<span class="badge badge-on">Active</span>'
        : '<span class="badge badge-off">Inactive</span>';
}

/* ---------------- Entity definitions ---------------- */

function entity_specs(): array {
    $cats = opt_rows('categories');
    $catTypes = [
        'ndt'        => 'NDT Technology',
        'automation' => 'Automation',
    ];
    return [
        'products' => [
            'table'      => 'products',
            'title'      => 'Products',
            'singular'   => 'Product',
            'title_field'=> 'name',
            'orderby'    => 'sort_order ASC, id DESC',
            'columns'    => ['name' => 'Name', 'category_id' => 'Category', 'technology' => 'Technology', 'image' => 'Image', 'is_active' => 'Status'],
            'fields'     => [
                'name'             => ['label' => 'Product Name', 'type' => 'text', 'required' => true],
                'slug'             => ['label' => 'Slug', 'type' => 'text', 'hint' => 'Leave blank to auto-generate from the name.'],
                'category_id'      => ['label' => 'Category', 'type' => 'select', 'options' => $cats, 'empty' => '— None —'],
                'technology'       => ['label' => 'Technology', 'type' => 'text'],
                'short_description'=> ['label' => 'Short Description', 'type' => 'textarea'],
                'description'      => ['label' => 'Full Description', 'type' => 'textarea'],
                'applications'     => ['label' => 'Applications', 'type' => 'textarea'],
                'features'         => ['label' => 'Features', 'type' => 'textarea'],
                'image'            => ['label' => 'Image', 'type' => 'image'],
                'is_active'        => ['label' => 'Visible on site', 'type' => 'checkbox', 'default' => 1],
                'sort_order'       => ['label' => 'Sort Order', 'type' => 'number'],
            ],
        ],
        'categories' => [
            'table'      => 'categories',
            'title'      => 'Categories',
            'singular'   => 'Category',
            'title_field'=> 'name',
            'orderby'    => 'type ASC, sort_order ASC',
            'columns'    => ['name' => 'Name', 'type' => 'Type', 'slug' => 'Slug', 'is_active' => 'Status'],
            'fields'     => [
                'name'        => ['label' => 'Category Name', 'type' => 'text', 'required' => true],
                'slug'        => ['label' => 'Slug', 'type' => 'text', 'hint' => 'Leave blank to auto-generate from the name.'],
                'type'        => ['label' => 'Group', 'type' => 'select', 'options' => $catTypes, 'required' => true],
                'parent_id'   => ['label' => 'Parent Category', 'type' => 'select', 'options' => $cats, 'empty' => '— None (top level) —'],
                'description' => ['label' => 'Description', 'type' => 'textarea'],
                'image'       => ['label' => 'Image', 'type' => 'image'],
                'is_active'   => ['label' => 'Visible on site', 'type' => 'checkbox', 'default' => 1],
                'sort_order'  => ['label' => 'Sort Order', 'type' => 'number'],
            ],
        ],
        'industries' => [
            'table'      => 'industries',
            'title'      => 'Industries',
            'singular'   => 'Industry',
            'title_field'=> 'name',
            'orderby'    => 'sort_order ASC',
            'columns'    => ['name' => 'Name', 'slug' => 'Slug', 'image' => 'Image', 'is_active' => 'Status'],
            'fields'     => [
                'name'        => ['label' => 'Industry Name', 'type' => 'text', 'required' => true],
                'slug'        => ['label' => 'Slug', 'type' => 'text', 'hint' => 'Leave blank to auto-generate from the name.'],
                'description' => ['label' => 'Description', 'type' => 'textarea'],
                'solutions'   => ['label' => 'Solutions', 'type' => 'textarea', 'hint' => 'Comma-separated list.'],
                'image'       => ['label' => 'Image', 'type' => 'image'],
                'is_active'   => ['label' => 'Visible on site', 'type' => 'checkbox', 'default' => 1],
                'sort_order'  => ['label' => 'Sort Order', 'type' => 'number'],
            ],
        ],
        'projects' => [
            'table'      => 'projects',
            'title'      => 'Projects',
            'singular'   => 'Project',
            'title_field'=> 'title',
            'orderby'    => 'sort_order DESC, id DESC',
            'columns'    => ['title' => 'Title', 'industry' => 'Industry', 'image' => 'Image', 'is_active' => 'Status'],
            'fields'     => [
                'title'       => ['label' => 'Project Title', 'type' => 'text', 'required' => true],
                'slug'        => ['label' => 'Slug', 'type' => 'text', 'hint' => 'Leave blank to auto-generate from the title.'],
                'industry'    => ['label' => 'Industry', 'type' => 'text'],
                'solution'    => ['label' => 'Solution', 'type' => 'textarea'],
                'description' => ['label' => 'Description', 'type' => 'textarea'],
                'image'       => ['label' => 'Image', 'type' => 'image'],
                'is_active'   => ['label' => 'Visible on site', 'type' => 'checkbox', 'default' => 1],
                'sort_order'  => ['label' => 'Sort Order', 'type' => 'number'],
            ],
        ],
        'timeline' => [
            'table'      => 'timeline_stages',
            'title'      => 'Workflow Stages',
            'singular'   => 'Stage',
            'title_field'=> 'title',
            'orderby'    => 'sort_order ASC',
            'columns'    => ['step_number' => 'Step', 'title' => 'Title', 'is_active' => 'Status'],
            'fields'     => [
                'step_number' => ['label' => 'Step Number', 'type' => 'number'],
                'title'       => ['label' => 'Stage Title', 'type' => 'text', 'required' => true],
                'description' => ['label' => 'Description', 'type' => 'textarea'],
                'image'       => ['label' => 'Image', 'type' => 'image'],
                'is_active'   => ['label' => 'Visible on site', 'type' => 'checkbox', 'default' => 1],
                'sort_order'  => ['label' => 'Sort Order', 'type' => 'number'],
            ],
        ],
    ];
}

function entity_spec(string $key): ?array {
    $specs = entity_specs();
    return $specs[$key] ?? null;
}

/* ---------------- Generic CRUD actions ---------------- */

function handle_entity_save(string $key, array $spec): void {
    if (empty($_POST['save'])) return;

    if (!csrf_ok()) {
        set_flash('Security token mismatch. Please try again.');
        header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($key));
        exit;
    }

    $db      = getDB();
    $id      = (int)($_POST['id'] ?? 0);
    $cols    = [];
    $vals    = [];
    $hasSlug = false;

    foreach ($spec['fields'] as $fkey => $fdef) {
        if ($fkey === 'slug') $hasSlug = true;

        if ($fdef['type'] === 'checkbox') {
            $cols[] = $fkey;
            $vals[] = isset($_POST[$fkey]) ? 1 : 0;
            continue;
        }
        if ($fdef['type'] === 'image') {
            $cols[] = $fkey;
            $vals[] = trim((string)($_POST[$fkey] ?? ''));
            continue;
        }
        if (isset($_POST[$fkey])) {
            $val = trim((string)$_POST[$fkey]);
            if (($fdef['type'] === 'select' || $fdef['type'] === 'number') && $val === '') {
                $val = null;
            }
            $cols[] = $fkey;
            $vals[] = $val;
        }
    }

    // file upload overrides the image field value
    if (isset($_POST['has_image_field'])) {
        foreach ($spec['fields'] as $fkey => $fdef) {
            if ($fdef['type'] === 'image') {
                $up = upload_image('image_file');
                if (!$up['ok']) {
                    set_flash('Image error: ' . $up['error']);
                    header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($key) . ($id ? '&id=' . $id : ''));
                    exit;
                }
                if ($up['path'] !== '') {
                    $idx = array_search($fkey, $cols, true);
                    $vals[$idx] = $up['path'];
                }
            }
        }
    }

    if ($hasSlug) {
        $titleKey = $spec['title_field'];
        $slug     = trim((string)($_POST['slug'] ?? ''));
        if ($slug === '') {
            $slug = slugify((string)($_POST[$titleKey] ?? ''));
        } else {
            $slug = slugify($slug);
        }
        $base = $slug;
        for ($i = 2; $i < 500; $i++) {
            $stmt = $db->prepare("SELECT id FROM {$spec['table']} WHERE slug = ? AND id != ? LIMIT 1");
            $stmt->execute([$slug, $id]);
            if (!$stmt->fetch()) break;
            $slug = $base . '-' . $i;
        }
        $idx = array_search('slug', $cols, true);
        $vals[$idx] = $slug;
    }

    if ($id) {
        $sql = "UPDATE {$spec['table']} SET " . implode(', ', array_map(fn($c) => "`$c` = ?", $cols)) . " WHERE id = ?";
        $params = $vals;
        $params[] = $id;
        $db->prepare($sql)->execute($params);
        set_flash($spec['singular'] . ' updated.');
    } else {
        $sql = "INSERT INTO {$spec['table']} (" . implode(', ', array_map(fn($c) => "`$c`", $cols)) . ") VALUES (" . implode(', ', array_fill(0, count($cols), '?')) . ")";
        $db->prepare($sql)->execute($vals);
        set_flash($spec['singular'] . ' created.');
    }

    header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($key));
    exit;
}

function handle_entity_action(string $key, array $spec): void {
    if (empty($_GET['do'])) return;

    if (!csrf_ok()) {
        set_flash('Security token mismatch.');
        header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($key));
        exit;
    }

    $db = getDB();
    $id = (int)($_GET['id'] ?? 0);
    $do = $_GET['do'];

    if ($do === 'delete') {
        $db->prepare("DELETE FROM {$spec['table']} WHERE id = ?")->execute([$id]);
        set_flash($spec['singular'] . ' deleted.');
    } elseif ($do === 'toggle') {
        $db->prepare("UPDATE {$spec['table']} SET is_active = 1 - is_active WHERE id = ?")->execute([$id]);
        set_flash('Status toggled.');
    }

    header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($key));
    exit;
}

function field_display_value(array $spec, string $col, $value): string {
    if ($value === null || $value === '') return '<span class="muted">—</span>';
    if ($col === 'is_active') return badge((bool)$value);
    if ($col === 'image') return '<img class="thumb" src="' . BASE_URL . '/' . e($value) . '" alt="">';
    $def = $spec['fields'][$col] ?? null;
    if ($def && $def['type'] === 'select' && !empty($def['options'])) {
        return e((string)($def['options'][$value] ?? $value));
    }
    $text = (string)$value;
    return e(mb_strlen($text) > 60 ? mb_substr($text, 0, 60) . '…' : $text);
}

/* ---------------- Layout ---------------- */

const ADMIN_NAV = [
    'dashboard'  => ['Dashboard', '/admin/index.php'],
    'products'   => ['Products', '/admin/entity.php?t=products'],
    'categories' => ['Categories', '/admin/entity.php?t=categories'],
    'industries' => ['Industries', '/admin/entity.php?t=industries'],
    'projects'   => ['Projects', '/admin/entity.php?t=projects'],
    'timeline'   => ['Workflow', '/admin/entity.php?t=timeline'],
    'enquiries'  => ['Enquiries', '/admin/enquiries.php'],
    'settings'   => ['Settings', '/admin/settings.php'],
];

function admin_header(string $title, string $active = ''): void {
    seed_admin_credentials();
    $nav = ADMIN_NAV;
    $flash = get_flash();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title) ?> — JAGS Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Inter', sans-serif; background: #0A0E17; color: #e8eef7; font-size: 14px; }
.topbar { background: #131B2A; border-bottom: 1px solid #1F2A3D; padding: 0 28px; position: sticky; top: 0; z-index: 50; display: flex; align-items: center; justify-content: space-between; height: 60px; }
.brand { font-weight: 800; font-size: 1.05rem; color: #fff; }
.brand span { color: #00B4D8; }
nav.tabs { display: flex; align-items: center; gap: 4px; height: 60px; overflow-x: auto; }
nav.tabs a { color: #9fb0c8; text-decoration: none; font-size: 0.82rem; font-weight: 600; padding: 8px 12px; border-radius: 6px; white-space: nowrap; }
nav.tabs a:hover { color: #00B4D8; }
nav.tabs a.active { background: #1B5E9E; color: #fff; }
nav.tabs a.site, .top-right a { background: #1F2A3D; color: #cfe1f5; }
.top-right { display: flex; align-items: center; gap: 10px; font-size: 0.75rem; color: #9fb0c8; }
.top-right a { text-decoration: none; padding: 6px 12px; border-radius: 6px; font-weight: 600; }
.wrap { max-width: 1200px; margin: 0 auto; padding: 32px 28px 60px; }
h1 { font-size: 1.35rem; font-weight: 800; margin-bottom: 4px; }
.page-sub { color: #9fb0c8; margin-bottom: 26px; font-size: 0.85rem; }
.flash { background: #0F3D6E; border: 1px solid #1B5E9E; color: #dbeafe; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
.flash.ok { background: #0d2f1c; border-color: #15803d; color: #bbf7d0; }
.cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 16px; margin-bottom: 30px; }
.card { background: #131B2A; border: 1px solid #1F2A3D; border-radius: 12px; padding: 20px; }
.card .n { font-size: 2rem; font-weight: 800; color: #00B4D8; }
.card h3 { font-size: 0.85rem; font-weight: 600; color: #cfe1f5; margin: 4px 0 2px; }
.card p { font-size: 0.72rem; color: #7d8ea6; }
.table { width: 100%; border-collapse: collapse; background: #131B2A; border: 1px solid #1F2A3D; border-radius: 12px; overflow: hidden; }
.table th { text-align: left; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; color: #7d8ea6; padding: 12px 14px; border-bottom: 1px solid #1F2A3D; }
.table td { padding: 12px 14px; border-bottom: 1px solid #161f30; vertical-align: middle; }
.table tr:last-child td { border-bottom: none; }
.table a { color: #00B4D8; text-decoration: none; font-weight: 600; }
.table a.danger { color: #f87171; }
.table .thumb { width: 54px; height: 40px; object-fit: cover; border-radius: 6px; display: block; }
.badge { font-size: 0.68rem; font-weight: 700; padding: 3px 8px; border-radius: 20px; }
.badge-on { background: #0d2f1c; color: #4ade80; }
.badge-off { background: #3b1a1a; color: #f87171; }
.msgbadge { background: #1b3a5e; color: #7dd3fc; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
.btn { display: inline-block; padding: 10px 18px; border: none; border-radius: 8px; font-weight: 700; font-size: 0.82rem; cursor: pointer; text-decoration: none; background: #1B5E9E; color: #fff; }
.btn:hover { background: #2476c0; }
.btn.sm { padding: 6px 12px; font-size: 0.74rem; }
.btn.gray { background: #1F2A3D; color: #cfe1f5; }
.btn.danger { background: #7f1d1d; color: #fecaca; }
.btn-line { background: transparent; border: 1px solid #2a3a55; color: #9fb0c8; }
.bar { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 16px; flex-wrap: wrap; }
.panel { background: #131B2A; border: 1px solid #1F2A3D; border-radius: 12px; padding: 24px; }
.panel h2 { font-size: 1rem; margin-bottom: 18px; color: #cfe1f5; }
label { display: block; font-size: 0.76rem; font-weight: 600; color: #9fb0c8; margin: 14px 0 5px; }
label .req { color: #f87171; }
input[type=text], input[type=number], input[type=password], textarea, select { width: 100%; background: #0F1726; border: 1px solid #24344e; color: #e8eef7; border-radius: 8px; padding: 10px 12px; font-size: 0.85rem; font-family: inherit; }
input:focus, textarea:focus, select:focus { outline: none; border-color: #00B4D8; }
textarea { min-height: 90px; resize: vertical; }
.hint { font-size: 0.7rem; color: #7d8ea6; margin-top: 4px; }
.check { display: flex; align-items: center; gap: 8px; margin: 16px 0 0; }
.check input { width: auto; }
.check label { margin: 0; }
.grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0 20px; }
.imgprev { margin-top: 8px; }
.imgprev img { max-width: 160px; max-height: 110px; border-radius: 8px; border: 1px solid #24344e; }
.actions-row { margin-top: 22px; display: flex; gap: 10px; }
.muted { color: #7d8ea6; }
.inline-form { display: inline; }
.pager { color: #7d8ea6; font-size: 0.75rem; margin-top: 10px; }
@media (max-width: 768px) { .grid2 { grid-template-columns: 1fr; } .topbar { padding: 0 14px; } .wrap { padding: 20px 14px 50px; } nav.tabs a { padding: 7px 9px; } }
</style>
</head>
<body>
<div class="topbar">
    <div class="brand">JAGS<span>·</span>ADMIN</div>
    <nav class="tabs">
        <?php foreach ($nav as $id => $item): ?>
            <a href="<?= BASE_URL . $item[1] ?>" class="<?= $active === $id ? 'active' : '' ?>"><?= e($item[0]) ?></a>
        <?php endforeach; ?>
        <a class="site" href="<?= BASE_URL ?>/">View Site</a>
    </nav>
    <div class="top-right">
        <span><?= e(admin_current_user()) ?></span>
        <a href="<?= BASE_URL ?>/admin/logout.php">Logout</a>
    </div>
</div>
<div class="wrap">
<?php if ($flash !== ''): ?>
    <div class="flash"><?= e($flash) ?></div>
<?php endif; ?>
    <?php
}

function admin_footer(): void {
    echo "</div></body></html>";
}