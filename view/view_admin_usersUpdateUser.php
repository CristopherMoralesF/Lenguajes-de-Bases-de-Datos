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
<h4 class="text-muted">Update User</h4>

<form method="POST" action="view_admin_usersUpdateUser.php" name="form">
<div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Buscar id Usuario</label>
        <input name="idbuscar"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <button type="submit" name="buscar_usuario"class="btn btn-primary">Buscar </button>
    </div>


</form>

<form method="POST" action="view_admin_usersUpdateUser.php">
    <input type="text" name="id" value="<?php echo (isset($id_out))?$id_out:'';?>" >
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Full Name</label>
        <input name="nombre"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo (isset($nombre))?$nombre:'';?>">
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Email</label>
        <input name="email"  type="email" class="form-control" id="exampleInputPassword1" value="<?php echo (isset($correo))?$correo:'';?>">
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password"  type="password" class="form-control" id="exampleInputPassword1"  value="<?php echo (isset($password))?$password:'';?>" >
    </div>

    <div class="mb-3">
        <label for="disabledSelect" class="form-label">Role</label>
        <select name="role" id="role" class="form-select">
            <option>ADMIN</option>
            <option>CONTADOR</option>
            <option>TAGGER</option>
        </select>
    </div>
  <br>
    <button type="submit" name="alter_usuario"class="btn btn-primary">Submit</button>
</form>

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