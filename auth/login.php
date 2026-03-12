<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginType = $_POST['login_type'] ?? 'user'; // 'user' or 'admin'
    $identifier = trim($_POST['identifier'] ?? '');
    $password   = $_POST['password'] ?? '';

    if ($identifier === '' || $password === '') {
        $error = 'Please fill in all fields.';
    } else {
        try {
            if ($loginType === 'admin') {
                // Admin: allow login by username OR email, but require role = 'admin'
                $stmt = $pdo->prepare(
                    'SELECT * FROM users 
                     WHERE role = "admin" 
                       AND (username = :id OR email = :id) 
                       AND status = "active"
                     LIMIT 1'
                );
            } else {
                // User: login by email, role = 'user'
                $stmt = $pdo->prepare(
                    'SELECT * FROM users 
                     WHERE role = "user" 
                       AND email = :id 
                       AND status = "active"
                     LIMIT 1'
                );
            }

            $stmt->execute([':id' => $identifier]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($password, $user['password_hash'])) {
                $error = 'Invalid credentials. Please check and try again.';
            } else {
                // Login OK
                $_SESSION['user_id']   = (int) $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role']; // 'user' or 'admin'

                // Track last login time (best-effort; ignore errors if column is missing)
                try {
                    $upd = $pdo->prepare('UPDATE users SET last_login = NOW() WHERE id = ?');
                    $upd->execute([(int) $user['id']]);
                } catch (Throwable $e) {}

                if ($user['role'] === 'admin') {
                    header('Location: ../admin/dashboard.php');
                    exit;
                }

                header('Location: ../index.php');
                exit;
            }
        } catch (Throwable $e) {
            // In production you would log this instead of showing it
            $error = 'An error occurred while trying to log in.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
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
        .auth-toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 1.2rem;
        }
        .auth-toggle-inner {
            display: inline-flex;
            padding: 0.15rem;
            border-radius: 999px;
            background: #020617;
            border: 1px solid #1f2937;
        }
        .auth-toggle button {
            border: none;
            background: transparent;
            color: var(--muted);
            font-size: 0.8rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            cursor: pointer;
        }
        .auth-toggle button.is-active {
            background: var(--primary-dark);
            color: #ffffff;
        }
        .auth-mode {
            display: none;
        }
        .auth-mode.is-active {
            display: block;
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
                    <div class="section-label">Account access</div>
                    <h2 class="section-title">Login to your account</h2>
                </div>

                <?php if ($error !== ''): ?>
                    <div class="auth-error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <section class="auth-card">
                    <div class="auth-toggle">
                        <div class="auth-toggle-inner" id="auth-toggle">
                            <button type="button" data-mode="user" class="is-active">User</button>
                            <button type="button" data-mode="admin">Admin</button>
                        </div>
                    </div>

                    <!-- User mode -->
                    <div class="auth-mode is-active" id="auth-mode-user">
                        <h2>Login as user</h2>
                        <p>
                            Use this section if you are a registered customer using At e Soft systems.
                        </p>
                        <form method="post" action="login.php" autocomplete="on">
                            <input type="hidden" name="login_type" value="user">
                            <div class="auth-field">
                                <label for="user-email">Email</label>
                                <input type="email" id="user-email" name="identifier" required>
                            </div>
                            <div class="auth-field">
                                <label for="user-password">Password</label>
                                <input type="password" id="user-password" name="password" required>
                            </div>
                            <div class="auth-submit">
                                <button type="submit" class="cta-btn">Log in as user</button>
                            </div>
                            <div class="auth-meta">
                                <div>
                                    Don’t have an account yet?
                                    <a href="register.php">Register as user</a>
                                </div>
                                <div style="margin-top:0.25rem;">
                                    <a href="forgot-password.php" style="color: var(--primary-dark);">Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Admin mode -->
                    <div class="auth-mode" id="auth-mode-admin">
                        <h2>Login as admin</h2>
                        <p>
                            For At e Soft staff to manage testimonials, inquiries and system content.
                        </p>
                        <form method="post" action="login.php" autocomplete="off">
                            <input type="hidden" name="login_type" value="admin">
                            <div class="auth-field">
                                <label for="admin-id">Username or email</label>
                                <input type="text" id="admin-id" name="identifier" required>
                            </div>
                            <div class="auth-field">
                                <label for="admin-password">Password</label>
                                <input type="password" id="admin-password" name="password" required>
                            </div>
                            <div class="auth-submit">
                                <button type="submit" class="cta-btn">Log in as admin</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../footer.php'; ?>
</div>
<script>
    (function () {
        const toggle = document.getElementById('auth-toggle');
        if (!toggle) return;

        const userBtn = toggle.querySelector('button[data-mode="user"]');
        const adminBtn = toggle.querySelector('button[data-mode="admin"]');
        const userMode = document.getElementById('auth-mode-user');
        const adminMode = document.getElementById('auth-mode-admin');

        function setMode(mode) {
            if (mode === 'admin') {
                userBtn.classList.remove('is-active');
                adminBtn.classList.add('is-active');
                userMode.classList.remove('is-active');
                adminMode.classList.add('is-active');
            } else {
                adminBtn.classList.remove('is-active');
                userBtn.classList.add('is-active');
                adminMode.classList.remove('is-active');
                userMode.classList.add('is-active');
            }
        }

        userBtn.addEventListener('click', () => setMode('user'));
        adminBtn.addEventListener('click', () => setMode('admin'));
    })();
</script>
</body>
</html>

