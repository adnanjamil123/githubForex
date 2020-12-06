/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function formValidation()
{
	var national_identity_name = document.national_identity_form.national_identity_name;
	var issue_date = document.national_identity_form.issue_date;
	var expire_date = document.national_identity_form.expire_date;
	var national_identity_number = document.national_identity_form.national_identity_number;

		if(national_identity_name_input_keys(national_identity_name))
		{
			if(national_identity_number_input_keys(national_identity_number))
			{
				if(issue_date_input_keys(issue_date))
				{
					if(expire_date_input_keys(expire_date))
					{
						return true;
					}
				}
			}
		}
	
	
	

	return false;
	
}

function bonusformValidation()
{
		var bonus_amount = document.bonus_form.bonus_amount;
	
		if(transaction_amount_input_keys(bonus_amount))
		{
			return true;
		}
	
	
	

	return false;
	
}


// for national identity name

function national_identity_name_input_keys(fieldname)
{
	var getElement = document.getElementById("error_national_identity_name");
	
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

// for phone

function national_identity_number_input_keys(fieldname)
{
	var getElement = document.getElementById("error_national_identity_number");
	
	var regex2=/^([0-9]{13})+$/;
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers , or at least 13 digit required..";
		
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


// for issue date

function issue_date_input_keys(fieldname)
{
	var getElement = document.getElementById("error_issue_date");
	
	var regex2=/^([0-9]{4}-[0-9]{2}-[0-9]{2})+$/;
	
	var textvalue = fieldname.value;
	
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers, or Format: (YYYY-MM-DD)";
		
		var regex = /([^0-9-])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else if(textvalue.substr(5 , 2) > 12 || textvalue.substr(5 , 2) < 01)
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
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}


}

// for expire date

function expire_date_input_keys(fieldname)
{
	var getElement = document.getElementById("error_expire_date");
	
	var regex2=/^([0-9]{4}-[0-9]{2}-[0-9]{2})+$/;
	
	var textvalue = fieldname.value;
	
	
	if(!fieldname.value.match(regex2))
	{
		getElement.innerHTML = "Contain only numbers, or Format: (YYYY-MM-DD)";
		
		var regex = /([^0-9-])/gi;
		
		fieldname.value = fieldname.value.replace(regex, "");
		
		fieldname.focus();
		
		return false;
	
	}
	else if(textvalue.substr(5 , 2) > 12 || textvalue.substr(5 , 2) < 01)
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
	else
	{
		getElement.innerHTML = "";
		
		return true;
	}


}

// for transaction_account_info


function transaction_amount_input_keys(fieldname)
{
	
	var getElement = document.getElementById("error_transaction_amount");
	
	var regex2=/^([0-9])+$/;
	
	if(fieldname.value <= 0)
	{
		
			getElement.innerHTML = "Accept greater than zero.";
		
			fieldname.focus();
		
			return false;
	}		
	else if(!fieldname.value.match(regex2))
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

