FROM php:latest

LABEL version="1.0.0"

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www

COPY composer.json composer.lock ./

COPY . .

RUN composer install

RUN php artisan key:generate --ansi

RUN php artisan storage:link

COPY ./script/php_script.sh /tmp

RUN chmod +x /tmp/php_script.sh

ENTRYPOINT ["sh","/tmp/php_script.sh"]

EXPOSE 8000
