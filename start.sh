#!/bin/sh

if [ -z "$APP_KEY" ]; then
    php artisan key:generate
else
    echo "Using provided APP_KEY."
fi

php artisan migrate --force
php artisan app:create-default-tenant-command
php artisan serve --host=0.0.0.0 --port=${PORT}
