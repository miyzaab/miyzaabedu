#!/bin/bash
set -e

# Create SQLite database directory and file
mkdir -p /var/data
touch /var/data/database.sqlite
chmod 777 /var/data/database.sqlite

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link || true

exec "$@"
