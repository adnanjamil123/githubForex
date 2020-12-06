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

	$MemberID = $result['0']['0'];
	$MemberName = $result['0']['1'] . ' ' .$result['0']['2'];
	$MemberPlace = $result['0']['6'] . ', ' . $result['0']['5'];
	$MemberAccountType = $result['0']['15'];
	$MemberAccountStatus = $result['0']['16'];
	$MemberBalance = $result['0']['20'];
	$BonusBalance = $result['0']['21'];
	$Phone = $result['0']['8'];		
?>

<html >

<head>

</head>

<body>
	
	<?php require_once('client_header.php');?>
	
	<br/>
	
	<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >
	
		<!-- Card -->
		<div class="card">
		
			<p class="h4 text-center py-4">Account Information</p>
			<!-- Card body -->
			<div class="card-body">
			
			
			
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Member ID:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo strtoupper($data->decrypt($MemberID)); ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Member Name:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo strtoupper($MemberName); ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Account Type:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo strtoupper($MemberAccountType); ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Account Status:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo strtoupper($MemberAccountStatus); ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Current Balance:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo $MemberBalance . ' + ' . $BonusBalance . ' BONUS'; ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Phone:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo $data->decrypt($Phone); ?> </span>
					</div>	
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="background:white"id="inputGroup-sizing-default"> Place:  </span>
						<span class="input-group-text" id="inputGroup-sizing-default"> <?php echo strtoupper($MemberPlace); ?> </span>
					</div>	
				</div>
				
				<center> <a href="change_password_form" ><button type="button" class="btn btn-dark">CHANGE PASSWORD</button> </a> </center>
				
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
