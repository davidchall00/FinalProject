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

/* view to have persons birthplace with names */
CREATE VIEW `vPersonBirth` AS
SELECT `tPeople`.`fPersonID`, `tPeople`.`fPriFirstName`, `tPeople`.`fPriLastname`, `tPeople`.`fBorn`, `tPeople`.`fDied`, `tLocations`.`fLocationName` AS `fBirthPlace`
FROM `tPeople` INNER JOIN `tLocations`
ON `tPeople`.`fBirthPlaceID` = `tLocations`.`fLocationID`;

DROP VIEW `vPersonBirth`;

/* view to have all information about a person and films in one place*/
CREATE VIEW `vFullPersonInfo` AS
SELECT `tMovies`.`fMovieID`, `tMovies`.`fTitle`, `tPersonMovieRoles`.`fPersonID`, `tPersonMovieRoles`.`fRoleID`, `vPersonBirth`.`fPriFirstName`, `vPersonBirth`.`fPriLastname`, `vPersonBirth`.`fBorn`, `vPersonBirth`.`fDied`, `vPersonBirth`.`fBirthPlace`, `tNames`.`fAltName`
FROM `tMovies` INNER JOIN `tPersonMovieRoles`
	ON `tMovies`.`fMovieID` = `tPersonMovieRoles`.`fMovieID`
    INNER JOIN `vPersonBirth`
    	ON `tPersonMovieRoles`.`fPersonID` = `vPersonBirth`.`fPersonID`
    LEFT JOIN `tNames`
    	ON `vPersonBirth`.`fPersonID` = `tNames`.`fPersonID`;

DROP VIEW `vFullPersonInfo`;

/* procedure to get the movies by MovieID */
CREATE PROCEDURE `pMovieByID`(`prmMovieID` INTEGER)
SELECT `fMovieID`, `fTitle`, `fStudioName`, `fReleased`, `fRunTime`, `fLocationName`
FROM `vFullMovieInfo`
WHERE `fMovieID` = `prmMovieID`;

DROP PROCEDURE `pMovieByID`;

/* A view to have FilmID with a persons role and full name */
CREATE VIEW `vPersonRoles` AS
SELECT `tPersonMovieRoles`.`fPersonID`, `tPersonMovieRoles`.`fMovieID`, `tPersonMovieRoles`.`fRoleID`, `tPeople`.`fPriFirstName`, `tPeople`.`fPriLastname`
FROM `tPersonMovieRoles` INNER JOIN `tPeople`
ON `tPersonMovieRoles`.`fPersonID` = `tPeople`.`fPersonID`;

DROP VIEW `vPersonRoles`;

/* procedure to get a cast members movie */
CREATE PROCEDURE `pMovieCast`(`prmMovieID` INTEGER)
SELECT `fMovieID`, `fPersonID`, `fRoleID`, `fPriFirstName`, `fPriLastName`
FROM `vPersonRoles`
WHERE `fMovieID` = `prmMovieID` AND `fRoleID` = 1;

DROP PROCEDURE `pMovieCast`;

/* procedure to get a producers movie */
CREATE PROCEDURE `pMovieDirect`(`prmMovieID` INTEGER)
SELECT `fMovieID`, `fPersonID`, `fRoleID`, `fPriFirstName`, `fPriLastName`
FROM `vPersonRoles`
WHERE `fMovieID` = `prmMovieID` AND `fRoleID` = 2;

DROP PROCEDURE `pMovieDirect`;

/* procedure to get a directors movie */
CREATE PROCEDURE `pMovieProduce`(`prmMovieID` INTEGER)
SELECT `fMovieID`, `fPersonID`, `fRoleID`, `fPriFirstName`, `fPriLastName`
FROM `vPersonRoles`
WHERE `fMovieID` = `prmMovieID` AND `fRoleID` = 3;

DROP PROCEDURE `pMovieProduce`;

/* procedure to get all info on a person when their link is chosen */
CREATE PROCEDURE `pPersonInfo` (`prmPersonID` INTEGER, `prmRoleID` INTEGER)
SELECT  `fPriFirstName`, `fPriLastName`, `fPersonID`, `fRoleID`, `fBorn`, `fDied`,
 `fBirthPlace`, `fTitle`
FROM `vFullPersonInfo`
WHERE `fPersonID` = `prmPersonID` AND `fRoleID` = `prmRoleID`;

DROP PROCEDURE `pPersonInfo`;

/* procedure to get a persons AKA names */
CREATE PROCEDURE `pPersonAKA`(`prmPersonID` INTEGER)
SELECT `fPersonID`, `fAltName`
FROM `tNames`
WHERE `fPersonID` = `prmPersonID`;

DROP PROCEDURE `pPersonAKA`;

