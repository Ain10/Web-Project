<?php
    session_start();
    require_once("xmlDOMRequire.php");
    if($_SESSION['username'] == null){
        header("Refresh:0; url=index.php");
    }
    if(isset($_GET['getUsers'])){

        $activeUsers = [];
        
        foreach($users as $user){
            $status = $user->getElementsByTagName("status")->item(0)->nodeValue;
            $username = $user->getAttribute("username");
           
            if($status == "active" && $username != $_SESSION['username']){
                $firstName = $user->getElementsByTagName("firstName")->item(0)->nodeValue;
                $lastName = $user->getElementsByTagName("lastName")->item(0)->nodeValue;
                $profilePic = $user->getElementsByTagName("profilePic")->item(0)->nodeValue;
    
                $activeUsers[] = "<li class='user' data-uname='$username' onclick='showChatBox(this)'> 
                                <img class='user-pic' src='profile_pics/$profilePic'/> 
                                <span>$firstName $lastName</span></li>";
            }
        }
        $countUsers = count($activeUsers);
        $activeUsers = implode("", $activeUsers);
        echo $countUsers."|".$activeUsers;
    }else{
        header("Location: viewMovies.php");
    }

?>