<?php

    include_once 'model_sql_connector.php';

    //Create a function to get the GL Accounts Resume
    function modelAccountsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM ACCOUNTS_RESUME');

        oci_execute($sqlQuery);

        closeOracleConnection($instance);

        return $sqlQuery;
        
    }

    //Create a function to get a balance resume for each account
    function modelAccountBalanceResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM ACCOUNTS_BALANCE_RESUME');

        oci_execute($sqlQuery);

        closeOracleConnection($instance);

        return $sqlQuery;
    }

?>