<?php

    #Include dependencies 
    include_once '../model/model_reconciliation.php';

    #Request classes resume to the controller and reply back to JS a JSON object
    if(isset($_GET['getReconciliation'])){
        
        $reconciliation = modelClassesResume();
        $i = 0;

        #Create the list that will be return to the front end 
        while($line = oci_fetch_array($reconciliation,OCI_ASSOC+OCI_RETURN_NULLS)){

            $outputList[$i]['ID_CLASE'] = $line['ID_CLASE'];
            $outputList[$i]['ID_CUENTA'] = $line['ID_CUENTA'];
            $outputList[$i]['ID_CATEGORIA_CUENTA'] = $line['ID_CATEGORIA_CUENTA'];
            $outputList[$i]['DESCRIPCION_CLASE'] = $line['DESCRIPCION_CLASE'];
            $outputList[$i]['BALANCE'] = $line['BALANCE'];
            $outputList[$i]['VALOR_SUBLEDGER'] = $line['VALOR_SUBLEDGER'];
            $i++;
        }

        #Return the list
        echo(json_encode($outputList));
    }
        
?>