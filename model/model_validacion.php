<?php

    include_once 'model_sql_connector.php';

    //Create a function to complete first time the information of one asset validation
    function modelCreateNewValidation($assetID,$validationID,$value){

        //Open connection with DB
        $conn = openOracleConnection();

        //Create SQL Query
        $sqlQuery = "BEGIN 
                        VALIDATIONS.ADD_VALIDATION_INFORMATION(:IN_ASSET_ID,:IN_ID_TIPO_VALIDACION,:IN_VALOR_VALIDACION,:OUT_VALIDACION_ID);
                    END;";

        //Execute SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        //Create variables values
        oci_bind_by_name($stmt,':IN_ASSET_ID',$assetID,32);
        oci_bind_by_name($stmt,':IN_ID_TIPO_VALIDACION',$validationID,32);
        oci_bind_by_name($stmt,':IN_VALOR_VALIDACION',$value,32);
        oci_bind_by_name($stmt,':OUT_VALIDACION_ID',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        closeOracleConnection($conn);

        return $response;
        
    }

    //Create a function to update the information of a previous added value
    function modelUpdateValidation($assetID,$validationID,$value){

        //Open connection with DB
        $conn = openOracleConnection();

        //Create SQL Query
        $sqlQuery = "BEGIN 
                        VALIDATIONS.UPDATE_VALIDATION_INFORMATION(:IN_ASSET_ID,:IN_ID_TIPO_VALIDACION,:IN_VALOR_VALIDACION,:OUT_VALIDACION_ID);
                    END;";

        //Execute SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        //Create variables values
        oci_bind_by_name($stmt,':IN_ASSET_ID',$assetID,32);
        oci_bind_by_name($stmt,':IN_ID_TIPO_VALIDACION',$validationID,32);
        oci_bind_by_name($stmt,':IN_VALOR_VALIDACION',$value,32);
        oci_bind_by_name($stmt,':OUT_VALIDACION_ID',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        closeOracleConnection($conn);

        return $response;
        
    }

?>