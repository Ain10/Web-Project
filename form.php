<?php
include_once 'checkLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <script src="js/script.js"></script>
    <title>Document</title>
</head>
<body onload="createCaptcha()">
<div class="formContainer">
        <div class="form">
            <form class= "loginForm">
                <input type="text" id="loginUname" name="loginUname" placeholder="Username">
                <input type="Password" id="loginPword" name="loginPword" placeholder="Password">
                <div id="login-button" class="button" onclick="login(loginUname.value, loginPword.value)">Login</div>
                <p class="regis">Not Registered? <a href="#">Create an account</a></p>
			</form>
			<form class="registrationForm">
                <input type="text" id="registerUname" name="registerUname" placeholder="Username">
                <input type="password" id="registerPword" name="registerPword" placeholder="Password">
                <input type="password" id="registerCPword" name="registerCPword" placeholder="Confirm Password">
                <input type="text" id="registerFname" name="registerFname" placeholder="First Name">
                <input type="text" id="registerLname" name="registerLname" placeholder="Last Name">
				<input type="text" id="registerEmail" name="registerEmail" placeholder="E-mail">
                <div id = "captcha"></div>
                <input type="text" id= "captchaInput" name="captchaInput" placeholder="Captcha">
                <div id="create-button" class="button" onclick="register(registerUname.value, registerPword.value,registerCPword.value, registerFname.value, registerLname.value, registerEmail.value, captchaInput.value)">Register</div>
                <p class="regis">Already registered? <a href="#">Sign in</a></p>
		</form> 
		</div>
	</div>    
</body>
</html>