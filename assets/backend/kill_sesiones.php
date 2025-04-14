<?php
require_once __DIR__ . '/../includes/middleware.php';
require_secure_view(['admin', 'user']); // según quien pueda cerrar sesión
require_once __DIR__ . '/../includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kill_id'])) {
  $killId = intval($_POST['kill_id']);
  $username = $_SESSION['user'] ?? null;

  if ($username) {
    $stmt = $conn->prepare("UPDATE login_attempts SET status = 'killed' WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $killId, $username);

    if ($stmt->execute()) {
      header("Location: /perfil_sesiones.php?success=🛑 Sesión finalizada correctamente");
    } else {
      header("Location: /perfil_sesiones.php?error=❌ Error al cerrar sesión");
    }
    exit;
  }
}

// Fallback si algo está mal
header("Location: /perfil_sesiones.php?error=❌ Acción inválida");
exit;
