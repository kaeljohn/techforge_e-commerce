#!/bin/bash
# Default PORT to 80 if not set by Render
PORT=${PORT:-80}

# Update apache ports to use the Render PORT
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Cache configuration and routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Start Apache in foreground
apache2-foreground
