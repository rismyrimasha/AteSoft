<?php
// es-rice-mill.php – Dedicated solution page: es Rice Mill
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-rice-mill';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Rice Mill';
$pageTagline = 'Rice mill automation – from paddy intake to finished rice stock.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
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
                <li><a href="#about">About esRice Mill</a></li>
                <li><a href="#intake">Paddy intake &amp; suppliers</a></li>
                <li><a href="#milling">Milling &amp; production</a></li>
                <li><a href="#stock">Stock &amp; dispatch</a></li>
                <li><a href="#accounts">Accounts &amp; reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esRice Mill</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Rice Mill overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Rice Mill overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Rice Mill overview' : 'Add an overview or milling / stock dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Rice Mill system is designed to support the full rice milling process from paddy intake up to finished product dispatch. It helps you track farmers and suppliers, paddy purchases, milling batches, by‑products, stock levels and customer deliveries.</p>
                <p>The system is fast, reliable and easy to use for both office staff and mill operators, and is integrated with accounts and inventory for accurate costing and profit analysis.</p>
            </section>

            <section id="intake" class="solution-section">
                <h2 class="solution-section-title">Paddy intake &amp; suppliers</h2>
                <ul class="solution-bullet-list">
                    <li>Farmer / supplier registration with contact and location details.</li>
                    <li>Paddy purchase entry with moisture, variety and grade.</li>
                    <li>Weighbridge tickets and manual adjustments if required.</li>
                    <li>Advance payments to farmers and settlements against deliveries.</li>
                </ul>
            </section>

            <section id="milling" class="solution-section">
                <h2 class="solution-section-title">Milling &amp; production</h2>
                <ul class="solution-bullet-list">
                    <li>Milling batch creation and milling orders.</li>
                    <li>Recording production yields for raw rice, boiled rice, broken rice, bran and husk.</li>
                    <li>Wastage tracking and yield comparison by batch and variety.</li>
                    <li>Batch history and traceability from paddy intake to finished product.</li>
                </ul>
            </section>

            <section id="stock" class="solution-section">
                <h2 class="solution-section-title">Stock &amp; dispatch</h2>
                <ul class="solution-bullet-list">
                    <li>Finished product stock by grade, bag size and location.</li>
                    <li>Sales orders and delivery notes.</li>
                    <li>Invoice handling (cash / credit) and receipts.</li>
                    <li>Stock movement between stores or mills.</li>
                </ul>
            </section>

            <section id="accounts" class="solution-section">
                <h2 class="solution-section-title">Accounts &amp; reports</h2>
                <p>Accounting and reporting help you understand costs, yields and profitability.</p>
                <ul class="solution-bullet-list">
                    <li>Supplier ledger and customer ledger for paddy and rice.</li>
                    <li>Daily purchase and sales summaries.</li>
                    <li>Batch‑wise yield, cost and margin reports.</li>
                    <li>Profitability by product, customer and time period.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a rice mill, we can configure es Rice Mill to match your intake, milling and dispatch processes.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

