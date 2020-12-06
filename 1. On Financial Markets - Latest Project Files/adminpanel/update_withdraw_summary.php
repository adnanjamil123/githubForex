<?php

	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../request.php');
	
	$WID_auth = $_GET['WID_auth'];
	$UserID_auth = str_replace(" ", "+", $_GET['UserID_auth']);
	
	$query = "CALL update_withdraw_status('$WID_auth', '$UserID_auth')";
	
	$update_withdraw_status = new DatabaseConfiguration();

	$result = $update_withdraw_status->query($query);

	
	
	if($result['0']['0'] == "WITHDRAW APPROVED")
	{
		error("Withdraw Approved");
	}
	else if($result['0']['0'] == "ALREADY WITHDRAW APPROVED")
	{
		error("Already Withdraw Approved");
	}
	
?>