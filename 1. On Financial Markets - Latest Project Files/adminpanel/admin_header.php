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
  <link href="../form_sourcefiles/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../form_sourcefiles/css/mdb.min.css" rel="stylesheet">
  <!-- MDBootstrap Datatables  -->
  <link href="../form_sourcefiles/css/addons/datatables.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../form_sourcefiles/css/style.css" rel="stylesheet">
  <!-- MDBootstr.ap Datatables  -->
<link href="../form_sourcefiles/css/addons/datatables.min.css" rel="stylesheet">
  <!-- Layout Standards  -->
<link href="../standards/layout_standards.css" rel="stylesheet">

	
 
<style>

p{
	
	text-align: justify;
}

}


</style>


</head>

<body onresize="OnResizeWindow()">



  <!-- Start your project here-->
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark " style="background:var(--main_admin_header_layout_background_color);"> <!--- #34495e -->
  <a class="navbar-brand" href=".">On Financial Markets</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href=".">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      
	    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Promotion
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="promotion_form">Add Promotion</a>
          <a class="dropdown-item" href="bonus_form">Add Bonus</a>

        </div>
      </li>
	  
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Transaction Summary
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="deposit_summary">Deposit</a>
          <a class="dropdown-item" href="withdraw_summary">Withdraw</a>

        </div>
      </li>
	  
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Accounts
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="user_requests">User Requests</a>
          <a class="dropdown-item" href="our_users">Our Users</a>

        </div>
      </li>
	  
	  
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
     
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>  Profile
        </a>
        <div id="profile_bar" class="dropdown-menu  dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
         <a class="dropdown-item" href="#">My account</a>
          <a class="dropdown-item" href="#">Log out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="../form_sourcefiles/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../form_sourcefiles/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../form_sourcefiles/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../form_sourcefiles/js/mdb.min.js"></script>
  <!-- Validation -->
   <script type="text/javascript" src="js/form-validation.js"></script>

  <!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="../form_sourcefiles/js/addons/datatables.min.js"></script>
	  
	  <script>

	 function OnResizeWindow () {
	var w = window.innerWidth;
	var element = document.getElementById("profile_bar");
	
        if(w <= 997) {
			
			 element.classList.remove('dropdown-menu-right');  
             
         } else {
               element.classList.add('dropdown-menu-right');
				
        }
	 }
	 
	OnResizeWindow ();

</script>
</body>

</html>
