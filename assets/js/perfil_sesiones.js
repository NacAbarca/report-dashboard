document.querySelectorAll('.btn-kill').forEach(btn => {
    btn.addEventListener('click', e => {
      if (!confirm("¿Cerrar esta sesión remotamente?")) e.preventDefault();
    });
  });