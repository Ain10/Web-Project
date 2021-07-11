<?php
        require_once('xmlConnector.php');
        session_start();
        ob_start();
            if(empty($_SESSION['logged'])){
            header('location: index.php');
        }
        $user = $_SESSION['username'];

        if(isset($_GET['removeFromWishlist'])){
            $gameCode = $_GET['removeFromWishlist'];

            foreach($wishes as $wish){
                $wishID = $wish->getAttribute("username");
                $wishGame = $wish->getElementsByTagName('game');
    
                if($wishID == $user){
                    foreach($wishGame as $counter=>$gameWish){
                        if($gameWish->nodeValue == $gameCode){
                            $willBeRemoved = $wish->getElementsByTagName('game')[$counter];
                            echo $willBeRemoved->nodeValue;
                            $wish->removeChild($willBeRemoved);
                          
                        }
                    }
                    
                    $xmlWish->save('wishlist.xml');
                    //SWEET NOTIF
                    echo "delete sucess 2";
                    
                }
            }
        }



        if(isset($_GET['removeFromCart'])){
            $gameCode = $_GET['removeFromCart'];
            foreach($carts as $cart){
                $cartID = $cart->getAttribute("username");
                $cartItem = $cart->getElementsByTagName('game');
    
                if($cartID == $user){
                    foreach($cartItem as $counter=>$gameCart){
                        if($gameCart->nodeValue == $gameCode){
                            $willBeRemoved = $cart->getElementsByTagName('game')[$counter];
                            echo $willBeRemoved->nodeValue;
                            $cart->removeChild($willBeRemoved);
                            
                        }
                    }
                    
                    $xmlCarts->save('cart.xml');
                    //SWEET NOTIF
                    echo "delete sucess 2";
                    
                }
            }
        }
?>