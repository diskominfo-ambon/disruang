#!/usr/bin/env bash
cp env.example .env
composer install
yarn install
php artisan migrate
php artisan db:seed
php artisan key:generate
php artisan serve
