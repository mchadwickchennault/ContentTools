FROM php:7.0-cli
COPY php.ini /usr/local/etc/php/
RUN apt-get update \
  && apt-get install -y \
	libfreetype6-dev \
	libjpeg62-turbo-dev \
	libpng12-dev \
	libmcrypt-dev \
	libxslt-dev \
	libxml2-dev \
	libldap2-dev \
	libpcre3 \
	libpcre3-dev \
	unzip \
	zip \
  && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/\
  && docker-php-ext-install \
	pdo_mysql \
	mysqli \
	mbstring \
	gd \
	zip \
	iconv \
	mcrypt \
	exif \
	ldap \
	soap \
	xsl \
	wddx

# add tools needed for scripts and scripting
RUN apt-get update \
    && apt-get install -y \
	nano \
	vim \
	libwww-perl
# mysql client needed for phpunit tests
RUN apt-get update && apt-get install -y mysql-client

# Install internationalization
RUN apt-get update && apt-get install -y\
    g++ \
    libicu-dev &&\
    docker-php-ext-install intl

# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_7.x | bash -
RUN apt-get install -y nodejs

