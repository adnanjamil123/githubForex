<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');

		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();
	
		$UserID_auth = str_replace(" ", "+", $_GET['UserID']);
		$new_user_password = $data->encrypt($_POST['user_password']);
		
		$query = "CALL change_userpassword('$UserID_auth', '$new_user_password')";
	
		$change_password = new DatabaseConfiguration();

		$result = $change_password->query($query);
		
			if($result['0']['0'] == "PASSWORD CHANGED")
			{
				error("Forgot Password Changed");
			}
			
		
?>