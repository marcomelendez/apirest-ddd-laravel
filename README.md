# Test Technical

## Hexagonal architecture with Laravel

API Rest con 4 endpoint con laravel y arquitectura hexagonal

- Laravel version 9

Instalación con Docker y sail

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

## Migraciones

php artisan migrate --seed

## Endpoint

*- POST /api/auth*
   Autenticación con JWT devuelve *Token* que se debe enviar en todas las peticiones

*- POST /api/lead* crear nuevo candidato
    ** Solicitud: {
        "name": "mi candidato",
        "source": "fotocasa",
        "owner": 2
    }
*- GET /api/leads* listar candidatos

*- GET /api/lead/{id}* obtener un candidato por Id
