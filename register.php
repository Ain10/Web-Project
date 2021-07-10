<?php
$xml = new domdocument("1.0");
$xml->load("users.xml");

$account = $xml->getElementsByTagName("user");

$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;


$username = $_GET["username"] ?? "";
$password = $_GET["password"] ?? "";
$fName = $_GET["fname"] ?? "";
$lName = $_GET["lname"] ?? "";
$email = $_GET["email"] ?? "";

$userExist = FALSE;

foreach($account as $accounts){
    if ($username == $accounts->getAttribute('username')){
        $userExist =TRUE;
        break;
    }
}

if($userExist){
    echo "username_exists";
}else{
    $user = $xml->createElement("user");
    $password = $xml->createElement("password", $password);
    $fName = $xml->createElement("firstName", $fName);
    $lName = $xml->createElement("lastName", $lName);
    $email = $xml->createElement("email", $email);

    $user->setAttribute("username", $username);
    $user->appendChild($password);
    $user->appendChild($fName);
    $user->appendChild($lName);
    $user->appendChild($email);

    $xml->getElementsByTagName("users")->item(0)->appendChild($user);
    $xml->save("users.xml");


}
?>