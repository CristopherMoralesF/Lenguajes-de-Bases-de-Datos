window.onload = journalsReportResume();

//Complete the information related to the indicators
function journalsReportResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_activo.php',
        data: {
            'getAssetSubledger': 'getAssetSubledger'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';
            
            for (var i = 0; i < outputList.length; i++) {

                

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_ACTIVO'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['FECHA_ADQUISICION'] + '</td>'
                tableRow += '<td class = "text-left">' + new Intl.NumberFormat("es-ES").format(parseFloat(outputList[i]['VALOR_ADQUISICION'])) + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['VIDA_UTIL'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['PERIODOS_DEPRECIADOS'] + '</td>'
                tableRow += '<td class = "text-left">' + new Intl.NumberFormat("es-ES").format(parseFloat(outputList[i]['DEPRECIACION_MENSUAL'])) + '</td>'
                tableRow += '<td class = "text-left">' + new Intl.NumberFormat("es-ES").format(parseFloat(outputList[i]['DEPRECIACION_ACUMULADA'])) + '</td>'
                tableRow += '</tr>'

            }

            document.getElementById('tableJournalResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}
