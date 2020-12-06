<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
		
	session_start();
	
	if (isset($_POST['login_btn']))
	{
		
		if(!isset($_SESSION['member_loginID']))
		{
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$user_email_auth = $data->encrypt($_POST['user_email_auth']);
		$user_password_auth = $data->encrypt($_POST['user_password_auth']);
	
		$query = "CALL login_user('$user_email_auth', '$user_password_auth')";
	
		$user_account = new DatabaseConfiguration();

		$result = $user_account->query($query);
	
			if($result['0']['0'] == "SUCCESSFUL")
			{
			
			$get_login_UserID = new DatabaseConfiguration();
			
			$query_2 = "CALL get_login_UserID('$user_email_auth')";
			
			$member_loginID = $get_login_UserID->query($query_2);
			
			$UserID = $data->decrypt($member_loginID['0']['0']);
		
			$_SESSION['member_loginID'] = $UserID;
		
			error("Login successful");
			
			}
			else if($result['0']['0'] == "FAILED")
			{
				error("Login failed");
			
				session_destroy();
			}
		}
		else
		{
			error("Login successful");
		}
		
	}
	else 
	{
		
		error("Unauthorized Access");
		
	}

	
?>