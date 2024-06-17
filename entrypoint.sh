#!/usr/bin/env bash

composer install -n
php artisan optimize:clear
php artisan config:cache
php artisan route:cache

exec "$@"
