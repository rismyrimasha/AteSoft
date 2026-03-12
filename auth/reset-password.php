<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

$token   = $_GET['token'] ?? '';
$error   = '';
$success = false;
$userRow = null;

function find_reset_user(PDO $pdo, string $token)
{
    if ($token === '') {
        return null;
    }
    $stmt = $pdo->prepare(
        'SELECT pr.id, pr.user_id, pr.expires_at, u.email, u.name
         FROM password_resets pr
         JOIN users u ON pr.user_id = u.id
         WHERE pr.token = :token AND pr.expires_at > NOW()
         LIMIT 1'
    );
    $stmt->execute([':token' => $token]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token    = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    $userRow = find_reset_user($pdo, $token);
    if (!$userRow) {
        $error = 'This password reset link is invalid or has expired.';
    } elseif ($password === '' || $confirm === '') {
        $error = 'Please fill in both password fields.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('UPDATE users SET password_hash = :hash WHERE id = :id');
            $stmt->execute([':hash' => $hash, ':id' => (int)$userRow['user_id']]);

            $stmt = $pdo->prepare('DELETE FROM password_resets WHERE user_id = :id');
            $stmt->execute([':id' => (int)$userRow['user_id']]);
            $pdo->commit();

            $success = true;
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $error = 'Could not reset password. Please try again.';
        }
    }
} else {
    $userRow = find_reset_user($pdo, $token);
    if (!$userRow) {
        $error = 'This password reset link is invalid or has expired.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset password – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .auth-wrapper { min-height: 100vh; display: flex; flex-direction: column; }
        .auth-main { flex: 1; padding: 3.5rem 0; }
        .auth-layout { max-width: 520px; margin: 0 auto; }
        .auth-card {
            background: #020617;
            border-radius: 1rem;
            border: 1px solid #1f2937;
            padding: 1.6rem 1.5rem 1.8rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            max-width: 420px;
            margin: 0 auto;
        }
        .auth-card h2 { font-size: 1.1rem; margin-bottom: 0.8rem; }
        .auth-card p { font-size: 0.85rem; color: var(--muted); margin-bottom: 1.2rem; }
        .auth-field { margin-bottom: 0.9rem; }
        .auth-field label { display: block; font-size: 0.8rem; margin-bottom: 0.25rem; color: var(--muted); }
        .auth-field input {
            width: 100%; padding: 0.45rem 0.7rem; border-radius: 0.4rem;
            border: 1px solid #374151; background: #020617; color: var(--text); font-size: 0.9rem;
        }
        .auth-field input:focus { outline: none; border-color: var(--primary-dark); }
        .auth-submit { margin-top: 0.3rem; }
        .auth-submit button { width: 100%; }
        .auth-error, .auth-success {
            margin-bottom: 1rem; padding: 0.6rem 0.8rem; border-radius: 0.5rem; font-size: 0.85rem;
        }
        .auth-error { background: #451a1a; border: 1px solid #b91c1c; color: #fee2e2; }
        .auth-success { background: #14532d; border: 1px solid #166534; color: #dcfce7; }
        @media (max-width: 900px) {
            .auth-layout { max-width: 100%; padding: 0 1rem; }
            .auth-card { max-width: 100%; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <?php include __DIR__ . '/../header.php'; ?>

    <main class="auth-main">
        <div class="container">
            <div class="auth-layout">
                <div class="section-header">
                    <div class="section-label">Password</div>
                    <h2 class="section-title">Reset your password</h2>
                </div>

                <?php if ($success): ?>
                    <div class="auth-success">
                        Your password has been reset successfully. You can now
                        <a href="login.php" style="color: var(--primary-dark);">log in</a>.
                    </div>
                <?php elseif ($error !== '' && !$userRow): ?>
                    <div class="auth-error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$success && $userRow): ?>
                <section class="auth-card">
                    <h2>Choose a new password</h2>
                    <p>Set a new password for the account <?php echo htmlspecialchars($userRow['email']); ?>.</p>
                    <?php if ($error !== '' && $userRow): ?>
                        <div class="auth-error">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="reset-password.php">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                        <div class="auth-field">
                            <label for="rp-password">New password</label>
                            <input type="password" id="rp-password" name="password" required minlength="8"
                                   placeholder="At least 8 characters">
                        </div>
                        <div class="auth-field">
                            <label for="rp-confirm">Confirm new password</label>
                            <input type="password" id="rp-confirm" name="confirm_password" required minlength="8">
                        </div>
                        <div class="auth-submit">
                            <button type="submit" class="cta-btn">Update password</button>
                        </div>
                    </form>
                </section>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../footer.php'; ?>
</div>
</body>
</html>

