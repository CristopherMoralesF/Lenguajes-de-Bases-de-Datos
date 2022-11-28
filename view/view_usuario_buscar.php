<?php
    include_once 'components/navigation.php';
    include_once '../controller/controller_usuario.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../custom components/css/login.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<body class="sb-nav-fixed">

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

        

            <!-- Login Form -->
            <form method = "POST">
                <label>Buscar por id un usuario</label>
                <br>

                <input type="text" id="id" class="fadeIn second" name="id" placeholder="Buscar id">
                <input type="submit" class="fadeIn fourth" name = "btn_buscar_id" id = "btn_buscar_id" value="Buscar id">
            

                </div>
            </form>

            <!-- Remind Password -->
         
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