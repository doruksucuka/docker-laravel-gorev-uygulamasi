FROM php:8.2-apache

# Laravel için gerekli PHP eklentileri
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev git \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Apache mod_rewrite etkinleştir
RUN a2enmod rewrite

# Laravel’in public klasörünü web root olarak ayarla
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apache konfigürasyonunu güncelle
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# ✨ Node.js ve npm kurulumu (v20)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Çalışma dizini
WORKDIR /var/www/html
