document.addEventListener('DOMContentLoaded', () => {
  const switchInput = document.getElementById('themeSwitch');
  const currentTheme = localStorage.getItem('theme') || 'dark';

  // Aplica el tema guardado
  document.body.classList.add(currentTheme + '-mode');
  if (currentTheme === 'light') switchInput.checked = true;

  // Escucha cambios
  switchInput.addEventListener('change', () => {
    if (switchInput.checked) {
      document.body.classList.replace('dark-mode', 'light-mode');
      localStorage.setItem('theme', 'light');
    } else {
      document.body.classList.replace('light-mode', 'dark-mode');
      localStorage.setItem('theme', 'dark');
    }
  });
});


document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar-wrapper');
  const toggleBtn = document.getElementById('sidebarToggle');
  
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('sidebar-open');
      document.body.classList.toggle('sidebar-collapsed');
    });
  }
});
