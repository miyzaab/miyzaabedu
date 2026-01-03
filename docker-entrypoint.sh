#!/bin/bash
set -e

# Create .env file from environment variables
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env file..."
    cat > /var/www/html/.env << EOF
APP_NAME=${APP_NAME:-MiyzaabEdu}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=${LOG_CHANNEL:-stderr}

DB_CONNECTION=${DB_CONNECTION:-sqlite}
DB_DATABASE=${DB_DATABASE:-/var/data/database.sqlite}

SESSION_DRIVER=cookie
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
EOF
fi

# Create SQLite database
mkdir -p /var/data
touch /var/data/database.sqlite
chmod 777 /var/data/database.sqlite

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache and migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link || true

# Start PHP built-in server on Railway's PORT
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
