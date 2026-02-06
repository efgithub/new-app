cat <<EOF > Dockerfile
FROM php:8.4-fpm

# 安裝資料庫驅動
RUN docker-php-ext-install pdo pdo_mysql
EOF
