FROM php:8.2

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    libcurl4-openssl-dev \
    libssl-dev \
    libpq-dev

# Installer extensions PHP
RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Créer dossier de l'app
WORKDIR /var/www

# Copier tous les fichiers
COPY . .

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev

# Générer une clé Laravel (facultatif si déjà fait)
RUN php artisan key:generate

# Donner les bons droits
RUN chmod -R 775 storage bootstrap/cache

# Exposer le port 8000
EXPOSE 8000

# Lancer le serveur Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
