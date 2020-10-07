FROM php:7.4-apache
RUN apt-get update -y && \
	docker-php-ext-install mysqli && \
	docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html/
WORKDIR /var/www/html/
CMD ["php", "-S", "0.0.0.0:4000", "-t","./notas/api/"]