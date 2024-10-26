<?php
    $servername = "localhost";
    $username = "HuyTinhBanGiay";
    $password = "111111";
    $dbname = "bangiay";

    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    if (!$conn)
    {
    die ("Could not connect to MySQL
    Database".mysqli_error());
    }
     
?>