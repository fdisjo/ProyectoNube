#!/bin/sh
set -eu

cd /var/www/html

mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
ln -sfn /var/www/html/storage/app/public /var/www/html/public/storage

php artisan optimize

exec apache2-foreground