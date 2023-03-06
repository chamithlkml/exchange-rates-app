FROM php:8.1-fpm

COPY composer.lock composer.json /var/www/html/

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libonig-dev \
    unzip \
    curl
    
RUN apt-get install -y git-core \
    openssl \
    libssl-dev

RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash - && \
apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

RUN npm install

RUN npm run build

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer update

RUN composer install

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
