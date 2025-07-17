FROM php:8.2-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev zip curl

# Extensions PHP
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier le projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Droits nécessaires
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port PHP-FPM
EXPOSE 9000

# Lancer php-fpm (Render n'écoute pas sur ce port, mais l'expose)
CMD ["php-fpm"]
