<!DOCTYPE html>
<?php 
    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    require_once('movieSort.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body onload="">
<script src="jquery-3.6.0.js"></script>
<script type="application/javascript" src="scripts.js"></script>
</script>
<!--- Profile Picture with username --->
<div class="profile-container">
            <div id="profile-pic-container">
                <img id="profile-pic" src="profile_pics/<?php echo $_SESSION['profilePic'] ;?>" onclick="editProfilePic()">
            </div>
            <div id="username-text">
                Hello, 
                <?php echo $_SESSION['firstN']." ".$_SESSION['lastN'];?>
                <span id="at-uname"><br><?php echo $_SESSION['username'];?></span>
            </div>
            <button onclick="logout()" id="LogoutButton">Logout</button>
        </div>


<table onmouseout="hideModal()" id="tableMovies"><tr><th>Movie Code</th><th>Title</th><th>Director</th><th>Genre</th><th>Date of Release</th></tr>
    <?php 
        foreach($sortMovie as $movie){
            $id=$movie['movieCode'];
            $title=$movie['title'];
            $director=$movie['director'];
            $genre=$movie['genre'];
            $dateOfRelease=$movie['dateOfRelease'];
            echo "<tr onmouseover='displayModal($id)' id='trHover'><td>$id</td><td>$title</td><td>$director</td><td>$genre</td><td>$dateOfRelease</td></tr>";
        }
    ?>
    </table>
    <div id="modal" style="display: none;">
        
        <img src="" id="modalImage"><br>
        <p><strong>Movie Code</strong></p>
        <p id="movieCode"></p>
        <p><strong>Movie Title</strong></p>
        <p id="movieTitle"></p>
        <p><strong>Movie Director</strong></p>
        <p id="movieDirector"></p>
        <p><strong>Movie Genre</strong></p>
        <p id="movieGenre"></p>
        <p><strong>Movie Date of Release</strong>
        <p id="movieDateOfRelease"></p>
    </div>
    <!-- Activity 5   -->
    <div id="divAllUser">
    <h3 id="activeU">Active Users(<span id="activeUsers">0</span>)</h3>
    <ul id="userList"></ul>
    </div>
    <div class="box">
	<div id="pop-over">	</div>
</div>

<div id="chatbox">
    <button id="close-btn" onclick="hideChatBox()">x</button>
    <div class="UserChatBox chat-top">
        <p class='chat-name'></p>
        <p class='chat-uname'></p>
    </div>
    <div class="MainChat chat-mid">
<!---- Them  ---->
        <div class="chat-row sender-row">
            <div class="sender">
                <p class="chat-time"></p>
                <p class="chat-text"></p>
            </div>
        </div>
<!---- Us  ---->
        <div class="chat-row receiver-row">
            <div class="receiver">
                <p class="chat-time"></p>
                <p class="chat-text"></p>
            </div>
        </div>
    </div>
    <div class="ChatArea chat-bot">
        <textarea name="textarea" id="textarea" cols="35" rows="5"></textarea>
        <button id="send-btn" onclick="sendChat()">Send</button>
    </div>
</div>
<!--- Change profile picture modal --->
<div id="edit-img-container">
    <div id="edit-box">
        <div id="img-box">
            <img id="current-profile-pic">
        </div>
        <input type="file" id="pic" onchange="displayChosenImage()">
        <button id="change-img-btn" onclick="saveImage()">Save Changes</button>
        <button id="exit-change-btn" onclick="exitModal()">x</button>

    </div>
</div>

</body>
</html>