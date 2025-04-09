window.addEventListener("DOMContentLoaded", () => {
    fetch('charts/data_api.php')
      .then(res => res.json())
      .then(data => {
        new Chart(document.getElementById('chart1'), {
          type: 'bar',
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Ventas',
              data: data.values,
              backgroundColor: 'rgba(255, 205, 86, 0.6)',
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
              borderColor: 'rgba(75, 192, 192, 1)',
              fill: false,
            }]
          }
        });
      });
  });
  