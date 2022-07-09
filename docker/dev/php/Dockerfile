FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    git

RUN docker-php-ext-install pdo pdo_pgsql

RUN docker-php-ext-install zip

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet

RUN pecl channel-update pecl.php.net

# Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

ADD ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ARG UID=1000
ARG GID=1000

RUN groupadd --gid 1000 laravel \
  && useradd --uid 1000 --gid laravel --shell /bin/bash --create-home laravel

WORKDIR /app/profit

USER ${UID}:${GID}

CMD ["php-fpm"]