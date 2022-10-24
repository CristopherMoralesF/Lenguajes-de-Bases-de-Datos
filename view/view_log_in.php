<DOCTYPE HTML>
<meta charset = "utf8" />

<?php 

    include '../model/model_sql_connector.php';

    //Validate the connection printing the users in the screen
    $conn = openOracleConnection(); 

    if (!$conn){

        $m = oci_error();
        echo $m['message'];
        exit;

    } else {

        echo "Connected to Oracle Successfully <br><br>";

        $sqlQuery = oci_parse($conn,'SELECT * FROM USUARIO');
        oci_execute($sqlQuery);

        while ($row = oci_fetch_array($sqlQuery,OCI_ASSOC+OCI_RETURN_NULLS)) {

            echo '<br>';
            echo $row['NOMBRE'] . ' - Correo: ' . $row['CORREO'];
            echo '<br>';

        }

    }

    closeOracleConnection($conn);

?>