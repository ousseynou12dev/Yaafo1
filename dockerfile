# Image officielle PHP avec FPM
FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libpq-dev libcurl4-openssl-dev \
    libjpeg-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Installe Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Installe Node.js et npm (nécessaire pour build frontend)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Crée le dossier de l'application
WORKDIR /var/www

# Copie tous les fichiers du projet
COPY . .

# Installe les dépendances PHP et JS
RUN composer install --no-dev --optimize-autoloader && \
    npm install && \
    npm run build

# Donne les bons droits à Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Lance le serveur Laravel intégré sur le port 8000
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
