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
# Stage 3: Production image (php-fpm + nginx)
# ==========================================
FROM php:8.3-fpm-bookworm

WORKDIR /var/www/html

# Install system dependencies + nginx + gettext-base (envsubst)
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
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Production PHP configuration
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Copy Laravel application and compiled frontend assets
COPY --from=composer-build /app /var/www/html
COPY --from=frontend-build /app/public/build /var/www/html/public/build

# Nginx configuration (port substituted at runtime via envsubst)
COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template

# Discover packages, link storage, set permissions
RUN php artisan package:discover --ansi \
    && php artisan storage:link \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Start php-fpm and nginx. PORT is injected by Render; envsubst renders the
# nginx listen directive.
# NOTE: Do not run migrations here. They run once per release via the
# preDeployCommand in render.yaml so every replica/restart does not race.
CMD sh -c "php artisan optimize \
    && PORT=\"\${PORT:-10000}\" envsubst '\${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf \
    && php-fpm -D \
    && nginx -g 'daemon off;'"
