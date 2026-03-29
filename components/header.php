<?php
$user = $_SESSION['user'] ?? 'Invitado';
$role = $_SESSION['role'] ?? 'user';

$roleEmoji = [
  'admin'    => '🛡️ Administrador',
  'user'     => '👤 Usuario',
  'analyst'  => '📊 Analista',
][$role] ?? '👥 Usuario';
?>

<nav class="navbar navbar-expand-lg app-shell-nav px-3 px-lg-4 border-bottom">
  <div class="container-fluid">

    <!-- Marca del panel -->
    <span class="navbar-brand app-brand">📊 Panel de Reportes</span>

    <!-- Menú de usuario -->
    <div class="dropdown ms-auto">
      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle app-user-link" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="me-2 fw-medium">
          <?= htmlspecialchars($user) ?>  
        </span>
        <img src="/assets/img/avatar-default.png" alt="avatar" width="32" height="32" class="rounded-circle">
      </a>

      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
        <li class="dropdown-header text-muted small">
          <?= $roleEmoji ?>
        </li>
        <li><a class="dropdown-item" href="/perfil.php">🧑‍💼 Mi perfil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="/logout.php">🚪 Cerrar sesión</a></li>
      </ul>
    </div>

  </div>

  <div class="form-check form-switch app-theme-switch ms-lg-3 me-1">
    <input class="form-check-input" type="checkbox" id="themeSwitch">
    <label class="form-check-label" for="themeSwitch">🌙</label>
  </div>
</nav>
