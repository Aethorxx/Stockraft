# Stockraft

A small Laravel shop application demonstrating Eloquent ORM relationships, resource CRUD, and clean Laravel conventions.

## Data Model

**Category** `hasMany` **Product**. A category has a name and an auto-generated slug. A product belongs to exactly one category and carries a price, stock count, and an active flag.

```
categories
  id, name (unique), slug (unique), timestamps

products
  id, category_id (FK → categories.id, cascade delete),
  name, description (nullable), price (decimal 10,2),
  stock (unsigned int), is_active (boolean), timestamps
```

## Clone and Run

```bash
git clone <repo-url>
cd Stockraft

composer install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite

php artisan migrate --seed

php artisan serve
```

Open **http://localhost:8000** — the root redirects to the products list, which displays 14 seeded products across 5 categories.
