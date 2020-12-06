-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2019 at 04:07 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onfinancialmarkets`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_promotion` (IN `promotion_title` VARCHAR(100), IN `promotion_description` VARCHAR(700), IN `promotion_percentage` INT)  BEGIN

DECLARE message VARCHAR(50);

INSERT INTO promotion(promotion_title, promotion_description, promotion_percentage, promotion_datetime) VALUES(promotion_title, promotion_description, promotion_percentage, NOW());

SET message = 'PROMOTION ADDED';

SELECT message;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_new_users` (IN `UserID` VARCHAR(250), IN `f_name` CHAR(35), IN `l_name` CHAR(35), IN `user_email_auth` VARCHAR(250), IN `user_password` VARCHAR(250), IN `country` CHAR(50), IN `city_town` CHAR(50), IN `preferred_language` CHAR(50), IN `phone_no` VARCHAR(250), IN `date_of_birth` DATE, IN `street_number` INT, IN `residential_address` VARCHAR(150), IN `postal_zip_code` INT, IN `find_us_detail` CHAR(15), IN `account_type` CHAR(15), IN `account_base_currency` CHAR(15), IN `account_leverage` DECIMAL(15,4), IN `expected_investment_balance` DECIMAL(15,4))  BEGIN

DECLARE message VARCHAR(50);
DECLARE account_actual_balance DECIMAL(15,4);
DECLARE account_virtual_balance DECIMAL(15,4);
DECLARE account_promotion_status CHAR(4);  
DECLARE account_status CHAR(15); 

IF EXISTS(SELECT * FROM users WHERE user_email = user_email_auth)

THEN

			SET message = 'NOT REGISTERED';

			SELECT message;

ELSE

		SET account_actual_balance = 0;
		SET account_virtual_balance = 0;
		SET account_promotion_status = 'NO';
		SET account_status = 'NOT VERIFIED';
		
		INSERT INTO users(UserID, f_name, l_name, user_email, user_password, country, city_town, preferred_language, phone_no, date_of_birth, street_number, residential_address, postal_zip_code, find_us_detail) VALUES(UserID, f_name, l_name, user_email_auth, user_password, country, city_town, preferred_language, phone_no, date_of_birth, street_number, residential_address, postal_zip_code, find_us_detail);
        
        		INSERT INTO customer_account(account_type, account_status, account_created_at, account_base_currency, account_leverage, account_actual_balance, account_virtual_balance, expected_investment_balance, account_promotion_status, UserID) VALUES(account_type, account_status, NOW(), account_base_currency, account_leverage, account_actual_balance, account_virtual_balance, expected_investment_balance, account_promotion_status, UserID);

				SET message = 'REGISTERED';

				SELECT message;

END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user_national_identity` (IN `national_identity_name` CHAR(100), IN `national_identity_type` CHAR(100), IN `national_identity_number` BIGINT, IN `issue_date` DATE, IN `expire_date` DATE, IN `UserID_auth` VARCHAR(250))  BEGIN

DECLARE message VARCHAR(50);

UPDATE customer_account SET account_status = 'VERIFIED' WHERE UserID = UserID_auth;

INSERT INTO national_identity(national_identity_name, national_identity_type, national_identity_number, issue_date, expire_date, UserID) VALUES(national_identity_name, national_identity_type, national_identity_number, issue_date, expire_date, UserID_auth);

SET message = 'ACCOUNT IS VERIFIED';

	SELECT message;



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `amount_deposit` (IN `deposit_account_email` VARCHAR(250), IN `deposit_account_password` VARCHAR(250), IN `deposit_method_type` CHAR(25), IN `deposit_amount` DECIMAL(15,4), IN `UserID_auth` VARCHAR(250))  BEGIN

	DECLARE deposit_status CHAR(15);
	DECLARE get_account_status CHAR(15);
	DECLARE message VARCHAR(50);

	SET get_account_status = (SELECT account_status FROM customer_account WHERE UserID = UserID_auth);

	SET deposit_status = 'NOT APPROVED';

	IF(get_account_status = 'VERIFIED')

	THEN

	INSERT INTO deposit(deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, deposit_datetime, UserID) VALUES(deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, NOW(), UserID_auth);
	
		SET message =  'PAYMENT DONE';


	ELSE


		SET message =  'PlEASE VERIFY YOUR ACCOUNT';

	END IF;

	SELECT message;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `amount_withdraw` (IN `withdraw_account_email` VARCHAR(250), IN `withdraw_account_password` VARCHAR(250), IN `withdraw_method_type` CHAR(25), IN `withdraw_amount_auth` DECIMAL(15,4), IN `UserID_auth` VARCHAR(250))  BEGIN

	DECLARE get_account_actual_balance DECIMAL(15,4);
    DECLARE withdraw_status_auth CHAR(15);
	DECLARE message VARCHAR(50);
	DECLARE get_withdraw_request_balance DECIMAL(15,4);
	
	SET get_withdraw_request_balance = (SELECT SUM(withdraw_amount) FROM withdraw WHERE UserID = UserID_auth AND withdraw_status = 'NOT APPROVED');
	
	IF(get_withdraw_request_balance is null)

	THEN
	
		SET get_withdraw_request_balance = 0;
		
	END IF;

	
	SET get_account_actual_balance = (SELECT account_actual_balance FROM customer_account WHERE UserID = UserID_auth);

	SET withdraw_status_auth = 'NOT APPROVED';

	IF(withdraw_amount_auth <= (get_account_actual_balance - get_withdraw_request_balance))

	THEN

		INSERT INTO withdraw(withdraw_account_email, withdraw_account_password, withdraw_method_type, withdraw_amount, withdraw_status, withdraw_datetime, UserID) VALUES(withdraw_account_email, withdraw_account_password, withdraw_method_type, withdraw_amount_auth, withdraw_status_auth, NOW(), UserID_auth);

		SET message = 'TRANSACTION COMPLETED';

	ELSE


		SET message = 'WITHDRAWAL AMOUNT EXCEEDS CURRENT BALANCE';


	

END IF;

SELECT message;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `apply_bonus` (`UserID_auth` VARCHAR(250), `apply_bonus_amount` DECIMAL(15,4))  BEGIN

DECLARE promotion_status CHAR(15);
DECLARE get_account_virtual_balance DECIMAL(15,4);
DECLARE new_balance DECIMAL(15,4);
DECLARE message VARCHAR(50);

SET promotion_status = 'APPROVED';
SET get_account_virtual_balance = (SELECT account_virtual_balance FROM customer_account WHERE UserID = UserID_auth);
SET new_balance = get_account_virtual_balance + apply_bonus_amount;

IF EXISTS(SELECT * FROM users WHERE UserID = UserID_auth)

	THEN
	
INSERT INTO bonus_request(UserID, amount, promotion_status, request_datetime) VALUES(UserID_auth, apply_bonus_amount, promotion_status, NOW());

UPDATE customer_account SET account_virtual_balance = new_balance WHERE UserID = UserID_auth;
UPDATE customer_account SET account_promotion_status = 'YES' WHERE UserID = UserID_auth;

SET message = 'BONUS APPLIED';

	ELSE

		SET message = 'CUSTOMER NOT FOUND';
		
		

END IF;

SELECT message;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cancel_withdraw_request` (IN `WID_auth` INT, IN `deposit_account_email` VARCHAR(250), IN `deposit_account_password` VARCHAR(250), IN `deposit_method_type` CHAR(25), IN `deposit_amount` DECIMAL(15,4), IN `UserID_auth` VARCHAR(250))  BEGIN

	DECLARE deposit_status CHAR(15);
	DECLARE get_account_status CHAR(15);
	DECLARE message VARCHAR(50);

	UPDATE withdraw SET withdraw_status = 'CANCELLED' WHERE WID = WID_auth;
	
	SET get_account_status = (SELECT account_status FROM customer_account WHERE UserID = UserID_auth);

	SET deposit_status = 'APPROVED';

	IF(get_account_status = 'VERIFIED')

	THEN

	INSERT INTO deposit(deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, deposit_datetime, UserID) VALUES(deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, NOW(), UserID_auth);
	
		SET message =  'PAYMENT DONE';


	ELSE


		SET message =  'PlEASE VERIFY YOUR ACCOUNT';

	END IF;

	SELECT message;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_userpassword` (IN `UserID_auth` VARCHAR(250), IN `new_user_password` VARCHAR(250))  BEGIN

DECLARE message VARCHAR(50);

		SET message = 'PASSWORD CHANGED';

		UPDATE users SET user_password = new_user_password WHERE UserID = UserID_auth;

		SELECT message;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_login_Name` (IN `UserID` VARCHAR(250))  BEGIN

DECLARE message VARCHAR(50);


		SELECT * FROM users u , customer_account a WHERE u.UserID = a.UserID AND u.UserID = UserID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_login_UserID` (IN `user_email_auth` VARCHAR(250))  BEGIN

DECLARE message VARCHAR(50);


		SET message = (SELECT UserID FROM users WHERE user_email = user_email_auth);

		SELECT message;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_user` (IN `user_email_auth` VARCHAR(250), IN `user_password_auth` VARCHAR(250))  BEGIN

DECLARE message VARCHAR(50);

IF EXISTS(SELECT * FROM users WHERE user_email = user_email_auth AND user_password = user_password_auth)

	THEN
		
		SET message = 'SUCCESSFUL';
		
		SELECT message;


ELSE

		SET message = 'FAILED';
		
		SELECT message;

END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `our_users_status` ()  BEGIN
SELECT * FROM users u, customer_account a WHERE u.UserID = a.UserID;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_deposit_status` (IN `DID_auth` INT, IN `UserID_auth` VARCHAR(250))  BEGIN

	DECLARE message VARCHAR(50);
	DECLARE get_deposit_amount DECIMAL(15,4);
	DECLARE	get_account_actual_balance DECIMAL(15,4);
	DECLARE get_deposit_status CHAR(15);
	DECLARE new_balance DECIMAL(15,4);

	SET get_deposit_status = (SELECT deposit_status FROM deposit WHERE DID = DID_auth);
	
	IF(get_deposit_status != 'APPROVED')
	
	THEN
	
	UPDATE deposit SET deposit_status = 'APPROVED' WHERE DID = DID_auth;

	SET get_deposit_amount = (SELECT deposit_amount FROM deposit WHERE DID = DID_auth);

	SET get_account_actual_balance = (SELECT account_actual_balance FROM customer_account WHERE UserID = UserID_auth);

	SET new_balance = get_account_actual_balance + get_deposit_amount;

	UPDATE customer_account SET account_actual_balance = new_balance WHERE UserID = UserID_auth;
	
	SET message = 'PAYMENT APPROVED';
	
	
	
	ELSE
	
	SET message = 'ALREADY PAYMENT APPROVED';
	
	END IF;
	
	SELECT message;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_withdraw_status` (IN `WID_auth` INT, IN `UserID_auth` VARCHAR(250))  BEGIN

	DECLARE message VARCHAR(50);
	DECLARE get_withdraw_status CHAR(15);
        DECLARE	get_withdraw_amount DECIMAL(15,4);
	DECLARE	get_account_actual_balance DECIMAL(15,4);
	DECLARE new_balance DECIMAL(15,4);

	SET get_withdraw_status = (SELECT withdraw_status FROM withdraw WHERE WID = WID_auth);
	
	IF(get_withdraw_status != 'APPROVED')
	
	THEN

	UPDATE customer_account SET account_promotion_status = 'NO' WHERE UserID = UserID_auth;

UPDATE customer_account SET account_virtual_balance = 0 WHERE UserID = UserID_auth;

	UPDATE withdraw SET withdraw_status = 'APPROVED' WHERE WID = WID_auth;

	SET get_withdraw_amount = (SELECT withdraw_amount FROM withdraw WHERE WID = WID_auth);

	SET get_account_actual_balance = (SELECT account_actual_balance FROM customer_account WHERE UserID = UserID_auth);

	SET new_balance = get_account_actual_balance - get_withdraw_amount;

	UPDATE customer_account SET account_actual_balance = new_balance WHERE UserID = UserID_auth;
	
	SET message = 'WITHDRAW APPROVED';
	
	
	ELSE
	
	SET message = 'ALREADY WITHDRAW APPROVED';
	
	END IF;
	
	SELECT message;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `useraccount_requests` ()  BEGIN
SELECT * FROM users u, customer_account a WHERE u.UserID = a.UserID AND account_status = 'NOT VERIFIED';


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_bonus_status` (`UserID_auth` VARCHAR(250))  BEGIN


SELECT * FROM bonus_request WHERE UserID = UserID_auth;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_deposit_status` (IN `UserID_auth` VARCHAR(250))  BEGIN


SELECT * FROM deposit WHERE UserID = UserID_auth;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_withdraw_status` (IN `UserID_auth` VARCHAR(250))  BEGIN


SELECT * FROM withdraw WHERE UserID = UserID_auth;




END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bonus_request`
--

CREATE TABLE `bonus_request` (
  `BID` int(11) NOT NULL,
  `UserID` varchar(250) DEFAULT NULL,
  `amount` decimal(15,4) DEFAULT NULL,
  `promotion_status` char(15) DEFAULT NULL,
  `request_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonus_request`
--

INSERT INTO `bonus_request` (`BID`, `UserID`, `amount`, `promotion_status`, `request_datetime`) VALUES
(1, '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc=', '50.0000', 'APPROVED', '2019-08-15 17:23:47'),
(2, '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8=', '20.0000', 'APPROVED', '2019-08-15 22:45:56'),
(4, '1reH579PsGJ/E4Z5tDzs6lx1d/vSLY+If9zymc4mdKM=', '20.0000', 'APPROVED', '2019-08-21 17:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `AID` int(11) NOT NULL,
  `account_type` char(15) DEFAULT NULL,
  `account_status` char(15) DEFAULT NULL,
  `account_created_at` datetime DEFAULT NULL,
  `account_base_currency` char(15) DEFAULT NULL,
  `account_leverage` decimal(15,4) DEFAULT NULL,
  `account_actual_balance` decimal(15,4) DEFAULT NULL,
  `account_virtual_balance` decimal(15,4) DEFAULT NULL,
  `expected_investment_balance` decimal(15,4) DEFAULT NULL,
  `account_promotion_status` char(4) DEFAULT NULL,
  `UserID` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`AID`, `account_type`, `account_status`, `account_created_at`, `account_base_currency`, `account_leverage`, `account_actual_balance`, `account_virtual_balance`, `expected_investment_balance`, `account_promotion_status`, `UserID`) VALUES
(1, 'Standard', 'VERIFIED', '2019-08-15 14:14:02', 'USD', '0.0067', '200.0000', '0.0000', '1000.0000', 'NO', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(2, 'Standard', 'VERIFIED', '2019-08-15 17:35:49', 'USD', '0.0067', '424.0000', '0.0000', '500.0000', 'NO', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(3, 'Standard', 'VERIFIED', '2019-08-15 19:49:50', 'USD', '0.0100', '0.0000', '20.0000', '500.0000', 'YES', '1reH579PsGJ/E4Z5tDzs6lx1d/vSLY+If9zymc4mdKM='),
(4, 'Standard', 'VERIFIED', '2019-08-15 20:39:36', 'EUR', '0.0067', '0.0000', '0.0000', '200.0000', 'NO', '1reH579PsGJ/E4Z5tDzs6v0cR9i/AgPGDSn5DytUuRg=');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `DID` int(11) NOT NULL,
  `deposit_account_email` varchar(60) DEFAULT NULL,
  `deposit_account_password` varchar(60) DEFAULT NULL,
  `deposit_method_type` char(25) DEFAULT NULL,
  `deposit_amount` decimal(15,4) DEFAULT NULL,
  `deposit_status` char(15) DEFAULT NULL,
  `deposit_datetime` datetime DEFAULT NULL,
  `UserID` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`DID`, `deposit_account_email`, `deposit_account_password`, `deposit_method_type`, `deposit_amount`, `deposit_status`, `deposit_datetime`, `UserID`) VALUES
(2, 'btUJZsbRmg+p6ZDXzjUhiQ==', '', 'SKRILL', '123.0000', 'APPROVED', '2019-08-15 17:20:12', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(3, 'btUJZsbRmg+p6ZDXzjUhiQ==', '', 'SKRILL', '10.0000', 'APPROVED', '2019-08-15 17:22:30', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(4, 'btUJZsbRmg+p6ZDXzjUhiQ==', '', 'SKRILL', '100.0000', 'APPROVED', '2019-08-15 18:55:34', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(5, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '500.0000', 'APPROVED', '2019-08-15 22:42:06', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(6, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '10.0000', 'APPROVED', '2019-08-15 22:44:19', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(7, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '450.0000', 'APPROVED', '2019-08-15 22:44:44', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(8, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '15.0000', 'APPROVED', '2019-08-15 22:46:37', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(9, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '440.0000', 'APPROVED', '2019-08-15 22:47:15', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8=');

-- --------------------------------------------------------

--
-- Stand-in structure for view `deposit_status`
-- (See below for the actual view)
--
CREATE TABLE `deposit_status` (
`DID` int(11)
,`deposit_account_email` varchar(60)
,`deposit_account_password` varchar(60)
,`deposit_method_type` char(25)
,`deposit_amount` decimal(15,4)
,`deposit_status` char(15)
,`deposit_datetime` datetime
,`UserID` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `national_identity`
--

CREATE TABLE `national_identity` (
  `NID` int(11) NOT NULL,
  `national_identity_name` char(100) DEFAULT NULL,
  `national_identity_type` char(100) DEFAULT NULL,
  `national_identity_number` bigint(20) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `UserID` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `national_identity`
--

INSERT INTO `national_identity` (`NID`, `national_identity_name`, `national_identity_type`, `national_identity_number`, `issue_date`, `expire_date`, `UserID`) VALUES
(1, 'Ali Jamil', 'National Identity Card', 3460389526199, '2018-09-27', '2028-09-27', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(2, 'Umer Jamil', 'National Identity Card', 1234567890123, '2018-09-27', '2028-09-27', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(3, 'Adnan Jamil', 'Passport', 3460389526199, '2018-09-27', '2028-09-27', '1reH579PsGJ/E4Z5tDzs6lx1d/vSLY+If9zymc4mdKM='),
(4, 'Imran Jamil', 'Passport', 1234567890123, '2018-09-27', '2028-09-27', '1reH579PsGJ/E4Z5tDzs6v0cR9i/AgPGDSn5DytUuRg=');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `PID` int(11) NOT NULL,
  `promotion_title` varchar(100) DEFAULT NULL,
  `promotion_description` varchar(700) DEFAULT NULL,
  `promotion_percentage` int(11) DEFAULT NULL,
  `promotion_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` varchar(250) NOT NULL,
  `f_name` char(35) DEFAULT NULL,
  `l_name` char(35) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `user_password` varchar(60) DEFAULT NULL,
  `country` char(50) DEFAULT NULL,
  `city_town` char(50) DEFAULT NULL,
  `preferred_language` char(50) DEFAULT NULL,
  `phone_no` varchar(250) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `residential_address` varchar(150) DEFAULT NULL,
  `postal_zip_code` int(11) DEFAULT NULL,
  `find_us_detail` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `f_name`, `l_name`, `user_email`, `user_password`, `country`, `city_town`, `preferred_language`, `phone_no`, `date_of_birth`, `street_number`, `residential_address`, `postal_zip_code`, `find_us_detail`) VALUES
('1reH579PsGJ/E4Z5tDzs6lx1d/vSLY+If9zymc4mdKM=', 'Adnan', 'Jamil', 'Appn1Jw1yhDLVsPg69Iz4g==', 'k1a0/XNNb5URvzjwQ+k1XQ==', 'Saudi Arabia', 'Makkah', 'English', 'qdU1M7w3v+wn4wrf6w+wOg==', '2019-04-27', 151, 'Near Jarir Book Store', 45645, 'Facebook'),
('1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc=', 'Ali', 'Jamil', 'btUJZsbRmg+p6ZDXzjUhiQ==', 'k1a0/XNNb5URvzjwQ+k1XQ==', 'Pakistan', 'Lahore', 'English', 'qdU1M7w3v+wn4wrf6w+wOg==', '1995-04-27', 134, 'Thokar Niaz Baig, Ali Town', 3454, 'Google'),
('1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8=', 'Umer', 'Jamil', '+eaLdmoL12IgwozsPjC0bg==', 'k1a0/XNNb5URvzjwQ+k1XQ==', 'Saudia Arabia', 'Jeddah', 'English', 'qdU1M7w3v+wn4wrf6w+wOg==', '2019-04-27', 151, 'Al Kandara', 45645, 'Google'),
('1reH579PsGJ/E4Z5tDzs6v0cR9i/AgPGDSn5DytUuRg=', 'Imran', 'Jamil', '5VBHRdZdzQzgwfn57rVU7Q==', 'k1a0/XNNb5URvzjwQ+k1XQ==', 'Saudi Arabia', 'Jeddah', 'English', 't2/7MDLRfeCGbeHRuvBZKQ==', '2019-04-27', 547, 'Al Kandara', 3454, 'Yahoo');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `WID` int(11) NOT NULL,
  `withdraw_account_email` varchar(60) DEFAULT NULL,
  `withdraw_account_password` varchar(60) DEFAULT NULL,
  `withdraw_method_type` char(25) DEFAULT NULL,
  `withdraw_amount` decimal(15,4) DEFAULT NULL,
  `withdraw_status` char(15) DEFAULT NULL,
  `withdraw_datetime` datetime DEFAULT NULL,
  `UserID` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`WID`, `withdraw_account_email`, `withdraw_account_password`, `withdraw_method_type`, `withdraw_amount`, `withdraw_status`, `withdraw_datetime`, `UserID`) VALUES
(1, 'MzFZXFAx2OJRcvKC78eH/w==', '', 'WEBMONEY', '15.0000', 'APPROVED', '2019-08-15 17:21:18', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(2, 'btUJZsbRmg+p6ZDXzjUhiQ==', '', 'SKRILL', '10.0000', 'CANCELLED', '2019-08-15 17:21:51', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(4, 'MzFZXFAx2OJRcvKC78eH/w==', '', 'WEBMONEY', '5.0000', 'APPROVED', '2019-08-15 17:26:31', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc='),
(5, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '50.0000', 'APPROVED', '2019-08-15 22:42:48', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(7, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '10.0000', 'CANCELLED', '2019-08-15 22:44:02', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(8, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '450.0000', 'CANCELLED', '2019-08-15 22:44:37', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(9, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '10.0000', 'APPROVED', '2019-08-15 22:44:56', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(10, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '15.0000', 'CANCELLED', '2019-08-15 22:46:24', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(11, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '440.0000', 'CANCELLED', '2019-08-15 22:46:56', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(12, '+eaLdmoL12IgwozsPjC0bg==', '', 'SKRILL', '16.0000', 'APPROVED', '2019-08-15 22:47:25', '1reH579PsGJ/E4Z5tDzs6tKdTScjHawAw1C53iCotT8='),
(13, 'btUJZsbRmg+p6ZDXzjUhiQ==', '', 'SKRILL', '3.0000', 'APPROVED', '2019-08-17 23:43:20', '1reH579PsGJ/E4Z5tDzs6sN2V3f2bhrQ0pPeMq/y+sc=');

-- --------------------------------------------------------

--
-- Stand-in structure for view `withdraw_status`
-- (See below for the actual view)
--
CREATE TABLE `withdraw_status` (
`WID` int(11)
,`withdraw_account_email` varchar(60)
,`withdraw_account_password` varchar(60)
,`withdraw_method_type` char(25)
,`withdraw_amount` decimal(15,4)
,`withdraw_status` char(15)
,`withdraw_datetime` datetime
,`UserID` varchar(250)
);

-- --------------------------------------------------------

--
-- Structure for view `deposit_status`
--
DROP TABLE IF EXISTS `deposit_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `deposit_status`  AS  select `deposit`.`DID` AS `DID`,`deposit`.`deposit_account_email` AS `deposit_account_email`,`deposit`.`deposit_account_password` AS `deposit_account_password`,`deposit`.`deposit_method_type` AS `deposit_method_type`,`deposit`.`deposit_amount` AS `deposit_amount`,`deposit`.`deposit_status` AS `deposit_status`,`deposit`.`deposit_datetime` AS `deposit_datetime`,`deposit`.`UserID` AS `UserID` from `deposit` where (`deposit`.`deposit_status` = 'NOT APPROVED') ;

-- --------------------------------------------------------

--
-- Structure for view `withdraw_status`
--
DROP TABLE IF EXISTS `withdraw_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `withdraw_status`  AS  select `withdraw`.`WID` AS `WID`,`withdraw`.`withdraw_account_email` AS `withdraw_account_email`,`withdraw`.`withdraw_account_password` AS `withdraw_account_password`,`withdraw`.`withdraw_method_type` AS `withdraw_method_type`,`withdraw`.`withdraw_amount` AS `withdraw_amount`,`withdraw`.`withdraw_status` AS `withdraw_status`,`withdraw`.`withdraw_datetime` AS `withdraw_datetime`,`withdraw`.`UserID` AS `UserID` from `withdraw` where (`withdraw`.`withdraw_status` = 'NOT APPROVED') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus_request`
--
ALTER TABLE `bonus_request`
  ADD PRIMARY KEY (`BID`),
  ADD KEY `fk_bonus_request_UserID` (`UserID`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `fk_account_UserID` (`UserID`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`DID`),
  ADD KEY `fk_deposit_UserID` (`UserID`);

--
-- Indexes for table `national_identity`
--
ALTER TABLE `national_identity`
  ADD PRIMARY KEY (`NID`),
  ADD KEY `fk_national_identity_UserID` (`UserID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`WID`),
  ADD KEY `fk_withdraw_UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonus_request`
--
ALTER TABLE `bonus_request`
  MODIFY `BID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `national_identity`
--
ALTER TABLE `national_identity`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `WID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonus_request`
--
ALTER TABLE `bonus_request`
  ADD CONSTRAINT `fk_bonus_request_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD CONSTRAINT `fk_account_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `fk_deposit_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `national_identity`
--
ALTER TABLE `national_identity`
  ADD CONSTRAINT `fk_national_identity_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `fk_withdraw_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
