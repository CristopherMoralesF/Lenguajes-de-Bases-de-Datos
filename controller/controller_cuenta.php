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
    

    #Create a JSON reply to Frond End with the balance resume
    if(isset($_GET['getAccountBalanceResume'])){

        $accounts = modelAccountBalanceResume();
        $i = 0;

        #Create the list that will be return to the front end. 
        while($account = oci_fetch_array($accounts,OCI_ASSOC+OCI_RETURN_NULLS)){

            $outputList[$i]['ID_CUENTA'] = $account['ID_CUENTA'];
            $outputList[$i]['DESCRIPCION_CUENTA'] = $account['DESCRIPCION_CUENTA'];
            $outputList[$i]['NATURALEZA'] = $account['NATURALEZA'];
            $outputList[$i]['DESCRIPCION_CATEGORIA'] = $account['DESCRIPCION_CATEGORIA'];
            $outputList[$i]['TOTAL_DEBITOS'] = $account['TOTAL_DEBITOS'];
            $outputList[$i]['TOTAL_CREDITOS'] = $account['TOTAL_CREDITOS'];
            $outputList[$i]['BALANCE'] = $account['BALANCE'];
            $i++;
        }

        echo(json_encode($outputList));
    }