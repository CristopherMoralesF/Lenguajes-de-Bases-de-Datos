<?php

    include_once '../model/model_usuario.php';

    if(isset($_POST['btn_login'])){

        $email = $_POST['login'];
        $password   = $_POST['password'];

        $usuario = modelConsultarUsuario($email,$password);

        while ($row = oci_fetch_array($usuario,OCI_ASSOC+OCI_RETURN_NULLS)){

            session_start();
            $_SESSION['userName'] = $row['NOMBRE'];
            $_SESSION['userRole'] = $row['ID_ROLE'];

        }
        
        Header("Location: ../view/view_home.php");

    }

?>