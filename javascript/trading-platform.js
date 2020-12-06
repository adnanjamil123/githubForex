// toggle between order menus(position,order ...)
  $(document).ready(function(){
    $(".order-menu ul li").on('click',function(){
      if($(this).hasClass("om-unselected")){
        var menus = "position, .invoice";
        var selected = $(this).attr("id");
        //first toggle active and inactive class b/w order menus
        $(`.${menus}`).removeClass('active inactive');
        $(`.${menus}`).addClass('inactive');
        $(`.${selected}`).removeClass('inactive');
        $(`.${selected}`).addClass('active');
        //second toggle om-selected and om-unselected class b/w main menu(order invoice history transaction)
        $(".order-menu ul li").removeClass('om-selected om-unselected'); 
        $(".order-menu ul li").addClass('om-unselected'); 
        $(this).removeClass("om-unselected");
        $(this).addClass("om-selected");
      }
    })
})

  $(document).ready(function(){
     
      $(".buy-sell ul li").on('click',function(){

        if($(this).hasClass("unfocus"))
        {
        $(".buy-sell ul li").toggleClass('unfocus focus'); 

        if($("#buy").hasClass("focus"))
        {
            $(".title .status").text("BUY");
        }
        else
        {
            $(".title .status").text("SELL");
        }
      }
    })
  })

  // dropdown toggle forex, popular, crypto
$(document).ready(function(){

  $("h3").on('click', function(){
    
    

    $(this).next().attr('id',function(){
      $(this).toggle();
     
    })
   
    $(this).find('i').delay(1000).toggleClass("fi-swsuxm-plus-solid fi-swsuxm-minus-solid");
    friconix_update();

  })

  
})

$(function(){
 isMarketOpen() ;
})
//popup
function popup(msg)
{
  
  //$(".popup").css("display", "block");
  $(".popup").show(1000);

  document.getElementById("msg").innerHTML=msg.trim();

  //setTimeout(function(){$(".popup").css("display", "none");},5000);
  setTimeout(function(){$(".popup").hide(1000);},5000);

}

function internetConnected()
{
  var connected = window.navigator.onLine;
 
  if(connected)
  {
    return true;
  }
  else
  {
    alert("No internet Connection");
  }
}

function isMarketOpen()
{
  $.getJSON('https://financialmodelingprep.com/api/v3/is-the-market-open').done(function(data)
  {
    var status = data['isTheStockMarketOpen'];
    day = getDays();
    if(status == true)
    {
      $(".market-status").text("open");
      return;
    }
    if(status == false && (day == 0||day == 6))
    {
      $(".market-status").text("closed");
      return;
    }
    if(status == false && !(day == 0||day == 6))
    {
      $(".market-status").text("open");
      return;
    }

  })
  .fail(function(){
    $(".market-status").text("connection failed!");
  })
}

function getDays()
{
  
  var date = new Date();
  var day = date.getDay();

  return day;

}

function calculateEquity()
{
  var netPL;
  var balance;
  var bonus;

  var equity = 0.00;

  //get netPL
  netPL=$(".net").text();
  //get balance
  balance=$(".infobar-balance").text();
  //bonus
  bonus= $(".bonus-amount").text();
  //write in DOM
  equity = parseFloat(balance) + parseFloat(netPL) + parseFloat(bonus);

  return equity.toFixed(2);
}



