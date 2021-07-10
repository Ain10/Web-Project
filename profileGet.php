<?php

session_start();
require_once("xmlDOMRequire.php");
if(isset($_GET['getPicture'])){
    foreach($users as $user){
        if($user->getAttribute("username") == $_SESSION['username']){
            echo $user->getElementsByTagName("profilePic")->item(0)->nodeValue;
            break;
        }
    }
}else{
    header("Location: viewMovies.php");
}
?>