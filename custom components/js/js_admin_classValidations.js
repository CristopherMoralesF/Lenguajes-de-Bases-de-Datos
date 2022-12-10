window.onload = classesValidationList();
window.onload = getClassesResume();


//Get the list of validations
function classesValidationList() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_classes.php',
        data: {
            'classesValidationList': 'classesValidationList'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++) {

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['ID_TIPO_VALIDACION'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_VALIDACION'] + '</td>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '</tr>'

            }

            document.getElementById('tblClassesResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

//Get a resume of the classes created
function getClassesResume() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_classes.php',
        data: {
            'getClasses': 'getClasses'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let optionsList = '';

            for (var i = 0; i < outputList.length; i++) {

                optionsList += '<option value="' + outputList[i]['ID_CLASE'] + '">' + outputList[i]['DESCRIPCION_CLASE'] + '</option>'

            }

            document.getElementById('selClassName').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}


//Create a new class validation
function createValidation() {

    var classDropdown = document.getElementById('selClassName')

    var selectedClass = classDropdown.options[classDropdown.selectedIndex].value;
    var txtValidationDescription = document.getElementById('txtValidationDescription').value;

    if (txtValidationDescription.length <= 0) {
        errroMessageStatus('Pending information, please complete all the fields');
    } else {
        $.ajax({
            type: 'POST',
            url: '../controller/controller_classes.php',
            data: {
                'createValidation': 'createValidation',
                'classID': selectedClass,
                'validationDescription':txtValidationDescription,

            }, success: function (data) {

                let outputList = $.parseJSON(data);
                let response = outputList[0]['Result'];

                if (response == 'Successful'){
                    successMessageStatus('validation created!');
                } else {
                    errroMessageStatus(response)
                }

            }, error: function (data) {
                errroMessageStatus('Error calling the data, review your connection');
            }
        })

    }

}