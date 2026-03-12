<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

// Admin guard
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$adminPage  = 'password_requests';
$adminTitle = 'Password reset requests';

// Handle status changes (mark request as done)
$requestsFlash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action    = $_POST['action'] ?? '';
    $requestId = isset($_POST['request_id']) ? (int) $_POST['request_id'] : 0;

    if ($action === 'mark_done' && $requestId > 0) {
        try {
            $stmt = $pdo->prepare(
                "UPDATE password_reset_requests
                 SET status = 'done', handled_at = NOW()
                 WHERE id = :id"
            );
            $stmt->execute([':id' => $requestId]);
            $requestsFlash = 'Marked request #' . $requestId . ' as completed.';
        } catch (Throwable $e) {
            $requestsFlash = 'Could not update request status. Please check that the password_reset_requests table has a status column.';
        }
    }
}

// Load reset requests, if table exists
$pendingRequests = [];
$doneRequests    = [];
$requestsError   = '';
try {
    // Expect a schema with status and handled_at columns
    $stmt = $pdo->query(
        "SELECT id, email, user_id, requested_at, status, handled_at
         FROM password_reset_requests
         WHERE status = 'pending'
         ORDER BY requested_at DESC
         LIMIT 200"
    );
    $pendingRequests = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

    $stmt = $pdo->query(
        "SELECT id, email, user_id, requested_at, status, handled_at
         FROM password_reset_requests
         WHERE status = 'done'
         ORDER BY handled_at DESC, requested_at DESC
         LIMIT 200"
    );
    $doneRequests = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
} catch (Throwable $e) {
    $requestsError = 'Password reset request log table is missing required columns. See the SQL snippet below to (re)create it with status support.';
}

include __DIR__ . '/header.php';
?>

<style>
    .users-table-wrap { margin-top: 1.2rem; overflow-x: auto; }
    .users-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .users-table th, .users-table td { padding: 0.5rem 0.6rem; border-bottom: 1px solid #1f2937; text-align: left; white-space: nowrap; }
    .users-table th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em; color: var(--muted); }
    @media (max-width: 768px) {
        .users-table th, .users-table td { padding: 0.4rem 0.45rem; }
    }
</style>

<div class="section-header" style="margin-bottom:1.0rem;">
    <h2 class="section-title">Password reset requests</h2>
    <p style="font-size:0.85rem;color:var(--muted);margin-top:0.15rem;">
        View recent "Forgot password" requests made by users. Use the Users page to reset passwords, then mark them as done here.
    </p>
</div>

<?php if ($requestsFlash !== ''): ?>
    <div class="auth-success" style="max-width:520px;margin-bottom:1rem;">
        <?php echo htmlspecialchars($requestsFlash); ?>
    </div>
<?php endif; ?>

<?php if ($requestsError !== ''): ?>
    <div class="auth-error" style="max-width:520px;margin-bottom:1rem;">
        <?php echo htmlspecialchars($requestsError); ?>
    </div>
    <div style="max-width:520px;font-size:0.8rem;color:var(--muted);">
        <p>To enable full tracking of password reset requests with status, create or alter the table using SQL similar to:</p>
        <pre style="background:#020617;border:1px solid #1f2937;border-radius:0.5rem;padding:0.75rem;white-space:pre-wrap;font-size:0.75rem;">
CREATE TABLE password_reset_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    user_id INT UNSIGNED NULL,
    requested_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending','done') NOT NULL DEFAULT 'pending',
    handled_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</pre>
    </div>
<?php else: ?>
    <h3 class="solution-subtitle" style="margin-top:1.5rem;">Pending requests</h3>
    <div class="users-table-wrap">
        <table class="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>User ID</th>
                <th>Requested at</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pendingRequests as $r): ?>
                <tr>
                    <td><?php echo (int) $r['id']; ?></td>
                    <td><?php echo htmlspecialchars($r['email']); ?></td>
                    <td><?php echo $r['user_id'] !== null ? (int) $r['user_id'] : '-'; ?></td>
                    <td><?php echo htmlspecialchars($r['requested_at'] ?? ''); ?></td>
                    <td>Pending</td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="request_id" value="<?php echo (int) $r['id']; ?>">
                            <button type="submit" name="action" value="mark_done" class="cta-btn"
                                    style="padding:0.2rem 0.6rem;font-size:0.75rem;"
                                    onclick="return confirm('Mark this password reset request as completed?');">
                                Mark as done
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$pendingRequests): ?>
                <tr>
                    <td colspan="6" style="color:var(--muted);">No pending password reset requests.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <h3 class="solution-subtitle" style="margin-top:2rem;">Completed requests</h3>
    <div class="users-table-wrap">
        <table class="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>User ID</th>
                <th>Requested at</th>
                <th>Completed at</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($doneRequests as $r): ?>
                <tr>
                    <td><?php echo (int) $r['id']; ?></td>
                    <td><?php echo htmlspecialchars($r['email']); ?></td>
                    <td><?php echo $r['user_id'] !== null ? (int) $r['user_id'] : '-'; ?></td>
                    <td><?php echo htmlspecialchars($r['requested_at'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($r['handled_at'] ?? ''); ?></td>
                    <td>Done</td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$doneRequests): ?>
                <tr>
                    <td colspan="6" style="color:var(--muted);">No completed password reset requests yet.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>

