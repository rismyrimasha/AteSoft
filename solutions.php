<?php
// solutions.php – Software solutions overview
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/db.php';

$solutionHeroImages = [];
try {
    $stmt = $pdo->query("SELECT solution_slug, image_path FROM solution_images WHERE image_key = 'hero'");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $solutionHeroImages[$row['solution_slug']] = $BASE_URL . '/' . $row['image_path'];
    }
} catch (Throwable $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Software Solutions – At e Soft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solutions-hero">
        <div class="container">
            <div class="section-header">
                <div class="section-label">Software solutions</div>
                <h1 class="section-title">Business software tailored to your work</h1>
            </div>
            <p class="solutions-intro">
                Explore the range of `es` systems we offer for different industries. Each solution is designed
                to simplify daily work, improve accuracy and give you clear, real‑time information for decision‑making.
            </p>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="solutions-grid-page">
                <?php
                $solutions = [
                    'es-pos-system' => 'es POS System',
                    'es-account-system' => 'es Account System',
                    'es-hire-purchasing' => 'es Hire Purchasing',
                    'es-distribution-system' => 'es Distribution System',
                    'es-color-lab-system' => 'es Color Lab System',
                    'es-workshop-system' => 'es Workshop System',
                    'es-gold-manufacturing' => 'es Gold Manufacturing',
                    'es-pawn-management' => 'es Pawn Management',
                    'es-gold-retail' => 'es Gold Retail',
                    'es-hospital' => 'es Hospital',
                    'es-money-exchange' => 'es Money Exchange',
                    'es-time-attendance-hr' => 'es Time Attendence & HR',
                    'es-hotel' => 'es Hotel',
                    'es-restaurant' => 'es Restuarant',
                    'es-filling-station' => 'es Filling Station',
                    'es-tire-shop' => 'es Tire shop',
                    'es-rice-mill' => 'es Rice Mill',
                    'es-mobile' => 'es Mobile',
                ];

                foreach ($solutions as $slug => $label):
                    if ($slug === 'es-pos-system') {
                        $detailUrl = 'es-pos-system.php';
                        $cardText = 'Point‑of‑sale, stock and reporting for retail outlets.';
                    } elseif ($slug === 'es-account-system') {
                        $detailUrl = 'es-account-system.php';
                        $cardText = 'Core accounting, ledgers and finance reports for day‑to‑day work.';
                    } elseif ($slug === 'es-hire-purchasing') {
                        $detailUrl = 'es-hire-purchasing.php';
                        $cardText = 'Manage hire purchasing sales, instalments and outstanding in one system.';
                    } elseif ($slug === 'es-distribution-system') {
                        $detailUrl = 'es-distribution-system.php';
                        $cardText = 'Manage routes, stock and customer orders with mobile billing support.';
                    } elseif ($slug === 'es-color-lab-system') {
                        $detailUrl = 'es-color-lab-system.php';
                        $cardText = 'Manage color lab and studio jobs, orders and billing from one place.';
                    } elseif ($slug === 'es-workshop-system') {
                        $detailUrl = 'es-workshop-system.php';
                        $cardText = 'Manage workshop jobs, hiring and service history in one place.';
                    } elseif ($slug === 'es-gold-manufacturing') {
                        $detailUrl = 'es-gold-manufacturing.php';
                        $cardText = 'Automate gold manufacturing – orders, stock, wastage and payroll together.';
                    } elseif ($slug === 'es-pawn-management') {
                        $detailUrl = 'es-pawn-management.php';
                        $cardText = 'Manage pawning, interest, reminders and gold stock with full history.';
                    } elseif ($slug === 'es-gold-retail') {
                        $detailUrl = 'es-gold-retail.php';
                        $cardText = 'Handle gold retail invoicing, orders and stock with current gold rates.';
                    } elseif ($slug === 'es-hospital') {
                        $detailUrl = 'es-hospital.php';
                        $cardText = 'Manage channeling, OPD, lab and ward activities in one hospital system.';
                    } elseif ($slug === 'es-money-exchange') {
                        $detailUrl = 'es-money-exchange.php';
                        $cardText = 'Control currency rates, approvals and deposits with integrated accounting.';
                    } elseif ($slug === 'es-time-attendance-hr') {
                        $detailUrl = 'es-time-attendance-hr.php';
                        $cardText = 'Capture time, run payroll and manage HR data from one integrated system.';
                    } elseif ($slug === 'es-hotel') {
                        $detailUrl = 'es-hotel.php';
                        $cardText = 'Manage hotel rooms, bookings, restaurant and billing in one property system.';
                    } elseif ($slug === 'es-restaurant') {
                        $detailUrl = 'es-restaurant.php';
                        $cardText = 'Run restaurant tables, KOT/BOT, recipes and billing with inventory control.';
                    } elseif ($slug === 'es-filling-station') {
                        $detailUrl = 'es-filling-station.php';
                        $cardText = 'Track pump meters, sales, credit bills and fuel stock in one system.';
                    } elseif ($slug === 'es-tire-shop') {
                        $detailUrl = 'es-tire-shop.php';
                        $cardText = 'Manage tire sales, rebuild/DAG work, stock and accounts together.';
                    } elseif ($slug === 'es-rice-mill') {
                        $detailUrl = 'es-rice-mill.php';
                        $cardText = 'Automate paddy intake, milling batches and finished rice stock.';
                    } elseif ($slug === 'es-mobile') {
                        $detailUrl = 'es-mobile-app.php';
                        $cardText = 'Use mobile apps for billing, distribution and MIS reporting on the go.';
                    } else {
                        $detailUrl = 'solution.php?id=' . urlencode($slug);
                        $cardText = 'A dedicated `es` solution built for this business area. Optimised to make daily operations smoother and more reliable.';
                    }
                    $imgSlug = ($slug === 'es-mobile') ? 'es-mobile-app' : $slug;
                    $heroImg = $solutionHeroImages[$imgSlug] ?? null;
                ?>
                    <article class="solution-card">
                        <?php if ($heroImg): ?>
                        <div class="solution-card-image"><img src="<?php echo htmlspecialchars($heroImg); ?>" alt="<?php echo htmlspecialchars($label); ?>"></div>
                        <?php else: ?>
                        <div class="solution-image-placeholder"></div>
                        <?php endif; ?>
                        <div class="solution-card-body">
                            <h2><?php echo htmlspecialchars($label); ?></h2>
                            <p class="solution-card-text">
                                <?php echo htmlspecialchars($cardText); ?>
                            </p>
                            <a class="solution-card-link" href="<?php echo htmlspecialchars($detailUrl); ?>">
                                View details
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

