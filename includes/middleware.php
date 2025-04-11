<?php

if (!function_exists('require_secure_view')) {
  /**
   * 🔒 Protege rutas por rol autorizado (uno o múltiples)
   * @param array|string $roles Roles permitidos: 'user', 'admin', 'alystic', 'costumer'
   */
  function require_secure_view(array|string $roles = 'user') {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    // 🔐 Verifica si hay sesión
    if (!isset($_SESSION['user'])) {
      header("Location: /login.php?error=Debes iniciar sesión para continuar");
      exit;
    }

    // 🔐 Verifica rol permitido
    $userRole = $_SESSION['role'] ?? null;
    $roles = (array) $roles; // fuerza array

    if (!in_array($userRole, $roles)) {
      header("Location: /403.php?error=Acceso denegado para rol: $userRole");
      exit;
    }

    // 🔗 Conexión DB y Layout
    require_once __DIR__ . '/db.php';
    require_once __DIR__ . '/../components/layout.php';
  }
}
