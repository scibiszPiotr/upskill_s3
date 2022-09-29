FROM php:8.1.11RC1-fpm-alpine AS basic

RUN apk update && \
	apk add --no-cache \
    mysql mysql-client nano

#ENV THIRD_PARTY_EXTS cli mysqlnd pdo common fpm gd mbstring xml dom intl simplexml

# Install and enable third party extensions
#RUN pecl -q install ${THIRD_PARTY_EXTS}
#
#RUN docker-php-ext-enable ${THIRD_PARTY_EXTS}

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ARG SSH_PRIVATE_KEY
RUN mkdir -p /root/.ssh && \
    chmod 0700 /root/.ssh
RUN echo "$SSH_PRIVATE_KEY" > /root/.ssh/authorized_keys && \
    chmod 600 /root/.ssh/authorized_keys

WORKDIR /var/www/html

FROM basic

COPY . .
COPY .env.example .env

RUN composer install
RUN php artisan key:generate

RUN chmod 777 -R storage
