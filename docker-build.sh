#!/bin/bash

set -e

# Set variables from docker.env
set -a && source app/.env && set +a

docker-compose down -v

docker-compose up --no-start --build

docker-compose run --rm producer-fpm /bin/bash -c 'composer install'

docker-compose start

docker-compose exec producer-fpm php bin/console d:m:m --no-interaction
