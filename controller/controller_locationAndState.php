<?php

    #Include dependencies
    include_once '../model/model_locationAndState.php';

    #Create a JSON reply to Frond End to plot the resume of locations
    if(isset($_GET['locationResume'])){

        #load list of assets 
        $classes = modelLocationResume();
        $i = 0;


         #Create the list that will be return to the front end 
         while($class = oci_fetch_array($classes,OCI_ASSOC+OCI_RETURN_NULLS)){

            $outputList[$i]['ID_UBICACION'] = $class['ID_UBICACION'];
            $outputList[$i]['ID_EDIFICIO'] = $class['ID_EDIFICIO'];
            $outputList[$i]['DESCRIPCION_SECCION'] = $class['DESCRIPCION_SECCION'];
            $i++;
        }

        #Return the list
        echo(json_encode($outputList));
    }
    
    #Create a JSON reply to Frond End to plot the resume of locations
    if(isset($_GET['stateResume'])){

        #load list of assets 
        $states = modelStateResume();
        $i = 0;

        #Create a list with the items
        while($state = oci_fetch_array($states,OCI_ASSOC+OCI_RETURN_NULLS)) {

           $outputList[$i]['ID_ESTADO'] = $state["ID_ESTADO"];
           $outputList[$i]['DESCRIPCION_ESTADO'] = $state["DESCRIPCION_ESTADO"];
           $i++;
        
        }

        //Convert the list to json and return it to the JS file
        echo(json_encode($outputList));
    }

?>