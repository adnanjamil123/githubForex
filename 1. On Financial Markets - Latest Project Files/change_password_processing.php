<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	session_start();
	
	if (isset($_POST['change_password_btn']))
	{
		
		if(isset($_SESSION['member_loginID']))
		{
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$UserID_auth = $data->encrypt($_SESSION['member_loginID']);
		$new_user_password = $data->encrypt($_POST['user_password']);
		
		$query = "CALL change_userpassword('$UserID_auth', '$new_user_password')";
	
		$change_password = new DatabaseConfiguration();

		$result = $change_password->query($query);
		
			if($result['0']['0'] == "PASSWORD CHANGED")
			{
				error("Password Changed");
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