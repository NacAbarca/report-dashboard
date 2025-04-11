<?php
$page_title = "📊 Auditoría de Accesos";

require '../includes/middleware.php';
require_secure_view(['user','admin', 'invitado']);
require '../includes/db.php';
require '../components/layout_start.php';

// 🔍 Obtener últimos intentos de login
$result = $conn->query("SELECT * FROM login_attempts ORDER BY created_at DESC LIMIT 100");
$logs = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<div class="mb-4 d-flex justify-content-between align-items-center">
  <h3 class="text-primary m-0"><i class="fas fa-shield-alt me-2"></i>Auditoría de Logins</h3>
  <a href="/admin/usuarios.php" class="btn btn-outline-secondary btn-sm">
    <i class="fas fa-arrow-left"></i> Volver
  </a>
</div>

<div id="alert-container"></div>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-sm align-middle">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><i class="fas fa-user"></i> Usuario</th>
            <th><i class="fas fa-globe"></i> IP</th>
            <th><i class="fas fa-desktop"></i> Navegador</th>
            <th><i class="fas fa-shield-alt"></i> Estado</th>
            <th><i class="fas fa-clock"></i> Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($logs): ?>
            <?php foreach ($logs as $i => $log): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($log['username'] ?? '—') ?></td>
                <td><code><?= $log['ip_address'] ?></code></td>
                <td><small><?= substr($log['user_agent'], 0, 45) ?>...</small></td>
                <td>
                  <span class="badge bg-<?= $log['status'] === 'success' ? 'success' : 'danger' ?>">
                    <?= strtoupper($log['status']) ?>
                  </span>
                </td>
                <td><?= $log['created_at'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="6" class="text-center text-muted">Sin registros aún.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require '../components/layout_end.php'; ?>
