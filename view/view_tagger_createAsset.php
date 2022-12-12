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
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Admin</h1>
                <h4 class="text-muted">Create Class</h4>

                <div class="container separator">
                    <div class="row offset-md-1" style="width: 80%">

                        <p class="text-muted">Complete all the information to create a new asset, take into
                            consideration that the creation of an asset will generate a new journal document impacting
                            the asset class accounts</p>

                        <div class="container">
                            <div class="row">
                                <div class="col-6">

                                    <label for="selClass">Asset Class</label>
                                    <select name="selClass" id="selClass" class="form-control">
                                        <!-- load options with JS -->
                                    </select>
                                    
                                    <br><br>
    
                                    <label for="selLocation">Asset Location</label>
                                    <select name="selLocation" id="selLocation" class="form-control">
                                        <!-- load options with JS -->
                                    </select>

                                    <br><br>

                                    <label for="selAssetOwner">Asset Owner</label>
                                    <select name="selAssetOwner" id="selAssetOwner" class="form-control">
                                        <!-- load options with JS -->
                                    </select>

                                    <br><br>

                                    <label for="selAssetState">Asset State</label>
                                    <select name="selAssetState" id="selAssetState" class="form-control">
                                        <!-- load options with JS -->
                                    </select>

                                </div>
                                <div class="col-6">

                                    <label for="txtAssetDescription">Asset Description</label>
                                    <input type="text" id="txtAssetDescription" name=txtAssetDescription
                                        class="form-control" placeholder="Indicate the asset description">
                                    
                                        <br><br>
                
                                    <label for="txtAcquisitionValue">Asset Acquisition Value</label>
                                    <input type="number" id="txtAcquisitionValue" name=txtAcquisitionValue
                                        class="form-control" placeholder="Indicate the asset acquisition value">

                                        <br><br>

                                    <label for="txtAcquisitionDate">Asset Acquisition Date</label>
                                    <input type="date" id="txtAcquisitionDate" name=txtAcquisitionDate
                                        class="form-control" placeholder="Indicate the asset acquisition date">

                                </div>
                            </div>
                            <div class="row" style = 'margin-top: 75px'>
                                <div class="text-center">
                                    <button class="btn btn-primary" id="btnSaveClass" name="btnSaveClass"
                                        onclick="createAsset()">
                                        <i class="fa-solid fa-plus"></i> Add New Asset
                                    </button>
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

    <script src="../vendor/sweetAlert/sweetAlert.js"></script>

    <!-- Custom JS codes -->
    <script src="../custom components/js/side-bar.js"></script>
    <script src="../custom components/js/custom sweetAlerts.js"></script>
    <script src="../custom components/js/js_tagger_createAsset.js"></script>


</body>



</html>