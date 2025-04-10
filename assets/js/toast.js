// ✅ TOAST: Mostrar mensaje flotante Bootstrap 5
export function showToast(message, type = 'info', position = 'bottom-right', duration = 4000) {
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
    container.style = `position: fixed; z-index: 9999; ${positions[position] || positions['bottom-right']}`;
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

// 🧼 Limpiar parámetros de la URL después del toast
export function clearToastParams(params = ['success', 'error'], delay = 1000) {
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
