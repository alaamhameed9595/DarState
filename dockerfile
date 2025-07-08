FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    libzip-dev libjpeg-dev libfreetype6-dev libjpeg62-turbo-dev \
    nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip gd

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app code
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install and build frontend assets
RUN npm install

RUN npm run build

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Clear and cache Laravel config
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan view:cache

# Expose port 8000
EXPOSE 8000

# Final command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
