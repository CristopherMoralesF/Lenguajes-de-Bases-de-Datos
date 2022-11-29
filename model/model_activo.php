<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the number of assets available for the class
    function modelClassAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM RESUMEN_ACTIVOS_CLASE');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

    //Create a function to load the basic stats of an asset
    function modelAssetIndResume(){

        $conn = openOracleConnection();

        

        $stmt = "BEGIN
                    FUNC_ESTATUS_ACTIVOS(:IN_USER_ID,:OUT_KPI_RESUME);
                END;";

        //Execute the statement
        $stmt = oci_parse($conn,$stmt);

        $usuarioID = 1;
        oci_bind_by_name($stmt,":IN_USER_ID",$usuarioID,8,OCI_B_INT);

        // Create a new cursor resource
        $KPI_Resume = oci_new_cursor($conn);

        // Bind the cursor resource to the Oracle argument
        oci_bind_by_name($stmt,":OUT_KPI_RESUME",$KPI_Resume,-1,OCI_B_CURSOR);

         // Execute the statement
        oci_execute($stmt);

        // Execute the cursor
        oci_execute($KPI_Resume);

        closeOracleConnection($conn);

        return $KPI_Resume;
 
    }

?>