FROM node:22-bookworm-slim AS assets

WORKDIR /app

COPY package.json ./
RUN npm install --no-audit --no-fund

COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build

FROM php:8.5-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libpq-dev \
        unzip \
    && docker-php-ext-install -j"$(nproc)" intl pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-progress

COPY --from=assets /app/public/build ./public/build
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start-render.sh /usr/local/bin/start-render

RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && a2enmod rewrite \
    && chmod +x /usr/local/bin/start-render \
    && mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

ENV PORT=10000

EXPOSE 10000

CMD ["/usr/local/bin/start-render"]
