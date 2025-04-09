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
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <form method="POST" action="includes/auth.php" class="p-4 bg-secondary rounded shadow w-100" style="max-width:400px;">
      <h2 class="mb-4 text-center">🔐 Acceso Dashboard</h2>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <div class="mb-3">
        <label>Usuario</label>
        <input type="text" name="username" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-warning w-100">Ingresar</button>
    </form>
  </div>
</body>
</html>
