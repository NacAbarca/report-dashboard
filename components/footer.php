<?php
// ⏱️ Tiempo de render opcional
$startTime = $GLOBALS['_startTime'] ?? null;
$renderTime = $startTime ? round(microtime(true) - $startTime, 3) : null;

// 👤 Usuario conectado
$user = $_SESSION['user'] ?? null;
$role = $_SESSION['role'] ?? null;

// 🔌 Estado de sesión
$estado = $user
  ? '<i class="fas fa-circle text-success me-1"></i> Sesión activa: <strong>' . htmlspecialchars($user) . '</strong>'
  : '<i class="fas fa-circle text-danger me-1"></i> Sesión cerrada';
?>

<footer class="footer app-footer mt-auto py-3 border-top">
  <div class="container text-center small text-muted">
    <div class="mb-1">
      <?= $estado ?>
      <?php if ($role): ?>
        <span class="ms-2 badge bg-secondary"><i class="fas fa-user-tag me-1"></i><?= htmlspecialchars($role) ?></span>
      <?php endif; ?>
    </div>
    <div>
      &copy; <?= date('Y') ?> Panel de Reportes — <i class="fas fa-code"></i> by 
      <a href="https://github.com/NacAbarca" target="_blank" rel="noopener">Nac Abarca</a>
    </div>
    <div>
      <i class="fas fa-rocket me-1"></i> v1.0.0
      <?php if ($renderTime): ?>
        · <i class="fas fa-clock me-1"></i><?= $renderTime ?>s
      <?php endif; ?>
    </div>
  </div>
</footer>
