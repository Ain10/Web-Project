<?php 

    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    require_once('movieSort.php');
    require_once('xmlConnector.php');
        //ADD GAME TO WISHLIST
        if(isset($_GET['addW'])){
            $gameCode = $_GET['addW'];
            $user = $_SESSION['username'];
            //need data validation
            
            $newGamesAdded = $xmlWish->createElement('game',$gameCode);
            
            foreach($wishes as $wish){
                echo $gameCode;
                $wishID = $wish->getAttribute("username");
                if($wishID == $user){
                    $wish->appendChild($newGamesAdded);
                    $xmlWish->save('wishlist.xml');
                    //SWEET NOTIF
                    echo "SUCCESS";
                    
                }
            }
        }
    //ADD GAME TO CART
    if(isset($_GET['addG'])){
        $gameCode = $_GET['addG'];
        $user = $_SESSION['username'];
        //need data validation
        
        $newGamesAdded = $xmlCarts->createElement('game',$gameCode);

        foreach($carts as $cart){
            $cartID = $cart->getAttribute("username");
            if($cartID == $user){
                $cart->appendChild($newGamesAdded);
                $xmlCarts->save('cart.xml');
                //SWEET NOTIF
                echo "SUCCESS";
                
            }
        }
    }

    if(isset($_GET['addFromWishlist'])){
        $gameCode = $_GET['addFromWishlist'];
        $user = $_SESSION['username'];
        //need data validation
        
        $newGamesAdded = $xmlCarts->createElement('game',$gameCode);

        foreach($carts as $cart){
            $cartID = $cart->getAttribute("username");
            if($cartID == $user){
                $cart->appendChild($newGamesAdded);
                $xmlCarts->save('cart.xml');
                //SWEET NOTIF
                echo "SUCCESS";
                
            }
        }


        foreach($wishes as $wish){
            $wishID = $wish->getAttribute("username");
            $wishGame = $wish->getElementsByTagName('game');

            if($wishID == $user){
                foreach($wishGame as $counter=>$gameWish){
                    if($gameWish->nodeValue == $gameCode){
                        $willBeRemoved = $wish->getElementsByTagName('game')[$counter];
                        echo $willBeRemoved->nodeValue;
                        $wish->removeChild($willBeRemoved);
                        echo "delete sucess 1";
                    }
                }
                
                $xmlWish->save('wishlist.xml');
                //SWEET NOTIF
                echo "delete sucess 2";
                
            }
        }

    }





?>