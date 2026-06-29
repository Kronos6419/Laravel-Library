# The Reading Room
### IT7744 Web Technologies Assignment 3
**Student:** Yousuf | **Student ID:** 20240259

A library-themed CMS web application built with Laravel 12, featuring a RESTful JSON API consumed by a client-side JavaScript application. Authors can register, publish and manage books, guests can browse the catalogue, and admins have full control through a dedicated panel.

---

## Features

- **Public catalogue** - JS-driven book browsing with genre filtering, search, and pagination, all fetched from the REST API
- **Author dashboard** - create, edit, and delete books via the API with client-side validation and sanitization
- **REST API** - JSON endpoints for books with public read access and session-authenticated writes
- **Secure authentication** - login by username or email, registration, and persistent sessions
- **Role-based access** - user and admin roles with ownership enforcement via Laravel policies
- **Admin panel** - full CRUD over all users and books
- **Profile editing** - update username, email, password, and avatar
- **CSRF protection** - on all forms (Blade and JavaScript fetch requests)
- **Client-side validation and sanitization** - before any API call is made
- **Server-side validation** - on all controllers
- **SCSS theme** - parchment/navy/gold palette with Lora serif headings and Inter body font
- **Test suite** - Vitest unit tests and Playwright acceptance tests

---

## Requirements

- PHP 8.2.12
- Composer 2.9.7
- Node.js v22.15.0
- XAMPP
- Git

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/Kronos6419/library.git
cd library
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Environment setup

Copy the example environment file and configure it:

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and update the database settings:

```env
APP_NAME="The Reading Room"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create the database

Open phpMyAdmin (`http://localhost/phpmyadmin`), click **New**, name it `library`, set collation to `utf8mb4_unicode_ci`, and click **Create**.

### 6. Run migrations and seed the database

```bash
php artisan migrate:fresh --seed
```

This creates all tables and seeds the database with:
- The admin account (`admin` / `admin`)
- Four author accounts
- 28 curated books across all eight genres

### 7. Create the storage symlink

```bash
php artisan storage:link
```

This makes uploaded cover images accessible from the browser.

---

## Running the Application

Run **Xampp** with starting xampp-control.exe and starting:
```bash
- Apache 
- MySQL
```

Then you need two terminals running simultaneously.

**Terminal 1 - Laravel development server:**

```bash
php artisan serve
```

**Terminal 2 - Vite asset compiler:**

```bash
npm run dev
```

Then open `http://localhost:8000` in your browser.

---

## Default Credentials

| Role  | Username | Password |
|-------|----------|----------|
| Admin | admin    | admin    |

The four seeded author accounts all use `password` as their password. Their usernames are `eleanor_voss`, `marcus_reid`, `sofia_lane`, and `james_okoro`.

---

## Running the Tests

### Unit tests (Vitest)

Tests the client-side validation and sanitization functions:

```bash
npm run test:unit
```

Expected output: **29 tests passing** across `validate.test.js` and `sanitize.test.js`.

### Acceptance tests (Playwright)

End-to-end tests for the full book lifecycle. Requires both `php artisan serve` and `npm run dev` running first:

```bash
npx playwright test
```

Expected output: **4 tests passing** covering guest browsing, genre filtering, authenticated create/edit/delete, and client-side validation.

To run with a visible browser:

```bash
npx playwright test --headed
```

## Architecture Decisions

**Session-based API authentication** was chosen over token-based auth (e.g. Sanctum bearer tokens) because the JavaScript client runs on the same domain as Laravel. The existing session cookie is sent automatically with each request, meaning no separate login flow or token storage is needed. Write routes live in `web.php` to inherit the full session middleware stack, while public read endpoints remain in `api.php`.

**SCSS over Bootstrap** was chosen to demonstrate CSS best-practice knowledge. The stylesheet uses the modern `@use` syntax (not the deprecated `@import`), organised into focused partials: `_variables.scss`, `_base.scss`, `_nav.scss`, `_buttons.scss`, `_forms.scss`, `_cards.scss`, `_book.scss`, and `_catalogue.scss`. Tailwind handles layout utilities only.

**Static JS imports** are used in `app.js` rather than dynamic imports, with each module guarding itself using `document.addEventListener('DOMContentLoaded')` and checking for the presence of its root DOM element before running. This avoids timing issues with Vite's module system in production builds.

**Client-side sanitization** in `sanitize.js` uses the DOM itself (`div.innerHTML = input; return div.innerText`) rather than regex, which is more reliable and handles edge cases like nested tags and encoded entities correctly.

**`BookResource`** controls exactly which fields the API exposes, preventing accidental data leakage and giving the JSON a clean, stable shape independent of the database schema.

---

## Tech Stack

| Layer       | Technology                        |
|-------------|-----------------------------------|
| Framework   | Laravel 12.58 / PHP 8.2           |
| Database    | MySQL (XAMPP)                     |
| Front-end   | Vanilla JS (ES modules), SCSS, Tailwind CSS v4 |
| Build tool  | Vite 7 with Laravel plugin        |
| Unit tests  | Vitest 3 + jsdom                  |
| E2E tests   | Playwright                        |
| Version control | Git / GitHub                  |

---

## Database Export

A full database export is included in the project root as `database.sql`. To import it fresh:

1. Create a database named `library` in phpMyAdmin
2. Select it, go to **Import**, choose `database.sql`, and click **Go**
3. Update `.env` with `DB_DATABASE=library`
4. Run `php artisan storage:link`

The exported database includes the admin account, all author accounts, and the full curated book catalogue.
