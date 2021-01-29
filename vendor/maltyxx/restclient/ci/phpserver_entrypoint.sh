#!/bin/bash

# We need to install dependencies only for Docker
[[ ! -e /.dockerenv ]] && exit 0

# Commande
php -S localhost:8000 &

exec "$@"
