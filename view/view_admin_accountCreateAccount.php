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
                <h4 class="text-muted">Create Account</h4>



                <div class="container separator">
                    <div class="row offset-md-3" style="width: 50%">

                        <p class = "text-muted">Complete all the information required to create a new GL Account</p>

                        <form action="POST" class="form">
                            <label for="txtGLACcount">GL Account</label>
                            <input type="text" id="txtGLAccount" name="txtGLAccount"
                                placeholder='follow the correct format' class="form-control" required>

                            <br><br>

                            <label for="txtAccountDescription">Account Description</label>
                            <input type="text" id="txtAccountDescription" name="txtAccountDescription"
                                placeholder='Indicate the account description' class="form-control" requried>

                            <br><br>

                            <label for="selNatureSelect">Account Nature</label>
                            <select name="selNatureSelect" id="selNatureSelect" class="form-control">
                                <option value="1">Activos</option>
                                <option value="2">Pasivos</option>
                                <option value="3">Capital</option>
                                <option value="4">Ingresos</option>
                                <option value="5">Gastos</option>
                            </select>

                            <br><br>

                            <label for="selNatureSelect">Account Nature</label>
                            <select name="selNatureSelect" id="selNatureSelect" class="form-control">
                                <option value="D">Debit</option>
                                <option value="C">Credit</option>
                            </select>

                            <br>

                            <div class="text-center">
                                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Account</button>
                            </div>

                        </form>

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


</body>



</html>