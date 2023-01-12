window.onload = loadClassAssetResume();
window.onload = modelAssetIndResume();
window.onload = getRiskTable('User');
window.onload = loadClassRiskAssessment()

//Edit the dashboard according to the filters apply
function dashboardFilter() {

  //get filter information
  let filtertext = document.getElementById('txtFilterDetails').innerHTML;

  if (filtertext.indexOf('user') > 0) {
    document.getElementById('txtFilterDetails').innerHTML = '<i class="fa-solid fa-building-lock" onclick = "dashboardFilter()"></i> Data filtered by company</p>'
    getRiskTable('All');
  } else {
    document.getElementById('txtFilterDetails').innerHTML = '<i class="fa-solid fa-user-secret" onclick = "dashboardFilter()"></i> Data filtered by user</p>'
    getRiskTable('User');
  }

}

//Complete the information related to the indicators
function modelAssetIndResume() {

  $.ajax({
    type: 'GET',
    url: '../controller/controller_activo.php',
    data: {
      'AssetIndicators': 'AssetIndicators'
    }, success: function (data) {

      let indicatorsList = $.parseJSON(data);

      document.getElementById('txtTotalAssets').innerHTML = "The company has a total of " + indicatorsList['Valor Activos'] + " assest currently";
      document.getElementById('txtTotalInvestment').innerHTML = "The company has a investment of " + new Intl.NumberFormat().format(indicatorsList['Total Inversion']) + " USD";
      document.getElementById('txtCompliancePercentaje').innerHTML = "Compliance percentaje is " + indicatorsList['Porcentaje Cumplimiento'] + '% current risk level is ' + indicatorsList['Risk Indicator'];
      document.getElementById('txtAssetsByUser').innerHTML = "You own a total of " + indicatorsList['Activos Usuario'] + " assets, please ensure the correct maintenance";


    }, error: function (data) {
      alert("Error calling the data, review your connection")
    }
  })


}

//Complete the information related to the risk assessment table
function getRiskTable(filter) {

  $.ajax({
    type: 'GET',
    url: '../controller/controller_activo.php',
    data: {
      'AssetsResumeRiskTable': 'AssetsResumeRiskTable',
      'levelDetail': filter
    }, success: function (data) {

      let outputList = $.parseJSON(data);
      let tableRow = '';

      for (var i = 0; i < outputList.length; i++) {

        riskAssessment = outputList[i]['RISK_ASSESMENT'];

        tableRow += '<tr>';
        tableRow += '<td>' + outputList[i]['ID_ACTIVO'] + '</td>';
        tableRow += '<td>' + outputList[i]['DESCRIPCION_ACTIVO'] + '</td>';
        tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>';

        if (riskAssessment == 'L') {
          tableRow += '<td style = "background-color:#a4d5b5"><a class = "riskL" href = "../view/view_tagger_assetDetails.php?assetID=' + outputList[i]['ID_ACTIVO'] + '"><i class="fa-regular fa-thumbs-up"></i></a></td>';
        } else if (riskAssessment == 'M') {
          tableRow += '<td style = "background-color:#fafcad"><a class = "riskM" href = "../view/view_tagger_assetDetails.php?assetID=' + outputList[i]['ID_ACTIVO'] + '"><i class="fa-solid fa-triangle-exclamation"></i></a></td>';
        } else {
          tableRow += '<td style = "background-color:#f1a2b7"; ><a class = "riskH" href = "../view/view_tagger_assetDetails.php?assetID=' + outputList[i]['ID_ACTIVO'] + '"><i class="fa-solid fa-circle-radiation"></i></a></td>';
        }

      }

      document.getElementById('assetRiskAssessment').innerHTML = tableRow

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
      drawAccountingDifferences(Class, Totals)


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
      backgroundColor: '#ADD8E6',
      data: Data,
      pointStyle: 'circle',
      pointRadius: 5,
      pointHoverRadius: 15,
      borderWidth: 1,
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      legend: {
        display: false
      },
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
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          }
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          }
        }]
      }

    }
  };

  const myChart = new Chart(
    document.getElementById('chartClassAssetResume'),
    config
  )

}

function DistinctRecords(MYJSON, prop) {
  return MYJSON.filter((obj, pos, arr) => {
    return arr.map(map0bj => map0bj[prop]).indexOf(obj[prop]) === pos;
  })
}

function loadClassRiskAssessment() {

  $.ajax({
    type: 'GET',
    url: '../controller/controller_activo.php',
    data: {
      'AssetsResumeRisk': 'AssetsResumeRisk'
    }, success: function (data) {

      //Get the list of assets with the total of assets under each risk from the data base. 
      let assetList = $.parseJSON(data);

      //Get the unique classes from the data set. 
      classes = DistinctRecords(assetList, "DESCRIPCION_CLASE");

      riskVariables = ['L', 'M', 'H']
      classList = [];
      riskL = [];
      riskM = [];
      riskH = [];
      i = 0;


      for (let assetClass in classes) {

        //Complete an array with the classes names
        selectedClass = assetList[assetClass]['DESCRIPCION_CLASE']


        //Filter the json data set with current class data
        assetListByClass = assetList.filter(element => element.DESCRIPCION_CLASE == selectedClass);

        //Complete the class list array
        classList[i] = selectedClass

        //Complete the risk assessment array
        for (let riskVariable in riskVariables) {

          //Get the risk level
          riskLevel = riskVariables[riskVariable]
          assetListByRiskVariable = assetListByClass.filter(element => element.RISK_ASSESMENT == riskLevel);

          //Get the final value
          if (assetListByRiskVariable.length > 0) {
            value = parseInt(assetListByRiskVariable[0]['TOTAL_ASSETS'])
          } else {
            value = 0
          }

          //Assing the value to the correct array
          if (riskLevel == 'L') {
            riskL[i] = value
          } else if (riskLevel == 'M') {
            riskM[i] = value
          } else {
            riskH[i] = value
          }

        }

        i++
      }

      drawClasRiskAssessment(classList, riskL, riskM, riskH)

    }, error: function (data) {
      alert("Error calling the data, review your connection")
    }
  })

}

function drawClasRiskAssessment(labels, riskL, riskM, riskH) {

  const data = {
    labels: labels,
    datasets: [{
      label: 'Low Risk',
      //borderColor: '#1C9645',
      backgroundColor: '#a4d5b5',
      data: riskL,
      borderWidth: 1,
    }, {
      label: 'Medium Risk',
      //borderColor: '#F3F732',
      backgroundColor: '#fafcad',
      data: riskM,
      borderWidth: 1,
    }, {
      label: 'High Risk',
      //borderColor: '#DC164A',
      backgroundColor: '#f1a2b7',
      data: riskH,
      borderWidth: 1,
    }
    ]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      legend: {
        display: false
      },
      maintainAspectRatio: false,
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          }
        }]
      },
      plugins: {
        title: {
          display: false
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",

          },
          stacked: true,
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          },
          stacked: true,
        }]
      }

    }
  };

  const myChart = new Chart(
    document.getElementById('chartRiskAssessment'),
    config
  )

}

function loadAccountingDifferences() {

}

function drawAccountingDifferences(labels, Data) {

  const data = {
    labels: ['Computadoras', 'Bus', 'Software', 'Vehiculos', 'Edificios', 'Maquinaria'],
    datasets: [{
      type: 'line',
      label: 'Total Accounting',
      borderColor: 'rgb(255, 99, 132)',
      backgroundColor: 'rgba(0, 0, 0, 0.0)',
      data: Data,
      borderWidth: 2,
      order: 2
    }, {
      label: 'Total Subledger',
      borderColor: '#146CA4',
      backgroundColor: '#7fc8e0e3',
      data: [13, 1, 3, 11, 3, 12],
      borderWidth: 1,
      order: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      legend: {
        display: false
      },
      maintainAspectRatio: false,
      responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
          }
        }]
      },
      plugins: {
        title: {
          display: false
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          }
        }],
        yAxes: [{
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
          }
        }]
      }

    }
  };

  const myChart = new Chart(
    document.getElementById('chartAccountingDifferences'),
    config
  )
}