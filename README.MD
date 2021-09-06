# PRUEBAS EDIFICIOS WAYNE

## REQUISITOS
- PHP 7.4
- Mysql
- Composer

## INSTALACION

- `composer install`
- Crear tabla en mysql
- Configurar BD en `src/Config/database.php`
- Ejecutar comando `php -S localhost:8000`
- Ruta de la api `http://localhost:8000/api/reports`
- Ruta del front `http://localhost:8000/front/index.html`

## ARQUITECTURA MVC

Este proyecto no es recomendado para ambientes productivos, ya que solamente fue realizado para la prueba.

Realice mi propio microframework con solamente los componentes que se iba a necesitar para la prueba.

El microframework contiene

- Rutas
- Controladores
- Orm
- Migraciones
- Seeds

Al momento de iniciar el proyecto, este ejecuta las migraciones y las semillas de manera automatica,
la generación del algoritmo se encuentra `Services/ElevatorService` cumpliendo con principios `SOLID`, Clean Code y 
algunos patrones de diseño.
