<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_auth();

$db = getDB();
$keys = ['company_name', 'tagline', 'address', 'phone', 'email', 'website', 'meta_description'];
$defaults = [
    'company_name'     => 'JAGS Technologies',
    'tagline'          => 'Engineering Precision. Inspection Excellence.',
    'address'          => 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058',
    'phone'            => '+91 94443 76041',
    'email'            => 'info@jags.com',
    'website'          => 'https://jags.com',
    'meta_description' => 'JAGS Technologies - Advanced NDT Equipment & Industrial Automation Solutions',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    if (!csrf_ok()) {
        set_flash('Security token mismatch.');
    } else {
        $stmt = $db->prepare(
            "INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?)
             ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)"
        );
        foreach ($keys as $k) {
            $stmt->execute([$k, trim((string)($_POST[$k] ?? ''))]);
        }
        set_flash('Settings saved.');
        header('Location: ' . BASE_URL . '/admin/settings.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    if (!csrf_ok()) {
        set_flash('Security token mismatch.');
    } else {
        $current = (string)($_POST['current_password'] ?? '');
        $newPass = (string)($_POST['new_password'] ?? '');
        if (!password_verify($current, (string)getSetting('admin_password_hash'))) {
            set_flash('Current password is incorrect.');
        } elseif (strlen($newPass) < 6) {
            set_flash('New password must be at least 6 characters.');
        } elseif ($newPass === $current) {
            set_flash('New password must be different from the current one.');
        } else {
            $db->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = 'admin_password_hash'")
               ->execute([password_hash($newPass, PASSWORD_DEFAULT)]);
            set_flash('Password changed successfully.');
        }
        header('Location: ' . BASE_URL . '/admin/settings.php');
        exit;
    }
}

admin_header('Settings', 'settings');
?>
<h1>Site Settings</h1>
<p class="page-sub">Contact details shown on the website and footer.</p>

<form method="post" action="">
    <?= csrf_field() ?>
    <div class="panel">
        <h2>Company Information</h2>
        <div class="grid2">
            <div>
                <label>Company Name</label>
                <input type="text" name="company_name" value="<?= e(getSetting('company_name', $defaults['company_name'])) ?>">
            </div>
            <div>
                <label>Tagline</label>
                <input type="text" name="tagline" value="<?= e(getSetting('tagline', $defaults['tagline'])) ?>">
            </div>
        </div>
        <label>Address</label>
        <textarea name="address"><?= e(getSetting('address', $defaults['address'])) ?></textarea>
        <div class="grid2">
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="<?= e(getSetting('phone', $defaults['phone'])) ?>">
            </div>
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?= e(getSetting('email', $defaults['email'])) ?>">
            </div>
        </div>
        <div class="grid2">
            <div>
                <label>Website URL</label>
                <input type="text" name="website" value="<?= e(getSetting('website', $defaults['website'])) ?>">
            </div>
            <div>
                <label>Meta Description (SEO)</label>
                <textarea name="meta_description" style="min-height:60px;"><?= e(getSetting('meta_description', $defaults['meta_description'])) ?></textarea>
            </div>
        </div>
    </div>
    <div class="actions-row">
        <button class="btn" type="submit" name="save_settings" value="1">Save Settings</button>
    </div>
</form>

<form method="post" action="" style="margin-top:34px;">
    <?= csrf_field() ?>
    <div class="panel">
        <h2>Change Admin Password</h2>
        <div class="grid2">
            <div>
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div>
                <label>New Password (min 6 chars)</label>
                <input type="password" name="new_password" required>
            </div>
        </div>
        <?php if (credentials_are_default()): ?>
            <div class="hint">You are still using the default password <strong>admin123</strong> — change it to secure the admin panel.</div>
        <?php endif; ?>
    </div>
    <div class="actions-row">
        <button class="btn gray" type="submit" name="change_password" value="1">Change Password</button>
    </div>
</form>

<?php admin_footer(); ?>