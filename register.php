<?php
    session_start();
    include("xmlDOMRequire.php");
    include('xmlConnector.php');



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

        $newUser = $xmlUser->createElement('user');
        $newPassword = $xmlUser->createElement('password',$pass);
        $newFirstName = $xmlUser->createElement('firstName',$registerFirst);
        $newLastName = $xmlUser->createElement('lastName',$registerLast);
        $profilePic = $xmlUser->createElement('profilePic','default.png');
        $status = $xmlUser->createElement('status','inactive');
        $newUser->setAttribute('username', $username);

        $newUser->appendChild($newPassword);
        $newUser->appendChild($newFirstName);
        $newUser->appendChild($newLastName);
        $newUser->appendChild($profilePic);
        $newUser->appendChild($status);

        $xmlUser->getElementsByTagName('users')[0]->appendChild($newUser);
        $xmlUser->save('users.xml');
        //new Cart
        $newUserCart = $xmlCarts->createElement('cart');
        $newUserCart->setAttribute('username',$username);

        $xmlCarts->getElementsByTagName('carts')[0]->append($newUserCart);
        $xmlCarts->save('cart.xml');
        //new Wishlist

        $newUserWishlist = $xmlWish->createElement('wish');
        $newUserWishlist->setAttribute('username',$username);

        $xmlWish->getElementsByTagName('wishes')[0]->append($newUserWishlist);
        $xmlWish->save('wishlist.xml');

        echo "none";
    }

    
    if(isset($_GET['logout'])){
        $discern = $_GET['logout'];   
        echo $discern;
        if($discern=="true"){
            foreach($users as $i=>$user){
                if($user->getAttribute("username") == $_SESSION['username']){
    
                    $status = $xmlUser->createElement("status", "inactive");
                    $oldStatus = $user->getElementsByTagName("status")->item(0);
    
                    $user->replaceChild($status, $oldStatus);
                    $xmlUser->save("users.xml");
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