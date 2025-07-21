FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl

RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data storage bootstrap/cache

# Supprimer ces lignes du build :
# RUN php artisan config:cache
# RUN php artisan route:cache
# RUN php artisan view:cache

EXPOSE 80

# Lancer le serveur PHP interne
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
