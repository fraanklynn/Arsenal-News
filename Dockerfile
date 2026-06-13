FROM php:8.4-cli

# Install dependencies yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy semua file ke folder kerja
WORKDIR /var/www/html
COPY . .

# INSTAL DEPENDENCIES DI DALAM SERVER (Ini langkah krusial)
RUN composer install --no-dev --optimize-autoloader

# Beri izin folder storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan server
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]