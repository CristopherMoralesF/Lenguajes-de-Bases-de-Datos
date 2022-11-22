window.onload = loadClassAssetResume();
window.onload = modelAssetIndResume();

//Complete the information related to the indicators
function modelAssetIndResume() {
  $.ajax({
    type: 'GET',
    url: '../controller/controller_activo.php',
    data: {
      'AssetIndResume': 'AssetIndResume'
    }, success: function (data) {

      let indicatorsList = $.parseJSON(data);
      document.getElementById('txtTotalAssets').innerHTML = "The company has a total of " +  indicatorsList['Valor Activos'] + " assest currently";
      document.getElementById('txtTotalInvestment').innerHTML = "The company has a investment of "+ new Intl.NumberFormat().format(indicatorsList['Total Inversion']) + " USD";

    }, error: function (data) {
      alert("Error calling the data, review your connection")
    }
  })
}

//Draw the line chart related to the total assets by class.
function loadClassAssetResume() {

  $.ajax({
    type: 'GET',
    url: '../controller/controller_activo.php',
    data: {
      'classAssetResume': 'classAssetResume'
    }, success: function (data) {

      let assetList = $.parseJSON(data);
      let Class = [];
      let Totals = [];

      for (var i = 0; i < assetList.length; i++) {

        Class[i] = assetList[i]['Class'];
        Totals[i] = assetList[i]['Total'];

      }

      drawClassAssetResume(Class, Totals);

    }, error: function (data) {
      alert("Error calling the data, review your connection")
    }
  })
}

function drawClassAssetResume(labels, Data) {

  const data = {
    labels: labels,
    datasets: [{
      label: 'Total Assets by Class',
      borderColor: '#146CA4',
      data: Data,
      pointStyle: 'circle',
      pointRadius: 10,
      pointHoverRadius: 15
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      maintainAspectRatio: false,
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      plugins: {
        title: {
          display: false
        }
      },

    }
  };

  const myChart = new Chart(
    document.getElementById('chartClassAssetResume'),
    config
  );

}