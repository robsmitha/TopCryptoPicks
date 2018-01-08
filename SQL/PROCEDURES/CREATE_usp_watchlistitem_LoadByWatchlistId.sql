DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlistitem_LoadByWatchlistId`
(
	 IN paramWatchlistId INT
)
BEGIN
	SELECT
		`watchlistitem`.`Id` AS `Id`,
		`watchlistitem`.`Name` AS `Name`,
		`watchlistitem`.`Symbol` AS `Symbol`,
		`watchlistitem`.`WatchlistId` AS `WatchlistId`,
		`watchlistitem`.`AddDate` AS `AddDate`
	FROM `watchlistitem`
	WHERE 		`watchlistitem`.`WatchlistId` = paramWatchlistId;
END //
DELIMITER ;