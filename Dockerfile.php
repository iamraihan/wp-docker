# Dockerfile.php

ARG PLUGIN_NAME=wp-project-manager
FROM php:7.4-fpm-alpine

# Install required PHP and OS packages
RUN apk add --no-cache \
    git curl unzip zip libzip-dev oniguruma-dev bash \
    && docker-php-ext-install mbstring zip

# Copy composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/wp-content/plugins/${PLUGIN_NAME}

CMD ["composer", "install"]
