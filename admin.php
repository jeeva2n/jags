<?php
require_once __DIR__ . '/includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAGS Technologies — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f5f5; color: #333; }
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        h1 { font-size: 1.5rem; margin-bottom: 8px; }
        .subtitle { color: #666; margin-bottom: 32px; }
        .admin-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .admin-card { background: white; border-radius: 10px; padding: 28px; border: 1px solid #e5e5e5; text-decoration: none; color: inherit; transition: all 0.2s; }
        .admin-card:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
        .admin-card h3 { font-size: 1rem; margin-bottom: 8px; }
        .admin-card p { font-size: 0.8rem; color: #666; }
        .admin-card .count { font-size: 2rem; font-weight: 700; color: #1B5E9E; }
        .actions { margin-top: 32px; }
        .actions a { display: inline-block; margin-right: 12px; padding: 10px 20px; background: #1B5E9E; color: white; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; }
        .actions a:hover { background: #0F3D6E; }
        .actions a.secondary { background: #333; }
        .enquiry-list { margin-top: 32px; }
        .enquiry-item { background: white; border-radius: 10px; padding: 20px; border: 1px solid #e5e5e5; margin-bottom: 12px; }
        .enquiry-item h4 { font-size: 0.9rem; margin-bottom: 4px; }
        .enquiry-item .meta { font-size: 0.75rem; color: #999; margin-bottom: 8px; }
        .enquiry-item .msg { font-size: 0.85rem; color: #555; }
    </style>
</head>
<body>
<div class="admin-container">
    <h1>JAGS Technologies — Admin Panel</h1>
    <p class="subtitle">Manage products, enquiries and content.</p>

    <?php
    $db = getDB();
    $catCount = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    $prodCount = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $indCount = $db->query("SELECT COUNT(*) FROM industries")->fetchColumn();
    $projCount = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    $enqCount = $db->query("SELECT COUNT(*) FROM quote_requests")->fetchColumn();
    $timelineCount = $db->query("SELECT COUNT(*) FROM timeline_stages")->fetchColumn();
    ?>

    <div class="admin-grid">
        <div class="admin-card">
            <div class="count"><?= $catCount ?></div>
            <h3>Categories</h3>
            <p>NDT & automation categories</p>
        </div>
        <div class="admin-card">
            <div class="count"><?= $prodCount ?></div>
            <h3>Products</h3>
            <p>NDT products & equipment</p>
        </div>
        <div class="admin-card">
            <div class="count"><?= $indCount ?></div>
            <h3>Industries</h3>
            <p>Industry sectors served</p>
        </div>
        <div class="admin-card">
            <div class="count"><?= $projCount ?></div>
            <h3>Projects</h3>
            <p>Completed projects</p>
        </div>
        <div class="admin-card">
            <div class="count"><?= $timelineCount ?></div>
            <h3>Workflow Steps</h3>
            <p>10-step engineering workflow</p>
        </div>
        <div class="admin-card">
            <div class="count"><?= $enqCount ?></div>
            <h3>Enquiries</h3>
            <p>Quote requests received</p>
        </div>
    </div>

    <div class="actions">
        <a href="#">Add Product</a>
        <a href="#">Add Project</a>
        <a href="#" class="secondary">View Site</a>
    </div>

    <?php if ($enqCount > 0): ?>
    <h2 style="margin-top: 48px; font-size: 1.2rem;">Recent Enquiries</h2>
    <div class="enquiry-list">
        <?php
        $enquiries = $db->query("SELECT * FROM quote_requests ORDER BY created_at DESC LIMIT 10")->fetchAll();
        foreach ($enquiries as $enq):
        ?>
        <div class="enquiry-item">
            <h4><?= htmlspecialchars($enq['name']) ?> — <?= htmlspecialchars($enq['company'] ?: 'N/A') ?></h4>
            <div class="meta"><?= htmlspecialchars($enq['email']) ?> | <?= htmlspecialchars($enq['industry'] ?: 'N/A') ?> | <?= htmlspecialchars($enq['ndt_technology'] ?: 'N/A') ?> | <?= $enq['created_at'] ?></div>
            <div class="msg"><?= nl2br(htmlspecialchars($enq['message'])) ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
