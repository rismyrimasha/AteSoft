<?php
require __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/es-systems-list.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$isUser = !empty($_SESSION['user_id']) && (($_SESSION['user_role'] ?? '') === 'user');

$success = $_SESSION['inquiry_success'] ?? '';
$error   = $_SESSION['inquiry_error'] ?? '';
$name    = $_SESSION['inquiry_name'] ?? ($_SESSION['user_name'] ?? '');
$email   = $_SESSION['inquiry_email'] ?? '';
$business = $_SESSION['inquiry_business'] ?? '';
$message = $_SESSION['inquiry_message'] ?? '';
$esSystem = $_SESSION['inquiry_es_system'] ?? '';
if (empty($email) && !empty($_SESSION['user_id'])) {
    require_once __DIR__ . '/includes/db.php';
    try {
        $stmt = $pdo->prepare('SELECT email FROM users WHERE id = ?');
        $stmt->execute([(int)$_SESSION['user_id']]);
        $u = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($u) $email = $u['email'];
    } catch (Throwable $e) {}
}
if ($success || $error) {
    unset($_SESSION['inquiry_success'], $_SESSION['inquiry_error'], $_SESSION['inquiry_name'],
          $_SESSION['inquiry_email'], $_SESSION['inquiry_business'], $_SESSION['inquiry_message'],
          $_SESSION['inquiry_es_system']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inquiry – <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <style>
        .inquiry-page { max-width: 560px; margin: 0 auto; padding: 2rem 0; }
        .inquiry-page h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .inquiry-page .intro { color: var(--muted); margin-bottom: 1.5rem; }
        .inquiry-form label { display: block; margin-bottom: 0.5rem; font-size: 0.9rem; }
        .inquiry-form input, .inquiry-form select, .inquiry-form textarea {
            width: 100%; padding: 0.5rem 0.7rem; margin-top: 0.25rem;
            background: #020617; border: 1px solid #374151; border-radius: 0.5rem;
            color: #fff; font-size: 0.95rem;
        }
        .inquiry-form .row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 600px) { .inquiry-form .row { grid-template-columns: 1fr; } }
        .inquiry-message { padding: 0.6rem; border-radius: 0.5rem; margin-bottom: 1rem; }
        .inquiry-message.success { background: #022c22; color: #bbf7d0; }
        .inquiry-message.error { background: #450a0a; color: #fecaca; }
        .my-inquiries-link { margin-top: 1rem; font-size: 0.9rem; }
    </style>
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solutions-hero">
        <div class="container">
            <div class="inquiry-page">
                <div class="section-header">
                    <div class="section-label">Contact</div>
                    <h1 class="section-title">Send an inquiry</h1>
                </div>
                <p class="intro">Tell us about your business needs. We will get back to you soon.</p>

                <?php if ($success): ?>
                <div class="inquiry-message success"><?php echo htmlspecialchars($success); ?></div>
                <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="<?php echo $BASE_URL; ?>/my-inquiries.php" class="link-btn">View my inquiries →</a>
                <?php endif; ?>
                <?php elseif ($error): ?>
                <div class="inquiry-message error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if (!$success): ?>
                    <?php if (!$isUser): ?>
                        <div class="inquiry-message error">
                            Please log in to send an inquiry.
                            <a href="<?php echo $BASE_URL; ?>/auth/login.php" class="link-btn">Login</a>
                        </div>
                    <?php else: ?>
                <form method="post" action="<?php echo $BASE_URL; ?>/inquiry-submit.php" class="inquiry-form">
                    <div class="row">
                        <label>Name *<input type="text" name="name" required value="<?php echo htmlspecialchars($name); ?>"></label>
                        <label>Email *<input type="email" name="email" required value="<?php echo htmlspecialchars($email); ?>"></label>
                    </div>
                    <label style="margin-top:1rem;">Business name *<input type="text" name="business_name" required value="<?php echo htmlspecialchars($business); ?>"></label>
                    <label style="margin-top:1rem;">ES system needed
                        <select name="es_system">
                            <?php foreach ($ES_SYSTEMS_LIST as $val => $opt): ?>
                            <option value="<?php echo htmlspecialchars($val); ?>"<?php echo $esSystem === $val ? ' selected' : ''; ?>><?php echo htmlspecialchars($opt); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label style="margin-top:1rem;">Message *<textarea name="message" rows="5" required><?php echo htmlspecialchars($message); ?></textarea></label>
                    <button type="submit" class="cta-btn" style="margin-top:1rem;">Send inquiry</button>
                </form>
                <div class="my-inquiries-link"><a href="<?php echo $BASE_URL; ?>/my-inquiries.php">View my previous inquiries</a></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
