/*a view to access name of studio with the movie title*/
CREATE VIEW `vStudios` AS 
SELECT `fMovieID`, `fTitle`, `tMovies`.`fStudioID`, `fReleased`, `fRunTime`, 
	`fStudioName` 
FROM `tMovies` INNER JOIN `tStudios` 
ON `tMovies`.`fStudioID` = `tStudios`.`fStudioID`;

DROP VIEW `vStudios`;


/* a view to have all movie info together for the movie info panel (2) */
CREATE VIEW `vFullMovieInfo` AS 
SELECT `vStudios`.`fMovieID`, `vStudios`.`fTitle`, `vStudios`.`fStudioName`,
`vStudios`.`fReleased`,`vStudios`.`fRunTime`,
`tLocations`.`fLocationName` 
FROM (`vStudios` INNER JOIN `tMovieLocations` 
ON `vStudios`.`fMovieID` = `tMovieLocations`.`fMovieID` 
) INNER JOIN `tLocations` 
ON `tMovieLocations`.`fLocationID` = `tLocations`.`fLocationID`;

DROP VIEW `vFullMovieInfo`;
