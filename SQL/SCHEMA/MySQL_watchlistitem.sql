/*
Author:			This code was generated by DALGen version 1.1.0.0 available at https://github.com/H0r53/DALGen 
Date:			1/3/2018
Description:	Creates the watchlistitem table and respective stored procedures

*/


USE topcryptopicks;



-- ------------------------------------------------------------
-- Drop existing objects
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `topcryptopicks`.`watchlistitem`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_Load`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_LoadAll`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_Add`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_Update`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_Delete`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_watchlistitem_Search`;


-- ------------------------------------------------------------
-- Create table
-- ------------------------------------------------------------



CREATE TABLE `topcryptopicks`.`watchlistitem` (
Id INT AUTO_INCREMENT,
Name VARCHAR(50),
Symbol VARCHAR(5),
WatchlistId INT,
AddDate DATETIME,
CONSTRAINT pk_watchlistitem_Id PRIMARY KEY (Id),
CONSTRAINT fk_watchlistitem_WatchlistId_watchlist_Id FOREIGN KEY (WatchlistId) REFERENCES watchlist (Id)
);


-- ------------------------------------------------------------
-- Create default SCRUD sprocs for this table
-- ------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_Load`
(
	 IN paramId INT
)
BEGIN
	SELECT
		`watchlistitem`.`Id` AS `Id`,
		`watchlistitem`.`Name` AS `Name`,
		`watchlistitem`.`Symbol` AS `Symbol`,
		`watchlistitem`.`WatchlistId` AS `WatchlistId`,
		`watchlistitem`.`AddDate` AS `AddDate`
	FROM `watchlistitem`
	WHERE 		`watchlistitem`.`Id` = paramId;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_LoadAll`
()
BEGIN
	SELECT
		`watchlistitem`.`Id` AS `Id`,
		`watchlistitem`.`Name` AS `Name`,
		`watchlistitem`.`Symbol` AS `Symbol`,
		`watchlistitem`.`WatchlistId` AS `WatchlistId`,
		`watchlistitem`.`AddDate` AS `AddDate`
	FROM `watchlistitem`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_Add`
(
	 IN paramName VARCHAR(50),
	 IN paramSymbol VARCHAR(5),
	 IN paramWatchlistId INT,
	 IN paramAddDate DATETIME
)
BEGIN
	INSERT INTO `watchlistitem` (Name,Symbol,WatchlistId,AddDate)
	VALUES (paramName, paramSymbol, paramWatchlistId, paramAddDate);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_Update`
(
	IN paramId INT,
	IN paramName VARCHAR(50),
	IN paramSymbol VARCHAR(5),
	IN paramWatchlistId INT,
	IN paramAddDate DATETIME
)
BEGIN
	UPDATE `watchlistitem`
	SET Name = paramName
		,Symbol = paramSymbol
		,WatchlistId = paramWatchlistId
		,AddDate = paramAddDate
	WHERE		`watchlistitem`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_Delete`
(
	IN paramId INT
)
BEGIN
	DELETE FROM `watchlistitem`
	WHERE		`watchlistitem`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_Search`
(
	IN paramId INT,
	IN paramName VARCHAR(50),
	IN paramSymbol VARCHAR(5),
	IN paramWatchlistId INT,
	IN paramAddDate DATETIME
)
BEGIN
	SELECT
		`watchlistitem`.`Id` AS `Id`,
		`watchlistitem`.`Name` AS `Name`,
		`watchlistitem`.`Symbol` AS `Symbol`,
		`watchlistitem`.`WatchlistId` AS `WatchlistId`,
		`watchlistitem`.`AddDate` AS `AddDate`
	FROM `watchlistitem`
	WHERE
		COALESCE(watchlistitem.`Id`,0) = COALESCE(paramId,watchlistitem.`Id`,0)
		AND COALESCE(watchlistitem.`Name`,'') = COALESCE(paramName,watchlistitem.`Name`,'')
		AND COALESCE(watchlistitem.`Symbol`,'') = COALESCE(paramSymbol,watchlistitem.`Symbol`,'')
		AND COALESCE(watchlistitem.`WatchlistId`,0) = COALESCE(paramWatchlistId,watchlistitem.`WatchlistId`,0)
		AND COALESCE(CAST(watchlistitem.`AddDate` AS DATE), CAST(NOW() AS DATE)) = COALESCE(CAST(paramAddDate AS DATE),CAST(watchlistitem.`AddDate` AS DATE), CAST(NOW() AS DATE));
END //
DELIMITER ;


