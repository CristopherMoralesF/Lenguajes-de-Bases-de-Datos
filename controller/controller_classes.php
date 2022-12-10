<?php

    #Include dependencies 
    include_once '../model/model_classes.php';

    #Request classes resume to the controller and reply back to JS a JSON object
    if(isset($_GET['getClasses'])){
        
        $classes = modelClassesResume();
        $i = 0;

        #Create the list that will be return to the front end 
        while($class = oci_fetch_array($classes,OCI_ASSOC+OCI_RETURN_NULLS)){

            $outputList[$i]['ID_CLASE'] = $class['ID_CLASE'];
            $outputList[$i]['DESCRIPCION_CLASE'] = $class['DESCRIPCION_CLASE'];
            $outputList[$i]['CUENTA_ACTIVO'] = $class['CUENTA_ACTIVO'];
            $outputList[$i]['CUENTA_DEP_ACUMULADA'] = $class['CUENTA_ACTIVO'];
            $outputList[$i]['CUENTA_GASTO'] = $class['CUENTA_GASTO'];
            $i++;
        }

        #Return the list
        echo(json_encode($outputList));
    }

    #Function to create a new class
    if(isset($_POST['createClass'])){

        $classDescription = $_POST['classDescription'];
        $assetAccount = $_POST['assetAccount'];
        $accumDepAccount = $_POST['accumDepAccount'];
        $expenseAccount = $_POST['expenseAccount'];

        $creationResult = modelCreateNewClass($classDescription,$assetAccount,$accumDepAccount,$expenseAccount);

        $outputList[0]['Result'] = $creationResult;

        echo(json_encode($outputList));
        
    }

    // --------------------------------------- Functions related to classes validations ---------------------------------------
    //Generate list of validations for each class.
    if(isset($_GET['classesValidationList'])){

        $validationsList = modelClassesValidationList();
        $i = 0;

        while($validation = oci_fetch_array($validationsList,OCI_ASSOC+OCI_RETURN_NULLS)){

            $outputList[$i]['ID_TIPO_VALIDACION'] = $validation['ID_TIPO_VALIDACION'];
            $outputList[$i]['ID_CLASE'] = $validation['ID_CLASE'];
            $outputList[$i]['DESCRIPCION_VALIDACION'] = $validation['DESCRIPCION_VALIDACION'];
            $outputList[$i]['DESCRIPCION_CLASE'] = $validation['DESCRIPCION_CLASE'];
            $i++;
        }

        echo(json_encode($outputList));

    }

    //Create new validation
    if(isset($_POST['createValidation'])){

        $classID = $_POST['classID'];
        $validationDescription = $_POST['validationDescription'];

        $creationResult = modelCreateNewValidation($classID,$validationDescription);

        $outputList[0]['Result'] = $creationResult;

        echo(json_encode($outputList));
        
    }

?>