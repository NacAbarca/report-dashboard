<?php
$page_title = "📍 Sesiones Activas";

require 'includes/middleware.php';
require_secure_view('user');
require 'includes/db.php';
require 'components/layout_start.php';

$username = $_SESSION['user'];
$current_session = session_id();

// 🔒 Finalizar sesión remota
if (isset($_GET['kill']) && $_GET['kill'] !== $current_session) {
  $sid = $_GET['kill'];
  $stmt = $conn->prepare("DELETE FROM login_attempts WHERE session_id = ? AND username = ?");
  $stmt->bind_param("ss", $sid, $username);
  $stmt->execute();
  header("Location: perfil_sesiones.php?success=✅ Sesión finalizada correctamente");
  exit;
}

// 🔍 Obtener sesiones activas del usuario
$stmt = $conn->prepare("
  SELECT ip_address, user_agent, session_id, created_at 
  FROM login_attempts 
  WHERE username = ? AND status = 'success' 
  ORDER BY created_at DESC
");
$stmt->bind_param("s", $username);
$stmt->execute();
$sessions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!-- CONTENIDO -->
<div class="mb-4 d-flex justify-content-between align-items-center">
  <h3 class="text-primary"><i class="fas fa-map-marker-alt me-2"></i>Sesiones Activas</h3>
  <a href="/perfil.php" class="btn btn-sm btn-outline-secondary">
    <i class="fas fa-arrow-left me-1"></i> Volver
  </a>
</div>

<div id="alert-container"></div>

<div class="card shadow-sm">
  <div class="card-body table-responsive">
    <table class="table table-hover table-sm align-middle">
      <thead class="table-dark">
        <tr>
          <th><i class="fas fa-clock"></i> Fecha</th>
          <th><i class="fas fa-globe"></i> IP</th>
          <th><i class="fas fa-desktop"></i> Navegador</th>
          <th><i class="fas fa-key"></i> ID Sesión</th>
          <th><i class="fas fa-power-off"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sessions as $s): ?>
          <tr class="<?= $s['session_id'] === $current_session ? 'table-success' : '' ?>">
            <td><?= $s['created_at'] ?></td>
            <td><code><?= $s['ip_address'] ?></code></td>
            <td><small><?= substr($s['user_agent'], 0, 60) ?>...</small></td>
            <td><code><?= substr($s['session_id'], 0, 10) ?>...</code></td>
            <td>
              <?php if ($s['session_id'] !== $current_session): ?>
                <a href="?kill=<?= $s['session_id'] ?>" class="btn btn-sm btn-outline-danger btn-kill" title="Cerrar sesión">
                  <i class="fas fa-sign-out-alt"></i>
                </a>
              <?php else: ?>
                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Actual</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script type="module">
  import {
    notifyFromURLToast,
    notifyFromURLSnackbar
  } from '/assets/js/notification_engine.js';

  // Puedes usar solo uno o ambos
  notifyFromURLToast();      // Para Bootstrap toast
  notifyFromURLSnackbar();   // Para snackbars tipo Material
</script>


<script src="/assets/js/perfil_sesiones.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.btn-kill').forEach(btn => {
    btn.addEventListener('click', e => {
      if (!confirm("¿Cerrar esta sesión remotamente?")) {
        e.preventDefault();
      }
    });
  });
});
</script>

<?php require 'components/layout_end.php'; ?>
