<?php
    include_once 'components/navigation.php';
    include_once '../controller/controller_activo.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reconciliation</title>
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
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Accounting</h1>
                <h4 class="text-muted">Reconciliation</h4>

                <div class="container separator" id = "reconciliationBody" name = "reconciliationBody">


                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="text-muted">Asset Class</h5>
                            </div>
                            <div class="col-2">
                               <h5 class="text-muted text-center"> Subledger</h5>
                            </div>
                            <div class="col-2">
                                <h5 class="text-muted text-center">Accounting</h5>
                            </div>
                            <div class="col-2">
                                <h5 class="text-muted text-center">Difference</h5>
                            </div>
                        </div>

                        <div class="row" style = 'margin-top: 25px'>
                            <div class="col-6">
                                <h5 class="text-muted">Vehiculos</h5>
                            </div>
                            <div class="col-2 text-center">
                                2500000
                            </div>
                            <div class="col-2 text-center">
                                2500000
                            </div>
                            <div class="col-2 text-center">
                                0
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <h5 class="text-muted">Dep Acumulada Vehiculos</h5>
                            </div>
                            <div class="col-2 text-center">
                                250000
                            </div>
                            <div class="col-2 text-center">
                                250000
                            </div>
                            <div class="col-2 text-center">
                                0
                            </div>
                        </div>

                        <div class="row" style = " border-top: 1px solid #969696;">
                            <div class="col-6">
                                <h4 class="text-muted">Total Vehiculos</h4>
                            </div>
                            <div class="col-2 text-center">
                                250000
                            </div>
                            <div class="col-2 text-center">
                                250000
                            </div>
                            <div class="col-2 text-center">
                                0
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

    <!-- Custom JS codes -->
    <script src="../custom components/js/side-bar.js"></script>
    <script src="../custom components/js/js_accounting_reconciliation.js"></script>


</body>



</html>