<?php
    session_start();
    include("xmlDOMRequire.php");



    if(isset($_GET['user'])){
        $userN = $_GET['user'];
        foreach($users as $user){
            $username = $user->getAttribute("username");
            if($username == $userN){
                echo "Username is Already Taken";
                exit();
            }
        }
        echo "";

    }
    if(isset($_GET['firstName'])){
        $firstN = $_GET['firstName'];
        $lastN = $_GET['lastName'];
        foreach($users as $user){
            $first = $user->getElementsbyTagName("firstName")[0]->nodeValue;
            $last = $user->getElementsbyTagName("lastName")[0]->nodeValue;
            if($firstN == $first && $lastN == $last){
                echo "Account for this person has already been created";
                exit();
            }
        }
        echo "";
    }

    if(isset($_GET['registerUser'])){
        $username = $_GET['registerUser'];
        $registerFirst = $_GET['firstN'];
        $registerLast = $_GET['lastN'];
        $pass = $_GET['pass'];

        $newUser = $xml->createElement('user');
        $newPassword = $xml->createElement('password',$pass);
        $newFirstName = $xml->createElement('firstName',$registerFirst);
        $newLastName = $xml->createElement('lastName',$registerLast);
        $newUser->setAttribute('username', $username);

        $newUser->appendChild($newPassword);
        $newUser->appendChild($newFirstName);
        $newUser->appendChild($newLastName);

        $xml->getElementsByTagName('users')[0]->appendChild($newUser);
        $xml->save('users.xml');
        echo "none";
    }

    
    if(isset($_GET['logout'])){
        $discern = $_GET['logout'];   
        echo "<script>alert('$discern')</script>";

        if($discern=="true"){
            foreach($users as $i=>$user){
                if($user->getAttribute("username") == $_SESSION['username']){
    
                    $status = $xml->createElement("status", "inactive");
                    $oldStatus = $user->getElementsByTagName("status")->item(0);
    
                    $user->replaceChild($status, $oldStatus);
                    $xml->save("users.xml");
                    break;
                }
            }
            $_SESSION = array();
            session_destroy();
            session_unset();
            header("Refresh:0; url=index.php");
            // header("Location: index.php");
            // header("Location: viewMovies.php");
        }
    }
?>