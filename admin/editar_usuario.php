<?php
$page_title = "✏️ Editar Usuario";

require '../includes/middleware.php';
require_secure_view(['admin']);
require '../includes/db.php';
require '../components/layout_start.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
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

// 🧠 Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $newPass  = trim($_POST['password']);
  $role     = $_POST['role'];

  if ($username && $role) {
    if (!empty($newPass)) {
      $hash = password_hash($newPass, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
      $stmt->bind_param("sssi", $username, $hash, $role, $id);
    } else {
      $stmt = $conn->prepare("UPDATE users SET username=?, role=? WHERE id=?");
      $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
      header("Location: usuarios.php?success=✅ Usuario actualizado correctamente");
      exit;
    } else {
      $msg = "❌ Error al guardar los cambios.";
    }
  } else {
    $msg = "⚠️ Todos los campos son obligatorios.";
  }
}
?>

<!-- CONTENIDO -->
<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-user-edit fa-lg text-warning"></i>
  <h3 class="text-warning m-0">Editar Usuario</h3>
</div>

<?php if ($msg): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<form method="POST" class="card shadow-sm p-4">
  <div class="mb-3">
    <label for="username" class="form-label"><i class="fas fa-user me-1"></i>Usuario</label>
    <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Nueva Contraseña</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="(opcional)">
  </div>

  <div class="mb-3">
    <label for="role" class="form-label"><i class="fas fa-user-shield me-1"></i>Rol</label>
    <select name="role" id="role" class="form-select">
      <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>👤 Usuario</option>
      <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>👑 Administrador</option>
    </select>
  </div>

  <div class="d-flex justify-content-between">
    <a href="usuarios.php" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Cancelar
    </a>
    <button type="submit" class="btn btn-warning">
      <i class="fas fa-save"></i> Guardar Cambios
    </button>
  </div>
</form>

<?php require '../components/layout_end.php'; ?>
