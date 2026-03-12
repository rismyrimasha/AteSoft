<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/mail.php';
session_start();

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // Validation
    if ($name === '' || $email === '' || $password === '' || $confirm === '') {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            if ($stmt->fetch()) {
                $error = 'An account with this email already exists. Please log in instead.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare(
                    'INSERT INTO users (email, username, password_hash, name, role, status) 
                     VALUES (:email, NULL, :hash, :name, "user", "active")'
                );
                $stmt->execute([
                    ':email' => $email,
                    ':hash'  => $hash,
                    ':name'  => $name,
                ]);

                // Send welcome / registration confirmation email
                $subject = 'You have successfully registered with At e Soft';
                $loginUrl = $BASE_URL . '/auth/login.php';
                $body = "Dear {$name},\n\n"
                    . "Thank you for registering with {$COMPANY_NAME_SHORT}.\n"
                    . "You can now log in using this email address and the password you chose.\n\n"
                    . "Login here: {$loginUrl}\n\n"
                    . "If you did not create this account, please ignore this email.\n\n"
                    . "Best regards,\n"
                    . "{$COMPANY_NAME}";
                send_app_mail($email, $subject, $body);

                $success = true;
            }
        } catch (Throwable $e) {
            $error = 'An error occurred while creating your account. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles.css">
    <style>
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .auth-main {
            flex: 1;
            padding: 3.5rem 0;
        }
        .auth-layout {
            max-width: 520px;
            margin: 0 auto;
        }
        .auth-card {
            background: #020617;
            border-radius: 1rem;
            border: 1px solid #1f2937;
            padding: 1.6rem 1.5rem 1.8rem;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            max-width: 420px;
            margin: 0 auto;
        }
        .auth-card h2 {
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
        }
        .auth-card p {
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 1.2rem;
        }
        .auth-field {
            margin-bottom: 0.9rem;
        }
        .auth-field label {
            display: block;
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
            color: var(--muted);
        }
        .auth-field input {
            width: 100%;
            padding: 0.45rem 0.7rem;
            border-radius: 0.4rem;
            border: 1px solid #374151;
            background: #020617;
            color: var(--text);
            font-size: 0.9rem;
        }
        .auth-field input:focus {
            outline: none;
            border-color: var(--primary-dark);
        }
        .auth-submit {
            margin-top: 0.3rem;
        }
        .auth-submit button {
            width: 100%;
        }
        .auth-meta {
            margin-top: 0.7rem;
            font-size: 0.8rem;
            color: var(--muted);
        }
        .auth-meta a {
            color: var(--primary-dark);
        }
        .auth-error {
            margin-bottom: 1rem;
            padding: 0.6rem 0.8rem;
            border-radius: 0.5rem;
            background: #451a1a;
            border: 1px solid #b91c1c;
            color: #fee2e2;
            font-size: 0.85rem;
        }
        .auth-success {
            margin-bottom: 1rem;
            padding: 0.6rem 0.8rem;
            border-radius: 0.5rem;
            background: #14532d;
            border: 1px solid #166534;
            color: #dcfce7;
            font-size: 0.85rem;
        }
        @media (max-width: 900px) {
            .auth-layout {
                max-width: 100%;
                padding: 0 1rem;
            }
            .auth-card {
                max-width: 100%;
            }
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
                    <div class="section-label">Create account</div>
                    <h2 class="section-title">Register as user</h2>
                </div>

                <?php if ($success): ?>
                    <div class="auth-success">
                        Your account has been created successfully. We have sent a confirmation email to your address.
                        You can now <a href="login.php" style="color: var(--primary-dark);">log in</a>.
                    </div>
                <?php elseif ($error !== ''): ?>
                    <div class="auth-error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$success): ?>
                <section class="auth-card">
                    <h2>Create your account</h2>
                    <p>
                        Register to submit testimonials and manage your inquiries with At e Soft.
                    </p>
                    <form method="post" action="register.php" autocomplete="on">
                        <div class="auth-field">
                            <label for="reg-name">Full name</label>
                            <input type="text" id="reg-name" name="name" required
                                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>
                        <div class="auth-field">
                            <label for="reg-email">Email</label>
                            <input type="email" id="reg-email" name="email" required
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                        <div class="auth-field">
                            <label for="reg-password">Password</label>
                            <input type="password" id="reg-password" name="password" required minlength="8"
                                   placeholder="At least 8 characters">
                        </div>
                        <div class="auth-field">
                            <label for="reg-confirm">Confirm password</label>
                            <input type="password" id="reg-confirm" name="confirm_password" required minlength="8">
                        </div>
                        <div class="auth-submit">
                            <button type="submit" class="cta-btn">Create account</button>
                        </div>
                        <div class="auth-meta">
                            Already have an account?
                            <a href="login.php">Log in</a>
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
