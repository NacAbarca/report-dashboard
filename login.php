<?php

// 🔒 Evita entrar si ya está logueado
if (isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

$error = $_GET['error'] ?? '';
$success = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - Panel de Reportes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="/assets/css/custom.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <h4 class="text-primary">🔐 Acceso al Panel</h4>
            </div>

            <!-- 🔔 Alertas -->
            <div id="alert-container"></div>

            <form method="POST" action="includes/auth.php" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="username" class="form-label">👤 Usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">🔑 Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Acceder</button>
            </form>

            <div class="text-center mt-3">
              <a href="registrar.php" class="small">🆕 Crear cuenta</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  <script type="module">
    import { notifyFromURL } from './assets/js/notifier.js';
    notifyFromURL({ mode: 'alert', containerId: 'alert-container' });
  </script>
</body>
</html>
