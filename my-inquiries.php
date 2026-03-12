<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Only logged-in users can view their inquiries
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'user') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);

    if ($id && $action === 'reply') {
        $reply = trim($_POST['user_reply'] ?? '');
        if ($reply !== '') {
            try {
                $stmt = $pdo->prepare('SELECT id FROM inquiries WHERE id = ? AND user_id = ?');
                $stmt->execute([$id, $userId]);
                if ($stmt->fetch()) {
                    $pdo->prepare(
                        'INSERT INTO inquiry_replies (inquiry_id, sender_type, sender_id, message) VALUES (?, ?, ?, ?)'
                    )->execute([$id, 'user', $userId, $reply]);
                    $pdo->prepare('UPDATE inquiries SET status = ? WHERE id = ?')->execute(['pending', $id]);
                    $message = 'Your reply has been sent.';
                } else {
                    $error = 'Inquiry not found.';
                }
            } catch (Throwable $e) {
                $error = 'Could not send reply.';
            }
        }
    }
}

// Load user's inquiries (by user_id)
try {
    $stmt = $pdo->prepare(
        "SELECT id, name, email, COALESCE(business_name, subject) AS business_name, es_system, message, status, created_at 
         FROM inquiries WHERE user_id = ? ORDER BY created_at DESC"
    );
    $stmt->execute([$userId]);
    $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $stmt = $pdo->prepare(
        "SELECT id, name, email, subject AS business_name, message, status, created_at 
         FROM inquiries WHERE user_id = ? ORDER BY created_at DESC"
    );
    $stmt->execute([$userId]);
    $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($inquiries as &$i) { $i['es_system'] = ''; }
}

// Load replies
$repliesByInquiry = [];
if (!empty($inquiries)) {
    $ids = array_column($inquiries, 'id');
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT inquiry_id, sender_type, message, created_at FROM inquiry_replies WHERE inquiry_id IN ($placeholders) ORDER BY created_at ASC");
    $stmt->execute($ids);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $repliesByInquiry[$row['inquiry_id']][] = $row;
    }
}

$currentPage = 'my-inquiries';
$pageTitle = 'My Inquiries';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Inquiries – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <style>
        .my-inq-page { max-width: 720px; margin: 0 auto; padding: 2rem 0; }
        .my-inq-page h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .my-inq-page .intro { color: var(--muted); margin-bottom: 1.5rem; }
        .inq-card { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem; }
        .inq-card .meta { font-size: 0.8rem; color: var(--muted); margin-top: 0.3rem; }
        .thread-msg { background: #020617; border-radius: 0.5rem; padding: 0.6rem; margin: 0.4rem 0; border-left: 3px solid #374151; }
        .thread-msg.admin { border-left-color: var(--primary-dark); }
        .thread-msg .who { font-size: 0.75rem; color: var(--muted); margin-bottom: 0.2rem; }
        .status-pending { color: #fbbf24; }
        .status-answered { color: #34d399; }
        .status-resolved { color: #94a3b8; }
        .inq-card textarea { width: 100%; height: 70px; padding: 0.5rem; background: #020617; border: 1px solid #374151; border-radius: 0.5rem; color: #fff; font-size: 0.9rem; margin-top: 0.5rem; }
        .inq-card .reply-form { margin-top: 0.8rem; }
        .page-msg { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 1rem; }
        .page-msg.success { background: #022c22; color: #bbf7d0; }
        .page-msg.error { background: #450a0a; color: #fecaca; }
    </style>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solutions-hero">
        <div class="container">
            <div class="my-inq-page">
                <div class="section-header">
                    <div class="section-label">Support</div>
                    <h1 class="section-title">My Inquiries</h1>
                </div>
                <p class="intro">View all your inquiries and continue the conversation.</p>

                <?php if ($message): ?><div class="page-msg success"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
                <?php if ($error): ?><div class="page-msg error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

                <p><a href="<?php echo $BASE_URL; ?>/inquiry.php" class="link-btn">+ New inquiry</a></p>

                <?php if (empty($inquiries)): ?>
                <p style="color:var(--muted); margin-top:1rem;">You have no inquiries yet. <a href="<?php echo $BASE_URL; ?>/inquiry.php">Send one</a>.</p>
                <?php else: ?>
                <?php foreach ($inquiries as $inq): ?>
                <?php $replies = $repliesByInquiry[$inq['id']] ?? []; ?>
                <div class="inq-card">
                    <div><strong><?php echo htmlspecialchars($inq['business_name'] ?: 'Inquiry'); ?></strong></div>
                    <?php if (!empty($inq['es_system'])): ?>
                    <div class="meta">ES system: <?php echo htmlspecialchars($inq['es_system']); ?></div>
                    <?php endif; ?>
                    <div class="meta"><?php echo htmlspecialchars($inq['created_at']); ?> · <span class="status-<?php echo $inq['status']; ?>"><?php echo htmlspecialchars($inq['status']); ?></span></div>
                    <div class="thread-msg">
                        <div class="who">You · <?php echo htmlspecialchars($inq['created_at']); ?></div>
                        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($inq['message']); ?></div>
                    </div>
                    <?php foreach ($replies as $r): ?>
                    <div class="thread-msg <?php echo $r['sender_type'] === 'admin' ? 'admin' : ''; ?>">
                        <div class="who"><?php echo $r['sender_type'] === 'admin' ? 'Admin' : 'You'; ?> · <?php echo htmlspecialchars($r['created_at']); ?></div>
                        <div style="white-space:pre-wrap;"><?php echo htmlspecialchars($r['message']); ?></div>
                    </div>
                    <?php endforeach; ?>
                    <?php if ($inq['status'] !== 'resolved'): ?>
                    <form method="post" class="reply-form">
                        <input type="hidden" name="action" value="reply">
                        <input type="hidden" name="id" value="<?php echo (int)$inq['id']; ?>">
                        <textarea name="user_reply" placeholder="Add a reply or follow-up question..."></textarea>
                        <button type="submit" class="cta-btn" style="margin-top:0.5rem;">Send reply</button>
                    </form>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
