<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the number of assets available for the class
    function modelLocationResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM LOCATION_RESUME');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

    //Create a function to load the number of assets available for the class
    function modelStateResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM STATE_RESUME');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

?>