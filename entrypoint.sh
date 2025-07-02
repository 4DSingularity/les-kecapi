#!/bin/bash
set -e

# Cek apakah file .env sudah ada. Jika tidak, buat dari environment Render.
if [ ! -f /var/www/html/.env ]; then
  echo "Creating .env file from Render's environment variables..."
  # Ambil semua variabel yang diawali dengan 'APP_' atau 'DB_'
  printenv | grep -E '^APP_|^DB_|^LOG_|^SESSION_|^CACHE_' > /var/www/html/.env
fi

# Sekarang .env sudah ada, kita bisa jalankan perintah artisan

# Generate APP_KEY jika belum ada di .env
# grep -q akan memeriksa apakah string 'APP_KEY=' sudah ada di file .env
if ! grep -q "APP_KEY=" /var/www/html/.env || grep -q "APP_KEY=$" /var/www/html/.env; then
  echo "APP_KEY not found or is empty, generating..."
  php artisan key:generate --force
fi

# Buat cache dari konfigurasi, rute, dan view
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