<?php
ob_start();
$page_title = "👤 Mi Perfil";


require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/session_guard.php';
validate_session_active($conn);

require_once __DIR__ . '/includes/middleware.php';
require_secure_view(['admin','user']);
require 'components/layout_start.php';

// Variables
$userId   = $_SESSION['user_id'];
$username = $_SESSION['user'];
$role     = $_SESSION['role'];
$msg = '';
$type = 'info';

// Obtener datos actuales
$stmt = $conn->prepare("SELECT username, avatar FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$avatar = $data['avatar'] ?? '/assets/img/avatar-default.png';

// Procesar cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newUsername = trim($_POST['username']);
  $newPassword = trim($_POST['password']);
  $avatarPath = $avatar;

  if ($newUsername) {
    if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === 0) {
      $file = $_FILES['avatar'];
      $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

      if (in_array($ext, $allowed)) {
        $newName = 'avatar_' . $userId . '.' . $ext;
        $uploadDir = __DIR__ . '/assets/img/';
        move_uploaded_file($file['tmp_name'], $uploadDir . $newName);
        $avatarPath = '/assets/img/' . $newName;
      }
    }

    if ($newPassword) {
      $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, avatar = ? WHERE id = ?");
      $stmt->bind_param("sssi", $newUsername, $hashed, $avatarPath, $userId);
    } else {
      $stmt = $conn->prepare("UPDATE users SET username = ?, avatar = ? WHERE id = ?");
      $stmt->bind_param("ssi", $newUsername, $avatarPath, $userId);
    }

    if ($stmt->execute()) {
      $_SESSION['user'] = $newUsername;
      header("Location: perfil.php?success=✅ Perfil actualizado correctamente");
      exit;
    } else {
      $msg = "❌ Error al guardar los cambios.";
      $type = 'danger';
    }
  } else {
    $msg = "⚠️ El nombre de usuario es obligatorio.";
    $type = 'warning';
  }
}
?>

<!-- CONTENIDO -->
<div class="mb-4 d-flex justify-content-between align-items-center">
  <h3 class="text-primary"><i class="fas fa-user-circle me-2"></i>Mi Perfil</h3>
  <a href="/index.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
</div>

<div id="alert-container">
  <?php if ($msg): ?>
    <div class="alert alert-<?= $type ?>"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
</div>

<form method="POST" enctype="multipart/form-data" class="card shadow-sm p-4">
  <div class="text-center mb-4">
    <img src="<?= htmlspecialchars($avatar) ?>" alt="avatar" class="rounded-circle border" width="96" height="96">
    <div class="mt-2">
      <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
    </div>
  </div>

  <div class="mb-3">
    <label for="username" class="form-label"><i class="fas fa-user me-1"></i>Usuario</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($data['username']) ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Nueva Contraseña</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="(opcional)">
  </div>

  <div class="mb-3">
    <label class="form-label"><i class="fas fa-user-shield me-1"></i>Rol actual</label>
    <input type="text" class="form-control" value="<?= htmlspecialchars($role) ?>" disabled>
  </div>

  <div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i>Guardar cambios</button>
    <a href="/perfil_sesiones.php" class="btn btn-outline-info"><i class="fas fa-history me-1"></i>Sesiones</a>
  </div>
</form>

<?php require 'components/layout_end.php'; ?>
 <?php ob_end_flush(); ?>