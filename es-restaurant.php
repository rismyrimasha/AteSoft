<?php
// es-restaurant.php – Dedicated solution page: es Restaurant System
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-restaurant';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Restaurant System';
$pageTagline = 'Restaurant management – tables, KOT/BOT, billing and inventory‑linked recipes.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$overviewImage   = $solutionImgUrls['overview'] ?? ($solutionImgUrls['hero'] ?? null);
$counterImage    = $solutionImgUrls['counter-billing'] ?? null;
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
                <li><a href="#about">About esRestaurant</a></li>
                <li><a href="#counter-billing">Counter &amp; billing</a></li>
                <li><a href="#tables">Tables &amp; service</a></li>
                <li><a href="#items">Items &amp; recipes</a></li>
                <li><a href="#payment">Payment options</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#security">Security</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esRestaurant</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($overviewImage): ?>
                    <img src="<?php echo htmlspecialchars($overviewImage); ?>" alt="es Restaurant overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Restaurant overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $overviewImage ? 'es Restaurant overview' : 'Add an overview or table layout screen image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Restaurant system is easy to operate and train – an accurate and effective solution for restaurants. KOT (Kitchen Order Ticket) and BOT (Bar Order Ticket) are automated with relevant service counters. You can visually monitor tables and customer order status.</p>
                <p>The system supports multiple price lists according to the service (AC / non‑AC). Recipes for each prepared item are integrated with inventory. It supports multiple customers for a single table, take‑away, delivery orders and periodic orders, with higher security. It is fully integrated with Accounts, Inventory and HR and provides useful reports for management, auditing and analysis.</p>
            </section>

            <section id="counter-billing" class="solution-section">
                <h2 class="solution-section-title">Counter &amp; billing</h2>
                <figure class="solution-figure">
                    <?php if ($counterImage): ?>
                    <img src="<?php echo htmlspecialchars($counterImage); ?>" alt="Counter &amp; billing" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Counter &amp; billing</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $counterImage ? 'Counter &amp; billing' : 'Optional image for billing or KOT/BOT counters.'; ?>
                    </figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>Separate counters for bar, kitchen and other services.</li>
                    <li>KOT / BOT printing in particular counters.</li>
                    <li>Invoices (general / super class).</li>
                    <li>Service charges (percentage).</li>
                    <li>Discount (percentage / amount).</li>
                    <li>On‑hold bills &amp; recall; add more items into an existing bill.</li>
                    <li>Take‑away billing.</li>
                </ul>
            </section>

            <section id="tables" class="solution-section">
                <h2 class="solution-section-title">Tables &amp; service</h2>
                <ul class="solution-bullet-list">
                    <li>Normal price tables and super‑class price tables.</li>
                    <li>Multiple table handling.</li>
                    <li>Multiple customers for a single table.</li>
                    <li>Multiple waiters for a single table.</li>
                </ul>
            </section>

            <section id="items" class="solution-section">
                <h2 class="solution-section-title">Items &amp; recipes</h2>
                <p>Item and recipe handling is tightly integrated with inventory.</p>
                <ul class="solution-bullet-list">
                    <li>Items (complete or raw materials).</li>
                    <li>Categorising items.</li>
                    <li>Raw material stock handling according to recipes.</li>
                    <li>Item stock movement (item bin card).</li>
                    <li>Dividing an item into KOT &amp; BOT counters.</li>
                    <li>Inserting recipes by using raw materials.</li>
                </ul>
            </section>

            <section id="payment" class="solution-section">
                <h2 class="solution-section-title">Payment options</h2>
                <ul class="solution-bullet-list">
                    <li>Cash.</li>
                    <li>Credit card.</li>
                    <li>Credit customer.</li>
                    <li>Complementary.</li>
                    <li>Foreign currency.</li>
                    <li>Cheque.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting supports daily operations, stock control and management analysis.</p>
                <ul class="solution-bullet-list">
                    <li>Day‑end bill summary / detail reports.</li>
                    <li>Counter‑wise KOT / BOT reports.</li>
                    <li>Counter‑wise item, sales and stock reports.</li>
                    <li>Waiter performance analysing report.</li>
                    <li>Table‑wise sale analysing report.</li>
                    <li>Sales category‑wise details / summary.</li>
                    <li>Fast‑ and slow‑moving stock reports.</li>
                    <li>Supplier‑wise item re‑order report.</li>
                    <li>Hourly sales analysis report.</li>
                    <li>Management &amp; auditing reports, and many more features.</li>
                </ul>
            </section>

            <section id="security" class="solution-section">
                <h2 class="solution-section-title">Security</h2>
                <ul class="solution-bullet-list">
                    <li>Multi‑level security.</li>
                    <li>Secure login for each user.</li>
                    <li>All events can be monitored by the administrator.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a restaurant or bar, we can configure es Restaurant System to match your tables, counters, recipes and billing flows.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

