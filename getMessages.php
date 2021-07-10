<?php
session_start();
include("xmlConnector.php");
if(!isset($_SESSION['username'])){
    header("Location: index.php");
}
if(isset($_GET['uname'])){
    if(!isset($_SESSION['chatCount'])){
        $_SESSION['chatCount'] = 0;
    }
    if($_GET['showChatBox'] == "show"){
        $_SESSION['chatCount'] = 0;
    }

    $user = $_SESSION['username'];
    $receiverAccount = $_GET['uname'];
    $_SESSION['other'] = $receiverAccount;


    if($_SESSION['chatCount'] == count($chats)){
    }else{

        for($i=$_SESSION['chatCount']; $i<count($chats); $i++){
            $chat = $chats[$i];
            $c_receiver = $chat->getElementsByTagName('receiver')->item(0)->nodeValue;
            $c_sender = $chat->getElementsByTagName('sender')->item(0)->nodeValue;
            if( $c_receiver == $receiverAccount && $c_sender == $user){
                $message = $chat->getElementsByTagName('message')->item(0)->nodeValue;
                $dateSent = $chat->getElementsByTagName('dateSent')->item(0)->nodeValue;
                $dateSent = date_create($dateSent);
                $dateSent = date_format($dateSent, "M d, Y h:i a");
    
                echo "<div class='chat-row sender-row'>
                    <div class='sender'>
                        <pre class='chat-text'>$message</pre>
                        <p class='chat-time'>$dateSent</p>
                    </div>
                    
                </div>";
            }else if($c_receiver == $user && $c_sender == $receiverAccount){
                $message = $chat->getElementsByTagName('message')->item(0)->nodeValue;
                $dateSent = $chat->getElementsByTagName('dateSent')->item(0)->nodeValue;
                $dateSent = date_create($dateSent);
                $dateSent = date_format($dateSent, "M d, Y h:i a");
                echo "
                <div class='chat-row receiver-row'>
                    <div class='receiver'>
                        <pre class='chat-text'>$message</pre>
                        <p class='chat-time'>$dateSent</p>
                    </div>
                    
                </div>";
            }
        }
        $_SESSION['chatCount'] = count($chats);

    }
}else{
    header("Location: viewMovies.php");
}



?>