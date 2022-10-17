# Reto técnico BackBooneSystems

Utilizar framework Laravel para realizar API 

## Requisitos

* Laravel 9
* PHP 8.1
* MySql database

## Instalación

```bash
composer install 
```
```bash
php artisan migrate 
```

```bash
php artisan db:seed
```

## Uso

```bash
php artisan server
```

Respuesta en formato Json [/api/zip-codes/{zip-code}](127.0.0.1:8000/api/zip-codes/{zip-code})

## Forma de trabajo
* Se descargan datos en formato excel dejando solo datos/columnas necesarias.
* Se analizan los datos para ver la relación entre ellos y crear una base de datos relacional en MySql 
* Se genera seeder con base al archivo CSV ```database/seeders/data_main.csv```
* Se desarrolla función principal en controlador ```app/Http/Controllers/ZipCodeController.php```
* Para finalizar, se hace configuración de los modelos utilizando ELOQUENT ORM
 para mejorar la relacion de la API con la base datos.