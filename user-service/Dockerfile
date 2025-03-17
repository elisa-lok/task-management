FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    libzip-dev \
    libpng-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip gd pdo_mysql

RUN pecl install grpc && docker-php-ext-enable grpc

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader

COPY . .

COPY .env.docker .env

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 50051

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]