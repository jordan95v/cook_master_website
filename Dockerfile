FROM php:latest

# Set working directory and copy source code
ADD . /app
WORKDIR /app

# Install php dependencies
RUN apt update && apt upgrade -y && apt install git zip libfreetype6-dev libjpeg62-turbo-dev libpng-dev netcat-traditional mariadb-client -y
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
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    composer install --optimize-autoloader

# Expose port 8000 and start php server
EXPOSE 8000
ENTRYPOINT /app/entrypoint.sh