------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ users / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE users
(
UserID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
f_name CHAR(35), 
l_name CHAR(35), 
user_email VARCHAR(60), 
user_password VARCHAR(60), 
country CHAR(50), 
city_town CHAR(50), 
preferred_language CHAR(50), 
phone_no BIGINT, 
date_of_birth DATE, 
street_number INT, 
residential_address VARCHAR(150), 
postal_zip_code INT, 
find_us_detail CHAR(15),

CONSTRAINT pk_UserID PRIMARY KEY(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE UserID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE UserID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE UserID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (customer , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM users

------------ DELETE QUERY ------------
DELETE FROM users ------ FOR ALL ------
DELETE FROM users WHERE UserID = 1 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE users SET street_number = 0 WHERE UserID = 1

------------ INSERT QUERY ------------
INSERT INTO users(UserID, f_name, l_name, user_email, user_password, country, city_town, preferred_language, phone_no, date_of_birth, street_number, residential_address, postal_zip_code, find_us_detail) VALUES(NEXT VALUE FOR UserID, 'ALI', 'JAMIL', 'ali_jamil@hotmail.com', 'Abcd12345@', 'PAKISTAN', 'CITY', 'ENGLISH', 03374850363, '1995-04-27', '2', '151 - Ali Noor Boyz Hostel, Raiwind Road, Lahore', 35345, 'GOOGLE')

------------ DROP TABLE QUERY ------------
DROP TABLE users

------------ CREATE PROCEDURE FOR ADD NEW USERS ------------
ALTER PROCEDURE add_new_users
@f_name CHAR(35), 
@l_name CHAR(35), 
@user_email VARCHAR(60), 
@user_password VARCHAR(60), 
@country CHAR(50), 
@city_town CHAR(50), 
@preferred_language CHAR(50), 
@phone_no BIGINT, 
@date_of_birth DATE, 
@street_number INT, 
@residential_address VARCHAR(150), 
@postal_zip_code INT, 
@find_us_detail CHAR(15),
@account_type CHAR(15),
@account_base_currency CHAR(15), 
@account_leverage DECIMAL(15,4), 
@expected_investment_balance DECIMAL(15,4)
--- @message VARCHAR(50) OUTPUT

AS
BEGIN

DECLARE @message VARCHAR(50), @UserID INT, @account_actual_balance DECIMAL(15,4), @account_virtual_balance DECIMAL(15,4), @account_promotion_status CHAR(4), @account_status CHAR(15)

IF EXISTS(SELECT * FROM users WHERE user_email = @user_email)

	BEGIN
		
		SET @message = 'This email is already registered, please try another one.'

	END;

ELSE

	BEGIN

		SET @UserID = NEXT VALUE FOR UserID
		SET @account_actual_balance = 0
		SET @account_virtual_balance = 0
		SET @account_promotion_status = 'NO'
		SET @account_status = 'NOT VERIFIED'

		INSERT INTO users(UserID, f_name, l_name, user_email, user_password, country, city_town, preferred_language, phone_no, date_of_birth, street_number, residential_address, postal_zip_code, find_us_detail) VALUES(@UserID, @f_name, @l_name, @user_email, @user_password, @country, @city_town, @preferred_language, @phone_no, @date_of_birth, @street_number, @residential_address, @postal_zip_code, @find_us_detail)

		INSERT INTO account(AID, account_type, account_status, account_created_at, account_base_currency, account_leverage, account_actual_balance, account_virtual_balance, expected_investment_balance, account_promotion_status, UserID) VALUES(NEXT VALUE FOR AID, @account_type, @account_status, GETDATE(), @account_base_currency, @account_leverage, @account_actual_balance, @account_virtual_balance, @expected_investment_balance, @account_promotion_status, @UserID)


		SET @message = 'Account is created.'

	END;

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE add_new_users

------------ EXECUTE PROCEDURE FOR INSERT DATA ------------
EXEC add_new_users @f_name = 'ADNAN', 
				   @l_name = 'JAMIL', 
				   @user_email = 'adnanjamil3@gmail.com', 
				   @user_password = 'Abc12345@', 
				   @country = 'SAUDIA', 
				   @city_town = 'MAKKAH',
				   @preferred_language = 'ENGLISH', 
				   @phone_no = '034335345345', 
				   @date_of_birth = '1992-04-27', 
				   @street_number = 2, 
				   @residential_address = 'MAKKAH', 
				   @postal_zip_code = 34455, 
				   @find_us_detail = 'GOOGLE',
				   @account_type = 'STANDARD',  
                   @account_base_currency = 'SAR',
				   @account_leverage = 0.388888889,
                   @expected_investment_balance  = 1000

------------ CREATE PROCEDURE FOR LOGIN USER ------------
ALTER PROCEDURE login_user
@user_email_auth VARCHAR(60), 
@user_password_auth VARCHAR(60)

AS
BEGIN

DECLARE @message VARCHAR(50)

IF EXISTS(SELECT * FROM users WHERE user_email = @user_email_auth AND user_password = @user_password_auth)

	BEGIN
		
		SET @message = 'Login Successful.'

	END;

ELSE

	BEGIN

		SET @message = 'Login Failed.'

	END;

	PRINT @message

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE login_user

------------ EXECUTE PROCEDURE FOR LOGIN DATA ------------
EXEC login_user @user_email_auth = 'adnanjamil3@gmail.com', 
				@user_password = 'Abc12345@'


------------ CREATE PROCEDURE FOR CHECK ACCOUNT EXISTS ------------
CREATE PROCEDURE account_email_verifying

@user_email_auth VARCHAR(60)

AS
BEGIN


IF NOT EXISTS(SELECT * FROM users WHERE user_email = @user_email_auth)

BEGIN

PRINT 'CUSTOMER NOT FOUND'

END


END

------------ EXECUTE PROCEDURE FOR SET DATA FOR CHECK EMIALS ------------
EXEC account_email_verifying @user_email_auth = 'adnanjamil@gmail.com'

------------ CREATE PROCEDURE FOR CHANGE USER PASSWORD ------------
CREATE PROCEDURE change_userpassword
@UserID INT,
@new_user_password VARCHAR(60)

AS
BEGIN

DECLARE @message VARCHAR(50)

		SET @message = 'Password Changed'

		UPDATE users SET user_password = @new_user_password WHERE UserID = @UserID

		PRINT @message

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE change_userpassword

------------ EXECUTE PROCEDURE FOR NEW PASSWORD DATA ------------
EXEC change_userpassword @UserID = 13,
						 @new_user_password = '12345'

SELECT * FROM users

------------ CREATE PROCEDURE FOR GET LOGIN USERID------------
ALTER PROCEDURE get_login_UserID
@user_email_auth VARCHAR(60)

AS
BEGIN

DECLARE @message VARCHAR(50)


		SET @message = (SELECT UserID FROM users WHERE user_email = @user_email_auth)

		PRINT @message

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE get_login_UserID

------------ EXECUTE PROCEDURE FOR LOGIN DATA ------------
EXEC get_login_UserID @user_email_auth = 'adnanjamil3@gmail.com'

------------ CREATE PROCEDURE FOR GET LOGIN USERNAME------------
ALTER PROCEDURE get_login_Name
@UserID INT

AS
BEGIN

DECLARE @message VARCHAR(50)


		SELECT * FROM users u , account a WHERE u.UserID = a.UserID AND u.UserID = @UserID

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE get_login_Name

------------ EXECUTE PROCEDURE FOR LOGIN DATA ------------
EXEC get_login_Name @UserID = 12

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ national_identity  / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE national_identity 
(
NID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
national_identity_name CHAR(100),  
national_identity_type CHAR(100),  
national_identity_number BIGINT,
issue_date DATE, 
expire_date DATE, 
UserID INT,

CONSTRAINT pk_NID PRIMARY KEY(NID),
CONSTRAINT fk_national_identity_UserID FOREIGN KEY(UserID) REFERENCES users(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE NID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE NID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE NID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (national_identity , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM national_identity

------------ DELETE QUERY ------------
DELETE FROM national_identity ------ FOR ALL ------
DELETE FROM national_identity WHERE NID = 1 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE national_identity SET national_identity_type = 'PASSPORT' WHERE UserID = 1

------------ INSERT QUERY ------------
INSERT INTO national_identity(NID, national_identity_name, national_identity_type, national_identity_number, issue_date, expire_date, UserID) VALUES(NEXT VALUE FOR NID, 'ALI JAMIL', 'ID CARD', 3460389526199, '2018-09-02', '2029-09-02', 13 )

------------ DROP TABLE QUERY ------------
DROP TABLE national_identity

------------ CREATE PROCEDURE FOR ADD USERS National Identity ------------
CREATE PROCEDURE add_user_national_identity
@national_identity_name CHAR(100),  
@national_identity_type CHAR(100),  
@national_identity_number BIGINT,
@issue_date DATE, 
@expire_date DATE, 
@UserID_auth INT
--- @message VARCHAR(50) OUTPUT

AS
BEGIN

DECLARE @message VARCHAR(50)

UPDATE account SET account_status = 'VERIFIED' WHERE UserID = @UserID_auth

INSERT INTO national_identity(NID, national_identity_name, national_identity_type, national_identity_number, issue_date, expire_date, UserID) VALUES(NEXT VALUE FOR NID, @national_identity_name, @national_identity_type, @national_identity_number, @issue_date, @expire_date, @UserID_auth)

SET @message = 'Account is Verified'

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE add_user_national_identity

------------ EXECUTE PROCEDURE FOR INSERT DATA ------------
EXEC add_user_national_identity @national_identity_name = 'ALI JAMIL',  
								@national_identity_type = 'ID CARD',  
								@national_identity_number = 3460389526199,
								@issue_date = '2018-09-02', 
								@expire_date = '2029-09-02', 
								@UserID_auth = 13

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ account / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE account
(
AID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
account_type CHAR(15), 
account_status CHAR(15), 
account_created_at DATETIME, 
account_base_currency CHAR(15), 
account_leverage DECIMAL(15,4), 
account_actual_balance DECIMAL(15,4), 
account_virtual_balance DECIMAL(15,4), 
expected_investment_balance DECIMAL(15,4), 
account_promotion_status CHAR(4), 
UserID INT,

CONSTRAINT pk_AID PRIMARY KEY(AID),
CONSTRAINT fk_account_UserID FOREIGN KEY(UserID) REFERENCES users(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE AID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE AID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE AID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (account , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM account

------------ DELETE QUERY ------------
DELETE FROM account ------ FOR ALL ------
DELETE FROM account WHERE UserID = 1 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE account SET account_status = 'VERIFIED' WHERE UserID = 11
UPDATE account SET account_actual_balance = 300 WHERE UserID = 7
UPDATE account SET account_promotion_status = 'NO' WHERE UserID = 13

------------ INSERT QUERY ------------
INSERT INTO account(AID, account_type, account_status, account_created_at, account_base_currency, account_leverage, account_actual_balance, account_virtual_balance, expected_investment_balance, account_promotion_status, UserID) VALUES(NEXT VALUE FOR AID, 'STANDARD', 'VERIFIED', GETDATE(), 'SAR', 0.388888889, 500, 0, 5000, 'NO', 1)

------------ DROP TABLE QUERY ------------
DROP TABLE account

------------ CREATE PROCEDURE FOR DISPLAY NOT VERIFIED ------------
CREATE PROCEDURE useraccount_requests
AS
BEGIN
SELECT * FROM users u, account a WHERE u.UserID = a.UserID AND account_status = 'NOT VERIFIED'
END

------------ CALL PROCEDURE FOR GET NOT VERIFIED ACCOUNT STATUS DATA ------------
EXEC useraccount_requests

------------ DROP PROCEDURE ------------
DROP PROCEDURE useraccount_requests

------------ CREATE PROCEDURE FOR DISPLAY ALL USERS ------------
CREATE PROCEDURE our_users_status
AS
BEGIN
SELECT * FROM users u, account a WHERE u.UserID = a.UserID
END

------------ CALL PROCEDURE FOR GET ALL USER ACCOUNT STATUS DATA ------------
EXEC our_users_status

------------ DROP PROCEDURE ------------
DROP PROCEDURE our_users_status

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ deposit / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE deposit
(
DID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
deposit_account_email VARCHAR(60), 
deposit_account_password VARCHAR(60), 
deposit_method_type CHAR(25), 
deposit_amount DECIMAL(15,4), 
deposit_status CHAR(15), 
deposit_datetime DATETIME, 
UserID INT,

CONSTRAINT pk_DID PRIMARY KEY(DID),
CONSTRAINT fk_deposit_UserID FOREIGN KEY(UserID) REFERENCES users(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE DID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE DID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE DID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (deposit , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM deposit

------------ DELETE QUERY ------------
DELETE FROM deposit ------ FOR ALL ------
DELETE FROM deposit WHERE UserID = 7 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE deposit SET deposit_status = 'APPROVED' WHERE DID = 2

------------ INSERT QUERY ------------
INSERT INTO deposit(DID, deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, deposit_datetime, UserID) VALUES(NEXT VALUE FOR DID, 'ali@gmail.com', 'Abc@121', 'WEBMONEY', 200, 'NOT APPROVED', GETDATE(), 7)

------------ DROP TABLE QUERY ------------
DROP TABLE deposit

------------ CREATE PROCEDURE FOR DEPOSIT ------------
ALTER PROCEDURE amount_deposit
@deposit_account_email VARCHAR(60), 
@deposit_account_password VARCHAR(60), 
@deposit_method_type CHAR(25), 
@deposit_amount DECIMAL(15,4), 
@UserID INT

AS
BEGIN

	DECLARE @deposit_status CHAR(15), @account_status CHAR(15), @message VARCHAR(50)

	SET @account_status = (SELECT account_status FROM account WHERE	UserID = @UserID)

	SET @deposit_status = 'NOT APPROVED'

	IF(@account_status = 'VERIFIED')

	BEGIN

	INSERT INTO deposit(DID, deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, deposit_datetime, UserID) VALUES(NEXT VALUE FOR DID, @deposit_account_email, @deposit_account_password, @deposit_method_type, @deposit_amount, @deposit_status, GETDATE(), @UserID)
	
	SET @message =  'Payment Done.'

	END

	ELSE

	BEGIN

		SET @message =  'Please verify your account.'

	END

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE amount_deposit

------------ EXECUTE PROCEDURE FOR INSERT DEPOSIT DATA ------------
EXEC amount_deposit @deposit_account_email = 'adnanjamil@gmail.com', 
				    @deposit_account_password = 'Abc@121', 
				    @deposit_method_type = 'PAYPAL', 
					@deposit_amount = 200,
					@UserID = 13

------------ CREATE VIEW FOR DISPLAY NOT APPROVED DEPOSIT STATUS------------
CREATE VIEW deposit_status
AS
SELECT * FROM deposit WHERE deposit_status = 'NOT APPROVED'

------------ CALL VIEW FOR GET DEPOSIT STATUS DATA ------------
SELECT * FROM deposit_status

------------ CREATE PROCEDURE FOR DISPLAY User DEPOSIT STATUS------------
CREATE PROCEDURE user_deposit_status
@UserID INT
AS
BEGIN
SELECT * FROM deposit WHERE UserID = @UserID
END

------------ DROP PROCEDURE ------------
DROP PROCEDURE user_deposit_status

------------ CALL PROCEDURE FOR GET DEPOSIT STATUS DATA ------------
EXEC user_deposit_status @UserID = 13 

------------ PROCEDURE FOR UPDATE DEPOSIT STATUS ------------
ALTER PROCEDURE update_deposit_status
@DID INT,
@UserID INT

AS
BEGIN


	DECLARE @message VARCHAR(50), @deposit_status CHAR(15), @deposit_amount DECIMAL(15,4), @account_actual_balance DECIMAL(15,4), @new_balance DECIMAL(15,4)

	SET @deposit_status = (SELECT deposit_status FROM deposit WHERE DID = @DID)

	IF(@deposit_status != 'APPROVED')

	BEGIN

	UPDATE deposit SET deposit_status = 'APPROVED' WHERE DID = @DID

	SET @deposit_amount = (SELECT deposit_amount FROM deposit WHERE DID = @DID)

	SET @account_actual_balance = (SELECT account_actual_balance FROM account WHERE UserID = @UserID)

	SET @new_balance = @account_actual_balance + @deposit_amount

	UPDATE account SET account_actual_balance = @new_balance WHERE UserID = @UserID

	SET @message = 'PAYMENT APPROVED'

	END

	ELSE

	BEGIN

	SET @message = 'ALREADY PAYMENT APPROVED'

	END

	PRINT @message


END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE update_deposit_status

------------ EXECUTE PROCEDURE FOR UPDATE DEPOSIT DATA ------------
EXEC update_deposit_status @DID = 8, 
					       @UserID = 13
------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ withdraw / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE withdraw
(
WID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
withdraw_account_email VARCHAR(60), 
withdraw_account_password VARCHAR(60), 
withdraw_method_type CHAR(25), 
withdraw_amount DECIMAL(15,4), 
withdraw_status CHAR(15), 
withdraw_datetime DATETIME, 
UserID INT,

CONSTRAINT pk_WID PRIMARY KEY(WID),
CONSTRAINT fk_withdraw_UserID FOREIGN KEY(UserID) REFERENCES users(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE WID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE WID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE WID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (withdraw , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM withdraw

------------ DELETE QUERY ------------
DELETE FROM withdraw ------ FOR ALL ------
DELETE FROM withdraw WHERE UserID = 7 ------ FOR SPECIFIC ------
DELETE FROM withdraw WHERE WID = 13

------------ UPDATE QUERY ------------
UPDATE withdraw SET withdraw_status = 'NOT APPROVED' WHERE WID = 1

------------ INSERT QUERY ------------
INSERT INTO withdraw(DID, withdraw_account_email, withdraw_account_password, withdraw_method_type, withdraw_amount, dwithdraw_status, withdraw_datetime, UserID) VALUES(NEXT VALUE FOR DID, 'ali@gmail.com', 'Abc@121', 'WEBMONEY', 50, 'NOT APPROVED', GETDATE(), 7)

------------ DROP TABLE QUERY ------------
DROP TABLE withdraw

------------ CREATE PROCEDURE FOR WITHDRAW ------------
ALTER PROCEDURE amount_withdraw
@withdraw_account_email VARCHAR(60), 
@withdraw_account_password VARCHAR(60), 
@withdraw_method_type CHAR(25), 
@withdraw_amount DECIMAL(15,4), 
@UserID INT

AS
BEGIN

	DECLARE @account_actual_balance DECIMAL(15,4), @withdraw_status CHAR(15), @message VARCHAR(50),  @get_withdraw_request_balance DECIMAL(15,4)

	SET @get_withdraw_request_balance = (SELECT SUM(withdraw_amount) FROM withdraw WHERE UserID = @UserID AND withdraw_status = 'NOT APPROVED')

	IF(@get_withdraw_request_balance is null)

	BEGIN
	
		SET @get_withdraw_request_balance = 0
	END

	SET @account_actual_balance = (SELECT account_actual_balance FROM account WHERE UserID = @UserID)

	SET @withdraw_status = 'NOT APPROVED'

	IF(@withdraw_amount <= (@account_actual_balance - @get_withdraw_request_balance))

	BEGIN

		INSERT INTO withdraw(WID, withdraw_account_email, withdraw_account_password, withdraw_method_type, withdraw_amount, withdraw_status, withdraw_datetime, UserID) VALUES(NEXT VALUE FOR WID, @withdraw_account_email, @withdraw_account_password, @withdraw_method_type, @withdraw_amount, @withdraw_status, GETDATE(), @UserID)

		SET @message = 'Transaction Completed'
	END

	ELSE

	BEGIN

		SET @message = 'Withdrawal amount exceeds current balance, please re-enter'

	END

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE amount_withdraw

------------ EXECUTE PROCEDURE FOR WITHDRAW INSERT DATA ------------
EXEC amount_withdraw @withdraw_account_email = 'ali@gmail.com', 
				     @withdraw_account_password = 'Abc@121', 
				     @withdraw_method_type = 'WEBMONEY', 
					 @withdraw_amount = 50,
					 @UserID = 13


------------ CREATE PROCEDURE FOR CANCEL WITHDRAW REQUEST ------------
ALTER PROCEDURE cancel_withdraw_request
@WID INT,
@deposit_account_email VARCHAR(60), 
@deposit_account_password VARCHAR(60), 
@deposit_method_type CHAR(25), 
@deposit_amount DECIMAL(15,4), 
@UserID INT

AS
BEGIN

	DECLARE @deposit_status CHAR(15), @account_status CHAR(15), @message VARCHAR(50)

	UPDATE withdraw SET withdraw_status = 'CANCELLED' WHERE WID = @WID

	SET @account_status = (SELECT account_status FROM account WHERE	UserID = @UserID)

	SET @deposit_status = 'APPROVED'

	IF(@account_status = 'VERIFIED')

	BEGIN

	INSERT INTO deposit(DID, deposit_account_email, deposit_account_password, deposit_method_type, deposit_amount, deposit_status, deposit_datetime, UserID) VALUES(NEXT VALUE FOR DID, @deposit_account_email, @deposit_account_password, @deposit_method_type, @deposit_amount, @deposit_status, GETDATE(), @UserID)
	
	SET @message =  'Payment Done.'

	END

	ELSE

	BEGIN

		SET @message =  'Please verify your account.'

	END

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE cancel_withdraw_request

------------ EXECUTE PROCEDURE FOR INSERT DEPOSIT DATA ------------
EXEC amount_deposit @WID_auth = 3
@deposit_account_email = 'adnanjamil@gmail.com', 
				    @deposit_account_password = 'Abc@121', 
				    @deposit_method_type = 'PAYPAL', 
					@deposit_amount = 100,
					@UserID = 11

------------ CREATE VIEW FOR DISPLAY NOT APPROVED DEPOSIT STATUS------------
CREATE VIEW withdraw_status
AS
SELECT * FROM withdraw WHERE withdraw_status = 'NOT APPROVED'

------------ CALL VIEW FOR GET DEPOSIT STATUS DATA ------------
SELECT * FROM withdraw_status

------------ CREATE PROCEDURE FOR DISPLAY User DEPOSIT STATUS------------
CREATE PROCEDURE user_withdraw_status
@UserID INT
AS
BEGIN
SELECT * FROM withdraw WHERE UserID = @UserID
END

------------ DROP PROCEDURE ------------
DROP PROCEDURE user_withdraw_status

------------ CALL PROCEDURE FOR GET DEPOSIT STATUS DATA ------------
EXEC user_withdraw_status @UserID = 13 

------------ PROCEDURE FOR UPDATE WITHDRAW STATUS ------------
ALTER PROCEDURE update_withdraw_status
@WID INT,
@UserID INT

AS
BEGIN

	DECLARE @message VARCHAR(50), @withdraw_status CHAR(15), @withdraw_amount DECIMAL(15,4), @account_actual_balance DECIMAL(15,4), @new_balance DECIMAL(15,4)

	SET @withdraw_status = (SELECT withdraw_status FROM withdraw WHERE WID = @WID)

	IF(@withdraw_status != 'APPROVED')

	BEGIN

	UPDATE account SET account_promotion_status = 'NO' WHERE UserID = @UserID

	UPDATE account SET account_virtual_balance = 0 WHERE UserID = @UserID

	UPDATE withdraw SET withdraw_status = 'APPROVED' WHERE WID = @WID

	SET @withdraw_amount = (SELECT withdraw_amount FROM withdraw WHERE WID = @WID)

	SET @account_actual_balance = (SELECT account_actual_balance FROM account WHERE UserID = @UserID)

	SET @new_balance = @account_actual_balance - @withdraw_amount

	UPDATE account SET account_actual_balance = @new_balance WHERE UserID = @UserID

	SET @message = 'WITHDRAW APPROVED'

	END

	ELSE

	BEGIN

	SET @message = 'ALREADY WITHDRAW APPROVED'

	END

	PRINT @message

END;

------------ DROP PROCEDURE ------------
DROP PROCEDURE update_withdraw_status

------------ EXECUTE PROCEDURE FOR UPDATE WITHDRAW DATA ------------
EXEC update_withdraw_status @WID = 14, 
					        @UserID = 13

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ promotion / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE promotion
(
PID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
promotion_title VARCHAR(100), 
promotion_description VARCHAR(700), 
promotion_percentage INT,
promotion_datetime DATETIME,

CONSTRAINT pk_PID PRIMARY KEY(PID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE PID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE PID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE PID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (promotion , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM promotion

------------ DELETE QUERY ------------
DELETE FROM promotion ------ FOR ALL ------
DELETE FROM promotion WHERE PID = 1 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE promotion SET promotion_title = 'Hello' WHERE PID = 1

------------ INSERT QUERY ------------
INSERT INTO promotion(PID, promotion_title, promotion_description, promotion_percentage, promotion_datetime) VALUES(NEXT VALUE FOR PID, 'Welcome Bonus up to $500', '1. Bonus crediting is Instant and Automatic. 2. Deposit to maximize your bonus amount', 15, GETDATE())

------------ DROP TABLE QUERY ------------
DROP TABLE promotion

------------ CREATE PROCEDURE FOR ADD NEW PROMOTIONS ------------
ALTER PROCEDURE add_new_promotion

@promotion_title VARCHAR(100), 
@promotion_description VARCHAR(700), 
@promotion_percentage INT

AS
BEGIN

DECLARE @message VARCHAR(50)

INSERT INTO promotion(PID, promotion_title, promotion_description, promotion_percentage, promotion_datetime) VALUES(NEXT VALUE FOR PID, @promotion_title, @promotion_description, @promotion_percentage, GETDATE())

SET @message = 'PROMOTION ADDED'

PRINT @message

END

------------ EXECUTE PROCEDURE FOR SET DATA FOR ADD NEW PROMOTIONS ------------
EXEC add_new_promotion @promotion_title = 'Welcome Bonus up to $500', 
					   @promotion_description = '1. Bonus crediting is Instant and Automatic. 2. Deposit to maximize your bonus amount',
					   @promotion_percentage = 15

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ promotion_request / -------------------------------

------------ CREATE TABLE QUERY ------------
CREATE TABLE bonus_request 
(
BID INT, ---- IDENTITY(1,1) ----      ------ Its work on SQL Server Express
UserID INT,
amount DECIMAL(15,4),
promotion_status CHAR(15),
request_datetime DATETIME,

CONSTRAINT pk_BID PRIMARY KEY(BID),
CONSTRAINT fk_bonus_request_UserID FOREIGN KEY(UserID) REFERENCES users(UserID)

)

------------ CREATE SEQUENCE QUERY ------------
CREATE SEQUENCE BID ------ Its work on SQL Server
START WITH 1
INCREMENT BY 1

------------ ALTER SEQUENCE QUERY FOR RESET ------------
ALTER SEQUENCE BID
RESTART WITH 1

------------ DROP SEQUENCE QUERY ------------
DROP SEQUENCE BID

------------ ALTER IDENTITY QUERY FOR RESET ------------
DBCC CHECKIDENT (bonus_request , RESEED, 0); ------ Its work on SQL Server Express

------------ SELECT QUERY ------------
SELECT * FROM bonus_request

------------ DELETE QUERY ------------
DELETE FROM bonus_request ------ FOR ALL ------
DELETE FROM bonus_request WHERE BID = 5 ------ FOR SPECIFIC ------

------------ UPDATE QUERY ------------
UPDATE bonus_request SET promotion_status = 'APPROVED' WHERE BID = 1

------------ INSERT QUERY ------------
INSERT INTO bonus_request(BID, UserID, amount, promotion_status, request_datetime) VALUES(NEXT VALUE FOR BID, 13, 500, 'APPROVED', GETDATE())

------------ DROP TABLE QUERY ------------
DROP TABLE bonus_request

------------ CREATE PROCEDURE FOR ADD PROMOTIONS REQUESTS ------------
ALTER PROCEDURE apply_bonus

@UserID INT,
@apply_bonus_amount DECIMAL(15,4)

AS
BEGIN

DECLARE @promotion_status CHAR(15), @account_virtual_balance DECIMAL(15,4), @new_balance DECIMAL(15,4)

SET @promotion_status = 'APPROVED'
SET @account_virtual_balance = (SELECT account_virtual_balance FROM account WHERE UserID = @UserID)
SET @new_balance = @account_virtual_balance + @apply_bonus_amount

IF EXISTS(SELECT * FROM users WHERE UserID = @UserID)

BEGIN
INSERT INTO bonus_request(BID, UserID, amount, promotion_status, request_datetime) VALUES(NEXT VALUE FOR BID, @UserID, @apply_bonus_amount, @promotion_status, GETDATE())

UPDATE account SET account_virtual_balance = @new_balance WHERE UserID = @UserID
UPDATE account SET account_promotion_status = 'YES' WHERE UserID = @UserID

PRINT 'BONUS APPLIED'

END

ELSE

BEGIN

PRINT 'CUSTOMER NOT FOUND'

END


END

------------ EXECUTE PROCEDURE FOR SET DATA FOR ADD NEW PROMOTIONS REQUESTS ------------
EXEC apply_bonus @UserID = 13,
				 @apply_bonus_amount  = 100

------------ CREATE PROCEDURE FOR DISPLAY USER BONUS STATUS------------
CREATE PROCEDURE user_bonus_status
@UserID INT
AS
BEGIN
SELECT * FROM bonus_request WHERE UserID = @UserID
END

------------ DROP PROCEDURE ------------
DROP PROCEDURE user_bonus_status

------------ CALL PROCEDURE FOR GET DEPOSIT STATUS DATA ------------
EXEC user_bonus_status @UserID = 13 

------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------
------------------------------- \ QURIES / -------------------------------

SELECT * FROM users
SELECT * FROM account
SELECT * FROM bonus_request
SELECT * FROM deposit
SELECT * FROM withdraw


DELETE FROM users
DELETE FROM account
DELETE FROM deposit
DELETE FROM withdraw
DELETE FROM bonus_request

------------- PROCEDURE FOR GET TOTAL DEPOSIT BY SPECIFIC USER -------------
CREATE PROCEDURE get_deposit_amount
@UserID INT
AS
BEGIN

SELECT SUM(deposit_amount) AS [DEPOST AMOUNT] FROM deposit WHERE UserID = @UserID 

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE get_deposit_amouny

------------ EXECUTE PROCEDURE FOR GET TOTAL DEPOSIT ------------
EXEC get_deposit_amount @UserID= 11

------------- PROCEDURE FOR GET TOTAL WITHDRAW BY SPECIFIC USER -------------
CREATE PROCEDURE get_withdraw_amount
@UserID INT
AS
BEGIN

SELECT SUM(withdraw_amount) AS [WITHDRAW AMOUNT] FROM withdraw WHERE UserID = @UserID

END

------------ DROP PROCEDURE ------------
DROP PROCEDURE get_withdraw_amount

------------ EXECUTE PROCEDURE FOR GET TOTAL WITHDRAW ------------
EXEC get_withdraw_amount @UserID= 7
