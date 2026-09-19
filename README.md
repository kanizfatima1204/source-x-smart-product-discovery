# Source X — Smart Product Discovery

Standalone Laravel 12 + Vue 3 + Inertia.js prototype for discovering products beyond a simple keyword search.

## Features

- Keyword search (including Bangla `মধু`)
- Category, location, price and availability filters
- Relevance, rating, price and newest sorting
- Related products and recommended discovery section
- Save/unsave products with browser localStorage
- Product details page
- Empty state and loading/search state
- Responsive mobile filter experience
- SQLite database with realistic seed data
- Feature tests for page loading and search

## Requirements

- PHP 8.2+
- Composer 2+
- Node.js 20+
- npm 10+

## Install

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000`.

For development with Vite hot reload:

```bash
npm run dev
php artisan serve
```

## Test

```bash
php artisan test
```

## Useful searches

- `মধু`
- `organic`
- `rice`
- `Manikganj`

## GitHub

```bash
git init
git add .
git commit -m "Build Source X smart product discovery prototype"
git branch -M main
git remote add origin YOUR_GITHUB_REPOSITORY_URL
git push -u origin main
```
