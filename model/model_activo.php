<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the number of assets available for the class
    function modelClassAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM RESUMEN_ACTIVOS_CLASE');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

?>