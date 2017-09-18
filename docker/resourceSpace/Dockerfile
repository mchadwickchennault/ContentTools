FROM ubuntu:16.04

# Set correct environment variables
ENV DEBIAN_FRONTEND noninteractive
ENV HOME            /root
ENV LC_ALL          C.UTF-8
ENV LANG            en_US.UTF-8
ENV LANGUAGE        en_US.UTF-8
ENV TERM            xterm

 RUN apt-get update && apt-get install -y \
	apache2 \
	mysql-client \
	php7.0 \
	php7.0-dev \
	php7.0-gd \
	php7.0-mysql \
	php-mbstring \
	php-zip \
	libapache2-mod-php \
	subversion \
	nano \
	imagemagick \
	ghostscript \
	antiword \
	xpdf \
	libav-tools \
	postfix \
	libimage-exiftool-perl \
	cron \
	wget \
    ffmpeg

ADD php.ini /etc/php/7.0/apache2/php.ini

RUN a2enmod rewrite

CMD service apache2 start && tail -F /var/log/apache2/error.log

