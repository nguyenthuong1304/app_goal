FROM php:7.4-fpm

# COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

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

WORKDIR /var/www/html/laravel
