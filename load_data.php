<?php
require_once ('config.php');
require_once ('functions.php');
require_once ('db.php');
   
if(isset($_POST['aid']) && isset($_POST['invoice']) )
{
 $id = $_POST['aid'];
 echo load_invoices($id);
}

if(isset($_POST['id']) && isset($_POST['period'])  && isset($_POST['interval']))
{
 $id = $_POST['id'];
 $period = $_POST['period'];
 $interval = $_POST['interval'];

 echo load_invoices_period($id,$interval,$period);
}

if(isset($_POST['id']) && empty($_POST['period']))
{
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
  
          $id = $_POST['id'];

          $sql = "SELECT * FROM positions 
          WHERE account = $id AND status = 'open'";

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

    load_invoices($ID);
}


 ?>