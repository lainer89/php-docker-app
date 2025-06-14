# Usamos una imagen oficial y moderna de PHP 8.2 con Apache.
FROM php:8.2-apache

# Instalamos la única extensión que esta aplicación necesita: mysqli.
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copiamos todo el código fuente al directorio web del contenedor.
COPY . /var/www/html/

# Buena práctica: Aseguramos los permisos.
RUN chown -R www-data:www-data /var/www/html