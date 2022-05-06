<?php

   //Use the machine name and instance if multiple instances are used
    //Define Port
    $port='Port=1433';
    

    $server = '10.0.0.10';
    $user = 'web.desarrollo';
    $pass = 'web';
    $database = 'webdesarrollo';


    $connection_string = "DRIVER={SQL Server};SERVER=$server;$port;DATABASE=$database";
    $conn = odbc_connect($connection_string,$user,$pass);
    if ($conn) {
        echo "Connection established.";
    } else{
        die("Connection could not be established.");
    }


    /*
    $sql = "SELECT * FROM st3_200 WHERE identifier = 1";

    $result = odbc_exec($conn,$sql);
    // Get Data From Result
      while ($data[] = odbc_fetch_array($result));

      // Free Result
      odbc_free_result($result);

      */
      // Close Connection
      odbc_close($conn);

      // Show data
     // print_r($data);


?>