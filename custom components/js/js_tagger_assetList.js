window.onload = assetsReportResume();

//Complete the information related to the indicators
function assetsReportResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_activo.php',
        data: {
            'AssetResume': 'AssetResume'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++) {

                tableRow += '<tr>'
                tableRow += '<td class = "text-left">' + outputList[i]['DESCRIPCION_ACTIVO'] + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat('en-US').format(outputList[i]['VALOR_ADQUISICION']) + '</td>'
                tableRow += '<td>' + outputList[i]['FECHA_ADQUISICION'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '<td>' + outputList[i]['VIDA_UTIL'] + '</td>'
                tableRow += '<td>' + outputList[i]['PERIODOS_DEPRECIADOS'] + '</td>'
                tableRow += '<td>' + outputList[i]['NOMBRE'] + '</td>'
                tableRow += '<td><a class = "btn btn-secondary" href = "../view/view_accounting_journalsReport_journalDetails.php?journalID=' + outputList[i]['ID_ACTIVO'] + '"><i class="far fa-eye" style = "color: white;"></i></a></td>'
                tableRow += '</tr>'

            }

            document.getElementById('tableAssetsResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}
