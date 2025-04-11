<?php

function run_full_diagnostic(): array {
  return [
    'auth' => check_session(),
    'mysql' => check_mysql_connection(),
    'insert' => test_mysql_insert(),
    'layout_start' => check_file('../components/layout_start.php'),
    'layout_end' => check_file('../components/layout_end.php'),
    'toast_js' => check_file('../assets/js/toast.js'),
    'snackbar_js' => check_file('../assets/js/snackbar.js'),
    'notification_engine_js' => check_file('../assets/js/notification_engine.js'),
    'csp_js' => check_csp_safety()
  ];
}

function check_session(): array {
  if (session_status() === PHP_SESSION_NONE) session_start();
  $user = $_SESSION['user'] ?? null;
  $role = $_SESSION['role'] ?? null;
  return [
    'label' => 'Sesión activa',
    'ok' => $user !== null,
    'message' => $user ? "Usuario autenticado como: $user (rol: $role)" : 'No autenticado'
  ];
}

function check_mysql_connection(): array {
  require_once '../includes/db.php';
  global $conn;
  return [
    'label' => 'Conexión MySQL',
    'ok' => $conn && $conn->ping(),
    'message' => $conn ? 'Conexión exitosa a MySQL' : 'Error de conexión'
  ];
}

function test_mysql_insert(): array {
  global $conn;
  $sql = "INSERT INTO login_attempts (username, status, ip_address, user_agent, session_id) VALUES ('diagnostico', 'success', '::1', 'test-agent', 'diag123')";
  $ok = $conn->query($sql);
  return [
    'label' => 'Inserción de prueba',
    'ok' => $ok,
    'message' => $ok ? 'Inserción de test completada' : 'Error de test'
  ];
}

function check_file(string $path): array {
  return [
    'label' => "Archivo $path",
    'ok' => file_exists($path),
    'message' => file_exists($path) ? "OK: $path" : "No encontrado: $path"
  ];
}

function check_csp_safety(): array {
  $unsafe = false;

  $js_files = [
    '../assets/js/toast.js',
    '../assets/js/snackbar.js',
    '../assets/js/notification_engine.js'
  ];

  foreach ($js_files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    if (preg_match('/eval\(|new Function\(/', $content)) {
      $unsafe = true;
      break;
    }
  }

  return [
    'label' => 'Revisión CSP: JS',
    'ok' => !$unsafe,
    'message' => !$unsafe
      ? '✔️ Verifica que no estés usando eval(), new Function() o scripts inline'
      : '❌ eval() o Function detectados en JS'
  ];
}
