window.onload = getClassesResume();

//Get a resume of the classes created
function getClassesResume(){

    $.ajax({
        type: 'GET',
        url: '../controller/controller_classes.php',
        data: {
            'getClasses': 'getClasses'
        }, success: function (data) {

            let outputList = $.parseJSON(data);
            let tableRow = '';

            for (var i = 0; i < outputList.length; i++) {

                tableRow += '<tr>'
                tableRow += '<td>' + outputList[i]['DESCRIPCION_CLASE'] + '</td>'
                tableRow += '<td>' + outputList[i]['CUENTA_ACTIVO'] + '</td>'
                tableRow += '<td>' + outputList[i]['CUENTA_DEP_ACUMULADA'] + '</td>'
                tableRow += '<td>' + outputList[i]['CUENTA_GASTO'] + '</td>'
                tableRow += '<td>' + outputList[i]['VIDA_UTIL'] + '</td>'
                tableRow += '</tr>'

            }

            document.getElementById('tblClassesResume').innerHTML = tableRow

        }, error: function (data) {
            alert("Error calling the data, review your connection")
        }
    })

}