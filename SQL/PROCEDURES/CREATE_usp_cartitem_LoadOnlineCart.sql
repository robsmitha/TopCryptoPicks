use topcryptopicks;
DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cartitem_LoadOnlineCart`
(
	 IN paramCartId INT
)
BEGIN
	SELECT
		`subscription`.`Name` AS `Subscription`,
		`subscription`.`Description` AS `SubscriptionDescription`,
		`subscription`.`ImgUrl` AS `ImgUrl`,
		`subscription`.`Price` AS `Price`,
		(SELECT `statustype`.`Name` FROM `statustype` WHERE `statustype`.`Id` = `subscription`.`StatusTypeId`) AS `StatusType`,
		(SELECT CONCAT(`customer`.`FirstName`, " ", `customer`.`LastName`) FROM `customer` WHERE `customer`.`Id` = `cart`.`CustomerId`) AS `CustomerName`,
		`cartitem`.`Quantity` AS `Quantity`,
		`cartitem`.`SubscriptionStartDate` AS `SubscriptionStartDate`,
		`cartitem`.`SubscriptionEndDate` AS `SubscriptionEndDate`
	FROM `cartitem`
	JOIN `cart` ON `cart`.`id` = `cartitem`.cartId
	JOIN `subscription` ON `subscription`.`Id` = `cartitem`.`SubscriptionId`
	WHERE 		`cartitem`.`cartId` = paramCartId;
END //
DELIMITER ;