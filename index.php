<?php 
require 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Panel de Reportes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'components/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <!-- Topbar -->
        <?php include 'components/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">📊 Dashboard</h1>
          </div>

          <!-- Content Row (KPI Cards)-->
          <div class="row">

            <!-- Card 1 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
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

            <!-- Card 2 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
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

          </div>

          <!-- Gráficas -->
          <div class="row">
            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">📈 Ventas</h6>
                </div>
                <div class="card-body">
                  <canvas id="chart1"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">📉 Ingresos</h6>
                </div>
                <div class="card-body">
                  <canvas id="chart2"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'components/footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <script src="sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="sbadmin/js/sb-admin-2.min.js"></script>

  <script>
    // Chart integration
    fetch('charts/data_api.php')
      .then(res => res.json())
      .then(data => {
        new Chart(document.getElementById('chart1'), {
          type: 'bar',
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Ventas',
              data: data.values,
              backgroundColor: 'rgba(78, 115, 223, 0.5)'
            }]
          }
        });

        new Chart(document.getElementById('chart2'), {
          type: 'line',
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Ingresos',
              data: data.values,
              borderColor: 'rgba(28, 200, 138, 1)',
              backgroundColor: 'rgba(28, 200, 138, 0.2)',
              fill: true
            }]
          }
        });
      });
  </script>

  <script type="module">
    import { showToast } from './assets/js/toast.js';

    <?php if (!empty($_GET['info'])): ?>
      showToast("<?= addslashes($_GET['info']) ?>", "info");
    <?php endif; ?>

    <?php if (!empty($_GET['success'])): ?>
      showToast("<?= addslashes($_GET['success']) ?>", "success");
    <?php endif; ?>

    <?php if (!empty($_GET['danger'])): ?>
      showToast("<?= addslashes($_GET['danger']) ?>", "danger");
    <?php endif; ?>
  </script>

</body>

</html>
