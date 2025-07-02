# Tahap 1: Gunakan image dasar resmi dari PHP 8.2 dengan server Apache
FROM php:8.2-apache

# Instal dependensi sistem yang dibutuhkan untuk ekstensi PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Konfigurasi dan instal ekstensi PHP yang dibutuhkan oleh Laravel
# Termasuk pdo_mysql (untuk lokal) dan pdo_pgsql (untuk Render)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql gd mbstring exif pcntl bcmath xml

# Instal Composer (manajer dependensi PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja di dalam container Docker
WORKDIR /var/www/html

# Salin semua file proyek Anda ke dalam direktori kerja
COPY . .

# Instal dependensi proyek dengan Composer
# --no-scripts mencegah error saat .env belum ada
RUN composer install --no-dev --no-scripts --optimize-autoloader

# Atur kepemilikan file agar Apache bisa menulis ke folder storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Atur konfigurasi Apache untuk menunjuk ke folder public Laravel
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
# Perintah "service apache2 restart" tidak diperlukan di sini, karena server akan dimulai saat container berjalan.