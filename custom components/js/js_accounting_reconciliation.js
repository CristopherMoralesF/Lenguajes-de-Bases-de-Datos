window.onload = getClassesResume();

function getClassesResume(){

    $.ajax({
        type: 'GET',
        url: '../controller/controller_reconciliation.php',
        data: {
            'getReconciliation': 'getReconciliation'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let htmlBody = '<div class="row"><div class="col-6"><h5 class="text-muted">Asset Class</h5></div><div class="col-2"><h5 class="text-muted text-center"> Subledger</h5></div><div class="col-2"><h5 class="text-muted text-center">Accounting</h5></div><div class="col-2"><h5 class="text-muted text-center">Difference</h5></div></div>';

            let classes = outputList['DESCRIPCION_CLASE']
            let currentClass = '';


            for (var i = 0; i < outputList.length; i++) {

                if (currentClass == outputList[i]['DESCRIPCION_CLASE']) {


                    currentClass = outputList[i]['DESCRIPCION_CLASE']
                    subledger = parseFloat(outputList[i]['VALOR_SUBLEDGER'])
                    balance = parseFloat(outputList[i]['BALANCE'])
                    result =  subledger - balance
                    htmlBody += '<div class="row"><div class="col-6"><h5 class="text-muted">Depreciation ' +  outputList[i]['DESCRIPCION_CLASE'] + '</h5></div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(subledger) + '</div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(balance) + '</div><div class="col-2 text-center">' + new Intl.NumberFormat('es-ES').format(result) +  '</div></div>'
                    htmlBody += '<div class="row" style = " border-top: 1px solid #969696;"><div class="col-6"><h4 class="text-muted">Total ' +  outputList[i]['DESCRIPCION_CLASE'] + '</h4></div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(Oldsubledger + subledger) + '</div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(Oldbalance + balance) + '</div><div class="col-2 text-center">' + new Intl.NumberFormat('es-ES').format(Oldresult + result) +  '</div></div>'


                } else {

                    currentClass = outputList[i]['DESCRIPCION_CLASE']
                    Oldsubledger = parseFloat(outputList[i]['VALOR_SUBLEDGER'])
                    Oldbalance = parseFloat(outputList[i]['BALANCE'])
                    Oldresult =  Oldsubledger - Oldbalance
                    htmlBody += '<div class="row" style = "margin-top: 25px"><div class="col-6"><h5 class="text-muted">' +  outputList[i]['DESCRIPCION_CLASE'] + '</h5></div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(Oldsubledger) + '</div><div class="col-2 text-center">' +  new Intl.NumberFormat('es-ES').format(Oldbalance) + '</div><div class="col-2 text-center">' + new Intl.NumberFormat('es-ES').format(Oldresult) +  '</div></div>'

                }

                

            }

            document.getElementById('reconciliationBody').innerHTML = htmlBody

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}