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

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# ✅ Installer les dépendances JS et compiler les assets
RUN npm install && npm run build

# Donner les bons droits à Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port HTTP
EXPOSE 80

# Lancer le serveur PHP interne
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
