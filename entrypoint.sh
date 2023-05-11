#!/bin/bash

# Laravel setup
php /app/artisan key:generate
php /app/artisan storage:link

# Sleep so MySQL can start
while ! mysqladmin ping -h "$DB_HOST" --silent; do
  echo "Waiting for MySQL to start..."  
  sleep 1
done

# Run migrations, seeders and start server
php /app/artisan migrate 

php /app/artisan config:clear
php /app/artisan route:cache
php /app/artisan view:cache
php /app/artisan serve --host=0.0.0.0
