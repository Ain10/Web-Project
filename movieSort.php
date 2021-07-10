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
?>