#!/usr/bin/env bash
set -euo pipefail

mkdir -p \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

touch database/database.sqlite

if [ -z "${APP_KEY:-}" ]; then
  php artisan key:generate --force --no-interaction
fi

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction
php artisan optimize

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
