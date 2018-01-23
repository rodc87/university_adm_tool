FROM pdedecker/laravel-apache
RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libreadline-dev \
    libxml2-dev
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install mysql mbstring xml tokenizer
RUN docker-php-ext-install pdo pdo_mysql
RUN service apache2 restart

ADD . /var/www
ADD . /var/www/html
