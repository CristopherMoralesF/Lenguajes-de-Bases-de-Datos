<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the number of assets available for the class
    function modelClassAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM RESUMEN_ACTIVOS_CLASE');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

    //Create a function to load a full list of assets
    function modelAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM ASSETS_RESUME');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

    //Create a function to laod the table for main screen dashboard
    function modelAssetsResumeRiskTable(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM ASSETS_RISK_ASSESSMENT');
        oci_execute($sqlQuery);
        closeOracleConnection($instance);
        
        return $sqlQuery;

    }

    //Create a function to laod the table for main screen dashboard
    function modelAssetsResumeRisk(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM ASSETS_RISK_ASSESSMENT_RESUME');
        oci_execute($sqlQuery);
        closeOracleConnection($instance);
        
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
        
        session_start();
        $usuarioID = $_SESSION['id_usuario'];
        session_write_close();
        
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

    //Create a function to create a new asset
    function createAsset($idClass,$idlocation,$idOwner,$idState,$assetDescription,$value,$date){

        $conn = openOracleConnection();

        $sqlQuery = "BEGIN
                    CREATE_ASSET(:IN_ID_CLASE,:IN_ID_UBICACION,:IN_ID_OWNER,:IN_ID_ESTADO,:IN_DESCRIPCION,:IN_VALOR,:IN_FECHA,:OUT_RESULT);
                END;";

        //Execute the SQL Query
        $stmt = oci_parse($conn,$sqlQuery);
        
        //Create variables values
        oci_bind_by_name($stmt,':IN_ID_CLASE',$idClass,32);
        oci_bind_by_name($stmt,':IN_ID_UBICACION',$idlocation,32);
        oci_bind_by_name($stmt,':IN_ID_OWNER',$idOwner,32);
        oci_bind_by_name($stmt,':IN_ID_ESTADO',$idState,32);
        oci_bind_by_name($stmt,':IN_DESCRIPCION',$assetDescription,32);
        oci_bind_by_name($stmt,':IN_VALOR',$value,32);
        oci_bind_by_name($stmt,':IN_FECHA',$date,32);
        oci_bind_by_name($stmt,':OUT_RESULT',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        //Execute the stmt
        closeOracleConnection($conn);

        return $response;

    }

    //Create a function to bring the validations completed by one of the assets. 
    function validationsResume($assetID){

        $conn = openOracleConnection();

        $sqlQuery = "BEGIN
                        VALIDATE_RESUME_BY_ASSET(:IN_ASSET_ID,:OUT_RESULT);
                    END;";

        //Execute the SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        // Create a new cursor resource
        $KPI_Resume = oci_new_cursor($conn);
        

        oci_bind_by_name($stmt,":IN_ASSET_ID",$assetID,32);
        oci_bind_by_name($stmt,":OUT_RESULT",$KPI_Resume,-1,OCI_B_CURSOR);

        // Execute the statement
        oci_execute($stmt);

        // Execute the cursor
        oci_execute($KPI_Resume);

        closeOracleConnection($conn);

        return $KPI_Resume;

    }

    //Create a function to run the depreciacion for one of the classes
    function modelRunDepreciation($idClase,$descripcionJournal){

        $conn = openOracleConnection();

        $sqlQuery = "BEGIN
                        DEPRECIATION.RUN_DEPRECIATION(
                            :IN_ID_CLASE,
                            :IN_JE_DESCRIPCION,
                            :OUT_RESULT,
                            :OUT_RESULT_TEXT     
                        );
                    END;";

        //Execute the SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        // Create a new cursor resource
        $depreciationResult = oci_new_cursor($conn);
        

        oci_bind_by_name($stmt,":IN_ID_CLASE",$idClase,32);
        oci_bind_by_name($stmt,":IN_JE_DESCRIPCION",$descripcionJournal,32);
        oci_bind_by_name($stmt,":OUT_RESULT_TEXT",$finalJournalID,32);
        oci_bind_by_name($stmt,":OUT_RESULT",$depreciationResult,-1,OCI_B_CURSOR);

        // Execute the statement
        oci_execute($stmt);

        // Execute the cursor
        oci_execute($depreciationResult);

        closeOracleConnection($conn);

        $output['cursorResult'] = $depreciationResult;
        $output['Journal ID'] = $finalJournalID;

        return $output;

    }

    //Create a function to load the asset subledger resume
    function modelSubledgerAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM DEPRECIATION_SUBLEDGER');
        oci_execute($sqlQuery);

        return $sqlQuery;
    }

?>