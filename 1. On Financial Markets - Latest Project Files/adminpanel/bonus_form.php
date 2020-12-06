<?php
	
	// include files
	
	require_once('../DatabaseConfiguration.php');
	
	require_once('../InfoSecurity.php');
	
	require_once('../request.php');
	
	$data = new InfoSecurity();
	
	$query = "CALL our_users_status";
	
	$get_our_users_status = new DatabaseConfiguration();
	
	$result = $get_our_users_status->query($query);
	
	$userArray = array();
	
	foreach($result as $display)
	{
		// $data->decrypt($display['0']) . ' - (' . $display['1'] . ' ' . $display['2'] . ' )';
		$userArray[] = $data->decrypt($display['0']) . ' - (' . $display['1'] . ' ' . $display['2'] . ' )';
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
 
	


<style>

* { box-sizing: border-box; }
body {
  font: 16px Arial;
}
.md-form {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.md-form-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.md-form-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.md-form-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.md-form-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}


</style>

</head>

<body>

<?php require_once("admin_header.php"); ?>

<br/>
<div  class="d-flex justify-content-center align-items-center"  style="max-width: 100rem;" >

	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		
<div class="card" style="padding:30px;">

  <!-- Card body -->
  <div class="card-body">

    <!-- Material form register -->
    <form autocomplete="off" name="bonus_form"  action="add_bonus" onsubmit="return bonusformValidation()" method="POST" >
      <p class="h4 text-center py-4">Bonus Detail</p>

	  <!--Make sure the form has the autocomplete function switched off:-->

  <!-- Material input text -->
      <div class="md-form">
	  
        <i class="fa fa-user-tie prefix grey-text"></i>
		<i id="error_f_name" style="float:right; color:red"></i>
        <input type="text" id="myInput" class="form-control" name="bonus_user" required>
         
		<label for="myInput" class="font-weight-light">Search Users</label>
		
      </div>
 
	  <br/>

	     <label class="font-weight-light">Amount</label>
	  <div class="form-group">
		<input type="text" class="form-control" id="inputAddress" placeholder="Enter amount" name="bonus_amount" onfocusout="transaction_amount_input_keys(this)" required>
			<i id="error_transaction_amount" style="float:right; color:red"></i>
	  </div>
	  
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" name="add_bonus_btn" type="submit">Add Bonus</button>
      </div>
	  
	   
	  
	  
    </form>
    <!-- Material form register -->

  </div>
  <!-- Card body -->

</div>

<!-- Card -->
	
	
	
	</div>


  <script>
  
  
var countries = <?php echo json_encode($userArray); ?>;

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "md-form-list");
      a.setAttribute("class", "md-form-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "md-form-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("md-form-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("md-form-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("md-form-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
} 
  autocomplete(document.getElementById("myInput"), countries);
  </script>
	  
</body>

</html>
