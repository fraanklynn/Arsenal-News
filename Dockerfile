FROM php:8.4-cli

# Install sistem depedensi
RUN apt-get update && apt-get install -y libpng-dev libzip-dev zip unzip git
RUN docker-php-ext-install pdo_mysql bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# INSTAL VENDOR DI SERVER (Ini kunci biar gak missing)
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]