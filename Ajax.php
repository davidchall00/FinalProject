<?php

include_once 'DB.php';
include_once 'GetData.php';

$strFunction = strGetPOSTParam('function');

switch ($strFunction) {
    case 'GetMovies':
        //get the MovieID sent via query string
        $iSelMovieID = strGetPOSTParam('movieID');

        //connect to the database
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');

        //call the function to build and return the list of movies by the MovieID
        moviesByTitle($conn, $iSelMovieID);
        break;

}

function strGetPOSTParam($strParamName) {
    $strParamValue = filter_input(INPUT_POST, $strParamName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return $strParamValue;
}
