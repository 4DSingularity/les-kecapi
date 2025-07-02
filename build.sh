#!/usr/bin/env bash
# Exit on error
set -o errexit

# 1. Instal dependensi Composer
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# 2. Instal dependensi NPM dan build aset
echo "Installing NPM dependencies and building assets..."
npm install
npm run build

# 3. Generate APP_KEY jika belum ada di environment
# Kita akan pastikan APP_KEY ada sebelum caching
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 4. Cache konfigurasi, rute, dan view
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Jalankan migrasi database
echo "Running database migrations..."
php artisan migrate --force