<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}
require '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: usuarios.php?error=ID inválido");
  exit;
}

// No permitir que se elimine a sí mismo
if ($_SESSION['user'] === $id) {
  header("Location: usuarios.php?error=No puedes eliminar tu propia cuenta");
  exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: usuarios.php?success=Usuario eliminado");
} else {
  header("Location: usuarios.php?error=No se pudo eliminar");
}
exit;
