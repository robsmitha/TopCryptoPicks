use topcryptopicks;
DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cartitem_LoadByCartId`
(
	 IN paramCartId INT
)
BEGIN
	SELECT
		`cartitem`.`Id` AS `Id`,
		`cartitem`.`cartId` AS `cartId`,
		`cartitem`.`SubscriptionId` AS `SubscriptionId`,
		`cartitem`.`AddDate` AS `AddDate`,
		`cartitem`.`Quantity` AS `Quantity`,
		`cartitem`.`SubscriptionStartDate` AS `SubscriptionStartDate`,
		`cartitem`.`SubscriptionEndDate` AS `SubscriptionEndDate`
	FROM `cartitem`
	WHERE 		`cartitem`.`cartId` = paramCartId;
END //
DELIMITER ;