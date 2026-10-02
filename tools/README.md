# tools/

Development launchers.

- `run.bat` — starts WordPress Playground (`npx @wp-playground/cli server`) at `http://localhost:9400`, with automatic sign-in. Checks that Node.js and npm are installed first.
- `blueprint.json` — Playground blueprint: logs in, sets site title/description, installs and activates the WordPress Importer.

Run `run.bat` from inside this folder — it resolves `blueprint.json` relative to itself.
