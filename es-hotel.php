<?php
// es-hotel.php – Dedicated solution page: es Hotel Management
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-hotel';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Hotel Management';
$pageTagline = 'Hotel property management – rooms, bookings, restaurant and billing.';

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
                <li><a href="#about">About esHotel Management</a></li>
                <li><a href="#room">Room setup</a></li>
                <li><a href="#hotel">Hotel setup</a></li>
                <li><a href="#transactions">Guests &amp; transactions</a></li>
                <li><a href="#menu">Menu &amp; services</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esHotel Management</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es Hotel overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es Hotel overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $heroImage ? 'es Hotel overview' : 'Add an overview or property dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At e Soft hotel software offers hotel property management systems, hotel management software, reservation software, hotel POS software and hotel back‑office accounting, inventory and payroll software to hotel, restaurant and leisure businesses.</p>
                <p>The hotel software supports hospitality businesses by offering tools for marketing and daily operations as well as management and planning.</p>
            </section>

            <section id="room" class="solution-section">
                <h2 class="solution-section-title">Room setup</h2>
                <ul class="solution-bullet-list">
                    <li>Room creation.</li>
                    <li>Room facilities.</li>
                    <li>Room pictures.</li>
                    <li>Room type.</li>
                    <li>Room category.</li>
                </ul>
            </section>

            <section id="hotel" class="solution-section">
                <h2 class="solution-section-title">Hotel setup</h2>
                <ul class="solution-bullet-list">
                    <li>Hotel master data.</li>
                    <li>Hotel type.</li>
                    <li>Hotel location.</li>
                    <li>Hotel information.</li>
                    <li>Tax and other charges.</li>
                    <li>Countries and call rates.</li>
                    <li>Payment types and credit card types.</li>
                    <li>Travel agents.</li>
                    <li>Booking types.</li>
                </ul>
            </section>

            <section id="transactions" class="solution-section">
                <h2 class="solution-section-title">Guests &amp; transactions</h2>
                <h3 class="solution-subtitle">Guests</h3>
                <ul class="solution-bullet-list">
                    <li>Guest registration.</li>
                    <li>Guest group members.</li>
                    <li>Guest type and guest nationality.</li>
                    <li>Guest history.</li>
                </ul>

                <h3 class="solution-subtitle">Room bookings &amp; changes</h3>
                <ul class="solution-bullet-list">
                    <li>Room booking, booking confirm and booking cancel.</li>
                    <li>Room reserved and room reserved cancel.</li>
                    <li>Change meal plan.</li>
                    <li>Change room.</li>
                </ul>

                <h3 class="solution-subtitle">Guides &amp; sponsorship</h3>
                <ul class="solution-bullet-list">
                    <li>Guide management.</li>
                    <li>Sponsor handling.</li>
                </ul>
            </section>

            <section id="menu" class="solution-section">
                <h2 class="solution-section-title">Menu &amp; services</h2>
                <ul class="solution-bullet-list">
                    <li>Menu, menu items and menu types.</li>
                    <li>Messages, message types and message search.</li>
                    <li>Room service.</li>
                </ul>

                <h3 class="solution-subtitle">Billing &amp; restaurant / bar</h3>
                <ul class="solution-bullet-list">
                    <li>Restaurant bill and restaurant bill reprint.</li>
                    <li>Service bill.</li>
                    <li>Bar bill and bar bill reprint.</li>
                    <li>Telephone bill.</li>
                    <li>Final bill and final bill reprint.</li>
                </ul>

                <h3 class="solution-subtitle">Delivery &amp; orders</h3>
                <ul class="solution-bullet-list">
                    <li>Delivery invoice and delivery order details.</li>
                    <li>Order modify and cancel order.</li>
                    <li>Sales report.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting supports daily hotel operations and management analysis.</p>
                <ul class="solution-bullet-list">
                    <li>Guest details and guest summary.</li>
                    <li>Final bill cancel and day sale.</li>
                    <li>Sponsor‑wise receipt details, income and outstanding.</li>
                    <li>Cancel booking.</li>
                    <li>Room prices report.</li>
                    <li>Booking details.</li>
                    <li>Room availability report.</li>
                    <li>Advance reprint.</li>
                    <li>Category‑wise sales.</li>
                    <li>Room use details and room percentage.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you operate a hotel or resort, we can configure es Hotel Management to match your property, room types, restaurant and billing flows.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

