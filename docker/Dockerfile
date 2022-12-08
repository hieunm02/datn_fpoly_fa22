FROM ubuntu:20.04

RUN apt-get update

RUN apt-get install -y software-properties-common

RUN add-apt-repository ppa:ondrej/php

RUN apt-get install -y php8.1-fpm

RUN apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath

RUN apt-get install -y curl

RUN apt-get install -y php-cli unzip

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y default-mysql-client


#COPY . .

# CMD ["composer"]