<?php
$GLOBALS['_startTime'] = microtime(true);
$page_title = "📊 Dashboard";


require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/session_guard.php';
validate_session_active($conn);

require_once __DIR__ . '/includes/middleware.php';
require_secure_view(['admin','user']);
require_once __DIR__ . '/components/layout_start.php';
require_once __DIR__ . '/components/breadcrumb.php';


?>

<!-- CONTENIDO DEL DASHBOARD -->
<div class="container-fluid">

  <!-- Título -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page_title ?></h1>
  </div>

<h1 class="h4 mb-4 text-primary">📊 Panel de Reportes</h1>
<p>Bienvenido, <?= htmlspecialchars($_SESSION['user']) ?>.</p>

<!-- Aquí podrías incluir cards, estadísticas, gráficos, etc -->
 
  <!-- KPIs -->
  <div class="row">
    <!-- KPI: Usuarios activos -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios activos</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">134</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- KPI: Ingresos mensuales -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ingresos Mensuales</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$24,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Puedes seguir agregando más KPIs -->
  </div>
  <div id="alert-container" class="p-3"></div>

  <!-- Gráficos -->
  <div class="row">
    <!-- Ventas -->
    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">📈 Ventas</h6>
        </div>
        <div class="card-body">
          <canvas id="chart1"></canvas>
        </div>
      </div>
    </div>

    <!-- Ingresos -->
    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">📉 Ingresos</h6>
        </div>
        <div class="card-body">
          <canvas id="chart2"></canvas>
        </div>
      </div>
    </div>

    <!-- reportes -->
    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">📉 Reportes</h6>
        </div>
        <div class="card-body">
          <canvas id="chart3"></canvas>
        </div>
      </div>
    </div>

  </div>

</div> <!-- /.container-fluid -->

<!-- Gráficos dinámicos con Chart.js -->
<?php include 'components/layout_end.php'; ?>


