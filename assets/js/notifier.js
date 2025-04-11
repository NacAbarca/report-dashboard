// /assets/js/notifier.js
import { showToast, clearToastParams } from './toast.js';
import { showAlert, clearAlertParams } from './alertas.js';

/**
 * ✅ Notificación unificada visual (Toast o Alert)
 * @param {string} message - Mensaje a mostrar
 * @param {Object} options
 * @param {string} [options.type='info'] - Tipo de mensaje (success, error, info, danger, warning)
 * @param {string} [options.mode='toast'] - 'toast' o 'alert'
 * @param {string} [options.position='top-right'] - Posición toast (no aplica en alert)
 * @param {string} [options.containerId='alert-container'] - ID del contenedor de alertas
 * @param {number} [options.duration=4000] - Tiempo visible (milisegundos)
 */
export function showNotification(message, {
  type = 'info',
  mode = 'toast',
  position = 'top-right',
  containerId = 'alert-container',
  duration = 4000
} = {}) {
  if (mode === 'alert') {
    showAlert(message, type, containerId, duration);
  } else {
    showToast(message, type, position, duration);
  }
}

/**
 * 🚀 Detecta automáticamente mensajes desde URL (?success=...) y muestra
 * @param {'toast' | 'alert'} mode
 */
export function notifyFromURL(mode = 'toast') {
  const url = new URL(window.location.href);
  const params = url.searchParams;
  const types = ['success', 'error', 'info', 'danger', 'warning'];

  types.forEach(type => {
    const raw = params.get(type);
    if (!raw) return;

    const msg = decodeURIComponent(raw);
    const key = `shown_${mode}_${type}_${hash(msg)}`;

    if (!sessionStorage.getItem(key)) {
      showNotification(msg, { type, mode });
      sessionStorage.setItem(key, '1');
    }
  });

  // Limpieza segura
  if (mode === 'alert') {
    clearAlertParams();
  } else {
    clearToastParams();
  }
}

/**
 * 🧠 Hash simple por contenido
 */
function hash(str) {
  if (!str) return 0;
  let hash = 0;
  for (let i = 0; i < str.length; i++) {
    hash = ((hash << 5) - hash) + str.charCodeAt(i);
    hash |= 0;
  }
  return Math.abs(hash);
}
