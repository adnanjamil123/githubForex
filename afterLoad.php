<script>
$(document).ready(function()
{
   
    $(".close-order").click(function(){

        if(($(".market-status").text())=="open")
    {

        if ( $( "#selected" ).length )
         {
    
                 var accountId =   $(".dropdown option:selected").attr('value');
                var positionID = $("#selected").attr('name');
                var closingPrice = parseFloat($("#selected #price").text());
                var gross = parseFloat($("#selected #gross").text());
                var expenses = 0.0
                var net = gross-expenses;
               // alert(gross);
                
                $.post('close-order.php',{

                    positionID: positionID,

                },
                function(status)
                {
                    if(status == 'invoice')
                    {
                        alert("order already closed.");
                        return;
                    }

                    if(status == 'open')
                    {
                        $.post('close-order.php',{
                            
                            accountId: accountId,
                            positionID: positionID,
                            closingPrice: closingPrice,
                            gross: gross,
                            expenses: expenses,
                            net: net,
                            status:"invoice"
                            },
                            function(data)
                            {
                                if(data)
                                {
                                    
                                    
                                    //update balance
                                    $(".dropdown").load("/forex/close-order.php",{
                                    aId: accountId
                                    });
                                     //update open orders
                                    $(".positions").load("/forex/close-order.php",{
                                    id: accountId
                                    });
                                    //update invoices
                                    $(".orders").load("/forex/close-order.php",{
                                    did: accountId
                                    });
                                    popup("Order closed successfully.");
                                }
                                else
                                {
                                    alert("Order not closed.");
                                }
                            }
                            );
                         
                    }      
                  
                })
            }
    }
    else{
        popup("Market closed.");
    }
        
          
    })
});

$(document).ready(function(){

    $("#period").change(function(){

var string = $(this).val();
var substring =string.split(" ");
var interval =substring[0];
var period =substring[1];

var accountId =   $(".dropdown option:selected").attr('value');

//$(".orders").html("");

$(".orders").load("/forex/load_data.php",{
  id: accountId,
  period:period,
  interval:interval
});


})

});
</script>
