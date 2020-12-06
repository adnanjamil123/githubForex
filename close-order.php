<?php
require_once ('config.php');
require_once ('query_functions.php');
require_once ('functions.php');

if (isset($_POST['positionID']) && empty($_POST['status'])) {

    $orderID = $_POST['positionID'];
    $procedure = "SELECT status FROM positions WHERE position_id = '$orderID'";
    $data = mysqli_query($db , $procedure);
    $result = mysqli_fetch_assoc($data);
    echo $result['status'];
    exit;
}

if (isset($_POST['status'])) {

    $accountID = $_POST['accountId'];
    $orderID = $_POST['positionID'];
    $closing_Price = $_POST['closingPrice'];
    $gross = $_POST['gross'];
    $expenses = $_POST['expenses'];
    $net = $_POST['net'];

    $result =  update_balance($accountID, $net);
    $data = close_order($orderID, $closing_Price, $gross, $net, $expenses, $result);
    echo $data;
    exit;
}

if(isset($_POST['id']))
{
    $ID = $_POST['id'];
    $data = load_orders($ID);
    echo $data;
}

if(isset($_POST['aId']))
{
    $ID = $_POST['aId'];
    $data = fill_accounts_byId($ID);
    echo $data;
}
if(isset($_POST['did']))
{
    $ID = $_POST['did'];
    $data = load_invoices($ID);
    echo $data;
}

?>