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

?>