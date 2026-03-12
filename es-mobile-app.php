<?php
// es-mobile-app.php – Dedicated page: es Mobile Apps
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-mobile-app';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Mobile Apps';
$pageTagline = 'Mobile billing, distribution and MIS apps that work online or offline.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$heroImage           = $solutionImgUrls['hero'] ?? null;
$mobilePosImage      = $solutionImgUrls['mobile-pos'] ?? null;
$mobileDistributor   = $solutionImgUrls['mobile-distributor'] ?? null;
$mobileMisImage      = $solutionImgUrls['mobile-mis'] ?? null;
// Mobile Pawning app: try several keys admin might have used
$mobilePawningImage = $solutionImgUrls['mobile-pawning']
    ?? $solutionImgUrls['mobile-pawning-app']
    ?? $solutionImgUrls['mobile-app']
    ?? null;
// Mobile Case Management app: try several keys admin might have used
$mobileCaseImage = $solutionImgUrls['mobile-case']
    ?? $solutionImgUrls['mobile-case-management']
    ?? $solutionImgUrls['mobile-case-management-app']
    ?? $solutionImgUrls['case-management']
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
            <div class="section-label">Mobile apps</div>
            <h1 class="solution-page-title"><?php echo htmlspecialchars($pageTitle); ?></h1>
            <p class="solution-page-tagline"><?php echo htmlspecialchars($pageTagline); ?></p>
        </div>
    </section>

    <div class="container solution-page-layout">
        <nav class="solution-toc" aria-label="Page contents">
            <div class="solution-toc-title">On this page</div>
            <ul class="solution-toc-list">
                <li><a href="#about">About esMobile Apps</a></li>
                <li><a href="#mobile-pos">Mobile POS App</a></li>
                <li><a href="#mobile-distributor">Mobile Distributor App</a></li>
                <li><a href="#mobile-mis">Mobile MIS Information App</a></li>
                <li><a href="#mobile-pawning">Mobile Pawning Reports App</a></li>
                <li><a href="#mobile-case">Mobile Case Management App</a></li>
                <li><a href="#other-apps">Other mobile apps</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esMobile Apps</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Mobile apps overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Mobile apps overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Mobile apps overview' : 'Add a composite image of your mobile apps here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Mobile apps are introduced for a wide range of retail and wholesale business processes in day‑to‑day life. The apps are reliable, uncomplicated and provide fast billing mechanisms that can work with or without internet.</p>
                <p>Mobile POS Billing App incorporates Bluetooth technology. Customer satisfaction billing and viewing accounts information are key advantages. Mobile apps are fully integrated with the accounting package and, where relevant, with inventory and other es systems.</p>
            </section>

            <section id="mobile-pos" class="solution-section">
                <h2 class="solution-section-title">Mobile POS App</h2>
                <figure class="solution-figure">
                    <?php if ($mobilePosImage): ?>
                    <img src="<?php echo htmlspecialchars($mobilePosImage); ?>" alt="Mobile POS app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile POS app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $mobilePosImage ? 'Mobile POS app' : 'Add screenshots of the Mobile POS app here.'; ?>
                    </figcaption>
                </figure>
                <p>Mobile POS App is an ideal mobile billing system for any kind of retail and wholesale business. It is reliable, uncomplicated and supports fast billing, working with or without internet. It incorporates Bluetooth bill printing and is fully integrated with the accounting package.</p>

                <h3 class="solution-subtitle">Search options</h3>
                <ul class="solution-bullet-list">
                    <li>Trade‑name‑wise search.</li>
                    <li>Item‑code‑wise search.</li>
                    <li>Department‑wise search.</li>
                </ul>

                <h3 class="solution-subtitle">Payments &amp; other options</h3>
                <ul class="solution-bullet-list">
                    <li>Cash payment with editable bill before cashing.</li>
                    <li>Cash and cheque payment.</li>
                    <li>Cash and credit‑card payment.</li>
                    <li>Cash and gift‑voucher payment.</li>
                    <li>Credit given and credit payment.</li>
                    <li>Customer ledger and supplier ledger view.</li>
                    <li>Credit note and debit note.</li>
                    <li>Upload, bill print and bill list.</li>
                </ul>
            </section>

            <section id="mobile-distributor" class="solution-section">
                <h2 class="solution-section-title">Mobile Distributor App</h2>
                <figure class="solution-figure">
                    <?php if ($mobileDistributor): ?>
                    <img src="<?php echo htmlspecialchars($mobileDistributor); ?>" alt="Mobile Distributor app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile Distributor app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $mobileDistributor ? 'Mobile Distributor app' : 'Add screenshots of the distributor billing app here.'; ?>
                    </figcaption>
                </figure>
                <p>Mobile Billing app is an Android application which is useful for distributors in their up‑to‑date business life. The app is easy to use and supports on‑route billing and collections.</p>

                <h3 class="solution-subtitle">Modes &amp; printing</h3>
                <ul class="solution-bullet-list">
                    <li>Online mode.</li>
                    <li>Offline mode.</li>
                    <li>Hybrid mode.</li>
                    <li>Bluetooth bill printing.</li>
                </ul>

                <h3 class="solution-subtitle">Other features</h3>
                <ul class="solution-bullet-list">
                    <li>View previous bills, set default bill and view default bill.</li>
                    <li>Customer options with reports and customer outstanding.</li>
                    <li>Cheque return and cheques to be realised.</li>
                    <li>Customer ledger.</li>
                    <li>Payment options: cash, cheque, credit card, gift voucher, credit given.</li>
                </ul>
            </section>

            <section id="mobile-mis" class="solution-section">
                <h2 class="solution-section-title">Mobile MIS Information App</h2>
                <figure class="solution-figure">
                    <?php if ($mobileMisImage): ?>
                    <img src="<?php echo htmlspecialchars($mobileMisImage); ?>" alt="Mobile MIS app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile MIS app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $mobileMisImage ? 'Mobile MIS app' : 'Add screenshots of MIS reports and graphs here.'; ?>
                    </figcaption>
                </figure>
                <p>MIS Online Report App is an Android application for managerial‑level users to view overall outputs such as income, profits and losses in their up‑to‑date business process. Many factors are available to support correct decisions.</p>

                <h3 class="solution-subtitle">Report categories (examples)</h3>
                <ul class="solution-bullet-list">
                    <li>Sales – collection summary, returns, totals by date, month and year.</li>
                    <li>Sales by location, department, supplier and salesman.</li>
                    <li>Stock – summaries, department‑wise, item search, expired items, stock quantity, zero / negative stock.</li>
                    <li>GP margin and cost vs sale‑price checks.</li>
                    <li>Stock taking – supplier‑wise and location‑wise.</li>
                    <li>Purchase and purchase‑return summaries by date range.</li>
                    <li>Cheques in hand / issued and bank balances.</li>
                    <li>Debtors and creditors – outstanding by location, customer / supplier, credit limits and birthdays.</li>
                    <li>Day summary and graph reports.</li>
                </ul>

                <h3 class="solution-subtitle">Other features</h3>
                <p>You can change the background of the report; select any image as desired from settings.</p>
            </section>

            <section id="mobile-pawning" class="solution-section">
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
                        <?php echo $mobilePawningImage ? 'Mobile Pawning app' : 'Add screenshots of the pawning reports app here.'; ?>
                    </figcaption>
                </figure>
                <p>Mobile Pawning app is introduced to view online reports. It is a managerial‑level application used to make decisions on the pawning business.</p>
                <p>Receipt, stock, release, sales item, own release, search and day summary reports are available, together with a security log module.</p>
            </section>

            <section id="mobile-case" class="solution-section">
                <h2 class="solution-section-title">Mobile Case Management App</h2>
                <figure class="solution-figure">
                    <?php if ($mobileCaseImage): ?>
                    <img src="<?php echo htmlspecialchars($mobileCaseImage); ?>" alt="Mobile Case Management app" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Mobile Case Management app</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $mobileCaseImage ? 'Mobile Case Management app' : 'Add screenshots of the legal case management app here.'; ?>
                    </figcaption>
                </figure>
                <p>At e Soft Case Management System is an ideal software solution for legal case management. Lawyers can manage their client and case details efficiently from Android smartphones or tablet PCs.</p>
                <p>The legal case management system revolves around the Case, Client and Contacts databases. From these three you can control and work every legal case handled by the law firm.</p>
            </section>

            <section id="other-apps" class="solution-section">
                <h2 class="solution-section-title">Other mobile apps</h2>
                <p>Additional apps such as Mobile POS Bucket App and Mobile Restaurant App can be added to match your business requirements. Each app can be tailored and integrated with your main es systems.</p>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you are interested in extending your es systems to mobile devices, we can help select and configure the right es Mobile Apps for you.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

