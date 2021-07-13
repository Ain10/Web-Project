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
   
            $newGamesAdded = $xmlWish->createElement('game',$gameCode);
            
            foreach($wishes as $wish){
                
                $wishID = $wish->getAttribute("username");

                if($wishID == $user){
                    $wishGs = $wish->getElementsByTagName('game');
                    foreach($wishGs as $i => $wishGCodes){
                        if($wishGCodes->nodeValue == $gameCode){
                            //sweet alert "already added"
                            echo "already added";
                            system(exit);
                        }
                    }
                    $wish->appendChild($newGamesAdded);
                    $xmlWish->save('wishlist.xml');
                    echo "SUCCESS";
                    
                }
            }
        }


    //ADD GAME TO CART
    if(isset($_GET['addG'])){
        $gameCode = $_GET['addG'];
        $user = $_SESSION['username'];
        $newGamesAdded = $xmlCarts->createElement('game',$gameCode);
        foreach($carts as $cart){
            $cartID = $cart->getAttribute("username");
            if($cartID == $user){
                $cartGs = $cart->getElementsByTagName('game');
                foreach($cartGs as $i => $cartGCodes){
                    if($cartGCodes->nodeValue == $gameCode){
                        //sweet alert already added
                        echo "already added";
                        system(exit);
                    }
                }
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

 
        
        $newGamesAdded = $xmlCarts->createElement('game',$gameCode);

        foreach($carts as $cart){
            $cartID = $cart->getAttribute("username");

            if($cartID == $user){
                $cartGs = $cart->getElementsByTagName('game');
                foreach($cartGs as $i => $cartGCodes){
                    if($cartGCodes->nodeValue == $gameCode){
                        //sweet alert already added
                        echo "already added";
                        system(exit);
                    }
                }
                $cart->appendChild($newGamesAdded);
                $xmlCarts->save('cart.xml');
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