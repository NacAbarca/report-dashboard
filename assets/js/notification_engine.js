// /assets/js/notification_engine.js
import { showToast } from './toast.js';
import { showSnackbar } from './snackbar.js';

/**
 * 🚀 Toast Bootstrap con protección de repetición vía sessionStorage
 */
export function notifyFromURLToast() {
  const params = new URLSearchParams(window.location.search);
  getTypes().forEach(type => {
    const raw = params.get(type);
    if (raw) {
      const msg = decodeURIComponent(raw);
      const key = `toast_${type}_${generateHash(msg)}`;
      if (!sessionStorage.getItem(key)) {
        showToast(msg, type);
        sessionStorage.setItem(key, '1');
      }
    }
  });
  clearNotificationParams();
}

/**
 * 📱 Snackbar estilo Material con protección anti-duplicados
 */
export function notifyFromURLSnackbar() {
  const params = new URLSearchParams(window.location.search);
  getTypes().forEach(type => {
    const raw = params.get(type);
    if (raw) {
      const msg = decodeURIComponent(raw);
      const key = `snackbar_${type}_${generateHash(msg)}`;
      if (!sessionStorage.getItem(key)) {
        showSnackbar(msg, type);
        sessionStorage.setItem(key, '1');
      }
    }
  });
  clearNotificationParams();
}

/**
 * 🧼 Elimina parámetros ?success=...&error=... después de mostrar
 */
export function clearNotificationParams(delay = 1000) {
  setTimeout(() => {
    const url = new URL(window.location.href);
    let modified = false;
    getTypes().forEach(type => {
      if (url.searchParams.has(type)) {
        url.searchParams.delete(type);
        modified = true;
      }
    });
    if (modified) {
      window.history.replaceState({}, document.title, url.pathname + url.search);
    }
  }, delay);
}

/**
 * 🧠 Genera un hash simple basado en el contenido del mensaje
 */
function generateHash(str) {
  if (!str) return 0;
  let hash = 0;
  for (let i = 0; i < str.length; i++) {
    hash = ((hash << 5) - hash) + str.charCodeAt(i);
    hash |= 0; // Conviértelo en entero de 32-bit
  }
  return Math.abs(hash);
}

/**
 * 🎨 Tipos de mensajes soportados
 */
function getTypes() {
  return ['success', 'error', 'info', 'danger', 'warning'];
}
