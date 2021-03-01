FROM php:7.4-fpm

# COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html/laravel

#COPY --from=node:10.22 /usr/local/bin /usr/local/bin
#COPY --from=node:10.22 /usr/local/lib /usr/local/lib

RUN apt-get install -y git-core curl build-essential openssl libssl-dev \
 && git clone https://github.com/nodejs/node.git \
 && cd node \
 && ./configure \
 && make \
 && sudo make install

RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
&& docker-php-ext-install pdo_mysql bcmath

COPY ./supervisord.conf /etc/supervisord.conf
COPY ./supervisor.d /etc/supervisor.d

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data .

ENV ENABLE_CRONTAB 1
ENV ENABLE_HORIZON 1

ENTRYPOINT ["sh", "./docker-entrypoint.sh"]

CMD supervisord -n -c /etc/supervisord.conf