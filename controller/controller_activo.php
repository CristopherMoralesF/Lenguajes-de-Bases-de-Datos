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

    #Create a JSON reply to Frond End to create a table with the assets resume
    if(isset($_GET['AssetResume'])){

        #load list of assets 
        $assets = modelAssetsResume();
        $i = 0;

        #Create a list with the items
        while($asset = oci_fetch_array($assets,OCI_ASSOC+OCI_RETURN_NULLS)) {

            $outputList[$i]['ID_ACTIVO'] = $asset["ID_ACTIVO"];
            $outputList[$i]['DESCRIPCION_ACTIVO'] = $asset["DESCRIPCION_ACTIVO"];
            $outputList[$i]['VALOR_ADQUISICION'] = $asset["VALOR_ADQUISICION"];
            $outputList[$i]['FECHA_ADQUISICION'] = $asset["FECHA_ADQUISICION"];
            $outputList[$i]['DESCRIPCION_CLASE'] = $asset["DESCRIPCION_CLASE"];
            $outputList[$i]['VIDA_UTIL'] = $asset["VIDA_UTIL"];
            $outputList[$i]['PERIODOS_DEPRECIADOS'] = $asset["PERIODOS_DEPRECIADOS"];
            $outputList[$i]['ID_EDIFICIO'] = $asset["ID_EDIFICIO"];
            $outputList[$i]['DESCRIPCION_SECCION'] = $asset["DESCRIPCION_SECCION"];
            $outputList[$i]['NOMBRE'] = $asset["NOMBRE"];
            $outputList[$i]['DESCRIPCION_ESTADO'] = $asset["DESCRIPCION_ESTADO"];
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

        #Define the level of risk according to compliance percentage
        
        $CompliancePercentaje = $indicator['COMPLIANCE_PERCENTAJE'];

        if ($CompliancePercentaje > 0 && $CompliancePercentaje <= 50) {
            $riskIndicator = 'High';
        } elseif ($CompliancePercentaje > 50 && $CompliancePercentaje <= 75) {
            $riskIndicator = "Mid";
        } else {
            $riskIndicator = "Low";
        };

        $outputList['Valor Activos'] = $indicator['TOTAL_ACTIVOS'];
        $outputList['Total Inversion'] = $indicator['TOTAL_INVERSION'];
        $outputList['Porcentaje Cumplimiento'] = $indicator['COMPLIANCE_PERCENTAJE'];
        $outputList['Activos Usuario'] = $indicator['TOTAL_ASSETS_OWN_BY_USER'];
        $outputList['Risk Indicator'] = $riskIndicator;

        echo (json_encode($outputList));
        

    }

    #Function to create a new asset
    if(isset($_POST['createAsset'])){

        $idClass = $_POST['idClass'];
        $idlocation = $_POST['idlocation'];
        $idOwner = $_POST['idOwner'];
        $idState = $_POST['idState'];
        $assetDescription = $_POST['assetDescription'];
        $value = $_POST['value'];
        $date = $_POST['date'];

        $createAsset = createAsset($idClass,$idlocation,$idOwner,$idState,$assetDescription,$value,$date);

        $outputList[0]['Result'] = $createAsset;

        echo(json_encode($outputList));

    }

    //Get a resume of the validations done for one asset
    if(isset($_POST['assetValidationResume'])){

        $idActivo =$_POST['idActivo'];

        $validationList = validationsResume($idActivo);
        $i = 0;

        while($validation = oci_fetch_array($validationList,OCI_ASSOC+OCI_RETURN_NULLS)) {

            $outputList[$i]['ID_TIPO_VALIDACION'] = $validation["ID_TIPO_VALIDACION"];
            $outputList[$i]['DESCRIPCION_VALIDACION'] = $validation["DESCRIPCION_VALIDACION"];
            $outputList[$i]['VALOR'] = $validation["VALOR"];
            $i++;
         
         }

         echo(json_encode($outputList));

    }

    //POST to run the depreciation for a selected class. 
    if(isset($_POST['runDepreciation'])){

        $idClass = $_POST['idClass'];
        $journalDescription = $_POST['journalDescription'];

        $runDepreciation = modelRunDepreciation($idClass,$journalDescription);

        $outputList['JournalID'] = $runDepreciation['Journal ID'];
        $i = 0;

        while($resume = oci_fetch_array($runDepreciation['cursorResult'],OCI_ASSOC+OCI_RETURN_NULLS)) {

            $outputList['Depreciation Resume'][$i]['DESCRIPCION_ACTIVO'] = $resume["DESCRIPCION_ACTIVO"];
            $outputList['Depreciation Resume'][$i]['VALOR_ADQUISICION'] = $resume["VALOR_ADQUISICION"];
            $outputList['Depreciation Resume'][$i]['FECHA_ADQUISICION'] = $resume["FECHA_ADQUISICION"];
            $outputList['Depreciation Resume'][$i]['PERIODOS_DEPRECIADOS'] = $resume["PERIODOS_DEPRECIADOS"];
            $outputList['Depreciation Resume'][$i]['DESCRIPCION_CLASE'] = $resume["DESCRIPCION_CLASE"];
            $outputList['Depreciation Resume'][$i]['VIDA_UTIL'] = $resume["VIDA_UTIL"];
            $outputList['Depreciation Resume'][$i]['ID_CLASE'] = $resume["ID_CLASE"];
            $outputList['Depreciation Resume'][$i]['DEPRECIACION_MENSUAL'] = $resume["DEPRECIACION_MENSUAL"];
            $outputList['Depreciation Resume'][$i]['DEPRECIACION_ACUMULADA'] = $resume["DEPRECIACION_ACUMULADA"];
            $i++;
         
         }

         echo(json_encode($outputList));

    
    }

    #Create a JSON reply to Frond End to get the asset subledger resume
    if(isset($_GET['getAssetSubledger'])){

        #load list of assets 
        $assets = modelSubledgerAssetsResume();
        $i = 0;

        #Create a list with the items
        while($asset = oci_fetch_array($assets,OCI_ASSOC+OCI_RETURN_NULLS)) {

           $outputList[$i]['DESCRIPCION_ACTIVO'] = $asset["DESCRIPCION_ACTIVO"];
           $outputList[$i]['DESCRIPCION_CLASE'] = $asset["DESCRIPCION_CLASE"];
           $outputList[$i]['FECHA_ADQUISICION'] = $asset["FECHA_ADQUISICION"];
           $outputList[$i]['VALOR_ADQUISICION'] = $asset["VALOR_ADQUISICION"];
           $outputList[$i]['VIDA_UTIL'] = $asset["VIDA_UTIL"];
           $outputList[$i]['PERIODOS_DEPRECIADOS'] = $asset["PERIODOS_DEPRECIADOS"];
           $outputList[$i]['DEPRECIACION_MENSUAL'] = $asset["DEPRECIACION_MENSUAL"];
           $outputList[$i]['DEPRECIACION_ACUMULADA'] = $asset["DEPRECIACION_ACUMULADA"];
           $i++;
        
        }

        //Convert the list to json and return it to the JS file
        echo (json_encode($outputList));
    }

?>