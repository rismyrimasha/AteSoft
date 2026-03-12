<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_SESSION['user_id'])) {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$isAdminProfile = (($_SESSION['user_role'] ?? '') === 'admin');
$profileMsg = '';
$profileErr = '';
$passwordMsg = '';
$passwordErr = '';

// Load current user
try {
    $stmt = $pdo->prepare('SELECT email, name, profile_image FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        throw new RuntimeException('User not found');
    }
} catch (Throwable $e) {
    $profileErr = 'Could not load your profile.';
    $user = ['email' => '', 'name' => '', 'profile_image' => null];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_profile') {
        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $profileErr = 'Name cannot be empty.';
        } else {
            $profilePath = $user['profile_image'] ?? null;

            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
                if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                    $tmp = $_FILES['profile_image']['tmp_name'];
                    $orig = $_FILES['profile_image']['name'] ?? 'avatar';
                    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
                    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    if (!in_array($ext, $allowed, true)) {
                        $profileErr = 'Profile image must be JPG, PNG, GIF or WEBP.';
                    } else {
                        $uploadDir = __DIR__ . '/uploads/profile';
                        if (!is_dir($uploadDir)) {
                            @mkdir($uploadDir, 0777, true);
                        }
                        $fileName = 'user-' . $userId . '-' . time() . '.' . $ext;
                        $destPath = $uploadDir . '/' . $fileName;
                        if (@move_uploaded_file($tmp, $destPath)) {
                            $profilePath = 'uploads/profile/' . $fileName;
                        } else {
                            $profileErr = 'Could not save uploaded image.';
                        }
                    }
                } else {
                    $profileErr = 'Error uploading profile image.';
                }
            }

            if ($profileErr === '') {
                try {
                    $stmt = $pdo->prepare('UPDATE users SET name = :name, profile_image = :img WHERE id = :id');
                    $stmt->execute([
                        ':name' => $name,
                        ':img'  => $profilePath,
                        ':id'   => $userId,
                    ]);
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_profile_image'] = $profilePath;
                    $profileMsg = 'Profile updated successfully.';
                    $user['name'] = $name;
                    $user['profile_image'] = $profilePath;
                } catch (Throwable $e) {
                    $profileErr = 'Could not update your profile.';
                }
            }
        }
    } elseif ($action === 'change_password') {
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($current === '' || $new === '' || $confirm === '') {
            $passwordErr = 'Please fill in all password fields.';
        } elseif (strlen($new) < 8) {
            $passwordErr = 'New password must be at least 8 characters long.';
        } elseif ($new !== $confirm) {
            $passwordErr = 'New passwords do not match.';
        } else {
            try {
                $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE id = ?');
                $stmt->execute([$userId]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$row || !password_verify($current, $row['password_hash'])) {
                    $passwordErr = 'Current password is incorrect.';
                } else {
                    $hash = password_hash($new, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
                    $stmt->execute([$hash, $userId]);
                    $passwordMsg = 'Password changed successfully.';
                }
            } catch (Throwable $e) {
                $passwordErr = 'Could not change your password.';
            }
        }
    } elseif ($action === 'delete_image') {
        // Remove profile image reference (file deletion is optional and may depend on hosting setup)
        try {
            $stmt = $pdo->prepare('UPDATE users SET profile_image = NULL WHERE id = ?');
            $stmt->execute([$userId]);
            $user['profile_image'] = null;
            unset($_SESSION['user_profile_image']);
            $profileMsg = 'Profile picture removed.';
        } catch (Throwable $e) {
            $profileErr = 'Could not remove profile picture.';
        }
    } elseif ($action === 'logout') {
        session_unset();
        session_destroy();
        header('Location: ' . $BASE_URL . '/auth/login.php');
        exit;
    } elseif ($action === 'delete_account') {
        try {
            $stmt = $pdo->prepare("UPDATE users SET status = 'inactive' WHERE id = ?");
            $stmt->execute([$userId]);
        } catch (Throwable $e) {
            // ignore; still log out
        }
        session_unset();
        session_destroy();
        header('Location: ' . $BASE_URL . '/index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <style>
        .profile-page { max-width: 720px; margin: 0 auto; padding: 2rem 0; }
        .profile-layout { display: grid; grid-template-columns: 220px minmax(0, 1fr); gap: 1.5rem; align-items: flex-start; }
        .profile-avatar-wrap { text-align: center; }
        .profile-avatar {
            width: 140px; height: 140px; border-radius: 999px;
            border: 2px solid #1e293b; background: #020617;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; margin: 0 auto 0.8rem;
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .profile-avatar-placeholder { font-size: 2.2rem; color: var(--muted); }
        .profile-forms { display: grid; gap: 1rem; }
        .profile-card { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.9rem; padding: 1rem 1.2rem; }
        .profile-card h2 { font-size: 1rem; margin-bottom: 0.6rem; }
        .profile-field { margin-bottom: 0.7rem; }
        .profile-field label { display: block; font-size: 0.8rem; color: var(--muted); margin-bottom: 0.2rem; }
        .profile-field input[type="text"],
        .profile-field input[type="email"],
        .profile-field input[type="password"],
        .profile-field input[type="file"] {
            width: 100%; padding: 0.45rem 0.7rem; border-radius: 0.4rem;
            border: 1px solid #374151; background: #020617; color: #fff; font-size: 0.9rem;
        }
        .profile-field input:focus { outline: none; border-color: var(--primary-dark); }
        .profile-meta { font-size: 0.8rem; color: var(--muted); }
        .profile-msg { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 0.8rem; font-size: 0.85rem; }
        .profile-msg.success { background: #022c22; color: #bbf7d0; }
        .profile-msg.error { background: #450a0a; color: #fecaca; }
        @media (max-width: 768px) {
            .profile-layout { grid-template-columns: minmax(0, 1fr); }
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solutions-hero">
        <div class="container">
            <div class="profile-page">
                <div class="section-header">
                    <div class="section-label">Account</div>
                    <h1 class="section-title">My Profile</h1>
                </div>
                <div class="profile-layout">
                    <div class="profile-avatar-wrap">
                        <div class="profile-avatar">
                            <?php if (!empty($user['profile_image'])): ?>
                                <img src="<?php echo htmlspecialchars($BASE_URL . '/' . $user['profile_image']); ?>" alt="Profile image">
                            <?php else: ?>
                                <div class="profile-avatar-placeholder">
                                    <?php echo strtoupper(substr($user['name'] ?: $user['email'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="profile-meta">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </div>
                        <?php if (!empty($user['profile_image'])): ?>
                        <form method="post" action="<?php echo $BASE_URL; ?>/profile.php" style="margin-top:0.6rem;">
                            <input type="hidden" name="action" value="delete_image">
                            <button type="submit" class="cta-btn" style="padding:0.25rem 0.7rem;font-size:0.8rem;">Remove picture</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <div class="profile-forms">
                        <div class="profile-card">
                            <h2>Basic information</h2>
                            <?php if ($profileMsg): ?><div class="profile-msg success"><?php echo htmlspecialchars($profileMsg); ?></div><?php endif; ?>
                            <?php if ($profileErr): ?><div class="profile-msg error"><?php echo htmlspecialchars($profileErr); ?></div><?php endif; ?>
                            <form method="post" action="<?php echo $BASE_URL; ?>/profile.php" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update_profile">
                                <div class="profile-field">
                                    <label for="pf-name">Full name</label>
                                    <input type="text" id="pf-name" name="name" required
                                           value="<?php echo htmlspecialchars($user['name']); ?>">
                                </div>
                                <div class="profile-field">
                                    <label for="pf-image">Profile image</label>
                                    <input type="file" id="pf-image" name="profile_image" accept="image/*">
                                </div>
                                <button type="submit" class="cta-btn">Save profile</button>
                            </form>
                        </div>
                        <div class="profile-card">
                            <h2>Change password</h2>
                            <?php if ($passwordMsg): ?><div class="profile-msg success"><?php echo htmlspecialchars($passwordMsg); ?></div><?php endif; ?>
                            <?php if ($passwordErr): ?><div class="profile-msg error"><?php echo htmlspecialchars($passwordErr); ?></div><?php endif; ?>
                            <form method="post" action="<?php echo $BASE_URL; ?>/profile.php">
                                <input type="hidden" name="action" value="change_password">
                                <div class="profile-field">
                                    <label for="pf-current">Current password</label>
                                    <input type="password" id="pf-current" name="current_password" required>
                                </div>
                                <div class="profile-field">
                                    <label for="pf-new">New password</label>
                                    <input type="password" id="pf-new" name="new_password" required minlength="8">
                                </div>
                                <div class="profile-field">
                                    <label for="pf-confirm">Confirm new password</label>
                                    <input type="password" id="pf-confirm" name="confirm_password" required minlength="8">
                                </div>
                                <button type="submit" class="cta-btn">Update password</button>
                            </form>
                        </div>
                        <div class="profile-card">
                            <h2>Account actions</h2>
                            <div class="profile-field">
                                <form method="post" action="<?php echo $BASE_URL; ?>/profile.php" style="margin-bottom:0.6rem;">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" class="cta-btn">Logout</button>
                                </form>
                            </div>
                            <?php if (!$isAdminProfile): ?>
                            <div class="profile-field">
                                <form method="post" action="<?php echo $BASE_URL; ?>/profile.php" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
                                    <input type="hidden" name="action" value="delete_account">
                                    <button type="submit" class="cta-btn" style="background:#b91c1c;">Delete account</button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>

