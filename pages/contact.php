<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Contact';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Contact</span>
        <h1 class="page-header-title">GET IN<br>TOUCH</h1>
        <p class="page-header-desc">Tell us about your inspection requirement and our engineering team will help identify the right solution.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Enquiry</span>
                <h2 class="section-title" style="margin-bottom: 32px;">REQUEST A<br>QUOTE</h2>

                <form id="contactForm" onsubmit="return false;">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="c-name">Name *</label>
                            <input type="text" id="c-name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c-company">Company</label>
                            <input type="text" id="c-company" name="company" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="c-email">Email *</label>
                            <input type="email" id="c-email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="c-phone">Phone</label>
                            <input type="tel" id="c-phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="c-industry">Industry</label>
                            <select id="c-industry" name="industry" class="form-control">
                                <option value="">Select Industry</option>
                                <option>Automotive</option>
                                <option>Aerospace</option>
                                <option>Oil &amp; Gas</option>
                                <option>Power Plants</option>
                                <option>Railways</option>
                                <option>Foundries</option>
                                <option>Forging</option>
                                <option>Fabrication</option>
                                <option>General Engineering</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="c-ndt">NDT Technology</label>
                            <select id="c-ndt" name="ndt_technology" class="form-control">
                                <option value="">Select Technology</option>
                                <option>Eddy Current</option>
                                <option>PAUT</option>
                                <option>TOFD</option>
                                <option>MPI</option>
                                <option>PT</option>
                                <option>Automated Inspection</option>
                                <option>Custom Automation</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="c-req">Requirement Type</label>
                        <select id="c-req" name="requirement_type" class="form-control">
                            <option value="">Select Type</option>
                            <option>New Equipment</option>
                            <option>System Upgrade</option>
                            <option>Spares & Accessories</option>
                            <option>Service & Calibration</option>
                            <option>Training</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="c-msg">Message *</label>
                        <textarea id="c-msg" name="message" class="form-control" rows="6" placeholder="Describe your inspection requirement..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="c-file">Upload Specification / Drawing</label>
                        <input type="file" id="c-file" name="specification_file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.jpg,.jpeg,.png,.dwg,.dxf,.step" style="padding: 10px;">
                        <div style="font-size: 0.72rem; color: var(--color-text-muted); margin-top: 6px;">Max 25 MB — PDF, Word, Excel, ZIP, images or CAD files</div>
                    </div>
                    <div id="contactMessage"></div>
                    <button type="submit" class="btn btn-primary magnetic-btn" style="width: 100%; justify-content: center;" id="contactSubmit">
                        REQUEST A QUOTE <span class="btn-arrow">&rarr;</span>
                    </button>
                </form>
            </div>

            <div>
                <span class="section-label">Information</span>
                <h3 class="section-title" style="font-size: 1.5rem; margin-bottom: 32px;">JAGS TECHNOLOGIES</h3>

                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Location</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);"><?= e(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?></span>
                    </div>
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Phone</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);">
                            <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', getSetting('phone', '+91 94443 76041'))) ?>" style="color: inherit; text-decoration: none;"><?= e(getSetting('phone', '+91 94443 76041')) ?></a>
                        </span>
                    </div>
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Email</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);">
                            <a href="mailto:<?= e(getSetting('email', 'info@jags.com')) ?>" style="color: inherit; text-decoration: none;"><?= e(getSetting('email', 'info@jags.com')) ?></a>
                        </span>
                    </div>
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Website</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);">
                            <a href="<?= e(getSetting('website', 'https://jags.com')) ?>" target="_blank" rel="noopener" style="color: inherit; text-decoration: none;"><?= e(str_replace(['https://', 'http://', 'www.'], '', getSetting('website', 'https://jags.com'))) ?></a>
                        </span>
                    </div>
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Automation</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);">Feeding, Inspection, Robotics, PLC/HMI, Data</span>
                    </div>
                    <div>
                        <span style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-text-muted); display: block; margin-bottom: 6px;">Services</span>
                        <span style="font-size: var(--fs-base); color: var(--color-text);">Application Engineering, Installation, Commissioning, Training, Service</span>
                    </div>
                </div>

                <div style="margin-top: 48px; padding: 32px; background: var(--color-bg-alt); border-radius: 12px;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; margin-bottom: 12px;">Engineering Workflow</h4>
                    <p style="font-size: 0.8rem; color: var(--color-text-secondary); line-height: 1.7;">
                        Application Study &rarr; Method Selection &rarr; Equipment Selection &rarr;
                        Mechanical Design &rarr; PLC Integration &rarr; Manufacturing &rarr;
                        Calibration &amp; FAT &rarr; Installation &rarr; Training &amp; Commissioning &rarr; Service &amp; Support
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== LOCATION MAP ====== -->
<section class="section map-section">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 0;">
            <span class="section-label">Location</span>
            <h2 class="section-title">WHERE TO FIND US</h2>
            <p class="section-desc" style="max-width: 560px; margin: 0 auto;">
                <?= e(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?>
            </p>
        </div>
    </div>
    <div class="map-wrapper" style="width: 100%; max-width: none; height: 550px; position: relative; overflow: hidden; margin-top: 56px;">
        <iframe
            src="https://www.google.com/maps?q=<?= urlencode(getSetting('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058')) ?>&z=15&hl=en&output=embed"
            style="display: block; position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen
            title="JAGS Technologies Location Map"></iframe>
    </div>
</section>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const btn = document.getElementById('contactSubmit');
        const msg = document.getElementById('contactMessage');
        const formData = new FormData(form);

        const fileInput = document.getElementById('c-file');
        if (fileInput && fileInput.files.length && fileInput.files[0].size > 25 * 1024 * 1024) {
            msg.innerHTML = '<div class="form-error">Attachment is too large. Maximum file size is 25 MB.</div>';
            return;
        }

        btn.textContent = 'Sending...';
        btn.disabled = true;

        fetch('../api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    msg.innerHTML = '<div class="form-success">Thank you! Your enquiry has been received. We will get back to you shortly.</div>';
                    form.reset();
                } else {
                    msg.innerHTML = '<div class="form-error">' + (data.message || 'Something went wrong.') + '</div>';
                }
            })
            .catch(err => {
                console.error('JAGS quote fetch error:', err);
                msg.innerHTML = '<div class="form-error">Network error. Please try again.</div>';
            })
            .finally(() => {
                btn.textContent = 'REQUEST A QUOTE';
                btn.disabled = false;
            });
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>