FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev

# Installer Node modules et builder assets avec npm
RUN npm install
RUN npm run build

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port HTTP (80) au lieu de 9000
EXPOSE 80

# Lancer le serveur PHP interne en exposant le dossier public/
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
