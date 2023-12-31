FROM php:8.1-fpm

RUN apt-get update && apt-get install -y  \
    libc6-dev \
    libsasl2-dev \
    libsasl2-modules \
    wget  \
    unzip \
    libssl-dev \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN mkdir -p /usr/src/php/ext/redis; \
    curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
    docker-php-ext-install redis;

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install \
    pcntl

RUN apt-get install -y  \
    libpq-dev \
    icu-devtools \
    libicu-dev \
    libzip-dev

RUN apt-get update && apt-get install -y  \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    zlib1g-dev \
    libxml2-dev \
    libpng-dev \
    libonig-dev \
    graphviz

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt-get install -y libmemcached-dev

RUN docker-php-ext-configure intl
# RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install intl iconv exif
RUN docker-php-ext-install sockets
RUN docker-php-source delete

RUN docker-php-ext-install zip \
    && docker-php-ext-install bcmath

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions imagick gmp fileinfo mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

#VOLUME /hostpipe

WORKDIR /var/www

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN chown -R www-data:www-data /var/www

USER www
