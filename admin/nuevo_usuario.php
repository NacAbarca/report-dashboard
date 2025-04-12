<?php
ob_start(); // 🔐 Evita error de headers si hay salida previa

require '../includes/middleware.php';
require_secure_view('admin');
require '../includes/db.php';

// 🚨 PROCESAR POST ANTES DE CUALQUIER HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $role     = $_POST['role'] ?? 'user';

  if ($username && $password) {
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      header("Location: nuevo_usuario.php?error=⚠️ El usuario ya existe");
      exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hash, $role);

    if ($stmt->execute()) {
      header("Location: usuarios.php?success=✅ Usuario creado correctamente");
    } else {
      header("Location: nuevo_usuario.php?error=❌ Error al guardar el usuario");
    }
    exit;
  } else {
    header("Location: nuevo_usuario.php?error=❌ Todos los campos son obligatorios");
    exit;
  }
}

$page_title = "➕ Nuevo Usuario";
require '../components/layout_start.php';
?>

<!-- CONTENIDO -->
<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-user-plus fa-lg text-primary"></i>
  <h3 class="text-primary m-0">Nuevo Usuario</h3>
</div>

<div id="alert-container"></div>

<form method="POST" class="card shadow-sm p-4">
  <div class="mb-3">
    <label for="username" class="form-label"><i class="fas fa-user me-1"></i>Usuario</label>
    <input type="text" name="username" id="username" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label"><i class="fas fa-lock me-1"></i>Contraseña</label>
    <input type="password" name="password" id="password" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="role" class="form-label"><i class="fas fa-user-shield me-1"></i>Rol</label>
    <select name="role" id="role" class="form-select">
      <option value="user" selected>👤 Usuario</option>
      <option value="admin">👑 Administrador</option>
    </select>
  </div>

  <div class="d-flex justify-content-between">
    <a href="usuarios.php" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Volver
    </a>
    <button type="submit" class="btn btn-success">
      <i class="fas fa-user-plus"></i> Crear Usuario
    </button>
  </div>
</form>

<script type="module">
  import { notifyFromURL } from '/assets/js/notifier.js';

  // ✅ Mostrar automáticamente notificación desde URL (?success=...)
  notifyFromURL('toast'); // o 'alert'
</script>

<?php require '../components/layout_end.php'; ?>
