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
        $row = $rsCastInfo->fetch();
        foreach ($rsCastInfo as $row) {
            echo '<tr>';
            echo '<td>'.'<a href="#">'.$row['fPriFirstName'].'</td>'.'</a>';
            echo '</tr>';
        }
        break;
        
        case 'GetDirector':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieDirect`'.'('.$iSelMovieID.')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsDirectInfo = $conn->query($strQuery);
        $row = $rsDirectInfo->fetch();
        foreach ($rsDirectInfo as $row) {
            echo '<tr>';
            echo '<td>'.'<a href="#">'.$row['fPriFirstName'].'</td>'.'</a>';
            echo '</tr>';
        }
        break;
        
        case 'GetProducer':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'SELECT `fPersonID`, `fMovieID`, `fRoleID`, `fPriFirstName`, `fPriLastName`'.
                'FROM `pMovieDirect`'.
                'WHERE `fMovieID =' .$iSelMovieID. 'AND `fRoleID` = (3)';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsProduceInfo = $conn->query($strQuery);
        $row = $rsProduceInfo->fetch();
        foreach ($rsProduceInfo as $row) {
            echo '<tr>';
            echo '<td>'.'<a href="#">'.$row['fPriFirstName'].'</td>'.'</a>';
            echo '</tr>';
        }
        break;
}

        


function strGetPOSTParam($strParamName) {
$strParamValue = filter_input(INPUT_POST, $strParamName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
return $strParamValue;
}
