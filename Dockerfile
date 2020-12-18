FROM php:alpine
RUN apk update && apk add libmcrypt-dev openssl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app
RUN composer create-project

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
