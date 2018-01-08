DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_watchlist_LoadByCustomerId`
(
	 IN paramCustomerId INT
)
BEGIN
	SELECT
		`watchlist`.`Id` AS `Id`,
		`watchlist`.`CustomerId` AS `CustomerId`
	FROM `watchlist`
	WHERE 		`watchlist`.`CustomerId` = paramCustomerId;
END //
DELIMITER ;