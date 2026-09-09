<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_auth();

$t = $_GET['t'] ?? '';
$spec = entity_spec($t);
if (!$spec) {
    header('Location: ' . BASE_URL . '/admin/index.php');
    exit;
}

handle_entity_save($t, $spec);
handle_entity_action($t, $spec);

$id    = (int)($_GET['id'] ?? 0);
$mode  = 'list';
$row   = null;

if (isset($_GET['new'])) {
    $mode = 'form';
    $row  = [];
    foreach ($spec['fields'] as $fkey => $fdef) {
        $row[$fkey] = $fdef['default'] ?? '';
    }
} elseif ($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM {$spec['table']} WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row) {
        header('Location: ' . BASE_URL . '/admin/entity.php?t=' . urlencode($t));
        exit;
    }
    $mode = 'form';
}

/* ---------- LIST ---------- */
if ($mode === 'list') {
    $db  = getDB();
    $rows = $db->query("SELECT * FROM {$spec['table']} ORDER BY " . $spec['orderby'])->fetchAll();
    $csrf = csrf_token();

    admin_header($spec['title'], $t === 'timeline' ? 'timeline' : $t);
    ?>
    <h1><?= e($spec['title']) ?></h1>
    <p class="page-sub"><?= count($rows) ?> record(s). Add, edit, reorder or remove content.</p>

    <div class="bar">
        <h2 style="font-size:1rem;"></h2>
        <a class="btn" href="?t=<?= urlencode($t) ?>&new=1">+ Add <?= e($spec['singular']) ?></a>
    </div>

    <?php if (count($rows) === 0): ?>
        <div class="panel"><p class="muted">No <?= strtolower($spec['title']) ?> yet. Click "Add <?= e($spec['singular']) ?>" to create the first one.</p></div>
    <?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <?php foreach ($spec['columns'] as $col => $label): ?>
                    <th><?= e($label) ?></th>
                <?php endforeach; ?>
                <th style="width:190px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <?php foreach ($spec['columns'] as $col => $label): ?>
                    <td><?= field_display_value($spec, $col, $r[$col]) ?></td>
                <?php endforeach; ?>
                <td>
                    <a href="?t=<?= urlencode($t) ?>&id=<?= (int)$r['id'] ?>">Edit</a>
                    &nbsp;
                    <a href="?t=<?= urlencode($t) ?>&do=toggle&id=<?= (int)$r['id'] ?>&csrf=<?= $csrf ?>">Toggle</a>
                    &nbsp;
                    <a class="danger" href="?t=<?= urlencode($t) ?>&do=delete&id=<?= (int)$r['id'] ?>&csrf=<?= $csrf ?>"
                       onclick="return confirm('Delete this <?= e(strtolower($spec['singular'])) ?>?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif;

    admin_footer();
    exit;
}

/* ---------- FORM ---------- */
$displayColumns = ['name', 'title', 'category_id', 'technology', 'type', 'parent_id', 'industry', 'step_number', 'slug'];
$cs = csrf_token();
$isEdit = $id > 0;
$titleFieldVal = $row[$spec['title_field']] ?? '';

admin_header(($isEdit ? 'Edit ' : 'Add ') . $spec['singular'], $t === 'timeline' ? 'timeline' : $t);
?>
<h1><?= $isEdit ? 'Edit ' : 'Add ' ?><?= e($spec['singular']) ?></h1>
<p class="page-sub">
    <?= $isEdit ? 'Editing "' . e($titleFieldVal) . '".' : 'Fill in the details below.' ?>
    <a href="?t=<?= urlencode($t) ?>" style="color:#00B4D8;">← Back to list</a>
</p>

<form method="post" action="?t=<?= urlencode($t) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int)$id ?>">
    <input type="hidden" name="has_image_field" value="1">

    <div class="panel">
        <div class="grid2">
        <?php foreach ($spec['fields'] as $fkey => $fdef): ?>
            <?php if (in_array($fdef['type'], ['textarea', 'image', 'checkbox'], true)) continue; ?>
            <div>
                <label><?= e($fdef['label']) ?><?= !empty($fdef['required']) ? ' <span class="req">*</span>' : '' ?></label>
                <?php if ($fdef['type'] === 'select'): ?>
                    <select name="<?= e($fkey) ?>">
                        <?php if (isset($fdef['empty'])): ?>
                            <option value=""><?= e($fdef['empty']) ?></option>
                        <?php endif; ?>
                        <?php foreach ($fdef['options'] as $optVal => $optLabel): ?>
                            <option value="<?= e((string)$optVal) ?>" <?= (string)($row[$fkey] ?? '') === (string)$optVal ? 'selected' : '' ?>><?= e($optLabel) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php elseif ($fdef['type'] === 'number'): ?>
                    <input type="number" name="<?= e($fkey) ?>" value="<?= e((string)($row[$fkey] ?? '')) ?>">
                <?php else: ?>
                    <input type="text" name="<?= e($fkey) ?>" value="<?= e((string)($row[$fkey] ?? '')) ?>" <?= !empty($fdef['required']) ? 'required' : '' ?>>
                <?php endif; ?>
                <?php if (!empty($fdef['hint'])): ?>
                    <div class="hint"><?= e($fdef['hint']) ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        </div>

        <?php foreach ($spec['fields'] as $fkey => $fdef): ?>
            <?php if ($fdef['type'] === 'textarea'): ?>
                <label><?= e($fdef['label']) ?></label>
                <textarea name="<?= e($fkey) ?>"><?= e((string)($row[$fkey] ?? '')) ?></textarea>
                <?php if (!empty($fdef['hint'])): ?><div class="hint"><?= e($fdef['hint']) ?></div><?php endif; ?>
            <?php elseif ($fdef['type'] === 'image'): ?>
                <label><?= e($fdef['label']) ?></label>
                <input type="text" name="<?= e($fkey) ?>" value="<?= e((string)($row[$fkey] ?? '')) ?>" placeholder="Path (e.g. assets/uploads/photo.webp)">
                <label style="font-weight:500;">…or upload a new file</label>
                <input type="file" name="image_file" accept="image/*">
                <?php if (!empty($row[$fkey])): ?>
                    <div class="imgprev"><img src="<?= BASE_URL ?>/<?= e($row[$fkey]) ?>" alt=""></div>
                <?php endif; ?>
            <?php elseif ($fdef['type'] === 'checkbox'): ?>
                <div class="check">
                    <input type="checkbox" name="<?= e($fkey) ?>" value="1" id="fld_<?= e($fkey) ?>" <?= !empty($row[$fkey]) ? 'checked' : '' ?>>
                    <label for="fld_<?= e($fkey) ?>"><?= e($fdef['label']) ?></label>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="actions-row">
        <button class="btn" type="submit" name="save" value="1"><?= $isEdit ? 'Save Changes' : 'Create ' . e($spec['singular']) ?></button>
        <a class="btn gray" href="?t=<?= urlencode($t) ?>">Cancel</a>
    </div>
</form>

<?php admin_footer(); ?>