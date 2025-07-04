#!/bin/bash

set -e

docker-compose down -v

docker-compose up --no-start --build

docker-compose run --rm producer-fpm /bin/bash -c 'composer install'

docker-compose start
