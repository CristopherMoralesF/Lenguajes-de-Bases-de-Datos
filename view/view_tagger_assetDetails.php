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

    <title>Journal Details</title>
    <link rel="icon" href="../custom components/img/web_icon.png">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../custom components/css/side-bar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<style>
.separator {
    padding-top: 50px;
    margin-top: 50px;
    padding: 15px;
}

.lineSeparator {
    margin-top: 45px;
}

.alert-size {
    height: 60px;
    width: 90%;
    margin-left: 30px;
}
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Asset Detail</h1>
                <h4 class="text-muted" id='txtAssetID' name='txtAssetID'>Asset ID: {Asset ID}</h4>

                <div class="container separator">

                    <div class="container">

                        <div class="row">
                            <div class="col-6">
                                <h5 class="text-muted"><i class="fa-regular fa-calendar"></i> Creation Date:</h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="txtCreationDate" name="txtCreationDate">{Creation Date}</p>
                                </div>
                            </div>

                            <div class="col-6">
                                <h5 class="text-muted"><i class="fa-regular fa-file"></i> Asset description:</h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="txtDescripcionActivo" name="txtDescripcionActivo">{Asset Description}</p>
                                </div>
                            </div>

                        </div>

                        <div class="row lineSeparator">

                            <div class="row">

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-regular fa-money-bill-1"></i> Acquisition Value:
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAcquisitionValue" name="txtAcquisitionValue">{Acquisition Value}</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-regular fa-calendar"></i> Acquisition Date
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAcquisitionDate" name="txtAcquisitionDate">{Acquistion Date}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row lineSeparator">

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-regular fa-heart"></i> Useful Life
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtUsefullLive" name="txtUsefullLive">{Useful Value}</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-solid fa-arrow-trend-down"></i> Depreciated Periods
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtDepreciatedPeriods" name="txtDepreciatedPeriods">{Depreciated Periods}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row lineSeparator">

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-solid fa-person"></i> Assset Owner
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAsssetOwner" name="txtAsssetOwner">{Asset Owner}</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-solid fa-location-dot"></i> Asset Location
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAssetLocation" name="txtAssetLocation">{Asset Location}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row lineSeparator">

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-solid fa-house-circle-exclamation"></i> Assset Class
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAsssetClass" name="txtAsssetClass">{Assset Class}</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-muted"><i class="fa-regular fa-message"></i> Asset State
                                    </h5>
                                    <div class="alert alert-info alert-size" role="alert">
                                        <p id="txtAssetState" name="txtAssetState">{Asset State</p>
                                    </div>
                                </div>

                            </div>

                     
                        <div class="container separator">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-muted"><i class="fa-solid fa-check"></i> Asset Validations</h5>
                                    <table class="table ">
                                        <thead class="text-center thead-light">
                                            <th>Validation Name</th>
                                            <th>Validation Value</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody id="tableAssetValidationsResume" name="tableAssetValidationsResume">
                                        </tbody>
                                    </table>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

            <!-- Custom JS codes -->
            <script src="../custom components/js/side-bar.js"></script>
            <script src="../custom components/js/js_tagger_assetDetails.js"></script>

</body>



</html>