<?php 

    $xmlGames = new DOMDocument();
    $xmlGames->load('games.xml');
    $games = $xmlGames->getElementsByTagName("game");

    $xmlCarts = new DOMDocument();
    $xmlCarts->load('cart.xml');
    $carts = $xmlCarts->getElementsByTagName("cart");
    
    $xmlChat = new DOMDocument();
    $xmlChat->load("chats.xml");
    $chats = $xmlChat->getElementsByTagName("chat");

    $xmlWish = new DOMDocument();
    $xmlWish->load('wishlist.xml');
    $wishes = $xmlWish->getElementsByTagName("wish");
?>