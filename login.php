<?php
session_start();

$username = $_GET['username'] ?? "";
$password = $_GET['password'] ?? "";

$xml = new DOMDocument();
$xml->load("users.xml");

$account = $xml->getElementsByTagName("user");

foreach($account as $accounts){
    if($username == $accounts->getAttribute('username')){
        if($password == $accounts->getElementsByTagName('password')->item(0)->nodeValue){
            $_SESSION['username'] = $username;
			echo "log_succ";
			break;
		}
		else{
			echo "err_pass";
			break;
		
        }
    }
}
?>