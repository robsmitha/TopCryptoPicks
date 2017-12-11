use topcryptopicks;

INSERT INTO `statustype` (`Id`, `Name`, `Description`) VALUES (1, 'Active Subscription', 'Subscription will appear on site');
INSERT INTO `statustype` (`Id`, `Name`, `Description`) VALUES (2, 'Inactive Subscription', 'Subscription will not appear on site');
INSERT INTO `statustype` (`Id`, `Name`, `Description`) VALUES (3, 'On Sale Subscription', 'Subscription is on sale');
INSERT INTO `statustype` (`Id`, `Name`, `Description`) VALUES ('4', 'Active Cart', 'Cart has not been checkout and is recognized as active. We will not delete any active carts.');
INSERT INTO `statustype` (`Id`, `Name`, `Description`) VALUES ('5', 'Inactive Cart', 'Cart has been checked out or abandoned.');