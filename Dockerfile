FROM php:8.2-apache
RUN chown -R www-data:www-data /var/www/html
RUN docker-php-ext-install mysqli
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && apt-get install -y libpng-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql && docker-php-ext-install gd && docker-php-ext-enable gd
RUN rm -r /etc/apache2/sites-available/000-default.conf
COPY carpetaApache /etc/apache2/sites-available/
RUN a2ensite sites.conf
RUN a2enmod rewrite
EXPOSE 80