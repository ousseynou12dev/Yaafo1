# Image PHP officielle avec PHP-FPM
FROM php:8.2-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip

# Installer les extensions PHP utiles pour Laravel
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Installer Composer (gestionnaire de paquets PHP)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir dossier de travail
WORKDIR /var/www/html

# Copier tout le projet dans l'image
COPY . .

# Installer les dépendances PHP via Composer
RUN composer install --optimize-autoloader --no-dev

# Donner les droits aux dossiers nécessaires
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port 9000 (PHP-FPM)
EXPOSE 9000

# Lancer PHP-FPM (serveur PHP)
CMD ["php-fpm"]
