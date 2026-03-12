<?php
// es-color-lab-system.php – Dedicated solution page: es Color Lab System
$pageTitle    = 'es Color Lab System';
$solutionSlug = 'es-color-lab-system';
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
                <?php echo htmlspecialchars($solutionTagline ?? 'Complete color lab &amp; studio management – front office to back office.'); ?>
            </p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About esColor Lab</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#color-lab">Color lab operations</a></li>
                <li><a href="#security">User &amp; security features</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esColor Lab</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if (!empty($solutionImgUrls['hero'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['hero']); ?>" alt="es Color Lab overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Color Lab overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add an overview or lab workflow image here.</figcaption>
                </figure>
                <p>At es Color lab &amp; studio management system covers all the activities in color lab &amp; studio front office and back office. It is an easy and fast billing system for lab and studio work.</p>
                <p>There are three types of customer categories and their price lists. The system is fully integrated with esAccounts, esHR and the Retail sales module (POS). You can easily search by customer orders and their order status for photo processing, laminating, picture framing, outdoor filming &amp; job costing. Wedding orders &amp; bookings can be easily managed with useful reports.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es Color Lab main features</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['features'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['features']); ?>" alt="Color lab features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Color lab features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Optional image for main color lab features.</figcaption>
                </figure>

                <h3 class="solution-subtitle">Customer &amp; studio</h3>
                <ul class="solution-bullet-list">
                    <li>Customer registration.</li>
                    <li>Customer area / route management.</li>
                    <li>Professional customer outstanding.</li>
                    <li>Amateur customer handling.</li>
                    <li>Studio management.</li>
                </ul>

                <h3 class="solution-subtitle">Color setting orders</h3>
                <ul class="solution-bullet-list">
                    <li>Color setting orders &amp; inquiries.</li>
                    <li>Color setting payments.</li>
                    <li>Color extra copy orders &amp; inquiries.</li>
                </ul>

                <h3 class="solution-subtitle">Black &amp; white work</h3>
                <ul class="solution-bullet-list">
                    <li>Black &amp; white setting orders &amp; inquiries.</li>
                    <li>Black &amp; white setting payments.</li>
                    <li>Black &amp; white extra copy orders &amp; inquiries.</li>
                    <li>Black &amp; white extra copy payments.</li>
                </ul>

                <h3 class="solution-subtitle">Wedding &amp; booking</h3>
                <ul class="solution-bullet-list">
                    <li>Wedding booking.</li>
                    <li>Wedding booking details &amp; history.</li>
                    <li>Support for outdoor filming and job costing.</li>
                </ul>

                <h3 class="solution-subtitle">Enlargement &amp; studio work</h3>
                <ul class="solution-bullet-list">
                    <li>Enlargement jobs.</li>
                    <li>General studio work integrated with billing.</li>
                </ul>
            </section>

            <section id="color-lab" class="solution-section">
                <h2 class="solution-section-title">Color lab operations</h2>
                <p>Detailed handling of color lab orders, copies, processing and finishing.</p>
                <ul class="solution-bullet-list">
                    <li>Color lab orders &amp; order inquiries.</li>
                    <li>Color lab order payments.</li>
                    <li>Color lab copies &amp; copy inquiries.</li>
                    <li>Color lab photo process orders &amp; order inquiries.</li>
                    <li>Photo process order payments.</li>
                    <li>Laminating &amp; framing orders.</li>
                    <li>Laminating &amp; framing order payments.</li>
                </ul>
            </section>

            <section id="security" class="solution-section">
                <h2 class="solution-section-title">User &amp; security features</h2>
                <p>User and security management helps control access and maintain accurate pricing.</p>
                <ul class="solution-bullet-list">
                    <li>User privileges and user groups.</li>
                    <li>Manage user and registration.</li>
                    <li>Create new user and set passwords.</li>
                    <li>Change password.</li>
                    <li>Maintain price lists and registration information.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting helps you track collections, customer activity and overall performance.</p>
                <ul class="solution-bullet-list">
                    <li>Customer search.</li>
                    <li>Collection summary.</li>
                    <li>Customer and job‑related reports across the lab and studio processes.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you manage a color lab or studio, we can configure es Color Lab System to match your exact services and workflows.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

