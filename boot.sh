#!/usr/bin/env bash
cp .env.example .env
composer install
composer dump-autoload
yarn install
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate
php artisan storage:link

echo 'Done ------>'

php artisan serve
