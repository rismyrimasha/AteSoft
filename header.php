<?php
require_once __DIR__ . '/includes/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');
$isLoggedIn = !empty($_SESSION['user_id']);
$isAdmin = ($_SESSION['user_role'] ?? '') === 'admin';
?>
<header>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                <?php echo htmlspecialchars($COMPANY_NAME_SHORT); ?> <span>Computer Systems</span>
            </div>
            <button class="nav-toggle" type="button" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="main-nav">
                <ul>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/index.php#home"<?php if ($currentPage === 'index.php') echo ' class="is-active"'; ?>>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/solutions.php"<?php if ($currentPage === 'solutions.php') echo ' class="is-active"'; ?>>
                            Software Solutions
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/testimonials.php"<?php if ($currentPage === 'testimonials.php') echo ' class="is-active"'; ?>>
                            Customer Testimonials
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/about.php"<?php if ($currentPage === 'about.php') echo ' class="is-active"'; ?>>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/inquiry.php"<?php if ($currentPage === 'inquiry.php') echo ' class="is-active"'; ?>>
                            Inquiry
                        </a>
                    </li>
                    <?php if ($isLoggedIn && !$isAdmin): ?>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/my-inquiries.php"<?php if ($currentPage === 'my-inquiries.php') echo ' class="is-active"'; ?>>
                            My Inquiries
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ($isAdmin): ?>
                    <li>
                        <a href="<?php echo $BASE_URL; ?>/admin/dashboard.php">
                            Admin dashboard
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php if ($isLoggedIn): ?>
                <?php $profileIconPath = $_SESSION['user_profile_image'] ?? null; ?>
                <a href="<?php echo $BASE_URL; ?>/profile.php" class="profile-icon-btn" aria-label="My profile">
                    <?php if (!empty($profileIconPath)): ?>
                        <img src="<?php echo htmlspecialchars($BASE_URL . '/' . $profileIconPath); ?>" alt="My profile">
                    <?php else: ?>
                        <?php echo strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)); ?>
                    <?php endif; ?>
                </a>
            <?php else: ?>
                <a href="<?php echo $BASE_URL; ?>/auth/login.php" class="cta-btn<?php if ($currentPage === 'login.php') echo ' is-active'; ?>">
                    Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

