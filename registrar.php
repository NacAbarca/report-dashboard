<?php
require 'includes/db.php';
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if ($username && $password && $confirm) {
        if ($password !== $confirm) {
            $error = "❌ Las contraseñas no coinciden.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);

            if ($stmt->execute()) {
                header("Location: login.php?msg=" . urlencode("✅ Usuario registrado exitosamente"));
                exit;
            } else {
                $error = "⚠️ Error: usuario ya existe o fallo en la base de datos.";
            }
        }
    } else {
        $error = "❌ Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Registrar cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
    <link href="sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  </head>

  <body class="bg-gradient-primary">

    <div class="container">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Crear Cuenta Nueva</h1>
                </div>

                <!-- Alerts -->
                <div id="alert-container"></div>
                <!-- Alerts -->

                <form class="user" method="POST" action="register.php">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="username" placeholder="Nombre de usuario" required>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" name="confirm_password" placeholder="Confirmar contraseña" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">Registrar</button>
                </form>

                <hr>
                <div class="text-center">
                  <a class="small" href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/sbadmin/js/sb-admin-2.min.js"></script>

    <script type="module">
      import { showToast, clearToastParams } from '../assets/js/toast.js';

      <?php if (!empty($_GET['success'])): ?>
        showToast("<?= addslashes($_GET['success']) ?>", "success");
      <?php endif; ?>

      <?php if (!empty($_GET['error'])): ?>
        showToast("<?= addslashes($_GET['error']) ?>", "danger");
      <?php endif; ?>

      clearToastParams(); // 🧼 limpia ?success y ?error de la barra
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
      import { notifyFromURL } from '../assets/js/notifier.js';
      notifyFromURL(); // toast por defecto
    </script>
  </body>
</html>
