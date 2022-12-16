window.onload = initialLoad();
window.onload = loadAccounts();

function initialLoad() {

    let currentDate = new Date().toJSON().slice(0, 10);

    document.getElementById('txtCreationDate').innerHTML = currentDate;
    document.getElementById('textTotalAmount').innerHTML = new Intl.NumberFormat('en-US').format(0);

}

function loadAccounts() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_cuenta.php',
        data: {
            'getAccounts': 'getAccounts'
        }, success: function (data) {

            let accountsList = $.parseJSON(data);
            let dropdownOptions = '';

            for (var i = 0; i < accountsList.length;i++){
                dropdownOptions += '<option value="' + accountsList[i]['ID_CUENTA'] +'">' + accountsList[i]['ID_CUENTA'] + '  ' + accountsList[i]['DESCRIPCION_CUENTA'] +'</option>';
            }

            document.getElementById('selAccount').innerHTML = dropdownOptions;

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

} 

function submitLine(){


    //Get objects from the DOM that are goin to be use
    var glDropdown = document.getElementById('selAccount');
    var natureDropdown = document.getElementById('selNature');
    var journalTable = document.getElementById('tableJournalResume');

    //Get the values of the new lines
    let nextLine = journalTable.rows.length + 1;
    let glAccount = glDropdown.options[glDropdown.selectedIndex].value;
    let jeNature = natureDropdown.options[natureDropdown.selectedIndex].text;
    let lineDescription = document.getElementById('txtFormLineDescription').value;
    let lineAmount = document.getElementById('txtFormAmount').value;

    //Get the previous lines in the journal
    let tableRow = journalTable.innerHTML;


    //Build new line body
    tableRow += '<tr>'
    tableRow += '<td>' + nextLine +'</td>'
    tableRow += '<td> ' + glAccount +'</td>'
    tableRow += '<td> ' + lineDescription +'</td>'

    //Validate the nature of the transaction
    if (jeNature == 'Debit'){
        tableRow += '<td> ' + lineAmount +'</td>'
        tableRow += '<td> ' + 0 +'</td>'    
        tableRow += '<td> ' + lineAmount +'</td>'
    } else {
        tableRow += '<td> ' + 0 +'</td>' 
        tableRow += '<td> ' + lineAmount +'</td>'
        tableRow += '<td> ' + -lineAmount +'</td>'
    }

    tableRow += '</tr>'


    document.getElementById('tableJournalResume').innerHTML = tableRow;
    validateJournal();
    
}

function validateJournal(){

    var tableRow = document.getElementById('tableJournalResume');
    var totalDebits = 0
    var totalCredits = 0
    var errorMessage = '';

    for(var i = 0; i < tableRow.rows.length; i++ ){
        totalDebits += parseFloat(tableRow.rows[i].cells[3].innerHTML);
        totalCredits += parseFloat(tableRow.rows[i].cells[4].innerHTML);
    }

    if (totalDebits != totalCredits) {
        errorMessage = "<i class='fa-solid fa-bomb'></i> Debits and Credits doesn't match"
        document.getElementById('saveJournal').style.display = 'none'
    } else {
        document.getElementById('saveJournal').style.display = 'inline'
    }

    document.getElementById('journalValidation').innerHTML = errorMessage;
    document.getElementById('textTotalAmount').innerHTML = new Intl.NumberFormat('en-US').format(totalDebits);

}



