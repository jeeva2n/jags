<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="<?= BASE_URL ?>/" class="footer-logo">
                        <img src="<?= BASE_URL ?>/assets/images/jags.png" alt="<?= e(getSetting('company_name', 'JAGS Technologies')) ?> Logo" class="logo-img" width="304" height="152" loading="lazy" decoding="async">
                        <!-- <span class="logo-text">JAGS<span class="logo-accent">TECH</span></span> -->
                    </a>
                    <p class="footer-tagline">ADVANCED NDT EQUIPMENT<br>& INDUSTRIAL AUTOMATION</p>
                    <p class="footer-desc">Engineering precision inspection systems and customized industrial automation solutions.</p>
                </div>

                <div class="footer-col">
                    <h4 class="footer-heading">NDT Equipment</h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/pages/products.php?cat=eddy-current">Eddy Current</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/products.php?cat=paut-tofd">PAUT & TOFD</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/products.php?cat=mpi">MPI</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/products.php?cat=pt-systems">PT Systems</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/products.php?cat=probes-accessories">Accessories</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-heading">Automation</h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/pages/automation.php#feeding">Feeding & Handling</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/automation.php#inspection-machines">Inspection Machines</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/automation.php#robotics">Robotics & Vision</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/automation.php#plc-hmi">PLC / HMI</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/automation.php#data">Data & Traceability</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-heading">Company</h4>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/pages/about.php">About</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/company-profile.php">Company Profile</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/management.php">Management</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/global-partners.php">Global Partners</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/social-responsibility.php">Social Responsibility</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/customer-experience-center.php">Customer Experience Center</a></li>
                        <li><a href="<?= BASE_URL ?>/used-equipment">Used Equipment</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/industries.php">Industries</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/solutions.php">Solutions</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/projects.php">Projects</a></li>
                        <li><a href="<?= BASE_URL ?>/pages/contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-heading">Contact</h4>
                    <ul class="footer-links footer-contact">

                        <li>
                            <span class="footer-contact-label">Contact</span>
                            <?= e(getSetting('phone', '+91 94443 76041')) ?>
                        </li>

                        <li>
                            <span class="footer-contact-label">Location</span>
                            <?= e(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?>
                        </li>

                        <li>
                            <span class="footer-contact-label">Website</span>
                            <a href="<?= e(getSetting('website', 'https://jags.com')) ?>" target="_blank"><?= e(str_replace(['https://', 'http://', 'www.'], '', getSetting('website', 'https://jags.com'))) ?></a>
                        </li>

                        <li>
                            <span class="footer-contact-label">Mail</span>
                            <a href="mailto:<?= e(getSetting('email', 'info@jags.com')) ?>"><?= e(getSetting('email', 'info@jags.com')) ?></a>
                        </li>


                    </ul>
                    <a href="<?= BASE_URL ?>/pages/contact.php" class="btn-footer-cta magnetic-btn" data-cursor="OPEN">REQUEST A QUOTE</a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p>&copy; <?= date('Y') ?> <?= e(getSetting('company_name', 'JAGS Technologies')) ?>. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="<?= BASE_URL ?>/pages/privacy-policy.php">Privacy Policy</a>
                    <a href="<?= BASE_URL ?>/pages/terms-of-service.php">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/cursor.js"></script>
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
<script src="<?= BASE_URL ?>/assets/js/timeline.js"></script>
</body>

</html>