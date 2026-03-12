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

    if ($id && $action === 'delete') {
        try {
            $pdo->prepare('DELETE FROM testimonials WHERE id = ?')->execute([$id]);
            $message = 'Testimonial deleted.';
        } catch (Throwable $e) {
            $error = 'Could not delete.';
        }
    } elseif ($id && $action === 'reply') {
        $reply = trim($_POST['admin_reply'] ?? '');
        if ($reply !== '') {
            try {
                $pdo->prepare('UPDATE testimonials SET admin_reply = ?, admin_reply_at = NOW() WHERE id = ?')->execute([$reply, $id]);
                $message = 'Reply saved.';
            } catch (Throwable $e) {
                $error = 'Could not save reply.';
            }
        }
    } elseif ($id && $action === 'approve') {
        try {
            $pdo->prepare('UPDATE testimonials SET status = ? WHERE id = ?')->execute(['approved', $id]);
            $message = 'Testimonial approved.';
        } catch (Throwable $e) {
            $error = 'Could not update.';
        }
    }
}

try {
    $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, status, admin_reply, admin_reply_at, created_at FROM testimonials ORDER BY created_at DESC");
    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $stmt = $pdo->query("SELECT id, name, company, sector, solution, quote, rating, admin_reply, admin_reply_at, created_at FROM testimonials ORDER BY created_at DESC");
    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($testimonials as &$t) $t['status'] = 'approved';
}

$adminPage = 'testimonials';
$adminTitle = 'Testimonials';
include __DIR__ . '/header.php';
?>
<style>
    .admin-msg { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 1rem; }
    .admin-msg.success { background: #022c22; color: #bbf7d0; }
    .admin-msg.error { background: #450a0a; color: #fecaca; }
    .testimonial-admin { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
    .testimonial-admin .meta { font-size: 0.8rem; color: var(--muted); margin-top: 0.3rem; }
    .testimonial-admin .reply-box { margin-top: 0.8rem; }
    .testimonial-admin textarea { width: 100%; height: 80px; padding: 0.5rem; background: #020617; border: 1px solid #374151; border-radius: 0.5rem; color: #fff; font-size: 0.9rem; }
    .testimonial-admin .actions { margin-top: 0.8rem; display: flex; gap: 0.5rem; flex-wrap: wrap; }
    .testimonial-admin .actions button, .testimonial-admin .actions input[type="submit"] { padding: 0.35rem 0.7rem; font-size: 0.85rem; }
</style>
<div class="section-header" style="margin-bottom:1.5rem;">
    <h2 class="section-title">Testimonials</h2>
</div>
<?php if ($message): ?><div class="admin-msg success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
<?php if ($error): ?><div class="admin-msg error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

<?php foreach ($testimonials as $t): ?>
<div class="testimonial-admin">
    <p class="testimonial-quote">"<?php echo htmlspecialchars($t['quote']); ?>"</p>
    <div class="meta">
        <?php echo htmlspecialchars($t['company']); ?> · <?php echo htmlspecialchars($t['sector']); ?> · <?php echo htmlspecialchars($t['solution']); ?>
        <?php if (!empty($t['rating'])): ?> · <?php echo (int)$t['rating']; ?>★<?php endif; ?>
        · <?php echo htmlspecialchars($t['created_at']); ?>
        <?php if (!empty($t['status'])): ?> · <span class="badge"><?php echo htmlspecialchars($t['status']); ?></span><?php endif; ?>
    </div>
    <?php if (!empty($t['admin_reply'])): ?>
    <div class="meta" style="margin-top:0.5rem;"><strong>Your reply:</strong> <?php echo htmlspecialchars($t['admin_reply']); ?></div>
    <?php endif; ?>
    <form method="post" class="reply-box">
        <input type="hidden" name="action" value="reply">
        <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
        <label>
            <textarea name="admin_reply" placeholder="Reply to this testimonial..."><?php echo htmlspecialchars($t['admin_reply'] ?? ''); ?></textarea>
        </label>
        <div class="actions">
            <button type="submit" class="cta-btn">Save reply</button>
            <?php if (!empty($t['status']) && $t['status'] === 'pending'): ?>
            <button type="submit" name="action" value="approve" class="cta-btn">Approve</button>
            <?php endif; ?>
            <button type="submit" name="action" value="delete" onclick="return confirm('Delete this testimonial?');">Delete</button>
        </div>
    </form>
</div>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>
