<!DOCTYPE html>
<?php 
    session_start();
    ob_start();
    if(!empty($_SESSION['logged'])){
		header('location: viewMovies.php');
	}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="application/javascript" src="scripts.js"></script>
    
    <title>Document</title>
</head>
<body style = "width: 100%;" onload="createCaptcha()">
   

    
    <table id="tableLogin" style = "border-radius: 10px; padding: 10px; background: #deb887; font-size: 20px;">
        <tr id="loginStyle" style = "background: #deb887;">
        <td colspan="2">
        <div id="display"></div>
        </td>
        </tr>
        <tr id="loginStyle" style = "background: #deb887;">
            <td><p><b>Username:</b></p></td>
            <td><input type="text" placeholder="Username" id="username"></td></tr>
        <tr id="loginStyle" style = "background: #deb887;">
            <td><p><b>Password:</b></p></td>
            <td><input type="Password" placeholder="Password" id="password"></td></tr>
        <tr id="loginStyle2" >
            <td id="loginStyle2" style = "background: #deb887;"><button onclick="login()" id="Login" >Login</button></td></tr>
            <td id="showRegister" onclick="showRegister()" >Register</td>
            <td id="hideRegister" onclick="hide()" style="display: none;">Cancel</td>

    </table>

    <div id="register" style="display: none;">

<div> 
    <table style=" margin: 0 auto; border-radius: 5px; background-color: #f2f2f2; padding: 30px;">
    <tr id="loginStyle">
    <td colspan="2">
        <p id="userNameError"></p>
        <p id="accountName"></p>
        <p id="confirmError"></p>
    </td>
    </tr>
    <tr id="loginStyle">
        <td>Username:</td>
        <td><input type="text" onfocusout="checkUsername(this.value);" id="registerUsername" required></td></tr>
        

    <tr id="loginStyle" style = "background-color: #f2f2f2;">
       <td>First Name:</td>
        <td><input type="text" onfocusout="checkName();" id="registerFirstName" required></td></tr>
    <tr id="loginStyle">
        <td>Last Name:</td>
        <td><input type="text" onfocusout="checkName();"  id="registerLastName" required></td></tr>
        

    <tr id="loginStyle" style = "background-color: #f2f2f2;">
        <td>Password:</td>
        <td><input type="password" onfocusout="checkPassword();" id="registerPassword" required></td></tr>
    <tr id="loginStyle">
        <td>Confirm Password:</td>
        <td><input type="password" onfocusout="checkCPassword();" id="registerConfirmPassword" required><td></tr>
    <tr id="loginStyle" style = "background-color: #f2f2f2;">
        <td>Captcha Code:</td>
        <td><div id = "captcha"></div><td></tr>
    <tr id="loginStyle">
        <td>Captcha</td>
        <td> <input type="text" id="captchaInput" name="captchaInput" placeholder="Captcha" required><td></tr>
        
    <tr id="loginStyle" style = "background-color: #f2f2f2;">
        <td><button onclick="register()" id="registerButton" style = "background-color: #008CBA">Add User</button><td>
    </table>
</div>
    </div>
    

</body>
</html>

