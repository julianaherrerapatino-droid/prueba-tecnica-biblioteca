# Sistema de Gestión de Biblioteca — Prueba técnica

## Instalación

1. Clonar el repositorio
2. Instalar dependencias:
```bash
   composer install
```
3. Copiar `.env.example` a `.env` y configurar la base de datos PostgreSQL:
4. Generar la key de la app:
```bash
   php artisan key:generate
```
5. Migrar y poblar la base de datos con datos de prueba:
```bash
   php artisan migrate:fresh --seed
```
6. Levantar el servidor:
```bash
   php artisan serve
```
7. La API queda disponible en `http://localhost:8000/api`

## Base de datos poblada

Se incluye un dump con datos de prueba en `database/biblioteca_dump.sql`.
Para importarlo directamente sin correr las seeders:
```bash
psql -U postgres -d biblioteca -f database/biblioteca_dump.sql
```

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