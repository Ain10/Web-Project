$(document).ready(function() {
	$('.regis a').on('click', function() {
		$('form').animate({
			height: "toggle",
			opacity: "toggle"
		}, "fast");
	});
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

function register(username, password, cpword, fname, lname, email, captchaInput){
	xhr = new XMLHttpRequest();

	xhr.onreadystatechange = () =>{
		if(xhr.readyState == 4 && xhr.status == 200){
			registerValidate(xhr.responseText);
			document.getElementById("test").innerHTML = xhr.responseText;
		}
	};



	var registerEmailEntry = $('#registerEmail').val();
	//var registerEmailValid = false;
	var registerEmailObject = $('#registerEmail');
	var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if(username == "" || password == "" || cpword == "" || fname == "" || lname == "" || email == "" || captchaInput == ""){
		Swal.fire({
			icon:'warning',
			title:'All fields are required.'
			
		});
	}
	else{
		if(password != cpword){
			Swal.fire({
				icon:'error',
				title:'Password and Confirm Password did not match',
				text: 'Please try again.'
			});
		}
		else{	
			if (!validateEmail.test(registerEmailEntry)){
				Swal.fire({
					icon:'error',
					title:'Email Invalid',
					text: 'Please try again.'
				});
				$(registerEmailObject).addClass("error");
				$(registerEmailObject).val("Enter a valid email address")
			}else{
				if (captchaInput == code) {
					xhr.open("GET", "register.php?username=" + username + "&password=" + password + "&fname=" + fname + "&lname=" + lname + "&email=" + email, true);	
				} else {		
					Swal.fire({
						icon:'error',
						title:'Captcha Invalid',
						text: 'Please try again.'
					});
					createCaptcha();
					document.getElementById("captchaInput").value="";
				}

			}
			$(registerEmailObject).on('click', function () {
				$(this).removeClass("error");
				$(this).val(""); 
			  });
			
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
function createCaptcha(){
	document.getElementById('captcha').innerHTML = "";
  	 chars =   "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  	 captchaLength = 7;
  	captcha = [];

	for ( i = 0; i < captchaLength; i++) {
		index = Math.floor(Math.random()*chars.length + 1);
		if (captcha.indexOf(chars[index])==-1) captcha.push(chars[index]);
		else i--;
	}

	captchaCont = document.createElement("captchaContainer");
	captchaCont.id = "captcha";
	captchaCont.width = 120;
	captchaCont.height = 50;
	ctx = captchaCont.getContext("2d");
	ctx.font = "25px Georgia";
	ctx.strokeText(captcha.join(""), 0, 30);
	
	code = captcha.join("");
	document.getElementById("captcha").appendChild(captchaCont);
}
function validateCaptcha(){
	event.preventDefault();
	debugger
	if (document.getElementById(captchaInput).value == code){
		alert("captcha is valid")
	}else{
		alert("Invalid Captch. try Again");
		createCaptcha();
	}
}




