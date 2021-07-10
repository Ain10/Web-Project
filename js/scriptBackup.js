/*
This file is just a backup of the original script.
This file hasn't been used in any part of the project
*/



$(document).ready(function() {
	$('.regis a').on('click', function() {
		$('form').animate({
			height: "toggle",
			opacity: "toggle"
		}, "fast");
	});

	/*$('#create-button').on('click', function(){
		var registerUnameEntry = $('#registerUname').val();
		var registerPwordEntry = $('#registerPword').val();
		var registerCPwordEntry = $('#registerCPword').val();
		var registerFnameEntry = $('#registerFname').val();
		var registerLnameEntry = $('#registerLname').val();
		var registerEmailEntry = $('#registerEmail').val();

		var registerEmailValid = false;

		var registerUnameObject = $('#registerUname');
		var registerPwordObject = $('#registerPword');
		var registerCPwordObject = $('#registerCPword');
		var registerFnameObject = $('#registerFname');
		var registerLnameObject = $('#registerLname');
		var registerEmailObject = $('#registerEmail');

		var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		if ((registerUnameEntry).length == 0){
			$(registerUnameObject).addClass("error")
			$(registerUnameObject).val("This field is required ")
		}
		if ((registerPwordEntry).length == 0){
			$(registerPwordObject).addClass("error")
			$(registerPwordObject).val("This field is required ")
		}
		if ((registerCPwordEntry).length == 0){
			$(registerCPwordObject).addClass("error")
			$(registerCPwordObject).attr("placeholder","This field is required ")
		}
		if ((registerFnameEntry).length == 0){
			$(registerFnameObject).addClass("error")
			$(registerFnameObject).val("This field is required ")
		}
		if ((registerLnameEntry).length == 0){
			$(registerLnameObject).addClass("error")
			$(registerLnameObject).val("This field is required ")
		}
		if ((registerEmailEntry).length == 0){
			$(registerEmailObject).addClass("error")
			$(registerEmailObject).val("This field is required ")
		}
	});*/

	});

function login(username, password){
    xhr = new XMLHttpRequest();
    
    xhr.onreadystatechange = () =>{
        if (xhr.readyState == 4 && xhr.status == 200){
            loginStatus(xhr.responseText);
            document.getElementById("test").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "login.php?username=" + username + "&password=" + password, true);
	xhr.send();

}

function loginStatus(status){
	if(status == "err_pass"){
		alert("Incorrect Password");
	}
	
	else if(status == "log_succ"){
		window.location.href = 'index.php';
	}
	
	else{
		alert("Invalid Username");
	}
}

function register(username, password, cpword, fname, lname, email){
	xhr = new XMLHttpRequest();

	xhr.onreadystatechange = () =>{
		if(xhr.readyState == 4 && xhr.status == 200){
			registerValidate(xhr.responseText);
			document.getElementById("test").innerHTML = xhr.responseText;
		}
	};

	if(username == "" || password == "" || cpword == "" || fname == "" || lname == "" || email == ""){
		Swal.fire({
			icon:'warning',
			title:'All fields are required.'
			
		});
	}

	else{
		if(password != cpword){
			Swal.fire({
				icon:'error',
				title:'Password did not match',
				text: 'Please try again.'
			});
		}
		else{
			xhr.open("GET", "register.php?username=" + username + "&password=" + password + "&fname=" + fname + "&lname=" + lname + "&email=" + email, true);
		xhr.send();
		}
		
	}
}

function registerValidate(validate){
	if (validate == "username_exists"){
		Swal.fire({
			icon: 'error',
			title: 'Error',
			text: 'Username already exists!'
		  });
	}
	else{
		Swal.fire({
			icon: 'success',
			title: 'Registration is successful',
			
		  });

		$('form').animate({
			height: "toggle",
			opacity: "toggle"
		}, "fast");

		$('#registerUname').val("");
		$('#registerPword').val("");
		$('#registerCPword').val("");
		$('#registerFname').val("");
		$('#registerLname').val("");
		$('#registerEmail').val("");

	}
}



