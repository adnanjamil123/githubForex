<!DOCTYPE html>
<html lang="en">

<head>
  
</head>

<body>
<?php require_once("admin_header.php"); ?>

<br/>
  <!-- Start your project here-->
<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >

	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		
<div class="card" style="padding:30px;">

  <!-- Card body -->
  <div class="card-body">

    <!-- Material form register -->
    <form name="national_identity_form"  action="UpdateUserRequests?UserID_auth=<?php echo $_GET['UserID_auth']; ?>" onsubmit="return formValidation()" method="POST" >
      <p class="h4 text-center py-4">National Identity Information</p>

	    <label class="font-weight-light">National Identity Type</label>
	  <select class="browser-default custom-select" name="national_identity_type" required>
		  <option selected disabled style="display:none">National Identity Type</option>
		  <option value="National Identity Card">National Identity Card</option>
		  <option value="Passport">Passport</option>
	  </select>
	  
	  <br/><br/>

	  <label class="font-weight-light">National Identity Number</label>
	  <div class="form-group">
		<input type="text" class="form-control" id="inputAddress" placeholder="National Identity Number" name="national_identity_number" onfocusout="national_identity_number_input_keys(this)" required>
			<i id="error_national_identity_number" style="float:right; color:red"></i>
	  </div>
	  
	  
      <!-- Material input text -->
      <div class="md-form">
	  
        <i class="fa fa-user-tie prefix grey-text"></i>
		<i id="error_national_identity_name" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardFirstNameEx" class="form-control" name="national_identity_name" onfocusout="national_identity_name_input_keys(this)"  required>
         
		<label for="materialFormCardFirstNameEx" class="font-weight-light">National Identity Name</label>
		
      </div>
	
	  
	<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-calendar prefix grey-text"></i>
		<i id="error_issue_date" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardDOB" class="form-control" name="issue_date" onfocusout="issue_date_input_keys(this)" required>
		
        <label for="materialFormCardDOB" class="font-weight-light">Issue Date (YYYY-MM-DD) </label>
      </div>
	
<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-calendar prefix grey-text"></i>
		<i id="error_expire_date" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardDOB2" class="form-control" name="expire_date" onfocusout="expire_date_input_keys(this)" required>
		
        <label for="materialFormCardDOB2" class="font-weight-light">Expire Date (YYYY-MM-DD) </label>
      </div>
	  
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" type="submit">Add Detail</button>
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
