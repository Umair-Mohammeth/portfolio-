# custom-portfolio-theme

Custom WordPress theme for this portfolio. Registers the `projects` post type with meta boxes for tech stack, GitHub URL, live URL, and PDF documentation link.

## Templates

| File | Role |
|------|------|
| `style.css` | Theme header + all styles |
| `theme.json` | Global settings & styles |
| `functions.php` | Theme setup, CPT `projects`, meta boxes, image helpers, asset enqueue |
| `front-page.php` | Homepage |
| `index.php` | Fallback template |
| `header.php` / `footer.php` | Site chrome |
| `page.php` | Default page |
| `page-about.php` / `page-experience.php` | Custom page layouts |
| `archive-projects.php` / `single-projects.php` | Projects listing / detail |
| `search.php` / `404.php` | Search results / not found |
| `template-parts/` | Reusable partials (hero, project card) |
| `assets/` | JavaScript and SVG images |

## Notes

- Project art fallback: `assets/images/*.svg` is served via `functions.php` when a project has no featured image.
- Textdomain `tech-portfolio` loads from `languages/` — create that folder when adding `.po` translation files.
