window.onload = journalsReportResume();

//Complete the information related to the indicators
function journalsReportResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_asientos.php',
        data: {
            'journalsReportResume': 'journalsReportResume'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++){
            
                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['ID_ASIENTO'] + '</td>'
                tableRow += '<td>' + outputList[i]['FECHA'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat().format(outputList[i]['TOTAL_ASIENTO']) + '</td>'
                tableRow += '<td><a class = "btn btn-secondary"><i class="far fa-eye" style = "color: white;"></i></a></td>'
                tableRow += '</tr>'

            }

            document.getElementById('tableJournalResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}