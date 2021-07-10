<?php
        require_once('xmlConnector.php');

        foreach($xml->getElementsByTagName('movie') as $movie) {
            $sortMovie[] = array(
                             'movieCode'             => $movie->getAttribute("movieCode"),
                             'title'          => $movie->getElementsByTagName("title")->item(0)->nodeValue,
                             'director'       => $director = $movie->getElementsByTagName("director")->item(0)->nodeValue,
                             'genre'         => $movie->getElementsByTagName("genre")->item(0)->nodeValue,
                             'dateOfRelease' => $movie->getElementsByTagName("dateOfRelease")->item(0)->nodeValue
                            );
        }
        
        function sortByOrder($a, $b) {
            return $a['movieCode'] - $b['movieCode'];
        }
        usort($sortMovie, 'sortByOrder');


        foreach($xmlGames->getElementsByTagName('game') as $game) {
            $sortGame[] = array(
                             'gameCode'      => $game->getAttribute("gameCode"),
                             'title'          => $game->getElementsByTagName("title")->item(0)->nodeValue,
                             'developer'       => $game->getElementsByTagName("developer")->item(0)->nodeValue,
                             'publisher'       => $game->getElementsByTagName("publisher")->item(0)->nodeValue,
                             'genre'         => $game->getElementsByTagName("genre")->item(0)->nodeValue,
                             'price'       => $game->getElementsByTagName("price")->item(0)->nodeValue,
                             'dateOfRelease' => $game->getElementsByTagName("dateOfRelease")->item(0)->nodeValue,
                             'description'       => $game->getElementsByTagName("description")->item(0)->nodeValue,
                             'imagePath'       => $game->getElementsByTagName("imagePath")->item(0)->nodeValue,
                            );
        }

        function sortOrder($a, $b) {
            return $a['gameCode'] - $b['gameCode'];
        }
        usort($sortGame, 'sortOrder');
        
?>