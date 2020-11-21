FROM php:7.4-fpm

RUN apt-get update && \
apt-get install -y \
apt-utils \
zip \
git \
zlib1g-dev \
libzip-dev \
libicu-dev \
g++ \
libpq-dev

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install intl extension
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

# Enable opcache
RUN docker-php-ext-enable opcache

# Install pdo
RUN docker-php-ext-install pdo

# Install postgres
RUN docker-php-ext-install pdo_pgsql

# Install composer
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

# Setup workdir
WORKDIR /opt/app
COPY app /opt/app
RUN PATH=$PATH:/opt/app/vendor/bin:bin