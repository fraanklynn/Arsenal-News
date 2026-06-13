# Arsenal News — Agent Guide

## Stack
- **Laravel 13** on **PHP 8.3+**, Tailwind CSS 4 (`@tailwindcss/vite` plugin), Vite + `laravel-vite-plugin`.
- Dev env: Laragon, `.env` uses MySQL; tests use SQLite `:memory:` (set in `phpunit.xml`).

## Commands
| Command | What it does |
|---------|-------------|
| `composer setup` | First-time setup: install, copy `.env`, generate key, migrate, `npm install --ignore-scripts`, `npm run build`. |
| `composer dev` | Runs four processes concurrently (server, queue:listen, pail logs, Vite). |
| `composer test` | Runs `php artisan config:clear` then `php artisan test`. |
| `./vendor/bin/pint` | Format PHP code (Laravel Pint, no custom config). |

## Testing
- SQLite `:memory:` in `phpunit.xml`. No external DB needed.
- Suites: `tests/Unit` (extends `PHPUnit\Framework\TestCase`), `tests/Feature` (extends `Tests\TestCase`).
- Single test: `php artisan test --filter=test_name` or `php artisan test tests/Feature/ExampleTest.php`.
- Feature tests hitting routes that query the DB **must** use `RefreshDatabase` trait.
- Only existing tests are boilerplate examples.

## Routes & controllers
- `GET /` → `NewsController@index` — returns view with dummy data (no DB queries).
- `GET admin/posts/create` → `PostController@create` — form to create posts.
- `POST admin/posts` → `PostController@store` — validates and creates `Post`.
- `HomeController.php` exists but is **not registered** in routes.

## Models (all use PHP 8 `#[Fillable]` attribute)
- **`Category`** — `id`, `name`, `slug`; `hasMany` articles/posts.
- **`Article`** — `id`, `title`, `slug`, `content`, `image`, `is_carousel` (boolean cast), `category_id`; `belongsTo` category.
- **`Post`** — `id`, `title`, `slug`, `excerpt`, `body`, `image_path`, `is_featured`, `category_id`; `belongsTo` category.

## Database
- 7 migration files in `database/migrations/`. Tables: `users`, `cache`, `jobs`, `categories`, `articles`, `posts`, `breaking_news`.
- Seeders: `CategorySeeder` (3 categories) + `ArticleSeeder` (10 articles with 3 carousel) called from `DatabaseSeeder`.
- Queue, session, cache default to `database` driver (migrations exist).

## Frontend
- `resources/css/app.css` defines `@theme` colors: `arsenal-red` (#EF0107), `arsenal-red-dark`, `arsenal-gold` (#9C824A), `arsenal-navy` (#023474).
- `home.blade.php` uses Bootstrap 5.3.3 from CDN + custom `public/css/home.css`. Tailwind classes are available but the main view relies on Bootstrap.
- Vite entrypoints: `resources/css/app.css`, `resources/js/app.js`. Font: Instrument Sans via Bunny CDN.

## Conventions
- Queue, session, cache default to `database` driver (migrations exist for all three).
- `composer.json` scripts (`setup`, `dev`, `test`) are the canonical dev workflow — prefer over ad-hoc commands.
