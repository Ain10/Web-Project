<?php 
    $xml = new DOMDocument();
    $xml->load("movies.xml");
    $movies = $xml->getElementsByTagName("movie");

    $xmlGames = new DOMDocument();
    $xmlGames->load('games.xml');
    $games = $xmlGames->getElementsByTagName("game");
    
    $xmlChat = new DOMDocument();
    $xmlChat->load("chats.xml");
    $chats = $xmlChat->getElementsByTagName("chat");




?>