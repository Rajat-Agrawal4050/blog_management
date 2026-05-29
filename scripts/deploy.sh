#!/usr/bin/env bash

echo "==> Generating app key..."
php artisan key:generate --force

echo "==> Clearing caches..."
php artisan config:clear
php artisan cache:clear

echo "==> Caching config & routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Starting PHP-FPM..."
php-fpm -D

echo "==> Starting Nginx..."
nginx -g "daemon off;"