# 📦 CHANGELOG - Report Dashboard Web App

Todas las versiones documentadas del sistema.  
Este changelog sigue el formato SemVer.

---
# 📦 CHANGELOG - Proyecto Report Dashboard

## [v1.1.0-alpha] - 2025-04-09
### Agregado
- Estructura base para nuevas funciones avanzadas
- Soporte multirrol: `viewer`, `analyst`
- CLI `make:securepage` con múltiples roles
- Refactor de notificaciones (alert, toast, snackbar)
- Modularización avanzada de layout y protección

### Próximo
- Filtros de reportes dinámicos
- Exportar a Excel/PDF
- Upload CSV
- Soporte multilenguaje


## [v1.0.0] - 2025-04-08
### 🎯 Versión inicial estable (MVP completado)

#### ✅ Features principales
- Login seguro con sesiones PHP (`login.php`)
- CRUD completo de usuarios (`usuarios.php`, `editar_usuario.php`, `nuevo_usuario.php`, `eliminar_usuario.php`)
- Dashboard visual con Bootstrap 5 y Chart.js
- Layout modular con `layout_start.php` y `layout_end.php`
- Middleware `require_secure_view()` con soporte a múltiples roles (`admin`, `user`, `alystic`, `customer`)
- Sistema inteligente de notificaciones: toast + alert
- Sanitización de parámetros `GET` para prevenir repeticiones
- CLI Generator `php make_securepage.php`

#### 🛡️ Seguridad aplicada
- Hash de contraseñas con `password_hash()` y `password_verify()`
- Validación de roles en tiempo real
- Protección CSRF básica con `ob_start()` + header location
- Prepared statements 100% en consultas SQL (`mysqli`)

#### 🧪 QA Validado
- ☑️ Registro y login funcionando
- ☑️ Gestión de usuarios protegida
- ☑️ Toasts y alertas funcionando vía URL
- ☑️ Base de datos remota conectada (OrangeHost)
- ☑️ Navegación protegida por middleware

#### 🧰 Tech Stack
- PHP 8.2+, Bootstrap 5.3, FontAwesome CDN
- MySQL 5.7+ / Hosting remoto
- Chart.js CDN
- JavaScript Modular (ES Modules)
- Layouts + Middlewares desacoplados

---

## 🔮 Roadmap próximo (v1.1.0)
| Tarea                                    | Estado |
|-----------------------------------------|--------|
| 👥 Registro externo con validación       | 🔜     |
| 📤 Exportación de reportes a PDF/Excel   | 🔜     |
| 🧾 Importación CSV                       | 🔜     |
| 🎯 Roles extendidos (viewer, analista)   | 🔜     |
| 🌐 Multilenguaje ES/EN                   | 🔜     |

---

> Generado por `Jake 🥷` – Asistente AI  
> Powered with 🔐 Seguridad + 📊 Visualización + ⚙️ Modularidad
