<?php

    include_once '../model/model_usuario.php';
    $cursorC=MostrarTablaCursor();
    
    $mensaje;
    if(isset($_POST['btn_login'])){

        $correo = $_POST['login'];
        $password   = $_POST['password'];

      //Validacion es alerta que returna en el metodo 
        $validacion=validar_usuarios($correo , $password);
       if($validacion=="Se ha logrado ingresar"){
        
        Header('Location: ../view/view_home.php');
    }
    else if($validacion=='No se ha logrado ingresar'){
   echo'<div class="'.'alert alert-danger'.'" role="'.'alert'.'">
    '.$validacion.'
  </div>';




;

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

if(isset($_POST['alter_usuario'])){
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $correo = $_POST['email'];
  $password   = $_POST['password'];
  $role = $_POST['role'];
//Validacion es alerta que returna en el metodo 
  $mensaje=alterarUsuario($id,$nombre,$correo , $password ,$role);
 if($mensaje=="Se ha logrado alterar correctamente el usuario"){
  
  echo '<script language="javascript">alert("'.$mensaje.'");</script>';
}
else if($mensaje=="No se encontro usuario") {
  echo '<script language="javascript">alert("'.$mensaje.'");</script>';
  
}

}


if(isset($_POST['buscar_usuario'])){

  $id = $_POST['idbuscar'];
 
 
//Validacion es alerta que returna en el metodo 
  
list($id_out,$nombre,$correo,$password,$alerta)=buscarUsuario($id);


 if($alerta=="Se ha encontrado Usuario"){
  
  echo '<script language="javascript">alert("'.$alerta.'");</script>';


}
else if($alerta=="No se ha logrado encontrar usuario") {
  echo '<script language="javascript">alert("'.$alerta.'");</script>';
  
}

}



  

function mostrarDatos($cursorC)
{
  oci_execute($cursorC);  
  while (($row = oci_fetch_array($cursorC, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {


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
  
  oci_free_statement($cursorC);
}

if(isset($_GET['user_list'])){

  #Load list of users
  $users = modelConsultarUsuario();
  $i = 0;

  #Create a list with users information
  while($user = oci_fetch_array($users,OCI_ASSOC+OCI_RETURN_NULLS)) {

    $outputList[$i]['ID_USUARIO'] = $user["ID_USUARIO"];
    $outputList[$i]['NOMBRE'] = $user["NOMBRE"];
    $outputList[$i]['CORREO'] = $user["CORREO"];
    $outputList[$i]['ID_ROLE'] = $user["ID_ROLE"];
    $i++;
 
 }

 //Convert the list to json and return it to the JS file
 echo (json_encode($outputList));

}

?>