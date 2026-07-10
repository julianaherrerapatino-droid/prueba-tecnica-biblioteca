# Sistema de Gestión de Biblioteca — Prueba técnica

## Instalación

1. Clonar el repositorio
2. Instalar dependencias:
```bash
   composer install
```
3. Copiar `.env.example` a `.env` y configurar la base de datos MySQL (XAMPP):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=
4. Generar la key de la app:
```bash
   php artisan key:generate
```
5. Crear la base de datos `biblioteca` desde phpMyAdmin (http://localhost/phpmyadmin), o correr:
```bash
   php artisan migrate:fresh --seed
```
   para que Laravel la migre y la llene con datos de prueba automáticamente.
6. Levantar el servidor:
```bash
   php artisan serve
```
7. La API queda disponible en `http://localhost:8000/api`

## Requisitos previos

- PHP 8.2 o superior
- Composer
- XAMPP (con Apache y MySQL corriendo)

## Base de datos poblada

Se incluye un dump con datos de prueba en `database/biblioteca_dump.sql`, exportado desde phpMyAdmin.
Para importarlo directamente sin correr las seeders:
1. Abrir phpMyAdmin (http://localhost/phpmyadmin)
2. Crear una base de datos vacía llamada `biblioteca`
3. Seleccionarla → pestaña **Importar** → elegir el archivo `database/biblioteca_dump.sql` → Continuar

## Colección de Postman

La colección exportada está en la carpeta `postman/`. Impórtala en Postman para probar todos los endpoints de la API.

## Respuestas teóricas

Ver el archivo `respuestas_teoricas.md` en la raíz del proyecto.

## Estructura del proyecto

- `app/Models` — modelos Eloquent (Autor, Libro, Usuario, Prestamo)
- `app/Http/Controllers/Api` — controladores de la API REST
- `app/Http/Requests` — validaciones
- `app/Services` — lógica de negocio (préstamos)
- `app/Console/Commands` — comando artisan para reporte de préstamos
- `database/migrations` — estructura de las tablas
- `database/seeders` y `database/factories` — datos de prueba
- `resources/views` — frontend con buscador de libros