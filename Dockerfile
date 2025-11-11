# Use the official PHP image with Apache
FROM php:8.2-apache

# Install necessary PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose the web server port
EXPOSE 80

# Set environment variables (can be overridden when running the container)
ENV DB_HOST=your-database-host \
    DB_NAME=your-database-name \
    DB_USER=your-db-username \
    DB_PASS=your-db-password

# Start Apache in the foreground
CMD ["apache2-foreground"]
