// /assets/js/snackbar.js
export function showSnackbar(message, type = 'info', duration = 4000) {
  // ❌ Remueve snackbar activo si existe (solo 1 activo)
  const existing = document.querySelector('.snackbar-container');
  if (existing) existing.remove();

  // 📦 Crear elemento snackbar
  const snackbar = document.createElement('div');
  snackbar.className = `snackbar-container snackbar-${type}`;
  snackbar.innerHTML = `
    <div class="snackbar-message">
      ${getIcon(type)} ${message}
    </div>
    <button class="snackbar-close" aria-label="Cerrar">&times;</button>
  `;

  // Cierre manual
  snackbar.querySelector('.snackbar-close').addEventListener('click', () => {
    snackbar.classList.remove('show');
    setTimeout(() => snackbar.remove(), 300);
  });

  // Inyectar y mostrar
  document.body.appendChild(snackbar);
  requestAnimationFrame(() => snackbar.classList.add('show'));

  // 🕒 Auto-remover
  setTimeout(() => {
    snackbar.classList.remove('show');
    setTimeout(() => snackbar.remove(), 500);
  }, duration);
}

// 🎨 Iconos por tipo
function getIcon(type) {
  switch (type) {
    case 'success': return '✅';
    case 'error':
    case 'danger': return '❌';
    case 'warning': return '⚠️';
    case 'info': return 'ℹ️';
    default: return '';
  }
}
