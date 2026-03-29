# Release Notes

## v1.2.0 - 2026-03-28

Tag actual: `v1.2.0`

### Cambios principales
- Integracion de MySQL configurable para Railway mediante variables de entorno.
- Soporte para `MYSQL_URL`, `DATABASE_URL` y variables `MYSQL*` o `DB_*`.
- Fallback local seguro a `localhost` para desarrollo.
- Esquema minimo agregado para inicializar una base vacia con `users` y `login_attempts`.
- Diagnostico de entorno ajustado para ejecutar pruebas de conexion e insercion con rutas seguras.

### Archivos clave
- `includes/db.php`
- `diagnostico/env_api.php`
- `database/schema_minimo.sql`
- `.env.example`
- `README.md`

### Validacion realizada
- Conexion real validada contra Railway.
- Creacion de tablas `users` y `login_attempts`.
- Insercion de prueba y limpieza posterior en `login_attempts`.
- Verificacion de sintaxis PHP sobre los archivos modificados.

### Notas operativas
- `main` es la rama principal y sigue `origin/main`.
- La rama feature de Railway ya fue mergeada y eliminada.
- El tag `v1.2.0` fue corregido para apuntar al merge actual de `main`.

## Proxima version sugerida: v1.2.1

### Siguiente foco
- Crear usuario administrador inicial para la base `railway`.
- Definir bootstrap de datos iniciales para ambientes vacios.
- Consolidar el flujo de despliegue y configuracion del `.env`.
