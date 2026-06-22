# Inventory Mini

Inventory management web app built with Laravel.

## Features

- Product management (create, update, delete, search)
- Stock transactions (`IN` / `OUT`) with before/after quantity tracking
- Dashboard, reports, and low-stock notifications
- Role-based access (admin/manager/user middleware)
- Multi-language routing and UI (`en`, `ar`, `tr`)
- DataTables integration with export buttons

## Tech Stack

- PHP 8.2+
- Laravel 12
- Blade + Vite
- Bootstrap 5, jQuery, DataTables
- MySQL or SQLite

## Local Setup

1. Install dependencies

```bash
composer install
npm install
```

2. Environment

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure database in `.env` (example for MySQL)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_mini
DB_USERNAME=root
DB_PASSWORD=
```

4. Migrate and seed

```bash
php artisan migrate --seed
```

5. Run the app

```bash
npm run dev
php artisan serve
```

Open: `http://127.0.0.1:8000`

## Default Seeded Account

- Email: `admin@example.com`
- Password: `password`
- Role: `admin`

## Language Routes

All app routes are locale-prefixed:

- `/en/...`
- `/ar/...`
- `/tr/...`

Root `/` redirects to the session/default locale.

## Useful Commands

```bash
php artisan route:list
php artisan optimize:clear
php artisan view:clear
php artisan test
```

## Notes

- Translations are maintained in PHP files under `lang/{locale}`.
- If tests fail with `could not find driver`, enable/install `pdo_sqlite`.

this project  
