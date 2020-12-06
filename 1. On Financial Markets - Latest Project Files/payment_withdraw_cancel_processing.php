<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	session_start();
	

		if(isset($_SESSION['member_loginID']))
		{
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$WID_auth = $_GET['WID_auth'];
		$transaction_account_info = $data->encrypt($_GET['transaction_account_info']);
		$deposit_account_password = "";
		$transaction_method_type = $_GET['transaction_method_type'];
		$deposit_amount = $_GET['deposit_amount'];
		$UserID_auth = $data->encrypt($_GET['UserID_auth']);
		
		$query = "CALL cancel_withdraw_request($WID_auth, '$transaction_account_info', '$deposit_account_password', '$transaction_method_type', '$deposit_amount', '$UserID_auth')";
	
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
		
	
?>