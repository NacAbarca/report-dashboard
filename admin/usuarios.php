<?php
$page_title = "Gestión de Usuarios";

require '../includes/db.php';
require_once __DIR__ . '/../includes/session_guard.php';
validate_session_active($conn);

require '../includes/middleware.php';
require_secure_view('admin');
require '../components/layout_start.php';



// 🔄 Obtener usuarios


$result = $conn->query("SELECT id, username, role, created_at FROM users ORDER BY id DESC");
$usuarios = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!-- CONTENIDO INICIO -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="text-primary m-0">
    <i class="fas fa-users-cog me-2"></i> Gestión de Usuarios
  </h3>
  <a href="nuevo_usuario.php" class="btn btn-primary">
    <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
  </a>
</div>

<div id="alert-container"></div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><i class="fas fa-user"></i> Usuario</th>
            <th><i class="fas fa-user-shield"></i> Rol</th>
            <th><i class="fas fa-calendar-alt"></i> Creado</th>
            <th><i class="fas fa-tools"></i> Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($usuarios) > 0): ?>
            <?php foreach ($usuarios as $u): ?>
              <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td>
                  <span class="badge bg-<?= $u['role'] === 'admin' ? 'primary' : 'secondary' ?>">
                    <?= $u['role'] === 'admin' ? '👑 Admin' : '👤 User' ?>
                  </span>
                </td>
                <td><?= $u['created_at'] ?></td>
                <td>
                  <a href="editar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="eliminar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                     onclick="return confirm('¿Eliminar este usuario?')" title="Eliminar">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" class="text-center text-muted">No hay usuarios registrados</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- CONTENIDO FIN -->

<!-- Notificaciones -->
<script type="module">
  import { notifyFromURL } from '/assets/js/notifier.js';

  // ✅ Mostrar automáticamente notificación desde URL (?success=...)
  notifyFromURL('toast'); // o 'alert'
</script>

<?php require '../components/layout_end.php'; ?>
