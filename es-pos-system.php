<?php
// es-pos-system.php – Dedicated solution page: es POS System
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-pos-system';
require __DIR__ . '/includes/solution-data.php';
$pageTitle = $solutionTitle ?? 'es POS System';
$pageTagline = $solutionTagline ?? 'Customer satisfaction billing system – easy, fast, reliable.';
// Build full URLs for all solution images
$solutionImgUrls = [];
foreach ($solutionImages as $k => $path) {
    $solutionImgUrls[$k] = $BASE_URL . '/' . $path;
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
                <li><a href="#about">About es POS</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#business-types">Business types</a></li>
                <li><a href="#modules">Modules</a></li>
                <li><a href="#module-front-office">Pos Front Office</a></li>
                <li><a href="#module-back-office">Pos Back Office</a></li>
                <li><a href="#module-barcode-writer">Barcode Writer</a></li>
                <li><a href="#module-quick-view">Quick view</a></li>
                <li><a href="#module-auto-synchro">Auto-synchro</a></li>
                <li><a href="#module-mobile-pos">Mobile Pos</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About es POS</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($heroImage): ?>
                    <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="es POS overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: es POS overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption"><?php echo $heroImage ? 'es POS overview' : 'Add an overview or dashboard image here.'; ?></figcaption>
                </figure>
                <p>At es POS System facilitates achieving all kinds of retail business. The POS system is a customer satisfaction billing system including the following features: easy, fast, reliable, customer loyalty module, various discounts, gift voucher, credit customer, salesmen-wise sale tracking, higher security, alerts for specific tasks, integrated with fully es Accounting and es HR module, easy data analysis and data mining ability, useful report module, ability for managerial decision making in seconds, online &amp; offline billing. There are more features available.</p>
                <p>Web-enabled Back office system will help you to work 24 hours online. With the compatibility of POS you can reduce staff &amp; overheads by using the online system. It’s fast, reliable &amp; user friendly.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">At es POS main features</h2>
                <figure class="solution-figure">
                    <?php if (!empty($solutionImgUrls['main-features'])): ?>
                    <img src="<?php echo htmlspecialchars($solutionImgUrls['main-features']); ?>" alt="Main features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Main features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption"><?php echo !empty($solutionImgUrls['main-features']) ? 'Main features' : 'Optional image for main features.'; ?></figcaption>
                </figure>
                <p>At es POS Retailer is a software product that helps to perform all kinds of retail business. At es POS Systems help you with easy, fast, reliable &amp; customer satisfaction billing. Easy handling with customer scorecard, discount card, greeting card, vendor tracking &amp; accounts, stock, outlets, stores, and many more features.</p>
            </section>

            <section id="business-types" class="solution-section">
                <h2 class="solution-section-title">At es POS system has been installed in the following businesses</h2>
                <ul class="solution-bullet-list">
                    <li>Hypermarket</li>
                    <li>Super markets</li>
                    <li>Pharmacies</li>
                    <li>Motor spare part shops</li>
                    <li>Gem &amp; Jewelry shops</li>
                    <li>Fashion shops (Textiles)</li>
                    <li>Fancy items shops</li>
                    <li>Pubs &amp; Restaurants</li>
                    <li>Electronic spare part shops</li>
                    <li>Book shops &amp; Stationery</li>
                </ul>
            </section>

            <section id="modules" class="solution-section">
                <h2 class="solution-section-title">At es POS Retailer – combination of 6 modules</h2>

                <article id="module-front-office" class="solution-module">
                    <h3 class="solution-module-title">Pos Front Office</h3>
                    <p>At es POS front office is used for all kinds of sales desktop activities.</p>
                    <button type="button" class="read-more-toggle" aria-expanded="false" data-read-more="front-office">Read more</button>
                    <div id="read-more-front-office" class="read-more-content" hidden>
                        <h4 class="solution-subtitle">At es POS Front Office main features</h4>
                        <figure class="solution-figure">
                            <?php if (!empty($solutionImgUrls['front-office'])): ?>
                            <img src="<?php echo htmlspecialchars($solutionImgUrls['front-office']); ?>" alt="Front office" class="solution-img">
                            <?php else: ?>
                            <div class="solution-img-placeholder" aria-hidden="true">
                                <span>Image: Front office</span>
                            </div>
                            <?php endif; ?>
                            <figcaption class="solution-figcaption">Front office screenshot or photo.</figcaption>
                        </figure>
                        <ul class="solution-feature-list">
                            <li>Display demo message</li>
                            <li>Name, quantity, unit price &amp; sub total</li>
                            <li>Accumulated total</li>
                            <li>Balance amount</li>
                            <li>Customer welcome message</li>
                            <li>Customer name &amp; bonus point</li>
                            <li>Counter status</li>
                            <li>Easy to use, easy to learn, higher reliability</li>
                            <li>Online system with multi user</li>
                            <li>Easy to train, security</li>
                        </ul>
                        <h4 class="solution-subtitle">Security</h4>
                        <ul class="solution-feature-list">
                            <li>Multilevel security</li>
                            <li>Create new user with menu privileges</li>
                            <li>Block user logging</li>
                            <li>User group privileges</li>
                            <li>Change user password at any time</li>
                            <li>User activity monitoring system</li>
                            <li>Counter auto/manual locking/unlocking</li>
                        </ul>
                        <h4 class="solution-subtitle">Discount &amp; customer card system</h4>
                        <ul class="solution-feature-list">
                            <li>Customer group wise discount card method</li>
                            <li>Item group wise different discount rates</li>
                            <li>Item wise or overall discount % or amount</li>
                            <li>Different discount rates for cashier wise</li>
                        </ul>
                        <h4 class="solution-subtitle">Billing</h4>
                        <ul class="solution-feature-list">
                            <li>Fast billing with Touch System, Barcode &amp; programming keyboard</li>
                            <li>Dual color receipt printing (Red &amp; Black)</li>
                            <li>Direct fast printing method</li>
                            <li>Header &amp; details with different font size and colors</li>
                            <li>Auto cutter or manual tear off</li>
                            <li>General invoice note</li>
                            <li>Bonus/Promotion/Free issued</li>
                            <li>Sales returns or preaches</li>
                            <li>On hold &amp; Recall receipts</li>
                            <li>Void items with auditing</li>
                            <li>Receipt cancellation with auditing</li>
                            <li>Recall previous receipts &amp; printing</li>
                            <li>Print last receipt with single key press</li>
                            <li>Different type of receipt formats</li>
                            <li>Data recovery due to power failure</li>
                        </ul>
                        <p>Quotation, Advanced Bill, Credit customer, Customer ledger &amp; Outstanding with single key press. Counter auto/manual locking option. Customer payment method (Cash/Credit/Credit Card/Gift Voucher). Salesman wise sale reports, profit, discount, commission and supply. Customer outstanding list for selected date. Item search by item number, Trade name, Barcode, Generic name, Weight, Price, Supplier. Item cost code &amp; price code. Item location rack &amp; shelf number. Counter opening balance/paid out &amp; Cash reserved. Reports: Counter opening balance, Cash received, Paid outs, X Reading &amp; Z Reading, Sales men wise sale &amp; commissions, Sales summary, details, &amp; department wise, and many more features.</p>
                        <p>Issuing customer discount cards, building customer relation by sending birthday cards, seasonal card, wedding anniversary cards with gift voucher. Customer pointed system according to bill value. Various discount rates for selected items, groups and card types. Many reports of customer movements.</p>
                    </div>
                </article>

                <article id="module-back-office" class="solution-module">
                    <h3 class="solution-module-title">Pos Back Office</h3>
                    <p>At es POS Back office is used for all kinds of back office activities such as GRN's, GTN, Stock taking, Auditing, Reports &amp; more.</p>
                    <button type="button" class="read-more-toggle" aria-expanded="false" data-read-more="back-office">Read more</button>
                    <div id="read-more-back-office" class="read-more-content" hidden>
                        <h4 class="solution-subtitle">At es POS Back Office main features</h4>
                        <figure class="solution-figure">
                            <?php if (!empty($solutionImgUrls['back-office'])): ?>
                            <img src="<?php echo htmlspecialchars($solutionImgUrls['back-office']); ?>" alt="Back office" class="solution-img">
                            <?php else: ?>
                            <div class="solution-img-placeholder" aria-hidden="true">
                                <span>Image: Back office</span>
                            </div>
                            <?php endif; ?>
                            <figcaption class="solution-figcaption">Back office screenshot or photo.</figcaption>
                        </figure>
                        <ul class="solution-feature-list">
                            <li>Inventory management</li>
                            <li>Account receivable &amp; Payable</li>
                            <li>Customer loyalty management</li>
                            <li>Employee management</li>
                            <li>System security</li>
                            <li>Graph and reporting – easy to manage</li>
                        </ul>
                        <h4 class="solution-subtitle">Inventory management</h4>
                        <p>Item properties: Location, Department, Main category, Sub category, Supplier, Capacity, Manufacture, Price code, Item reorder level, Max order level, Picture, Similar items, Generic name, GP, Markup price, Price level, Cost and Barcode.</p>
                        <h4 class="solution-subtitle">Good Received Note (GRN)</h4>
                        <p>GRN authorization before posting. Item purchase history. Notification of changing agreed GP ratio. Free receiving, Purchase returned, Cheque issuing.</p>
                        <h4 class="solution-subtitle">Good Transfer Note (GTN)</h4>
                        <p>Goods transfer from location to location.</p>
                        <h4 class="solution-subtitle">Stock adjustment</h4>
                        <p>Stock adjustment with authorization process.</p>
                        <h4 class="solution-subtitle">Reporting</h4>
                        <p>Daily reports, Auditing reports, Management reports, Analysis Reports. Over 500 reports for various purposes &amp; over 100 graphs &amp; tables with valuable management information.</p>
                        <h4 class="solution-subtitle">Account receivable &amp; Payable</h4>
                        <p>Fully integrated with the final Accounts balance sheet and trial balance.</p>
                        <h4 class="solution-subtitle">Stock taking</h4>
                        <p>Location wise and department wise stock taking process. Stock taking adjustment &amp; stock updating process. Stock data sheets. Month end stock report. Stock for selected date &amp; online stock taking ability.</p>
                        <h4 class="solution-subtitle">Employee management</h4>
                        <p>Sales commissions, Item or bill wise salesmen assign ability &amp; calculating their commissions at any time.</p>
                        <h4 class="solution-subtitle">Graph &amp; reports</h4>
                        <p>Sales, purchase, stock, profit &amp; loss, location &amp; department wise reports for selected date period.</p>
                        <h4 class="solution-subtitle">System security</h4>
                        <p>Fully integrated security system for POS front office and back office. User wise menu privilege, group wise security, user logging tracking system, each transaction wise auditing facility.</p>
                        <p><strong>Other features:</strong> Bonus items, Tax setting, Database backup, Backup schedule, Backup history, Master alerts, User alert, Barcode &amp; Label printing. For more features please contact At e Soft team info@es-pos.com</p>
                    </div>
                </article>

                <article id="module-barcode-writer" class="solution-module">
                    <h3 class="solution-module-title">Barcode Writer</h3>
                    <p>At es Barcode writer will help you to print Labels, Barcodes stickers &amp; Tags.</p>
                    <figure class="solution-figure">
                        <?php if (!empty($solutionImgUrls['barcode-writer'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['barcode-writer']); ?>" alt="Barcode writer" class="solution-img">
                        <?php else: ?>
                        <div class="solution-img-placeholder" aria-hidden="true">
                            <span>Image: Barcode writer</span>
                        </div>
                        <?php endif; ?>
                        <figcaption class="solution-figcaption">Barcode writer screen or sample labels.</figcaption>
                    </figure>
                </article>

                <article id="module-quick-view" class="solution-module">
                    <h3 class="solution-module-title">Quick view</h3>
                    <p>At es Quick view helps you to get all the key information at your fingertips: Bank balance, Vendor account, Stock movement, Item reordering.</p>
                    <figure class="solution-figure">
                        <?php if (!empty($solutionImgUrls['quick-view'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['quick-view']); ?>" alt="Quick view" class="solution-img">
                        <?php else: ?>
                        <div class="solution-img-placeholder" aria-hidden="true">
                            <span>Image: Quick view</span>
                        </div>
                        <?php endif; ?>
                        <figcaption class="solution-figcaption">Quick view dashboard or screen.</figcaption>
                    </figure>
                </article>

                <article id="module-auto-synchro" class="solution-module">
                    <h3 class="solution-module-title">Auto-synchro</h3>
                    <p>At es Auto-synchro helps to link branches with head offices through online or offline connection.</p>
                    <figure class="solution-figure">
                        <?php if (!empty($solutionImgUrls['auto-synchro'])): ?>
                        <img src="<?php echo htmlspecialchars($solutionImgUrls['auto-synchro']); ?>" alt="Auto-synchro" class="solution-img">
                        <?php else: ?>
                        <div class="solution-img-placeholder" aria-hidden="true">
                            <span>Image: Auto-synchro</span>
                        </div>
                        <?php endif; ?>
                        <figcaption class="solution-figcaption">Sync or branch link diagram/screen.</figcaption>
                    </figure>
                </article>

                <article id="module-mobile-pos" class="solution-module">
                    <h3 class="solution-module-title">Mobile Pos</h3>
                    <p>At es Mobile Pos is an Android application which is used to do front office activities.</p>
                    <button type="button" class="read-more-toggle" aria-expanded="false" data-read-more="mobile-pos">Read more</button>
                    <div id="read-more-mobile-pos" class="read-more-content" hidden>
                        <figure class="solution-figure">
                            <?php if (!empty($solutionImgUrls['mobile-pos'])): ?>
                            <img src="<?php echo htmlspecialchars($solutionImgUrls['mobile-pos']); ?>" alt="Mobile POS app" class="solution-img">
                            <?php else: ?>
                            <div class="solution-img-placeholder" aria-hidden="true">
                                <span>Image: Mobile POS app</span>
                            </div>
                            <?php endif; ?>
                            <figcaption class="solution-figcaption">Mobile POS app screenshot.</figcaption>
                        </figure>
                        <p>It is an ideal mobile billing system for any kind of retail and wholesale business processes in day to day life. This app is reliable, uncomplicated and fast billing mechanism that can work with or without internet. Mobile Pos Billing App incorporates Bluetooth technology. Customer satisfaction billing and viewing accounts information details are advantages of the app. Mobile Pos Billing app is fully integrated with the accounting package.</p>
                    </div>
                </article>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">For more features and a tailored demonstration, contact the At e Soft team.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

<script>
    document.querySelectorAll('.read-more-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-read-more');
            var panel = document.getElementById('read-more-' + id);
            if (!panel) return;
            var isOpen = this.getAttribute('aria-expanded') === 'true';
            panel.hidden = isOpen;
            this.setAttribute('aria-expanded', !isOpen);
            this.textContent = isOpen ? 'Read more' : 'Show less';
        });
    });
</script>

</body>
</html>
