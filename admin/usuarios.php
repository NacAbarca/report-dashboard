<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit;
}
require '../includes/db.php';

// Obtener usuarios
$usuarios = $conn->query("SELECT id, username, role, created_at FROM users ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
  <link href="/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include '../components/sidebar.php'; ?>
    <!-- End Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include '../components/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">👥 Gestión de Usuarios</h1>
            <a href="nuevo_usuario.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Nuevo Usuario</a>
          </div>

          <!-- Tabla -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Usuario</th>
                      <th>Rol</th>
                      <th>Creado</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($usuarios as $u): ?>
                    <tr>
                      <td><?= $u['id'] ?></td>
                      <td><?= htmlspecialchars($u['username']) ?></td>
                      <td><span class="badge bg-info"><?= $u['role'] ?? 'user' ?></span></td>
                      <td><?= $u['created_at'] ?></td>
                      <td>
                        <a href="editar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="eliminar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include '../components/footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <script type="module">
    import { showToast, clearToastParams } from '../assets/js/toast.js';

    <?php if (!empty($_GET['success'])): ?>
      showToast("<?= addslashes($_GET['success']) ?>", "success");
    <?php endif; ?>

    <?php if (!empty($_GET['error'])): ?>
      showToast("<?= addslashes($_GET['error']) ?>", "danger");
    <?php endif; ?>

    clearToastParams(); // 🧼 limpia ?success y ?error de la barra
  </script>


  <!-- Scripts -->
  <script src="/sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/sbadmin/js/sb-admin-2.min.js"></script>

</body>
</html>
