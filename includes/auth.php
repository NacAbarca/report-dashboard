<?php
require_once __DIR__ . '/db.php';
session_start();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user']    = $user['username'];
  $_SESSION['role']    = $user['role'];
  $_SESSION['session_id'] = session_id();

  // ✅ Guardar login en login_attempts
  $ip = $_SERVER['REMOTE_ADDR'];
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $sid = session_id();
  $status = 'success';
  $stmt = $conn->prepare("INSERT INTO login_attempts (username, ip_address, user_agent, session_id, status) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $username, $ip, $ua, $sid, $status);
  $stmt->execute();

  header("Location: /index.php?success=✅ Bienvenido");
  exit;
}

header("Location: /login.php?error=❌ Credenciales inválidas");
exit;
