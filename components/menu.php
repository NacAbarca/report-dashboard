<?php

$role = $_SESSION['role'] ?? 'user';
$current_url = $_SERVER['PHP_SELF'];

$menu = [
  [
    'title' => 'Dashboard',
    'url' => '/index.php',
    'icon' => 'fas fa-home',
    'roles' => ['admin', 'user']
  ],
  [
    'title' => 'Gestion de usuarios',
    'url' => '/admin/usuarios.php',
    'icon' => 'fas fa-users-cog',
    'roles' => ['admin', 'user']
  ],
  [
    'title' => 'Mi perfil',
    'url' => '/perfil.php',
    'icon' => 'fas fa-user-circle',
    'roles' => ['admin', 'user']
  ],
  [
    'title' => 'Sesiones',
    'url' => '/perfil_sesiones.php',
    'icon' => 'fas fa-history',
    'roles' => ['admin', 'user']
  ],
  // ADMIN ONLY
  [
    'separator' => 'Administración',
    'roles' => ['admin']
  ],
  [
    'title' => '📑 Reportes',
    'url' => '/admin/reportes.php',
    'icon' => 'fas fa-bug',
    'roles' => ['admin']
  ],
  [
    'title' => 'Usuarios',
    'url' => '/admin/usuarios.php',
    'icon' => 'fas fa-users',
    'roles' => ['admin']
  ],
  [
    'title' => 'Auditoría Accesos',
    'url' => '/admin/login_logs.php',
    'icon' => 'fas fa-shield-alt',
    'roles' => ['admin']
  ],
  [
    'separator' => 'Diagnóstico',
    'roles' => ['admin']
  ],
  [
    'title' => 'Diagnóstico de sistema',
    'url' => '/diagnostico/env_diagnosis.php',
    'icon' => 'fas fa-tools',
    'roles' => ['admin']
  ],
  [
    'separator' => 'Cuenta',
    'roles' => ['admin', 'user']
  ],
  [
    'title' => 'Salir',
    'url' => '/logout.php',
    'icon' => 'fas fa-sign-out-alt',
    'roles' => ['admin', 'user']
  ]

];
?>

<ul class="nav flex-column">

  <?php foreach ($menu as $item): ?>
    <?php if (isset($item['separator']) && in_array($role, $item['roles'])): ?>

      <li class="nav-item mt-3 mb-1 text-info small text-uppercase">
        <?= $item['separator'] ?>
      </li>

    <?php elseif (in_array($role, $item['roles'])): ?>
      <?php $active = (strpos($current_url, $item['url']) !== false) ? 'active fw-bold text-info' : 'text-white'; ?>

      <li class="nav-item mb-2">
        <a class="nav-link <?= $active ?>" href="<?= $item['url'] ?>">
          <i class="<?= $item['icon'] ?>"></i>
          <span class="ms-2"><?= $item['title'] ?></span>
        </a>
      </li>

    <?php endif; ?>
  <?php endforeach; ?>

</ul>
