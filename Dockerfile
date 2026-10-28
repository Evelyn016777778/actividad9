# Usar la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copiar los archivos del proyecto al directorio web predeterminado de Apache
COPY . /var/www/html/

# Asegurar permisos adecuados para que PHP pueda escribir en el archivo de texto
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto 80 para acceder mediante el navegador
EXPOSE 80