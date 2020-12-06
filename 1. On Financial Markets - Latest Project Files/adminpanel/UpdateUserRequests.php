<?php

	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../request.php');
	
	$national_identity_name = $_POST['national_identity_name'];
	$national_identity_type = $_POST['national_identity_type'];
	$national_identity_number = $_POST['national_identity_number'];
	$issue_date = $_POST['issue_date'];
	$expire_date = $_POST['expire_date'];
	$UserID_auth = str_replace(" ", "+", $_GET['UserID_auth']);

	$query = "CALL add_user_national_identity('$national_identity_name', '$national_identity_type', '$national_identity_number', 
	'$issue_date', '$expire_date', '$UserID_auth')";
	
	$update_user_account_status = new DatabaseConfiguration();

	$result = $update_user_account_status->query($query);
	
	if($result['0']['0'] == "ACCOUNT IS VERIFIED")
	{
		error("Account Status Verified, Admin");
	}
	
	
	
?>