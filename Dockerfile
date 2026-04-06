# Utilisation de l'image PHP officielle avec Apache
FROM php:8.2-apache

# Installation des dépendances système et des extensions PHP pour MySQL
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Activation du module rewrite d'Apache (utile pour PHP)
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copie des fichiers du projet
COPY . .

# Installation des dépendances PHP via Composer
RUN composer install --no-interaction --optimize-autoloader

# On donne les droits à Apache sur le dossier
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80