<?php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
session_start();

if (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    header('Location: ' . $BASE_URL . '/auth/login.php');
    exit;
}

$solutions = [
    'es-pos-system' => 'es POS System',
    'es-account-system' => 'es Account System',
    'es-distribution-system' => 'es Distribution System',
    'es-hire-purchasing' => 'es Hire Purchasing',
    'es-color-lab-system' => 'es Color Lab System',
    'es-workshop-system' => 'es Workshop System',
    'es-gold-manufacturing' => 'es Gold Manufacturing',
    'es-pawn-management' => 'es Pawn Management',
    'es-gold-retail' => 'es Gold Retail',
    'es-hospital' => 'es Hospital',
    'es-money-exchange' => 'es Money Exchange',
    'es-time-attendance-hr' => 'es Time Attendance & HR',
    'es-hotel' => 'es Hotel',
    'es-restaurant' => 'es Restaurant',
    'es-filling-station' => 'es Filling Station',
    'es-tire-shop' => 'es Tire shop',
    'es-rice-mill' => 'es Rice Mill',
    'es-mobile-app' => 'es Mobile',
];

$adminPage = 'solutions';
$adminTitle = 'ES Solutions';
include __DIR__ . '/header.php';
?>
<style>
    .solutions-list { display: grid; gap: 0.5rem; }
    .solutions-list a { display: block; padding: 0.8rem 1rem; background: #0f172a; border: 1px solid #1e293b; border-radius: 0.5rem; color: #e5e5e5; }
    .solutions-list a:hover { background: #1e293b; border-color: var(--primary-dark); }
</style>
<div class="section-header" style="margin-bottom:1.5rem;">
    <h2 class="section-title">ES Solutions</h2>
</div>
<p style="margin-bottom:1rem;color:var(--muted);">Click a solution to edit its title, tagline and upload a hero image.</p>
<div class="solutions-list">
    <?php foreach ($solutions as $slug => $label): ?>
    <a href="<?php echo $BASE_URL; ?>/admin/solution-edit.php?slug=<?php echo urlencode($slug); ?>">
        <?php echo htmlspecialchars($label); ?>
    </a>
    <?php endforeach; ?>
</div>
<?php include __DIR__ . '/footer.php'; ?>
