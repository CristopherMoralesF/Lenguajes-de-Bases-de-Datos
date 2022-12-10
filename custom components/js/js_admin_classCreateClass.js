window.onload = loadAccounts();

function loadAccounts() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_cuenta.php',
        data: {
            'getAccounts': 'getAccounts',
        }, success: function (data) {

            let accountsList = $.parseJSON(data);
            let assetsOptions = '';
            let depAcumOptions = '';
            let expenceOptions = '';

            for (var i = 0; i < accountsList.length;i++){
                if(accountsList[i]['ID_CATEGORIA'] == 1){
                    assetsOptions += '<option value="' + accountsList[i]['ID_CUENTA'] +'">' + accountsList[i]['ID_CUENTA'] + '  ' + accountsList[i]['DESCRIPCION_CUENTA'] +'</option>';
                } else if (accountsList[i]['ID_CATEGORIA'] == 6){
                    depAcumOptions += '<option value="' + accountsList[i]['ID_CUENTA'] +'">' + accountsList[i]['ID_CUENTA'] + '  ' + accountsList[i]['DESCRIPCION_CUENTA'] +'</option>';
                } else if (accountsList[i]['ID_CATEGORIA'] == 5){
                    expenceOptions += '<option value="' + accountsList[i]['ID_CUENTA'] +'">' + accountsList[i]['ID_CUENTA'] + '  ' + accountsList[i]['DESCRIPCION_CUENTA'] +'</option>';
                }
                
            }

            document.getElementById('selAssetAccount').innerHTML = assetsOptions;
            document.getElementById('selAccumDepAccount').innerHTML = depAcumOptions;
            document.getElementById('selExpenseAccount').innerHTML = expenceOptions;

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

function createClass() {

    //Get the elements from the dom
    var dropAssetAccount = document.getElementById('selAssetAccount');
    var dropAcuDepAccount = document.getElementById('selAccumDepAccount');
    var dropExpenseAccount = document.getElementById('selExpenseAccount');

    var classDescription = document.getElementById('txtclassDescription').value;
    var assetAccount = dropAssetAccount.options[dropAssetAccount.selectedIndex].value;
    var AcuDepAccount = dropAcuDepAccount.options[dropAcuDepAccount.selectedIndex].value;
    var expenseAccount = dropExpenseAccount.options[dropExpenseAccount.selectedIndex].value;
    var usefullLife = document.getElementById('txtvidaUtil').value;

    if (classDescription.length <= 0 || assetAccount.length <= 0
        || AcuDepAccount.length <= 0  || expenseAccount.length <= 0 || usefullLife.length <= 0) {
        errroMessageStatus('Pending information, please complete all the fields')
    } else if (classDescription.length > 50 || assetAccount.length > 15
            || AcuDepAccount.length > 15 || expenseAccount.length > 15) {
        errroMessageStatus('The account or description is to long, follow the correct formats')
    } else {

        $.ajax({
            type: 'POST',
            url: '../controller/controller_classes.php',
            data: {
                'createClass': 'createClass',
                'classDescription': classDescription,
                'assetAccount':assetAccount,
                'accumDepAccount':AcuDepAccount,
                'expenseAccount':expenseAccount,
                'usefullLife':usefullLife
            }, success: function (data) {

                let outputList = $.parseJSON(data);
                let response = outputList[0]['Result'];

                if (response == 'Successful'){
                    successMessageStatus('Class created!');
                } else {
                    errroMessageStatus(response)
                }

            }, error: function (data) {
                errroMessageStatus('Error calling the data, review your connection');
            }
        })

    }
}

