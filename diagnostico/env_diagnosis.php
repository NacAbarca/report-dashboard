<?php
$page_title = "🔎 Diagnostico de sistema";

require '../includes/middleware.php';
require_secure_view(['admin']);
require '../includes/db.php';
require '../components/layout_start.php';



echo "<pre>";
// CONFIGURACIÓN

ob_start(); // evita warning por headers
require '../diagnostico/env_api.php'; // funciones

$diagnosis = run_full_diagnostic();

foreach ($diagnosis as $label => $status) {
  $emoji = $status['ok'] ? '✅' : '❌';
  echo "<p>$emoji <strong>{$status['label']}:</strong> {$status['message']}</p>";
}

echo "</pre>";

require '../components/layout_end.php';
