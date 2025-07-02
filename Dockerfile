# Gunakan image dasar resmi dari PHP 8.2 dengan server Apache
FROM php:8.2-apache

# Instal dependensi sistem dan ekstensi PHP yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git unzip zip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd mbstring exif pcntl bcmath xml \
    && rm -rf /var/lib/apt/lists/*

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin file composer terlebih dahulu untuk caching dependensi
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-autoloader --no-scripts

# Salin sisa file aplikasi
COPY . .

# Generate autoloader
RUN composer dump-autoload --optimize

# Atur kepemilikan file
RUN chown -R www-data:www-data storage bootstrap/cache

# Salin dan atur skrip entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Atur konfigurasi Apache untuk menunjuk ke folder public
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Atur entrypoint container
ENTRYPOINT ["entrypoint.sh"]