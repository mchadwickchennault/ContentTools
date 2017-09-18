FROM php:7.0-apache

RUN apt-get update && apt-get install -y \
    libldap2-dev

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
  && docker-php-ext-install \
	pdo_mysql \
	mysqli
