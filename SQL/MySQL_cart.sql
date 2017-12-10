/*
Author:			This code was generated by DALGen version 1.1.0.0 available at https://github.com/H0r53/DALGen 
Date:			12/9/2017
Description:	Creates the cart table and respective stored procedures

*/


USE topcryptopicks;



-- ------------------------------------------------------------
-- Drop existing objects
-- ------------------------------------------------------------

DROP TABLE IF EXISTS `topcryptopicks`.`cart`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_Load`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_LoadAll`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_Add`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_Update`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_Delete`;
DROP PROCEDURE IF EXISTS `topcryptopicks`.`usp_cart_Search`;


-- ------------------------------------------------------------
-- Create table
-- ------------------------------------------------------------



CREATE TABLE `topcryptopicks`.`cart` (
Id INT AUTO_INCREMENT,
CustomerId INT,
StatusTypeId INT,
CreateDate DATETIME,
CheckoutDate DATETIME,
CONSTRAINT pk_cart_Id PRIMARY KEY (Id),
CONSTRAINT fk_cart_CustomerId_customer_Id FOREIGN KEY (CustomerId) REFERENCES customer (Id),
CONSTRAINT fk_cart_StatusTypeId_statustype_Id FOREIGN KEY (StatusTypeId) REFERENCES statustype (Id)
);


-- ------------------------------------------------------------
-- Create default SCRUD sprocs for this table
-- ------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_Load`
(
	 IN paramId INT
)
BEGIN
	SELECT
		`cart`.`Id` AS `Id`,
		`cart`.`CustomerId` AS `CustomerId`,
		`cart`.`StatusTypeId` AS `StatusTypeId`,
		`cart`.`CreateDate` AS `CreateDate`,
		`cart`.`CheckoutDate` AS `CheckoutDate`
	FROM `cart`
	WHERE 		`cart`.`Id` = paramId;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_LoadAll`
()
BEGIN
	SELECT
		`cart`.`Id` AS `Id`,
		`cart`.`CustomerId` AS `CustomerId`,
		`cart`.`StatusTypeId` AS `StatusTypeId`,
		`cart`.`CreateDate` AS `CreateDate`,
		`cart`.`CheckoutDate` AS `CheckoutDate`
	FROM `cart`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_Add`
(
	 IN paramCustomerId INT,
	 IN paramStatusTypeId INT,
	 IN paramCreateDate DATETIME,
	 IN paramCheckoutDate DATETIME
)
BEGIN
	INSERT INTO `cart` (CustomerId,StatusTypeId,CreateDate,CheckoutDate)
	VALUES (paramCustomerId, paramStatusTypeId, paramCreateDate, paramCheckoutDate);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_Update`
(
	IN paramId INT,
	IN paramCustomerId INT,
	IN paramStatusTypeId INT,
	IN paramCreateDate DATETIME,
	IN paramCheckoutDate DATETIME
)
BEGIN
	UPDATE `cart`
	SET CustomerId = paramCustomerId
		,StatusTypeId = paramStatusTypeId
		,CreateDate = paramCreateDate
		,CheckoutDate = paramCheckoutDate
	WHERE		`cart`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_Delete`
(
	IN paramId INT
)
BEGIN
	DELETE FROM `cart`
	WHERE		`cart`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `topcryptopicks`.`usp_cart_Search`
(
	IN paramId INT,
	IN paramCustomerId INT,
	IN paramStatusTypeId INT,
	IN paramCreateDate DATETIME,
	IN paramCheckoutDate DATETIME
)
BEGIN
	SELECT
		`cart`.`Id` AS `Id`,
		`cart`.`CustomerId` AS `CustomerId`,
		`cart`.`StatusTypeId` AS `StatusTypeId`,
		`cart`.`CreateDate` AS `CreateDate`,
		`cart`.`CheckoutDate` AS `CheckoutDate`
	FROM `cart`
	WHERE
		COALESCE(cart.`Id`,0) = COALESCE(paramId,cart.`Id`,0)
		AND COALESCE(cart.`CustomerId`,0) = COALESCE(paramCustomerId,cart.`CustomerId`,0)
		AND COALESCE(cart.`StatusTypeId`,0) = COALESCE(paramStatusTypeId,cart.`StatusTypeId`,0)
		AND COALESCE(CAST(cart.`CreateDate` AS DATE), CAST(NOW() AS DATE)) = COALESCE(CAST(paramCreateDate AS DATE),CAST(cart.`CreateDate` AS DATE), CAST(NOW() AS DATE))
		AND COALESCE(CAST(cart.`CheckoutDate` AS DATE), CAST(NOW() AS DATE)) = COALESCE(CAST(paramCheckoutDate AS DATE),CAST(cart.`CheckoutDate` AS DATE), CAST(NOW() AS DATE));
END //
DELIMITER ;


