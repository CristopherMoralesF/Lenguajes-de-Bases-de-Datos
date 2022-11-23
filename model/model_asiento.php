<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the resume of the journals
    function modelAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM RESUMEN_ASIENTOS');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

?>