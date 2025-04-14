<?php

function validate_session_active(mysqli $conn) {
  if (!isset($_SESSION['user']) || !isset($_SESSION['session_id'])) return;

  $username = $_SESSION['user'];
  $session_id = $_SESSION['session_id'];

  $stmt = $conn->prepare("SELECT status FROM login_attempts WHERE username = ? AND session_id = ? ORDER BY created_at DESC LIMIT 1");
  $stmt->bind_param("ss", $username, $session_id);
  $stmt->execute();
  $status = $stmt->get_result()->fetch_assoc()['status'] ?? 'unknown';

  if ($status === 'killed') {
    session_destroy();
    header("Location: /login.php?error=🚫 Tu sesión fue finalizada remotamente");
    exit;
  }
}
