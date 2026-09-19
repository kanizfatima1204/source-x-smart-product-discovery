#!/usr/bin/env bash
set -euo pipefail

mkdir -p \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

if [ -z "${DB_DATABASE:-}" ]; then
  export DB_DATABASE=database/database.sqlite
fi

if [[ "${DB_CONNECTION:-sqlite}" == "sqlite" && "${DB_DATABASE}" != ":memory:" ]]; then
  mkdir -p "$(dirname "${DB_DATABASE}")"
  touch "${DB_DATABASE}"
fi

if [ -z "${APP_KEY:-}" ] || [[ "${APP_KEY}" != base64:* ]]; then
  php artisan key:generate --force --no-interaction
fi

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction
php artisan optimize

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
