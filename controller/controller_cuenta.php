<?php

    #Include dependencies
    include_once '../model/model_cuenta.php';
    
    #Create a JSON reply to Frond End to plot the resume of values
    if(isset($_GET['getAccounts'])){

        $accounts = modelAccountsResume();
        $i = 0; 

        #Create the list that will be return to the front end with accoutns data
        while($account = oci_fetch_array($accounts,OCI_ASSOC+OCI_RETURN_NULLS)) {

            $outputList[$i]['ID_CUENTA'] = $account['ID_CUENTA'];
            $outputList[$i]['DESCRIPCION_CUENTA'] = $account['DESCRIPCION_CUENTA'];
            $i++;
        }

        #Return the list to the JS function
        echo(json_encode($outputList));

    }
    