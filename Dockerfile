# ==========================================
# Stage 1: Install PHP dependencies
# ==========================================
FROM composer:2 AS composer-build

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .

RUN composer dump-autoload --optimize --no-dev

# ==========================================
# Stage 2: Build frontend assets
# ==========================================
FROM node:22-alpine AS frontend-build

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

COPY --from=composer-build /app/vendor ./vendor

RUN npm run build

# ==========================================
# Stage 3: Production image
# ==========================================
FROM php:8.3-fpm-bookworm

WORKDIR /var/www/html

# Install Nginx and PHP dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    gettext-base \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        intl \
        zip \
        gd \
        opcache \
    && rm -f /etc/nginx/sites-enabled/default \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ==========================================
# PHP OPcache configuration
# ==========================================
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=64" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# ==========================================
# PHP-FPM configuration - Render Free Tier
# ==========================================
RUN { \
    echo '[www]'; \
    echo 'pm = dynamic'; \
    echo 'pm.max_children = 3'; \
    echo 'pm.start_servers = 1'; \
    echo 'pm.min_spare_servers = 1'; \
    echo 'pm.max_spare_servers = 2'; \
    echo 'pm.max_requests = 300'; \
    echo 'request_terminate_timeout = 120s'; \
} > /usr/local/etc/php-fpm.d/zz-custom.conf

# ==========================================
# Copy Laravel application
# ==========================================
COPY --from=composer-build /app /var/www/html

# Copy compiled frontend assets
COPY --from=frontend-build /app/public/build /var/www/html/public/build

# Copy Nginx configuration template
COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template

# ==========================================
# Laravel directories and permissions
# ==========================================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && php artisan storage:link \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render uses PORT, default to 10000
EXPOSE 10000

# ==========================================
# Startup
# ==========================================
CMD ["sh", "-c", "\
    set -e; \
    PORT=${PORT:-10000}; \
    echo 'Starting Laravel on port:' $PORT; \
    envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf; \
    rm -f /etc/nginx/sites-enabled/default; \
    nginx -t; \
    php artisan optimize; \
    php docker/debug-config.php; \
    php-fpm -D; \
    exec nginx -g 'daemon off;' \
"]
