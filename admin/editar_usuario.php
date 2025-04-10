<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}
require '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: usuarios.php?error=ID inválido");
  exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
  header("Location: usuarios.php?error=Usuario no encontrado");
  exit;
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $role = $_POST['role'];
  $newPass = trim($_POST['password']);

  if ($username && $role) {
    if ($newPass) {
      $passHash = password_hash($newPass, PASSWORD_DEFAULT);
      $update = $conn->prepare("UPDATE users SET username=?, role=?, password=? WHERE id=?");
      $update->bind_param("sssi", $username, $role, $passHash, $id);
    } else {
      $update = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
      $update->bind_param("ssi", $username, $role, $id);
    }

    if ($update->execute()) {
      header("Location: usuarios.php?success=Usuario actualizado");
      exit;
    } else {
      $msg = "❌ Error al actualizar usuario.";
    }
  } else {
    $msg = "⚠️ Campos obligatorios faltantes.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
  <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>✏️ Editar Usuario</h2>

    <?php if ($msg): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Usuario</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
      </div>

      <div class="mb-3">
        <label>Nueva contraseña <small>(dejar en blanco para no cambiar)</small></label>
        <input type="password" name="password" class="form-control">
      </div>

      <div class="mb-3">
        <label>Rol</label>
        <select name="role" class="form-select">
          <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Usuario</option>
          <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
        </select>
      </div>

      <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Guardar cambios</button>
      <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>
