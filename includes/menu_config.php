<?php
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
  [
    'separator' => 'Administración',
    'roles' => ['admin']
  ],
  [
    'title' => '📑 Reportes (Admin)',
    'url' => '/admin/reportes.php',
    'icon' => 'fas fa-bug',
    'roles' => ['admin']
  ],
  [
    'title' => 'Usuarios (Admin)',
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
