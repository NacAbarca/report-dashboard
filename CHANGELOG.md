## [Unreleased]

## [v1.2.2] - 2026-03-29

### Changed
- Refinamiento del sistema visual dark/light en `assets/css/custom.css`.
- Navbar, sidebar, menu y footer alineados con el tema activo.
- Dashboard mejorado con jerarquia visual mas clara para titulos, subtitulos y KPI cards.
- Pantallas `admin/usuarios.php`, `admin/login_logs.php`, `perfil.php` y `perfil_sesiones.php` ajustadas para mejor contraste y responsive real.
- `README.md` actualizado a la version `v1.2.2`.

### Verified
- `php -l` sobre `admin/usuarios.php`, `admin/login_logs.php`, `perfil.php` y `perfil_sesiones.php`.
- Tablas y cards preparadas para dark/light sin depender de `table-dark`, `table-light` o colores fijos de Bootstrap.

## [v1.2.1] - 2026-03-29

### Fixed
- Inicio de sesion corregido en `login.php` con `session_start()` antes de validar `$_SESSION`.
- Formulario de `registrar.php` corregido para publicar al archivo real.
- Alta de usuarios admin corregida en `admin/nuevo_usuario.php` eliminando doble carga de layout.
- Registro de intentos fallidos agregado en `includes/auth.php`.
- Render de estados de sesiones normalizado a `success`, `fail` y `killed`.
- Inicio de sesion temprano corregido en `components/layout_start.php`.

### Changed
- Rutas de assets en `registrar.php` alineadas con `sbadmin`.
- Notificaciones de error en `registrar.php` integradas al sistema actual.

### Verified
- `php -l` sobre `login.php`, `registrar.php`, `admin/nuevo_usuario.php`, `includes/auth.php`, `perfil_sesiones.php` y `components/layout_start.php`.
- Login exitoso y fallido verificados contra Railway con inserciones `success` y `fail` en `login_attempts`.

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
