<?php

// Function to get movie information for a particular movie
function moviesByTitle($conn, $movieID) {
    $strGetMovieInfo = "CALL `pMovieByID`($movieID)";
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
    echo '<tr>';
    echo '<td>' . "Location(s): " . $row['fLocationName'] .'</td>';
    echo '</tr>';
}
