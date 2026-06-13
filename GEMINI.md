# Arsenal News — Project Guide

## Overview
Arsenal News is a web application built with **Laravel 13** and **PHP 8.3+**, designed to manage and display news content related to Arsenal FC. The project follows standard Laravel conventions and utilizes a modern frontend stack including **Tailwind CSS 4** and **Vite**.

## Technology Stack
- **Framework:** Laravel 13.x
- **Language:** PHP 8.3+
- **Frontend:**
  - Tailwind CSS 4 (`@tailwindcss/vite` plugin)
  - Vite + `laravel-vite-plugin`
  - Bootstrap 5.3.3 (via CDN in some views)
- **Database:**
  - Development: MySQL (configured via `.env`)
  - Testing: SQLite `:memory:` (configured in `phpunit.xml`)
- **Tools:**
  - Laravel Pail (log streaming)
  - Laravel Pint (PHP linting)
  - Concurrently (running dev processes)

## Architecture & Data Model

### Models
Models utilize the PHP 8 `#[Fillable]` attribute for mass assignment.
- **`Post`**: The primary content unit. Includes `title`, `slug`, `excerpt`, `body`, `image_path`, `is_featured`, and `category_id`.
- **`Category`**: Groups posts. Includes `name` and `slug`.
- **`User`**: Standard Laravel authentication model.
- **`BreakingNews`**: Simple table for active alerts (`title`, `link`, `is_active`).

### Relationships
- `Post` **belongsTo** `Category`
- `Category` **hasMany** `Post`

### Routing & Controllers
- `GET /` → `NewsController@index`: Displays featured, latest, and trending posts.
- `admin/` prefix (named `admin.`):
  - `GET /posts/create` → `PostController@create`: Form to create new posts.
  - `POST /posts` → `PostController@store`: Validates and saves posts.

## Development Workflow

### Key Commands
| Command | Description |
|---------|-------------|
| `composer setup` | Full initial setup: installs dependencies, copies `.env`, generates key, runs migrations, and builds assets. |
| `composer dev` | Starts the development environment (Server, Queue, Pail logs, and Vite) concurrently. |
| `composer test` | Clears config and runs the PHPUnit test suite. |
| `./vendor/bin/pint` | Automatically formats PHP code according to Laravel standards. |

### Database Management
- Migrations are located in `database/migrations/`.
- Seeders (`CategorySeeder`, `PostSeeder`) provide initial data for development.
- Queue, session, and cache drivers default to `database`.

## Testing Conventions
- **Database:** Tests use SQLite in-memory for speed and isolation.
- **Traits:** Feature tests that interact with the database must use the `Illuminate\Foundation\Testing\RefreshDatabase` trait.
- **Suites:**
  - `tests/Unit`: Low-level logic tests (extends `PHPUnit\Framework\TestCase`).
  - `tests/Feature`: HTTP and integration tests (extends `Tests\TestCase`).

## Frontend Conventions
- **Styling:** Main application styles are in `resources/css/app.css` using Tailwind 4.
- **Vite Entrypoints:** `resources/css/app.css` and `resources/js/app.js`.
- **Theme Colors:** Custom Arsenal-themed colors are defined in CSS:
  - `arsenal-red`: `#EF0107`
  - `arsenal-gold`: `#9C824A`
  - `arsenal-navy`: `#023474`
- **Legacy/CDN:** Some views (like `home.blade.php`) may use Bootstrap 5.3.3 from a CDN for layout components.
