<?php

function fill_accounts_dropdown()
{
  $output = '';
  $color1 = "orange";
  $color2 = "green";
  $color = $color1;
  
  $accounts_set = query_all_accounts();

  while($rows = mysqli_fetch_assoc($accounts_set)){

    $color == $color1 ? $color = $color2 : $color = $color1;

    $balance = number_format($rows['balance'],2);
   
      $output .= "<option data-leverage=$rows[leverage] data-bonus=$rows[bonus] value=$rows[account_id] name=$balance class=account-info style=background:$color> ";
      $output .= "&#10004; Account ID:$rows[account_id] 	&#8212; ";
      $output .= "&#8226; USD  $balance &#36; ";
      $output .= "$rows[account_type]";
      $output .= "</option>";
       
   }
   mysqli_free_result($accounts_set);
   return $output;

}
function get_first_bonus()
{
  
  $accounts_set = query_all_accounts();
  
  $rows = mysqli_fetch_assoc($accounts_set);
   
    $bonus = number_format($rows['bonus']);
    

    mysqli_free_result($accounts_set);

    return $bonus;

}

function update_bonus($ID)
{
  global $db;

  $sql = "SELECT bonus FROM account_info ";
  $sql .= "WHERE account_id= '".$ID."' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db , $sql);
  confirm_result_set($result);
  $data = mysqli_fetch_assoc($result);
  return $data['bonus'];
}

function fill_accounts_byId($ID)
{
  $output = '';
  $color1 = "orange";
  $color2 = "green";
  $color = $color1;
  
  $accounts_set = query_all_accounts_byID($ID);

  while($rows = mysqli_fetch_assoc($accounts_set)){

    $color == $color1 ? $color = $color2 : $color = $color1;

    $balance = number_format($rows['balance'],2);
   
      $output .= "<option data-leverage=$rows[leverage] data-bonus=$rows[bonus] value=$rows[account_id] name=$balance class=account-info style=background:$color> ";
      $output .= "&#10004; Account ID:$rows[account_id] 	&#8212; ";
      $output .= "&#8226; USD  $balance &#36; ";
      $output .= "$rows[account_type]";
      $output .= "</option>";
       
   }
   mysqli_free_result($accounts_set);
   return $output;

}
// fill account balance at start(loading page)
function fill_account_balance()
{

    
  $accounts_set = query_all_accounts();
  
  $rows = mysqli_fetch_assoc($accounts_set);
   
    $balance = number_format($rows['balance']);
    

    mysqli_free_result($accounts_set);

    return $balance;

}
// placing open positions at start on loading of page(ascending by account id)
function update_position_Start(){
    global  $pHeader;
    
    $output = $pHeader;

      $result = query_open_positions_atStart();

      if(mysqli_num_rows($result)>0)
      {
        while($data = mysqli_fetch_assoc($result))
        {
          
        $size = number_format($data['size']);
          
        $output .=   "<tr name=$data[position_id] class=$data[market]><td>$data[created]</td>
        <td id='mark'>$data[market]</td><td id='pos-size'>$size</td><td>$data[direction]</td><td>$data[entry]</td>
        <td>$data[take_profit]</td><td>$data[stop_limit]</td>
        <td id='gross'></td><td id='price'></td></tr>";

        }
        mysqli_free_result($result);
         return $output;
      }
}
//get balance of specific account id
function get_balance($ID)
{
  global $db;

  $sql = "SELECT balance FROM account_info ";
  $sql .= "WHERE account_id= '".$ID."' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db , $sql);
  confirm_result_set($result);
  $data = mysqli_fetch_assoc($result);
  return $data['balance'];
}

//update balance in specific ID with amount
function update_balance($ID , $Amount)
{
    global $db;

    $oldBalance = get_balance($ID);
    $newBalance = $oldBalance + $Amount;

    $sql = "UPDATE account_info SET ";
    $sql .= "balance= '".$newBalance."' ";
    $sql .= "WHERE account_id= '".$ID."'";

    $result = mysqli_query($db , $sql);
    confirm_result_set($result);
    return $newBalance;
}

// load closed invoices
function load_invoices_atstart()
{
 global $iHeader;
 global $db;
 global $EMAIL;

 $output = $iHeader;

 $sql ="SELECT * FROM positions WHERE account = (SELECT account_id from account_info
 WHERE email_id = '$EMAIL' ORDER BY account_id ASC LIMIT 1) AND status = 'invoice' ";
  $sql .="AND DATE(closing_time)= CURDATE()";
 $sql .="ORDER BY closing_time DESC";

 $result = mysqli_query($db , $sql);
  confirm_result_set($result);
 while($data = mysqli_fetch_assoc($result))
 {

  $output .="<tr name=$data[position_id]><td>$data[position_id]</td><td>$data[closing_time]</td><td>$data[market]</td>
  <td>$data[size]</td><td>$data[direction]</td><td>$data[entry]</td><td>$data[closed_price]</td>
  <td>$data[commission]</td><td>$data[gross]</td><td>$data[net]</td><td>$data[balance]</td></tr>";

 }

 return $output;
}
//load invoices by specific period
function load_invoices_period($id,$interval,$period)
{
 global $iHeader;
 global $db;
 global $EMAIL;

 $output = $iHeader;
 if($interval == 0 && $period == "Day")
 {
  $sql ="SELECT * FROM positions WHERE account = $id AND status = 'invoice' ";
  $sql .="AND DATE(closing_time)= CURDATE()";
 $sql .="ORDER BY closing_time DESC";

 $result = mysqli_query($db , $sql);
  confirm_result_set($result);
 while($data = mysqli_fetch_assoc($result))
 {

  $output .="<tr name=$data[position_id]><td>$data[position_id]</td><td>$data[closing_time]</td><td>$data[market]</td>
  <td>$data[size]</td><td>$data[direction]</td><td>$data[entry]</td><td>$data[closed_price]</td>
  <td>$data[commission]</td><td>$data[gross]</td><td>$data[net]</td><td>$data[balance]</td></tr>";

 }

 return $output;
 }

 $sql ="SELECT * FROM positions WHERE account = $id AND status = 'invoice' ";
  $sql .="AND closing_time >= DATE_SUB(now(), INTERVAL $interval $period) ";
 $sql .="ORDER BY closing_time DESC";

 $result = mysqli_query($db , $sql);
  confirm_result_set($result);
 while($data = mysqli_fetch_assoc($result))
 {

  $output .="<tr name=$data[position_id]><td>$data[position_id]</td><td>$data[closing_time]</td><td>$data[market]</td>
  <td>$data[size]</td><td>$data[direction]</td><td>$data[entry]</td><td>$data[closed_price]</td>
  <td>$data[commission]</td><td>$data[gross]</td><td>$data[net]</td><td>$data[balance]</td></tr>";

 }

 return $output;
}

function load_invoices($ID)
{
 global $iHeader;
 global $db;

 $output = $iHeader;

 $sql ="SELECT * FROM positions WHERE account = $ID AND status = 'invoice' ";
 $sql .="AND DATE(closing_time)= CURDATE()";
 $sql .= "ORDER BY closing_time DESC";
 

 $result = mysqli_query($db , $sql);
  confirm_result_set($result);
 while($data = mysqli_fetch_assoc($result))
 {

  $output .="<tr name=$data[position_id]><td>$data[position_id]</td><td>$data[closing_time]</td><td>$data[market]</td>
  <td>$data[size]</td><td>$data[direction]</td><td>$data[entry]</td><td>$data[closed_price]</td>
  <td>$data[commission]</td><td>$data[gross]</td><td>$data[net]</td><td>$data[balance]</td></tr>";

 }

 return $output;
}

?>