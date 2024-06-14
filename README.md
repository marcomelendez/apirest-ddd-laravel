# Test Technical

## Hexagonal architecture with Laravel

Rest API with 4 endpoints with Laravel and hexagonal architecture

## Installation

- Laravel version 9

Installation with Docker and sail

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
## Migrations

php artisan migrate --seed

## API

| Plugin | RETURN |
| ------ | ------ |
| POST /api/auth | Authetication with JWT |
| POST /api/lead | New Leads Example: { "name": "mi candidato","source": "fotocasa", "owner": 2} |
| GET /api/leads | List of leads |
| GET /api/lead/{id} | Get Lead |

