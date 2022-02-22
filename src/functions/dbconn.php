<?php

    $servername = "monitor-mysql-domain";
    $username = "monitoradmin";
    $password = "top-secret";
    $dbname = "mymonitordb";


    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    }
?>
