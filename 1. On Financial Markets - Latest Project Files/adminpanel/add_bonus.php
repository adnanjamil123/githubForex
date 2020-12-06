<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');

	if (isset($_POST['add_bonus_btn']))
	{
		
		
		// getting data from user side and encrypt that information
	
		$data = new InfoSecurity();

		$bonus_user = $data->encrypt(substr($_POST['bonus_user'], 0, 23));
		$bonus_amount = $_POST['bonus_amount'];
		
		$query = "CALL apply_bonus('$bonus_user', '$bonus_amount')";
	
		$add_bonus = new DatabaseConfiguration();

		$result = $add_bonus->query($query);
		
			if($result['0']['0'] == "BONUS APPLIED")
			{
				error("Bonus Applied, Admin");

			}
			else if($result['0']['0'] == "CUSTOMER NOT FOUND")
			{
				error("Customer Not Found, Admin");

			}
			
	}
?>