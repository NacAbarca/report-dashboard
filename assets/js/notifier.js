// ✅ Notificación unificada: alert o toast
export function showNotification(message, {
  type = 'info',
  mode = 'toast',
  position = 'bottom-right',
  containerId = 'alert-container',
  duration = 4000
} = {}) {
  if (mode === 'alert') {
    const container = document.getElementById(containerId);
    if (!container) return console.error(`❌ Contenedor #${containerId} no encontrado`);
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade`;
    alert.setAttribute('role', 'alert');
    alert.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    `;
    container.appendChild(alert);
    void alert.offsetWidth;
    alert.classList.add('show');
    setTimeout(() => {
      alert.classList.remove('show');
      setTimeout(() => alert.remove(), 300);
    }, duration);
  } else {
    const positions = {
      'top-left': 'top: 1rem; left: 1rem;',
      'top-right': 'top: 1rem; right: 1rem;',
      'bottom-left': 'bottom: 1rem; left: 1rem;',
      'bottom-right': 'bottom: 1rem; right: 1rem;'
    };

    let container = document.querySelector(`#toast-container-${position}`);
    if (!container) {
      container = document.createElement('div');
      container.id = `toast-container-${position}`;
      container.style = `position: fixed; z-index: 9999; ${positions[position]}`;
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast align-items-center bg-${type} text-white border-0 show mb-2`;
    toast.role = 'alert';
    toast.innerHTML = `
      <div class="d-flex">
        <div class="toast-body">${message}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    `;
    container.appendChild(toast);
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    }, duration);
  }
}

// 🧼 Limpia parámetros de notificación
export function clearNotificationParams(params = ['success', 'error', 'warning', 'info'], delay = 1000) {
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

// 🧠 Automáticamente detecta y notifica desde URL
export function notifyFromURL({
  mode = 'toast',
  position = 'bottom-right',
  containerId = 'alert-container',
  duration = 4000
} = {}) {
  const url = new URL(window.location);
  const types = ['success', 'error', 'warning', 'info'];
  let matched = false;

  types.forEach(type => {
    const msg = url.searchParams.get(type);
    if (msg) {
      showNotification(msg, { type, mode, position, containerId, duration });
      matched = true;
    }
  });

  if (matched) clearNotificationParams(types);
}
