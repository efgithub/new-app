FROM php:8.4-fpm

# 安裝系統相依套件與 PHP 擴充功能
# 新增: gnupg (Node.js 安裝腳本需要它來處理金鑰)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    gnupg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 設定工作目錄
WORKDIR /var/www
