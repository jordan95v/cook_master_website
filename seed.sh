#!/bin/bash

echo "Deleting seeded images..."
rm -rf ./storage/app/public/*.png
echo "Seed images deleted !"

echo "Deleting invoices..."
rm -rf ./storage/app/public/invoices/*.pdf
echo "Invoices deleted !"

php artisan migrate:fresh --seed
echo "Migration done !"