<?php
require_once ('db.php');
require_once ('config.php');
require_once ('query_functions.php');
require_once ('functions.php');


//$db = db_connect();

$mysqli = new MySQLi('localhost','root','','forextrading');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script defer src="https://friconix.com/cdn/friconix.js"></script>
  <link rel="stylesheet" href="/forex/css/trading-platform.css">
  <script src="/forex/javascript/jquery.js"></script>
  <script src="/forex/javascript/trading-platform.js"></script>
  <script src="/forex/javascript/ajax.js"></script>
  <script src="/forex/javascript/func.js"></script>
 
  <script>
 $(window).on('load',(function() {
    $('#loading').hide();
  }));

  </script>

  <script>
  
  </script>
</head>
<body>

<div id="loading">
  <img id="loading-image" src="/forex/images/spinner.gif" alt="Loading..." />
</div>

  <div class="container"><!--container-->
  <div class="top"><!--starting-top -->
  <img class="logo" src="/forex/images/logo.jpeg" alt="logo" width="60px" height="50px">
   <h1 >ON|FINANCIAL MARKETS</h1>
   
   <select name="account-info" class="dropdown">
     <?php echo fill_accounts_dropdown();  ?>

</select>
<select class="email">
<?php
 echo "<option value='email'>$EMAIL</option>" ;
 echo "<option value='sign-out'>Sign Out</option>" ;
 ?>
</select>
  </div><!--ending-top -->
  <div class="center"><!--forex and chart-->
<div class="table-all"><!--ALL-->
    <div class="popular-forex"><!--popular-forex -->
   <h3 class="tog-up">POPULAR <i id="popu" class="fi  fi-swsuxm-plus-solid"></i>
</h3>
    <table id ="pop" class="pop">

</table> 
    </div><!--ending popular-forex -->

  <div class= "forex">
     <!--written in javascript code // file func.js-->
     <h3 class="tog-down">FOREX <i id="foru" class="fi fi-swsuxm-plus-solid"></i>
  </h3>
     <table id="all-currencies" class="forex">
     
     </table>
  </div>

  <div class= "crypto">
     <!--written in javascript code // file func.js-->
     <h3 class="tog-down">CYRPTOCURRENCIES <i id="crypt" class="fi fi-swsuxm-plus-solid"></i>
  </h3>
     <table id="cryptocurrencies" class="crypto">
     
     </table>
  </div>

  <div class= "metals">
     <!--written in javascript code // file func.js-->
     <h3 class="tog-down" id="h3-metals">METALS <i id="metals" class="fi fi-swsuxm-plus-solid"></i>
  </h3>
     <table id="bullion" class="bullion">
     
     </table>
  </div>

</div><!--ending-ALL-->

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_0af70"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/FX-EURUSD/" rel="noopener" target="_blank"><span class="blue-text">EURUSD Chart</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": 1100,
  "height": 400,
  "symbol": "FX:EURGBP",
  "interval": "1",
  "timezone": "Etc/UTC",
  "theme": "Light",
  "style": "0",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "container_id": "tradingview_0af70"
}
  );
  </script>
</div><!-- ENDING TradingView Widget END -->
</div><!--ENDING forex and chart-->

<div class="order">

  <div class="order-menu">
    <ul>
        <li class= "om-selected" id="position">Positions</li>
        <li class= "om-unselected" id="invoice">Orders</li>
        <li class= "om-unselected" id="history">History</li>
        <li class= "om-unselected" id="transaction">Transactions</li>
    </ul>
  </div> <!--closing order-menu-->
  
      <div class="position active">

        <div class="position-menu">
          <ul>
            <li>New Order</li>
            <li class="close-order">Close</li>
          </ul>
        </div><!--ending position menu-->

        <div class="order-table">
          <table class="positions">
            <?php
                  echo update_position_Start();
            ?>
          
          </table>
        </div><!--order-table-->


      </div><!--ending position-->

      <div class="invoice inactive">
        <div class="period" style="height:30px; background:#f5f5f5">
        <span style="margin-left:100px">Period</span>
            <select id="period" name="select-period" style="margin-left:10px"> 
                <option value="0 Day">Today</option>
                <option value="3 Day">Last 3 Days</option>
                <option value="1 Week">Current Week</option>
                <option value="1 Month">Current Month</option>
                <option value="2 Month">Last 2 Months</option>
                <option value="1 Year">Current Year</option>
            </select>
        </div>
        <div id="closed-orders">
              <table class="orders">
            <?php
             echo load_invoices_atstart();
            ?>
         
          </table>
          </div>
      </div><!--ending invoice-->

</div> <!--ending order-->

<div class="account-info">
  <ul>
    <li>
      Balance<br><hr><span class="infobar-balance"> <?php echo fill_account_balance();?> </span>
    </li>
    <li>
      Equity<br><hr><span class="equity">0.0</span>
    </li>
    <li>
      Margin<br><hr><span class="margin">0.0</span>
    </li>
    <li>
      Free Margin<br><hr><span class="free-margin">0.0</span>
    </li>
    <li>
      Margin Level<br><hr><span class="margin-level">0.0</span>
    </li>
    <li>
      Smart Stop Out<br><hr><span>0.0</span>
    </li>
    <li>
      Gross P&L<br><hr><span class="gross">0.0</span>
    </li>
    <li>
    Net P&L<br><hr><span class="net">0.0</span>
    </li>
  </ul>
</div><!--ending-account-info-->


<!--Trading window -->
<div class="trade-window" style="display:none">

  <div class="title">
    <p><span class="currency">currency</span>--<span class="status">SELL</span></P>
    <a href="#" class="close">close</a>
  </div>

  

  <div class="buy-sell">
    <ul>
      <li class="focus" id="sell"><a href="#" style="color:red" >SELL</a><br><span id="sells">price</span></li>
      <li class="unfocus" id="buy"><a href="#" style="color:blue" >BUY</a><br><span id="buys">price</span></li>
    </ul>
  </div>

  <div class="spread-high-low">
    <p><span class="spread"></span> high: <span class="high"></span> low: <span class="low"></span></p>
  </div><!--Margin and size elements-->

    <div class="auto-stop">
    <div class="stop-loss">
    <label for="stop-loss">Stop loss</label>
    <div class="stop-loss-div">
    <input class= "input-checkbox" type="checkbox"  id="stop-loss-id" name = "stop-loss">
    <input class= "stop-loss-input" type="number" disabled step=.0001 id="stop-loss" name = "stop-loss">
    </div>
    </div>

    <div class="take-profit">
    <label for="take-profit">Take Profit</label>
    <div class="take-profit-div">
    <input class= "input-checkbox" type="checkbox"  id="take-profit-id" name = "take-profit">
    <input class= "take-profit-input" type="number" disabled id="take-profit" name = "take-profit">
    </div>
    </div>
    </div>

    <div class="size-margin">
    <label for="size-margin">size:</label>
    <input value="" class= "volume-margin" type="number" min ="1000" step ="1000"  id="size-margin" name = "size-margin">
    <span class="free-margin text"></span>
    <br><span class="">Margin Required: </span><span class="margin-required text">0.00</span>
    </div><!--Ending Margin and size elements-->
    
    <!--Place order elements-->
  <div class="place-order">
    <p class="warning-bar"></p>

    <ul>
      <li>Place an order</li>
    </ul>
  </div><!--Ending Place order elements-->

</div><!--ending trade-window-->

<div class="popup">
 <div class="bar"> <img  src="/forex/images/logo.jpeg" alt="bar" width="60px" height="50px"></div>
 <div class="msg"><span  id="msg"></span></div>
</div><!--ending popup-->

<div class="market-info noselect">
<div class="market-p"><span>Market: </span><span class="market-status"></span></div>
<div class="bonus" ><span>Bonus: </span><span class="bonus-amount"><?php echo get_first_bonus() ?></span></div>
<div class="info-leverage" ><span>Leverage: </span><span class="leverage-amount"></span></div>
</div><!--ending market-info-->


</div><!--container-->

<script>

// place order 
$(document).ready(function(){

$(".place-order").click(function(){

var sell = $("#sells").text();
var buy = $("#buys").text();
var size = $("#size-margin").val();
var status = $(".status").text();
var currency  = $(".currency").text();
var entry = status=="SELL"?sell:buy;
var id =   $(".dropdown option:selected").attr('value');
var marginRequired = parseFloat($(".margin-required").text());
var freeMargin = parseFloat($(".free-margin").text());
var stopLoss = parseFloat($("#stop-loss").val());
var takeProfit = parseFloat($("#take-profit").val());

if(marginRequired > freeMargin)
{
  return;
}
if(size <= 0 )
{
  $(".warning-bar").text("Volume should not be 0 or less.");
  return;
}
$(".trade-window").css("display","none");

$(".positions").load("/forex/insert.php",{
  market:currency,
  direction:status,
  entryAmount:entry,
  size:size,
  id:id,
  stopLoss:stopLoss,
  takeProfit:takeProfit

})
popup("Order placed successfully.");
})
})

//update orders and invoices on change of dropdown
$(document).ready(function()
{

$(".dropdown").change(function(){

var account_id = $(this).val();

$(".positions").load("/forex/load_data.php",{
  id: account_id
});

$(".orders").load("/forex/load_data.php",{
  aid: account_id,
  invoice:"invoiced"
});

})

})

$(document).ready(function(){
  
 
  setInterval(() => {

    let aggregateMargin = 0.00;
    //inserting balance in infobar
  var commission= 0.00;
  var balance =   $(".dropdown option:selected").attr('name');
  var bonus =   $(".dropdown option:selected").attr('data-bonus');
  var leverage =   $(".dropdown option:selected").attr('data-leverage');

   $(".infobar-balance").text(balance.replace(',' , ''));
   $(".bonus-amount").text(bonus);


   var gross = 0.00;
    var exp;
    var net;

   $(".positions  tr:not(:first)").each(function(){

   var val = $(this).find("#gross").text();
   var margin = marginArray[$(this).find("#mark").text()];
   var size = parseInt(($(this).find("#pos-size").text()).replace(',' , ''));
   gross = gross + parseFloat(val);
   aggregateMargin += (size/leverage)*margin;


  })
    exp= (Math.abs(gross)*10)/100;
    net= gross-exp;
  $(".leverage-amount").text(leverage);
   $(".gross").text(gross.toFixed(2));
   $(".net").text(net.toFixed(2));
   $(".equity").text(calculateEquity());
   $(".margin").text(aggregateMargin.toFixed(2));
    $(".free-margin").text((calculateEquity()-aggregateMargin.toFixed(2)).toFixed(2));
    $(".margin-level").text((((calculateEquity()-commission)/(aggregateMargin==0?"n/a":aggregateMargin))*100).toFixed(2) + "%");
    }, 500);
 

})

// add or selected and unselected id in positions table
$(document).ready(function(){
 $(".positions").on('click','tr',function()
 {
    if($(this).attr('class')!='header')
    {
      if($(this).attr('id')!= 'selected')
      {
        $(".positions tr").attr('id','unselected');
        $(this).attr('id','selected');
      }
    }
 })
})
// update margin required
$(function(){
$(".volume-margin").on("change", function(){
  var size = $("#size-margin").val();
  var pair = $(".currency").text();
  var leverage = $(".dropdown option:selected").attr('data-leverage');
  var marginRequired = calculateMarginRequired(pair,size,leverage);
  var freeMargin = parseFloat($(".free-margin").text());
  if(size != 0 )
  {
    $(".warning-bar").text("");
  }

  if(marginRequired > freeMargin )
  {
    $(".warning-bar").text("Margin required should not exceed free margin.");
  }

  if(marginRequired < freeMargin )
  {
    $(".warning-bar").text("");
  }
  $(".margin-required").text(marginRequired.toFixed(2));
})

$(".input-checkbox").change(function(){

  var stat = $(this).prop("checked");
  var inputBox = $(this).first().next().attr('class');
  
  if(stat)
  {
    $("." + inputBox).prop('disabled', false);
    $("." + inputBox).val($("#buys").text());
    
  }
  if(!stat)
  {
    $("." + inputBox).prop('disabled', true);
    $("." + inputBox).val(0);
   
  }
})

})

</script>

<?php include "afterLoad.php";?>


</body>
</html>
<?php db_close($db);?>