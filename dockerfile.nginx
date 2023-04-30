FROM webdevops/php-nginx-dev:8.2

ENV WEB_DOCUMENT_ROOT /var/www/html/public
ENV WEB_DOCUMENT_INDEX index.php

WORKDIR /var/www/html

COPY  . .

RUN composer install

RUN chmod -R 7777 /var/www/html/storage

EXPOSE 80