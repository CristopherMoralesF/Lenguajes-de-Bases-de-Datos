<?php

    include_once 'model_sql_connector.php';

    //Validate if a user exists an return the information. 
    function modelConsultarUsuario($userEmail,$userPassword) {
        
        //Create connection with the sql and brind the values with the correct email and password
        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM USUARIO');
        oci_execute($sqlQuery);
        
        return $sqlQuery;

    }
  
    function buscarUsuarioPorId($id)
    {
        $conn=openOracleConnection();
 
        $sql = 'BEGIN Buscar_por_id_usuarios(:id, :message); END;';
        
        $stmt = oci_parse($conn,$sql);
        
        oci_bind_by_name($stmt,':id',$id,32);
        
       
        oci_bind_by_name($stmt,':message',$message,32);
        
        
        
       
        
       
         oci_execute($stmt);
         echo "<table border='1' class=".'table table-dark'." >

<tr>

<th>Informacion</th>


</tr>";

 



  echo "<tr>";

  echo "<td>" . $message . "</td>";

  echo "</tr>";

  

echo "</table>";
        return ;
    }

    function validar_usuarios($correo , $password)
    {
        $conn=openOracleConnection();
 
        $sql = 'BEGIN  validar_usuarios(:correo ,:password ,:nombre,:role ,:alerta); END;';
        
        $stmt = oci_parse($conn,$sql);
        
        oci_bind_by_name($stmt,':correo',$correo,32);
        
       
        oci_bind_by_name($stmt,':password',$password,32);
        
        oci_bind_by_name($stmt,':nombre',$nombre,32);
        
        oci_bind_by_name($stmt,':role',$role,32);
        
        oci_bind_by_name($stmt,':alerta',$alerta,32);

        
         oci_execute($stmt);

         session_start();
         
         $_SESSION['nombre'] =$nombre;
         $_SESSION['role'] = $role;

         session_write_close();

       return $alerta;

    }

    function crearUsuario($nombre,$correo , $password,$role)
    {
        $conn=openOracleConnection();
 
        $sql = 'BEGIN  crear_usuario(:nombre,:correo ,:password ,:role ,:alerta); END;';
        
        $stmt = oci_parse($conn,$sql);
        
        oci_bind_by_name($stmt,':correo',$correo,32);
        
       
        oci_bind_by_name($stmt,':password',$password,32);
        
        oci_bind_by_name($stmt,':nombre',$nombre,32);
        
        oci_bind_by_name($stmt,':role',$role,32);
        
        oci_bind_by_name($stmt,':alerta',$alerta,32);

        
         oci_execute($stmt);


       return $alerta;

    }




    function MostrarTablaCursor()
    {

     $conn=openOracleConnection();

    $stid = oci_parse($conn, 'begin :cursor :=mostrar_Tabla_Usuarios(); end;');
    $p_cursor = oci_new_cursor($conn);

    oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);
    

    
    oci_execute($stid);

    oci_free_statement($stid);

   return $p_cursor;

    } 
?>