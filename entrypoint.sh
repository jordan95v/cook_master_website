#!/bin/bash

php /app/artisan key:generate
php /app/artisan storage:link
sleep 10
php /app/artisan migrate 
php /app/artisan serve --host=0.0.0.0
