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

    <title>Journal Detail</title>
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

                <h1 class="mt-4">Tagger</h1>
                <h4 class="text-muted">Asses Report</h4>

                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <table class="table table-striped" id='journalsResume' name='journalsResume'>
                                <thead class="text-center table-striped thead-dark">
                                    <th>Asset Description</th>
                                    <th>Acquisition Value</th>
                                    <th>Acquisition Date</th>
                                    <th>Class Description</th>
                                    <th>Usefull Life</th>
                                    <th>Depreciated Months</th>
                                    <th>Owner</th>
                                    <th>Edit</th>
                                </thead>
                                <tbody id="tableAssetsResume" name="tableAssetsResume">
                                </tbody>
                            </table>

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
    <script src="../custom components/js/js_tagger_assetList.js"></script>

</body>



</html>