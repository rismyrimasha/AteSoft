<?php
// es-money-exchange.php – Dedicated solution page: es Money Exchange
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-money-exchange';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Money Exchange';
$pageTagline = 'Money exchange management – currency rates, approvals, deposits and reports.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Money exchange features: try several keys admin might have used
$moneyExchangeFeaturesImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['money-exchange-features']
    ?? $solutionImgUrls['money-exchange']
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
                <li><a href="#about">About esMoney Exchange</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#regular-transactions">Regular customer transactions</a></li>
                <li><a href="#reports">Reporting</a></li>
                <li><a href="#bank-transactions">Bank transactions</a></li>
                <li><a href="#accounts">Accounts</a></li>
                <li><a href="#currency">Currency stock &amp; security</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esMoney Exchange</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Money Exchange overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Money Exchange overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Money Exchange overview' : 'Add an overview or currency dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Money exchange system is an easy, accurate, fast &amp; reliable solution. It handles currency‑wise data and their analytical reports &amp; graphs for history and rate comparison, bank confirmation, customer deposits, approval customers and their transactions.</p>
                <p>The system is fully integrated with accounts and money inventory. It provides day‑end reports, managerial reports and the ability to determine average rates for each currency.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Money Exchange main features</h2>
                <figure class="solution-figure">
                    <?php if ($moneyExchangeFeaturesImage): ?>
                    <img src="<?php echo htmlspecialchars($moneyExchangeFeaturesImage); ?>" alt="Money exchange features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Money exchange features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $moneyExchangeFeaturesImage ? 'Money exchange features' : 'Optional image for main money exchange features.'; ?>
                    </figcaption>
                </figure>
                <p>The money exchange system covers all core business functionality.</p>
                <ul class="solution-bullet-list">
                    <li>Reliable, fast, user‑friendly interface.</li>
                    <li>Billing with purchase &amp; selling in the same receipt.</li>
                    <li>Max &amp; min day rate in each currency.</li>
                    <li>Exchange rate history with graphs &amp; reports.</li>
                    <li>Average sale, purchase &amp; on‑approval handling.</li>
                </ul>
            </section>

            <section id="regular-transactions" class="solution-section">
                <h2 class="solution-section-title">Regular customer transactions</h2>
                <ul class="solution-bullet-list">
                    <li>Credit purchase and sales.</li>
                    <li>Customer advance issues and receipts.</li>
                    <li>Customer and bank confirmation deposits.</li>
                    <li>Customer approval issues and receipts.</li>
                    <li>Customer transfers.</li>
                    <li>Currency purchase &amp; sales (cash and credit).</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reporting</h2>
                <p>Comprehensive reports support daily management and regulatory reporting.</p>
                <ul class="solution-bullet-list">
                    <li>Daily purchase &amp; sales reports.</li>
                    <li>Daily customer advance receipts reports.</li>
                    <li>Bank confirmation deposits reports.</li>
                    <li>Approval money issues &amp; receives reports.</li>
                    <li>Monthly purchase report.</li>
                    <li>Monthly bank deposit report.</li>
                    <li>Monthly purchase bank deposit report for Central Bank.</li>
                </ul>
            </section>

            <section id="bank-transactions" class="solution-section">
                <h2 class="solution-section-title">Bank transactions</h2>
                <p>Banking activities are integrated and posted to the proper ledgers.</p>
                <ul class="solution-bullet-list">
                    <li>Daily purchase &amp; sales reports linked to bank movements.</li>
                    <li>Daily customer advance receipts.</li>
                    <li>Bank confirmation deposits.</li>
                    <li>Approval money issues &amp; receives.</li>
                    <li>Monthly purchase and bank deposit reporting, including Central Bank‑format reports.</li>
                </ul>
            </section>

            <section id="accounts" class="solution-section">
                <h2 class="solution-section-title">Accounts</h2>
                <p>Accounting views and ledgers are kept up‑to‑date automatically.</p>
                <ul class="solution-bullet-list">
                    <li>Cash and bank book.</li>
                    <li>Customer account ledger.</li>
                    <li>Approval customer accounts.</li>
                    <li>Bank account ledger.</li>
                </ul>
            </section>

            <section id="currency" class="solution-section">
                <h2 class="solution-section-title">Currency stock &amp; system security</h2>
                <p>Additional tools support currency stock visibility and system security.</p>
                <h3 class="solution-subtitle">Currency tools</h3>
                <ul class="solution-bullet-list">
                    <li>Currency log.</li>
                    <li>Currency stock.</li>
                    <li>Currency summary for quick view of the day's transactions.</li>
                    <li>Day summary.</li>
                </ul>

                <h3 class="solution-subtitle">System security</h3>
                <ul class="solution-bullet-list">
                    <li>Fully integrated security system.</li>
                    <li>User‑wise menu privilege.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you run a money exchange business, we can configure es Money Exchange to match your rates, approvals and reporting requirements.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

