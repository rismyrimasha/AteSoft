<?php
// testimonials.php – Full customer testimonials
require __DIR__ . '/testimonials-data.php';
require __DIR__ . '/includes/config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$isUser = !empty($_SESSION['user_id']) && (($_SESSION['user_role'] ?? '') === 'user');

if (!isset($TESTIMONIALS) || !is_array($TESTIMONIALS)) {
    $TESTIMONIALS = [];
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$isUser) {
        $errors[] = 'Please log in to submit a testimonial.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $sector = trim($_POST['sector'] ?? '');
        $solution = trim($_POST['solution'] ?? '');
        $quote = trim($_POST['quote'] ?? '');
        $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;

        if ($company === '') {
            $errors[] = 'Please enter your company or shop name.';
        }
        if ($quote === '') {
            $errors[] = 'Please enter your comment.';
        }
        if ($rating !== 0 && ($rating < 1 || $rating > 5)) {
            $errors[] = 'Rating must be between 1 and 5 stars.';
        }

        if (!$errors) {
            require __DIR__ . '/includes/db.php';

            $stmt = $pdo->prepare(
                'INSERT INTO testimonials (name, company, sector, solution, quote, rating) VALUES (?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $name ?: 'Client',
                $company,
                $sector ?: 'Business',
                $solution ?: 'es System',
                $quote,
                $rating ?: null,
            ]);

            $success = true;

            // Reload from DB so the new one appears immediately.
            require __DIR__ . '/testimonials-data.php';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Testimonials – At e Soft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<main>
    <section class="solutions-hero">
        <div class="container">
            <div class="section-header">
                <div class="section-label">Customer testimonials</div>
                <h1 class="section-title">What our customers say</h1>
            </div>
            <p class="solutions-intro">
                Real feedback from Sri Lankan businesses who use our `es` systems to run their daily work with more confidence, clarity and peace of mind.
            </p>
        </div>
    </section>

    <section class="solutions-hero">
        <div class="container">
            <div class="testimonial-form-wrapper">
                <h2 class="section-title" style="font-size:1.1rem;margin-bottom:0.3rem;">Share your experience</h2>
                <p class="solutions-intro" style="margin-bottom:0.6rem;">
                    In a few lines, tell us how your `es` system helps your business day to day. Your words guide other business owners who are considering At e Soft.
                </p>

                <?php if ($success): ?>
                    <div class="form-message success">Thank you. Your testimonial has been recorded.</div>
                <?php elseif ($errors): ?>
                    <div class="form-message error">
                        <?php foreach ($errors as $err): ?>
                            <div><?php echo htmlspecialchars($err); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($isUser): ?>
                <form method="post" class="testimonial-form">
                    <div class="form-row">
                        <label>
                            Your name (optional)
                            <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </label>
                        <label>
                            Company / shop name *
                            <input type="text" name="company" required value="<?php echo htmlspecialchars($_POST['company'] ?? ''); ?>">
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            Business type (sector)
                            <input type="text" name="sector" placeholder="e.g. Retail, Gold, Hospital" value="<?php echo htmlspecialchars($_POST['sector'] ?? ''); ?>">
                        </label>
                        <label>
                            Which `es` system do you use?
                            <input type="text" name="solution" placeholder="e.g. es POS System" value="<?php echo htmlspecialchars($_POST['solution'] ?? ''); ?>">
                        </label>
                    </div>
                    <?php $currentRating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0; ?>
                    <div class="form-row">
                        <label>
                            Rating
                            <div class="rating-stars" data-selected="<?php echo htmlspecialchars($currentRating); ?>">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <button
                                        type="button"
                                        class="rating-star<?php echo $i <= $currentRating ? ' active' : ''; ?>"
                                        data-value="<?php echo $i; ?>"
                                    >
                                        ★
                                    </button>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" value="<?php echo htmlspecialchars($currentRating); ?>">
                        </label>
                    </div>
                    <label class="form-full">
                        Your comment *
                        <textarea name="quote" rows="3" required><?php echo htmlspecialchars($_POST['quote'] ?? ''); ?></textarea>
                    </label>
                    <div class="form-actions">
                        <button type="submit" class="cta-btn">Submit testimonial</button>
                    </div>
                </form>
                <?php else: ?>
                <div class="form-message error">
                    Please log in to submit a testimonial.
                    <a href="<?php echo $BASE_URL; ?>/auth/login.php" class="link-btn">Login</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    $perPage = 6;
    $total   = count($TESTIMONIALS);
    $index   = 0;
    ?>
    <section>
        <div class="container">
            <div class="testimonials-grid reveal reveal-visible">
                <?php foreach ($TESTIMONIALS as $t): ?>
                    <?php $index++; $extra = $index > $perPage; ?>
                    <article class="testimonial-card<?php echo $extra ? ' extra-testimonial' : ''; ?>">
                        <?php if (!empty($t['rating'])): ?>
                            <div class="testimonial-rating">
                                <?php
                                $r = (int) $t['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $r ? '★' : '☆';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <p class="testimonial-quote">
                            “<?php echo htmlspecialchars($t['quote']); ?>”
                        </p>
                        <?php if (!empty($t['admin_reply'])): ?>
                        <div class="testimonial-reply">
                            <strong>At e Soft:</strong> <?php echo htmlspecialchars($t['admin_reply']); ?>
                        </div>
                        <?php endif; ?>
                        <div class="testimonial-meta">
                            <div class="testimonial-name">
                                <?php echo htmlspecialchars($t['company']); ?>
                            </div>
                            <div class="testimonial-role">
                                <?php echo htmlspecialchars($t['sector']); ?> · <?php echo htmlspecialchars($t['solution']); ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if ($total > $perPage): ?>
                <div class="form-actions" style="margin-top:1rem;text-align:center;">
                    <button type="button" class="cta-btn" id="load-more-testimonials">
                        Load more testimonials
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('load-more-testimonials');
        if (btn) {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.extra-testimonial').forEach(card => {
                    card.style.display = 'flex';
                });
                btn.style.display = 'none';
                const formWrapper = document.querySelector('.testimonial-form-wrapper');
                if (formWrapper) {
                    formWrapper.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }

        const ratingWrappers = document.querySelectorAll('.rating-stars');
        ratingWrappers.forEach(wrapper => {
            const stars = wrapper.querySelectorAll('.rating-star');
            const hiddenInput = wrapper.parentElement.querySelector('input[name="rating"]');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.getAttribute('data-value'), 10) || 0;
                    stars.forEach(s => {
                        const sVal = parseInt(s.getAttribute('data-value'), 10) || 0;
                        if (sVal <= value) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                    if (hiddenInput) {
                        hiddenInput.value = String(value);
                    }
                });
            });
        });
    });
</script>

</body>
</html>