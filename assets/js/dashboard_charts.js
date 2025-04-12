// dashboard_charts.js
import Chart from '/assets/js/chart.min.js';

fetch('/charts/data_api.php')
  .then(res => res.json())
  .then(data => {
    new Chart(document.getElementById('chart1'), {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Ventas',
          data: data.values,
          backgroundColor: 'rgba(78, 115, 223, 0.5)'
        }]
      }
    });

    new Chart(document.getElementById('chart2'), {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Ingresos',
          data: data.values,
          borderColor: 'rgba(28, 200, 138, 1)',
          backgroundColor: 'rgba(28, 200, 138, 0.2)',
          fill: true
        }]
      }
    });
  });
