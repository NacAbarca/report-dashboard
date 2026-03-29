<?php
require_once __DIR__ . '/db.php';
session_start();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// ✅ Registrar intento de login para auditoría
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$sid = session_id();
$status = ($user && password_verify($password, $user['password'])) ? 'success' : 'fail';
$auditStmt = $conn->prepare(
  "INSERT INTO login_attempts (username, ip_address, user_agent, session_id, status) VALUES (?, ?, ?, ?, ?)"
);
$auditStmt->bind_param("sssss", $username, $ip, $ua, $sid, $status);
$auditStmt->execute();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user']    = $user['username'];
  $_SESSION['role']    = $user['role'];
  $_SESSION['session_id'] = $sid;

  header("Location: /index.php?success=✅ Bienvenido");
  exit;
}

header("Location: /login.php?error=❌ Credenciales inválidas");
exit;
