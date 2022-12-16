<?php

    include_once 'model_sql_connector.php';

    //Create a function to get the resume of the reconciliation for the accounts
    function modelClassesResume(){

        //Create connection and query
        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM CLASS_BALANCE_RECONCILIATION');

        //Execute query
        oci_execute($sqlQuery);

        //Close connection
        closeOracleConnection($instance);

        //Return query result
        return $sqlQuery;

    }
    
?>