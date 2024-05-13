<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "erpproj";
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>