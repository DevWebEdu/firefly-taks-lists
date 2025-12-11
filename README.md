# Proyecto: FireFly - TodoList 

Aplicacion Web de gestion de Tareas - Todo List. Construida con LARAVEL 12 - VUE 3 - INTERTIAJS.

---

## Tabla de Contenidos

* [Requisitos](#requisitos)
* [Pasos de instalación](#pasos)
* [Cómo ejecutar cada servicio](#ejecucion)
* [Variables de entorno necesarias](#entorno)


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
