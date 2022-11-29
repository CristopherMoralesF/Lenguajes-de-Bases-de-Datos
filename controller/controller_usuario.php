<?php

    include_once '../model/model_usuario.php';
    $cursor=MostrarTablaCursor();
    $mensaje;
    if(isset($_POST['btn_login'])){

        $correo = $_POST['login'];
        $password   = $_POST['password'];

      //Validacion es alerta que returna en el metodo 
        $validacion=validar_usuarios($correo , $password);
       if($validacion=="Se ha logrado ingresar"){
        
        Header("Location: ../view/view_home.php");
    }
    else{
      echo'<div class="'.'alert alert-danger'.'" role="'.'alert'.'">
    '.$validacion.'
  </div>';
}
}


if(isset($_POST['guardar_usuario'])){

  $nombre = $_POST['nombre'];
  $correo = $_POST['email'];
  $password   = $_POST['password'];
  $role = $_POST['role'];
//Validacion es alerta que returna en el metodo 
  $mensaje=crearUsuario($nombre,$correo , $password ,$role);
 if($mensaje=="Se ha logrado ingresar correctamente el usuario"){
  
  echo '<script language="javascript">alert("'.$mensaje.'");</script>';
}
else if($mensaje=="Estos datos coinciden con un usuario de la base de datos") {
  echo '<script language="javascript">alert("'.$mensaje.'");</script>';
}

}



  

function mostrarDatos($cursor)
{
  oci_execute($cursor);  
  while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {


      echo'<table class="table">
      <thead>
        <tr>
          <th scope="col">#'.$row['ID_USUARIO'].'</th>
          <th scope="col">First Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
     
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row"></th>
          <td>'.$row['NOMBRE'].'</td>
          <td>'.$row['CORREO'].'</td>
          <td>'.$row['NOMBRE_ROLE'].'</td>
        </tr>
      </tbody>
    </table>';
  }
  
  oci_free_statement($cursor);
}

?>