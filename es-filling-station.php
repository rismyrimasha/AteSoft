<?php
// es-filling-station.php – Dedicated solution page: es Filling Station
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-filling-station';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Filling Station';
$pageTagline = 'Fuel station management – meter readings, pumps, credit bills and stock.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Filling station features: try several keys admin might have used
$fillingStationFeaturesImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['filling-station-features']
    ?? $solutionImgUrls['filling-station']
    ?? $solutionImgUrls['features']
    ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pageTitle); ?> – At e Soft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<main class="solution-page">
    <section class="solution-page-hero">
        <div class="container">
            <div class="section-label">Software solution</div>
            <h1 class="solution-page-title"><?php echo htmlspecialchars($pageTitle); ?></h1>
            <p class="solution-page-tagline"><?php echo htmlspecialchars($pageTagline); ?></p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About esFilling Station</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#transactions">Transactions</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esFilling Station</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Filling Station overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Filling Station overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Filling Station overview' : 'Add an overview or pump / meter dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At e Soft Filling Station system provides accurate functions for meter reading, pump testing, pump‑wise sale and stock, and pump operator‑wise sales and collections.</p>
                <p>The system supports credit bills, customer‑wise multiple vehicles and their transactions, an oil counter with POS system and higher security. It is fully integrated with accounts and HR and offers useful reports for management, auditing and analysis.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">Main features</h2>
                <figure class="solution-figure">
                    <?php if ($fillingStationFeaturesImage): ?>
                    <img src="<?php echo htmlspecialchars($fillingStationFeaturesImage); ?>" alt="Filling station features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Filling station features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $fillingStationFeaturesImage ? 'Filling station features' : 'Optional image for main filling station features.'; ?>
                    </figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>Meter reading and pump testing.</li>
                    <li>Pump‑wise sales and stock.</li>
                    <li>Pump operator‑wise sales and collections.</li>
                    <li>Credit bills and customer‑wise multiple vehicles.</li>
                    <li>Oil counter with POS system.</li>
                    <li>Higher security and full integration with accounts and HR.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Transactions</h2>
                <ul class="solution-bullet-list">
                    <li>Meter reading billing.</li>
                    <li>Meter reading test and meter reading reprint.</li>
                    <li>GRN (goods received note).</li>
                    <li>Item price change.</li>
                    <li>Credit bill.</li>
                    <li>Customer order bill.</li>
                    <li>Advance payment.</li>
                    <li>Employee deposit and employee deposit payment.</li>
                    <li>Settlement.</li>
                    <li>Balance sheet.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting provides visibility into pump activity, customers, staff deposits and profitability.</p>
                <ul class="solution-bullet-list">
                    <li>Pump report.</li>
                    <li>Credit bill report.</li>
                    <li>Customer deposit report.</li>
                    <li>Employee deposit report.</li>
                    <li>Expenses report.</li>
                    <li>Customer details.</li>
                    <li>Department‑wise profit.</li>
                    <li>Profit &amp; loss.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a filling station, we can configure es Filling Station to match your pumps, meters, credit customers and reporting needs.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

