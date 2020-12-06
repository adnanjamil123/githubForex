<?php
	
	// include files
	
	require_once('DatabaseConfiguration.php');
	
	require_once('InfoSecurity.php');
	
	require_once('request.php');

	$data = new InfoSecurity();
	
	$encrypt_UserID = str_replace(" ", "+", $_GET['UserID']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>On Financial Markets</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="form_sourcefiles/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="form_sourcefiles/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="form_sourcefiles/css/style.css" rel="stylesheet">

	<style>
		
		body, html {
  height: 100%;
}
.bg {
  /* The image used */
  background-image: url("images/business_image_2.jpg");

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
		
	</style>	

</head>

<body>
	
	<div class="bg">
	
	<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >
	
		<!-- Card -->
		<div class="card" style="padding:30px; opacity:0.9;">
		
			
			<div class="card-body" >
			
			 <form name="forgotchangepassword_form"  action="forgot_change_password_processing?UserID=<?php echo $encrypt_UserID; ?>" onsubmit="return forgotchangepassowrdformValidation()" method="POST" >
			 
				<p class="h4 text-center py-4">Change Password</p>
	  
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
	</div>
	
	
	
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="form_sourcefiles/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="form_sourcefiles/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="form_sourcefiles/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="form_sourcefiles/js/mdb.min.js"></script>
  <!-- Validation -->
   <script type="text/javascript" src="js/form-validation.js"></script>
	
</body>

</html>
