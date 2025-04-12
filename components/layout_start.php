<?php
  
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}

// 💡 Título de la página
$page_title = $page_title ?? 'Panel de Reportes';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
  <link href="/assets/css/custom.css" rel="stylesheet">
  <link href="/assets/css/snackbar.css" rel="stylesheet">
</head>

<body class="bg-light">

  <!-- 🔲 Estructura general -->
  <div class="d-flex" id="wrapper">

    <!-- 📚 Menú lateral -->
    <?php include 'sidebar.php'; ?>

    <!-- 🧱 Contenido principal -->
    <div id="page-content-wrapper" class="w-100">

      <?php include 'header.php'; ?>

      <!-- 💡 Área de contenido dinámico -->
      <main class="container-fluid py-4">
