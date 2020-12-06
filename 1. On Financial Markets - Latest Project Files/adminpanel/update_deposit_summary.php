<?php

	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../request.php');
	
	$DID_auth = $_GET['DID_auth'];
	$UserID_auth = str_replace(" ", "+", $_GET['UserID_auth']);
	
	$query = "CALL update_deposit_status('$DID_auth', '$UserID_auth')";
	
	$update_deposit_status = new DatabaseConfiguration();

	$result = $update_deposit_status->query($query);

	if($result['0']['0'] == "PAYMENT APPROVED")
	{
		
		error("Payment Approved");
	}
	else if($result['0']['0'] == "ALREADY PAYMENT APPROVED")
	{
		error("Already Approved");
	}
	
	
	
?>