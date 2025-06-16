# ETAPA 1: BUILDER - Para instalar dependencias de Composer
FROM composer:2 as builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader
COPY . .

# ETAPA 2: FINAL - La imagen de producción
FROM php:8.2-apache

# Habilitamos el módulo de Apache para URLs amigables
RUN a2enmod rewrite

# Copiamos la configuración de Apache que apunta a la carpeta /web
COPY config-dev/vhost.conf /etc/apache2/sites-available/000-default.conf

# Instalamos la extensión PDO para MySQL, que es la que usa la app
RUN docker-php-ext-install mysqli  pdo_mysql

# Copiamos los archivos de la app desde la etapa builder
WORKDIR /var/www/html
COPY --from=builder /app .

# Damos permisos al usuario de Apache
RUN chown -R www-data:www-data /var/www/html
