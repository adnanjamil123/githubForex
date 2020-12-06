<?php

	require_once('request.php');
	
	session_start();
	
	// check login session
	
	if(isset($_SESSION['member_loginID']))
	{
		error("Login successful");
	}
	else
	{

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

<body >
<div class="bg">
  <!-- Start your project here-->

  
	<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" > <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
<div class="card" style="padding:30px; opacity:0.9;">

  <!-- Card body -->
  <div class="card-body">

    <!-- Material form register -->
    <form method="POST" name="login" action="UserAuth" onsubmit="return loginformValidation()">
      <p class="h4 text-center py-4">Sign in</p>

    
      <!-- Material input email -->
      <div class="md-form">
        <i class="fa fa-envelope prefix grey-text"></i>
		<i id="error_user_email_auth" style="float:right; color:red"></i>
        <input type="email" id="materialFormCardEmailEx" class="form-control" name="user_email_auth" onfocusout="user_email_auth_input_keys(this)" required>
        <label for="materialFormCardEmailEx" class="font-weight-light">Your email</label>
      </div>

      <!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
		
        <input type="password" id="materialFormCardPasswordEx" class="form-control" name="user_password_auth"  required>
        <label for="materialFormCardPasswordEx" class="font-weight-light">Your password</label>
      </div>
	
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" type="submit" name="login_btn">Login</button>
      </div>
	  
	   
	  <center> <a href="forgot_password_provide_email"> <h6>Forgot Password</h6> </a> </center>
	  
    </form>
    <!-- Material form register -->

  </div>
  <!-- Card body -->

</div>
<!-- Card -->
	</div>

	</div>

		
  <!-- Start your project here-->

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


<?php

		session_destroy();
	}

?>