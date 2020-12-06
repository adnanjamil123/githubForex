<?php
	


	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');
	
	$data = new InfoSecurity();
	
	$query = "CALL our_users_status";
	
	$get_our_users_status = new DatabaseConfiguration();
	
	$result = $get_our_users_status->query($query);
	
	$count_users = 0;
	
	$count_total_users = 0;
	
	$count_monthly_info = array(0,0,0,0,0,0,0,0,0,0,0,0);
	
	$count_wayof_findus_by_social = array(0,0,0); 
	
	if(isset($_COOKIE['current_year']))
	{
		$current_year = $_COOKIE['current_year'];
	}
	else
	{
		$current_year = substr(date("Y/m/d"),0,4);
	}
	
	
	foreach($result as $display)
	{
		if(($display['16'] == "VERIFIED"))
		{
			$count_total_users++;
		}
		
		if(($display['16'] == "VERIFIED") && (substr($display['17'],0,4) == $current_year))
		{
			// find us
			if($display['13'] == "Google")
			{
				$count_wayof_findus_by_social[0]++;
			}
			else if($display['13'] == "Facebook")
			{
				$count_wayof_findus_by_social[1]++;
			}
			else if($display['13'] == "Yahoo")
			{
				$count_wayof_findus_by_social[2]++;
			}
		
			// no of users detail
			if(substr($display['17'],5,2) == "01")
			{
				$count_monthly_info[0]++;
			}
			else if(substr($display['17'],5,2) == "02")
			{
				$count_monthly_info[1]++;
			}
			else if(substr($display['17'],5,2) == "03")
			{
				$count_monthly_info[2]++;
			}
			else if(substr($display['17'],5,2) == "04")
			{
				$count_monthly_info[3]++;
			}
			else if(substr($display['17'],5,2) == "05")
			{
				$count_monthly_info[4]++;
			}
			else if(substr($display['17'],5,2) == "06")
			{
				$count_monthly_info[5]++;
			}
			else if(substr($display['17'],5,2) == "07")
			{
				$count_monthly_info[6]++;
			}
			else if(substr($display['17'],5,2) == "08")
			{
				$count_monthly_info[7]++;
			}
			else if(substr($display['17'],5,2) == "09")
			{
				$count_monthly_info[8]++;
			}
			else if(substr($display['17'],5,2) == "10")
			{
				$count_monthly_info[9]++;
			}
			else if(substr($display['17'],5,2) == "11")
			{
				$count_monthly_info[10]++;
			}
			else if(substr($display['17'],5,2) == "12")
			{
				$count_monthly_info[11]++;
			}
			
			
	
			$count_users++;
		
		}
		
	}
	
?>

<html>

<head>

</head>

<body>
	
	<?php require_once('admin_header.php');?>
	
	<script>

	if (document.cookie.indexOf('current_year') == -1 ) {
		
		var d = new Date();
		
		d.setTime(d.getTime() + (3600 * 1000 * 24 * 365 * 5));

		var expires = "expires="+ d.toUTCString();
  
		var current_year = <?php echo json_encode(substr(date("Y/m/d"),0,4)); ?>;
		
		document.cookie = "current_year = " + current_year + ";" + expires;
		
	}

		function selectyear(fieldname)
		{
		
			var d = new Date();
		
		    d.setTime(d.getTime() + (3600 * 1000 * 24 * 365 * 5));

		    var expires = "expires="+ d.toUTCString();
  
		    var current_year = <?php echo json_encode(substr(date("Y/m/d"),0,4)); ?>;
	

			selected_year = fieldname.value;
			
			document.cookie = "current_year = " + selected_year + ";" + expires;
		
			location.reload(); 
		}
	
	</script>
	
	
	<br/>
	
		<center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Total Registered Users  - <?php echo $count_total_users; ?></b> </h5></center>
	
	<br/>
	
	<center>
	
	<label class="font-weight-light">Select Year</label>
	
	<div class="d-flex justify-content-center align-items-center"  style="max-width: 15rem;" >
	
	  <select class="browser-default custom-select"  name="year" id="year" onchange="selectyear(this)" required>
	  
		  <option selected disabled style="display:none">Year</option>

		<?php for($i=substr(date("Y/m/d"),0,4); $i>(substr(date("Y/m/d"),0,4)) - 5 ; $i--) { ?>
			
			<option <?php if($current_year  == $i) { ?> selected <?php } ?>value="<?php echo $i;?>"> <?php echo $i;?> </option>
			
		<?php } ?>
			
	  </select>
	  
	  </div>
	  
	  </center>
	  
	  <br/>
	  
		<div class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >
	
			<canvas id="myChart" style="max-width: 700px;"></canvas>
		
		</div>
	
	<br/>
	
		<center> <h5 style="background:var(--main_admin_header_layout_heading_background_color); color:white; padding:10px"> <b> Advertisement Details </b> </h5></center>
	
		<div class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >

			<canvas id="polarChart" style="max-width: 600px;"></canvas>
		
		</div>
		

	<br/>
	
	
	<script>
		

var month = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

var total_users = <?php echo $count_users; ?>;

var socialmedia  = new Array("Google", "Facebook", "Yahoo");

var count_wayof_findus_by_social = <?php echo json_encode($count_wayof_findus_by_social); ?>;

var count_monthly_info = <?php echo json_encode($count_monthly_info); ?>;

//bar
		var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: month,
    datasets: [{
      label: 'No of Per Year Users ( ' + total_users + ' ) - ' + <?php echo json_encode($current_year);?>, 
      data: count_monthly_info,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
	
	//polar
var ctxPA = document.getElementById("polarChart").getContext('2d');
var myPolarChart = new Chart(ctxPA, {
  type: 'polarArea',
  data: {
    labels: socialmedia,
    datasets: [{
      data: count_wayof_findus_by_social,
      backgroundColor: ["rgba(212, 70, 56, 0.1)", "rgba(60,90,153,0.5)", "rgba(67, 2, 151, 0.2)"
      ],
      hoverBackgroundColor: ["rgba(212, 70, 56,1.0)", "rgba(60,90,153,1.0)",
        "rgba(67, 2, 151, 1.0)"
      ]
    }]
  },
  options: {
    responsive: true
  }
});

	</script>
</body>

</html>

