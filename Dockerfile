FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Clone from GitHub into a temporary folder, then copy into /var/www
# This avoids "destination path '.' already exists and is not an empty directory" errors
RUN git clone https://github.com/Jeloyyy/EMV-Tracking-System /tmp/repo && \
    cd /tmp/repo && git checkout main || true && \
    rm -rf /var/www/* /var/www/.[!.]* /var/www/..?* || true && \
    cp -a /tmp/repo/. /var/www && \
    rm -rf /tmp/repo

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
