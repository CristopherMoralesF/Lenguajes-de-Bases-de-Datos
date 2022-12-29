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
    <link href="../custom components/css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-1">

                <div class="text-center">
                    <h3 class="mt-4">Company Status</h3>
                    <h4 class="text-muted">Asset Management Resume</h4>
                </div>

                <div class="container separator maxWidth">
                    <div class="row">

                        <div class="col-md">
                            <div class="card text-white  mb-3" style="max-width: 18rem;" id='informativeCard'>
                                <div class="card-header">Count Assets</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtTotalAssets' name='txtTotalAssets'>The company has a
                                        total of {count of assets} assest currently
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;"
                                id='informativeCard'>
                                <div class="card-header" style="padding-top: 5px">Total Assets (USD)</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtTotalInvestment' name='txtTotalInvestment'>The company
                                        has a investment of {Sum of amount} USD</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;"
                                id='informativeCard'>
                                <div class="card-header" style="padding-top: 5px">Compliance Percentaje</div>
                                <div class="card-body">
                                    <p class="card-text" id='txtCompliancePercentaje' name='txtCompliancePercentaje'>
                                        Compliance percentaje is {compliance percentaje}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;"
                                id='informativeCard'>
                                <div class="card-header" style="padding-top: 5px">Assets Own by You</div>
                                <div class="card-body">
                                    <p class="card-text" id="txtAssetsByUser" name="txtAssetsByUser">You need to main
                                        {assets under user} assets</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="container maxWidth">


                    <div class="row">
                        <div class="col-lg" style="padding-top: 2px">
                            <div class="container chartDiv">
                                <div class="row" style="height: 280px">
                                    <div class="col-12">
                                        <p class="text-muted text-center" style="padding-top: 5px">Total Assets
                                            Available</p>
                                        <!-- Draw results charts -->
                                        <div class="row" style="width: 100%; height: 225px">
                                            <canvas id="chartClassAssetResume"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg" style="padding-top: 2px">
                            <div class="container chartDiv">
                                <div class="row" style="height: 280px">
                                    <div class="col-12">
                                        <p class="text-muted text-center" style="padding-top: 5px">Risk Assessment</p>
                                        <!-- Draw results charts -->
                                        <div class="row" style="width: 100%; height: 225px">
                                            <canvas id="chartRiskAssessment"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg" style="padding-top: 15px">
                            <div class="container chartDiv">
                                <div class="row" style="height: 270px;">
                                    <div class="col-12">
                                        <p class="text-muted text-center">Accounting Differences</p>
                                        <!-- Draw results charts -->
                                        <div class="row" style="width: 100%; height: 225px">
                                            <canvas id="chartAccountingDifferences"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg" style="padding-top: 15px">
                            <div class="container chartDiv">
                                <div class="row" style="height: 270px;">
                                    <div class="col-12">

                                        <div class="row" style="padding-top: 5px;">
                                            <div class="col-sm">
                                                <p class="text-muted text-right">Assets on
                                                    Risk
                                                </p>
                                            </div>
                                            <div class="col-sm">
                                                <p class="text-muted text-center" id='txtFilterDetails'
                                                    onclick="dashboardFilter()" style="display: inline;"><i
                                                        class="fa-solid fa-user-secret"></i> Data
                                                    filtered by user</p>

                                            </div>
                                        </div>

                                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                            <table class="table table-striped" id='journalsResume'
                                                name='journalsResume'>
                                                <thead class="text-center table-striped">
                                                    <th>Asset ID</th>
                                                    <th>Asset Description</th>
                                                    <th>Asset Class</th>
                                                    <th>Risk</th>
                                                </thead>
                                                <tbody id="assetRiskAssessment" name="assetRiskAssessment">
                                                    <!-- Load by JS Function -->
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
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