FROM composer as composer-stage
COPY . /app/
WORKDIR /app/
COPY composer.* ./
RUN composer install --no-scripts

#
# Frontend
#
FROM node:18.15.0-alpine as node-stage

COPY . /app/

WORKDIR /app/

RUN npm install && npm run build


FROM php:8.1.3-fpm-alpine


COPY --from=composer-stage /app/vendor /var/www/html/vendor
COPY --from=node-stage /app/public/build /var/www/html/public/build

# install necessary alpine packages
RUN apk update && apk add --no-cache \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mysqli gd



# Set working directory
WORKDIR /var/www/html/

# Remove Cache
RUN rm -rf /var/cache/apk/*


RUN apk --no-cache add shadow

RUN usermod -u 1000 www-data



# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["php-fpm"]
