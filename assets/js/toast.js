// /assets/js/toast.js

/**
 * ✅ Mostrar notificación tipo Toast con Bootstrap 5
 * @param {string} message - Mensaje a mostrar
 * @param {string} type - Tipo (success, error, info, warning, danger)
 * @param {string} position - Posición del toast (top-right, top-left, etc)
 * @param {number} duration - Duración en milisegundos
 */
export function showToast(message, type = 'info', position = 'top-right', duration = 4000) {
  const positions = {
    'top-left': 'top: 1rem; left: 1rem;',
    'top-right': 'top: 4.5rem; right: 1rem;',
    'bottom-left': 'bottom: 1rem; left: 1rem;',
    'bottom-right': 'bottom: 1rem; right: 1rem;'
  };

  // 📦 Crear contenedor si no existe
  let container = document.querySelector(`#toast-container-${position}`);
  if (!container) {
    container = document.createElement('div');
    container.id = `toast-container-${position}`;
    container.style = `position: fixed; z-index: 9999; ${positions[position] || positions['top-right']}`;
    document.body.appendChild(container);
  }

  // 🧱 Crear Toast dinámico
  const toast = document.createElement('div');
  toast.className = `toast align-items-center text-white bg-${normalizeType(type)} border-0 show mb-2`;
  toast.setAttribute('role', 'alert');
  toast.setAttribute('aria-live', 'assertive');
  toast.setAttribute('aria-atomic', 'true');

  toast.innerHTML = `
    <div class="d-flex">
      <div class="toast-body">${message}</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Cerrar"></button>
    </div>
  `;

  // 🔒 Cierre manual
  toast.querySelector('.btn-close').addEventListener('click', () => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  });

  container.appendChild(toast);

  // ⏱️ Auto-remover
  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  }, duration);
}

/**
 * 🧼 Limpia parámetros de notificación en la URL
 * @param {string[]} params - Lista de parámetros que eliminar
 * @param {number} delay - Milisegundos antes de limpiar
 */
export function clearToastParams(params = ['success', 'error', 'info', 'warning', 'danger'], delay = 1200) {
  setTimeout(() => {
    const url = new URL(window.location.href);
    let modified = false;

    params.forEach(param => {
      if (url.searchParams.has(param)) {
        url.searchParams.delete(param);
        modified = true;
      }
    });

    if (modified) {
      window.history.replaceState({}, document.title, url.pathname + url.search);
    }
  }, delay);
}

/**
 * 🎨 Convierte errores comunes a clases de Bootstrap válidas
 */
function normalizeType(type) {
  if (type === 'error') return 'danger';
  return type;
}
