<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');

	$data = new InfoSecurity();
	
	$encrypt_UserID = str_replace(" ", "+", $_GET['UserID_auth']);
	
	$query = "CALL user_deposit_status('$encrypt_UserID');";
	
	$get_user_deposit_status = new DatabaseConfiguration();
	
	$result = $get_user_deposit_status->query($query);	
	
	$query_2 = "CALL user_withdraw_status('$encrypt_UserID');";
	
	$get_user_withdraw_status = new DatabaseConfiguration();
	
	$result_2 = $get_user_withdraw_status->query($query_2);	
	
	$query_3 = "CALL user_bonus_status('$encrypt_UserID');";
	
	$get_user_bonus_status = new DatabaseConfiguration();
	
	$result_3 = $get_user_bonus_status->query($query_3);	
?>

<!DOCTYPE html>
<html lang="en">

<head>
 
<style>

.navbar.navbar-1 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger6.svg?color=000');
}
.navbar.navbar-2 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger2.svg?color=fff');
}
.navbar.navbar-3 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger1.svg?color=6a1b9a');
}
.navbar.navbar-4 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger7.svg?color=BFE100');
}
.navbar.navbar-5 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger5.svg?color=f3e5f5');
}
.navbar.navbar-6 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger8.svg?color=E3005C');
}
.navbar.navbar-7 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger9.svg?color=FF2C00');
}
.navbar.navbar-8 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger4.svg?color=1729B0');
}
.navbar.navbar-9 .navbar-toggler-icon {
background-image: url('https://mdbootstrap.com/img/svg/hamburger3.svg?color=00FBD8');
}


</style>



</head>


<body>

	<?php require_once("admin_header.php"); ?>
	
	

<br/>
	
	
		
		<center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px; display: inline-block"> <b> <?php echo $data->decrypt($encrypt_UserID); ?> </b> </h5>
		<p class="h4 text-center py-4">Customer Transaction Summary</p>

<!----------------------- for deposit ----------------------- >

  <!-- Navbar brand -->
   <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Deposit </b> 



 <!-- Collapse button -->
  <button onclick="content_hide_show('desposit_table')" style="float:right;" class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="white-text" ><i
        class="fas fa-bars fa-1x" ></i></span></button>
		
		</h5></center>
		
<!-- <button onclick="exportTableToExcel('desposit_table', 'transactions_desposit_table')">Export Table Data To Excel File</button> -->

<div id="desposit_table" >

     <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">DID
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
						<td><?php echo $data->decrypt($display['1']);?></td>
						<td><?php echo $display['3'];?></td>
						<td><?php echo $display['4'];?></td>
						<td><?php echo $display['6'];?></td>
						<td><?php echo $display['5'];?></td>

				   </tr>
		
		<?php
			
					}

		?>	
                    
  </tbody>
  

</table>

  </div>

 <!----------------------- for withdraw ----------------------- >
 
  <!-- Navbar brand -->
   <center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Withdraw </b> 


 <!-- Collapse button -->
  <button onclick="content_hide_show('withdraw_table')" style="float:right" class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="white-text"><i
        class="fas fa-bars fa-1x"></i></span></button>
		
		</h5></center>

<div id="withdraw_table">

   <table id="dtHorizontalExample2" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
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
	
    </tr>
  </thead>
  <tbody>
    <?php
			
					foreach($result_2 as $display)
					{

					?>	
			
					<tr>
				
						<td><?php echo $display['0'];?></td>
						<td><?php echo $data->decrypt($display['1']);?></td>
						<td><?php echo $display['3'];?></td>
						<td><?php echo $display['4'];?></td>
						<td><?php echo $display['6'];?></td>
						<td><?php echo $display['5'];?></td>
					
				   </tr>
		
		<?php
			
					}

		?>	
                    
  </tbody>
  
</table>

</div>


<!----------------------- for bonus ----------------------- >

 <!-- Navbar brand -->
   <center><h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Bonus </b> 


 <!-- Collapse button -->
  <button onclick="content_hide_show('bonus_table')" style="float:right;" class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="white-text" ><i
        class="fas fa-bars fa-1x" ></i></span></button>
		
		</h5></center>

<div id="bonus_table" >

     <table id="dtHorizontalExample3" class="table table-striped table-bordered table-sm"  cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">BID
      </th>
      <th class="th-sm">Bonus Amount
      </th>
      <th class="th-sm">Approved Date/Time
      </th>
	  <th class="th-sm">Bonus Status
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
			
					foreach($result_3 as $display)
					{

					?>	
			
					<tr>
				
						<td><?php echo $display['0'];?></td>
						<td><?php echo $display['2'];?></td>
						<td><?php echo $display['4'];?></td>
						<td><?php echo $display['3'];?></td>

				   </tr>
		
		<?php
			
					}

		?>	
                    
  </tbody>
  

</table>

  </div>
  
<script>
		
		function content_hide_show(field) {
  var x = document.getElementById(field);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 
		
	
	</script>
  
  
  
<script>
$(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true,
});
$('.dataTables_length').addClass('bs-select');
});
</script>
  

<script>
$(document).ready(function () {
$('#dtHorizontalExample2').DataTable({
"scrollX": true,
});
$('.dataTables_length').addClass('bs-select');
});
</script>

<script>
$(document).ready(function () {
$('#dtHorizontalExample3').DataTable({
"scrollX": true,
});
$('.dataTables_length').addClass('bs-select');
});
</script>


<script>

	function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


</script>

</body>

</html>

