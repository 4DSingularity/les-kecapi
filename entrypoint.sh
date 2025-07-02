#!/bin/bash
set -e

# Generate APP_KEY jika belum ada (sangat penting)
php artisan key:generate --force

# Buat cache dari konfigurasi, rute, dan view
# Ini akan membaca .env yang sudah disuntikkan oleh Render
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi database
echo "Running database migrations..."
php artisan migrate --force

# Mulai server Apache
echo "Starting Apache server..."
apache2-foreground