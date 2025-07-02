#!/usr/bin/env bash
set -o errexit

composer install --no-dev --no-interaction --prefer-dist
npm install
npm run build

# php artisan config:cache <-- HAPUS ATAU BERI TANDA PAGAR
php artisan route:cache
php artisan view:cache
php artisan migrate --force