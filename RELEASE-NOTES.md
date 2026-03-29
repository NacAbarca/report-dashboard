# Release Notes

## v1.2.2 - 2026-03-29

Tag actual: `v1.2.2`

### Cambios principales
- Refinamiento visual completo del tema dark/light.
- Correccion de contraste en tablas, cards, dropdowns y formularios.
- Navbar, sidebar y footer adaptados a desktop y mobile con mejor consistencia Bootstrap.
- Mejora visual de `usuarios`, `auditoria`, `perfil` y `sesiones`.
- `README.md` actualizado con la nueva version actual.

### Archivos clave
- `assets/css/custom.css`
- `components/header.php`
- `components/sidebar.php`
- `components/menu.php`
- `components/footer.php`
- `index.php`

### Validacion realizada
- Verificacion de sintaxis PHP sobre `admin/usuarios.php`, `admin/login_logs.php`, `perfil.php` y `perfil_sesiones.php`.
- Ajuste de estilos para tablas y shell de aplicacion sin romper el layout existente.

### Notas operativas
- `main` es la rama principal y sigue `origin/main`.
- `v1.2.1` queda como release de estabilizacion de autenticacion.
- `v1.2.2` corresponde al ajuste visual dark/light y responsive.

## Proxima version sugerida: v1.2.3

### Siguiente foco
- Definir seed inicial opcional para entornos vacios.
- Revisar cierre de auto-registro publico en produccion si aplica.
- Limpiar scripts de prueba embebidos en layout y documentar deploy final.
