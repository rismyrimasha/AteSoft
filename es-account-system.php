<?php
// es-account-system.php – Dedicated solution page: es Account System
require __DIR__ . '/includes/config.php';
$pageTitle   = 'es Account System';
$solutionSlug = 'es-account-system';
require __DIR__ . '/includes/solution-data.php';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
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
            <h1 class="solution-page-title"><?php echo htmlspecialchars($solutionTitle ?? $pageTitle); ?></h1>
            <p class="solution-page-tagline">
                <?php echo htmlspecialchars($solutionTagline ?? 'Integrated business and accounting – ledgers, vouchers and reports in one place.'); ?>
            </p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About es Account</a></li>
                <li><a href="#reference">Reference masters</a></li>
                <li><a href="#transactions">Transactions</a></li>
                <li><a href="#bank">Bank &amp; cheques</a></li>
                <li><a href="#reports">Reports &amp; financials</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esAccount</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if (!empty($solutionImgUrls['hero'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['hero']); ?>" alt="es Account dashboard" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Account dashboard</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add an overview or dashboard image here.</figcaption>
                </figure>
                <p>At e Soft Accounting software is a robust integrated business and accounting software system that will help you organise your business's financial future. At es Accounting software contains all the features which you would expect from a complete business and inventory management package.</p>
                <p>As you carry out your daily business activities, At es Accounting software creates your accounting entries for you. This keeps ledgers, vouchers and financial statements up to date without extra manual work.</p>
            </section>

            <section id="reference" class="solution-section">
                <h2 class="solution-section-title">Reference masters</h2>
                <p>The reference section lets you define and maintain the core accounting structure for your business.</p>
                <ul class="solution-bullet-list">
                    <li><strong>Account Tree</strong> – complete chart of accounts for your organisation.</li>
                    <li><strong>Groups</strong> – groupings for ledgers and reporting.</li>
                    <li><strong>Ledger</strong> – customer, supplier and general ledgers.</li>
                    <li><strong>Voucher Types</strong> – sales, purchase, journal, receipts, payments and more.</li>
                    <li><strong>Change financial year</strong> – move smoothly from one financial year to the next.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Transactions</h2>
                <p>Day‑to‑day accounting transactions can be entered, reviewed and controlled from a central place.</p>
                <ul class="solution-bullet-list">
                    <li><strong>Journal Entry</strong> – general journal entries for adjustments and corrections.</li>
                    <li><strong>Day Book</strong> – a combined view of daily transactions.</li>
                    <li><strong>Voucher Payment</strong> – payment vouchers for expenses and payables.</li>
                    <li><strong>Advance payments</strong> – handle advance payments by cheque or cash.</li>
                </ul>
            </section>

            <section id="bank" class="solution-section">
                <h2 class="solution-section-title">Bank &amp; cheque management</h2>
                <p>Banking functions and cheque handling are integrated into the accounting flow.</p>
                <ul class="solution-bullet-list">
                    <li><strong>Cheque Deposit</strong> – record cheques deposited into bank.</li>
                    <li><strong>Cheque Return</strong> – handle returned / dishonoured cheques.</li>
                    <li><strong>Cheque Issued Realised</strong> – mark issued cheques as realised.</li>
                    <li><strong>Received Cheque Preview</strong> – preview and track received cheques.</li>
                    <li><strong>Issued Cheque Preview</strong> – preview and track issued cheques.</li>
                    <li><strong>Cheque Writing</strong> – prepare printed cheques.</li>
                    <li><strong>Bank Reconciliation</strong> – reconcile bank statements with ledger balances.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports &amp; financial statements</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['reports'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['reports']); ?>" alt="Accounting reports" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Accounting reports</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add example financial reports or dashboards here.</figcaption>
                </figure>

                <h3 class="solution-subtitle">Cheque &amp; bank reports</h3>
                <ul class="solution-feature-list">
                    <li>Cheque issued report</li>
                    <li>Bank‑wise cheque receive and payment</li>
                    <li>Cheque deposit report</li>
                    <li>Cheque return report</li>
                    <li>Bank deposit report</li>
                </ul>

                <h3 class="solution-subtitle">Voucher and journal reports</h3>
                <ul class="solution-feature-list">
                    <li>Voucher report</li>
                    <li>Journal report</li>
                    <li>Ledger balance</li>
                </ul>

                <h3 class="solution-subtitle">Core financials</h3>
                <ul class="solution-feature-list">
                    <li>Profit and Loss</li>
                    <li>Balance Sheet</li>
                    <li>Trial Balance</li>
                    <li>Cash Flow</li>
                </ul>

                <h3 class="solution-subtitle">Final reports</h3>
                <p>Final versions of Profit and Loss, Balance Sheet, Cash Flow and Trial Balance are available for period‑end and statutory reporting.</p>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you would like to see how es Account System can match your existing process, we can prepare a focused demonstration.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

