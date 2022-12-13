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