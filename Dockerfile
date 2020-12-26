FROM php:alpine
ENV DB_CONNECTION=pgsql
ENV DB_USERNAME=user
ENV DB_PASSWORD=pwd
ENV DB_NAME=postgres
ENV DB_PORT=5432

RUN apk update && apk add libmcrypt-dev openssl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app
RUN composer create-project

ENTRYPOINT ./artisan.sh

EXPOSE 8000
