window.onload = getAccountBalanaceResume();

//Complete the information related to the indicators
function getAccountBalanaceResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_cuenta.php',
        data: {
            'getAccountBalanceResume': 'getAccountBalanceResume'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++) {

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['ID_CUENTA'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['DESCRIPCION_CUENTA'] + '</td>'
                tableRow += '<td>' + outputList[i]['NATURALEZA'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CATEGORIA'] + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat('en-US').format(outputList[i]['TOTAL_DEBITOS'].replace(',','.')) + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat('en-US').format(outputList[i]['TOTAL_CREDITOS'].replace(',','.')) + '</td>'
                tableRow += '<td>' + new Intl.NumberFormat('en-US').format(outputList[i]['BALANCE'].replace(',','.')) + '</td>'
                //tableRow += '<td><a class = "btn btn-secondary" href = "../view/view_accounting_journalsReport_journalDetails.php?journalID=' + outputList[i]['ID_CUENTA'] + '"><i class="fa-solid fa-pencil" style = "color: white;"></i></a></td>'
                tableRow += '</tr>'

            }

            document.getElementById('tblAccountBalanceResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}