# Portfolio — WordPress Site

Personal portfolio running as a WordPress install in the XAMPP doc root: `http://localhost`

## Layout

| Path | Purpose |
|------|---------|
| `wp-admin/`, `wp-includes/`, `wp-*.php` | WordPress core (git-ignored, managed by WP updates) |
| `wp-config.php` | Local DB config (git-ignored) |
| `wp-content/` | Theme, uploads, plugins |
| `wp-content/themes/custom-portfolio-theme/` | Custom theme — the main codebase |
| `tools/` | WordPress Playground launcher (`run.bat` + `blueprint.json`) |
| `exports/` | WordPress WXR export of the site |
| `desktop/` | WPF/XAML desktop mock-up experiment |
| `notes/` | Personal web-dev notes |
| `.agents/` | opencode agent skills |
| `.env`, `docker-compose.yml` | Docker WordPress stack (port 8080) |

## Running locally

- **XAMPP**: start Apache + MySQL → `http://localhost`
- **Docker**: `docker compose up` → `http://localhost:8080`
- **Playground**: `tools\run.bat` → `http://localhost:9400` (login is handled automatically by the blueprint)

## Git

Tracked: custom theme, root config, tooling. Ignored: WP core, `wp-config.php`, `.env`, `wp-content/uploads/`.
