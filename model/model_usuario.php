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
  
?>