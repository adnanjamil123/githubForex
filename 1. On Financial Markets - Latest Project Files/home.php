<?php
	
	// include files
	
	require_once('request.php');
	
	session_start();

	
		if(isset($_SESSION['member_loginID']))
		{
		
	
?>


<html>

<head>

</head>

<body>
	
	<?php require_once('client_header.php');?>
	
</body>

</html>


<?php
			}
			else
			{
				session_destroy();

				error("Unauthorized Access");
			}
			/*
	}
	else
	{
		error("Unauthorized Access");
	}
	*/