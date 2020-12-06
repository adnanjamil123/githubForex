<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	session_start();
	
	if (isset($_POST['payment_deposit_btn']))
	{
		
		if(isset($_SESSION['member_loginID']))
		{
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$transaction_account_info = $data->encrypt($_POST['transaction_account_info']);
		$deposit_account_password = "";
		$transaction_method_type = $_POST['transaction_method_type'];
		$deposit_amount = $_POST['deposit_amount'];
		$UserID_auth = $data->encrypt($_SESSION['member_loginID']);
		
		$query = "CALL amount_deposit('$transaction_account_info', '$deposit_account_password', '$transaction_method_type', '$deposit_amount', '$UserID_auth')";
	
		$deposit_money = new DatabaseConfiguration();

		$result = $deposit_money->query($query);
		
			if($result['0']['0'] == "PAYMENT DONE")
			{
				error("Payment Done");
			}
			else if($result['0']['0'] == "PlEASE VERIFY YOUR ACCOUNT")
			{
				error("Verify Your Account");
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