# Use the official PHP image with Apache
FROM php:8.2-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your application code into the container
COPY . .

# Install common PHP extensions (optional but useful)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (often needed for frameworks like Laravel, etc.)
RUN a2enmod rewrite

# Set proper permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to the host
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
