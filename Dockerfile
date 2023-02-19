
# # docker image to use
# FROM php:8.1-fpm
# # where all code for the project will be held
# WORKDIR /app/media-api

# #
# #
# #  MIGHT NEED TO INSTALL DEPENDENCIES FOR LARAVEL
# #
# #

# # copy project to container
# COPY . .
# # port to expose container to
# EXPOSE 3001
# # command to run after container ghas started
# CMD ['php', 'artisan', 'serve']

###################### OLD ######################

# FROM php:8.1-fpm

# RUN docker-php-ext-install pdo_mysql
# ADD . /var/www
# ADD ./public /var/www/html

# RUN pwd

# WORKDIR /var/www
# EXPOSE 3001

# RUN ['php','artisan','serve']

###################### OTHER OLD ######################

FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
