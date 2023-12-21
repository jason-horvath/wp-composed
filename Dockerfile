# Use an official PHP runtime as a parent image
FROM php:8.3-fpm

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    unzip \
    supervisor \
    libonig-dev

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql zip mbstring calendar

# Install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Xdebug
RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug

# Expose the Xdebug port
EXPOSE 9003

# Add nginx user
RUN useradd -u 1001 -m -s /bin/bash nginx

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the local PHP configuration file to the container
COPY docker/php/php.ini /usr/local/etc/php/conf.d/

# Copy Xdebug configuration file
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Set up Composer cache directory
ENV COMPOSER_CACHE_DIR /tmp/composer_cache

# Copy the local codebase to the container
COPY . .

# Install Composer Packages
RUN composer install --no-interaction --optimize-autoloader

# Cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy supervisor configuration
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 80
EXPOSE 80

# Copy Nginx configurations
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN chown -R nginx:nginx /etc/nginx

# Start supervisord to manage Nginx and PHP-FPM
# CMD /usr/sbin/nginx && /usr/local/sbin/php-fpm -F
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]