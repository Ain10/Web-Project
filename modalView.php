<?php
    require_once("movieSort.php");
    $gameC = $_GET["gameCode"];

    foreach($games as $game){
        $gameCode = $game->getAttribute("gameCode");
        $title = $game->getElementsbyTagName("title")[0]->nodeValue;
        $developer = $game->getElementsbyTagName("developer")[0]->nodeValue;
        $publisher = $game->getElementsbyTagName("publisher")[0]->nodeValue;
        $genre = $game->getElementsbyTagName("genre")[0]->nodeValue;
        $price = $game->getElementsbyTagName("price")[0]->nodeValue;
        $dateOfRelease = $game->getElementsbyTagName("dateOfRelease")[0]->nodeValue;
        $description = $game->getElementsbyTagName("description")[0]->nodeValue;
        $imagePath = $game->getElementsbyTagName("imagePath")[0]->nodeValue;
        $all = [];
        if($gameCode == $gameC){
            $all[0]=$gameCode;
            $all[1]=$title;
            $all[2]=$developer;
            $all[3]=$publisher;
            $all[4]=$genre;
            $all[5]=$price;
            $all[6]=$dateOfRelease;
            $all[7]=$description;
            $all[8]=$imagePath;
            $all[9]="block";
            echo implode("|", $all);
            echo "hello";
            break;
        }
    }
    
    
?>