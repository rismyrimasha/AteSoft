<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

// Admin guard
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

// Flash messages for admin actions (status / password reset)
$usersFlashSuccess = '';
$usersFlashError   = '';
// Track which user we are resetting the password for (to show a form)
$resetUserId       = 0;
$resetUserEmail    = '';

// Handle admin actions: activate/deactivate users and password reset (best-effort)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;

    // Prevent admins from accidentally changing their own status via this screen
    $isSelf = $userId === (int) ($_SESSION['user_id'] ?? 0);

    if ($userId > 0) {
        if (in_array($action, ['activate', 'deactivate'], true) && !$isSelf) {
            $newStatus = $action === 'activate' ? 'active' : 'inactive';
            try {
                $stmt = $pdo->prepare('UPDATE users SET status = :status WHERE id = :id');
                $stmt->execute([':status' => $newStatus, ':id' => $userId]);
                $usersFlashSuccess = 'User status updated.';
            } catch (Throwable $e) {
                $usersFlashError = 'Could not update user status. Please try again.';
            }
        } elseif ($action === 'reset_password') {
            // Admin-initiated password reset for a user
            $newPassword     = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($newPassword === '' && $confirmPassword === '') {
                // First click on "Reset password" button: show the reset form for this user
                $resetUserId = $userId;
                try {
                    $stmt = $pdo->prepare('SELECT email FROM users WHERE id = :id LIMIT 1');
                    $stmt->execute([':id' => $userId]);
                    $resetUserEmail = (string) ($stmt->fetchColumn() ?: '');
                } catch (Throwable $e) {
                    $resetUserEmail = '';
                }
            } elseif ($newPassword === '' || $confirmPassword === '') {
                $usersFlashError = 'Please enter and confirm the new password.';
                $resetUserId     = $userId;
            } elseif (strlen($newPassword) < 8) {
                $usersFlashError = 'New password must be at least 8 characters long.';
                $resetUserId     = $userId;
            } elseif ($newPassword !== $confirmPassword) {
                $usersFlashError = 'New password and confirmation do not match.';
                $resetUserId     = $userId;
            } else {
                try {
                    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare('UPDATE users SET password_hash = :hash WHERE id = :id');
                    $stmt->execute([':hash' => $hash, ':id' => $userId]);
                    $usersFlashSuccess = 'Password has been reset for the selected user.';
                } catch (Throwable $e) {
                    $usersFlashError = 'Could not reset the password. Please try again.';
                    $resetUserId     = $userId;
                }
            }
        }
    }
}

// High-level stats about users
$stats = [
    'total'     => 0,
    'active'    => 0,
    'inactive'  => 0,
    'admins'    => 0,
    'end_users' => 0,
];

try {
    $stats['total'] = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
} catch (Throwable $e) {}
try {
    $stats['active'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'active'")->fetchColumn();
} catch (Throwable $e) {}
try {
    $stats['inactive'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE status = 'inactive'")->fetchColumn();
} catch (Throwable $e) {}
try {
    $stats['admins'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
} catch (Throwable $e) {}
try {
    $stats['end_users'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
} catch (Throwable $e) {}

// Load users list with last login (fallback if column is missing)
$users = [];
try {
    $stmt = $pdo->query(
        'SELECT id, name, email, role, status, created_at, updated_at, last_login
         FROM users
         ORDER BY created_at DESC'
    );
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
} catch (Throwable $e) {
    try {
        $stmt = $pdo->query(
            'SELECT id, name, email, role, status, created_at, updated_at, NULL AS last_login
             FROM users
             ORDER BY created_at DESC'
        );
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (Throwable $e2) {
        $users = [];
    }
}

$adminPage  = 'users';
$adminTitle = 'Users';
include __DIR__ . '/header.php';
?>
<style>
    .users-stats { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .users-stat-card { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.75rem; padding: 0.9rem; }
    .users-stat-card .num { font-size: 1.4rem; font-weight: 600; color: var(--primary-dark); }
    .users-stat-card .label { font-size: 0.8rem; color: var(--muted); margin-top: 0.2rem; }
    .users-table-wrap { margin-top: 1.75rem; overflow-x: auto; }
    .users-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .users-table th, .users-table td { padding: 0.5rem 0.6rem; border-bottom: 1px solid #1f2937; text-align: left; white-space: nowrap; }
    .users-table th { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.04em; color: var(--muted); }
    .badge-role { display: inline-block; padding: 0.1rem 0.4rem; border-radius: 999px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.04em; }
    .badge-role-admin { background: rgba(220, 38, 38, 0.1); color: #fecaca; }
    .badge-role-user { background: rgba(37, 99, 235, 0.1); color: #bfdbfe; }
    .badge-status { display: inline-block; padding: 0.1rem 0.45rem; border-radius: 999px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.04em; }
    .badge-status-active { background: rgba(22, 163, 74, 0.12); color: #bbf7d0; }
    .badge-status-inactive { background: rgba(148, 163, 184, 0.12); color: #e5e7eb; }
    @media (max-width: 768px) {
        .users-table th, .users-table td { padding: 0.4rem 0.45rem; }
    }
</style>

<div class="section-header" style="margin-bottom:1.4rem;">
    <h2 class="section-title">Users</h2>
    <p style="font-size:0.85rem;color:var(--muted);margin-top:0.15rem;">
        Track all registered users and admins, their status and their last login.
    </p>
</div>

<?php if ($usersFlashSuccess !== ''): ?>
    <div class="auth-success" style="max-width:480px;margin-bottom:1rem;">
        <?php echo htmlspecialchars($usersFlashSuccess); ?>
    </div>
<?php elseif ($usersFlashError !== '' && $resetUserId === 0): ?>
    <div class="auth-error" style="max-width:480px;margin-bottom:1rem;">
        <?php echo htmlspecialchars($usersFlashError); ?>
    </div>
<?php endif; ?>

<div class="users-stats">
    <div class="users-stat-card">
        <div class="num"><?php echo $stats['total']; ?></div>
        <div class="label">Total users</div>
    </div>
    <div class="users-stat-card">
        <div class="num"><?php echo $stats['active']; ?></div>
        <div class="label">Active</div>
    </div>
    <div class="users-stat-card">
        <div class="num"><?php echo $stats['inactive']; ?></div>
        <div class="label">Inactive</div>
    </div>
    <div class="users-stat-card">
        <div class="num"><?php echo $stats['end_users']; ?></div>
        <div class="label">End users</div>
    </div>
    <div class="users-stat-card">
        <div class="num"><?php echo $stats['admins']; ?></div>
        <div class="label">Admins</div>
    </div>
</div>

<div class="users-table-wrap">
    <table class="users-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Last login</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?php echo (int) $u['id']; ?></td>
                <td><?php echo htmlspecialchars($u['name']); ?></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td>
                    <?php if ($u['role'] === 'admin'): ?>
                        <span class="badge-role badge-role-admin">Admin</span>
                    <?php else: ?>
                        <span class="badge-role badge-role-user">User</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($u['status'] === 'active'): ?>
                        <span class="badge-status badge-status-active">Active</span>
                    <?php else: ?>
                        <span class="badge-status badge-status-inactive">Inactive</span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($u['created_at'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($u['last_login'] ?? ''); ?></td>
                <td>
                    <?php if ((int) $u['id'] !== (int) ($_SESSION['user_id'] ?? 0)): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo (int) $u['id']; ?>">
                            <?php if ($u['status'] === 'active'): ?>
                                <button type="submit" name="action" value="deactivate" class="cta-btn" style="padding:0.2rem 0.6rem;font-size:0.75rem;background:#b91c1c;"
                                        onclick="return confirm('Deactivate this user? They will no longer be able to log in.');">
                                    Deactivate
                                </button>
                            <?php else: ?>
                                <button type="submit" name="action" value="activate" class="cta-btn" style="padding:0.2rem 0.6rem;font-size:0.75rem;">
                                    Activate
                                </button>
                            <?php endif; ?>
                        </form>
                        <form method="post" style="display:inline;margin-left:0.3rem;">
                            <input type="hidden" name="user_id" value="<?php echo (int) $u['id']; ?>">
                            <input type="hidden" name="action" value="reset_password">
                            <button type="submit" class="cta-btn" style="padding:0.2rem 0.6rem;font-size:0.75rem;background:#1d4ed8;"
                                    onclick="return confirm('Reset this user\\'s password? You will set a new password on the next screen.');">
                                Reset password
                            </button>
                        </form>
                    <?php else: ?>
                        <span style="font-size:0.75rem;color:var(--muted);">You</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$users): ?>
            <tr>
                <td colspan="8" style="color:var(--muted);">No users found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if ($resetUserId > 0): ?>
    <section class="auth-card" style="max-width:480px;margin-top:1.5rem;">
        <h2 style="font-size:0.95rem;margin-bottom:0.4rem;">Reset password</h2>
        <p style="font-size:0.8rem;color:var(--muted);margin-bottom:0.7rem;">
            Set a new password for user ID <?php echo (int) $resetUserId; ?>
            <?php if ($resetUserEmail !== ''): ?>
                (<?php echo htmlspecialchars($resetUserEmail); ?>)
            <?php endif; ?>.
        </p>
        <?php if ($usersFlashError !== ''): ?>
            <div class="auth-error" style="margin-bottom:0.7rem;">
                <?php echo htmlspecialchars($usersFlashError); ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <input type="hidden" name="user_id" value="<?php echo (int) $resetUserId; ?>">
            <input type="hidden" name="action" value="reset_password">
            <div class="auth-field">
                <label for="reset-new-password">New password (min 8 characters)</label>
                <input type="password" id="reset-new-password" name="new_password" required minlength="8">
            </div>
            <div class="auth-field">
                <label for="reset-confirm-password">Confirm new password</label>
                <input type="password" id="reset-confirm-password" name="confirm_password" required minlength="8">
            </div>
            <div class="auth-submit">
                <button type="submit" class="cta-btn" style="width:auto;padding:0.3rem 0.9rem;">
                    Save new password
                </button>
            </div>
        </form>
    </section>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>

