<?php
// es-workshop-system.php – Dedicated solution page: es Workshop System
$pageTitle    = 'es Workshop System';
$solutionSlug = 'es-workshop-system';
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
                <?php echo htmlspecialchars($solutionTagline ?? 'Manage hiring, outdoor services and workshop repairs in one system.'); ?>
            </p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About esWorkshop</a></li>
                <li><a href="#features">Main features</a></li>
                <li><a href="#service-flow">Service flow</a></li>
                <li><a href="#setup">Setup &amp; users</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esWorkshop</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if (!empty($solutionImgUrls['hero'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['hero']); ?>" alt="es Workshop overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Workshop overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Add an overview or workshop dashboard image here.</figcaption>
                </figure>
                <p>At es Workshop management system helps you manage three main activities: hiring (tools &amp; equipment), outdoor services and workshop repairs.</p>
                <p>In the hiring module you can hire tools, machinery and accessories with easy recording of customer history, photos, payments and more. Outdoor services can be handled for periodic work and immediate breakdowns. Workshop repairs support job estimates &amp; quotations, required accessory lists with stock availability &amp; reordering, multiple technician assignment per job and monitoring of testing processes. Jobs can be monitored online for status &amp; history. The system is fully integrated with Inventory, Account and HR modules and provides useful reports for management, auditing and analysis.</p>
            </section>

            <section id="features" class="solution-section">
                <h2 class="solution-section-title">At es Workshop main features</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['features'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['features']); ?>" alt="Workshop features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Workshop features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">Optional image for main workshop features.</figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>Accessories registration.</li>
                    <li>Technician records.</li>
                    <li>Company and customer registration.</li>
                    <li>Employee and service type records.</li>
                    <li>Service category, payment and test component configuration.</li>
                    <li>Service job item definitions.</li>
                </ul>
            </section>

            <section id="service-flow" class="solution-section">
                <h2 class="solution-section-title">Service flow</h2>
                <p>Service and repair operations are managed through a clear sequence of steps.</p>
                <h3 class="solution-subtitle">Service handling</h3>
                <ul class="solution-bullet-list">
                    <li>Service registration and intake.</li>
                    <li>Service assign – assign jobs to technicians.</li>
                    <li>Service estimate – prepare job estimates.</li>
                    <li>Service issued – issue jobs from front office to workshop.</li>
                    <li>Service history – full history of service jobs.</li>
                </ul>

                <h3 class="solution-subtitle">Orders &amp; working progress</h3>
                <ul class="solution-bullet-list">
                    <li>Order list and order item supply.</li>
                    <li>Ordering items and received‑from‑company tracking.</li>
                    <li>Working progress tracking.</li>
                    <li>Service search and finishing.</li>
                </ul>
            </section>

            <section id="setup" class="solution-section">
                <h2 class="solution-section-title">Setup &amp; users</h2>
                <p>Setup options help you manage users, security and registration.</p>
                <ul class="solution-bullet-list">
                    <li>Create new user.</li>
                    <li>User groups.</li>
                    <li>Manage users.</li>
                    <li>Set password and set password (other options).</li>
                    <li>Registration and configuration for pricing and services.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting supports operational monitoring and management decisions.</p>
                <ul class="solution-bullet-list">
                    <li>Service received report.</li>
                    <li>Service category‑wise report.</li>
                    <li>Technician‑wise report.</li>
                    <li>Job‑wise employee allocation.</li>
                    <li>Test history report.</li>
                    <li>Job‑wise technician allocation.</li>
                    <li>Technician‑wise income.</li>
                    <li>Monthly job details.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you run a workshop or service centre, we can configure es Workshop System to match your hiring, service and repair processes.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

