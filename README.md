# Stockraft

Stockraft — CRUD-приложение на Laravel для работы с каталогом товаров.
Демонстрирует связь один-ко-многим между категориями и товарами через Eloquent ORM,
валидацию через FormRequest, ресурсные контроллеры, фабрики и сидеры.

## Стек

- **Laravel 13**, PHP 8.2+
- **SQLite** — база данных в файле, сервер не нужен
- **AdminLTE 3** (Bootstrap 4) — UI через CDN, без сборки

## Модель данных

**Category** `hasMany` **Product**. Slug генерируется автоматически из названия через модельное событие `creating`.

```
categories
  id, name (unique), slug (unique), timestamps

products
  id, category_id (FK → categories.id, cascade delete),
  name, description (nullable), price (decimal 10,2),
  stock (unsigned int), is_active (boolean), timestamps
```

## Установка и запуск

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

Открыть **http://localhost:8000**.

> `npm install` **не требуется** — стили и скрипты подключены через CDN.

## Сброс и очистка базы

Пересоздать таблицы и загрузить тестовые данные заново:

```bash
php artisan migrate:fresh --seed
```

Полная очистка локального окружения:

```bash
php artisan migrate:fresh        # сбросить все таблицы
# или удалить файл БД целиком:
rm database/database.sqlite && touch database/database.sqlite
php artisan migrate --seed
```
