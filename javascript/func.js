
document.addEventListener('DOMContentLoaded', () => {
  
    $(document).ready(function(){

       pipArrayValue = new Array();
       metalsArray  = new Array();
       listOfCrypto = new Array("Bitcoin","Ripple","Litecoin","Ethereum");
       cryptoData = new Array();
       marginArray = new Array();
       window.goldSell = 1;
       window.silverSell = 0.3;
       window.BitcoinSell = 1;
       window.RippleSell = 0.02;
       window.LitcoinSell = 1;
       window.EthereumSell = 1;
       
       //apiKey = "ed7cfb56d562197a5a0651f512c1be50";
       //endPoint = "live";

       //initiate pip values for metals and crypto
        pipArrayValue["Gold"]=1;
        pipArrayValue["Silver"]=1;
        pipArrayValue["Bitcoin"]=1;
        pipArrayValue["Ripple"]=1;
        pipArrayValue["Litecoin"]=1;
        pipArrayValue["Ethereum"]=1;

        let url = `https://financialmodelingprep.com/api/v3/forex/`;
        let url2 = `https://data-asg.goldprice.org/dbXRates/USD`;
        let url3 = `https://financialmodelingprep.com/api/v3/cryptocurrencies`;

        let tab = document.querySelector("#all-currencies");
        let pop = document.querySelector("#pop");
        let bul = document.querySelector("#bullion");
        let crypt = document.querySelector("#cryptocurrencies");

          pip("USD",pipArrayValue);

          getCryptoData();
          getAllCurrencies();
          getPositionsRate(pipArrayValue);
          getPopular();
          getBullionData();
          writeBullionToArray();
          
          
        // $("#h3-metals").click(getBullionData);
          

        //write data into array of crypto
        function getCryptoData()
        { 
          getCryptoJson(url3)
          .then(function(data){
           
            let resp = JSON.parse(data).cryptocurrenciesList;
            getDataOfCrypto(resp,listOfCrypto,cryptoData);
            marginArray['Bitcoin'] = cryptoData['Bitcoin'];
           marginArray['Ripple'] = cryptoData['Ripple'];
           marginArray['Litecoin'] = cryptoData['Litecoin'];
          marginArray['Ethereum'] = cryptoData['Ethereum'];
            return cryptoData;
            
          })
          .then(function(data){
            return cryptoHandler(data);
          })
          .then(function(literals){
            crypt.innerHTML = `<tr>
            <th>Pair</th>
            <th>Ask/Buy</th>
            <th>Bid/Sell</th>
            </tr>${literals}`;
          })
          .then(function(){
            setTimeout(getCryptoData,500);
          })
        }
        function cryptoHandler(data)
        {
          var table = "";
          Object.keys(data).map(function(key , val){

            var oldVal = $("."+ key).text();
            var color = $("."+ key).attr('class');
            var ticker = key;
            var ask = (data[key]).toFixed(2);
            const difference = key=="Ripple"?0.02:1;
            var bid = (ask - difference).toFixed(2);

            color = (ask != oldVal)?((ask > oldVal)? "blue":"red"):color;

            table += `<tr><td>${ticker}</td><td class="${color}" id="">${ask}</td>
            <td class="${color}" id="">${bid}</td></tr>`;
           
          })
         return table;
            
        }


          function getPopular()
          {
            getPopularRequest(url)

            .then(function(response){
             // writeCryptoToTable(cryptoData);
              let resp = JSON.parse(response).forexList;
              
              return popularSuccessHander(resp);
            
            }).then(function(literals){
              pop.innerHTML = `<tr>
              <th>Pair</th>
              <th>Ask/Buy</th>
              <th>Bid/Sell</th>
              </tr>${literals}`;
            })
            .then(function(){
              setTimeout(getPopular,500);
            })
          }
          // write gold and silver values in metalsArray
          function writeBullionToArray()
          {
            getBullionJson()
            .then(function(response){
              var json = ((JSON.parse(response)).items)[0];
              var dataArray = new Array;
              var gold;
              var silver;

              for(var item in json)
              {
                if(item == "xauPrice")
                {
                
                 gold = json[item];
                 
                }
                if(item == "xagPrice")
                {
                
                 silver = json[item];
                }
              }

              dataArray['Gold'] = gold;
              dataArray['Silver'] = silver;

              return dataArray
            })
            .then(function(data){

              metalsArray['Gold'] = data['Gold'];
              metalsArray['Silver'] = data['Silver'];
            })
            .then(function(){
              setTimeout(writeBullionToArray,500);
            })
          }
          
        function getAllCurrencies(){
          
          getRequest(url)

          .then(function(responses)
             {
              let resp = JSON.parse(responses).forexList;
                  
                  return resp.map(function(res){
                   return successHandler(res);
                 })
              }).then(function(literals){
                tab.innerHTML = `<tr>
                <th>Pair</th>
                <th>Ask/Buy</th>
                <th>Bid/Sell</th>
              </tr>${literals.join('')}`;
              })
              .then(function(){
               
                  setTimeout(getAllCurrencies,500);
                
              });
        }
          function getPositionsRate(pipArrayValue)
      {
       
        let url = `https://financialmodelingprep.com/api/v3/forex/`;

        getPositionsData(url)
        .then(function(responses){

          let response = JSON.parse(responses).forexList;

          return response;
        }).then(function(responses){
          
          positionsDataHandler(responses,pipArrayValue);
          
         // console.log(arrayExchange);
        }).then(function(){
           setTimeout(getPositionsRate,500,pipArrayValue);
        })
      }
      // this function updates live values in placed/open orders.
      function positionsDataHandler(responses,arr)
      {

        $(".positions  tr:not(:first)").each(function(){
          
          
          var status = $(this).find("td:nth-child(4)").html(); 
          var p = $(this).find("td:nth-child(2)").text();
          var tradingElement = $(this).find("td:nth-child(2)").html();
          var pair = insert($(this).find("td:nth-child(2)").html());
          var $price = $(this).find("td:nth-child(9)");
          var $pip = $(this).find("td:nth-child(8)");
          var $size = $(this).find("td:nth-child(3)").text();
          var getStatus = (status=="BUY")?"bid":"ask";
          var oldVal = $(this).find("td:nth-child(9)").text();
          var oldVal2 = $(this).find("td:nth-child(8)").text();
          var color =$price.attr('class');
          var color2 =$pip.attr('class');
          var entry = $(this).find("td:nth-child(5)").html();
          var size = $size.replace(/,/g,'');
          var value = (status == "BUY")?1:-1;
          var pipvalue = arr[p]*parseInt(size);
         
          if(tradingElement == "Gold" || tradingElement == "Silver")
          {
            if(tradingElement == "Gold")
            {

              var ask = metalsArray[tradingElement].toFixed(2);
              var bid = (ask-goldSell).toFixed(2);
              
              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;

              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;

              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
              
            }
            if(tradingElement == "Silver")
            {

              var ask = metalsArray[tradingElement].toFixed(2);
              var bid = (ask-silverSell).toFixed(2);

              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;

              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;
              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
            }
          }
      
          if(tradingElement == "Bitcoin" || tradingElement == "Ripple" || tradingElement == "Litcoin" || tradingElement == "Ethereum")
          {
            if(tradingElement == "Bitcoin")
            {

              var ask = cryptoData[tradingElement].toFixed(2);
              var bid = (ask-BitcoinSell).toFixed(2);
              
              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;

              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;

              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
              
            }
            if(tradingElement == "Ripple")
            {
              
              var ask = cryptoData[tradingElement].toFixed(2);
              var bid = (ask-RippleSell).toFixed(2);
              
              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;
              
              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;
              
              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
              
            }
            if(tradingElement == "Litcoin")
            {
              
              var ask = cryptoData[tradingElement].toFixed(2);
              var bid = (ask-LitcoinSell).toFixed(2);
              
              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;
              
              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;
              
              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
              
            }
            if(tradingElement == "Ethereum")
            {

              var ask = cryptoData[tradingElement].toFixed(2);
              var bid = (ask-EthereumSell).toFixed(2);
              
              var stat = (getStatus == "ask")?ask:bid;
              color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;

              $price.text(stat);
              var gross = ((stat-entry)*pipvalue).toFixed(2);
              color2 = (gross != oldVal2)?((gross > oldVal2)? "red":"blue"):color2;

              $pip.text(gross);
              changeClassName($price,color);
              changeClassName($pip,color2);
              
            }
           
          }

           responses.map(function(response){
           
            for(i in response)
            {
              
             if(response[i] == pair)
              {
                var ask = getSpecificData(response,"ask");
                var bid = getSpecificData(response,"bid");
                var stat = (getStatus == "ask")?ask:bid;
                color = (stat != oldVal)?((stat > oldVal)? "blue":"red"):color;
                
                
                changeClassName($price,color);
                $price.text(stat);
                var gross = ((stat-entry)*pipvalue).toFixed(2);
                $pip.text(gross);

                color2 = (gross != oldVal2)?((stat > oldVal2)? "red":"blue"):color2;
                changeClassName($pip,color2);
              }
            }

          })
          
        })
      }
      // rates for gold and silver
      function getBullionData()
      {
        getBullion(url2,metalsArray)
        .then(function(response){
          
           return Object.keys(response).map(function(key , val){
            return metalHandler(key , response[key]);
          })
        })
        .then(function(literals){
          bul.innerHTML = `<tr>
              <th>Metal</th>
              <th>Ask/Buy</th>
              <th>Bid/Sell</th>
              </tr>${literals}`;
        })
        .then(function(){
          setTimeout(getBullionData,500);
        })
      }

      })
      });


      //get data according to crypto array
      function getDataOfCrypto(response,arr,arr2)
      {
        arr.map(function(data){
         
          $.each(response,function(key,values){
            
              $.each(values,function(key,value){

                if(value == data)
                {
                  $.each(values,function(k,v){
                    
                    var price;
                    if( k == 'price')
                    {
                      price=v;

                      arr2[value] = price;
                    }
                    
                  })
                }
               
              })
           
          })
        })
      
      }

        // update prices of Gold & Silver
      function metalHandler(key , val)
      {
        var old_goldColor=$(".Gold").attr("id");
        var old_silverColor=$(".Silver").attr("id");

        let gold_old_buy=parseFloat($(".Gold").text());
        let silver_old_buy=parseFloat($(".Silver").text());
        
        let buy = val.toFixed(2);
        
        let sell = (val -goldSell).toFixed(2);
        let sell2 = (val - silverSell).toFixed(2);
        let color = "red";
        let ticker = key;
        
        let sellVal=ticker=="Gold"?sell:sell2;
        if(gold_old_buy < buy)
        {
          color = "blue";
         
        }
        if(gold_old_buy > buy)
        {
          color = "red";
        }
        if(gold_old_buy == buy)
        {
          color = old_goldColor;
        }


        if(ticker=="Silver")
        {
          if(silver_old_buy < buy)
          {
            color = "blue";
           
          }
          if(silver_old_buy > buy)
          {
            color = "red";
          }
          if(silver_old_buy == buy)
          {
            color = old_silverColor;
          }
        }
       
        const Table = `
        <tr><td>${ticker}</td><td class="${ticker}" id="${color}">${buy}</td><td id="${color}">${sellVal}</td></tr>`;
        
        //debugger;
        return Table;
      }


      function getPositionsRate(arrayExchange)
      {
       
        let url = `https://financialmodelingprep.com/api/v3/forex/`;

        getPositionsData(url)
        .then(function(responses){

          let response = JSON.parse(responses).forexList;

          return response;
        }).then(function(responses){
          
          positionsDataHandler(responses,arrayExchange);
         // console.log(arrayExchange);
        }).then(function(){
          setTimeout(getPositionsRate,200);
        })
      }


      // html element change class name
      function changeClassName(element , className)
      {
        $(element).removeClass();
        $(element).addClass(className);
      }
      
      // get ask or bid from array data
      function getSpecificData(data,spec)
      {
        for(i in data)
      {
        
            if(i == spec)
            {
                
                return data[i];
            }

            
      }
      
      }


//calculate Pip (get Data from getPipData and then create buy array to make pip data)
 function pip(accountCurrency,arr)
 {

    let url = `https://financialmodelingprep.com/api/v3/forex/`;

    getPipData(url)
    .then(function(responses){
      let response = JSON.parse(responses).forexList;
      return response;
    }).then(function(response){
      let buy = new Array();

      response.map(function(resp){
        //buy array...

        getPipArray(resp,buy)

      })
      return buy;
    }).then(function(buy){

      // calculate pip from trading currency, buy array and pushing data back to arr(array of pip)
      calculatePip(accountCurrency,buy,arr);
      calculateMargin(accountCurrency,buy,marginArray);
     
    })
 }
// create calculatepip from trading currency, buy array and pushing data back to arr(array of pip)
 function calculatePip(trade,buyArray,pipArray){

 for(index in buyArray)
 {
  let first_currency = index.substring(0,3);
  let second_currency = index.substring(3,6);

  if(second_currency == trade)
  {
    pipArray[index] = 1;
  }
  if(first_currency == trade)
  {
    pipArray[index] = (1/(buyArray[index])).toFixed(2);
  }
 
 
  if(trade!=first_currency && trade!=second_currency){

    let direct = trade + second_currency;
    let indirect = second_currency + trade;
    
    for(index2 in buyArray)
    {
      if(index2 == direct){
          
       
        pipArray[index]=((1/buyArray[index2])).toFixed(2);
             
          
      }
      if(index2 == indirect)
      {

        pipArray[index]=(0.01/((0.1/buyArray[index2]))).toFixed(2);
          
      }
    }
  } 
}

 }
//calculate margin
 function calculateMargin(trade,buyArray,marginArray){

// trade is USD
// buyArray is Array with pair values
// marginArray is array saving margin values

        

       marginArray['Gold'] = metalsArray['Gold'];
       marginArray['Silver'] = metalsArray['Silver'];
       
// checking margin for each array in buyArray
  for(index in buyArray)
  {
   let first_currency = index.substring(0,3);
   let second_currency = index.substring(3,6);
 
   
    //console.log(index);
   // if first currency is USD, 1 USD = 1 USD
   if(first_currency == trade)
   {
    marginArray[index] = 1;
    
   }

   //if second curreny is USD, just display trading value
   if(second_currency == trade)
   {
     
    marginArray[index] = parseFloat(buyArray[index]).toFixed(2);
     
   }
  
  
   if(trade!=first_currency && trade!=second_currency){
 
     
     let direct = first_currency + trade; //EURGBP = EURUSD
     let indirect = trade + first_currency;
     
     for(index2 in buyArray)
     {
       
       //in  EURGBP, EURUSD is direct// direct
       if(index2 == direct){
           
        
        marginArray[index]=parseFloat(buyArray[index2]).toFixed(2);
              
        
       }

       //in  CADCHF, CADUSD is indirect// indirect

       if(index2 == indirect)
       {
 
         marginArray[index]=(1/parseFloat(buyArray[index2])).toFixed(2);
           
       }
     }
   } 
 }
 
  }
//create array of different pairs buy rate..
 function getPipArray(response,arr)
 {
     
  let ticker;
  let ask;
  

   const dataObj = response;
 
  for(i in dataObj)

  {
    
        if(i == "ask")
        {
            
          ask = dataObj[i];
        }

        if(i == "ticker")
        {
          ticker = dataObj[i].replace("/","");
        }
        
  }
      arr[ticker]=ask;
      

 }

 // trading window open/close updating currencies and getting live data from site...
 $(document).ready(function(){

    var interval;
    var interval2;

    $(".close").click(function(){

        $(".trade-window").css("display","none");
        $("#size-margin").val(0.00);
        $(".margin-required").text(0.00);
        clearInterval(interval);
        clearInterval(interval2);

       //document.location.reload(true);

    })
    
    $('.popular-forex table , #all-currencies, #bullion, #cryptocurrencies').on('click',"tbody tr", function(){

      $("#size-margin").val(0.00);
      $(".margin-required").text(0.00);

      if(($(".market-status").text())=="open")
    {
      
      let pair = $(this).find("td:first").text();
      let buy = $(this).find("td:nth-child(2)").text();
      let sell = $(this).find("td:nth-child(3)").text();

      $(".volume-margin").attr("step",1000);
      $(".volume-margin").attr("min",1000);

      $("#sells").text(sell);
      $("#buys").text(buy);

        $(".trade-window").css("display","block");
        
        

        $(".currency").text(pair);

        clearInterval(interval);
        clearInterval(interval2);

       

        if(pair == "Gold" || pair == "Silver")
        {
          interval2 = setInterval(function(){
            $(".volume-margin").attr("step",1 );
            $(".volume-margin").attr("min",1 );
            var buyGold  = (parseFloat(metalsArray['Gold'])).toFixed(2);
          var buySilver  = (parseFloat(metalsArray['Silver'])).toFixed(2);

          var sellGold = (parseFloat(buyGold-1)).toFixed(2);
          var sellSilver = (parseFloat(buySilver-0.3)).toFixed(2);

          if(pair == "Gold")
          {
            $("#sells").text(sellGold);
            $("#buys").text(buyGold);
          }
          if(pair == "Silver")
          {
            $("#sells").text(sellSilver);
            $("#buys").text(buySilver);
          }

          },500)
          
        }
        
        if(pair == "Bitcoin" || pair == "Ripple" || pair == "Litecoin" || pair == "Ethereum")
        {

          interval2 = setInterval(function(){
            $(".volume-margin").attr("step",1 );
            $(".volume-margin").attr("min",1 );
            var buyBitcoin  = (parseFloat(cryptoData['Bitcoin'])).toFixed(2);
          var buyRipple  = (parseFloat(cryptoData['Ripple'])).toFixed(2);
          var buyLitcoin  = (parseFloat(cryptoData['Litcoin'])).toFixed(2);
          var buyEthereum  = (parseFloat(cryptoData['Etherum'])).toFixed(2);

          var sellBitcoin = (parseFloat(buyBitcoin-1)).toFixed(2);
          var sellRipple = (parseFloat(buyRipple-0.02)).toFixed(2);
          var sellLitcoin = (parseFloat(buyLitcoin-1)).toFixed(2);
          var sellEthereum = (parseFloat(buyEthereum-1)).toFixed(2);
          

          if(pair == "Bitcoin")
          {
            $("#sells").text(sellBitcoin);
            $("#buys").text(buyBitcoin);
          }
          if(pair == "Ripple")
          {
            $("#sells").text(sellRipple);
            $("#buys").text(buyRipple);
          }
          if(pair == "Litcoin")
          {
            $("#sells").text(sellLitcoin);
            $("#buys").text(buyLitcoin);
          }
          if(pair == "Ethereum")
          {
            $("#sells").text(sellEthereum);
            $("#buys").text(buyEthereum);
          }
          

          },500)
          
        }
        interval =  setInterval(function(){
          
            tradePair(pair).then(function(response){
              for (i in response)
              {
                  if(i == "bid")
                  {
                  $("#sells").text(response[i]);
                  }
                  if(i == "ask")
                  {
                  $("#buys").text(response[i]);
                  }
                  if(i == "low")
                  {
                  $(".low").text(response[i]);
                  }
                  if(i == "high")
                  {
                  $(".high").text(response[i]);
                  }
              }
              
             });
         
      },500)

    }
    else
    {
      popup("market closed");
    }

    })

  })
  

//get data and process of specific currency
  function trade(pair)
  {
    
    return new Promise(function(resolve,reject){

      let url = `https://financialmodelingprep.com/api/v3/forex/${pair}`;

      getRequest(url).then(function(response){

        let dataObj = JSON.parse(response);
      
         resolve(dataObj);

      })

    })
   
  }


// // success handler to write all currency pair in table
  function successHandler(response)
  {

      
      let ticker;
      let bid;
      let ask;
      
  
       const dataObj = response;
     
      for(i in dataObj)
      {
        
            if(i == "ask")
            {
                
                ask = dataObj[i];
            }

            if(i == "bid")
            {
                bid = dataObj[i];
            }

            if(i == "ticker")
            {
                    ticker = dataObj[i].replace("/","");
            }
            
      }
      
      let $oldask = $(`.${ticker}`).text();
      let askcolor=$(`.${ticker}`).attr('id');

      let $oldbuy = $(`.${ticker}`).next('td').text();
      let buycolor=$(`.${ticker}`).next('td').attr('id');
      
      if($oldask > ask){
        askcolor = "red";
      }
      if($oldask < ask){
        askcolor = "blue";
      }

      if($oldbuy > bid){
        buycolor = "red";
      }
      if($oldbuy < bid){
        buycolor = "blue";
      }
     

      
      const Table = `
      <tr><td>${ticker}</td><td class="${ticker}" id="${askcolor}">${ask}</td><td id="${buycolor}">${bid}</td></tr>`;
  
      return Table;
  
  }

// success handler for popular
function popularSuccessHander(response)
{
  let ticker;
  let bid;
  let ask;
  let table ='';

  let pairs=["EUR/USD","USD/JPY","GBP/USD","EUR/GBP","USD/CHF","USD/CAD","AUD/USD"];

  const dataObj = response;
  $.each(dataObj,function(item,keys){

    $.each(keys, function(item,key){
    
      pairs.map(pair=>
      {
        if(pair == key)
        {
          for(i in keys)
          {
            if(i == "ask")
              {
               ask = keys[i];
              }
            if(i == "bid")
              {
                bid = keys[i];
              }
            if(i == "ticker")
              {
                ticker = keys[i].replace("/","");
              }
          }
          let old_askValue = $(`.popular-${ticker}`).text();
          let old_buyValue = $(`.popular-${ticker}`).next('td').text();

          let askcolor=$(`.popular-${ticker}`).attr('id');
          let buycolor=$(`.popular-${ticker}`).next('td').attr('id');

          askcolor=ask>old_askValue?"blue":ask<old_askValue?"red":askcolor;
          buycolor=bid>old_buyValue?"blue":bid<old_buyValue?"red":buycolor;

          table += `<tr><td>${ticker}</td><td class="popular-${ticker}" id="${askcolor}">${ask}</td><td id="${buycolor}">${bid}</td></tr>`;
        }
      })
    })
  })
  return table;
}
  //getting trade pair from all currencies 
  function tradePair(pairs)
  {

    let pair =insert(pairs);

    let url = `https://financialmodelingprep.com/api/v3/forex/`

    return new Promise(function(resolve,reject){
    
      getOrderData(url)
      .then(function(responses){

        let response = JSON.parse(responses).forexList;

        return response.map(function(resp){
          return resp;
        })
        

      }).then(function(datas){

       
          datas.map(function(data){
            
            
           $.each(data,function(key , val)
           {
            if(val == pair)
            {
              resolve(data);
            }

           })
            
          })
        
      })

    })
  }

// insert into string
  function insert(str) {
    let index = 3;
    return str.substr(0, index) + '/' + str.substr(index);
}
//calculate margin required

function calculateMarginRequired(pair,size,leverage)
{
  var margin = marginArray[pair];
  var volume = size;
  var lev = leverage;
  var requiredMargin = 0.00;
  //Required Margin = Trade Size / Leverage * Account Currency Exchange Rate
  if(size > 0)  requiredMargin = (volume * margin)/lev;

  return requiredMargin;

}
function cryptoTable()
{

}




