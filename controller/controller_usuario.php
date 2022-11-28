<?php

    include_once '../model/model_usuario.php';

    if(isset($_POST['btn_login'])){

        $correo = $_POST['login'];
        $password   = $_POST['password'];

      //Validacion es alerta que returna en el metodo 
        $validacion=validar_usuarios($correo , $password);
       if($validacion=="Se ha logrado ingresar"){
        
        Header("Location: ../view/view_home.php");
    }
    echo'<div class="'.'alert alert-danger'.'" role="'.'alert'.'">
    '.$validacion.'
  </div>';


    }

    if(isset($_POST['btn_buscar_id']))
    {
    $id=$_POST['id'];
    buscarUsuarioPorId($id);
    }



?>