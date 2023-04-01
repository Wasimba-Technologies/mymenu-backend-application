FROM composer as builder
COPY . /app/
WORKDIR /app/
COPY composer.* ./
RUN composer install --no-scripts


FROM php:8.1.3-fpm-alpine


COPY --from=builder /app/vendor /var/www/html/vendor


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
