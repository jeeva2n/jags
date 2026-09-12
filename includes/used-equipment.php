<?php
/* ============================================================
   USED EQUIPMENT - DATA & HELPERS
   Used equipment is managed dynamically from the admin panel
   (admin/entity.php?t=used-items and ?t=used-categories).
   Data lives in the `used_equipment_categories` and
   `used_equipment_items` tables. On first use the tables are
   created automatically and seeded from the static data below;
   the static arrays also serve as a safe fallback.
   ============================================================ */

/* --------------- DB readiness + one-time migration --------------- */

function ue_use_db(?bool $value = null): bool
{
    static $ready = null;
    if ($value !== null) {
        $ready = $value;
        return $ready;
    }
    if ($ready !== null) {
        return $ready;
    }
    try {
        $db = getDB();
        $db->query("SELECT id FROM used_equipment_categories LIMIT 1")->fetchAll();
        $db->query("SELECT id FROM used_equipment_items LIMIT 1")->fetchAll();
        $ready = true;
    } catch (Exception $e) {
        $ready = false;
    }
    return $ready;
}

function ue_ensure_tables(): void
{
    if (ue_use_db()) {
        return;
    }
    try {
        $db = getDB();
        $db->exec(
            "CREATE TABLE IF NOT EXISTS used_equipment_categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                code VARCHAR(20) NOT NULL,
                slug VARCHAR(255) NOT NULL UNIQUE,
                description TEXT,
                image VARCHAR(500),
                is_active TINYINT(1) DEFAULT 1,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_ue_cat_active (is_active, sort_order)
            ) ENGINE=InnoDB"
        );
        $db->exec(
            "CREATE TABLE IF NOT EXISTS used_equipment_items (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                slug VARCHAR(255) NOT NULL UNIQUE,
                category_id INT NULL,
                manufacturer VARCHAR(255),
                model VARCHAR(255),
                condition_value VARCHAR(50),
                availability VARCHAR(50),
                image VARCHAR(500),
                short_description TEXT,
                description TEXT,
                specifications TEXT,
                features TEXT,
                is_active TINYINT(1) DEFAULT 1,
                featured TINYINT(1) DEFAULT 0,
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_ue_item_cat (category_id),
                CONSTRAINT fk_ue_item_cat FOREIGN KEY (category_id)
                    REFERENCES used_equipment_categories(id) ON DELETE SET NULL
            ) ENGINE=InnoDB"
        );

        $catCount = (int)$db->query("SELECT COUNT(*) FROM used_equipment_categories")->fetchColumn();
        if ($catCount === 0) {
            $catStmt = $db->prepare(
                "INSERT INTO used_equipment_categories (name, code, slug, description, image, sort_order, is_active)
                 VALUES (?, ?, ?, ?, ?, ?, 1)"
            );
            $catIds = [];
            foreach (ue_static_categories() as $i => $c) {
                $catStmt->execute([$c['name'], $c['code'], $c['slug'], $c['desc'], '', $i + 1]);
                $catIds[$c['slug']] = (int)$db->lastInsertId();
            }

            $itemStmt = $db->prepare(
                "INSERT INTO used_equipment_items
                    (name, slug, category_id, manufacturer, model, condition_value, availability,
                     image, short_description, description, specifications, features, is_active, featured, sort_order)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, 0)"
            );
            foreach (ue_static_equipment() as $it) {
                $itemStmt->execute([
                    $it['name'],
                    $it['slug'],
                    $catIds[$it['category']] ?? null,
                    $it['manufacturer'],
                    $it['model'],
                    $it['condition'],
                    $it['availability'],
                    $it['image'] ?? '',
                    $it['shortDescription'],
                    $it['description'],
                    implode("\n", $it['specifications']),
                    implode("\n", $it['features']),
                    (int)!empty($it['featured']),
                ]);
            }
        }

        ue_use_db(true);
    } catch (Exception $e) {
        // Table created per request may fail (permissions, etc.); static data keeps working.
        ue_use_db(false);
    }
}

function ue_lines(?string $text): array
{
    if ($text === null || trim($text) === '') {
        return [];
    }
    $lines = array_map('trim', explode("\n", $text));
    return array_values(array_filter($lines, fn($l) => $l !== ''));
}

/* --------------- Seed data (fallback + initial migration source) --------------- */

function ue_static_categories(): array
{
    return [
        ['slug' => 'avn', 'code' => 'AVN', 'name' => 'Automatic Testing Systems', 'desc' => 'Automated eddy current evaluation systems for inline testing and production-line inspection cells.'],
        ['slug' => 'probes', 'code' => 'Probes', 'name' => 'Probes & Sensors', 'desc' => 'Eddy current probes, rotating field probes, MFL sensors and calibration accessories.'],
        ['slug' => 'ect', 'code' => 'ECT', 'name' => 'Eddy Current Testing', 'desc' => 'Eddy current instruments and crack detection systems for surface and sub-surface defects.'],
        ['slug' => 'rfet', 'code' => 'RFET', 'name' => 'Rotating Field Eddy Current Testing', 'desc' => 'Rotating field eddy current testing systems for round bars, tubes and wire inspection.'],
        ['slug' => 'nft', 'code' => 'NFT', 'name' => 'Near-Field Testing', 'desc' => 'Near-field testing technology for ferromagnetic tube and heat exchanger inspection.'],
        ['slug' => 'rfa', 'code' => 'RFA', 'name' => 'Rotating Field Analysis', 'desc' => 'Rotating field analysis instruments for surface defect detection in cylindrical products.'],
        ['slug' => 'nfa', 'code' => 'NFA', 'name' => 'Near-Field Analysis', 'desc' => 'Near-field analysis systems for fine surface inspection of wires and small diameter products.'],
        ['slug' => 'mfl', 'code' => 'MFL', 'name' => 'Magnetic Flux Leakage', 'desc' => 'Magnetic flux leakage inspection systems for tubing, tanks and ferromagnetic materials.'],
    ];
}

function ue_static_equipment(): array
{
    return [
        [
            'id' => 101,
            'slug' => 'automated-eddy-current-evaluation-system',
            'name' => 'Automated Eddy Current Evaluation System',
            'category' => 'avn',
            'manufacturer' => 'Rohmann',
            'model' => 'ELOTEST AVN',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Multi-channel automated eddy current evaluation system for complete inline inspection cells.',
            'description' => 'Professionally refurbished automated eddy current evaluation system, delivered with a technical inspection report and supported by the JAGS Technologies service team. Suited for integration into new or existing production-line testing cells.',
            'specifications' => [
                'Multi-frequency eddy current electronics',
                'Up to 8 measuring channels',
                'Integrated evaluation and sorting logic',
                'RS-232 / LAN data interface',
                'Supply voltage 230 V / 50 Hz'
            ],
            'features' => [
                'Ready for cell integration',
                'Factory calibration included',
                'Operator and service documentation supplied',
                'One year service and spares support'
            ],
            'featured' => true
        ],
        [
            'id' => 102,
            'slug' => 'inline-testing-sorting-system',
            'name' => 'Inline Testing & Sorting System',
            'category' => 'avn',
            'manufacturer' => 'Foerster',
            'model' => 'STATOGRAPH DG',
            'condition' => 'Used',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Production-line eddy current testing and sorting system with parts handling interface.',
            'description' => 'Used eddy current testing and sorting system in good working condition. Includes interface for existing parts handling and marking equipment.',
            'specifications' => [
                'Eddy current crack and hardness inspection',
                'Integrated sorting interface',
                'Encoder and proximity trigger inputs',
                'Robust industrial enclosure',
                '230 V / 50 Hz supply'
            ],
            'features' => [
                'Field proven electronics',
                'Spare connectors and cables included',
                'Technical health check performed',
                'Installation support on request'
            ],
            'featured' => false
        ],
        [
            'id' => 103,
            'slug' => 'rotating-eddy-current-probe-set',
            'name' => 'Rotating Eddy Current Probe Set',
            'category' => 'probes',
            'manufacturer' => 'Rohmann',
            'model' => 'RPC 60/90',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Refurbished rotating eddy current probe set with drive and connectors for round product inspection.',
            'description' => 'Refurbished rotating probe set comprising probe carrier, drive and connecting cables. Suitable for round product eddy current inspection applications.',
            'specifications' => [
                'Rotating probe carrier 60 / 90 mm',
                'Exchangeable probe holders',
                '2 m cable with connector',
                'Including calibration artefacts'
            ],
            'features' => [
                'Checked and serviced by our team',
                'Genuine spare parts fitted',
                'Supplied in protective case'
            ],
            'featured' => false
        ],
        [
            'id' => 104,
            'slug' => 'surface-eddy-current-probe',
            'name' => 'Surface Eddy Current Probe',
            'category' => 'probes',
            'manufacturer' => 'Ether NDE',
            'model' => 'Crack MicroPlus Probe',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Compact surface eddy current probe for crack detection on machined components.',
            'description' => 'Compact surface eddy current probe in good condition, suitable for crack and defect detection on machined and ground surfaces.',
            'specifications' => [
                'Frequency range 100 Hz - 10 MHz',
                'Differential coil arrangement',
                'Profile and bore variants',
                '90-day warranty'
            ],
            'features' => [
                'Tested against reference blocks',
                'Multiple sizes available on request',
                'Fast dispatch from stock'
            ],
            'featured' => true
        ],
        [
            'id' => 105,
            'slug' => 'multichannel-eddy-current-instrument',
            'name' => 'Multi-Channel Eddy Current Instrument',
            'category' => 'ect',
            'manufacturer' => 'Foerster',
            'model' => 'DEFECTOMAT CP',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Multi-channel eddy current instrument for crack detection and material sorting.',
            'description' => 'Used multi-channel eddy current instrument offering crack detection and material sorting capability for workshop and line applications.',
            'specifications' => [
                '4 measuring channels',
                'Frequency range 1 kHz - 1 MHz',
                'C-scope evaluation display',
                'Digital input / outputs'
            ],
            'features' => [
                'Recently serviced',
                'Suitable for test bench use',
                'Manual and quick start guides included'
            ],
            'featured' => true
        ],
        [
            'id' => 106,
            'slug' => 'eddy-current-crack-detection-system',
            'name' => 'Eddy Current Crack Detection System',
            'category' => 'ect',
            'manufacturer' => 'Rohmann',
            'model' => 'ELOTEST PL500',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Compact eddy current crack detection system for heat exchangers and surface testing.',
            'description' => 'Refurbished compact eddy current crack detection system with support for a wide range of probes and tube inspection tasks.',
            'specifications' => [
                'Single / dual frequency operation',
                'Spin, bobbin and surface probes supported',
                'Data storage and report export',
                'Remote control option'
            ],
            'features' => [
                'Factory test certificate provided',
                'Complete accessories kit included',
                'Backed by technical support'
            ],
            'featured' => false
        ],
        [
            'id' => 107,
            'slug' => 'rotating-field-eddy-current-tester',
            'name' => 'Rotating Field Eddy Current Tester',
            'category' => 'rfet',
            'manufacturer' => 'Rohmann',
            'model' => 'ELOTEST M3 RFET',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Rotating field eddy current tester for surface and shallow sub-surface inspection of cylindrical parts.',
            'description' => 'Refurbished rotating field eddy current tester for surface inspection of cylindrical parts, suitable for both hand-held and stand mounted operation.',
            'specifications' => [
                'Rotating field technology at 5 kHz',
                '2 independent channels',
                'Hand-held and stand configurations',
                'Battery operated'
            ],
            'features' => [
                'Battery and charger included',
                'Calibrated against reference samples',
                'Carry case supplied'
            ],
            'featured' => true
        ],
        [
            'id' => 108,
            'slug' => 'round-bar-inspection-system',
            'name' => 'Round Bar Inspection System',
            'category' => 'rfet',
            'manufacturer' => 'IbG',
            'model' => 'EQUALIS / RFET',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Complete rotating field inspection line for round bars with feeding and marking modules.',
            'description' => 'Used rotating field inspection line for round bars, delivered with feeding, inspection head and marking modules. Modular design simplifies relocation and re-commissioning.',
            'specifications' => [
                'Inspection speed up to 2 m/s',
                'Longitudinal and transverse defect detection',
                'Integrated marking unit',
                'PLC control cabinet'
            ],
            'features' => [
                'Complete line documentation included',
                'Spare probes available',
                'Commissioning assistance on request'
            ],
            'featured' => false
        ],
        [
            'id' => 109,
            'slug' => 'near-field-tube-inspection-system',
            'name' => 'Near-Field Tube Inspection System',
            'category' => 'nft',
            'manufacturer' => 'Rohmann',
            'model' => 'ELOTEST M3 NFT',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Near-field testing system for ferromagnetic heat exchanger and boiler tubes.',
            'description' => 'Refurbished near-field testing system for inspection of ferromagnetic heat exchanger and boiler tubes, complete with tube chart scanning software.',
            'specifications' => [
                'Near-field (NFT) evaluation',
                'Depth of defect assessment',
                'Tube chart scanning software',
                'Carrier frequencies 1 - 64 kHz'
            ],
            'features' => [
                'Software license transferred',
                'Calibration tubes supplied',
                'Operator training available'
            ],
            'featured' => true
        ],
        [
            'id' => 110,
            'slug' => 'ferromagnetic-tube-probe',
            'name' => 'Ferromagnetic Tube Probe',
            'category' => 'nft',
            'manufacturer' => 'Ether NDE',
            'model' => 'NF Probe 8/16 mm',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Near-field probe for ferromagnetic tubing with interchangeable sensor heads.',
            'description' => 'Near-field probe for ferromagnetic tubing, supplied with interchangeable sensor heads and spare wear parts.',
            'specifications' => [
                'Tube sizes 8 - 16 mm',
                'Detachable sensor head',
                'Kevlar cable, 50 m',
                'Spare wear parts included'
            ],
            'features' => [
                'Ready for immediate use',
                'Compatible with ELOTEST software',
                'Supplied in padded case'
            ],
            'featured' => false
        ],
        [
            'id' => 111,
            'slug' => 'rotating-field-analysis-instrument',
            'name' => 'Rotating Field Analysis Instrument',
            'category' => 'rfa',
            'manufacturer' => 'Rohmann',
            'model' => 'ELOTEST ISK-3 / RFA',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Rotating field analysis instrument for crack and seam detection on drawn products.',
            'description' => 'Refurbished rotating field analysis instrument for crack and seam detection on drawn round products, with integrated drive control.',
            'specifications' => [
                'Rotating field excitation',
                'Integrated drive control',
                'Analogue outputs for recording',
                'Optional sorting logic'
            ],
            'features' => [
                'Serviced and verified by our team',
                'Reference samples included',
                'Technical documentation supplied'
            ],
            'featured' => false
        ],
        [
            'id' => 112,
            'slug' => 'drawbench-seam-detection-system',
            'name' => 'Drawbench Seam Detection System',
            'category' => 'rfa',
            'manufacturer' => 'Foerster',
            'model' => 'CIRCOGRAPH',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Rotating field seam detection system for drawn round products at drawbench speeds.',
            'description' => 'Rotating field seam detection system used on drawbench lines for continuous inspection of drawn round products.',
            'specifications' => [
                'Compact rotating head',
                'Speed tracking electronics',
                'Marker integration',
                'Calibration rings included'
            ],
            'features' => [
                'Line proven performance',
                'Quick head service parts kit',
                'Installation drawings available'
            ],
            'featured' => false
        ],
        [
            'id' => 113,
            'slug' => 'near-field-analysis-wire-system',
            'name' => 'Near-Field Wire Analysis System',
            'category' => 'nfa',
            'manufacturer' => 'IbG',
            'model' => 'NFA 400',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Near-field analysis system for surface inspection of fine wire and small-diameter products.',
            'description' => 'Near-field analysis system for continuous surface inspection of fine wire and small diameter products at high line speeds.',
            'specifications' => [
                'Diameter range 0.5 - 8 mm',
                'High line speeds supported',
                'Integrated flaw display',
                'Service and diagnostics software'
            ],
            'features' => [
                'Complete with console desk',
                'Spare sensor cards included',
                'Remote support possible'
            ],
            'featured' => false
        ],
        [
            'id' => 114,
            'slug' => 'fine-wire-inspection-probe-head',
            'name' => 'Fine Wire Inspection Probe Head',
            'category' => 'nfa',
            'manufacturer' => 'Rohmann',
            'model' => 'NFA Probe Head',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Replaceable near-field probe head with sensor ring for fine wire inspection.',
            'description' => 'Refurbished near-field probe head with sensor ring, designed as a drop-in replacement for fine wire inspection stations.',
            'specifications' => [
                'Quick-change sensor module',
                'Wear-resistant guide rings',
                'Fits NFA test heads',
                'Including spare sensors'
            ],
            'features' => [
                'Interchangeable without re-wiring',
                'Tested against calibration wire',
                'Short delivery time'
            ],
            'featured' => false
        ],
        [
            'id' => 115,
            'slug' => 'mfl-tube-inspection-system',
            'name' => 'MFL Tube Inspection System',
            'category' => 'mfl',
            'manufacturer' => 'IbG',
            'model' => 'MFL 2000',
            'condition' => 'Refurbished',
            'availability' => 'In Stock',
            'image' => '',
            'shortDescription' => 'Magnetic flux leakage system for full-length inspection of ferromagnetic tubes and pipes.',
            'description' => 'Refurbished magnetic flux leakage system for full-length inspection of ferromagnetic tubes and pipes, with automated wall thickness evaluation.',
            'specifications' => [
                'Axial and transverse MFL sensors',
                'Diameter range 20 - 250 mm',
                'Automated wall thickness evaluation',
                'Data archiving and reporting'
            ],
            'features' => [
                'Full software package included',
                'Calibration standards supplied',
                'Commissioning by our engineers optional'
            ],
            'featured' => true
        ],
        [
            'id' => 116,
            'slug' => 'tank-floor-mfl-scanner',
            'name' => 'Tank Floor MFL Scanner',
            'category' => 'mfl',
            'manufacturer' => 'Ether NDE',
            'model' => 'TScan MFL',
            'condition' => 'Used',
            'availability' => 'On Request',
            'image' => '',
            'shortDescription' => 'Manual magnetic flux leakage scanner for above-ground storage tank floor inspection.',
            'description' => 'Manual magnetic flux leakage scanner for corrosion and pitting inspection of above-ground storage tank floors, with on-line defect mapping.',
            'specifications' => [
                'Scanning width 300 mm',
                'On-line defect mapping',
                'Battery powered, wireless data',
                'Lightweight carbon frame'
            ],
            'features' => [
                'Complete with battery kit and charger',
                'Software license transferred',
                'Flight case included'
            ],
            'featured' => false
        ],
    ];
}

/* --------------- Public helpers (used by the frontend) --------------- */

function ue_categories(): array
{
    ue_ensure_tables();
    if (!ue_use_db()) {
        return ue_static_categories();
    }
    $db = getDB();
    $rows = $db->query(
        "SELECT * FROM used_equipment_categories WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
    )->fetchAll();
    $out = [];
    foreach ($rows as $r) {
        $out[] = [
            'id'    => (int)$r['id'],
            'slug'  => $r['slug'],
            'code'  => $r['code'],
            'name'  => $r['name'],
            'desc'  => $r['description'] ?? '',
            'image' => $r['image'] ?? '',
        ];
    }
    return $out;
}

function ue_category(string $slug): ?array
{
    foreach (ue_categories() as $c) {
        if ($c['slug'] === $slug) {
            return $c;
        }
    }
    return null;
}

function ue_equipment(): array
{
    ue_ensure_tables();
    if (!ue_use_db()) {
        return ue_static_equipment();
    }
    $db = getDB();
    $rows = $db->query(
        "SELECT i.*, c.slug AS category_slug, c.code AS category_code, c.name AS category_name
         FROM used_equipment_items i
         LEFT JOIN used_equipment_categories c ON i.category_id = c.id
         WHERE i.is_active = 1
         ORDER BY c.sort_order ASC, i.sort_order ASC, i.id ASC"
    )->fetchAll();
    $out = [];
    foreach ($rows as $r) {
        $out[] = [
            'id'              => (int)$r['id'],
            'slug'            => $r['slug'],
            'name'            => $r['name'],
            'category'        => $r['category_slug'] ?? '',
            'category_code'   => $r['category_code'] ?? '',
            'manufacturer'    => $r['manufacturer'] ?? '',
            'model'           => $r['model'] ?? '',
            'condition'       => $r['condition_value'] ?? '',
            'availability'    => $r['availability'] ?? '',
            'image'           => $r['image'] ?? '',
            'shortDescription'=> $r['short_description'] ?? '',
            'description'     => $r['description'] ?? '',
            'specifications'  => ue_lines($r['specifications']),
            'features'        => ue_lines($r['features']),
            'featured'        => (bool)(int)$r['featured'],
        ];
    }
    return $out;
}

function ue_equipment_by_slug(string $slug): ?array
{
    foreach (ue_equipment() as $item) {
        if ($item['slug'] === $slug) {
            return $item;
        }
    }
    return null;
}

function ue_equipment_by_category(string $slug): array
{
    $items = [];
    foreach (ue_equipment() as $item) {
        if ($item['category'] === $slug) {
            $items[] = $item;
        }
    }
    return $items;
}

function ue_item_image(array $item): string
{
    $img = (string)($item['image'] ?? '');
    if ($img === '') {
        return '';
    }
    return strpos($img, 'http') === 0 ? $img : BASE_URL . '/' . ltrim($img, '/');
}