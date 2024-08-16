# acessar o container

cd docker
docker-compose exec -it php8 bash

# instalar as dependencias

cd html
composer install && npm install

# migrations

php artisan migrate
