# Proyecto: FireFly - TodoList 

Aplicacion Web de gestion de Tareas - Todo List. Construida con LARAVEL 12 - VUE 3 - INTERTIAJS.

---

## Tabla de Contenidos

* [Requisitos](#requisitos)
* [Pasos de instalación](#Pasos de instalación)
* [Cómo ejecutar cada servicio](#Cómo ejecutar cada servicio)
* [Variables de entorno necesarias](#Variables de entorno necesarias)


---

## Requisitos

Para levantar el proyecto es necesario tener los siguientes requerimientos.
* [x] NodeJs   ^22.18.0 
* [x] Composer ^2.7.7
* [x] NPM      ^11.6.2
* [x] PHP      ^8.2.22
---

## Pasos de instalación
### Clonacion del repositorio

 ```bash
# Clonar el repositorio
git clone https://github.com/DevWebEdu/firefly-taks-lists.git
cd firefly-taks-lists
```


### Back End : Laravel

 
 ```bash
# Entrar a la carpeta del backend 
cd .\todolist-backend\

# descargamos todas las dependencias
composer install

# copiamos el .env.example para crear nuestro .env
cp .\.env.example .\.env

# generamos la clave de la aplicacion
php artisan key:generate

# generamos la clave secreta de nuestro paquete de Jsonwebtokens
php artisan jwt:secret
```
---

### Variables de Entorno (BACKEND)

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=todobd
DB_USERNAME=root
DB_PASSWORD=root
```
---
### Migramos las tablas
```bash
php artisan migrate

## levantamos el servidor en el puerto 8001 
php artisan serve --port=8001
```
### Front End : Laravel + Inertia + Vue 
---
```bash
# Entrar a la carpeta del frontend 
cd .\todolist-frontend\

# descargamos todas las dependencias
composer install

# descargamos todas las dependencias de node para vue
npm install

# Si hay errores, usa:
npm install --legacy-peer-deps

# copiamos el .env.example para crear nuestro .env
cp .\.env.example .\.env

# En una terminal corremos el servidor del Front End - Laravel
php artisan server

# En otra terminal corremos el servidor del Front End - Vue  - compilamos estilos
npm run dev
```
## Cómo ejecutar cada servicio

### RUTAS 

* POST - api/register
* POST - api/login
* GET  - api/me
* POST - api/logout
* GET  - api/tasks
* POST - api/tasks
* PUT  - api/tasks
* DELETE  - api/tasks
* POST - api/tasks/{taskId}/toggle
---
### BACKEND
```bash
# Entrar a la carpeta del backend 
cd .\todolist-backend\

# levantar 
php artisan serve --port=8001

  INFO  Server running on [http://127.0.0.1:8001].  

  Press Ctrl+C to stop the server

```
### FRONTEND

```bash
# Entrar a la carpeta del frontend 
cd .\todolist-frontend\
# En una terminal corremos el servidor del Front End - Laravel
php artisan server

# En otra terminal corremos el servidor del Front End - Vue  - compilamos estilos
npm run dev

  VITE v7.2.7  ready in 2399 ms

  ➜  Local:   http://localhost:5173/
  ➜  Network: use --host to expose
  ➜  press h + enter to show help

  LARAVEL v12.41.1  plugin v2.0.1

  ➜  APP_URL: http://127.0.0.1:8000

```



## Variables de entorno necesarias

### BACKEND

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:FeREp/iHpFzLEq3hTZPfiFC+cFH+ATbPgk26W4xXT94=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=todobd
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

```

### BACKEND


```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:XXCZcsY6ll6hvFmo/dxooHlCcS44vUBSChjBfiL5Eac=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
VITE_API_URL=http://127.0.0.1:8001/api

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```
