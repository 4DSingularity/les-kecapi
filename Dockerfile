# Gunakan image dasar resmi dari PHP 8.2 dengan server Apache
FROM php:8.2-apache

# Instal dependensi sistem dan ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd mbstring exif pcntl bcmath xml

# Instal Composer (manajer dependensi PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja di dalam container Docker
WORKDIR /var/www/html

# Salin semua file proyek Anda ke dalam direktori kerja
COPY . .

# Instal dependensi proyek dengan Composer
RUN composer install --no-dev --optimize-autoloader

# Atur kepemilikan file agar Apache bisa menulis ke folder storage dan bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Ubah konfigurasi Apache akgar menunjuk ke folder public Laravel
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN service apache2 restart
