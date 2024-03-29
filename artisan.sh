export DB_CONNECTION
export DB_USERNAME
export DB_PASSWORD
export DB_NAME
export DB_PORT
export DB_HOST
export PHP_TOKEN_KEY

sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_PORT=.*/DB_PORT=$DB_PORT/" .env
sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
sed -i "s/TOKEN_KEY=.*/TOKEN_KEY=$PHP_TOKEN_KEY/" .env

php artisan optimize:clear
#php artisan cache:clear
#php artisan route:clear
#php artisan config:clear
#php artisan view:clear
php artisan serve --host=0.0.0.0 --port=8000