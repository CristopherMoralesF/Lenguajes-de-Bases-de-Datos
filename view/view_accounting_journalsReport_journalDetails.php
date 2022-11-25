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
    width: 50%;
    margin-left: 30px;
}
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Journal Detail</h1>
                <h4 class="text-muted" id='txtJournalID' name='txtJournalID'>Journal ID: {Journal ID}</h4>

                <div class="container separator">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-muted"><i class="fa-regular fa-calendar"></i> Creation Date:</h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="txtCreationDate" name="txtCreationDate">{Creation Date}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row lineSeparator">
                            <div class="col-12">
                                <h5 class="text-muted"><i class="fa-regular fa-file-lines"></i> Journal Description:
                                </h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="txtJournalDescription" name=txtJournalDescription>{Journal Description}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row lineSeparator">
                            <div class="col-12">
                                <h5 class="text-muted"><i class="fa-regular fa-building"></i> Class Description: </h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="txtClassDescription" name="txtClassDescription">{Class Description}</p>
                                </div>

                            </div>
                        </div>

                        <div class="row lineSeparator">
                            <div class="col-12">
                                <h5 class="text-muted"><i class="fa-solid fa-hand-holding-dollar"></i> Total Amount</h5>
                                <div class="alert alert-info alert-size" role="alert">
                                    <p id="textTotalAmount" name="textTotalAmount">{Total Amount}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="container separator">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-muted"><i class="fa-solid fa-calculator"></i> Journal Body</h5>
                                <table class="table ">
                                    <thead class="text-center thead-light">
                                        <th>Line</th>
                                        <th>GL Account</th>
                                        <th>Line Description</th>
                                        <th>Debits</th>
                                        <th>Credits</th>
                                        <th>Balance</th>
                                    </thead>
                                    <tbody id="tableJournalResume" name="tableJournalResume">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

    <!-- Custom JS codes -->
    <script src="../custom components/js/side-bar.js"></script>
    <script src="../custom components/js/js_accounting_journalReport_journalDetails.js"></script>

</body>



</html>