<?php

    include_once 'model_sql_connector.php';

    //Create a function to load the resume of the journals
    function modelAssetsResume(){

        $instance = openOracleConnection();
        $sqlQuery = oci_parse($instance,'SELECT * FROM RESUMEN_ASIENTOS');
        oci_execute($sqlQuery);
        closeOracleConnection($instance);
        
        return $sqlQuery;
    }

    //Create a function to load the information related to the accounting equation
    function modelAccountingEquation(){

        //Open Connection 
        $instance = openOracleConnection();

        $sqlQuery = oci_parse($instance,'SELECT * FROM ECUACION_CONTABLE');
        oci_execute($sqlQuery);

        closeOracleConnection($instance);

        return $sqlQuery;
 
    }

    //Create function to load the information related to the journal header detail
    function modelJournalHeader($journalID) {

        //Open Connection
        $instance = openOracleConnection();

        $sqlQuery = oci_parse($instance,"SELECT * FROM RESUMEN_ASIENTOS WHERE ID_ASIENTO = $journalID");
        oci_execute($sqlQuery);

        closeOracleConnection($instance);
        
        return $sqlQuery;

    }

    //Create function to load the body of a journal based on the ID. 
    function modelJournalBody($journalID) {

         //Open DataBase Connection
         $conn = openOracleConnection();

         //Create query string
         $stmt = "BEGIN
            RESUMEN_ASIENTO_LINEAS_BODY(:IN_ASIENTO_ID,:OUT_RESUMEN_ASIENTO);
         END;";
 
         //Execute the statement
         $stmt = oci_parse($conn,$stmt);
 
         oci_bind_by_name($stmt,":IN_ASIENTO_ID",$journalID,8,OCI_B_INT);
 
         //Create the cursor
         $journalBodyResume = oci_new_cursor($conn);
 
         //Bind the cursor resource to the Oracle argument
         oci_bind_by_name($stmt,":OUT_RESUMEN_ASIENTO",$journalBodyResume,-1,OCI_B_CURSOR);
 
         //Execute the statement
         oci_execute($stmt);
 
         //Execute the cursor
         oci_execute($journalBodyResume);
 
         closeOracleConnection($conn);
 
         return $journalBodyResume;



    }

    #Create a function to create the JE Header
    //Create a new validation
    function modelCreateManualJEHeader($journalDescription){

        $conn = openOracleConnection();

        //Create the SQL Query
        $sqlQuery = "BEGIN
                        CREATE_JOURNAL_HEADER(:IN_DESCRIPCION,:OUT_ID_ASIENTO);
                    END;";

        //Execute the SQL Query
        $stmt = oci_parse($conn,$sqlQuery);

        //Create variables values
        oci_bind_by_name($stmt,':IN_DESCRIPCION',$journalDescription,32);
        oci_bind_by_name($stmt,':OUT_ID_ASIENTO',$response,32);

        //Execute the stmt
        oci_execute($stmt);

        closeOracleConnection($conn);

        return $response;

    }


?>