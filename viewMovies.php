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

<div id="displayCart">
    <h2>Cart</h2>
    <div id="Cartlist">
    
    </div>
    <div id="checkOut">
        <h3>Price</h3>
        <button id="checkOutButton">Check out</button>
    </div>
</div>
<div id="displayWishlist">
    <h2>Wishlist</h2>
    <div id="wishList">

    </div>
</div>
<table  id="tableMovies"><tr><th>Game Code</th><th>Title</th><th>Developer</th><th>Publisher</th><th>Genre</th><th>Price</th><th>Date of Release</th><th>Image</th></tr>
    <?php 
        foreach($sortGame as $game){
            $id=$game['gameCode'];
            $title=$game['title'];
            $developer=$game['developer'];
            $publisher=$game['publisher'];
            $genre=$game['genre'];
            $price=$game['price'];
            $dateOfRelease=$game['dateOfRelease'];
            $imagePath=$game['imagePath'];

            echo "<tr onclick='displayModal($id)' id='trHover'>
            <td>$id</td>
            <td>$title</td>
            <td>$developer</td>
            <td>$publisher</td>
            <td>$genre</td>
            <td>$price</td>
            <td>$dateOfRelease</td>
            <td>$imagePath</td>
            </tr>";
        }
    ?>
    </table>
    <div id="modal" style="display: none;" onclick="hideModal()">
        <input id='gameCodeHolder' type='hidden' value="">
        <img src="" id="modalImage"><br>
        <p><strong>Game Code</strong></p>
        <p id="gameCode"></p>
        <p><strong>Game Title</strong></p>
        <p id="gameTitle"></p>
        <p><strong>Game Director</strong></p>
        <p id="gameDeveloper"></p>
        <p><strong>Game Publisher</strong></p>
        <p id="gamePublisher"></p>
        <p><strong>Genre</strong></p>
        <p id="gameGenre"></p>
        <p><strong>Price</strong></p>
        <p id="gamePrice"></p>
        <p><strong>Date of Release</strong>
        <p id="DateOfRelease"></p>
        <p><strong>Description</strong>
        <p id="gameDescription"></p>
        <button id='addtoCartButton' onclick="addToCart()">Add to Cart</button>
        <button id='addToWishList' onclick="addtoWishList()">Add to Wishlist</button>
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