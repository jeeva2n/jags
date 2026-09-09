<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_auth();

$db = getDB();

if (($_GET['do'] ?? '') === 'delete' && isset($_GET['id'])) {
    if (!csrf_ok()) {
        set_flash('Security token mismatch.');
    } else {
        $db->prepare("DELETE FROM quote_requests WHERE id = ?")->execute([(int)$_GET['id']]);
        set_flash('Enquiry deleted.');
    }
    header('Location: ' . BASE_URL . '/admin/enquiries.php');
    exit;
}

$enquiries = $db->query("SELECT * FROM quote_requests ORDER BY created_at DESC")->fetchAll();

admin_header('Enquiries', 'enquiries');
?>
<h1>Enquiries</h1>
<p class="page-sub">Quote requests submitted through the website.</p>

<?php if (count($enquiries) === 0): ?>
    <div class="panel"><p class="muted">No enquiries received yet.</p></div>
<?php else: ?>
<table class="table">
    <thead>
        <tr><th>Name</th><th>Company</th><th>Contact</th><th>Details</th><th>Date</th><th></th></tr>
    </thead>
    <tbody>
    <?php foreach ($enquiries as $enq): ?>
        <tr>
            <td><strong><?= e($enq['name']) ?></strong></td>
            <td><?= e($enq['company'] ?: '—') ?></td>
            <td>
                <?= e($enq['email']) ?><br>
                <span class="muted"><?= e($enq['phone'] ?: '—') ?></span>
            </td>
            <td>
                <?php
                $rows = [
                    'Industry'   => $enq['industry'],
                    'Technology' => $enq['ndt_technology'],
                    'Requirement'=> $enq['requirement_type'],
                ];
                foreach ($rows as $k => $v):
                    if ($v !== '' && $v !== null): ?>
                        <span class="msgbadge"><?= e($k) ?>: <?= e($v) ?></span>
                    <?php endif;
                endforeach;
                if (!empty($enq['message'])): ?>
                    <div class="muted" style="margin-top:6px; font-size:0.78rem;"><?= nl2br(e($enq['message'])) ?></div>
                <?php endif;
                if (!empty($enq['specification_file'])): ?>
                    <div style="margin-top:6px;"><a href="<?= BASE_URL ?>/<?= e($enq['specification_file']) ?>" target="_blank">
                        Attachment: <?= e(basename($enq['specification_file'])) ?>
                    </a></div>
                <?php endif; ?>
            </td>
            <td class="muted" style="white-space:nowrap;"><?= e($enq['created_at']) ?></td>
            <td>
                <a class="danger" href="?do=delete&id=<?= (int)$enq['id'] ?>&csrf=<?= csrf_token() ?>"
                   onclick="return confirm('Delete this enquiry from <?= e(addslashes($enq['name'])) ?>?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php admin_footer(); ?>