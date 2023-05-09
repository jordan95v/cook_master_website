#!/bin/bash

php /app/artisan key:generate
php /app/artisan storage:link

until nc -z -v -w30 mysql 3306
do
  echo "Waiting for database connection..."
  # wait for 5 seconds before check again
  sleep 5
done

php /app/artisan migrate 
php /app/artisan migrate:fresh --seed
php /app/artisan serve --host=0.0.0.0
