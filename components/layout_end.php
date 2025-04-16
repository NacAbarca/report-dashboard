<?php  include __DIR__ . '/footer.php'; ?>      
          <!-- CONTENIDO DE LA PÁGINA VA AQUÍ -->

        </main>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <script src="/assets/js/dashboard_charts.js" type="module"></script>
    <script src="/assets/js/toast.js" type="module"></script>
    <script src="/assets/js/alertas.js" type="module"></script>
    <script src="/assets/js/notifier.js" type="module"></script>
    <script src="/assets/js/chart.min.js"></script>

    <script type="module">
      import { showAlert } from '/assets/js/alertas.js';
      showAlert('⚠️ Esto es una alerta de prueba', 'warning');
    </script>

    <script type="module">
      import { notifyFromURL } from '/assets/js/notifier.js';
      notifyFromURL('toast'); // o 'alert'
    </script>

  </body>
</html>