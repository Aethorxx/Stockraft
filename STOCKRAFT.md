# Claude Code Prompt — Stockraft (Laravel Shop Project)

> Copy everything below the line and paste it into Claude Code.

---

## Context — read this first

I am applying for a backend developer position. The employer sent me a **test assignment** and will review the result personally by cloning my GitHub repo and running it locally. The point of the assignment is to prove I can work with Laravel's Eloquent ORM correctly and write clean, conventional code — it is NOT about building a feature-rich product.

**What the reviewer will actually check:**
- Whether I follow Laravel conventions (naming, folder structure, resource controllers) or fight the framework.
- Whether my Eloquent relationships are defined correctly on both sides and used properly (no raw SQL, no N+1 queries).
- Whether validation, migrations, seeders, and factories are done the idiomatic Laravel way.
- Whether the code is clean and readable — a reviewer spends 5–10 minutes skimming; messy code, weird comments, or fake data are instant red flags.
- Whether the project runs immediately after cloning, with zero friction.

The reviewer explicitly asked for: **clean, concise code; only Laravel and PHP; no Docker, no CSS preprocessors, no JS frameworks; runnable in a browser.** Every constraint below exists to satisfy a real reviewer expectation, so treat them as hard requirements, not suggestions.

Because a human will read every file, the priority order is: **correctness > convention > readability > cleanliness of data and comments > features.** When in doubt, do the boring, standard, "Laravel docs" way rather than anything clever.

---

Build a small but clean Laravel application called **Stockraft** that demonstrates Eloquent ORM skills.

## Stack constraints (hard requirements)

- **Latest stable Laravel, plain PHP only.** The reviewer wants to see framework fundamentals, not a custom stack.
- **Database: SQLite** (a file at `database/database.sqlite`). This is deliberate — SQLite needs no DB server, so the reviewer can clone and run with zero setup. No MySQL, no Docker, no external DB.
- **NO JavaScript frameworks** (no Vue/React/Inertia/Livewire) and **NO CSS preprocessors** (no Sass/Less). No Vite build step should be required to view the app — the reviewer should not have to run `npm install`.
- **Styling: Bootstrap 5 via CDN `<link>` only** (pure CSS, no build). This keeps the UI presentable without violating the "no preprocessors / no JS framework" rule. Keep markup minimal and clean.
- The entire app must run with only: `composer install`, `migrate`, `seed`, and `php artisan serve`. Nothing else.

## Domain: simple e-commerce

A shop has **categories**, and each category contains many **products**. This is the classic one-to-many relationship and the cleanest way to demonstrate Eloquent relationships, which is the core thing being tested. Product is the main entity the reviewer will create/edit/delete; Category exists to show the relationship and to populate a dropdown.

### Category

| Field | Type | Notes |
|-------|------|-------|
| id | bigIncrements | primary key |
| name | string | required, unique |
| slug | string | unique, auto-generated from name |
| timestamps | — | — |

Relationship: `Category` **hasMany** `Product`

### Product *(primary model for CRUD)*

| Field | Type | Notes |
|-------|------|-------|
| id | bigIncrements | primary key |
| category_id | foreignId | → categories.id, required, constrained, cascadeOnDelete |
| name | string | required |
| description | text | nullable |
| price | decimal(10,2) | required, >= 0 |
| stock | unsignedInteger | default 0 |
| is_active | boolean | default true |
| timestamps | — | — |

Relationship: `Product` **belongsTo** `Category`

## What to build

1. **Two migrations** — categories first, then products. The products migration must define the foreign key with `->constrained()->cascadeOnDelete()` so deleting a category cleans up its products. Order matters: the products table references categories, so categories must be created first.

2. **Eloquent models** with `$fillable`, proper `casts()` (`price` as `decimal:2`, `is_active` as `boolean`), and the relationship methods on both sides (`Category::products()` and `Product::category()`). Auto-generate the category `slug` from its `name` (e.g. via a `creating` model event or a mutator) — this shows you understand model events, not just plain properties.

3. **Factories** — `CategoryFactory` and `ProductFactory`. The product factory should produce realistic data (see "Seed data" rules below) and assign a category.

4. **Seeders:**
   - `CategorySeeder` — creates the 5 categories.
   - `ProductSeeder` — creates 12+ products, each linked to an existing category via its real `category_id` (not a random integer — fetch real category IDs so the foreign keys are valid).
   - `DatabaseSeeder` calls them in the correct order (categories before products).

5. **Full resource CRUD for Product:**
   - `index` — paginated list (Bootstrap table) showing name, category name (**eager-loaded** with `->with('category')` to avoid the N+1 problem — the reviewer will specifically look for this), price, stock, active status, plus Edit/Delete buttons and a "Create Product" button.
   - `create` & `edit` — must share one `_form.blade.php` partial to avoid duplication (DRY). The category field is a `<select>` dropdown populated from all categories.
   - `store` & `update` — validate via dedicated FormRequest classes (`StoreProductRequest`, `UpdateProductRequest`). Rules: name required/string/max, category_id required/exists:categories,id, price required/numeric/min:0, stock integer/min:0, etc.
   - `destroy` — delete with a confirmation prompt in the UI.
   - Use session flash messages for success feedback after create/update/delete.

6. **Categories index page** — list of categories with a product-count column using `withCount('products')`. This demonstrates a second, more advanced relationship feature beyond the basic CRUD.

7. **Routes (`routes/web.php`):**
   - `Route::resource('products', ProductController::class)`.
   - A single `categories` index route.
   - Redirect `"/"` to the products index so the app opens on something meaningful.

8. **Blade:**
   - `layouts/app.blade.php` — master layout pulling Bootstrap 5 from CDN, a simple navbar linking Products / Categories, a `@yield('content')` section, and a block that renders the success flash message if present.
   - All views extend this layout.

## Quality bar

- **Eager-load relationships** to prevent N+1 queries. This is the single most-checked thing in an Eloquent test — never lazy-load category inside a loop.
- **Validation must work** and re-render the form with error messages and preserved `old()` input.
- **Use route model binding** in the controller (`Product $product`), not manual `findOrFail`.
- **Keep controllers thin** — no business logic in Blade, no query building in views.
- Follow Laravel naming conventions exactly: singular StudlyCase models, plural snake_case tables, resourceful controller method names.

## Seed data — realism rules

The seeder must contain **believable, real-world data** as if this were an actual store. A reviewer reading "Test Product 1" immediately assumes low effort.

**Categories (exactly 5):** real retail categories, e.g. Electronics, Books, Clothing, Home & Garden, Sports.

**Products (12+):** each product must have:
- A real product name that fits its category, e.g. "Wireless Noise-Cancelling Headphones", "Yoga Mat 6mm", "Stainless Steel Water Bottle", "The Pragmatic Programmer".
- A realistic price for that item — headphones ≈ 79.99, a paperback ≈ 14.99, a yoga mat ≈ 24.99. Vary them; do not price everything at 9.99 or 999.99.
- A short but meaningful description (1–2 real sentences describing the item — never lorem ipsum, never "This is a great product").
- A plausible stock value (0–200), varied across products.

**Strictly forbidden in seed data:**
- Placeholder names like "Product 1", "Test Item", "Sample Product XYZ", "Foo", "Bar".
- Prices that are all identical or suspiciously round (10.00, 20.00, 30.00...).
- Lorem ipsum or "description here" as a description.
- Emojis or exclamation marks anywhere in seed values.

## Code comments — strict rules

Comments are allowed but must follow these rules without exception:

- **Short** — one line maximum. No paragraph comments, no multi-line `/* */` blocks restating what the next line obviously does.
- **Technical and "why", not "what"** — never write `// Get all products` above `Product::all()`; that is noise. A good comment explains a non-obvious decision (e.g. why eager loading, why a specific cast).
- **Only at genuine decision points** — most methods need zero comments.
- **No motivational or decorative comments** — nothing like `// Here we go!`, `// Magic happens here`, `// This is important!`.
- **No section-divider comments** — no `// ===== CRUD Methods =====` separators.

A file with zero comments is better than a file with bad comments.

## Setup & verification *(do these yourself before reporting back)*

- Create the project, set `.env` to SQLite (`DB_CONNECTION=sqlite`), create the empty `database/database.sqlite` file, generate `APP_KEY`.
- Run `php artisan migrate --seed` and confirm it completes with no errors.
- Boot `php artisan serve`, then verify with `curl` that the products index returns HTTP 200 and the HTML actually contains your seeded product names.
- Manually trace the create/edit/delete flow logic and fix anything broken until the full cycle works end to end.

## Git — local only

- Set up a sensible `.gitignore` (Laravel's default is fine; ensure `/vendor`, `.env`, and `database/database.sqlite` are ignored, but **commit** a `database/.gitignore` so the empty folder is kept in the repo).
- Initialize a git repository and make **local commits only**.
- **Do NOT push. Do NOT add any remote. Do NOT print git remote/push commands.** I will create the GitHub repository and push it myself, manually, later. Your job ends at local commits.
- Commit message style: **English, short, two words, lowercase**, e.g. `initial scaffold`, `add models`, `add crud`, `add seeders`. Use a few small logical commits rather than one giant commit, so the history reads cleanly.

## Expected output & deliverables

When you are done, the following must be true — verify each point yourself before reporting back.

### Working application
- `http://localhost:8000` redirects to the products list with 12+ seeded products visible in a table.
- Each product row shows: name, category (from the related model), price, stock, active status, Edit and Delete buttons.
- Creating a product via the form works — category dropdown populated, validation errors show inline, success flash appears after save.
- Editing a product works — form pre-filled with current values.
- Deleting a product works — confirmation required, success flash appears.
- `http://localhost:8000/categories` shows all 5 categories with their product counts.

### File deliverables (all must exist and be non-empty)
- `app/Models/Category.php` — `hasMany`, `$fillable`, slug generation.
- `app/Models/Product.php` — `belongsTo`, `$fillable`, price + is_active casts.
- `database/migrations/` — exactly 2 new migration files (categories, then products).
- `database/seeders/` — `CategorySeeder.php`, `ProductSeeder.php`, updated `DatabaseSeeder.php`.
- `database/factories/` — `CategoryFactory.php`, `ProductFactory.php`.
- `app/Http/Controllers/ProductController.php` — thin resource controller, route model binding.
- `app/Http/Controllers/CategoryController.php` — index only.
- `app/Http/Requests/` — `StoreProductRequest.php`, `UpdateProductRequest.php`.
- `resources/views/layouts/app.blade.php` — master layout, Bootstrap CDN, navbar, flash block.
- `resources/views/products/` — `index.blade.php`, `create.blade.php`, `edit.blade.php`, `_form.blade.php`.
- `resources/views/categories/index.blade.php`.
- `routes/web.php` — resource route, categories route, root redirect.
- `README.md` — project description, data-model/relationship explanation, exact clone-and-run steps.
- `.gitignore` (+ `database/.gitignore`).

### Final output from you
After verifying everything works, print:
1. The full file tree of everything you created or modified.
2. The exact commands to clone and run the project locally (the same ones that go in the README).
3. A short confirmation that all local commits are made and that no remote was added and nothing was pushed.

---

When finished, give me a short summary of the file structure you created and the commands to run it.
