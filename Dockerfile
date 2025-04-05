# Utiliser une image PHP avec FPM
FROM php:8.1-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# Copier les fichiers de l'application dans le conteneur
WORKDIR /var/www/html
COPY . .

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Installer les dépendances JavaScript (si nécessaire)
RUN apt-get install -y nodejs npm
RUN npm install

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage

# Exposer le port utilisé par PHP-FPM
EXPOSE 9000

# Commande par défaut (optionnel)
CMD ["php-fpm"]