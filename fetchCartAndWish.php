<?php
    require_once('xmlConnector.php');
    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    if(isset($_GET['getGames'])){
        $activeGames=[];
        $allCartGames =[];
        
        foreach($carts as $cart){
            $user = $_SESSION['username'];
            $cartUser = $cart->getAttribute("username");
            if($user == $cartUser){
                //GET USER CART ITEMS
                //print_r($array);
                $getGameCode = $cart->getElementsByTagName('game');
                $codeText = "";
                foreach($getGameCode as $i=>$codes){
                    $activeGames[$i]= $codes->nodeValue;
                }
            if(!empty($activeGames)){ 
                foreach($activeGames as $cartGames){
                    foreach($games as $game){
                        $gameCodeHolder = $game->getAttribute("gameCode");
                        if($cartGames == $gameCodeHolder){
                            $getGameTitle = $game->getElementsbyTagName("title")[0]->nodeValue;
                            $getGamePrice = $game->getElementsbyTagName("price")[0]->nodeValue;
                            $getGameImage = $game->getElementsbyTagName("imagePath")[0]->nodeValue;
                            echo "
                            <div id='cartItem'>
                            <img src='$getGameImage' id='cartImage'>
                            <p id='cartGameTitle'>$getGameTitle</p>
                            <p id='cartGamePrice'>$getGamePrice</p>
                            <button id='cartGameTitle' onclick='viewItemDetails($gameCodeHolder)'>View Details</button>
                            <button id='itemRemove' onclick='cartItemRemove($gameCodeHolder".','.'1'.")'>Remove Item</button>
                            </div>
                            ";
                        }
                    }
                }
            }else{
                echo "Cart Empty";
            }
            }
        }

    }


?>