window.onload = getClassesResume();
window.onload = getLocationResume();
window.onload = getStateResume();
window.onload = getUserResume();


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

            document.getElementById('selClass').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

function getLocationResume() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_locationAndState.php',
        data: {
            'locationResume': 'locationResume'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let optionsList = '<option value="0">Select an option</option>'

            for (var i = 0; i < outputList.length; i++) {

                optionsList += '<option value="' + outputList[i]['ID_UBICACION'] + '">' + outputList[i]['DESCRIPCION_SECCION'] + '</option>'

            }

            document.getElementById('selLocation').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

function getStateResume() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_locationAndState.php',
        data: {
            'stateResume': 'stateResume'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let optionsList = '<option value="0">Select an option</option>';

            for (var i = 0; i < outputList.length; i++) {

                optionsList += '<option value="' + outputList[i]['ID_ESTADO'] + '">' + outputList[i]['DESCRIPCION_ESTADO'] + '</option>'

            }

            document.getElementById('selAssetState').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

function getUserResume() {

    $.ajax({
        type: 'GET',
        url: '../controller/controller_usuario.php',
        data: {
            'user_list': 'user_list'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let optionsList = '<option value="0">Select an option</option>';

            for (var i = 0; i < outputList.length; i++) {

                optionsList += '<option value="' + outputList[i]['ID_USUARIO'] + '">' + outputList[i]['NOMBRE'] + '</option>'

            }

            document.getElementById('selAssetOwner').innerHTML = optionsList

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

// -------------- Function to create a new user --------------
function createAsset() {

    //Get the dropdowns
    var dropAssetClass = document.getElementById('selClass');
    var dropAssetLocation = document.getElementById('selLocation');
    var dropAssetOwner = document.getElementById('selAssetOwner');
    var dropAssetState = document.getElementById('selAssetState');

    //Get the values from the dropdowns
    var assetClass = dropAssetClass.options[dropAssetClass.selectedIndex].value;
    var assetLocation = dropAssetLocation.options[dropAssetLocation.selectedIndex].value;
    var assetOwner = dropAssetOwner.options[dropAssetOwner.selectedIndex].value;
    var assetState = dropAssetState.options[dropAssetState.selectedIndex].value;

    //Get the values from other kind of fields
    var assetDescription = document.getElementById('txtAssetDescription').value;
    var assetValue = document.getElementById('txtAcquisitionValue').value;
    var assetDate = document.getElementById('txtAcquisitionDate').value;


    if (assetClass == 0 || assetLocation == 0 ||
        assetOwner == 0 || assetState == 0) {
        errroMessageStatus('Pending information, please complete all the fields')
        return;
    }

    if (assetDescription.length <= 0 || assetValue.length <= 0
        || assetDate.length <= 0) {
        errroMessageStatus('Pending information, please complete all the fields')
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
        text: "The creation of the asset will generate an accounting impact!",
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
                    'createAsset': 'createAsset',
                    'idClass': assetClass,
                    'idlocation': assetLocation,
                    'idOwner': assetOwner,
                    'idState': assetState,
                    'assetDescription': assetDescription,
                    'value': assetValue,
                    'date': assetDate
                }, success: function (data) {

                    let outputList = $.parseJSON(data);
                    let response = outputList[0]['Result'];

                    if (response == 'Successful') {
                        successMessageStatus('Asset created!');
                    } else {
                        errroMessageStatus(response)
                    }

                }, error: function (data) {
                    errroMessageStatus('Error calling the data, review your connection');
                }
            })

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'The asset information was not saved',
                'error'
            )
        }

    })



}
