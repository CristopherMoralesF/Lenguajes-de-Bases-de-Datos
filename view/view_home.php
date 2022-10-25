<?php
    include_once 'components/navigation.php';
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

<body class="sb-nav-fixed">

    <?php printNavigationPanel() ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">My Dashboard</h1>
                <h4 class="text-muted">Open Assets</h4>

                <div class="container-fluid" style = "margin-top: 25px;">
                    <div class="col col-lg-6">
                        <table class="table">
                            <thead>
                                <th scope="col">Asset Type</th>
                                <th scope="col">Count of Assets</th>
                                <th scope="col">Total Balance</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Vehicules</td>
                                    <td>5</td>
                                    <td>250000.00</td>
                                    <td><button type="button" class="btn btn-info text-light">Details</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>

            </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../custom components/js/side-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>

</body>



</html>