FROM php:8-fpm-alpine

RUN apk add --update nodejs npm yarn
RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN apk add acl 
RUN apk add icu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl
RUN apk --update add redis
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install redis \
  && pecl install mongodb \
  && docker-php-ext-enable mongodb \
  && docker-php-ext-enable redis \
  && apk del pcre-dev ${PHPIZE_DEPS} \
  && rm -rf /tmp/pear

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_pgsql pdo_mysql

RUN wget https://getcomposer.org/installer -O - | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/php.ini
ADD php-fpm.conf /etc/php/php-fpm.d/

WORKDIR /var/www/symfony


EXPOSE 9000

CMD ["php-fpm", "-F"]