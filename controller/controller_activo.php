<?php

    #Include dependencies
    include_once '../model/model_activo.php';

    #Create a JSON reply to Frond End to plot the resume of values
    if(isset($_GET['classAssetResume'])){

        #load list of assets 
        $assets = modelClassAssetsResume();
        $i = 0;

        #Create a list with the items
        while($asset = oci_fetch_array($assets,OCI_ASSOC+OCI_RETURN_NULLS)) {

           $outputList[$i]['Class'] = $asset["DESCRIPCION_CLASE"];
           $outputList[$i]['Total'] = $asset["TOTAL_ACTIVOS"];
           $i++;
        
        }

        //Convert the list to json and return it to the JS file
        echo (json_encode($outputList));
    }
    
    #Create a JSON reply with the resume of the indicators
    if(isset($_GET['AssetIndResume'])){

        #load list of indicators
        $indicators = modelAssetIndResume();
        
        $indicator = oci_fetch_assoc($indicators);

        $outputList['Valor Activos'] = $indicator['TOTAL_ACTIVOS'];
        $outputList['Total Inversion'] = $indicator['TOTAL_INVERSION'];

        echo (json_encode($outputList));
        

    }

?>