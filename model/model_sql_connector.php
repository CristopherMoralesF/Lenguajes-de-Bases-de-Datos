<?php 

    //Create Oracle database connection
    function openOracleConnection(){

        $conn = oci_connect("CRIS","CRIS270497","//localhost/orcl");
        return $conn;
        
    }

    //Close the connection
    function closeOracleConnection($connection){
        oci_close($conn);
    }

?>