# Prueba candidatos Backend (PHP-Laravel)
La prueba consiste en desarrollar una API Rest con 4 endpoints.

## Requisitos
- Utilizar Laravel 9, BBDD MySQL y Redis para caché, JWT para el token
- Crear test unitarios
- Crear factories de todos los modelos Seeder para crear usuario con los 2 roles
- Utilizar caché para obtener los candidatos
- Utilizar DDD
- Cobertura 100% de unit testing
- Utilizar Sonarqube para el analisis del código estatico

## A entregar 
Código con el .env.exemple listo para copiar a .env

## Los endpoints son

**Generar access token POST /auth**
<pre>
    Solicitud:
        {
            "username": "tester", "password": "PASSWORD"
        }
    
    Respuesta 200 OK
    
    {
        "meta": { "success":
        true,"errors": []
    },
        "data": {
        "token": "TOOOOOKEN",
        "minutes_to_expire": 1440
        }
    }
    
    401 Unauthorized
    {
        "meta": { "success":
        false,"errors": [
            "Password incorrect for: tester"
            ]
        }
    }
</pre>   

**Crear andidato POST /lead Solicitud**
<pre>
    {
        "name": "Mi candidato", 
        "source": "Fotocasa", 
        "owner": 2
    }
        
    Respuesta:201 OK
        
    {
        "meta": { "success":
        true,"errors": []
    },
        "data": {
            "id": "1",
            "name": "Mi candidato", "source": "Fotocasa", "owner": 2,
            "created_at": "2020-09-01 16:16:16",
            "created_by": 1
        }
    }
    
    401 Unauthorized
        {
            "meta": { "success":
            false,"errors": [ "Token expired"]
        }
    }
</pre>
**Obtener candidato GET /lead/{id}**

Para obtener un candidato con un id en concreto
<pre>
Respuesta:200 OK
{
    "meta": { "success":
    true,"errors": []
},
    "data": { 
        "id": "1",
        "name": "Mi candidato", "source": "Fotocasa", "owner": 2,
        "created_at": "2020-09-01 16:16:16",
        "created_by": 1
    }
}

401 Unauthorized

{
    "meta": { 
        "success":
        false,"errors": ["Token expired"]
    }
}

404 Not found

{
    "meta": { 
    "success": false,
    "errors": [ "No lead found"]
    }
}
</pre>
**Obtener todos los candidatos GET /leads**

Devuelve todos los candidatos asignados al agente o si es usuario managerdevuelve todas los candidatos.
<pre>
    Respuesta:200 OK
    {
        "meta": { "success":
        true,"errors": []
    },
    "data": [
        {
            "id": "1",
            "name": "Mi candidato", "source": "Fotocasa", "owner": 2,
            "created_at": "2020-09-01 16:16:16",
            "created_by": 1
        },
        {
            "id": "2",
            "name": "Mi candidato 2", "source": "Habitaclia", "owner": 2,
            "created_at": "2020-09-01 16:16:16",
            "created_by": 1
            }
        ]
    }
    
    
    401 Unauthorized
    {
        "meta": { 
            "success": false,
            "errors": [ "Token expired"]
        }
    }
</pre>


