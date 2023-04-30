FROM php:8.2 




RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip


ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/


RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    zip pdo_mysql mbstring \
    exif pcntl bcmath gd \ 
    monogdb mysqli redis
    


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html

COPY . /var/www/html

RUN chmod -R 7777 /var/www/html/storage

RUN composer install

RUN php artisan key:generate


EXPOSE 8000 

CMD [ "php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000" ] 
