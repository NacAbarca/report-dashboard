# 📝 Release Notes – v1.1.0

📅 Fecha de publicación: 2025-04-14  
👨‍💻 Autor: Nac Abarca + Jake 🥷

---

## 🆕 Mejoras y Nuevas Funcionalidades

### 🔐 Seguridad y Gestión de Sesión
- ✅ Sistema de *sesiones remotas*: registro, visualización y control de sesiones activas
- ✅ Función `validate_session_active()` para validar si una sesión fue *cerrada remotamente*
- ✅ Middleware `session_guard.php` que intercepta accesos con sesiones *killed*

### 🧱 Backend y Middleware
- 🛡️ Refactor total de `layout_start.php` para incluir:
  - Conexión segura (`db.php`)
  - Validación por middleware y sesión
- Modularización clara por componentes

### 🧰 Corrección de Errores
- 🛠️ Warning `headers already sent` solucionado
- 🧪 Fix en orden de includes con `__DIR__`
- 🧩 Validación de roles por `require_secure_view()`

---

## 📊 Dashboard / Sesiones

- 🔍 Vista de sesiones activas con `perfil_sesiones.php`
- 🔘 Botón para *cerrar sesión remota* con `kill_sesiones.php`
- 🧠 Control de `session_id` por usuario
- ✅ Verificación de estado: `Activa`, `Fallida`, `Cerrada`

---

## 🧪 QA Completado

| Test | Estado |
|------|--------|
| Cierre de sesión remota | ✅ |
| Render seguro de header/footer | ✅ |
| Redirección si `status = killed` | ✅ |
| Validación por rol y sesión | ✅ |
| Dashboard, login y registro | ✅ |

---

## 🚀 Próximos objetivos v1.2.0

- 📤 Exportación de sesiones a CSV/PDF
- 🧪 Auditoría por IP/User Agent
- 🧱 UI para administración de múltiples cuentas
- 📧 Notificación por email al cerrar sesión remotamente

---

> 🛠️ Powered by: Jake & Nac – Versión Estable para Entorno Producción 🧠  
> `git tag v1.1.0` + `git push origin main --tags` para liberar en GitHub 🚀
