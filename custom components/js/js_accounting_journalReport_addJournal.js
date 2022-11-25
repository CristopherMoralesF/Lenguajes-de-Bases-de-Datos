window.onload = initialLoad();

function initialLoad(){

    let currentDate = new Date().toJSON().slice(0, 10);

    document.getElementById('txtCreationDate').innerHTML = currentDate;
    document.getElementById('textTotalAmount').innerHTML = new Intl.NumberFormat('en-US').format(0);

}

function journalVaidation(){

    tblJournalBody = document.getElementById('tblJournalBody');
    errorMessage = "<i class='fa-solid fa-bomb'></i> Debits and Credits doesn't match"
    
}