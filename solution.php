<?php
// solution.php – Single solution detail page

$solutions = [
    'es-pos-system' => 'es POS System',
    'es-account-system' => 'es Account System',
    'es-hire-purchasing' => 'es Hire Purchasing',
    'es-distribution-system' => 'es Distribution System',
    'es-color-lab-system' => 'es Color Lab System',
    'es-workshop-system' => 'es Workshop System',
    'es-gold-manufacturing' => 'es Gold Manufacturing',
    'es-pawn-management' => 'es Pwan Management',
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

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!isset($solutions[$id])) {
    http_response_code(404);
    $title = 'Solution not found';
} else {
    $title = $solutions[$id];
}

function solution_intro($id, $label)
{
    switch ($id) {
        case 'es-pos-system':
            return 'A complete point‑of‑sale solution for retail, with billing, stock and reporting in one place.';
        case 'es-account-system':
            return 'Core accounting for day‑to‑day finance – ledgers, vouchers, reports and audits.';
        case 'es-hire-purchasing':
            return 'Track hire‑purchase agreements, instalments, arrears and customer history accurately.';
        case 'es-distribution-system':
            return 'Manage distribution, routes, orders and delivery with clear visibility into stock movement.';
        case 'es-color-lab-system':
            return 'Job management and billing for colour labs, photo studios and printing centres.';
        case 'es-workshop-system':
            return 'Handle job cards, spare parts, labour and billing for vehicle and equipment workshops.';
        case 'es-gold-manufacturing':
            return 'Follow gold manufacturing from raw material to finished item with full traceability.';
        case 'es-pawn-management':
            return 'Manage pawning tickets, interest, renewals and auctions with clear records.';
        case 'es-gold-retail':
            return 'Retail sales, pricing and stock control for jewellery and gold retail outlets.';
        case 'es-hospital':
            return 'Registration, OPD, billing and records for hospitals and medical centres.';
        case 'es-money-exchange':
            return 'Foreign currency buying, selling and compliance reporting for money exchange businesses.';
        case 'es-time-attendance-hr':
            return 'Time attendance and HR, linked to devices and payroll‑ready reports.';
        case 'es-hotel':
            return 'Front‑office, reservations and billing for hotels and guest houses.';
        case 'es-restaurant':
            return 'Order taking, kitchen order tickets and billing for restaurants and cafés.';
        case 'es-filling-station':
            return 'Nozzle‑wise sales, credits and stock management for fuel stations.';
        case 'es-tire-shop':
            return 'Jobs, stock and billing for tyre and alignment shops.';
        case 'es-rice-mill':
            return 'Paddy intake, milling and dispatch tracking for rice mills.';
        case 'es-mobile':
            return 'Sales, service tracking and stock control for mobile and electronics shops.';
        default:
            return 'A dedicated `es` solution built for this business area, ready to be adapted to your operation.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($title); ?> – At e Soft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solution-hero">
        <div class="container">
            <?php if (!isset($solutions[$id])): ?>
                <div class="section-header">
                    <div class="section-label">Software solution</div>
                    <h1 class="section-title">Solution not found</h1>
                </div>
                <p class="solutions-intro">
                    The solution you tried to open could not be found. Please go back to the list of software
                    solutions and choose again.
                </p>
                <p>
                    <a class="solution-card-link" href="solutions.php">Back to Software Solutions</a>
                </p>
            <?php else: ?>
                <div class="section-header">
                    <div class="section-label">Software solution</div>
                    <h1 class="section-title"><?php echo htmlspecialchars($solutions[$id]); ?></h1>
                </div>

                <div class="solution-detail-layout">
                    <div class="solution-detail-media">
                        <div class="solution-image-placeholder large"></div>
                    </div>
                    <div class="solution-detail-text">
                        <p class="solutions-intro">
                            <?php echo htmlspecialchars(solution_intro($id, $solutions[$id])); ?>
                        </p>
                        <p class="solution-detail-body">
                            This page can later include detailed process flows, screen samples and reports that
                            match your exact way of working. We usually analyse your current manual or semi‑manual
                            process, then configure and extend this `es` system to fit – from master data to daily
                            transactions and management reporting.
                        </p>
                        <p class="solution-detail-body">
                            If you are interested in this solution, we can schedule a short discussion to understand
                            your requirements and show a focused demonstration.
                        </p>

                        <p>
                            <a class="solution-card-link" href="solutions.php">← Back to all software solutions</a>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

