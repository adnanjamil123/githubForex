<?php

		// include files
	
		require_once('DatabaseConfiguration.php');
	
		require_once('InfoSecurity.php');

		require_once('request.php');
	
		// POSTting data from user side and encypt that information

		$data = new InfoSecurity();
	
		$current = date("dmYhis");
		$ip = $_SERVER['REMOTE_ADDR'];
		$UserID = "CUSTOMER-$current";
		
		$UserID = $data->encrypt(str_replace(".", "", "$UserID"));
		$f_name = $_POST['f_name'];
		$l_name = $_POST['l_name'];
		
		$user_email_auth = $data->encrypt($_POST['user_email_auth']);
		$user_password = $data->encrypt($_POST['user_password']);
		$country = $_POST['country'];
		$city_town = $_POST['city_town'];
		$preferred_language = $_POST['preferred_language'];
		$phone_no = $data->encrypt($_POST['phone_no']);
		$date_of_birth = $_POST['date_of_birth']; 
		$street_number = $_POST['street_number'];
		$residential_address = $_POST['residential_address']; 
		$postal_zip_code = $_POST['postal_zip_code'];
		$find_us_detail = $_POST['find_us_detail'];
		$account_type = $_POST['account_type'];  
        $account_base_currency = $_POST['account_base_currency'];
		$account_leverage = (1 / $_POST['account_leverage']);
        $expected_investment_balance  = $_POST['expected_investment_balance'];
	
		$query = "CALL add_new_users('$UserID', '$f_name', '$l_name', '$user_email_auth', '$user_password', '$country', '$city_town','$preferred_language', '$phone_no', '$date_of_birth', '$street_number', '$residential_address', '$postal_zip_code', '$find_us_detail','$account_type', '$account_base_currency', '$account_leverage','$expected_investment_balance')";

		$new_account = new DatabaseConfiguration();

		$result = $new_account->query($query);

		if($result['0']['0'] == "REGISTERED")
		{
			error("Registration successful");
		}
		else if($result['0']['0'] == "NOT REGISTERED")
		{
			error("Email Already Registered");
		}


?>	