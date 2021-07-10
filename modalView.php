<?php
    require_once("movieSort.php");
    $movieCode = $_GET["movieCode"];

    foreach($movies as $movie){
        $movieID = $movie->getAttribute("movieCode");
        $title = $movie->getElementsbyTagName("title")[0]->nodeValue;
        $director = $movie->getElementsbyTagName("director")[0]->nodeValue;
        $genre = $movie->getElementsbyTagName("genre")[0]->nodeValue;
        $dateOfRelease = $movie->getElementsbyTagName("dateOfRelease")[0]->nodeValue;
        $imagePath = $movie->getElementsbyTagName("imagePath")[0]->nodeValue;
        $all = [];
        if($movieCode == $movieID){
            $all[0]=$movieID;
            $all[1]=$title;
            $all[2]=$director;
            $all[3]=$genre;
            $all[4]=$dateOfRelease;
            $all[5]=$imagePath;
            $all[6]="block";
            echo implode("|", $all);
            break;
        }
    }
    
    
?>