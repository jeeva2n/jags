<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Terms of Service';
$metaDesc  = 'Terms of service for using the JAGS Technologies website — quotations, content, intellectual property and limitations of liability.';
$jsonLd    = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebPage',
    'name'     => 'Terms of Service',
    'url'      => canonical_url(),
];
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Legal</span>
        <h1 class="page-header-title">TERMS OF<br>SERVICE</h1>
        <p class="page-header-desc">Terms governing your use of this website.</p>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width: 860px;">
        <div class="legal-content section-desc" style="display: flex; flex-direction: column; gap: 28px; line-height: 1.8;">
            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">1. Acceptance of Terms</h2>
                <p>By accessing or using this website operated by JAGS Technologies (the "Company"), you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, please do not use the website.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">2. Use of the Website</h2>
                <p>The content on this website is provided for general information about the Company's products and services. You agree not to misuse the website, attempt to gain unauthorised access to its systems, or interfere with its operation.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">3. Quotations and Orders</h2>
                <p>Information published on this website, including product listings, used-equipment listings and descriptions, is indicative and subject to availability and verification. All quotations are prepared on the basis of your specific requirement, and no contractual obligation arises until a written quotation is accepted by both parties.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">4. Intellectual Property</h2>
                <p>All content, design, text, graphics, logos and software on this website are the property of the Company or its licensors and are protected by applicable intellectual property laws. You may not reproduce, distribute or commercially exploit any part of the website without prior written permission.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">5. Submissions</h2>
                <p>By submitting an enquiry, you confirm that the information and any files you provide are accurate and that you have the right to share them. Do not submit confidential technical data unless it is necessary for evaluating your requirement.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">6. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, the Company shall not be liable for any indirect, incidental, special or consequential damages arising out of or in connection with the use of this website or the information contained in it.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">7. External Links</h2>
                <p>This website may contain links to third-party websites. The Company is not responsible for the content, policies or practices of any third-party website.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">8. Governing Law</h2>
                <p>These Terms of Service shall be governed by and construed in accordance with the laws of India. Any disputes shall be subject to the jurisdiction of the competent courts of Chennai.</p>
            </div>

            <div>
                <h2 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 10px;">9. Contact</h2>
                <p>Questions about these terms can be sent to<br>
                JAGS Technologies<br>
                <?= e(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?><br>
                Email: <a href="mailto:<?= e(getSetting('email', 'info@jags.com')) ?>"><?= e(getSetting('email', 'info@jags.com')) ?></a></p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>