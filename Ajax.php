<?php

include_once 'DB.php';

$strFunction = strGetPOSTParam('function');

switch ($strFunction) {
    case 'GetMovies':
        //get the MovieID sent via query string
        $iSelMovieID = strGetPOSTParam('movieID');

        //connect to the database
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');

        //call the function to build and return the list of movies by the MovieID
        $strGetMovieInfo = "CALL `pMovieByID`($iSelMovieID)";
        $rsMovieInfo = $conn->query($strGetMovieInfo);
        $row = $rsMovieInfo->fetch();
        echo '<tr>';
        echo '<td><h2>' . $row['fTitle'] . '</h2></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . "Studio: " . $row['fStudioName'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . "Release Year: " . $row['fReleased'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . "Running Time: " . $row['fRunTime'] . " minutes" . '</td>';
        echo '</tr>';
        break;

    case 'GetCast':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieCast`' . '(' . $iSelMovieID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsCastInfo = $conn->query($strQuery);
        echo '<thead><h3>Cast Member(s):</h3></thead>';
        foreach ($rsCastInfo as $row) {
            echo '<tr>';
            echo '<td>' . '<a href="#" onclick="vShowPerson(' . $row['fRoleID'] . ', '
            . $row['fPersonID'] . ')"; return false;>' . $row['fPriFirstName'] .
            ' ' . $row['fPriLastname'] . '</td>' . '</a>';
            echo '</tr>';
        }
        break;

    case 'GetDirector':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieDirect`' . '(' . $iSelMovieID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsDirectInfo = $conn->query($strQuery);
        echo '<thead><h3>Director(s):</h3></thead>';
        foreach ($rsDirectInfo as $row) {
            echo '<tr>';
            echo '<td>' . '<a href="#" onclick="vShowPerson(' . $row['fRoleID'] . ', '
            . $row['fPersonID'] . ')"; return false;>' . $row['fPriFirstName'] .
            ' ' . $row['fPriLastname'] .
            '</td>' . '</a>';
            echo '</tr>';
        }
        break;

    case 'GetProducer':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'CALL `pMovieProduce`' . '(' . $iSelMovieID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsProduceInfo = $conn->query($strQuery);
        echo '<thead><h3>Producer(s):</h3></thead>';
        foreach ($rsProduceInfo as $row) {
            echo '<tr>';
            echo '<td>' . '<a href="#" onclick="vShowPerson(' . $row['fRoleID'] . ', '
            . $row['fPersonID'] . '); return false;">' . $row['fPriFirstName'] .
            ' ' . $row['fPriLastname'] .
            '</td>' . '</a>';
            echo '</tr>';
        }
        break;

    case 'GetLocation':
        $iSelMovieID = strGetPOSTParam('movieID');
        $strQuery = 'Call `pMovieByID`' . '(' . $iSelMovieID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsLocalInfo = $conn->query($strQuery);
        echo '<tr>Filming Locations:</tr>';
        foreach ($rsLocalInfo as $row) {
            echo '<tr>';
            echo '<td>' . $row['fLocationName'] . '</td>';
            echo '</tr>';
        }
        break;

    case 'GetPersonInfo':
        $iSelRoleID = strGetPOSTParam('roleID');
        $iSelPersonID = strGetPOSTParam('personID');
        $strQuery = 'Call `pPersonInfo`(' . $iSelPersonID . ', ' . $iSelRoleID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsPersonInfo = $conn->query($strQuery);
        $row = $rsPersonInfo->fetch();
        echo '<tr><td><h2>' . $row['fPriFirstName'] . ' ' . $row['fPriLastname'] .
        '</h2></td></tr>';
        echo '<tr><td>Date of Birth: ' . $row['fBorn'] . '</td></tr>';
        echo '<tr><td>Born in: ' . $row['fBirthPlace'] . '</td></tr>';
        if ($row['fDied'] !== null) {
            echo '<tr><td>Died: ' . $row['fDied'] . '</td></tr>';
        }
        break;

    case 'GetAKA':
        $iSelRoleID = strGetPOSTParam('roleID');
        $iSelPersonID = strGetPOSTParam('personID');
        $strQuery = 'Call `pPersonAKA`(' . $iSelPersonID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsPersonAKA = $conn->query($strQuery);
        if ($rsPersonAKA->rowCount() > 0) {
            echo '<tr><td><h3>AKA:</h3></tr></td>';
            foreach ($rsPersonAKA as $row) {
                if ($row['fAltName'] !== null) {
                    echo '<tr><td>' . $row['fAltName'] . '</td></tr>';
                }
            }
        }
        break;

    case 'GetPersonMovies':
        $iSelRoleID = strGetPOSTParam('roleID');
        $iSelPersonID = strGetPOSTParam('personID');
        $strQuery = 'Call `pPersonInfo`(' . $iSelPersonID . ', ' . $iSelRoleID . ')';
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');
        $rsPersonMovies = $conn->query($strQuery);
        echo '<tr><td><h3>Movies:</h3></tr></td>';
        foreach ($rsPersonMovies as $row) {
            echo '<tr><td>' . $row['fTitle'] . '</td></tr>';
        }
        break;
}

function strGetPOSTParam($strParamName) {
    $strParamValue = filter_input(INPUT_POST, $strParamName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    return $strParamValue;
}
