<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>On Financial Markets</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="form_sourcefiles/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="form_sourcefiles/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="form_sourcefiles/css/style.css" rel="stylesheet">
  <script src="js/form-validation.js"></script>
	
  <script>
function leverage_value() {
  
                document.getElementById("leverage_lable").innerHTML = "1: " + document.getElementById("leverage_current_value").value;
			
    }

</script>

<style>

p{
	
	text-align: justify;
}

</style>

</head>

<body onload="leverage_value()">

  <!-- Start your project here-->

   <div class="form-row">
    <!-- Grid column -->
	 <!--- class="card border-primary mb-3" -->
	 <div class="col">
      <div class="col-14">
	  
      <!-- Default input -->
     <img src="images/business_image.jpg" class="img-fluid" alt="Responsive image">
	 <br/><br/>
	 </div>
	 
	 <div class="col-12">
	 <h1 class="text-center" style=" background:navy; color:white">ABOUT ON FINANCIAL MARKETS</h1>
	 
	 <br/>
<p>
On Financial Markets is a global, award winning, online broker providing 24/5 trading facilities to private and institutional investors in forex and CFDs on indices, bullion, commodities, energies and cryptocurrencies.
<br/><br/>
Originally established in UK in 2019, the One Financial Markets Group of companies offers global presence with local expertise through its wholly owned and affiliate offices throughout the Middle East, Europe, South America and Central and South East Asia.
<br/><br/>
The Group is regulated by financial services authorities around the world including the Financial Conduct Authority in the UK and the Financial Sector Conduct Authority in South Africa. </p>
</div>

<div class="col-12">
<h1 class="text-center" style="background:navy; color:white">PRIVACY NOTICE</h1>
<p>
<br/>
At On Financial Markets we are committed to safeguarding your privacy.
<br/><br/>
Please see our Privacy Policy for details about what information is collected from you and why it is collected. We do not sell your information or use it other than as described in the Policy.
<br/><br/>
Please note that it is in our legitimate business interest to send you certain marketing emails from time to time. However, if you would prefer not to receive these you can opt-out by ticking the box above. Alternatively you can unsubscribe at any time using the unsubscribe link at the bottom of the emails we send.
<br/><br/>
You can also set your email preferences from within the client portal details of which will be emailed to you on completion of the application form.
<br/><br/>
By continuing with this application you agree with the use of your personal information as detailed in the Policy.

</p>
</div>

<center>
<div class="col-12">
<h1 class="text-center"style="background:navy; color:white">CONTACT US</h1>

<!--Facebook-->
<a href="https://www.facebook.com" class="btn-floating btn-lg btn-fb" type="button" role="button"><i class="fab fa-facebook-f"></i></a>
<!--Twitter-->
<a href="https://twitter.com/" class="btn-floating btn-lg btn-tw" type="button" role="button"><i class="fab fa-twitter"></i></a>
<!--Google +-->
<a href="https://www.google.com" class="btn-floating btn-lg btn-gplus" type="button" role="button"><i class="fab fa-google-plus-g"></i></a>
<!--Linkedin-->
<a href="https://www.linkedin.com/" class="btn-floating btn-lg btn-li" type="button" role="button"><i class="fab fa-linkedin-in"></i></a>
<!--Instagram-->
<a href="https://www.instagram.com/" class="btn-floating btn-lg btn-ins" type="button" role="button"><i class="fab fa-instagram"></i></a>
<!--Youtube-->
<a href="https://www.youtube.com/" class="btn-floating btn-lg btn-yt" type="button" role="button"><i class="fab fa-youtube"></i></a>



</div>
Email: <a href="#"><font color=" #1b5fde ">info@ofmarkets.com</font></a><br/>  +92 (301) 9842026 </center>
    </div>
    
	
  <div class="col">
	
  
  
	 <!--- class="card border-primary mb-3" -->
	
		<!-- Card -->
		<div class="col-14">
<div class="card">

  <!-- Card body -->
  <div class="card-body">

    <!-- Material form register -->
    <form name="registration"  action="UserRegistration" onsubmit="return formValidation()" method="POST" >
      <p class="h4 text-center py-4">Sign up</p>

      <!-- Material input text -->
      <div class="md-form">
	  
        <i class="fa fa-user-tie prefix grey-text"></i>
		<i id="error_f_name" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardFirstNameEx" class="form-control" name="f_name" onkeyup="f_name_input_keys(this)"  required>
         
		<label for="materialFormCardFirstNameEx" class="font-weight-light">First Name</label>
		
      </div>
	  
	   <!-- Material input text -->
      <div class="md-form">
        <i class="fa fa-user-tie prefix grey-text"></i>
		<i id="error_l_name" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardLastNameEx" class="form-control" name="l_name" onkeyup="l_name_input_keys(this)" required>
        <label for="materialFormCardLastNameEx" class="font-weight-light">Last Name</label>
      </div>
	  
      <!-- Material input email -->
      <div class="md-form">
        <i class="fa fa-envelope prefix grey-text"></i>
		<i id="error_user_email_auth" style="float:right; color:red"></i>
        <input type="email" id="materialFormCardEmailEx" class="form-control" name="user_email_auth" onkeyup="user_email_auth_input_keys(this)" required>
        <label for="materialFormCardEmailEx" class="font-weight-light">Your email</label>
      </div>

      <!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
        <input type="password" id="materialFormCardPasswordEx" class="form-control" name="user_password" required>
        <label for="materialFormCardPasswordEx" class="font-weight-light">Your password</label>
      </div>
		
	  <!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-exclamation-triangle prefix grey-text"></i>
		<i id="error_user_password" style="float:right; color:red"></i>
        <input type="password" id="materialFormCardPasswordEx2" class="form-control" name="confirm_user_password" onkeyup="user_password_input_keys(this)" required>
        <label for="materialFormCardPasswordEx2" class="font-weight-light">Confirm your password</label>
      </div>
	
	<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-phone prefix grey-text"></i>
		<i id="error_phone_no" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardPhoneEx" class="form-control" name="phone_no" onkeyup="phone_no_input_keys(this)" required>
        <label for="materialFormCardPhoneEx" class="font-weight-light">Phone</label>
      </div>
	
	
	<!-- Material input password -->
      <div class="md-form">
        <i class="fa fa-calendar-alt prefix grey-text"></i>
		<i id="error_date_of_birth" style="float:right; color:red"></i>
        <input type="text" id="materialFormCardDOB" class="form-control" name="date_of_birth" onkeyup="date_of_birth_input_keys(this)" required>
        <label for="materialFormCardDOB" class="font-weight-light">Date of Birth (YYYY-MM-DD) </label>
      </div>
	  
	<label class="font-weight-light">Select a Country</label>
	  <select class="browser-default custom-select" name="country" required>
		  <option selected disabled style="display:none">Country</option>
		     <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="United Kingdom">United Kingdom</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="United States of America">United States of America</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
	  </select>
	  
	  <br/><br/>
	  
	  <label class="font-weight-light">Select a City/Town</label>
	  <div class="form-row">
    <!-- Grid column -->
    <div class="col-7">
      <!-- Default input -->
	  
      <input type="text" class="form-control" placeholder="City" name="city_town" onkeyup="city_town_input_keys(this)" required >
	  <i id="error_city_town" style="float:right; color:red"></i>
    </div>
    <!-- Grid column -->
	
	 <!-- Grid column -->
    <div class="col">
      <!-- Default input -->
      <input type="text" class="form-control" placeholder="Street No" name="street_number" onkeyup="street_number_input_keys(this)" required>
	  <i id="error_street_number" style="float:right; color:red"></i>
    </div>
    <!-- Grid column -->
	
    <!-- Grid column -->
    <div class="col">
      <!-- Default input -->
      <input type="text" class="form-control" placeholder="Postal/Zip" name="postal_zip_code" onkeyup="postal_zip_code_input_keys(this)"required>
	  <i id="error_postal_zip_code" style="float:right; color:red"></i>
    </div>
    <!-- Grid column -->
  </div>
	    
	   <br/>
	   
	  <label class="font-weight-light">Residential Address</label>
	  <div class="form-group">
		<input type="text" class="form-control" id="inputAddress" placeholder="Apartment, studio, or floor" name="residential_address" required>
	  </div>
	  
	  <label class="font-weight-light">Preferred Language</label>
	  <select class="browser-default custom-select" name="preferred_language" required>
		  <option selected disabled style="display:none">Preferred Language</option>
		  <option value="English">English</option>
		  <option value="Urdu">Urdu</option>
	  </select>
	  
	  <br/><br/>
	  
 <label class="font-weight-light">Where you find us?</label>
	  <select class="browser-default custom-select" name="find_us_detail" required>
		  <option selected disabled style="display:none">Find Us</option>
		  <option value="Google">Google</option>
		  <option value="Facebook">Facebook</option>
		  <option value="Yahoo">Yahoo</option>
	  </select>
	  
	 <br/><br/>
	  
 <label class="font-weight-light">Account Type</label>
	  <select class="browser-default custom-select" name="account_type" onchange="getAccountType(this);" required>
		  <option selected disabled style="display:none">Type of your Account</option>
		  <option value="Standard">Standard Account</option>
		  <option value="Mini">Mini Account</option>
	  </select>
	  
	  <br/><br/>
	  
	  <label class="font-weight-light">Base Currency</label>
	  <select class="browser-default custom-select" name="account_base_currency" required>
		  <option selected disabled style="display:none">Account Base Currency</option>
		  <option value="USD">United States Dollars</option>
	<option value="EUR">Euro</option>
	<option value="GBP">United Kingdom Pounds</option>
	<option value="DZD">Algeria Dinars</option>
	<option value="ARP">Argentina Pesos</option>
	<option value="AUD">Australia Dollars</option>
	<option value="ATS">Austria Schillings</option>
	<option value="BSD">Bahamas Dollars</option>
	<option value="BBD">Barbados Dollars</option>
	<option value="BEF">Belgium Francs</option>
	<option value="BMD">Bermuda Dollars</option>
	<option value="BRR">Brazil Real</option>
	<option value="BGL">Bulgaria Lev</option>
	<option value="CAD">Canada Dollars</option>
	<option value="CLP">Chile Pesos</option>
	<option value="CNY">China Yuan Renmimbi</option>
	<option value="CYP">Cyprus Pounds</option>
	<option value="CSK">Czech Republic Koruna</option>
	<option value="DKK">Denmark Kroner</option>
	<option value="NLG">Dutch Guilders</option>
	<option value="XCD">Eastern Caribbean Dollars</option>
	<option value="EGP">Egypt Pounds</option>
	<option value="FJD">Fiji Dollars</option>
	<option value="FIM">Finland Markka</option>
	<option value="FRF">France Francs</option>
	<option value="DEM">Germany Deutsche Marks</option>
	<option value="XAU">Gold Ounces</option>
	<option value="GRD">Greece Drachmas</option>
	<option value="HKD">Hong Kong Dollars</option>
	<option value="HUF">Hungary Forint</option>
	<option value="ISK">Iceland Krona</option>
	<option value="INR">India Rupees</option>
	<option value="IDR">Indonesia Rupiah</option>
	<option value="IEP">Ireland Punt</option>
	<option value="ILS">Israel New Shekels</option>
	<option value="ITL">Italy Lira</option>
	<option value="JMD">Jamaica Dollars</option>
	<option value="JPY">Japan Yen</option>
	<option value="JOD">Jordan Dinar</option>
	<option value="KRW">Korea (South) Won</option>
	<option value="LBP">Lebanon Pounds</option>
	<option value="LUF">Luxembourg Francs</option>
	<option value="MYR">Malaysia Ringgit</option>
	<option value="MXP">Mexico Pesos</option>
	<option value="NLG">Netherlands Guilders</option>
	<option value="NZD">New Zealand Dollars</option>
	<option value="NOK">Norway Kroner</option>
	<option value="PKR">Pakistan Rupees</option>
	<option value="XPD">Palladium Ounces</option>
	<option value="PHP">Philippines Pesos</option>
	<option value="XPT">Platinum Ounces</option>
	<option value="PLZ">Poland Zloty</option>
	<option value="PTE">Portugal Escudo</option>
	<option value="ROL">Romania Leu</option>
	<option value="RUR">Russia Rubles</option>
	<option value="SAR">Saudi Arabia Riyal</option>
	<option value="XAG">Silver Ounces</option>
	<option value="SGD">Singapore Dollars</option>
	<option value="SKK">Slovakia Koruna</option>
	<option value="ZAR">South Africa Rand</option>
	<option value="KRW">South Korea Won</option>
	<option value="ESP">Spain Pesetas</option>
	<option value="XDR">Special Drawing Right (IMF)</option>
	<option value="SDD">Sudan Dinar</option>
	<option value="SEK">Sweden Krona</option>
	<option value="CHF">Switzerland Francs</option>
	<option value="TWD">Taiwan Dollars</option>
	<option value="THB">Thailand Baht</option>
	<option value="TTD">Trinidad and Tobago Dollars</option>
	<option value="TRL">Turkey Lira</option>
	<option value="VEB">Venezuela Bolivar</option>
	<option value="ZMK">Zambia Kwacha</option>
	<option value="EUR">Euro</option>
	<option value="XCD">Eastern Caribbean Dollars</option>
	<option value="XDR">Special Drawing Right (IMF)</option>
	<option value="XAG">Silver Ounces</option>
	<option value="XAU">Gold Ounces</option>
	<option value="XPD">Palladium Ounces</option>
	<option value="XPT">Platinum Ounces</option>
	  </select>
	  
	   <br/><br/>
	  
	  
	  
	  <label id="leverage_range" class="font-weight-light">Account Leverage ( Depends Upon Account Type ) </label>
	  
	<input type="range" id="leverage_current_value" value="50" onchange="leverage_value();" class="custom-range" min="50" max="500" step="50" id="customRange3" name="account_leverage" required>
	  <label class="font-weight-light">Ratio Value: &nbsp; </label> <label id="leverage_lable" class="font-weight-light">0</label>
	  
	   <br/><br/>
	  
	   <label class="font-weight-light">Expected Investment Balance</label>
	  <div class="form-group">
		<input type="text" class="form-control" id="inputAddress" placeholder="Expected Investment Balance" name="expected_investment_balance" onkeyup="expected_investment_balance_input_keys(this)" required>
			<i id="error_expected_investment_balance" style="float:right; color:red"></i>
	  </div>
	  
	  <div class="text-center py-4 mt-3">
        <button class="btn btn-cyan" type="submit">Register</button>
      </div>
	  
	   
	  
	  
    </form>
    <!-- Material form register -->

  </div>
  <!-- Card body -->

</div>
</div>
<!-- Card -->
	
	</div>
	</div>
	

		
  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="form_sourcefiles/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="form_sourcefiles/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="form_sourcefiles/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="form_sourcefiles/js/mdb.min.js"></script>
  
  <script>
	  
	  function getAccountType(fieldname)
	  {
		var selected_account_type = fieldname.value;
		
		var get_element_leverage = document.getElementById("leverage_current_value");
		var range_text = document.getElementById("leverage_range");

		if(selected_account_type == "Mini")
		{
			range_text.innerHTML =  "Account Leverage ( 1:50 - 1:100 )";

			get_element_leverage.max = 100;
			
		}
		else if(selected_account_type == "Standard")
		{
			range_text.innerHTML =  "Account Leverage ( 1:50 - 1:500 )";
	
			get_element_leverage.max = 500;
			
			
		}
		
		
		get_element_leverage.value  = 50;
		
		leverage_value();
		
	  }
	  
	  </script>
	  
</body>

</html>
