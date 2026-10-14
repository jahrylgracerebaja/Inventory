# Item Management System

A small Laravel application for creating, viewing, editing, and deleting inventory items. It uses Blade templates, responsive CSS, Eloquent, and SQLite by default.

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm

## Run locally

From the project directory, run:

```powershell
composer install
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
if (-not (Select-String -Path .env -Pattern '^APP_KEY=.+$' -Quiet)) { php artisan key:generate }
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File -Path database/database.sqlite | Out-Null }
php artisan migrate
npm ci
npm run build
php artisan serve
```

Open the URL printed by `php artisan serve` (usually `http://127.0.0.1:8000`). The default configuration uses SQLite at `database/database.sqlite`. To use MySQL instead, update the `DB_*` values in `.env` before running migrations.

For live CSS updates during development, run `npm run dev` in a second terminal instead of building the assets once.

## Tests

```powershell
php artisan route:list
php artisan test
```

The feature tests cover listing (including the empty state), create validation and persistence, viewing and updating records, and deleting records.

## Production deployment

Deploy to a host that supports PHP 8.3+, Composer, and Laravel's `public` directory as the web root. Do not serve the project root. Configure the production environment variables in the hosting provider (never commit `.env`): set a unique `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, and `APP_URL` to the HTTPS site URL, and configure a persistent production database. SQLite is configured by default for local use; use MySQL or another supported persistent database for a multi-instance deployment. Keep the database credentials and application key private.

After configuring the production environment, run the following from the release directory:

```sh
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan optimize
```

Ensure `storage` and `bootstrap/cache` are writable by the PHP process. Keep the SQLite database on persistent storage if SQLite is used for a single-instance deployment. After each release, clear or rebuild Laravel's cached configuration/routes as appropriate (`php artisan optimize:clear` before changing environment configuration, then `php artisan optimize`). Run the tests before deploying; do not run `migrate:fresh` against production data.

## Render demo deployment

The root `render.yaml` configures a free Docker web service in Singapore. Connect the pushed GitHub repository through Render's Blueprint flow and use the detected `render.yaml` to create the service. Render generates `APP_KEY`; the container builds the frontend, runs migrations at startup, and serves the app on Render's assigned port.

This demo uses SQLite on the service's ephemeral filesystem. Free services can sleep when idle, and inventory data can be lost when the service restarts or redeploys. Use a persistent database and paid service plan for data that must be retained.
