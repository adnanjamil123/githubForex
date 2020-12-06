<?php
	
	// include files
	
	require_once('request.php');
	
	session_start();
	
	/*
	if (isset($_POST['withdraw_btn']))
	{
		*/
		// check login session
	
		if(isset($_SESSION['member_loginID']))
		{
		
	
?>


<html>

<head>

</head>

<body onload="current_paymentMethod();">

<?php require_once('client_header.php');?>

<br/>

  <!-- Start your project here-->
<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >

	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		
<div class="card" style="padding:30px;">

  <!-- Card body -->
  <div class="card-body">

    <!-- Material form register -->
    <form name="transaction_form"  action="payment_withdraw_processing" onsubmit="return withdrawformValidation()" method="POST" >
      <p class="h4 text-center py-4">Withdraw Information</p>

	    <!-- Material input email -->
      <div class="md-form">
        <i id="symbol" class="fa fa-envelope prefix grey-text"></i>
		<i id="error_user_email_auth" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardEmailEx" class="form-control" name="transaction_account_info" onkeyup="current_paymentMethod();" required>
        <label for="materialFormCardEmailEx" id="textforMethod" name="textforMethod"  class="font-weight-light">Your email</label>
      </div>

   
	   <label class="font-weight-light">Payment Method</label>
	  <select class="browser-default custom-select"  id="transaction_method_type" name="transaction_method_type"  onchange="current_paymentMethod();" required>
		  <option selected disabled style="display:none">Method Type</option>
		  <option value="WEBMONEY">WEBMONEY</option>
		  <option value="SKRILL">SKRILL</option>
	  </select>
	  
	  <br/><br/>
	   <center> <h5> <label id="textforOurDetail" style="background:skyblue; color:white" class="font-weight-light">OUR PAYMENT DETAIL</label> </h5> </center>
	   <label class="font-weight-light">Amount</label>
	  <div class="form-group">
		<input type="text" class="form-control" id="inputAddress" placeholder="Enter amount" name="withdraw_amount" onfocusout="transaction_amount_input_keys(this)" required>
			<i id="error_transaction_amount" style="float:right; color:red"></i>
	  </div>
	  
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" name="payment_withdraw_btn" type="submit">Withdraw</button>
      </div>
	  
    </form>
    <!-- Material form register -->

  </div>
  <!-- Card body -->

</div>

<!-- Card -->
	
	
	
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
			/*
	}
	else
	{
		error("Unauthorized Access");
	}
	*/
?>
