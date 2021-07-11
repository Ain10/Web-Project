<?php
    require_once('xmlConnector.php');
    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    $user = $_SESSION['username'];
    if(isset($_GET['getGames'])){
        $wishGames =[];
        $allWishGames = [];
       
        //wish
        
        foreach($wishes as $wish){

            
            $cartUser = $wish->getAttribute("username");
            
            if($user == $cartUser){
 
                //print_r($array);
                $getGameCode = $wish->getElementsByTagName('game');
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
                                <button id='cartGameTitle' onclick='addToCartFromWishList($gameCodeHolder)'>Add to Cart</button>
                                <button id='itemRemove' onclick='cartItemRemove($gameCodeHolder".','.'2'.")'>Remove Item</button>
                                </div>
                                ";
                            }
                        }
                    }
                }else{
                    echo "Wishlist Empty";
                }

            }
        }
    }
?>