<DOCTYPE HTML>
<meta charset = "utf8" />

<?php 

    include_once '../model/model_sql_connector.php'

    //Validate the connection printing the users in the screen
    $oracleConnection = openOracleConnection(); 

    if (!$oracleConnection) {

        $m = oci_error(); 
        echo $m['message'];
        exit; 
    } else {
        print "Connected to Oracle successfully"; 
    }

    oci_close($oracleConnection);

?>