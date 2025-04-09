<?php require 'includes/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php include 'components/header.php'; ?>
  <div class="container mt-5">
    <h1 class="mb-4">📊 Panel de Reportes</h1>
    <div class="row">
      <div class="col-md-6">
        <canvas id="chart1"></canvas>
      </div>
      <div class="col-md-6">
        <canvas id="chart2"></canvas>
      </div>
    </div>
  </div>
  <script src="assets/js/dashboard.js"></script>
</body>
</html>
