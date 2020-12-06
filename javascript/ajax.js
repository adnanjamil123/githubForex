function getPositionsData(url) {

  return new Promise(function(resolve,reject){


        req2 = new XMLHttpRequest();
        req2.open("GET", url, true);
      if (!req2) return false;

      if (typeof success != 'function') success = function() {};

      req2.onreadystatechange = function() {

        if (req2.readyState == 4) {
          if (req2.status === 200) {
            resolve(req2.responseText)
          }else{
              reject(Error(req2.status));
          }
        }
      }


      req2.send(null);

  })
}

function getRequest(url) {

  return new Promise(function(resolve,reject){

        req = new XMLHttpRequest();
        req.open("GET", url, true);



      if (!req) return false;

      if (typeof success != 'function') success = function() {};

      req.onreadystatechange = function() {


        if (req.readyState == 4) {
          if (req.status === 200) {
            resolve(req.responseText)
          }else{
              reject(Error(req.status));
          }
        }
      }


      req.send(null);

  })
}

function getPipData(url) {
  return new Promise(function(resolve,reject){


        req3 = new XMLHttpRequest();
        req3.open("GET", url, true);
      if (!req3) return false;

      if (typeof success != 'function') success = function() {};

      req3.onreadystatechange = function() {

        if (req3.readyState == 4) {
          if (req3.status === 200) {
            resolve(req3.responseText)
          }else{
              reject(Error(req3.status));
          }
        }
      }


      req3.send(null);

  })
}


function getOrderData(url) {
  return new Promise(function(resolve,reject){


        req4 = new XMLHttpRequest();
        req4.open("GET", url, true);
      if (!req4) return false;

      if (typeof success != 'function') success = function() {};

      req4.onreadystatechange = function() {

        if (req4.readyState == 4) {
          if (req4.status === 200) {
            resolve(req4.responseText)
          }else{
              reject(Error(req4.status));
          }
        }
      }


      req4.send(null);

  })
}

function getPopularRequest(url) {


  return new Promise(function(resolve,reject){

        req5 = new XMLHttpRequest();
        req5.open("GET", url, true);



      if (!req5) return false;

      if (typeof success != 'function') success = function() {};

      req5.onreadystatechange = function() {


        if (req5.readyState == 4) {
          if (req5.status === 200) {
            resolve(req5.responseText)
          }else{
              reject(Error(req5.status));
          }
        }
      }


      req5.send(null);

  })
}

function getBullion(url2) {
  return new Promise(function(resolve,reject){

    var metals = new Array();

  $.ajax({
    url: url2,
    crossDomain:true,
    success: function(json){

     var response = json.items;

      response.forEach(function(key){

        metals['Gold'] = key['xauPrice'];
        metals['Silver'] = key['xagPrice'];

      })

      resolve(metals);
    }

  })
})

}


// get bullion data using xmlhttprequest
function getBullionJson()
{
  var url = `https://data-asg.goldprice.org/dbXRates/USD`;

  return new Promise(function(resolve,reject){

  bXml = new XMLHttpRequest();

  bXml.open("GET", url , true);

  if(!bXml) return false;

  bXml.onreadystatechange = function()
  {
    if(bXml.readyState == 4)
    {
      if(bXml.status === 200)
      {
        resolve(bXml.responseText);
      }
      else
      {
        reject(Error(bXml.status));
      }
    }

  }
  bXml.send(null);
})

}

function getCryptoJson(url)
  {
    return new Promise(function(resolve,reject){


    cXhr = new XMLHttpRequest();
    cXhr.open("GET", url, true);

    if(!cXhr) return false;

    cXhr.onreadystatechange = function(){

      if(cXhr.readyState == 4)
      {
        if(cXhr.status=200)
        {
          resolve(cXhr.responseText);
        }
        else{
          reject(Error(cXhr.status));
        }
      }
    }
    cXhr.send(null);
    })

  }
