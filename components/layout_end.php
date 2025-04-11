          <!-- CONTENIDO DE LA PÁGINA VA AQUÍ -->

        </main>
      </div>
    </div>

    <script type="module">
      import {
        notifyFromURLToast,
        notifyFromURLSnackbar
      } 
      from '/assets/js/notification_engine.js';

      notifyFromURLToast(); // activa si usas mensajes tipo toast
    </script>

    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="/assets/js/perfil_sesiones.js"></script>
    <script src="/assets/js/chart.min.js"></script>   

  </body>
</html>