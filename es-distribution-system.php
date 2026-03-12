<?php
// es-distribution-system.php – Dedicated solution page: es Distribution System
$pageTitle    = 'es Distribution System';
$solutionSlug = 'es-distribution-system';
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/solution-data.php';

// Map images to full URLs
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
                <?php echo htmlspecialchars($solutionTagline ?? 'Distribution management – routes, stock, customers and mobile billing in one system.'); ?>
            </p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About esDistribution</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#invoicing">Invoicing &amp; receipts</a></li>
                <li><a href="#daily-reports">Daily &amp; monthly reports</a></li>
                <li><a href="#analysis-reports">Analysis reports</a></li>
                <li><a href="#other-reports">Other reports</a></li>
                <li><a href="#mobile-distributor">Mobile Distributor</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esDistribution</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if (!empty($solutionImgUrls['hero'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['hero']); ?>" alt="es Distribution overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Distribution overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add an overview or route / stock dashboard image here.</figcaption>
                </figure>
                <p>At es Distribution system is designed to make it easy to manage multiple stores with accurate inventory, price levels and price lists, customer price lists, customer orders and periodic orders. Goods reordering can be automated, and you can see country, territory, area and route‑wise customer sales, outstanding and visiting details.</p>
                <p>The system supports data mining to find new patterns in customer, sales and competitor behaviours. A vehicle maintenance module and sales commission with target monitoring help keep your distribution team organised. Distribution System is fully integrated with Accounts, HR and Inventory and provides important reports for management, auditing and analysis.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Distribution main features</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['features'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['features']); ?>" alt="Distribution features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Distribution features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Optional image for main distribution features.</figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>Multi‑store, multi‑department structure.</li>
                    <li>Country, territory, area and route‑wise customer outstanding and sales.</li>
                    <li>Month and year‑wise sales comparison.</li>
                    <li>Salesmen‑wise invoices, collections, cheque returns and progress of sales &amp; collections reports.</li>
                    <li>Easy to use, easy to train, reliable and focused on higher customer satisfaction &amp; accuracy.</li>
                    <li>Suitable for any kind of distribution, manufacturing &amp; wholesale business.</li>
                </ul>
            </section>

            <section id="invoicing" class="solution-section">
                <h2 class="solution-section-title">Invoicing &amp; receipts</h2>
                <p>Flexible billing and settlement options support real distribution‑life scenarios.</p>
                <ul class="solution-bullet-list">
                    <li>Cash settlement, cheque settlement, over‑payment or multiple settlement methods in a single receipt.</li>
                    <li>Ability to make credit or debit notes using the same interface.</li>
                    <li>Sales reports (summary / detail) and collection reports (summary / detail).</li>
                    <li>Sales item summary reports (summary / detail).</li>
                    <li>Over‑charge / under‑charge report.</li>
                    <li>Customer‑wise sales and returns.</li>
                </ul>
            </section>

            <section id="daily-reports" class="solution-section">
                <h2 class="solution-section-title">Daily &amp; monthly reports</h2>
                <p>Day‑to‑day and period‑end views give you a clear understanding of performance.</p>
                <ul class="solution-bullet-list">
                    <li>Sales analysis.</li>
                    <li>Fast‑moving stock analysis.</li>
                    <li>Slow‑moving stock analysis.</li>
                    <li>Stock age analysis.</li>
                    <li>Customer age analysis.</li>
                    <li>Supplier age analysis.</li>
                </ul>
            </section>

            <section id="analysis-reports" class="solution-section">
                <h2 class="solution-section-title">Analysis &amp; control</h2>
                <p>Additional tools to control pricing and ensure correct posting to stock and customer ledgers.</p>
                <ul class="solution-bullet-list">
                    <li>Change price while billing (price edit option).</li>
                    <li>Multiple bill number ranges according to location.</li>
                    <li>Quotation printing and advance‑payment billing.</li>
                    <li>Room to edit or correct saved invoices before they affect stock and customer ledger.</li>
                    <li>All invoices affect stock &amp; customer ledgers only after day‑end, giving a controlled posting process.</li>
                </ul>
            </section>

            <section id="other-reports" class="solution-section">
                <h2 class="solution-section-title">Other reports</h2>
                <p>Additional reports help you understand customers, suppliers, items and GRN activity.</p>
                <ul class="solution-bullet-list">
                    <li>Customer details report and supplier contacts report.</li>
                    <li>Customer‑wise cheques report.</li>
                    <li>Non‑GRN sold items and bill free quantity issued report.</li>
                    <li>Customer purchase history &amp; customer‑wise item movement report.</li>
                    <li>GRN free received &amp; discounts report.</li>
                    <li>GRN summary supplier‑wise and department‑wise.</li>
                    <li>Bill cancellation report.</li>
                    <li>Item re‑order reports.</li>
                </ul>
            </section>

            <section id="mobile-distributor" class="solution-section">
                <h2 class="solution-section-title">At e Soft Mobile Distributor App</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['mobile-distributor'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['mobile-distributor']); ?>" alt="Mobile Distributor app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile Distributor app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add screenshots of the mobile distributor app here.</figcaption>
                </figure>
                <p>Mobile Billing app is an Android application which is useful for distributors in their day‑to‑day business life. The app is easy to use and supports on‑route billing and collections.</p>
                <h3 class="solution-subtitle">Modes &amp; printing</h3>
                <ul class="solution-bullet-list">
                    <li>Online mode</li>
                    <li>Offline mode</li>
                    <li>Hybrid mode</li>
                    <li>Bluetooth bill printing</li>
                </ul>
                <p>
                    <a class="link-btn" href="es-mobile-app.php">Read more about the Mobile Distributor App <span>→</span></a>
                </p>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you manage distribution, manufacturing or wholesale operations, we can configure es Distribution to match your territory, route and reporting needs.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

