<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	session_start();
	
	if (isset($_POST['payment_withdraw_btn']))
	{
		
		if(isset($_SESSION['member_loginID']))
		{
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$transaction_account_info = $data->encrypt($_POST['transaction_account_info']);
		$withdraw_account_password = "";
		$transaction_method_type = $_POST['transaction_method_type'];
		$withdraw_amount = $_POST['withdraw_amount'];
		$UserID_auth = $data->encrypt($_SESSION['member_loginID']);
		
		$query = "CALL amount_withdraw('$transaction_account_info', '$withdraw_account_password', '$transaction_method_type', '$withdraw_amount', '$UserID_auth')";
	
		$withdraw_money = new DatabaseConfiguration();

		$result = $withdraw_money->query($query);
	
			if($result['0']['0'] == "TRANSACTION COMPLETED")
			{
			error("Transaction Done");
			}
			else if($result['0']['0'] == "WITHDRAWAL AMOUNT EXCEEDS CURRENT BALANCE")
			{
			error("Withdraw amount is greater from current amount");
			}
		}
		else
		{
			session_destroy();
		
			error("Unauthorized Access");
		}
		}
	else 
	{
		
		error("Unauthorized Access");
		
	}
?>