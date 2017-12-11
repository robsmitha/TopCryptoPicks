use topcryptopicks;
DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_LoadByCustomerId`
(
	 IN paramCustomerId INT
)
BEGIN
	SELECT DISTINCT
		`cart`.`Id` AS `Id`,
		`cart`.`CustomerId` AS `CustomerId`,
		`cart`.`StatusTypeId` AS `StatusTypeId`,
		`cart`.`CreateDate` AS `CreateDate`,
		`cart`.`CheckoutDate` AS `CheckoutDate`
	FROM `cart`
	WHERE 		`cart`.`CustomerId` = paramCustomerId
	AND `cart`.`StatusTypeId` = 4;  -- active cart
END //
DELIMITER ;