FROM tangramor/nginx-php8-fpm

COPY . .
COPY .env.example .env

RUN composer install
RUN php artisan key:generate

RUN chmod 777 -R storage
RUN chown www-data:www-data -R /var/www/html
RUN chown www-data:www-data -R /var/www/html/
RUN chmod 777 -R /var/www/html
RUN chmod 777 -R /var/www/html/
