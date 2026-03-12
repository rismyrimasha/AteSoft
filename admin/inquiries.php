<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);

    if ($id && $action === 'reply') {
        $reply = trim($_POST['admin_reply'] ?? '');
        if ($reply !== '') {
            try {
                $pdo->prepare(
                    'INSERT INTO inquiry_replies (inquiry_id, sender_type, sender_id, message) VALUES (?, ?, ?, ?)'
                )->execute([$id, 'admin', (int)$_SESSION['user_id'], $reply]);
                $pdo->prepare('UPDATE inquiries SET status = ? WHERE id = ?')->execute(['answered', $id]);
                $message = 'Reply saved.';
            } catch (Throwable $e) {
                $error = 'Could not save reply.';
            }
        }
    } elseif ($id && $action === 'resolve') {
        try {
            $pdo->prepare('UPDATE inquiries SET status = ? WHERE id = ?')->execute(['resolved', $id]);
            $message = 'Inquiry marked as resolved.';
        } catch (Throwable $e) {
            $error = 'Could not update status.';
        }
    }
}

// Load inquiries (new schema: business_name, es_system, user_id; fallback to subject if needed)
try {
    $stmt = $pdo->query("SELECT id, name, email, COALESCE(business_name, subject) AS business_name, es_system, message, status, user_id, created_at FROM inquiries WHERE status IN ('pending', 'answered') ORDER BY created_at DESC");
    $inquiriesActive = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $stmt = $pdo->query("SELECT id, name, email, subject AS business_name, message, status, created_at FROM inquiries WHERE status IN ('pending', 'answered') ORDER BY created_at DESC");
    $inquiriesActive = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($inquiriesActive as &$i) { $i['es_system'] = ''; $i['user_id'] = null; }
}
try {
    $stmt = $pdo->query("SELECT id, name, email, COALESCE(business_name, subject) AS business_name, es_system, message, status, user_id, created_at FROM inquiries WHERE status = 'resolved' ORDER BY created_at DESC");
    $inquiriesResolved = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $stmt = $pdo->query("SELECT id, name, email, subject AS business_name, message, status, created_at FROM inquiries WHERE status = 'resolved' ORDER BY created_at DESC");
    $inquiriesResolved = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($inquiriesResolved as &$i) { $i['es_system'] = ''; $i['user_id'] = null; }
}

// Load replies for all inquiry IDs
$allIds = array_merge(array_column($inquiriesActive, 'id'), array_column($inquiriesResolved, 'id'));
$repliesByInquiry = [];
if (!empty($allIds)) {
    $placeholders = implode(',', array_fill(0, count($allIds), '?'));
    $stmt = $pdo->prepare("SELECT inquiry_id, sender_type, message, created_at FROM inquiry_replies WHERE inquiry_id IN ($placeholders) ORDER BY created_at ASC");
    $stmt->execute($allIds);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $repliesByInquiry[$row['inquiry_id']][] = $row;
    }
}

$adminPage = 'inquiries';
$adminTitle = 'Inquiries';
include __DIR__ . '/header.php';
?>
<style>
    .admin-msg { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .admin-msg.success { background: #022c22; color: #bbf7d0; }
    .admin-msg.error { background: #450a0a; color: #fecaca; }
    .inquiry-admin { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .inquiry-admin .meta { font-size: 0.8rem; color: var(--muted); margin-top: 0.3rem; }
    .inquiry-admin .reply-box { margin-top: 0.8rem; }
    .inquiry-admin textarea { width: 100%; height: 80px; padding: 0.5rem; background: #020617; border: 1px solid #374151; border-radius: 0.5rem; color: #fff; font-size: 0.9rem; }
    .inquiry-admin .actions { margin-top: 0.8rem; display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .status-pending { color: #fbbf24; }
    .status-answered { color: #34d399; }
    .status-resolved { color: #94a3b8; }
    .thread-msg { background: #020617; border-radius: 0.5rem; padding: 0.6rem; margin: 0.4rem 0; border-left: 3px solid #374151; }
    .thread-msg.admin { border-left-color: var(--primary-dark); }
    .thread-msg .who { font-size: 0.75rem; color: var(--muted); margin-bottom: 0.2rem; }
    .inq-section { margin-bottom: 2rem; }
    .inq-section h3 { font-size: 1.1rem; margin-bottom: 1rem; }
</style>
<div class="section-header" style="margin-bottom:1.5rem;">
    <h2 class="section-title">Inquiries</h2>
</div>
<?php if ($message): ?><div class="admin-msg success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<?php if ($error): ?><div class="admin-msg error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

<div class="inq-section">
    <h3>Active</h3>
<?php if (empty($inquiriesActive)): ?>
<p style="color:var(--muted);">No active inquiries.</p>
<?php else: ?>
<?php foreach ($inquiriesActive as $inq): ?>
<?php $replies = $repliesByInquiry[$inq['id']] ?? []; ?>
<div class="inquiry-admin">
    <div><strong><?php echo htmlspecialchars($inq['name']); ?></strong> &lt;<?php echo htmlspecialchars($inq['email']); ?>&gt;</div>
    <?php if (!empty($inq['business_name'])): ?>
    <div class="meta"><strong>Business:</strong> <?php echo htmlspecialchars($inq['business_name']); ?></div>
    <?php endif; ?>
    <?php if (!empty($inq['es_system'])): ?>
    <div class="meta"><strong>ES system:</strong> <?php echo htmlspecialchars($inq['es_system']); ?></div>
    <?php endif; ?>
    <div class="thread-msg">
        <div class="who">Customer · <?php echo htmlspecialchars($inq['created_at']); ?></div>
        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($inq['message']); ?></div>
    </div>
    <?php foreach ($replies as $r): ?>
    <div class="thread-msg <?php echo $r['sender_type'] === 'admin' ? 'admin' : ''; ?>">
        <div class="who"><?php echo $r['sender_type'] === 'admin' ? 'Admin' : 'Customer'; ?> · <?php echo htmlspecialchars($r['created_at']); ?></div>
        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($r['message']); ?></div>
    </div>
    <?php endforeach; ?>
    <div class="meta"><span class="status-<?php echo $inq['status']; ?>"><?php echo htmlspecialchars($inq['status']); ?></span></div>
    <form method="post" class="reply-box">
        <input type="hidden" name="action" value="reply">
        <input type="hidden" name="id" value="<?php echo (int)$inq['id']; ?>">
        <label>
            <textarea name="admin_reply" placeholder="Your reply..."></textarea>
        </label>
        <div class="actions">
            <button type="submit" class="cta-btn">Send reply</button>
        </div>
    </form>
    <form method="post" style="margin-top:0.5rem;">
        <input type="hidden" name="action" value="resolve">
        <input type="hidden" name="id" value="<?php echo (int)$inq['id']; ?>">
        <button type="submit" class="cta-btn" style="background:#374151;">Mark resolved</button>
    </form>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<div class="inq-section">
    <h3>Resolved</h3>
<?php if (empty($inquiriesResolved)): ?>
<p style="color:var(--muted);">No resolved inquiries.</p>
<?php else: ?>
<?php foreach ($inquiriesResolved as $inq): ?>
<?php $replies = $repliesByInquiry[$inq['id']] ?? []; ?>
<div class="inquiry-admin" style="opacity:0.9;">
    <div><strong><?php echo htmlspecialchars($inq['name']); ?></strong> &lt;<?php echo htmlspecialchars($inq['email']); ?>&gt;</div>
    <?php if (!empty($inq['business_name'])): ?>
    <div class="meta"><strong>Business:</strong> <?php echo htmlspecialchars($inq['business_name']); ?></div>
    <?php endif; ?>
    <div class="thread-msg">
        <div class="who">Customer · <?php echo htmlspecialchars($inq['created_at']); ?></div>
        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($inq['message']); ?></div>
    </div>
    <?php foreach ($replies as $r): ?>
    <div class="thread-msg <?php echo $r['sender_type'] === 'admin' ? 'admin' : ''; ?>">
        <div class="who"><?php echo $r['sender_type'] === 'admin' ? 'Admin' : 'Customer'; ?> · <?php echo htmlspecialchars($r['created_at']); ?></div>
        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($r['message']); ?></div>
    </div>
    <?php endforeach; ?>
    <div class="meta"><span class="status-resolved">resolved</span></div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php include __DIR__ . '/footer.php'; ?>
