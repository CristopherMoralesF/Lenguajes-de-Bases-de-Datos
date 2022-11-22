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

    <title>Home</title>
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

                <h1 class="mt-4">My Dashboard</h1>
                <h4 class="text-muted">Assets Information</h4>

                <div class="container separator">
                    <div class="row">

                        <div class="col-3">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Count Assets</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtTotalAssets' name='txtTotalAssets'>The company has a
                                        total of {count of assets} assest currently
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Total Assets (USD)</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtTotalInvestment' name='txtTotalInvestment'>The company
                                        has a investment of {Sum of amount} USD</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Compliance Percentaje</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtCompliancePercentaje' name='txtCompliancePercentaje'>
                                        Compliance percentaje is {compliance percentaje}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Assets Own by You</div>
                                <div class="card-body">
                                    <p class="card-text" id="txtAssetsByUser" name="txtAssetsByUser">You need to main
                                        {assets under user} assets</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-muted">Total Assets Available</p>
                            <!-- Draw results charts -->
                            <div class="row" style="width: 100%; height: 500px">
                                <canvas id="chartClassAssetResume"></canvas>
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
    <script src="../custom components/js/home_charts.js"></script>

</body>



</html>