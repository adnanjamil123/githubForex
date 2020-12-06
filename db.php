<?php
require_once ('db_credentials.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forextrading";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$EMAIL= 'adnanjamil221@gmail.com';

$pHeader="<tr class = 'header'><th>Created</th><th>Market</th><th>Size</th><th>Direction</th><th>Entry</th>
<th>T/P</th><th>S/L</th><th>Gross USD</th><th>Close</th></tr>";

$iHeader="<tr class = 'invoice-header'><th>Deal ID</th><th>Closing time</th><th>Market</th>
<th>Size</th><th>Direction</th><th>Entry</th><th>Closing Price</th><th>Commission</th>
<th>Gross</th><th>Net</th><th>Balance</th></tr>";


// Make new db Connection
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    confirm_db_connect();
    return $connection;
}

// Close Db Connection
function db_close($connection)
{
    if(isset($connection)){
        mysqli_close($connection);
    }
    
}

//database connect error
function confirm_db_connect()
{
    if(mysqli_connect_errno())
    {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

//database query error
function confirm_result_set($result_set){

    if(!$result_set){
       exit("Database query Failed."); 
    }

}

?>