<?php
// es-pawn-management.php – Dedicated solution page: es Pawn Management
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-pawn-management';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Pawn Management';
$pageTagline = 'Pawning management – receipts, renewals, gold stock and mobile reports.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Pawn features: try several keys admin might have used
$pawnFeaturesImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['pawn-features']
    ?? $solutionImgUrls['pawn-management-features']
    ?? $solutionImgUrls['features']
    ?? null;
// Mobile Pawning app section
$mobilePawningImage = $solutionImgUrls['mobile-pawning']
    ?? $solutionImgUrls['mobile-pawning-app']
    ?? $solutionImgUrls['mobile-app']
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
                <li><a href="#about">About esPawning</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#transactions">Transactions</a></li>
                <li><a href="#utility">Utility &amp; tools</a></li>
                <li><a href="#security">System security</a></li>
                <li><a href="#letters">Letters</a></li>
                <li><a href="#reports">Reports &amp; pawn stock</a></li>
                <li><a href="#mobile-app">Mobile Pawning Reports App</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esPawning</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Pawn overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Pawn overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Pawn overview' : 'Add an overview or pawn summary dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Pawn management system is easy to handle with various search options, customer history, blacklist handling, day collection summary &amp; details of all transactions, quick check lists, gold stock and pawn category wise views.</p>
                <p>It supports reminder letters in multiple steps, taking ownership, customised pawn methods with security, interest rates and pawn rescheduling. The system is fully integrated with accounts and HR modules and provides useful reports for management, auditing and analysis.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Pawn Management main features</h2>
                <figure class="solution-figure">
                    <?php if ($pawnFeaturesImage): ?>
                    <img src="<?php echo htmlspecialchars($pawnFeaturesImage); ?>" alt="Pawn features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Pawn features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $pawnFeaturesImage ? 'Pawn features' : 'Optional image for main pawn features.'; ?>
                    </figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>User‑friendly, easy to use and online receipts.</li>
                    <li>Each transaction monitoring, fast &amp; reliable solution.</li>
                    <li>Customer registration with national ID, passport number, name and other details.</li>
                    <li>Blacklist customers and block their transactions at any location.</li>
                    <li>Item categorisation with gold type, interest levels and pawn methods.</li>
                    <li>Pawn receipts, pawn release and owner release handling.</li>
                    <li>Salesman‑wise sales reports, daily income &amp; expenses.</li>
                    <li>Cancel receipts, cancel release and gold stock with current gold rate.</li>
                    <li>History of gold rate variation with graphs.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Transactions</h2>
                <p>Core pawning transactions are handled with full audit and reporting support.</p>
                <ul class="solution-bullet-list">
                    <li>Receipt and release.</li>
                    <li>Interest payment and owner release.</li>
                    <li>Cancel receipt and cancel release.</li>
                    <li>Day opening balance.</li>
                    <li>Daily income and daily expenses.</li>
                    <li>Day book.</li>
                    <li>Edit receipt details and customer information.</li>
                    <li>Customer information and gold rate management.</li>
                    <li>Weight‑wise receipt handling.</li>
                    <li>Service and sale items, sale receipts and sale receipt search.</li>
                    <li>Cancel sale receipt and change renewal date.</li>
                    <li>Stock transfer.</li>
                </ul>
            </section>

            <section id="utility" class="solution-section">
                <h2 class="solution-section-title">Utility &amp; tools</h2>
                <p>Utilities support user management, enquiries and adjustments.</p>
                <ul class="solution-bullet-list">
                    <li>Add new user and change password.</li>
                    <li>Search and EMI search, pawn inquiry.</li>
                    <li>Reminding letter, warning letter and final warning letter generation.</li>
                    <li>Customer shortage/excess handling.</li>
                    <li>Blacklist customer and blacklist item.</li>
                    <li>Customer’s full details view.</li>
                    <li>Edit unsettled advances and sale details.</li>
                    <li>Release or receipt details view.</li>
                    <li>Send SMS.</li>
                </ul>
            </section>

            <section id="security" class="solution-section">
                <h2 class="solution-section-title">System security</h2>
                <p>Security, backup and auditing protect data and operations.</p>
                <ul class="solution-bullet-list">
                    <li>User‑wise menu privilege.</li>
                    <li>Database backup and backup schedule.</li>
                    <li>Backup history tracking.</li>
                    <li>Each transaction auditing ability.</li>
                </ul>
            </section>

            <section id="letters" class="solution-section">
                <h2 class="solution-section-title">Letters</h2>
                <ul class="solution-bullet-list">
                    <li>Reminding letters.</li>
                    <li>Warning letters.</li>
                    <li>Final warning letters.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports &amp; pawn stock</h2>
                <p>Comprehensive reports support daily operations, analysis and statutory requirements.</p>
                <h3 class="solution-subtitle">Receipt and release reports</h3>
                <ul class="solution-bullet-list">
                    <li>Receipt and receipt details (gold / other).</li>
                    <li>Cancel receipt and receipt payment / receipt payment cancel.</li>
                    <li>Change renewal date.</li>
                    <li>Release and release details (gold / other).</li>
                    <li>Cancel release and same‑day release.</li>
                    <li>Change interest release and release information.</li>
                    <li>Own release and own release cancel.</li>
                    <li>Remaining pawn and monthly summary.</li>
                    <li>Renew receipt.</li>
                </ul>

                <h3 class="solution-subtitle">Financial &amp; sales reports</h3>
                <ul class="solution-bullet-list">
                    <li>Balance sheet, income report and expenses report.</li>
                    <li>Sale item report and sale item cancel report.</li>
                    <li>Sales analysis reports.</li>
                    <li>User‑wise pawn and pawn summary.</li>
                </ul>

                <h3 class="solution-subtitle">Pawn stock &amp; advance</h3>
                <ul class="solution-bullet-list">
                    <li>Pawn stock – item wise, receipt wise, all types, gold and other.</li>
                    <li>Owner release stock and category‑wise stock.</li>
                    <li>Receipt amount report.</li>
                    <li>Advance item and advance payment reports.</li>
                    <li>Advance item and advance item cancel reports.</li>
                    <li>Same‑day advance release.</li>
                </ul>
            </section>

            <section id="mobile-app" class="solution-section">
                <h2 class="solution-section-title">Mobile Pawning Reports App</h2>
                <figure class="solution-figure">
                    <?php if ($mobilePawningImage): ?>
                    <img src="<?php echo htmlspecialchars($mobilePawningImage); ?>" alt="Mobile Pawning app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile Pawning app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $mobilePawningImage ? 'Mobile Pawning app' : 'Add screenshots of the mobile pawning reports app here.'; ?>
                    </figcaption>
                </figure>
                <p>Mobile Pawning app is introduced to view online reports, giving owners and managers up‑to‑date visibility into pawning activity from anywhere.</p>
                <p>
                    <a class="link-btn" href="es-mobile-app.php">Read more about the Mobile Pawning Reports App <span>→</span></a>
                </p>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you run a pawning business, we can configure es Pawn Management to match your interest methods, letter steps and reporting needs.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

