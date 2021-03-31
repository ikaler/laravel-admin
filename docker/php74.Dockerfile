# PHP + Apache
FROM php:7.4-apache
LABEL maintainer="inderjeet@gmail.com"

# Define user for the container
ENV user=laravel
ENV uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libmcrypt-dev \
    libmemcached-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    wget \
    vim \
  && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath \
    calendar \
    exif \
    gd \
    intl \
    mysqli \
    opcache \
    pcntl \
    pdo_mysql \
    soap \
    zip \
    sockets

# Install PHP extensions using PECL 
RUN pecl install redis-5.3.2 \
    && pecl install xdebug-2.9.8 \
    && pecl install mcrypt-1.0.3 \
    && pecl install memcached-3.1.5 \
    && pecl install grpc-1.32.0 \
    && docker-php-ext-enable redis \
    xdebug mcrypt memcached grpc

# Enable common Apache modules
RUN a2enmod headers expires rewrite ssl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Create system user to run Composer and Other Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

# Set current user
# USER $user