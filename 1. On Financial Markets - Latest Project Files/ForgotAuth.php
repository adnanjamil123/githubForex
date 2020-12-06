<?php
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	if (isset($_POST['forgot_btn']))
	{
		
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$user_email_auth = $data->encrypt($_POST['user_email_auth']);
		
		$query = "CALL account_email_verifying('$user_email_auth')";
	
		$verify_email = new DatabaseConfiguration();

		$result = $verify_email->query($query);
		
		if($result['0']['0'] == "CUSTOMER NOT FOUND")
		{
			error("Email Not Found");

		}
		else
		{
			error("Forgot Password, Email Sent");
		}
	}
	else 
	{
		
		error("Unauthorized Access");
		
	}

	
?>