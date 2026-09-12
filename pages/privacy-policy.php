<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Privacy Policy';
$metaDesc  = 'Privacy policy for JAGS Technologies — how we collect, use and protect personal information submitted through this website.';
$jsonLd    = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebPage',
    'name'     => 'Privacy Policy',
    'url'      => canonical_url(),
];
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Legal</span>
        <h1 class="page-header-title">PRIVACY<br>POLICY</h1>
        <p class="page-header-desc">How JAGS Technologies collects, uses and protects your information.</p>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 860px;">
        <div class="legal-content section-desc" style="display: flex; flex-direction: column; gap: 28px; line-height: 1.8;">
            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">1. Introduction</h2>
                <p>JAGS Technologies (the "Company") respects your privacy. This policy explains what information we collect through this website, how we use it, and the choices you have. By using this website, you agree to the practices described below.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">2. Information We Collect</h2>
                <p>We collect the personal information you choose to provide through our enquiry and quote-request forms, such as your name, company, email address, phone number, industry, technical requirements and any specification or drawing files you upload. We also collect limited technical information automatically (such as your IP address, browser type and pages visited) to operate and improve the website.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">3. How We Use Your Information</h2>
                <ul style="padding-left: 20px; list-style: disc;">
                    <li>To respond to your enquiries and prepare quotations.</li>
                    <li>To communicate with you about your enquiry and related services.</li>
                    <li>To improve our products, services and website experience.</li>
                    <li>To comply with legal and regulatory obligations.</li>
                </ul>
                <p style="margin-top: 12px;">We do not sell, rent or trade your personal information to third parties.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">4. Uploaded Files</h2>
                <p>Specification, drawing and other files uploaded with an enquiry are used solely to evaluate your requirement. They are stored securely, are not publicly downloadable, and are retained only as long as needed for the purpose for which they were submitted.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">5. Cookies</h2>
                <p>This website uses essential cookies to keep sessions secure (for example, on the administrator login). We do not use advertising or unnecessary third-party tracking cookies.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">6. Data Security</h2>
                <p>We apply appropriate technical and organisational measures to protect your information against unauthorised access, alteration, disclosure or loss. However, no method of transmission over the Internet is completely secure, and we cannot guarantee absolute security.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">7. Your Rights</h2>
                <p>You may request access to, correction of, or deletion of the personal information we hold about you. To exercise these rights, contact us using the details below.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">8. Contact</h2>
                <p>JAGS Technologies<br>
                <?= e(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?><br>
                Phone: <?= e(getSetting('phone', '+91 94443 76041')) ?><br>
                Email: <a href="mailto:<?= e(getSetting('email', 'info@jags.com')) ?>"><?= e(getSetting('email', 'info@jags.com')) ?></a></p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">9. Changes to This Policy</h2>
                <p>We may update this policy from time to time. The date below indicates when it was last revised.</p>
                <p style="margin-top: 8px;">Last updated: <?= e(date('F Y')) ?></p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>