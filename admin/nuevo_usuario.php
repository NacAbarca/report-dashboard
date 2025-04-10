<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}
require '../includes/db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $role = $_POST['role'];

  if ($username && $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hash, $role);

    if ($stmt->execute()) {
      header("Location: usuarios.php?success=" . urlencode("Usuario creado correctamente"));
      exit;
    } else {
      $msg = "⚠️ No se pudo registrar. ¿Existe ya ese usuario?";
    }
  } else {
    $msg = "❌ Todos los campos son obligatorios.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nuevo Usuario</title>
  <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">➕ Registrar nuevo usuario</h2>

    <?php if ($msg): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="nuevo_usuario.php">
      <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Rol</label>
        <select name="role" class="form-select" required>
          <option value="user">Usuario</option>
          <option value="admin">Administrador</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Registrar</button>
      <a href="usuarios.php" class="btn btn-secondary">Volver</a>
    </form>
  </div>

  <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
