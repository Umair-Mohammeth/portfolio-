# Portfolio — Mohammed Nazar Umair Mohammeth

Personal portfolio website built on WordPress with a custom dark-tech theme.

**Live:** [https://github.com/Umair-Mohammeth/portfolio-](https://github.com/Umair-Mohammeth/portfolio-)

## Tech Stack

- **CMS:** WordPress
- **Theme:** Custom Tech Portfolio (custom-coded, no page builders)
- **Languages:** PHP, JavaScript, CSS, SVG
- **Integrations:** GitHub API (live repo display)

## Features

- Dark theme with gold accent palette
- Live GitHub project feed via API
- Education timeline & certifications grid
- Responsive, mobile-friendly layout
- Custom Post Type (Projects) with taxonomy filtering

## Structure

```
assets/                        — Frontend assets (CSS, JS, images)
├── css/
├── images/
│   └── projects/              — Themed SVG project thumbnails
└── js/
shared-assets/                 — Shared resources (logo)
wp-content/themes/
└── custom-portfolio-theme/    — Custom WordPress theme
    ├── front-page.php         — Homepage with hero, stats, GitHub feed
    ├── page-about.php         — About & credentials
    ├── page-github-projects.php — Full GitHub projects archive
    ├── archive-projects.php   — Projects CPT with live GitHub feed
    ├── single-projects.php    — Single project detail
    ├── functions.php          — Theme setup, CPT, shortcodes
    └── style.css              — All theme styles
```

## Setup

1. Clone into a WordPress installation's `wp-content/themes/` or serve from XAMPP/WAMP
2. Activate the **Custom Tech Portfolio** theme from WP Admin
3. Create pages: Home, About, Experience, Contact and assign the corresponding templates
4. Create a page with the **GitHub Projects Archive** template for the live repo feed
