#!/bin/sh

# Wait for the database to be ready
until php artisan migrate:status > /dev/null 2>&1; do
  echo "Waiting for database connection..."
  sleep 2
done

# Run migrations and seeders
php artisan migrate --force --seed

# Then start PHP-FPM or Laravel server (adjust as per your container setup)
exec "$@"
