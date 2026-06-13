FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache