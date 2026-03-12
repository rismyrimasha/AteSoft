<?php
// es-time-attendance-hr.php – Dedicated solution page: es Time & Attendance with HR
require __DIR__ . '/includes/config.php';
$solutionSlug = 'es-time-attendance-hr';
require __DIR__ . '/includes/solution-data.php';
$pageTitle   = $solutionTitle ?? 'es Time & Attendance with HR';
$pageTagline = 'Time & attendance, payroll and HR – integrated with accounts and banks.';

// Build URL map for images (or null if missing)
$solutionImgUrls = [];
if (!empty($solutionImages)) {
    foreach ($solutionImages as $key => $path) {
        $solutionImgUrls[$key] = $BASE_URL . '/' . ltrim($path, '/');
    }
}
$overviewImage = $solutionImgUrls['overview']
    ?? ($solutionImgUrls['hero'] ?? null)
    ?? (reset($solutionImgUrls) ?: null);
$featuresImage = $solutionImgUrls['time-features']
    ?? ($solutionImgUrls['main-features'] ?? null)
    ?? ($solutionImgUrls['overview'] ?? null)
    ?? ($solutionImgUrls['hero'] ?? null);
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
                <li><a href="#about">About esTime &amp; Attendance with HR</a></li>
                <li><a href="#main-features">Main features</a></li>
                <li><a href="#shift-attendance">Shift &amp; attendance</a></li>
                <li><a href="#hr-data">HR &amp; staff data</a></li>
                <li><a href="#reports">Reports</a></li>
            </ul>
        </nav>

        <div class="solution-page-content">
            <section id="about" class="solution-section">
                <h2 class="solution-section-title">About esTime and Attendance with HR</h2>
                <figure class="solution-figure solution-figure-right">
                    <?php if ($overviewImage): ?>
                    <img src="<?php echo htmlspecialchars($overviewImage); ?>" alt="Time &amp; attendance overview" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Time &amp; attendance overview</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $overviewImage ? 'Time &amp; attendance overview' : 'Add an overview or time &amp; attendance dashboard image here.'; ?>
                    </figcaption>
                </figure>
                <p>At es Time and Attendance (Payroll) with HR system has the ability to capture data manually or by thumb reader, proximity card or barcode reader. It supports easy shift scheduling, day schedules, contract staff, labour supplier commission, multiple loans, deductions &amp; allowances and easy integration with banks.</p>
                <p>The HR system covers qualifications, skills, experience, training, dependants and higher security, fully integrated with accounts.</p>
            </section>

            <section id="main-features" class="solution-section">
                <h2 class="solution-section-title">Main features</h2>
                <figure class="solution-figure">
                    <?php if ($featuresImage): ?>
                    <img src="<?php echo htmlspecialchars($featuresImage); ?>" alt="Time &amp; attendance features" class="solution-img">
                    <?php else: ?>
                    <div class="solution-img-placeholder" aria-hidden="true">
                        <span>Image: Time &amp; attendance features</span>
                    </div>
                    <?php endif; ?>
                    <figcaption class="solution-figcaption">
                        <?php echo $featuresImage ? 'Time &amp; attendance features' : 'Optional image for main time &amp; attendance features.'; ?>
                    </figcaption>
                </figure>
                <p>Fast, reliable, easy to use and customisable for factories, offices and other organisations. At e Soft Payroll system supports various data capturing methods with proximity card, thumb reader, barcode card and manual data entry options.</p>
            </section>

            <section id="shift-attendance" class="solution-section">
                <h2 class="solution-section-title">Shift &amp; attendance</h2>
                <ul class="solution-bullet-list">
                    <li>Shift schedule and attendance process.</li>
                    <li>Factory, department or line‑wise attendance handling.</li>
                    <li>Day‑offs and covering days.</li>
                    <li>Allowances (fixed and variable).</li>
                    <li>Overtime and group overtime.</li>
                    <li>Staff loans with various rules.</li>
                    <li>Attendance checkout daily and monthly.</li>
                    <li>Salary increment processing.</li>
                </ul>
            </section>

            <section id="hr-data" class="solution-section">
                <h2 class="solution-section-title">HR &amp; staff data</h2>
                <ul class="solution-bullet-list">
                    <li>Staff qualifications including education and professional skills.</li>
                    <li>Dependant details.</li>
                    <li>Recording of leaves and allowances / deductions.</li>
                </ul>
            </section>

            <section id="reports" class="solution-section">
                <h2 class="solution-section-title">Reports</h2>
                <p>Reporting supports payroll, compliance and management analysis.</p>
                <ul class="solution-bullet-list">
                    <li>Employee details and inactive employees.</li>
                    <li>Employees sex‑wise and age‑wise.</li>
                    <li>Attendance payslips, pay sheet and pay summaries.</li>
                    <li>Coin‑analysis for salary payments and signature list for salary payments.</li>
                    <li>Leave taken and leave balance reports.</li>
                    <li>Daily employee attendance and absent employee details.</li>
                    <li>Late attendance reports and invalid records.</li>
                    <li>Employee attendance monthly summary.</li>
                    <li>EPF/ETF reports.</li>
                    <li>Month/year‑end management reports.</li>
                </ul>
            </section>

            <section class="solution-section solution-cta">
                <p class="solution-cta-text">If you need integrated time &amp; attendance, payroll and HR, we can configure this system to match your shifts, rules and reporting.</p>
                <a class="cta-btn" href="<?php echo $BASE_URL; ?>/inquiry.php">Get in touch</a>
            </section>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>

