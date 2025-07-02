#!/usr/bin/env bash
set -o errexit

# 1. Instal Dependensi Composer
composer install --no-dev --no-interaction --prefer-dist

# 2. Compile Aset Frontend
npm install
npm run build

# 3. Jalankan Perintah Artisan untuk Produksi
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force