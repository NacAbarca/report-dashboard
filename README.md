# 📊 Report Dashboard Web App

Bienvenido al **Panel de Reportes** creado con tecnologías web modernas.  
Este proyecto es una aplicación web para visualizar datos dinámicos en tiempo real, accesible desde cualquier navegador moderno.

---

## 🚀 Tecnologías Usadas

### 🖥️ Frontend
- **Bootstrap 5**: Framework CSS responsivo para construir interfaces rápidas y limpias.
- **Chart.js**: Librería de gráficos interactivos (barras, líneas, tortas, etc).
- **JavaScript Vanilla**: Usado para interactividad, llamadas AJAX y lógica del dashboard.
- **HTML5 + CSS3**: Estructura y estilo adicional.
- **SweetAlert2 (opcional)**: Alerts estilizadas (no instalado aún).

### 🧠 Backend
- **PHP (Vanilla)**: Lógica del servidor para manejar sesiones, login y datos.
- **MySQL**: Base de datos para usuarios y datos de reportes.
- **mysqli + prepared statements**: Seguridad ante SQL Injection.

---

## 🧩 Estructura del Proyecto


---

## 🔐 Funciones Implementadas

| Módulo           | Funcionalidad                                                                 |
|------------------|--------------------------------------------------------------------------------|
| **Login**        | Autenticación de usuario con PHP y sesiones.                                  |
| **Dashboard**    | Panel principal con tarjetas e informes gráficos.                             |
| **Conexión DB**  | Conexión remota a base de datos en hosting externo (OrangeHost).              |
| **Gráficas**     | Gráficos de barras y líneas con `Chart.js` usando datos JSON desde PHP.       |
| **Protección**   | Uso de `password_hash()`, `password_verify()` y prepared statements.          |
| **Logout**       | Sistema seguro de cierre de sesión.                                           |

---

## ⚙️ Configuración Inicial

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/report-dashboard.git

Configura tu base de datos en includes/db.php:

php
Copiar
Editar
$host = "mysql.tudominio.com";
$user = "usuario";
$pass = "contraseña";
$db   = "dashboard";
Importa el archivo .sql en tu hosting MySQL (por phpMyAdmin).