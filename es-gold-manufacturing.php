<?php
// es-gold-manufacturing.php – Dedicated solution page: es Gold Manufacturing
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-gold-manufacturing';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Gold Manufacturing';
$pageTagline = 'Gold manufacturing automation – orders, stock, wastage and payroll in one system.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Gold manufacturing features: try several keys admin might have used
$featuresImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['gold-manufacturing-features']
    ?? $solutionImgUrls['gold-features']
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
                <li><a href="#about">About esGold Manufacturing</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#transactions">Transactions</a></li>
                <li><a href="#gold-stock">Gold stock</a></li>
                <li><a href="#bank">Bank transactions</a></li>
                <li><a href="#accounts">Accounts integration</a></li>
                <li><a href="#cheques">Cheque transactions</a></li>
                <li><a href="#payroll">Embedded payroll</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esGold Manufacturing</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Gold Manufacturing overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Gold Manufacturing overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Gold Manufacturing overview' : 'Add an overview or production dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Gold manufacturing system covers all the activities in the gold manufacturing process. Orders management and on‑time delivery, order tracking, increasing productivity and staff efficiency, employee satisfaction and accuracy are supported throughout.</p>
                <p>The system manages raw material stock and finished goods stock, wastage and wastage recovery processes, old gold melting, subcontract management, and staff attendance with thumb reader or proximity card system. It is fully integrated with payroll, HR, accounts and inventory, and provides useful reports for management, auditing and analysis.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Gold Manufacturing main features</h2>
                <figure class="solution-figure">
                    <?php if ($featuresImage): ?>
                    <img src="<?php echo htmlspecialchars($featuresImage); ?>" alt="Gold manufacturing features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Gold manufacturing features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $featuresImage ? 'Gold manufacturing features' : 'Optional image for main gold manufacturing features.'; ?>
                    </figcaption>
                </figure>
                <p>This product is used to perform the operations of a Gold Manufacturing (jewel manufacturing) factory automation system. It is fast, reliable, accurate, and easy to use and train.</p>
                <ul class="solution-bullet-list">
                    <li>Customer and supplier management.</li>
                    <li>Raw material and jewel product designs.</li>
                    <li>Employee and salesman records.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Transactions</h2>
                <p>Production and sales‑related transactions are fully tracked and integrated with gold and cash ledgers.</p>
                <ul class="solution-bullet-list">
                    <li>Production orders and order cancellation.</li>
                    <li>Issue gold or items to employees and receive gold from employees.</li>
                    <li>Employee wastage handling (hand cut, rough, polish, melt etc.) and wastage recovery.</li>
                    <li>Issue for sales and receive from sales.</li>
                    <li>Billing, sales returns and gold sales.</li>
                    <li>Gold purchasing and stone purchasing.</li>
                </ul>
            </section>

            <section id="gold-stock" class="solution-section">
                <h2 class="solution-section-title">Gold stock</h2>
                <p>Gold stock is tracked at multiple levels to give full visibility of metal movement.</p>
                <ul class="solution-bullet-list">
                    <li>Company gold stock.</li>
                    <li>Main gold stock.</li>
                    <li>Employee gold account.</li>
                    <li>Customer gold account.</li>
                </ul>
            </section>

            <section id="bank" class="solution-section">
                <h2 class="solution-section-title">Bank transactions</h2>
                <p>Banking activities are automated and posted to the relevant ledgers and bank statement.</p>
                <ul class="solution-bullet-list">
                    <li>Cash deposit and cash withdrawal.</li>
                    <li>Internal bank transfers.</li>
                    <li>Standing orders.</li>
                    <li>Bank incomes and bank expenses.</li>
                    <li>Transactions automatically updated to bank account ledger and bank statement.</li>
                </ul>
            </section>

            <section id="accounts" class="solution-section">
                <h2 class="solution-section-title">Accounts integration</h2>
                <p>Automated transactions update all related accounts without manual entry.</p>
                <ul class="solution-bullet-list">
                    <li>Customer &amp; supplier account ledgers (gold &amp; cash).</li>
                    <li>Employee account ledger (gold &amp; cash).</li>
                    <li>Cash &amp; bank accounts.</li>
                    <li>Sales and sales return accounts.</li>
                </ul>
            </section>

            <section id="cheques" class="solution-section">
                <h2 class="solution-section-title">Cheque transactions</h2>
                <p>Cheque handling is integrated with customers, employees and suppliers.</p>
                <ul class="solution-bullet-list">
                    <li>Enter cheque transactions such as issuing and receiving.</li>
                    <li>Deposit cheques to bank and update current status (realised or returned).</li>
                    <li>Allow third‑party payment or end‑cash of received cheques.</li>
                    <li>Account adjustment module for authorised users.</li>
                </ul>
            </section>

            <section id="payroll" class="solution-section">
                <h2 class="solution-section-title">Embedded payroll</h2>
                <p>The embedded payroll module helps manage staff attendance, overtime and salary processing.</p>
                <ul class="solution-bullet-list">
                    <li>Employee attendance tracking.</li>
                    <li>Overtime, leaves, allowances and deductions.</li>
                    <li>Salary advances and increments.</li>
                    <li>Coin‑analysis salary payment and pay sheet generation.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you manufacture jewellery or gold products, we can configure es Gold Manufacturing to match your process, from orders and wastage to payroll.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

