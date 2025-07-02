#!/bin/bash

# Jalankan migrasi database
# --force diperlukan untuk lingkungan produksi
echo "Running database migrations..."
php artisan migrate --force

# Jalankan server Apache di foreground
# Perintah ini akan menjaga container tetap berjalan
echo "Starting Apache server..."
apache2-foreground