MANUAL DE INSTALACION

PASO 1

Clonar el directorio publico remoto de github https://github.com/daw223-08/Gymnastic-Total


PASO 2

Dirigirse a la carpeta Backend-Gymnastic y ejecutar el comando composer install
Esto instalara composer para poder operar sobre los directorios

PASO 3

En esta misma carpeta hay que migrar las tablas, para ello creamos la base de datos en phpMyAdminn (http://27.0.174.71:8081) bajo el nombre "gymnastic" y una vez creada volvemos a la misma carpeta y ejecutamos php artisan migrate.

PASO 4

Ejecutar el comando que arrancará todo, docker-compose up -d y nos dirigimos a la url http://27.0.174.71/backend
