$(document).ready(function(){
    var URL = "https://financialmodelingprep.com/api/v3/forex?json";

    $.ajax({
        url:URL,
        type:"GET",
        crossDomain:true,
        success:function(response)
        {   
           
            var resp = response.forexList;

            var $table = $("<table  class='table'></table>");

            for(var i = 0 ; i < 4 ; i++)
            {
                var financial = resp[i];
                let $line = $("<tr></tr>");
                let $lineHader = $("<tr></tr>");
                let $head = $('<thead></thead>');

                for(var key in financial)
                {
                    if(i===0 && financial.hasOwnProperty(key)){
                        $lineHader.append($("<th></th>").html(key));
                       
                    }

                }
                $head.append($lineHader);
                $table.append($head);
                for(var key2 in financial)
                {
                    if(financial.hasOwnProperty(key)){
                        $line.append($("<td></td>").html(financial[key2]));
                        
                    }

                }

                $table.append($line);
                
            }
            $(".popular-table").append($table);
        },
        error:function(xhr , status)
        {
            alert('error');
        }

    });

});

$(document).ready(function(){
    var URL = "https://financialmodelingprep.com/api/v3/forex?json";
    $.ajax({
        url:URL,
        type:"GET",
        crossDomain:true,
        success:function(response)
        {
            var financial = response.forexList;
            $.each(financial,function(key , val){

                $(".timeline p").append("<span class='currency'>" + val.ticker +" " + "</span>" + "<span class='rate'>" + val.ask + "/" + val.bid + "</span>");   
          
            })
        },
        error:function(xhr, status)
        {
           alert('error');
        }
    } )
});

$(document).ready(function(){

$(".dropdown").click(function(){

 $("#hamburger-menu-list").toggle();
})

})


$(document).ready(function(){
window.addEventListener('mouseup',function(event){
var box = document.getElementById('hamburger-menu-list');
var drop =   document.getElementById('dropdown');
if(event.target != drop){
    if(event.target != box && event.target.parentNode != box)
    {
        box.style.display='none';
        
    }
}
})
})


    


/*.getJSON("https://financialmodelingprep.com/api/v3/forex?jason", function(data){

    
    
    $.each(data,function(key , val){
       
           val.forEach(element => {
            $(".timeline p").append("<span class='currency'>" + element.ticker +" " + "</span>" + "<span class='rate'>" + element.ask + "/" + element.bid + "</span>");   
           });
            
      
    })*/
       
    




/*$(document).ready(function(){
    $.getJSON("https://financialmodelingprep.com/api/v3/forex/EURUSD",function(data){
        
        $.each(data,function(key,value){
            if(key=="ticker")
            {
                $(".popular-table table").append("<tr class='current'>" + "<td>" + value + "</td>" + "</tr>");
            }
            if(key == "bid")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "ask")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "open")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "low")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
                $(".popular-table table tr").removeClass("current");           }

        })  
    })
})
$(document).ready(function(){
    $.getJSON("https://financialmodelingprep.com/api/v3/forex/USDJPY",function(data){
       
        $.each(data,function(key,value){
            if(key=="ticker")
            {
                $(".popular-table table").append("<tr class='current'>" + "<td>" + value + "</td>" + "</tr>");
            }
            if(key == "bid")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "ask")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "open")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "low")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
                $(".popular-table table tr").removeClass("current");
            }

        })  
    })
})
$(document).ready(function(){
    $.getJSON("https://financialmodelingprep.com/api/v3/forex/GBPUSD",function(data){
       
        $.each(data,function(key,value){
            if(key=="ticker")
            {
                $(".popular-table table").append("<tr class='current'>" + "<td>" + value + "</td>" + "</tr>");
            }
            if(key == "bid")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "ask")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "open")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "low")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
                $(".popular-table table tr").removeClass("current");
            }

        })  
    })
})
$(document).ready(function(){
    $.getJSON("https://financialmodelingprep.com/api/v3/forex/AUDUSD",function(data){
       
        $.each(data,function(key,value){
            if(key=="ticker")
            {
                $(".popular-table table").append("<tr class='current'>" + "<td>" + value + "</td>" + "</tr>");
            }
            if(key == "bid")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "ask")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "open")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
            }
            if(key == "low")
            {
                $(".popular-table table tr.current").append("<td>" + value + "</td>");
                $(".popular-table table tr").removeClass("current");
            }

        })  
    })
})*/