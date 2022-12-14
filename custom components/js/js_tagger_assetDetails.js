window.onload = assetsReportResume();
window.onload = loadAssetValidations();

//Complete the information related to the indicators
function assetsReportResume() {
    $.ajax({
        type: 'GET',
        url: '../controller/controller_activo.php',
        data: {
            'AssetResume': 'AssetResume'
        }, success: function (data) {

            //Get the journal id from the URL
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const asssetID = urlParams.get('assetID');

            //Get assets from the data base
            let outputList = $.parseJSON(data);

            //Filter by the selected asset
            outputList = outputList.filter(element => element.ID_ACTIVO == asssetID)

            document.getElementById('txtAssetID').innerHTML = 'Asset ID: ' + outputList[0]['ID_ACTIVO'];
            document.getElementById('txtCreationDate').innerHTML = outputList[0]['FECHA_ADQUISICION'];
            document.getElementById('txtDescripcionActivo').innerHTML = outputList[0]['DESCRIPCION_ACTIVO'];
            document.getElementById('txtAcquisitionValue').innerHTML = outputList[0]['VALOR_ADQUISICION'];
            document.getElementById('txtAcquisitionDate').innerHTML = outputList[0]['FECHA_ADQUISICION'];
            document.getElementById('txtUsefullLive').innerHTML = outputList[0]['VIDA_UTIL'];
            document.getElementById('txtDepreciatedPeriods').innerHTML = outputList[0]['PERIODOS_DEPRECIADOS'];
            document.getElementById('txtAsssetOwner').innerHTML = outputList[0]['NOMBRE'];
            document.getElementById('txtAssetLocation').innerHTML = outputList[0]['DESCRIPCION_SECCION'];
            document.getElementById('txtAsssetClass').innerHTML = outputList[0]['DESCRIPCION_CLASE'];
            document.getElementById('txtAssetState').innerHTML = outputList[0]['DESCRIPCION_ESTADO'];

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })
}

function loadAssetValidations() {

    //Get the journal id from the URL
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const asssetID = urlParams.get('assetID');

    $.ajax({
        type: 'POST',
        url: '../controller/controller_activo.php',
        data: {
            'assetValidationResume': 'assetValidationResume',
            'idActivo': asssetID
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++) {

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['ID_TIPO_VALIDACION'] + '</td>'
                tableRow += '<td class = "text-left">' + outputList[i]['DESCRIPCION_VALIDACION'] + '</td>'


                if (outputList[i]['VALOR'] == null) {
                    tableRow += '<td>' + 'Pending Information' + '</td>'
                    tableRow += '<td><button class = "btn btn-primary" onclick = addValidationInformation(' + outputList[i]['ID_TIPO_VALIDACION'] + ',' + asssetID + ')>' + '<i class="fa-solid fa-plus"></i>' + '</button></td>'

                } else {
                    tableRow += '<td>' + outputList[i]['VALOR'] + '</td>'
                    tableRow += '<td><button class = "btn btn-primary" onclick = updateValidationInformation(' + outputList[i]['ID_TIPO_VALIDACION'] + ',' + asssetID + ')>' + '<i class="fa-solid fa-pencil"></i>' + '</button></td>'

                }

                tableRow += '</tr>'

            }

            document.getElementById('tableAssetValidationsResume').innerHTML = tableRow


        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}

function addValidationInformation(validationID, assetID) {

    (async () => {

        const { value: text } = await Swal.fire({
            input: 'text',
            inputLabel: 'Validation Value',
            inputPlaceholder: 'Enter the validation value'
        })

        if (text) {

            $.ajax({
                type: 'POST',
                url: '../controller/controller_validacion.php',
                data: {
                    'completeValidation': 'completeValidation',
                    'assetID': assetID,
                    'validationID':validationID,
                    'value':text
                }, success: function (data) {

                    let outputList = $.parseJSON(data);

                    if (outputList[0]['Result'].length > 0) {
                        successMessageStatus('Validation Information Added!')
                    } else {
                        errroMessageStatus('Error adding the validation value!')    
                    }
                    
            
                }, error: function (data) {
                    errroMessageStatus('Error adding the validation value!')
                }
            })


        }

    })()
}

function updateValidationInformation(validationID, assetID) {

    (async () => {

        const { value: text } = await Swal.fire({
            input: 'text',
            inputLabel: 'Validation Value',
            inputPlaceholder: 'Enter the new validation value'
        })

        if (text) {

            $.ajax({
                type: 'POST',
                url: '../controller/controller_validacion.php',
                data: {
                    'updateValidation': 'updateValidation',
                    'assetID': assetID,
                    'validationID':validationID,
                    'value':text
                }, success: function (data) {

                    let outputList = $.parseJSON(data);

                    if (outputList[0]['Result'].length > 0) {
                        successMessageStatus('Validation Information Added!')
                    } else {
                        errroMessageStatus('Error adding the validation value!')    
                    }
                    
            
                }, error: function (data) {
                    errroMessageStatus('Error adding the validation value!')
                }
            })


        }

    })()
}