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

    <title>Journals Detail - New Journal</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../custom components/img/web_icon.png">
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

.input-size {
    width: 100%;
    background: transparent;
    border: none;
}

input:focus {
    outline: none;
}
</style>

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <h1 class="mt-4">Journal Detail</h1>
                <h4 class="text-muted" id='txtJournalID' name='txtJournalID'>New Journal Form</h4>

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
                                    <input type="text" name="inpJournalDescription" id="inpJournalDescription"
                                        class='input-size' placeholder='Input Journal Description'>
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

                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add
                                    Line</button>

                                <button type="button" class="btn btn-primary" id = "saveJournal" name = "saveJournal" style = 'display: none'><i class="far fa-save"></i> Guardar
                                    Asiento</button>

                                <p id="journalValidation" class='text-danger' style='padding: 10px'><i
                                        class='fa-solid fa-bomb'></i> Add a new line to the JE body</p>
                                <table class="table " style="margin-top: 10px;" id='tblJournalBody'
                                    name='tblJournalBody'>
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

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h4 class="text-muted" style='padding:15px'>Add Journal Line</h4>
                        <div style="margin: 15px">

                            <label for='selAccount'>GL Account</label>
                            <select name="selAccount" id="selAccount" class="form-select">
                                <!-- Options loaded by JS function  -->
                            </select>

                            <label for='selNature' style='margin-top: 25px;'>Nature</label>
                            <select name="selNature" id="selNature" class="form-select">
                                <option value="1">Debit</option>
                                <option value="2">Credit</option>
                            </select>

                            <label for='txtFormLineDescription' style='margin-top: 25px;'>Line Description</label>
                            <input type='text' class='form-control' id='txtFormLineDescription'
                                name='txtFormLineDescription' required>

                            <label for='txtFormAmount' style='margin-top: 25px;'>Line Amount</label>
                            <input type='number' class='form-control' id='txtFormAmount' name='txtFormAmount' required>

                            <div class="d-flex justify-content-center align-items-center" style="100vh">
                                <button class='btn btn-primary ' style='margin-top: 25px;' onclick='submitLine()'><i
                                        class="fa-solid fa-plus"></i> Add Line</button>
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
    <script src="../custom components/js/js_accounting_journalReport_addJournal.js"></script>

</body>



</html>