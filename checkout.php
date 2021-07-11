<?php
    require_once('xmlConnector.php');
    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    
    if(isset($_GET['checkout'])){
        date_default_timezone_set('Asia/Manila');
        $dateSent = new DateTime();
        $dateSent = $dateSent->format("Y-m-d");
        $checkoutPrice = $_GET['checkout'];
        $user = $_SESSION['username'];
        $activeGames=[];
        $allCartGames =[];
        // ADD DATA VALIDATION IF EMPTY



        $hisT = $xmlHistory->createElement("history");
        $name = $xmlHistory->createElement("user",$user);
        $hisT->appendChild($name);

        $date = $xmlHistory->createElement("dateOfPurchase",$dateSent);
        $hisT->appendChild($date);

        $gameCodes = $xmlHistory->createElement("gameCodes");


        foreach($carts as $cart){
            $cartUser = $cart->getAttribute("username");
            if($user == $cartUser){
                $getGameCode = $cart->getElementsByTagName('game');
                foreach($getGameCode as $i => $codes){
                    $gameCodeSingle = $xmlHistory->createElement("code",$codes->nodeValue);
                    $gameCodes->appendChild($gameCodeSingle);
                }
                //$gameCodes->appendChild($getGameCode);

            }

        }
        $hisT->appendChild($gameCodes);
        $price = $xmlHistory->createElement("price",$checkoutPrice);
        $hisT->appendChild($price);

        $xmlHistory->getElementsByTagName("histories")->item(0)->appendChild($hisT);
        $xmlHistory->save("history.xml");

        //remove from cart
        

        foreach($carts as $cart){
            $cartID = $cart->getAttribute("username");
            $cartItem = $cart->getElementsByTagName('game');
            if($cartID == $user){
                while($cart->hasChildNodes()){
                    $cart->removeChild($cart->firstChild);
                }

                $xmlCarts->save('cart.xml');
            }
        }
        echo "Sucess";
    }

?>