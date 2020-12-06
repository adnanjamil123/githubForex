<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');
	
	session_start();
	
	// check login session
	
	if(isset($_SESSION['member_loginID']))
	{
		
	$data = new InfoSecurity();
	
	$member_loginID = $_SESSION['member_loginID'];

	$encrypt_UserID = $data->encrypt($member_loginID);
	
	$query = "CALL get_login_Name('$encrypt_UserID');";
	
	$user_account = new DatabaseConfiguration();
	
	$result = $user_account->query($query);

	$data = new InfoSecurity();
	
	$MemberPassword = $data->decrypt($result['0']['4']);

?>

<html >

<head>
 
</head>

<body>
	
	<?php require_once('client_header.php');?>
	
	<br/>
	
	<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >
	
		<!-- Card -->
		<div class="card" style="padding:30px;">
		
			
			<div class="card-body" >
			
			 <form name="changepassword_form"  action="change_password_processing" onsubmit="return changepassowrdformValidation(<?php echo $MemberPassword;?>)" method="POST" >
			 
				<p class="h4 text-center py-4">Change Password</p>
				
							<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
		<i id="error_current_password" style="float:right; color:red"></i>
        <input type="password" id="materialFormCardPasswordEx3" class="form-control" name="current_password" onfocusout="current_password_input_keys(this,<?php echo $MemberPassword;?>)" required>
        <label for="materialFormCardPasswordEx3" class="font-weight-light">Current password</label>
      </div>
	  
				<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
        <input type="password" id="materialFormCardPasswordEx" class="form-control" name="user_password" required>
        <label for="materialFormCardPasswordEx" class="font-weight-light">New password</label>
      </div>
		
	  <!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-exclamation-triangle prefix grey-text"></i>
		<i id="error_user_password" style="float:right; color:red"></i>
        <input type="password" id="materialFormCardPasswordEx2" class="form-control" name="confirm_user_password" onfocusout="user_password_input_keys(this)" required>
        <label for="materialFormCardPasswordEx2" class="font-weight-light">Confirm your password</label>
      </div>
				
				<div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" type="submit" name="change_password_btn">Change Password</button>
      </div>
				
				
			</form>
			
			</div>
			
		</div>
		
	</div>
	
	
</body>

</html>


<?php
		}
	else
	{
		session_destroy();

		error("Unauthorized Access");
	}
	
?>
