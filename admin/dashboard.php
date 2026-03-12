<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

// Admin guard
if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

// Stats (handle missing tables/columns gracefully)
$stats = [
    'inquiries_pending'        => 0,
    'inquiries_answered'       => 0,
    'inquiries_resolved'       => 0,
    'inquiries_total'          => 0,
    'testimonials_new'         => 0,
    'testimonials_total'       => 0,
    'users_total'              => 0,
    'password_requests_pending'=> 0,
];

try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'pending'");
    $stats['inquiries_pending'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'answered'");
    $stats['inquiries_answered'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'resolved'");
    $stats['inquiries_resolved'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM inquiries");
    $stats['inquiries_total'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials WHERE status = 'pending'");
    $stats['testimonials_new'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
        $stats['testimonials_new'] = (int) $stmt->fetchColumn();
    } catch (Throwable $e2) {}
}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials");
    $stats['testimonials_total'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $stats['users_total'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM password_reset_requests WHERE status = 'pending'");
    $stats['password_requests_pending'] = (int) $stmt->fetchColumn();
} catch (Throwable $e) {}

$adminPage = 'overview';
include __DIR__ . '/header.php';
?>
<style>
    .admin-stats { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
    .admin-stat-card { background: #0f172a; border: 1px solid #1e293b; border-radius: 0.75rem; padding: 1rem; }
    .admin-stat-card .num { font-size: 1.75rem; font-weight: 700; color: var(--primary-dark); }
    .admin-stat-card .label { font-size: 0.8rem; color: var(--muted); margin-top: 0.2rem; }
    .admin-report { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #1e293b; }
    .admin-report h3 { font-size: 1rem; margin-bottom: 0.5rem; }
    .admin-report p { font-size: 0.85rem; color: var(--muted); margin-bottom: 0.8rem; }
</style>
<div class="section-header" style="margin-bottom:1.5rem;">
    <h2 class="section-title">Overview</h2>
</div>
<div class="admin-stats">
                <a href="<?php echo $BASE_URL; ?>/admin/inquiries.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num" style="color:#ef4444;"><?php echo $stats['inquiries_pending']; ?></div>
                        <div class="label">Pending inquiries</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/inquiries.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num"><?php echo $stats['inquiries_answered']; ?></div>
                        <div class="label">Answered inquiries</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/inquiries.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num"><?php echo $stats['inquiries_resolved']; ?></div>
                        <div class="label">Resolved inquiries</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/inquiries.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num"><?php echo $stats['inquiries_total']; ?></div>
                        <div class="label">Total inquiries</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/testimonials.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num" style="color:#ef4444;"><?php echo $stats['testimonials_new']; ?></div>
                        <div class="label">New testimonials</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/testimonials.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num"><?php echo $stats['testimonials_total']; ?></div>
                        <div class="label">Total testimonials</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/users.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num"><?php echo $stats['users_total']; ?></div>
                        <div class="label">Users</div>
                    </div>
                </a>
                <a href="<?php echo $BASE_URL; ?>/admin/password-requests.php" style="text-decoration:none;color:inherit;">
                    <div class="admin-stat-card">
                        <div class="num" style="color:#ef4444;"><?php echo $stats['password_requests_pending']; ?></div>
                        <div class="label">Pending password requests</div>
                    </div>
                </a>
            </div>

<div class="admin-report">
    <h3>Download report</h3>
    <p>View a detailed summary of inquiries, testimonials and users (you can print or save as PDF from your browser).</p>
    <a href="<?php echo $BASE_URL; ?>/admin/report-download.php?format=pdf" class="cta-btn">Open report (PDF)</a>
</div>
<?php include __DIR__ . '/footer.php'; ?>
