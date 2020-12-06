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
	
	$query = "CALL user_withdraw_status('$encrypt_UserID');";
	
	$get_user_withdraw_status = new DatabaseConfiguration();
	
	$result = $get_user_withdraw_status->query($query);	
?>


<html>

<head>
  
	<!-- MDBootstrap Datatables  -->
<link href="form_sourcefiles/css/addons/datatables.min.css" rel="stylesheet">


<style>

p{
	
	text-align: justify;
}



</style>

</head>

<body>

	<?php require_once('client_header.php');?>
	<br/>
  <!-- Start your project here--><center> <h5 style="background:var(--main_client_header_layout_heading_background_color); color:white; padding:10px"> <b> Withdraw Summary</b> </h5></center>


	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		


    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">WID
      </th>
      <th class="th-sm">Withdraw Email/Account No
      </th>
      <th class="th-sm">Withdraw Method
      </th>
      <th class="th-sm">Withdraw Amount
      </th>
      <th class="th-sm">Withdraw Date/Time
      </th>
	  <th class="th-sm">Withdraw Status
      </th>
	  <th class="th-sm">Request
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
			
					foreach($result as $display)
					{

					?>	
			
					<tr>
				
						<td><?php echo $display['0'];?></td>
						<td><?php echo $data->decrypt($display['1']);?></td>
						<td><?php echo $display['3'];?></td>
						<td><?php echo $display['4'];?></td>
						<td><?php echo $display['6'];?></td>
						<td><?php echo $display['5'];?></td>
						<td <?php if($display['5'] == "NOT APPROVED") { ?> style="background:black; color:white" <?php } ?> > <a <?php if($display['5'] == "NOT APPROVED") { ?> style="color:white" name="payment_withdrawcancel_btn" href="payment_withdraw_cancel_processing?WID_auth=<?php echo $display['0'];?>&transaction_account_info=<?php echo $data->decrypt($display['1']);?>&transaction_method_type=<?php echo $display['3'];?>&deposit_amount=<?php echo $display['4'];?>&UserID_auth=<?php echo $data->decrypt($display['7']); ?>" <?php } else { ?> href="#" <?php } ?>>  <?php if($display['5'] == "APPROVED") { echo "APPROVED BY ADMIN"; } else if($display['5'] == "CANCELLED") { echo  "CANCELLED BY YOU"; } else { echo "CANCEL REQUEST"; }?> </a> </td>
				   </tr>
		
		<?php
			
					}

		?>	
                    
  </tbody>
  
</table>

  <!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="form_sourcefiles/js/addons/datatables.min.js"></script>


<script>
$(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true,
});
$('.dataTables_length').addClass('bs-select');
});
</script>
  
	  
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