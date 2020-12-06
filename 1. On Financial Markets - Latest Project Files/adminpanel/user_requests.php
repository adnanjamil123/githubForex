<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');
	
	$data = new InfoSecurity();
	
	$query = "CALL useraccount_requests";
	
	$get_useraccount_status = new DatabaseConfiguration();
	
	$result = $get_useraccount_status->query($query);
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
<style>

</style>

</head>

<body>
<?php require_once("admin_header.php"); ?>

<br/>
  <!-- Start your project here-->
<center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Account Verification Applicatons </b> </h5></center>

	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		


    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">UserID
      </th>
      <th class="th-sm">Full Name
      </th>
      <th class="th-sm">Email Address
      </th>
      <th class="th-sm">Country
      </th>
      <th class="th-sm">City
      </th>
      <th class="th-sm">Residential Address
      </th>
	  <th class="th-sm">Phone No
      </th>
	  <th class="th-sm">Account Type
      </th>
	  <th class="th-sm">Account Base Currency
      </th>
	  <th class="th-sm">Account Status
      </th>
	  
    </tr>
  </thead>
  <tbody>
    <?php
			
					foreach($result as $display)
					{

					?>	
			
					<tr>
				
						<td><?php echo $data->decrypt($display['0']);?></th>
						<td><?php echo $display['1'] . ' ' . $display['2'];?></th>
						<td><?php echo $data->decrypt($display['3']);?></th>
						<td><?php echo $display['5'];?></th>
						<td><?php echo $display['6'];?></th>
						<td><?php echo $display['11'];?></th>
						<td><?php echo $data->decrypt($display['8']);?></th>
						<td><?php echo $display['15'];?></th>
						<td><?php echo $display['18'];?></th>
						<td> <a href="update_user_requests_form?UserID_auth=<?php echo $display['0']; ?>">  <?php echo $display['16'];?>  </a> </th>

				   </tr>
		
		<?php
			
					}

		?>	
                    
  </tbody>
  
</table>

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
