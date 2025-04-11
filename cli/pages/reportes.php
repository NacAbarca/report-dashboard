<?php
ob_start();

require '../includes/middleware.php';
require_secure_view(['admin', 'analyst']);

require '../includes/db.php';
require '../components/layout_start.php';
?>

<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-shield-alt fa-lg text-success"></i>
  <h3 class="m-0 text-success">Página Segura</h3>
</div>

<p class="lead">Acceso autorizado para los roles: <code>admin,analyst</code>.</p>

<?php
require '../components/layout_end.php';
ob_end_flush();
?>