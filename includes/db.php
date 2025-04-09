<?php
$host = "localhost";
$user = "admin_user";
$pass = "JcND3kcRmoi=";
$db = "marketi8_dashboard";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}
