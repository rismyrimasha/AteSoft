<?php
// es-tire-shop.php – Dedicated solution page: es Tire Shop
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-tire-shop';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Tire Shop';
$pageTagline = 'Tire shop management – billing, stock, complaints and accounts.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Tire shop features: try several keys admin might have used
$tireShopFeaturesImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['tire-shop-features']
    ?? $solutionImgUrls['tire-shop']
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
                <li><a href="#about">About esTire Shop</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#accounts">Accounts</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esTire Shop</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Tire Shop overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Tire Shop overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Tire Shop overview' : 'Add an overview or workshop / tire shop dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At e Soft tire shop system covers back‑office and front‑office activities. It is an easy, fast, reliable &amp; customer satisfaction billing system. Customers, items, suppliers, salesmen, banks, bank accounts, credit cards, income &amp; expenses, quotations, invoices (cash &amp; credit), receipts and payments (cash, cheque or credit card), receipt cancellation, stock handling and purchasing are all handled in one system.</p>
                <p>Purchasing includes goods received notes (GRN), purchase returns to suppliers (PRN), stock adjustments, cheque payment vouchers (company &amp; third party), cheque received vouchers, cash payment vouchers and cash received vouchers. The system supports very easy methods for handling complaints, customer receiving / issuing, company issuing / receiving, rebuild &amp; DAG, and ownership.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">Main features</h2>
                <figure class="solution-figure">
                    <?php if ($tireShopFeaturesImage): ?>
                    <img src="<?php echo htmlspecialchars($tireShopFeaturesImage); ?>" alt="Tire shop features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Tire shop features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $tireShopFeaturesImage ? 'Tire shop features' : 'Optional image for main tire shop features.'; ?>
                    </figcaption>
                </figure>
                <p>The system offers powerful, easy search options across customers, items and rebuild / DAG work.</p>
                <ul class="solution-bullet-list">
                    <li>Item search by item code, item trade name and item barcode.</li>
                    <li>Item size‑wise search (tire size).</li>
                    <li>Casing search.</li>
                    <li>Customer search.</li>
                    <li>Rebuild &amp; DAG search.</li>
                    <li>Under‑complaint search.</li>
                </ul>
            </section>

            <section id="accounts" class="solution-section">
                <h2 class="solution-section-title">Accounts</h2>
                <p>Account transactions and ledgers are integrated with day‑to‑day tire shop operations.</p>
                <ul class="solution-bullet-list">
                    <li>Accounts transactions and cash &amp; bank books.</li>
                    <li>Customer accounts ledger.</li>
                    <li>Supplier accounts ledger.</li>
                    <li>Bank accounts ledger.</li>
                    <li>Sales &amp; sales return books.</li>
                    <li>Purchase &amp; purchase return books.</li>
                    <li>Daily expenses &amp; income.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting supports sales analysis, stock visibility and customer rebuild / DAG tracking.</p>
                <ul class="solution-bullet-list">
                    <li>Sales analysis reports.</li>
                    <li>Sales item summary.</li>
                    <li>Daily cash collection summary.</li>
                    <li>Sales reports – salesman‑wise, cashier‑wise, vehicle‑number‑wise.</li>
                    <li>Invoice settlement details.</li>
                    <li>Customer rebuild / DAG reports and stocks.</li>
                    <li>Customer purchases, customer received and customer issued reports.</li>
                    <li>Customer / supplier outstanding.</li>
                    <li>Expenses and income reports.</li>
                    <li>Stock reports (including brand‑wise and size‑wise).</li>
                    <li>Other reports as required.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a tire shop, we can configure this system to match your billing, rebuild/DAG and stock control needs.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

