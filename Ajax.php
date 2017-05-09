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

    case 'GetCast':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieCast`'.'('.$iSelMovieID.')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsCastInfo = $conn->query($strQuery);
        echo '<thead><h3>Cast Member(s):</h3></thead>';
        foreach ($rsCastInfo as $row) {
            echo '<tr>';
        echo '<td>'.'<a href="#" onclick="vShowPerson"; return false;>'.$row['fPriFirstName'].
                ' '.$row['fPriLastname'].'</td>'.'</a>';
            echo '</tr>';
        }
        break;
        
        case 'GetDirector':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieDirect`'.'('.$iSelMovieID.')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsDirectInfo = $conn->query($strQuery);
        echo '<thead><h3>Director(s):</h3></thead>';
        foreach ($rsDirectInfo as $row) {
            echo '<tr>';
            echo '<td>'.'<a href="#" onclick="vShowPerson"; return false;>'.$row['fPriFirstName'].
                    ' '.$row['fPriLastname'].
                    '</td>'.'</a>';
            echo '</tr>';
        }
        break;
        
        case 'GetProducer':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieProduce`'.'('.$iSelMovieID.')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsProduceInfo = $conn->query($strQuery);
        echo '<thead><h3>Producer(s):</h3></thead>';
        foreach ($rsProduceInfo as $row) {
            echo '<tr>';
            echo '<td>'.'<a href="#" onclick="vShowPerson"; return false;>'.$row['fPriFirstName'].
                    ' '.$row['fPriLastname'].
                    '</td>'.'</a>';
            echo '</tr>';
        }
        break;
        
        case 'GetLocation':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'Call `pMovieLocal`' . '('.$iSelMovieID.')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsLocalInfo = $conn->query($strQuery);
        echo '<tr>Filming Locations:</tr>';
        foreach ($rsLocalInfo as $row){
            echo '<tr>';
            echo '<td>'.$row['fLocationName'].'</td>';
            echo '</tr>';
        }
        break;     
}

function strGetPOSTParam($strParamName) {
$strParamValue = filter_input(INPUT_POST, $strParamName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
return $strParamValue;
}
