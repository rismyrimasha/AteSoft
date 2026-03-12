<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/mail.php';
session_start();

$error = '';
$sent  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // In this simplified flow we do not send an email directly.
        // Admins will handle password resets manually and can view requests in the admin area.
        try {
            // Optional: look up user so admins can later inspect logs or DB if needed.
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

            // Try to log the request for admins (table may or may not exist yet).
            try {
                $stmtLog = $pdo->prepare(
                    'INSERT INTO password_reset_requests (email, user_id, requested_at, status)
                     VALUES (:email, :user_id, NOW(), :status)'
                );
                $stmtLog->execute([
                    ':email'   => $email,
                    ':user_id' => $userRow ? (int)$userRow['id'] : null,
                    ':status'  => 'pending',
                ]);
            } catch (Throwable $e2) {
                // Ignore logging errors so the page still works even if the table is missing.
            }
        } catch (Throwable $e) {
            // ignore lookup errors – we still show the same message below
        }

        // Always show generic message to avoid revealing whether the email exists.
        $sent = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot password – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
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
                    <h2 class="section-title">Forgot your password?</h2>
                </div>

                <?php if ($sent && !$error): ?>
                    <div class="auth-success">
                        If an account with that email exists, our administrator will contact you and help reset your password.
                    </div>
                <?php elseif ($error !== ''): ?>
                    <div class="auth-error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$sent || $error): ?>
                <section class="auth-card">
                    <h2>Request password reset</h2>
                    <p>Enter the email you used to register. Our administrator will review your request and contact you to reset your password.</p>
                    <form method="post" action="forgot-password.php" autocomplete="on">
                        <div class="auth-field">
                            <label for="fp-email">Email</label>
                            <input type="email" id="fp-email" name="email" required
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="auth-submit">
                            <button type="submit" class="cta-btn">Send reset link</button>
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

