<?php
$page_title = "🧪 Prueba Alertas JS";
require_once __DIR__ . '/../includes/middleware.php';
require_secure_view(['admin', 'user']);
require_once __DIR__ . '/../components/layout_start.php';
?>

<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-vial text-warning"></i>
  <h3 class="text-warning m-0">Test de Alertas JS</h3>
</div>

<div id="alert-container" class="p-2"></div>

<form id="alertForm" class="card shadow-sm p-4 mb-4">
  <div class="mb-3">
    <label for="message" class="form-label"><i class="fas fa-comment-alt"></i> Mensaje</label>
    <input type="text" class="form-control" id="message" placeholder="Escribe un mensaje de alerta..." required>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label"><i class="fas fa-palette"></i> Tipo de alerta</label>
    <select class="form-select" id="type">
      <option value="primary">🔵 Primary</option>
      <option value="success">✅ Success</option>
      <option value="danger">❌ Danger</option>
      <option value="warning">⚠️ Warning</option>
      <option value="info" selected>ℹ️ Info</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="duration" class="form-label"><i class="fas fa-clock"></i> Duración (ms)</label>
    <input type="number" class="form-control" id="duration" value="4000" min="1000" step="500">
  </div>

  <button type="submit" class="btn btn-outline-warning">
    <i class="fas fa-bolt"></i> Lanzar Alerta
  </button>
</form>

<script type="module">
  import { showAlert } from '/assets/js/alertas.js';

  document.getElementById('alertForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const msg = document.getElementById('message').value;
    const type = document.getElementById('type').value;
    const duration = parseInt(document.getElementById('duration').value) || 4000;

    showAlert(msg, type, 'alert-container', duration);
  });
</script>

<?php require_once __DIR__ . '/../components/layout_end.php'; ?>
