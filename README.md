# JAGS Technologies — Website

Premium industrial NDT equipment and automation website built with PHP, MySQL, GSAP, and custom animations.

## Features

- **Complete NDT Product Catalogue** — Eddy Current, PAUT/TOFD, MPI, PT, Probes & Accessories
- **Industrial Automation** — Feeding, Inspection Machines, Robotics, PLC/HMI, Data & Traceability
- **10-Step Engineering Workflow** — Interactive horizontal timeline with scroll-triggered animations
- **Custom Cursor** — Magnetic interactions, contextual labels (VIEW, EXPLORE, OPEN, DRAG)
- **Cinematic Hero** — Parallax, scan lines, technical grid overlays
- **Full-Screen Scanning Section** — Image transitions with clip-path masking
- **Responsive Design** — Mobile-first, tablet, desktop breakpoints
- **Quote/Contact Forms** — AJAX submission with database storage
- **Admin Panel** — View products, enquiries, projects at `/admin.php`

## Tech Stack

- **Backend:** PHP 8+, MySQL 8+
- **Frontend:** Vanilla JS, GSAP 3.12+, ScrollTrigger
- **Styling:** CSS Custom Properties, Inter font
- **Database:** PDO with prepared statements

## Project Structure

```
n/
├── index.php                 # Homepage with all sections
├── admin.php                 # Admin dashboard
├── database/
│   └── setup.sql             # Database schema + seed data
├── includes/
│   ├── config.php            # DB connection, helpers
│   ├── header.php            # Header + nav + cursor
│   └── footer.php            # Footer + script includes
├── pages/
│   ├── products.php          # Product catalogue with filters
│   ├── product-detail.php    # Product detail page
│   ├── automation.php        # Automation systems
│   ├── industries.php        # Industries served
│   ├── about.php             # About JAGS
│   ├── contact.php           # Contact/quote form
│   ├── projects.php          # Project showcase
│   └── solutions.php         # Application solutions
├── api/
│   └── contact.php           # Quote form endpoint
├── assets/
│   ├── css/
│   │   ├── main.css          # Core styles, layout, components
│   │   ├── animations.css    # Reveal, scan, cursor, transitions
│   │   └── responsive.css    # Mobile, tablet, reduced-motion
│   ├── js/
│   │   ├── cursor.js         # Custom cursor + magnetic buttons
│   │   ├── main.js           # GSAP animations, scroll, parallax
│   │   └── timeline.js       # Horizontal workflow timeline
│   └── images/               # Image directories
```

## Installation

### 1. Database Setup
```sql
-- In phpMyAdmin or MySQL CLI:
CREATE DATABASE jags_technologies;
USE jags_technologies;
SOURCE database/setup.sql;
```

### 2. Configure Database
Edit `includes/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'jags_technologies');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

### 3. Web Server
Point your Apache/Nginx document root to the `n/` directory.

**Apache (XAMPP):**
```
C:\xampp\htdocs\n\
```
Access at: `http://localhost/n/`

**Nginx:**
```nginx
root /path/to/n;
index index.php;
location ~ \.php$ {
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    include fastcgi_params;
}
```

### 4. Enable mod_rewrite (optional for clean URLs)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

## Database Schema

- **categories** — NDT & Automation categories
- **products** — Product catalogue with JSON gallery
- **industries** — Industry sectors with solutions
- **projects** — Completed projects
- **timeline_stages** — 10-step engineering workflow
- **quote_requests** — Form submissions
- **site_settings** — Config values

## Key Components

### Custom Cursor (`assets/js/cursor.js`)
- Dot + ring with inertia following
- Magnetic expansion on button hover
- Context labels: VIEW, EXPLORE, OPEN, DRAG
- Disabled on touch devices

### Magnetic Buttons (`.magnetic-btn`)
- Subtle attraction toward cursor (max 8px)
- Smooth return on mouseleave

### Workflow Timeline (`assets/js/timeline.js`)
- Pinned horizontal scroll on desktop
- Vertical stack on mobile
- Active node highlighting with scan line
- Progress indicator

### GSAP Animations (`assets/js/main.js`)
- Hero staggered entrance
- Section scroll reveals
- Split-section parallax
- Card hover 3D tilt (via CSS)

## Pages Overview

| Page | Description |
|------|-------------|
| `/` | Complete homepage: Hero → Who We Are → NDT Tech → ECT → PAUT → MPI/PT → Full-Screen Scan → Automation Flow → Timeline → Industries → Solutions → Services → Why JAGS → Projects → Quote → CTA |
| `/pages/products.php` | Filterable product grid by category |
| `/pages/product-detail.php` | Product detail with features, applications, related |
| `/pages/automation.php` | 5 automation modules with split layouts |
| `/pages/industries.php` | 9 industry cards with descriptions |
| `/pages/about.php` | Mission, capabilities, 10-step workflow |
| `/pages/contact.php` | Full quote form with file upload |
| `/pages/projects.php` | Project showcase grid |
| `/pages/solutions.php` | Application-focused solutions |
| `/admin.php` | Admin dashboard with stats & enquiries |

## Color System

```css
--color-bg: #F7F8FA;           /* Main background */
--color-bg-white: #FFFFFF;     /* Cards, sections */
--color-bg-dark: #0A0E17;      /* Dark sections */
--color-text: #1A1D26;         /* Primary text */
--color-brand: #1B5E9E;        /* Primary blue */
--color-accent: #00B4D8;       /* Cyan accent */
--color-border: #E2E5EB;       /* Borders */
```

## Typography

- **Font:** Inter (300-900)
- **Hero:** clamp(3rem, 7vw, 6rem), 900 weight
- **Section titles:** 2.75rem, 900 weight
- **Technical labels:** 0.7rem, 600 weight, 0.14em letter-spacing

## Animation Philosophy

- **Mechanical precision** — No bounce, rubber-band, or float
- **GPU-friendly** — transform, opacity only
- **Reduced motion** — Respects `prefers-reduced-motion`
- **Purposeful** — Every animation communicates engineering/inspection

## Adding Products

1. Go to `/admin.php` to view current counts
2. Insert via MySQL or build admin UI:
```sql
INSERT INTO products (name, slug, category_id, short_description, description, features, applications, technology, image, sort_order)
VALUES ('Product Name', 'product-slug', 1, 'Short desc', 'Full description', 'Feature 1\nFeature 2', 'App 1\nApp 2', 'ECT', 'assets/images/products/image.jpg', 1);
```

## Adding Images

Place images in appropriate directories:
- `assets/images/ndt/` — NDT product images
- `assets/images/automation/` — Automation system images
- `assets/images/industries/` — Industry photos
- `assets/images/timeline/` — Workflow step images
- `assets/images/hero/` — Hero background

Reference in database with relative path: `assets/images/ndt/product.jpg`

## Performance Notes

- Images: Use WebP/AVIF, lazy-load with `loading="lazy"`
- CSS/JS: Minify for production
- GSAP: Already loaded from CDN (consider local for offline)
- Database: Add indexes on `slug`, `category_id`, `is_active`

## Browser Support

- Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- Requires ES6 modules support (for GSAP from CDN)
- `IntersectionObserver` for scroll reveals
- CSS Grid/Flexbox for layout

## License

Proprietary — JAGS Technologies 2026