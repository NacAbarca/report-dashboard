<?php
$host = "66.45.23.20";
$user = "marketi8_admin_user";
$pass = "JcND3kcRmoi=";
$db = "marketi8_dashboard";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("❌ Conexión fallida: " . $conn->connect_error);
}

// Mejorar con mysqli_report para detectar errores fácilmente
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
