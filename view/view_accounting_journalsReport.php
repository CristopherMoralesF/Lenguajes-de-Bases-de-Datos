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

                <h1 class="mt-4">Accounting</h1>
                <h4 class="text-muted">Journals Report</h4>

                <div class="container separator">
                    <div class="row text-center offset-md-2">

                        <div class="col-2">
                            <h4 class='text-muted'>Assets</h4>
                            <p class="text-muted">{Total Assets}</p>
                        </div>

                        <div class="col-1">
                            <div class="text-center">
                                <h1>
                                    +
                                </h1>
                            </div>
                        </div>

                        <div class="col-2">
                            <h4 class='text-muted'>Liabilities</h4>
                            <p class="text-muted">{Liabilities}</p>
                        </div>

                        <div class="col-1">
                            <div class="text-center">
                                <h1>
                                    =
                                </h1>
                            </div>
                        </div>

                        <div class="col-3">
                            <h4 class='text-muted'>Capital</h4>
                            <p class="text-muted">{Total Capital}</p>
                        </div>

                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <table class="table table-striped">
                                <thead class="text-center table-striped thead-dark">
                                    <th>Journal ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Class Description</th>
                                    <th>Total Debits</th>
                                    <th>Details</th>
                                </thead>
                                <tbody id="tableJournalResume" name = "tableJournalResume">
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
    <script src="../custom components/js/js_accounting_journalReport.js"></script>

</body>



</html>