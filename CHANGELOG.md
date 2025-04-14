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
