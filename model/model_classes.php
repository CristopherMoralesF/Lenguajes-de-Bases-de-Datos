<?php

    include_once 'model_sql_connector.php';

    //Create a function to get a resume of all open classes
    function modelClassesResume(){

        //Create connection and query
        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM CLASSES_LIST');

        //Execute query
        oci_execute($sqlQuery);

        //Close connection
        closeOracleConnection($instance);

        //Return query result
        return $sqlQuery;

    }

    //Create a function to create a new class
    function modelCreateNewClass($classDescription,$assetAccount,$accumDepAccount,$expenseAccount){

        $conn = openOracleConnection();

        //Create the SQL Query
        $sqlQuery = "BEGIN CREATE_CLASS(:VAR_CLASS_DESCRIPTION,:VAR_ASSET_ACCOUNT,:VAR_DEP_ACUM_ACCOUNT,:VAR_EXPENSE_ACCOUNT,:VAR_RESULT); END;";

        //Execute the SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        //Create variables values
        oci_bind_by_name($stmt,':VAR_CLASS_DESCRIPTION',$classDescription,32);
        oci_bind_by_name($stmt,':VAR_ASSET_ACCOUNT',$assetAccount,32);
        oci_bind_by_name($stmt,':VAR_DEP_ACUM_ACCOUNT',$accumDepAccount,32);
        oci_bind_by_name($stmt,':VAR_EXPENSE_ACCOUNT',$expenseAccount,32);
        oci_bind_by_name($stmt,':VAR_RESULT',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        closeOracleConnection($conn);

        return $response;

    }

?>