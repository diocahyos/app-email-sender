# Stage 1: Build Stage
FROM php:7.4 AS build

# Install necessary packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    git

# Install mysqli and gd extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the app code
COPY ./app /var/www/html

# Composer Install
WORKDIR /var/www/html
RUN composer install --prefer-dist

# Stage 2: Production Stage
FROM php:7.4-apache

# Copy necessary files from the build stage
COPY --from=build /usr/local/bin/composer /usr/local/bin/composer
COPY --from=build /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/

# Install necessary packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    git

# Install mysqli extension
RUN docker-php-ext-install mysqli pdo pdo_mysql gd

# Copy the app code and site configuration
COPY --from=build /var/www/html /var/www/html
COPY ./app/my-site.conf /etc/apache2/sites-available/my-site.conf

# Enable necessary Apache modules and configurations
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    a2enmod rewrite && \
    a2enmod headers && \
    a2dissite 000-default && \
    a2ensite my-site && \
    service apache2 restart

# Create temp directory
RUN mkdir -p /var/www/html/temp
RUN chmod 755 /var/www/html/temp

EXPOSE 80