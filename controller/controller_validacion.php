<?php

    #Include dependencies
    include_once '../model/model_validacion.php';
    

    #Function to complete validation information
    if(isset($_POST['completeValidation'])) {

        $assetID = $_POST['assetID'];
        $validationID = $_POST['validationID'];
        $value = $_POST['value'];
        
        $creationResult = modelCreateNewValidation($assetID,$validationID,$value);

        $outputList[0]['Result'] = $creationResult;

        echo(json_encode($outputList));
    }
    
    #Function to update validation information
    if(isset($_POST['updateValidation'])) {

        $assetID = $_POST['assetID'];
        $validationID = $_POST['validationID'];
        $value = $_POST['value'];
        
        $creationResult = modelUpdateValidation($assetID,$validationID,$value);

        $outputList[0]['Result'] = $creationResult;

        echo(json_encode($outputList));
    }
    
?>