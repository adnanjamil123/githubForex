<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');
	
	$data = new InfoSecurity();
	
	$query = "SELECT * FROM deposit_status";
	
	$get_deposit_status = new DatabaseConfiguration();
	
	$result = $get_deposit_status->query($query);
			
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
 <center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Deposit </b> </h5></center>


	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		


    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">DID
      </th>
      <th class="th-sm">Customer ID
      </th>
      <th class="th-sm">Deposit Email/Account No
      </th>
      <th class="th-sm">Deposit Method
      </th>
      <th class="th-sm">Deposit Amount
      </th>
      <th class="th-sm">Deposit Date/Time
      </th>
	  <th class="th-sm">Deposit Status
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
						<td><?php echo $data->decrypt($display['7']);?></td>
						<td><?php echo $data->decrypt($display['1']);?></td>
						<td><?php echo $display['3'];?></td>
						<td><?php echo $display['4'];?></td>
						<td><?php echo $display['6'];?></td>
						<td> <a href="update_deposit_summary?DID_auth=<?php echo $display['0'];?>&UserID_auth=<?php echo $display['7']; ?>">  <?php echo $display['5'];?>  </a> </td>

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
