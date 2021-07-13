<?php
        require_once('xmlConnector.php');
        $xmlGames = new DOMDocument();
        $xmlGames->load('games.xml');
        $games = $xmlGames->getElementsByTagName("game");

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