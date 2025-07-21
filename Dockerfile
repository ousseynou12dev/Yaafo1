FROM php:8.2-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libapache2-mod-php

# Activer les extensions PHP requises par Laravel
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Activer le module Apache rewrite (important pour Laravel)
RUN a2enmod rewrite

# Copier le fichier de configuration Apache personnalisé
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Copier Composer depuis l’image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Positionner le répertoire de travail
WORKDIR /var/www/html

# Copier le code source
COPY . .

# Installer les dépendances PHP (sans dev)
RUN composer install --optimize-autoloader --no-dev

# Donner les bons droits à Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Compiler les assets front (vite)
RUN npm install && npm run build

# Exposer le port
EXPOSE 80
