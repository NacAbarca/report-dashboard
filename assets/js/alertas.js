// ✅ ALERTA Bootstrap con fade (clásica)
export function showAlert(message, type = 'danger', containerId = 'alert-container', duration = 4000) {
  const container = document.getElementById(containerId);
  if (!container) return console.error(`❌ Contenedor de alerta no encontrado: #${containerId}`);

  const alert = document.createElement('div');
  alert.className = `alert alert-${type} alert-dismissible fade`;
  alert.setAttribute('role', 'alert');
  alert.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  `;
  container.appendChild(alert);
  void alert.offsetWidth; // ⚡ Trigger animación
  alert.classList.add('show');

  setTimeout(() => {
    alert.classList.remove('show');
    setTimeout(() => alert.remove(), 300);
  }, duration);
}

// 🧼 Limpiar parámetros después de mostrar alertas
export function clearAlertParams(params = ['success', 'error', 'warning', 'info'], delay = 1000) {
  setTimeout(() => {
    const url = new URL(window.location);
    let changed = false;

    params.forEach(p => {
      if (url.searchParams.has(p)) {
        url.searchParams.delete(p);
        changed = true;
      }
    });

    if (changed) {
      window.history.replaceState({}, document.title, url.pathname);
    }
  }, delay);
}
