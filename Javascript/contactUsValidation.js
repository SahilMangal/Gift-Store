$(document).ready(function () {
	
	$("#firstNameCheck").hide();
	let firstNameError = true;

	$('#txtFirstName').keyup(function () {
		validateFirstName();
	});

	$("#lastNameCheck").hide();
	let lastNameError = true;

	$('#txtLastName').keyup(function () {
		validateLastName();
	});


	function validateFirstName() {
		let firstNameValue = $('#txtFirstName').val();
		if (firstNameValue.length == "") {
			$('#firstNameCheck').show();
			firstNameError = false;
			return false;
		} else if (firstNameValue.length < 3 || firstNameValue.length > 10) {
			$('#firstNameCheck').show();
			$('#firstNameCheck').html("**Invalid First Name");
			firstNameError = false;
			return false;
		} else {
			$('#firstNameCheck').hide();
		}
	}

	function validateLastName() {
		let lastNameValue = $('#txtLastName').val();
		if (lastNameValue.length == "") {
			$('#lastNameCheck').show();
			lastNameError = false;
			return false;
		} else if (lastNameValue.length < 3 || lastNameValue.length > 10) {
			$('#lastNameCheck').show();
			$('#lastNameCheck').html("**Invalid Last Name");
			lastNameError = false;
			return false;
		} else {
			$('#lastNameCheck').hide();
		}
	}

});


function validateEmail(id) {
    var x = document.getElementById(id).value;
    var validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (x.match(validRegex)) {
        document.getElementById(id).style.backgroundColor = "white";
        document.getElementById(id).style.color = "black";
    } else {
        document.getElementById(id).style.backgroundColor = "#EF5350";
        document.getElementById(id).style.color = "white";
        
    }
}








