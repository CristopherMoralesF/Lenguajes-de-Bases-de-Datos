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

    //Create a function to create a new account
    function modelCreateNewAccount($account,$accountDescription,$accountCategory,$accountNature){

        //Open connection with DB
        $conn = openOracleConnection();

        //Create SQL Query
        $sqlQuery = "BEGIN CREATE_ACCOUNT(:IN_ACCOUNT,:IN_ACCOUNT_DESCRIPTION,:IN_ACCOUNT_CATEGORY,:IN_ACCOUNT_NATURE,:OUT_RESULT); END;";

        //Execute SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        $accountCategory = (int)$accountCategory;

        //Create variables values
        oci_bind_by_name($stmt,':IN_ACCOUNT',$account,32);
        oci_bind_by_name($stmt,':IN_ACCOUNT_DESCRIPTION',$accountDescription,32);
        oci_bind_by_name($stmt,':IN_ACCOUNT_CATEGORY',$accountCategory,32);
        oci_bind_by_name($stmt,':IN_ACCOUNT_NATURE',$accountNature,32);
        oci_bind_by_name($stmt,':OUT_RESULT',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        return $response;
        
    }

?>