<!DOCTYPE html>
<html lang="en">

<head>
 
  <script src="js/form-validation.js"></script>
	
<style>


</style>

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
    <form name="promotion_form"  action="promotion_processing" method="POST" >
      <p class="h4 text-center py-4">Add Promotion</p>

	 <!-- Material outline input -->
<div class="md-form md-outline">
  <input type="text" id="form1" class="form-control" name="promotion_title" required>
  <label for="form1">Promotion Title</label>
</div>
     
	 <div class="md-form">
  <textarea id="textarea-char-counter" class="form-control md-textarea" length="120" rows="3" name="promotion_description" required></textarea>
  <label for="textarea-char-counter">Promotion Description</label>
</div>
	 	 <!-- Material outline input -->
<div class="md-form md-outline">
  <input type="text" id="form2" class="form-control" name="promotion_percentage" required>
  <label for="form2">Promotion Percentage</label>
</div>
     
	  
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" name="addpromotion_btn" type="submit">Add</button>
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

