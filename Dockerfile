# 1. Gunakan base image yang punya PHP DAN Node.js
FROM php:8.4-cli

# Install Node.js (biar npm bisa jalan)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install system dependencies PHP
RUN apt-get update && apt-get install -y \
    libpng-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy file
WORKDIR /var/www/html
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies & Build
RUN npm install && npm run build

# Permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]