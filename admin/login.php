<?php
require_once __DIR__ . '/inc/bootstrap.php';

if (admin_authed()) {
    header('Location: ' . BASE_URL . '/admin/index.php');
    exit;
}

seed_admin_credentials();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_ok()) {
        $error = 'Security token mismatch. Please try again.';
    } else {
        $user = trim((string)($_POST['username'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');
        if (admin_login($user, $pass)) {
            header('Location: ' . BASE_URL . '/admin/index.php');
            exit;
        }
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — JAGS Technologies</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Inter', sans-serif; background: #0A0E17; color: #e8eef7; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
.box { width: 100%; max-width: 380px; padding: 40px 32px; background: #131B2A; border: 1px solid #1F2A3D; border-radius: 16px; margin: 20px; }
h1 { font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 2px; }
h1 span { color: #00B4D8; }
.sub { font-size: 0.78rem; color: #7d8ea6; margin-bottom: 26px; }
label { display: block; font-size: 0.75rem; font-weight: 600; color: #9fb0c8; margin: 14px 0 5px; }
input { width: 100%; background: #0F1726; border: 1px solid #24344e; color: #e8eef7; border-radius: 8px; padding: 11px 12px; font-size: 0.9rem; }
input:focus { outline: none; border-color: #00B4D8; }
button { width: 100%; margin-top: 24px; padding: 12px; background: #1B5E9E; border: none; border-radius: 8px; color: #fff; font-weight: 700; font-size: 0.9rem; cursor: pointer; }
button:hover { background: #2476c0; }
.err { background: #3b1a1a; border: 1px solid #7f1d1d0500; color: #fca5a5; padding: 10px 12px; border-radius: 8px; font-size: 0.8rem; margin-bottom: 8px; }
.note { background: #0F1726; border: 1px solid #24344e; color: #7dd3fc; padding: 10px 12px; border-radius: 8px; font-size: 0.74rem; margin-top: 18px; line-height: 1.5; }
.back { display: block; text-align: center; margin-top: 16px; font-size: 0.75rem; color: #7d8ea6; text-decoration: none; }
.back:hover { color: #00B4D8; }
</style>
</head>
<body>
<div class="box">
    <h1>JAGS<span>·</span>ADMIN</h1>
    <p class="sub">Sign in to manage the website.</p>

    <?php if ($error !== ''): ?>
        <div class="err"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <?= csrf_field() ?>
        <label>Username</label>
        <input type="text" name="username" required autofocus>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Sign In</button>
    </form>

    <?php if (credentials_are_default()): ?>
        <div class="note">Default login: <strong>admin</strong> / <strong>admin123</strong><br>Change it from <strong>Settings</strong> after signing in.</div>
    <?php endif; ?>

    <a class="back" href="<?= BASE_URL ?>/">← Back to website</a>
</div>
</body>
</html>