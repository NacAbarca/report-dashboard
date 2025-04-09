<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1e1e2f, #2d2f7f);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      background: #fff;
      padding: 2.5rem;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 420px;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-primary {
      border-radius: 8px;
      background-color: #2d2f7f;
      border: none;
    }
    .btn-primary:hover {
      background-color: #4b4dd8;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h3 class="text-center mb-4 text-dark">🔐 Ingreso al Panel</h3>

    <?php if ($error): ?>
      <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="includes/auth.php">
      <div class="mb-3">
        <label for="username" class="form-label">👤 Usuario</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">🔑 Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>

      <button type="submit" class="btn btn-primary w-100">Acceder</button>
    </form>
  </div>

</body>
</html>
