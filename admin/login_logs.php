<?php
$page_title = "📊 Auditoría de Accesos";


require '../includes/db.php';
require_once __DIR__ . '/../includes/session_guard.php';
validate_session_active($conn);

require '../includes/middleware.php';
require_secure_view('admin');
require '../components/layout_start.php';


// 🔍 Obtener últimos intentos de login
$result = $conn->query("SELECT * FROM login_attempts ORDER BY created_at DESC LIMIT 100");
$logs = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

?>

<div class="app-panel-header">
  <div class="app-panel-header-inner">
    <h3 class="app-section-title m-0"><i class="fas fa-shield-alt me-2"></i>Auditoría de Logins</h3>
    <p class="app-panel-subtitle">Revisa intentos recientes con estado, origen e información de navegador sin perder contraste en tema oscuro o claro.</p>
  </div>
  <a href="/admin/usuarios.php" class="btn btn-outline-secondary btn-sm">
    <i class="fas fa-arrow-left"></i> Volver
  </a>
</div>

<div id="alert-container"></div>

<div class="card shadow-sm app-table-card">
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
                <td><code class="app-code"><?= htmlspecialchars($log['ip_address'] ?? '—') ?></code></td>
                <td><small><?= htmlspecialchars(mb_strimwidth($log['user_agent'] ?? '—', 0, 72, '...')) ?></small></td>
                <td>
                  <?php
                    $badgeClass = match ($log['status']) {
                      'success' => 'success',
                      'killed' => 'warning',
                      default => 'danger',
                    };
                  ?>
                  <span class="badge bg-<?= $badgeClass ?>">
                    <?= strtoupper($log['status']) ?>
                  </span>
                </td>
                <td><?= $log['created_at'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="6" class="empty-state">Sin registros aún.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require '../components/layout_end.php'; ?>
