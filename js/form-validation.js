/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function formValidation()
{
	var f_name = document.registration.f_name;
	var l_name = document.registration.l_name;
	var user_email_auth = document.registration.user_email_auth;
	var user_password = document.registration.user_password;
	var confirm_user_password = document.registration.confirm_user_password;
	var phone_no = document.registration.phone_no;
	var date_of_birth = document.registration.date_of_birth;
	var city_town = document.registration.city_town;
	var street_number = document.registration.street_number;
	var postal_zip_code = document.registration.postal_zip_code;
	var expected_investment_balance = document.registration.expected_investment_balance;

	if(f_name_input_keys(f_name))
	{
		if(l_name_input_keys(l_name))
		{
			if(user_email_auth_input_keys(user_email_auth))
			{
				if(confirm_password_input_keys(user_password, confirm_user_password))
				{
					if(phone_no_input_keys(phone_no))
					{
						if(date_of_birth_input_keys(date_of_birth))
						{
							if(city_town_input_keys(city_town))
							{
								if(street_number_input_keys(street_number))
								{
									if(postal_zip_code_input_keys(postal_zip_code))
									{
										if(expected_investment_balance_input_keys(expected_investment_balance))
										{
								
											return true;
											
										}
									}
										
								}
								
							}
						}
					}
				}
			}
		}
	}
	
	

	return false;
	
}


function changepassowrdformValidation(get_current_password)
{
	var current_password = document.changepassword_form.current_password;
	var user_password = document.changepassword_form.user_password;
	var confirm_user_password = document.changepassword_form.confirm_user_password;
	
	if(current_password_input_keys(current_password, get_current_password))
	{
		if(confirm_password_input_keys(user_password, confirm_user_password))
		{
			return true;
		}
	}

	return false;
	
}



function withdrawformValidation()
{

	if(current_paymentMethod())
	{
		return true;
	}

	return false;
	
}

function depositformValidation()
{

	if(current_paymentMethod())
	{
		return true;
	}

	return false;
	
}

function current_paymentMethod()
{
	var symbol = document.getElementById('symbol');
	var forMethod = document.getElementById('textforMethod');
	var forOurDetail = document.getElementById('textforOurDetail');
	var currentMethod = document.getElementById('transaction_method_type').value;
	var transaction_account_info = document.transaction_form.transaction_account_info;
	
	if(currentMethod == "WEBMONEY")
	{
		forMethod.innerHTML = "Account Number";
		forOurDetail.innerHTML = "WMID: 123456789012";
		symbol.className = "fa fa-user prefix grey-text";
		
		if(account_number_input_keys(transaction_account_info))
		{
			return true;
		}
	}
	else if(currentMethod == "SKRILL")
	{
		forMethod.innerHTML = "Your email";
		forOurDetail.innerHTML = "Email: example@domain.com";
		symbol.className = "fa fa-envelope prefix grey-text";
		
		if(user_email_auth_input_keys(transaction_account_info))
		{
			return true
		}			
	}
	
	return false;
			
}


function loginformValidation()
{
	
	var user_email_auth = document.login.user_email_auth;
	
	if(user_email_auth_input_keys(user_email_auth))
	{
		return true;			
	}
	
	return false;
	
}

// for firstname

function f_name_input_keys(fieldname)
{
	var getElement = document.getElementById("error_f_name");
	
	var regex2=/^[a-zA-Z ]+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only alphabet.";
		
		var regex = /([^a-z ])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}

// for lastname

function l_name_input_keys(fieldname)
{
	var getElement = document.getElementById("error_l_name");
	
	var regex2=/^[a-zA-Z ]+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only alphabet.";
		
		var regex = /([^a-z ])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}

// for email

function user_email_auth_input_keys(fieldname)
{
	var getElement = document.getElementById("error_user_email_auth");
	
	var regex2=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Your email is formatted incorrectly.";
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}


// for password

function confirm_password_input_keys(user_password, confirm_user_password)
{
	var getElement = document.getElementById("error_user_password");
	
	if(user_password.value != confirm_user_password.value)
	{
		getElement.innerHTML = "Password not matched.";
		
		confirm_user_password.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
		
	}

}

function user_password_input_keys(fieldname)
{
	var getElement = document.getElementById("error_user_password");
	
	var user_password = document.getElementById("materialFormCardPasswordEx");

	if(fieldname.value != user_password.value)
	{
		getElement.innerHTML = "Password not matched.";
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}

// current password
function current_password_input_keys(fieldname, get_current_password)
{
	var getElement = document.getElementById("error_current_password");
	
	if(fieldname.value != get_current_password)
	{
		getElement.innerHTML = "Current password is incorrect.";
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}

// for phone

function phone_no_input_keys(fieldname)
{
	var getElement = document.getElementById("error_phone_no");
	
	var regex2=/^([0-9]{11})+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers, or at least 11 digit required.";
		
		var regex = /([^0-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for account number

function account_number_input_keys(fieldname)
{
	var getElement = document.getElementById("error_user_email_auth");
	
	var regex2=/^([0-9]{12})+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers, or at least 12 digit required.";
		
		var regex = /([^0-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for DOB

function date_of_birth_input_keys(fieldname)
{
	var getElement = document.getElementById("error_date_of_birth");
	
	var regex2=/^([0-9]{4}-[0-9]{2}-[0-9]{2})+$/;
	
	var textvalue = fieldname.value;
	
	if(textvalue.substr(5 , 2) > 12 || textvalue.substr(5 , 2) < 01)
	{
		getElement.innerHTML = "Month value should be greater than 01 and less than 12.";
		
		fieldname.focus();
		
		return false;
	}
	else if(textvalue.substr(8 , 2) > 31 || textvalue.substr(8 , 2) < 01)
	{
		getElement.innerHTML = "Date value should be greater than 01 and less than 31.";
		
		fieldname.focus();
		
		return false;
	}
	else if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers.";
		
		var regex = /([^0-9-])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for city_town

function city_town_input_keys(fieldname)
{
	var getElement = document.getElementById("error_city_town");
	
	var regex2=/^[a-zA-Z ]+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only alphabet.";
		
		var regex = /([^a-z])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}

}

// for street number

function street_number_input_keys(fieldname)
{
	var getElement = document.getElementById("error_street_number");
	
	var regex2=/^([0-9])+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers.";
		
		var regex = /([^0-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for postal zip code

function postal_zip_code_input_keys(fieldname)
{
	var getElement = document.getElementById("error_postal_zip_code");
	
	var regex2=/^([0-9])+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers.";
		
		var regex = /([^0-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for expected investment balance

function expected_investment_balance_input_keys(fieldname)
{
	var getElement = document.getElementById("error_expected_investment_balance");
	
	var regex2=/^([0-9])+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers.";
		
		var regex = /([^0-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}

// for expected investment balance

function transaction_amount_input_keys(fieldname)
{
	
	var getElement = document.getElementById("error_transaction_amount");
	
	var regex2=/^([1-9])+$/;
	
	//var textvalue = fieldname.value;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers or accept greater than zero.";
		
		var regex = /([^1-9])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}
	

}


