<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');
		
	
	if (isset($_POST['addpromotion_btn']))
	{
		
		// getting data from user side and encrypt that information
	
		$promotion_title = $_POST['promotion_title'];
		$promotion_description = $_POST['promotion_description'];
		$promotion_percentage = $_POST['promotion_percentage'];
		
	
		$query = "CALL add_new_promotion('$promotion_title', '$promotion_description', '$promotion_percentage')";
	
		$add_promotion = new DatabaseConfiguration();

		$result = $add_promotion->query($query);
	
			if($result['0']['0'] == "PROMOTION ADDED")
			{

				error("Promotion Added");
			
			}		
	}
	else 
	{
		
		error("Unauthorized Access, Admin");
		
	}

	
?>