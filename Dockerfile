FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nodejs \
    npm \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev

# Compiler les assets CSS/JS
RUN npm install && npm run build

# Donner les droits
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port automatiquement défini par Render
EXPOSE 10000

# ✅ Corrigé : Render utilisera la variable d’environnement $PORT
CMD ["php", "-S", "0.0.0.0:$PORT", "-t", "public"]
