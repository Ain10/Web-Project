<?php 
    $xml = new DOMDocument();
    $xml->load("movies.xml");
    $movies = $xml->getElementsByTagName("movie");

    
    $xmlChat = new DOMDocument();
    $xmlChat->load("chats.xml");
    $chats = $xmlChat->getElementsByTagName("chat");
?>