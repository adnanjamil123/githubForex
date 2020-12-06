<script type='text/javascript'>
		
	var url = "<?php echo 'http://localhost/www.onfinancialmarkets.com/'; ?>";
	
	var time = 3000;
				
</script>

<?php
	
	function error($request)
	{
		if($request == "Login failed")
		{
			echo "<h1>Login Failed.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Login successful")
		{
			echo "<h1>Login Successful.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'home';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Email Already Registered")
		{
			echo "<h1>Email Already Registered.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Registration successful")
		{
			echo "<h1>Registration Successful.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Unauthorized Access")
		{
			echo "<h1>Unauthorized Access.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Page Not Found")
		{
			echo "<h1>Page Not Found.</h1>";
	
		}
		else if($request == "Logout")
		{
			session_start();
			
			echo "<h1>Logout.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
			
			session_destroy();
		}
		else if($request == "Deposit")
		{
			
			echo "<h1>Make a payment.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'deposit';} setTimeout ('leave()', time); </script>";
			
		}
		else if($request == "Payment Done")
		{
			echo "<h1>Payment Done.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'home';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Payment Approved")
		{
			echo "<h1>Payment Approved.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Already Approved")
		{
			echo "<h1>Already Approved.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Verify Your Account")
		{
			echo "<h1>Please verify your account.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'home';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Transaction Done")
		{
			echo "<h1>Transaction Completed.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'home';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Withdraw amount is greater from current amount")
		{
			echo "<h1>Withdrawal amount exceeds current balance, please re-enter.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'withdraw_form';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Withdraw Approved")
		{
			echo "<h1>Withdrawal Approved.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Already Withdraw Approved")
		{
			echo "<h1>Already Withdrawal Approved.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Promotion Added")
		{
			echo "<h1>Promotion Added.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Unauthorized Access, Admin")
		{
			echo "<h1>Unauthorized Access.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Account Status Verified, Admin")
		{
			echo "<h1>Account is Verified.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Password Changed")
		{
			echo "<h1>You password is changed.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'home';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Bonus Applied, Admin")
		{
			echo "<h1>Bouns is applied and added to the account.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Customer Not Found, Admin")
		{
			echo "<h1>Bouns is not applied because customer account not found.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url+'adminpanel';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Forgot Password Changed")
		{
			echo "<h1>You password is changed.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url+'member_login';} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Forgot Password, Email Sent")
		{
			echo "<h1>Email Sending.</h1>";
	
			echo "Redirecting, please wait a second...";
		
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
		else if($request == "Email Not Found")
		{
			echo "<h1>Customer account not found.</h1>";
	
			echo "Redirecting, please wait a second...";
	
			echo "<script type='text/javascript'>function leave() {  window.location = url;} setTimeout ('leave()', time); </script>";
		}
	}
	
?>	