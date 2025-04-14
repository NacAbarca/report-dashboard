<?php
$page_title = "🧑‍💻 Sesiones Activas";


require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/session_guard.php';
validate_session_active($conn);

require_once __DIR__ . '/includes/middleware.php';
require_secure_view(['admin','user']);


$username = $_SESSION['user'];

// ✅ Mover esto antes del layout para evitar "headers already sent"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kill_id'])) {
  $killId = intval($_POST['kill_id']);
  $stmt = $conn->prepare("UPDATE login_attempts SET status = 'killed' WHERE id = ? AND username = ?");
  $stmt->bind_param("is", $killId, $username);
  $stmt->execute();

  header("Location: perfil_sesiones.php?success=✅ Sesión finalizada correctamente");
  exit;
}

require 'components/layout_start.php';

// 📦 Cargar sesiones del usuario
$stmt = $conn->prepare("SELECT id, ip_address, user_agent, status, session_id, created_at 
                        FROM login_attempts 
                        WHERE username = ? 
                        ORDER BY created_at DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- UI -->
<div class="mb-4 d-flex justify-content-between align-items-center">
  <h3 class="text-primary"><i class="fas fa-history me-2"></i> Sesiones Activas</h3>
  <a href="perfil.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
</div>

<table class="table table-striped">
  <thead class="table-light">
    <tr>
      <th>IP</th>
      <th>User Agent</th>
      <th>Estado</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['ip_address']) ?></td>
        <td><small><?= htmlspecialchars($row['user_agent']) ?></small></td>
        <td>
          <?php if ($row['status'] === 'success'): ?>
            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Activa</span>
          <?php elseif ($row['status'] === 'failed'): ?>
            <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Fallida</span>
          <?php elseif ($row['status'] === 'killed'): ?>
            <span class="badge bg-danger"><i class="fas fa-power-off me-1"></i>Cerrada</span>
          <?php endif; ?>
        </td>
        <td><?= date('Y-m-d H:i', strtotime($row['created_at'])) ?></td>
        <td>
          <?php if ($row['status'] === 'success'): ?>
            <form method="POST" style="display:inline-block">
              <input type="hidden" name="kill_id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn btn-sm btn-danger btn-kill" title="Desconectar sesión">
                <i class="fas fa-power-off"></i>
              </button>
            </form>
            <?php else: ?>
              <span class="text-muted small"><i class="fas fa-lock"></i> Sin acción</span>
            <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php require 'components/layout_end.php'; ?>
