<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Advanced NDT Equipment & Industrial Automation';
$metaDesc = 'JAGS Technologies provides advanced NDT equipment, inspection systems, industrial automation and customized engineering solutions.';

$ndtCategories = getCategories('ndt');
$automationCategories = getCategories('automation');
$timelineStages = getTimelineStages();
$industries = getIndustries();
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- ====== HERO ====== -->
<section class="hero">
    <div class="hero-grid-overlay">
        <div class="grid-line-h" style="top: 25%"></div>
        <div class="grid-line-h" style="top: 50%"></div>
        <div class="grid-line-h" style="top: 75%"></div>
        <div class="grid-line-v" style="left: 25%"></div>
        <div class="grid-line-v" style="left: 50%"></div>
        <div class="grid-line-v" style="left: 75%"></div>
    </div>

    <div class="hero-scan-line" id="heroScan"></div>

    <span class="hero-coord" style="top: 20%; left: 15%">047.382</span>
    <span class="hero-coord" style="bottom: 25%; right: 42%">X-02.150</span>
    <span class="hero-coord" style="top: 60%; left: 8%">Y+12.700</span>

    <div class="hero-content">
        <div class="hero-text">
            <span class="hero-label">Advanced NDT Equipment &bull; Automation &bull; Engineering</span>

            <h1 class="hero-title">
                <span class="line"><span class="line-inner">ENGINEERING</span></span>
                <span class="line"><span class="line-inner">PRECISION<span class="accent">.</span></span></span>
                <span class="line"><span class="line-inner">INSPECTION</span></span>
                <span class="line"><span class="line-inner">EXCELLENCE<span class="accent">.</span></span></span>
            </h1>

            <p class="hero-desc">
                JAGS Technologies is an engineering and technology company focused on NDT equipment sales, inspection systems, industrial
                automation and customized engineering solutions. We support customers from equipment selection through installation,
                commissioning, application support and training.
            </p>

            <div class="hero-actions">
                <a href="<?= BASE_URL ?>/pages/products.php" class="btn btn-primary magnetic-btn">
                    EXPLORE SOLUTIONS
                    <span class="btn-arrow">&rarr;</span>
                </a>
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-secondary magnetic-btn">
                    REQUEST A QUOTE
                </a>
            </div>
        </div>

        <div class="hero-image-wrapper">
            <div class="hero-slider" id="heroSlider">
                <div class="hero-slide active">
                    <img src="<?= BASE_URL ?>/assets/images/hero/maganatic%20particle.webp" alt="Magnetic Particle Inspection">
                </div>
                <div class="hero-slide">
                    <img src="<?= BASE_URL ?>/assets/images/hero/ndt-test.webp" alt="NDT Testing">
                </div>
                <div class="hero-slide">
                    <img src="<?= BASE_URL ?>/assets/images/hero/Nondestructive-testing-equipment-768x644.webp" alt="NDT Equipment">
                </div>
                <div class="hero-slide">
                    <img src="<?= BASE_URL ?>/assets/images/hero/ultrasonic-probe-steel-pipe-inspection.webp" alt="Ultrasonic Pipe Inspection">
                </div>
                <div class="hero-slider-scan" id="heroSliderScan"></div>
                <div class="tech-overlay"></div>
            </div>
        </div>
    </div>
</section>


<!-- ====== WHO WE ARE ====== -->
<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Who We Are</span>

                <h2 class="section-title">
                    RELIABLE NDT<br>
                    TECHNOLOGY FOR<br>
                    QUALITY & SAFETY
                </h2>

                <p class="section-desc" style="margin-bottom: 40px;">
                    JAGS TECHNOLOGIES is a reliable NDT equipment supplier
                    providing quality NDT instruments, accessories and
                    inspection solutions for manufacturing industries.
                    With fast service and technical expertise, we help
                    customers achieve accurate, safe and reliable inspection results.
                </p>
    
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                    <div class="value-card" style="padding: 28px;">
                        <div class="value-number" style="font-size: 1.5rem; margin-bottom: 8px;">01</div>
                        <h3 class="value-title" style="font-size: 1rem;">NDT Equipment</h3>
                        <p class="value-desc" style="font-size: 0.8rem;">
                            Quality NDT equipment and instruments for accurate and reliable inspection.
                        </p>
                    </div>

                    <div class="value-card" style="padding: 28px;">
                        <div class="value-number" style="font-size: 1.5rem; margin-bottom: 8px;">02</div>
                        <h3 class="value-title" style="font-size: 1rem;">Inspection Services</h3>
                        <p class="value-desc" style="font-size: 0.8rem;">
                            Professional NDT inspection services focused on quality and safety.
                        </p>
                    </div>

                    <div class="value-card" style="padding: 28px;">
                        <div class="value-number" style="font-size: 1.5rem; margin-bottom: 8px;">03</div>
                        <h3 class="value-title" style="font-size: 1rem;">Technical Expertise</h3>
                        <p class="value-desc" style="font-size: 0.8rem;">
                            Technical knowledge to help you choose the right NDT solution for your application.
                        </p>
                    </div>

                    <div class="value-card" style="padding: 28px;">
                        <div class="value-number" style="font-size: 1.5rem; margin-bottom: 8px;">04</div>
                        <h3 class="value-title" style="font-size: 1rem;">Fast Service & Support</h3>
                        <p class="value-desc" style="font-size: 0.8rem;">
                            Responsive service and dependable support to keep your inspection work moving.
                        </p>
                    </div>

                </div>
            </div>

            <div class="who-we-are-visual has-scan">
                <img src="<?= BASE_URL ?>/assets/images/hero/who%20we%20are.webp"
                     alt="JAGS Technologies NDT Equipment and Inspection Solutions">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<!-- ====== NDT TECHNOLOGIES ====== -->
<section class="section" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">01 / NDT Technologies</span>
            </span>
            <h2 class="section-title">ADVANCED INSPECTION<br>TECHNOLOGIES</h2>
        </div>

        <div class="tech-cards-grid">
            <?php
            $techCards = [
                ['eddy-current', 'Eddy Current', 'Advanced electromagnetic inspection using conventional ECT, multi-channel ECT, eddy current array, tube inspection, sorting and crack detection.', 'ECT', 'https://picsum.photos/seed/ect/600/400'],
                ['paut-tofd', 'PAUT & TOFD', 'Advanced ultrasonic inspection with portable PAUT instruments, TOFD systems, manual and encoded scanners.', 'UT', 'https://picsum.photos/seed/ut/600/400'],
                ['mpi', 'MPI', 'Professional magnetic particle inspection equipment for surface and near-surface defect detection.', 'MPI', 'https://picsum.photos/seed/mpi/600/400'],
                ['pt-systems', 'PT Systems', 'Professional penetrant testing systems for surface-breaking defect detection.', 'PT', 'https://picsum.photos/seed/pt/600/400'],
                ['probes-accessories', 'Probes & Accessories', 'NDT probes, wedges, encoders, calibration blocks and accessories.', 'ACC', 'https://picsum.photos/seed/acc/600/400'],
            ];
            foreach ($techCards as $tc):
            ?>
                <a href="<?= BASE_URL ?>/pages/products.php?cat=<?= $tc[0] ?>" class="tech-card tilt-card">
                    <div class="tech-card-scan"></div>
                    <div class="tech-card-image">
                        <img src="<?= $tc[4] ?>" alt="<?= $tc[1] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="tech-card-body">
                        <h3 class="tech-card-title"><?= $tc[1] ?></h3>
                        <p class="tech-card-desc"><?= $tc[2] ?></p>
                        <span class="tech-card-arrow">EXPLORE <span class="btn-arrow">&rarr;</span></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== EDDY CURRENT ====== -->
<section class="section">
    <div class="container">
        <div class="split-section">
            <div class="split-image img-reveal has-scan">
                <img src="https://picsum.photos/seed/eddy-current/800/600" alt="Eddy Current Inspection" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                <div class="scan-line"></div>
            </div>

            <div class="split-content">
                <span class="split-number">01 &mdash; EDDY CURRENT</span>
                <h2 class="split-title">ADVANCED ELECTROMAGNETIC<br>INSPECTION</h2>
                <span class="split-subtitle">EDDY CURRENT TESTING</span>

                <ul class="split-list">
                    <li>Conventional ECT</li>
                    <li>Multi-Channel ECT</li>
                    <li>Eddy Current Array</li>
                    <li>Tube Inspection</li>
                    <li>Sorting &amp; Crack Detection</li>
                </ul>

                <a href="<?= BASE_URL ?>/pages/products.php?cat=eddy-current" class="btn btn-primary magnetic-btn">
                    EXPLORE ECT
                    <span class="btn-arrow">&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ====== PAUT & TOFD ====== -->
<section class="section section-dark">
    <div class="container">
        <div class="split-section" style="direction: rtl;">
            <div style="direction: ltr;" class="split-content">
                <span class="split-number" style="color: var(--color-accent);">02 &mdash; PAUT & TOFD</span>
                <h2 class="split-title" style="color: white;">ADVANCED ULTRASONIC<br>INSPECTION</h2>
                <span class="split-subtitle" style="color: rgba(255,255,255,0.4);">PHASED ARRAY & TOFD</span>

                <ul class="split-list">
                    <li style="color: rgba(255,255,255,0.6);">Portable PAUT Instruments</li>
                    <li style="color: rgba(255,255,255,0.6);">TOFD Systems</li>
                    <li style="color: rgba(255,255,255,0.6);">Manual &amp; Encoded Scanners</li>
                    <li style="color: rgba(255,255,255,0.6);">Weld Scanners</li>
                    <li style="color: rgba(255,255,255,0.6);">Corrosion Mapping Scanners</li>
                    <li style="color: rgba(255,255,255,0.6);">Probes, Wedges &amp; Encoders</li>
                </ul>

                <a href="<?= BASE_URL ?>/pages/products.php?cat=paut-tofd" class="btn btn-primary magnetic-btn" style="background: var(--color-accent);">
                    EXPLORE PAUT
                    <span class="btn-arrow">&rarr;</span>
                </a>
            </div>

            <div class="split-image img-reveal has-scan" style="direction: ltr;">
                <img src="https://picsum.photos/seed/paut/800/600" alt="PAUT TOFD Inspection" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<!-- ====== MPI + PT ====== -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; min-height: 500px;">
            <div class="tech-card" style="display: flex; flex-direction: column;">
                <div class="tech-card-image" style="aspect-ratio: 16/8;">
                    <img src="https://picsum.photos/seed/mpi-card/600/300" alt="Magnetic Particle Inspection" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                    <span class="split-number">MPI</span>
                    <h3 class="tech-card-title" style="font-size: 1.4rem;">Magnetic Particle<br>Inspection</h3>
                    <p class="tech-card-desc">Professional magnetic particle inspection equipment and systems for surface and near-surface defect detection in ferromagnetic materials.</p>
                    <a href="<?= BASE_URL ?>/pages/products.php?cat=mpi" class="tech-card-arrow">EXPLORE MPI <span class="btn-arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="tech-card" style="display: flex; flex-direction: column;">
                <div class="tech-card-image" style="aspect-ratio: 16/8;">
                    <img src="https://picsum.photos/seed/pt-card/600/300" alt="Penetrant Testing" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                    <span class="split-number">PT SYSTEMS</span>
                    <h3 class="tech-card-title" style="font-size: 1.4rem;">Penetrant<br>Inspection</h3>
                    <p class="tech-card-desc">Professional penetrant testing systems for surface-breaking defect detection in non-porous materials. Visible and fluorescent methods.</p>
                    <a href="<?= BASE_URL ?>/pages/products.php?cat=pt-systems" class="tech-card-arrow">EXPLORE PT <span class="btn-arrow">&rarr;</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== FULLSCREEN SCANNING ====== -->
<section class="section section-dark" style="padding: 0; min-height: 100vh; display: flex; align-items: center;">
    <div class="container-wide" style="width: 100%;">
        <div class="section-header" style="text-align: center; padding: 80px 0 40px;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center; color: var(--color-accent);">
                <span style="display: inline;">Inspection Technology In Motion</span>
            </span>
            <h2 class="section-title" style="color: white;">ADVANCED NDT<br>SOLUTIONS</h2>
        </div>

        <div class="tech-cards-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px; padding-bottom: 80px;">
            <div class="tech-card" style="background: var(--color-bg-dark-alt); border-color: rgba(255,255,255,0.08);">
                <div class="tech-card-image">
                    <img src="https://picsum.photos/seed/scan-ect/400/300" alt="Eddy Current" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body">
                    <h3 class="tech-card-title" style="color: white;">Eddy Current</h3>
                    <p class="tech-card-desc" style="color: rgba(255,255,255,0.5);">Electromagnetic inspection for surface and sub-surface defects.</p>
                </div>
            </div>
            <div class="tech-card" style="background: var(--color-bg-dark-alt); border-color: rgba(255,255,255,0.08);">
                <div class="tech-card-image">
                    <img src="https://picsum.photos/seed/scan-paut/400/300" alt="PAUT & TOFD" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body">
                    <h3 class="tech-card-title" style="color: white;">PAUT & TOFD</h3>
                    <p class="tech-card-desc" style="color: rgba(255,255,255,0.5);">Advanced ultrasonic weld and thickness inspection.</p>
                </div>
            </div>
            <div class="tech-card" style="background: var(--color-bg-dark-alt); border-color: rgba(255,255,255,0.08);">
                <div class="tech-card-image">
                    <img src="https://picsum.photos/seed/scan-auto/400/300" alt="Automated Inspection" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body">
                    <h3 class="tech-card-title" style="color: white;">Automated Inspection</h3>
                    <p class="tech-card-desc" style="color: rgba(255,255,255,0.5);">Production-line automated inspection and sorting systems.</p>
                </div>
            </div>
            <div class="tech-card" style="background: var(--color-bg-dark-alt); border-color: rgba(255,255,255,0.08);">
                <div class="tech-card-image">
                    <img src="https://picsum.photos/seed/scan-robo/400/300" alt="Robotic Inspection" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="tech-card-body">
                    <h3 class="tech-card-title" style="color: white;">Robotic Inspection</h3>
                    <p class="tech-card-desc" style="color: rgba(255,255,255,0.5);">Robotic scanning, handling and vision-assisted systems.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== AUTOMATION ====== -->
<section class="section">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">Automation</span>
            </span>
            <h2 class="section-title">FROM INSPECTION EQUIPMENT<br>TO COMPLETE AUTOMATION</h2>
            <p class="section-desc" style="margin: 0 auto;">
                End-to-end automation from feeding and handling to inspection,
                robotics, control and data traceability.
            </p>
        </div>

        <div class="auto-flow">
            <div class="auto-flow-node" data-cursor="EXPLORE">
                <div class="auto-flow-label">FEEDING</div>
            </div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node" data-cursor="EXPLORE">
                <div class="auto-flow-label">INSPECTION</div>
            </div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node" data-cursor="EXPLORE">
                <div class="auto-flow-label">ROBOTICS</div>
            </div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node" data-cursor="EXPLORE">
                <div class="auto-flow-label">PLC / HMI</div>
            </div>
            <span class="auto-flow-arrow">&rarr;</span>
            <div class="auto-flow-node" data-cursor="EXPLORE">
                <div class="auto-flow-label">DATA</div>
            </div>
        </div>

        <div class="tech-cards-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php
            $autoCards = [
                ['feeding-handling', 'Feeding & Handling', 'Conveyors, vibratory bowl feeders, step feeders, loading/unloading, part orientation.'],
                ['inspection-machines', 'Inspection Machines', 'Rotary inspection, probe positioning, centering devices, multi-station cells.'],
                ['robotics-vision', 'Robotics & Vision', 'Robotic handling, automated scanning, vision-assisted identification and traceability.'],
                ['plc-hmi', 'PLC / HMI', 'Industrial PLC control systems, HMI interfaces, sensors, encoders and interlocks.'],
                ['data-traceability', 'Data & Traceability', 'Data acquisition, result logging, reports and production traceability systems.'],
                ['complete-solutions', 'Complete Solutions', 'End-to-end customized inspection solutions from concept to commissioning.'],
            ];
            foreach ($autoCards as $ac):
            ?>
                <a href="<?= BASE_URL ?>/pages/automation.php" class="tech-card">
                    <div class="tech-card-body">
                        <h3 class="tech-card-title"><?= $ac[1] ?></h3>
                        <p class="tech-card-desc"><?= $ac[2] ?></p>
                        <span class="tech-card-arrow">EXPLORE <span class="btn-arrow">&rarr;</span></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== WORKFLOW TIMELINE ====== -->
<section class="timeline-section">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 40px;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">Workflow</span>
            </span>
            <h2 class="section-title">FROM APPLICATION<br>TO COMPLETE INSPECTION SOLUTION</h2>
            <p class="section-desc" style="margin: 0 auto;">
                A complete engineering workflow from application study to commissioning and service.
            </p>
        </div>
    </div>

    <div class="timeline-wrapper">
        <div class="timeline-track">
            <?php foreach ($timelineStages as $i => $stage): ?>
                <div class="timeline-node <?= $i === 0 ? 'active' : '' ?>" data-cursor="OPEN">
                    <div class="timeline-node-inner">
                        <div class="timeline-node-step">STEP <?= str_pad($stage['step_number'], 2, '0', STR_PAD_LEFT) ?></div>
                        <div class="timeline-node-image">
                            <img src="https://picsum.photos/seed/timeline-<?= $i + 1 ?>/400/300" alt="<?= e($stage['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="timeline-node-scan"></div>
                        </div>
                        <div class="timeline-node-content">
                            <h3 class="timeline-node-title"><?= e($stage['title']) ?></h3>
                            <p class="timeline-node-desc"><?= e($stage['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" style="margin-top: 40px;">
        <div class="timeline-progress">
            <div class="timeline-progress-fill"></div>
        </div>
    </div>
</section>

<!-- ====== INDUSTRIES ====== -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center; color: var(--color-accent);">
                <span style="display: inline;">Industries</span>
            </span>
            <h2 class="section-title" style="color: white;">INDUSTRIES<br>WE SERVE</h2>
        </div>

        <div class="industry-grid">
            <?php
            $industryIcons = [
                'Automotive' => 'ENG',
                'Aerospace' => 'AERO',
                'Oil & Gas' => 'O&G',
                'Power Plants' => 'PWR',
                'Railways' => 'RAIL',
                'Foundries' => 'FND',
                'Forging' => 'FRG',
                'Fabrication' => 'FAB',
                'General Engineering' => 'GEN'
            ];
            foreach ($industries as $indIdx => $ind):
                $icon = $industryIcons[$ind['name']] ?? 'NDT';
            ?>
                <div class="industry-card" data-cursor="EXPLORE">
                    <div class="industry-card-placeholder" style="padding: 0;">
                        <img src="https://picsum.photos/seed/industry-<?= $indIdx + 1 ?>/400/300" alt="<?= e($ind['name']) ?>" style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;">
                    </div>
                    <div class="industry-card-overlay">
                        <h3 class="industry-card-title"><?= e($ind['name']) ?></h3>
                        <p class="industry-card-sub"><?= e($ind['solutions']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== SOLUTIONS ====== -->
<section class="section">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">Solutions</span>
            </span>
            <h2 class="section-title">APPLICATION-FOCUSED<br>SOLUTIONS</h2>
        </div>

        <div class="services-grid" style="grid-template-columns: repeat(3, 1fr);">
            <?php
            $solutions = [
                ['Surface Inspection', 'Surface crack and defect detection using MPI, PT and eddy current testing.'],
                ['Tube Inspection', 'Internal tube inspection for heat exchangers, condensers and boilers using eddy current.'],
                ['Weld Inspection', 'Comprehensive weld inspection with PAUT, TOFD, MPI and radiographic methods.'],
                ['Corrosion Mapping', 'Wall thickness measurement and corrosion mapping using phased array UT.'],
                ['Sorting & Detection', 'Automated sorting and crack detection on production lines using eddy current.'],
                ['Automated Testing', 'Complete automated inspection cells with feeding, handling and data logging.'],
            ];
            foreach ($solutions as $sol):
            ?>
                <div class="service-item">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                        </svg>
                    </div>
                    <h3 class="service-title"><?= $sol[0] ?></h3>
                    <p class="service-desc"><?= $sol[1] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== SERVICES ====== -->
<section class="section" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">Services</span>
            </span>
            <h2 class="section-title">ENGINEERING<br>SERVICES</h2>
        </div>

        <div class="services-grid">
            <?php
            $services = [
                ['Application Engineering', 'Understanding your inspection requirements and recommending the optimal NDT solution.'],
                ['Equipment Selection', 'Selecting the right NDT instruments, probes, wedges and accessories for your application.'],
                ['Installation', 'Professional on-site installation and integration of inspection systems.'],
                ['Commissioning', 'System commissioning, calibration and performance validation.'],
                ['Training', 'Comprehensive operator training on NDT equipment and inspection techniques.'],
                ['Service & Spares', 'Ongoing maintenance, technical support and spares supply.'],
            ];
            foreach ($services as $svc):
            ?>
                <div class="service-item">
                    <div class="service-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                        </svg>
                    </div>
                    <h3 class="service-title"><?= $svc[0] ?></h3>
                    <p class="service-desc"><?= $svc[1] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== WHY JAGS ====== -->
<section class="section">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Why JAGS</span>
                <h2 class="section-title">WHY PARTNER WITH<br>JAGS TECHNOLOGIES?</h2>

                <div style="display: flex; flex-direction: column; gap: 20px; margin-top: 40px;">
                    <?php
                    $whyItems = [
                        ['Application-Driven Sales Support', 'We understand your application before recommending a solution.'],
                        ['Multiple NDT Technologies Under One Roof', 'Eddy Current, PAUT, TOFD, MPI, PT — all from a single partner.'],
                        ['Customized Automation', 'From feeding to inspection to data — fully customized systems.'],
                        ['Probe, Calibration & Accessory Support', 'Complete range of probes, calibration blocks and accessories.'],
                        ['Installation & Commissioning', 'Professional installation and commissioning at your facility.'],
                        ['Training & After-Sales Service', 'Comprehensive training and ongoing technical support.'],
                    ];
                    foreach ($whyItems as $item):
                    ?>
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="flex-shrink: 0; width: 28px; height: 28px; border-radius: 6px; background: var(--color-accent-subtle); display: flex; align-items: center; justify-content: center; margin-top: 2px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--color-brand)" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h4 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 4px;"><?= $item[0] ?></h4>
                                <p style="font-size: 0.8rem; color: var(--color-text-secondary); line-height: 1.6;"><?= $item[1] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="split-image img-reveal has-scan">
                <img src="https://picsum.photos/seed/why-jags/800/600" alt="Why JAGS Technologies" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;">
                <div class="scan-line"></div>
            </div>
        </div>
    </div>
</section>

<!-- ====== PROJECTS ====== -->
<section class="section" style="background: var(--color-bg-alt);">
    <div class="container">
        <div class="section-header" style="text-align: center;">
            <span class="section-label" style="padding-left: 0; display: block; text-align: center;">
                <span style="display: inline;">Projects</span>
            </span>
            <h2 class="section-title">ENGINEERED<br>INSPECTION SOLUTIONS</h2>
        </div>

        <div class="project-grid">
            <?php
            $projectPlaceholders = [
                ['Automotive', 'Automated Component Inspection System', 'Complete automated inspection cell with feeding, eddy current testing and sorting for automotive components.', 'https://picsum.photos/seed/project-auto/600/400'],
                ['Oil & Gas', 'Tube Inspection Solution', 'Multi-frequency eddy current tube inspection system for heat exchanger tubes in refinery.', 'https://picsum.photos/seed/project-oil/600/400'],
                ['Aerospace', 'Weld Inspection System', 'Phased array ultrasonic inspection system for aerospace structural welds.', 'https://picsum.photos/seed/project-aero/600/400'],
                ['Power Plants', 'Corrosion Mapping Solution', 'Automated corrosion mapping system for pressure vessel and piping inspection.', 'https://picsum.photos/seed/project-power/600/400'],
            ];
            foreach ($projectPlaceholders as $proj):
            ?>
                <div class="project-card">
                    <div class="project-card-image">
                        <img src="<?= $proj[3] ?>" alt="<?= $proj[1] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="project-card-body">
                        <span class="project-card-tag"><?= $proj[0] ?></span>
                        <h3 class="project-card-title"><?= $proj[1] ?></h3>
                        <p class="project-card-desc"><?= $proj[2] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== REQUEST A QUOTE ====== -->
<section class="section" id="quote">
    <div class="container">
        <div class="split-section">
            <div>
                <span class="section-label">Contact</span>
                <h2 class="section-title">TELL US ABOUT YOUR<br>INSPECTION REQUIREMENT</h2>
                <p class="section-desc">
                    Fill in the details below and our engineering team will identify
                    the right inspection or automation solution for your application.
                </p>
            </div>

            <div>
                <form id="quoteForm" class="quote-form" onsubmit="return false;">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="q-name">Name *</label>
                            <input type="text" id="q-name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="q-company">Company</label>
                            <input type="text" id="q-company" name="company" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="q-email">Email *</label>
                            <input type="email" id="q-email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="q-phone">Phone</label>
                            <input type="tel" id="q-phone" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="q-industry">Industry</label>
                            <select id="q-industry" name="industry" class="form-control">
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
                            <label for="q-ndt">NDT Technology</label>
                            <select id="q-ndt" name="ndt_technology" class="form-control">
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
                        <label for="q-message">Requirement</label>
                        <textarea id="q-message" name="message" class="form-control" rows="5" placeholder="Describe your inspection requirement..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="q-file">Upload Specification / Drawing</label>
                        <input type="file" id="q-file" name="specification_file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.jpg,.jpeg,.png,.dwg,.dxf,.step" style="padding: 10px;">
                        <div style="font-size: 0.72rem; color: var(--color-text-muted); margin-top: 6px;">Max 25 MB — PDF, Word, Excel, ZIP, images or CAD files</div>
                    </div>
                    <div id="formMessage"></div>
                    <button type="submit" class="btn btn-primary magnetic-btn" style="width: 100%; justify-content: center;" id="submitBtn">
                        REQUEST A QUOTE
                        <span class="btn-arrow">&rarr;</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ====== FINAL CTA ====== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">HAVE AN INSPECTION<br>CHALLENGE?</h2>
            <p class="cta-desc">
                Tell us about your application and let our team help identify
                the right inspection or automation solution.
            </p>
            <div class="cta-actions">
                <a href="<?= BASE_URL ?>/pages/contact.php" class="btn btn-white magnetic-btn">
                    REQUEST A QUOTE
                    <span class="btn-arrow">&rarr;</span>
                </a>
                <a href="<?= BASE_URL ?>/pages/products.php" class="btn btn-outline-white magnetic-btn">
                    CONTACT OUR TEAM
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('quoteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const btn = document.getElementById('submitBtn');
        const msg = document.getElementById('formMessage');
        const formData = new FormData(form);

        const fileInput = document.getElementById('q-file');
        if (fileInput && fileInput.files.length && fileInput.files[0].size > 25 * 1024 * 1024) {
            msg.innerHTML = '<div class="form-error">Attachment is too large. Maximum file size is 25 MB.</div>';
            return;
        }

        btn.textContent = 'Sending...';
        btn.disabled = true;

        fetch('api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    msg.innerHTML = '<div class="form-success">Thank you! Your enquiry has been received. We will get back to you shortly.</div>';
                    form.reset();
                } else {
                    msg.innerHTML = '<div class="form-error">' + (data.message || 'Something went wrong. Please try again.') + '</div>';
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

<?php include __DIR__ . '/includes/footer.php'; ?>