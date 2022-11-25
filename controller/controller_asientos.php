<?php

    #Include dependencies
    include_once '../model/model_asiento.php';

    #Create a JSON reply to Frond End to plot the resume of values
    if(isset($_GET['journalsReportResume'])){

        #load list of assets 
        $journals = modelAssetsResume();
        $i = 0;

        #Create a list with the items
        while($journal = oci_fetch_array($journals,OCI_ASSOC+OCI_RETURN_NULLS)) {

           $outputList[$i]['ID_ASIENTO'] = $journal["ID_ASIENTO"];
           $outputList[$i]['FECHA'] = $journal["FECHA"];
           $outputList[$i]['DESCRIPCION'] = $journal["DESCRIPCION"];
           $outputList[$i]['DESCRIPCION_CLASE'] = $journal["DESCRIPCION_CLASE"];
           $outputList[$i]['TOTAL_ASIENTO'] = $journal["TOTAL_ASIENTO"];
           $i++;
        
        }

        //Convert the list to json and return it to the JS file
        echo (json_encode($outputList));
    }

    //Validate accounting equation information
    if(isset($_GET['accountingEquation'])){

        
        #load the results of the query
        $indicators = modelAccountingEquation();

        while($indicator = oci_fetch_array($indicators,OCI_ASSOC+OCI_RETURN_NULLS)){

            #Save the results of the information in an array
            $outputList[$indicator['CATEGORIA']] = $indicator['TOTAL_BALANCE'];

        }

        #Return the array to the frond end. 
        echo(json_encode($outputList));

    }

    //Get the information about one of the journals required
    if(isset($_GET['journalHeaderResume'])) {

        #Get the journal id
        $journalID = $_GET['JournalID'];

        #Get the Header Information
        $journalResume = modelJournalHeader($journalID);

        while($journal = oci_fetch_array($journalResume,OCI_ASSOC+OCI_RETURN_NULLS)) {

            $outputList['ID_ASIENTO'] = $journal["ID_ASIENTO"];
            $outputList['FECHA'] = $journal["FECHA"];
            $outputList['DESCRIPCION'] = $journal["DESCRIPCION"];
            $outputList['DESCRIPCION_CLASE'] = $journal["DESCRIPCION_CLASE"];
            $outputList['TOTAL_ASIENTO'] = $journal["TOTAL_ASIENTO"];
         
         }

         echo(json_encode($outputList));

    }

    if(isset($_GET['journalBodyResume'])) {

        #Get the journal id
        $journalID = $_GET['JournalID'];

        #Get the body information
        $journalBodyLines = modelJournalBody($journalID);
        $outputList = [];
        $i = 0;

        #Iterate for each of the lines and print in the result
        while ($entryLine = oci_fetch_assoc($journalBodyLines)) {
            $outputList[$i]['ID_ASIENTO_LINEA'] = $entryLine['ID_ASIENTO_LINEA'];
            $outputList[$i]['ID_CUENTA_CONTABLE'] = $entryLine['ID_CUENTA_CONTABLE'];
            $outputList[$i]['DESCRIPCION_LINEA'] = $entryLine['DESCRIPCION_LINEA'];
            $outputList[$i]['DEBITO'] = $entryLine['DEBITO'];
            $outputList[$i]['CREDITO'] = $entryLine['CREDITO'];
            $outputList[$i]['BALANCE'] = $entryLine['BALANCE'];
            $i++;
        }

        echo(json_encode($outputList));
    }
?>