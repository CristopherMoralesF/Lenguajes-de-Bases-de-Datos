window.onload = getClassesResume();

//Get a resume of the classes created
function getClassesResume() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_classes.php',
        data: {
            'getClasses': 'getClasses'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let optionsList = '<option value="0">Select an option</option>'

            for (var i = 0; i < outputList.length; i++) {

                optionsList += '<option value="' + outputList[i]['ID_CLASE'] + '">' + outputList[i]['DESCRIPCION_CLASE'] + '</option>'

            }

            document.getElementById('selAssetClass').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

//Create a function to run the depreciation for one of the journals
function runDepreciation () {

    //Get the dropdown from the DOM. 
    dropClass = document.getElementById('selAssetClass');

    //Recover the values
    journalDescripcion = document.getElementById('txtDepreciationDescription').value;
    assetClass = dropClass.options[dropClass.selectedIndex].value;

    if (assetClass == "0" || journalDescripcion.length <= 0) {
        errroMessageStatus('Error: Pending information, please complete all the fields')
        return;
    } 

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "The execution of the depreciation will generate an accounting impact!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, create it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: false
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: '../controller/controller_activo.php',
                data: {
                    'runDepreciation': 'runDepreciation',
                    'idClass': assetClass,
                    'journalDescription': journalDescripcion,
                }, success: function (data) {

                    let outputList = $.parseJSON(data);
                    let journalID = outputList['JournalID'];
                    let tableRow = '';


                    for (var i = 0; i < outputList['Depreciation Resume'].length; i++) {

                        tableRow += '<tr>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['DESCRIPCION_ACTIVO'] + '</td>'
                        tableRow += '<td>' + new Intl.NumberFormat("es-ES").format(outputList['Depreciation Resume'][i]['VALOR_ADQUISICION'].replace(',','.')) + '</td>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['FECHA_ADQUISICION'] + '</td>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['PERIODOS_DEPRECIADOS'] + '</td>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['DESCRIPCION_CLASE'] + '</td>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['VIDA_UTIL'] + '</td>'
                        tableRow += '<td>' + outputList['Depreciation Resume'][i]['ID_CLASE'] + '</td>'
                        tableRow += '<td>' + new Intl.NumberFormat("es-ES").format(outputList['Depreciation Resume'][i]['DEPRECIACION_MENSUAL'].replace(',','.')) + '</td>'
                        tableRow += '<td>' + new Intl.NumberFormat("es-ES").format(outputList['Depreciation Resume'][i]['DEPRECIACION_ACUMULADA'].replace(',','.')) + '</td>'
                        tableRow += '</tr>'
        
                    }

                    document.getElementById('journalID').innerHTML = 'Depreciation executed successfully, review accounting impact in the Journal ID: ' + journalID;
                    document.getElementById('tableDepreciationResume').innerHTML = tableRow;
                    document.getElementById('depreciationResume').style.display = '';

                }, error: function (data) {
                    errroMessageStatus('Error calling the data, review your connection');
                }
            })

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'The depreciation information was not saved',
                'error'
            )
        }

    })




}