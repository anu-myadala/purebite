# Use official PHP with Apache
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    curl \
    libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy all files from htdocs to web root
COPY htdocs/ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache
RUN echo '<Directory /var/www/html/>\n\
    Options -Indexes +FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/docker-php.conf

RUN a2enconf docker-php

# Ensure PHP is enabled (should be by default, but making sure)
RUN a2enmod php8.2 || true

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

