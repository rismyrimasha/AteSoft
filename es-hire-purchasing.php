<?php
// es-hire-purchasing.php – Dedicated solution page: es Hire Purchasing
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-hire-purchasing';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Hire Purchasing';
$pageTagline = 'Easy payment and hire purchasing management – sales, instalments and reports.';

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
                <li><a href="#about">About esHire Purchasing</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#stock">Stock &amp; locations</a></li>
                <li><a href="#searching">Searching options</a></li>
                <li><a href="#bank">Bank transactions</a></li>
                <li><a href="#cheques">Cheque transactions</a></li>
                <li><a href="#service">Service &amp; repairs</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esHire Purchasing</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Hire Purchasing overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Hire Purchasing overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Hire Purchasing overview' : 'Add an overview or dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Hire purchasing management system covers all the activities in hire purchasing sales. Bulk purchasing, discounts, payment instalments in straight line &amp; reducing balance, receipts, to‑date closing balance, rebates, various reports for management decisions, analysis &amp; auditing reports, stock movement with product serial numbers, daily collections &amp; payments are handled in one system.</p>
                <p>Various sales types such as cash, credit, group, individual &amp; user‑defined invoice types are supported, together with account reschedule &amp; early settlement ability. The system is fully integrated with accounts and HR. With web‑enabled front office &amp; back office, you can reduce staff &amp; overheads by using the online system. It’s fast, reliable &amp; user friendly.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Hire Purchasing main features</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['main-features'])): ?>
                    <img src="<?php echo htmlspecialchars($solutionImgUrls['main-features']); ?>" alt="Main hire purchasing features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Main hire purchasing features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo !empty($solutionImgUrls['main-features']) ? 'Main hire purchasing features' : 'Optional image for main features.'; ?>
                    </figcaption>
                </figure>
                <p>This product is used to perform the operations of Hire Purchasing (Easy Payment) business.</p>
                <ul class="solution-bullet-list">
                    <li>Easier tracking of customer, supplier and salesman‑wise outstanding according to area and route.</li>
                    <li>Item purchasing and selling (cash &amp; credit) with various payment methods.</li>
                    <li>Sales returns, purchase returns and supplier payments.</li>
                    <li>Support for different sales types such as cash, credit, group and individual plans.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>The system provides a wide range of reports to support management decisions, analysis and auditing.</p>
                <ul class="solution-bullet-list">
                    <li>Customer and supplier outstanding reports &amp; payment history.</li>
                    <li>Group, individual &amp; interest‑free sales and payment history.</li>
                    <li>Salesman‑wise commission and outstanding reports.</li>
                    <li>Many additional auditing and management reports.</li>
                </ul>
            </section>

            <section id="stock" class="solution-section">
                <h2 class="solution-section-title">Stock &amp; locations</h2>
                <p>Stock handling and movement between locations is integrated with hire purchasing.</p>
                <ul class="solution-bullet-list">
                    <li><strong>Good Receive Note (GRN)</strong> – purchase items from suppliers.</li>
                    <li><strong>Purchase Return Note (PRN)</strong> – reject / return items to suppliers.</li>
                    <li><strong>Good Transfer Note (GIN)</strong> – transfer items to business locations such as stores and showrooms.</li>
                    <li>Stock movement with product serial numbers and location information.</li>
                </ul>
                <p>For central purchasing systems, each location transaction can be updated with the head office through dial‑up connections or online links.</p>
            </section>

            <section id="searching" class="solution-section">
                <h2 class="solution-section-title">Searching options</h2>
                <p>The system offers powerful search options for both customers and items.</p>
                <ul class="solution-bullet-list">
                    <li>Find a customer by using any information such as Name, Account No, Join Date or NIC No.</li>
                    <li>Find a model easily by using any part of the model name or number.</li>
                </ul>
            </section>

            <section id="bank" class="solution-section">
                <h2 class="solution-section-title">Bank transactions</h2>
                <p>Bank transactions are integrated with the ledger and bank statements.</p>
                <ul class="solution-bullet-list">
                    <li>Cash deposit and cash withdrawal.</li>
                    <li>Internal bank transfers.</li>
                    <li>Standing orders.</li>
                    <li>Bank incomes and bank expenses.</li>
                    <li>All transactions are automatically updated to bank account ledger &amp; bank statement.</li>
                </ul>
            </section>

            <section id="cheques" class="solution-section">
                <h2 class="solution-section-title">Cheque transactions</h2>
                <p>Cheque handling is closely linked with customers and creditors (suppliers).</p>
                <ul class="solution-bullet-list">
                    <li>Enter issuing &amp; receiving cheques that involve customers and suppliers.</li>
                    <li>Deposit cheques to bank and maintain current status such as realised or returned.</li>
                    <li>Allow third‑party payment or end‑cash of received cheques.</li>
                    <li>Maintain cheque calendar and related follow‑ups.</li>
                </ul>
            </section>

            <section id="service" class="solution-section">
                <h2 class="solution-section-title">Service &amp; repairs</h2>
                <p>The system can maintain records of repairs and service jobs.</p>
                <ul class="solution-bullet-list">
                    <li>Service note creation.</li>
                    <li>Issue for service and receive from service.</li>
                    <li>Issue repaired items back to the customer.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you are running a hire purchasing or easy payment business, we can tailor es Hire Purchasing to match your exact process.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

