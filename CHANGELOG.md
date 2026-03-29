## [Unreleased]

### Added
- Soporte de configuracion MySQL por variables de entorno para Railway.
- Archivo `database/schema_minimo.sql` para inicializar `users` y `login_attempts`.
- Archivo `.env.example` con plantilla de conexion.

### Changed
- Refactor de `includes/db.php` para soportar `MYSQL_URL`, `DATABASE_URL`, `MYSQL*` y `DB_*`.
- Actualizacion de `diagnostico/env_api.php` para ejecutar validaciones seguras desde web y CLI.
- Documentacion de instalacion y conexion en `README.md` y `RELEASE-NOTES.md`.

### Verified
- Conexion real a Railway.
- Insercion de prueba en `login_attempts`.
- Creacion de tablas base en una base vacia.

## [v1.2.0] - 2025-04-20

### ✨ Nuevas funcionalidades
- Sistema completo de sesiones activas (`perfil_sesiones.php`)
- Cierre remoto de sesiones (`session_guard.php`)
- Validación automática de sesiones desde middleware
- Integración visual de badges de estado (activo, cerrado, fallido)

### 🔐 Seguridad
- Refuerzo de control de sesión por `session_id`
- Middleware validación activa `validate_session_active($conn)`
- Protección contra navegación con sesiones muertas

### 🛠️ Refactor y mejoras internas
- Modularización de layout con `__DIR__` seguro
- Armonización de `layout_start.php` en todos los flujos
- Arreglo de carga de scripts condicionales en `layout_end.php`

### 🐛 Correcciones
- Errores de `header already sent` al eliminar usuarios
- Control de errores en `editar_usuario.php` con fallback visual

### 🧪 QA Validado
- Crear, editar, eliminar usuarios ✅
- Cerrar sesión remota y validar cierre ✅
- Carga de perfil y avatar ✅

---


## [1.1.0] – 2025-04-14

### Added
- 🔐 `session_guard.php`: validación de sesiones remotas
- 💾 Registro de login en `login_attempts`
- 🧾 `perfil_sesiones.php` y `kill_sesiones.php`

### Changed
- ♻️ Orden de includes en `layout_start.php`
- 🧱 Includes absolutos con `__DIR__`

### Fixed
- 🧯 Warning headers sent
- 🐛 Undefined `$conn` warnings
