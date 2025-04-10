<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $page_title ?? 'Panel' ?></title>
  <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">
  <?php include 'sidebar.php'; ?>

  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <?php include 'header.php'; ?>
      <div class="container-fluid">

      </div> <!-- /.container-fluid -->
    </div> <!-- End of content -->
    <?php include 'footer.php'; ?>
  </div> <!-- End of content-wrapper -->
</div> <!-- End of wrapper -->

<script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
<script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/sbadmin/js/sb-admin-2.min.js"></script>
</body>
</html>