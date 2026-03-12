<?php
// es-hospital.php – Dedicated solution page: es Hospital System
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-hospital';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Hospital System';
$pageTagline = 'Hospital management – channeling, OPD, lab, ward and ECG in one system.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage = $solutionImgUrls['hero'] ?? null;
// Channeling module: try several keys admin might have used
$channelingImage = $solutionImgUrls['main-features']
    ?? $solutionImgUrls['channeling']
    ?? $solutionImgUrls['channeling-module']
    ?? $solutionImgUrls['channeling-system']
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
                <li><a href="#about">About esHospital</a></li>
                <li><a href="#channeling">Channeling system</a></li>
                <li><a href="#opd">OPD system</a></li>
                <li><a href="#lab">Lab system</a></li>
                <li><a href="#doctor">Doctor &amp; payments</a></li>
                <li><a href="#ecg">ECG</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esHospital</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Hospital overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Hospital overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Hospital overview' : 'Add an overview or hospital / ward dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At e Soft Hospital system covers activities in medical lab, channeling, OPD, X‑Ray and ward front office &amp; back office. It supports collecting samples, patient history data and reports, and is integrated with the Account system.</p>
            </section>

            <section id="channeling" class="solution-section">
                <h2 class="solution-section-title">At es Hospital – channeling system</h2>
                <figure class="solution-figure">
                    <?php if ($channelingImage): ?>
                    <img src="<?php echo htmlspecialchars($channelingImage); ?>" alt="Channeling module" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Channeling module</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $channelingImage ? 'Channeling module' : 'Optional image for channeling or appointment screens.'; ?>
                    </figcaption>
                </figure>
                <ul class="solution-bullet-list">
                    <li>Channeling and doctor availability.</li>
                    <li>Doctor appointment and e‑channeling.</li>
                    <li>Doctor‑wise appointment report.</li>
                    <li>Hospital‑wise doctor appointment report.</li>
                    <li>Shift doctor appointment.</li>
                    <li>Cancel doctor appointment and refund doctor appointment.</li>
                    <li>Day‑end channeling report.</li>
                    <li>Patient registration and patient symptoms.</li>
                    <li>Patient history and patient monitoring.</li>
                    <li>Patient charges and discharge bill.</li>
                    <li>Admitted patients report.</li>
                    <li>Day‑end collection.</li>
                </ul>
            </section>

            <section id="opd" class="solution-section">
                <h2 class="solution-section-title">OPD system</h2>
                <p>OPD (out‑patient department) handling includes minor procedures and collections.</p>
                <ul class="solution-bullet-list">
                    <li>Minor surgery.</li>
                    <li>Medicine and other payments.</li>
                    <li>Day‑end OPD report.</li>
                    <li>Add new records for OPD.</li>
                    <li>Sample order, sample report and day‑end sample collection.</li>
                </ul>
            </section>

            <section id="lab" class="solution-section">
                <h2 class="solution-section-title">Lab system</h2>
                <p>Lab module supports test sample orders, results and sample handling.</p>
                <ul class="solution-bullet-list">
                    <li>Test sample order and test sample result.</li>
                    <li>Sample issue.</li>
                    <li>Sample order reprint and delete.</li>
                    <li>Refund handling.</li>
                </ul>

                <h3 class="solution-subtitle">Lab reports</h3>
                <ul class="solution-bullet-list">
                    <li>Sample received report.</li>
                    <li>Doctor‑wise test report.</li>
                    <li>Daily total collection.</li>
                    <li>Patient‑wise test report.</li>
                    <li>Free‑of‑charge report.</li>
                    <li>Delete sample test report.</li>
                    <li>Refund report.</li>
                </ul>
            </section>

            <section id="doctor" class="solution-section">
                <h2 class="solution-section-title">Doctor &amp; payments</h2>
                <ul class="solution-bullet-list">
                    <li>Doctor registration.</li>
                    <li>Doctor payments.</li>
                    <li>Doctor payment report.</li>
                </ul>
            </section>

            <section id="ecg" class="solution-section">
                <h2 class="solution-section-title">ECG</h2>
                <p>ECG module supports order handling and day‑end collections.</p>
                <ul class="solution-bullet-list">
                    <li>ECG order.</li>
                    <li>Day‑end ECG collection report.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a hospital, lab or medical centre, we can configure es Hospital System to match your channeling, OPD, lab and ward workflows.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

