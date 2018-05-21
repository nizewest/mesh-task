FROM phpearth/php:7.2-nginx

RUN apk update --no-cache
RUN apk add --no-cache g++ make bash shadow zlib-dev libpng-dev
RUN rm -fr /var/cache/apk/*
RUN apk add --no-cache phpunit composer yarn
RUN apk add --no-cache php7.2-pdo php7.2-pdo_mysql php7.2-gd

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN chown 1000:1000 -R /var/www