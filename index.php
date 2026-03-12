<?php
// index.php – At e Soft Computer Systems (Pvt) Ltd
require __DIR__ . '/testimonials-data.php';
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/db.php';

$solutionHeroImages = [];
try {
    $stmt = $pdo->query("SELECT solution_slug, image_path FROM solution_images WHERE image_key = 'hero' AND solution_slug IN ('es-pos-system', 'es-account-system', 'es-distribution-system')");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $solutionHeroImages[$row['solution_slug']] = $BASE_URL . '/' . $row['image_path'];
    }
} catch (Throwable $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>At e Soft Computer Systems (Pvt) Ltd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="animations.js"></script>
</head>
<body class="has-custom-cursor">

<div class="scroll-progress"></div>
<div class="custom-cursor"></div>
<div class="custom-cursor-dot"></div>

<?php include __DIR__ . '/header.php'; ?>

<main id="home">
    <section class="hero">
        <div class="container">
            <div class="hero-heading reveal">
                <h1>At e Soft Computer Systems (Pvt) Ltd</h1>
                <p class="subtitle">Relax your mind from business. Let your systems carry the weight.</p>
            </div>

            <div class="hero-layout">
                <div class="hero-content reveal">
                    <div class="hero-pill">
                        <span class="hero-pill-dot"></span>
                        Business software that feels tailored to you
                    </div>

                    <p class="hero-text">
                        We design, develop and maintain software that takes the weight of daily operations
                        off your team – so you can focus on decisions, not manual work.
                    </p>
                    <div class="hero-actions">
                        <a class="cta-btn" href="solutions.php">
                            Explore our solutions
                        </a>
                        <a class="link-btn" href="about.php">Learn more about us <span>→</span></a>
                    </div>
                </div>

                <div class="hero-carousel reveal">
                    <div class="hero-swiper swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a class="hero-slide-link" href="es-pos-system.php">
                                    <div class="hero-slide-placeholder">
                                        <div>
                                            <div class="hero-slide-tag">Featured solution</div>
                                            <div class="hero-slide-title">es POS System</div>
                                            <p class="hero-slide-text">
                                                Billing, stock and reporting for day‑to‑day retail operations.
                                            </p>
                                        </div>
                                        <ul class="hero-slide-bullets">
                                            <li>Fast, reliable billing</li>
                                            <li>Real‑time stock balances</li>
                                            <li>Clear daily summaries</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a class="hero-slide-link" href="es-account-system.php">
                                    <div class="hero-slide-placeholder">
                                        <div>
                                            <div class="hero-slide-tag">Featured solution</div>
                                            <div class="hero-slide-title">es Account System</div>
                                            <p class="hero-slide-text">
                                                Core accounting, ledgers and reporting for finance teams.
                                            </p>
                                        </div>
                                        <ul class="hero-slide-bullets">
                                            <li>General ledger & vouchers</li>
                                            <li>Audit‑ready reports</li>
                                            <li>Supports local regulations</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a class="hero-slide-link" href="es-distribution-system.php">
                                    <div class="hero-slide-placeholder">
                                        <div>
                                            <div class="hero-slide-tag">Featured solution</div>
                                            <div class="hero-slide-title">es Distribution System</div>
                                            <p class="hero-slide-text">
                                                Route, order and delivery management with clear stock visibility.
                                            </p>
                                        </div>
                                        <ul class="hero-slide-bullets">
                                            <li>Route‑wise sales</li>
                                            <li> vehicle / van loading</li>
                                            <li>Returns and stock tracking</li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="hero-swiper-pagination swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <p class="hero-text hero-content-secondary reveal">
                From analysis to deployment and ongoing support, At e Soft Computer Systems (Pvt) Ltd acts as
                your long‑term software partner – not just a one‑off vendor.
            </p>
            <div class="hero-highlight reveal">
                <div>
                    <strong>Tailored systems</strong>
                    From billing to inventory, we adapt to how your business really works.
                </div>
                <div>
                    <strong>Reliable support</strong>
                    Local, responsive support that keeps your systems running smoothly.
                </div>
                <div>
                    <strong>Long‑term partner</strong>
                    We grow your software as your business grows.
                </div>
            </div>

            <div class="tagline-scroller reveal">
                <div class="tagline-inner">
                    <span>Custom‑fitted business software</span>
                    <span>Calm, structured implementations</span>
                    <span>Local, responsive support</span>
                    <span>Clear, real‑time information</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section-alt metrics-section">
        <div class="container">
            <div class="metrics-grid">
                <article class="stat-card reveal">
                    <div class="stat-card-inner">
                        <span class="stat-number" data-value="20" data-duration="1800">0</span><span class="stat-plus">+</span>
                        <div class="stat-label">Years experience</div>
                        <p class="stat-caption">Delivering business systems across Sri Lanka.</p>
                    </div>
                </article>
                <article class="stat-card reveal">
                    <div class="stat-card-inner">
                        <span class="stat-number" data-value="100" data-duration="2000">0</span><span class="stat-plus">+</span>
                        <div class="stat-label">Clients</div>
                        <p class="stat-caption">Businesses trusting our software every day.</p>
                    </div>
                </article>
                <article class="stat-card reveal">
                    <div class="stat-card-inner">
                        <span class="stat-number" data-value="10" data-duration="1200">0</span><span class="stat-plus">+</span>
                        <div class="stat-label">Staff</div>
                        <p class="stat-caption">Dedicated to development and support.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-label">Why At e Soft</div>
                <h2 class="section-title">A long‑term software partner for your business</h2>
            </div>
            <div class="why-grid">
                <div class="why-text reveal">
                    <p>
                        At e Soft Computer Systems (Pvt) Ltd focuses on practical, long‑term solutions for
                        small and medium businesses in Sri Lanka. We spend time understanding how you really
                        work and then shape the software to fit your daily operations.
                    </p>
                    <p>
                        Our goal is simple: <strong>let the software handle the routine work</strong>, so you
                        and your team can relax your minds from administration and focus on growth, customers
                        and strategy.
                    </p>
                </div>
                <div>
                    <div class="why-points">
                        <div class="why-card reveal">
                            <strong>Local understanding</strong>
                            We are used to working with local regulations, business practices and
                            expectations – no over‑complex “one size fits all” systems.
                        </div>
                        <div class="why-card reveal">
                            <strong>Step‑by‑step delivery</strong>
                            We implement in stages, so your team can adapt comfortably without disrupting
                            daily work.
                        </div>
                        <div class="why-card reveal">
                            <strong>Clear communication</strong>
                            We explain your options in simple language and keep you updated from analysis
                            to deployment and support.
                        </div>
                        <div class="why-card reveal">
                            <strong>Ongoing support</strong>
                            After go‑live, we stay with you for maintenance, enhancements and user
                            training as your needs evolve.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="key-solutions" class="section-alt">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-label">Key software solutions</div>
                <h2 class="section-title">Start with a proven `es` system</h2>
            </div>
            <div class="solutions-grid-page">
                <article class="solution-card reveal">
                    <?php if (!empty($solutionHeroImages['es-pos-system'])): ?>
                    <div class="solution-card-image">
                        <img src="<?php echo htmlspecialchars($solutionHeroImages['es-pos-system']); ?>" alt="es POS System">
                    </div>
                    <?php else: ?>
                    <div class="solution-image-placeholder"></div>
                    <?php endif; ?>
                    <div class="solution-card-body">
                        <h2>es POS System</h2>
                        <p class="solution-card-text">
                            Point‑of‑sale, stock and reporting for retail outlets.
                        </p>
                        <a class="solution-card-link" href="es-pos-system.php">
                            View details
                        </a>
                    </div>
                </article>
                <article class="solution-card reveal">
                    <?php if (!empty($solutionHeroImages['es-account-system'])): ?>
                    <div class="solution-card-image">
                        <img src="<?php echo htmlspecialchars($solutionHeroImages['es-account-system']); ?>" alt="es Account System">
                    </div>
                    <?php else: ?>
                    <div class="solution-image-placeholder"></div>
                    <?php endif; ?>
                    <div class="solution-card-body">
                        <h2>es Account System</h2>
                        <p class="solution-card-text">
                            Core accounting, ledgers and finance reports for day‑to‑day work.
                        </p>
                        <a class="solution-card-link" href="es-account-system.php">
                            View details
                        </a>
                    </div>
                </article>
                <article class="solution-card reveal">
                    <?php if (!empty($solutionHeroImages['es-distribution-system'])): ?>
                    <div class="solution-card-image">
                        <img src="<?php echo htmlspecialchars($solutionHeroImages['es-distribution-system']); ?>" alt="es Distribution System">
                    </div>
                    <?php else: ?>
                    <div class="solution-image-placeholder"></div>
                    <?php endif; ?>
                    <div class="solution-card-body">
                        <h2>es Distribution System</h2>
                        <p class="solution-card-text">
                            Routes, orders and delivery with clear stock visibility.
                        </p>
                        <a class="solution-card-link" href="es-distribution-system.php">
                            View details
                        </a>
                    </div>
                </article>
            </div>
            <div class="hero-actions" style="justify-content:center;margin-top:1.5rem;">
                <a class="link-btn" href="solutions.php">Browse all software solutions <span>→</span></a>
            </div>
        </div>
    </section>

    <section id="testimonials" class="section-alt">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-label">Customer testimonials</div>
                <h2 class="section-title">What our customers say</h2>
            </div>
            <?php
            $featured = array_slice($TESTIMONIALS, 0, 3);
            ?>
            <div class="testimonials-grid reveal">
                <?php foreach ($featured as $t): ?>
                    <article class="testimonial-card">
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
            <div class="hero-actions" style="justify-content:center;margin-top:1.3rem;">
                <a class="link-btn" href="testimonials.php">Read more testimonials <span>→</span></a>
            </div>
        </div>
    </section>

    <section id="downloads" class="section-alt">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-label">Implementation resources</div>
                <h2 class="section-title">Everything your team needs to run smoothly</h2>
            </div>
            <div class="why-points">
                <div class="why-card reveal">
                    <strong>User‑friendly documentation</strong>
                    Clear user guides, process diagrams and checklists to support day‑to‑day work.
                </div>
                <div class="why-card reveal">
                    <strong>Training & handover</strong>
                    Focused training sessions for key users and operators, at your pace.
                </div>
                <div class="why-card reveal">
                    <strong>Support materials</strong>
                    Remote support tools and resources to help us solve issues quickly.
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="section-alt">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-label">How we work</div>
                <h2 class="section-title">A calm, structured project approach</h2>
            </div>
            <div class="why-points">
                <div class="why-card reveal">
                    <strong>1. Understand</strong>
                    We map your current process and agree what success looks like – with simple, clear language.
                </div>
                <div class="why-card reveal">
                    <strong>2. Configure & develop</strong>
                    We configure the `es` system and add the pieces that are unique to your business.
                </div>
                <div class="why-card reveal">
                    <strong>3. Train & support</strong>
                    We train your team, go live in stages, and stay available for ongoing support and enhancements.
                </div>
            </div>
            <div class="hero-actions" style="justify-content:center;margin-top:1.3rem;">
                <a href="<?php echo $BASE_URL; ?>/inquiry.php" class="cta-btn">
                    Talk to us about your system
                </a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const heroSwiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.hero-swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.hero-swiper-next',
            prevEl: '.hero-swiper-prev',
        },
        keyboard: {
            enabled: true,
        },
        grabCursor: true,
    });

    const testimonialsSwiperEl = document.querySelector('.testimonials-swiper');
    if (testimonialsSwiperEl) {
        const testimonialsSwiper = new Swiper(testimonialsSwiperEl, {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.testimonials-swiper-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 24,
            grabCursor: true,
        });
    }

    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        revealEls.forEach((el, index) => {
            el.dataset.revealIndex = String(index);
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const idx = parseInt(target.dataset.revealIndex || '0', 10) || 0;
                    const baseDelay = 80;
                    const stepDelay = 70;
                    const delay = baseDelay + (idx % 5) * stepDelay;
                    target.style.transitionDelay = `${delay}ms`;
                    target.classList.add('reveal-visible');
                    observer.unobserve(target);
                }
            });
        }, {
            threshold: 0.2
        });

        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('reveal-visible'));
    }

    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');
    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            navToggle.classList.toggle('is-open');
            mainNav.classList.toggle('is-open');
        });

        mainNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navToggle.classList.remove('is-open');
                mainNav.classList.remove('is-open');
            });
        });
    }

    const progressBar = document.querySelector('.scroll-progress');
    const siteHeader = document.querySelector('header');

    const handleScrollEffects = () => {
        const doc = document.documentElement;
        const scrollTop = window.scrollY || doc.scrollTop || 0;

        if (progressBar) {
            const docHeight = doc.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? Math.min(scrollTop / docHeight, 1) : 0;
            progressBar.style.transform = `scaleX(${progress})`;
        }

        if (siteHeader) {
            if (scrollTop > 12) {
                siteHeader.classList.add('is-scrolled');
            } else {
                siteHeader.classList.remove('is-scrolled');
            }
        }
    };

    window.addEventListener('scroll', handleScrollEffects, { passive: true });
    window.addEventListener('resize', handleScrollEffects);
    handleScrollEffects();

    // Stat count-up: 0 → target when card enters view
    (function initStatCountUp() {
        const statNumbers = document.querySelectorAll('.stat-number[data-value]');
        if (!statNumbers.length) return;

        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }

        function countUp(el, target, durationMs) {
            const start = performance.now();
            target = parseInt(target, 10) || 0;
            if (target <= 0) {
                el.textContent = '0';
                return;
            }

            function tick(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / durationMs, 1);
                const eased = easeOutQuart(progress);
                const value = Math.round(eased * target);
                el.textContent = value;
                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    el.textContent = target;
                }
            }

            requestAnimationFrame(tick);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const card = entry.target;
                const numEl = card.querySelector('.stat-number[data-value]');
                if (!numEl || numEl.dataset.counted === 'true') return;
                numEl.dataset.counted = 'true';
                const target = numEl.getAttribute('data-value');
                const duration = parseInt(numEl.getAttribute('data-duration'), 10) || 1800;
                countUp(numEl, target, duration);
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.stat-card').forEach((card) => {
            if (card.querySelector('.stat-number[data-value]')) {
                observer.observe(card);
            }
        });
    })();

    // Custom cursor (desktop only)
    const cursorEl = document.querySelector('.custom-cursor');
    const cursorDotEl = document.querySelector('.custom-cursor-dot');

    if (cursorEl && cursorDotEl && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        let cursorVisible = false;

        const showCursor = () => {
            if (!cursorVisible) {
                cursorEl.style.opacity = '1';
                cursorDotEl.style.opacity = '1';
                cursorVisible = true;
            }
        };

        const moveCursor = (event) => {
            const x = event.clientX;
            const y = event.clientY;
            const transformValue = `translate3d(${x}px, ${y}px, 0)`;
            cursorEl.style.transform = transformValue;
            cursorDotEl.style.transform = transformValue;
        };

        window.addEventListener('mousemove', (event) => {
            showCursor();
            moveCursor(event);
        });

        const activateCursor = () => cursorEl.classList.add('is-active');
        const deactivateCursor = () => cursorEl.classList.remove('is-active');

        document.querySelectorAll('a, button, .cta-btn, .link-btn').forEach((el) => {
            el.addEventListener('mouseenter', activateCursor);
            el.addEventListener('mouseleave', deactivateCursor);
        });

        window.addEventListener('mousedown', () => {
            cursorEl.classList.add('is-clicked');
        });

        window.addEventListener('mouseup', () => {
            cursorEl.classList.remove('is-clicked');
        });
    }
</script>

</body>
</html>
<?php

