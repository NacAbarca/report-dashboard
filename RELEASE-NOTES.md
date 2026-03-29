# Release Notes

## v1.2.1 - 2026-03-29

Tag actual: `v1.2.1`

### Cambios principales
- Correccion del guard de sesion en `login.php`.
- Correccion del registro publico en `registrar.php`.
- Correccion del alta de usuarios admin en `admin/nuevo_usuario.php`.
- Registro de intentos fallidos en `includes/auth.php`.
- Normalizacion de estados de sesiones a `success`, `fail` y `killed`.

### Archivos clave
- `login.php`
- `registrar.php`
- `admin/nuevo_usuario.php`
- `includes/auth.php`
- `perfil_sesiones.php`
- `components/layout_start.php`

### Validacion realizada
- Verificacion de sintaxis PHP sobre los archivos modificados.
- Login exitoso verificado con escritura `success` en `login_attempts`.
- Login fallido verificado con escritura `fail` en `login_attempts`.
- Flujo de usuarios corregido para evitar 404 en registro y duplicacion de layout.

### Notas operativas
- `main` es la rama principal y sigue `origin/main`.
- El tag `v1.2.1` apunta al commit `c8b5e89`.
- `v1.2.0` queda como release de integracion de Railway y `v1.2.1` como release de estabilizacion del flujo de autenticacion.

## Proxima version sugerida: v1.2.2

### Siguiente foco
- Definir seed inicial opcional para entornos vacios.
- Revisar cierre de auto-registro publico en produccion si aplica.
- Limpiar scripts de prueba embebidos en layout y documentar deploy final.
