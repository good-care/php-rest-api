export DB_CONNECTION
export DB_USERNAME
export DB_PASSWORD
export DB_NAME
export DB_PORT

sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env

php artisan key:generate
php artisan serve --host=0.0.0.0 --port=8000