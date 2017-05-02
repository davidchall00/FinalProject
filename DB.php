<?php

function connectDB($userName, $password, $schema) {
     $conn = new PDO("mysql:host=localhost;dbname=$schema", $userName, $password);
        
        //tell PDO to throw an exception for every error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //tell MySQL to UTF-8 as the encoding for all names
        $conn->exec('SET NAMES "utf8"');
        
        return $conn;
}