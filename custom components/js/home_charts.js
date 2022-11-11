window.onload = loadClassAssetResume();
window.onload = drawComplianceResume();

function loadClassAssetResume() {

    $.ajax ({
        type: 'GET',
        url: '../controller/controller_activo.php',
        data: {
            'classAssetResume':'classAssetResume'
        }, success: function(data) {

            let assetList = $.parseJSON(data);
            let Class = [];
            let Totals = [];

            for (var i = 0; i < assetList.length; i++){

                Class[i] = assetList[i]['Class'];
                Totals[i] = assetList[i]['Total'];

            }

            drawClassAssetResume(Class,Totals);

        }, error: function(data){
            alert("Error calling the data, review your connection")
        }
    })
}

function drawClassAssetResume(labels,Data){

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

function drawComplianceResume(){

   

    const labels = ['Maquinaria y Equipo','Vehiculos','Edificios'];
    const dataValues1 = [10,15,30];
    const dataValues2 = [20,30,60];

    const data = {
    labels: labels,
    datasets: [
        {
        label: 'Total Assets',
        data: dataValues1,
        borderColor: '#32A89C',
        backgroundColor: '#146CA4',
        order: 1
        },
        {
        label: 'Compliance',
        data: dataValues2,
        borderColor: '#46648C',
        type: 'line',
        order: 0
        }
    ]
    };
  
    const config = {
        type: 'bar',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Chart.js Combined Line/Bar Chart'
            }
          }
        },
      };

    const myChart = new Chart(
        document.getElementById('chartComplianceResume'),
        config
    );

}