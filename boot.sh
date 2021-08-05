#!/usr/bin/env bash
cp .env.example .env
composer install
yarn install
php artisan migrate:fresh
php artisan db:seed
php artisan key:generate

echo 'Done ------>'

php artisan serve
