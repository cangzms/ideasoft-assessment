# Ideasoft Take-Home Assessment

## Installation
Clone Repository

````
git clone https://github.com/cangzms/ideasoft-assessment.git
````

Copy & rename api/.env.example to api/.env file

````
cp api/.env.example api/.env
````

Docker Containers run

````
docker-compose up -d --build
````
````
docker exec -ti api_container_id bash
````
Composer install

````
composer install
````

Generate laravel app key

````
php artisan key:generate
````

Migrate
````
php artisan migrate:fresh --seed
````

Request
````
localhost:8080/api/...
````