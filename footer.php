<?php
require_once __DIR__ . '/includes/config.php';
?>
<footer id="contact">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-heading"><?php echo htmlspecialchars($COMPANY_NAME); ?></div>
                <p style="font-size:0.9rem;color:#9ca3af;">
                    Relax your mind from business – we help you run operations on reliable, custom‑fitted
                    software so you can focus on what matters most.
                </p>
            </div>
            <div>
                <div class="footer-heading">Quick links</div>
                <ul class="footer-nav">
                    <li><a href="<?php echo $BASE_URL; ?>/index.php#home">Home</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/solutions.php">Software Solutions</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/testimonials.php">Customer Testimonials</a></li>
                    <!-- <li><a href="<?php echo $BASE_URL; ?>/index.php#downloads">Download</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/index.php#services">Service</a></li> -->
                    <li><a href="<?php echo $BASE_URL; ?>/about.php">About Us</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/inquiry.php">Inquiry</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Contact us</div>
                <div class="contact-item">
                    <span>Phone</span>
                    <?php echo htmlspecialchars($COMPANY_PHONE); ?>
                </div>
                <div class="contact-item">
                    <span>Email</span>
                    <a href="mailto:<?php echo htmlspecialchars($COMPANY_EMAIL); ?>">
                        <?php echo htmlspecialchars($COMPANY_EMAIL); ?>
                    </a>
                </div>
                <div class="contact-item">
                    <span>Address</span>
                    <?php echo htmlspecialchars($COMPANY_ADDR_LINE1); ?><br>
                    <?php echo htmlspecialchars($COMPANY_ADDR_LINE2); ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>© <?php echo date('Y'); ?> <?php echo htmlspecialchars($COMPANY_NAME); ?>. All rights reserved.</div>
            <div>Designed &amp; developed in‑house.</div>
        </div>
    </div>
</footer>

