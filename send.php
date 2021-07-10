<?php

session_start();

if(isset($_POST['message'])){
    $message = $_POST['message'];
    $receiver = $_SESSION['other'];
    $sender = $_SESSION['username'];
    date_default_timezone_set('Asia/Manila');
    $dateSent = new DateTime();
    $dateSent = $dateSent->format("Y-m-d H:i:s");
    if(trim($message) == ""){
        echo "empty";
    }else{
        $xml = new domdocument();
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;
        $xml->load("chats.xml");

        $chat = $xml->createElement("chat");

        $sender = $xml->createElement("sender", $sender);
        $chat->appendChild($sender);

        $receiver = $xml->createElement("receiver", $receiver);
        $chat->appendChild($receiver);

        $messageEl = $xml->createElement("message", $message);
        $chat->appendChild($messageEl);

        $dateSentEl = $xml->createElement("dateSent", $dateSent);
        $chat->appendChild($dateSentEl);

        $xml->getElementsByTagName("chats")->item(0)->appendChild($chat);

        $xml->save("chats.xml");
    }
}else{
    header("Location: viewMovies.php");
}

?>