<?php
session_start();
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
    <meta charset="utf-8">
    <title>Iniciar sesión - Panel de Reportes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SB Admin 2 Assets -->
    <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,700" rel="stylesheet">
    <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  </head>

  <body class="bg-gradient-primary">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center mb-4">
                      <h1 class="h4 text-gray-900">🔐 Ingreso al Panel</h1>
                    </div>

                    <!-- Alerts -->
                    <!-- <?php if ($error): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                      </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                      </div>
                    <?php endif; ?> -->

                    <div id="alert-container"></div>

                    <!-- Login Form -->
                    <form method="POST" action="includes/auth.php" class="user">
                      <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user"
                          placeholder="👤 Usuario" required>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                          placeholder="🔑 Contraseña" required>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Acceder
                      </button>
                    </form>

                    <hr>
                    <div class="text-center">
                      <a class="small" href="registrar.php">🆕 Crear una cuenta</a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Scripts -->
    <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Fade auto-hide (opcional) -->

    <script type="module">
      import { showToast } from './assets/js/toast.js';

      <?php if (!empty($_GET['success'])): ?>
        showToast("<?= addslashes($_GET['success']) ?>", "success");
      <?php endif; ?>

      <?php if (!empty($_GET['error'])): ?>
        showToast("<?= addslashes($_GET['error']) ?>", "danger");
      <?php endif; ?>

    </script>

    <script type="module">
      import { showAlert, clearAlertParams } from './assets/js/alertas.js';

      <?php if (!empty($_GET['success'])): ?>
        showAlert("<?= addslashes($_GET['success']) ?>", "success");
      <?php endif; ?>

      <?php if (!empty($_GET['error'])): ?>
        showAlert("<?= addslashes($_GET['error']) ?>", "danger");
      <?php endif; ?>

      clearAlertParams(); // 🧼 limpia ?success, ?error, etc. de la URL
    </script>


    <script type="module">
      import { showNotification, clearNotificationParams } from '../assets/js/notifier.js';

      <?php if (!empty($_GET['success'])): ?>
        showNotification("<?= addslashes($_GET['success']) ?>", { type: "success", mode: "toast" });
      <?php endif; ?>

      <?php if (!empty($_GET['error'])): ?>
        showNotification("<?= addslashes($_GET['error']) ?>", { type: "danger", mode: "toast" });
      <?php endif; ?>

      clearNotificationParams();
    </script>

    <script type="module">
      import { notifyFromURL } from '../assets/js/notifier.js';
      notifyFromURL(); // toast por defecto
    </script>

  </body>
</html>
