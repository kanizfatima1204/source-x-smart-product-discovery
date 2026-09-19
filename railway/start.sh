#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(pwd)"

# 1. Ensure all directories exist
mkdir -p \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache \
  database

# 2. Grant full read/write permissions for container runtime
chmod -R 777 storage bootstrap/cache database 2>/dev/null || true

# 3. Create .env if it does not exist
if [ ! -f .env ]; then
  if [ -f .env.example ]; then
    cp .env.example .env
  else
    touch .env
  fi
fi

# 4. Database configuration (absolute path for SQLite)
export DB_CONNECTION=sqlite
export DB_DATABASE="${ROOT_DIR}/database/database.sqlite"
touch "${DB_DATABASE}"
chmod 666 "${DB_DATABASE}" 2>/dev/null || true

# 5. Set APP_URL if running on Railway domain
if [ -n "${RAILWAY_PUBLIC_DOMAIN:-}" ]; then
  export APP_URL="https://${RAILWAY_PUBLIC_DOMAIN}"
fi

# 6. Ensure APP_KEY exists
if [ -z "${APP_KEY:-}" ] || [[ "${APP_KEY}" != base64:* ]]; then
  if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    php artisan key:generate --force --no-interaction
  fi
fi

# 7. Run database migrations & seeders
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction

# 8. Clear stale caches and optimize for production
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 9. Ensure permissions again after cache generation
chmod -R 777 storage bootstrap/cache database 2>/dev/null || true

# 10. Start HTTP server
echo "Starting Laravel server on port ${PORT:-8080}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
