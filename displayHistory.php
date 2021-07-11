<?php
        require_once('xmlConnector.php');
        session_start();
        ob_start();
            if(empty($_SESSION['logged'])){
            header('location: index.php');
        }
        if(isset($_GET['display'])){
            $user = $_SESSION['username'];
            $activeGames=[];
            foreach($histories as $history){
                $userID = $history->getElementsByTagName('user')->item(0)->nodeValue;
                if($userID==$user){
                    $getGameCode = $history->getElementsByTagName('code');
                    //may i ffix dito
                    foreach($getGameCode as $i=>$codes){
                        $activeGames[$i]= $codes->nodeValue;
                        if($getGameCode->count() > $i)break;
                    }
                    print_r($activeGames);
                    $sortHistory[] = array(
                        'user' =>$history->getElementsByTagName('user')->item(0)->nodeValue,
                        'dateOfPurchase'=>$history->getElementsByTagName('dateOfPurchase')->item(0)->nodeValue,
                        'gameCodes'=>$activeGames,
                        'price'=>$history->getElementsByTagName('price')->item(0)->nodeValue
                    );
                }  
            }
            function sortOrder($a, $b){
                if($_GET['display']=='date'){
                    return str_replace('-','',$b['dateOfPurchase']) - str_replace('-','',$a['dateOfPurchase']);
                }elseif($_GET['display']=='price'){
                    return $b['price'] - $a['price'];
                }
            }
            usort($sortHistory, 'sortOrder');
      
            $html ='';
            foreach($sortHistory as $history){
                
                $date = $history['dateOfPurchase'];
                $gamesPurchased = $history['gameCodes'];
                $price = $history['price'];
                $html="<div id='purchasedItems'>
                <p>Purchase Date: $date</p><br>";
                foreach($gamesPurchased as $gameCode){
                    foreach($games as $i =>$gam){
                        $gamID = $gam->getAttribute('gameCode');
                        if($gameCode==$gamID){
                            $gImage = $gam->getElementsByTagName('imagePath')->item(0)->nodeValue;
                            $gTitle = $gam->getElementsByTagName('title')->item(0)->nodeValue;
                            $gDeveloper = $gam->getElementsByTagName('developer')->item(0)->nodeValue;
                            $gGenre= $gam->getElementsByTagName('genre')->item(0)->nodeValue;
                            $gPrice= $gam->getElementsByTagName('price')->item(0)->nodeValue;
                            $html .= "<img src='$gImage' id='historyImage'style='max-width: 30%;' >".
                                    "<p id='historyTitle'>$gTitle</p><br>".
                                    "<p id='historyDeveloper'>$gDeveloper</p><br>".
                                    "<p id='historyGenre'>$gGenre</p><br>".
                                    "<p id='historyPrice'>$gPrice</p><br>"
                            ;
                            
                        }
                        
                    }
                    
                }
                $html.="<p>Total: $price</p></div>";
                echo $html;
            }

        }
        
?>