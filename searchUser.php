<?php
    session_start();
    require_once("xmlDOMRequire.php");
    $userName = $_GET["user"];
    $password = $_GET["password"];
   
    foreach($users as $user){
        $username = $user->getAttribute("username");
        $pass = $user->getElementsbyTagName("password")[0]->nodeValue;
        if($username == $userName && $password == $pass){
            
            echo "1";
            $_SESSION['logged'] = "logged";
            $_SESSION['username'] = $username;
            $_SESSION['firstN'] = $user->getElementsByTagName("firstName")->item(0)->nodeValue;
            $_SESSION['lastN'] = $user->getElementsByTagName("lastName")->item(0)->nodeValue;
            $_SESSION['profilePic'] = $user->getElementsByTagName("profilePic")->item(0)->nodeValue;

            $status = $xml->createElement("status", "active");
            $oldStatus = $user->getElementsByTagName("status")->item(0);

            $user->replaceChild($status, $oldStatus);
            $xml->save("users.xml");
            exit();
        }
    }
    echo "Wrong Username or Password";
?>