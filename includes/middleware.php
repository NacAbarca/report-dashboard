<?php

if (!function_exists('require_secure_view')) {
  function require_secure_view(array|string $roles = 'user') {
    if (session_status() === PHP_SESSION_NONE) session_start();

    // 🔒 Protege sesión
    if (!isset($_SESSION['user'])) {
      header("Location: /login.php?error=Debes iniciar sesión");
      exit;
    }

    $userRole = $_SESSION['role'] ?? null;
    $roles = (array) $roles;

    if (!in_array($userRole, $roles)) {
      header("Location: /403.php?error=Acceso denegado");
      exit;
    }

    require_once __DIR__ . '/db.php';
    // El layout ya se carga desde layout_start, por eso comentado:
    // require_once __DIR__ . '/../components/layout.php';
  }
}
