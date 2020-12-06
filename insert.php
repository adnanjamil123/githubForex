<?php

require_once ('db.php');
require_once ('config.php');
require_once ('query_functions.php');


$id = $_POST['id'];
$market = $_POST['market'];
$direction = $_POST['direction'];
$entry = $_POST['entryAmount'];
$size = $_POST['size'];
$stop = $_POST['stopLoss'];
$take = $_POST['takeProfit'];

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// $sql = "INSERT INTO positions (account, market, direction, entry, size, status)
// VALUES ('$id', '$market', '$direction', '$entry', '$size', 'open')";

$result = insert_position($id, $market, $direction, $entry, $size, $stop, $take);


    echo 
"
  <tr class = 'header'>
  <th>Created</th>
  <th>Market</th>
  <th>Size</th>
  <th>Direction</th>
  <th>Entry</th>
  <th>T/P</th>
  <th>S/L</th>
  <th>Gross USD</th>
  <th>Close</th>
  </tr>";

    $sql = "SELECT * FROM positions 
    WHERE account = $id AND status = 'open'" ;

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
      while($data = mysqli_fetch_assoc($result))
      {
        $id = $data['position_id'];
        $created = $data['created'];
        $market = $data['market'];
        $currency = '"'.$market.'"';
        $size = number_format($data['size']);
        $direction = $data['direction'];
        $entry = $data['entry'];
        $take = $data['take_profit'];
        $stop = $data['stop_limit'];

        echo "<tr name='$id' class='$currency'><td>$created</td><td id='mark'>$market</td><td id='pos-size'>$size</td>
        <td>$direction</td><td>$entry</td><td>$take</td><td>$stop</td>
        <td id='gross'></td><td id='price'></td>";
      }
    }


?>