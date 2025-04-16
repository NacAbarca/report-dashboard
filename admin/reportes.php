<?php
$page_title = "📑 Reportes";

require '../includes/db.php';
require_once __DIR__ . '/../includes/session_guard.php';
validate_session_active($conn);

require '../includes/middleware.php';
require_secure_view('admin');
require '../components/layout_start.php';
?>

<h3 class="mb-4 text-primary"><i class="fas fa-clipboard-list me-2"></i>Listado de Reportes</h3>

<!-- 🔍 Filtro por fecha -->
<form method="GET" class="row g-3 mb-4">
  <div class="col-md-4">
    <input type="date" name="from" class="form-control" placeholder="Desde">
  </div>
  <div class="col-md-4">
    <input type="date" name="to" class="form-control" placeholder="Hasta">
  </div>
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Filtrar</button>
  </div>
</form>

<!-- 📊 Tabla dinámica (ficticia por ahora) -->
<table class="table table-hover">
  <thead class="table-light">
    <tr>
      <th>ID</th>
      <th>Usuario</th>
      <th>Evento</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>1</td><td>admin</td><td>Login</td><td>2025-04-14</td></tr>
    <tr><td>2</td><td>user</td><td>Exportó reporte</td><td>2025-04-14</td></tr>
  </tbody>
</table>

<canvas id="chart3" width="100%" height="40"></canvas>

<?php require '../components/layout_end.php'; ?>
