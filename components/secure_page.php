<?php
ob_start(); // 🔐 Previene errores de header enviados

// 🧠 Middleware y validación de rol
require '../includes/middleware.php';
require_secure_view('admin'); // Cambia 'admin' por array ['admin', 'user'] si lo necesitás

// 🔗 Conexión a la base de datos
require '../includes/db.php';

// 📦 Layout base (contiene <head>, navbar, etc)
require '../components/layout_start.php';

// --- CONTENIDO DE LA PÁGINA A PARTIR DE AQUÍ ---
?>

<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-shield-alt fa-lg text-success"></i>
  <h3 class="m-0 text-success">Página Segura</h3>
</div>

<p class="lead">Esta página está protegida con verificación de sesión, rol y headers seguros.</p>

<?php
// --- FIN DE CONTENIDO ---
require '../components/layout_end.php';
ob_end_flush(); // 🧼 Libera el buffer y renderiza todo
?>
