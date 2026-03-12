<?php
// es-gold-retail.php – Dedicated solution page: es Gold Retail
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-gold-retail';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Gold Retail';
$pageTagline = 'Gold retail management – invoicing, orders, gold rate and stock.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Gold retail features: try several keys admin might have used
$goldRetailFeaturesImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['gold-retail-features']
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
                <li><a href="#about">About esGold Retail</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#transactions">Transactions</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esGold Retail</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Gold Retail overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Gold Retail overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Gold Retail overview' : 'Add an overview or shop / counter screen image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Gold Retail system covers all the activities in the gold retail process. esGold Retail is an easy, accurate, fast &amp; reliable solution. Invoicing, item orders, sample order issue, order issue, order cancel, invoice cancellation, order payments, gold rate and reports are all available in the system.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">Gold Retail main features</h2>
                <figure class="solution-figure">
                    <?php if ($goldRetailFeaturesImage): ?>
                    <img src="<?php echo htmlspecialchars($goldRetailFeaturesImage); ?>" alt="Gold retail features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Gold retail features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $goldRetailFeaturesImage ? 'Gold retail features' : 'Optional image for main gold retail features.'; ?>
                    </figcaption>
                </figure>
                <p>The core transaction types for gold retailing are supported in one place.</p>
                <ul class="solution-bullet-list">
                    <li>Invoicing.</li>
                    <li>Item orders.</li>
                    <li>Sample order issue.</li>
                    <li>Order issue.</li>
                    <li>Order cancel.</li>
                    <li>Invoice cancellation.</li>
                    <li>Order payments.</li>
                    <li>Gold rate handling.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Transactions</h2>
                <p>Transactions are tracked for both daily operations and management analysis.</p>
                <ul class="solution-bullet-list">
                    <li>Sales summary and sales details.</li>
                    <li>Invoice order details and invoice order cancel.</li>
                    <li>Sample item handling.</li>
                    <li>Invoice order details according to status.</li>
                    <li>Gold rate change tracking.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting helps understand sales performance and stock across categories and main categories.</p>
                <ul class="solution-bullet-list">
                    <li>Stock report.</li>
                    <li>Category‑wise sale summary.</li>
                    <li>Main category‑wise stock.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you run a gold retail shop, we can configure es Gold Retail to match your billing, order and gold rate practices.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

