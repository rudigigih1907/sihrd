FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies & extensions
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install pdo_mysql zip exif pcntl intl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Remove Cache
RUN rm -rf /var/cache/apt/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
# COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data README.md /var/www/html/

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]