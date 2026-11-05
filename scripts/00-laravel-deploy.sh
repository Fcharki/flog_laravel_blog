#!/usr/bin/env bash

set -e

cd /var/www/html

echo "Installing dependencies..."
composer install --no-dev --prefer-dist \
    --no-interaction --optimize-autoloader

echo "Creating storage link..."
php artisan storage:link

echo "Running migrations..."
php artisan migrate --force

echo "Optimizing Laravel..."
php artisan optimize

echo "Deployment initialization complete!"