<?php
$page_title = "🧪 Test Notificaciones";
require_once __DIR__ . '/../includes/middleware.php';
require_secure_view(['admin', 'user']);
require_once __DIR__ . '/../components/layout_start.php';
?>

<div class="mb-4 d-flex align-items-center gap-2">
  <i class="fas fa-bell text-info"></i>
  <h3 class="text-info m-0">Prueba de Alertas y Toasts</h3>
</div>

<div id="alert-container" class="mb-4"></div>

<form id="notifForm" class="card shadow-sm p-4">
  <div class="mb-3">
    <label for="message" class="form-label">📝 Mensaje</label>
    <input type="text" class="form-control" id="message" placeholder="Ej: Proceso finalizado correctamente" required>
  </div>

  <div class="mb-3">
    <label for="type" class="form-label">🎨 Tipo</label>
    <select class="form-select" id="type">
      <option value="success">✅ Success</option>
      <option value="danger">❌ Danger</option>
      <option value="warning">⚠️ Warning</option>
      <option value="info" selected>ℹ️ Info</option>
      <option value="primary">🔵 Primary</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="mode" class="form-label">💡 Modo</label>
    <select class="form-select" id="mode">
      <option value="alert" selected>🔔 Alerta (alertas.js)</option>
      <option value="toast">🍞 Toast (toast.js)</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="duration" class="form-label">⏱️ Duración (ms)</label>
    <input type="number" class="form-control" id="duration" value="4000" min="1000">
  </div>

  <button type="submit" class="btn btn-outline-primary">
    <i class="fas fa-play"></i> Probar Notificación
  </button>
</form>

<script type="module">
  import { showAlert } from '/assets/js/alertas.js';
  import { showToast } from '/assets/js/toast.js';

  document.getElementById('notifForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const msg = document.getElementById('message').value;
    const type = document.getElementById('type').value;
    const mode = document.getElementById('mode').value;
    const duration = parseInt(document.getElementById('duration').value) || 4000;

    if (mode === 'toast') {
      showToast(msg, type, 'top-right', duration);
    } else {
      showAlert(msg, type, 'alert-container', duration);
    }
  });
</script>

<?php require_once __DIR__ . '/../components/layout_end.php'; ?>
