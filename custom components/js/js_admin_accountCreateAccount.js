function createAccount() {

    //Get the elements from the form
    var dropAccountCategory = document.getElementById('selCategorySelect');
    var dropAccountNature = document.getElementById('selNatureSelect');

    var account = document.getElementById('txtGLAccount').value;
    var accountDescription = document.getElementById('txtAccountDescription').value;
    var accountCategory = dropAccountCategory.options[dropAccountCategory.selectedIndex].value;
    var accountNature = dropAccountNature.options[dropAccountNature.selectedIndex].value;

    if (account.length <= 0 || accountDescription.length <= 0) {
        errroMessageStatus('Pending information, please complete all the fields')
    } else if (account.length >15 || accountDescription.length > 50) {
        errroMessageStatus('The account or description is to long, follow the correct formats')
    } else {

        $.ajax({
            type: 'POST',
            url: '../controller/controller_cuenta.php',
            data: {
                'createAccount': 'createAccount',
                'accountID': account,
                'accountDescription':accountDescription,
                'accountCategory':accountCategory,
                'accountNature':accountNature
            }, success: function (data) {

                let outputList = $.parseJSON(data);
                let response = outputList[0]['Result'];

                if (response == 'Successful'){
                    successMessageStatus('Account created!');
                } else {
                    errroMessageStatus(response)
                }

            }, error: function (data) {
                errroMessageStatus('Error calling the data, review your connection');
            }
        })

    }



}

