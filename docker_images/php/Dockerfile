FROM php:8.1-fpm


RUN apt-get update && apt-get install -y \
    libpq-dev git unzip libzip-dev  \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-install zip


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer
