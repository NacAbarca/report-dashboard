<?php

$page_title = "🗑️ Eliminar Usuario";

require '../includes/middleware.php';
require_secure_view('admin');
require '../includes/db.php';
require '../components/layout_start.php';

// 🔐 Validación ID
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
  header("Location: usuarios.php?error=❌ ID inválido");
  exit;
}

// 🔥 Intentar eliminar usuario
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: usuarios.php?success=🗑️ Usuario eliminado correctamente");
} else {
  header("Location: usuarios.php?error=❌ No se pudo eliminar el usuario");
}
exit;
