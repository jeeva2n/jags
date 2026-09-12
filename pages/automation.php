<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Automation';
$metaDesc = 'JAGS Technologies builds industrial automation — feeding and handling, automated inspection machines, robotics and vision, PLC/HMI control and data traceability.';
$automationCategories = getCategories('automation');

$automationImages = [];
foreach ($automationCategories as $c) {
    $automationImages[$c['slug']] = $c['image'];
}
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <span class="page-header-label">Industrial Automation</span>
        <h1 class="page-header-title">COMPLETE<br>AUTOMATION SOLUTIONS</h1>
        <p class="page-header-desc">From feeding and handling to inspection, robotics, control and data traceability.</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <h2 class="section-title">AUTOMATION<br>SYSTEM</h2>
        </div>

        <div class="auto-flow" style="margin-bottom: 60px;">
            <div class="auto-flow-node active"><div class="auto-flow-label">FEEDING</div></div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node"><div class="auto-flow-label">INSPECTION</div></div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node"><div class="auto-flow-label">ROBOTICS</div></div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node"><div class="auto-flow-label">PLC / HMI</div></div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node"><div class="auto-flow-label">DATA</div></div>
        </div>
    </div>
</section>

<section class="section" id="feeding" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="split-section">
            <div class="split-content">
                <span class="split-number">FEEDING & HANDLING</span>
                <h2 class="split-title">PART FEEDING &amp; ORIENTATION</h2>
                <ul class="split-list">
                    <li>Conveyors</li>
                    <li>Vibratory Bowl Feeders</li>
                    <li>Step Feeders</li>
                    <li>Loading / Unloading</li>
                    <li>Part Orientation</li>
                </ul>
            </div>
            <div class="split-image img-reveal">
                <img src="<?= image_uri($automationImages['feeding-handling'] ?? '', placeholder_img()) ?>" alt="Feeding & Handling" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<section class="section" id="inspection-machines">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal">
                <img src="<?= image_uri($automationImages['inspection-machines'] ?? '', placeholder_img()) ?>" alt="Inspection Machines" loading="lazy" decoding="async">
            </div>
            <div class="split-content">
                <span class="split-number">INSPECTION MACHINES</span>
                <h2 class="split-title">AUTOMATED INSPECTION<br>EQUIPMENT</h2>
                <ul class="split-list">
                    <li>Rotary Inspection Systems</li>
                    <li>Probe Positioning Devices</li>
                    <li>Centering Devices</li>
                    <li>Multi-Station Inspection Cells</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section section-dark" id="robotics">
    <div class="container">
        <div class="split-section" style="direction: rtl;">
            <div style="direction: ltr;" class="split-content">
                <span class="split-number" style="color: var(--color-accent);">ROBOTICS & VISION</span>
                <h2 class="split-title" style="color: white;">ROBOTIC INSPECTION<br>SYSTEMS</h2>
                <ul class="split-list">
                    <li style="color: rgba(255,255,255,0.6);">Robotic Handling</li>
                    <li style="color: rgba(255,255,255,0.6);">Automated Scanning</li>
                    <li style="color: rgba(255,255,255,0.6);">Vision-Assisted Identification</li>
                    <li style="color: rgba(255,255,255,0.6);">Traceability</li>
                </ul>
            </div>
            <div class="split-image img-reveal" style="direction: ltr;">
                <img src="<?= image_uri($automationImages['robotics-vision'] ?? '', placeholder_img()) ?>" alt="Robotics & Vision" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<section class="section" id="plc-hmi">
    <div class="container">
        <div class="split-section">
            <div class="split-content">
                <span class="split-number">CONTROL & DATA</span>
                <h2 class="split-title">PLC / HMI &amp; DATA</h2>
                <ul class="split-list">
                    <li>PLC Control Systems</li>
                    <li>HMI Interfaces</li>
                    <li>Sensors &amp; Encoders</li>
                    <li>Safety Interlocks</li>
                    <li>Data Acquisition</li>
                    <li>Result Logging &amp; Reports</li>
                </ul>
            </div>
            <div class="split-image img-reveal">
                <img src="<?= image_uri($automationImages['plc-hmi'] ?? '', placeholder_img()) ?>" alt="PLC / HMI Controls" loading="lazy" decoding="async">
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">NEED A CUSTOM<br>AUTOMATION SOLUTION?</h2>
            <p class="cta-desc">Our engineering team can design and build customized inspection automation for your specific application.</p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">REQUEST A QUOTE <span class="btn-arrow">&rarr;</span></a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
