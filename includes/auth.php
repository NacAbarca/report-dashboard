<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$sessionId = session_id();

// Buscar usuario
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Validar
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['user_id'] = $user['id'];
    
    // Registrar intento exitoso
    $status = 'success';
    $log = $conn->prepare("INSERT INTO login_attempts (username, ip_address, user_agent, status, session_id) VALUES (?, ?, ?, ?, ?)");
    $log->bind_param("sssss", $username, $ip, $agent, $status, $sessionId);
    $log->execute();

    // Notificación opcional
    // $whitelisted_ips = ['127.0.0.1']; // Ejemplo
    // if (!in_array($ip, $whitelisted_ips)) {
    //   mail($user['email'], "🚨 Nuevo acceso detectado", "IP: $ip\nNavegador: $agent");
    // }

    header("Location: ../index.php");
    exit;
} else {
    // Fallido
    $status = 'failed';
    $log = $conn->prepare("INSERT INTO login_attempts (username, ip_address, user_agent, status, session_id) VALUES (?, ?, ?, ?, ?)");
    $log->bind_param("sssss", $username, $ip, $agent, $status, $sessionId);
    $log->execute();

    header("Location: ../login.php?error=Credenciales incorrectas");
    exit;
}
