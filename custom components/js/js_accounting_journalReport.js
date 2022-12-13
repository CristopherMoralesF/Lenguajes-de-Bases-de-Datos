window.onload = journalsReportResume();
window.onload = accountingEquationResume();

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
            
            for (var i = 0; i < outputList.length; i++) {

                totalAmmount = outputList[i]['TOTAL_ASIENTO'].replace(',','.')

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['ID_ASIENTO'] + '</td>'
                tableRow += '<td>' + outputList[i]['FECHA'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['DESCRIPCION'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat("es-ES").format(totalAmmount) + '</td>'
                tableRow += '<td><a class = "btn btn-secondary" href = "../view/view_accounting_journalsReport_journalDetails.php?journalID=' + outputList[i]['ID_ASIENTO'] + '"><i class="far fa-eye" style = "color: white;"></i></a></td>'
                tableRow += '</tr>'

            }

            document.getElementById('tableJournalResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}

//Complete the information of the header of the page with the accountng equation
function accountingEquationResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_asientos.php',
        data: {
            'accountingEquation': 'accountingEquation'
        }, success: function (data) {

            //Get the results from the data base
            let indicators = $.parseJSON(data);


            //Assign the values to the correct position. 
            document.getElementById('txtTotalAssets').innerHTML = new Intl.NumberFormat('en-US').format(indicators['Activos'])
            document.getElementById('txtLiabilities').innerHTML = new Intl.NumberFormat('en-US').format(indicators['Pasivos'])
            document.getElementById('TotalCapital').innerHTML = new Intl.NumberFormat('en-US').format(indicators['Capital'])

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}

//Creaste function to download in an excel file the content of the table. 
function exportJournalsExcel(tableID,filename = ''){
    
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g,'%20');

    //Specify the file name
    filename = filename?filename+'.xls':'excel_data.xls';

    //Create a download link element
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff',tableHTML],{
            type:dataType
        });

        navigator.msSaveOrOpenBlob(blob,filename);

    } else {

        //Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        //Setting the file name
        downloadLink.download = filename;

        //Trigger the function
        downloadLink.click();
    }
}