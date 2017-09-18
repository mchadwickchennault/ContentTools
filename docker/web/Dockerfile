FROM php:7.0-apache
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y \
	libmcrypt-dev \
    zlib1g-dev \
	unzip \
	zip


RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    mcrypt

# Enable and configure xdebug
RUN pecl install xdebug-2.5.1
RUN docker-php-ext-enable xdebug

RUN mkdir /var/www/public

# Update the default apache site with the config we created.
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Enable necessary modules in Apache 2
RUN a2enmod rewrite expires mime filter deflate