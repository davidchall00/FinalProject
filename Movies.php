<?php
include_once 'DB.php';
?>
<p>
    <select name="selMovie" id="selMovie" onchange="vGetMovies(this);">
        <?php
        //Connect to the Movies database
        $conn = connectDB('CSC366', 'HC-CSC366', 'Movies');

        //run a query to get movie ids and names to put in the <select> element
        $strGetMovie = 'SELECT * FROM `tMovies` ORDER BY `fTitle`';
        $rsMovies = $conn->query($strGetMovie);

        //get the first row ie first movie seperately so we can get MovieID of first movie
        $row = $rsMovies->fetch();
        $iSelMovieID = $row['fMovieID'];

        //generate the option element for this movie
        echo '<option value="' . $iSelMovieID . '">' . $row['fTitle'] . '</option>';

        //loop through the rows in the result set returned
        foreach ($rsMovies as $row) {
            //each row is one movie, which will be an <option> element in the drop down list
            //put the id in the value attribute, name the content of the element
            echo '<option value="' . $row['fMovieID'] . '" >' . $row['fTitle'] .
            '</option>';
        }
        
        ?>
    </select>
</p>
