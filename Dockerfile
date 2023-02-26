FROM php:8.1.11-apache-buster

# Install system dependencies
RUN apt-get update && apt-get install -y git

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli
