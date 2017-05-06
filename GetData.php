<?php

// Function to get movie information for a particular movie
function moviesByTitle($conn, $movieID) {
    $strGetMovieInfo = "CALL `pMovieByID`($movieID)";
    $rsMovieInfo = $conn->query($strGetMovieInfo);
    $row = $rsMovieInfo->fetch();
    echo '<h2>' . $row['fTitle'] . '</h2>';
    echo '<p>' . "Studio: " . $row['fStudioName'] . '</p>';
    echo '<p>' . "Release Year: " . $row['fReleased'] . '</p>';
    echo '<p>' . "Running Time: " . $row['fRunTime'] . " minutes" . '</p>';
    echo '<p>' . "Location(s):" . '</p><ul>';
    foreach ($rsMovieInfo as $rows) {
        echo '<li>' . $rows['fLocationName'] . '</li>';
    }
    echo '</ul>';
}

function castByMovie($conn, $movieID) {
    $strMovieCast = "CALL `pMovieCast` ($movieID)";
    $rsCastInfo = $conn->query($strMovieCast);
    $row = $rsCastInfo->fetch();
    foreach ($rsCastInfo as $row) {
        echo '<tr>';
        echo '<td>'.$row['fPriFirstName']." ".$row['fPriLastName'].'</td>';
        echo '</tr>';
    }
}
