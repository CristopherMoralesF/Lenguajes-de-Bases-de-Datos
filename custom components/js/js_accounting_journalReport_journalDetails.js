window.onload = journalsReportResume();
window.onload = journalBodyDetail();

//Complete the information related to the indicators
function journalsReportResume() {

    //Get the journal id from the URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const journalID = urlParams.get('journalID');

    //Perform request to the server
    $.ajax({
        type: 'GET',
        url: '../controller/controller_asientos.php',
        data: {
            'journalHeaderResume': 'journalHeaderResume',
            'JournalID': journalID
        }, success: function (data) {

            let outputList = $.parseJSON(data);

            document.getElementById('txtJournalID').innerHTML = 'Journal ID: ' + outputList['ID_ASIENTO'];
            document.getElementById('txtCreationDate').innerHTML = outputList['FECHA'];
            document.getElementById('txtJournalDescription').innerHTML = outputList['DESCRIPCION'];
            document.getElementById('txtClassDescription').innerHTML = outputList['DESCRIPCION_CLASE'];
            document.getElementById('textTotalAmount').innerHTML = new Intl.NumberFormat('en-US').format(outputList['TOTAL_ASIENTO']);

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}

//Perform the request to the server, in order to bring the JE lines. 
function journalBodyDetail() {

    //Get the journal id from the URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const journalID = urlParams.get('journalID');

    //Variable to complete the body of the table
    tableLines = '';

    //Perform request to the server
    $.ajax({
        type: 'GET',
        url: '../controller/controller_asientos.php',
        data: {
            'journalBodyResume': 'journalBodyResume',
            'JournalID': journalID
        }, success: function (data) {

            let journalBodyLines = $.parseJSON(data);

            for (var i = 0; i < journalBodyLines.length; i++){
                tableLines += '<tr>'
                tableLines += '<td>' + journalBodyLines[i]['ID_ASIENTO_LINEA'] + '</td>'
                tableLines += '<td>' + journalBodyLines[i]['ID_CUENTA_CONTABLE'] + '</td>'
                tableLines += '<td class = "text-left">' + journalBodyLines[i]['DESCRIPCION_LINEA'] + '</td>'
                tableLines += '<td>' + new Intl.NumberFormat('en-US').format(journalBodyLines[i]['DEBITO']) + '</td>'
                tableLines += '<td>' + new Intl.NumberFormat('en-US').format(journalBodyLines[i]['CREDITO']) + '</td>'
                tableLines += '<td>' + new Intl.NumberFormat('en-US').format(journalBodyLines[i]['BALANCE']) + '</td>'
                tableLines += '</tr>'
            }

            document.getElementById('tableJournalResume').innerHTML = tableLines

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

