FROM php:8.2-apache

# Mise à jour et installation des dépendances système nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    apt-utils \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libapache2-mod-php \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP requises par Laravel
RUN docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Activation du module Apache rewrite (nécessaire pour Laravel)
RUN a2enmod rewrite

# Copie du fichier de configuration Apache personnalisé
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Copie de Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie du code source de Laravel dans le conteneur
COPY . .

# Installation des dépendances PHP avec optimisation pour la production
RUN composer install --optimize-autoloader --no-dev

# Attribution des droits nécessaires sur les dossiers Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Installation des dépendances JS et compilation des assets avec Vite
RUN npm install && npm run build

# Exposition du port 80 pour Apache
EXPOSE 80
