###### Как запустить:
composer install

cp .env.example .env

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate

./vendor/bin/sail artisan migrate

##### Запуск тестов:

./vendor/bin/sail artisan test

##### Документация:

http://127.0.0.1/swagger
