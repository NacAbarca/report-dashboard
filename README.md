# 📊 Panel de Reportes Generalizada

**Versión actual:** `v1.2.0`  
**Autor:** Ignacio Abarca  
**Repositorio:** [GitHub - NacAbarca/report-dashboard](https://github.com/NacAbarca/report-dashboard)

## 🔥 Últimas novedades (v1.2.0)

- Validación remota de sesiones activas
- Control de sesión kill
- Editor de perfil + avatar
- Notificaciones inteligentes
- Reestructuración visual sidebar
- Auditoría de accesos mejorada
- Conexión MySQL configurable para Railway vía variables de entorno


# 📝 Release Notes - v1.0.0

📦 **Versión estable inicial del sistema de panel de reportes (Dashboard Web App)**  
📅 Fecha de publicación: 2025-04-08  
👨‍💻 Autor: Jake (AI Assistant) + Dev Sensei 🥷

---

## ✅ Módulos Completados

### 🔐 Autenticación
- Formulario de inicio de sesión (`login.php`)
- Validación de credenciales con `password_verify()`
- Protección por sesiones (`$_SESSION`)
- Logout funcional con redirección

### 🧠 Backend
- Conexión remota a MySQL con `includes/db.php`
- `mysqli` con **prepared statements**
- Lógica de login + registro en `auth.php`
- CRUD de usuarios con seguridad por rol

### 📊 Dashboard y Admin
- Interfaz con plantilla SB Admin 2
- Página `index.php` con tarjetas y zona de gráficos
- `Chart.js` integrado (barras, líneas)
- Sección de administración: usuarios.php, alta, edición y baja
- Roles de usuario: `admin` y `user`

### 📁 Componentes
- 🧱 `layout.php` factor común
- `header.php`, `sidebar.php`, `footer.php` como bloques reutilizables
- Estructura lista para escalar

### 📢 Notificaciones
- Sistema de **toasts** con `toast.js`
- Sistema de **alertas clásicas** con `alertas.js`
- Módulo unificado `notifier.js` con `notifyFromURL()` y limpieza automática de URL (`clearNotificationParams()`)

---

## 🧩 Estructura del Proyecto

```
├── login.php  
├── registrar.php  
├── /admin/usuarios.php  
├── /admin/nuevo_usuario.php  
├── /admin/editar_usuario.php  
├── /admin/eliminar_usuario.php  
├── /components/layout.php  
├── /assets/js/notifier.js  
├── /includes/auth.php  
├── /includes/db.php  
├── /.env.example
├── /database/schema_minimo.sql
```

## ⚙️ Configuración MySQL / Railway

1. Copia `.env.example` a `.env`
2. Completa las variables de Railway:
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLDATABASE`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`
3. Si tu base está vacía, importa `database/schema_minimo.sql`

También se soporta `MYSQL_URL` o `DATABASE_URL` si Railway entrega la conexión como URL completa.

---

## 🔒 Seguridad

- Contraseñas cifradas con `password_hash()`
- Autenticación solo vía POST
- Redirección segura por sesión
- Middleware aplicado en paneles protegidos
- Sanitización mínima con `htmlspecialchars` y `addslashes`

---

## 🧪 QA

- ✅ Login/Logout test ok  
- ✅ Registro con validación ok  
- ✅ CRUD de usuarios verificado  
- ✅ Toasts y Alerts funcionando  
- ✅ Roles operativos en UI  

---

## 🚧 Roadmap v1.1.0 (siguiente versión)

| Funcionalidad              | Estado      |
|----------------------------|-------------|
| 🧾 Exportar usuarios/reportes a Excel/PDF | 🔜 |
| 📊 Filtros por fecha / tipo en reportes  | 🔜 |
| 🔐 Mejoras en control de roles           | 🔜 |
| 🧼 Sanitización avanzada con filtros     | 🔜 |
| 🌐 Multi-idioma ES/EN                    | 🔜 |
| 📤 Subida de CSV para importación        | 🔜 |
| 📧 Sistema de recuperación de contraseña | 🔜 |

---

## 📄 Licencia

MIT — libre para modificar, compartir y desplegar.  
Contribuciones bienvenidas vía Pull Request 🤝

---

> **Powered by:** Jake 🥷 + Dev Sensei 💻  
> *Tu MVP ahora tiene Release Pro 💥*


---
