<?php
    include_once 'components/navigation.php';
    include_once '../controller/controller_activo.php';
    include_once '../controller/controller_usuario.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
    <link rel="icon" href="../custom components/img/web_icon.png">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../custom components/css/side-bar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<style>
.separator {
    padding: 15px;
}

.btnSeparator {
    margin: 10px;
}
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Admin</h1>
                <h4 class="text-muted">Class Validations</h4>


                <button type="button" class="btn btn-outline-primary btnSeparator" data-toggle="modal"
                    data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add Validation</button>

                <table class="table table-striped">
                    <thead class="text-center table-striped thead-dark">
                        <th>ID Validation</th>
                        <th>Validation Description</th>
                        <th>Class</th>
                    </thead>
                    <tbody id="tblClassesResume" name=tblClassesResume>
                        <!-- Information is comming with a JS function -->
                    </tbody>
                </table>

                <!-- Modal Creation -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div style='margin: 15px'>
                                <p class="text-muted">Complete all the information to create the validation</p>
                                <select name="selClassName" id="selClassName" class="form-control">
                                    <!-- Information upload by JS Function -->
                                </select>
                                <br>
                                <input type="text" id = 'txtValidationDescription' name = 'txtValidationDescription' class="form-control" placeholder = 'Indicate validation description'>
                                <br>
                                <button class="btn btn-primary" onclick = 'createValidation()'>Create Validation</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <!-- External vendor JS codes -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/chartJS/charts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <script src="../vendor/sweetAlert/sweetAlert.js"></script>
    
    <!-- Custom JS codes -->
    <script src="../custom components/js/side-bar.js"></script>
    <script src="../custom components/js/custom sweetAlerts.js"></script>
    <script src="../custom components/js/js_admin_classValidations.js"></script>


</body>



</html>