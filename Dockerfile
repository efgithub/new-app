FROM php:8.4-fpm

# 安裝系統相依套件與 PHP 擴充功能 (包含 pdo_mysql)
RUN apt-get update && apt-get install -y     libpng-dev     libonig-dev     libxml2-dev     zip     unzip     git     curl     && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 設定工作目錄
WORKDIR /var/www
