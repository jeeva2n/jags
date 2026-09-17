DROP DATABASE IF EXISTS jags_technologies;
CREATE DATABASE jags_technologies CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jags_technologies;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(500),
    parent_id INT DEFAULT NULL,
    sort_order INT DEFAULT 0,
    type ENUM('ndt','automation') NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category_id INT,
    short_description TEXT,
    description TEXT,
    applications TEXT,
    features TEXT,
    technology VARCHAR(255),
    image VARCHAR(500),
    gallery JSON,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE industries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    image VARCHAR(500),
    solutions TEXT,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    industry VARCHAR(255),
    solution TEXT,
    description TEXT,
    image VARCHAR(500),
    gallery JSON,
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE timeline_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    step_number INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(500),
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    company VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    industry VARCHAR(255),
    ndt_technology VARCHAR(255),
    requirement_type VARCHAR(255),
    message TEXT,
    specification_file VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(255) NOT NULL UNIQUE,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO categories (name, slug, description, type, sort_order) VALUES
('Eddy Current', 'eddy-current', 'Advanced electromagnetic inspection using conventional ECT, multi-channel ECT, eddy current array, tube inspection, sorting and crack detection.', 'ndt', 1),
('PAUT & TOFD', 'paut-tofd', 'Advanced ultrasonic inspection with portable PAUT instruments, TOFD systems, manual and encoded scanners, weld scanners, corrosion mapping scanners.', 'ndt', 2),
('Magnetic Particle Inspection', 'mpi', 'Professional magnetic particle inspection equipment and systems for surface and near-surface defect detection.', 'ndt', 3),
('Penetrant Testing', 'pt-systems', 'Professional penetrant testing systems for surface-breaking defect detection in non-porous materials.', 'ndt', 4),
('Probes & Accessories', 'probes-accessories', 'NDT probes, wedges, encoders, calibration blocks and accessories for all inspection technologies.', 'ndt', 5),
('Calibration Blocks', 'calibration-blocks', 'Precision calibration blocks for NDT instrument calibration and performance verification.', 'ndt', 6),
('MFL', 'mfl', 'Magnetic flux leakage inspection systems for tubing, tanks and ferromagnetic materials.', 'ndt', 7),
('Scanners & Crawlers', 'scanners-crawlers', 'Manual and encoded PAUT scanners, weld scanners, corrosion mapping scanners and crawlers.', 'ndt', 8),
('Probes & Sensors', 'probes-sensors', 'NDT probes, wedges, encoders, sensors and calibration accessories for all inspection technologies.', 'ndt', 9),
('Feeding & Handling', 'feeding-handling', 'Conveyors, vibratory bowl feeders, step feeders, loading/unloading systems, part orientation equipment.', 'automation', 1),
('Inspection Machines', 'inspection-machines', 'Rotary inspection systems, probe positioning, centering devices, multi-station inspection cells.', 'automation', 2),
('Robotics & Vision', 'robotics-vision', 'Robotic handling, automated scanning, vision-assisted identification and traceability systems.', 'automation', 3),
('PLC / HMI', 'plc-hmi', 'Industrial PLC control systems, HMI interfaces, sensors, encoders and interlocks.', 'automation', 4),
('Data & Traceability', 'data-traceability', 'Data acquisition, result logging, reports and production traceability systems.', 'automation', 5),
('Complete Inspection Solutions', 'complete-solutions', 'End-to-end customized inspection solutions from concept to commissioning.', 'automation', 6);

INSERT INTO timeline_stages (step_number, title, description, sort_order) VALUES
(1, 'Application Study', 'Understanding the inspection requirement through detailed analysis of the component, defect types, and production environment.', 1),
(2, 'Method Selection', 'Evaluating and selecting the most appropriate NDT inspection technology for the application.', 2),
(3, 'Equipment & Probe Selection', 'Selecting the right NDT instrument, probes, wedges and accessories for the application.', 3),
(4, 'Mechanical Design', 'Designing custom inspection machinery, fixtures and handling systems using CAD engineering.', 4),
(5, 'Electrical / PLC Integration', 'Designing and integrating PLC control systems, HMI interfaces, sensors and safety interlocks.', 5),
(6, 'Manufacturing', 'Manufacturing and assembling the inspection system with precision engineering standards.', 6),
(7, 'Calibration & FAT', 'System calibration and Factory Acceptance Testing to verify performance and accuracy.', 7),
(8, 'Installation', 'On-site installation and integration of the inspection system at the customer facility.', 8),
(9, 'Training & Commissioning', 'Operator training, system commissioning and performance validation.', 9),
(10, 'Service & Support', 'Ongoing maintenance, technical support, spares and calibration services.', 10);

INSERT INTO industries (name, slug, description, solutions, sort_order) VALUES
('Automotive', 'automotive', 'NDT inspection and automation solutions for automotive component manufacturing, engine parts, safety-critical components.', 'Component inspection, surface crack detection, automated production line testing', 1),
('Aerospace', 'aerospace', 'Advanced NDT solutions for aerospace components, turbine blades, structural parts and composite materials.', 'PAUT weld inspection, eddy current surface inspection, corrosion mapping', 2),
('Oil & Gas', 'oil-gas', 'Pipeline inspection, pressure vessel testing and refinery equipment NDT solutions.', 'Tube inspection, weld inspection, corrosion mapping, automated pipe inspection', 3),
('Power Plants', 'power-plants', 'Nuclear, thermal and renewable power plant inspection equipment and solutions.', 'Turbine inspection, boiler tube inspection, structural weld testing', 4),
('Railways', 'railways', 'Railway component inspection including wheels, axles, tracks and structural components.', 'Wheel and axle testing, surface crack detection, automated component inspection', 5),
('Foundries', 'foundries', 'NDT solutions for casting inspection, defect detection and quality assurance in foundry operations.', 'Radiographic testing, ultrasonic testing, surface inspection', 6),
('Forging', 'forging', 'Inspection systems for forged components ensuring structural integrity and defect-free production.', 'Ultrasonic testing, magnetic particle inspection, eddy current testing', 7),
('Fabrication', 'fabrication', 'Weld inspection and structural testing solutions for fabrication workshops and shipyards.', 'Weld inspection, PAUT/TOFD, MPI, PT systems', 8),
('General Engineering', 'general-engineering', 'Versatile NDT and automation solutions for general engineering and manufacturing applications.', 'Multi-technology inspection, custom automation, quality systems', 9);

INSERT INTO site_settings (setting_key, setting_value) VALUES
('company_name', 'JAGS Technologies'),
('tagline', 'Engineering Precision. Inspection Excellence.'),
('address', 'F-16, 2nd Cross Main Rd, Ambattur Industrial Estate, Chennai, Tamil Nadu 600058'),
('phone', '+91 94443 76041'),
('email', 'info@jags.com'),
('website', 'https://jags.com'),
('meta_description', 'JAGS Technologies - Advanced NDT Equipment & Industrial Automation Solutions');