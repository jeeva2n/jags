<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_auth();

$db = getDB();
$stats = [
    'products'   => $db->query("SELECT COUNT(*) FROM products")->fetchColumn(),
    'categories' => $db->query("SELECT COUNT(*) FROM categories")->fetchColumn(),
    'industries' => $db->query("SELECT COUNT(*) FROM industries")->fetchColumn(),
    'projects'   => $db->query("SELECT COUNT(*) FROM projects")->fetchColumn(),
    'timeline'   => $db->query("SELECT COUNT(*) FROM timeline_stages")->fetchColumn(),
    'enquiries'  => $db->query("SELECT COUNT(*) FROM quote_requests")->fetchColumn(),
];

$recent = $db->query("SELECT * FROM quote_requests ORDER BY created_at DESC LIMIT 8")->fetchAll();

admin_header('Dashboard', 'dashboard');
?>

<h1>Dashboard</h1>
<p class="page-sub">Overview of the JAGS Technologies website content.</p>

<div class="cards">
    <?php foreach ($stats as $label => $count): ?>
    <div class="card">
        <div class="n"><?= (int)$count ?></div>
        <h3><?= ucfirst($label) ?></h3>
        <p><?= in_array($label, ['products', 'categories', 'industries', 'projects', 'timeline', 'enquiries']) ? 'Manage from the menu above.' : '' ?></p>
    </div>
    <?php endforeach; ?>
</div>

<div class="bar">
    <h2 style="font-size: 1rem;">Recent Enquiries</h2>
    <a class="btn gray sm" href="<?= BASE_URL ?>/admin/enquiries.php">View all</a>
</div>

<?php if (count($recent) === 0): ?>
    <div class="panel"><p class="muted">No enquiries yet. They appear here when someone submits the quote request form.</p></div>
<?php else: ?>
<table class="table">
    <thead>
        <tr><th>Name</th><th>Company</th><th>Email</th><th>Technology</th><th>Date</th></tr>
    </thead>
    <tbody>
    <?php foreach ($recent as $enq): ?>
        <tr>
            <td><strong><?= e($enq['name']) ?></strong></td>
            <td><?= e($enq['company'] ?: '—') ?></td>
            <td><?= e($enq['email']) ?></td>
            <td><?= e($enq['ndt_technology'] ?: '—') ?></td>
            <td class="muted"><?= e($enq['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php admin_footer(); ?>