FROM php:latest

# Set working directory and copy source code
ADD . /app
WORKDIR /app

# Install php dependencies
RUN apt update && apt upgrade -y && apt install git zip libfreetype6-dev libjpeg62-turbo-dev libpng-dev netcat-traditional mariadb-client cron -y
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install bcmath mysqli pdo pdo_mysql gd && \
    chmod +x /app/entrypoint.sh

# Install node and npm packages
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run build

# Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    composer install --optimize-autoloader

RUN crontab /app/crontabs

# Expose port 8000 and start php server
EXPOSE 8000
ENTRYPOINT /app/entrypoint.sh