# Gunakan image dasar resmi dari PHP 8.2 dengan server Apache
FROM php:8.2-apache

# Instal dependensi sistem, termasuk Node.js dan npm
RUN apt-get update && apt-get install -y \
    git unzip zip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libpq-dev \
    nodejs npm \
    && rm -rf /var/lib/apt/lists/*

# Konfigurasi dan instal ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql gd mbstring exif pcntl bcmath xml

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin file-file penting terlebih dahulu untuk caching
COPY package.json package-lock.json composer.json composer.lock ./

# Instal dependensi backend & frontend
RUN composer install --no-dev --optimize-autoloader
RUN npm install

# Salin sisa file aplikasi
COPY . .

# Build aset frontend untuk produksi
RUN npm run build

# Atur kepemilikan file
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Salin dan atur skrip entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Atur konfigurasi Apache
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Atur entrypoint container
ENTRYPOINT ["entrypoint.sh"]